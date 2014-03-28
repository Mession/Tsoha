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
        <title><?php echo $title ?></title>
    </head>
    <body>
        <?php if (isset($_SESSION["user"])): ?>
            <?php require "loggedinnavbar.php"; ?>
        <?php else: ?>
            <?php require "navbar.php"; ?>
        <?php endif; ?>
        <?php if (!empty($data->error)): ?>
            <div class="alert alert-danger"><?php echo $data->error; ?></div>
        <?php endif; ?>
        <?php require $page; ?>
    </body>
</html>