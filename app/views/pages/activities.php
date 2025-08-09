<?php
// If editing, $data['editActivity'] will be set, otherwise not
$editActivity = $data['editActivity'] ?? null;
?>

<h2><?= $editActivity ? 'Edit Activity' : 'Add Activity' ?></h2>

<form action="<?= URLROOT ?>/activities/<?= $editActivity ? 'update/' . $editActivity['id'] : 'store' ?>" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
    <div>
        <label>Activity Name:</label><br>
        <input type="text" name="activity_name" required value="<?= $editActivity ? htmlspecialchars($editActivity['activity_name']) : '' ?>">
    </div>

    <div>
        <label>Category:</label><br>
        <select name="category" required>
            <?php
            $categories = ['Mental', 'Physical', 'Creative', 'Social'];
            foreach ($categories as $cat):
            ?>
                <option value="<?= $cat ?>" <?= ($editActivity && $editActivity['category'] === $cat) ? 'selected' : '' ?>><?= $cat ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Photo:</label><br>
        <?php if ($editActivity && !empty($editActivity['photo'])): ?>
            <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($editActivity['photo']) ?>" alt="Existing Photo" style="max-width: 100px;"><br>
            <input type="hidden" name="existing_photo" value="<?= htmlspecialchars($editActivity['photo']) ?>">
            <small>Upload new photo to replace</small><br>
        <?php endif; ?>
        <input type="file" name="photo" <?= $editActivity ? '' : '' ?>>
    </div>

    <div>
        <label>Time:</label><br>
        <!-- Using time input -->
        <input type="time" name="time" required value="<?= $editActivity ? date('H:i', strtotime($editActivity['time'])) : '' ?>">
    </div>

    <div>
        <label>Participants:</label><br>
        <input type="number" name="participants" min="1" required value="<?= $editActivity ? htmlspecialchars($editActivity['participants']) : '' ?>" placeholder="Number of participants">
    </div>

    <div>
        <label>Location:</label><br>
        <input type="text" name="location" required value="<?= $editActivity ? htmlspecialchars($editActivity['location']) : '' ?>">
    </div>

    <div style="margin-top: 10px;">
        <button type="submit"><?= $editActivity ? 'Update Activity' : 'Add Activity' ?></button>
        <?php if ($editActivity): ?>
            <a href="<?= URLROOT ?>/activities" style="margin-left: 10px;">Cancel</a>
        <?php endif; ?>
    </div>
</form>

<hr>

<h3>Activities List</h3>
<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #eee;">
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
                    <td><?= htmlspecialchars($activity['category']) ?></td>
                    <td>
                        <?php if (!empty($activity['photo'])): ?>
                            <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($activity['photo']) ?>" alt="Photo" style="max-width: 50px;">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars(date('H:i', strtotime($activity['time']))) ?></td>
                    <td><?= htmlspecialchars($activity['participants']) ?></td>
                    <td><?= htmlspecialchars($activity['location']) ?></td>
                    <td>
                        <a href="<?= URLROOT ?>/activities/index/<?= $activity['id'] ?>">Edit</a> |
                        <a href="<?= URLROOT ?>/activities/delete/<?= $activity['id'] ?>" onclick="return confirm('Delete this activity?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align: center;">No activities found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>