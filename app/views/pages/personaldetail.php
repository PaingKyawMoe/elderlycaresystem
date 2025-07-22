<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elderly Care System - User Profile</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/personal.css?v=<?= time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Elderly Care System</h1>
            <p class="subtitle">Comprehensive Care Management</p>
        </div>

        <!-- Alert for existing user -->
        <div class="alert warning" id="existingUserAlert" style="display: none;">
            <span class="alert-icon">⚠️</span>
            <div>
                <strong>Account Already Exists!</strong>
                <p>We found an existing account with this information. Your previous data is displayed below.</p>
            </div>
        </div>

        <!-- Registration form for new users -->
        <div class="registration-form" id="registrationForm">
            <h3 style="margin-bottom: 20px; color: #2c3e50;">Register New Patient</h3>
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" id="newName" placeholder="Enter full name">
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="newPhone" placeholder="Enter phone number">
            </div>
            <div class="form-group">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="newDOB">
            </div>
            <div class="action-buttons">
                <button class="btn btn-success" onclick="checkExistingUser()">
                    <span id="checkingLoader" style="display: none;" class="loading"></span>
                    Register Patient
                </button>
            </div>
        </div>

        <!-- Profile display for existing users -->
        <div class="profile-content" id="profileContent" style="display: none;">
            <div class="profile-header">
                <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=300&h=300&fit=crop&crop=face" alt="Patient Photo" class="profile-image" id="patientPhoto">
                <div class="profile-basic">
                    <h2 class="profile-name" id="patientName">Mg Mg</h2>
                    <div class="profile-meta">
                        <span class="meta-item" id="patientGender">Male</span>
                        <span class="meta-item" id="patientAge">54 years old</span>
                        <span class="meta-item" id="appointmentType">In person</span>
                    </div>
                </div>
            </div>

            <div class="profile-grid">
                <div class="info-card">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-value" id="dobValue">20.6.1970</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Last Visit</div>
                    <div class="info-value" id="lastVisitValue">26.5.2025</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value" id="phoneValue">750231601</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Preferred Time</div>
                    <div class="info-value" id="timeSlotValue">Morning</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Address</div>
                    <div class="info-value" id="addressValue">123, Street Yangon</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Assigned Doctor</div>
                    <div class="info-value" id="doctorValue">Dr. Paing</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Medical History</div>
                    <div class="info-value" id="medicalHistoryValue">Chronic illness</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Insurance Status</div>
                    <div class="info-value" id="insuranceValue">Active Coverage</div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn btn-primary" onclick="editProfile()">Update Profile</button>
                <button class="btn btn-success" onclick="window.location.href='<?= URLROOT; ?>/pages/appointmentform'">
                    Book New Appointment
                </button>
                <button class="btn btn-secondary" onclick="viewHistory()">View Medical History</button>
            </div>
        </div>
    </div>

    <script>
        // Sample database of existing users
        const existingUsers = {
            "750231601": {
                name: "Mg Mg",
                gender: "Male",
                dob: "20.6.1970",
                phone: "750231601",
                lastVisit: "26.5.2025",
                timeSlot: "Morning",
                address: "123, Street Yangon",
                doctor: "Dr. Paing",
                medicalHistory: "Chronic illness, Hypertension",
                insurance: "Active Coverage",
                photo: "https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=300&h=300&fit=crop&crop=face",
                age: 54,
                appointmentType: "In person"
            },
            "9876543210": {
                name: "Daw Khin",
                gender: "Female",
                dob: "15.3.1955",
                phone: "9876543210",
                lastVisit: "20.7.2025",
                timeSlot: "Afternoon",
                address: "456, Main Road Mandalay",
                doctor: "Dr. Thant",
                medicalHistory: "Diabetes, Joint pain",
                insurance: "Pending Renewal",
                photo: "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=300&h=300&fit=crop&crop=face",
                age: 70,
                appointmentType: "Telemedicine"
            }
        };

        // Show registration form initially
        document.getElementById('registrationForm').style.display = 'block';

        function checkExistingUser() {
            const phone = document.getElementById('newPhone').value;
            const name = document.getElementById('newName').value;

            if (!phone || !name) {
                alert('Please fill in all required fields');
                return;
            }

            // Show loading
            document.getElementById('checkingLoader').style.display = 'inline-block';

            // Simulate API call delay
            setTimeout(() => {
                document.getElementById('checkingLoader').style.display = 'none';

                // Check if user exists in our "database"
                const existingUser = existingUsers[phone];

                if (existingUser) {
                    // User exists - show their profile
                    showExistingUserProfile(existingUser);
                } else {
                    // New user - proceed with registration
                    registerNewUser(name, phone);
                }
            }, 1500);
        }

        function showExistingUserProfile(userData) {
            // Show alert
            document.getElementById('existingUserAlert').style.display = 'flex';

            // Hide registration form
            document.getElementById('registrationForm').style.display = 'none';

            // Populate profile data
            document.getElementById('patientName').textContent = userData.name;
            document.getElementById('patientGender').textContent = userData.gender;
            document.getElementById('patientAge').textContent = userData.age + ' years old';
            document.getElementById('appointmentType').textContent = userData.appointmentType;
            document.getElementById('patientPhoto').src = userData.photo;
            document.getElementById('dobValue').textContent = userData.dob;
            document.getElementById('lastVisitValue').textContent = userData.lastVisit;
            document.getElementById('phoneValue').textContent = userData.phone;
            document.getElementById('timeSlotValue').textContent = userData.timeSlot;
            document.getElementById('addressValue').textContent = userData.address;
            document.getElementById('doctorValue').textContent = userData.doctor;
            document.getElementById('medicalHistoryValue').textContent = userData.medicalHistory;
            document.getElementById('insuranceValue').textContent = userData.insurance;

            // Show profile content with animation
            document.getElementById('profileContent').style.display = 'block';
            document.getElementById('profileContent').classList.add('fade-in');
        }

        function registerNewUser(name, phone) {
            // Simulate successful registration
            alert(`Registration successful for ${name}!\nPhone: ${phone}\nYou can now proceed to book an appointment.`);

            // In a real application, you would:
            // 1. Send data to backend API
            // 2. Create new user record in database
            // 3. Redirect to next step or show success message
        }

        function editProfile() {
            alert('Edit Profile functionality would open a form to update patient information.');
        }

        function bookAppointment() {
            alert('Book Appointment functionality would open the appointment booking system.');
        }

        function viewHistory() {
            alert('View Medical History functionality would display detailed medical records.');
        }

        // Demo function to test with different users
        function testExistingUser(phone) {
            document.getElementById('newPhone').value = phone;
            document.getElementById('newName').value = 'Test User';
            checkExistingUser();
        }

        // Add some demo buttons for testing (remove in production)
        window.addEventListener('load', function() {
            const demoDiv = document.createElement('div');
            demoDiv.innerHTML = `
                <div style="position: fixed; bottom: 20px; right: 20px; background: rgba(0,0,0,0.8); color: white; padding: 15px; border-radius: 10px; z-index: 1000;">
                    <strong>Demo Controls:</strong><br>
                    <button onclick="testExistingUser('750231601')" style="margin: 5px; padding: 5px 10px; border: none; border-radius: 5px; background: #3498db; color: white; cursor: pointer;">Test Mg Mg</button><br>
                    <button onclick="testExistingUser('9876543210')" style="margin: 5px; padding: 5px 10px; border: none; border-radius: 5px; background: #e74c3c; color: white; cursor: pointer;">Test Daw Khin</button><br>
                    <button onclick="location.reload()" style="margin: 5px; padding: 5px 10px; border: none; border-radius: 5px; background: #95a5a6; color: white; cursor: pointer;">Reset</button>
                </div>
            `;
            document.body.appendChild(demoDiv);
        });
    </script>
</body>

</html>