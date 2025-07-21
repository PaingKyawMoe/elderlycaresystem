<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Responsive Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="main-wrapper">
    <div class="img-col">
      <img src="https://images.pexels.com/photos/8088870/pexels-photo-8088870.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Caregiver and elderly person">
    </div>
    <div class="content-col">
      <div class="headline">
        <h2>Living Life in the Fullest begin<br>right now with you.</h2>
      </div>

      <div class="login-box" id="loginBox">
        <button class="close-btn" onclick="closeLoginBox()">&times;</button>
        <h2>Login</h2>

        <form method="POST" action="pages/dash.php" autocomplete="off">
          <!-- Email Input -->
          <div class="input-group">
            <span class="input-icon">
              <svg width="20" height="20" fill="none" stroke="#222" stroke-width="1.5" viewBox="0 0 24 24">
                <rect x="2" y="5" width="20" height="14" rx="2.5"/>
                <path d="M2 7l10 6 10-6"/>
              </svg>
            </span>
            <input type="email" id="email" name="email" placeholder="Email" required>
          </div>

          <!-- Password Input -->
          <div class="input-group">
            <span class="input-icon">
              <svg width="20" height="20" fill="none" stroke="#222" stroke-width="1.5" viewBox="0 0 24 24">
                <rect x="5" y="11" width="14" height="8" rx="2"/>
                <path d="M12 15v2"/>
                <circle cx="12" cy="15" r="1"/>
                <path d="M8 11V9a4 4 0 1 1 8 0v2"/>
              </svg>
            </span>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()" title="Show/Hide Password">
              <svg id="eyeIcon" fill="none" stroke="#222" stroke-width="1.5" viewBox="0 0 24 24">
                <ellipse cx="12" cy="12" rx="8" ry="5"/>
                <circle cx="12" cy="12" r="2"/>
              </svg>
            </span>
          </div>

          <!-- Forgot Link -->
          <div class="forgot">
            <a href="<?php echo URLROOT; ?>/users/forgot">Forgot Password?</a>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="login-btn">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function togglePassword() {
      const pwd = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        eyeIcon.innerHTML = '<ellipse cx="12" cy="12" rx="8" ry="5"/><circle cx="12" cy="12" r="2"/><line x1="4" y1="4" x2="20" y2="20" stroke="#222" stroke-width="1.5"/>';
      } else {
        pwd.type = 'password';
        eyeIcon.innerHTML = '<ellipse cx="12" cy="12" rx="8" ry="5"/><circle cx="12" cy="12" r="2"/>';
      }
    }

    function closeLoginBox() {
      document.getElementById('loginBox').style.display = 'none';
    }
  </script>
</body>
</html>
