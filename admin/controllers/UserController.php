<?php
/**
 * User Controller
 * Manages User CRUD operations for admin
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/CheckoutModel.php';

class UserController extends Controller {
    private $userModel;
    private $bookingModel;
    private $checkoutModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->checkoutModel = new CheckoutModel();
    }

    /**
     * List all users
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $status = $this->get('status');
        
        if ($search) {
            $users = $this->userModel->search($search);
        } elseif ($status === 'active') {
            $users = $this->userModel->getActiveUsers();
        } elseif ($status === 'inactive') {
            $users = $this->userModel->getInactiveUsers();
        } else {
            $users = $this->userModel->findAll('usersID DESC');
        }
        
        $this->view('users/index', [
            'title' => 'Users Management',
            'users' => $users,
            'search' => $search,
            'currentStatus' => $status,
            'totalUsers' => $this->userModel->count(),
            'activeCount' => $this->userModel->countByStatus('active'),
            'inactiveCount' => $this->userModel->countByStatus('inactive'),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form
     */
    public function create() {
        $this->requireAuth();
        
        $this->view('users/create', [
            'title' => 'Add New User',
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new user
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=user&action=create');
        }

        $data = [
            'usersname' => $this->sanitize($this->post('usersname')),
            'email' => $this->sanitize($this->post('email')),
            'password' => $this->post('password'),
            'phoneNumber' => $this->sanitize($this->post('phoneNumber')),
            'address' => $this->sanitize($this->post('address'))
        ];

        // Validation
        if (empty($data['usersname']) || empty($data['email']) || empty($data['password'])) {
            $this->setFlash('danger', 'Username, Email and Password are required.');
            $this->redirect('index.php?controller=user&action=create');
        }

        if (!$this->validateEmail($data['email'])) {
            $this->setFlash('danger', 'Please enter a valid email address.');
            $this->redirect('index.php?controller=user&action=create');
        }

        if ($this->userModel->emailExists($data['email'])) {
            $this->setFlash('danger', 'Email already exists.');
            $this->redirect('index.php?controller=user&action=create');
        }

        if (strlen($data['password']) < 6) {
            $this->setFlash('danger', 'Password must be at least 6 characters.');
            $this->redirect('index.php?controller=user&action=create');
        }

        $userId = $this->userModel->createUser($data);

        if ($userId) {
            $this->setFlash('success', 'User created successfully!');
            $this->redirect('index.php?controller=user');
        } else {
            $this->setFlash('danger', 'Failed to create user.');
            $this->redirect('index.php?controller=user&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $user = $this->userModel->findById($id);

        if (!$user) {
            $this->setFlash('danger', 'User not found.');
            $this->redirect('index.php?controller=user');
        }

        $this->view('users/edit', [
            'title' => 'Edit User',
            'user' => $user,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update user
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=user');
        }

        $id = $this->post('usersID');
        $user = $this->userModel->findById($id);

        if (!$user) {
            $this->setFlash('danger', 'User not found.');
            $this->redirect('index.php?controller=user');
        }

        $data = [
            'usersname' => $this->sanitize($this->post('usersname')),
            'email' => $this->sanitize($this->post('email')),
            'phoneNumber' => $this->sanitize($this->post('phoneNumber')),
            'address' => $this->sanitize($this->post('address'))
        ];

        // Only update password if provided
        $password = $this->post('password');
        if (!empty($password)) {
            if (strlen($password) < 6) {
                $this->setFlash('danger', 'Password must be at least 6 characters.');
                $this->redirect('index.php?controller=user&action=edit&id=' . $id);
            }
            $data['password'] = $password;
        }

        // Validation
        if (empty($data['usersname']) || empty($data['email'])) {
            $this->setFlash('danger', 'Username and Email are required.');
            $this->redirect('index.php?controller=user&action=edit&id=' . $id);
        }

        if (!$this->validateEmail($data['email'])) {
            $this->setFlash('danger', 'Please enter a valid email address.');
            $this->redirect('index.php?controller=user&action=edit&id=' . $id);
        }

        if ($this->userModel->emailExists($data['email'], $id)) {
            $this->setFlash('danger', 'Email already exists.');
            $this->redirect('index.php?controller=user&action=edit&id=' . $id);
        }

        if ($this->userModel->updateUser($id, $data)) {
            $this->setFlash('success', 'User updated successfully!');
            $this->redirect('index.php?controller=user');
        } else {
            $this->setFlash('danger', 'Failed to update user.');
            $this->redirect('index.php?controller=user&action=edit&id=' . $id);
        }
    }

    /**
     * Delete user
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->userModel->delete($id)) {
            $this->setFlash('success', 'User deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete user.');
        }
        
        $this->redirect('index.php?controller=user');
    }

    /**
     * Toggle user status
     */
    public function toggleStatus() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->userModel->toggleStatus($id)) {
            $this->setFlash('success', 'User status updated!');
        } else {
            $this->setFlash('danger', 'Failed to update user status.');
        }
        
        $this->redirect('index.php?controller=user');
    }

    /**
     * View user details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $user = $this->userModel->findById($id);

        if (!$user) {
            $this->setFlash('danger', 'User not found.');
            $this->redirect('index.php?controller=user');
        }

        $bookingHistory = $this->bookingModel->getDetailedByUser($id);
        $paymentHistory = $this->checkoutModel->getDetailedByUser($id);
        $totalPaymentAmount = 0;

        foreach ($paymentHistory as $payment) {
            $totalPaymentAmount += (float) ($payment['amount'] ?? 0);
        }

        $this->view('users/view', [
            'title' => 'User Details',
            'user' => $user,
            'bookingHistory' => $bookingHistory,
            'paymentHistory' => $paymentHistory,
            'totalPaymentAmount' => $totalPaymentAmount,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }
}
