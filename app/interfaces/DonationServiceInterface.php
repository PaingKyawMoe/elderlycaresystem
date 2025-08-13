<?php
// app/interfaces/DonationServiceInterface.php

interface DonationServiceInterface
{
    public function getAllDonations(): array;
    public function updateDonationStatus(int $donationId, string $status): bool;
    public function createDonation(array $data): bool;
}
