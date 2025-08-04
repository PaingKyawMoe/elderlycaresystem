<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee - Staff Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="70" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .header h1 {
            position: relative;
            z-index: 1;
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            position: relative;
            z-index: 1;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .form-container {
            padding: 40px;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 10px;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            font-weight: 500;
            animation: slideIn 0.3s ease-out;
        }

        .alert i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
            transform: translateY(-2px);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            padding-right: 50px;
        }

        .staff-type-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .staff-type-option {
            position: relative;
        }

        .staff-type-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .staff-type-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
            text-align: center;
        }

        .staff-type-label:hover {
            border-color: #4facfe;
            background: rgba(79, 172, 254, 0.05);
            transform: translateY(-2px);
        }

        .staff-type-option input[type="radio"]:checked+.staff-type-label {
            border-color: #4facfe;
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%);
            color: #0056b3;
        }

        .staff-type-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #6c757d;
            transition: color 0.3s ease;
        }

        .staff-type-option input[type="radio"]:checked+.staff-type-label .staff-type-icon {
            color: #4facfe;
        }

        .staff-type-text {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-container {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading .btn-primary {
            background: #6c757d;
        }

        .field-error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .field-error i {
            margin-right: 5px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(79, 172, 254, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(79, 172, 254, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(79, 172, 254, 0);
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                padding: 25px 20px;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            .form-container {
                padding: 25px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .staff-type-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .btn-container {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .staff-type-grid {
                grid-template-columns: 1fr;
            }

            .staff-type-label {
                flex-direction: row;
                justify-content: flex-start;
                padding: 15px;
            }

            .staff-type-icon {
                margin-right: 15px;
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-plus"></i> Add New Employee</h1>
            <p>Fill in the details to add a new staff member to the system</p>
        </div>

        <div class="form-container">
            <?php
            session_start();

            // Display success message
            if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Employee added successfully!
                </div>
            <?php endif; ?>

            <?php
            // Display error message
            if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                </div>
            <?php
                unset($_SESSION['error']);
            endif; ?>

            <form id="employeeForm" method="POST" action="EmployeeController.php">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user"></i> Full Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-input"
                            placeholder="Enter full name"
                            value="<?php echo isset($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="Enter email address"
                            value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">
                            <i class="fas fa-phone"></i> Phone Number
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="form-input"
                            placeholder="Enter phone number"
                            value="<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group full-width">
                        <label for="address" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Address
                        </label>
                        <textarea
                            id="address"
                            name="address"
                            class="form-textarea"
                            placeholder="Enter complete address"
                            required><?php echo isset($_SESSION['form_data']['address']) ? htmlspecialchars($_SESSION['form_data']['address']) : ''; ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fas fa-briefcase"></i> Staff Type
                        </label>
                        <div class="staff-type-grid">
                            <div class="staff-type-option">
                                <input type="radio" id="doctor" name="staff_type" value="doctor"
                                    <?php echo (isset($_SESSION['form_data']['staff_type']) && $_SESSION['form_data']['staff_type'] == 'doctor') ? 'checked' : ''; ?> required>
                                <label for="doctor" class="staff-type-label">
                                    <div class="staff-type-icon">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="staff-type-text">Doctor</div>
                                </label>
                            </div>

                            <div class="staff-type-option">
                                <input type="radio" id="caregiver" name="staff_type" value="caregiver"
                                    <?php echo (isset($_SESSION['form_data']['staff_type']) && $_SESSION['form_data']['staff_type'] == 'caregiver') ? 'checked' : ''; ?> required>
                                <label for="caregiver" class="staff-type-label">
                                    <div class="staff-type-icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="staff-type-text">Caregiver</div>
                                </label>
                            </div>

                            <div class="staff-type-option">
                                <input type="radio" id="driver" name="staff_type" value="driver"
                                    <?php echo (isset($_SESSION['form_data']['staff_type']) && $_SESSION['form_data']['staff_type'] == 'driver') ? 'checked' : ''; ?> required>
                                <label for="driver" class="staff-type-label">
                                    <div class="staff-type-icon">
                                        <i class="fas fa-car"></i>
                                    </div>
                                    <div class="staff-type-text">Driver</div>
                                </label>
                            </div>

                            <div class="staff-type-option">
                                <input type="radio" id="cleaner" name="staff_type" value="cleaner"
                                    <?php echo (isset($_SESSION['form_data']['staff_type']) && $_SESSION['form_data']['staff_type'] == 'cleaner') ? 'checked' : ''; ?> required>
                                <label for="cleaner" class="staff-type-label">
                                    <div class="staff-type-icon">
                                        <i class="fas fa-broom"></i>
                                    </div>
                                    <div class="staff-type-text">Cleaner</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Employee
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Reset Form
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Clear form data after displaying
    if (isset($_SESSION['form_data'])) {
        unset($_SESSION['form_data']);
    }
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('employeeForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            const resetBtn = form.querySelector('button[type="reset"]');

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                // Add loading state
                form.classList.add('loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding Employee...';
                submitBtn.disabled = true;
            });

            // Form validation
            function validateForm() {
                let isValid = true;
                const requiredFields = ['name', 'email', 'phone', 'address'];

                // Check required fields
                requiredFields.forEach(fieldName => {
                    const field = form.querySelector(`[name="${fieldName}"]`);
                    if (!field.value.trim()) {
                        showFieldError(field, `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)} is required`);
                        isValid = false;
                    } else {
                        clearFieldError(field);
                    }
                });

                // Check staff type selection
                const staffTypeChecked = form.querySelector('input[name="staff_type"]:checked');
                if (!staffTypeChecked) {
                    showAlert('Please select a staff type', 'error');
                    isValid = false;
                }

                // Email format validation
                const emailField = form.querySelector('[name="email"]');
                if (emailField.value && !isValidEmail(emailField.value)) {
                    showFieldError(emailField, 'Please enter a valid email address');
                    isValid = false;
                }

                // Phone format validation
                const phoneField = form.querySelector('[name="phone"]');
                if (phoneField.value && !isValidPhone(phoneField.value)) {
                    showFieldError(phoneField, 'Please enter a valid phone number');
                    isValid = false;
                }

                return isValid;
            }

            // Email validation
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Phone validation
            function isValidPhone(phone) {
                const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
                return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
            }

            // Show field error
            function showFieldError(field, message) {
                clearFieldError(field);
                field.style.borderColor = '#dc3545';
                field.style.backgroundColor = '#fff5f5';

                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;

                field.parentNode.appendChild(errorDiv);
            }

            // Clear field error
            function clearFieldError(field) {
                field.style.borderColor = '#e1e5e9';
                field.style.backgroundColor = '#f8f9fa';

                const existingError = field.parentNode.querySelector('.field-error');
                if (existingError) {
                    existingError.remove();
                }
            }

            // Show alert
            function showAlert(message, type) {
                const existingAlert = document.querySelector('.alert');
                if (existingAlert) {
                    existingAlert.remove();
                }

                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type}`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'check-circle'}"></i>
                    ${message}
                `;

                const formContainer = document.querySelector('.form-container');
                formContainer.insertBefore(alertDiv, formContainer.firstChild);

                // Auto-hide after 5 seconds
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }

            // Real-time validation
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim()) {
                        if (this.name === 'email' && !isValidEmail(this.value)) {
                            showFieldError(this, 'Please enter a valid email address');
                        } else if (this.name === 'phone' && !isValidPhone(this.value)) {
                            showFieldError(this, 'Please enter a valid phone number');
                        } else {
                            clearFieldError(this);
                        }
                    } else if (this.hasAttribute('required')) {
                        showFieldError(this, `${this.name.charAt(0).toUpperCase() + this.name.slice(1)} is required`);
                    }
                });

                input.addEventListener('focus', function() {
                    clearFieldError(this);
                });
            });

            // Reset form functionality
            resetBtn.addEventListener('click', function() {
                // Clear all field errors
                inputs.forEach(input => {
                    clearFieldError(input);
                });

                // Remove any alerts
                const existingAlert = document.querySelector('.alert');
                if (existingAlert && !existingAlert.classList.contains('alert-success')) {
                    existingAlert.remove();
                }

                // Reset form with animation
                setTimeout(() => {
                    form.reset();
                }, 100);
            });

            // Auto-hide success/error messages
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });

            // Phone number formatting
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function() {
                // Remove all non-digit characters except + at the beginning
                let value = this.value.replace(/[^\d+]/g, '');
                if (value.indexOf('+') > 0) {
                    value = value.replace(/\+/g, '');
                }
                this.value = value;
            });

            // Name field - only letters and spaces
            const nameInput = document.getElementById('name');
            nameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });

            // Add smooth animations to form elements
            const formElements = document.querySelectorAll('.form-input, .form-textarea, .staff-type-label');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    element.style.transition = 'all 0.5s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>

</html>