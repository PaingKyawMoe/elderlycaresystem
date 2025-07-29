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
                    <button class="btn btn-success" onclick="refreshData()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh Data
                    </button>
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
        // Global variables - Use actual backend data
        const URLROOT = '<?= URLROOT ?>';
        let activities = <?= json_encode($data['activities'] ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

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
            renderStats();
            renderTable();
            attachEventListeners();
        });

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

        // Render activities table
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
                            <button class="btn btn-small btn-edit" onclick="editActivity(${activity.id})">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-small btn-delete" onclick="deleteActivity(${activity.id})">
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

        // Modal functions
        function openModal(activity = null) {
            isEditMode = !!activity;
            currentEditingId = activity ? activity.id : null;
            modalTitle.textContent = isEditMode ? 'Edit Activity' : 'Add New Activity';
            saveBtn.innerHTML = `<i class="fas fa-${isEditMode ? 'save' : 'plus'}"></i> ${isEditMode ? 'Update' : 'Create'} Activity`;

            if (activity) {
                // Populate form with activity data
                document.getElementById('activityId').value = activity.id;
                document.getElementById('activityTitle').value = activity.title;
                document.getElementById('activityCategory').value = activity.category;
                document.getElementById('activityTime').value = activity.time;
                document.getElementById('activityDuration').value = activity.duration;
                document.getElementById('activityStatus').value = activity.status;
                document.getElementById('activityImage').value = activity.image || '';
                document.getElementById('activityDescription').value = activity.description;
            } else {
                // Reset form for new activity
                activityForm.reset();
                document.getElementById('activityId').value = '';
                document.getElementById('activityStatus').value = 'active';
            }

            activityModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            document.getElementById('activityTitle').focus();
        }

        function closeModal() {
            activityModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            activityForm.reset();
            isEditMode = false;
            currentEditingId = null;
        }

        function editActivity(id) {
            const activity = activities.find(a => a.id == id);
            if (activity) {
                openModal(activity);
            } else {
                showMessage('Activity not found!', 'error');
            }
        }

        function deleteActivity(id) {
            const activity = activities.find(a => a.id == id);
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

        // Enhanced delete function with better error handling
        function confirmDelete() {
            if (!activityToDelete) return;

            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.classList.add('loading');
            confirmBtn.disabled = true;

            // Create form data for POST request
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
                    console.log('Delete response:', data); // Debug log

                    if (data.success) {
                        activities = activities.filter(a => a.id != activityToDelete.id);
                        filteredActivities = filteredActivities.filter(a => a.id != activityToDelete.id);
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

        // Form submission - FIXED to work with your backend
        function handleFormSubmit(e) {
            e.preventDefault();

            const formData = new FormData(activityForm);

            // Get form values
            const title = document.getElementById('activityTitle').value.trim();
            const description = document.getElementById('activityDescription').value.trim();
            const category = document.getElementById('activityCategory').value;
            const time = document.getElementById('activityTime').value;
            const duration = document.getElementById('activityDuration').value;
            const status = document.getElementById('activityStatus').value;
            const image = document.getElementById('activityImage').value.trim();

            // Validation
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

            // Prepare form data for backend
            const submitData = new FormData();
            submitData.append('title', title);
            submitData.append('description', description);
            submitData.append('category', category);
            submitData.append('time', time);
            submitData.append('duration', duration);
            submitData.append('status', status);
            submitData.append('image', image);

            // Add ID for edit mode
            if (isEditMode && currentEditingId) {
                submitData.append('id', currentEditingId);
            }

            const url = isEditMode ? `${URLROOT}/Activities/update` : `${URLROOT}/Activities/create`;

            fetch(url, {
                    method: 'POST',
                    body: submitData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Server response:', data); // Debug log

                    if (data.success) {
                        if (isEditMode && currentEditingId) {
                            // EDIT MODE - Update existing activity in local array
                            const index = activities.findIndex(a => a.id == currentEditingId);
                            if (index !== -1) {
                                activities[index] = {
                                    ...activities[index],
                                    title: title,
                                    category: category,
                                    time: time,
                                    duration: parseInt(duration),
                                    status: status,
                                    image: image || activities[index].image,
                                    description: description
                                };
                            }
                            showMessage('Activity updated successfully!', 'success');
                        } else {
                            // CREATE MODE - Add new activity from server response
                            const newActivity = {
                                id: data.id || Date.now(),
                                title: title,
                                category: category,
                                time: time,
                                duration: parseInt(duration),
                                status: status,
                                image: image || 'https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg',
                                description: description,
                                created_at: new Date().toISOString()
                            };
                            activities.push(newActivity);
                            showMessage('Activity created successfully!', 'success');
                        }

                        // Update filtered activities and refresh UI
                        filteredActivities = [...activities];
                        renderStats();
                        renderTable();
                        closeModal();
                    } else {
                        showMessage(data.message || 'Failed to save activity.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('An error occurred while saving the activity. Please check the console for details.', 'error');
                })
                .finally(() => {
                    saveBtn.classList.remove('loading');
                    saveBtn.disabled = false;
                });
        }

        // Enhanced refresh function with better error handling  
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
                    console.log('Refresh response:', data); // Debug log

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