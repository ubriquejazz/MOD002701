<?php
    
    session_start();

    // Si hago trampas
    if ($_SESSION["usuario"] == null) {
        $_SESSION["error"] = "Debe iniciar sesión para acceder a la página de perfil.";
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Perfil de usuario</title>
  </head>
  <body>

    <h1>Perfil de usuario</h1>

    <table>
      <tr>
        <td>
          <img src="user.jpg" width="80" height="80"></td>
        <td>
          Usuario: <?= $_SESSION["usuario"] ?><br>
          Página de perfil con información del usuario.<br>
          <a href="index.php">Página principal</a>
        </td>
      </tr>
    </table>

  </body>
</html>
