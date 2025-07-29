<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/activities.css?v=<?= time(); ?>">

</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Activities Dashboard</h1>
            <p>Discover and explore our curated collection of activities</p>
        </div>

        <div id="errorMessage" class="error-message" style="display: none;"></div>

        <div class="controls">
            <div class="search-filter-container">
                <div class="search-box">
                    <svg class="search-icon icon" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input
                        type="text"
                        class="search-input"
                        placeholder="Search activities..."
                        id="searchInput">
                </div>
                <select class="filter-select" id="categoryFilter">
                    <option value="All">All Categories</option>
                    <option value="Physical">Physical</option>
                    <option value="Mental">Mental</option>
                    <option value="Social">Social</option>
                    <option value="Creative">Creative</option>
                </select>
                <select class="filter-select" id="statusFilter">
                    <option value="All">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <div class="loading" id="loadingIndicator">
            <div class="loading-spinner"></div>
            <p>Loading activities...</p>
        </div>

        <div class="activities-grid" id="activitiesGrid" style="display: none;">
            <!-- Activities will be populated by JavaScript -->
        </div>

        <div class="no-results" id="noResults" style="display: none;">
            <h3>No activities found</h3>
            <p>Try adjusting your search or filter criteria</p>
        </div>
    </div>

    <script>
        // Configuration - Update this path to match your project structure
        // Common configurations (uncomment the one that matches your setup):
        const API_BASE_URL = '/activities'; // If using root-based URLs
        // const API_BASE_URL = './activities'; // If in same directory
        // const API_BASE_URL = '../activities'; // If in subdirectory
        // const API_BASE_URL = 'http://localhost/your-project/activities'; // Full URL

        let allActivities = [];
        let filteredActivities = [];

        // DOM elements
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const statusFilter = document.getElementById('statusFilter');
        const activitiesGrid = document.getElementById('activitiesGrid');
        const noResults = document.getElementById('noResults');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const errorMessage = document.getElementById('errorMessage');

        // Category SVG icons
        const categoryIcons = {
            'Physical': `<svg viewBox="0 0 24 24"><path d="M12 2L13.09 6.26L18 6L14.5 10L18 14L13.09 17.74L12 22L10.91 17.74L6 18L9.5 14L6 10L10.91 6.26L12 2Z"/></svg>`,
            'Mental': `<svg viewBox="0 0 24 24"><path d="M21.33 12.91c.09-.33.15-.66.15-1a7.12 7.12 0 0 0-.15-.91c-.03-.15-.08-.29-.12-.44-.1-.36-.2-.72-.35-1.06-.03-.07-.05-.14-.08-.2C19.65 6.89 16.92 5 13.7 5s-5.95 1.89-7.08 4.3c-.03.06-.05.13-.08.2-.15.34-.25.7-.35 1.06-.04.15-.09.29-.12.44C6.03 11.34 6 11.67 6 12s.03.66.07 1c.03.15.08.29.12.44.1.36.2.72.35 1.06.03.07.05.14.08.2C7.75 17.11 10.48 19 13.7 19s5.95-1.89 7.08-4.3c.03-.07.05-.13.08-.2.15-.34.25-.7.35-1.06.04-.15.09-.29.12-.44zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/><circle cx="12" cy="12" r="2"/></svg>`,
            'Social': `<svg viewBox="0 0 24 24"><path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-6h3v8h-3v-2zm6.5 2h-3v-8h3v8zM12.5 11H16v7h-3.5v-7zM18 22v-6h3v8h-3v-2zm-1.5-6.5c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zM7 10c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>`,
            'Creative': `<svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9l-5.91 1.74L19 22l-7-3.73L5 22l2.91-11.26L2 9l6.91-1.74L12 2z"/></svg>`
        };

        // Default image for activities without images
        const DEFAULT_IMAGE = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=250&fit=crop';

        // Format time to 12-hour format
        function formatTime(time24) {
            if (!time24) return 'N/A';
            const [hours, minutes] = time24.split(':');
            const hour12 = hours % 12 || 12;
            const ampm = hours < 12 ? 'AM' : 'PM';
            return `${hour12}:${minutes} ${ampm}`;
        }

        // Show error message
        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
            loadingIndicator.style.display = 'none';
        }

        // Hide error message
        function hideError() {
            errorMessage.style.display = 'none';
        }

        // Show loading
        function showLoading() {
            loadingIndicator.style.display = 'block';
            activitiesGrid.style.display = 'none';
            noResults.style.display = 'none';
        }

        // Hide loading
        function hideLoading() {
            loadingIndicator.style.display = 'none';
        }

        // Create activity card HTML
        function createActivityCard(activity) {
            // Use default image if none provided or if image is invalid
            const imageUrl = activity.image && activity.image.trim() !== '' ? activity.image : DEFAULT_IMAGE;

            return `
                <div class="activity-card" onclick="viewActivity(${activity.id})">
                    <img src="${imageUrl}" alt="${activity.title}" class="activity-image" loading="lazy" onerror="this.src='${DEFAULT_IMAGE}'">
                    <div class="activity-content">
                        <div class="activity-header">
                            <h3 class="activity-title">${activity.title}</h3>
                            <div class="activity-category category-${activity.category.toLowerCase()}">
                                ${categoryIcons[activity.category] || ''} ${activity.category}
                            </div>
                        </div>
                        <p class="activity-description">${activity.description}</p>
                        <div class="activity-meta">
                            <div class="activity-time">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                ${formatTime(activity.time)}
                            </div>
                            <div class="activity-duration">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                ${activity.duration || 'N/A'} min
                            </div>
                            <div class="status-badge status-${activity.status}">
                                ${activity.status}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Render activities
        function renderActivities() {
            hideLoading();

            if (filteredActivities.length === 0) {
                activitiesGrid.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                activitiesGrid.style.display = 'grid';
                noResults.style.display = 'none';
                activitiesGrid.innerHTML = filteredActivities.map(createActivityCard).join('');
            }
        }

        // Filter activities
        function filterActivities() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedCategory = categoryFilter.value;
            const selectedStatus = statusFilter.value;

            filteredActivities = allActivities.filter(activity => {
                const matchesSearch = !searchTerm ||
                    activity.title.toLowerCase().includes(searchTerm) ||
                    activity.description.toLowerCase().includes(searchTerm);

                const matchesCategory = selectedCategory === 'All' || activity.category === selectedCategory;
                const matchesStatus = selectedStatus === 'All' || activity.status === selectedStatus;

                return matchesSearch && matchesCategory && matchesStatus;
            });

            renderActivities();
        }

        // Fetch activities from the server
        async function fetchActivities() {
            try {
                showLoading();
                hideError();

                console.log('Fetching from:', `${API_BASE_URL}/getAll`); // Debug log

                const response = await fetch(`${API_BASE_URL}/getAll`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest' // Indicates AJAX request
                    }
                });

                console.log('Response status:', response.status); // Debug log
                console.log('Response headers:', response.headers); // Debug log

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
                }

                const data = await response.json();
                console.log('Response data:', data); // Debug log

                if (data.success) {
                    allActivities = data.activities || [];
                    filteredActivities = [...allActivities];
                    console.log('Loaded activities:', allActivities.length); // Debug log
                    renderActivities();
                } else {
                    throw new Error(data.message || 'Failed to fetch activities');
                }
            } catch (error) {
                console.error('Error fetching activities:', error);

                // More detailed error message
                let errorMsg = 'Failed to load activities. ';
                if (error.message.includes('404')) {
                    errorMsg += 'Endpoint not found. Check your API_BASE_URL configuration.';
                } else if (error.message.includes('500')) {
                    errorMsg += 'Server error. Check your PHP backend logs.';
                } else if (error.message.includes('NetworkError') || error.message.includes('Failed to fetch')) {
                    errorMsg += 'Network error. Make sure your server is running.';
                } else {
                    errorMsg += error.message;
                }

                showError(errorMsg);
                allActivities = [];
                filteredActivities = [];
                renderActivities();
            }
        }

        // View single activity (you can customize this function)
        function viewActivity(id) {
            // You can implement this to show a modal or navigate to a detail page
            console.log('Viewing activity:', id);
            // Example: window.location.href = `activities/show/${id}`;
        }

        // Initialize the dashboard
        async function initializeDashboard() {
            // Set up event listeners
            searchInput.addEventListener('input', filterActivities);
            categoryFilter.addEventListener('change', filterActivities);
            statusFilter.addEventListener('change', filterActivities);

            // Load activities
            await fetchActivities();
        }

        // Start the application when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeDashboard);

        // Refresh activities function (can be called manually)
        function refreshActivities() {
            console.log('Refreshing activities...');
            fetchActivities();
        }

        // Removed auto-refresh - you can enable it manually if needed
        // setInterval(refreshActivities, 5 * 60 * 1000);
    </script>
</body>

</html>