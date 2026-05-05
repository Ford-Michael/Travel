<?php
/**
 * Review Model
 * Manages Review operations with Tour and User relationships
 */

require_once __DIR__ . '/Model.php';

class ReviewModel extends Model {
    protected $table = 'Review';
    protected $primaryKey = 'reviewID';

    /**
     * Get all reviews with tour and user details
     */
    public function getAllWithDetails() {
        $sql = "SELECT r.*, t.title as tourTitle, t.destination,
                       u.usersname, u.email as userEmail
                FROM {$this->table} r
                LEFT JOIN Tour t ON r.tourID = t.tourID
                LEFT JOIN Users u ON r.usersID = u.usersID
                ORDER BY r.timestamp DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get single review with full details
     */
    public function getWithDetails($id) {
        $sql = "SELECT r.*, t.title as tourTitle, t.destination,
                       u.usersname, u.email as userEmail
                FROM {$this->table} r
                LEFT JOIN Tour t ON r.tourID = t.tourID
                LEFT JOIN Users u ON r.usersID = u.usersID
                WHERE r.reviewID = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get reviews by tour
     */
    public function getByTour($tourId) {
        $sql = "SELECT r.*, u.usersname
                FROM {$this->table} r
                LEFT JOIN Users u ON r.usersID = u.usersID
                WHERE r.tourID = :tourId
                ORDER BY r.timestamp DESC";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Get reviews by user
     */
    public function getByUser($userId) {
        $sql = "SELECT r.*, t.title as tourTitle
                FROM {$this->table} r
                LEFT JOIN Tour t ON r.tourID = t.tourID
                WHERE r.usersID = :userId
                ORDER BY r.timestamp DESC";
        $stmt = $this->query($sql, ['userId' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get reviews by rating
     */
    public function getByRating($rating) {
        $sql = "SELECT r.*, t.title as tourTitle, t.destination,
                       u.usersname, u.email as userEmail
                FROM {$this->table} r
                LEFT JOIN Tour t ON r.tourID = t.tourID
                LEFT JOIN Users u ON r.usersID = u.usersID
                WHERE r.rating = :rating
                ORDER BY r.timestamp DESC";
        $stmt = $this->query($sql, ['rating' => $rating]);
        return $stmt->fetchAll();
    }

    /**
     * Get average rating for a tour
     */
    public function getAverageRating($tourId) {
        $sql = "SELECT AVG(rating) as average, COUNT(*) as count FROM {$this->table} WHERE tourID = :tourId";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        $result = $stmt->fetch();
        return [
            'average' => round($result['average'] ?? 0, 1),
            'count' => $result['count'] ?? 0
        ];
    }

    /**
     * Get overall statistics
     */
    public function getStatistics() {
        $sql = "SELECT 
                    AVG(rating) as overallAverage,
                    COUNT(*) as totalReviews,
                    SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as fiveStars,
                    SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as fourStars,
                    SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as threeStars,
                    SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as twoStars,
                    SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as oneStar
                FROM {$this->table}";
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }

    /**
     * Search reviews
     */
    public function search($keyword) {
        $sql = "SELECT r.*, t.title as tourTitle, t.destination,
                       u.usersname, u.email as userEmail
                FROM {$this->table} r
                LEFT JOIN Tour t ON r.tourID = t.tourID
                LEFT JOIN Users u ON r.usersID = u.usersID
                WHERE r.comment LIKE :keyword 
                OR t.title LIKE :keyword
                OR u.usersname LIKE :keyword
                ORDER BY r.timestamp DESC";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }

    /**
     * Get recent reviews
     */
    public function getRecent($limit = 5) {
        $sql = "SELECT r.*, t.title as tourTitle, u.usersname
                FROM {$this->table} r
                LEFT JOIN Tour t ON r.tourID = t.tourID
                LEFT JOIN Users u ON r.usersID = u.usersID
                ORDER BY r.timestamp DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $normalized = [
            'tourID' => $data['tourID'],
            'usersID' => $data['usersID'],
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? ($data['review'] ?? ''),
            'timestamp' => $data['timestamp'] ?? ($data['reviewDate'] ?? date('Y-m-d H:i:s')),
        ];

        return parent::create($normalized);
    }
}
