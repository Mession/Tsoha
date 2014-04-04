<?php

require_once "libs/common.php";
require_once "libs/models/card.php";
$id = (int) $_GET['id'];
$card = Card::findCardById($id);
if ($card == null) {
    $_SESSION['error'] = "Card doesn't exist";
    redirect("cards.php");
} elseif (admin()) {
    $card->destroy();
    $_SESSION['notice'] = "Card was successfully destroyed";
    redirect("cards.php");
} else {
    $_SESSION['error'] = "You don't have permission to do that";
    redirect("cards.php");
}