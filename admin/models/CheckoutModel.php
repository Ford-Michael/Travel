<?php
/**
 * Checkout Model
 * Manages Payment/Checkout operations
 */

require_once __DIR__ . '/Model.php';

class CheckoutModel extends Model {
    protected $table = 'Checkout';
    protected $primaryKey = 'checkoutID';

    /**
     * Get all checkouts with booking details
     */
    public function getAllWithDetails() {
        $sql = "SELECT c.*, b.bookingDate, b.totalPrice as bookingTotal,
                       t.title as tourTitle, u.usersname, u.email as userEmail
                FROM {$this->table} c
                LEFT JOIN Booking b ON c.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                ORDER BY c.paymentDate DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get single checkout with full details
     */
    public function getWithDetails($id) {
        $sql = "SELECT c.*, b.bookingDate, b.totalPrice as bookingTotal, b.numAdults, b.numChildren,
                       t.title as tourTitle, t.destination, t.duration,
                       u.usersname, u.email as userEmail, u.phoneNumber, u.address
                FROM {$this->table} c
                LEFT JOIN Booking b ON c.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE c.checkoutID = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get checkouts by payment status
     */
    public function getByPaymentStatus($status) {
        $sql = "SELECT c.*, b.bookingDate, b.totalPrice as bookingTotal,
                       t.title as tourTitle, t.destination,
                       u.usersname, u.email as userEmail
                FROM {$this->table} c
                LEFT JOIN Booking b ON c.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE c.paymentStatus = :status
                ORDER BY c.paymentDate DESC";
        $stmt = $this->query($sql, ['status' => $status]);
        return $stmt->fetchAll();
    }

    /**
     * Get checkouts by payment method
     */
    public function getByPaymentMethod($method) {
        $sql = "SELECT c.*, t.title as tourTitle, u.usersname
                FROM {$this->table} c
                LEFT JOIN Booking b ON c.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE c.paymentMethod = :method
                ORDER BY c.paymentDate DESC";
        $stmt = $this->query($sql, ['method' => $method]);
        return $stmt->fetchAll();
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus($id, $status) {
        return $this->update($id, ['paymentStatus' => $status]);
    }

    /**
     * Get checkout by booking
     */
    public function getByBooking($bookingId) {
        return $this->findBy('bookingID', $bookingId);
    }

    /**
     * Get payment history by user with booking and tour details.
     */
    public function getDetailedByUser($userId) {
        $sql = "SELECT c.*, b.bookingID, b.bookingDate, b.totalPrice as bookingTotal,
                       t.title as tourTitle, t.destination
                FROM {$this->table} c
                LEFT JOIN Booking b ON c.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                WHERE b.usersID = :userId
                ORDER BY c.paymentDate DESC";
        $stmt = $this->query($sql, ['userId' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Count by payment status
     */
    public function countByPaymentStatus($status) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE paymentStatus = :status";
        $stmt = $this->query($sql, ['status' => $status]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Get total payments received
     */
    public function getTotalPayments() {
        $sql = "SELECT SUM(amount) as total FROM {$this->table} WHERE paymentStatus = 'Completed'";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    /**
     * Search checkouts
     */
    public function search($keyword) {
        $sql = "SELECT c.*, b.bookingDate, b.totalPrice as bookingTotal,
                       t.title as tourTitle, t.destination,
                       u.usersname, u.email as userEmail
                FROM {$this->table} c
                LEFT JOIN Booking b ON c.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE c.transactionID LIKE :keyword 
                OR t.title LIKE :keyword
                OR u.usersname LIKE :keyword
                OR c.paymentMethod LIKE :keyword
                ORDER BY c.paymentDate DESC";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }
}
