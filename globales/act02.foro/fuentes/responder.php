<?

require("funciones.php");
echo imprimir_cabecera();
session_start();

// Controlamos que la sesión sigue activa
if (!isset($_SESSION['num_user'])) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");  
}

conectar_BD();
$fecha=date("Y-m-d");
$array_fecha=explode ("-",$fecha);
$fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";

//La variable enviar es la que se recibe al rellenar un formulario de envio de mensaje. Es el boton
if (isset($_REQUEST['enviar']))
   {
   if(trim($_REQUEST['asunto'])=='') $asunto="[Sin Asunto]";
   else $asunto=str_replace("'", "\'", $_REQUEST['asunto']);
   
   if(isset($_REQUEST['num_mensaje_origen'])) $num_mensaje_origen=$_REQUEST['num_mensaje_origen'];
   else $num_mensaje_origen=-1;
   
   $consulta="insert into mensajes values(NULL,NOW(),'$asunto', '".str_replace("'", "\'", $_REQUEST['contenido'])."','".$_SESSION['num_user']."', '$num_mensaje_origen', 0)";
   $datos=@mysql_query($consulta,$id_conexion) or die("<CENTER><H3>No se ha podido ejecutar la inserci&oacute;n.</H3></CENTER>");
   
   // Aumentamos en 1 el contador de respuestas de los mensajes
   if ($num_mensaje_origen>0) {
   	$consulta="UPDATE mensajes SET num_respuestas=num_respuestas+1 WHERE num_mensaje=".$num_mensaje_origen;
   	$datos=@mysql_query($consulta,$id_conexion) or die("<CENTER><H3>No se ha podido ejecutar la inserci&oacute;n.</H3></CENTER>");
   }
   
   echo "<center><br><br><br><h3>El mensaje se ha dado de alta correctamente<h3><center>";
}
else
    if (isset($_REQUEST['num_mensaje']))
    {    	
       $consulta="SELECT fecha, asunto, nombre, email
                  FROM mensajes M, usuarios U 
                  WHERE M.num_usuario=U.num_usuario AND num_mensaje=".$_REQUEST['num_mensaje'];
       $datos=@mysql_query($consulta,$id_conexion) or
             die("<CENTER><H3>No se ha podido ejecutar la consulta.</H3></CENTER>");
       list($fecha, $asunto, $nombre, $email)=mysql_fetch_array($datos);
       $array_fecha=explode ("-",$fecha);
       $fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";

       echo "<br><br><table align='center'border='0'>
            <tr><td colspan='2' align='right'><b>$fecha_modificada</b></td></tr>
            <tr><td colspan='2'><form name='form1' method='post' action='responder.php'>
            <b>Asunto</b> <input type='text' name='asunto' value='RE:$asunto' size='50' maxlength='50'></td></tr>
            <tr><td colspan='2'><b>Respuesta al mensaje de <i>$nombre ($email)</i></b></td></tr>
            <tr><td colspan='2' valign='top'>
            <textarea name='contenido' rows='20' cols='75' wrap=on></textarea></td></tr>
            <tr align='center'><td>
            <input type='hidden' name='num_user' value='".$_SESSION['num_user']."'>
            <input type='hidden' name='num_mensaje_origen' value='".$_REQUEST['num_mensaje']."'>
            <input type='submit' name='enviar' value='Enviar Mensaje'></td>
            <td><input type='reset' name='Borrar' value='Borrar datos'></td></tr>
            </table>";
    }
    else
       echo "<br><br><table align='center'border='0'>
            <tr><td colspan='2' align='right'><b>$fecha_modificada</b></td></tr>
            <tr><td colspan='2'><form name='form1' method='post' action='responder.php'>
            <b>Asunto</b>   <input type='text' name='asunto' value='' size='42' maxlength='50'></td></tr>
            <tr><td colspan='2' valign='top'>
            <textarea name='contenido' rows='20' cols='38'></textarea></td></tr>
            <tr align='center'><td>
            <input type='hidden' name='num_user' value='".$_SESSION['num_user']."'>
            <input type='submit' name='enviar' value='Enviar Mensaje'></td>
            <td><input type='reset' name='Borrar' value='Borrar datos'></td></tr>
            </table>";

    echo "<BR><CENTER>".boton_ficticio('Volver a mensajes','foro.php')."</CENTER>";
?>
