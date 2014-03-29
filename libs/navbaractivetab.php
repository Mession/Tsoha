<?php
$site = explode('/',$_SERVER['REQUEST_URI']);
$sitewithoutextension = explode('.',$site[2]);
$sites = array("index", "cards", "decks", "users", "signup", "login", "user", "logout", "card");
foreach ($sites as $onesite) {
    $active[$onesite] = ($sitewithoutextension[0] == $onesite)? "active":"noactive";
}
if ($active["card"] == "active") {
    $active["cards"] = "active";
}