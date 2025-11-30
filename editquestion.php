<?php
// include 'includes/DatabaseConnection.php';
// try{
//      if(isset($_POST['submit'])) {
//           $sql = 'UPDATE question SET text = :text WHERE id = :id';
//           $stmt = $pdo->prepare($sql);
//           $stmt->bindValue(':text', $_POST['text']);
//           $stmt->bindValue(':id', $_POST['questionid']);
//           $stmt->execute();

//           header('Location: questions.php');
//      } else {
//           $sql = 'SELECT * FROM question WHERE id = :id';
//           $stmt = $pdo->prepare($sql);
//           $stmt->bindValue(':id', $_GET['id']);
//           $stmt->execute();
//           $question = $stmt->fetch();
//           $title = 'Edit Question';
//           ob_start();
//           include 'templates/editquestion.html.php';
//           $output = ob_get_clean();
//      }
// } catch(PDOException $e){
//      $title = 'An error has occurred';
//      $output = 'Database error: ' . $e->getMessage();
// }
// include 'templates/layout.html.php';

require 'includes/session_start.php';
include 'includes/DatabaseConnection.php';

if (!$_SESSION['loggedin']) {
    header('Location: admin/login/Validate.php');
    exit;
}

$id = $_GET['id'] ?? $_POST['questionid'] ?? null;
if (!$id) {
    header('Location: questions.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM question WHERE id = ?');
$stmt->execute([$id]);
$question = $stmt->fetch();

if (!$question) {
    die('Question not found');
}

$isOwner = ($_SESSION['user_id'] == $question['user_id']);
$isAdmin = $_SESSION['is_admin'] ?? false;

if (!$isOwner && !$isAdmin) {
    die('You can only edit your own questions');
}

if (isset($_POST['submit'])) {
    $pdo->prepare('UPDATE question SET text = ? WHERE id = ?')
        ->execute([$_POST['text'], $id]);
    header('Location: questions.php');
    exit;
}

$title = 'Edit Question';
ob_start();
include 'templates/editquestion.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>