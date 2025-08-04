<?php

require_once 'BaseModel.php';

class DonationModel extends BaseModel
{
    public function save()
    {
        $this->db->query("INSERT INTO donations (full_name, email, phone, amount, payment_method) 
                          VALUES (:full_name, :email, :phone, :amount, :payment_method)");

        $this->db->bind(':full_name', $this->full_name);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':phone', $this->phone);
        $this->db->bind(':amount', $this->amount);
        $this->db->bind(':payment_method', $this->payment_method);

        return $this->db->execute();
    }

    public function updateStatus($donationId, $status)
    {
        $this->db->query('UPDATE donations SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $donationId);
        return $this->db->execute();
    }
}
