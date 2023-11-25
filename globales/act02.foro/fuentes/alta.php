<?
require("funciones.php");
imprimir_cabecera();

if (isset($_REQUEST['Alta']))
{

   //Conectar a la BD
   conectar_BD();
   
   if ((trim($_REQUEST['login'])=='') or (trim($_REQUEST['password'])=='') or (trim($_REQUEST['nombre'])==''))
   	die("<BR><BR><center>
                  El Nombre, Login y Password no deben ser vacíos. Elija otro.<br><br>
                  <a href='alta.php'>Volver al formulario de alta</a></center>");
   
   $consulta="select nombre, login from usuarios WHERE nombre='".$_REQUEST['nombre']."' or login='".$_REQUEST['login']."' ";
   $datos=@mysql_query($consulta,$id_conexion) or
             die("<CENTER><H3>No se ha podido ejecutar la consulta de alta. <P>Revise la sintaxis de la orden.</H3></CENTER>");
   
   if (mysql_num_rows($datos)>0)
   	echo "<BR><BR><center>
                  El login y/o el usuario ya se encuentran en la base de datos. Elija otro.<br><br>
                  <a href='alta.php'>Volver al formulario de alta</a></center>";
   else   
   {
       $consulta="insert into usuarios values (NULL,'".$_REQUEST['nombre']."','".$_REQUEST['login']."','".$_REQUEST['password']."','".$_REQUEST['email']."')";
       $datos=@mysql_query($consulta,$id_conexion) or
                 die("<CENTER><H3>No se ha podido ejecutar la nueva alta. <P>Revise la sintaxis de la orden.</H3></CENTER>");
	
       session_start();
       //Ahora activamos la sesión con el id del usuario nuevo
       $_SESSION['num_user'] = mysql_insert_id($id_conexion);
       
       echo "<BR><BR><center><h3>El alta se ha producido correctamente</h3><br><br>
                 <a href='foro.php'>Entre en el foro</a></CENTER>";
    
    }


}
else
    echo "<BR><BR><center><h3>NUEVA ALTA</h3></CENTER>
     <br><br><form name='form1' method='post' action='alta.php'>
     <table align='center'>
     <tr><td >Nombre    :</td>
         <td><input type='text' name='nombre' value='' size='20' maxlength='30'></td></tr>
     <tr><td >Login     :</td>
         <td><input type='text' name='login' value='' size='12' maxlength='20'></td></tr>
     <tr><td >Contraseña:</td>
         <td><input type='password' name='password' value='' size='12' maxlength='12'></td></tr>
     <tr><td >Email     :</td>
         <td><input type='text' name='email' value='' size='20' maxlength='30'></td></tr>
     <tr align='center'>         
         <td><input type='submit' name='Alta' value='Dar de Alta'></td>
         <td><input type='reset' name='Borrar' value='Borrar datos'></td></tr>            
    </table>
    </form>
    <br><br><center><a href='index.php'>Volver a Inicio de Sesion</a></center>";


?>






</body>
</html>
