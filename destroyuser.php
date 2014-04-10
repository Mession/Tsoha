<?php

require_once "libs/common.php";
require_once "libs/models/user.php";
$id = (int) $_GET['id'];
$user = User::findUserById($id);
if ($user == null) {
    $_SESSION['error'] = "User doesn't exist";
    redirect("users.php");
} elseif (loggedIn() && $_SESSION["userid"] == $id) {
    $user->destroy();
    unset($_SESSION["user"]);
    unset($_SESSION["userid"]);
    unset($_SESSION["name"]);
    unset($_SESSION["admin"]);
    $_SESSION['notice'] = "User was successfully destroyed";
    redirect("users.php");
} else {
    $_SESSION['error'] = "You don't have permission to do that";
    redirect("users.php");
}