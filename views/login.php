<div class="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div>
            <?php if (isset($data->user)): ?>
                Username: <input type="text" name="username" value="<?php echo htmlspecialchars($data->user); ?>"><br>
            <?php else: ?>
                Username: <input type="text" name="username"><br>
            <?php endif; ?>
            Password: <input type="password" name="password"><br>
            <input type="hidden" name="sent" value="1">
            <input type="submit" value="Login">
        </div>
    </form>
</div>