<?php

// namespace App\interface;

interface DonationModelInterface
{
    public function save();
    public function readAll();
    public function updateStatus($donationId, $status);
}

interface DonationsControllerInterface
{
    public function donationDash();
    public function updateStatus();
    public function donate();
}
