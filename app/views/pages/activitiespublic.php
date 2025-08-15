<!-- app/views/pages/activities_read.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
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
    </style>
</head>

<body>
    <!-- Hero Video Section -->
    <div class="hero-video-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Active Aging Adventures</h1>
                <p>Discover inspiring activities and wellness programs designed for active seniors</p>
            </div>

            <div class="video-carousel-container">
                <div class="video-carousel" id="videoCarousel">
                    <!-- Slide 1 - YouTube Videos -->
                    <div class="video-slide">
                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/8BcPHWGQO44" title="Seated Exercises for Older Adults" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Chair Exercises for Seniors</div>
                                <div class="video-description">20-minute gentle seated exercises for strength and mobility</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed"
                                src="https://www.youtube.com/embed/oBu-pQG6sTY"
                                title="Senior Yoga for Beginners"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                            <div class="video-info">
                                <div class="video-title">Gentle Yoga for Seniors</div>
                                <div class="video-description">Easy yoga poses perfect for beginners and older adults</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/uJZk7jafw-o" title="10 Exercises for Balance and Fall Prevention // Full Follow Along Workout" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Balance & Fall Prevention</div>
                                <div class="video-description">Simple exercises to improve balance and prevent falls</div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 - Vimeo Videos -->
                    <div class="video-slide">
                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/E2YqFYFLSbE" title="Gentle Range of Motion Chair Exercises for SENIORS (Arthritis/Limited Mobility/True Beginners)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Chair Yoga Flow</div>
                                <div class="video-description">Gentle stretching and movement from your chair</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/0UaHYhBX6Rw" title="20 Min Strength Training for Seniors and Beginners | Gentle Exercises" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Gentle Strength Training</div>
                                <div class="video-description">Safe resistance exercises for seniors</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/Uo1Umx4kABA" title="30 MINUTE WALKING WORKOUT | For Seniors and Beginners" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Indoor Walking Workout</div>
                                <div class="video-description">30-minute walking workout you can do at home</div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 - Dailymotion & Mixed Platforms -->
                    <div class="video-slide">
                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/uth_9K3EmDI" title="10 Minute Balance Exercises - To Do Everyday for Improved Balance!" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Tai Chi for Beginners</div>
                                <div class="video-description">Gentle movements for balance and relaxation</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/JEsZo3aRo50" title="The Best 4 Pool Exercises to Strengthen Your Core &amp; Tone Up" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Water Aerobics Fun</div>
                                <div class="video-description">Low-impact water exercises for joint health</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/ihba9Lw0tv4" title="10 Minute Morning Stretch for every day | Simple routine to wake up &amp; feel good" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Morning Stretches</div>
                                <div class="video-description">10-minute morning routine to start your day</div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 - SilverSneakers & Health Platform Videos -->
                    <div class="video-slide">
                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/NqFHwtxTPnE?list=RDNqFHwtxTPnE" title="Dynamite - Chair One Fitness Exclusive Choreo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Chair Dancing Workout</div>
                                <div class="video-description">Fun seated dance moves for cardio and joy</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/pwwISeTzCc4" title="Seated Core Workout for Seniors, Beginners" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Gentle Pilates</div>
                                <div class="video-description">Core strengthening with gentle movements</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/a4bQBXj0a0Y" title="10 Minute Guided Breathwork For Stress &amp; Anxiety I Feel Calm and Focused" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Relaxation & Meditation</div>
                                <div class="video-description">Guided breathing for stress relief and calm</div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 5 - Health Organizations & Educational Content -->
                    <div class="video-slide">
                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/90DKrNwwnzA" title="Daily Exercise Routine for JOINT PAIN RELIEF | Full Body Workout | Saurabh Bothra Yoga" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Arthritis-Friendly Exercises</div>
                                <div class="video-description">Joint-friendly movements for pain relief</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/SzbVLVxXO0s" title="How To Improve Your Balance - Home Exercises For Balance And Stability" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Advanced Balance Training</div>
                                <div class="video-description">Progressive exercises for stability improvement</div>
                            </div>
                        </div>

                        <div class="video-item">
                            <iframe class="video-embed" src="https://www.youtube.com/embed/KVm5QuXSxxA" title="5 Brain Exercises to Improve Memory and Concentration | Jim Kwik" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="video-info">
                                <div class="video-title">Memory & Brain Games</div>
                                <div class="video-description">Cognitive exercises to keep mind sharp</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-controls">
                    <button class="carousel-btn" onclick="prevSlide()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15,18 9,12 15,6"></polyline>
                        </svg>
                    </button>
                    <button class="carousel-btn" onclick="nextSlide()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9,18 15,12 9,6"></polyline>
                        </svg>
                    </button>
                </div>

                <div class="carousel-indicators">
                    <div class="indicator active" onclick="goToSlide(0)"></div>
                    <div class="indicator" onclick="goToSlide(1)"></div>
                    <div class="indicator" onclick="goToSlide(2)"></div>
                    <div class="indicator" onclick="goToSlide(3)"></div>
                    <div class="indicator" onclick="goToSlide(4)"></div>
                </div>
            </div>
        </div>
    </div>

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