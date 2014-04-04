<div class="container">
    <h1><?php echo $data->card->getName(); ?></h1>
    <p><?php echo $data->card->getClass(); echo ($data->card->getAttack() == 0 && $data->card->getHealth() == 0)? " spell":" minion";; ?></p>
    <p><?php echo $data->card->getDescription(); ?></p>
    <p>Mana cost: <?php echo $data->card->getManacost(); ?></p>
    <?php if ($data->card->getAttack() == 0 && $data->card->getHealth() == 0): ?>
    <?php else: ?>
        <p>Attack: <?php echo $data->card->getAttack(); ?></p>
        <p>Health: <?php echo $data->card->getHealth(); ?></p>
    <?php endif; ?>
    <?php if (admin()): ?>
    <a href="updatecard.php?id=<?php echo $data->card->getId(); ?>">Edit</a>
    <a href="destroycard.php?id=<?php echo $data->card->getId(); ?>">Destroy</a>
    <?php endif; ?>
</div>