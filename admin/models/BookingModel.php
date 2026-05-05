<?php
/**
 * Booking Model
 * Manages Booking operations with Tour and User relationships
 */

require_once __DIR__ . '/Model.php';

class BookingModel extends Model {
    protected $table = 'Booking';
    protected $primaryKey = 'bookingID';

    /**
     * Get all bookings with tour and user details
     */
    public function getAllWithDetails() {
        $sql = "SELECT b.*, t.title as tourTitle, t.destination as tourDestination, 
                       u.usersname, u.email as userEmail, u.phoneNumber
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                ORDER BY b.bookingDate DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get single booking with full details
     */
    public function getWithDetails($id) {
        $sql = "SELECT b.*, t.title as tourTitle, t.destination, t.priceAdult, t.priceChild, t.duration,
                       u.usersname, u.email as userEmail, u.phoneNumber, u.address
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE b.bookingID = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update booking status
     */
    public function updateStatus($id, $status) {
        return $this->update($id, ['bookingStatus' => $status]);
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus($id, $status) {
        return $this->update($id, ['paymentStatus' => $status]);
    }

    /**
     * Get bookings by status
     */
    public function getByStatus($status) {
        $sql = "SELECT b.*, t.title as tourTitle, u.usersname
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE b.bookingStatus = :status
                ORDER BY b.bookingDate DESC";
        $stmt = $this->query($sql, ['status' => $status]);
        return $stmt->fetchAll();
    }

    /**
     * Get bookings by payment status
     */
    public function getByPaymentStatus($status) {
        $sql = "SELECT b.*, t.title as tourTitle, u.usersname
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE b.paymentStatus = :status
                ORDER BY b.bookingDate DESC";
        $stmt = $this->query($sql, ['status' => $status]);
        return $stmt->fetchAll();
    }

    /**
     * Get bookings by user
     */
    public function getByUser($userId) {
        $sql = "SELECT b.*, t.title as tourTitle
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                WHERE b.usersID = :userId
                ORDER BY b.bookingDate DESC";
        $stmt = $this->query($sql, ['userId' => $userId]);
        return $stmt->fetchAll();
    }

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

    /**
     * Get bookings by tour
     */
    public function getByTour($tourId) {
        $sql = "SELECT b.*, u.usersname, u.email as userEmail
                FROM {$this->table} b
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE b.tourID = :tourId
                ORDER BY b.bookingDate DESC";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Count bookings by status
     */
    public function countByStatus($status) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE bookingStatus = :status";
        $stmt = $this->query($sql, ['status' => $status]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Get total revenue
     */
    public function getTotalRevenue() {
        $sql = "SELECT SUM(totalPrice) as total FROM {$this->table} WHERE paymentStatus = 'Paid'";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    /**
     * Search bookings
     */
    public function search($keyword) {
        $sql = "SELECT b.*, t.title as tourTitle, u.usersname
                FROM {$this->table} b
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE t.title LIKE :keyword 
                OR u.usersname LIKE :keyword
                OR u.email LIKE :keyword
                ORDER BY b.bookingDate DESC";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }
}
