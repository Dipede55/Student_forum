<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../admin_questionss.css">
     <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
     <header id="admin">
          <h1>Student Forum Admin Area <br/>
               Manage questions, modules and users</h1>
     </header>
     <nav>
          <ul>
               <li><a href="../admin/index.php">Home</a></li>
               <li><a href="../admin/questions.php">Manage Questions</a></li>
               <li><a href="../admin/modules.php">Manage Modules</a></li> <!-- not coded yet -->
               <li><a href="../admin/users.php">Manage Users</a></li> <!-- not coded yet -->
               <li><a href="../admin/login/Logout.php">Public Site/Logout</a></li>
          </ul>
     </nav>
     <main>
          <?= $output?>
     </main>
     <footer>&copy; Student Forum 2025</footer>
</body>
</html>