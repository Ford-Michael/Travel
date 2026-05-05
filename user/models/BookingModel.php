<?php
/**
 * Booking Model
 * Provides booking history queries for the user module.
 */

require_once __DIR__ . '/Model.php';

class BookingModel extends Model {
    protected $table = 'Booking';
    protected $primaryKey = 'bookingID';

    /**
     * Get detailed booking history by user.
     */
    public function getDetailedByUser($userId) {
        $sql = "SELECT b.*, t.title as tourTitle, t.destination, t.duration
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                WHERE b.usersID = :userId
                ORDER BY b.bookingDate DESC";
        $stmt = $this->query($sql, ['userId' => $userId]);
        return $stmt->fetchAll();
    }
}
