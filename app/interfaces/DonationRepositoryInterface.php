<?php
// app/interfaces/DonationRepositoryInterface.php

interface DonationRepositoryInterface
{
    public function readAll(): array;
    public function updateStatus(int $donationId, string $status): bool;
    public function save(array $data): bool;
}
