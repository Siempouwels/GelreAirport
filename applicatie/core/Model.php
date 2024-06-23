<?php

require_once __DIR__ . '/Database.php';

class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll($orderBy = null, $orderDir = 'ASC')
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy $orderDir";
        }
        return $this->fetchAll($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->fetch($sql, ['id' => $id]);
    }

    public function create(array $data)
    {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        return $this->execute($sql, $data);
    }

    public function update($id, array $data)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        $sql = "UPDATE {$this->table} SET $fields WHERE id = :id";
        $data['id'] = $id;
        return $this->execute($sql, $data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }

    public function insert(array $data)
    {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $this->execute($sql, $data);
        return $this->db->lastInsertId();
    }

    protected function query($sql, $params = []): PDOStatement
    {
        try {
            $stmt = $this->db->prepare($sql);

            if (!$stmt->execute($params)) {
                throw new Exception('Database query error: ' . implode(', ', $stmt->errorInfo()));
            }

            return $stmt;
        } catch (Exception $e) {
            // Log the exception with SQL and parameters
            error_log('SQL: ' . $sql);
            error_log('Parameters: ' . json_encode($params));
            error_log('Exception: ' . $e->getMessage());

            // Re-throw the exception to handle it at a higher level
            throw $e;
        }
    }

    protected function fetchAll($sql, $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function fetch($sql, $params = []): array|false
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function execute($sql, $params = []): int
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
}
