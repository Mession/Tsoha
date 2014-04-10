<div class="container">
    <h1>Change password</h1>
    <form action="updateuser.php?id=<?php echo $data->user->getId(); ?>" method="post">
        Old password: <input type="password" name="old_password"><br>
        New password: <input type="password" name="password"><br>
        <input type="hidden" name="sent" value="1">
        <input type="hidden" name="id" value="<?php echo $data->user->getId(); ?>">
        <input type="submit" value="Change password">
    </form>
</div>