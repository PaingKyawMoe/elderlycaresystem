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
        $this->view('pages/activities');
    }

    public function search()
    {
        $this->view('pages/searchappointment');
    }

    public function adminActivities()
    {
        $this->view('pages/adminactivities');
    }

    public function emplist()
    {
        $this->view('pages/emplist');
    }

    public function employee()
    {
        $this->view('pages/employee');
    }
}
