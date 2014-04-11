<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>List of users</h1>
    <!-- Kuinka monta käyttäjää tietokannassa on -->
    <?php if ($data->amount == 0): ?>
        <h5>No users in the database</h5>
    <?php elseif ($data->amount == 1): ?>
        <h5>1 user in the database</h5>
    <?php else: ?>
        <h5><?php echo $data->amount ?> users in the database</h5>
    <?php endif; ?>
    <?php require "views/filter.php"; ?>
    <!-- Kirjautumattomalle käyttäjälle näytetään rekisteröimisnappi -->
    <div style="float:left">
        <?php if (!loggedIn()): ?>
            <a href="signup.php">
                <button class="btn btn-default" type="button">
                    Sign up
                </button>
            </a>
        <?php endif; ?>
    </div>
    <!-- Taulukko kaikista käyttäjistä -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <?php foreach ($data->users as $user): ?>
                <tr>
                    <td><a href="user.php?id=<?php echo $user->getId(); ?>"><?php echo htmlspecialchars($user->getName()); ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>