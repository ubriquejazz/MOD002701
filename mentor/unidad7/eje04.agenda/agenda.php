<?php

// Dibuja un botón sencillo mediante una tabla HTML
function boton_ficticio($caption,$url){
  	return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
  			<TR><TD bgcolor=\"white\"><FONT size =\"-1\">
			<a href = \"$url\">$caption</A></FONT></TD></TR></TABLE>";
}

define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
	
class agenda {
  	
  	protected $db;
  	
  	function __construct($BD="") {
		try {
			if ($BD!='')
				$this->db = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . $BD .";charset=utf8", USUARIO, CLAVE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			else 
				$this->db = new PDO("mysql:host=" . SERVIDOR. ";charset=utf8", USUARIO, CLAVE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			
			$this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,  true);
			// Indicamos como atributo que se debe devolver una cadena vacía para los valores nulos
			$this->db->setAttribute(PDO::NULL_TO_STRING, true);
			// Si no indicamos la BD es que hay que crearla de nuevo
			if ($BD=='') {
				// Ejecutamos la SQL de Creación de BD directamente en el servidor MySQL.
			   $sql = file_get_contents('ejercicios.sql');			 
			   $this->ejecuta_SQL($sql);
			}
		} catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
			<P>Compruebe si está activado el servidor de bases de datos MySQL.</H3></p>\n <p>Error: " . $e->getMessage() . "</p>\n");
		} 
	}
	
	function __destruct() {
		if (isset($db)) // Desconectamos de la BD
			$db=null;
	}

	function ejecuta_SQL($sql) {
		$resultado=$this->db->query($sql);
		if (!$resultado){
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($this->db->errorInfo());					
			die ("</PRE>");
		}
		return $resultado;
	} 
	
	function add_contacto ($registro, $Nombre, $Apellidos, $Telefono_oficina, 
							$Telefono_movil,$email, $direccion, $localidad, $provincia, 
							$codigo_postal, $telefono, $notas) 
	{
	  	if ($registro>0) 
	    	$sql_script = "UPDATE agenda SET 
					Nombre='$Nombre', Apellidos='$Apellidos', 
					Telefono_oficina='$Telefono_oficina',
					Telefono_movil='$Telefono_movil',email='$email', 
					direccion='$direccion', localidad='$localidad', 
					provincia='$provincia', codigo_postal='$codigo_postal',
					telefono='$telefono', notas='$notas'
				WHERE registro=$registro";
    	else
    	  	$sql_script = "INSERT INTO agenda (Nombre, Apellidos, Telefono_oficina,
				Telefono_movil, email, direccion, localidad, provincia, codigo_postal, telefono, notas)
				VALUES('$Nombre', '$Apellidos', '$Telefono_oficina', 
				'$Telefono_movil','$email', '$direccion', '$localidad',
				'$provincia', '$codigo_postal','$telefono', '$notas')";    	  					
    	
		$this->ejecuta_SQL($sql_script);
    }

    function nume_contacto () {
		$sql_script = "SELECT * FROM agenda";
		$resultado=$this->ejecuta_SQL($sql_script);
		return $resultado->rowCount();
    }
    	
    function del_contacto($id_to_del) {
		$sql_script = "delete FROM agenda where registro=$id_to_del";
		$this->ejecuta_SQL($sql_script);
    }
    
    function del_all_contacto() {
		$sql_script = "delete FROM agenda";
		$this->ejecuta_SQL($sql_script);
    }
    
    // Añadir o modificar contactos
    function introduce($id_to_edit, $ver) {	
		$campos=array(	
			0=>array(0=>"Nombre",1=>"Nombre",2=>15, 3=>30, 4=>""),
			1=>array(0=>"Apellidos",1=>"Apellidos",2=>30, 3=>100, 4=>""),
			2=>array(0=>"Telefono_oficina",1=>"Teléfono oficina",2=>15, 3=>30, 4=>""),
			3=>array(0=>"Telefono_movil",1=>"Teléfono móvil",2=>15, 3=>30, 4=>""),
			4=>array(0=>"email",1=>"e-Mail",2=>40, 3=>200, 4=>""),
			5=>array(0=>"direccion",1=>"Dirección",2=>30, 3=>150, 4=>""),
			6=>array(0=>"localidad",1=>"Localidad",2=>30, 3=>100, 4=>""),
			7=>array(0=>"provincia",1=>"Provincia",2=>30, 3=>60, 4=>""),
			8=>array(0=>"codigo_postal",1=>"Cód. Postal",2=>5, 3=>5, 4=>""),
			9=>array(0=>"telefono",1=>"Teléfono personal",2=>30, 3=>100, 4=>""),
			10=>array(0=>"notas",1=>"Notas",2=>65, 3=>254, 4=>""));
			
		if ($id_to_edit>0) {
			$sql_script = "SELECT Nombre, Apellidos, Telefono_oficina, 
				Telefono_movil, email, direccion, localidad, 
				provincia, codigo_postal, telefono, notas 
				FROM agenda where registro='$id_to_edit'";
			$resultado=$this->ejecuta_SQL($sql_script);
						
			$filas = $resultado->rowCount();
			if ($filas==0) { //resultado query vacío
				echo "<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
					<TR><TD ALIGN=CENTER VALIGN=CENTER><H2>No se encuentra ningún registro</H2></TD></TR></TABLE>";
			}
			else {
				$myrow = $resultado->fetchAll();
				for ($i=0; $i < count($campos); $i++)
					$campos[$i][4]=$myrow[0][$i];
			}
		}//end if $id_to_edit>0
    	
		if ($ver==0) 
			echo "<FORM name='form9' method='post' action=\"index.php?operacion=exec_alta\">";

		echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' align='center' width='600'>";	
		for ($i=0; $i < count($campos); $i++){
			echo "<TR><TD bgcolor='teal' align=center width=140>
				<FONT size=-1 color='white'>".$campos[$i][1]."</FONT></TD><TD>";

			if ($ver==1) 
				echo "<FONT size=-1><B>". $campos[$i][4]."</B></FONT>"; 
			else 
				echo "<input type='text' name='".$campos[$i][0]."' size='".$campos[$i][2]."' value = \"".$campos[$i][4].
						"\" maxlength='".$campos[$i][3]."'>";
			echo "</TD></TR>";
		}
		echo "</TABLE><CENTER>";
		
		if ($ver==0) {
			echo "<INPUT type='hidden' NAME='registro' value = '$id_to_edit'>";
			if ($id_to_edit>0) //estamos modificando
				echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Modificar contacto\">";
			else 
				echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Alta contacto\">";
		}

		echo "</CENTER>";
		if ($ver==0) echo "</FORM>";	
    	
	}
   
   	// Buscar contactos
   	function buscar($lo_q_busco) {
   		if ($lo_q_busco!="") 
   			$sql_script="SELECT * FROM agenda WHERE apellidos like '%".$lo_q_busco."%' ORDER BY apellidos";
   		else 
			$sql_script = "SELECT * FROM agenda order by apellidos";
   	
   		$resultado=$this->ejecuta_SQL($sql_script);
    	$filas = $resultado->rowCount();
	
   		if ($filas==0) { //resultado query vacío
   			echo "<TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
   				<TR><TD ALIGN=CENTER VALIGN=CENTER><H2>No se encuentra ningún registro</H2></TD></TR></TABLE>";
		}
		else //la búsqueda no es vacía
   			echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'><TR>
				<TH bgcolor='teal'><FONT color='white'>Nombre</FONT></TH>
				<TH bgcolor='teal'><FONT color='white'>Apellidos</FONT></TH>
				<TH bgcolor='teal'><FONT color='white'>Teléfono</FONT></TH>
				<TH bgcolor='teal' colspan='3'><FONT color='white'>Operaciones</FONT></TH>
				</TR>";

		foreach ($resultado as $valor) {
			echo "<TR>
				<TD><FONT size='-1'><B>$valor[Nombre]</B></FONT></TD>
				<TD><FONT size='-1'><B>$valor[Apellidos]</B></FONT></TD>
				<TD><FONT size='-1'><B>$valor[Telefono_oficina]</B></FONT></TD>";
			echo "<TD>". boton_ficticio("Consulta","index.php?operacion=introduce&ver=1&nume=$valor[registro]#ancla")."</TD>";
			echo "<TD>". boton_ficticio("Editar","index.php?operacion=introduce&ver=0&nume=$valor[registro]#ancla")."</TD>";
			echo "<TD>". boton_ficticio("Borrar","index.php?operacion=borrar&nume=$valor[registro]")."</TD></TR>";
		} // end bucle

		echo "</TABLE>";
	}
	
}
	
?>