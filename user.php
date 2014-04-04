<?php

require_once "libs/common.php";
require_once "libs/models/user.php";

$id = (int)$_GET['id'];
$user = User::findUserById($id);
if ($user == null) {
    $_SESSION['error'] = "User doesn't exist";
    redirect("users.php");
} else {
    show("views/user.php", "User page", array('user' => $user));
}