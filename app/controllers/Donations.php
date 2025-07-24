<?php

class Donations extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('DonationModel');
        $this->db = new Database();
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

            // Create model object
            $donation = new DonationModel();
            $donation->setFullName($full_name);
            $donation->setemail($email);
            $donation->setphone($phone);
            $donation->setamount($amount);
            $donation->setpayment_method($paymentMethod);

            $data = $donation->toArray();

            // var_dump($data);  // <-- This will print the data array to the browser
            // exit;

            $saved = $this->db->create('donations', $data);

            if ($saved) {
                // setMessage('success', 'Donation submitted!');
                redirect('pages/dashboard');
            } else {
                setMessage('error', 'Something went wrong.');
                redirect('donation/form');
            }
        } else {
            redirect('donation/form');
        }
    }
}
