<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .content {
            padding: 40px;
        }

        .form-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(79, 70, 229, 0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 16px;
            border: 2px dashed #d1d5db;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f9fafb;
            color: #6b7280;
        }

        .file-input-label:hover {
            border-color: #4f46e5;
            background: #f0f4ff;
            color: #4f46e5;
        }

        .existing-photo {
            margin-bottom: 15px;
            text-align: center;
        }

        .existing-photo img {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 120px;
            height: auto;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 2px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .activities-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(79, 70, 229, 0.1);
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 95%;
            border-collapse: collapse;
            background: white;
        }

        thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #374151;
            font-weight: 700;
            padding: 18px 15px;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e5e7eb;
        }

        tbody td {
            padding: 18px 15px;
            border-bottom: 1px solid #f3f4f6;
            color: #4b5563;
            font-size: 0.95rem;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #f8fafc;
            transform: translateX(4px);
        }

        .activity-photo {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 60px;
            height: auto;
        }

        .action-links {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .action-links a {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .edit-link {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .edit-link:hover {
            background: #bfdbfe;
            transform: translateY(-1px);
        }

        .delete-link {
            background: #fecaca;
            color: #dc2626;
        }

        .delete-link:hover {
            background: #fca5a5;
            transform: translateY(-1px);
        }

        .no-activities {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 40px;
            background: #f9fafb;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .category-mental {
            background: #ddd6fe;
            color: #7c3aed;
        }

        .category-physical {
            background: #dcfce7;
            color: #16a34a;
        }

        .category-creative {
            background: #fed7d7;
            color: #e53e3e;
        }

        .category-social {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .content {
                padding: 20px;
            }

            .form-section,
            .activities-section {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .header h2 {
                font-size: 2rem;
            }

            .table-container {
                font-size: 0.9rem;
            }

            .action-links {
                flex-direction: column;
                gap: 5px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
            }
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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