<?php
require 'includes/session_start.php';
include 'includes/DatabaseConnection.php';

// Must be logged in
if (!$_SESSION['loggedin']) {
    header('Location: admin/login/Validate.php');
    exit;
}

$userId = $_SESSION['user_id'];
$title = 'My Profile';

// =============== HANDLE ACCOUNT DELETION (ONLY NON-ADMINS) ===============
if (isset($_POST['delete_account']) && $_POST['delete_account'] === 'yes') {
     try {
            $pdo->beginTransaction(); // Important: ensure all or nothing

            // 1. Delete all replies by this user
            $pdo->prepare("DELETE FROM replies WHERE user_id = ?")->execute([$userId]);

            // 2. Delete all questions by this user (and their images if you want)
            // First get image names to delete files (optional but clean)
            $images = $pdo->prepare("SELECT img FROM question WHERE user_id = ? AND img IS NOT NULL AND img != ''");
            $images->execute([$userId]);
            $imageList = $images->fetchAll(PDO::FETCH_COLUMN);

            // Delete questions from database
            $pdo->prepare("DELETE FROM question WHERE user_id = ?")->execute([$userId]);

            // Optional: Delete image files from server
            foreach ($imageList as $img) {
                $filePath = __DIR__ . '/COMP1841.studentforum/images/' . $img;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // 3. Finally delete the user account
            $pdo->prepare("DELETE FROM user WHERE id = ?")->execute([$userId]);
            $pdo->commit(); // Commit the transaction
            // Logout and redirect
            session_destroy();
            header('Location: index.php?account_deleted=1');
            exit;

          } catch (Exception $e) {
            $errors[] = "Failed to delete account. Please try again.";
    }
}

// =============== FETCH CURRENT USER DATA ===============
$stmt = $pdo->prepare("SELECT name, email, username FROM user WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// =============== HANDLE PROFILE UPDATE ===============
$errors = [];
$success = '';

if ($_POST && !isset($_POST['delete_account'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($username)) $errors[] = "Username is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";

    // Check duplicate username/email
    $check = $pdo->prepare("SELECT id FROM user WHERE (username = ? OR email = ?) AND id != ?");
    $check->execute([$username, $email, $userId]);
    if ($check->rowCount() > 0) {
        $errors[] = "Username or email already taken by another account";
    }

    // Password change (optional)
    $updateFields = ["name" => $name, "email" => $email, "username" => $username];
    if (!empty($password)) {
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters";
        } else {
            $updateFields['password'] = md5($password);
        }
    }

    // Save changes
    if (empty($errors)) {
        $sql = "UPDATE user SET name = :name, email = :email, username = :username";
        $params = [':name' => $name, ':email' => $email, ':username' => $username, ':id' => $userId];

        if (isset($updateFields['password'])) {
            $sql .= ", password = :password";
            $params[':password'] = $updateFields['password'];
        }

        $sql .= " WHERE id = :id";
        $pdo->prepare($sql)->execute($params);

        $_SESSION['name'] = $name;
        $success = "Profile updated successfully!";
        
        // Refresh displayed data
        $user['name'] = $name;
        $user['email'] = $email;
        $user['username'] = $username;
    }
}

// =============== FETCH MODULES USER POSTED IN ===============
$modulesStmt = $pdo->prepare("
    SELECT DISTINCT m.moduleName 
    FROM question q 
    JOIN module m ON q.module_id = m.id 
    WHERE q.user_id = ?
");
$modulesStmt->execute([$userId]);
$enrolledModules = $modulesStmt->fetchAll(PDO::FETCH_COLUMN);

// =============== RENDER PAGE ===============
ob_start();
include 'templates/profile.html.php';  // This file will use $user, $errors, $success, $enrolledModules, etc.
$output = ob_get_clean();
include 'templates/layout.html.php';
?>

