<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/forgot.css?v=<?= time(); ?>">
</head>

<body>
    <!-- Alert messages (hidden by default) -->
    <div class="alert alert-success" id="successAlert"></div>
    <div class="alert alert-error" id="errorAlert"></div>

    <!-- Your existing backend code structure (unchanged) -->
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="<?= URLROOT ?>/auth/forgotPassword" method="POST" id="forgotPasswordForm">
            <div class="form-group">
                <label for="email">Enter your email address:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-2" id="submitBtn">
                <span class="btn-text">Send Reset Link</span>
                <div class="loading">
                    <div class="spinner"></div>
                </div>
            </button>
        </form>

        <p class="mt-3">
            <a href="<?= URLROOT ?>/pages/signin">Back to Sign In</a>
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('forgotPasswordForm');
            const submitBtn = document.getElementById('submitBtn');
            const emailInput = document.getElementById('email');
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');

            // Email validation
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Show alert message
            function showAlert(type, message) {
                const alert = type === 'success' ? successAlert : errorAlert;
                alert.textContent = message;
                alert.style.display = 'block';

                // Hide after 5 seconds
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            }

            // Hide alerts
            function hideAlerts() {
                successAlert.style.display = 'none';
                errorAlert.style.display = 'none';
            }

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                hideAlerts();

                const email = emailInput.value.trim();

                // Client-side validation
                if (!email) {
                    e.preventDefault();
                    showAlert('error', 'Please enter your email address.');
                    emailInput.focus();
                    return;
                }

                if (!validateEmail(email)) {
                    e.preventDefault();
                    showAlert('error', 'Please enter a valid email address.');
                    emailInput.focus();
                    return;
                }

                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                // Note: The form will submit normally to your backend
                // The loading state will be visible until page redirect/reload
            });

            // Real-time email validation feedback
            emailInput.addEventListener('input', function() {
                const email = this.value.trim();
                hideAlerts();

                if (email && !validateEmail(email)) {
                    this.style.borderColor = '#f56565';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });

            // Reset loading state if form submission is prevented
            emailInput.addEventListener('focus', function() {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            });

            // Handle form reset
            form.addEventListener('reset', function() {
                hideAlerts();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                emailInput.style.borderColor = '#e2e8f0';
            });

            // Keyboard accessibility
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideAlerts();
                }
            });
        });
    </script>
</body>

</html>