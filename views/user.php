<div class="container">
    <h1><?php echo htmlspecialchars($data->user->getName()); ?></h1>
    <p>Decks made by <?php echo htmlspecialchars($data->user->getName()); ?>:</p>
    <ul>
        <li><a href="../decks/id.html">User.decks.first</a></li>
        <li><a href="../decks/id.html">User.decks.second</a></li>
        <li><a href="../decks/id.html">jne.</a></li>
    </ul>
    <?php if ($_SESSION["userid"] == $data->user->getId()): ?>
    <a href="updateuser.php?id=<?php echo $data->user->getId(); ?>">Change password</a>
    <a href="destroyuser.php?id=<?php echo $data->user->getId(); ?>">Destroy</a>
    <?php endif; ?>
</div>