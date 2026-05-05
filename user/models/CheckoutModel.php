<?php
/**
 * Checkout Model
 * Provides payment history queries for the user module.
 */

require_once __DIR__ . '/Model.php';

class CheckoutModel extends Model {
    protected $table = 'Checkout';
    protected $primaryKey = 'checkoutID';

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
}
