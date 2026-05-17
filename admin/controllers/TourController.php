<?php
/**
 * Tour Controller
 * Manages Tour CRUD operations
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/TourModel.php';

class TourController extends Controller {
    private $tourModel;

    public function __construct() {
        $this->tourModel = new TourModel();
    }

    /**
     * List all tours
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        
        if ($search) {
            $tours = $this->tourModel->search($search);
        } else {
            $tours = $this->tourModel->findAll('tourID DESC');
        }
        
        // Use the main image
        foreach ($tours as &$tour) {
            $tour['firstImage'] = $this->tourModel->getDisplayImageUrl($tour);
        }
        unset($tour);
        
        $this->view('tours/index', [
            'title' => 'Tours Management',
            'tours' => $tours,
            'search' => $search,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form
     */
    public function create() {
        $this->requireAuth();
        
        $this->view('tours/create', [
            'title' => 'Add New Tour',
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new tour
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour&action=create');
        }

        // Get number of days and format as duration string
        $numDays = intval($this->post('numDays', 1));
        $duration = $numDays . ' ngày ' . ($numDays > 1 ? ($numDays - 1) . ' đêm' : '');

        $data = [
            'title' => $this->sanitize($this->post('title')),
            'description' => $this->sanitize($this->post('description')),
            'quantity' => intval($this->post('quantity', 0)),
            'priceAdult' => floatval($this->post('priceAdult')),
            'priceChild' => floatval($this->post('priceChild')),
            'duration' => $duration,
            'departureDate' => $this->post('departureDate') ?: null,
            'destination' => $this->sanitize($this->post('destination')),
            'availability' => $this->post('availability') ? 1 : 0
        ];

        // Validation
        if (empty($data['title']) || empty($data['destination'])) {
            $this->setFlash('danger', 'Title and Destination are required.');
            $this->redirect('index.php?controller=tour&action=create');
        }

        if ($data['priceAdult'] <= 0) {
            $this->setFlash('danger', 'Adult price must be greater than 0.');
            $this->redirect('index.php?controller=tour&action=create');
        }

        $tourId = $this->tourModel->create($data);

        if ($tourId) {
            // Handle main image upload
            if (!empty($_FILES['mainImage']['name']) && $_FILES['mainImage']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->uploadTourImage($_FILES['mainImage'], $tourId);
                if ($uploadResult['success']) {
                    $this->tourModel->update($tourId, ['imageURL' => $uploadResult['url']]);
                }
            }

            // Handle multiple image uploads (secondary images up to 10)
            if (!empty($_FILES['tourImages']['name'][0])) {
                $files = $_FILES['tourImages'];
                $count = min(count($files['name']), 10);
                for ($i = 0; $i < $count; $i++) {
                    if ($files['error'][$i] === UPLOAD_ERR_OK) {
                        $singleFile = [
                            'name'     => $files['name'][$i],
                            'type'     => $files['type'][$i],
                            'tmp_name' => $files['tmp_name'][$i],
                            'error'    => $files['error'][$i],
                            'size'     => $files['size'][$i],
                        ];
                        $uploadResult = $this->uploadTourImage($singleFile, $tourId);
                        if ($uploadResult['success']) {
                            $this->tourModel->addImage($tourId, $uploadResult['url'], '');
                        }
                    }
                }
            }
            
            // Save itinerary data
            $itineraryData = $_POST['itinerary'] ?? [];
            if (!empty($itineraryData) && is_array($itineraryData)) {
                $sortOrder = 0;
                foreach ($itineraryData as $dayNumber => $dayData) {
                    $day = intval($dayNumber);
                    $title = $this->sanitize($dayData['title'] ?? '');
                    $description = $this->sanitize($dayData['description'] ?? '');

                    if ($title === '' && $description === '') {
                        continue;
                    }

                    $sortOrder++;
                    $this->tourModel->addItineraryItem([
                        'tourID' => $tourId,
                        'dayNumber' => $day,
                        'title' => $title !== '' ? $title : 'Ngay ' . $day,
                        'description' => $description,
                        'time' => null,
                        'location' => '',
                        'sortOrder' => $sortOrder
                    ]);
                }
            }
            
            $this->setFlash('success', 'Tour created successfully with itinerary!');
            $this->redirect('index.php?controller=tour');
        } else {
            $this->setFlash('danger', 'Failed to create tour.');
            $this->redirect('index.php?controller=tour&action=create');
        }
    }

    /**
     * Upload tour image to img/tours folder
     */
    private function uploadTourImage($file, $tourId) {
        $uploadDir = __DIR__ . '/../../img/tours/';
        
        // Create tours directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, GIF, WEBP allowed.'];
        }
        
        // Validate file size (max 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            return ['success' => false, 'message' => 'File too large. Maximum 5MB allowed.'];
        }
        
        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'tour_' . $tourId . '_' . time() . '_' . uniqid() . '.' . $extension;
        $filepath = $uploadDir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            // Return absolute URL for database storage
            return [
                'success' => true, 
                'url' => '/travel.bling/img/tours/' . $filename,
                'filename' => $filename
            ];
        }
        
        return ['success' => false, 'message' => 'Failed to upload file.'];
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $tour = $this->tourModel->findById($id);

        if (!$tour) {
            $this->setFlash('danger', 'Tour not found.');
            $this->redirect('index.php?controller=tour');
        }
        $tour['displayImageURL'] = $this->tourModel->getDisplayImageUrl($tour);

        $this->view('tours/edit', [
            'title' => 'Edit Tour',
            'tour' => $tour,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update tour
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        $id = $this->post('tourID');
        $tour = $this->tourModel->findById($id);

        if (!$tour) {
            $this->setFlash('danger', 'Tour not found.');
            $this->redirect('index.php?controller=tour');
        }

        $data = [
            'title' => $this->sanitize($this->post('title')),
            'description' => $this->sanitize($this->post('description')),
            'quantity' => intval($this->post('quantity', 0)),
            'priceAdult' => floatval($this->post('priceAdult')),
            'priceChild' => floatval($this->post('priceChild')),
            'duration' => $this->sanitize($this->post('duration')),
            'departureDate' => $this->post('departureDate') ?: null,
            'destination' => $this->sanitize($this->post('destination')),
            'availability' => $this->post('availability') ? 1 : 0
        ];

        // Validation
        if (empty($data['title']) || empty($data['destination'])) {
            $this->setFlash('danger', 'Title and Destination are required.');
            $this->redirect('index.php?controller=tour&action=edit&id=' . $id);
        }

        // Handle main image upload for update
        if (!empty($_FILES['mainImage']['name']) && $_FILES['mainImage']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->uploadTourImage($_FILES['mainImage'], $id);
            if ($uploadResult['success']) {
                $data['imageURL'] = $uploadResult['url'];
            }
        }

        if ($this->tourModel->update($id, $data)) {
            $this->setFlash('success', 'Tour updated successfully!');
            $this->redirect('index.php?controller=tour');
        } else {
            $this->setFlash('danger', 'Failed to update tour.');
            $this->redirect('index.php?controller=tour&action=edit&id=' . $id);
        }
    }

    /**
     * Delete tour
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->tourModel->delete($id)) {
            $this->setFlash('success', 'Tour deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete tour.');
        }
        
        $this->redirect('index.php?controller=tour');
    }

    /**
     * Toggle tour availability
     */
    public function toggleAvailability() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->tourModel->toggleAvailability($id)) {
            $this->setFlash('success', 'Tour availability updated!');
        } else {
            $this->setFlash('danger', 'Failed to update availability.');
        }
        
        $this->redirect('index.php?controller=tour');
    }

    /**
     * View tour details
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $tour = $this->tourModel->getWithStats($id);

        if (!$tour) {
            $this->setFlash('danger', 'Tour not found.');
            $this->redirect('index.php?controller=tour');
        }

        $this->view('tours/view', [
            'title' => 'Tour Details',
            'tour' => $tour,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Add image to tour (supports both file upload and URL)
     */
    public function addImage() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        $tourId = $this->post('tourID');
        $description = $this->sanitize($this->post('description'));
        $imageUrl = $this->post('imageUrl');
        if ($imageUrl === null || $imageUrl === '') {
            $imageUrl = $this->post('imageURL');
        }
        $imageUrl = $imageUrl ? $this->sanitize($imageUrl) : '';

        // Check if files were uploaded (multiple)
        if (!empty($_FILES['tourImagesFile']['name'][0])) {
            $files = $_FILES['tourImagesFile'];
            $count = min(count($files['name']), 10);
            $uploaded = 0;
            for ($i = 0; $i < $count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $singleFile = [
                        'name'     => $files['name'][$i],
                        'type'     => $files['type'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error'    => $files['error'][$i],
                        'size'     => $files['size'][$i],
                    ];
                    $uploadResult = $this->uploadTourImage($singleFile, $tourId);
                    if ($uploadResult['success']) {
                        $this->tourModel->addImage($tourId, $uploadResult['url'], $description);
                        $uploaded++;
                    }
                }
            }
            if ($uploaded > 0) {
                $this->setFlash('success', $uploaded . ' image(s) added successfully!');
            } else {
                $this->setFlash('danger', 'Failed to upload images.');
            }
        } elseif (!empty($imageUrl)) {
            $this->tourModel->addImage($tourId, $imageUrl, $description);
            $this->setFlash('success', 'Image added successfully from URL!');
        } else {
            $this->setFlash('danger', 'Please select image files or provide an image URL.');
        }

        $this->redirect('index.php?controller=tour&action=show&id=' . $tourId);
    }

    /**
     * Remove image from tour
     */
    public function removeImage() {
        $this->requireAuth();
        
        $imageId = $this->get('imageId');
        $tourId = $this->get('tourId');

        if ($this->tourModel->removeImage($imageId)) {
            $this->setFlash('success', 'Image removed successfully!');
        } else {
            $this->setFlash('danger', 'Failed to remove image.');
        }

        $this->redirect('index.php?controller=tour&action=show&id=' . $tourId);
    }

    /**
     * Update tour quantity
     */
    public function updateQuantity() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        $tourId = $this->post('tourID');
        $quantity = intval($this->post('quantity'));

        if ($quantity < 0) {
            $this->setFlash('danger', 'Quantity cannot be negative.');
            $this->redirect('index.php?controller=tour&action=show&id=' . $tourId);
        }

        if ($this->tourModel->updateQuantity($tourId, $quantity)) {
            $this->setFlash('success', 'Quantity updated successfully!');
        } else {
            $this->setFlash('danger', 'Failed to update quantity.');
        }

        $this->redirect('index.php?controller=tour&action=show&id=' . $tourId);
    }

    // ============================================
    // ITINERARY (Lịch trình) METHODS
    // ============================================

    /**
     * Show itinerary management page for a tour
     */
    public function itinerary() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $tour = $this->tourModel->getWithItinerary($id);

        if (!$tour) {
            $this->setFlash('danger', 'Tour not found.');
            $this->redirect('index.php?controller=tour');
        }

        // Group itinerary by day
        $itineraryByDay = [];
        foreach ($tour['itinerary'] as $item) {
            $day = $item['dayNumber'];
            if (!isset($itineraryByDay[$day])) {
                $itineraryByDay[$day] = [];
            }
            $itineraryByDay[$day][] = $item;
        }

        $this->view('tours/itinerary', [
            'title' => 'Lịch trình - ' . $tour['title'],
            'tour' => $tour,
            'itineraryByDay' => $itineraryByDay,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Add itinerary item
     */
    public function addItinerary() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        $tourId = $this->post('tourID');
        
        $data = [
            'dayNumber' => intval($this->post('dayNumber')),
            'title' => $this->sanitize($this->post('title')),
            'description' => $this->sanitize($this->post('description')),
            'time' => $this->post('time') ?: null,
            'location' => $this->sanitize($this->post('location')),
            'imageURL' => null
        ];

        // Process image upload
        if (!empty($_FILES['itineraryImage']['name']) && $_FILES['itineraryImage']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->uploadTourImage($_FILES['itineraryImage'], $tourId);
            if ($uploadResult['success']) {
                $data['imageURL'] = $uploadResult['url'];
            }
        }

        // Validation
        if ($data['dayNumber'] < 1 || ($data['title'] === '' && $data['description'] === '')) {
            $this->setFlash('danger', 'So ngay va noi dung lich trinh la bat buoc.');
            $this->redirect('index.php?controller=tour&action=itinerary&id=' . $tourId);
        }

        if ($data['title'] === '') {
            $data['title'] = 'Ngay ' . $data['dayNumber'];
        }

        if ($this->tourModel->addItinerary($tourId, $data)) {
            $this->setFlash('success', 'Đã thêm lịch trình thành công!');
        } else {
            $this->setFlash('danger', 'Không thể thêm lịch trình.');
        }

        $this->redirect('index.php?controller=tour&action=itinerary&id=' . $tourId);
    }

    /**
     * Edit itinerary item (AJAX)
     */
    public function editItinerary() {
        $this->requireAuth();
        
        $itineraryId = $this->get('id');
        $item = $this->tourModel->getItineraryItem($itineraryId);
        
        if (!$item) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Item not found']);
            exit;
        }
        
        header('Content-Type: application/json');
        echo json_encode($item);
        exit;
    }

    /**
     * Update itinerary item
     */
    public function updateItineraryItem() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        $itineraryId = $this->post('itineraryID');
        $tourId = $this->post('tourID');
        
        $data = [
            'dayNumber' => intval($this->post('dayNumber')),
            'title' => $this->sanitize($this->post('title')),
            'description' => $this->sanitize($this->post('description')),
            'time' => $this->post('time') ?: null,
            'location' => $this->sanitize($this->post('location'))
        ];

        // Process image upload
        if (!empty($_FILES['itineraryImage']['name']) && $_FILES['itineraryImage']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->uploadTourImage($_FILES['itineraryImage'], $tourId);
            if ($uploadResult['success']) {
                $data['imageURL'] = $uploadResult['url'];
            }
        }

        // Validation
        if ($data['dayNumber'] < 1 || ($data['title'] === '' && $data['description'] === '')) {
            $this->setFlash('danger', 'So ngay va noi dung lich trinh la bat buoc.');
            $this->redirect('index.php?controller=tour&action=itinerary&id=' . $tourId);
        }

        if ($data['title'] === '') {
            $data['title'] = 'Ngay ' . $data['dayNumber'];
        }

        if ($this->tourModel->updateItinerary($itineraryId, $data)) {
            $this->setFlash('success', 'Đã cập nhật lịch trình!');
        } else {
            $this->setFlash('danger', 'Không thể cập nhật lịch trình.');
        }

        $this->redirect('index.php?controller=tour&action=itinerary&id=' . $tourId);
    }

    /**
     * Delete itinerary item
     */
    public function deleteItinerary() {
        $this->requireAuth();
        
        $itineraryId = $this->get('id');
        $tourId = $this->get('tourId');

        if ($this->tourModel->deleteItinerary($itineraryId)) {
            $this->setFlash('success', 'Đã xóa lịch trình!');
        } else {
            $this->setFlash('danger', 'Không thể xóa lịch trình.');
        }

        $this->redirect('index.php?controller=tour&action=itinerary&id=' . $tourId);
    }

    /**
     * Show merge tour form
     */
    public function merge() {
        $this->requireAuth();
        
        $tours = $this->tourModel->findAll('tourID DESC');
        
        $this->view('tours/merge', [
            'title' => 'Gộp Tour',
            'tours' => $tours,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Process tour merging
     */
    public function processMerge() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour&action=merge');
        }

        $primaryId = $this->post('primaryTourID');
        $secondaryId = $this->post('secondaryTourID');

        if (!$primaryId || !$secondaryId) {
            $this->setFlash('danger', 'Vui lòng chọn cả hai tour.');
            $this->redirect('index.php?controller=tour&action=merge');
        }

        if ($primaryId === $secondaryId) {
            $this->setFlash('danger', 'Không thể gộp một tour vào chính nó.');
            $this->redirect('index.php?controller=tour&action=merge');
        }

        if ($this->tourModel->mergeTours($primaryId, $secondaryId)) {
            $this->setFlash('success', 'Gộp tour thành công! Tour cũ đã được tắt trạng thái hoạt động.');
            $this->redirect('index.php?controller=tour&action=show&id=' . $primaryId);
        } else {
            $this->setFlash('danger', 'Có lỗi xảy ra trong quá trình gộp.');
            $this->redirect('index.php?controller=tour&action=merge');
        }
    }
}

