<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - Elderly Care System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5f41;
            --secondary-color: #4a7c59;
            --accent-color: #7fb069;
            --light-bg: #f8fffe;
            --card-shadow: 0 4px 20px rgba(44, 95, 65, 0.1);
        }

        body {
            background: linear-gradient(135deg, var(--light-bg) 0%, #e8f5e8 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 15px rgba(44, 95, 65, 0.2);
        }

        .main-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem;
            border: none;
        }

        .card-header h2 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .form-section {
            padding: 2rem;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--accent-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(127, 176, 105, 0.25);
            background-color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(44, 95, 65, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 95, 65, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            background: #5a6268;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }

        .required {
            color: #dc3545;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-row.single {
            grid-template-columns: 1fr;
        }

        .floating-label {
            position: relative;
        }

        .floating-label .form-control {
            padding-top: 1.5rem;
            padding-bottom: 0.5rem;
        }

        .floating-label .form-label {
            position: absolute;
            top: 0.5rem;
            left: 1rem;
            font-size: 0.85rem;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding: 2rem;
            background: #f8f9fa;
            margin: 0 -2rem -2rem -2rem;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .main-container {
                margin: 1rem auto;
                padding: 0 0.5rem;
            }
        }

        .input-group-text {
            background: var(--accent-color);
            border: 2px solid var(--accent-color);
            color: white;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .input-group .form-control:focus {
            border-left: 2px solid var(--accent-color);
        }

        .employee-id-display {
            background: #e9ecef;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-heart"></i> Elderly Care System</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="?action=show&id=<?php echo $employee['id']; ?>"><i class="fas fa-eye"></i> View Employee</a>
                <a class="nav-link" href="?action=index"><i class="fas fa-users"></i> All Employees</a>
                <a class="nav-link" href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <!-- Alert Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Main Form -->
        <div class="form-card">
            <div class="card-header">
                <h2><i class="fas fa-user-edit"></i> Edit Employee</h2>
                <p class="mb-0 opacity-75">Update employee information - <?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']); ?></p>
            </div>

            <form action="?action=update&id=<?php echo $employee['id']; ?>" method="POST" class="needs-validation" novalidate>
                <!-- Employee ID Display -->
                <div class="form-section">
                    <div class="form-row single">
                        <div>
                            <label class="form-label">Employee ID</label>
                            <div class="employee-id-display">
                                <?php echo htmlspecialchars($employee['employee_id'] ?? 'N/A'); ?>
                            </div>
                            <small class="text-muted">Employee ID cannot be changed</small>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-user"></i> Personal Information
                    </h4>

                    <div class="form-row">
                        <div class="floating-label">
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="<?php echo htmlspecialchars($employee['first_name']); ?>" required>
                            <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                            <div class="invalid-feedback">Please provide a valid first name.</div>
                        </div>

                        <div class="floating-label">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="<?php echo htmlspecialchars($employee['last_name']); ?>" required>
                            <label for="last_name" class="form-label">Last Name <span class="required">*</span></label>
                            <div class="invalid-feedback">Please provide a valid last name.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="floating-label">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($employee['email']); ?>" required>
                            </div>
                            <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>

                        <div class="floating-label">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="<?php echo htmlspecialchars($employee['phone']); ?>" required>
                            </div>
                            <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                            <div class="invalid-feedback">Please provide a valid phone number.</div>
                        </div>
                    </div>

                    <div class="form-row single">
                        <div class="floating-label">
                            <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($employee['address'] ?? ''); ?></textarea>
                            <label for="address" class="form-label">Address</label>
                        </div>
                    </div>
                </div>

                <!-- Employment Information -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-briefcase"></i> Employment Information
                    </h4>

                    <div class="form-row">
                        <div>
                            <label for="role" class="form-label">Role <span class="required">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $value => $label): ?>
                                    <option value="<?php echo $value; ?>"
                                        <?php echo ($employee['role'] === $value) ? 'selected' : ''; ?>>
                                        <?php echo $label; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Please select a role.</div>
                        </div>

                        <div>
                            <label for="department_id" class="form-label">Department <span class="required">*</span></label>
                            <select class="form-select" id="department_id" name="department_id" required>
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?php echo $department['id']; ?>"
                                        <?php echo ($employee['department_id'] == $department['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($department['department_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Please select a department.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="floating-label">
                            <input type="date" class="form-control" id="hire_date" name="hire_date"
                                value="<?php echo $employee['hire_date']; ?>">
                            <label for="hire_date" class="form-label">Hire Date</label>
                        </div>

                        <div class="floating-label">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                <input type="number" class="form-control" id="salary" name="salary" step="0.01" min="0"
                                    value="<?php echo $employee['salary'] ?? ''; ?>">
                            </div>
                            <label for="salary" class="form-label">Salary</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" <?php echo ($employee['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo ($employee['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                <option value="on_leave" <?php echo ($employee['status'] === 'on_leave') ? 'selected' : ''; ?>>On Leave</option>
                                <option value="terminated" <?php echo ($employee['status'] === 'terminated') ? 'selected' : ''; ?>>Terminated</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact & Additional Info -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-phone-alt"></i> Emergency Contact & Additional Information
                    </h4>

                    <div class="form-row">
                        <div class="floating-label">
                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                                value="<?php echo htmlspecialchars($employee['emergency_contact'] ?? ''); ?>">
                            <label for="emergency_contact" class="form-label">Emergency Contact Name</label>
                        </div>

                        <div class="floating-label">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="emergency_phone" name="emergency_phone"
                                    value="<?php echo htmlspecialchars($employee['emergency_phone'] ?? ''); ?>">
                            </div>
                            <label for="emergency_phone" class="form-label">Emergency Phone</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="floating-label">
                            <textarea class="form-control" id="qualifications" name="qualifications" rows="3"><?php echo htmlspecialchars($employee['qualifications'] ?? ''); ?></textarea>
                            <label for="qualifications" class="form-label">Qualifications & Certifications</label>
                        </div>
                    </div>

                    <div class="form-row single">
                        <div class="floating-label">
                            <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo htmlspecialchars($employee['notes'] ?? ''); ?></textarea>
                            <label for="notes" class="form-label">Additional Notes</label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="?action=show&id=<?php echo $employee['id']; ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Auto-dismiss alerts
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let formattedValue = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            if (value.length <= 10) {
                e.target.value = formattedValue;
            }
        });

        document.getElementById('emergency_phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let formattedValue = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            if (value.length <= 10) {
                e.target.value = formattedValue;
            }
        });

        // Floating labels animation
        document.querySelectorAll('.floating-label .form-control, .floating-label .form-select').forEach(function(element) {
            element.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            element.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });

            // Check on page load
            if (element.value !== '') {
                element.parentElement.classList.add('focused');
            }
        });

        // Initialize floating labels for existing values
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.floating-label .form-control, .floating-label .form-select').forEach(function(element) {
                if (element.value !== '') {
                    element.parentElement.classList.add('focused');
                }
            });
        });

        // Confirm before leaving if form has changes
        let formChanged = false;
        const form = document.querySelector('form');
        const formElements = form.querySelectorAll('input, select, textarea');

        // Store initial form values
        const initialValues = {};
        formElements.forEach(function(element) {
            initialValues[element.name] = element.value;
        });

        // Track changes
        formElements.forEach(function(element) {
            element.addEventListener('change', function() {
                if (this.value !== initialValues[this.name]) {
                    formChanged = true;
                } else {
                    // Check if all values match initial values
                    let allMatch = true;
                    formElements.forEach(function(el) {
                        if (el.value !== initialValues[el.name]) {
                            allMatch = false;
                        }
                    });
                    formChanged = !allMatch;
                }
            });
        });

        // Warn before leaving
        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '';
                return '';
            }
        });

        // Don't warn when submitting
        form.addEventListener('submit', function() {
            formChanged = false;
        });
    </script>
</body>

</html>