<?php
/**
 * Image Model
 * Handles image data operations
 */

require_once __DIR__ . '/Model.php';

class ImageModel extends Model {
    protected $table = 'Images';
    protected $primaryKey = 'imageID';

    /**
     * Get all images with pagination
     */
    public function getAllWithPagination($page = 1, $limit = 20) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT i.*, t.title as tour_title 
                FROM {$this->table} i 
                LEFT JOIN Tour t ON i.tourID = t.tourID 
                ORDER BY i.imageID DESC 
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get total count of images
     */
    public function getCount() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    /**
     * Get images by tour ID
     */
    public function getByTourId($tourId) {
        $sql = "SELECT * FROM {$this->table} WHERE tourID = :tourID ORDER BY imageID ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':tourID', $tourId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get image with tour information
     */
    public function getById($id) {
        $sql = "SELECT i.*, t.title as tour_title 
                FROM {$this->table} i 
                LEFT JOIN Tour t ON i.tourID = t.tourID 
                WHERE i.imageID = :imageID";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':imageID', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
