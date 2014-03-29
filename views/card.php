<?php
$id = explode('=',$_SERVER['REQUEST_URI']);
$id = $id[1];
$card = Card::findCardById($id);
?>
<div class="container">
    <h1><?php echo $card->getName(); ?></h1>
    <p><?php echo $card->getClass(); echo ($card->getAttack() == 0 && $card->getHealth() == 0)? " spell":" minion";; ?></p>
    <p><?php echo $card->getDescription(); ?></p>
    <p>Mana cost: <?php echo $card->getManacost(); ?></p>
    <?php if ($card->getAttack() == 0 && $card->getHealth() == 0): ?>
    <?php else: ?>
        <p>Attack: <?php echo $card->getAttack(); ?></p>
        <p>Health: <?php echo $card->getHealth(); ?></p>
    <?php endif; ?>
    <a href="id/edit.html">Edit</a>
    <a href="id/destroy.php">Destroy</a>
</div>