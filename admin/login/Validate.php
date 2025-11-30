<!-- if right username and password, go to the questions page -->
<?php 
     // $ActualPassword = "Secret";
     // if($_POST['password'] === $ActualPassword){
     //      session_start();
     //      $_SESSION['Authorized'] = "Y"; 
     //      header("Location: index.php");
     // } else {
     //      header("Location: Wrongpassword.html");
     // }
require '../../includes/session_start.php';
$title = 'Login';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../includes/DatabaseConnection.php';
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && md5($password) === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $user['name'];
        $_SESSION['is_admin'] = (bool)$user['admin_role_id']; // if not null → admin
        $_SESSION['is_school_role'] = (bool)$user['school_role_id']; // if not null → school role
        if ($_SESSION['is_admin']) {
            header('Location: ../index.php');
        } else {
            header('Location: ../../index.php');
        }
        exit;
    } else {
        header("Location: Wrongpassword.html");
    }
}

ob_start();
include '../../templates/login.html.php';
$output = ob_get_clean();
include '../../templates/layout.html.php';
?>


<?php
// require '../../includes/session_start.php';
// include '../../includes/DatabaseConnection.php';

// $title = 'Login';
// $error = '';

// if ($_POST) {
//     $username = trim($_POST['username']);
//     $password = $_POST['password'];

//     $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
//     $stmt->execute([$username]);
//     $user = $stmt->fetch();

//     if ($user && md5($password) === $user['password']) {
//         $_SESSION['loggedin'] = true;
//         $_SESSION['user_id'] = $user['id'];
//         $_SESSION['name'] = $user['name'];
//         $_SESSION['is_admin'] = (bool)$user['admin_role_id']; // if not null → admin

//         header('Location: index.php');
//         exit;
//     } else {
//         $error = 'Invalid username or password';
//     }
// }

// ob_start();
?>

