<?

  class discos {
  	
  	private $datos, $id_conexion;
  	
  	function __construct() {
  	  	$DBHost="localhost";
		$DBUser="root";
		$DBPass="";
		$DB="ejercicios";
        
		/*
		$DBHost='10.10.110.11';
		$DBUser='usuarioMCPHP';
		$DBPass='CpHP1()2';
		$DB='mentorCursoPHP';*/

		/* Intentamos establecer una conexi�n persistente con el servidor.*/
		/*
		$this->id_conexion = mysql_pconnect($DBHost, $DBUser, $DBPass);
  	  	printf("<H3>No se ha podido establecer la conexi&oacute;n.<P>
		Compruebe si est&aacute; activado el servidor de bases de datos MySQL.</H3>");

		if (!mysql_select_db($DB))
			printf("<CENTER><H3>No se ha podido seleccionar la base de datos $DB: <P>%s",'Error no '.
				mysql_errno() . '.-' . mysql_error());
		*/
	}

	function __destruct () {
		/* Liberamos la conexi�n persistente con el servidor.*/
		//if (isset($this->datos)) mysql_free_result($this->datos);
		//if (isset($this->id_conexion)) mysql_close($this->id_conexion);
	}


  }
	
?>

