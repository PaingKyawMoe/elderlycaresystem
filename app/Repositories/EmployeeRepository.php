<?php

require_once __DIR__ . '/../interfaces/EmployeeRepositoryInterface.php';

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(): array
    {
        return $this->db->readAll('employees');
    }

    public function getById(int $id): ?array
    {
        return $this->db->getById('employees', $id);
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        $sql = "SELECT COUNT(*) FROM employees WHERE email = :email";
        $params = ['email' => $email];

        if ($excludeId) {
            $sql .= " AND id != :excludeId";
            $params['excludeId'] = $excludeId;
        }

        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn() > 0;
    }


    public function create(array $data): bool
    {
        return $this->db->create('employees', $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->update('employees', $id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->delete('employees', $id);
    }
}
