<?php

require_once "libs/common.php";
require_once "libs/models/card.php";

if (admin()) {

    $newcard = new Card();
    $newcard->setName($_POST["name"]);
    $newcard->setClass($_POST["class"]);
    $newcard->setDescription($_POST["description"]);
    $newcard->setManacost($_POST["manacost"]);
    $newcard->setHealth($_POST["health"]);
    $newcard->setAttack($_POST["attack"]);
    $sent = $_POST["sent"];

    if ($sent) {
        if ($newcard->attributesCorrect()) {
            $newcard->insert();
            $_SESSION['notice'] = "Card was successfully added";
            redirect("cards.php");
        } else {
            $errors = $newcard->getErrors();
            show("views/newcardform.php", "New card", array('card' => $newcard, 'errors' => $errors));
        }
    } else {
        show("views/newcardform.php", "New card", array());
    }
    
} else {
    $_SESSION['error'] = "You don't have permission to do that";
    redirect("cards.php");
}