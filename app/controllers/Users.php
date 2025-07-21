<?php

class Users extends Controller
{
    private $db;
    
    public function __construct()
    {
        $this->model('UserModel');
    
        $this->db = new Database();
    }

    public function index()
    {
        $userModel = new UserModel();
         $users = $userModel->getAllUsers(); // get users from model

        $this->view('admin/user_list', ['users' => $users]); // send to view
        $this->view('pages/dash');
        // Or: $this->view('pages/users');
    }
    
public function userlist()
{
    $userModel = new UserModel();
    $users = $userModel->getAllUsers();

    $this->view('pages/userlist', ['users' => $users]);
}





    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 1. POST မှ data ယူမယ်
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // 2. UserModelModel object create
            $user = new UserModel();
            $user->setName($name);
            $user->setEmail($email);
            $user->setpassword(password_hash($password, PASSWORD_DEFAULT));

            
            $userData = $user->toArray();

           
            // unset($userData['id']);

            // 4. Database insert
            $result = $this->db->create('users', $userData);

            if ($result) {
                $this->view('pages/dash');
                // redirect('login'); // MVC helper method
            } else {
                echo "Something went wrong.";
            }
        } else {
            // GET request – show register form
            $this->view('users/register');
        }
        
    }

}


?>