<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>Add cards</h1>
    <!-- Kerrotaan käyttäjälle, kuinka monta sellaista korttia, jotka käyttäjä voisi lisätä pakkaansa kortin luokan puolesta, tietokannassa on -->
    <?php if ($data->amount == 0): ?>
        <h5>No cards in the database</h5>
    <?php elseif ($data->amount == 1): ?>
        <h5>1 card in the database</h5>
    <?php else: ?>
        <h5>There are <?php echo $data->amount ?> cards you could add to your deck</h5>
    <?php endif; ?>
    <?php require "views/filter.php"; ?>
    <div style="float:left">
        <a href="deck.php?id=<?php echo $data->deck->getId(); ?>">
            <button class="btn btn-default" type="button">
                Back to deck
            </button>
        </a>
    </div>
    <!-- Taulukko, jossa näkyy kortteja, jotka sopivat pakkaan luokan puolesta -->
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
                        <a href="addcards.php?id=<?php echo $data->deck->getId(); ?>&cid=<?php echo $card->getId(); ?>">
                            <span class="glyphicon glyphicon-plus" style="color:black"></span>
                        </a>
                        <a href="card.php?id=<?php echo $card->getId(); ?>"><?php echo htmlspecialchars($card->getName()); ?></a>
                    </td>
                    <td><?php echo htmlspecialchars($card->getClass()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>