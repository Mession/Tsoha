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
    <h1>List of decks</h1>
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
                <th>Id</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <tr>
                <td>1</td>
                <td><a href="decks/id.html">Deck.first.name</a></td>
                <td><a href="users/id.html">User.name</a></td>
                <td><p>Mage</p></td>
            </tr>
            <tr>
                <td>2</td>
                <td><a href="decks/id.html">Deck.second.name</a></td>
                <td><a href="users/id.html">User.name</a></td>
                <td><p>Warlock</p></td>
            </tr>
            <tr>
                <td>3</td>
                <td><a href="decks/id.html">jne.</a></td>
                <td><a href="users/id.html">User.name</a></td>
                <td><p>Rogue</p></td>
            </tr>
        </tbody>
    </table>
</div>