<div class="container">
    <h1>Edit card</h1>
    <form action="updatecard.php?id=<?php echo $data->card->getId(); ?>" method="post">
        <?php require 'cardform.php'; ?>
        <input type="hidden" name="id" value="<?php echo $data->card->getId(); ?>">
        <input type="submit" value="Edit card">
    </form>
</div>