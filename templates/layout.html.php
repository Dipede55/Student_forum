<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="questionss.css">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <header><h1>Student Forum</h1></header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="questions.php">Questions</a></li>
            
            <?php if ($_SESSION['loggedin']): ?>
                <li><a href="addquestion.php">Add Question</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout (<?=htmlspecialchars($_SESSION['name'])?>)</a></li>
                <?php if ($_SESSION['is_admin']): ?>
                    <li><a href="admin/questions.php">Admin Panel</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="admin/login/Login.html">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <?= $output ?>
    </main>
    <footer>&copy; Student Forum 2025</footer>
</body>
</html>