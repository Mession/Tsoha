<?php

require_once "libs/common.php";
require_once "libs/models/user.php";
if (!loggedIn()) {
    show("views/signup.php", "Sign up", array());
} else {
    show("views/index.php", "Hearthstone deck builder", array('error' => "You already have an account"));
}