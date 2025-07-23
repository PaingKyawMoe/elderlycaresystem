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
                        <select name="reasonForAppointment" id="reasonForAppointment" required>
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

    <script>
        // Form submission with loading state and age validation
        document.getElementById('appointmentForm').addEventListener('submit', function(e) {
            const dobInput = document.getElementById('dob').value;
            const dob = new Date(dobInput);
            const today = new Date();

            if (!dobInput || isNaN(dob)) {
                alert("Please enter a valid date of birth.");
                e.preventDefault();
                return;
            }

            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            const dayDiff = today.getDate() - dob.getDate();
            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            if (age < 60) {
                alert("Appointments are only allowed for people aged 60 and above.");
                e.preventDefault();
                return;
            }

            const container = document.querySelector('.form-container');
            const submitBtn = this.querySelector('.submit-btn');

            container.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;
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
    </script>

</body>

</html>