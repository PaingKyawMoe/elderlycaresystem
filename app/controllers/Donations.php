<?php

class Donations extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('DonationModel');
        $this->db = new Database();
    }


    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            $donationId = $input['donation_id'];
            $status = $input['status'];
            $allowedStatuses = ['complete', 'pending', 'not'];
            if (!in_array($status, $allowedStatuses)) {
                echo json_encode(['success' => false, 'message' => 'Invalid status']);
                return;
            }

            $db = new Database();

            $updateData = ['status' => $status];

            if ($db->update('donations', $donationId, $updateData)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database update failed']);
            }
        }
    }

    public function donate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $full_name = $_POST['fullName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $amount = $_POST['amount'] ?? '';

            if ($amount === 'custom') {
                $amount = $_POST['customAmount'] ?? '';
            }

            $paymentMethod = $_POST['paymentMethod'] ?? '';


            $donation = new DonationModel([
                'full_name' => $full_name,
                'email' => $email,
                'phone' => $phone,
                'amount' => $amount,
                'payment_method' => $paymentMethod
            ]);


            $saved = $donation->save();

            if ($saved) {

                setMessage('success', 'Successful Payment.');
                redirect('donation/form');
            } else {
                setMessage('error', 'Something went wrong.');
                redirect('donation/form');
            }
        } else {
            redirect('donation/form');
        }
    }
}
