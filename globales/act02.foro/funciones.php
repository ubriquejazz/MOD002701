<?php

/* Fijamos las variables globales de la conexi�n al servidor MySQL.
   El nombre del servidor es el que admite por defecto el servidor
   local; el nombre del usuario y de la clave han sido dados de alta
   previamente en el servidor MySQL. */
      
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
   } 

   function imprimir_footer() 
   {
      echo "<br><br><center><p>Copyright " . date('Y') . ". Aula Mentor cumple al 100% las directrices de protección de datos del GDPR.<br>";
      echo "Lee nuestra Política de Privacidad para entender cómo recogemos, almacenamos y procesamos tu información privada según el GDPR.";
      echo "</p><br>" . boton_ficticio("Logout", "index.php?logout") . "</center>";
      echo "</BODY></HTML>";
   }

   function boton_ficticio($caption,$url)
   {
      return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
                           <TR><TD bgcolor='white'>
                              <FONT size ='-1' face='arial, helvetica'><a href = '$url'>$caption</A></FONT>
                           </TD></TR></TABLE>";
   } // end funcion boton_fictio

   function conectar_BD() 
   {
      global $DBHost, $DBUser, $DBPass, $DB, $id_conexion;

      try {
         $id_conexion = new PDO("mysql:host=" . $DBHost. ";dbname=" . $DB. ";charset=utf8", 
            $DBUser, $DBPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
         $id_conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,  true);
         $id_conexion->setAttribute(PDO::NULL_TO_STRING, true);
      } 
      catch (PDOException $e) {
         die ("<p><H3>No se ha podido establecer la conexión.<P>Compruebe si está activado el 
         servidor de bases de datos MySQL.</H3></p>\n <p>Error: " . $e->getMessage() . "</p>\n");
      } 
   }

   function ejecuta_SQL($sql) 
   {
      global $id_conexion;

		$resultado=$id_conexion->query($sql);
		if (!$resultado){
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($id_conexion->errorInfo());					
			die ("</PRE>");
		}
		return $resultado;
	} 

   function insert_id() {
      global $id_conexion;
      return $id_conexion->lastInsertId();
   }
?>