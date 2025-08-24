<form method="POST" action="<?= URLROOT ?>/users/verifyOtp">
    <input type="email" name="email" placeholder="Enter email" required>
    <input type="text" name="otp" placeholder="Enter OTP" required>
    <button type="submit">Verify</button>
</form>