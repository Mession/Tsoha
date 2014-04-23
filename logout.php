<?php

require_once "libs/common.php";
if (loggedIn()) {
    logout();
    $title = "Home";
    redirect("index.php");
} else {
    show("views/login.php", "Login", array('error' => "You can't log out if you're not logged in"));
}