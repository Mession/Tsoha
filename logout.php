<?php

require_once "libs/common.php";
if (loggedIn()) {
    unset($_SESSION["user"]);
    unset($_SESSION["userid"]);
    $title = "Home";
    header('Location: index.php');
} else {
    show("views/login.php", "Login", array('error' => "You can't log out if you're not logged in"));
}