<?php
/**
 * History Model
 * Manages Activity History/Log operations
 */

require_once __DIR__ . '/Model.php';

class HistoryModel extends Model {
    protected $table = 'History';
    protected $primaryKey = 'historyID';

    /**
     * Get all history with user and tour details
     */
    public function getAllWithDetails() {
        $sql = "SELECT h.*, u.usersname, u.email as userEmail, t.title as tourTitle,
                       a.usersname as adminUsername, a.email as adminEmail
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                LEFT JOIN Tour t ON h.tourID = t.tourID
                LEFT JOIN Admin a ON h.adminID = a.adminID
                ORDER BY h.timestamp DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get paginated history
     */
    public function getPaginated($page = 1, $perPage = 50) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT h.*, u.usersname, t.title as tourTitle,
                       a.usersname as adminUsername, a.email as adminEmail
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                LEFT JOIN Tour t ON h.tourID = t.tourID
                LEFT JOIN Admin a ON h.adminID = a.adminID
                ORDER BY h.timestamp DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get history by user
     */
    public function getByUser($userId) {
        $sql = "SELECT h.*, t.title as tourTitle
                FROM {$this->table} h
                LEFT JOIN Tour t ON h.tourID = t.tourID
                WHERE h.usersID = :userId
                ORDER BY h.timestamp DESC";
        $stmt = $this->query($sql, ['userId' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get history by tour
     */
    public function getByTour($tourId) {
        $sql = "SELECT h.*, u.usersname
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                WHERE h.tourID = :tourId
                ORDER BY h.timestamp DESC";
        $stmt = $this->query($sql, ['tourId' => $tourId]);
        return $stmt->fetchAll();
    }

    /**
     * Get history by action type
     */
    public function getByActionType($actionType) {
        $sql = "SELECT h.*, u.usersname, t.title as tourTitle,
                       a.usersname as adminUsername, a.email as adminEmail
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                LEFT JOIN Tour t ON h.tourID = t.tourID
                LEFT JOIN Admin a ON h.adminID = a.adminID
                WHERE h.actionType = :actionType
                ORDER BY h.timestamp DESC";
        $stmt = $this->query($sql, ['actionType' => $actionType]);
        return $stmt->fetchAll();
    }

    /**
     * Get distinct action types
     */
    public function getActionTypes() {
        $sql = "SELECT DISTINCT actionType FROM {$this->table} ORDER BY actionType";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Log new action
     */
    public function logAction($userId, $tourId, $actionType, $adminId = null, $loginIP = null, $userAgent = null) {
        return $this->create([
            'usersID' => $userId,
            'tourID' => $tourId,
            'adminID' => $adminId,
            'actionType' => $actionType,
            'loginIP' => $loginIP,
            'userAgent' => $userAgent
        ]);
    }

    public function logAdminLogin($adminId, $loginIP = null, $userAgent = null) {
        return $this->create([
            'usersID' => null,
            'tourID' => null,
            'adminID' => $adminId,
            'actionType' => 'admin_login',
            'loginIP' => $loginIP,
            'userAgent' => $userAgent
        ]);
    }

    /**
     * Get activity statistics
     */
    public function getStatistics() {
        $sql = "SELECT actionType, COUNT(*) as count 
                FROM {$this->table} 
                GROUP BY actionType 
                ORDER BY count DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get recent activity
     */
    public function getRecent($limit = 20) {
        $sql = "SELECT h.*, u.usersname, t.title as tourTitle
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                LEFT JOIN Tour t ON h.tourID = t.tourID
                ORDER BY h.timestamp DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Search history
     */
    public function search($keyword) {
        $sql = "SELECT h.*, u.usersname, t.title as tourTitle,
                       a.usersname as adminUsername, a.email as adminEmail
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                LEFT JOIN Tour t ON h.tourID = t.tourID
                LEFT JOIN Admin a ON h.adminID = a.adminID
                WHERE h.actionType LIKE :keyword 
                OR u.usersname LIKE :keyword
                OR a.usersname LIKE :keyword
                OR t.title LIKE :keyword
                ORDER BY h.timestamp DESC";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }

    /**
     * Get history by date range
     */
    public function getByDateRange($startDate, $endDate) {
        $sql = "SELECT h.*, u.usersname, t.title as tourTitle,
                       a.usersname as adminUsername, a.email as adminEmail
                FROM {$this->table} h
                LEFT JOIN Users u ON h.usersID = u.usersID
                LEFT JOIN Tour t ON h.tourID = t.tourID
                LEFT JOIN Admin a ON h.adminID = a.adminID
                WHERE h.timestamp BETWEEN :startDate AND :endDate
                ORDER BY h.timestamp DESC";
        $stmt = $this->query($sql, ['startDate' => $startDate, 'endDate' => $endDate]);
        return $stmt->fetchAll();
    }

    /**
     * Clear old history
     */
    public function clearOlderThan($days) {
        $sql = "DELETE FROM {$this->table} WHERE timestamp < DATE_SUB(NOW(), INTERVAL :days DAY)";
        $stmt = $this->query($sql, ['days' => $days]);
        return $stmt->rowCount();
    }
}
