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
        $miColor = $_SESSION["color"];
        $n = $_SESSION["aleatorio"];
        echo "<p>El color es <b>$miColor</b>";
        echo " y el número es <b>$n</b></p>";
    ?>
    </p>
    <p>Id de la sesión: <b><?= session_id() ?></b></p>

    
</body>
</html>