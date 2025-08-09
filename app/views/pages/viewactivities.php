<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Center - Daily Activities</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f8ff 50%, #fff8dc 100%);
            min-height: 100vh;
            padding: 20px;
            font-size: 18px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #2c5530 0%, #3d7c47 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 15px 35px rgba(44, 85, 48, 0.3);
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1.4rem;
            opacity: 0.9;
            font-style: italic;
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .activity-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            border: 3px solid transparent;
            position: relative;
        }

        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .activity-card.mental {
            border-color: #8b5cf6;
        }

        .activity-card.physical {
            border-color: #10b981;
        }

        .activity-card.creative {
            border-color: #f59e0b;
        }

        .activity-card.social {
            border-color: #3b82f6;
        }

        .card-header {
            padding: 25px 30px 20px;
            position: relative;
        }

        .category-badge {
            position: absolute;
            top: -15px;
            right: 25px;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .category-badge.mental {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .category-badge.physical {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .category-badge.creative {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .category-badge.social {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .activity-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .activity-photo {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .no-photo {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            border: 2px dashed #d1d5db;
        }

        .no-photo i {
            font-size: 4rem;
            color: #9ca3af;
        }

        .card-body {
            padding: 0 30px 30px;
        }

        .activity-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 25px;
        }

        .detail-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 15px;
            border-left: 5px solid;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .detail-item.time {
            border-left-color: #3b82f6;
        }

        .detail-item.participants {
            border-left-color: #10b981;
        }

        .detail-item.location {
            border-left-color: #f59e0b;
            grid-column: 1 / -1;
        }

        .detail-icon {
            font-size: 1.8rem;
            margin-bottom: 10px;
            display: block;
        }

        .detail-icon.time {
            color: #3b82f6;
        }

        .detail-icon.participants {
            color: #10b981;
        }

        .detail-icon.location {
            color: #f59e0b;
        }

        .detail-label {
            font-size: 1rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
        }

        .no-activities {
            text-align: center;
            padding: 80px 40px;
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .no-activities i {
            font-size: 6rem;
            color: #d1d5db;
            margin-bottom: 30px;
            display: block;
        }

        .no-activities h3 {
            font-size: 2.5rem;
            color: #6b7280;
            margin-bottom: 15px;
        }

        .no-activities p {
            font-size: 1.3rem;
            color: #9ca3af;
            font-style: italic;
        }

        .filter-section {
            background: white;
            padding: 25px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 12px 25px;
            border: 2px solid #e5e7eb;
            background: white;
            color: #6b7280;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-btn:hover,
        .filter-btn.active {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .filter-btn.all.active {
            background: #4b5563;
            color: white;
            border-color: #4b5563;
        }

        .filter-btn.mental.active {
            background: #8b5cf6;
            color: white;
            border-color: #8b5cf6;
        }

        .filter-btn.physical.active {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }

        .filter-btn.creative.active {
            background: #f59e0b;
            color: white;
            border-color: #f59e0b;
        }

        .filter-btn.social.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        @media (max-width: 768px) {
            body {
                font-size: 16px;
                padding: 15px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 2.5rem;
            }

            .header p {
                font-size: 1.2rem;
            }

            .activities-grid {
                grid-template-columns: 1fr;
                gap: 25px;
                padding: 10px;
            }

            .activity-card {
                margin: 0 10px;
            }

            .card-header {
                padding: 20px;
            }

            .activity-title {
                font-size: 1.8rem;
            }

            .card-body {
                padding: 0 20px 25px;
            }

            .activity-details {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .detail-item.location {
                grid-column: 1;
            }

            .filter-section {
                padding: 20px;
            }

            .filter-btn {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Your existing PHP backend code remains unchanged
        // This will fetch activities from your database
        ?>
        <div class="header fade-in">
            <h1><i class="fas fa-heart"></i> Senior Activity Center</h1>
            <p>Discover wonderful activities designed for your enjoyment and wellness</p>
        </div>

        <div class="filter-section fade-in">
            <button class="filter-btn all active" onclick="filterActivities('all')">
                <i class="fas fa-th"></i> All Activities
            </button>
            <button class="filter-btn mental" onclick="filterActivities('mental')">
                <i class="fas fa-brain"></i> Mental
            </button>
            <button class="filter-btn physical" onclick="filterActivities('physical')">
                <i class="fas fa-running"></i> Physical
            </button>
            <button class="filter-btn creative" onclick="filterActivities('creative')">
                <i class="fas fa-palette"></i> Creative
            </button>
            <button class="filter-btn social" onclick="filterActivities('social')">
                <i class="fas fa-users"></i> Social
            </button>
        </div>

        <div class="activities-grid">
            <?php if (!empty($data['activities']) && is_array($data['activities'])): ?>
                <?php foreach ($data['activities'] as $activity): ?>
                    <div class="activity-card fade-in <?= strtolower($activity['category']) ?>" data-category="<?= strtolower($activity['category']) ?>">
                        <div class="card-header">
                            <div class="category-badge <?= strtolower($activity['category']) ?>">
                                <?php
                                $icons = [
                                    'mental' => 'fas fa-brain',
                                    'physical' => 'fas fa-running',
                                    'creative' => 'fas fa-palette',
                                    'social' => 'fas fa-users'
                                ];
                                $icon = $icons[strtolower($activity['category'])] ?? 'fas fa-star';
                                ?>
                                <i class="<?= $icon ?>"></i>
                                <?= htmlspecialchars($activity['category']) ?>
                            </div>
                            <h2 class="activity-title"><?= htmlspecialchars($activity['activity_name']) ?></h2>
                        </div>

                        <div class="card-body">
                            <?php if (!empty($activity['photo'])): ?>
                                <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($activity['photo']) ?>" alt="<?= htmlspecialchars($activity['activity_name']) ?>" class="activity-photo">
                            <?php else: ?>
                                <div class="no-photo">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>

                            <div class="activity-details">
                                <div class="detail-item time">
                                    <i class="fas fa-clock detail-icon time"></i>
                                    <div class="detail-label">Time</div>
                                    <div class="detail-value"><?= htmlspecialchars(date('g:i A', strtotime($activity['time']))) ?></div>
                                </div>

                                <div class="detail-item participants">
                                    <i class="fas fa-users detail-icon participants"></i>
                                    <div class="detail-label">Participants</div>
                                    <div class="detail-value"><?= htmlspecialchars($activity['participants']) ?> <?= $activity['participants'] == 1 ? 'Person' : 'People' ?></div>
                                </div>

                                <div class="detail-item location">
                                    <i class="fas fa-map-marker-alt detail-icon location"></i>
                                    <div class="detail-label">Location</div>
                                    <div class="detail-value"><?= htmlspecialchars($activity['location']) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-activities fade-in">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Activities Available</h3>
                    <p>Check back soon for exciting new activities!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function filterActivities(category) {
            const cards = document.querySelectorAll('.activity-card');
            const buttons = document.querySelectorAll('.filter-btn');

            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.filter-btn.${category}`).classList.add('active');

            // Filter cards with animation
            cards.forEach((card, index) => {
                const cardCategory = card.dataset.category;

                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'block';
                    card.style.animationDelay = `${index * 0.1}s`;
                    card.classList.remove('fade-in');
                    void card.offsetWidth; // Trigger reflow
                    card.classList.add('fade-in');
                } else {
                    card.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add stagger animation to cards
            const cards = document.querySelectorAll('.activity-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Add smooth scroll behavior
            document.documentElement.style.scrollBehavior = 'smooth';

            // Add entrance animation to filter section
            const filterSection = document.querySelector('.filter-section');
            setTimeout(() => {
                filterSection.style.animationDelay = '0.3s';
                filterSection.classList.add('fade-in');
            }, 300);
        });

        // Optional: Auto-refresh functionality (uncomment if needed)
        // setInterval(() => {
        //     window.location.reload();
        // }, 300000); // Refresh every 5 minutes
    </script>
</body>

</html>