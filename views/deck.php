<script type='text/javascript' src="js/confirmdelete.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->deck->getName()); ?></h1>
    <!-- Kerrotaan pakan tietoja -->
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
    <?php require "views/filter.php"; ?>
    <!-- Nappi, joka vie korttien lisäämissivulle -->
    <div style="float:left">
        <?php if ($data->deck->getOwner() == $_SESSION["userid"]): ?>
            <a href="addcards.php?id=<?php echo $data->deck->getId(); ?>">
                <button class="btn btn-default" type="button">
                    Add cards to this deck
                </button>
            </a>
        <?php endif; ?>
    </div>
    <!-- Taulukko, jossa näkyy pakan kortteja -->
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
                        <?php if ($data->deck->getOwner() == $_SESSION["userid"]): ?>
                            <a href="removecard.php?id=<?php echo $data->deck->getId(); ?>&cid=<?php echo $card->getId(); ?>" <span class="glyphicon glyphicon-remove" style="color:black"></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($card->getClass()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Pakan omistajalle näytetään lisäksi pakan muokkaus ja poisto -napit -->
    <?php if ($data->deck->getOwner() == $_SESSION["userid"]): ?>
    <a href="updatedeck.php?id=<?php echo $data->deck->getId(); ?>">Change name</a>
    <a href="destroydeck.php?id=<?php echo $data->deck->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>