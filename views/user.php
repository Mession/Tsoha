<div class="container">
    <h1><?php echo $data->user->getName(); ?></h1>
    <p>Decks made by <?php echo $data->user->getName(); ?>:</p>
    <ul>
        <li><a href="../decks/id.html">User.decks.first</a></li>
        <li><a href="../decks/id.html">User.decks.second</a></li>
        <li><a href="../decks/id.html">jne.</a></li>
    </ul>
    <?php if ($_SESSION["userid"] == $data->user->getId()): ?>
    <a href="id/edit.html">Change password</a>
    <a href="id/destroy.php">Destroy</a>
    <?php endif; ?>
</div>