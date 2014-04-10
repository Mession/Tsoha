<script type='text/javascript' src="js/confirmdelete.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->deck->getName()); ?></h1>
    <p>
        This <?php echo htmlspecialchars(strtolower($data->deck->getClass())); ?> deck was made by <a href="user.php?id=<?php echo $data->deck->getOwner() ?>"><?php echo htmlspecialchars(User::findUserById($data->deck->getOwner())->getName()); ?></a>
        <?php if ($data->amount == 0): ?>
            but doesn't have any cards yet
        <?php elseif ($data->amount == 1): ?>
            and has 1 card
        <?php else: ?>
            and has <?php echo $data->amount ?> cards
        <?php endif; ?>
    </p>
    <div class="input-group" style="float:left">
        <input id="filter" type="text" class="form-control" placeholder="Filter results">
    </div>
    <div style="float:left">
        <?php if ($data->deck->getOwner() == $_SESSION["userid"]): ?>
            <a href="addcards.php">
                <button class="btn btn-default" type="button">
                    Add cards to this deck
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
            <?php foreach ($data->cards as $card): ?>
                <tr>
                    <td>
                        <a href="card.php?id=<?php echo $card->getId(); ?>"><?php echo htmlspecialchars($card->getName()); ?></a>
                    </td>
                    <td><?php echo htmlspecialchars($card->getClass()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if ($data->deck->getOwner() == $_SESSION["userid"]): ?>
    <a href="updatedeck.php?id=<?php echo $data->deck->getId(); ?>">Change name</a>
    <a href="destroydeck.php?id=<?php echo $data->deck->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>