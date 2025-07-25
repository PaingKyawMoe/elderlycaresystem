<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elderly Care Activities</title>
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
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .view-toggle {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .toggle-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.9);
            color: #666;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .toggle-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .activity-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .activity-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .activity-icon {
            font-size: 2.5rem;
            margin-right: 15px;
            padding: 15px;
            border-radius: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .activity-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-weight: 600;
        }

        .activity-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .activity-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .participants {
            display: flex;
            align-items: center;
            color: #666;
            font-weight: 600;
        }

        .participants i {
            margin-right: 8px;
            color: #667eea;
        }

        .join-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .join-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4);
        }

        /* Admin Dashboard Styles */
        .admin-panel {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .admin-panel.active {
            display: block;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(102, 126, 234, 0.2);
        }

        .admin-title {
            font-size: 2rem;
            color: #2c3e50;
            font-weight: 700;
        }

        .add-activity-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.3);
        }

        .add-activity-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(39, 174, 96, 0.4);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 12px 16px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .activity-item {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .activity-item:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateX(5px);
        }

        .activity-info h4 {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .activity-info p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .admin-actions {
            display: flex;
            gap: 10px;
        }

        .edit-btn,
        .delete-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            box-shadow: 0 6px 15px rgba(243, 156, 18, 0.3);
        }

        .delete-btn {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.3);
        }

        .edit-btn:hover,
        .delete-btn:hover {
            transform: translateY(-2px);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(102, 126, 234, 0.2);
        }

        .modal-title {
            font-size: 1.5rem;
            color: #2c3e50;
            font-weight: 700;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: #e74c3c;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .save-btn,
        .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .save-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.3);
        }

        .cancel-btn {
            background: #ecf0f1;
            color: #7f8c8d;
        }

        .save-btn:hover,
        .cancel-btn:hover {
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .activities-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .activity-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .admin-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .view-toggle {
                flex-direction: column;
                align-items: center;
            }

            .toggle-btn {
                width: 200px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            .activity-card {
                padding: 20px;
            }

            .activity-icon {
                font-size: 2rem;
                padding: 12px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-heart"></i> Senior Care Activities</h1>
            <p>Engaging activities designed for our wonderful residents</p>
        </div>

        <div class="view-toggle">
            <button class="toggle-btn active" onclick="showActivities()">
                <i class="fas fa-calendar-alt"></i> View Activities
            </button>
            <button class="toggle-btn" onclick="showAdmin()">
                <i class="fas fa-cog"></i> Admin Dashboard
            </button>
        </div>

        <!-- Activities View -->
        <div id="activities-view" class="activities-view">
            <div class="activities-grid" id="activitiesGrid">
                <!-- Activities will be populated by JavaScript -->
            </div>
        </div>

        <!-- Admin Panel -->
        <div id="admin-panel" class="admin-panel">
            <div class="admin-header">
                <h2 class="admin-title">Activity Management</h2>
                <button class="add-activity-btn" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Add New Activity
                </button>
            </div>

            <div id="admin-activities-list">
                <!-- Admin activities list will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Add/Edit Activity Modal -->
    <div id="activity-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title">Add New Activity</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>

            <form id="activity-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="activity-name">Activity Name</label>
                        <input type="text" id="activity-name" required>
                    </div>

                    <div class="form-group">
                        <label for="activity-time">Time</label>
                        <input type="time" id="activity-time" required>
                    </div>

                    <div class="form-group">
                        <label for="activity-icon">Icon Class</label>
                        <select id="activity-icon" required>
                            <option value="fas fa-music">Music</option>
                            <option value="fas fa-paint-brush">Art</option>
                            <option value="fas fa-walking">Exercise</option>
                            <option value="fas fa-book">Reading</option>
                            <option value="fas fa-gamepad">Games</option>
                            <option value="fas fa-utensils">Cooking</option>
                            <option value="fas fa-seedling">Gardening</option>
                            <option value="fas fa-camera">Photography</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="activity-participants">Max Participants</label>
                        <input type="number" id="activity-participants" min="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="activity-description">Description</label>
                    <textarea id="activity-description" required></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save Activity</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sample activities data stored in memory
        let activities = [{
                id: 1,
                name: "Morning Music Therapy",
                time: "09:00",
                icon: "fas fa-music",
                description: "Start your day with soothing melodies and sing-along sessions. Our music therapist will guide you through relaxing tunes and familiar classics.",
                participants: 12,
                maxParticipants: 15
            },
            {
                id: 2,
                name: "Art & Crafts Workshop",
                time: "14:00",
                icon: "fas fa-paint-brush",
                description: "Express your creativity through painting, drawing, and various craft projects. All skill levels welcome with personalized assistance.",
                participants: 8,
                maxParticipants: 10
            },
            {
                id: 3,
                name: "Gentle Exercise Class",
                time: "10:30",
                icon: "fas fa-walking",
                description: "Low-impact exercises designed for seniors. Improve flexibility, balance, and strength in a fun, supportive environment.",
                participants: 15,
                maxParticipants: 20
            },
            {
                id: 4,
                name: "Story Time & Discussion",
                time: "15:30",
                icon: "fas fa-book",
                description: "Share stories, read together, and engage in meaningful discussions about books, memories, and experiences.",
                participants: 6,
                maxParticipants: 12
            },
            {
                id: 5,
                name: "Board Game Tournament",
                time: "19:00",
                icon: "fas fa-gamepad",
                description: "Challenge your mind with classic board games, puzzles, and strategic thinking games. Great for social interaction!",
                participants: 10,
                maxParticipants: 16
            },
            {
                id: 6,
                name: "Cooking Together",
                time: "11:00",
                icon: "fas fa-utensils",
                description: "Prepare simple, delicious meals and snacks together. Share recipes and cooking tips while enjoying the process.",
                participants: 4,
                maxParticipants: 8
            }
        ];

        let editingId = null;

        function renderActivities() {
            const grid = document.getElementById('activitiesGrid');
            grid.innerHTML = '';

            activities.forEach(activity => {
                const card = document.createElement('div');
                card.className = 'activity-card';
                card.innerHTML = `
                    <div class="activity-header">
                        <div class="activity-icon">
                            <i class="${activity.icon}"></i>
                        </div>
                        <div>
                            <div class="activity-title">${activity.name}</div>
                            <div class="activity-time">${formatTime(activity.time)}</div>
                        </div>
                    </div>
                    <div class="activity-description">${activity.description}</div>
                    <div class="activity-details">
                        <div class="participants">
                            <i class="fas fa-users"></i>
                            ${activity.participants}/${activity.maxParticipants} joined
                        </div>
                        <button class="join-btn" onclick="joinActivity(${activity.id})">
                            <i class="fas fa-plus"></i> Join
                        </button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        function renderAdminActivities() {
            const list = document.getElementById('admin-activities-list');
            list.innerHTML = '';

            activities.forEach(activity => {
                const item = document.createElement('div');
                item.className = 'activity-item';
                item.innerHTML = `
                    <div class="activity-info">
                        <h4><i class="${activity.icon}"></i> ${activity.name}</h4>
                        <p>${formatTime(activity.time)} • ${activity.participants}/${activity.maxParticipants} participants</p>
                    </div>
                    <div class="admin-actions">
                        <button class="edit-btn" onclick="editActivity(${activity.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="delete-btn" onclick="deleteActivity(${activity.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                `;
                list.appendChild(item);
            });
        }

        function showActivities() {
            document.getElementById('activities-view').style.display = 'block';
            document.getElementById('admin-panel').classList.remove('active');
            document.querySelectorAll('.toggle-btn')[0].classList.add('active');
            document.querySelectorAll('.toggle-btn')[1].classList.remove('active');
        }

        function showAdmin() {
            document.getElementById('activities-view').style.display = 'none';
            document.getElementById('admin-panel').classList.add('active');
            document.querySelectorAll('.toggle-btn')[0].classList.remove('active');
            document.querySelectorAll('.toggle-btn')[1].classList.add('active');
            renderAdminActivities();
        }

        function openAddModal() {
            editingId = null;
            document.getElementById('modal-title').textContent = 'Add New Activity';
            document.getElementById('activity-form').reset();
            document.getElementById('activity-modal').classList.add('active');
        }

        function editActivity(id) {
            editingId = id;
            const activity = activities.find(a => a.id === id);

            document.getElementById('modal-title').textContent = 'Edit Activity';
            document.getElementById('activity-name').value = activity.name;
            document.getElementById('activity-time').value = activity.time;
            document.getElementById('activity-icon').value = activity.icon;
            document.getElementById('activity-participants').value = activity.maxParticipants;
            document.getElementById('activity-description').value = activity.description;

            document.getElementById('activity-modal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('activity-modal').classList.remove('active');
            editingId = null;
        }

        function deleteActivity(id) {
            if (confirm('Are you sure you want to delete this activity?')) {
                activities = activities.filter(a => a.id !== id);
                renderAdminActivities();
                renderActivities();
            }
        }

        function joinActivity(id) {
            const activity = activities.find(a => a.id === id);
            if (activity && activity.participants < activity.maxParticipants) {
                activity.participants++;
                renderActivities();
                renderAdminActivities();

                // Show success message
                const btn = event.target;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Joined!';
                btn.style.background = 'linear-gradient(135deg, #27ae60 0%, #2ecc71 100%)';

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                }, 2000);
            } else {
                alert('Sorry, this activity is full!');
            }
        }

        function formatTime(time) {
            const [hours, minutes] = time.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const hour12 = hour % 12 || 12;
            return `${hour12}:${minutes} ${ampm}`;
        }

        // Form submission handler
        document.getElementById('activity-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('activity-name').value,
                time: document.getElementById('activity-time').value,
                icon: document.getElementById('activity-icon').value,
                maxParticipants: parseInt(document.getElementById('activity-participants').value),
                description: document.getElementById('activity-description').value
            };

            if (editingId) {
                // Edit existing activity
                const activity = activities.find(a => a.id === editingId);
                Object.assign(activity, formData);
            } else {
                // Add new activity
                const newActivity = {
                    id: Math.max(...activities.map(a => a.id)) + 1,
                    participants: 0,
                    ...formData
                };
                activities.push(newActivity);
            }

            closeModal();
            renderActivities();
            renderAdminActivities();
        });

        // Close modal when clicking outside
        document.getElementById('activity-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize the page
        renderActivities();
    </script>
</body>

</html>