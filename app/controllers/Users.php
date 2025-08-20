<?php

require_once __DIR__ . '/../interfaces/UserModelInterface.php';
require_once __DIR__ . '/../models/UserModel.php';

class Users extends Controller
{
    private $db;
    private UserModelInterface $userModel;
    public function __construct()
    {
        $this->db = new Database();
        $this->userModel = $this->model('UserModel');
    }

    // Show user list only
    public function userlist()
    {
        $users = $this->userModel->getAllUsers();
        $this->view('pages/userlist', ['users' => $users]);
    }

    // Delete user by ID
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->userModel->deleteUser($id);

            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete user.']);
            }
        } else {

            header("Location: " . URLROOT . "/users/userlist");
            exit;
        }
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents("php://input"), true);

            if ($this->userModel->updateUser($input)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Update failed']);
            }
        } else {
            header("Location: " . URLROOT . "/users/userlist");
            exit;
        }
    }






    // Register a new user
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // session_start(); // for messages

            // --- Step 1: Get reCAPTCHA response ---
            $recaptcha_secret = "6LfTA6srAAAAACzlTnGsNzUvhK2ib6g2vd6b-JQY";
            $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

            if (empty($recaptcha_response)) {
                $_SESSION['error_captcha'] = "Please verify that you are not a robot.";
                $this->view('pages/signup');
                return;
            }

            // --- Step 2: Verify with Google ---
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'secret' => $recaptcha_secret,
                'response' => $recaptcha_response
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $verify = curl_exec($ch);
            curl_close($ch);

            $response_data = json_decode($verify);

            if (!$response_data || !isset($response_data->success) || !$response_data->success) {
                $_SESSION['error_captcha'] = "Captcha verification failed.";
                $this->view('pages/signup');
                return;
            }

            // --- Step 3: Validate form fields ---
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($password !== $confirmPassword) {
                $data['password-doesnotmatch'] = 'Passwords do not match.';
                $this->view('pages/signup', $data);
                return;
            }

            if ($this->db->columnFilter('users', 'email', $email)) {
                $_SESSION['error_email'] = "This email is already registered!";
                $this->view('pages/signup');
                return;
            }

            $validation = new UserValidator($_POST);
            $data = $validation->validateForm();
            if (count($data) > 0) {
                $this->view('pages/signup', $data);
                return;
            }

            // --- Step 4: Save user ---
            $this->userModel->name = $name;
            $this->userModel->email = $email;
            $this->userModel->roleid = User;
            $this->userModel->password = password_hash($password, PASSWORD_DEFAULT);

            if ($this->userModel->save()) {
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;

                redirect('pages/dashboard');
            } else {
                $_SESSION['error'] = "Something went wrong.";
                $this->view('pages/signup');
            }
        } else {
            $this->view('pages/signup');
        }
    }
}
