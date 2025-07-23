<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In - Elder Care System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", "Segoe UI", system-ui, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow-x: hidden;
    }

    /* Animated background particles */
    .bg-animation {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .particle {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .particle:nth-child(1) {
      width: 80px;
      height: 80px;
      left: 10%;
      animation-delay: 0s;
    }

    .particle:nth-child(2) {
      width: 60px;
      height: 60px;
      left: 20%;
      animation-delay: 2s;
    }

    .particle:nth-child(3) {
      width: 40px;
      height: 40px;
      left: 70%;
      animation-delay: 1s;
    }

    .particle:nth-child(4) {
      width: 100px;
      height: 100px;
      left: 80%;
      animation-delay: 3s;
    }

    .particle:nth-child(5) {
      width: 50px;
      height: 50px;
      left: 50%;
      animation-delay: 1.5s;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
      }

      50% {
        transform: translateY(-100px) rotate(180deg);
        opacity: 0.3;
      }
    }

    .container {
      display: flex;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 900px;
      width: 90%;
      min-height: 600px;
      position: relative;
      z-index: 1;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .image-section {
      flex: 1;
      position: relative;
      background: linear-gradient(45deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .image-section::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("https://images.pexels.com/photos/8088870/pexels-photo-8088870.jpeg?auto=compress&cs=tinysrgb&w=600") center/cover;
      filter: brightness(0.7);
      transition: transform 0.3s ease;
    }

    .container:hover .image-section::before {
      transform: scale(1.05);
    }

    .image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
      padding: 2rem;
    }

    .image-overlay h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .image-overlay p {
      font-size: 1.1rem;
      opacity: 0.95;
      line-height: 1.6;
    }

    .form-section {
      flex: 1;
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: rgba(255, 255, 255, 0.9);
      position: relative;
    }

    .close-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: none;
      border: none;
      font-size: 24px;
      color: #a0aec0;
      cursor: pointer;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .close-btn:hover {
      background: #f7fafc;
      color: #667eea;
      transform: rotate(90deg);
    }

    .form-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-header h1 {
      font-size: 2.2rem;
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 0.5rem;
      background: linear-gradient(135deg, #667eea, #764ba2);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .form-header p {
      color: #718096;
      font-size: 1rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .input-container {
      position: relative;
      transition: transform 0.3s ease;
    }

    .form-input {
      width: 100%;
      padding: 1rem 1rem 1rem 3rem;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
      outline: none;
    }

    .form-input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      transform: translateY(-1px);
    }

    .form-input.error {
      border-color: #f56565;
      background: #fef5f5;
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #a0aec0;
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }

    .form-input:focus+.input-icon {
      color: #667eea;
    }

    .floating-label {
      position: absolute;
      left: 3rem;
      top: 50%;
      transform: translateY(-50%);
      color: #a0aec0;
      font-size: 1rem;
      pointer-events: none;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.9);
      padding: 0 0.5rem;
    }

    .form-input:focus~.floating-label,
    .form-input:not(:placeholder-shown)~.floating-label {
      top: 0;
      font-size: 0.85rem;
      color: #667eea;
      font-weight: 500;
    }

    .password-wrapper {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #a0aec0;
      cursor: pointer;
      padding: 4px;
      border-radius: 4px;
      transition: all 0.3s ease;
      font-size: 1.1rem;
    }

    .toggle-password:hover {
      color: #667eea;
      background: rgba(102, 126, 234, 0.1);
    }

    .error-message {
      background: linear-gradient(135deg, #fed7d7, #feb2b2);
      color: #c53030;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      font-size: 0.875rem;
      margin-top: 0.5rem;
      border-left: 4px solid #f56565;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      animation: slideDown 0.3s ease-out;
      box-shadow: 0 4px 12px rgba(245, 101, 101, 0.15);
    }

    .error-message::before {
      content: "⚠️";
      font-size: 1rem;
    }

    .error-message.fade-out {
      animation: slideUp 0.3s ease-out forwards;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideUp {
      from {
        opacity: 1;
        transform: translateY(0);
      }

      to {
        opacity: 0;
        transform: translateY(-10px);
      }
    }

    .forgot-password {
      text-align: right;
      margin-bottom: 1.5rem;
    }

    .forgot-password a {
      color: #667eea;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
    }

    .forgot-password a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 0;
      background: linear-gradient(135deg, #667eea, #764ba2);
      transition: width 0.3s ease;
    }

    .forgot-password a:hover::after {
      width: 100%;
    }

    .forgot-password a:hover {
      color: #764ba2;
    }

    .submit-btn {
      width: 100%;
      padding: 1rem;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 1rem;
      position: relative;
      overflow: hidden;
    }

    .submit-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .submit-btn:hover::before {
      left: 100%;
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    .signup-link {
      text-align: center;
      margin-top: 2rem;
      color: #718096;
      font-size: 0.95rem;
    }

    .signup-link a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .signup-link a:hover {
      color: #764ba2;
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        margin: 1rem;
        max-width: none;
      }

      .image-section {
        min-height: 200px;
      }

      .form-section {
        padding: 2rem;
      }

      .image-overlay h2 {
        font-size: 2rem;
      }

      .form-header h1 {
        font-size: 1.8rem;
      }
    }

    /* Loading animation */
    .btn-loading {
      position: relative;
      color: transparent !important;
    }

    .btn-loading::after {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      width: 20px;
      height: 20px;
      margin: -10px 0 0 -10px;
      border: 2px solid #ffffff;
      border-radius: 50%;
      border-top-color: transparent;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    /* Success message styling */
    .success-message {
      background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
      color: #2f855a;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      font-size: 0.875rem;
      margin-bottom: 1rem;
      border-left: 4px solid #38a169;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      animation: slideDown 0.3s ease-out;
      box-shadow: 0 4px 12px rgba(56, 161, 105, 0.15);
    }

    .success-message::before {
      content: "✅";
      font-size: 1rem;
    }
  </style>
</head>

<body>
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
        <?php if (isset($_SESSION['success_message'])): ?>
          <div class="success-message">
            <?php echo $_SESSION['success_message'];
            unset($_SESSION['success_message']); ?>
          </div>
        <?php endif; ?>

        <?php if (isset($data['login-err'])): ?>
          <div class="error-message">
            <?php echo $data['login-err']; ?>
          </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_login'])): ?>
          <div class="error-message">
            <?php echo $_SESSION['error_login'];
            unset($_SESSION['error_login']); ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <?php if (isset($data['email-err'])): ?>
            <div class="error-message" data-error-type="email">
              <?php echo $data['email-err']; ?>
            </div>
          <?php endif; ?>
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
        </div>

        <div class="form-group">
          <?php if (isset($data['password-err'])): ?>
            <div class="error-message" data-error-type="password">
              <?php echo $data['password-err']; ?>
            </div>
          <?php endif; ?>
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
        </div>

        <div class="forgot-password">
          <a href="<?php echo URLROOT; ?>/users/forgot">Forgot Password?</a>
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

      // Auto-hide error and success messages after 5 seconds
      function hideMessages() {
        const messages = document.querySelectorAll('.error-message, .success-message');

        messages.forEach(function(messageElement) {
          setTimeout(function() {
            messageElement.classList.add('fade-out');

            setTimeout(function() {
              if (messageElement.parentNode) {
                messageElement.remove();

                // Remove error class from input
                const inputContainer = messageElement.parentNode.querySelector('.input-container');
                if (inputContainer) {
                  const input = inputContainer.querySelector('.form-input.error');
                  if (input) {
                    input.classList.remove('error');
                  }
                }
              }
            }, 300);
          }, 4700);
        });
      }

      // Initialize message hiding
      hideMessages();

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

    function togglePassword() {
      const passwordField = document.getElementById('passwordInput');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.textContent = '👁️';
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

    // Mutation observer for dynamic error handling
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.addedNodes.length > 0) {
          const messages = document.querySelectorAll('.error-message, .success-message');
          if (messages.length > 0) {
            hideMessages();
          }
        }
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true
    });
  </script>
</body>

</html>