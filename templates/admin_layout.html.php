<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>$title</title>
</head>
<body>
     <header id="admin">
          <h1>Student Forum Admin Area <br/>
               Manage questions, modules and users</h1>
     </header>
     <nav>
          <ul>
               <li><a href="questions.php">Manage Questions</a></li>
               <li><a href="modules.php">Manage Modules</a></li>
               <li><a href="users.php">Manage Users</a></li>
               <li><a href="login/Logout.php">Public Site/Logout</a></li>
          </ul>
     </nav>
     <main>
          <?=$output?>
     </main>
     <footer>&copy; Student Forum 2025</footer>
</body>
</html>