<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities Admin - Elder Care System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/adminact.css?v=<?= time(); ?>">

</head>

<body>
    <div class="admin-container">
        <!-- Admin Header -->
        <div class="admin-header">
            <h1>
                <i class="fas fa-cogs"></i>
                Activities Administration
            </h1>
            <p>Manage and organize all activities for the elder care community</p>
        </div>

        <!-- Control Panel -->
        <div class="control-panel">
            <div class="control-buttons">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <button class="btn btn-primary" onclick="openModal()">
                        <i class="fas fa-plus"></i>
                        Add New Activity
                    </button>
                    <!-- <button class="btn btn-success" onclick="refreshData()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh Data
                    </button> -->
                </div>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="<?= URLROOT ?>/pages/activities" class="btn btn-secondary">
                        <i class="fas fa-eye"></i>
                        View Public Page
                    </a>
                    <a href="<?= URLROOT ?>/pages/dashboard" class="btn btn-secondary">
                        Back to Dashboard
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid" id="statsGrid">
            <!-- Stats will be populated by JavaScript -->
        </div>

        <!-- Activities Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">All Activities</h2>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search activities..." id="searchInput">
                    <select class="filter-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Physical">Physical</option>
                        <option value="Mental">Mental</option>
                        <option value="Social">Social</option>
                        <option value="Creative">Creative</option>
                    </select>
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Activity</th>
                            <th>Time & Duration</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="activitiesTableBody">
                        <!-- Table content will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Activity Modal -->
    <div id="activityModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Activity</h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="activityForm">
                    <input type="hidden" id="activityId" name="id">

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="activityTitle">Activity Title *</label>
                            <input type="text" id="activityTitle" name="title" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="activityCategory">Category *</label>
                            <select id="activityCategory" name="category" class="form-select" required>
                                <option value="">Select Category</option>
                                <option value="Physical">Physical Activities</option>
                                <option value="Mental">Mental Activities</option>
                                <option value="Social">Social Activities</option>
                                <option value="Creative">Creative Activities</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="activityTime">Time *</label>
                            <input type="time" id="activityTime" name="time" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="activityDuration">Duration (minutes) *</label>
                            <input type="number" id="activityDuration" name="duration" class="form-input" min="15" max="240" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="activityStatus">Status *</label>
                            <select id="activityStatus" name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="activityImage">Image URL</label>
                            <input type="url" id="activityImage" name="image" class="form-input" placeholder="https://example.com/image.jpg">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="activityDescription">Description *</label>
                        <textarea id="activityDescription" name="description" class="form-textarea" rows="4" required placeholder="Describe the activity in detail..."></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" form="activityForm" id="saveBtn">
                    <i class="fas fa-save"></i>
                    Save Activity
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay delete-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Delete</h2>
                <button class="modal-close" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="delete-info">
                    <i class="fas fa-exclamation-triangle delete-icon"></i>
                    <h3 class="delete-title">Delete Activity</h3>
                    <p>Are you sure you want to delete this activity?</p>
                    <p><strong id="deleteActivityName"></strong></p>
                </div>

                <div class="delete-warning">
                    <p>
                        <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                        This action cannot be undone and will permanently remove the activity from the system.
                    </p>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i>
                    Delete Activity
                </button>
            </div>
        </div>
    </div>

    <!-- Message Container -->
    <div id="messageContainer" class="message-container"></div>

    <script>
        // Global variables - Use actual backend data with fallback
        const URLROOT = '<?= URLROOT ?>';
        let activities = [];

        // Try to get data from PHP backend
        try {
            const phpData = <?= json_encode($data['activities'] ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
            if (phpData && Array.isArray(phpData)) {
                activities = phpData;
                console.log('Loaded activities from PHP:', activities.length, 'items');
            }
        } catch (e) {
            console.log('No PHP data available, will load from API');
            activities = [];
        }

        let filteredActivities = [...activities];
        let isEditMode = false;
        let activityToDelete = null;
        let currentEditingId = null;

        // DOM elements
        const statsGrid = document.getElementById('statsGrid');
        const activitiesTableBody = document.getElementById('activitiesTableBody');
        const activityModal = document.getElementById('activityModal');
        const deleteModal = document.getElementById('deleteModal');
        const activityForm = document.getElementById('activityForm');
        const modalTitle = document.getElementById('modalTitle');
        const saveBtn = document.getElementById('saveBtn');
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const statusFilter = document.getElementById('statusFilter');

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initial activities data:', activities); // Debug log

            // If no data from PHP backend, load it immediately
            if (!activities || activities.length === 0) {
                console.log('No initial data found, loading from database...');
                loadInitialData();
            } else {
                console.log('Found initial data, rendering...');
                renderStats();
                renderTable();
            }

            attachEventListeners();
        });

        // Load initial data from database if not provided by PHP
        function loadInitialData() {
            console.log('Loading initial data from database...');

            // Show loading indicator
            statsGrid.innerHTML = `
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">Loading...</div>
                            <div class="stat-label">Please wait</div>
                        </div>
                        <div class="stat-icon total">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
            `;

            activitiesTableBody.innerHTML = `
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fas fa-spinner fa-spin"></i>
                            <h3>Loading Activities...</h3>
                            <p>Please wait while we fetch your activities data.</p>
                        </div>
                    </td>
                </tr>
            `;

            fetch(`${URLROOT}/Activities/getAll`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Initial data loaded:', data);

                    if (data.success && data.activities) {
                        activities = data.activities;
                        filteredActivities = [...activities];
                        renderStats();
                        renderTable();
                        console.log('Successfully loaded and rendered', activities.length, 'activities');
                    } else {
                        console.error('Failed to load initial data:', data);
                        showMessage('Failed to load activities data.', 'error');
                        // Show empty state
                        activities = [];
                        filteredActivities = [];
                        renderStats();
                        renderTable();
                    }
                })
                .catch(error => {
                    console.error('Error loading initial data:', error);
                    showMessage('Error loading activities. Please check your connection.', 'error');
                    // Show empty state
                    activities = [];
                    filteredActivities = [];
                    renderStats();
                    renderTable();
                });
        }

        // Render statistics
        function renderStats() {
            const stats = {
                total: activities.length,
                active: activities.filter(a => a.status === 'active').length,
                inactive: activities.filter(a => a.status === 'inactive').length,
                categories: [...new Set(activities.map(a => a.category))].length
            };

            statsGrid.innerHTML = `
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">${stats.total}</div>
                            <div class="stat-label">Total Activities</div>
                        </div>
                        <div class="stat-icon total">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">${stats.active}</div>
                            <div class="stat-label">Active</div>
                        </div>
                        <div class="stat-icon active">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">${stats.inactive}</div>
                            <div class="stat-label">Inactive</div>
                        </div>
                        <div class="stat-icon inactive">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">${stats.categories}</div>
                            <div class="stat-label">Categories</div>
                        </div>
                        <div class="stat-icon categories">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                </div>
            `;
        }

        // Render activities table - FIXED: Better ID handling in onclick handlers
        function renderTable() {
            if (filteredActivities.length === 0) {
                activitiesTableBody.innerHTML = `
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-calendar-times"></i>
                                <h3>No Activities Found</h3>
                                <p>No activities match your search criteria or none have been created yet.</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            const tableHTML = filteredActivities.map(activity => `
                <tr>
                    <td>
                        <img class="activity-img" 
                             src="${activity.image || 'https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg?auto=compress&cs=tinysrgb&w=200'}" 
                             alt="${activity.title}"
                             onerror="this.src='https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg?auto=compress&cs=tinysrgb&w=200'">
                    </td>
                    <td>
                        <div class="activity-title">${escapeHTML(activity.title)}</div>
                        <div class="activity-category">${activity.category}</div>
                    </td>
                    <td>
                        <div><strong>${formatTime(activity.time)}</strong></div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem;">${activity.duration} minutes</div>
                    </td>
                    <td>
                        <span class="status-badge status-${activity.status}">
                            ${activity.status}
                        </span>
                    </td>
                    <td>
                        <div>${formatDate(activity.created_at)}</div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-small btn-edit" onclick="editActivity('${activity.id}')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-small btn-delete" onclick="deleteActivity('${activity.id}')">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');

            activitiesTableBody.innerHTML = tableHTML;
        }

        // Filter activities
        function filterActivities() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const categoryValue = categoryFilter.value;
            const statusValue = statusFilter.value;

            filteredActivities = activities.filter(activity => {
                const matchesSearch = !searchTerm ||
                    activity.title.toLowerCase().includes(searchTerm) ||
                    activity.description.toLowerCase().includes(searchTerm) ||
                    activity.category.toLowerCase().includes(searchTerm);

                const matchesCategory = !categoryValue || activity.category === categoryValue;
                const matchesStatus = !statusValue || activity.status === statusValue;

                return matchesSearch && matchesCategory && matchesStatus;
            });

            renderTable();
        }

        // Attach event listeners
        function attachEventListeners() {
            // Search functionality
            let searchTimeout;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(filterActivities, 300);
            });

            categoryFilter.addEventListener('change', filterActivities);
            statusFilter.addEventListener('change', filterActivities);

            // Form submission
            activityForm.addEventListener('submit', handleFormSubmit);

            // Modal close events
            activityModal.addEventListener('click', (e) => {
                if (e.target === activityModal) closeModal();
            });

            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) closeDeleteModal();
            });

            // Keyboard events
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (activityModal.classList.contains('active')) closeModal();
                    if (deleteModal.classList.contains('active')) closeDeleteModal();
                }
            });
        }

        // Modal functions - ENHANCED for debugging with FIXED ID handling
        function openModal(activity = null) {
            isEditMode = !!activity;
            currentEditingId = activity ? activity.id : null;

            console.group('🔧 Opening Modal');
            console.log('Mode:', isEditMode ? 'EDIT' : 'CREATE');
            console.log('Activity ID:', currentEditingId);
            console.log('Activity Data:', activity);
            console.groupEnd();

            modalTitle.textContent = isEditMode ? 'Edit Activity' : 'Add New Activity';
            saveBtn.innerHTML = `<i class="fas fa-${isEditMode ? 'save' : 'plus'}"></i> ${isEditMode ? 'Update' : 'Create'} Activity`;

            if (activity) {
                // Populate form with activity data
                try {
                    document.getElementById('activityId').value = activity.id || '';
                    document.getElementById('activityTitle').value = activity.title || '';
                    document.getElementById('activityCategory').value = activity.category || '';
                    document.getElementById('activityTime').value = activity.time || '';
                    document.getElementById('activityDuration').value = activity.duration || '';
                    document.getElementById('activityStatus').value = activity.status || 'active';
                    document.getElementById('activityImage').value = activity.image || '';
                    document.getElementById('activityDescription').value = activity.description || '';

                    console.log('✅ Form populated successfully');
                    console.log('Current title:', activity.title);
                    console.log('Current ID:', activity.id);
                } catch (error) {
                    console.error('❌ Error populating form:', error);
                    showMessage('Error loading activity data', 'error');
                    return;
                }
            } else {
                // Reset form for new activity
                activityForm.reset();
                document.getElementById('activityId').value = '';
                document.getElementById('activityStatus').value = 'active';
                console.log('✅ Form reset for new activity');
            }

            activityModal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Focus on title field after a short delay
            setTimeout(() => {
                document.getElementById('activityTitle').focus();
            }, 100);
        }

        function closeModal() {
            activityModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            activityForm.reset();
            isEditMode = false;
            currentEditingId = null;
        }

        // FIXED: editActivity function with proper string ID handling
        function editActivity(id) {
            console.group('Edit Activity Request');
            console.log('Requested ID:', id, typeof id);
            console.log('Available activities:', activities.length);

            // Convert ID to string for consistent comparison since IDs in onclick are strings
            const searchId = String(id);

            const activity = activities.find(a => {
                const activityId = String(a.id);
                console.log(`Comparing: "${activityId}" === "${searchId}"`);
                return activityId === searchId;
            });

            console.log('Found activity:', activity);
            console.groupEnd();

            if (activity) {
                openModal(activity);
            } else {
                console.error('❌ Activity not found with ID:', id);
                console.log('Available IDs:', activities.map(a => ({
                    id: a.id,
                    type: typeof a.id,
                    title: a.title
                })));
                showMessage('Activity not found! Please refresh the page.', 'error');
            }
        }

        function deleteActivity(id) {
            // Use same string conversion for consistency
            const activity = activities.find(a => String(a.id) === String(id));
            if (activity) {
                activityToDelete = activity;
                document.getElementById('deleteActivityName').textContent = activity.title;
                deleteModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeDeleteModal() {
            deleteModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            activityToDelete = null;
        }

        // Enhanced delete function - YOUR ORIGINAL BACKEND INTEGRATION
        function confirmDelete() {
            if (!activityToDelete) return;

            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.classList.add('loading');
            confirmBtn.disabled = true;

            // Create form data for POST request - YOUR ORIGINAL CODE
            const formData = new FormData();
            formData.append('id', activityToDelete.id);

            fetch(`${URLROOT}/Activities/delete`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Delete response:', data);

                    if (data.success) {
                        // IMMEDIATELY remove from local arrays - no refresh needed
                        const deletedId = String(activityToDelete.id);
                        activities = activities.filter(a => String(a.id) !== deletedId);
                        filteredActivities = filteredActivities.filter(a => String(a.id) !== deletedId);

                        // IMMEDIATELY update the view
                        renderStats();
                        renderTable();
                        closeDeleteModal();
                        showMessage('Activity deleted successfully!', 'success');
                    } else {
                        showMessage(data.message || 'Failed to delete activity.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    showMessage('An error occurred while deleting the activity. Please check the console for details.', 'error');
                })
                .finally(() => {
                    confirmBtn.classList.remove('loading');
                    confirmBtn.disabled = false;
                });
        }

        // Form submission - YOUR ORIGINAL BACKEND INTEGRATION with FIXED ID handling
        function handleFormSubmit(e) {
            e.preventDefault();

            // Get form values
            const title = document.getElementById('activityTitle').value.trim();
            const description = document.getElementById('activityDescription').value.trim();
            const category = document.getElementById('activityCategory').value;
            const time = document.getElementById('activityTime').value;
            const duration = document.getElementById('activityDuration').value;
            const status = document.getElementById('activityStatus').value;
            const image = document.getElementById('activityImage').value.trim();

            // Client-side validation
            if (!title || !description || !category || !time || !duration) {
                showMessage('Please fill in all required fields.', 'error');
                return;
            }

            if (duration < 15 || duration > 240) {
                showMessage('Duration must be between 15 and 240 minutes.', 'error');
                return;
            }

            // Show loading state
            saveBtn.classList.add('loading');
            saveBtn.disabled = true;
            saveBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${isEditMode ? 'Updating...' : 'Creating...'}`;

            // Prepare form data for your backend - YOUR ORIGINAL CODE
            const submitData = new FormData();
            submitData.append('title', title);
            submitData.append('description', description);
            submitData.append('category', category);
            submitData.append('time', time);
            submitData.append('duration', duration);
            submitData.append('status', status);

            // Only append image if it has a value
            if (image) {
                submitData.append('image', image);
            } else {
                submitData.append('image', ''); // Send empty string if no image
            }

            // CRITICAL: Add ID for edit mode - this is what your backend expects
            if (isEditMode && currentEditingId) {
                submitData.append('id', currentEditingId);
            }

            const url = isEditMode ? `${URLROOT}/Activities/update` : `${URLROOT}/Activities/create`;

            // Debug logging
            console.group(`🚀 ${isEditMode ? 'UPDATE' : 'CREATE'} Request`);
            console.log('URL:', url);
            console.log('Mode:', isEditMode ? 'EDIT' : 'CREATE');
            console.log('Activity ID:', currentEditingId);
            console.log('Form Data:');
            for (let [key, value] of submitData.entries()) {
                console.log(`  ${key}: "${value}"`);
            }
            console.groupEnd();

            // Make the request - YOUR ORIGINAL BACKEND INTEGRATION
            fetch(url, {
                    method: 'POST',
                    body: submitData
                })
                .then(response => {
                    console.log('📡 Response Status:', response.status, response.statusText);

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    return response.text(); // Get as text first to debug
                })
                .then(responseText => {
                    console.log('📄 Raw Response:', responseText);

                    // Parse JSON
                    let data;
                    try {
                        data = JSON.parse(responseText);
                    } catch (e) {
                        console.error('❌ JSON Parse Error:', e);
                        throw new Error('Invalid JSON response from server');
                    }

                    console.log('📦 Parsed Response:', data);

                    // Handle response based on your backend structure
                    if (data.success === true) {
                        console.log('✅ Success Response');

                        if (isEditMode && currentEditingId) {
                            // EDIT MODE - Update local data immediately with FIXED string comparison
                            const index = activities.findIndex(a => String(a.id) === String(currentEditingId));
                            if (index !== -1) {
                                // Update the activity object
                                activities[index] = {
                                    ...activities[index], // Keep existing fields
                                    title: title,
                                    category: category,
                                    time: time,
                                    duration: parseInt(duration),
                                    status: status,
                                    description: description,
                                    image: image || activities[index].image || null
                                };

                                // Update filtered array with same string comparison
                                const filteredIndex = filteredActivities.findIndex(a => String(a.id) === String(currentEditingId));
                                if (filteredIndex !== -1) {
                                    filteredActivities[filteredIndex] = {
                                        ...activities[index]
                                    };
                                } else {
                                    // Re-apply filters if item not in current filtered view
                                    filterActivities();
                                }

                                console.log('✅ Local data updated:', activities[index]);
                            }
                            showMessage(data.message || 'Activity updated successfully!', 'success');
                        } else {
                            // CREATE MODE - Add new activity
                            const newActivity = {
                                id: data.id || Date.now(),
                                title: title,
                                category: category,
                                time: time,
                                duration: parseInt(duration),
                                status: status,
                                image: image || null,
                                description: description,
                                created_at: new Date().toISOString()
                            };

                            activities.unshift(newActivity);
                            filteredActivities.unshift(newActivity);

                            console.log('✅ New activity added:', newActivity);
                            showMessage(data.message || 'Activity created successfully!', 'success');
                        }

                        // Update UI immediately
                        renderStats();
                        renderTable();
                        closeModal();

                    } else {
                        // Handle failure response
                        console.error('❌ Server Error:', data);
                        const errorMsg = data.message || (isEditMode ? 'Failed to update activity' : 'Failed to create activity');
                        showMessage(errorMsg, 'error');
                    }
                })
                .catch(error => {
                    console.group('❌ Request Failed');
                    console.error('Error:', error);
                    console.groupEnd();

                    let userMessage = `An error occurred while ${isEditMode ? 'updating' : 'creating'} the activity.`;

                    if (error.message.includes('JSON')) {
                        userMessage = 'Server returned invalid response. Please check server logs.';
                    } else if (error.message.includes('HTTP')) {
                        userMessage = `Server error: ${error.message}`;
                    } else if (error.message.includes('fetch')) {
                        userMessage = 'Network error. Please check your connection.';
                    }

                    showMessage(userMessage, 'error');
                })
                .finally(() => {
                    // Reset button state
                    saveBtn.classList.remove('loading');
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = `<i class="fas fa-${isEditMode ? 'save' : 'plus'}"></i> ${isEditMode ? 'Update' : 'Create'} Activity`;
                });
        }

        // Enhanced refresh function with better error handling - YOUR ORIGINAL BACKEND
        function refreshData() {
            const refreshBtn = document.querySelector('.btn-success');
            refreshBtn.classList.add('loading');
            refreshBtn.disabled = true;

            fetch(`${URLROOT}/Activities/getAll`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Refresh response:', data);

                    if (data.success && data.activities) {
                        activities = data.activities;
                        filteredActivities = [...activities];
                        renderStats();
                        renderTable();
                        showMessage('Data refreshed successfully!', 'success');
                    } else {
                        showMessage(data.message || 'Failed to refresh data.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Refresh error:', error);
                    showMessage('An error occurred while refreshing data. Please check the console for details.', 'error');
                })
                .finally(() => {
                    refreshBtn.classList.remove('loading');
                    refreshBtn.disabled = false;
                });
        }

        // Utility functions
        function formatTime(timeString) {
            if (!timeString) return '';
            const [hours, minutes] = timeString.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const displayHour = hour % 12 || 12;
            return `${displayHour}:${minutes} ${ampm}`;
        }

        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function escapeHTML(str) {
            if (!str) return '';
            return str.replace(/[&<>"']/g, (match) => {
                const escapeMap = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                };
                return escapeMap[match];
            });
        }

        function showMessage(message, type = 'info') {
            const messageContainer = document.getElementById('messageContainer');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            messageDiv.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
                <button class="message-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;

            messageContainer.appendChild(messageDiv);

            setTimeout(() => {
                if (messageDiv.parentElement) {
                    messageDiv.remove();
                }
            }, 5000);
        }

        // Make functions globally available
        window.openModal = openModal;
        window.closeModal = closeModal;
        window.editActivity = editActivity;
        window.deleteActivity = deleteActivity;
        window.closeDeleteModal = closeDeleteModal;
        window.confirmDelete = confirmDelete;
        window.refreshData = refreshData;
    </script>
</body>

</html>