<script type='text/javascript' src="js/confirmdelete.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
<div class="container">
    <h1><?php echo htmlspecialchars($data->user->getName()); ?></h1>
    <!-- Näytetään tämän käyttäjän pakkojen määrä -->
    <?php if ($data->amount == 0): ?>
        <h5><?php echo htmlspecialchars($data->user->getName()); ?> has not made any decks yet</h5>
    <?php elseif ($data->amount == 1): ?>
        <h5><?php echo htmlspecialchars($data->user->getName()); ?> has made 1 deck</h5>
    <?php else: ?>
        <h5><?php echo htmlspecialchars($data->user->getName()); ?> has made <?php echo $data->amount ?> decks</h5>
    <?php endif; ?>
    <?php require "views/filter.php"; ?>
    <!-- Käyttäjä voi mennä pakanlisäyslomakkeeseen omalta sivultaan, "intuitiivista", kun näkyy omia deckkejä samalla -->
    <?php if ($data->user->getId() == $_SESSION["userid"]): ?>
        <?php require "views/newdeckbutton.php"; ?>
    <?php endif; ?>
    <!-- Taulukko, jossa on tämän käyttäjän pakat -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <?php foreach ($data->decks as $deck): ?>
                <tr>
                    <td><a href="deck.php?id=<?php echo $deck->getId() ?>"><?php echo htmlspecialchars($deck->getName()); ?></a></td>
                    <td><?php echo htmlspecialchars($deck->getClass()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Kirjautuneelle käyttäjälle näytetään omalla sivulla linkit salasananvaihtoon ja käyttäjätilin poistoon -->
    <?php if ($_SESSION["userid"] == $data->user->getId()): ?>
    <a href="updateuser.php?id=<?php echo $data->user->getId(); ?>">Change password</a>
    <a href="destroyuser.php?id=<?php echo $data->user->getId(); ?>" onclick="return confirmDelete()">Destroy</a>
    <?php endif; ?>
</div>