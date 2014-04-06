<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>List of cards</h1>
    <?php if ($data->amount == 0): ?>
        <h5>No cards in the database</h5>
    <?php else: ?>
        <h5><?php echo $data->amount ?> cards in the database</h5>
    <?php endif; ?>
    <div class="input-group" style="float:left">
        <input id="filter" type="text" class="form-control" placeholder="Filter results">
    </div>
    <div style="float:left">
        <?php if (admin()): ?>
            <a href="newcard.php">
                <button class="btn btn-default" type="button">
                    Create a new card
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
                        <a href="card.php?id=<?php echo $card->getId(); ?>"><?php echo $card->getName(); ?></a>
                    </td>
                    <td><?php echo $card->getClass(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>