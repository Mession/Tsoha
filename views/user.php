<?php
echo 'testi - user page';
?>
<div class="container">
    <h1><?php echo $_SESSION["name"] ?></h1>
    <p>Decks made by <?php echo $_SESSION["name"] ?>:</p>
    <ul>
        <li><a href="../decks/id.html">User.decks.first</a></li>
        <li><a href="../decks/id.html">User.decks.second</a></li>
        <li><a href="../decks/id.html">jne.</a></li>
    </ul>
    <a href="id/edit.html">Change password</a>
    <a href="id/destroy.php">Destroy</a>
</div>