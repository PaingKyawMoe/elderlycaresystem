<?php

require_once __DIR__ . '/BaseModel.php';
class ReviewModel extends BaseModel
{
    protected $table = 'reviews';

    public function addReview($data)
    {
        $this->db->query("INSERT INTO reviews (user_id, comment, rating) VALUES (:user_id, :comment, :rating)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':rating', $data['rating']);
        return $this->db->execute();
    }

    public function getAllReviews()
    {
        $this->db->query("SELECT r.*, u.name FROM reviews r JOIN users u ON r.user_id = u.id ORDER BY r.created_at DESC");
        return $this->db->resultSet();
    }
}
