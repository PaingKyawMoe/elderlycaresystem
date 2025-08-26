<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>For Your Health Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dashboard.css?v=<?= time(); ?>">
</head>
<style>
  /* Navigation Bar Styles */
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
    padding-top: 60px;
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

<body>
  <!-- Navigation Bar -->
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
      <a href="<?= URLROOT ?>/auth/logout" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i>
        Logout
      </a>
    </div>
  </nav>



  <div class="dashboard-bg">
    <div class="dashboard-content">
      <div class="dashboard-title">For Your Health</div>

      <div class="dashboard-actions">

        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/Activities/elderlyview';">
          <span class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="8" cy="4" r="2" />
              <path d="M8 6v5l-2 5" />
              <path d="M8 11l2 2 4-2 2 7" />
              <path d="M16 19a2 2 0 1 0 0-4" />
            </svg>
          </span>
          Activities
        </button>
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/viewAppionment';">
          <span class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="16" rx="2" />
              <path d="M7 8h10" />
              <path d="M7 12h10" />
              <path d="M7 16h6" />
            </svg>
          </span>
          Appointment History
        </button>
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/appointmentform';">
          <span class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M16 3v4" />
              <path d="M8 3v4" />
              <path d="M3 9h18" />
            </svg>
          </span>
          Appointment
        </button>

        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/search';">
          <span class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="16" rx="2" />
              <path d="M7 8h10" />
              <path d="M7 12h10" />
              <path d="M7 16h6" />
            </svg>
          </span>
          Appointment Search
        </button>
      </div>
      <div class="dashboard-lower">
        <div class="lower-img">
          <img src="https://plus.unsplash.com/premium_photo-1681995526481-fe0763f510cd?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGVsZGVybHljYXJlfGVufDB8fDB8fHww" alt="Healthcare professionals providing care">
        </div>
        <div class="lower-text">
          <div class="subtitle">Specialist Doctors and Modern Technology</div>
          <div class="desc">
            Experience comprehensive healthcare with our team of specialist doctors equipped with cutting-edge medical technology. We provide personalized care tailored to your unique health needs, ensuring the highest standards of medical excellence and patient satisfaction.
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>