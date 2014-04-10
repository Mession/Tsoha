<?php
$site = explode('/',$_SERVER['REQUEST_URI']);
$sitewithoutextension = explode('.',$site[2]);
$id = (int)$_GET['id'];
$sites = array("index", "cards", "decks", "users", "signup", "login", "user", "logout", "card", "deck");
foreach ($sites as $onesite) {
    $active[$onesite] = ($sitewithoutextension[0] == $onesite)? "active":"noactive";
}
if ($active["card"] == "active") {
    $active["cards"] = "active";
}
if ($active["user"] == "active" && !loggedIn()) {
    $active["users"] = "active";
} else if ($active["user"] == "active" && $id != $_SESSION["userid"]) {
    $active["users"] = "active";
    $active["user"] = "noactive";
}
if ($active["deck"] == "active") {
    $active["decks"] = "active";
}