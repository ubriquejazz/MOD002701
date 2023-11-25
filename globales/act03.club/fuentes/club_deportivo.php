<?

  function boton_ficticio($caption,$url)
  {
      return "<TABLE align=center border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
              <TR><TD bgcolor='white'><FONT size ='-1'><a href = '$url'>$caption</A></FONT></TD></TR></TABLE>";
  }
  
  function formateaFecha($fecha) {
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $matriz_fecha);
		return $matriz_fecha[3]."/".$matriz_fecha[2]."/".$matriz_fecha[1];
  }
  
  function checkFecha(& $fecha) {
		ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $fecha, $matriz_fecha);
		$fecha=$matriz_fecha[3]."-".$matriz_fecha[2]."-".$matriz_fecha[1];
		return checkdate($matriz_fecha[2],$matriz_fecha[1],$matriz_fecha[3]);
  }
	
  function checkEuros(& $euros) {
		$basu="";
		for ($i=0; $i<strlen($euros); $i++)
			if ($euros[$i]!=".") $basu.=$euros[$i];
		$basu=strtr($basu,",",".");
		$resultado = ( $basu == number_format((float)$basu,2,".","") );
		$euros=(float)$basu;
		return $resultado;
  }

  /******************************
  	    CLASE CLUB_DEPORTIVO
  ******************************/
  class club_deportivo {
  	
  	//var $datos, $id_conexion;
  	
  	function club_deportivo () //Esto es el constructor
  	{
  	  /*$DBHost="localhost";
  	  $DBUser="root";
  	  $DBPass="";
  	  $DB="ejercicios";*/
  	  
  	  $DBHost='10.10.110.11';
	  $DBUser='usuarioMCPHP';
	  $DBPass='CpHP1()2';
	  $DB='mentorCursoPHP';
  	  
  	  /* Intentamos establecer una conexión persistente con el servidor.*/
  	  $this->id_conexion =
  	  	@mysql_connect($DBHost, $DBUser, $DBPass) or
  	  		die("<CENTER><H3>No se ha podido establecer la conexi&oacute;n.
  	  			<P>Compruebe si est&aacute; activado el servidor de bases de datos MySQL.</H3></CENTER>");
  	  			
  	  /* Intentamos seleccionar la base de datos "ejercicios". Si no
  	  	se consigue, se informa de ello y se indica cuál es el
  	  	motivo del fallo con el número y el mensaje de error.*/
  	  if (!mysql_select_db($DB))
  	  	printf("<CENTER><H3>No se ha podido seleccionar la base de datos
  	  		'$DB': <P>%s",'Error n&deg; '.mysql_errno().'.-'.mysql_error());
	}//end function club_deportivo
	
	function _club_deportivo () //Esto es el destructor
	{
	  /* Liberamos la conexión persistente con el servidor.*/
	  if (isset($this->datos)) mysql_free_result($this->datos);
	  if (isset($this->id_conexion)) mysql_close($this->id_conexion);
	}//end destructor club_deportivo
	
	// Añadir una socio al club
	function add_socio($registro, $dni, $apellidos, $nombre, 
  	    					$domicilio, $localidad)
	{
	  //Buscamos si hay algun socio con DNI repetido
	  $this->datos = mysql_query("SELECT dni from socios WHERE dni=$dni and id<>$registro",$this->id_conexion);  	
    	  $filas = mysql_num_rows($this->datos);
    	  if ($filas>0){     			
    		die("<HR><font size=+1 color=red><b>ERROR: &iexcl;hay otro socio con el mismo DNI!</b></font>");    	  		
    	  }
	  
	  if ($registro>0) 
	    	$sql_script = "UPDATE socios SET 
	    			dni='$dni', apellidos='$apellidos', nombre='$nombre', 
	    			domicilio='$domicilio', localidad='$localidad'
	    		    WHERE id=$registro";
    	  else {    		
    		$sql_script = "INSERT INTO socios (dni, apellidos, nombre, domicilio, localidad)
    	  		         VALUES('$dni', '$apellidos', '$nombre', '$domicilio','$localidad')";
    	}    	  					
    	$this->datos = mysql_query($sql_script,$this->id_conexion);
    	$this->buscar("", "dni");
    }//end add_socio
    
    // Nº total de socios
    function nume_socios () {
    	  $sql_script = "SELECT * FROM socios";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  return mysql_num_rows($this->datos);
    }
    	
    // Borrar socio
    function del_socio($id_to_del) {
    	$sql_script = "delete FROM socios where id=$id_to_del";
    	$this->datos = mysql_query($sql_script,$this->id_conexion);    			
    	$sql_script = "delete FROM cuotas where id_socio=$id_to_del";
    	$this->datos = mysql_query($sql_script,$this->id_conexion);
    	$this->buscar("", "dni");
    }
    
    // Añadir o modificar socio
    function introduce($id_to_edit, $ver) {
    		
	$campos=array(	
    	   0=>array(0=>"dni",1=>"DNI",2=>9, 3=>9, 4=>""),
    	   1=>array(0=>"apellidos",1=>"Apellidos",2=>50, 3=>150, 4=>""),
    	   2=>array(0=>"nombre", 1=>"Nombre",2=>30, 3=>100, 4=>""),
    	   3=>array(0=>"domicilio",1=>"Domicilio",2=>50, 3=>150, 4=>""),
    	   4=>array(0=>"localidad",1=>"Localidad",2=>30, 3=>100, 4=>""));
    	   
    	 if ($id_to_edit>0) {
    	 	$sql_script = "SELECT dni, apellidos, nombre, domicilio, localidad
    	 				FROM socios where id='$id_to_edit'";
    	 			
    	 	$this->datos = @mysql_query($sql_script,$this->id_conexion)
    			or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
    					
    		$filas = mysql_num_rows($this->datos);
    		if ($filas==0) { //resultado query vacío
    	  	echo "<CENTER>
    	  		<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  		<TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    	  			<font size=+2>No se encuentra ning&uacute;n registro</font>
    	  		</TD></TR></TABLE></CENTER>";
    		}
    		else //la búsqueda no es vacía
    		{
    			$myrow = mysql_fetch_row($this->datos);
    			for ($i=0; $i < count($campos); $i++)
    				$campos[$i][4]=$myrow[$i];
    		}
    	}//end if $id_to_edit>0
    	
    	if ($ver==0) 
    	    echo "<FORM name='form9' method='post' action=\"index.php?operacion=exec_alta\">";
    	echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' align='center' width='600'>";
    				
    	for ($i=0; $i < count($campos); $i++){
    		echo "<TR><TD bgcolor='blue' align=center width=100>
    			<FONT color='white'>".$campos[$i][1]."</FONT>
    		 	  </TD><TD>";
    		if ($ver==1) 
    			echo "<B>". $campos[$i][4]."</B>"; 
    		else echo "<input type='text' name='".$campos[$i][0]."' size='".$campos[$i][2]."' value = \"".$campos[$i][4].
    					"\" maxlength='".$campos[$i][3]."'>";
    		echo "</TD>
    		</TR>";
    	}//for
    	echo "</TABLE><CENTER>";
    	
    	if ($ver==0) {
    		echo "<INPUT type='hidden' NAME='registro' value = '$id_to_edit'>";
    		if ($id_to_edit>0) //estamos modificando
    			echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Modificar socio\">";
    		else echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Alta socio\">";
    	}
    	// Si estamos viendo los datos del socio mostramos también las cuotas
    	if ($ver==1) {    		
    		$this->listar_cuotas($id_to_edit, -1, false);
    	}
    	echo "</CENTER>";
    	if ($ver==0) echo "</FORM>";	
    	
   }//end Añadir o modificar socio
   
   // Buscar socios
   function buscar($lo_q_busco, $campo_busqueda) {
   	$sql_script="SELECT * FROM socios 
   	  		WHERE ".$campo_busqueda." like '%".$lo_q_busco."%' 
   			ORDER BY ".$campo_busqueda;

   	$this->datos = @mysql_query($sql_script,$this->id_conexion)
   		or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   		
   	$filas = mysql_num_rows($this->datos);
   	if ($filas==0) { //resultado query vacío
   		echo "<CENTER>
   			<TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
   			<TR><TD ALIGN=CENTER VALIGN=CENTER>
   				<H2>No se encuentra ning&uacute;n registro</H2>
   			</TD></TR></TABLE></CENTER>";
   	}else //la búsqueda no es vacía
   	
   	   echo "<HR><TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'>
   	         <TR>
   	             <TH bgcolor='blue'><FONT color='white'>N&deg; socio </FONT></TH>
   	             <TH bgcolor='blue'><FONT color='white'>DNI</FONT></TH>
   	             <TH bgcolor='blue'><FONT color='white'>Apellidos</FONT></TH>
   	             <TH bgcolor='blue'><FONT color='white'>Nombre</FONT></TH>   	             
   	             <TH bgcolor='blue' width=110 colspan='4'><FONT color='white'>Operaciones</FONT></TH>
   	         </TR>";
		 while ( $myrow = mysql_fetch_row($this->datos))
		 {
		    echo "<TR>
		             <TD align=center><FONT size='-1'><B>".$myrow[0]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".$myrow[3]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD> 
		             <TD><FONT size='-1'><B>".$myrow[1]."</B></FONT></TD> 
		             <TD>".boton_ficticio("Consulta","index.php?operacion=introduce&ver=1&nume=".$myrow[0]."#ancla")."</TD>
			     <TD>".boton_ficticio("Editar","index.php?operacion=introduce&ver=0&nume=".$myrow[0]."#ancla")."</TD>
			     <TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$myrow[0])."</TD>
			     <TD>".boton_ficticio("Cuotas","index.php?operacion=cuotas&nume=".$myrow[0])."</TD>
			  </TR>";
		}
		echo "</TABLE><P>
		<TABLE><TR>
		     <TD><FONT color=blue size ='-1'>El n&deg; total de socios es: ".$this->nume_socios()."</FONT><P></TD>
		 </TR></TABLE>";
	}// END function Buscar socios
	
	// Listar cuotas
   function listar_cuotas($nume, $id_cuota, $editable) {
  		$sql_script="SELECT id,fecha, importe FROM cuotas where id_socio=$nume order by fecha";

   		$this->datos = @mysql_query($sql_script,$this->id_conexion)
   			or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   		
   		$importe=0;
   		echo "<HR><TABLE BORDER='0' cellspacing='2' cellpadding='0' align='center' width='400'>";
  		echo "<TR><TD bgcolor='blue' align=center width=100 colspan=4><FONT color='white'>Cuotas del socio n&deg; $nume</FONT></TD></TR>";
  		echo "<TR><TD><b>Fecha</b></TD><TD align=center><b>Importe</b></TD>";
  		if ($editable) echo "<TD width=100 colspan=2><b>Operaciones</b></TD>";
  		echo "</TR>";
   		
   		$filas = mysql_num_rows($this->datos);
   		if ($filas>0) { //resultado query no vacío   			  			
			while ( $myrow = mysql_fetch_row($this->datos)) {
				$importe+=$myrow[2];
				$myrow[1]=formateaFecha($myrow[1]);
				if (!$editable) echo "<TR><TD>".$myrow[1]."</TD><TD align=center>".$myrow[2]."</TD></TR>";
				else 
				{
				
				   if ($myrow[0]!=$id_cuota)
   					echo "<TR><TD>".$myrow[1]."</TD><TD>".$myrow[2]."</TD>
   					          <TD>".boton_ficticio("Editar","index.php?operacion=cuotas&nume=$nume&id_cuota=".$myrow[0])."</TD>
   						      <TD>".boton_ficticio("Borrar","index.php?operacion=baja_cuota&nume=$nume&id_cuota=".$myrow[0])."</TD>   						      
   					      </TR>";
   				   else
   					echo "<FORM method='post' action=\"index.php?operacion=gestiona_cuota&nume=$nume&id_cuota=$id_cuota\">
   						  <TR><TD><INPUT name=fecha type=text size=14 value=".$myrow[1]."></TD>
   					      	  <TD><INPUT name=importe type=text size=5 value=".$myrow[2]."></TD>
   						      <TD colspan=2><INPUT type=submit value=Guardar></TD>
   					      </TR></FORM>";   					
   			       }
   			}//while   					
   			
   		} //filas>0
   		if ($editable)  			
   		echo "<FORM method='post' action=\"index.php?operacion=gestiona_cuota&nume=$nume&id_cuota=-1\">
   		      <TR><TD><INPUT name=fecha type=text size=14 value=''></TD>
   				  <TD><INPUT name=importe type=text size=5 value=''></TD>
   				  <TD colspan=2><INPUT type=submit value=Alta></TD>
   			  </TR></FORM>";	
   		echo "</TABLE><P>El importe total es <b>$importe</b>";
   		
   } // Listar cuotas
   
   // Borrar cuota
    function baja_cuota($nume, $id_to_del) {
    	$sql_script = "delete FROM cuotas where id=$id_to_del";
    	$this->datos = mysql_query($sql_script,$this->id_conexion);
    	$this->listar_cuotas($nume, -1);
    }
    
    // Gestiona las cuotas
    function gestiona_cuota($nume, $id, $fecha, $importe){
    	$la_fecha=$fecha;
    	$el_importe=$importe;
  		if (!checkFecha($la_fecha)) die("<HR><font size=+1 color=red><b>ERROR: El formato de la fecha indicada es incorrecto (dd/mm/yyyy) o est&aacute; en blanco</b></font>");
  		if (!checkEuros($el_importe)) die("<HR><font size=+1 color=red><b>ERROR: El formato del importe indicado es incorrecto</b></font>");
  		if ($id<0)
  			$sql_script = "INSERT INTO cuotas (importe, fecha, id_socio)
    	  	   	           VALUES('$el_importe', '$la_fecha', '$nume')";
    	else $sql_script = "UPDATE cuotas SET 
	    			importe='$importe', fecha='$la_fecha'
	    		    WHERE id=$id";
    	$this->datos = mysql_query($sql_script,$this->id_conexion);
    	$this->listar_cuotas($nume, -1);
    }
	
  }//END clase club_deportivo
	
?>