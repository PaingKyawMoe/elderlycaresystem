<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>For Your Health Dashboard</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dashboard.css?v=<?= time(); ?>">
</head>
<style>
  .logout-btn {
    background: #e74c3c;
    /* red */
    color: #fff;
    border: none;
    margin-top: 20px;
    padding: 10px 18px;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
  }

  .logout-btn:hover {
    background: #c0392b;
    /* darker red on hover */
    transform: translateY(-2px);
  }

  .logout-btn:active {
    transform: scale(0.95);
  }
</style>

<body>


  <div class="dashboard-bg">
    <div class="dashboard-content">
      <div class="dashboard-title">For Your Health</div>
      <div style="position: absolute; top: 20px; right: 20px;">
        <button class="logout-btn" onclick="location.href='<?= URLROOT ?>/Auth/logout';">
          Logout
        </button>
      </div>
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
          Search History
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