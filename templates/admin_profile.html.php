<h2>My Profile</h2>

<?php if (!empty($success)): ?>
    <p style="color:green;font-weight:bold;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div style="color:red;">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <label>Name:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required style="width:300px;">
    </label><br><br>

    <label>Email:<br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required style="width:300px;">
    </label><br><br>

    <label>Username:<br>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required style="width:300px;">
    </label><br><br>

    <label>New Password (leave blank to keep current):<br>
        <input type="password" name="password" placeholder="Enter new password">
    </label><br><br>

    <label>Confirm New Password:<br>
        <input type="password" name="confirm_password" placeholder="Confirm new password">
    </label><br><br>

    <input type="submit" value="Update Profile" style="padding:10px 20px; font-size:16px; margin-left: 4em;">
</form>

<hr>

<h3>Modules You've Posted In:</h3>
<?php if (empty($enrolledModules)): ?>
    <p>You haven't posted any questions yet.</p>
<?php else: ?>
    <ul>
        <?php foreach ($enrolledModules as $module): ?>
            <li><?= htmlspecialchars($module) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<p><a href="../admin/questions.php">← Back to Questions</a></p>
