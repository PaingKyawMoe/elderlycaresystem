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

    public function Info()  
    {
        $appointmentData = $this->db->readAll('appointments');
        $data = [
            'appointmentData' => $appointmentData
        ];

        $this->view('pages/appointmentInfo', $data);
    }

    public function personal()
    {
        $this->view('pages/personaldetail');
    }
}
