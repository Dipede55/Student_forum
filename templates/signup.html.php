<h2>Sign Up</h2>
<?php foreach($errors as $e): ?><p style="color:red"><?=htmlspecialchars($e)?></p><?php endforeach; ?>

<form method="post">
    <label>Name: <br> <input type="text" name="name" required></label><br><br>
    <label>Email: <br> <input type="email" name="email" required></label><br><br>
    <label>Username: <br> <input type="text" name="username" required></label><br><br>
    <label>Password: <br> <input type="password" name="password" required></label><br><br>
    <!-- <button type="submit">Create Account</button> -->
    <input type="submit" value="Create Account">
</form>