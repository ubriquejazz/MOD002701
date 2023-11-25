<?
//ESTE ARCHIVO RECIBE LAS VARIABLES $num_mensaje

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


$consulta="SELECT num_mensaje, fecha, asunto, contenido, nombre, email
           FROM mensajes M, usuarios U
           WHERE M.num_usuario=U.num_usuario AND (num_mensaje=".$_REQUEST["num_mensaje"]." or num_mensaje_origen=".$_REQUEST["num_mensaje"].") ORDER BY num_mensaje ASC";
$datos=@mysql_query($consulta,$id_conexion) or
             die("<CENTER><H3>No se ha podido ejecutar la consulta.</H3></CENTER>");
             
list($num_mensaje, $fecha, $asunto, $contenido, $nombre, $email)=mysql_fetch_array($datos);
$array_fecha=explode ("-",$fecha);
$fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";

echo "<br><table align='center' border=0 width='80%' bgcolor='white'>
     <tr><td colspan='3'><b><U>ASUNTO:</U> <I>$asunto</b></I><td><td align=center rowspan=3>".boton_ficticio("Responder","responder.php?&num_mensaje=$num_mensaje")."</td></tr>
     <tr><td width='80%'><b><U>FECHA</U> : $fecha_modificada</b></td></tr>
     <tr><td colspan='3'><b><U>AUTOR</U> : </b>$nombre (<a href='mailto:$email'>$email</a>)<td></tr>
     <tr><td colspan='3'></td></tr></table>";
     //Se comprueba si se ha llegado al primer mensaje.Si no, se activa el boton

     echo "<br><table  bgcolor='#FFCC33' align='center' border=0 width='80%'><tr><td>$contenido</td></tr></table><BR>";
     
     echo "<table  bgcolor='#FFCC33' align='center' border=0 width='80%'>
     	   <tr><td><u>RESPUESTAS:<u> </td></tr>";
     
     while (list($num_mensaje, $fecha, $asunto, $contenido, $nombre, $email)=mysql_fetch_array($datos)) {
		$array_fecha=explode ("-",$fecha);
		$fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
		echo "<tr><td>$nombre (<a href='mailto:$email'>$email</a>) dijo: \n$contenido<HR></td></tr>";
		
     } // end while    	     	
     echo "</table>";     
     
     echo "<BR><CENTER>".boton_ficticio('Volver a mensajes','foro.php')."</CENTER>";

?>
</BODY>
</HTML>
