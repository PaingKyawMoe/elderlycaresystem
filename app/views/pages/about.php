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
      <a href="<?php echo URLROOT; ?>/pages/home">Home</a>
      <a href="">Service</a>
      <a href="">About Us</a>
      <a href="">Admin</a>
      <button class="call-now">Call Now</button>
    </nav>
  </div>

  <!-- Hero Section -->
  <div class="hero">
    <div class="hero-content13">
      <h1>
        About Us.
      </h1>
      <p>
       At Elderly People Care System (EPCS), we are committed to supporting the aging population with care, compassion, and cutting-edge technology. Our platform was founded with a single goal in mind: to improve the quality of life for elderly individuals and simplify the caregiving process. As populations age around the world, it has become increasingly important to ensure that senior citizens can live with independence, dignity, and access to essential care services.
Our system is a comprehensive care management platform built to support elderly people, their families, and their healthcare providers. Whether it’s booking appointments, managing medical records, tracking medications, or ensuring emergency readiness — EPCS is here to support every aspect of elderly care.
We believe that technology can empower aging individuals and help them live safer, healthier, and happier lives — and that belief drives every feature we build.
      </p>
    </div>
  
      <!-- From Uiverse.io by SnyDeTreves --> 
<div class="map-container" style="width: 400px; height: 400px;">
  <svg width="400" height="400" viewBox="0 0 500 500" class="map-background">
    <rect style="fill: #f5f0e5" width="500" height="500"></rect>
    <path
      style="fill: #90daee"
      d="M0,367.82c5.83-4.39,14.42-10.16,25.59-15.34,4.52-2.09,43.19-19.51,79.55-11.93,36.1,7.52,35.75,32.55,78.41,60.23,46.34,30.06,109.47,41.21,123.32,22.1,11.95-16.49-22.61-41.92-13.66-84.6,4.85-23.1,22.33-50.71,47.73-58.52,42.42-13.05,78.83,39.45,102.84,23.86,15.81-10.26.01-32.87,22.73-74.43,5.8-10.62,11.65-21.15,11.93-36.93.28-15.69-5.63-26.64-7.95-32.39-6.66-16.45-6.21-45.15,28.84-98.55.23,146.23.46,292.46.69,438.69H0v-132.18Z"
    ></path>
  </svg>

  <div class="map-cities">
    <div style="--x: 5; --y: 66;" class="map-city">
      <div class="map-city__label">
        <span class="map-city__sign">Meikhtila</span>
      </div>
    </div>
    <div style="--x: 32; --y: 32;" class="map-city">
      <div class="map-city__label">
        <span class="map-city__sign anim anim-grow">PyawBwe</span>
      </div>
    </div>
    <div style="--x: 58; --y: 83;" class="map-city">
      <div class="map-city__label">
        <span class="map-city__sign anim anim-slidein">Yangon</span>
      </div>
    </div>
    <div style="--x: 65; --y: 22;" class="map-city">
      <div class="map-city__label">
        <span class="map-city__sign">Taunggyi</span>
      </div>
    </div>
    <div style="--x: 87; --y: 58;" class="map-city">
      <div class="map-city__label">
        <span class="map-city__sign">Mandalay</span>
      </div>
    </div>
    <div style="--x: 94; --y: 38;" class="map-city">
      <div class="map-city__label">
        <span class="map-city__sign anim anim-slidein">Bago</span>
      </div>
    </div>
  </div>
</div>
</div>
  </div>
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
