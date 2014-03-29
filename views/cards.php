<?php
$cards = Card::findAllCards();
?>
<div class="container">
    <h1>List of cards</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cards as $card): ?>
                <tr>
                    <td><?php echo $card->getId(); ?></td>
                    <td>
                        <a href="card.php?id=<?php echo $card->getId(); ?>"><?php echo $card->getName(); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>