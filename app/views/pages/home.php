<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Elderly Care System</title>
        <meta name="viewport" content="width=1366px, initial-scale=1.0">
    </head>
    <body>
  <!-- Header -->
  <div class="header">  
    <div class="logo">
      <img src="https://img.icons8.com/fluency/48/heart-with-pulse.png" alt="Logo">
      Elderly Care System
    </div>
    <nav>
      <a href="#">Home</a>
      <a href="<?php echo URLROOT; ?>/pages/dash.php">Service</a>
      <a href="<?php echo URLROOT; ?>/pages/about">About Us</a>
      <a href="<?php echo URLROOT; ?>/pages/admin">Admin</a>
      <button class="call-now">Call Now</button>
    </nav>
  </div>

  <!-- Hero Section -->
  <div class="hero">
    <div class="hero-content12">
      <h1>
        We are<br>
        Committed To<br>
        Quality Care
      </h1>
      <p>
        A care system for older people can use a variety of technologies.
      </p><a href="<?php echo URLROOT; ?>/pages/register">
      <button class="register-btn">Register</button></a>
    </div>
    <div class="hero-image1">
      <img class="main-img1" src="https://images.pexels.com/photos/7345476/pexels-photo-7345476.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Caregiver with elderly man">
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <div class="footer-section">
      <h4>About</h4>
      <ul>
        <li><a href="#">Our Story</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Support</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h4>Company</h4>
      <ul>
        <li><a href="#">Cookie Statement</a></li>
        <li><a href="#">Terms Of Service</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h4>Service</h4>
      <ul>
        <li><a href="#">HomeCare</a></li>
        <li><a href="#">ModernMachine</a></li>
        <li><a href="#">Reliability</a></li>
      </ul>
    </div>
    <div class="newsletter">
      <label for="newsletter-email">Subscribe To Our newsletter</label>
      <form class="newsletter-form" id="newsletter-form">
        <input type="email" id="newsletter-email" placeholder="Email address" required>
        <button type="submit">Subscribe</button>
      </form>
      <div class="footer-social">
        <a href="#"><i class="fab fa-facebook-square"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>

  <!-- JS for newsletter form -->
  <script>
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('newsletter-email').value;
      alert('Thank you for subscribing, ' + email + '!');
      document.getElementById('newsletter-email').value = '';
    });
  </script>
</body>
</html>
