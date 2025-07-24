<?php

class DonationModel
{
    private $db;
    private $id;
    private $full_name;
    private $email;
    private $phone;
    private $amount;
    private $payment_method;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setphone($phone)
    {
        $this->phone = $phone;
    }

    public function getphone()
    {
        return $this->phone;
    }

    public function setamount($amount)
    {
        $this->amount = $amount;
    }

    public function getamount()
    {
        return $this->amount;
    }

    public function setpayment_method($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    public function getpayment_method()
    {
        return $this->payment_method;
    }

    public function toArray()
    {
        return [
            'id'    => $this->getId(),
            'full_name'   => $this->getFullName(),
            'email'  => $this->getEmail(),
            'phone'   => $this->getphone(),
            'amount'   => $this->getamount(),
            'payment_method'   => $this->getpayment_method()
        ];
    }
}
