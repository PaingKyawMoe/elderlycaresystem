<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>

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
                <label>Gender:</label>
                <input type="radio" id="male" name="gender" value="male" checked>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
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
                        <option value="consultation">Video Call</option>
                        <option value="checkup">In Person</option>
                        <option value="followup">Home Visit</option>
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
                        <option value="dr-smith">Dr. John Smith</option>
                        <option value="dr-jones">Dr. Emily Jones</option>
                        <option value="dr-davis">Dr. Michael Davis</option>
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
    
</div>
</form>
    <script>
       
    </script>
</body>
</html>