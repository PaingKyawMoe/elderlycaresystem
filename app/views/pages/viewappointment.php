<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px auto;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #3498db;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background: #f1f9ff;
        }

        .no-data {
            text-align: center;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <h1>My Appointments</h1>

    <?php if (!empty($data['appointmentData'])): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
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
                    <th>Created At</th>
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
                        <td>
                            <?php if (!empty($appointment['photo'])): ?>
                                <img src="/uploads/<?= htmlspecialchars($appointment['photo']) ?>" alt="Photo" width="50">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($appointment['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No appointments found.</p>
    <?php endif; ?>
</body>

</html>