<?php
/**
 * Tour Model
 * Manages Tour CRUD operations
 */

require_once __DIR__ . '/Model.php';

class TourModel extends Model {
    protected $table = 'Tour';
    protected $primaryKey = 'tourID';

    /**
     * Search tours by title or destination
     */
    public function search($keyword) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE title LIKE :keyword1 
                OR destination LIKE :keyword2 
                OR description LIKE :keyword3";
        $searchTerm = "%{$keyword}%";
        $stmt = $this->query($sql, [
            'keyword1' => $searchTerm,
            'keyword2' => $searchTerm,
            'keyword3' => $searchTerm
        ]);
        return $stmt->fetchAll();
    }

    /**
     * Get all available tours
     */
    public function getAvailableTours() {
        return $this->findAllBy('availability', 1);
    }

    /**
     * Get all unavailable tours
     */
    public function getUnavailableTours() {
        return $this->findAllBy('availability', 0);
    }

    /**
     * Toggle tour availability
     */
    public function toggleAvailability($id) {
        $tour = $this->findById($id);
        
        if (!$tour) {
            return false;
        }

        $newStatus = $tour['availability'] ? 0 : 1;
        
        return $this->update($id, [
            'availability' => $newStatus
        ]);
    }

    /**
     * Get tour with images
     */
    public function getWithImages($tourId) {
        $tour = $this->findById($tourId);
        
        if (!$tour) {
            return null;
        }

        $this->syncGalleryImagesFromFilesystem($tour);

        $sql = "SELECT * FROM Images WHERE tourID = :tourId";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        $tour['images'] = $stmt->fetchAll();
        $tour['displayImageURL'] = $this->getDisplayImageUrl($tour);

        if (empty($tour['imageURL']) && !empty($tour['displayImageURL'])) {
            $this->backfillMainImageUrl($tourId, $tour['displayImageURL']);
            $tour['imageURL'] = $tour['displayImageURL'];
        }
        
        return $tour;
    }

    /**
     * Resolve a display image for admin listings.
     * Prefer the main image, then fall back to the first gallery image.
     */
    public function getDisplayImageUrl(array $tour) {
        if (!empty($tour['imageURL'])) {
            return $this->resolveImageUrl($tour['imageURL']);
        }

        $tourId = (int) ($tour['tourID'] ?? 0);
        if ($tourId <= 0) {
            return null;
        }

        $stmt = $this->query(
            "SELECT imageURL FROM Images WHERE tourID = :tourId ORDER BY imageID ASC LIMIT 1",
            ['tourId' => $tourId]
        );
        $imageUrl = $stmt->fetchColumn();

        return $imageUrl ? $this->resolveImageUrl($imageUrl) : null;
    }

    private function resolveImageUrl($imageUrl) {
        $imageUrl = trim((string) $imageUrl);
        if ($imageUrl === '') {
            return '';
        }

        if (preg_match('#^https?://#i', $imageUrl)) {
            return $imageUrl;
        }

        if (strpos($imageUrl, '/travel.bling/') === 0) {
            return $imageUrl;
        }

        if (strpos($imageUrl, 'travel.bling/') === 0) {
            return '/' . ltrim($imageUrl, '/');
        }

        if (strpos($imageUrl, '/img/') === 0) {
            return '/travel.bling' . $imageUrl;
        }

        if (strpos($imageUrl, 'img/') === 0) {
            return '/travel.bling/' . ltrim($imageUrl, '/');
        }

        return $imageUrl;
    }

    /**
     * Persist the first usable image as the main image when the Tour record is missing one.
     */
    public function backfillMainImageUrl($tourId, $imageUrl) {
        if (empty($tourId) || empty($imageUrl)) {
            return false;
        }

        $stmt = $this->query(
            "UPDATE {$this->table}
             SET imageURL = :imageUrl
             WHERE tourID = :tourId AND (imageURL IS NULL OR imageURL = '')",
            [
                'tourId' => $tourId,
                'imageUrl' => $imageUrl
            ]
        );

        return $stmt->rowCount() > 0;
    }

    /**
     * Get tours with pagination
     */
    public function getPaginated($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM {$this->table} ORDER BY tourID DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Count tours by availability
     */
    public function countByAvailability($available = true) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE availability = :status";
        $stmt = $this->query($sql, ['status' => $available ? 1 : 0]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Get tour with images, booking count, and review count
     */
    public function getWithStats($tourId) {
        $tour = $this->getWithImages($tourId);
        
        if (!$tour) {
            return null;
        }

        // Count bookings for this tour
        $sql = "SELECT COUNT(*) as count FROM Booking WHERE tourID = :tourId";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        $result = $stmt->fetch();
        $tour['bookingCount'] = $result['count'] ?? 0;

        // Count reviews for this tour
        $sql = "SELECT COUNT(*) as count, AVG(rating) as avgRating FROM Review WHERE tourID = :tourId";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        $result = $stmt->fetch();
        $tour['reviewCount'] = $result['count'] ?? 0;
        $tour['avgRating'] = round($result['avgRating'] ?? 0, 1);

        return $tour;
    }

    /**
     * Get tours by destination
     */
    public function getByDestination($destination) {
        $sql = "SELECT * FROM {$this->table} WHERE destination LIKE :dest ORDER BY tourID DESC";
        $stmt = $this->query($sql, ['dest' => "%{$destination}%"]);
        return $stmt->fetchAll();
    }

    /**
     * Get tours by price range
     */
    public function getByPriceRange($minPrice, $maxPrice) {
        $sql = "SELECT * FROM {$this->table} WHERE priceAdult BETWEEN :min AND :max ORDER BY priceAdult ASC";
        $stmt = $this->query($sql, ['min' => $minPrice, 'max' => $maxPrice]);
        return $stmt->fetchAll();
    }

    /**
     * Update tour quantity
     */
    public function updateQuantity($tourId, $quantity) {
        return $this->update($tourId, ['quantity' => $quantity]);
    }

    /**
     * Decrease tour quantity (for booking)
     */
    public function decreaseQuantity($tourId, $amount = 1) {
        $tour = $this->findById($tourId);
        if (!$tour || $tour['quantity'] < $amount) {
            return false;
        }
        return $this->update($tourId, ['quantity' => $tour['quantity'] - $amount]);
    }

    /**
     * Add image to tour
     */
    public function addImage($tourId, $imageUrl, $description = '') {
        $sql = "INSERT INTO Images (tourID, imageURL, description) VALUES (:tourId, :url, :desc)";
        $this->query($sql, [
            'tourId' => $tourId,
            'url' => $imageUrl,
            'desc' => $description
        ]);
        return $this->db->lastInsertId();
    }

    /**
     * Remove image from tour
     */
    public function removeImage($imageId) {
        $sql = "DELETE FROM Images WHERE imageID = :id";
        $this->query($sql, ['id' => $imageId]);
        return true;
    }

    /**
     * Recover gallery images that exist on disk but are missing from the Images table.
     */
    private function syncGalleryImagesFromFilesystem(array $tour) {
        $tourId = (int) ($tour['tourID'] ?? 0);
        if ($tourId <= 0) {
            return;
        }

        $uploadDir = dirname(__DIR__, 2) . '/img/tours/';
        if (!is_dir($uploadDir)) {
            return;
        }

        $files = glob($uploadDir . 'tour_' . $tourId . '_*');
        if (empty($files)) {
            return;
        }

        sort($files, SORT_NATURAL);

        $existingStmt = $this->query("SELECT imageURL FROM Images WHERE tourID = :tourId", ['tourId' => $tourId]);
        $existingUrls = $existingStmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
        $existingLookup = array_fill_keys($existingUrls, true);

        $reservedUrls = [];
        if (!empty($tour['imageURL'])) {
            $reservedUrls[$tour['imageURL']] = true;
        }

        try {
            $itineraryStmt = $this->query(
                "SELECT imageURL FROM TourItinerary WHERE tourID = :tourId AND imageURL IS NOT NULL AND imageURL <> ''",
                ['tourId' => $tourId]
            );
            foreach ($itineraryStmt->fetchAll(PDO::FETCH_COLUMN) ?: [] as $imageUrl) {
                $reservedUrls[$imageUrl] = true;
            }
        } catch (\PDOException $e) {
            // Older schemas may not have TourItinerary images.
        }

        foreach ($files as $file) {
            $url = '/travel.bling/img/tours/' . basename($file);

            if (isset($existingLookup[$url]) || isset($reservedUrls[$url])) {
                continue;
            }

            $this->addImage($tourId, $url, '');
            $existingLookup[$url] = true;
        }
    }

    // ============================================
    // ITINERARY (Lịch trình) METHODS
    // ============================================

    /**
     * Get all itinerary items for a tour
     */
    public function getItinerary($tourId) {
        try {
            $sql = "SELECT * FROM TourItinerary WHERE tourID = :tourId ORDER BY dayNumber ASC, sortOrder ASC";
            $stmt = $this->query($sql, ['tourId' => $tourId]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            return [];
        }
    }

    /**
     * Add itinerary item
     */
    public function addItinerary($tourId, $data) {
        try {
            // Get max sort order for this day
            $sql = "SELECT MAX(sortOrder) as maxOrder FROM TourItinerary WHERE tourID = :tourId AND dayNumber = :day";
            $stmt = $this->query($sql, ['tourId' => $tourId, 'day' => $data['dayNumber']]);
            $result = $stmt->fetch();
            $sortOrder = ($result['maxOrder'] ?? 0) + 1;

            $sql = "INSERT INTO TourItinerary (tourID, dayNumber, title, description, time, location, sortOrder) 
                    VALUES (:tourId, :dayNumber, :title, :description, :time, :location, :sortOrder)";
            $this->query($sql, [
                'tourId' => $tourId,
                'dayNumber' => $data['dayNumber'],
                'title' => $data['title'],
                'description' => $data['description'] ?? '',
                'time' => $data['time'] ?? null,
                'location' => $data['location'] ?? '',
                'sortOrder' => $sortOrder
            ]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Update itinerary item
     */
    public function updateItinerary($itineraryId, $data) {
        try {
            $sql = "UPDATE TourItinerary SET 
                    dayNumber = :dayNumber,
                    title = :title,
                    description = :description,
                    time = :time,
                    location = :location
                    WHERE itineraryID = :id";
            $this->query($sql, [
                'id' => $itineraryId,
                'dayNumber' => $data['dayNumber'],
                'title' => $data['title'],
                'description' => $data['description'] ?? '',
                'time' => $data['time'] ?? null,
                'location' => $data['location'] ?? ''
            ]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Delete itinerary item
     */
    public function deleteItinerary($itineraryId) {
        try {
            $sql = "DELETE FROM TourItinerary WHERE itineraryID = :id";
            $this->query($sql, ['id' => $itineraryId]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Get single itinerary item
     */
    public function getItineraryItem($itineraryId) {
        try {
            $sql = "SELECT * FROM TourItinerary WHERE itineraryID = :id";
            $stmt = $this->query($sql, ['id' => $itineraryId]);
            return $stmt->fetch();
        } catch (\PDOException $e) {
            return null;
        }
    }

    /**
     * Get tour with itinerary
     */
    public function getWithItinerary($tourId) {
        $tour = $this->getWithStats($tourId);
        
        if (!$tour) {
            return null;
        }

        $tour['itinerary'] = $this->getItinerary($tourId);
        
        return $tour;
    }

    /**
     * Add itinerary item
     */
    public function addItineraryItem($data) {
        $sql = "INSERT INTO TourItinerary (tourID, dayNumber, title, description, time, location, sortOrder) 
                VALUES (:tourID, :dayNumber, :title, :description, :time, :location, :sortOrder)";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'tourID' => $data['tourID'],
                'dayNumber' => $data['dayNumber'],
                'title' => $data['title'],
                'description' => $data['description'] ?? '',
                'time' => $data['time'],
                'location' => $data['location'] ?? '',
                'sortOrder' => $data['sortOrder'] ?? 0
            ]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Error adding itinerary: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Merge secondary tour data into primary tour
     */
    public function mergeTours($primaryId, $secondaryId) {
        $primaryId = (int)$primaryId;
        $secondaryId = (int)$secondaryId;
        
        if ($primaryId === $secondaryId || $primaryId <= 0 || $secondaryId <= 0) {
            return false;
        }

        try {
            $this->db->beginTransaction();

            // Update foreign keys in all related tables
            $tables = ['Booking', 'Fashion', 'History', 'Images', 'Promotion', 'Review', 'TourItinerary'];
            
            foreach ($tables as $tbl) {
                $sql = "UPDATE {$tbl} SET tourID = :primary WHERE tourID = :secondary";
                $this->query($sql, ['primary' => $primaryId, 'secondary' => $secondaryId]);
            }

            // Deactivate or delete the secondary tour
            $sql = "UPDATE {$this->table} SET availability = 0, title = CONCAT(title, ' (Merged into #', :primary, ')') WHERE tourID = :secondary";
            $this->query($sql, ['primary' => $primaryId, 'secondary' => $secondaryId]);

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Merge tours error: " . $e->getMessage());
            return false;
        }
    }
}
