<?php 
     $ActualPassword = "Secret";
     if($_POST['password'] === $ActualPassword){
          session_start();
          $_SESSION['Authorized'] = "Y";
          header("Location: index.php");
     } else {
          header("Location: Wrongpassword.html");
     }
?>