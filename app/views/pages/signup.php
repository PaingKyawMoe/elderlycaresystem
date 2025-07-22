<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Elder Care System</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/signup.css?v=<?= time(); ?>">
</head>

<body>
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="image-section">
            <div class="image-overlay">
                <h2>Welcome!</h2>
                <p>Join our caring community and access comprehensive elder care services designed with love and expertise.</p>
            </div>
        </div>

        <div class="form-section">
            <div class="form-header">
                <h1>Create Account</h1>
                <p>Start your journey with us today</p>
            </div>

            <form method="POST" action="<?= URLROOT ?>/Users/register" id="signupForm">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>

                <div class="form-group">
                    <?php if (isset($data['name-err'])): ?>
                        <div class="error-message" data-error-type="name">
                            <?php echo $data['name-err']; ?>
                        </div>
                    <?php endif; ?>
                    <div class="input-container">
                        <input type="text"
                            name="name"
                            class="form-input <?php echo isset($data['name-err']) ? 'error' : ''; ?>"
                            placeholder=" "
                            required>
                        <div class="input-icon">👤</div>
                        <label class="floating-label">Full Name</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php if (isset($data['email-err'])): ?>
                        <div class="error-message" data-error-type="email">
                            <?php echo $data['email-err']; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error_email'])): ?>
                        <div class="error-message" data-error-type="email-session">
                            <?php echo $_SESSION['error_email'];
                            unset($_SESSION['error_email']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="input-container">
                        <input type="email"
                            name="email"
                            class="form-input <?php echo (isset($data['email-err']) || isset($_SESSION['error_email'])) ? 'error' : ''; ?>"
                            placeholder=" "
                            required>
                        <div class="input-icon">📧</div>
                        <label class="floating-label">Email Address</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php if (isset($data['password-err'])): ?>
                        <div class="error-message" data-error-type="password">
                            <?php echo $data['password-err']; ?>
                        </div>
                    <?php endif; ?>
                    <div class="input-container">
                        <input type="password"
                            name="password"
                            class="form-input <?php echo isset($data['password-err']) ? 'error' : ''; ?>"
                            placeholder=" "
                            id="passwordInput"
                            required>
                        <div class="input-icon">🔒</div>
                        <label class="floating-label">Password</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="error-message" id="confirm-password-error" style="display: none;" data-error-type="confirm-password">
                        Passwords do not match
                    </div>
                    <div class="input-container">
                        <input type="password"
                            name="confirm_password"
                            class="form-input <?php echo isset($data['password-doesnotmatch']) ? 'error' : ''; ?>"
                            placeholder=" "
                            id="confirmPasswordInput"
                            required>
                        <div class="input-icon">🔐</div>
                        <label class="floating-label">Confirm Password</label>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    Create Account
                </button>

                <div class="signin-link">
                    Already have an account? <a href="<?php echo URLROOT; ?>/pages/signin">Sign In</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Enhanced form functionality
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signupForm');
            const submitBtn = document.getElementById('submitBtn');

            // Form submission loading state
            // (This is now handled in the form submission validation section above)

            // Auto-hide error messages after 5 seconds
            function hideErrorMessages() {
                const errorMessages = document.querySelectorAll('.error-message');

                errorMessages.forEach(function(errorElement) {
                    setTimeout(function() {
                        errorElement.classList.add('fade-out');

                        setTimeout(function() {
                            if (errorElement.parentNode) {
                                errorElement.remove();

                                // Remove error class from input
                                const inputContainer = errorElement.parentNode.querySelector('.input-container');
                                if (inputContainer) {
                                    const input = inputContainer.querySelector('.form-input.error');
                                    if (input) {
                                        input.classList.remove('error');
                                    }
                                }
                            }
                        }, 300);
                    }, 4700);
                });
            }

            // Initialize error hiding
            hideErrorMessages();

            // Input focus animations
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentNode.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentNode.style.transform = 'scale(1)';
                });
            });

            // Real-time validation feedback
            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.getElementById('passwordInput');
            const confirmPasswordInput = document.getElementById('confirmPasswordInput');
            const confirmPasswordError = document.getElementById('confirm-password-error');

            // Email validation
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (this.value && !emailRegex.test(this.value)) {
                        this.classList.add('error');
                    } else {
                        this.classList.remove('error');
                    }
                });
            }

            // Password confirmation validation
            function validatePasswordMatch() {
                if (passwordInput && confirmPasswordInput && confirmPasswordError) {
                    const password = passwordInput.value;
                    const confirmPassword = confirmPasswordInput.value;

                    if (confirmPassword && password !== confirmPassword) {
                        confirmPasswordInput.classList.add('error');
                        confirmPasswordError.style.display = 'flex';
                        confirmPasswordError.classList.remove('fade-out');
                        confirmPasswordError.classList.add('show-error');
                        return false;
                    } else {
                        confirmPasswordInput.classList.remove('error');
                        confirmPasswordError.style.display = 'none';
                        confirmPasswordError.classList.remove('show-error');
                        return true;
                    }
                }
                return true;
            }

            // Add event listeners for password validation
            if (passwordInput && confirmPasswordInput) {
                passwordInput.addEventListener('input', validatePasswordMatch);
                confirmPasswordInput.addEventListener('input', validatePasswordMatch);

                // Also validate on blur (when user leaves the field)
                confirmPasswordInput.addEventListener('blur', validatePasswordMatch);
            }

            // Form submission validation
            form.addEventListener('submit', function(e) {
                if (!validatePasswordMatch()) {
                    e.preventDefault(); // Stop form submission
                    confirmPasswordInput.focus(); // Focus on the error field
                    return false;
                }

                // If validation passes, show loading state
                submitBtn.classList.add('btn-loading');
                submitBtn.disabled = true;
            });
        });

        // Mutation observer for dynamic error handling
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length > 0) {
                    const errorMessages = document.querySelectorAll('.error-message');
                    if (errorMessages.length > 0) {
                        hideErrorMessages();
                    }
                }
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    </script>
</body>

</html>