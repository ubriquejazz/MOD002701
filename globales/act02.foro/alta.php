<?php

    require("funciones.php");

    imprimir_cabecera();

    
    if (isset($_REQUEST['Alta'])){

        conectar_BD();
    
        if ((trim($_REQUEST['login'])=='') or (trim($_REQUEST['password'])=='') 
            or (trim($_REQUEST['nombre'])==''))
            die ("<BR><BR><center>El login/password no deben ser vacios. Elija otro.
                  <a href='alta.php'>Volver al formulario de alta</a></center>");
   
        $consulta="SELECT nombre, login FROM usuarios WHERE nombre='".$_REQUEST['nombre']."' or login='".$_REQUEST['login']."' ";
        $resultado = ejecuta_SQL($consulta);

        if ($resultado->rowCount()>0)
   	        echo "<BR><BR><center>
                El login y/o el usuario ya se encuentran en la base de datos. Elija otro.</center>";
        else   
        {
            $consulta="INSERT INTO usuarios VALUES (NULL,'".$_REQUEST['nombre']."','".$_REQUEST['login']."','".$_REQUEST['password']."','".$_REQUEST['email']."')";
            $resultado = ejecuta_SQL($consulta);

            session_start();
            $_SESSION['num_user'] = insert_id();
            
            die("<BR><BR><center><h3>El alta se ha producido correctamente</h3><br><br>
                <a href='foro.php'>Entre en el foro</a></center>");
    }
}   
?>

<BR><BR><center><h3>NUEVA ALTA</h3></CENTER>
     <br><br><form name='form1' method='post' action='alta.php'>
     <table align='center'>
     <tr><td >Nombre    :</td>
         <td><input type='text' name='nombre' value='' size='20' maxlength='30'></td></tr>
     <tr><td >Login     :</td>
         <td><input type='text' name='login' value='' size='12' maxlength='20'></td></tr>
     <tr><td >Contrasena:</td>
         <td><input type='password' name='password' value='' size='12' maxlength='12'></td></tr>
     <tr><td >Email     :</td>
         <td><input type='text' name='email' value='' size='20' maxlength='30'></td></tr>
     <tr align='center'>         
         <td><input type='submit' name='Alta' value='Dar de Alta'></td>
         <td><input type='reset' name='Borrar' value='Borrar datos'></td></tr>            
    </table>
    </form>

    <br><br><center><a href='index.php'>Volver a Inicio de Sesion</a></center>

<?php imprimir_footer(); ?>