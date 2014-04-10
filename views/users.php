<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1>List of users</h1>
    <?php if ($data->amount == 0): ?>
        <h5>No users in the database</h5>
    <?php else: ?>
        <h5><?php echo $data->amount ?> users in the database</h5>
    <?php endif; ?>
    <div class="input-group" style="float:left">
        <input id="filter" type="text" class="form-control" placeholder="Filter results">
    </div>
    <div style="float:left">
        <?php if (!loggedIn()): ?>
            <a href="signup.php">
                <button class="btn btn-default" type="button">
                    Sign up
                </button>
            </a>
        <?php endif; ?>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <?php foreach ($data->users as $user): ?>
                <tr>
                    <td><a href="user.php?id=<?php echo $user->getId(); ?>"><?php echo htmlspecialchars($user->getName()); ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>