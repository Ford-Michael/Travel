<?php
/**
 * Admin Model
 * Handles admin authentication and password management
 */

require_once __DIR__ . '/Model.php';

class AdminModel extends Model {
    protected $table = 'Admin';
    protected $primaryKey = 'adminID';
    private $rememberTable = 'AdminRememberTokens';

    /**
     * Find admin by email
     */
    public function findByEmail($email) {
        return $this->findBy('email', $email);
    }

    /**
     * Find admin by username
     */
    public function findByUsername($username) {
        return $this->findBy('usersname', $username);
    }

    /**
     * Create new admin with hashed password
     */
    public function createAdmin($data) {
        // Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['createdDate'] = date('Y-m-d H:i:s');
        
        if (!isset($data['role'])) {
            $data['role'] = 'moderator';
        }
        
        return $this->create($data);
    }

    /**
     * Verify password
     */
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Login admin
     */
    public function login($usernameOrEmail, $password) {
        // Try to find by email first
        $admin = $this->findByEmail($usernameOrEmail);
        
        // If not found, try username
        if (!$admin) {
            $admin = $this->findByUsername($usernameOrEmail);
        }
        
        if (!$admin) {
            return ['success' => false, 'message' => 'Account not found'];
        }

        // Check if password is hashed (starts with $2y$ for bcrypt)
        if (strpos($admin['password'], '$2y$') === 0) {
            // Hashed password - use password_verify
            if (!$this->verifyPassword($password, $admin['password'])) {
                return ['success' => false, 'message' => 'Invalid password'];
            }
        } else {
            // Plain text password (legacy) - direct comparison
            if ($admin['password'] !== $password) {
                return ['success' => false, 'message' => 'Invalid password'];
            }
            // Update to hashed password
            $this->update($admin['adminID'], [
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        }

        return ['success' => true, 'admin' => $admin];
    }

    public function createRememberToken($adminId, $days = 30) {
        $this->ensureRememberTokenTable();
        $this->clearRememberTokensByAdmin($adminId);

        $plainToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $plainToken);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+' . max(1, (int) $days) . ' days'));

        $sql = "INSERT INTO {$this->rememberTable} (adminID, tokenHash, expiresAt) VALUES (:adminId, :tokenHash, :expiresAt)";
        $this->query($sql, [
            'adminId' => $adminId,
            'tokenHash' => $tokenHash,
            'expiresAt' => $expiresAt
        ]);

        return $plainToken;
    }

    public function findByRememberToken($plainToken) {
        $this->ensureRememberTokenTable();
        $tokenHash = hash('sha256', (string) $plainToken);

        $sql = "SELECT a.*
                FROM {$this->rememberTable} t
                INNER JOIN {$this->table} a ON a.adminID = t.adminID
                WHERE t.tokenHash = :tokenHash
                AND t.expiresAt > NOW()
                LIMIT 1";
        $stmt = $this->query($sql, ['tokenHash' => $tokenHash]);
        return $stmt->fetch() ?: false;
    }

    public function clearRememberToken($plainToken) {
        $this->ensureRememberTokenTable();
        $tokenHash = hash('sha256', (string) $plainToken);
        $this->query("DELETE FROM {$this->rememberTable} WHERE tokenHash = :tokenHash", ['tokenHash' => $tokenHash]);
    }

    public function clearRememberTokensByAdmin($adminId) {
        $this->ensureRememberTokenTable();
        $this->query("DELETE FROM {$this->rememberTable} WHERE adminID = :adminId", ['adminId' => $adminId]);
    }

    /**
     * Create password reset token
     */
    public function createPasswordResetToken($email) {
        $admin = $this->findByEmail($email);
        
        if (!$admin) {
            return ['success' => false, 'message' => 'Email not found'];
        }

        // Ensure PasswordResets table exists
        $this->ensurePasswordResetsTable();

        // Generate token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

        try {
            // Delete existing tokens for this email
            $this->query("DELETE FROM PasswordResets WHERE email = :email", ['email' => $email]);

            // Insert new token
            $sql = "INSERT INTO PasswordResets (email, token, expires_at) VALUES (:email, :token, :expires_at)";
            $this->query($sql, [
                'email' => $email,
                'token' => $token,
                'expires_at' => $expiresAt
            ]);

            return ['success' => true, 'token' => $token, 'admin' => $admin];
        } catch (Exception $e) {
            error_log("Password reset error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Failed to create reset token. Please try again.'];
        }
    }

    /**
     * Ensure PasswordResets table exists
     */
    private function ensurePasswordResetsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS PasswordResets (
            id INT PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(100) NOT NULL,
            token VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            expires_at DATETIME NOT NULL,
            INDEX idx_email (email),
            INDEX idx_token (token)
        )";
        $this->query($sql);
    }

    /**
     * Generate temporary password
     */
    public function generateTemporaryPassword($email) {
        $admin = $this->findByEmail($email);
        
        if (!$admin) {
            return ['success' => false, 'message' => 'Email not found'];
        }

        // Generate temporary password
        $tempPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        
        // Update password
        $this->update($admin['adminID'], [
            'password' => password_hash($tempPassword, PASSWORD_DEFAULT)
        ]);

        return ['success' => true, 'tempPassword' => $tempPassword, 'admin' => $admin];
    }

    /**
     * Reset password with token
     */
    public function resetPassword($token, $newPassword) {
        // Find valid token
        $sql = "SELECT * FROM PasswordResets WHERE token = :token AND expires_at > NOW()";
        $stmt = $this->query($sql, ['token' => $token]);
        $reset = $stmt->fetch();

        if (!$reset) {
            return ['success' => false, 'message' => 'Invalid or expired token'];
        }

        // Find admin
        $admin = $this->findByEmail($reset['email']);
        
        if (!$admin) {
            return ['success' => false, 'message' => 'Admin not found'];
        }

        // Update password
        $this->update($admin['adminID'], [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        // Delete used token
        $this->query("DELETE FROM PasswordResets WHERE token = :token", ['token' => $token]);

        return ['success' => true, 'admin' => $admin];
    }

    /**
     * Validate token
     */
    public function validateToken($token) {
        $sql = "SELECT * FROM PasswordResets WHERE token = :token AND expires_at > NOW()";
        $stmt = $this->query($sql, ['token' => $token]);
        return $stmt->fetch();
    }

    /**
     * Check if email exists
     */
    public function emailExists($email) {
        return $this->findByEmail($email) !== false;
    }

    /**
     * Check if username exists
     */
    public function usernameExists($username) {
        return $this->findByUsername($username) !== false;
    }

    private function ensureRememberTokenTable() {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->rememberTable} (
            tokenID INT PRIMARY KEY AUTO_INCREMENT,
            adminID INT NOT NULL,
            tokenHash VARCHAR(64) NOT NULL,
            createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
            expiresAt DATETIME NOT NULL,
            UNIQUE KEY uniq_token_hash (tokenHash),
            KEY idx_admin_id (adminID),
            CONSTRAINT fk_admin_remember_admin FOREIGN KEY (adminID) REFERENCES {$this->table}(adminID) ON DELETE CASCADE
        )";
        $this->query($sql);
    }

}
