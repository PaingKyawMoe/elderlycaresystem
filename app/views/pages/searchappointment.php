<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Lookup</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/search.css?v=<?= time(); ?>">

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
                padding-top: 60px;
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