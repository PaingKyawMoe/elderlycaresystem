<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Lookup</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/search.css?v=<?= time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Appointment Lookup</h1>
            <p>Enter your details to find your appointment</p>
        </div>

        <form id="lookupForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
            </div>

            <button type="submit" class="search-btn" id="searchBtn">
                <span class="btn-text">Search Appointment</span>
            </button>
        </form>

        <div id="result" class="result"></div>
    </div>
</body>

</html>

<script>
    document.getElementById("lookupForm").addEventListener("submit", function(e) {
        e.preventDefault(); // Stop default reload

        const formData = new FormData(this);

        fetch("<?php echo URLROOT; ?>/appointment/search", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(response => {
                const resultDiv = document.getElementById("result");
                resultDiv.classList.add('show');

                if (response.status === "found") {
                    const data = response.data;
                    resultDiv.innerHTML = `
                <h3>✅ Your Appointment Found!</h3>
                <div class="appointment-details">
                    <div class="detail-row"><span class="detail-label">Name:</span><span class="detail-value">${data.name}</span></div>
                    <div class="detail-row"><span class="detail-label">Gender:</span><span class="detail-value">${data.gender}</span></div>
                    <div class="detail-row"><span class="detail-label">DOB:</span><span class="detail-value">${data.dob}</span></div>
                    <div class="detail-row"><span class="detail-label">Phone:</span><span class="detail-value">${data.phone}</span></div>
                    <div class="detail-row"><span class="detail-label">Appointment Date:</span><span class="detail-value">${data.preferred_date}</span></div>
                    <div class="detail-row"><span class="detail-label">Address:</span><span class="detail-value">${data.address}</span></div>
                    <div class="detail-row"><span class="detail-label">Doctor:</span><span class="detail-value">${data.selectDoctor}</span></div>
                    <div class="detail-row"><span class="detail-label">AppointmentType:</span><span class="detail-value">${data.appointment_type}</span></div>
                    <div class="detail-row"><span class="detail-label">Reason:</span><span class="detail-value">${data.reasonForAppointment}</span></div>
                </div>
            `;
                } else {
                    resultDiv.innerHTML = `
                <h3>❌ Your Appointment Not Found</h3>
                <p style="color:#666;">Please check your information and try again.</p>
            `;
                }
            })
            .catch(err => {
                alert("Error searching appointment: " + err);
            });
    });
</script>