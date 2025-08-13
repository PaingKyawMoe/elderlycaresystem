<?php
// app/controllers/Donations.php

require_once __DIR__ . '/../interfaces/DonationServiceInterface.php';

class Donations extends Controller
{
    private DonationServiceInterface $donationService;

    public function __construct(DonationServiceInterface $donationService)
    {
        $this->donationService = $donationService;
    }

    public function donationDash()
    {
        $donations = $this->donationService->getAllDonations();
        $this->view('pages/donationdashboard', ['Donation' => $donations]);
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $donationId = $input['donation_id'] ?? null;
        $status = $input['status'] ?? null;

        try {
            $success = $this->donationService->updateDonationStatus($donationId, $status);
            echo json_encode($success
                ? ['success' => true]
                : ['success' => false, 'message' => 'Database update failed']);
        } catch (InvalidArgumentException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function donate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('donation/form');
            return;
        }

        $data = [
            'full_name'      => $_POST['fullName'] ?? '',
            'email'          => $_POST['email'] ?? '',
            'phone'          => $_POST['phone'] ?? '',
            'amount'         => ($_POST['amount'] ?? '') === 'custom'
                ? ($_POST['customAmount'] ?? '')
                : ($_POST['amount'] ?? ''),
            'payment_method' => $_POST['paymentMethod'] ?? ''
        ];

        $saved = $this->donationService->createDonation($data);

        if ($saved) {
            redirect('donation/form');
        } else {
            setMessage('error', 'Something went wrong.');
        }
        redirect('donation/form');
    }
}
