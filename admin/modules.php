<!-- admin/modules.php -->
<?php
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$title = 'Manage Modules';

$totalModules = totalModules($pdo);

try {
    if (isset($_POST['delete'])) {
        deleteModule($pdo, $_POST['id']);
    }

    if (isset($_POST['add'])) {
        insertModule($pdo, $_POST['moduleName']);
    }

    if (isset($_POST['edit'])) {
        updateModule($pdo, $_POST['id'], $_POST['moduleName']);
    }

    $modules = allModules($pdo);

    ob_start();
    include '../templates/admin_modules.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';
?>