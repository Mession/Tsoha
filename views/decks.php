<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>List of decks</h1>
    <?php if ($data->amount == 0): ?>
        <h5>No decks in the database</h5>
    <?php else: ?>
        <h5><?php echo $data->amount ?> decks in the database</h5>
    <?php endif; ?>
    <div class="input-group" style="float:left">
        <input id="filter" type="text" class="form-control" placeholder="Filter results">
    </div>
    <div style="float:left">
        <?php if (loggedIn()): ?>
            <a href="newdeck.php">
                <button class="btn btn-default" type="button">
                    Create a new deck
                </button>
            </a>
        <?php endif; ?>
    </div>
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