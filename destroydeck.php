<?php

require_once "libs/common.php";
require_once "libs/models/deck.php";
$id = (int) $_GET['id'];
$deck = Deck::findDeckById($id);
if ($deck == null) {
    $_SESSION['error'] = "Deck doesn't exist";
    redirect("decks.php");
} elseif ($deck->getOwner() == $_SESSION["userid"]) {
    $deck->destroy();
    $_SESSION['notice'] = "Deck was successfully destroyed";
    redirect("decks.php");
} else {
    $_SESSION['error'] = "You don't have permission to do that";
    redirect("decks.php");
}