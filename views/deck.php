<script type='text/javascript' src="js/confirmdelete.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->deck->getName()); ?></h1>
    <p>This <?php echo htmlspecialchars(strtolower($data->deck->getClass())); ?> deck was made by <a href="user.php?id=<?php echo $data->deck->getOwner() ?>"><?php echo htmlspecialchars(User::findUserById($data->deck->getOwner())->getName()); ?></a></p>
    <h2>Cards:</h2>
    <ul>
        <li><a href="../cards/id.html">Deck.cards.first</a></li>
        <li><a href="../cards/id.html">Deck.cards.second</a></li>
        <li><a href="../cards/id.html">jne.</a></li>
    </ul>
    <?php if ($data->deck->getOwner() == $_SESSION["userid"]): ?>
    <a href="updatedeck.php?id=<?php echo $data->deck->getId(); ?>">Change name</a>
    <a href="destroydeck.php?id=<?php echo $data->deck->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>