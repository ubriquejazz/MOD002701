<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    $_SESSION["n"] = isset($_SESSION["n"]) ? $_SESSION["n"] + 1 : 1;
    ?>
    <h1>Contador es <?= $_SESSION["n"] ?></h1>
    <a href="contadorVisitas.php"> Recargar </a>
</body>
</html>