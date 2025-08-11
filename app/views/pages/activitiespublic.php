<!-- app/views/pages/activities_read.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/publicview.css?v=<?= time(); ?>">
</head>

<body>
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
        // Search functionality
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
    </script>

</body>

</html>