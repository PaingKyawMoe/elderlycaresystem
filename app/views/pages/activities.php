<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/activities.css?v=<?= time(); ?>">
</head>

<body>
    <div class="container fade-in">
        <div class="header">
            <!-- Your PHP code remains unchanged -->
            <?php
            // If editing, $data['editActivity'] will be set, otherwise not
            $editActivity = $data['editActivity'] ?? null;
            ?>
            <h2><i class="fas fa-calendar-alt"></i> <?= $editActivity ? 'Edit Activity' : 'Add Activity' ?></h2>
        </div>

        <div class="content">
            <div class="form-section">
                <form action="<?= URLROOT ?>/activities/<?= $editActivity ? 'update/' . $editActivity['id'] : 'store' ?>" method="POST" enctype="multipart/form-data" id="activityForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="activity_name"><i class="fas fa-tag"></i> Activity Name</label>
                            <input type="text" id="activity_name" name="activity_name" required value="<?= $editActivity ? htmlspecialchars($editActivity['activity_name']) : '' ?>" placeholder="Enter activity name">
                        </div>

                        <div class="form-group">
                            <label for="category"><i class="fas fa-list"></i> Category</label>
                            <select id="category" name="category" required>
                                <?php
                                $categories = ['Mental', 'Physical', 'Creative', 'Social'];
                                foreach ($categories as $cat):
                                ?>
                                    <option value="<?= $cat ?>" <?= ($editActivity && $editActivity['category'] === $cat) ? 'selected' : '' ?>><?= $cat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-image"></i> Photo</label>
                            <?php if ($editActivity && !empty($editActivity['photo'])): ?>
                                <div class="existing-photo">
                                    <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($editActivity['photo']) ?>" alt="Existing Photo">
                                    <input type="hidden" name="existing_photo" value="<?= htmlspecialchars($editActivity['photo']) ?>">
                                    <small style="display: block; margin-top: 8px; color: #6b7280;">Upload new photo to replace</small>
                                </div>
                            <?php endif; ?>
                            <div class="file-input-wrapper">
                                <input type="file" name="photo" id="photo" accept="image/*">
                                <label for="photo" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose Photo</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time"><i class="fas fa-clock"></i> Time</label>
                            <input type="time" id="time" name="time" required value="<?= $editActivity ? date('H:i', strtotime($editActivity['time'])) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="participants"><i class="fas fa-users"></i> Participants</label>
                            <input type="number" id="participants" name="participants" min="1" required value="<?= $editActivity ? htmlspecialchars($editActivity['participants']) : '' ?>" placeholder="Number of participants">
                        </div>

                        <div class="form-group">
                            <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
                            <input type="text" id="location" name="location" required value="<?= $editActivity ? htmlspecialchars($editActivity['location']) : '' ?>" placeholder="Enter location">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            <?= $editActivity ? 'Update Activity' : 'Add Activity' ?>
                        </button>
                        <a href="<?= URLROOT ?>/Appointment/list" class="btn btn-secondary">
                            Back
                        </a>
                        <?php if ($editActivity): ?>
                            <a href="<?= URLROOT ?>/activities" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Cancel
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="activities-section">
                <h3 class="section-title">
                    <i class="fas fa-list-ul"></i>
                    Activities List
                </h3>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Photo</th>
                                <th>Time</th>
                                <th>Participants</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['activities']) && is_array($data['activities'])): ?>
                                <?php foreach ($data['activities'] as $activity): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($activity['id']) ?></td>
                                        <td><?= htmlspecialchars($activity['activity_name']) ?></td>
                                        <td>
                                            <span class="category-badge category-<?= strtolower($activity['category']) ?>">
                                                <?= htmlspecialchars($activity['category']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if (!empty($activity['photo'])): ?>
                                                <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($activity['photo']) ?>" alt="Photo" class="activity-photo">
                                            <?php else: ?>
                                                <span style="color: #9ca3af;">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars(date('H:i', strtotime($activity['time']))) ?></td>
                                        <td>
                                            <i class="fas fa-users" style="color: #6b7280; margin-right: 5px;"></i>
                                            <?= htmlspecialchars($activity['participants']) ?>
                                        </td>
                                        <td>
                                            <i class="fas fa-map-marker-alt" style="color: #6b7280; margin-right: 5px;"></i>
                                            <?= htmlspecialchars($activity['location']) ?>
                                        </td>
                                        <td>
                                            <div class="action-links">
                                                <a href="<?= URLROOT ?>/activities/index/<?= $activity['id'] ?>" class="edit-link">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= URLROOT ?>/activities/delete/<?= $activity['id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this activity?');">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="no-activities">
                                        <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                                        No activities found. Create your first activity above!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File input enhancement
            const fileInput = document.getElementById('photo');
            const fileLabel = fileInput.nextElementSibling;
            const originalText = fileLabel.querySelector('span').textContent;

            fileInput.addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : originalText;
                fileLabel.querySelector('span').textContent = this.files[0] ? fileName : originalText;

                if (this.files[0]) {
                    fileLabel.style.borderColor = '#4f46e5';
                    fileLabel.style.backgroundColor = '#f0f4ff';
                    fileLabel.style.color = '#4f46e5';
                } else {
                    fileLabel.style.borderColor = '#d1d5db';
                    fileLabel.style.backgroundColor = '#f9fafb';
                    fileLabel.style.color = '#6b7280';
                }
            });

            // Form submission enhancement
            const form = document.getElementById('activityForm');
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;
                form.classList.add('loading');
            });

            // Enhanced delete confirmation
            const deleteLinks = document.querySelectorAll('.delete-link');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const result = confirm('⚠️ Are you sure you want to delete this activity?\n\nThis action cannot be undone.');

                    if (result) {
                        // Add loading state
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                        this.style.pointerEvents = 'none';
                        this.style.opacity = '0.7';

                        // Navigate to delete URL
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 500);
                    }
                });
            });

            // Add smooth animations to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('fade-in');
            });

            // Form validation enhancement
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                field.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.style.borderColor = '#ef4444';
                        this.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
                    } else {
                        this.style.borderColor = '#10b981';
                        this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
                    }
                });

                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.style.borderColor = '#e5e7eb';
                        this.style.boxShadow = '';
                    }
                });
            });
        });
    </script>
</body>

</html>