<div class="container">
    <h2>Reset Password</h2>
    <form action="<?= URLROOT ?>/auth/resetPassword?token=<?= htmlspecialchars($data['token']); ?>" method="POST">
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
    </form>

    <p class="mt-3">
        <a href="<?= URLROOT ?>/pages/signin">Back to Sign In</a>
    </p>
</div>