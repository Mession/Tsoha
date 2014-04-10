<script type='text/javascript' src="js/confirmdelete.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->user->getName()); ?></h1>
    <p>Decks made by <?php echo htmlspecialchars($data->user->getName()); ?>:</p>
    <ul>
        <?php foreach ($data->decks as $deck): ?>
            <li><a href="deck.php?id=<?php echo $deck->getId(); ?>"><?php echo htmlspecialchars($deck->getName()); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php if ($_SESSION["userid"] == $data->user->getId()): ?>
    <a href="updateuser.php?id=<?php echo $data->user->getId(); ?>">Change password</a>
    <a href="destroyuser.php?id=<?php echo $data->user->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>