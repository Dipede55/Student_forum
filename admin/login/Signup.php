<?php
require '../../includes/session_start.php';
include '../../includes/DatabaseConnection.php';

$title = 'Sign Up';
$errors = [];

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id FROM user WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) $errors[] = "Username or email already taken";

    if (empty($errors)) {
        $md5pass = md5($password);  // ← ONLY THIS LINE MATTERS

        $pdo->prepare("INSERT INTO user (name, email, username, password, school_role_id, admin_role_id)
                       VALUES (?, ?, ?, ?, 1, NULL)")
            ->execute([$name, $email, $username, $md5pass]);
        header('Location: Login.php?created=1');
        exit;
    }
}

ob_start();
include '../../templates/signup.html.php';
$output = ob_get_clean();
include '../../templates/layout.html.php';
?>