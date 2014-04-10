<?php

require_once "libs/common.php";
require_once "libs/models/deck.php";
require_once "libs/models/user.php";
require_once "libs/models/cardsindeck.php";

$id = (int)$_GET['id'];
$deck = Deck::findDeckById($id);
$cards = CardsInDeck::findCardsByDeckId($id);
$amount = CardsInDeck::amountOfCardsInDeckByDeckId($id);
if ($deck == null) {
    $_SESSION['error'] = "Deck doesn't exist";
    redirect("decks.php");
} else {
    show("views/deck.php", "Deck", array('deck' => $deck, 'cards' => $cards, 'amount' => $amount));
}
