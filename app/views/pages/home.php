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
    /* Image Slider Section */
    .photo-slider-section {
      padding: 80px 0;
      background: #f8fafc;
      position: relative;
      overflow: hidden;
      text-align: center;
    }

    .photo-slider-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      position: relative;
    }

    .slider-title {
      font-size: 2.5rem;
      font-weight: 800;
      color: #1e293b;
      margin-bottom: 40px;
    }

    .photo-slider {
      display: flex;
      overflow: hidden;
      scroll-snap-type: x mandatory;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .photo-slide {
      flex: 0 0 100%;
      scroll-snap-align: start;
      position: relative;
    }

    .photo-slide img {
      width: 100%;
      display: block;
      object-fit: cover;
      height: 500px;
      /* Adjust height as needed */
    }

    .prev-btn,
    .next-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.8);
      border: none;
      padding: 15px;
      cursor: pointer;
      z-index: 10;
      border-radius: 50%;
      font-size: 1.5rem;
      color: #3b82f6;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .prev-btn:hover,
    .next-btn:hover {
      background: #3b82f6;
      color: white;
      transform: translateY(-50%) scale(1.1);
    }

    .prev-btn {
      left: 20px;
    }

    .next-btn {
      right: 20px;
    }

    .dots-container {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
    }

    .dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #cbd5e1;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .dot.active {
      background-color: #3b82f6;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .photo-slide img {
        height: 300px;
      }
    }

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

    /* Review Section Styles */
    .review-section {
      padding: 80px 0;
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      position: relative;
      overflow: hidden;
    }

    .review-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(ellipse at center, rgba(59, 130, 246, 0.03) 0%, transparent 50%);
      pointer-events: none;
    }

    .review-section {
      max-width: 1200px;
      margin: 0 auto;
      padding: 80px 20px;
      position: relative;
      z-index: 1;
    }

    .review-section h2 {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(135deg, #1e40af, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-align: center;
      margin-bottom: 50px;
      line-height: 1.2;
    }

    .review-form {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      margin-bottom: 50px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      position: relative;
      overflow: hidden;
    }

    .review-form::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #3b82f6, #1e40af);
    }

    .review-form textarea {
      width: 100%;
      min-height: 120px;
      padding: 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-family: 'Inter', sans-serif;
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 20px;
      resize: vertical;
      transition: all 0.3s ease;
      background: #f8fafc;
      box-sizing: border-box;
    }

    .review-form textarea:focus {
      outline: none;
      border-color: #3b82f6;
      background: white;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .review-form textarea::placeholder {
      color: #9ca3af;
    }

    .review-form-row {
      display: flex;
      gap: 20px;
      align-items: center;
      flex-wrap: wrap;
    }

    .review-form select {
      flex: 1;
      min-width: 200px;
      padding: 15px 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-family: 'Inter', sans-serif;
      font-size: 1rem;
      background: #f8fafc;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .review-form select:focus {
      outline: none;
      border-color: #3b82f6;
      background: white;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .review-form button {
      background: linear-gradient(135deg, #3b82f6, #1e40af);
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1rem;
      position: relative;
      overflow: hidden;
      white-space: nowrap;
    }

    .review-form button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .review-form button:hover::before {
      left: 100%;
    }

    .review-form button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    .review-form button:active {
      transform: translateY(0);
    }

    .review-form p {
      text-align: center;
      font-size: 1.1rem;
      color: #64748b;
      margin: 0;
    }

    .review-form p a {
      color: #3b82f6;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .review-form p a:hover {
      color: #1e40af;
      text-decoration: underline;
    }

    .review-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .review-card {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .review-card::before {
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

    .review-card:hover::before {
      transform: scaleX(1);
    }

    .review-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
    }

    .review-card strong {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e293b;
      display: block;
      margin-bottom: 8px;
    }

    .review-card span {
      font-size: 1.1rem;
      margin-bottom: 15px;
      display: block;
    }

    .review-card p {
      color: #4b5563;
      font-size: 1rem;
      line-height: 1.7;
      margin-bottom: 20px;
      font-style: italic;
    }

    .review-card small {
      color: #9ca3af;
      font-size: 0.9rem;
      display: block;
      text-align: right;
      font-weight: 500;
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
    @media (max-width: 1200px) {
      .review-section {
        padding: 60px 15px;
      }

      .review-list {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
      }
    }

    @media (max-width: 992px) {
      .services {
        padding: 60px 0;
      }

      .services-header h2,
      .testimonials-header h2,
      .review-section h2 {
        font-size: 2.5rem;
      }

      .services-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
      }

      .review-form {
        padding: 30px;
      }

      .review-form-row {
        flex-direction: column;
        align-items: stretch;
      }

      .review-form select {
        min-width: 100%;
        margin-bottom: 15px;
      }

      .review-form button {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 768px) {
      .services {
        padding: 50px 0;
      }

      .services-header h2,
      .testimonials-header h2,
      .review-section h2 {
        font-size: 2.2rem;
        margin-bottom: 30px;
      }

      .services-header p,
      .testimonials-header p {
        font-size: 1.1rem;
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

      /* Review Section Mobile Styles */
      .review-section {
        padding: 50px 15px;
      }

      .review-section h2 {
        font-size: 2rem;
        margin-bottom: 30px;
      }

      .review-form {
        padding: 25px 20px;
        margin-bottom: 40px;
      }

      .review-form textarea {
        min-height: 100px;
        padding: 15px;
        font-size: 0.95rem;
        margin-bottom: 15px;
      }

      .review-form select {
        padding: 12px 15px;
        font-size: 0.95rem;
        margin-bottom: 15px;
      }

      .review-form button {
        padding: 12px 25px;
        font-size: 0.95rem;
      }

      .review-list {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 30px;
      }

      .review-card {
        padding: 20px;
      }

      .review-card strong {
        font-size: 1.1rem;
        margin-bottom: 6px;
      }

      .review-card span {
        font-size: 1rem;
        margin-bottom: 12px;
      }

      .review-card p {
        font-size: 0.95rem;
        margin-bottom: 15px;
        line-height: 1.6;
      }

      .review-card small {
        font-size: 0.85rem;
      }
    }

    @media (max-width: 480px) {

      .services-header h2,
      .testimonials-header h2,
      .review-section h2 {
        font-size: 1.8rem;
      }

      .services-header p,
      .testimonials-header p {
        font-size: 1rem;
      }

      .service-card {
        padding: 25px 15px;
      }

      .service-icon {
        width: 70px;
        height: 70px;
        margin-bottom: 20px;
      }

      .service-icon i {
        font-size: 1.8rem;
      }

      .service-card h3 {
        font-size: 1.3rem;
        margin-bottom: 12px;
      }

      .service-card p {
        font-size: 0.95rem;
        margin-bottom: 20px;
      }

      .service-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
      }

      .stats-grid {
        grid-template-columns: 1fr;
        gap: 25px;
      }

      .stat-number {
        font-size: 2.2rem;
      }

      .stat-label {
        font-size: 1rem;
      }

      /* Review Section Small Mobile Styles */
      .review-section {
        padding: 40px 10px;
      }

      .review-section h2 {
        font-size: 1.6rem;
        margin-bottom: 25px;
      }

      .review-form {
        padding: 20px 15px;
        margin-bottom: 30px;
      }

      .review-form textarea {
        min-height: 90px;
        padding: 12px;
        font-size: 0.9rem;
      }

      .review-form select {
        padding: 10px 12px;
        font-size: 0.9rem;
      }

      .review-form button {
        padding: 10px 20px;
        font-size: 0.9rem;
      }

      .review-form p {
        font-size: 1rem;
      }

      .review-card {
        padding: 15px;
        border-radius: 15px;
      }

      .review-card strong {
        font-size: 1rem;
      }

      .review-card span {
        font-size: 0.95rem;
      }

      .review-card p {
        font-size: 0.9rem;
        line-height: 1.5;
      }

      .review-card small {
        font-size: 0.8rem;
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

    /* Focus styles for accessibility */
    .review-form textarea:focus,
    .review-form select:focus,
    .review-form button:focus {
      outline: 2px solid #3b82f6;
      outline-offset: 2px;
    }

    /* High contrast support */
    @media (prefers-contrast: high) {
      .review-form {
        border: 2px solid #1e293b;
      }

      .review-card {
        border: 2px solid #e5e7eb;
      }

      .review-form textarea,
      .review-form select {
        border-width: 2px;
      }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {

      .review-card,
      .review-form,
      .service-card,
      .testimonial-card {
        transition: none;
      }

      .review-card:hover,
      .service-card:hover,
      .testimonial-card:hover {
        transform: none;
      }
    }

    /* Print styles */
    @media print {
      .review-form {
        display: none;
      }

      .review-section {
        padding: 20px 0;
      }

      .review-card {
        box-shadow: none;
        border: 1px solid #000;
        break-inside: avoid;
        margin-bottom: 20px;
      }
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
        <a href="<?php echo URLROOT; ?>/pages/donate">Donate</a>
        <a href="<?php echo URLROOT; ?>/pages/about">About Us</a>
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
  <section class="photo-slider-section">
    <div class="photo-slider-container">
      <h3 class="slider-title">Our Happy Community</h3>
      <div class="photo-slider">
        <div class="photo-slide fade-in-up">
          <img src="https://plus.unsplash.com/premium_photo-1722686448514-e56bbe4120d5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZWxkZXJseSUyMHBlb3BsZXxlbnwwfHwwfHx8MA%3D%3D" alt="A happy elderly man smiling" loading="lazy">
        </div>
        <div class="photo-slide fade-in-up">
          <img src="https://images.unsplash.com/photo-1513159446162-54eb8bdaa79b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8ZWxkZXJseSUyMHBlb3BsZXxlbnwwfHwwfHx8MA%3D%3D" alt="An elderly woman laughing with a caregiver" loading="lazy">
        </div>
        <div class="photo-slide fade-in-up">
          <img src="https://plus.unsplash.com/premium_photo-1663036898193-b072c8b24b39?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGVsZGVybHklMjBwZW9wbGV8ZW58MHx8MHx8fDA%3D" alt="A friendly elderly couple holding hands" loading="lazy">
        </div>
        <div class="photo-slide fade-in-up">
          <img src="https://media.istockphoto.com/id/2162741471/photo/group-of-asian-elderly-woman-relaxing-together-at-home.webp?a=1&b=1&s=612x612&w=0&k=20&c=52WPfn1oMVR6FFGjm_oUc9hCwU_s7JEeiDx6b2kNclk=" alt="A thoughtful elderly man looking out a window" loading="lazy">
        </div>
      </div>
      <button class="prev-btn" aria-label="Previous image"><i class="fas fa-chevron-left"></i></button>
      <button class="next-btn" aria-label="Next image"><i class="fas fa-chevron-right"></i></button>
      <div class="dots-container"></div>
    </div>
  </section>

  <!-- Review Section -->
  <div class="review-section">
    <h2>User Reviews</h2>

    <!-- Add Review Form -->
    <?php if (isset($_SESSION['user'])): ?>
      <form action="<?= URLROOT ?>/reviews/add" method="POST" class="review-form">
        <textarea name="comment" placeholder="Write your review..." required></textarea>
        <div class="review-form-row">
          <select name="rating" required>
            <option value="">Rate our service</option>
            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
            <option value="4">⭐⭐⭐⭐ Very Good</option>
            <option value="3">⭐⭐⭐ Good</option>
            <option value="2">⭐⭐ Fair</option>
            <option value="1">⭐ Poor</option>
          </select>
          <button type="submit">Submit Review</button>
        </div>
      </form>
    <?php else: ?>
      <div class="review-form">
        <p><a href="<?= URLROOT ?>/pages/signin">Login</a> to leave a review and share your experience with our elderly care services.</p>
      </div>
    <?php endif; ?>

    <!-- Show Reviews -->
    <div class="review-list">
      <?php foreach ($data['reviews'] as $review): ?>
        <div class="review-card fade-in-up">
          <strong><?= htmlspecialchars($review['name']) ?></strong>
          <span><?= str_repeat("⭐", $review['rating']) ?></span>
          <p><?= htmlspecialchars($review['comment']) ?></p>
          <small><?= $review['created_at'] ?></small>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Services Section -->


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
            <li><a href="#">HomeCare</a></li>
            <li><a href="#">ModernMachine</a></li>
            <li><a href="#">Reliability</a></li>
            <li><a href="#">24/7 Support</a></li>
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
        button.style.background = 'linear-gradient(135deg, #10b981, #34d399)';

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

    // Review form enhancements
    const reviewForm = document.querySelector('.review-form form');
    if (reviewForm) {
      const textarea = reviewForm.querySelector('textarea');
      const select = reviewForm.querySelector('select');
      const button = reviewForm.querySelector('button');

      // Character counter for textarea
      const charCounter = document.createElement('div');
      charCounter.style.cssText = `
        text-align: right;
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: -15px;
        margin-bottom: 15px;
      `;
      textarea.parentNode.insertBefore(charCounter, textarea.nextSibling);

      textarea.addEventListener('input', function() {
        const length = this.value.length;
        charCounter.textContent = `${length}/500 characters`;

        if (length > 500) {
          charCounter.style.color = '#ef4444';
          this.style.borderColor = '#ef4444';
        } else if (length > 450) {
          charCounter.style.color = '#f59e0b';
          this.style.borderColor = '#f59e0b';
        } else {
          charCounter.style.color = '#6b7280';
          this.style.borderColor = '#e5e7eb';
        }
      });

      // Form validation and submission
      reviewForm.addEventListener('submit', function(e) {
        if (textarea.value.length > 500) {
          e.preventDefault();
          showNotification('Review is too long. Please keep it under 500 characters.', 'error');
          return;
        }

        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
        button.disabled = true;
        textarea.disabled = true;
        select.disabled = true;
      });

      // Auto-resize textarea
      textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 200) + 'px';
      });
    }

    // Custom notification system
    function showNotification(message, type = 'info') {
      const notification = document.createElement('div');
      notification.className = `notification ${type}`;

      const bgColor = type === 'error' ? '#ef4444' : type === 'success' ? '#10b981' : '#3b82f6';

      notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: white;
        color: #1f2937;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border-left: 4px solid ${bgColor};
        z-index: 10000;
        max-width: 400px;
        transform: translateX(100%);
        transition: all 0.3s ease;
        font-weight: 500;
      `;

      const icon = type === 'error' ? 'fa-exclamation-circle' : type === 'success' ? 'fa-check-circle' : 'fa-info-circle';

      notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <i class="fas ${icon}" style="color: ${bgColor}; font-size: 1.25rem;"></i>
          <span>${message}</span>
          <button onclick="this.parentElement.parentElement.remove()" 
                  style="background: none; border: none; color: #9ca3af; cursor: pointer; font-size: 1.25rem; margin-left: auto;">
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
      
      .register-btn, .call-now, .newsletter-form button, .service-btn, .review-form button {
        position: relative;
        overflow: hidden;
      }
    `;
    document.head.appendChild(style);

    // Apply ripple effect to buttons
    document.querySelectorAll('.register-btn, .call-now, .newsletter-form button, .service-btn, .review-form button').forEach(button => {
      button.addEventListener('click', createRipple);

      button.addEventListener('mouseenter', function() {
        if (!this.disabled) {
          this.style.transform = 'translateY(-3px) scale(1.02)';
        }
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
        if (element && element.style) {
          element.style.transform = `translateY(${scrolled * speed}px)`;
        }
      });
    });

    // Keyboard navigation improvements
    document.addEventListener('keydown', (e) => {
      // Handle keyboard navigation for accessibility
      if (e.key === 'Enter' || e.key === ' ') {
        const focused = document.activeElement;
        if (focused.classList.contains('call-now') ||
          focused.classList.contains('register-btn') ||
          focused.classList.contains('service-btn') ||
          (focused.tagName === 'BUTTON' && focused.closest('.review-form'))) {
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
          if (element && element.style) {
            element.style.opacity = '1';
            element.style.transform = 'translateX(0)';
          }
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
      const animatedElements = document.querySelectorAll('.review-card, .review-form, .service-card, .testimonial-card');
      animatedElements.forEach(element => {
        element.style.transition = 'none';
      });
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
      'background: linear-gradient(135deg, #3b82f6, #1e40af); color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; text-shadow: 0 2px 4px rgba(0,0,0,0.3);'
    );
    console.log(
      '%c✨ Modern responsive design with beautiful blue & white theme and review section loaded successfully!',
      'color: #3b82f6; font-size: 14px; font-weight: 500;'
    );

    // Image Slider functionality
    document.addEventListener('DOMContentLoaded', function() {
      const slider = document.querySelector('.photo-slider');
      const slides = document.querySelectorAll('.photo-slide');
      const prevBtn = document.querySelector('.prev-btn');
      const nextBtn = document.querySelector('.next-btn');
      const dotsContainer = document.querySelector('.dots-container');
      let currentIndex = 0;

      // Create navigation dots
      slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        dot.addEventListener('click', () => {
          goToSlide(index);
        });
        dotsContainer.appendChild(dot);
      });

      const dots = document.querySelectorAll('.dot');

      function goToSlide(index) {
        if (index < 0) {
          currentIndex = slides.length - 1;
        } else if (index >= slides.length) {
          currentIndex = 0;
        } else {
          currentIndex = index;
        }

        slider.scrollLeft = slides[currentIndex].offsetLeft;
        updateDots();
      }

      function updateDots() {
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
      }

      prevBtn.addEventListener('click', () => {
        goToSlide(currentIndex - 1);
      });

      nextBtn.addEventListener('click', () => {
        goToSlide(currentIndex + 1);
      });

      // Auto-slide functionality
      setInterval(() => {
        goToSlide(currentIndex + 1);
      }, 5000); // Change image every 5 seconds

      // Initial state
      goToSlide(0);
    });
  </script>
</body>

</html>