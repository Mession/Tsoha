<?php

require_once "libs/common.php";
require_once "libs/models/user.php";

if (loggedIn()) {
    show("views/index.php", "Hearthstone deck builder", array('error' => "You are logged in already"));
}

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
    $_SESSION["user"] = $dbuser;
    $_SESSION["userid"] = $dbuser->getId(); 
    $_SESSION["name"] = $dbuser->getName();
    $_SESSION["admin"] = $dbuser->getAdmin();
    header('Location: index.php');
} else {
    show("views/login.php", "Login", array('user' => $user, 'error' => "Username and password do not match"));
}