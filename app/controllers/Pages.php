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
