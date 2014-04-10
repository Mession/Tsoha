<?php

require_once "libs/common.php";
require_once "libs/models/card.php";
require_once "libs/models/cardsindeck.php";
require_once "libs/models/deck.php";
if (loggedIn()) {
    $id = $_GET["id"];
    $deck = Deck::findDeckById($id);
    if ($deck == null) {
        $_SESSION['error'] = "Deck doesn't exist";
        redirect("decks.php");
    } elseif ($deck->getOwner() != $_SESSION["userid"]) {
        $_SESSION['error'] = "You can't remove cards from someone else's deck";
        redirect("deck.php?id=" . $deck->getId());
    } else {
        $cid = $_GET["cid"];
        if (isset($cid)) {
            // add card to the deck
            $card = Card::findCardById($cid);
            if ($card == null) {
                $_SESSION['error'] = "Card doesn't exist";
                redirect("deck.php?id=" . $deck->getId());
            }
            $cardsindeck = CardsInDeck::findEntryByDeckAndCardId($id, $cid);
            if (CardsInDeck::howManySpecificCardsInDeck($id, $cid) == 0) {
                $_SESSION['error'] = "That card wasn't in the deck";
                redirect("deck.php?id=" . $deck->getId());
            } else {
                $cardsindeck->destroy();
                $_SESSION['notice'] = "Card was successfully removed from the deck";
                redirect("deck.php?id=" . $deck->getId());
            }
        } else {
            $_SESSION['error'] = "Card doesn't exist";
            redirect("deck.php?id=" . $deck->getId());
        }
    }
} else {
    $_SESSION['error'] = "You should be logged in";
    redirect("login.php");
}