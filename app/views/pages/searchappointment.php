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
    <!-- Main content wrapper to separate from the footer -->
    <div class="page-wrapper">
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
    </div>
    <!-- End of main content wrapper -->

    <!-- Footer starts here -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-section">
                    <h4>About</h4>
                    <ul>
                        <li><a href="#">Our Story</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">Cookie Statement</a></li>
                        <li><a href="#">Terms Of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Service</h4>
                    <ul>
                        <li><a href="#">HomeCare</a></li>
                        <li><a href="#">ModernMachine</a></li>
                        <li><a href="#">Reliability</a></li>
                        <li><a href="#">24/7 Support</a></li>
                    </ul>
                </div>

                <div class="newsletter">
                    <h4>Stay Updated</h4>
                    <form class="newsletter-form" id="newsletter-form">
                        <input type="email" id="newsletter-email" placeholder="Enter your email" required
                            autocomplete="email">
                        <button type="submit">Subscribe</button>
                    </form>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends here -->

    <script>
        document.getElementById("lookupForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("<?php echo URLROOT; ?>/appointment/find/search", {
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
                            <h3 style="text-align: center;">Your Appointment Found!</h3>
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
                            <h3 style="text-align:center;">Your Appointment Not Found</h3>
                            <p style="color:red;text-align:center;">Please check your information and try again.</p>
                        `;
                    }
                })
                .catch(err => {
                    alert("Error searching appointment: " + err);
                });
        });
    </script>
</body>

</html>