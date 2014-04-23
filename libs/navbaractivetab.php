<?php
// Etsitään urlin perusteella, minkä navigointipalkin linkin tulisi näkyä aktiivisena
$site = explode('/',$_SERVER['REQUEST_URI']);
$sitewithoutextension = explode('.',$site[2]);
$id = (int)$_GET['id'];
$sites = array("index", "cards", "decks", "users", "signup", "login", "user", "logout", "card", "deck", "newcard", "updatecard", "destroycard", "newdeck", "updatedeck", "destroydeck", "updateuser", "destroyuser", "addcards", "removecard");
foreach ($sites as $onesite) {
    $active[$onesite] = ($sitewithoutextension[0] == $onesite)? "active":"noactive";
}
// "Poikkeukset", eli tapaukset, joissa url ei vastaa navbarin linkin nimeä
// Korttiin liittyvä sivu auki, eli "Cards" pitäisi olla aktiivinen
if ($active["card"] == "active" || $active["newcard"] == "active" || $active["updatecard"] == "active" || $active["destroycard"] == "active") {
    $active["cards"] = "active";
}
// Käyttäjiin liittyvä sivu auki, eli eri tapauksissa joko "Users" tai käyttäjänimen pitäisi olla aktiivinen
if ($active["user"] == "active" && !loggedIn()) {
    $active["users"] = "active";
} else if ($active["user"] == "active" && $id != $_SESSION["userid"]) {
    $active["users"] = "active";
    $active["user"] = "noactive";
} else if ($active["updateuser"] == "active" || $active["destroyuser"] == "active") {
    $active["user"] = "active";
}
// Pakkoihin liittyvä sivu auki, eli "Decks" pitäisi olla aktiivinen
if ($active["deck"] == "active" || $active["newdeck"] == "active" || $active["updatedeck"] == "active" || $active["destroydeck"] == "active" || $active["addcards"] == "active" || $active["removecard"] == "active") {
    $active["decks"] = "active";
}