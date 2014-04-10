<?php

require_once "libs/common.php";
require_once "libs/models/deck.php";

if (loggedIn()) {

    $deck = new Deck();
    $deck->setName($_POST["name"]);
    $deck->setClass($_POST["class"]);
    $deck->setOwner($_SESSION["userid"]);
    $sent = $_POST["sent"];
    $classes = array("Warrior", "Paladin", "Hunter", "Shaman", "Rogue", "Druid", "Priest", "Warlock", "Mage");
    $selected = array();
    if ($deck->getClass() != null) {
            foreach ($classes as $class) {
                $currentclass = trim($deck->getClass());
                $selected[$class] = ($currentclass == $class)? "selected=\"selected\"" : "";
            }
        } else {
            $selected["Warrior"] = "selected";
        }

    if ($sent) {
        if ($deck->attributesCorrect()) {
            $deck->insert();
            $_SESSION['notice'] = "Deck was successfully created, now go add some cards to it";
            redirect("decks.php");
        } else {
            $errors = $deck->getErrors();
            show("views/newdeckform.php", "New deck", array('deck' => $deck, 'errors' => $errors, 'selected' => $selected));
        }
    } else {
        show("views/newdeckform.php", "New deck", array('deck' => $deck, 'selected' => $selected));
    }
    
} else {
    $_SESSION['error'] = "You should be logged in";
    redirect("login.php");
}