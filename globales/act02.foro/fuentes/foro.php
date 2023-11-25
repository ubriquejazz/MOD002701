<?


//##################PROGRAMA PRINCIPAL####################
require("funciones.php");
imprimir_cabecera();

session_start();
if (isset($_SESSION['num_user']))
{
    //Conectar a la BD
    conectar_BD();
        
    $consulta="select num_usuario, login, password from usuarios WHERE num_usuario=".$_SESSION['num_user'];
    $datos=@mysql_query($consulta,$id_conexion) or
             die("<CENTER><H3>No se ha podido ejecutar la consulta.</H3></CENTER>");
    if (mysql_num_rows($datos)>0) {    	
    	// Todo correcto imprimimos los mensajes
    	$consulta="SELECT num_mensaje, fecha, asunto, nombre, num_respuestas
                   FROM mensajes M, usuarios U
               	   WHERE M.num_usuario=U.num_usuario and num_mensaje_origen<0";
     	$datos2=@mysql_query($consulta,$id_conexion) or die("<CENTER><H3>No se ha podido ejecutar la consulta.
                                                            <P>Revise la sintaxis de la orden.</H3></CENTER>");

     	$filas=mysql_num_rows($datos2);
     	echo "<br><TABLE BORDER='0' cellspacing='1' cellpadding='1' width='80%' align='center'>
                <TR><th bgcolor='black'><FONT color='white' face='arial, helvetica'>Fecha</FONT></th>
                    <th bgcolor='black'><FONT color='white' face='arial, helvetica'>Asunto</FONT></th>
                    <th bgcolor='black'><FONT color='white' face='arial, helvetica'>Autor</FONT></th>
                    <th bgcolor='black' width=100><FONT color='white' face='arial, helvetica'>Respuestas</FONT></th>
                </TR>";    
    	for ($i=0;$i<$filas;$i++)
     	{
      		list($num_mensaje, $fecha, $asunto, $nombre, $num_respuestas)=mysql_fetch_array($datos2);
      		$array_fecha=explode ("-",$fecha);
      		$fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
      		echo "<TR>
      			<TD align='center'>$fecha_modificada</TD>
                   	<TD align='left'>&nbsp;&nbsp;<a href='contenido.php?num_mensaje=$num_mensaje'>$asunto</a></TD>
                   	<TD align='left'>&nbsp;&nbsp;$nombre</TD>
                   	<TD align='center'>$num_respuestas</TD>
                </TR>";
     	} // end for
    	echo "</table><BR><CENTER>";
    	echo boton_ficticio('Nuevo mensaje','responder.php');
    	echo "</CENTER>";
    } 
    else
    echo "<br><br><center><h3>El Usuario o Contraseña son incorrectas</h3><br><br><a href='index.php'>Vuelva a Intentarlo</a>";
}    
else //No se ha encontrado al usuario
echo "<br><br><center><h3>El Usuario o Contraseña son incorrectas</h3><br><br><a href='index.php'>Vuelva a Intentarlo</a>";
            

?>
</BODY>
</HTML>
