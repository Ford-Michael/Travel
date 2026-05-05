<?php
/**
 * Base Model Class
 * Provides common database operations for all user models
 */

require_once __DIR__ . '/../config/database.php';

class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll($orderBy = null) {
        $sql = "SELECT * FROM {$this->table}";
        if ($orderBy) {
            $sql .= " ORDER BY {$orderBy}";
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findBy($field, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = :value";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['value' => $value]);
        return $stmt->fetch();
    }

    public function findAllBy($field, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = :value";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $fields       = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql          = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $stmt         = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "{$key} = :{$key}, ";
        }
        $fields     = rtrim($fields, ', ');
        $sql        = "UPDATE {$this->table} SET {$fields} WHERE {$this->primaryKey} = :id";
        $data['id'] = $id;
        $stmt       = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql  = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function count() {
        $sql    = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmt   = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
