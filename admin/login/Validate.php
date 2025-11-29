<?php 
     $ActualPassword = "Secret";
     if($_POST['password'] === $ActualPassword){
          session_start();
          $_SESSION['Authorized'] = "Y";
          header("Location: ../questions.php");
     } else {
          header("Location: Wrongpassword.html");
     }

// session_start();
// require_once '../../includes/DatabaseConnection.php'; // your DB connection (mysqli or PDO)

// // get form values
// $username = $_POST['username'];
// $password = md5($_POST['password']); // convert to MD5

// $sql = "SELECT id, username, password, admin_role_id FROM user 
//         WHERE username = ? LIMIT 1";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("s", $username);
// $stmt->execute();
// $result = $stmt->get_result();

// $user = $result->fetch_assoc();

// // compare MD5 hash
// if ($user && $user['password'] === $password) {

//     // set session values
//     $_SESSION['Authorized'] = "Y";
//     $_SESSION['user_id'] = $user['id'];
//     $_SESSION['username'] = $user['username'];
//     $_SESSION['role'] = $user['admin_role_id'];

//     // redirect
//     if ($user['admin_role_id'] != 0) {
//         header("Location: ../admin/login/index.php");
//     } else {
//         header("Location: ../../index.php");
//     }
//     exit;
// }

// // login failed
// header("Location: Wrongpassword.html");
// exit;
?>