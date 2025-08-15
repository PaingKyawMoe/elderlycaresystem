<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elderly Care System - Quality Care for Your Loved Ones</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/home.css?v=<?= time(); ?>">

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
        <a href="<?php echo URLROOT; ?>/pages/signin">Admin</a>
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
      
      .register-btn, .call-now, .newsletter-form button {
        position: relative;
        overflow: hidden;
      }
    `;
    document.head.appendChild(style);

    // Apply ripple effect to buttons
    document.querySelectorAll('.register-btn, .call-now, .newsletter-form button').forEach(button => {
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
        if (focused.classList.contains('call-now') || focused.classList.contains('register-btn')) {
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

    // Intersection Observer for scroll animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe footer sections for scroll animations
    document.querySelectorAll('.footer-section').forEach(section => {
      section.style.opacity = '0';
      section.style.transform = 'translateY(30px)';
      section.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
      observer.observe(section);
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