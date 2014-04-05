<?php

require_once "libs/common.php";
require_once "libs/models/card.php";
if (admin()) {
    $id = (int) $_GET['id'];
    $card = Card::findCardById($id);
    if ($card == null) {
        $_SESSION['error'] = "Card doesn't exist";
        redirect("cards.php");
    } else {
        $sent = $_POST["sent"];
        $classes = array("Warrior", "Paladin", "Hunter", "Shaman", "Rogue", "Druid", "Priest", "Warlock", "Mage", "Neutral");
        $selected = array();
        if ($card->getClass() != null) {
            foreach ($classes as $class) {
                $currentclass = trim($card->getClass());
                $selected[$class] = ($currentclass == $class)? "selected=\"selected\"" : "";
            }
        } else {
            $selected["Neutral"] = "selected";
        }

        if ($sent) {
            $card->setName($_POST["name"]);
            $card->setClass($_POST["class"]);
            $card->setDescription($_POST["description"]);
            $card->setManacost($_POST["manacost"]);
            $card->setHealth($_POST["health"]);
            $card->setAttack($_POST["attack"]);
            if ($card->attributesCorrect()) {
                $card->update();
                $_SESSION['notice'] = "Card was successfully updated";
                redirect("cards.php");
            } else {
                $errors = $card->getErrors();
                show("views/updatecardform.php", "Edit card", array('card' => $card, 'errors' => $errors, 'selected' => $selected));
            }
        } else {
            show("views/updatecardform.php", "Edit card", array('card' => $card, 'selected' => $selected));
        }
    }
    
} else {
    $_SESSION['error'] = "You don't have permission to do that";
    redirect("cards.php");
}