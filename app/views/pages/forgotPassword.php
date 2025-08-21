<div class="container">
    <h2>Forgot Password</h2>
    <form action="<?= URLROOT ?>/auth/forgotPassword" method="POST">
        <div class="form-group">
            <label for="email">Enter your email address:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Send Reset Link</button>
    </form>

    <p class="mt-3">
        <a href="<?= URLROOT ?>/pages/signin">Back to Sign In</a>
    </p>
</div>