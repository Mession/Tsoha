<?php

require_once "libs/common.php";
require_once "libs/models/user.php";
showOnlyIfLoggedIn("views/user.php", "User page", array());