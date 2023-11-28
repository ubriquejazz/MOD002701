<?php

    require("funciones.php");
    session_start();
  
    // si hay algo del formulario
    if (isset($_POST["usr"]) && $_POST["usr"] != null) {
        $usuario = $_POST["usr"];
  
        if ($usuario == "pepe" && $_POST["pwd"] == "") {
            $_SESSION["usuario"] = $usuario;
            header("Location: foro.php");
        } 
        else if ($usuario == "admin" && $_POST["pwd"] == "1234") {
            $_SESSION["usuario"] = $usuario;
            header("Location: foro.php");
        }
        else {
            $_SESSION["error"] = "User or password incorrect";
        }
    }
    imprimir_cabecera();
?>
    <br><br>
    <center><h3>Login</h3></center>
    <br><br>
    <table align="center">
    <form name="form1" method="post" action="index.php">
    <tr><td>User</td>
        <td><input type="text" name="usr" value="" size="20" maxlength="20"></td></tr>
    <tr><td>Password</td>
        <td><input type="password" name="pwd" value="" size="12" maxlength="12"></td></tr>
    <tr><td><INPUT TYPE="SUBMIT" NAME="pulsa" VALUE="Send"></form></td></tr>           
    </table>


<?php imprimir_footer(); ?>