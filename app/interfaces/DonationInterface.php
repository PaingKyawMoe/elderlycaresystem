<?php

namespace App\Interfaces;



interface DonationInterfaces
{
    public function save();
    public function updateStatus($donationId, $status);
}
