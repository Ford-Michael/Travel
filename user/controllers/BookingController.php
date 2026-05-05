<?php
/**
 * Booking Controller
 * Handles user-facing booking creation.
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/TourModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class BookingController extends Controller {
    private $bookingModel;
    private $tourModel;
    private $userModel;

    public function __construct() {
        $this->bookingModel = new BookingModel();
        $this->tourModel = new TourModel();
        $this->userModel = new UserModel();
    }

    /**
     * Show booking page for a selected tour.
     */
    public function index() {
        $this->requireAuth();

        $tourId = (int) $this->get('tour_id', $this->get('id', 0));
        if ($tourId <= 0) {
            $this->setFlash('danger', 'Vui long chon tour truoc khi dat.');
            $this->redirect('index.php?controller=tour');
        }

        $tour = $this->tourModel->getTourDetail($tourId);
        if (!$tour) {
            $this->setFlash('danger', 'Tour khong ton tai.');
            $this->redirect('index.php?controller=tour');
        }

        $currentUser = $this->getCurrentUser();
        $account = $this->userModel->findById($currentUser['id']);

        if (!$account) {
            $this->setFlash('danger', 'Khong tim thay thong tin tai khoan.');
            $this->redirect('index.php?controller=account');
        }

        $this->view('booking/index', [
            'title' => 'Dat tour | Travel Bling',
            'tour' => $tour,
            'account' => $account,
            'user' => $currentUser,
            'flash' => $this->getFlash(),
            'csrf_token' => $this->generateCsrfToken(),
        ]);
    }

    /**
     * Store booking from booking page.
     */
    public function store() {
        $this->requireAuth();

        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Yeu cau khong hop le. Vui long thu lai.');
            $this->redirect('index.php?controller=tour');
        }

        $tourId = (int) $this->post('tourID');
        $tour = $this->tourModel->getTourDetail($tourId);
        if (!$tour) {
            $this->setFlash('danger', 'Tour khong ton tai.');
            $this->redirect('index.php?controller=tour');
        }

        $numAdults = max(1, (int) $this->post('numAdults', 1));
        $numChildren = max(0, (int) $this->post('numChildren', 0));
        $requestedGuests = $numAdults + $numChildren;
        $availableSlots = (int) ($tour['quantity'] ?? 0);

        if ($requestedGuests <= 0) {
            $this->setFlash('danger', 'So luong khach khong hop le.');
            $this->redirect('index.php?controller=booking&tour_id=' . $tourId);
        }

        if ($availableSlots > 0 && $requestedGuests > $availableSlots) {
            $this->setFlash('danger', 'So luong dat vuot qua so cho con lai cua tour.');
            $this->redirect('index.php?controller=booking&tour_id=' . $tourId);
        }

        $totalPrice = ((float) ($tour['priceAdult'] ?? 0) * $numAdults)
            + ((float) ($tour['priceChild'] ?? 0) * $numChildren);

        $currentUser = $this->getCurrentUser();
        $specialRequests = $this->sanitize($this->post('specialRequests', ''));

        $bookingId = $this->bookingModel->create([
            'tourID' => $tourId,
            'usersID' => $currentUser['id'],
            'bookingDate' => date('Y-m-d H:i:s'),
            'numAdults' => $numAdults,
            'numChildren' => $numChildren,
            'totalPrice' => $totalPrice,
            'paymentStatus' => 'Unpaid',
            'bookingStatus' => 'Pending',
            'specialRequests' => $specialRequests,
        ]);

        if (!$bookingId) {
            $this->setFlash('danger', 'Khong the tao booking. Vui long thu lai.');
            $this->redirect('index.php?controller=booking&tour_id=' . $tourId);
        }

        $this->setFlash('success', 'Dat tour thanh cong. Booking cua ban da duoc tao.');
        $this->redirect('index.php?controller=account');
    }
}
