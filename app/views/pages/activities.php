<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities Dashboard - Elder Care System</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/activities.css?v=<?= time(); ?>">
</head>

<body>
    <div class="activities-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Activity Center</h1>
            <p>Discover engaging activities designed to promote health, happiness, and social connection in our caring community.</p>
        </div>

        <!-- Modern Slider -->
        <div class="slider-wrapper" id="slider">
            <div class="slider-container">
                <div class="slider-slide active">
                    <img class="slider-img" src="https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Physical Activities">
                    <div class="slider-content">
                        <div class="slider-title">Physical Activities</div>
                        <div class="slider-desc">Start your day with energizing morning yoga, join our walking club for fresh air and friendship, or express yourself through therapeutic dance sessions.</div>
                        <a class="slider-btn" href="#" onclick="showSchedule(); return false;">View Schedule</a>
                    </div>
                </div>

                <div class="slider-slide">
                    <img class="slider-img" src="https://images.pexels.com/photos/8637983/pexels-photo-8637983.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Mental Activities">
                    <div class="slider-content">
                        <div class="slider-title">Mental Activities</div>
                        <div class="slider-desc">Keep your mind sharp and engaged with memory-boosting games, challenging puzzles, and captivating storytelling sessions that spark creativity.</div>
                        <a class="slider-btn" href="#" onclick="showSchedule(); return false;">View Schedule</a>
                    </div>
                </div>

                <div class="slider-slide">
                    <img class="slider-img" src="https://images.pexels.com/photos/7446764/pexels-photo-7446764.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Social Activities">
                    <div class="slider-content">
                        <div class="slider-title">Social Activities</div>
                        <div class="slider-desc">Build lasting friendships through group singing, celebrate special occasions together, and bond over collaborative cooking experiences.</div>
                        <a class="slider-btn" href="#" onclick="showSchedule(); return false;">View Schedule</a>
                    </div>
                </div>

                <div class="slider-slide">
                    <img class="slider-img" src="https://media.istockphoto.com/id/682635620/photo/seniors-playing-dominoes.jpg?b=1&s=612x612&w=0&k=20&c=--P5LL0i6QZZ69tgSKxK3t7WE4ZHJ_U-u9DMuk8dcIw=" alt="Creative Activities">
                    <div class="slider-content">
                        <div class="slider-title">Creative Activities</div>
                        <div class="slider-desc">Unleash your artistic side with jewelry making, painting workshops, and poetry writing sessions that celebrate your unique creativity.</div>
                        <a class="slider-btn" href="#" onclick="showSchedule(); return false;">View Schedule</a>
                    </div>
                </div>
            </div>

            <button class="slider-arrow left" onclick="prevSlide()" aria-label="Previous slide">‹</button>
            <button class="slider-arrow right" onclick="nextSlide()" aria-label="Next slide">›</button>

            <div class="slider-indicators">
                <div class="indicator active" onclick="goToSlide(0)"></div>
                <div class="indicator" onclick="goToSlide(1)"></div>
                <div class="indicator" onclick="goToSlide(2)"></div>
                <div class="indicator" onclick="goToSlide(3)"></div>
            </div>
        </div>

        <!-- Activity Grid -->
        <div class="activity-grid">
            <div class="activity-card fade-in-up" onclick="showSchedule()">
                <img class="activity-img" src="https://media.istockphoto.com/id/682635620/photo/seniors-playing-dominoes.jpg?b=1&s=612x612&w=0&k=20&c=--P5LL0i6QZZ69tgSKxK3t7WE4ZHJ_U-u9DMuk8dcIw=" alt="Mental Activities">
                <div class="activity-info">
                    <div class="activity-title">Mental Stimulation</div>
                    <div class="activity-desc">Engage your mind with memory games, crossword puzzles, and storytelling sessions designed to keep your cognitive abilities sharp and active.</div>
                    <div class="activity-time">9:00 AM - 10:00 AM</div>
                </div>
            </div>

            <div class="activity-card fade-in-up" onclick="showSchedule()">
                <img class="activity-img" src="https://media.istockphoto.com/id/856881212/photo/pleasant-walk-at-park.jpg?b=1&s=612x612&w=0&k=20&c=pIb09VxI7o-ZUSPDQA29MMiN1nm5ZL-vQ7J8zh5LJOM=" alt="Social Activities">
                <div class="activity-info">
                    <div class="activity-title">Social Connection</div>
                    <div class="activity-desc">Build meaningful relationships through group singing, birthday celebrations, and collaborative cooking sessions that bring our community together.</div>
                    <div class="activity-time">11:00 AM - 12:00 PM</div>
                </div>
            </div>

            <div class="activity-card fade-in-up" onclick="showSchedule()">
                <img class="activity-img" src="https://images.pexels.com/photos/28175940/pexels-photo-28175940/free-photo-of-abuelito-pintor.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Creative Activities">
                <div class="activity-info">
                    <div class="activity-title">Creative Expression</div>
                    <div class="activity-desc">Explore your artistic talents through jewelry making, painting workshops, and poetry writing that celebrates your unique creative voice.</div>
                    <div class="activity-time">4:00 PM - 5:00 PM</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Schedule Popup -->
    <div id="schedulePopup" class="popup-overlay">
        <div class="popup-content">
            <button class="popup-close" onclick="closeSchedule()" aria-label="Close popup">×</button>

            <div class="popup-header">
                <h2>Daily Activity Schedule</h2>
            </div>

            <div class="schedule-list">
                <div class="schedule-item">
                    <div class="schedule-activity">Physical Activities</div>
                    <div class="schedule-time">6:00 AM - 8:00 AM</div>
                </div>
                <div class="schedule-item">
                    <div class="schedule-activity">Mental Activities</div>
                    <div class="schedule-time">9:00 AM - 10:00 AM</div>
                </div>
                <div class="schedule-item">
                    <div class="schedule-activity">Social Activities</div>
                    <div class="schedule-time">11:00 AM - 12:00 PM</div>
                </div>
                <div class="schedule-item">
                    <div class="schedule-activity">Creative Activities</div>
                    <div class="schedule-time">4:00 PM - 5:00 PM</div>
                </div>
            </div>

            <div class="popup-footer">
                <p>We're always here and waiting for you. Join us for a fulfilling day!</p>
                <button class="popup-btn" onclick="closeSchedule()">Got It!</button>
            </div>
        </div>
    </div>

    <script>
        // Modern Slider Logic
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-slide');
        const indicators = document.querySelectorAll('.indicator');

        function updateSlider() {
            slides.forEach((slide, index) => {
                slide.classList.remove('active', 'prev');
                if (index === currentSlide) {
                    slide.classList.add('active');
                } else if (index < currentSlide) {
                    slide.classList.add('prev');
                }
            });

            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        // Touch/Swipe Support
        let startX = null;
        let startY = null;
        const slider = document.getElementById('slider');

        slider.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        }, {
            passive: true
        });

        slider.addEventListener('touchend', e => {
            if (startX === null || startY === null) return;

            let endX = e.changedTouches[0].clientX;
            let endY = e.changedTouches[0].clientY;
            let deltaX = endX - startX;
            let deltaY = endY - startY;

            // Only trigger swipe if horizontal movement is greater than vertical
            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                if (deltaX > 50) {
                    prevSlide();
                } else if (deltaX < -50) {
                    nextSlide();
                }
            }

            startX = null;
            startY = null;
        }, {
            passive: true
        });

        // Auto-slide with pause on hover
        let autoSlideInterval;

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        slider.addEventListener('mouseenter', stopAutoSlide);
        slider.addEventListener('mouseleave', startAutoSlide);

        // Popup Functions
        function showSchedule() {
            document.getElementById('schedulePopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSchedule() {
            document.getElementById('schedulePopup').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            const popup = document.getElementById('schedulePopup');

            if (popup.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeSchedule();
                }
            } else {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                }
            }
        });

        // Close popup when clicking outside
        document.getElementById('schedulePopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSchedule();
            }
        });

        // Intersection Observer for Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Start auto-slide
            startAutoSlide();

            // Animate cards on scroll
            const cards = document.querySelectorAll('.activity-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `all 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });

            // Preload images
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        });

        // Performance optimization: Reduce animations on low-end devices
        if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
            document.documentElement.style.setProperty('--animation-duration', '0.3s');
        }
    </script>
</body>

</html>