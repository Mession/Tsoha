<?php

require_once "libs/common.php";
require_once "libs/models/user.php";

if (loggedIn()) {
    $_SESSION['error'] = "You are logged in already";
    redirect("cards.php");
} else {

    $user = $_POST["username"];
    $password = $_POST["password"];
    $sent = $_POST["sent"];
    if ($sent) {
        if (empty($user)) {
            show("views/login.php", "Login", array('user' => $user, 'error' => "You must fill in a username"));
        } elseif (empty($password)) {
            show("views/login.php", "Login", array('user' => $user, 'error' => "You must fill in a password"));
        }
    } else {
        show("views/login.php", "Login", array());
    }

    $dbuser = User::findUserByNameAndPassword($user, $password);

    if (isset($dbuser)) {
        $_SESSION['notice'] = "Welcome back!";
        login($dbuser);
        $title = "Home";
        redirect("index.php");
    } else {
        show("views/login.php", "Login", array('user' => $user, 'error' => "Wrong username or password"));
    }
}