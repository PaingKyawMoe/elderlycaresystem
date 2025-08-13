<?php
// app/repositories/DonationRepository.php

require_once __DIR__ . '/../interfaces/DonationRepositoryInterface.php';
require_once __DIR__ . '/../interfaces/DatabaseInterface.php';

class DonationRepository implements DonationRepositoryInterface
{
    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function readAll(): array
    {
        return $this->db->readAll('donations');
    }

    public function updateStatus(int $donationId, string $status): bool
    {
        $updateData = ['status' => $status];
        return $this->db->update('donations', $donationId, $updateData);
    }

    public function save(array $data): bool
    {
        return $this->db->create('donations', $data) !== false;
    }
}
