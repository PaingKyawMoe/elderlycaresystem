<?php
require_once __DIR__ . '/../interfaces/EmployeeRepositoryInterface.php';
require_once __DIR__ . '/../libraries/Database.php';

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private Database $db;
    private string $table = 'employees';

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(): array
    {
        return $this->db->readAll($this->table);
    }

    public function getById(int $id): ?array
    {
        $result = $this->db->getById($this->table, $id);
        return $result ?: null;
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        $record = $this->db->columnFilter(
            $this->table,
            'email',
            $email,
            $excludeId !== null ? 'id' : null,
            $excludeId
        );
        return !empty($record);
    }


    public function delete(int $id): bool
    {
        return $this->db->delete($this->table, $id);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->update($this->table, $id, $data);
    }

    public function create(array $data): bool
    {
        return (bool) $this->db->create($this->table, $data);
    }
}
