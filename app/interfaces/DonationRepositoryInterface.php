<?php

namespace App\Interfaces;



interface DonationRepositoryInterface
{
    public function save();
    public function updateStatus($donationId, $status);
}
