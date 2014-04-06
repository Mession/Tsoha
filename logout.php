<?php

require_once "libs/common.php";
if (loggedIn()) {
    unset($_SESSION["user"]);
    unset($_SESSION["userid"]);
    unset($_SESSION["name"]);
    unset($_SESSION["admin"]);
    $title = "Home";
    header('Location: index.php');
} else {
    show("views/login.php", "Login", array('error' => "You can't log out if you're not logged in"));
}