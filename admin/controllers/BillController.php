<?php
/**
 * Bill Controller
 * Manages Bill/Invoice operations
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/BillModel.php';
require_once __DIR__ . '/../models/BookingModel.php';

class BillController extends Controller {
    private $billModel;
    private $bookingModel;

    public function __construct() {
        $this->billModel = new BillModel();
        $this->bookingModel = new BookingModel();
    }

    /**
     * List all bills
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $bills = $this->getBillsForListing($search);
        
        $this->view('bills/index', [
            'title' => 'Bills Management',
            'bills' => $bills,
            'search' => $search,
            'totalBilled' => $this->billModel->getTotalBilled(),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * View bill details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $bill = $this->billModel->getWithDetails($id);

        if (!$bill) {
            $this->setFlash('danger', 'Bill not found.');
            $this->redirect('index.php?controller=bill');
        }

        $this->view('bills/view', [
            'title' => 'Bill Details - ' . $id,
            'bill' => $bill,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form (select booking)
     */
    public function create() {
        $this->requireAuth();
        
        // Get bookings without bills
        $bookings = $this->bookingModel->getAllWithDetails();
        
        $this->view('bills/create', [
            'title' => 'Create Bill',
            'bookings' => $bookings,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new bill
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=bill&action=create');
        }

        $bookingId = intval($this->post('bookingID'));
        $details = $this->sanitize($this->post('details'));

        if (!$bookingId) {
            $this->setFlash('danger', 'Please select a booking.');
            $this->redirect('index.php?controller=bill&action=create');
        }

        // Check if booking exists
        $booking = $this->bookingModel->findById($bookingId);
        if (!$booking) {
            $this->setFlash('danger', 'Booking not found.');
            $this->redirect('index.php?controller=bill&action=create');
        }

        $billId = $this->billModel->createForBooking($bookingId, $details);

        if ($billId) {
            $this->setFlash('success', 'Bill created successfully!');
            $this->redirect('index.php?controller=bill');
        } else {
            $this->setFlash('danger', 'Failed to create bill.');
            $this->redirect('index.php?controller=bill&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $bill = $this->billModel->getWithDetails($id);

        if (!$bill) {
            $this->setFlash('danger', 'Bill not found.');
            $this->redirect('index.php?controller=bill');
        }

        $bookings = $this->bookingModel->getAllWithDetails();

        $this->view('bills/edit', [
            'title' => 'Edit Bill',
            'bill' => $bill,
            'bookings' => $bookings,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update bill
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=bill');
        }

        $id = $this->post('billID');
        $bill = $this->billModel->findById($id);

        if (!$bill) {
            $this->setFlash('danger', 'Bill not found.');
            $this->redirect('index.php?controller=bill');
        }

        $data = [
            'details' => $this->sanitize($this->post('details')),
            'amount' => floatval($this->post('totalAmount'))
        ];

        if ($this->billModel->update($id, $data)) {
            $this->setFlash('success', 'Bill updated successfully!');
            $this->redirect('index.php?controller=bill');
        } else {
            $this->setFlash('danger', 'Failed to update bill.');
            $this->redirect('index.php?controller=bill&action=edit&id=' . $id);
        }
    }

    /**
     * Delete bill
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->billModel->delete($id)) {
            $this->setFlash('success', 'Bill deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete bill.');
        }
        
        $this->redirect('index.php?controller=bill');
    }

    /**
     * Print bill (printable view)
     */
    public function printBill() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $bill = $this->billModel->getWithDetails($id);

        if (!$bill) {
            $this->setFlash('danger', 'Bill not found.');
            $this->redirect('index.php?controller=bill');
        }

        $this->view('bills/print', [
            'title' => 'Print Bill - ' . $id,
            'bill' => $bill
        ]);
    }

    /**
     * Export bills to Excel-compatible file.
     */
    public function exportExcel() {
        $this->requireAuth();

        $search = $this->get('search');
        $id = $this->get('id');
        $bills = $this->getBillsForExport($search, $id);

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $this->buildExportFilename('xls', $id) . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";

        $exportTitle = $id ? 'Bill Export - ' . $id : 'Bills Export';
        require __DIR__ . '/../views/bills/export_excel.php';
        exit;
    }

    /**
     * Export bill(s) to a print-ready PDF page.
     * Without a PDF library, the browser Save as PDF flow is used.
     */
    public function exportPdf() {
        $this->requireAuth();

        $search = $this->get('search');
        $id = $this->get('id');
        $bills = $this->getBillsForExport($search, $id);
        $bill = $id ? $this->billModel->getWithDetails($id) : null;

        if ($id && !$bill) {
            $this->setFlash('danger', 'Bill not found.');
            $this->redirect('index.php?controller=bill');
        }

        $exportTitle = $bill ? 'Bill ' . $bill['billID'] : 'Bills Report';
        require __DIR__ . '/../views/bills/export_pdf.php';
        exit;
    }

    private function getBillsForListing($search = '') {
        if ($search) {
            return $this->billModel->search($search);
        }

        return $this->billModel->getAllWithDetails();
    }

    private function getBillsForExport($search = '', $id = '') {
        if ($id) {
            $bill = $this->billModel->getWithDetails($id);
            return $bill ? [$bill] : [];
        }

        return $this->getBillsForListing($search);
    }

    private function buildExportFilename($extension, $id = '') {
        $prefix = $id ? 'bill-' . preg_replace('/[^A-Za-z0-9\-]/', '-', $id) : 'bills-report';
        return $prefix . '-' . date('Ymd-His') . '.' . $extension;
    }
}
