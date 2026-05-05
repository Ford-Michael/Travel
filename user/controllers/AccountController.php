<?php
/**
 * Account Controller
 * Handles the user account detail page.
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/CheckoutModel.php';

class AccountController extends Controller {
    private $userModel;
    private $bookingModel;
    private $checkoutModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->checkoutModel = new CheckoutModel();
    }

    /**
     * Show current user account details.
     */
    public function index() {
        $this->requireAuth();

        $currentUser = $this->getCurrentUser();
        $account = $this->userModel->findById($currentUser['id']);

        if (!$account) {
            session_unset();
            session_destroy();
            session_start();

            $this->setFlash('danger', 'Tai khoan khong con ton tai. Vui long dang nhap lai.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        $bookingHistory = $this->bookingModel->getDetailedByUser($currentUser['id']);
        $paymentHistory = $this->checkoutModel->getDetailedByUser($currentUser['id']);
        $totalPaymentAmount = 0;

        foreach ($paymentHistory as $payment) {
            $totalPaymentAmount += (float) ($payment['amount'] ?? 0);
        }

        $this->view('account/index', [
            'title'              => 'Chi tiet tai khoan | Travel Bling',
            'flash'              => $this->getFlash(),
            'user'               => $currentUser,
            'account'            => $account,
            'accountFields'      => $this->userModel->getAccountFields($account),
            'bookingHistory'     => $bookingHistory,
            'paymentHistory'     => $paymentHistory,
            'totalPaymentAmount' => $totalPaymentAmount,
        ]);
    }

    /**
     * Save quick contact info (email, phone, address) on account page.
     */
    public function saveContact() {
        $this->requireAuth();

        if (!$this->isPost()) {
            $this->redirect('index.php?controller=account');
        }

        $currentUser = $this->getCurrentUser();
        $account = $this->userModel->findById($currentUser['id']);
        if (!$account) {
            $this->setFlash('danger', 'Không tìm thấy tài khoản.');
            $this->redirect('index.php?controller=account');
        }

        $email = trim((string) $this->post('email', ''));
        $phone = trim((string) $this->post('phone', ''));
        $address = trim((string) $this->post('address', ''));

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->setFlash('danger', 'Email không hợp lệ.');
            $this->redirect('index.php?controller=account');
        }

        $columns = $this->userModel->getTableColumns();
        $data = [];

        if (in_array('email', $columns, true)) {
            $data['email'] = $email;
        }

        if (in_array('phoneNumber', $columns, true)) {
            $data['phoneNumber'] = $phone;
        } elseif (in_array('phone', $columns, true)) {
            $data['phone'] = $phone;
        }

        if (in_array('address', $columns, true)) {
            $data['address'] = $address;
        }

        if (empty($data)) {
            $this->setFlash('danger', 'Không có trường dữ liệu phù hợp để cập nhật.');
            $this->redirect('index.php?controller=account');
        }

        $updated = $this->userModel->updateProfile($currentUser['id'], $data);
        if (!$updated) {
            $this->setFlash('danger', 'Không thể cập nhật thông tin. Vui lòng thử lại.');
            $this->redirect('index.php?controller=account');
        }

        // Keep session user info in sync.
        $_SESSION['user_email'] = $email;
        $_SESSION['user_phone'] = $phone;

        $this->setFlash('success', 'Đã lưu thông tin liên hệ.');
        $this->redirect('index.php?controller=account');
    }
}
