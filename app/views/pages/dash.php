<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>For Your Health Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="dashboard-bg">
    
    <div class="dashboard-content">
      <div class="dashboard-title">For Your Health</div>
      <div class="dashboard-actions">
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/signin';">
          <span class="action-icon">
            <!-- Activities SVG -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="8" cy="4" r="2"/>
              <path d="M8 6v5l-2 5"/>
              <path d="M8 11l2 2 4-2 2 7"/>
              <path d="M16 19a2 2 0 1 0 0-4"/>
            </svg>
          </span>
          Activities
        </button>
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/signin';">
          <span class="action-icon">
            <!-- View History SVG -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="16" rx="2"/>
              <path d="M7 8h10"/>
              <path d="M7 12h10"/>
              <path d="M7 16h6"/>
            </svg>
          </span>
          View History
        </button>
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/appointmentform';">
          <span class="action-icon">
            <!-- Appointment SVG -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="5" width="18" height="16" rx="2"/>
              <path d="M16 3v4"/>
              <path d="M8 3v4"/>
              <path d="M3 9h18"/>
            </svg>
          </span>
          Appointment
        </button>
        <button class="action-card" tabindex="0" onclick="location.href='<?= URLROOT ?>/pages/userlist';">
          <span class="action-icon">
            <!-- Admin SVG -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 20v-2a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v2"/>
            </svg>
          </span>
          Admin
        </button>
      </div>
      <div class="dashboard-lower">
        <div class="lower-img">
          <img src="https://images.pexels.com/photos/7551677/pexels-photo-7551677.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Doctor protecting family">
        </div>
        <div class="lower-text">
          <div class="subtitle">Specialist Doctors and<br>Modern Technology</div>
          <div class="desc">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis maxime hic corporis minus repellat quo cumque ipsam libero, voluptatum sunt earum odio officia delectus eos dolore laborum doloribus voluptatem. Repellendus debitis facilis aperiam nihil!
          </div>
        </div>
      </div>
    </div>
  </div>
 
</body>
</html>
