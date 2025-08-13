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




    // Register a new user
    public function register()
    {
        // var_dump('paing');
        // exit;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($password !== $confirmPassword) {
                $data['password-doesnotmatch'] = 'Passwords do not match.';
                $this->view('pages/signup', $data);
                return;
            }
            // var_dump('paing');
            // exit;

            $emailExist = $this->db->columnFilter('users', 'email', $email);
            if ($emailExist) {
                // var_dump('paing');
                // exit;
                setMessage('error_email', 'This email is already registered !');
                redirect('pages/register');
                return;
            }
            // var_dump('paing');
            // exit;

            $validation = new UserValidator($_POST);
            $data = $validation->validateForm();

            if (count($data) > 0) {
                $this->view('pages/signup', $data);
                return;
            }

            $this->userModel->name = $_POST['name'];
            $this->userModel->email = $_POST['email'];
            $this->userModel->roleid = User; // Not setRoleid()
            $this->userModel->password = password_hash($password, PASSWORD_DEFAULT);
            // Not setPassword()
            // $userData = $this->userModel->toArray();
            // $userData = new UserModel($data);

            // $appointment = new AppointmentModel($data);
            // Save to DB
            // $result = $this->db->create('users', $userData->toArray());
            // var_dump('paing');
            // die;
            $result = $this->userModel->save();
            if (!$result) {
                echo "Something went wrong.";
                return;
            }
            $this->view('pages/dash');
        }
    }
}
