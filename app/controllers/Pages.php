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
        $this->view('pages/home');
    }

    public function admin()
    {
        $this->view('Users/userlist');
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
        $this->view('pages/activities');
    }
    public function personal()
    {
        $this->view('pages/personaldetail');
    }

    public function search()
    {
        $this->view('pages/searchappointment');
    }

    public function adminActivities()
    {
        $this->view('pages/adminactivities');
    }
    public function employee()
    {
        $this->view('pages/employee');
    }

    public function donationDash()
    {
        $donationData = $this->db->readAll('donations');
        // $total = $this->db->getDonationTotal();
        $data = [
            'donationData' => $donationData
            // 'total_amount' => $total['total_amount']
        ];
        $this->view('pages/donationdashboard', $data);
    }

    public function Info()
    {
        $appointmentData = $this->db->readAll('appointments');
        $data = [
            'appointmentData' => $appointmentData
        ];

        $this->view('pages/appointmentInfo', $data);
    }
}
