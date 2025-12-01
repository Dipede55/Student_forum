<!-- templates/admin_users.html.php -->
<h2>Manage Users (Admin can only delete)</h2>

<?php if (empty($users)): ?>
    <p>No users found.</p>
<?php else: ?>
    <table style="width:100%; border-collapse: collapse;">
        <tr style="background:#333; color:white;">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:8px;"><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="delete" style="padding: 8px 15px; background: #fe6200; color: white; border: none; border-radius: 4px; cursor: pointer;"
                            onclick="return confirm('Delete user <?= htmlspecialchars($user['name']) ?>?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>