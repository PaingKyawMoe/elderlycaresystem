<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/appointmentform.css?v=<?= time(); ?>">

    <style>
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #667eea;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-user {
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }


        /* Adjust body padding to account for fixed navbar */
        body {

            padding-top: 80px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.8rem 1rem;
                flex-wrap: wrap;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .logo {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .nav-user {
                font-size: 0.8rem;
            }

            .logout-btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            body {
                padding-top: 80px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.6rem;
            }

            .navbar-nav {
                gap: 0.5rem;
            }

            .nav-user {
                display: none;
                /* Hide user info on very small screens */
            }

            .logout-btn {
                padding: 0.4rem 0.6rem;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar">
        <a href="<?= URLROOT ?>/pages/dashboard" class="navbar-brand">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            Elderly Care
        </a>
        <div class="navbar-nav">
            <div class="nav-user">
                <i class="fas fa-user-circle"></i>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></span>
            </div>
            <a href="<?= URLROOT ?>/pages/dashboard" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Back
            </a>
        </div>
    </nav>
    <div class="wrapper">
        <div class="form-container">
            <h1>Appointment Form</h1>
            <form id="appointmentForm" method="POST" action="<?= URLROOT ?>/Appointment/store" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user']['id']); ?>">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="text" name="dob" id="dob" placeholder="Date Of Birth" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="phone" id="phone" placeholder="Enter Your Phone" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="address" id="address" placeholder="Enter Your Address" required>
                </div>
                <div class="form-group radio-group">
                    <label class="radio-title">Gender:</label>
                    <div class="radio-options">
                        <input type="radio" id="male" name="gender" value="male" checked>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                    </div>
                </div>

                <div class="form-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="text" name="preferredDate" id="preferredDate" placeholder="Preferred Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                </div>
                <div class="form-group">
                    <div class="custom-select-wrapper">
                        <i class="fas fa-clipboard-list"></i>
                        <select name="appointmentType" id="appointmentType" required>
                            <option value="" disabled selected>Type Of Appointment</option>
                            <option value="consultation">Consultation</option>
                            <option value="checkup">Checkup</option>
                            <option value="followup">followup</option>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-select-wrapper">
                        <i class="fas fa-clock"></i>
                        <select name="preferredTime" id="preferredTime" required>
                            <option value="" disabled selected>Preferred Time</option>
                            <option value="morning">Morning (8 AM - 11 AM)</option>
                            <option value="afternoon">Afternoon (11 AM - 2 PM)</option>
                            <option value="evening">Evening (2 PM - 5 PM)</option>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-select-wrapper">
                        <i class="fas fa-user-md"></i>
                        <select name="selectDoctor" id="selectDoctor" required>
                            <option value="" disabled selected>Select Doctor</option>
                            <option value="Dr-Paing">Dr. Paing</option>
                            <option value="dr-kyaw">Dr. Kyaw</option>
                            <option value="dr-moe">Dr. Moe</option>
                            <option value="dr-phyoe">Dr. Phyoe</option>
                            <option value="dr-mya">Dr. Mya</option>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-select-wrapper">
                        <i class="fas fa-notes-medical"></i>
                        <select name="reasonforappointment" id="reasonForAppointment" required>
                            <option value="" disabled selected>Reason For Appointment</option>
                            <option value="general-checkup">General Check-up</option>
                            <option value="symptoms">Discuss Symptoms</option>
                            <option value="prescription-refill">Prescription Refill</option>
                            <option value="other">Other</option>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>
                <div class="form-group">
                    <i class="fas fa-image"></i>
                    <input type="file" name="photo" id="photo" accept="image/*" required>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <!-- Modern Alert Modal -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal-alert">
            <div class="modal-header" id="modalHeader">
                <i class="fas fa-exclamation-circle"></i>
                <h3 id="modalTitle">Age Requirement</h3>
            </div>
            <div class="modal-body">
                <p id="modalMessage">
                    Sorry, appointments are only available for people aged
                    <span class="age-requirement" id="ageRequirement">50 and above</span>.
                    Please check your date of birth and try again.
                </p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalBtn" onclick="closeModal()">OK</button>
            </div>
        </div>
    </div>

    <script>
        // Modern alert function
        function showModal(title, message, type = 'error') {
            const overlay = document.getElementById('modalOverlay');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalHeader = document.getElementById('modalHeader');
            const modalBtn = document.getElementById('modalBtn');
            const ageReq = document.getElementById('ageRequirement');

            modalTitle.textContent = title;
            modalMessage.innerHTML = message;

            if (type === 'success') {
                modalHeader.classList.add('success');
                modalBtn.classList.add('success');
                if (ageReq) ageReq.classList.add('success');
                modalHeader.querySelector('i').className = 'fas fa-check-circle';
            } else if (type === 'warning') {
                modalHeader.classList.remove('success');
                modalHeader.classList.add('warning');
                modalBtn.classList.remove('success');
                modalBtn.classList.add('warning');
                if (ageReq) {
                    ageReq.classList.remove('success');
                    ageReq.classList.add('warning');
                }
                modalHeader.querySelector('i').className = 'fas fa-exclamation-triangle';
            } else {
                modalHeader.classList.remove('success', 'warning');
                modalBtn.classList.remove('success', 'warning');
                if (ageReq) ageReq.classList.remove('success', 'warning');
                modalHeader.querySelector('i').className = 'fas fa-exclamation-circle';
            }

            overlay.classList.add('active');
        }

        function closeModal() {
            const overlay = document.getElementById('modalOverlay');
            overlay.classList.remove('active');
        }

        // Close modal on overlay click
        document.getElementById('modalOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Function to check if appointment already exists
        async function checkExistingAppointment(name, dob, phone) {
            try {
                const formData = new FormData();
                formData.append('name', name);
                formData.append('dob', dob);
                formData.append('phone', phone);

                const response = await fetch('<?= URLROOT ?>/Appointment/find/check', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                return await response.json();
            } catch (error) {
                console.error('Error checking appointment:', error);
                return {
                    status: 'error',
                    message: 'Failed to check existing appointment. Please try again.'
                };
            }
        }

        // Function to submit form via AJAX
        async function submitFormAjax(formData) {
            try {
                // console.log(formData);
                const response = await fetch('<?= URLROOT ?>/Appointment/store', {
                    method: 'POST',
                    body: formData
                });

                // Since your backend redirects, we'll assume success if no error
                return {
                    success: true
                };
            } catch (error) {
                console.error('Form submission error:', error);
                return {
                    success: false,
                    message: 'Failed to submit appointment. Please try again.'
                };
            }
        }

        // Function to show success message and redirect
        function showSuccessAndRedirect() {
            // Show success modal
            showModal(
                'Appointment Successful!',
                'Your appointment has been successfully submitted. Thank you for your appointment...',
                'success'
            );
            // Redirect after showing success message (3 seconds delay)
            setTimeout(function() {
                window.location.href = '<?= URLROOT ?>/pages/dashboard';
            }, 3000); // 3 second delay to show success message
        }

        // Form submission with loading state and validation
        document.getElementById('appointmentForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const name = document.getElementById('name').value.trim();
            const dobInput = document.getElementById('dob').value;
            const phone = document.getElementById('phone').value.trim();
            const dob = new Date(dobInput);
            const today = new Date();

            // Validate required fields
            if (!name || !dobInput || !phone) {
                showModal(
                    'Missing Information',
                    'Please fill in all required fields (Name, Date of Birth, and Phone).'
                );
                return;
            }

            if (!dobInput || isNaN(dob)) {
                showModal(
                    'Invalid Date',
                    'Please enter a valid date of birth.'
                );
                return;
            }

            // Age validation
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            const dayDiff = today.getDate() - dob.getDate();
            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            if (age < 50) {
                showModal(
                    'Age Requirement Not Met',
                    'Sorry, appointments are only available for people aged <span class="age-requirement">50 and above</span>. Please check your date of birth and try again.'
                );
                return;
            }

            const container = document.querySelector('.form-container');
            const submitBtn = this.querySelector('.submit-btn');

            // Show loading state
            container.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            submitBtn.disabled = true;

            // Check if appointment already exists
            const checkResult = await checkExistingAppointment(name, dobInput, phone);

            if (checkResult.status === 'error') {
                // Remove loading state
                container.classList.remove('loading');
                submitBtn.innerHTML = 'Submit';
                submitBtn.disabled = false;

                showModal(
                    'Error',
                    checkResult.message
                );
                return;
            }

            if (checkResult.status === 'exists') {
                // Remove loading state
                container.classList.remove('loading');
                submitBtn.innerHTML = 'Submit';
                submitBtn.disabled = false;

                showModal(
                    'Appointment Already Exists',
                    'You already have an existing appointment with the same name, date of birth, and phone number. Please check your appointment status or contact us if you need to make changes.',
                    'warning'
                );
                return;
            }

            // If no existing appointment, proceed with submission
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

            // Create FormData from the form
            const formData = new FormData(this);

            // Submit form via AJAX to show success modal first
            const submitResult = await submitFormAjax(formData);

            if (submitResult.success) {
                // Show success modal and then redirect
                showSuccessAndRedirect();
            } else {
                // Remove loading state and show error
                container.classList.remove('loading');
                submitBtn.innerHTML = 'Submit';
                submitBtn.disabled = false;

                showModal(
                    'Submission Failed',
                    submitResult.message || 'Failed to submit appointment. Please try again.'
                );
            }
        });

        // Enhanced date input interaction
        const dateInputs = document.querySelectorAll('input[onfocus]');
        dateInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.type = 'text';
                }
            });
        });

        // Smooth animations on load
        window.addEventListener('load', function() {
            document.querySelector('.wrapper').style.opacity = '1';
        });

        // Enhanced file input feedback
        document.getElementById('photo').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const label = document.createElement('span');
                label.textContent = ` Selected: ${fileName}`;
                label.style.color = 'var(--success-color)';
                label.style.fontSize = '0.9rem';
                label.style.marginLeft = '0.5rem';

                const existing = this.parentNode.querySelector('span');
                if (existing) existing.remove();

                this.parentNode.appendChild(label);
            }
        });

        // Auto-resize for better mobile experience
        function adjustLayout() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }

        window.addEventListener('resize', adjustLayout);
        adjustLayout();

        // ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('modalOverlay').classList.contains('active')) {
                closeModal();
            }
        });
    </script>

</body>

</html>