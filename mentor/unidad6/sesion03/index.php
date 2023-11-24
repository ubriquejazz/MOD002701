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
        $_SESSION["palabra"] = "hola";
        $_SESSION["aleatorio"] = rand(1, 10);
        $_SESSION["color"] = "verde";
    ?>
    <p>Variables de sesión asignadas.</p>
    <p><a href="pagina1.php">Página 1</a></p>
    <p><a href="pagina2.php">Página 2</a></p>
    </body>

</body>
</html>