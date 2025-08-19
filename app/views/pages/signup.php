<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Elder Care System</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/signup.css?v=<?= time(); ?>">
    <style>
        /* SVG Icon Styles */
        .svg-icon {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            display: inline-block;
            vertical-align: middle;
        }

        .input-icon .svg-icon {
            width: 18px;
            height: 18px;
            color: #6b7280;
            transition: color 0.2s ease;
        }

        .form-input:focus+.input-icon .svg-icon {
            color: #3b82f6;
        }

        .form-input.error+.input-icon .svg-icon {
            color: #ef4444;
        }

        /* reCAPTCHA Styles */
        .recaptcha-container {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .recaptcha-container.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .g-recaptcha {
            transform: scale(0.9);
            transform-origin: center;
        }

        @media (max-width: 768px) {
            .g-recaptcha {
                transform: scale(0.8);
            }
        }

        @media (max-width: 480px) {
            .g-recaptcha {
                transform: scale(0.75);
            }
        }

        /* Modern Alert Modal */
        .alert-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .alert-overlay.show {
            display: flex;
            opacity: 1;
        }

        .alert-box {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
            transform: translateY(-20px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .alert-overlay.show .alert-box {
            transform: translateY(0) scale(1);
        }

        .alert-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        .alert-icon svg {
            width: 30px;
            height: 30px;
            color: white;
            stroke-width: 2;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(239, 68, 68, 0);
            }
        }

        .alert-title {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .alert-message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .alert-button {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .alert-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .alert-button:active {
            transform: translateY(0);
        }

        /* Shake animation for reCAPTCHA error */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .recaptcha-container.shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Modern Alert Modal -->
    <div class="alert-overlay" id="alertOverlay">
        <div class="alert-box">
            <div class="alert-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <div class="alert-title">Verification Required</div>
            <div class="alert-message">Please complete the reCAPTCHA verification to prove you're not a robot.</div>
            <button class="alert-button" onclick="closeAlert()">Got it!</button>
        </div>
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
                        <div class="input-icon">
                            <svg class="svg-icon" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
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
                        <div class="input-icon">
                            <svg class="svg-icon" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>
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
                        <div class="input-icon">
                            <svg class="svg-icon" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <circle cx="12" cy="16" r="1" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </div>
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
                        <div class="input-icon">
                            <svg class="svg-icon" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <circle cx="12" cy="16" r="1" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                <path d="M7 6.5V7a5 5 0 0 1 10 0v-.5" />
                            </svg>
                        </div>
                        <label class="floating-label">Confirm Password</label>
                    </div>
                </div>

                <!-- Fixed reCAPTCHA Position -->
                <div class="form-group">
                    <div class="recaptcha-container" id="recaptchaContainer">
                        <div class="g-recaptcha" data-sitekey="6LfTA6srAAAAANUe7iOdVOQHwAd15Jq0WgkmOrgT"></div>
                    </div>

                    <!-- Show captcha error -->
                    <?php if (isset($data['captcha-err'])): ?>
                        <div class="error-message"><?php echo $data['captcha-err']; ?></div>
                    <?php endif; ?>
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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        // Modern Alert Functions
        function showAlert() {
            const overlay = document.getElementById('alertOverlay');
            overlay.classList.add('show');

            // Add shake animation to reCAPTCHA
            const recaptchaContainer = document.getElementById('recaptchaContainer');
            recaptchaContainer.classList.add('error', 'shake');

            // Remove shake animation after it completes
            setTimeout(() => {
                recaptchaContainer.classList.remove('shake');
            }, 500);
        }

        function closeAlert() {
            const overlay = document.getElementById('alertOverlay');
            overlay.classList.remove('show');

            // Focus on reCAPTCHA after closing alert
            setTimeout(() => {
                const recaptchaFrame = document.querySelector('.g-recaptcha iframe');
                if (recaptchaFrame) {
                    recaptchaFrame.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }, 300);
        }

        // Function to check if reCAPTCHA is completed
        function isRecaptchaCompleted() {
            const recaptchaResponse = grecaptcha.getResponse();
            return recaptchaResponse && recaptchaResponse.length > 0;
        }

        // Enhanced form functionality
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signupForm');
            const submitBtn = document.getElementById('submitBtn');
            const recaptchaContainer = document.getElementById('recaptchaContainer');

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
                confirmPasswordInput.addEventListener('blur', validatePasswordMatch);
            }

            // Form submission validation with reCAPTCHA check
            form.addEventListener('submit', function(e) {
                // Check password match
                if (!validatePasswordMatch()) {
                    e.preventDefault();
                    confirmPasswordInput.focus();
                    return false;
                }

                // Check reCAPTCHA completion
                if (!isRecaptchaCompleted()) {
                    e.preventDefault();
                    showAlert();
                    return false;
                }

                // Remove error styling from reCAPTCHA if validation passes
                recaptchaContainer.classList.remove('error');

                // Show loading state
                submitBtn.classList.add('btn-loading');
                submitBtn.disabled = true;
            });

            // Close alert when clicking outside the alert box
            document.getElementById('alertOverlay').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAlert();
                }
            });

            // Close alert with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAlert();
                }
            });
        });

        // Callback function for when reCAPTCHA is completed
        function onRecaptchaCallback() {
            const recaptchaContainer = document.getElementById('recaptchaContainer');
            recaptchaContainer.classList.remove('error');
        }

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