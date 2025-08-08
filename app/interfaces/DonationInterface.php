<?php

namespace App\Interfaces;

interface DonationInterface
{
    public function save();
    public function readAll();
    public function updateStatus($donationId, $status);
}
