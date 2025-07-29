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
        //  echo "Hello Bo Kaw";
        //  exit;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = base64_encode($_POST['password']);
                $isLogin = $this->db->loginCheck($email, $password);
                // var_dump($isLogin);
                // exit;

                if ($isLogin) {
                    $checkData = $this->db->getById('users', $isLogin['id']);
                    if ($checkData['role_id'] == Admin) {
                        redirect('pages/Info');
                    }
                    redirect('pages/dashboard');
                } else {
                    setMessage('error', 'Login Fail!');
                    redirect('pages/signin');
                }
            }
        }
    }


    function logout($id)
    {
        // session_start();
        // $this->db->unsetLogin(base64_decode($_SESSION['id']));

        //$this->db->unsetLogin($this->auth->getAuthId());
        $this->db->unsetLogin($id);
        // session_start();
        // session_destroy();
        redirect('pages/dashboard');
    }
}
