<?php

require_once "libs/common.php";
require_once "libs/models/card.php";

$id = (int)$_GET['id'];
$card = Card::findCardById($id);
if ($card == null) {
    $_SESSION['error'] = "Card doesn't exist";
    redirect("cards.php");
} else {
    // tarkistetaan, onko kortti ase, ja jos on, lyhennetään kuvausta (tieto siitä, onko kortti ase, on tallennettuna kuvaukseen)
    $weaponcheck = str_split($card->getDescription(), 6);
    $isweapon = false;
    $description = $card->getDescription();
    if (($weaponcheck[0] == "Weapon")) {
        $isweapon = true;
        $description = substr($card->getDescription(), 8);
    }
    show("views/card.php", "Card", array('card' => $card, 'isweapon' => $isweapon, 'description' => $description));
}