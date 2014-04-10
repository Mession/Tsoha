<?php

require_once "libs/common.php";
require_once "libs/models/deck.php";
$id = (int) $_GET['id'];
$deck = Deck::findDeckById($id);
if ($deck == null) {
    $_SESSION['error'] = "Deck doesn't exist";
    redirect("decks.php");
} elseif (loggedIn() && $_SESSION["userid"] == $deck->getOwner()) {
    $sent = $_POST["sent"];

    if ($sent) {
        $deck->setName($_POST["name"]);
        $deck->setOwner($_SESSION["userid"]);
        if ($deck->attributesCorrect()) {
            $deck->update();
            $_SESSION['notice'] = "Deck was successfully updated";
            redirect("decks.php");
        } else {
            $errors = $deck->getErrors();
            show("views/updatedeckform.php", "New deck", array('deck' => $deck, 'errors' => $errors, 'selected' => $selected));
        }
    } else {
        show("views/updatedeckform.php", "New deck", array('deck' => $deck, 'selected' => $selected));
    }
} elseif(loggedIn()) {
    $_SESSION['error'] = "You can't edit someone else's decks";
    redirect("decks.php");
} else {
    $_SESSION['error'] = "You should be logged in";
    redirect("login.php");
}