<?php

require_once "libs/common.php";
require_once "libs/models/card.php";

$id = explode('=',$_SERVER['REQUEST_URI']);
$id = $id[1];
$card = Card::findCardById($id);
show("views/card.php", "Card", array('card' => $card));