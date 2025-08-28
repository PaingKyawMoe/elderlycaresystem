<!-- app/views/pages/activities_read.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/publicview.css?v=<?= time(); ?>">
    <style>
        /* Hero Video Section Styles */
        .hero-video-section {
            padding: 40px 20px;
            margin-bottom: 30px;
            border-radius: 15px;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .hero-text h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-text p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        .video-carousel-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
        }

        .video-carousel {
            display: flex;
            transition: transform 0.5s ease;
        }

        .video-slide {
            min-width: 100%;
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .video-item {
            flex: 1;
            max-width: 350px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .video-item:hover {
            transform: translateY(-5px);
        }

        .video-embed {
            width: 100%;
            height: 200px;
            border: none;
        }

        .video-info {
            padding: 15px;
        }

        .video-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 1rem;
            line-height: 1.4;
        }

        .video-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.3;
        }

        .carousel-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .carousel-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 16px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.05);
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
        }

        .indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .indicator.active {
            background: white;
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2rem;
            }

            .video-slide {
                flex-direction: column;
            }

            .video-item {
                max-width: 100%;
            }
        }

        /* Existing header styles adjustment */
        .header {
            margin-top: 20px;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #667eea;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-user {
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }


        /* Adjust body padding to account for fixed navbar */
        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                sans-serif;
            padding-top: 60px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.8rem 1rem;
                flex-wrap: wrap;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .logo {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .nav-user {
                font-size: 0.8rem;
            }

            .logout-btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            body {
                padding-top: 80px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.6rem;
            }

            .navbar-nav {
                gap: 0.5rem;
            }

            .nav-user {
                display: none;
                /* Hide user info on very small screens */
            }

            .logout-btn {
                padding: 0.4rem 0.6rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="<?= URLROOT ?>/pages/dashboard" class="navbar-brand">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            Elderly Care
        </a>
        <div class="navbar-nav">
            <div class="nav-user">
                <i class="fas fa-user-circle"></i>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></span>
            </div>
            <!-- <a href="<?= URLROOT ?>/pages/dashboard" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Back
            </a> -->
        </div>
    </nav>
    <!-- Hero Video Section -->


    <div class="header">
        <h2>Discover Amazing Activities</h2>
        <p>Explore exciting experiences and adventures waiting for you</p>

        <div class="search-container">
            <div class="search-wrapper">
                <input
                    type="text"
                    id="searchInput"
                    class="search-box"
                    placeholder="Search by activity name, category, or location..."
                    autocomplete="off">
                <div class="search-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                </div>
                <div class="search-stats" id="searchStats">
                    <?php if (!empty($data['activities'])): ?>
                        Showing <?= count($data['activities']) ?> activities
                    <?php endif; ?>
                </div>
            </div>

            <a href="tel:+1234567890" class="call-button">
                <svg viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                <span>Call Us</span>
            </a>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($data['activities'])): ?>
            <div class="activities-grid" id="activitiesGrid">
                <?php foreach ($data['activities'] as $index => $activity): ?>
                    <div class="activity-card" data-activity='<?= json_encode([
                                                                    "name" => $activity['activity_name'],
                                                                    "category" => $activity['category'],
                                                                    "location" => $activity['location'],
                                                                    "time" => $activity['time'],
                                                                    "participants" => $activity['participants']
                                                                ], JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                        <div class="card-image">
                            <div class="card-number"><?= $index + 1 ?></div>
                            <?php if (!empty($activity['photo'])): ?>
                                <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($activity['photo']) ?>" alt="<?= htmlspecialchars($activity['activity_name']) ?>">
                            <?php else: ?>
                                <div class="no-image">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21,15 16,10 5,21" />
                                    </svg>
                                    <span style="margin-left: 10px;">Activity Image</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-content">
                            <h3 class="activity-title"><?= htmlspecialchars($activity['activity_name']) ?></h3>

                            <div class="category-badge">
                                <?= htmlspecialchars($activity['category']) ?>
                            </div>

                            <div class="activity-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12,6 12,12 16,14" />
                                        </svg>
                                    </div>
                                    <span class="detail-text">Time: <span class="detail-value"><?= htmlspecialchars($activity['time']) ?></span></span>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                    </div>
                                    <span class="detail-text">Participants: <span class="detail-value"><?= htmlspecialchars($activity['participants']) ?></span></span>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                    </div>
                                    <span class="detail-text">Location: <span class="detail-value"><?= htmlspecialchars($activity['location']) ?></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="no-results" id="noResults" style="display: none;">
                <h3>No Activities Found</h3>
                <p>Sorry, we couldn't find any activities matching your search.</p>
                <button class="clear-search" onclick="clearSearch()">Clear Search</button>
            </div>
        <?php else: ?>
            <div class="no-activities">
                <h3>No Activities Found</h3>
                <p>Check back later for exciting new activities!</p>
            </div>
        <?php endif; ?>
    </div>
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
                        <input type="email" id="newsletter-email" placeholder="Enter your email" required
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
        // Video Carousel Functionality
        let currentSlide = 0;
        const totalSlides = 5;
        const carousel = document.getElementById('videoCarousel');
        const indicators = document.querySelectorAll('.indicator');

        function updateCarousel() {
            const translateX = -currentSlide * 100;
            carousel.style.transform = `translateX(${translateX}%)`;

            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateCarousel();
        }

        // Auto-advance slides every 8 seconds
        setInterval(nextSlide, 8000);

        // Search functionality (existing code unchanged)
        const searchInput = document.getElementById('searchInput');
        const activitiesGrid = document.getElementById('activitiesGrid');
        const searchStats = document.getElementById('searchStats');
        const noResults = document.getElementById('noResults');
        const activityCards = document.querySelectorAll('.activity-card');

        let totalActivities = activityCards.length;

        // Real-time search with debounce
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(this.value);
            }, 300);
        });

        function performSearch(searchTerm) {
            searchTerm = searchTerm.toLowerCase().trim();
            let visibleCount = 0;
            let hasVisibleCards = false;

            // Clear previous highlights
            clearHighlights();

            if (searchTerm === '') {
                // Show all cards
                activityCards.forEach((card, index) => {
                    card.classList.remove('hidden');
                    updateCardNumber(card, index + 1);
                    visibleCount++;
                });
                hasVisibleCards = true;
                updateSearchStats(visibleCount, totalActivities);
            } else {
                // Filter cards based on search term
                let visibleIndex = 1;

                activityCards.forEach(card => {
                    const activityData = JSON.parse(card.getAttribute('data-activity'));
                    const searchableText = [
                        activityData.name,
                        activityData.category,
                        activityData.location,
                        activityData.time,
                        activityData.participants
                    ].join(' ').toLowerCase();

                    if (searchableText.includes(searchTerm)) {
                        card.classList.remove('hidden');
                        updateCardNumber(card, visibleIndex++);
                        highlightSearchTerms(card, searchTerm);
                        visibleCount++;
                        hasVisibleCards = true;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                updateSearchStats(visibleCount, totalActivities, searchTerm);
            }

            // Show/hide no results message
            if (activitiesGrid) {
                activitiesGrid.style.display = hasVisibleCards ? 'grid' : 'none';
            }
            if (noResults) {
                noResults.style.display = hasVisibleCards ? 'none' : 'block';
            }
        }

        function updateCardNumber(card, number) {
            const cardNumber = card.querySelector('.card-number');
            if (cardNumber) {
                cardNumber.textContent = number;
            }
        }

        function updateSearchStats(visible, total, searchTerm = '') {
            if (!searchStats) return;

            if (searchTerm) {
                if (visible === 0) {
                    searchStats.textContent = `No activities found for "${searchTerm}"`;
                } else if (visible === 1) {
                    searchStats.textContent = `Found 1 activity matching "${searchTerm}"`;
                } else {
                    searchStats.textContent = `Found ${visible} activities matching "${searchTerm}"`;
                }
            } else {
                if (total === 1) {
                    searchStats.textContent = 'Showing 1 activity';
                } else {
                    searchStats.textContent = `Showing ${total} activities`;
                }
            }
        }

        function highlightSearchTerms(card, searchTerm) {
            const elementsToHighlight = card.querySelectorAll('.activity-title, .category-badge, .detail-value');

            elementsToHighlight.forEach(element => {
                const originalText = element.textContent;
                const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');

                if (regex.test(originalText)) {
                    element.innerHTML = originalText.replace(regex, '<span class="highlight">$1</span>');
                }
            });
        }

        function clearHighlights() {
            const highlightedElements = document.querySelectorAll('.highlight');
            highlightedElements.forEach(element => {
                const parent = element.parentNode;
                parent.replaceChild(document.createTextNode(element.textContent), element);
                parent.normalize();
            });
        }

        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        function clearSearch() {
            searchInput.value = '';
            performSearch('');
            searchInput.focus();
        }

        // Add smooth scroll effect when search results change
        searchInput.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
        });

        searchInput.addEventListener('blur', function() {
            if (this.value === '') {
                this.style.transform = 'translateY(0)';
            }
        });

        // Initialize search stats on page load
        if (totalActivities > 0) {
            updateSearchStats(totalActivities, totalActivities);
        }

        // Copy Video Link Function
        function copyVideoLink(link) {
            navigator.clipboard.writeText(link)
                .then(() => alert('Video link copied!'))
                .catch(err => console.error('Failed to copy:', err));
        }
    </script>

</body>

</html>