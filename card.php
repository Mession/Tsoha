<?php

require_once "libs/common.php";
require_once "libs/models/card.php";

$id = (int)$_GET['id'];
$card = Card::findCardById($id);
if ($card == null) {
    $_SESSION['error'] = "Card doesn't exist";
    redirect("cards.php");
} else {
    show("views/card.php", "Card", array('card' => $card));
}