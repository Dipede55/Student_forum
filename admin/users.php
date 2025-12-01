<?php
// require '../../includes/session_start.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunctions.php';

$title = 'Manage Users';

if (isset($_POST['delete'])) {
    $userId = $_POST['id'];
    // Don't allow deleting self
    if ($userId == $_SESSION['user_id']) {
        $error = "You cannot delete yourself!";
    } else {
        deleteUser($pdo, $userId);
        $success = "User deleted successfully.";
    }
}

$users = $pdo->query("SELECT id, name, email, username, 
                      (admin_role_id IS NOT NULL) as is_admin 
                      FROM user ORDER BY id")->fetchAll();

ob_start();
include '../templates/admin_users.html.php';
$output = ob_get_clean();
include '../templates/admin_layout.html.php';
?>