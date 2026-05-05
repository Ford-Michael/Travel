<?php
/**
 * Image Controller
 * Manages tour images
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ImageModel.php';

class ImageController extends Controller {
    private $imageModel;

    public function __construct() {
        $this->imageModel = new ImageModel();
    }

    /**
     * Display all images
     */
    public function index() {
        $this->requireAuth();
        
        $page = $this->get('page', 1);
        $limit = 20;
        $images = $this->imageModel->getAllWithPagination($page, $limit);
        $totalImages = $this->imageModel->getCount();
        $totalPages = ceil($totalImages / $limit);
        
        $data = [
            'title' => 'Images - Travel Bling Admin',
            'admin' => $this->getCurrentAdmin(),
            'images' => $images,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalImages' => $totalImages,
            'flash' => $this->getFlash()
        ];

        $this->view('image/index', $data);
    }

    /**
     * Display add image form
     */
    public function add() {
        $this->requireAuth();
        
        // Get tours for dropdown
        require_once __DIR__ . '/../models/TourModel.php';
        $tourModel = new TourModel();
        $tours = $tourModel->findAll();
        
        $data = [
            'title' => 'Add Image - Travel Bling Admin',
            'admin' => $this->getCurrentAdmin(),
            'tours' => $tours,
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash()
        ];

        $this->view('image/add', $data);
    }

    /**
     * Process add image
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=image&action=add');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Invalid request. Please try again.');
            $this->redirect('index.php?controller=image&action=add');
        }

        $tourId = $this->post('tour_id');
        $description = $this->sanitize($this->post('description'));
        
        $errors = [];
        
        if (empty($tourId)) {
            $errors[] = 'Please select a tour.';
        }
        
        // Handle image upload
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                $errors[] = 'Invalid image type. Only JPG, PNG, GIF, WEBP are allowed.';
            } else {
                // Ensure upload directory exists
                $uploadDir = __DIR__ . '/../../img/tours/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $filename = 'tour_' . $tourId . '_' . time() . '.' . $extension;
                $targetFile = $uploadDir . $filename;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'img/tours/' . $filename;
                } else {
                    $errors[] = 'Failed to upload image.';
                }
            }
        } else {
            $errors[] = 'Please select an image to upload.';
        }

        if (!empty($errors)) {
            $this->setFlash('danger', implode('<br>', $errors));
            $this->redirect('index.php?controller=image&action=add');
            return;
        }

        // Save to database
        $imageData = [
            'tourID' => $tourId,
            'imageURL' => $imagePath,
            'description' => $description
        ];

        $result = $this->imageModel->create($imageData);

        if ($result) {
            $this->setFlash('success', 'Image added successfully.');
        } else {
            $this->setFlash('danger', 'Failed to add image.');
        }

        $this->redirect('index.php?controller=image');
    }

    /**
     * Delete image
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        if (!$id) {
            $this->setFlash('danger', 'Invalid image ID.');
            $this->redirect('index.php?controller=image');
            return;
        }

        // Get image info before deleting
        $image = $this->imageModel->getById($id);
        if ($image && !empty($image['imageURL'])) {
            // Delete physical file
            $filePath = __DIR__ . '/../../' . $image['imageURL'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $result = $this->imageModel->delete($id);

        if ($result) {
            $this->setFlash('success', 'Image deleted successfully.');
        } else {
            $this->setFlash('danger', 'Failed to delete image.');
        }

        $this->redirect('index.php?controller=image');
    }
}
