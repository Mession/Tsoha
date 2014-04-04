<?php

require_once "libs/common.php";
require_once "libs/models/user.php";
$users = User::findAllUsers();
show("views/users.php", "Users", array('users' => $users));