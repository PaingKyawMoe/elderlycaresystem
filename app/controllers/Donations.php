<?php
// app/controllers/Donations.php

require_once __DIR__ . '/../interfaces/DonationServiceInterface.php';

class Donations extends Controller
{
    private DonationServiceInterface $donationService;

    public function __construct(DonationServiceInterface $donationService)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'httponly' => true,
                'samesite' => 'Lax',  // CSRF is correct or not
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
            ]);
            session_start();
        }
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

        $headers = getallheaders();
        if (!isset($headers['X-CSRF-Token']) || $headers['X-CSRF-Token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $donationId = $input['donation_id'] ?? null;
        $status = strip_tags($input['status'] ?? ''); // prevent XSS

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            // CSRF validation
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                http_response_code(403);
                die("Invalid CSRF token");
            }

            // Collect form data
            $donationData = [
                'full_name'      => $_POST['fullName'] ?? '',
                'email'          => $_POST['email'] ?? '',
                'phone'          => $_POST['phone'] ?? '',
                'amount'         => $_POST['amount'] ?? $_POST['customAmount'] ?? 0,
                'payment_method' => $_POST['paymentMethod'] ?? ''
            ];

            // Use the service to save to database
            $this->donationService->createDonation($donationData);

            // Redirect or show success
            header('Location: ' . URLROOT . '/pages/donate?success=true');
            exit;
        }

        // If GET, show form
        $this->view('pages/donate');
    }
}
