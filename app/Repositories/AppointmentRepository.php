<?php
// app/repositories/AppointmentRepository.php

require_once __DIR__ . '/../interfaces/AppointmentRepositoryInterface.php';
require_once __DIR__ . '/../models/AppointmentModel.php';
// require_once __DIR__ . '/../libraries/Database.php';

class AppointmentRepository implements AppointmentRepositoryInterface
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(): array
    {
        return $this->db->readAll('appointments');
    }

    public function findByNameDobPhone(string $name, string $dob, string $phone): ?array
    {
        return $this->db->multiColumnFilter('appointments', [
            'name' => $name,
            'dob' => $dob,
            'phone' => $phone,
        ]);
    }


    public function create(array $data): int|bool
    {
        return $this->db->create('appointments', $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->update('appointments', $id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->delete('appointments', $id);
    }
}
