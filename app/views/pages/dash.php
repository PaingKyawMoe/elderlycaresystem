<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>For Your Health Dashboard</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dashboard.css?v=<?= time(); ?>">
</head>

<body>
  <div class="dashboard-bg">
    <div class="dashboard-content">
      <div class="dashboard-title">For Your Health</div>

      <div class="dashboard-actions">
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/Activities/index';">
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

        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/search';">
          <span class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="16" rx="2" />
              <path d="M7 8h10" />
              <path d="M7 12h10" />
              <path d="M7 16h6" />
            </svg>
          </span>
          View History
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

        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/signin';">
          <span class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="8" r="4" />
              <path d="M4 20v-2a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v2" />
            </svg>
          </span>
          Admin
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