<?php
// app/services/DonationService.php

require_once __DIR__ . '/../interfaces/DonationServiceInterface.php';
require_once __DIR__ . '/../interfaces/DonationRepositoryInterface.php';

class DonationService implements DonationServiceInterface
{
    private DonationRepositoryInterface $donationRepository;

    public function __construct(DonationRepositoryInterface $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    public function getAllDonations(): array
    {
        return $this->donationRepository->readAll();
    }

    public function updateDonationStatus(int $donationId, string $status): bool
    {
        $allowedStatuses = ['complete', 'pending', 'not'];
        if (!in_array($status, $allowedStatuses, true)) {
            throw new InvalidArgumentException('Invalid status');
        }
        return $this->donationRepository->updateStatus($donationId, $status);
    }

    public function createDonation(array $data): bool
    {
        $data = [
            'full_name'      => $data['full_name'] ?? '',
            'email'          => $data['email'] ?? '',
            'phone'          => $data['phone'] ?? '',
            'amount'         => $data['amount'] ?? 0,
            'payment_method' => $data['payment_method'] ?? '',
            'status'         => 'pending'
        ];
        return $this->donationRepository->save($data);
    }
}
