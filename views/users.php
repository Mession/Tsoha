<div class="container">
            <h1>List of users</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->users as $user): ?>
                    <tr>
                        <td><a href="user.php?id=<?php echo $user->getId() ?>"><?php echo $user->getName(); ?></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="container">
            <a href="signup.php">Sign up</a>
        </div>