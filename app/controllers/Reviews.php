<?php

class Reviews extends Controller
{
    private $reviewModel;

    public function __construct()
    {
        $this->reviewModel = $this->model('ReviewModel');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user']['id'],
                'comment' => trim($_POST['comment']),
                'rating'  => $_POST['rating']
            ];

            if ($this->reviewModel->addReview($data)) {
                redirect('pages/home'); // after review, go back home
            }
        }
    }
}
