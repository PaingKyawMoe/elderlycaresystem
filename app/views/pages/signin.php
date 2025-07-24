<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In - Elder Care System</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/signin.css?v=<?= time(); ?>">
</head>

<body>
  <?php if (session_id() == '') session_start(); ?>

  <!-- Fixed Message Container -->
  <div class="message-container" id="messageContainer">
    <?php if (isset($_SESSION['error'])): ?>
      <div class="message-box error">
        <span class="message-icon">⚠️</span>
        <span class="message-text">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </span>
        <button class="message-close" onclick="closeMessage(this)">×</button>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
      <div class="message-box success">
        <span class="message-icon">✅</span>
        <span class="message-text">
          <?php echo $_SESSION['success_message'];
          unset($_SESSION['success_message']); ?>
        </span>
        <button class="message-close" onclick="closeMessage(this)">×</button>
      </div>
    <?php endif; ?>

    <?php if (isset($data['login-err'])): ?>
      <div class="message-box error">
        <span class="message-icon">🔐</span>
        <span class="message-text"><?php echo $data['login-err']; ?></span>
        <button class="message-close" onclick="closeMessage(this)">×</button>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_login'])): ?>
      <div class="message-box error">
        <span class="message-icon">❌</span>
        <span class="message-text">
          <?php echo $_SESSION['error_login'];
          unset($_SESSION['error_login']); ?>
        </span>
        <button class="message-close" onclick="closeMessage(this)">×</button>
      </div>
    <?php endif; ?>
  </div>

  <div class="bg-animation">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>

  <div class="container">
    <div class="image-section">
      <div class="image-overlay">
        <h2>Welcome Back!</h2>
        <p>Living Life to the Fullest begins right now with you. Access your caring community and comprehensive elder care services.</p>
      </div>
    </div>

    <div class="form-section">
      <button class="close-btn" onclick="closeLoginBox()" aria-label="Close login form">×</button>

      <div class="form-header">
        <h1>Sign In</h1>
        <p>Welcome back! Please sign in to your account</p>
      </div>

      <form method="POST" action="<?= URLROOT ?>/Auth/login" id="loginForm">
        <div class="form-group">
          <div class="input-container">
            <input type="email"
              name="email"
              class="form-input <?php echo isset($data['email-err']) ? 'error' : ''; ?>"
              placeholder=" "
              value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>"
              required
              autocomplete="email">
            <div class="input-icon">📧</div>
            <label class="floating-label">Email Address</label>
          </div>
          <?php if (isset($data['email-err'])): ?>
            <div class="field-error">
              <?php echo $data['email-err']; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <div class="input-container password-wrapper">
            <input type="password"
              name="password"
              class="form-input <?php echo isset($data['password-err']) ? 'error' : ''; ?>"
              placeholder=" "
              id="passwordInput"
              required
              autocomplete="current-password">
            <div class="input-icon">🔒</div>
            <label class="floating-label">Password</label>
            <span class="toggle-password" onclick="togglePassword()" title="Show/Hide Password">
              <span id="eyeIcon">👁️</span>
            </span>
          </div>
          <?php if (isset($data['password-err'])): ?>
            <div class="field-error">
              <?php echo $data['password-err']; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="forgot-password">
          <a href="<?php echo URLROOT; ?>/pages/signin">Forgot Password?</a>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
          Sign In
        </button>

        <div class="signup-link">
          Don't have an account? <a href="<?php echo URLROOT; ?>/pages/register">Create Account</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('loginForm');
      const submitBtn = document.getElementById('submitBtn');

      // Auto-hide messages after 5 seconds
      function autoHideMessages() {
        const messages = document.querySelectorAll('.message-box');
        messages.forEach(function(message) {
          setTimeout(function() {
            if (message && message.parentNode) {
              closeMessage(message.querySelector('.message-close'));
            }
          }, 5000);
        });
      }

      // Initialize auto-hide
      autoHideMessages();

      // Input focus animations
      const inputs = document.querySelectorAll('.form-input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentNode.style.transform = 'scale(1.02)';
        });

        input.addEventListener('blur', function() {
          this.parentNode.style.transform = 'scale(1)';
        });
      });

      // Real-time email validation
      const emailInput = document.querySelector('input[name="email"]');
      if (emailInput) {
        emailInput.addEventListener('input', function() {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (this.value && !emailRegex.test(this.value)) {
            this.classList.add('error');
          } else {
            this.classList.remove('error');
          }
        });
      }

      // Form submission with loading state
      form.addEventListener('submit', function(e) {
        // Show loading state
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;

        // Re-enable button after 5 seconds as fallback
        setTimeout(function() {
          submitBtn.classList.remove('btn-loading');
          submitBtn.disabled = false;
        }, 5000);
      });

      // Remember form values on page reload
      const savedEmail = localStorage.getItem('login_email');
      if (savedEmail && emailInput) {
        emailInput.value = savedEmail;
      }

      // Save email on input
      if (emailInput) {
        emailInput.addEventListener('input', function() {
          localStorage.setItem('login_email', this.value);
        });
      }
    });

    function closeMessage(btn) {
      const messageBox = btn.parentElement;
      messageBox.classList.add('fade-out');
      setTimeout(function() {
        messageBox.remove();
        // Check if message container is empty and hide it
        const container = document.getElementById('messageContainer');
        if (container && container.children.length === 0) {
          container.style.display = 'none';
        }
      }, 300);
    }

    function togglePassword() {
      const passwordField = document.getElementById('passwordInput');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.textContent = '👁️‍🗨️';
      } else {
        passwordField.type = 'password';
        eyeIcon.textContent = '👁️';
      }
    }

    function closeLoginBox() {
      // Option 1: Hide the container
      document.querySelector('.container').style.display = 'none';

      // Option 2: Redirect to home page (uncomment if preferred)
      // window.location.href = '<?php echo URLROOT; ?>/';

      // Option 3: Go back in history
      // window.history.back();
    }

    // Keyboard accessibility
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeLoginBox();
      }
    });

    // Handle dynamic message creation
    function showMessage(text, type = 'error') {
      const container = document.getElementById('messageContainer');
      container.style.display = 'block';

      const messageBox = document.createElement('div');
      messageBox.className = `message-box ${type}`;
      messageBox.innerHTML = `
        <span class="message-icon">${type === 'success' ? '✅' : '⚠️'}</span>
        <span class="message-text">${text}</span>
        <button class="message-close" onclick="closeMessage(this)">×</button>
      `;

      container.appendChild(messageBox);

      // Auto-hide after 5 seconds
      setTimeout(function() {
        if (messageBox && messageBox.parentNode) {
          closeMessage(messageBox.querySelector('.message-close'));
        }
      }, 5000);
    }
  </script>
</body>

</html>