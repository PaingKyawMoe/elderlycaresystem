<?php

class Auth extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('UserModel');
        $this->db = new Database();
        $this->model('AppointmentModel');
    }

    public function formRegister()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['email_check']) &&
            $_POST['email_check'] == 1
        ) {
            $email = $_POST['email'];
            // call columnFilter Method from Database.php
            $isUserExist = $this->db->columnFilter('users', 'email', $email);
            if ($isUserExist) {
                echo 'Sorry! email has already taken. Please try another.';
            }
        }
    }

    // public function verify($token)
    // {
    //     $user = $this->db->columnFilter('users', 'token', $token);

    //     if ($user) {
    //         $success = $this->db->verify($user[0]['id']);

    //         if ($success) {
    //             setMessage(
    //                 'success',
    //                 'Successfully Verified . Please log in !'
    //             );
    //         } else {
    //             setMessage('error', 'Fail to Verify . Please try again!');
    //         }
    //     } else {
    //         setMessage('error', 'Incrorrect Token . Please try again!');
    //     }

    //     redirect('');
    // }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form input
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                setMessage('error', 'Please enter both email and password.');
                redirect('pages/signin');
            }

            // Fetch user by email from database
            $user = $this->db->getByEmail('users', $email);

            // Check if user exists and verify password
            if ($user && password_verify($password, $user['password'])) {
                // Store user info in session
                $_SESSION['user'] = $user;
                $_SESSION['user_role'] = $user['role_id'];

                // Redirect based on role
                if ($user['role_id'] == Admin) {
                    redirect('Appointment/list'); // Admin dashboard
                } else {
                    redirect('pages/dashboard'); // User dashboard
                }
            } else {
                // Invalid login
                setMessage('error', 'Login failed! Invalid email or password.');
                redirect('pages/signin');
            }
        } else {
            // If accessed directly via GET, redirect to sign-in page
            redirect('pages/signin');
        }
    }




    // function logout($id)
    // {
    //     session_start();
    //     $this->db->unsetLogin(base64_decode($_SESSION['id']));

    //     $this->db->unsetLogin($this->auth->getAuthId());
    //     $this->db->unsetLogin($id);
    //     session_start();
    //     session_destroy();
    //     redirect('pages/dashboard');
    // }
}
