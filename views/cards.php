<div class="container">
    <h1>List of cards</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
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
<?php if (admin()): ?>
<?php require_once 'views/newcard.php'; ?>
<?php endif; ?>
