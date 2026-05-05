<?php
/**
 * Booking Controller
 * Manages Booking operations
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/BookingModel.php';

class BookingController extends Controller {
    private $bookingModel;

    public function __construct() {
        $this->bookingModel = new BookingModel();
    }

    /**
     * List all bookings
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $status = $this->get('status');
        
        if ($search) {
            $bookings = $this->bookingModel->search($search);
        } elseif ($status) {
            $bookings = $this->bookingModel->getByStatus($status);
        } else {
            $bookings = $this->bookingModel->getAllWithDetails();
        }
        
        $this->view('bookings/index', [
            'title' => 'Bookings Management',
            'bookings' => $bookings,
            'search' => $search,
            'currentStatus' => $status,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form
     */
    public function create() {
        $this->requireAuth();
        
        require_once __DIR__ . '/../models/TourModel.php';
        require_once __DIR__ . '/../models/UserModel.php';
        
        $tourModel = new TourModel();
        $userModel = new UserModel();
        
        $this->view('bookings/create', [
            'title' => 'Create Booking',
            'tours' => $tourModel->findAll('title ASC'),
            'users' => $userModel->findAll('usersname ASC'),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new booking
    /**
     * Store new booking
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=booking&action=create');
        }

        $data = [
            'tourID' => intval($this->post('tourID')),
            'usersID' => intval($this->post('usersID')),
            'numAdults' => intval($this->post('numberOfAdults', 1)),
            'numChildren' => intval($this->post('numberOfChildren', 0)),
            'bookingDate' => $this->post('bookingDate') ?: date('Y-m-d H:i:s'),
            'totalPrice' => floatval($this->post('totalPrice')),
            'bookingStatus' => $this->sanitize($this->post('bookingStatus', 'Pending')),
            'paymentStatus' => $this->sanitize($this->post('paymentStatus', 'Unpaid')),
            'specialRequests' => $this->sanitize($this->post('specialRequests'))
        ];

        // Validation
        if (!$data['tourID'] || !$data['usersID']) {
            $this->setFlash('danger', 'Tour and User are required.');
            $this->redirect('index.php?controller=booking&action=create');
        }

        if ($data['numAdults'] < 1) {
            $this->setFlash('danger', 'At least 1 adult is required.');
            $this->redirect('index.php?controller=booking&action=create');
        }

        $bookingId = $this->bookingModel->create($data);

        if ($bookingId) {
            $this->setFlash('success', 'Booking created successfully!');
            $this->redirect('index.php?controller=booking');
        } else {
            $this->setFlash('danger', 'Failed to create booking.');
            $this->redirect('index.php?controller=booking&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $booking = $this->bookingModel->getWithDetails($id);

        if (!$booking) {
            $this->setFlash('danger', 'Booking not found.');
            $this->redirect('index.php?controller=booking');
        }

        require_once __DIR__ . '/../models/TourModel.php';
        require_once __DIR__ . '/../models/UserModel.php';
        
        $tourModel = new TourModel();
        $userModel = new UserModel();

        $this->view('bookings/edit', [
            'title' => 'Edit Booking',
            'booking' => $booking,
            'tours' => $tourModel->findAll('title ASC'),
            'users' => $userModel->findAll('usersname ASC'),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update booking
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=booking');
        }

        $id = $this->post('bookingID');
        $booking = $this->bookingModel->findById($id);

        if (!$booking) {
            $this->setFlash('danger', 'Booking not found.');
            $this->redirect('index.php?controller=booking');
        }

        $data = [
            'tourID' => intval($this->post('tourID')),
            'usersID' => intval($this->post('usersID')),
            'numAdults' => intval($this->post('numberOfAdults', 1)),
            'numChildren' => intval($this->post('numberOfChildren', 0)),
            'totalPrice' => floatval($this->post('totalPrice')),
            'bookingStatus' => $this->sanitize($this->post('bookingStatus')),
            'paymentStatus' => $this->sanitize($this->post('paymentStatus')),
            'specialRequests' => $this->sanitize($this->post('specialRequests'))
        ];

        // Validation
        if (!$data['tourID'] || !$data['usersID']) {
            $this->setFlash('danger', 'Tour and User are required.');
            $this->redirect('index.php?controller=booking&action=edit&id=' . $id);
        }

        if ($this->bookingModel->update($id, $data)) {
            $this->setFlash('success', 'Booking updated successfully!');
            $this->redirect('index.php?controller=booking');
        } else {
            $this->setFlash('danger', 'Failed to update booking.');
            $this->redirect('index.php?controller=booking&action=edit&id=' . $id);
        }
    }

    /**
     * View booking details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $booking = $this->bookingModel->getWithDetails($id);

        if (!$booking) {
            $this->setFlash('danger', 'Booking not found.');
            $this->redirect('index.php?controller=booking');
        }

        $this->view('bookings/view', [
            'title' => 'Booking Details',
            'booking' => $booking,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update booking status
     */
    public function updateStatus() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=booking');
        }

        $id = $this->post('bookingID');
        $bookingStatus = $this->sanitize($this->post('bookingStatus'));
        $paymentStatus = $this->sanitize($this->post('paymentStatus'));

        $booking = $this->bookingModel->findById($id);
        if (!$booking) {
            $this->setFlash('danger', 'Booking not found.');
            $this->redirect('index.php?controller=booking');
        }

        $updated = false;
        
        if ($bookingStatus) {
            $updated = $this->bookingModel->updateStatus($id, $bookingStatus);
        }
        
        if ($paymentStatus) {
            $updated = $this->bookingModel->updatePaymentStatus($id, $paymentStatus) || $updated;
        }

        if ($updated) {
            $this->setFlash('success', 'Booking status updated successfully!');
        } else {
            $this->setFlash('danger', 'Failed to update booking status.');
        }
        
        $this->redirect('index.php?controller=booking&action=show&id=' . $id);
    }

    /**
     * Delete booking
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->bookingModel->delete($id)) {
            $this->setFlash('success', 'Booking deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete booking.');
        }
        
        $this->redirect('index.php?controller=booking');
    }

    /**
     * Quick status update via GET (for buttons)
     */
    public function setStatus() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $status = $this->get('status');
        $type = $this->get('type', 'booking'); // 'booking' or 'payment'

        if ($type === 'payment') {
            $result = $this->bookingModel->updatePaymentStatus($id, $status);
        } else {
            $result = $this->bookingModel->updateStatus($id, $status);
        }

        if ($result) {
            $this->setFlash('success', ucfirst($type) . ' status updated!');
        } else {
            $this->setFlash('danger', 'Failed to update status.');
        }
        
        $this->redirect('index.php?controller=booking');
    }
}
