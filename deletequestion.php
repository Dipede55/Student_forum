<?php
// try {
//     include 'includes/DatabaseConnection.php';

//     $sql = 'DELETE FROM question WHERE id = :id';
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':id', $_POST['id']);
//     $stmt->execute();

//     header('location: questions.php');
//     exit; // Always exit after redirect
// } catch (PDOException $e) {
//     $title = 'An error has occurred';
//     $output = 'Unable to delete joke: ' . $e->getMessage();
// }
// include 'templates/layout.html.php';
// ?>

<?php
require 'includes/session_start.php';
include 'includes/DatabaseConnection.php';

if (!$_SESSION['loggedin']) {
    header('Location: admin/login/Validate.php');
    exit;
}

if (!isset($_POST['id'])) {
    header('Location: questions.php');
    exit;
}

$questionId = $_POST['id'];

// Get question owner
$stmt = $pdo->prepare('SELECT user_id FROM question WHERE id = ?');
$stmt->execute([$questionId]);
$question = $stmt->fetch();

if (!$question) {
    die('Question not found');
}

$isOwner = ($_SESSION['user_id'] == $question['user_id']);
$isAdmin = $_SESSION['is_admin'] ?? false;

if (!$isOwner && !$isAdmin) {
    die('Permission denied');
}

// Delete allowed
$pdo->prepare('DELETE FROM question WHERE id = ?')->execute([$questionId]);

header('Location: questions.php');
exit;
?>
