<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/appointmentform.css?v=<?= time(); ?>">

</head>

<body>
    <div class="wrapper">
        <div class="form-container">
            <h1>Appointment Form</h1>
            <form id="appointmentForm" method="POST" action="<?= URLROOT ?>/Appointment/store" enctype="multipart/form-data">
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
                            <option value="dr-paing">Dr. Paing</option>
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