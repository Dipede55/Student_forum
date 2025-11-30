<h2>Login</h2>
<?php if ($error): ?><p style="color:red"><?=htmlspecialchars($error)?></p><?php endif; ?>

<form method="post">
    <label>Username: <input type="text" name="username" required></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <input type="submit" value="Login">
</form>
<p>Don't have an account? <a href="signup.php">Sign Up</a></p>