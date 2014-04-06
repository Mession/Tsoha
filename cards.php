<?php

require_once "libs/common.php";
require_once "libs/models/card.php";
$cards = Card::findAllCards();
$amount = Card::amount();
show("views/cards.php", "Cards", array('cards' => $cards, 'amount' => $amount));