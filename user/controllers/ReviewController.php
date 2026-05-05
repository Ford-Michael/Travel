<?php
/**
 * Review Controller
 * Allows users to submit reviews on tours.
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ReviewModel.php';
require_once __DIR__ . '/../models/TourModel.php';

class ReviewController extends Controller {
    private $reviewModel;
    private $tourModel;

    public function __construct() {
        $this->reviewModel = new ReviewModel();
        $this->tourModel = new TourModel();
    }

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

        $rating = (int) $this->post('rating');
        $comment = $this->sanitize($this->post('comment'));

        if ($rating < 1 || $rating > 5) {
            $this->setFlash('danger', 'Vui long chon so sao tu 1 den 5.');
            $this->redirect('index.php?controller=tour&action=detail&id=' . $tourId);
        }

        if ($comment === '') {
            $this->setFlash('danger', 'Vui long nhap noi dung binh luan.');
            $this->redirect('index.php?controller=tour&action=detail&id=' . $tourId);
        }

        $currentUser = $this->getCurrentUser();
        $existing = $this->reviewModel->findByUserAndTour($currentUser['id'], $tourId);

        if ($existing) {
            $this->reviewModel->updateReview((int) $existing['reviewID'], $rating, $comment);
            $this->setFlash('success', 'Danh gia cua ban da duoc cap nhat.');
        } else {
            $this->reviewModel->createReview($tourId, $currentUser['id'], $rating, $comment);
            $this->setFlash('success', 'Cam on ban da gui danh gia.');
        }

        $this->redirect('index.php?controller=tour&action=detail&id=' . $tourId);
    }
}
