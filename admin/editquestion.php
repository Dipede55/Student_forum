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
?>

<?php
require '../includes/session_start.php';
include '../includes/DatabaseConnection.php';

if (!$_SESSION['loggedin']) {
    header('Location: login/Validate.php');
    exit;
}

$id = $_GET['id'] ?? $_POST['questionid'] ?? null;
if (!$id) {
    header('Location: questions.php');
    exit;
}

// Get question with owner info
$stmt = $pdo->prepare('SELECT q.*, u.name FROM question q JOIN user u ON q.user_id = u.id WHERE q.id = ?');
$stmt->execute([$id]);
$question = $stmt->fetch();

if (!$question) {
    die('Question not found');
}

// Check: owner OR admin can edit (but admin can only edit their own!)
$isOwner = ($_SESSION['user_id'] == $question['user_id']);
$isAdmin = $_SESSION['is_admin'] ?? false;

if (!$isOwner) {
    die('You can only edit your own questions');
}

if (isset($_POST['submit'])) {
    $pdo->prepare('UPDATE question SET text = ? WHERE id = ?')
        ->execute([$_POST['text'], $id]);
        
    header('Location: questions.php');
    exit;
}

$title = 'Edit Question (Admin)';
ob_start();
include '../templates/admin_editquestion.php';  // your existing template
$output = ob_get_clean();
include '../templates/admin_layout.html.php';
?>