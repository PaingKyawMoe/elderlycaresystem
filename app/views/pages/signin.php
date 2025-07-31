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
        <span class="message-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L1 21H23L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 9V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 17H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
        <span class="message-text">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </span>
        <button class="message-close" onclick="closeMessage(this)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
      <div class="message-box success">
        <span class="message-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4905 2.02168 11.3363C2.16356 9.18203 2.99721 7.13214 4.39828 5.49883C5.79935 3.86553 7.69279 2.72636 9.79619 2.24223C11.8996 1.75809 14.1003 1.95185 16.07 2.79" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
        <span class="message-text">
          <?php echo $_SESSION['success_message'];
          unset($_SESSION['success_message']); ?>
        </span>
        <button class="message-close" onclick="closeMessage(this)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
    <?php endif; ?>

    <?php if (isset($data['login-err'])): ?>
      <div class="message-box error">
        <span class="message-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2" />
            <circle cx="12" cy="16" r="1" fill="currentColor" />
            <path d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
        <span class="message-text"><?php echo $data['login-err']; ?></span>
        <button class="message-close" onclick="closeMessage(this)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_login'])): ?>
      <div class="message-box error">
        <span class="message-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
            <path d="M15 9L9 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M9 9L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
        <span class="message-text">
          <?php echo $_SESSION['error_login'];
          unset($_SESSION['error_login']); ?>
        </span>
        <button class="message-close" onclick="closeMessage(this)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
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
      <button class="close-btn" onclick="closeLoginBox()" aria-label="Close login form">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>

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
            <div class="input-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
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
            <div class="input-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2" />
                <circle cx="12" cy="16" r="1" fill="currentColor" />
                <path d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <label class="floating-label">Password</label>
            <span class="toggle-password" onclick="togglePassword()" title="Show/Hide Password">
              <span id="eyeIcon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" />
                </svg>
              </span>
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

  <style>
    /* Additional styles for SVG icons */
    .message-icon svg {
      display: block;
    }

    .input-icon svg {
      color: #64748b;
      transition: color 0.3s ease;
    }

    .form-input:focus+.input-icon svg {
      color: #3b82f6;
    }

    .toggle-password svg {
      color: #64748b;
      transition: color 0.3s ease;
    }

    .toggle-password:hover svg {
      color: #3b82f6;
    }

    .close-btn svg {
      transition: transform 0.3s ease;
    }

    .close-btn:hover svg {
      transform: rotate(90deg);
    }

    .message-close svg {
      transition: transform 0.2s ease;
    }

    .message-close:hover svg {
      transform: scale(1.1);
    }

    /* Error state for input icons */
    .form-input.error+.input-icon svg {
      color: #ef4444;
    }
  </style>

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
        eyeIcon.innerHTML = `
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.68192 4.028 7.66313 6.17 6.17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.9 4.24C10.5883 4.0789 11.2931 3.99836 12 4C19 4 23 12 23 12C22.393 13.1356 21.6691 14.2048 20.84 15.19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.12 14.12C13.8454 14.4148 13.5141 14.6512 13.1462 14.8151C12.7782 14.9791 12.3809 15.0673 11.9781 15.0744C11.5753 15.0815 11.1749 15.0074 10.8016 14.8565C10.4282 14.7056 10.0887 14.4811 9.80385 14.1962C9.51895 13.9113 9.29441 13.5718 9.14351 13.1984C8.99261 12.8251 8.91853 12.4247 8.92563 12.0219C8.93274 11.6191 9.02091 11.2218 9.18488 10.8538C9.34884 10.4859 9.58525 10.1546 9.88 9.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1 1L23 23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        `;
      } else {
        passwordField.type = 'password';
        eyeIcon.innerHTML = `
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
          </svg>
        `;
      }
    }

    function closeLoginBox() {
      // Option 1: Hide the container
      // document.querySelector('.container').style.display = 'none';

      // Option 3: Go back in history
      window.history.back();
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

      let iconSvg = '';
      if (type === 'success') {
        iconSvg = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4905 2.02168 11.3363C2.16356 9.18203 2.99721 7.13214 4.39828 5.49883C5.79935 3.86553 7.69279 2.72636 9.79619 2.24223C11.8996 1.75809 14.1003 1.95185 16.07 2.79" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
      } else {
        iconSvg = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 2L1 21H23L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 9V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 17H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
      }

      messageBox.innerHTML = `
        <span class="message-icon">${iconSvg}</span>
        <span class="message-text">${text}</span>
        <button class="message-close" onclick="closeMessage(this)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
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