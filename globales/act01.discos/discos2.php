<?php



	
	// A�adir una disco a la lista
	function add_disco ($registro, $titulo, $interprete, $estilo, $casa_discografica,
    	 				$formato, $duracion, $anio, $imagen)
	{	  
       	  if (isset($imagen) && ($imagen['size']>0)) {
       	  	// Si el tama�o del fichero es mayor de 80 Kb o est� vac�o,
       	  	// se muestra un mensaje y se abandona el script. 
	  	if ($imagen['size']>80000) 
	  		die ("<B>El fichero ocupa m&aacute;s de 80KB o no ha indicado
                                 su nombre en el formulario. No puede copiarse.</B>");
                 if (is_uploaded_file($imagen['tmp_name']) && !empty($imagen['tmp_name'])) {
                 	$tipo_fichero=explode("/", $imagen['type']);
                 	if ($tipo_fichero[0]=='image') {                 		
                 		// S�lo si hay una imagen nueva entonces miramos si hay que borrar el fichero jpg actual
                 		if ($registro>0) {
                 		    $sql_script = "SELECT imagen FROM discos where id='$registro'";    	 			
    				    $this->datos = @mysql_query($sql_script,$this->id_conexion)
    	               					or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
    					
    				    $filas = mysql_num_rows($this->datos);
    				    if ($filas==0) { //resultado query vac&iacute;o
    				    	echo "<CENTER>
    				    	      <TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    				    	      <TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    				    	      <font size=+2>No se encuentra ning&uacute;n registro</font>
    				    	      </TD></TR></TABLE></CENTER>";
    				    }
    				    else //la b&uacute;squeda no es vac&iacute;a
    				    {
    				    	$myrow = mysql_fetch_row($this->datos);
    				    	// S�lo buscamos si hay que borrar la imagen si el nombre ha cambiado
    				    	if ($imagen['name']<>$myrow[0]) {
    				    		$sql_script = "SELECT id FROM discos where imagen='".$myrow[0]."'";    	 			
    						$this->datos = @mysql_query($sql_script,$this->id_conexion)
    	               						or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");    					
    						if (mysql_num_rows($this->datos)==1) { @unlink("imagenes/".$myrow[0]);}
    					}
    				    }
    				 } // if registro>0
    				 
    				 //Movemos un fichero
    				 move_uploaded_file($imagen['tmp_name'], 'imagenes/'.$imagen['name']);                 		
                 		
                	} else die ("<B>S&oacute;lo se pueden subir ficheros de tipo imagen.</B>");
                } else die ("<B>No se puede subir el fichero.</B>");
	  } // end if isset
       
     
      
	  if ($registro>0) 
	    $sql_script = "UPDATE discos SET 
	    			titulo='$titulo', interprete='$interprete', estilo='$estilo', 
	    			casa_discografica='$casa_discografica', formato='$formato', 
	    			duracion='$duracion', anio='$anio', imagen='".$imagen['name']."'
	    		   WHERE id=$registro";
    	  else
    	    $sql_script = "INSERT INTO discos (titulo, interprete, estilo, casa_discografica,
    	 				formato, duracion, anio, imagen)
    	  		             VALUES('$titulo', '$interprete', '$estilo', '$casa_discografica',
    	 							'$formato', '$duracion', '$anio', '".$imagen['name']."')";
    	  					
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  $this->buscar("", "titulo");
    }//end add_disco
    
    // N� total de discos
    function nume_discos () {
    	  $sql_script = "SELECT * FROM discos";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  return mysql_num_rows($this->datos);
    }
    	
    // Borrar disco
    function del_disco($id_to_del) {
    	$sql_script = "SELECT imagen FROM discos where id='$id_to_del'";    	 			
    	$this->datos = @mysql_query($sql_script,$this->id_conexion)
    	               or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
    					
    	$filas = mysql_num_rows($this->datos);
    	if ($filas==0) { //resultado query vac&iacute;o
    	echo "<CENTER>
    	  	<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  	 <TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    	  		<font size=+2>No se encuentra ning&uacute;n registro</font>
    	  	 </TD></TR></TABLE></CENTER>";
    	}
    	else //la b&uacute;squeda no es vac&iacute;a
    	{
    		$myrow = mysql_fetch_row($this->datos);
    		$sql_script = "SELECT id FROM discos where imagen='".$myrow[0]."'";    	 			
    		$this->datos = @mysql_query($sql_script,$this->id_conexion)
    	               or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");    					
    		if (mysql_num_rows($this->datos)==1) { @unlink("imagenes/".$myrow[0]);}
    	}
    	
    	$sql_script = "delete FROM discos where id=$id_to_del";
    	$this->datos = mysql_query($sql_script,$this->id_conexion);    			
    	$this->buscar("", "titulo");
    }
    
    // A�adir o modificar disco
    function introduce($id_to_edit, $ver) {
    		
	$campos=array(	
    	   0=>array(0=>"titulo",1=>"T&iacute;tulo",2=>40, 3=>100, 4=>""),
    	   1=>array(0=>"interprete",1=>"Int&eacute;rprete",2=>30, 3=>50, 4=>""),
    	   2=>array(0=>"estilo", 1=>"Estilo",2=>30, 3=>50, 4=>""),
    	   3=>array(0=>"casa_discografica",1=>"Casa Discogr&aacute;fica",2=>30, 3=>50, 4=>""),
    	   4=>array(0=>"formato",1=>"Formato (CD/MC)",2=>30, 3=>50, 4=>""),
    	   5=>array(0=>"duracion",1=>"Duraci&oacute;n (min)",2=>3, 3=>3, 4=>""),
    	   6=>array(0=>"anio",1=>"A&ntilde;o prod.",2=>4, 3=>4, 4=>""),
    	   7=>array(0=>"imagen",1=>"Imagen",2=>15, 3=>-1, 4=>""));
    	   
    	 if ($id_to_edit>0) {
    	 	$sql_script = "SELECT titulo, interprete, estilo, casa_discografica,
    	 				formato, duracion, anio, imagen
    	 				FROM discos where id='$id_to_edit'";
    	 			
    	 	$this->datos = @mysql_query($sql_script,$this->id_conexion)
    			or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
    					
    		$filas = mysql_num_rows($this->datos);
    		if ($filas==0) { //resultado query vac&iacute;o
    	  	echo "<CENTER>
    	  		<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  		<TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    	  			<font size=+2>No se encuentra ning&uacute;n registro</font>
    	  		</TD></TR></TABLE></CENTER>";
    		}
    		else //la b&uacute;squeda no es vac&iacute;a
    		{
    			$myrow = mysql_fetch_row($this->datos);
    			for ($i=0; $i < count($campos); $i++)
    				$campos[$i][4]=$myrow[$i];
    		}
    	}//end if $id_to_edit>0
    	
    	if ($ver==0) 
    	    echo "<FORM name='form9' ENCTYPE=multipart/form-data method='post' action=\"index.php?operacion=exec_alta\">";
    	echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' align='center' width='600'>";
    				
    	for ($i=0; $i < count($campos); $i++){
    		echo "<TR><TD bgcolor='blue' align=center width=140>
    			<FONT size=-1 color='white'>".$campos[$i][1]."</FONT>
    		 	  </TD><TD>";
    		if ($ver==1) {
    		    if ($campos[$i][3]>-1) echo "<FONT size=-1><B>". $campos[$i][4]."</B></FONT>"; 
    		    else if ($campos[$i][4]<>'') echo "<IMG src='imagenes/". $campos[$i][4].">"; 
    		    else echo "<FONT size=-1><B>Sin imagen</B></FONT>"; 
    		} else 
    		if ($campos[$i][3]>-1)
    		     echo "<input type='text' name='".$campos[$i][0]."' size='".$campos[$i][2]."' value = \"".$campos[$i][4]."\" maxlength='".$campos[$i][3]."'>";
    		else echo "<input type='file' name='".$campos[$i][0]."' size='".$campos[$i][2]."'><INPUT TYPE='hidden' name='MAX_FILE_SIZE' VALUE='80000'>";
    		echo "</TD>
    		</TR>";
    	}//for
    	echo "</TABLE><CENTER>";
    	
    	if ($ver==0) {
    		echo "<INPUT type='hidden' NAME='registro' value = '$id_to_edit'>";
    		if ($id_to_edit>0) //estamos modificando
    			echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Modificar disco\">";
    		else echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Alta disco\">";
    	}
    	echo "</CENTER>";
    	if ($ver==0) echo "</FORM>";	
    	
   }//end A�adir o modificar disco
   
   // Buscar discos
	function buscar($lo_q_busco, $campo_busqueda) {
   		$sql_script="SELECT * FROM discos 
			WHERE ".$campo_busqueda." like '%".$lo_q_busco."%' ORDER BY ".$campo_busqueda;

		$this->datos = @mysql_query($sql_script,$this->id_conexion)
   		or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   		
   		$filas = mysql_num_rows($this->datos);
		if ($filas==0) { //resultado query vac&iacute;o
			echo "<CENTER>
				<TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
				<TR><TD ALIGN=CENTER VALIGN=CENTER>
					<H2>No se encuentra ning&uacute;n registro</H2>
				</TD></TR></TABLE></CENTER>";
		}
		else //la b&uacute;squeda no es vac&iacute;a
		
			echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'>
					<TR>
						<TH bgcolor='blue'><FONT color='white'>T&iacute;tulo</FONT></TH>
						<TH bgcolor='blue'><FONT color='white'>Int&eacute;rprete</FONT></TH>
						<TH bgcolor='blue'><FONT color='white'>Estilo</FONT></TH>
						<TH bgcolor='blue'><FONT color='white'>Casa Disco</FONT></TH>
						<TH bgcolor='blue' colspan='3'><FONT color='white'>Operaciones</FONT></TH>
					</TR>";
		 
		 while ($myrow = mysql_fetch_row($this->datos))
		 {
		    echo "<TR>
		             <TD><FONT size='-1'><B>".$myrow[1]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".$myrow[3]."</B></FONT></TD> 
		             <TD><FONT size='-1'><B>".$myrow[4]."</B></FONT></TD> 
		             <TD>".boton_ficticio("Consulta","index.php?operacion=introduce&ver=1&nume=".$myrow[0]."#ancla")."</TD>
			     <TD>".boton_ficticio("Editar","index.php?operacion=introduce&ver=0&nume=".$myrow[0]."#ancla")."</TD>
			     <TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$myrow[0])."</TD>
			  </TR>";
		}
		echo "</TABLE><P><TABLE><TR>
		    <TD><FONT color=blue size ='-1'>El n&deg; total de discos es: ".$this->nume_discos()."</FONT><P></TD>
		 	</TR></TABLE>";
	}

?>