<?php
/**
 * Bill Model
 * Manages Bill/Invoice operations
 */

require_once __DIR__ . '/Model.php';

class BillModel extends Model {
    protected $table = 'Bill';
    protected $primaryKey = 'billID';

    /**
     * Get all bills with booking details
     */
    public function getAllWithDetails() {
        $sql = "SELECT bi.*, b.bookingDate, b.totalPrice as bookingTotal, b.paymentStatus,
                       t.title as tourTitle, u.usersname, u.email as userEmail
                FROM {$this->table} bi
                LEFT JOIN Booking b ON bi.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                ORDER BY bi.dateIssued DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get single bill with full details
     */
    public function getWithDetails($id) {
        $sql = "SELECT bi.*, b.bookingDate, b.totalPrice as bookingTotal, b.paymentStatus,
                       b.numAdults, b.numChildren, b.specialRequests,
                       t.title as tourTitle, t.destination, t.priceAdult, t.priceChild, t.duration,
                       u.usersname, u.email as userEmail, u.phoneNumber, u.address
                FROM {$this->table} bi
                LEFT JOIN Booking b ON bi.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE bi.billID = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Generate unique bill ID
     */
    public function generateBillId() {
        $prefix = 'INV-';
        $date = date('Ymd');
        
        // Get last bill ID for today
        $sql = "SELECT billID FROM {$this->table} WHERE billID LIKE :pattern ORDER BY billID DESC LIMIT 1";
        $stmt = $this->query($sql, ['pattern' => $prefix . $date . '%']);
        $last = $stmt->fetch();
        
        if ($last) {
            $lastNum = intval(substr($last['billID'], -4));
            $newNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNum = '0001';
        }
        
        return $prefix . $date . '-' . $newNum;
    }

    /**
     * Create bill for booking
     */
    public function createForBooking($bookingId, $details = '') {
        $billId = $this->generateBillId();
        
        // Get booking total
        $sql = "SELECT totalPrice FROM Booking WHERE bookingID = :id";
        $stmt = $this->query($sql, ['id' => $bookingId]);
        $booking = $stmt->fetch();
        
        if (!$booking) {
            return false;
        }
        
        return $this->create([
            'billID' => $billId,
            'bookingID' => $bookingId,
            'amount' => $booking['totalPrice'],
            'details' => $details
        ]);
    }

    /**
     * Get bills by booking
     */
    public function getByBooking($bookingId) {
        return $this->findAllBy('bookingID', $bookingId);
    }

    /**
     * Search bills
     */
    public function search($keyword) {
        $sql = "SELECT bi.*, b.bookingDate, b.totalPrice as bookingTotal, b.paymentStatus,
                       t.title as tourTitle, u.usersname, u.email as userEmail
                FROM {$this->table} bi
                LEFT JOIN Booking b ON bi.bookingID = b.bookingID
                LEFT JOIN Tour t ON b.tourID = t.tourID
                LEFT JOIN Users u ON b.usersID = u.usersID
                WHERE bi.billID LIKE :keyword1 
                OR t.title LIKE :keyword2
                OR u.usersname LIKE :keyword3
                ORDER BY bi.dateIssued DESC";
        $searchTerm = "%{$keyword}%";
        $stmt = $this->query($sql, [
            'keyword1' => $searchTerm,
            'keyword2' => $searchTerm,
            'keyword3' => $searchTerm
        ]);
        return $stmt->fetchAll();
    }

    /**
     * Get total billed amount
     */
    public function getTotalBilled() {
        $sql = "SELECT SUM(amount) as total FROM {$this->table}";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
}
