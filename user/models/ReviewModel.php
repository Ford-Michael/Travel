<?php
/**
 * Review Model
 * Handles user review queries and mutations.
 */

require_once __DIR__ . '/Model.php';

class ReviewModel extends Model {
    protected $table = 'Review';
    protected $primaryKey = 'reviewID';

    public function getByTour($tourId) {
        $sql = "SELECT r.*, u.usersname
                FROM {$this->table} r
                LEFT JOIN Users u ON r.usersID = u.usersID
                WHERE r.tourID = :tourId
                ORDER BY r.timestamp DESC";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        return $stmt->fetchAll();
    }

    public function findByUserAndTour($userId, $tourId) {
        $sql = "SELECT * FROM {$this->table}
                WHERE usersID = :userId AND tourID = :tourId
                LIMIT 1";
        $stmt = $this->query($sql, ['userId' => $userId, 'tourId' => $tourId]);
        return $stmt->fetch();
    }

    public function createReview($tourId, $userId, $rating, $comment) {
        return $this->create([
            'tourID' => $tourId,
            'usersID' => $userId,
            'rating' => $rating,
            'comment' => $comment,
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }

    public function updateReview($reviewId, $rating, $comment) {
        return $this->update($reviewId, [
            'rating' => $rating,
            'comment' => $comment,
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}
