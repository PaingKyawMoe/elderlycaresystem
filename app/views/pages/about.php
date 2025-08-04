<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Elderly Care System | Quality Care for Your Loved Ones</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/about.css?v=<?= time(); ?>">
</head>

<body>
  <!-- Header -->
  <header class="header" id="header">
    <div class="header-container">
      <a href="index.html" class="logo">
        <div class="logo-icon">
          <i class="fas fa-heart-pulse"></i>
        </div>
        Elderly Care System
      </a>

      <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
      </button>

      <nav id="nav">
        <a href="<?php echo URLROOT; ?>/pages/home">Home</a>
        <a href="<?php echo URLROOT; ?>/pages/donate"">Donate</a>
        <a href=" <?php echo URLROOT; ?>/pages/about" class="active">About Us</a>
        <a href="<?php echo URLROOT; ?>/pages/signin">Admin</a>
        <button class="call-now">Call Now</button>
      </nav>
    </div>
  </header>

  <!-- About Hero Section -->
  <section class="about-hero">
    <div class="about-container">
      <div class="about-content">
        <h1>About Our Care System</h1>
        <p>
          At Elderly Care System, we are dedicated to providing comprehensive, compassionate care for your loved ones. With over 15 years of experience in elderly care services, we combine modern technology with personalized attention to ensure the highest quality of life for seniors.
        </p>
        <p>
          Our mission is to create a supportive environment where elderly individuals can maintain their independence while receiving the care and assistance they need. We believe in treating every client with dignity, respect, and the individualized attention they deserve.
        </p>
        <p>
          We understand that choosing the right care for your loved ones is one of the most important decisions you'll make. That's why we've built our services around the core values of compassion, professionalism, and reliability. Our team of highly trained caregivers is committed to providing personalized care plans that address the unique needs of each individual.
        </p>

        <!-- Statistics -->
        <div class="about-stats">
          <div class="stat-item">
            <span class="stat-number">500+</span>
            <span class="stat-label">Happy Clients</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">15+</span>
            <span class="stat-label">Years Experience</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">24/7</span>
            <span class="stat-label">Available Support</span>
          </div>
        </div>

      </div>

      <div class="right-sidebar">
        <!-- Contact Information -->
        <div class="contact-info">
          <h3>Get in Touch</h3>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-details">
              <strong>Our Office</strong>
              <span>123 Care Street, Sanchaung Township, Yangon, Myanmar</span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-details">
              <strong>Phone Number</strong>
              <span>+95 9 750 231 601</span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-details">
              <strong>Email Address</strong>
              <span>info@elderlycaresystem.com.mm</span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="contact-details">
              <strong>Office Hours</strong>
              <span>Monday - Friday: 8:00 AM - 8:00 PM</span>
            </div>
          </div>
        </div>

        <!-- Map Section -->
        <div class="map-section">
          <div class="map-header">
            <!-- <h3>Visit Our Office</h3>
            <p>We're located in Yangon's healthcare district</p> -->
          </div>
          <div class="map-container">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61103.75587305661!2d96.11183068433457!2d16.806739568772465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon%2C%20Myanmar%20(Burma)!5e0!3m2!1sen!2smm!4v1700000000000!5m2!1sen!2smm"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Elderly Care System Office Location - Yangon, Myanmar">
            </iframe>
            <div class="map-overlay"></div>
          </div>
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
          <h4>Services</h4>
          <ul>
            <li><a href="#">Home Care</a></li>
            <li><a href="#">Medical Equipment</a></li>
            <li><a href="#">Emergency Support</a></li>
            <li><a href="#">24/7 Assistance</a></li>
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

  <!-- Toast Container -->
  <div id="toast-container"></div>

  <script>
    // Header scroll effect
    const header = document.getElementById('header');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;

      if (currentScroll > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }

      // Hide/show header on scroll
      if (currentScroll > lastScroll && currentScroll > 300) {
        header.style.transform = 'translateY(-100%)';
      } else {
        header.style.transform = 'translateY(0)';
      }

      lastScroll = currentScroll;
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const nav = document.getElementById('nav');

    mobileMenuBtn.addEventListener('click', () => {
      nav.classList.toggle('active');
      const isOpen = nav.classList.contains('active');
      mobileMenuBtn.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!nav.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
        nav.classList.remove('active');
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
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

        // Show success toast
        showToast(`Welcome aboard! We've sent a confirmation email to ${email}`, 'success');

        // Reset button after 3 seconds
        setTimeout(() => {
          button.innerHTML = originalText;
          button.style.background = '';
          button.disabled = false;
          input.disabled = false;
        }, 3000);
      }, 1500);
    });

    // Toast notification system
    function showToast(message, type = 'info') {
      const toast = document.createElement('div');
      toast.className = `toast ${type}`;

      const iconMap = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        info: 'fa-info-circle',
        warning: 'fa-exclamation-triangle'
      };

      toast.innerHTML = `
        <div class="toast-content">
          <i class="fas ${iconMap[type]} toast-icon"></i>
          <span>${message}</span>
          <button class="toast-close" onclick="this.parentElement.parentElement.remove()">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;

      document.getElementById('toast-container').appendChild(toast);

      // Trigger animation
      setTimeout(() => {
        toast.classList.add('show');
      }, 100);

      // Auto remove after 5 seconds
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
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

    // Add click-to-call functionality
    document.querySelectorAll('.call-now').forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = 'tel:+959123456789';
      });
    });

    // Parallax effect for hero background elements
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const parallaxElements = document.querySelectorAll('.about-hero::before, .about-hero::after');

      parallaxElements.forEach((element, index) => {
        const speed = 0.3 + (index * 0.1);
        if (element) {
          element.style.transform = `translateY(${scrolled * speed}px)`;
        }
      });
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
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe elements for scroll animations
    document.querySelectorAll('.stat-item, .contact-item, .footer-section').forEach(section => {
      section.style.opacity = '0';
      section.style.transform = 'translateY(30px)';
      section.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
      observer.observe(section);
    });

    // Loading animation for stats
    const animateValue = (element, start, end, duration) => {
      let startTimestamp = null;
      const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value + (element.textContent.includes('+') ? '+' : '');
        if (progress < 1) {
          window.requestAnimationFrame(step);
        }
      };
      window.requestAnimationFrame(step);
    };

    // Animate stats when they come into view
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const statNumber = entry.target.querySelector('.stat-number');
          const value = statNumber.textContent;
          if (value.includes('+')) {
            const num = parseInt(value);
            animateValue(statNumber, 0, num, 2000);
          }
          statsObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.5
    });

    document.querySelectorAll('.stat-item').forEach(stat => {
      statsObserver.observe(stat);
    });

    // Add reduced motion support
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    if (prefersReducedMotion.matches) {
      // Disable animations for users who prefer reduced motion
      document.documentElement.style.setProperty('--transition', 'none');
      document.documentElement.style.setProperty('--transition-smooth', 'none');
    }

    // Console branding
    console.log(
      '%c Elderly Care System - About Page',
      'background: linear-gradient(135deg, #10B981, #34D399); color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; text-shadow: 0 2px 4px rgba(0,0,0,0.3);'
    );
    console.log(
      '%c Location: Yangon, Myanmar',
      'color: #0066FF; font-size: 14px; font-weight: 500;'
    );
  </script>
</body>

</html>