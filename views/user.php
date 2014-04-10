<script type='text/javascript' src="js/confirmdelete.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->user->getName()); ?></h1>
    <?php if ($data->amount == 0): ?>
        <h5><?php echo htmlspecialchars($data->user->getName()); ?> has not made any decks yet</h5>
    <?php elseif ($data->amount == 1): ?>
        <h5><?php echo htmlspecialchars($data->user->getName()); ?> has made 1 deck</h5>
    <?php else: ?>
        <h5><?php echo htmlspecialchars($data->user->getName()); ?> has made <?php echo $data->amount ?> decks</h5>
    <?php endif; ?>
    <div class="input-group" style="float:left">
        <input id="filter" type="text" class="form-control" placeholder="Filter results">
    </div>
    <div style="float:left">
        <?php if ($data->user->getId() == $_SESSION["userid"]): ?>
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
                <th>Class</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <?php foreach ($data->decks as $deck): ?>
                <tr>
                    <td><a href="deck.php?id=<?php echo $deck->getId() ?>"><?php echo htmlspecialchars($deck->getName()); ?></a></td>
                    <td><?php echo htmlspecialchars($deck->getClass()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if ($_SESSION["userid"] == $data->user->getId()): ?>
    <a href="updateuser.php?id=<?php echo $data->user->getId(); ?>">Change password</a>
    <a href="destroyuser.php?id=<?php echo $data->user->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>