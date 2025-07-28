<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdo;
    private $stmt;
    private $error;

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

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function rowCount()
    {
        return $this->stmt->rowCount();
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

    public function update($table, $id, $data)
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

    // Add this method to your Database class
    // public function updateDonationStatus($donationId, $status)
    // {
    //     try {
    //         $sql = "UPDATE donations SET status = :status WHERE id = :id";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindValue(':status', $status);
    //         $stmt->bindValue(':id', $donationId);
    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         error_log($e->getMessage());
    //         return false;
    //     }
    // }

    public function delete($table, $id)
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

    public function readAll($table)
    {
        try {
            $sql = "SELECT * FROM {$table}";
            return $this->pdo->query($sql)->fetchAll();
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

    // public function getDonationTotal()
    // {
    //     try {
    //         $sql = "SELECT SUM(amount) AS total_amount FROM donations";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetch(); // returns ['total_amount' => value]
    //     } catch (PDOException $e) {
    //         error_log($e->getMessage());
    //         return ['total_amount' => 0];
    //     }
    // }


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

    public function columnFilter($table, $column, $value)
    {
        try {
            $sql = "SELECT * FROM {$table} WHERE {$column} = :value";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':value', $value);
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

    public function setLogin($id)
    {
        return $this->toggleLoginState($id, 1);
    }

    public function unsetLogin($id)
    {
        return $this->toggleLoginState($id, 0);
    }

    private function toggleLoginState($id, $state)
    {
        try {
            $sql = "UPDATE users SET is_login = :state WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':state', $state);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function verify($id)
    {
        try {
            $sql = "UPDATE users SET is_confirmed = 1 WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Dashboard Stats
    public function incomeTransition()
    {
        return $this->sumQuery("SELECT *, SUM(amount) AS amount FROM incomes WHERE date = CURDATE()");
    }

    public function expenseTransition()
    {
        return $this->sumQuery("SELECT *, SUM(amount * qty) AS amount FROM expenses WHERE date = CURDATE()");
    }

    private function sumQuery($sql)
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getByCategoryId($table, $name)
    {
        try {
            $sql = "SELECT * FROM {$table} WHERE name = :name";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
