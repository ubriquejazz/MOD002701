<?php

    function comprobar_usuario($nombre, $clave){
        if ($nombre === "usuario" and $clave === "1234") {
            $usu['nombre'] = "usuario";
            $usu['rol'] = 0;
        }
        else if ($nombre === "admin" and $clave === "1234") {
            $usu['nombre'] = "admin";
            $usu['rol'] = 1;
        }
        return $usu;
    }

    /* form de login, si va bien abre sesion, guarda nombre de 
    usuario y redirige a main.php. si va mal mensaje de error */

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
        if ($usu == false) {
            $err = true;
            $usuario = $_POST['usuario'];
        }
        else {
            session_start();
            $_SESSION['usuario'] = $_POST['usuario'];
            header("Location: index.php");
        }
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
<?php
    if (isset($_GET["redirigido"])) {
        echo "<p> Haga login para continuar</p>";
    }
    if (isset($err) and $err==true) {
        echo "<p> Revise usuario, contrasena</p>";
    }
?>
<form method="post" action="login.php">
    Usuario <input value="<?php ?>" id="usuario" name="usuario" type="text">
    Clave <input id="clave" name="clave" type="password">
    <input value="ok" type="submit">
</form>
    
</body>
</html>