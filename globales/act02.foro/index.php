<?php
    include("funciones.php");

    imprimir_cabecera();
    
    if (isset($_REQUEST['pulsa'])){
    
        conectar_BD();
        $consulta="select num_usuario from usuarios 
            WHERE login='".$_REQUEST['login']."' and password='".$_REQUEST['password']."' ";
        
        $resultado = ejecuta_SQL($consulta);
        if ($resultado->rowCount()>0) {
            $myrow = $resultado->fetchAll();
            //Ahora activamos la sesion con el id del usuario nuevo
            session_start();
            $_SESSION['num_user'] = $myrow[0][0];
            
            //Saltamos de pagina
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'foro.php';
            header("Location: http://$host$uri/$extra");  
        }
        else
            echo "<BR><BR><center>El login y/o el usuario no coinciden. Escriba otro.<br><br></center>";
    }
    else if (isset($_REQUEST['logout'])){
        $_SESSION[] = array();
    }
?>
<br><br>
<center><h3>INICIO DE SESION</h3></center>
<br><br>
<table align="center">
<form name="form1" method="post" action="index.php">
      <tr><td>User</td>
          <td><input type="text" name="login" value="" size="20" maxlength="20"></td></tr>
      <tr><td>Password</td>
          <td><input type="password" name="password" value="" size="12" maxlength="12"></td></tr>
      <tr><td><INPUT TYPE="SUBMIT" NAME="pulsa" VALUE="Aceptar"></form></td>
          <td align="right"><a href="alta.php">Nuevo Usuario</a></td></tr>           
</table>

<?php imprimir_footer() ?>