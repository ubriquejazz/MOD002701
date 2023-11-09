<?php
    /* form de login, si va bien abre sesion, guarda nombre de 
    usuario y redirige a main.php. si va mal mensaje de error */

    require "funciones.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
        if ($usu == false) {
            $err = true;
            $usuario = $_POST['usuario'];
        }
        else {
            session_start();
            $_SESSION['usuario'] = $_POST['usuario'];
            header("Location: sesion02_main.php");
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
<form method="POST" action="sesion02_login.php">
    Usuario <input value="<?php ?>" id="usuario" name="usuario" type="text">
    Clave <input id="clave" name="clave" type="password">
    <input value="ok" type="submit">
</form>
    
</body>
</html>