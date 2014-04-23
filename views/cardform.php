<!-- Kortin lisäys- ja muokkauspohja -->
Card name: <input type="text" name="name" value="<?php echo htmlspecialchars($data->card->getName()); ?>"><br>
Class: <select name="class">
    <option value="Warrior" <?php echo $data->selected["Warrior"] ?>>Warrior</option>
    <option value="Paladin" <?php echo $data->selected["Paladin"] ?>>Paladin</option>
    <option value="Hunter" <?php echo $data->selected["Hunter"] ?>>Hunter</option>
    <option value="Shaman" <?php echo $data->selected["Shaman"] ?>>Shaman</option>
    <option value="Rogue" <?php echo $data->selected["Rogue"] ?>>Rogue</option>
    <option value="Druid" <?php echo $data->selected["Druid"] ?>>Druid</option>
    <option value="Priest" <?php echo $data->selected["Priest"] ?>>Priest</option>
    <option value="Warlock" <?php echo $data->selected["Warlock"] ?>>Warlock</option>
    <option value="Mage" <?php echo $data->selected["Mage"] ?>>Mage</option>
    <option value="Neutral" <?php echo $data->selected["Neutral"] ?>>Neutral</option>
</select><br>
Description (write "Weapon. " as the first word of the description for a weapon, ignore the quotation marks): <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($data->card->getDescription()); ?>"><br>
Mana cost: <input type="text" name="manacost" value="<?php echo htmlspecialchars($data->card->getManacost()); ?>"><br>
Attack (input 0 for spell): <input type="text" name="attack" value="<?php echo htmlspecialchars($data->card->getAttack()); ?>"><br>
Health (input 0 for spell and durability for weapon): <input type="text" name="health" value="<?php echo htmlspecialchars($data->card->getHealth()); ?>"><br>
<input type="hidden" name="sent" value="1">