<?php if (!empty($data->errors)) : ?>
<div class="alert alert-danger">
    <?php foreach ($data->errors as $error): ?>
    <?php echo $error; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="container">
    <h1>New card</h1>
    <?php if (isset($data->card)) : ?>
    <form action="newcard.php" method="post">
        Card name: <input type="text" name="name" value="<?php echo $data->card->getName(); ?>"><br>
        Class: <select name="class" value="<?php echo $data->card->getClass(); ?>">
                        <option value="warrior">Warrior</option>
                        <option value="paladin">Paladin</option>
                        <option value="hunter">Hunter</option>
                        <option value="shaman">Shaman</option>
                        <option value="rogue">Rogue</option>
                        <option value="druid">Druid</option>
                        <option value="priest">Priest</option>
                        <option value="warlock">Warlock</option>
                        <option value="mage">Mage</option>
                        <option value="neutral">Neutral</option>
                </select><br>
        Description: <input type="text" class="form-control" name="description" value="<?php echo $data->card->getDescription(); ?>"><br>
        Mana cost: <input type="text" name="manacost" value="<?php echo $data->card->getManacost(); ?>"><br>
        Attack (input 0 for spell): <input type="text" name="attack" value="<?php echo $data->card->getAttack(); ?>"><br>
        Health (input 0 for spell): <input type="text" name="health" value="<?php echo $data->card->getHealth(); ?>"><br>
        <input type="hidden" name="sent" value="1">
        <input type="submit" value="Create card">
    </form>
    <?php else : ?>
    <form action="newcard.php" method="post">
        Card name: <input type="text" name="name"><br>
        Class: <select name="class">
                        <option value="Warrior">Warrior</option>
                        <option value="Paladin">Paladin</option>
                        <option value="Hunter">Hunter</option>
                        <option value="Shaman">Shaman</option>
                        <option value="Rogue">Rogue</option>
                        <option value="Druid">Druid</option>
                        <option value="Priest">Priest</option>
                        <option value="Warlock">Warlock</option>
                        <option value="Mage">Mage</option>
                        <option value="Neutral">Neutral</option>
                </select><br>
        Description: <input type="text" class="form-control" name="description"><br>
        Mana cost: <input type="text" name="manacost"><br>
        Attack (input 0 for spell): <input type="text" name="attack"><br>
        Health (input 0 for spell): <input type="text" name="health"><br>
        <input type="hidden" name="sent" value="1">
        <input type="submit" value="Create card">
    </form>
    <?php endif; ?>
</div>