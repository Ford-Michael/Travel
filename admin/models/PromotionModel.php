<?php
/**
 * Promotion Model
 * Manages Promotion/Discount operations
 */

require_once __DIR__ . '/Model.php';

class PromotionModel extends Model {
    protected $table = 'Promotion';
    protected $primaryKey = 'promotionID';

    /**
     * Get all promotions with tour details
     */
    public function getAllWithDetails() {
        $sql = "SELECT p.*, t.title as tourTitle
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                ORDER BY p.startDate DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get single promotion with tour details
     */
    public function getWithDetails($id) {
        $sql = "SELECT p.*, t.title as tourTitle, t.destination
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                WHERE p.promotionID = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get active promotions
     */
    public function getActivePromotions() {
        $sql = "SELECT p.*, t.title as tourTitle
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                WHERE p.startDate <= NOW() AND p.endDate >= NOW() AND (p.quantity > 0 OR p.quantity IS NULL)
                ORDER BY p.endDate ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get expired promotions
     */
    public function getExpiredPromotions() {
        $sql = "SELECT p.*, t.title as tourTitle
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                WHERE p.endDate < NOW() OR p.quantity = 0
                ORDER BY p.endDate DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get upcoming promotions
     */
    public function getUpcomingPromotions() {
        $sql = "SELECT p.*, t.title as tourTitle
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                WHERE p.startDate > NOW()
                ORDER BY p.startDate ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get promotions by tour
     */
    public function getByTour($tourId) {
        $sql = "SELECT * FROM {$this->table} WHERE tourID = :tourId ORDER BY startDate DESC";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Check if promotion code exists
     */
    public function codeExists($code, $excludeId = null) {
        $sql = "SELECT * FROM {$this->table} WHERE promotionID = :code";
        if ($excludeId) {
            $sql .= " AND promotionID != :excludeId";
            $stmt = $this->query($sql, ['code' => $code, 'excludeId' => $excludeId]);
        } else {
            $stmt = $this->query($sql, ['code' => $code]);
        }
        return $stmt->fetch() !== false;
    }

    /**
     * Decrement quantity
     */
    public function decrementQuantity($id) {
        $sql = "UPDATE {$this->table} SET quantity = quantity - 1 WHERE promotionID = :id AND quantity > 0";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Search promotions
     */
    public function search($keyword) {
        $sql = "SELECT p.*, t.title as tourTitle
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                WHERE p.promotionID LIKE :keyword 
                OR p.description LIKE :keyword
                OR t.title LIKE :keyword
                ORDER BY p.startDate DESC";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }

    /**
     * Get promotion status
     */
    public function getStatus($promotion) {
        $now = time();
        $start = strtotime($promotion['startDate']);
        $end = strtotime($promotion['endDate']);
        
        if ($promotion['quantity'] !== null && $promotion['quantity'] <= 0) {
            return 'exhausted';
        }
        if ($now < $start) {
            return 'upcoming';
        }
        if ($now > $end) {
            return 'expired';
        }
        return 'active';
    }
}
