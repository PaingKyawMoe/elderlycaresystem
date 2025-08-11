<?php
require_once __DIR__ . '/../repositories/EmployeeRepository.php';
// require_once __DIR__ . '/../interfaces/EmployeeRepositoryInterface.php';

class EmployeeService
{
    private EmployeeRepositoryInterface $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllEmployees(): array
    {
        return $this->repository->getAll();
    }

    public function getEmployeeById(int $id): ?array
    {
        return $this->repository->getById($id);
    }

    public function checkEmailExists(string $email, ?int $excludeId = null): bool
    {
        return $this->repository->emailExists($email, $excludeId);
    }


    public function deleteEmployee(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function updateEmployee(int $id, array $data): bool
    {
        // Validate required fields
        $required = ['name', 'email', 'phone', 'address', 'role'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new InvalidArgumentException("$field is required.");
            }
        }

        // Check email uniqueness
        if ($this->checkEmailExists($data['email'], $id)) {
            throw new InvalidArgumentException("Email already exists.");
        }

        return $this->repository->update($id, $data);
    }

    public function createEmployee(array $data): bool
    {
        $required = ['name', 'email', 'phone', 'address', 'role'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new InvalidArgumentException("$field is required.");
            }
        }

        if ($this->checkEmailExists($data['email'])) {
            throw new InvalidArgumentException("Email already exists.");
        }

        return $this->repository->create($data);
    }
}
