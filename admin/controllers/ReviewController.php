<?php
/**
 * Review Controller
 * Manages Review moderation
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ReviewModel.php';

class ReviewController extends Controller {
    private $reviewModel;

    public function __construct() {
        $this->reviewModel = new ReviewModel();
    }

    /**
     * List all reviews
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $rating = $this->get('rating');
        $reviews = $this->getReviewList($search, $rating);
        
        $statistics = $this->reviewModel->getStatistics();
        
        $this->view('reviews/index', [
            'title' => 'Reviews Management',
            'reviews' => $reviews,
            'search' => $search,
            'currentRating' => $rating,
            'statistics' => $statistics,
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
        
        $this->view('reviews/create', [
            'title' => 'Create Review',
            'tours' => $tourModel->findAll('title ASC'),
            'users' => $userModel->findAll('usersname ASC'),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new review
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=review&action=create');
        }

        $data = [
            'tourID' => intval($this->post('tourID')),
            'usersID' => intval($this->post('usersID')),
            'rating' => intval($this->post('rating')),
            'comment' => $this->sanitize($this->post('comment', $this->post('review'))),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Validation
        if (!$data['tourID'] || !$data['usersID']) {
            $this->setFlash('danger', 'Tour and User are required.');
            $this->redirect('index.php?controller=review&action=create');
        }

        if ($data['rating'] < 1 || $data['rating'] > 5) {
            $this->setFlash('danger', 'Rating must be between 1 and 5.');
            $this->redirect('index.php?controller=review&action=create');
        }

        $reviewId = $this->reviewModel->create($data);

        if ($reviewId) {
            $this->setFlash('success', 'Review created successfully!');
            $this->redirect('index.php?controller=review');
        } else {
            $this->setFlash('danger', 'Failed to create review.');
            $this->redirect('index.php?controller=review&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $review = $this->reviewModel->getWithDetails($id);

        if (!$review) {
            $this->setFlash('danger', 'Review not found.');
            $this->redirect('index.php?controller=review');
        }

        require_once __DIR__ . '/../models/TourModel.php';
        require_once __DIR__ . '/../models/UserModel.php';
        
        $tourModel = new TourModel();
        $userModel = new UserModel();

        $this->view('reviews/edit', [
            'title' => 'Edit Review',
            'review' => $review,
            'tours' => $tourModel->findAll('title ASC'),
            'users' => $userModel->findAll('usersname ASC'),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update review
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=review');
        }

        $id = $this->post('reviewID');
        $review = $this->reviewModel->findById($id);

        if (!$review) {
            $this->setFlash('danger', 'Review not found.');
            $this->redirect('index.php?controller=review');
        }

        $data = [
            'rating' => intval($this->post('rating')),
            'comment' => $this->sanitize($this->post('comment', $this->post('review'))),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Validation
        if ($data['rating'] < 1 || $data['rating'] > 5) {
            $this->setFlash('danger', 'Rating must be between 1 and 5.');
            $this->redirect('index.php?controller=review&action=edit&id=' . $id);
        }

        if ($this->reviewModel->update($id, $data)) {
            $this->setFlash('success', 'Review updated successfully!');
            $this->redirect('index.php?controller=review');
        } else {
            $this->setFlash('danger', 'Failed to update review.');
            $this->redirect('index.php?controller=review&action=edit&id=' . $id);
        }
    }

    /**
     * View review details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $review = $this->reviewModel->getWithDetails($id);

        if (!$review) {
            $this->setFlash('danger', 'Review not found.');
            $this->redirect('index.php?controller=review');
        }

        $this->view('reviews/view', [
            'title' => 'Review Details',
            'review' => $review,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Delete review (moderation)
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->reviewModel->delete($id)) {
            $this->setFlash('success', 'Review deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete review.');
        }
        
        $this->redirect('index.php?controller=review');
    }

    public function exportExcel() {
        $this->requireAuth();

        $search = $this->get('search');
        $rating = $this->get('rating');
        $id = $this->get('id');
        $reviews = $this->getReviewExportData($search, $rating, $id);

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $this->buildExportFilename('review', 'xls', $id) . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";

        require __DIR__ . '/../views/reviews/export_excel.php';
        exit;
    }

    public function exportPdf() {
        $this->requireAuth();

        $search = $this->get('search');
        $rating = $this->get('rating');
        $id = $this->get('id');
        $reviews = $this->getReviewExportData($search, $rating, $id);
        $review = $id ? $this->reviewModel->getWithDetails($id) : null;

        if ($id && !$review) {
            $this->setFlash('danger', 'Review not found.');
            $this->redirect('index.php?controller=review');
        }

        require __DIR__ . '/../views/reviews/export_pdf.php';
        exit;
    }

    private function getReviewList($search = '', $rating = '') {
        if ($search) {
            return $this->reviewModel->search($search);
        }

        if ($rating) {
            return $this->reviewModel->getByRating($rating);
        }

        return $this->reviewModel->getAllWithDetails();
    }

    private function getReviewExportData($search = '', $rating = '', $id = '') {
        if ($id) {
            $review = $this->reviewModel->getWithDetails($id);
            return $review ? [$review] : [];
        }

        return $this->getReviewList($search, $rating);
    }

    private function buildExportFilename($prefix, $extension, $id = '') {
        $suffix = $id ? '-' . preg_replace('/[^A-Za-z0-9\-]/', '-', (string) $id) : '-report';
        return $prefix . $suffix . '-' . date('Ymd-His') . '.' . $extension;
    }
}
