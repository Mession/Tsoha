<script type='text/javascript' src="js/confirmdelete.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->card->getName()); ?></h1>
    <!-- Kerrotaan käyttäjälle kortin luokka ja tyyppi -->
    <?php if ($data->isweapon): ?>
    <p><?php echo htmlspecialchars($data->card->getClass()); echo " weapon"; ?></p>
    <?php else: ?>
    <p><?php echo htmlspecialchars($data->card->getClass()); echo ($data->card->getAttack() == 0 && $data->card->getHealth() == 0)? " spell":" minion"; ?></p>
    <?php endif; ?>
    <!-- Kortin muut tiedot -->
    <p><?php echo htmlspecialchars($data->description); ?></p>
    <p>Mana cost: <?php echo htmlspecialchars($data->card->getManacost()); ?></p>
    <!-- Sellaiset kortin tiedot, jotka ovat vain minioneilla tai aseilla -->
    <?php if ($data->card->getAttack() == 0 && $data->card->getHealth() == 0): ?>
    <?php elseif ($data->isweapon): ?>
        <p>Attack: <?php echo htmlspecialchars($data->card->getAttack()); ?></p>
        <p>Durability: <?php echo htmlspecialchars($data->card->getHealth()); ?></p>
    <?php else: ?>
        <p>Attack: <?php echo htmlspecialchars($data->card->getAttack()); ?></p>
        <p>Health: <?php echo htmlspecialchars($data->card->getHealth()); ?></p>
    <?php endif; ?>
    <!-- Adminille näytetään linkit kortin editoimiseen ja poistamiseen -->
    <?php if (admin()): ?>
    <a href="updatecard.php?id=<?php echo $data->card->getId(); ?>">Edit</a>
    <a href="destroycard.php?id=<?php echo $data->card->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>