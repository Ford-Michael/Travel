<?php
/**
 * User Model
 * Admin manages Users through this model
 */

require_once __DIR__ . '/Model.php';

class UserModel extends Model {
    protected $table = 'Users';
    protected $primaryKey = 'usersID';

    /**
     * Find user by email
     */
    public function findByEmail($email) {
        return $this->findBy('email', $email);
    }

    /**
     * Find user by username
     */
    public function findByUsername($username) {
        return $this->findBy('usersname', $username);
    }

    /**
     * Create new user with hashed password
     */
    public function createUser($data) {
        // Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['isActive'] = true;
        $data['status'] = 'active';
        
        return $this->create($data);
    }

    /**
     * Update user
     */
    public function updateUser($id, $data) {
        // If password is being updated, hash it
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
        
        return $this->update($id, $data);
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus($id) {
        $user = $this->findById($id);
        
        if (!$user) {
            return false;
        }

        $newStatus = $user['isActive'] ? 0 : 1;
        $statusText = $newStatus ? 'active' : 'inactive';
        
        return $this->update($id, [
            'isActive' => $newStatus,
            'status' => $statusText
        ]);
    }

    /**
     * Get all active users
     */
    public function getActiveUsers() {
        return $this->findAllBy('isActive', 1);
    }

    /**
     * Get all inactive users
     */
    public function getInactiveUsers() {
        return $this->findAllBy('isActive', 0);
    }

    /**
     * Search users
     */
    public function search($keyword) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE usersname LIKE :keyword 
                OR email LIKE :keyword 
                OR phoneNumber LIKE :keyword";
        $stmt = $this->query($sql, ['keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }

    /**
     * Check if email exists
     */
    public function emailExists($email, $excludeId = null) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        if ($excludeId) {
            $sql .= " AND {$this->primaryKey} != :id";
            $stmt = $this->query($sql, ['email' => $email, 'id' => $excludeId]);
        } else {
            $stmt = $this->query($sql, ['email' => $email]);
        }
        return $stmt->fetch() !== false;
    }

    /**
     * Count users by status
     */
    public function countByStatus($status) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE status = :status";
        $stmt = $this->query($sql, ['status' => $status]);
        $result = $stmt->fetch();
        return $result['count'];
    }
}
