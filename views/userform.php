<?php if (isset($data->user)): ?>
    Username: <input type="text" name="username" value="<?php echo htmlspecialchars($data->user); ?>"><br>
<?php else: ?>
    Username: <input type="text" name="username"><br>
<?php endif; ?>
Password: <input type="password" name="password"><br>
<input type="hidden" name="sent" value="1">