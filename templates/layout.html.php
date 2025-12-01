<?php
if (!isset($basePath)) {
    $basePath = '/COMP1841/studentforum';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $basePath ?>/css/style.css">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <header><h1>Student Forum</h1></header>

    <nav>
        <ul>
          <li><a href="<?= $basePath ?>/index.php">Home</a></li>
          <li><a href="<?= $basePath ?>/questions.php">Questions</a></li>
          <li><a href="<?= $basePath ?>/addquestion.php">Add Question</a></li>
          <li><a href="<?= $basePath ?>/profile.php">Profile</a></li>
          <?php if ($_SESSION['loggedin']): ?>
          <li><a href="<?= $basePath ?>/admin/login/Logout.php">Logout</a></li>

          <?php else: ?>
          <li><a href="<?= $basePath ?>/admin/login/Validate.php">Login</a></li>
          <li><a href="<?= $basePath ?>/admin/login/Signup.php">Signup</a></li>
          <?php endif; ?>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>&copy; Student Forum 2025</footer>
</body>
</html>
