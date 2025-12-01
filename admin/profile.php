<?php
require '../includes/session_start.php';
include '../includes/DatabaseConnection.php';

if (!$_SESSION['loggedin']) {
    header('Location: admin/login/Validate.php');
    exit;
}

$userId = $_SESSION['user_id'];
$title = 'My Profile';

// Fetch current user data
$stmt = $pdo->prepare("SELECT name, email, username FROM user WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    die('User not found');
}

// Handle form submission
$errors = [];

if ($_POST) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($name)) $errors[] = "Name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($username)) $errors[] = "Username is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";

    // Check if username or email already taken by someone else
    $checkStmt = $pdo->prepare("SELECT id FROM user WHERE (username = ? OR email = ?) AND id != ?");
    $checkStmt->execute([$username, $email, $userId]);
    if ($checkStmt->rowCount() > 0) {
        $errors[] = "Username or email is already taken by another user";
    }

    // Only update password if provided
    $passwordQuery = "";
    $params = [':name' => $name, ':email' => $email, ':username' => $username, ':id' => $userId];

    if (!empty($password)) {
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters";
        } else {
            $passwordQuery = ", password = :password";
            $params[':password'] = md5($password); // Note: md5 is weak – consider upgrading to password_hash() later
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE user SET name = :name, email = :email, username = :username $passwordQuery WHERE id = :id";
        $pdo->prepare($sql)->execute($params);

        // Update session name
        $_SESSION['name'] = $name;

        $success = "Profile updated successfully!";
        // Refresh user data
        $user['name'] = $name;
        $user['email'] = $email;
        $user['username'] = $username;
    }
}

// Fetch modules the user has asked questions in (optional bonus)
$moduleStmt = $pdo->prepare("
    SELECT DISTINCT m.moduleName 
    FROM question q
    JOIN module m ON q.module_id = m.id
    WHERE q.user_id = ?
");
$moduleStmt->execute([$userId]);
$enrolledModules = $moduleStmt->fetchAll(PDO::FETCH_COLUMN);

ob_start();
include '../templates/admin_profile.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
?>