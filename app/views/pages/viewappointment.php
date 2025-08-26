<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            /* background: linear-gradient(rgb(56, 189, 248), rgb(186, 230, 253)); */
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(rgb(56, 189, 248), rgb(186, 230, 253));
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        h1 {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .table-container {
            padding: 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        th {
            background: linear-gradient(to right, rgb(56, 189, 248), rgb(59, 130, 246));
            color: #fff;
            padding: 20px 15px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        td {
            padding: 18px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.95rem;
            color: #333;
            vertical-align: middle;
        }

        tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        tbody tr:nth-child(even) {
            background: rgba(0, 0, 0, 0.02);
        }

        .photo-cell img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #667eea;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .photo-cell img:hover {
            transform: scale(1.2);
        }

        .no-data {
            text-align: center;
            padding: 60px 30px;
            color: #666;
            font-size: 1.2rem;
            background: #fff;
            border-radius: 15px;
            margin: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .no-data::before {
            content: "📅";
            display: block;
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .appointment-card {
            display: none;
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea;
        }

        .card-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
        }

        .card-number {
            background: #667eea;
            color: #fff;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .card-field {
            padding: 12px;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 8px;
        }

        .card-field label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #667eea;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .card-field-value {
            font-size: 0.95rem;
            color: #333;
        }

        /* Mobile Responsive Design */
        @media (max-width: 1024px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            .table-container {
                padding: 20px;
            }

            table {
                min-width: 1000px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 5px;
            }

            .header {
                padding: 30px 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .subtitle {
                font-size: 1rem;
            }

            table {
                display: none;
            }

            .appointment-card {
                display: block;
            }

            .table-container {
                padding: 15px;
            }

            .card-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                border-radius: 10px;
                margin: 5px;
            }

            .header {
                padding: 20px 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .table-container {
                padding: 10px;
            }
        }

        /* Animations */
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

        .container {
            animation: fadeInUp 0.8s ease;
        }

        .appointment-card {
            animation: fadeInUp 0.6s ease;
        }

        /* Scrollbar Styling */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #667eea;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-user {
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }


        /* Adjust body padding to account for fixed navbar */
        body {

            padding-top: 80px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.8rem 1rem;
                flex-wrap: wrap;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .logo {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .nav-user {
                font-size: 0.8rem;
            }

            .logout-btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            body {
                padding-top: 80px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.6rem;
            }

            .navbar-nav {
                gap: 0.5rem;
            }

            .nav-user {
                display: none;
                /* Hide user info on very small screens */
            }

            .logout-btn {
                padding: 0.4rem 0.6rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="<?= URLROOT ?>/pages/dashboard" class="navbar-brand">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            Elderly Care
        </a>
        <div class="navbar-nav">
            <div class="nav-user">
                <i class="fas fa-user-circle"></i>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></span>
            </div>
            <a href="<?= URLROOT ?>/pages/dashboard" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Back
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="header">
            <h1>My Appointments</h1>
            <p class="subtitle">Manage and view your medical appointments</p>
        </div>

        <?php if (!empty($data['appointmentData'])): ?>
            <div class="table-container">
                <!-- Desktop Table View -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Preferred Date</th>
                            <th>Type</th>
                            <th>Preferred Time</th>
                            <th>Doctor</th>
                            <th>Reason</th>
                            <th>Photo</th>
                            <!-- <th>Created At</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['appointmentData'] as $index => $appointment): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($appointment['name']) ?></td>
                                <td><?= htmlspecialchars($appointment['dob']) ?></td>
                                <td><?= htmlspecialchars($appointment['phone']) ?></td>
                                <td><?= htmlspecialchars($appointment['address']) ?></td>
                                <td><?= htmlspecialchars($appointment['gender']) ?></td>
                                <td><?= htmlspecialchars($appointment['preferred_date']) ?></td>
                                <td><?= htmlspecialchars($appointment['appointment_type']) ?></td>
                                <td><?= htmlspecialchars($appointment['preferred_time']) ?></td>
                                <td><?= htmlspecialchars($appointment['selectDoctor']) ?></td>
                                <td><?= htmlspecialchars($appointment['reasonForAppointment']) ?></td>
                                <td class="photo-cell">
                                    <?php if (!empty($appointment['photo'])): ?>
                                        <img src="/uploads/<?= htmlspecialchars($appointment['photo']) ?>" alt="Photo">
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <!-- <td><?= htmlspecialchars($appointment['created_at']) ?></td>
                            </tr> -->
                            <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Mobile Card View -->
                <?php foreach ($data['appointmentData'] as $index => $appointment): ?>
                    <div class="appointment-card">
                        <div class="card-header">
                            <div class="card-title"><?= htmlspecialchars($appointment['name']) ?></div>
                            <div class="card-number">#<?= $index + 1 ?></div>
                        </div>
                        <div class="card-grid">
                            <div class="card-field">
                                <label>Date of Birth</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['dob']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Phone</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['phone']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Gender</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['gender']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Preferred Date</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['preferred_date']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Appointment Type</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['appointment_type']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Preferred Time</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['preferred_time']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Doctor</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['selectDoctor']) ?></div>
                            </div>
                            <div class="card-field">
                                <label>Created At</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['created_at']) ?></div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;">
                            <div class="card-field">
                                <label>Address</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['address']) ?></div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;">
                            <div class="card-field">
                                <label>Reason for Appointment</label>
                                <div class="card-field-value"><?= htmlspecialchars($appointment['reasonForAppointment']) ?></div>
                            </div>
                        </div>
                        <?php if (!empty($appointment['photo'])): ?>
                            <div style="margin-top: 15px; text-align: center;">
                                <label style="display: block; margin-bottom: 10px; font-size: 0.8rem; font-weight: 600; color: #667eea; text-transform: uppercase;">Photo</label>
                                <img src="/uploads/<?= htmlspecialchars($appointment['photo']) ?>" alt="Photo" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid #667eea;">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-data">
                <p>No appointments found.</p>
                <p style="margin-top: 10px; font-size: 1rem; color: #999;">Schedule your first appointment to get started.</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>