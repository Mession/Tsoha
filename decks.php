<?php

require_once "libs/common.php";
require_once "libs/models/deck.php";
require_once "libs/models/user.php";
$decks = Deck::findAllDecks();
$amount = Deck::amount();
show("views/decks.php", "Decks", array('decks' => $decks, 'amount' => $amount));