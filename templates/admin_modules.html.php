<!-- templates/admin_modules.html.php -->
<h2>Manage Modules</h2>

<!-- Add New Module Form -->
<div style="margin: 20px 0; padding: 15px; background: #f0f0f0; border-radius: 8px;">
    <form method="post" style="display: inline-block;">
        <input type="text" name="moduleName" placeholder="Enter new module name" required 
               style="padding: 8px; width: 300px; font-size: 1em;">
        <button type="submit" name="add" style="padding: 8px 15px; background: #fe6200; color: white; border: none; cursor: pointer;">
            Add Module
        </button>
    </form> 
</div>
    <small>There are <?= $totalModules ?> available modules.</small>
<!-- List of Existing Modules with Inline Edit -->
<?php if (empty($modules)): ?>
    <p>No modules available yet.</p>
<?php else: ?>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #333; color: white; text-align: left;">
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Module Name</th>
                <th style="padding: 12px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $module): ?>
            <tr style="border-bottom: 1px solid #ddd; background: #fafafa;">
                <td style="padding: 12px; font-weight: bold;"><?= $module['id'] ?></td>
                
                <!-- Inline Edit Form -->
                <td style="padding: 12px;">
                    <form method="post" style="display: flex; gap: 10px; align-items: center;">
                        <input type="hidden" name="id" value="<?= $module['id'] ?>">
                        <input type="text" name="moduleName" 
                               value="<?= htmlspecialchars($module['moduleName'], ENT_QUOTES) ?>" 
                               required style="padding: 8px; width: 350px; font-size: 1em; border: 1px solid #ccc; border-radius: 4px;">
                        <button type="submit" name="edit" 
                                style="padding: 8px 15px; background: #fe6200; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            Save
                        </button>
                    </form>
                </td>

                <!-- Delete Button -->
                <td style="padding: 12px;">
                    <form method="post" onsubmit="return confirm('Delete module: <?= htmlspecialchars($module['moduleName']) ?>?');">
                        <input type="hidden" name="id" value="<?= $module['id'] ?>">
                        <button type="submit" name="delete" 
                                style="padding: 6px 12px; background: #d9534f; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>