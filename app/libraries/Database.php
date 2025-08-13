<?php

require_once __DIR__ . '/../interfaces/DatabaseInterface.php';

class Database implements DatabaseInterface
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdo;
    private $stmt;
    // private $error;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("DB Connection Failed: " . $e->getMessage());
        }
    }

    // Generic Query Execution
    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {
        if ($type === null) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR
            };
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function callProcedure($procedureName, $params = []): array
    {
        try {
            $placeholders = implode(',', array_fill(0, count($params), '?'));
            $sql = "CALL {$procedureName}($placeholders)";
            $stmt = $this->pdo->prepare($sql);

            foreach (array_values($params) as $index => $value) {
                $stmt->bindValue($index + 1, $value);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Stored Procedure Error: " . $e->getMessage());
            return [];
        }
    }


    // CRUD Operations
    public function create($table, $data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }
            return $stmt->execute() ? $this->pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function update($table, $id, $data): bool
    {
        unset($data['id']);
        try {
            $setPart = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($data)));
            $sql = "UPDATE {$table} SET {$setPart} WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $data['id'] = $id;
            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete($table, $id): bool
    {
        try {
            $sql = "DELETE FROM {$table} WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function readAll($table): array
    {
        try {
            $sql = "SELECT * FROM {$table}";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); // Return associative arrays
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getById($table, $id)
    {
        try {
            $sql = "SELECT * FROM {$table} WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getByEmail($table, $email)
    {
        try {
            $sql = "SELECT * FROM {$table} WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    // Authentication
    public function loginCheck($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function columnFilter(string $table, string $column, $value, ?string $excludeColumn = null, $excludeValue = null)
    {
        try {
            $sql = "SELECT * FROM {$table} WHERE {$column} = :value";

            if ($excludeColumn !== null && $excludeValue !== null) {
                $sql .= " AND {$excludeColumn} != :excludeValue";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':value', $value);

            if ($excludeColumn !== null && $excludeValue !== null) {
                $stmt->bindValue(':excludeValue', $excludeValue);
            }

            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function multiColumnFilter(string $table, array $criteria): ?array
    {
        try {
            $columns = array_keys($criteria);
            $conditions = implode(' AND ', array_map(fn($col) => "$col = :$col", $columns));
            $sql = "SELECT * FROM {$table} WHERE {$conditions} LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            foreach ($criteria as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
    public function getPdo(): PDO
    {
        return $this->pdo;
    }



    // public function resultSet()
    // {
    //     $this->execute();
    //     return $this->stmt->fetchAll();
    // }

    // public function rowCount()
    // {
    //     return $this->stmt->rowCount();
    // }

    // public function verify($id)
    // {
    //     try {
    //         $sql = "UPDATE users SET is_confirmed = 1 WHERE id = :id";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindValue(':id', $id);
    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         error_log($e->getMessage());
    //         return false;
    //     }
    // }

    // private function sumQuery($sql)
    // {
    //     try {
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetch();
    //     } catch (PDOException $e) {
    //         error_log($e->getMessage());
    //         return [];
    //     }
    // }
}
