<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>List of cards</h1>
    <!-- Kerrotaan käyttäjälle, kuinka monta korttia tietokannassa on -->
    <?php if ($data->amount == 0): ?>
        <h5>No cards in the database</h5>
    <?php elseif ($data->amount == 1): ?>
        <h5>1 card in the database</h5>
    <?php else: ?>
        <h5><?php echo $data->amount ?> cards in the database</h5>
    <?php endif; ?>
    <?php require "views/filter.php"; ?>
    <!-- Uuden kortin luomisnappi, joka näkyy vain adminille -->
    <div style="float:left">
        <?php if (admin()): ?>
            <a href="newcard.php">
                <button class="btn btn-default" type="button">
                    Create a new card
                </button>
            </a>
        <?php endif; ?>
    </div>
    <!-- Taulukko, jossa näkyy kaikki tietokannassa olevat kortit -->
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
</div>