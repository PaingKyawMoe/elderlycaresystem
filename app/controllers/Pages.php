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

    public function admin(){
        $this->view('pages/userlist');
    }
    
    public function dashboard(){
        $this->view('pages/dashboard');
    }

    public function appointmentForm(){
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
}
