<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav">
            <li id="li_cards" class="<?php echo $active["cards"] ?>"><a href="cards.php">Cards</a></li>
            <li id="li_decks" class="<?php echo $active["decks"] ?>"><a href="decks.php">Decks</a></li>
            <li id="li_users" class="<?php echo $active["users"] ?>"><a href="users.php">Users</a></li>
            <?php if (loggedIn()): ?>
                <li id="li_user" class="<?php echo $active["user"] ?>"><a href="user.php?id=<?php echo $_SESSION["userid"] ?>"><?php echo htmlspecialchars($_SESSION["name"]) ?></a></li>
                <li id="li_logout" class="<?php echo $active["logout"] ?>"><a href="logout.php">Log out</a></li>
            <?php else: ?>
                <li id="li_signup" class="<?php echo $active["signup"] ?>"><a href="signup.php">Sign up</a></li>
                <li id="li_login" class="<?php echo $active["login"] ?>"><a href="login.php">Log in</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>