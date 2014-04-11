<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-2.1.0.js"></script>
        <script type="text/javascript" src="../js/jquery-2.1.0.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <?php if (isset($title)): ?>
            <title><?php echo $title ?> | Hearthstone deck builder</title>
        <?php else: ?>
            <title>Hearthstone deck builder</title>
        <?php endif; ?>
    </head>
    <body>
        <?php require_once "libs/navbaractivetab.php"; ?>
        <?php require "navbar.php"; ?>
        <!-- Näytetään käyttäjälle mahdollisia virhe- ja muita viestejä -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['notice'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['notice']; ?></div>
            <?php unset($_SESSION['notice']); ?>
        <?php endif; ?>
        <?php if (!empty($data->errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($data->errors as $error): ?>
                    <?php echo $error . "<br>"; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data->error)): ?>
            <div class="alert alert-danger">
                <p><?php echo $data->error ?></p>
            </div>
        <?php endif; ?>
        <?php require $page; ?>
    </body>
    <br>
    <br>
</html>