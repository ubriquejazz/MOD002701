<?php

function boton_ficticio($caption,$url){
	return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
			<TR><TD bgcolor='white'><FONT size ='-1'><a href = '$url'>$caption</A></FONT></TD></TR></TABLE>";
}

define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
	
class cine {
  	
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
			   $sql = file_get_contents('bbdd.sql');			 
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
	
	// A�adir un cine a la lista
	function add_cine($registro, $nombre_peli, $nombre_cine, $descripcion, $sesion1, $sesion2, $sesion3, $nume_filas, $nume_asientos)
	{
	  if ($registro>0) 
	    $sql_script = "UPDATE cine SET
					nombre_peli='$nombre_peli', nombre_cine='$nombre_cine', descripcion='$descripcion', 
					sesion1='$sesion1', sesion2='$sesion2', sesion3='$sesion3', nume_filas=$nume_filas, nume_asientos=$nume_asientos 
	    		    WHERE Id=$registro";
    	  else {
			  $sql_script = "INSERT INTO cine (nombre_peli, nombre_cine, descripcion, sesion1, sesion2, sesion3, nume_filas, nume_asientos)
    	  		             VALUES('$nombre_peli', '$nombre_cine', '$descripcion', '$sesion1', '$sesion2', '$sesion3', $nume_filas, $nume_asientos)";
		  }
    	  $this->ejecuta_SQL($sql_script);
    	  $this->buscar("");
	}
    
	// N� total de pel�culas
	function nume_cines () {
		$sql_script = "SELECT * FROM cine";
		$resultado=$this->ejecuta_SQL($sql_script);
    	return $resultado->rowCount();
	}
    	
	// Borrar cine
	function del_cine($id_to_del) {
    		$sql_script = "delete FROM cine where Id=$id_to_del";
    		$this->ejecuta_SQL($sql_script);
			$sql_script = "delete FROM cine_entradas where Id_cine=$id_to_del";
    		$this->ejecuta_SQL($sql_script);    			
    		$this->buscar("");
    }
    
    // A�adir o modificar cine
	function introduce($id_to_edit, $ver) {
    		
	   		$campos=array(	
    	    	0=>array(0=>"nombre_cine",1=>"Nombre del cine",2=>50, 3=>100, 4=>""),
    	    	1=>array(0=>"nombre_peli",1=>"Nombre de la pel&iacute;cula",2=>50, 3=>100, 4=>""),
    	    	2=>array(0=>"descripcion", 1=>"Descripci&oacute;n",2=>70, 3=>200, 4=>""),
    	    	3=>array(0=>"sesion1",1=>"Sesi&oacute;n 1 (hora)",2=>5, 3=>5, 4=>"16:00"),
	    		4=>array(0=>"sesion2",1=>"Sesi&oacute;n 2 (hora)",2=>5, 3=>5, 4=>"19:00"),
	    		5=>array(0=>"sesion3",1=>"Sesi&oacute;n 3 (hora)",2=>5, 3=>5, 4=>"22:00"),
    	    	6=>array(0=>"nume_filas",1=>"N� filas del cine",2=>2, 3=>2, 4=>10),
				7=>array(0=>"nume_asientos",1=>"N� asientos del cine",2=>2, 3=>2, 4=>10));
    	   
    	   if ($id_to_edit>0) {
    	 	$sql_script = "SELECT nombre_cine, nombre_peli, descripcion, sesion1, sesion2, sesion3, 
    	    			   nume_filas, nume_asientos 
						   FROM cine where id='$id_to_edit'";
    	 			
    	 	$resultado=$this->ejecuta_SQL($sql_script);
    		//	or die ("<CENTER><H2>Error al consultar la base de datos</H2></CENTER>");		
    		$filas = $resultado->rowCount();
    		if ($filas==0) { //resultado query vac�o
    	  	echo "<CENTER>
    	  		<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' 
    	  				bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  		<TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    	  			<font size=+2>No se encuentra ning�n registro</font>
    	  		</TD></TR></TABLE></CENTER>";
    		}
    		else //la b�squeda no es vac�a
    		{
    			$myrow = $resultado->fetchAll();
    			for ($i=0; $i < count($campos); $i++)
    				$campos[$i][4]=substr($myrow[$i], 0, $campos[$i][3]);
    		}
    	   }//end if $id_to_edit>0
    	
    	   if ($ver==0) echo "<FORM name='form9' method='post' action='index.php?operacion=exec_alta'>";
    	  
    	   echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' align='center' width='600'>";
		  	
    	   for ($i=0; $i < count($campos); $i++){
    		echo "<TR><TD bgcolor='green' align=center width=130><FONT size=-1 color='white'>".$campos[$i][1]."</FONT></TD><TD>";
    		if ($ver==1) echo "<FONT size=-1><B>". $campos[$i][4]."</B></FONT>"; 
    		else echo "<input type='text' name='".$campos[$i][0]."' size='".$campos[$i][2]."' value = \"".$campos[$i][4].
    					"\" maxlength='".$campos[$i][3]."'>";
    		echo "</TD>
    		</TR>";
    	   }//for
    	   echo "</TABLE><CENTER>";
    	
    	   if ($ver==0) {
    		echo "<INPUT type='hidden' NAME='registro' value = '$id_to_edit'>";
    		if ($id_to_edit>0) //estamos modificando
    			echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Modificar cine\">";
    		else echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Alta cine\">";
    	   }
    	   echo "</CENTER>";
    	   if ($ver==0) echo "</FORM>";	
    	
    }//end A�adir o modificar cine
   
	// Buscar pelicula
    function buscar($lo_q_busco) {
        	
 	   	$sql_script="SELECT Id, nombre_cine, nombre_peli, descripcion  FROM cine 
			WHERE nombre_peli like '%".$lo_q_busco."%' ORDER BY nombre_cine";
   	
		$resultado=$this->ejecuta_SQL($sql_script);
   		//or die ("<CENTER><H2>Error al consultar la base de datos: ".$sql_script.".</H2></CENTER>");
   	   	$filas = $resultado->rowCount();
   	   	if ($filas==0) { //resultado query vac�o
   		echo "<CENTER>
   			<TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
   			<TR><TD ALIGN=CENTER VALIGN=CENTER><H2>No se encuentra ning�n registro</H2>
   			</TD></TR></TABLE></CENTER>";
   	   }else //la b�squeda no es vac�a
   	
   		echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='800'>
			<TR>
			  <TH bgcolor='green'><FONT color='white'>Nombre cine</FONT></TH>
			  <TH bgcolor='green'><FONT color='white'>Pel&iacute;cula</FONT></TH>
			  <TH bgcolor='green' width=450><FONT color='white'>Descripci&oacute;n</FONT></TH>			  
			  <TH bgcolor='green' colspan='4'><FONT color='white'>Operaciones</FONT></TH>
			</TR>";
		
		foreach ($resultado as $valor) {
		{
		   echo "<TR>
		   	   <TD><FONT size='-1'><B>".$valor[1]."</B></FONT></TD>
		   	   <TD><FONT size='-1'><B>".$valor[2]."</B></FONT></TD>
		   	   <TD><FONT size='-1'><B>".$valor[3]."</B></FONT></TD> 
		   	   <TD>".boton_ficticio("Consulta","index.php?operacion=introduce&ver=1&nume=".$valor[0]."#ancla")."</TD>
		   	   <TD>".boton_ficticio("Editar","index.php?operacion=introduce&ver=0&nume=".$valor[0]."#ancla")."</TD>
		   	   <TD>".boton_ficticio("Comprar","index.php?operacion=comprar&sesion=1&nume=".$valor[0]."&dia=0#ancla")."</TD>		   	   
		   	   <TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$valor[0])."</TD>
		   	 </TR>";
		}
		echo "</TABLE><P>
		<TABLE><TR>
		   <TD><FONT color=green size ='-1'>El n� total de pel�culas es: ".$this->nume_cines()."</FONT><P></TD>
		 </TR></TABLE>";
	}//END function Buscar pelicula
	
	// Funci�n que dibuja el cine (Bot�n comprar del listado de cines/pel�culas)
	function comprar($Id, $sesion, $dia) {
		if (ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $dia, $regs)) 
			$fecha=$regs[3]."-".$regs[2]."-".$regs[1];
		else {
			$dia=date("j/n/Y"); 
			$fecha=date("Y-m-d");
		} 
		$sql_script = "SELECT nombre_cine, nombre_peli, nume_filas, 
			nume_asientos, sesion1, sesion2, sesion3 FROM cine where Id='$Id'";
    	
		$reultado=$this->ejecuta_SQL($sql_script);
    	//	or die ("<CENTER><H2>Error al consultar la base de datos</H2></CENTER>");			
		$filas = $resultado->rowCount();
    	if ($filas==0) { //resultado query vac�o
    		echo "<CENTER>
    	  		<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' 
    	  				bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  		<TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    	  			<font size=+2>No se encuentra ning�n registro</font>
    	  		</TD></TR></TABLE></CENTER>";
    		} 
		else { //Se puede dibujar las butacas del cine.
			$myrow = $resultado->fetchAll();
			echo "<A name=ancla><HR>
			      <TABLE BORDER='0' cellspacing='5' cellpadding='0' align='center' width='600'>
    			  	  <TR>
				  	<TD bgcolor='green' align=center width=130><FONT size=-1 color='white'>Nombre cine</FONT></TD>
					<TD><FONT size=-1><B>". $myrow[0]."</B></FONT></TD>
					<TD bgcolor='green' align=center width=130><FONT size=-1 color='white'>Nombre pel�cula</FONT></TD>
					<TD><FONT size=-1><B>". $myrow[1]."</B></FONT></TD>
				  </TR><TR>
				  	<TD bgcolor='green' align=center width=130><FONT size=-1 color='white'>Sesi�n</FONT></TD>
				  	<FORM name='comprar' method='post' action='index.php?operacion=comprar&nume=$Id#ancla'>
					<TD colspan=3>
						Hora <SELECT name=sesion>
							<OPTION value=1>". substr($myrow[4], 0, 5). "</OPTION>
							<OPTION value=2"; if ($sesion==2) echo " selected"; echo">". substr($myrow[5], 0, 5). "</OPTION>
							<OPTION value=3"; if ($sesion==3) echo " selected"; echo">". substr($myrow[6], 0, 5). "</OPTION>
						</SELECT> 
						D�a <input type='text' name='dia' size='12' value ='$dia' maxlength='10'> 
						<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Cambiar sesi�n\">					
					</TD>
					</FORM>
				  </TR>
			      </TABLE><CENTER>";
			echo "<TABLE BORDER='0' cellspacing='1' cellpadding='0' align='center' width='100'>
				  <TR><TD align=center>Pantalla<BR><HR></TD></TR>
			      </TABLE>";
				
			echo "<TABLE BORDER='0' cellspacing='3' cellpadding='0' align='center'>";
			for($i=1; $i<=$myrow[2]; $i++) {
				echo "<TR>";
				for($j=1; $j<=$myrow[3]; $j++) {
					$sql_script = "SELECT Id FROM cine_entradas WHERE Id_cine='$Id' and sesion='$sesion' and fila=$i and asiento=$j and dia='$fecha'";
    	 			
					$resultado=$this->ejecuta_SQL($sql_script);
					// or die ("<CENTER><H2>Error al consultar la base de datos</H2></CENTER>");
					$filas = $resultado->rowCount();
					if ($filas==0) {echo "<TD bgcolor=lime>"; $accion=1;}
					else { echo "<TD bgcolor=red>"; $accion=0;}
					echo "<A href=index.php?operacion=exec_comprar&Id=$Id&sesion=$sesion&fila=$i&asiento=$j&accion=$accion&dia=$dia#ancla>
							  <img alt='Comprar/Devolver' src=1px.gif height=10 width=10 border=1></A></TD>";
				} // end for $j
				echo "</TR>";
			} // end for $i
			echo "</TABLE>";
		}//else. End se puede dibujar las butacas del cine.
	} //end funci�n comprar
	
	// Funci�n que marca/desmarca en base de datos la reserva de entradas
	function exec_comprar($Id, $sesion, $fila, $asiento, $accion, $dia){
		if (ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $dia, $regs)) 
			$fecha=$regs[3]."-".$regs[2]."-".$regs[1];
		else exit;
		if ($accion==1)
			$sql_script = "INSERT INTO cine_entradas (Id_cine, sesion, fila, asiento, dia)
    	  			       VALUES('$Id', '$sesion', '$fila', '$asiento', '$fecha')";
		else $sql_script = "DELETE from cine_entradas 
							WHERE Id_cine='$Id' and sesion='$sesion' and fila=$fila and asiento=$asiento and dia='$fecha'";
		$this->ejecuta_SQL($sql_script);
    	//		or die ("<CENTER><H2>Error al consultar la base de datos</H2></CENTER>");
		$this->comprar($Id, $sesion, $dia);		
	} //end funci�n exec_comprar
	
  }//END clase cine
	
?>

