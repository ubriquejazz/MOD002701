<?php

  session_start();

  // paso por error cuando ya estoy logueado
  if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] != null) 
    header("Location: index.php");

  // si hay algo del formulario
  if (isset($_POST["usuario"]) && $_POST["usuario"] != null) {
    $usuario = $_POST["usuario"];

    if ($usuario == "pepe" && $_POST["contrasena"] == "") {
      $_SESSION["usuario"] = $usuario;
      header("Location: index.php");
    } 
    else {
      $_SESSION["error"] = "Usuario o contraseña incorrecto";
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

    <h1>Iniciar sesión</h1>

    <form method = 'post' action="login.php">
      Usuario: <input type="text" name="usuario"><br>
      Contraseña: <input type="password" name="contrasena"><br>
      <input type="submit" value="Enviar">
    </form>
    
    <div style="color: red;">
      <p>
        <?php 
            if (isset($_SESSION["error"])) {
                echo $_SESSION["error"];
                unset($_SESSION["error"]); 
            }
        ?>
      </p>
    </div>

</body>
</html>