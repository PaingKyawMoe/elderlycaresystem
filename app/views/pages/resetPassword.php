<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/reset.css?v=<?= time(); ?>">
</head>

<body>
    <!-- Alert messages (hidden by default) -->
    <div class="alert alert-success" id="successAlert"></div>
    <div class="alert alert-error" id="errorAlert"></div>

    <!-- Your existing backend code structure (unchanged) -->
    <div class="container">
        <h2>Reset Password</h2>
        <form action="<?= URLROOT ?>/auth/resetPassword?token=<?= htmlspecialchars($data['token']); ?>" method="POST" id="resetPasswordForm">
            <div class="form-group">
                <label for="password">New Password:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password')" aria-label="Toggle password visibility">Show</button>
                </div>
                <div class="password-strength" id="passwordStrength">
                    <div class="password-strength-bar"></div>
                </div>
                <div class="password-strength-text" id="passwordStrengthText"></div>
            </div>

            <div class="form-group mt-2">
                <label for="confirm_password">Confirm New Password:</label>
                <div class="password-container">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')" aria-label="Toggle confirm password visibility">Show</button>
                </div>
                <div class="password-match" id="passwordMatch"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3" id="submitBtn">
                <span class="btn-text">Reset Password</span>
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
            const form = document.getElementById('resetPasswordForm');
            const submitBtn = document.getElementById('submitBtn');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            const passwordStrength = document.getElementById('passwordStrength');
            const passwordStrengthText = document.getElementById('passwordStrengthText');
            const passwordMatch = document.getElementById('passwordMatch');

            // Toggle password visibility
            window.togglePassword = function(fieldId) {
                const field = document.getElementById(fieldId);
                const button = field.nextElementSibling;

                if (field.type === 'password') {
                    field.type = 'text';
                    button.textContent = 'Hide';
                    button.setAttribute('aria-label', 'Hide password');
                } else {
                    field.type = 'password';
                    button.textContent = 'Show';
                    button.setAttribute('aria-label', 'Show password');
                }
            };

            // Password strength checker
            function checkPasswordStrength(password) {
                let score = 0;
                let feedback = '';

                if (password.length >= 8) score++;
                if (password.match(/[a-z]/)) score++;
                if (password.match(/[A-Z]/)) score++;
                if (password.match(/[0-9]/)) score++;
                if (password.match(/[^a-zA-Z0-9]/)) score++;

                passwordStrength.className = 'password-strength';

                if (score < 3) {
                    passwordStrength.classList.add('weak');
                    feedback = 'Weak password';
                } else if (score < 5) {
                    passwordStrength.classList.add('medium');
                    feedback = 'Medium strength';
                } else {
                    passwordStrength.classList.add('strong');
                    feedback = 'Strong password';
                }

                passwordStrengthText.textContent = password.length > 0 ? feedback : '';
            }

            // Check password match
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword.length > 0) {
                    passwordMatch.classList.add('show');
                    if (password === confirmPassword) {
                        passwordMatch.className = 'password-match show match';
                        passwordMatch.textContent = 'Passwords match';
                    } else {
                        passwordMatch.className = 'password-match show no-match';
                        passwordMatch.textContent = 'Passwords do not match';
                    }
                } else {
                    passwordMatch.classList.remove('show');
                }
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

            // Real-time password strength checking
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
                hideAlerts();
            });

            // Real-time password match checking
            confirmPasswordInput.addEventListener('input', function() {
                checkPasswordMatch();
                hideAlerts();
            });

            // Form submission with validation
            form.addEventListener('submit', function(e) {
                hideAlerts();

                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                // Client-side validation
                if (password.length < 8) {
                    e.preventDefault();
                    showAlert('error', 'Password must be at least 8 characters long.');
                    passwordInput.focus();
                    return;
                }

                if (password !== confirmPassword) {
                    e.preventDefault();
                    showAlert('error', 'Passwords do not match.');
                    confirmPasswordInput.focus();
                    return;
                }

                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                // Note: The form will submit normally to your backend
                // The loading state will be visible until page redirect/reload
            });

            // Reset loading state if form submission is prevented
            passwordInput.addEventListener('focus', function() {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            });

            confirmPasswordInput.addEventListener('focus', function() {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            });

            // Handle form reset
            form.addEventListener('reset', function() {
                hideAlerts();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                passwordStrength.className = 'password-strength';
                passwordStrengthText.textContent = '';
                passwordMatch.classList.remove('show');
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