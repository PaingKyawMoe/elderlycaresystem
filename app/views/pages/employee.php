<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Employee</title>
</head>

<body>
    <h1>Add Employee</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="<?= URLROOT ?>/Employee/add" method="POST">
        <label for="role">Role:</label>


        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required /><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required /><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required /><br><br>

        <select name="role" id="role" required>
            <option value="">-- Select Role --</option>
            <option value="doctor">Doctor</option>
            <option value="caregiver">Caregiver</option>
            <option value="driver">Driver</option>
            <option value="staff">Staff</option>
        </select><br><br>

        <label for="address">Address:</label><br>
        <textarea name="address" id="address" rows="3" cols="30" required></textarea><br><br>

        <button type="submit">Add Employee</button>
    </form>
</body>

</html>