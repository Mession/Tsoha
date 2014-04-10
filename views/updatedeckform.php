<div class="container">
    <h1>Edit deck</h1>
    <form action="updatedeck.php?id=<?php echo $data->deck->getId(); ?>" method="post">
        Deck name: <input type="text" name="name" value="<?php echo htmlspecialchars($data->deck->getName()); ?>"><br>
        <input type="hidden" name="sent" value="1">
        <input type="submit" value="Edit deck">
    </form>
</div>