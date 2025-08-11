<?php

interface AppointmentRepositoryInterface
{
    public function getAll(): array;
    public function findByNameDobPhone(string $name, string $dob, string $phone): ?array;
    public function create(array $data): int|bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
