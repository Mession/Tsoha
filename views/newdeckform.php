<div class="container">
    <h1>New deck</h1>
    <form action="newdeck.php" method="post">
        Deck name: <input type="text" name="name" value="<?php echo htmlspecialchars($data->deck->getName()); ?>"><br>
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
        </select><br>
        <input type="hidden" name="sent" value="1">
        <input type="submit" value="Create deck">
    </form>
</div>