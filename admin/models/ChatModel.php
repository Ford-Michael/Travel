<?php
/**
 * Chat Model
 * Manages Chat/Support message operations
 */

require_once __DIR__ . '/Model.php';

class ChatModel extends Model {
    protected $table = 'Chat';
    protected $primaryKey = 'chatID';

    /**
     * Get all chats with user details
     */
    public function getAllWithDetails() {
        $sql = "SELECT c.*, u.usersname, u.email as userEmail, a.usersname as adminName
                FROM {$this->table} c
                LEFT JOIN Users u ON c.usersID = u.usersID
                LEFT JOIN Admin a ON c.adminID = a.adminID
                ORDER BY c.createdDate DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get single chat with full details
     */
    public function getWithDetails($id) {
        $sql = "SELECT c.*, u.usersname, u.email as userEmail, u.phoneNumber,
                       a.usersname as adminName
                FROM {$this->table} c
                LEFT JOIN Users u ON c.usersID = u.usersID
                LEFT JOIN Admin a ON c.adminID = a.adminID
                WHERE c.chatID = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get chats by user
     */
    public function getByUser($userId) {
        $sql = "SELECT c.*, a.usersname as adminName
                FROM {$this->table} c
                LEFT JOIN Admin a ON c.adminID = a.adminID
                WHERE c.usersID = :userId
                ORDER BY c.createdDate DESC";
        $stmt = $this->query($sql, ['userId' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get unread chats
     */
    public function getUnread() {
        $sql = "SELECT c.*, u.usersname, u.email as userEmail
                FROM {$this->table} c
                LEFT JOIN Users u ON c.usersID = u.usersID
                WHERE c.readStatus = 0
                ORDER BY c.createdDate DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get unread count
     */
    public function getUnreadCount() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE readStatus = 0";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Mark chat as read
     */
    public function markAsRead($id) {
        return $this->update($id, ['readStatus' => 1]);
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead() {
        $sql = "UPDATE {$this->table} SET readStatus = 1 WHERE readStatus = 0";
        $stmt = $this->db->query($sql);
        return $stmt->rowCount();
    }

    /**
     * Add reply to chat
     */
    public function addReply($id, $message, $adminId) {
        $chat = $this->findById($id);
        if (!$chat) {
            return false;
        }

        $existingMessages = $chat['messages'] ?? '';
        $newMessage = "\n\n[Admin Reply - " . date('Y-m-d H:i:s') . "]\n" . $message;
        
        return $this->update($id, [
            'messages' => $existingMessages . $newMessage,
            'adminID' => $adminId,
            'readStatus' => 1
        ]);
    }

    /**
     * Create new chat message
     */
    public function createMessage($userId, $message, $ipAddress = null) {
        return $this->create([
            'usersID' => $userId,
            'messages' => $message,
            'readStatus' => 0,
            'ipAddress' => $ipAddress
        ]);
    }

    /**
     * Search chats
     */
    public function search($keyword) {
        $sql = "SELECT c.*, u.usersname, u.email as userEmail
                FROM {$this->table} c
                LEFT JOIN Users u ON c.usersID = u.usersID
                WHERE c.messages LIKE :keyword 
                OR u.usersname LIKE :keyword
                OR u.email LIKE :keyword
                ORDER BY c.createdDate DESC";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }

    /**
     * Get recent chats
     */
    public function getRecent($limit = 10) {
        $sql = "SELECT c.*, u.usersname
                FROM {$this->table} c
                LEFT JOIN Users u ON c.usersID = u.usersID
                ORDER BY c.createdDate DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
