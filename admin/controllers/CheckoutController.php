<?php
/**
 * Checkout Controller
 * Manages Payment/Checkout operations
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/CheckoutModel.php';

class CheckoutController extends Controller {
    private $checkoutModel;

    public function __construct() {
        $this->checkoutModel = new CheckoutModel();
    }

    /**
     * List all checkouts/payments
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $status = $this->get('status');
        $checkouts = $this->getCheckoutList($search, $status);
        
        $this->view('checkouts/index', [
            'title' => 'Payments Management',
            'checkouts' => $checkouts,
            'search' => $search,
            'currentStatus' => $status,
            'totalPayments' => $this->checkoutModel->getTotalPayments(),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form
     */
    public function create() {
        $this->requireAuth();
        
        require_once __DIR__ . '/../models/BookingModel.php';
        $bookingModel = new BookingModel();
        
        $this->view('checkouts/create', [
            'title' => 'Create Payment',
            'bookings' => $bookingModel->getAllWithDetails(),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new payment
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=checkout&action=create');
        }

        $data = [
            'bookingID' => intval($this->post('bookingID')),
            'paymentMethod' => $this->sanitize($this->post('paymentMethod')),
            'paymentAmount' => floatval($this->post('paymentAmount')),
            'paymentDate' => $this->post('paymentDate') ?: date('Y-m-d H:i:s'),
            'paymentStatus' => $this->sanitize($this->post('paymentStatus', 'Pending'))
        ];

        // Validation
        if (!$data['bookingID']) {
            $this->setFlash('danger', 'Booking is required.');
            $this->redirect('index.php?controller=checkout&action=create');
        }

        if ($data['paymentAmount'] <= 0) {
            $this->setFlash('danger', 'Payment amount must be greater than 0.');
            $this->redirect('index.php?controller=checkout&action=create');
        }

        $checkoutId = $this->checkoutModel->create($data);

        if ($checkoutId) {
            $this->setFlash('success', 'Payment created successfully!');
            $this->redirect('index.php?controller=checkout');
        } else {
            $this->setFlash('danger', 'Failed to create payment.');
            $this->redirect('index.php?controller=checkout&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $checkout = $this->checkoutModel->getWithDetails($id);

        if (!$checkout) {
            $this->setFlash('danger', 'Payment not found.');
            $this->redirect('index.php?controller=checkout');
        }

        require_once __DIR__ . '/../models/BookingModel.php';
        $bookingModel = new BookingModel();

        $this->view('checkouts/edit', [
            'title' => 'Edit Payment',
            'checkout' => $checkout,
            'bookings' => $bookingModel->getAllWithDetails(),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update payment
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=checkout');
        }

        $id = $this->post('checkoutID');
        $checkout = $this->checkoutModel->findById($id);

        if (!$checkout) {
            $this->setFlash('danger', 'Payment not found.');
            $this->redirect('index.php?controller=checkout');
        }

        $data = [
            'paymentMethod' => $this->sanitize($this->post('paymentMethod')),
            'paymentAmount' => floatval($this->post('paymentAmount')),
            'paymentStatus' => $this->sanitize($this->post('paymentStatus'))
        ];

        if ($this->checkoutModel->update($id, $data)) {
            $this->setFlash('success', 'Payment updated successfully!');
            $this->redirect('index.php?controller=checkout');
        } else {
            $this->setFlash('danger', 'Failed to update payment.');
            $this->redirect('index.php?controller=checkout&action=edit&id=' . $id);
        }
    }

    /**
     * View checkout details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $checkout = $this->checkoutModel->getWithDetails($id);

        if (!$checkout) {
            $this->setFlash('danger', 'Payment record not found.');
            $this->redirect('index.php?controller=checkout');
        }

        $this->view('checkouts/view', [
            'title' => 'Payment Details',
            'checkout' => $checkout,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update payment status
     */
    public function updateStatus() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=checkout');
        }

        $id = $this->post('checkoutID');
        $status = $this->sanitize($this->post('paymentStatus'));

        if ($this->checkoutModel->updatePaymentStatus($id, $status)) {
            $this->setFlash('success', 'Payment status updated successfully!');
        } else {
            $this->setFlash('danger', 'Failed to update payment status.');
        }
        
        $this->redirect('index.php?controller=checkout&action=show&id=' . $id);
    }

    /**
     * Quick status update via GET
     */
    public function setStatus() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $status = $this->get('status');

        if ($this->checkoutModel->updatePaymentStatus($id, $status)) {
            $this->setFlash('success', 'Payment status updated!');
        } else {
            $this->setFlash('danger', 'Failed to update status.');
        }
        
        $this->redirect('index.php?controller=checkout');
    }

    /**
     * Delete checkout record
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->checkoutModel->delete($id)) {
            $this->setFlash('success', 'Payment record deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete payment record.');
        }
        
        $this->redirect('index.php?controller=checkout');
    }

    public function exportExcel() {
        $this->requireAuth();

        $search = $this->get('search');
        $status = $this->get('status');
        $id = $this->get('id');
        $checkouts = $this->getCheckoutExportData($search, $status, $id);

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $this->buildExportFilename('payment', 'xls', $id) . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";

        require __DIR__ . '/../views/checkouts/export_excel.php';
        exit;
    }

    public function exportPdf() {
        $this->requireAuth();

        $search = $this->get('search');
        $status = $this->get('status');
        $id = $this->get('id');
        $checkouts = $this->getCheckoutExportData($search, $status, $id);
        $checkout = $id ? $this->checkoutModel->getWithDetails($id) : null;

        if ($id && !$checkout) {
            $this->setFlash('danger', 'Payment not found.');
            $this->redirect('index.php?controller=checkout');
        }

        require __DIR__ . '/../views/checkouts/export_pdf.php';
        exit;
    }

    private function getCheckoutList($search = '', $status = '') {
        if ($search) {
            return $this->checkoutModel->search($search);
        }

        if ($status) {
            return $this->checkoutModel->getByPaymentStatus($status);
        }

        return $this->checkoutModel->getAllWithDetails();
    }

    private function getCheckoutExportData($search = '', $status = '', $id = '') {
        if ($id) {
            $checkout = $this->checkoutModel->getWithDetails($id);
            return $checkout ? [$checkout] : [];
        }

        return $this->getCheckoutList($search, $status);
    }

    private function buildExportFilename($prefix, $extension, $id = '') {
        $suffix = $id ? '-' . preg_replace('/[^A-Za-z0-9\-]/', '-', (string) $id) : '-report';
        return $prefix . $suffix . '-' . date('Ymd-His') . '.' . $extension;
    }
}
