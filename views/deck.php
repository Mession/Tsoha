<div class="container">
    <h1><?php echo htmlspecialchars($data->deck->getName()); ?></h1>
    <p>This deck was made by <a href="user.php?id=<?php echo $data->deck->getOwner() ?>"><?php echo htmlspecialchars(User::findUserById($data->deck->getId())->getName()); ?></a></p>
    <h2>Cards:</h2>
    <ul>
        <li><a href="../cards/id.html">Deck.cards.first</a></li>
        <li><a href="../cards/id.html">Deck.cards.second</a></li>
        <li><a href="../cards/id.html">jne.</a></li>
    </ul>
    <a href="id/edit.html">Edit</a>
    <a href="id/destroy.php">Destroy</a>
</div>