<?php

class Users extends Controller
{
    private $db;
    private $userModel;

    public function __construct()
    {
        $this->db = new Database();
        $this->userModel = $this->model('UserModel'); // Use the built-in model() loader
    }

    // Show dashboard + user list
    public function index()
    {
        $users = $this->userModel->getAllUsers();
        $this->view('admin/user_list', ['users' => $users]);
        $this->view('pages/dash');
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
            // For direct GET access (optional fallback)
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

            $emailExist = $this->db->columnFilter('users', 'email', $email);
            if ($emailExist) {
                setMessage('error_email', 'This email is already registered !');
                redirect('pages/register');
            }

            $validation = new UserValidator($_POST);
            $data = $validation->validateForm();

            if (count($data) > 0) {
                $this->view('pages/signup', $data);
            }

            $this->userModel->setName($name);
            $this->userModel->setEmail($email);
            $this->userModel->setPassword(password_hash($password, PASSWORD_DEFAULT));
//paingkyawmoe
            $userData = $this->userModel->toArray();

            // Save to DB
            $result = $this->db->create('users', $userData);

            if (!$result) {
                echo "Something went wrong.";
            }
            $this->view('pages/dash');
        }
    }
}
