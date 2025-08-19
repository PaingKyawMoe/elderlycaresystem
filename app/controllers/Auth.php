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
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $ip = $_SERVER['REMOTE_ADDR'];

            if (empty($email) || empty($password)) {
                setMessage('error', 'Please enter both email and password.');
                redirect('pages/signin');
            }

            // --- Initialize session login attempts ---
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = [];
            }

            if (!isset($_SESSION['login_attempts'][$ip])) {
                $_SESSION['login_attempts'][$ip] = [
                    'count' => 0,
                    'first_attempt' => time(),
                    'blocked_until' => null
                ];
            }

            $attempt = &$_SESSION['login_attempts'][$ip];

            // --- Check if IP is blocked ---
            if ($attempt['blocked_until'] && $attempt['blocked_until'] > time()) {
                $wait = $attempt['blocked_until'] - time();
                setMessage('error', "Too many login attempts. Try again after $wait seconds.");
                redirect('pages/signin');
            }

            // --- Reset window if older than 1 minute ---
            if (time() - $attempt['first_attempt'] > 60) {
                $attempt['count'] = 0;
                $attempt['first_attempt'] = time();
            }

            // --- Fetch user ---
            $user = $this->db->getByEmail('users', $email);

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['login_attempts'][$ip] = null;

                $_SESSION['user'] = $user;
                $_SESSION['user_role'] = $user['role_id'];

                if ($user['role_id'] == Admin) {
                    redirect('Appointment/list');
                } else {
                    redirect('pages/dashboard');
                }
            } else {

                $attempt['count']++;

                if ($attempt['count'] >= 5) {
                    $attempt['blocked_until'] = time() + 300; // block for 5 minutes
                    setMessage('error', "Too many login attempts. Your IP is blocked for 5 minutes.");
                } else {
                    setMessage('error', "Login failed! Invalid email or password.");
                }

                redirect('pages/signin');
            }
        } else {
            redirect('pages/signin');
        }
    }


    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Destroy session and redirect
        session_destroy();

        header("Location: " . URLROOT . "/pages/signin");
        exit;
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
