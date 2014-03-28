<?php
$site = explode('/',$_SERVER['REQUEST_URI']);
$sites = array("index.php", "cards.php", "decks.php", "users.php", "signup.php", "login.php");
foreach ($sites as $onesite) {
    $active[$onesite] = ($site[2] == $onesite)? "active":"noactive";
}
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav">
            <li id="li_home" class="<?php echo $active["index.php"]?>"><a href="index.php">Home</a></li>
            <li id="li_cards" class="<?php echo $active["cards.php"]?>"><a href="cards.php">Cards</a></li>
            <li id="li_decks" class="<?php echo $active["decks.php"]?>"><a href="decks.php">Decks</a></li>
            <li id="li_users" class="<?php echo $active["users.php"]?>"><a href="users.php">Users</a></li>
            <li id="li_signup" class="<?php echo $active["signup.php"]?>"><a href="signup.php">Sign up</a></li>
            <li id="li_login" class="<?php echo $active["login.php"]?>"><a href="login.php">Log in</a></li>
        </ul>
    </div>
</nav>