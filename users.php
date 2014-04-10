<?php

require_once "libs/common.php";
require_once "libs/models/user.php";
$users = User::findAllUsers();
$amount = User::amount();
show("views/users.php", "Users", array('users' => $users, 'amount' => $amount));