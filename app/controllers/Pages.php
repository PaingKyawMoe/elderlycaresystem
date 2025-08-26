<?php

class Pages extends Controller
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $reviewModel = $this->model('ReviewModel');
        $reviews = $reviewModel->getAllReviews();

        $data = [
            'reviews' => $reviews
        ];
        $this->view('pages/home', $data);;
    }
    public function forgotPassword()
    {
        $this->view('pages/forgotPassword');
    }
    public function resetPassword()
    {
        $this->view('pages/resetPassword');
    }
    public function verifyOtp()
    {
        $this->view('pages/verifyOtp');
    }

    public function dashboard()
    {
        $this->view('pages/dash');
    }

    public function appointmentForm()
    {
        $this->view('pages/appointmentform');
    }

    public function signin()
    {
        $this->view('pages/signin');
    }

    public function register()
    {
        $this->view('pages/signup');
    }

    public function about()
    {
        $this->view('pages/about');
    }

    public function donate()
    {
        $this->view('pages/donation');
    }

    public function activities()
    {
        redirect('Activities/index');
    }

    public function search()
    {
        $this->view('pages/searchappointment');
    }

    public function viewAppionment()
    {
        $appointmentData = $this->db->findByColumn('appointments', 'user_id', $_SESSION['user']['id']);
        $data = [
            'appointmentData' => $appointmentData
        ];
        $this->view('pages/viewappointment', $data);
    }

    public function viewactivities()
    {
        redirect('Activities/elderlyView');
    }

    public function emplist()
    {
        $this->view('pages/emplist');
    }

    public function employee()
    {
        $this->view('pages/employee');
    }

    public function donationInfo()
    {
        redirect('donations/donationDash');
    }

    public function appointmentInfo()
    {
        redirect('Appointment/list');
    }

    public function userInfo()
    {
        redirect('Users/userlist');
    }
}
