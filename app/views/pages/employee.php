<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: radial-gradient(at center bottom, rgb(219, 234, 254), rgb(147, 197, 253), rgb(59, 130, 246));
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
        }

        .form-container {
            padding: 40px 30px;
        }

        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 25px;
            color: #c33;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .error-message::before {
            content: "⚠️";
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
            font-family: inherit;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        /* Email validation styles */
        .email-validation {
            position: relative;
        }

        .email-validation .validation-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            display: none;
        }

        .email-validation.checking .validation-icon.loading {
            display: block;
            animation: spin 1s linear infinite;
        }

        .email-validation.valid .validation-icon.success {
            display: block;
        }

        .email-validation.invalid .validation-icon.error {
            display: block;
        }

        .validation-icon svg {
            width: 100%;
            height: 100%;
        }

        .email-validation.invalid input {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .email-validation.valid input {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        .email-error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        .email-validation.invalid .email-error-message {
            display: block;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        select option {
            padding: 10px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:active:not(:disabled) {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover:not(:disabled)::before {
            left: 100%;
        }

        /* Custom Alert Styles */
        .custom-alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .custom-alert.show {
            display: flex;
        }

        .alert-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        .alert-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fee2e2;
            border-radius: 50%;
        }

        .alert-icon svg {
            width: 30px;
            height: 30px;
        }

        .alert-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #374151;
        }

        .alert-message {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .alert-button {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .alert-button:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .container {
                margin: 0;
                border-radius: 15px;
            }

            .header {
                padding: 25px 20px;
            }

            .header h1 {
                font-size: 1.6rem;
            }

            .form-container {
                padding: 30px 25px;
            }

            input[type="text"],
            input[type="email"],
            select,
            textarea {
                padding: 12px 14px;
                font-size: 0.95rem;
            }

            .submit-btn {
                padding: 14px 20px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 1.4rem;
            }

            .form-container {
                padding: 25px 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }
        }

        /* Loading animation for submit button */
        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Add Employee</h1>
        </div>

        <div class="form-container">
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= URLROOT ?>/Employee/add" method="POST" id="employeeForm">
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="">-- Select Role --</option>
                        <option value="doctor">Doctor</option>
                        <option value="caregiver">Caregiver</option>
                        <option value="driver">Driver</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="email-validation">
                        <input type="email" name="email" id="email" required />
                        <!-- Loading Icon -->
                        <span class="validation-icon loading">
                            <svg viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="#6b7280" stroke-width="2" />
                                <path d="m12 6 0 6 4 2" stroke="#6b7280" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <!-- Success Icon -->
                        <span class="validation-icon success">
                            <svg viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" fill="#10b981" />
                                <path d="m9 12 2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <!-- Error Icon -->
                        <span class="validation-icon error">
                            <svg viewBox="0 0 24 24" fill="none">
                                <line x1="15" y1="9" x2="9" y2="15" stroke="white" stroke-width="2" stroke-linecap="round" />
                                <line x1="9" y1="9" x2="15" y2="15" stroke="white" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <div class="email-error-message">This email address is already registered!</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" required />
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" required placeholder="Enter employee address..."></textarea>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">Add Employee</button>
                <button type="button" class="submit-btn" onclick="window.location.href='<?= URLROOT; ?>/pages/emplist'">Employee List</button>
            </form>
        </div>
    </div>

    <!-- Custom Alert Modal -->
    <div class="custom-alert" id="customAlert">
        <div class="alert-content">
            <div class="alert-icon error">⚠️</div>
            <div class="alert-title">Email Already Exists!</div>
            <div class="alert-message" id="alertMessage">This email address is already registered. Please use a different email address.</div>
            <button class="alert-button" onclick="closeAlert()">OK</button>
        </div>
    </div>

    <script>
        let emailCheckTimeout;
        let emailIsValid = false;

        // Add loading animation on form submit
        document.getElementById('employeeForm').addEventListener('submit', function(e) {
            if (!emailIsValid) {
                e.preventDefault();
                showAlert('Please enter a valid and unique email address.');
                return false;
            }

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Adding Employee...';
        });

        // Email validation
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value.trim();
            const emailGroup = this.closest('.email-validation');
            const submitBtn = document.getElementById('submitBtn');

            // Clear previous timeout
            clearTimeout(emailCheckTimeout);

            // Reset states
            emailGroup.classList.remove('checking', 'valid', 'invalid');
            emailIsValid = false;
            submitBtn.disabled = true;

            if (email === '') {
                submitBtn.disabled = false;
                return;
            }

            // Basic email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                emailGroup.classList.add('invalid');
                emailGroup.querySelector('.email-error-message').textContent = 'Please enter a valid email address.';
                return;
            }

            // Show checking state
            emailGroup.classList.add('checking');

            // Debounce the API call
            emailCheckTimeout = setTimeout(() => {
                checkEmailExists(email);
            }, 500);
        });

        async function checkEmailExists(email) {
            const emailGroup = document.querySelector('.email-validation');

            try {
                const response = await fetch('<?= URLROOT ?>/Employee/checkEmailAjax', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email
                    })
                });

                const data = await response.json();

                emailGroup.classList.remove('checking');

                if (data.success) {
                    if (data.exists) {
                        // Email exists
                        emailGroup.classList.add('invalid');
                        emailGroup.querySelector('.email-error-message').textContent = 'This email address is already registered!';
                        emailIsValid = false;
                        document.getElementById('submitBtn').disabled = true;
                    } else {
                        // Email is unique
                        emailGroup.classList.add('valid');
                        emailIsValid = true;
                        document.getElementById('submitBtn').disabled = false;
                    }
                } else {
                    // Handle error
                    emailGroup.classList.add('invalid');
                    emailGroup.querySelector('.email-error-message').textContent = 'Error checking email. Please try again.';
                    emailIsValid = false;
                    document.getElementById('submitBtn').disabled = true;
                }
            } catch (error) {
                console.error('Error checking email:', error);
                emailGroup.classList.remove('checking');
                emailGroup.classList.add('invalid');
                emailGroup.querySelector('.email-error-message').textContent = 'Error checking email. Please try again.';
                emailIsValid = false;
                document.getElementById('submitBtn').disabled = true;
            }
        }

        function showAlert(message) {
            document.getElementById('alertMessage').textContent = message;
            document.getElementById('customAlert').classList.add('show');
        }

        function closeAlert() {
            document.getElementById('customAlert').classList.remove('show');
        }

        // Close alert when clicking outside
        document.getElementById('customAlert').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAlert();
            }
        });

        // Add subtle animations on input focus
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Initialize form state
        document.getElementById('submitBtn').disabled = true;
    </script>
</body>

</html>