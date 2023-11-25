<?

/* Fijamos las variables globales de la conexión al servidor MySQL.
   El nombre del servidor es el que admite por defecto el servidor
   local; el nombre del usuario y de la clave han sido dados de alta
   previamente en el servidor MySQL. */

/*$DBHost='10.10.110.11';
$DBUser='usuarioMCPHP';
$DBPass='CpHP1()2';
$DB='mentorCursoPHP';*/

   
$DBHost="localhost";
$DBUser="root";
$DBPass="";
$DB="ejercicios";

$id_conexion=-1;


function imprimir_cabecera()
{
	echo "<HTML><HEAD><TITLE>Foro de mensajes</TITLE></HEAD>
		<BODY bgcolor='orange' >
		<TABLE bgcolor='black' border='0' align='center' cellspacing='3' cellpadding='3' width='100%'>
		<TR><TH colspan='5' width='100%' bgcolor='black'>
                &nbsp;<FONT size='6' color='orange' face='arial, helvetica'>FORO DE MENSAJES</FONT>&nbsp
                </TH></TR>
               </TABLE>";
} // end imprimir_cabecera


function conectar_BD() 
{
   global $DBHost, $DBUser, $DBPass, $DB, $id_conexion;
   
   $id_conexion =@mysql_connect($DBHost, $DBUser, $DBPass) or
     die("<CENTER><H3>No se ha podido establecer la conexi&oacute;n.<P>
          Compruebe si est&aacute; activado el servidor de bases de datos MySQL.</H3></CENTER>");
   /* Intentamos establecer una conexión persistente con el servidor.*/
   if (!mysql_select_db($DB))
    die("<CENTER><H3>No se ha podido seleccionar la base de datos '$DB'");
}


function boton_ficticio($caption,$url)
{
	return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
                        <TR><TD bgcolor='white'>
                        	<FONT size ='-1' face='arial, helvetica'><a href = '$url'>$caption</A></FONT>
                        </TD></TR></TABLE>";
} // end funcion boton_fictio

?>