<?php

require_once "libs/common.php";
require_once "libs/models/user.php";

$id = (int) $_GET['id'];
$user = User::findUserById($id);
if ($user == null) {
    $_SESSION['error'] = "User doesn't exist";
    redirect("users.php");
}

if (loggedIn() && $_SESSION["userid"] == $id) {
    $sent = $_POST["sent"];
    if ($sent) {
        if (empty($_POST["old_password"])) {
            show("views/changepassword.php", "Change password", array('user' => $user, 'errors' => array("You must fill in your old password")));
        }
        elseif ($_POST["old_password"] != $user->getPassword()) {
            show("views/changepassword.php", "Change password", array('user' => $user, 'errors' => array("The old password was incorrect")));
        } else {
            $user->setPassword($_POST["password"]);
            if ($user->attributesCorrect()) {
                $user->update();
                $_SESSION['notice'] = "Your password was successfully changed";
                redirect("users.php");
            } else {
                $errors = $user->getErrors();
                show("views/changepassword.php", "Change password", array('user' => $user, 'errors' => $errors));
            }
        }
    } else {
        show("views/changepassword.php", "Change password", array('user' => $user));
    }
} else {
    $_SESSION['error'] = "You don't have permission to do that";
    redirect("users.php");
}