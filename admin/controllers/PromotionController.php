<?php
/**
 * Promotion Controller
 * Manages Promotion/Discount CRUD operations
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/PromotionModel.php';
require_once __DIR__ . '/../models/TourModel.php';

class PromotionController extends Controller {
    private $promotionModel;
    private $tourModel;

    public function __construct() {
        $this->promotionModel = new PromotionModel();
        $this->tourModel = new TourModel();
    }

    /**
     * List all promotions
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $filter = $this->get('filter');
        
        if ($search) {
            $promotions = $this->promotionModel->search($search);
        } elseif ($filter === 'active') {
            $promotions = $this->promotionModel->getActivePromotions();
        } elseif ($filter === 'expired') {
            $promotions = $this->promotionModel->getExpiredPromotions();
        } elseif ($filter === 'upcoming') {
            $promotions = $this->promotionModel->getUpcomingPromotions();
        } else {
            $promotions = $this->promotionModel->getAllWithDetails();
        }
        
        // Add status to each promotion
        foreach ($promotions as &$promo) {
            $promo['status'] = $this->promotionModel->getStatus($promo);
        }
        
        $this->view('promotions/index', [
            'title' => 'Promotions Management',
            'promotions' => $promotions,
            'search' => $search,
            'currentFilter' => $filter,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form
     */
    public function create() {
        $this->requireAuth();
        
        $tours = $this->tourModel->findAll('title ASC');
        
        $this->view('promotions/create', [
            'title' => 'Create Promotion',
            'tours' => $tours,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new promotion
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=promotion&action=create');
        }

        $promotionId = strtoupper($this->sanitize($this->post('promotionID')));
        
        // Check if code exists
        if ($this->promotionModel->codeExists($promotionId)) {
            $this->setFlash('danger', 'Promotion code already exists.');
            $this->redirect('index.php?controller=promotion&action=create');
        }

        $data = [
            'promotionID' => $promotionId,
            'description' => $this->sanitize($this->post('description')),
            'discount' => floatval($this->post('discount')),
            'startDate' => $this->post('startDate'),
            'endDate' => $this->post('endDate'),
            'quantity' => $this->post('quantity') !== '' ? intval($this->post('quantity')) : null,
            'tourID' => $this->post('tourID') !== '' ? intval($this->post('tourID')) : null
        ];

        // Validation
        if (empty($data['promotionID'])) {
            $this->setFlash('danger', 'Promotion code is required.');
            $this->redirect('index.php?controller=promotion&action=create');
        }

        if ($data['discount'] <= 0) {
            $this->setFlash('danger', 'Discount must be greater than 0.');
            $this->redirect('index.php?controller=promotion&action=create');
        }

        try {
            $this->promotionModel->create($data);
            $this->setFlash('success', 'Promotion created successfully!');
            $this->redirect('index.php?controller=promotion');
        } catch (Exception $e) {
            $this->setFlash('danger', 'Failed to create promotion: ' . $e->getMessage());
            $this->redirect('index.php?controller=promotion&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $promotion = $this->promotionModel->findById($id);

        if (!$promotion) {
            $this->setFlash('danger', 'Promotion not found.');
            $this->redirect('index.php?controller=promotion');
        }

        $tours = $this->tourModel->findAll('title ASC');

        $this->view('promotions/edit', [
            'title' => 'Edit Promotion',
            'promotion' => $promotion,
            'tours' => $tours,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update promotion
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=promotion');
        }

        $id = $this->post('promotionID');
        $promotion = $this->promotionModel->findById($id);

        if (!$promotion) {
            $this->setFlash('danger', 'Promotion not found.');
            $this->redirect('index.php?controller=promotion');
        }

        $data = [
            'description' => $this->sanitize($this->post('description')),
            'discount' => floatval($this->post('discount')),
            'startDate' => $this->post('startDate'),
            'endDate' => $this->post('endDate'),
            'quantity' => $this->post('quantity') !== '' ? intval($this->post('quantity')) : null,
            'tourID' => $this->post('tourID') !== '' ? intval($this->post('tourID')) : null
        ];

        if ($this->promotionModel->update($id, $data)) {
            $this->setFlash('success', 'Promotion updated successfully!');
            $this->redirect('index.php?controller=promotion');
        } else {
            $this->setFlash('danger', 'Failed to update promotion.');
            $this->redirect('index.php?controller=promotion&action=edit&id=' . $id);
        }
    }

    /**
     * Delete promotion
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->promotionModel->delete($id)) {
            $this->setFlash('success', 'Promotion deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete promotion.');
        }
        
        $this->redirect('index.php?controller=promotion');
    }

    /**
     * View promotion details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $promotion = $this->promotionModel->findById($id);

        if (!$promotion) {
            $this->setFlash('danger', 'Promotion not found.');
            $this->redirect('index.php?controller=promotion');
        }

        // Get tour if linked
        $tour = null;
        if ($promotion['tourID']) {
            $tour = $this->tourModel->findById($promotion['tourID']);
        }

        $promotion['status'] = $this->promotionModel->getStatus($promotion);

        $this->view('promotions/view', [
            'title' => 'Promotion Details',
            'promotion' => $promotion,
            'tour' => $tour,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }
}
