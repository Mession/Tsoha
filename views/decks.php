<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>List of decks</h1>
    <!-- Kerrotaan käyttäjälle, kuinka monta pakkaa tietokannassa on -->
    <?php if ($data->amount == 0): ?>
        <h5>No decks in the database</h5>
    <?php elseif ($data->amount == 1): ?>
        <h5>1 deck in the database</h5>
    <?php else: ?>
        <h5><?php echo $data->amount ?> decks in the database</h5>
    <?php endif; ?>
    <?php require "views/filter.php"; ?>
    <?php require "views/newdeckbutton.php"; ?>
    <!-- Taulukko, jossa näkyy tietokannassa olevat pakat -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Owner</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <?php foreach ($data->decks as $deck): ?>
                <tr>
                    <td><a href="deck.php?id=<?php echo $deck->getId() ?>"><?php echo htmlspecialchars($deck->getName()); ?></a></td>
                    <td><a href="user.php?id=<?php echo $deck->getOwner() ?>"><?php echo htmlspecialchars(User::findUserById($deck->getOwner())->getName()); ?></a></td>
                    <td><?php echo htmlspecialchars($deck->getClass()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>