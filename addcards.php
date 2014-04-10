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
        $_SESSION['error'] = "You can't add cards to someone else's deck";
        redirect("deck.php?id=" . $deck->getId());
    } else {
        $cid = $_GET["cid"];
        $class = $deck->getClass();
        $amount = Card::amountByClassIncludeNeutrals($class);
        $cards = Card::findAllCardsByClassIncludeNeutrals(trim($class));
        if (isset($cid)) {
            // add card to the deck
            $card = Card::findCardById($cid);
            if ($card == null) {
                $_SESSION['error'] = "Card doesn't exist";
                redirect("deck.php?id=" . $deck->getId());
            }
            $cardsindeck = new CardsInDeck();
            $cardsindeck->setCard_id($cid);
            $cardsindeck->setDeck_id($id);
            if (CardsInDeck::howManySpecificCardsInDeck($id, $cid) == 2) {
                $_SESSION['error'] = "You can only have two similar cards in a deck";
                redirect("addcards.php?id=" . $deck->getId());
            } elseif (CardsInDeck::deckIsFull($id)) {
                $_SESSION['error'] = "Your deck is full (there can only be 30 cards in a deck)";
                redirect("deck.php?id=" . $deck->getId());
            } elseif ($cardsindeck->attributesCorrect()) {
                $cardsindeck->insert();
                $_SESSION['notice'] = "Card was successfully added to the deck";
                redirect("addcards.php?id=" . $deck->getId());
            } else {
                $errors = $cardsindeck->getErrors();
                show("views/addcards.php", "Add cards", array('deck' => $deck, 'amount' => $amount, 'cards' => $cards, 'errors' => $errors));
            }
        } else {
            show("views/addcards.php", "Add cards", array('deck' => $deck, 'amount' => $amount, 'cards' => $cards));
        }
    }
} else {
    $_SESSION['error'] = "You should be logged in";
    redirect("login.php");
}
