<?php

require_once "libs/common.php";
require_once "libs/models/user.php";

$user = $_POST["username"];
$password = $_POST["password"];

$sent = $_POST["sent"];

if (!loggedIn()) {
    if ($sent) {
        if (empty($user)) {
            show("views/signup.php", "Sign up", array('user' => $user, 'error' => "You must fill in a username"));
        } elseif (empty($password)) {
            show("views/signup.php", "Sign up", array('user' => $user, 'error' => "You must fill in a password"));
        }
    } else {
        // ensimmäisellä kerralla ei näytetä virheviestejä
        show("views/signup.php", "Sign up", array());
    }
    
    $dbuser = User::findUserByName($user);
    if (isset($dbuser)) {
        // käyttäjänimen pitää olla uniikki
        show("views/signup.php", "Sign up", array('user' => $user, 'error' => "A user with that name already exists"));
    } else {
        $dbuser = new User();
        $dbuser->setAdmin(0);
        $dbuser->setName($user);
        $dbuser->setPassword($password);
        if ($dbuser->attributesCorrect()) {
            $dbuser->insert();
            $_SESSION['notice'] = "Welcome!";
            $_SESSION["user"] = $dbuser;
            $_SESSION["userid"] = $dbuser->getId();
            $_SESSION["name"] = $dbuser->getName();
            $_SESSION["admin"] = $dbuser->getAdmin();
            $title = "Home";
            header('Location: index.php');
        } else {
            $errors = $dbuser->getErrors();
            show("views/signup.php", "Sign up", array('user' => $user, 'errors' => $errors));
        }
    }
} else {
    $_SESSION['error'] = "You already have an account";
    redirect("cards.php");
}