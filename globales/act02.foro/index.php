<?php

    include("funciones.php");
    if (isset($_REQUEST['pulsa']))
    {
        //Conectar a la BD
        conectar_BD();  
        $consulta="select num_usuario from usuarios WHERE login='".$_REQUEST['login']."' or password='".$_REQUEST['password']."' ";
        //$datos=@mysql_query($consulta,$id_conexion);
        if (mysql_num_rows($datos)<0)
            echo "<BR><BR><center>
                El login y/o el usuario no coinciden. Escriba otro.<br><br></center>";
        else {
            //$myrow = mysql_fetch_row($datos);
            session_start();

            //Ahora activamos la sesi�n con el id del usuario nuevo
            $_SESSION['num_user'] = $myrow[0];

            //Saltamos de p�gina
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'foro.php';
            header("Location: http://$host$uri/$extra");       
        }
    }
    imprimir_cabecera();
?>

<br><br>
<center><h3>INICIO DE SESION</h3></center>
<br><br>
<table align="center">
<form name="form1" method="post" action="index.php">
      <tr><td>Nombre de usuario</td>
          <td><input type="text" name="login" value="" size="20" maxlength="20"></td></tr>
      <tr><td>Contrasena</td>
          <td><input type="password" name="password" value="" size="12" maxlength="12"></td></tr>
      <tr><td><INPUT TYPE="SUBMIT" NAME="pulsa" VALUE="Aceptar"></form></td>
          <td align="right"><a href="alta.php">Nuevo Usuario</a></td></tr>           
</table>

</body>
</html>