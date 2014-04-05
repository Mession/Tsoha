<script type="text/javascript" src="js/jquery-2.1.0.js"></script>
<script>$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>
<div class="container">
    <h1>List of cards</h1>
    <div class="input-group">
        <input id="filter" type="text" class="form-control" placeholder="Filter results">
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
<?php if (admin()): ?>
<?php require_once 'views/newcard.php'; ?>
<?php endif; ?>
