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
        <title></title>
    </head>
    <body>
        <!-- Toteuta myöhemmin kaksi erillistä navbaria, toinen kirjautuneelle ja toinen muille
        ja että navbarissa huomioidaan aktiivinen sivu html-demon tapaan -->
        <?php require "navbar.php"; ?>
        <?php require $page; ?>
    </body>
</html>