<?php
/**
 * User Model
 * Handles user account-related database operations
 */

require_once __DIR__ . '/Model.php';

class UserModel extends Model {
    protected $table      = 'users';
    protected $primaryKey = 'userID';
    private $usernameColumn = 'username';
    private $schemaResolved = false;
    private $columns = [];
    private $rememberTable = 'UserRememberTokens';

    public function __construct() {
        parent::__construct();
        $this->resolveSchema();
    }

    private function resolveSchema() {
        if ($this->schemaResolved) {
            return;
        }

        $this->schemaResolved = true;

        $lowerTableExists = $this->db->query("SHOW TABLES LIKE 'users'")->fetchColumn();
        $upperTableExists = $this->db->query("SHOW TABLES LIKE 'Users'")->fetchColumn();

        if ($upperTableExists && !$lowerTableExists) {
            $this->table = 'Users';
        }

        $stmt = $this->db->query("SHOW COLUMNS FROM {$this->table}");
        if (!$stmt) {
            return;
        }

        $this->columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (in_array('usersID', $this->columns, true)) {
            $this->primaryKey = 'usersID';
        }
        if (in_array('usersname', $this->columns, true)) {
            $this->usernameColumn = 'usersname';
        }
    }

    private function normalizeUser($user) {
        if (!$user) {
            return $user;
        }

        if (!isset($user['username']) && isset($user['usersname'])) {
            $user['username'] = $user['usersname'];
        }
        if (!isset($user['usersname']) && isset($user['username'])) {
            $user['usersname'] = $user['username'];
        }
        if (!isset($user['userID']) && isset($user['usersID'])) {
            $user['userID'] = $user['usersID'];
        }
        if (!isset($user['usersID']) && isset($user['userID'])) {
            $user['usersID'] = $user['userID'];
        }

        return $user;
    }

    /**
     * Find user by id.
     */
    public function findById($id) {
        $this->resolveSchema();
        return $this->normalizeUser(parent::findById($id));
    }

    /**
     * Get table columns for the user schema.
     */
    public function getTableColumns() {
        $this->resolveSchema();
        return $this->columns;
    }

    /**
     * Build account fields from the current schema.
     */
    public function getAccountFields($user) {
        $fields = [];

        foreach ($this->getTableColumns() as $column) {
            $fields[] = [
                'key' => $column,
                'label' => $this->getColumnLabel($column),
                'value' => $this->formatColumnValue($column, $user[$column] ?? null),
            ];
        }

        return $fields;
    }

    private function getColumnLabel($column) {
        $labels = [
            'userID' => 'Ma tai khoan',
            'usersID' => 'Ma tai khoan',
            'username' => 'Ten dang nhap',
            'usersname' => 'Ten dang nhap',
            'password' => 'Mat khau',
            'email' => 'Email',
            'phoneNumber' => 'So dien thoai',
            'address' => 'Dia chi',
            'ipAddress' => 'IP dang nhap',
            'isActive' => 'Kich hoat',
            'status' => 'Trang thai',
        ];

        if (isset($labels[$column])) {
            return $labels[$column];
        }

        $label = preg_replace('/(?<!^)([A-Z])/', ' $1', $column);
        return ucwords(str_replace('_', ' ', (string) $label));
    }

    private function formatColumnValue($column, $value) {
        if ($column === 'password') {
            return '******** (bao mat)';
        }

        if ($column === 'isActive') {
            return !empty($value) ? 'Co' : 'Khong';
        }

        if ($value === null || $value === '') {
            return 'Chua cap nhat';
        }

        return (string) $value;
    }

    /**
     * Find user by email
     */
    public function findByEmail($email) {
        $this->resolveSchema();
        $sql  = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $this->normalizeUser($stmt->fetch());
    }

    /**
     * Find user by username
     */
    public function findByUsername($username) {
        $this->resolveSchema();
        $sql  = "SELECT * FROM {$this->table} WHERE {$this->usernameColumn} = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $this->normalizeUser($stmt->fetch());
    }

    /**
     * Check if email exists
     */
    public function emailExists($email) {
        $user = $this->findByEmail($email);
        return $user !== false;
    }

    /**
     * Check if username exists
     */
    public function usernameExists($username) {
        $user = $this->findByUsername($username);
        return $user !== false;
    }

    /**
     * Login user
     */
    public function login($emailOrUsername, $password) {
        $this->resolveSchema();
        $sql  = "SELECT * FROM {$this->table} WHERE (email = :val OR {$this->usernameColumn} = :val2) LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['val' => $emailOrUsername, 'val2' => $emailOrUsername]);
        $user = $this->normalizeUser($stmt->fetch());

        if (!$user) {
            return ['success' => false, 'message' => 'Email hoặc tài khoản không tồn tại.'];
        }

        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Mật khẩu không đúng.'];
        }

        return ['success' => true, 'user' => $user];
    }

    public function createRememberToken($userId, $days = 30) {
        $this->resolveSchema();
        $this->ensureRememberTokenTable();
        $this->clearRememberTokensByUser($userId);

        $plainToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $plainToken);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+' . max(1, (int) $days) . ' days'));

        $sql = "INSERT INTO {$this->rememberTable} ({$this->primaryKey}, tokenHash, expiresAt) VALUES (:userId, :tokenHash, :expiresAt)";
        $this->query($sql, [
            'userId' => $userId,
            'tokenHash' => $tokenHash,
            'expiresAt' => $expiresAt
        ]);

        return $plainToken;
    }

    public function findByRememberToken($plainToken) {
        $this->resolveSchema();
        $this->ensureRememberTokenTable();
        $tokenHash = hash('sha256', (string) $plainToken);

        $sql = "SELECT u.*
                FROM {$this->rememberTable} t
                INNER JOIN {$this->table} u ON u.{$this->primaryKey} = t.{$this->primaryKey}
                WHERE t.tokenHash = :tokenHash
                AND t.expiresAt > NOW()
                LIMIT 1";
        $stmt = $this->query($sql, ['tokenHash' => $tokenHash]);
        return $this->normalizeUser($stmt->fetch()) ?: false;
    }

    public function clearRememberToken($plainToken) {
        $this->resolveSchema();
        $this->ensureRememberTokenTable();
        $tokenHash = hash('sha256', (string) $plainToken);
        $this->query("DELETE FROM {$this->rememberTable} WHERE tokenHash = :tokenHash", ['tokenHash' => $tokenHash]);
    }

    public function clearRememberTokensByUser($userId) {
        $this->resolveSchema();
        $this->ensureRememberTokenTable();
        $this->query("DELETE FROM {$this->rememberTable} WHERE {$this->primaryKey} = :userId", ['userId' => $userId]);
    }

    /**
     * Create new user
     */
    public function createUser($data) {
        $this->resolveSchema();
        if ($this->usernameColumn !== 'username' && isset($data['username'])) {
            $data[$this->usernameColumn] = $data['username'];
            unset($data['username']);
        }
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->create($data);
    }

    /**
     * Update user profile
     */
    public function updateProfile($id, $data) {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
        return $this->update($id, $data);
    }

    private function ensureRememberTokenTable() {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->rememberTable} (
            tokenID INT PRIMARY KEY AUTO_INCREMENT,
            {$this->primaryKey} INT NOT NULL,
            tokenHash VARCHAR(64) NOT NULL,
            createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
            expiresAt DATETIME NOT NULL,
            UNIQUE KEY uniq_token_hash (tokenHash),
            KEY idx_user_id ({$this->primaryKey}),
            CONSTRAINT fk_user_remember_user FOREIGN KEY ({$this->primaryKey}) REFERENCES {$this->table}({$this->primaryKey}) ON DELETE CASCADE
        )";
        $this->query($sql);
    }
}
