<?php
require_once __DIR__ . '/../libraries/Mail.php';
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
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match.";
                $this->view('pages/signup');
                return;
            }

            if ($this->db->columnFilter('users', 'email', $email)) {
                $_SESSION['error'] = "Email already registered.";
                $this->view('pages/signup');
                return;
            }

            $otp = rand(100000, 999999);
            $expires = date('Y-m-d H:i:s', time() + 600); // 10 min

            $this->userModel->name = $name;
            $this->userModel->email = $email;
            $this->userModel->roleid = User;
            $this->userModel->password = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->otp_code = $otp;
            $this->userModel->otp_expires = $expires;
            $this->userModel->status = 'pending';

            if ($this->userModel->save()) {
                $mailer = new Mail();
                $verifyLink = URLROOT . "/users/verifyEmail?email=" . urlencode($email) . "&otp=$otp";
                $mailer->sendVerifyMail($email, $name, $otp, $verifyLink);

                // $_SESSION['success'] = "Registration successful! Please check your email to verify.";
                redirect('pages/verifyOtp');
            } else {
                // $_SESSION['error'] = "Something went wrong.";
                $this->view('pages/signup');
            }
        } else {
            $this->view('pages/signup');
        }
    }

    // --- Email verification ---
    public function verifyEmail()
    {
        $email = $_GET['email'] ?? '';
        $otp = $_GET['otp'] ?? '';

        $user = $this->db->multiColumnFilter('users', [
            'email' => $email,
            'otp_code' => $otp
        ]);

        if ($user && strtotime($user['otp_expires']) > time()) {
            if ($this->db->verify($user['id'])) {
                $this->db->update('users', $user['id'], [
                    'otp_code' => null,
                    'otp_expires' => null
                ]);
                $_SESSION['success'] = "Email verified! You can login now.";
            } else {
                $_SESSION['error'] = "Failed to verify. Try again later.";
            }
        } else {
            $_SESSION['error'] = "Invalid or expired verification link.";
        }

        redirect('pages/signin');
    }

    // --- OTP verification (manual) ---
    public function verifyOtp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $otp = $_POST['otp'] ?? '';

            $user = $this->db->multiColumnFilter('users', [
                'email' => $email,
                'otp_code' => $otp
            ]);

            if ($user && strtotime($user['otp_expires']) > time()) {
                if ($this->db->verify($user['id'])) {
                    $this->db->update('users', $user['id'], [
                        'otp_code' => null,
                        'otp_expires' => null
                    ]);
                    $_SESSION['success'] = "Account verified successfully!";
                } else {
                    $_SESSION['error'] = "Failed to verify. Try again later.";
                }
            } else {
                $_SESSION['error'] = "Invalid or expired OTP.";
            }

            redirect('pages/signin');
        }
    }
}
