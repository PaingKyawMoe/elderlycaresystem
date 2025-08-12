<?php

interface EmployeeRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?array;
    public function emailExists(string $email, ?int $excludeId = null): bool;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
