<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php?redirigido=true");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo "Bienvenido " . $_SESSION['usuario']; ?>
    <br><a href="logout.php"> exit </a>
</body>
</html>