<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Elderly Care System | Quality Care for Your Loved Ones</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    :root {
      /* Modern Blue & White Theme */
      --primary-blue: #0066FF;
      --primary-blue-dark: #0052CC;
      --primary-blue-light: #3385FF;
      --secondary-blue: #E6F2FF;
      --accent-blue: #B3D9FF;

      /* Green Buttons */
      --button-green: #10B981;
      --button-green-dark: #059669;
      --button-green-light: #34D399;

      /* Neutral Colors */
      --white: #FFFFFF;
      --white-soft: #FEFEFE;
      --gray-50: #F8FAFC;
      --gray-100: #F1F5F9;
      --gray-200: #E2E8F0;
      --gray-300: #CBD5E1;
      --gray-400: #94A3B8;
      --gray-500: #64748B;
      --gray-600: #475569;
      --gray-700: #334155;
      --gray-800: #1E293B;
      --gray-900: #0F172A;

      /* Glass Effects */
      --glass-bg: rgba(255, 255, 255, 0.95);
      --glass-border: rgba(255, 255, 255, 0.2);
      --glass-shadow: 0 8px 32px rgba(0, 102, 255, 0.1);

      /* Modern Shadows */
      --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
      --shadow-md: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 10px -6px rgba(0, 0, 0, 0.1);
      --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
      --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      --shadow-blue: 0 10px 30px rgba(0, 102, 255, 0.2);
      --shadow-green: 0 10px 30px rgba(16, 185, 129, 0.3);

      /* Border Radius */
      --radius-sm: 8px;
      --radius: 12px;
      --radius-lg: 20px;
      --radius-xl: 24px;
      --radius-2xl: 32px;

      /* Transitions */
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);

      /* Typography */
      --font-size-xs: 0.75rem;
      --font-size-sm: 0.875rem;
      --font-size-base: 1rem;
      --font-size-lg: 1.125rem;
      --font-size-xl: 1.25rem;
      --font-size-2xl: 1.5rem;
      --font-size-3xl: 1.875rem;
      --font-size-4xl: 2.25rem;
      --font-size-5xl: 3rem;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      line-height: 1.6;
      color: var(--gray-700);
      background: var(--white-soft);
      overflow-x: hidden;
      font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Glassmorphism Header */
    .header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--glass-border);
      padding: 1rem 0;
      transition: var(--transition);
      box-shadow: var(--glass-shadow);
    }

    .header.scrolled {
      background: var(--white);
      box-shadow: var(--shadow-lg);
    }

    .header-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.875rem;
      font-size: var(--font-size-xl);
      font-weight: 700;
      color: var(--primary-blue);
      text-decoration: none;
      transition: var(--transition);
    }

    .logo:hover {
      transform: scale(1.02);
    }

    .logo-icon {
      width: 52px;
      height: 52px;
      background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
      border-radius: var(--radius-lg);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: var(--font-size-xl);
      box-shadow: var(--shadow-blue);
      transition: var(--transition);
    }

    .logo:hover .logo-icon {
      transform: rotate(5deg) scale(1.05);
      box-shadow: var(--shadow-lg);
    }

    nav {
      display: flex;
      align-items: center;
      gap: 3rem;
    }

    nav a {
      color: var(--gray-600);
      text-decoration: none;
      font-weight: 500;
      font-size: var(--font-size-base);
      position: relative;
      transition: var(--transition);
      padding: 0.5rem 0;
    }

    nav a:hover,
    nav a.active {
      color: var(--primary-blue);
      transform: translateY(-2px);
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--button-green), var(--button-green-light));
      transform: translateX(-50%);
      transition: var(--transition);
      border-radius: 2px;
    }

    nav a:hover::after,
    nav a.active::after {
      width: 100%;
    }

    .call-now {
      background: linear-gradient(135deg, var(--button-green), var(--button-green-dark));
      color: var(--white);
      border: none;
      padding: 0.875rem 2rem;
      border-radius: var(--radius-xl);
      font-weight: 600;
      font-size: var(--font-size-sm);
      cursor: pointer;
      transition: var(--transition);
      box-shadow: var(--shadow-green);
      text-transform: none;
      position: relative;
      overflow: hidden;
    }

    .call-now::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.6s;
    }

    .call-now:hover::before {
      left: 100%;
    }

    .call-now:hover {
      background: linear-gradient(135deg, var(--button-green-dark), var(--button-green));
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
    }

    /* About Hero Section */
    .about-hero {
      min-height: 100vh;
      background: linear-gradient(135deg, var(--white) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%);
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
      padding-top: 100px;
    }

    .about-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 80%;
      height: 200%;
      background: linear-gradient(45deg, rgba(0, 102, 255, 0.05), rgba(16, 185, 129, 0.05));
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .about-hero::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: -10%;
      width: 60%;
      height: 120%;
      background: linear-gradient(-45deg, rgba(0, 102, 255, 0.03), rgba(16, 185, 129, 0.03));
      border-radius: 50%;
      animation: float 8s ease-in-out infinite reverse;
    }

    .about-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 4rem 2rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 6rem;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    .about-content {
      animation: fadeInLeft 0.8s ease-out;
    }

    .about-content h1 {
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 2rem;
      color: var(--gray-900);
      background: linear-gradient(135deg, var(--gray-900) 0%, var(--primary-blue) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .about-content p {
      font-size: var(--font-size-lg);
      color: var(--gray-600);
      margin-bottom: 2rem;
      line-height: 1.7;
      font-weight: 400;
    }

    .about-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-top: 3rem;
    }

    .stat-item {
      text-align: center;
      padding: 1.5rem;
      background: var(--white);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow);
      transition: var(--transition);
    }

    .stat-item:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .stat-number {
      font-size: var(--font-size-3xl);
      font-weight: 800;
      color: var(--primary-blue);
      display: block;
    }

    .stat-label {
      font-size: var(--font-size-sm);
      color: var(--gray-600);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .contact-info {
      background: var(--white);
      padding: 2rem;
      border-radius: var(--radius-xl);
      box-shadow: var(--shadow-lg);
      margin-top: 2rem;
    }

    .contact-info h3 {
      font-size: var(--font-size-xl);
      font-weight: 700;
      color: var(--gray-800);
      margin-bottom: 1.5rem;
    }

    .contact-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
      padding: 0.75rem;
      border-radius: var(--radius);
      transition: var(--transition);
    }

    .contact-item:hover {
      background: var(--gray-50);
    }

    .contact-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
      color: var(--white);
      border-radius: var(--radius);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: var(--font-size-base);
    }

    .contact-details {
      flex: 1;
    }

    .contact-details strong {
      color: var(--gray-800);
      font-weight: 600;
      display: block;
    }

    .contact-details span {
      color: var(--gray-600);
      font-size: var(--font-size-sm);
    }

    /* Map Section */
    .map-section {
      animation: fadeInRight 0.8s ease-out 0.3s both;
    }

    .map-container {
      position: relative;
      border-radius: var(--radius-2xl);
      overflow: hidden;
      box-shadow: var(--shadow-xl);
      background: var(--white);
      padding: 1rem;
      height: 600px;
    }

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
      border-radius: var(--radius-lg);
    }

    .map-overlay {
      position: absolute;
      top: 1rem;
      left: 1rem;
      right: 1rem;
      bottom: 1rem;
      background: linear-gradient(135deg,
          rgba(0, 102, 255, 0.05) 0%,
          transparent 50%,
          rgba(16, 185, 129, 0.03) 100%);
      border-radius: var(--radius-lg);
      pointer-events: none;
    }

    .map-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .map-header h2 {
      font-size: var(--font-size-2xl);
      font-weight: 700;
      color: var(--gray-800);
      margin-bottom: 0.5rem;
    }

    .map-header p {
      color: var(--gray-600);
      font-size: var(--font-size-base);
    }

    /* Modern Footer */
    .footer {
      background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
      color: var(--gray-600);
      padding: 5rem 2rem 3rem;
      position: relative;
      overflow: hidden;
      border-top: 1px solid var(--gray-200);
    }

    .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--primary-blue), transparent);
      opacity: 0.3;
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .footer-main {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 4rem;
      margin-bottom: 3rem;
    }

    .footer-section h4 {
      font-size: var(--font-size-lg);
      font-weight: 700;
      margin-bottom: 2rem;
      color: var(--gray-800);
      position: relative;
    }

    .footer-section h4::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 30px;
      height: 3px;
      background: linear-gradient(90deg, var(--button-green), var(--button-green-light));
      border-radius: 2px;
    }

    .footer-section ul {
      list-style: none;
    }

    .footer-section ul li {
      margin-bottom: 1rem;
    }

    .footer-section ul li a {
      color: var(--gray-500);
      text-decoration: none;
      transition: var(--transition);
      font-size: var(--font-size-base);
      position: relative;
      padding: 0.25rem 0;
    }

    .footer-section ul li a:hover {
      color: var(--primary-blue);
      transform: translateX(8px);
    }

    /* Newsletter Section */
    .newsletter {
      grid-column: span 1;
    }

    .newsletter h4 {
      margin-bottom: 1.5rem;
    }

    .newsletter-form {
      display: flex;
      margin-bottom: 2rem;
      background: var(--white);
      border-radius: var(--radius-2xl);
      padding: 0.5rem;
      box-shadow: var(--shadow);
      border: 2px solid var(--gray-100);
      transition: var(--transition);
    }

    .newsletter-form:focus-within {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
    }

    .newsletter-form input {
      flex: 1;
      background: transparent;
      border: none;
      color: var(--gray-700);
      padding: 1rem 1.5rem;
      font-size: var(--font-size-base);
      outline: none;
      font-family: inherit;
    }

    .newsletter-form input::placeholder {
      color: var(--gray-400);
    }

    .newsletter-form button {
      background: linear-gradient(135deg, var(--button-green), var(--button-green-light));
      color: var(--white);
      border: none;
      padding: 1rem 2rem;
      border-radius: var(--radius-xl);
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      white-space: nowrap;
      font-size: var(--font-size-base);
      box-shadow: var(--shadow-green);
    }

    .newsletter-form button:hover {
      background: linear-gradient(135deg, var(--button-green-dark), var(--button-green));
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
    }

    .social-links {
      display: flex;
      gap: 1rem;
    }

    .social-link {
      width: 48px;
      height: 48px;
      background: var(--white);
      border: 2px solid var(--gray-200);
      border-radius: var(--radius-lg);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gray-500);
      text-decoration: none;
      transition: var(--transition);
      font-size: var(--font-size-lg);
    }

    .social-link:hover {
      background: var(--primary-blue);
      border-color: var(--primary-blue);
      color: var(--white);
      transform: translateY(-4px) rotate(5deg);
      box-shadow: var(--shadow-blue);
    }

    /* Animations */
    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(5deg);
      }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .about-container {
        grid-template-columns: 1fr;
        gap: 4rem;
        text-align: center;
      }

      .map-section {
        order: -1;
      }

      .map-container {
        height: 450px;
      }

      .about-stats {
        justify-content: center;
        max-width: 600px;
        margin: 3rem auto 0;
      }

      .footer-main {
        grid-template-columns: repeat(2, 1fr);
        gap: 3rem;
      }

      /* Stack navigation vertically on tablets */
      nav {
        gap: 2rem;
      }

      nav a {
        font-size: var(--font-size-sm);
      }

      .call-now {
        padding: 0.75rem 1.5rem;
        font-size: var(--font-size-sm);
      }
    }

    @media (max-width: 768px) {
      .header-container {
        padding: 0 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
      }

      /* Keep navigation visible but make it responsive */
      nav {
        width: 100%;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
        order: 3;
        padding-top: 1rem;
        border-top: 1px solid var(--gray-200);
      }

      nav a {
        font-size: var(--font-size-sm);
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        background: var(--gray-50);
        transition: var(--transition);
      }

      nav a:hover,
      nav a.active {
        background: var(--secondary-blue);
      }

      .call-now {
        padding: 0.75rem 1.5rem;
        font-size: var(--font-size-sm);
      }

      .about-container {
        padding: 3rem 1.5rem;
        gap: 3rem;
      }

      .about-content h1 {
        font-size: 2.5rem;
      }

      .about-stats {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .map-container {
        height: 350px;
      }

      .footer {
        padding: 4rem 1.5rem 2rem;
      }

      .footer-main {
        grid-template-columns: 1fr;
        gap: 2.5rem;
        text-align: center;
      }

      .newsletter-form {
        flex-direction: column;
        background: none;
        padding: 0;
        border: none;
        gap: 1rem;
        box-shadow: none;
      }

      .newsletter-form input {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 1.25rem 1.5rem;
        box-shadow: var(--shadow);
      }

      .newsletter-form button {
        border-radius: var(--radius-xl);
        padding: 1.25rem;
      }

      .social-links {
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .logo {
        font-size: var(--font-size-lg);
      }

      .logo-icon {
        width: 44px;
        height: 44px;
        font-size: var(--font-size-lg);
      }

      .header-container {
        padding: 0 1rem;
      }

      nav {
        gap: 0.75rem;
      }

      nav a {
        padding: 0.5rem 0.75rem;
        font-size: var(--font-size-xs);
      }

      .call-now {
        padding: 0.625rem 1.25rem;
        font-size: var(--font-size-xs);
      }

      .about-content h1 {
        font-size: 2rem;
      }

      .map-container {
        height: 300px;
      }
    }

    /* Enhanced focus states for accessibility */
    .user-is-tabbing *:focus {
      outline: 3px solid var(--button-green);
      outline-offset: 2px;
      border-radius: var(--radius-sm);
    }

    /* Smooth scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--primary-blue);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--primary-blue-dark);
    }
  </style>
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

      <nav id="nav">
        <a href="<?php echo URLROOT; ?>/pages/home">Home</a>
        <a href="<?php echo URLROOT; ?>/pages/home">Service</a>
        <a href="<?php echo URLROOT; ?>/pages/home" class="active">About Us</a>
        <a href="<?php echo URLROOT; ?>/Pages/dashboard">Admin</a>
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

        <!-- Contact Information -->
        <div class="contact-info">
          <h3>Get in Touch</h3>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-details">
              <strong>Our Office</strong>
              <span>123 Care Street, Health District, Madrid, Spain 28001</span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-details">
              <strong>Phone Number</strong>
              <span>+34 900 123 456</span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-details">
              <strong>Email Address</strong>
              <span>info@elderlycaresystem.com</span>
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
      </div>

      <div class="map-section">
        <div class="map-header">
          <h2>Visit Our Office</h2>
          <p>We're located in the heart of Madrid's health district</p>
        </div>
        <div class="map-container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.5562434238447!2d-3.7037902!3d40.4167754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42287c6c4f9b93%3A0x7f0d7a0a9a9a9a9a!2sMadrid%2C%20Spain!5e0!3m2!1sen!2ses!4v1700000000000!5m2!1sen!2ses"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Elderly Care System Office Location">
          </iframe>
          <div class="map-overlay"></div>
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
      
      .call-now, .newsletter-form button {
        position: relative;
        overflow: hidden;
      }
    `;
    document.head.appendChild(style);

    // Apply ripple effect to buttons
    document.querySelectorAll('.call-now, .newsletter-form button').forEach(button => {
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
        window.location.href = 'tel:+34-900-123-456';
      });
    });

    // Parallax effect for hero background elements
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const heroElements = document.querySelectorAll('.about-hero::before, .about-hero::after');

      heroElements.forEach((element, index) => {
        const speed = 0.3 + (index * 0.1);
        if (element) {
          element.style.transform = `translateY(${scrolled * speed}px)`;
        }
      });
    });

    // Keyboard navigation improvements
    document.addEventListener('keydown', (e) => {
      // Handle keyboard navigation for accessibility
      if (e.key === 'Enter' || e.key === ' ') {
        const focused = document.activeElement;
        if (focused.classList.contains('call-now')) {
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

    // Observe elements for scroll animations
    document.querySelectorAll('.stat-item, .contact-item, .footer-section').forEach(section => {
      section.style.opacity = '0';
      section.style.transform = 'translateY(30px)';
      section.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
      observer.observe(section);
    });

    // Initialize page
    window.addEventListener('load', function() {
      // Add entrance animations
      const animatedElements = document.querySelectorAll('.about-content, .map-section');
      animatedElements.forEach((element, index) => {
        setTimeout(() => {
          element.style.opacity = '1';
          element.style.transform = 'translateX(0)';
        }, index * 200);
      });

      // Initialize map iframe
      const mapIframe = document.querySelector('iframe');
      if (mapIframe) {
        mapIframe.addEventListener('load', () => {
          console.log('Google Maps loaded successfully');
        });
      }
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
      '%c🏥 Elderly Care System - About Page',
      'background: linear-gradient(135deg, #10B981, #34D399); color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; text-shadow: 0 2px 4px rgba(0,0,0,0.3);'
    );
    console.log(
      '%c✨ About page with integrated Google Maps loaded successfully!',
      'color: #0066FF; font-size: 14px; font-weight: 500;'
    );
  </script>
</body>

</html>