<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elderly Care System - Quality Care for Your Loved Ones</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/home.css?v=<?= time(); ?>">

  <style>
    /* Services Section Styles */
    .services {
      padding: 80px 0;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      position: relative;
      overflow: hidden;
    }

    .services::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 60%;
      height: 200%;
      background: radial-gradient(ellipse at center, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
      transform: rotate(45deg);
      pointer-events: none;
    }

    .services-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      position: relative;
      z-index: 1;
    }

    .services-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .services-header h2 {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(135deg, #1e40af, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 16px;
      line-height: 1.2;
    }

    .services-header p {
      font-size: 1.2rem;
      color: #64748b;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .service-card {
      background: white;
      border-radius: 20px;
      padding: 40px 30px;
      text-align: center;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .service-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #3b82f6, #1e40af);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .service-card:hover::before {
      transform: scaleX(1);
    }

    .service-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(59, 130, 246, 0.2);
    }

    .service-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 24px;
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.4s ease;
      position: relative;
    }

    .service-card:hover .service-icon {
      background: linear-gradient(135deg, #3b82f6, #1e40af);
      transform: scale(1.1);
    }

    .service-icon i {
      font-size: 2rem;
      color: #3b82f6;
      transition: all 0.4s ease;
    }

    .service-card:hover .service-icon i {
      color: white;
      transform: scale(1.1);
    }

    .service-card h3 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 16px;
      transition: color 0.3s ease;
    }

    .service-card:hover h3 {
      color: #3b82f6;
    }

    .service-card p {
      color: #64748b;
      line-height: 1.6;
      margin-bottom: 24px;
    }

    .service-btn {
      background: linear-gradient(135deg, #3b82f6, #1e40af);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      position: relative;
      overflow: hidden;
    }

    .service-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .service-btn:hover::before {
      left: 100%;
    }

    .service-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    /* Statistics Section */
    .stats {
      background: linear-gradient(135deg, #1e40af, #3b82f6);
      padding: 60px 0;
      margin-top: 0;
    }

    .stats-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      text-align: center;
    }

    .stat-item {
      color: white;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 8px;
      display: block;
    }

    .stat-label {
      font-size: 1.1rem;
      opacity: 0.9;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Testimonials Section */
    .testimonials {
      padding: 80px 0;
      background: #f8fafc;
      position: relative;
    }

    .testimonials::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(ellipse at top, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
      pointer-events: none;
    }

    .testimonials-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      position: relative;
      z-index: 1;
    }

    .testimonials-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .testimonials-header h2 {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(135deg, #1e40af, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 16px;
      line-height: 1.2;
    }

    .testimonials-header p {
      font-size: 1.2rem;
      color: #64748b;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .testimonials-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
    }

    .testimonial-card {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .testimonial-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #3b82f6, #1e40af);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .testimonial-card:hover::before {
      transform: scaleX(1);
    }

    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
    }

    .testimonial-content {
      position: relative;
    }

    .quote-icon {
      position: absolute;
      top: -10px;
      right: 0;
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .testimonial-card:hover .quote-icon {
      background: linear-gradient(135deg, #3b82f6, #1e40af);
    }

    .quote-icon i {
      color: #3b82f6;
      font-size: 1rem;
      transition: color 0.3s ease;
    }

    .testimonial-card:hover .quote-icon i {
      color: white;
    }

    .testimonial-content p {
      color: #4b5563;
      font-size: 1.1rem;
      line-height: 1.7;
      margin-bottom: 25px;
      font-style: italic;
      padding-right: 50px;
    }

    .patient-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .patient-avatar {
      flex-shrink: 0;
    }

    .patient-avatar img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #e5e7eb;
      transition: border-color 0.3s ease;
    }

    .testimonial-card:hover .patient-avatar img {
      border-color: #3b82f6;
    }

    .patient-details h4 {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 4px;
    }

    .patient-details span {
      color: #64748b;
      font-size: 0.9rem;
      display: block;
      margin-bottom: 8px;
    }

    .rating {
      display: flex;
      gap: 2px;
    }

    .rating i {
      color: #fbbf24;
      font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .services {
        padding: 60px 0;
      }

      .services-header h2,
      .testimonials-header h2 {
        font-size: 2.2rem;
      }

      .services-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .service-card {
        padding: 30px 20px;
      }

      .testimonials {
        padding: 60px 0;
      }

      .testimonials-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .testimonial-card {
        padding: 25px;
      }

      .testimonial-content p {
        font-size: 1rem;
        padding-right: 40px;
      }

      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
      }

      .stat-number {
        font-size: 2.5rem;
      }
    }

    /* Animation for scroll reveal */
    .fade-in-up {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fade-in-up.revealed {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header" id="header">
    <div class="header-container">
      <a href="#" class="logo">
        <div class="logo-icon">
          <i class="fas fa-heart-pulse"></i>
        </div>
        Elderly Care System
      </a>

      <nav id="nav">
        <a href="<?php echo URLROOT; ?>/pages/home" class="active">Home</a>
        <a href="<?php echo URLROOT; ?>/pages/donate"">Donate</a>
        <a href=" <?php echo URLROOT; ?>/pages/about">About Us</a>
        <a href="<?php echo URLROOT; ?>/pages/signin">Login</a>
        <button class="call-now">Call Now</button>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-container">
      <div class="hero-content">
        <h1>
          We are<br>
          Committed To<br>
          Quality Care
        </h1>
        <p>
          A care system for older people can use a variety of technologies to enhance their quality of life and ensure their safety and well-being.
        </p>
        <a href="<?php echo URLROOT; ?>/pages/register">
          <button class="register-btn">Register Now</button>
        </a>
      </div>

      <div class="hero-image">
        <div class="image-container">
          <img src="https://images.unsplash.com/photo-1588991837648-9f380f70dde9?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGVsZGVybHljYXJlfGVufDB8MXwwfHx8MA%3D%3D"
            loading="lazy">
          <div class="image-overlay"></div>
        </div>
      </div>
    </div>
  </section>
  <div class="review-section">
    <h2>User Reviews</h2>

    <!-- Add Review Form -->
    <?php if (isset($_SESSION['user'])): ?>
      <form action="<?= URLROOT ?>/reviews/add" method="POST" class="review-form">
        <textarea name="comment" placeholder="Write your review..." required></textarea>
        <select name="rating" required>
          <option value="">Rate</option>
          <option value="5">⭐⭐⭐⭐⭐</option>
          <option value="4">⭐⭐⭐⭐</option>
          <option value="3">⭐⭐⭐</option>
          <option value="2">⭐⭐</option>
          <option value="1">⭐</option>
        </select>
        <button type="submit">Submit Review</button>
      </form>
    <?php else: ?>
      <p><a href="<?= URLROOT ?>/pages/signin">Login</a> to leave a review.</p>
    <?php endif; ?>

    <!-- Show Reviews -->
    <div class="review-list">
      <?php foreach ($data['reviews'] as $review): ?>
        <div class="review-card">
          <strong><?= htmlspecialchars($review['name']) ?></strong>
          <span><?= str_repeat("⭐", $review['rating']) ?></span>
          <p><?= htmlspecialchars($review['comment']) ?></p>
          <small><?= $review['created_at'] ?></small>
        </div>
      <?php endforeach; ?>
    </div>
  </div>


  <!-- Services Section -->
  <section class="services">
    <div class="services-container">
      <div class="services-header fade-in-up">
        <h2>Our Care Services</h2>
        <p>Comprehensive healthcare solutions designed specifically for elderly care with modern technology and compassionate professionals</p>
      </div>

      <div class="services-grid">
        <div class="service-card fade-in-up">
          <div class="service-icon">
            <i class="fas fa-home"></i>
          </div>
          <h3>Home Care</h3>
          <p>Professional in-home care services providing personalized assistance with daily activities, medication management, and companionship in the comfort of your loved one's home.</p>
          <a href='<?= URLROOT; ?>/pages/donate' class="service-btn">Learn More</a>
        </div>

        <div class="service-card fade-in-up">
          <div class="service-icon">
            <i class="fas fa-stethoscope"></i>
          </div>
          <h3>Medical Care</h3>
          <p>Comprehensive medical services including regular health monitoring, specialist consultations, and coordination with healthcare providers for optimal health management.</p>
          <a href='<?= URLROOT; ?>/pages/donate' class="service-btn">Learn More</a>
        </div>

        <div class="service-card fade-in-up">
          <div class="service-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Safety Monitoring</h3>
          <p>Advanced monitoring systems and emergency response services ensuring 24/7 safety and peace of mind for both seniors and their families.</p>
          <a href='<?= URLROOT; ?>/pages/donate' class="service-btn">Learn More</a>
        </div>

        <div class="service-card fade-in-up">
          <div class="service-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Social Activities</h3>
          <p>Engaging social programs and activities designed to maintain mental wellness, foster connections, and provide meaningful experiences for active aging.</p>
          <a href='<?= URLROOT; ?>/pages/donate' class="service-btn">Learn More</a>
        </div>

        <div class="service-card fade-in-up">
          <div class="service-icon">
            <i class="fas fa-utensils"></i>
          </div>
          <h3>Nutrition Support</h3>
          <p>Customized meal planning and nutrition services ensuring proper dietary needs are met with delicious, healthy meals tailored to individual preferences.</p>
          <a href='<?= URLROOT; ?>/pages/donate' class="service-btn">Learn More</a>
        </div>

        <div class="service-card fade-in-up">
          <div class="service-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h3>24/7 Support</h3>
          <p>Round-the-clock support services with trained professionals available at any time to provide assistance, answer questions, and handle emergencies.</p>
          <a href='<?= URLROOT; ?>/pages/donate' class="service-btn">Learn More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistics Section -->
  <section class="stats">
    <div class="stats-container">
      <div class="stats-grid">
        <div class="stat-item fade-in-up">
          <span class="stat-number" data-target="2500">0</span>
          <span class="stat-label">Happy Families</span>
        </div>
        <div class="stat-item fade-in-up">
          <span class="stat-number" data-target="150">0</span>
          <span class="stat-label">Care Professionals</span>
        </div>
        <div class="stat-item fade-in-up">
          <span class="stat-number" data-target="10">0</span>
          <span class="stat-label">Years Experience</span>
        </div>
        <div class="stat-item fade-in-up">
          <span class="stat-number" data-target="24">0</span>
          <span class="stat-label">Hours Service</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-main">
        <div class="footer-section">
          <h4>About</h4>
          <ul>
            <li><a href="#">Our Story</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Careers</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h4>Company</h4>
          <ul>
            <li><a href="#">Cookie Statement</a></li>
            <li><a href="#">Terms Of Service</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h4>Service</h4>
          <ul>
            <li><a href="dashboard.php">HomeCare</a></li>
            <li><a href="dashboard.php">ModernMachine</a></li>
            <li><a href="dashboard.php">Reliability</a></li>
            <li><a href="dashboard.php">24/7 Support</a></li>
          </ul>
        </div>

        <div class="newsletter">
          <h4>Stay Updated</h4>
          <form class="newsletter-form" id="newsletter-form">
            <input type="email"
              id="newsletter-email"
              placeholder="Enter your email"
              required
              autocomplete="email">
            <button type="submit">Subscribe</button>
          </form>
          <div class="social-links">
            <a href="#" class="social-link" aria-label="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-link" aria-label="YouTube">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-link" aria-label="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Header scroll effect
    const header = document.getElementById('header');

    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Enhanced newsletter form
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('newsletter-email').value;
      const button = this.querySelector('button');
      const originalText = button.textContent;
      const input = this.querySelector('input');

      // Show loading state
      button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
      button.disabled = true;
      input.disabled = true;

      // Simulate API call
      setTimeout(() => {
        // Show success state
        button.innerHTML = '<i class="fas fa-check"></i> Subscribed!';
        button.style.background = 'linear-gradient(135deg, var(--button-green), var(--button-green-light))';

        // Reset form
        input.value = '';

        // Show success message
        showNotification(`Welcome aboard! We've sent a confirmation email to ${email}`, 'success');

        // Reset button after 3 seconds
        setTimeout(() => {
          button.innerHTML = originalText;
          button.style.background = '';
          button.disabled = false;
          input.disabled = false;
        }, 3000);
      }, 1500);
    });

    // Custom notification system
    function showNotification(message, type = 'info') {
      const notification = document.createElement('div');
      notification.className = `notification ${type}`;
      notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: var(--white);
        color: var(--gray-800);
        padding: 1rem 1.5rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-xl);
        border-left: 4px solid var(--button-green);
        z-index: 10000;
        max-width: 400px;
        transform: translateX(100%);
        transition: var(--transition);
        font-weight: 500;
      `;

      notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <i class="fas fa-check-circle" style="color: var(--button-green); font-size: 1.25rem;"></i>
          <span>${message}</span>
          <button onclick="this.parentElement.parentElement.remove()" 
                  style="background: none; border: none; color: var(--gray-400); cursor: pointer; font-size: 1.25rem; margin-left: auto;">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;

      document.body.appendChild(notification);

      // Slide in
      setTimeout(() => {
        notification.style.transform = 'translateX(0)';
      }, 100);

      // Auto remove after 5 seconds
      setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
      }, 5000);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          const headerHeight = document.querySelector('.header').offsetHeight;
          const targetPosition = target.offsetTop - headerHeight;

          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        }
      });
    });

    // Enhanced button interactions with ripple effect
    function createRipple(e) {
      const button = e.currentTarget;
      const circle = document.createElement('span');
      const diameter = Math.max(button.clientWidth, button.clientHeight);
      const radius = diameter / 2;

      circle.style.width = circle.style.height = `${diameter}px`;
      circle.style.left = `${e.clientX - button.offsetLeft - radius}px`;
      circle.style.top = `${e.clientY - button.offsetTop - radius}px`;
      circle.classList.add('ripple');

      const ripple = button.getElementsByClassName('ripple')[0];
      if (ripple) {
        ripple.remove();
      }

      button.appendChild(circle);
    }

    // Add ripple effect styles
    const style = document.createElement('style');
    style.textContent = `
      .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple 600ms linear;
        pointer-events: none;
      }
      
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
      
      .register-btn, .call-now, .newsletter-form button, .service-btn {
        position: relative;
        overflow: hidden;
      }
    `;
    document.head.appendChild(style);

    // Apply ripple effect to buttons
    document.querySelectorAll('.register-btn, .call-now, .newsletter-form button, .service-btn').forEach(button => {
      button.addEventListener('click', createRipple);

      button.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-3px) scale(1.02)';
      });

      button.addEventListener('mouseleave', function() {
        if (!this.disabled) {
          this.style.transform = 'translateY(0) scale(1)';
        }
      });
    });

    // Add click-to-call functionality
    document.querySelectorAll('.call-now').forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        // Replace with your actual phone number
        window.location.href = 'tel:+1-800-ELDERCARE';
      });
    });

    // Scroll reveal animation
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
        }
      });
    }, observerOptions);

    // Observe elements for scroll animations
    document.querySelectorAll('.fade-in-up').forEach(el => {
      observer.observe(el);
    });

    // Animated counters for statistics
    function animateCounter(element, target, duration = 2000) {
      let start = 0;
      const increment = target / (duration / 16);

      const updateCounter = () => {
        start += increment;
        if (start < target) {
          element.textContent = Math.floor(start);
          requestAnimationFrame(updateCounter);
        } else {
          element.textContent = target;
        }
      };

      updateCounter();
    }

    // Start counter animations when stats section is visible
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const counters = entry.target.querySelectorAll('.stat-number');
          counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            animateCounter(counter, target);
          });
          statsObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.5
    });

    const statsSection = document.querySelector('.stats');
    if (statsSection) {
      statsObserver.observe(statsSection);
    }

    // Parallax effect for hero background elements
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const heroElements = document.querySelectorAll('.hero::before, .hero::after');

      heroElements.forEach((element, index) => {
        const speed = 0.5 + (index * 0.1);
        element.style.transform = `translateY(${scrolled * speed}px)`;
      });
    });

    // Keyboard navigation improvements
    document.addEventListener('keydown', (e) => {
      // Handle keyboard navigation for accessibility
      if (e.key === 'Enter' || e.key === ' ') {
        const focused = document.activeElement;
        if (focused.classList.contains('call-now') || focused.classList.contains('register-btn') || focused.classList.contains('service-btn')) {
          focused.click();
        }
      }
    });

    // Add focus visible for better accessibility
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Tab') {
        document.body.classList.add('user-is-tabbing');
      }
    });

    document.addEventListener('mousedown', function() {
      document.body.classList.remove('user-is-tabbing');
    });

    // Initialize page
    window.addEventListener('load', function() {
      // Add entrance animations
      const animatedElements = document.querySelectorAll('.hero-content, .hero-image');
      animatedElements.forEach((element, index) => {
        setTimeout(() => {
          element.style.opacity = '1';
          element.style.transform = 'translateX(0)';
        }, index * 200);
      });

      // Preload images
      const images = document.querySelectorAll('img[loading="lazy"]');
      images.forEach(img => {
        img.addEventListener('load', () => {
          img.style.opacity = '1';
        });
      });
    });

    // Add reduced motion support
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    if (prefersReducedMotion.matches) {
      // Disable animations for users who prefer reduced motion
      document.documentElement.style.setProperty('--transition', 'none');
      document.documentElement.style.setProperty('--transition-smooth', 'none');

      const animations = document.getAnimations();
      animations.forEach(animation => animation.cancel());
    }

    // Performance optimization: Throttle scroll events
    let ticking = false;

    function updateScrollEffects() {
      // All scroll-related updates here
      const scrolled = window.pageYOffset;

      // Header scroll effect
      if (scrolled > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }

      ticking = false;
    }

    function requestTick() {
      if (!ticking) {
        requestAnimationFrame(updateScrollEffects);
        ticking = true;
      }
    }

    window.addEventListener('scroll', requestTick);

    // Console branding
    console.log(
      '%c🏥 Elderly Care System',
      'background: linear-gradient(135deg, #10B981, #34D399); color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; text-shadow: 0 2px 4px rgba(0,0,0,0.3);'
    );
    console.log(
      '%c✨ Modern responsive design with beautiful blue & white theme loaded successfully!',
      'color: #0066FF; font-size: 14px; font-weight: 500;'
    );
  </script>
</body>

</html>