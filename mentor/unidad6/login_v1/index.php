<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Página principal</h1>

    <?php
        session_start();
        if (!isset($_SESSION["usuario"])) 
            echo "<a href='login.php'>Entrar</a>";
        else { // zona privada
    ?>
        Logueado como <a href="perfil.php"><?= $_SESSION["usuario"] ?></a>
        (<a href="logout.php">Salir</a>)
    <?php
        }
    ?>

    <p>
    Página principal con información pública que puede ver cualquier usuario.
    </p>

</body>
</html>