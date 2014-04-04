<?php

require_once "libs/common.php";
require_once "libs/models/card.php";
$cards = Card::findAllCards();
show("views/cards.php", "Cards", array('cards' => $cards));