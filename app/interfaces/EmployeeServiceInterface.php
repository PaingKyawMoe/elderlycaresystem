<?php

interface EmployeeServiceInterface
{
    public function getAllEmployees(): array;
    public function getEmployeeById(int $id): ?array;
    public function checkEmailExists(string $email, ?int $excludeId = null): bool;
    public function deleteEmployee(int $id): bool;
    public function updateEmployee(int $id, array $data): bool;
    public function createEmployee(array $data): bool;
}
