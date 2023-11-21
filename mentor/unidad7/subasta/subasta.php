<?php

  function boton_ficticio($caption,$url)
  {
      return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
              <TR><TD bgcolor='white'><FONT size ='-1'><a href = '$url'>$caption</A></FONT></TD></TR></TABLE>";
  }
  
  function formateaFecha($fecha) {
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $matriz_fecha);
	return $matriz_fecha[3]."/".$matriz_fecha[2]."/".$matriz_fecha[1];
  }
  
  function formateaEuros($euros) {
  	return str_replace(".", ",", $euros);	
  }  
  
  function checkEuros(&$euros) {
  	$basu="";
  	for ($i=0; $i<strlen($euros); $i++)
  		if ($euros[$i]!=".") $basu.=$euros[$i];
  	$basu=strtr($basu,",",".");
  	$resultado = ( $basu == number_format((float)$basu,2,".","") );
  	$euros=(float)$basu;
  	return $resultado;
  }
	
  class subasta {
  	
  	private $datos;
  	private $id_conexion;
  	
  	function subasta () //Esto es el constructor
  	{
	  $DBHost="localhost";
	  $DBUser="root";
	  $DBPass="";
	  $DB="ejercicios";
	  
	 /* $DBHost='10.10.110.11';
	  $DBUser='usuarioMCPHP';
	  $DBPass='CpHP1()2';
	  $DB='mentorCursoPHP';*/
  	  
  	  /* Intentamos establecer una conexi�n con el servidor MySQL.*/
  	  $this->id_conexion =
  	  	@mysql_connect($DBHost, $DBUser, $DBPass) or
  	  		die("<CENTER><H3>No se ha podido establecer la conexi�n.
  	  			<P>Compruebe si est&aacute; activado el servidor de bases de datos MySQL.</H3></CENTER>");
  	  			
  	  /* Intentamos seleccionar la base de datos "examenes". Si no
  	     se consigue, se informa de ello y se indica cual es el
  	     motivo del fallo con el n�mero y el mensaje de error.*/
  	  if (!mysql_select_db($DB))
  	  	printf("<CENTER><H3>No se ha podido seleccionar la base de datos
  	  		\"$DB\": <P>%s",'Error n� '.mysql_errno().'.-'.mysql_error());
	}//end function subasta
	
	// A�adir un articulo a la lista
	function add_articulo ($id, $titulo, $descripcion, $precio_inicial, $vendido)
	{
	  if ($id>0) 
	    $sql_script = "UPDATE subasta_articulos SET 
	    			titulo='$titulo', descripcion='$descripcion', 
	    			precio_inicial='$precio_inicial', vendido='$vendido'
	    			WHERE id=$id";
    	  else
    	    $sql_script = "INSERT INTO subasta_articulos (titulo, descripcion, precio_inicial, fecha_publicacion, vendido)
    	  		           VALUES('$titulo', '$descripcion', '$precio_inicial', now(), 0)";
    	  					
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  $this->buscar("", "id", 1);
    	}//end add_articulo
    
    	//Pujar por un art�culo
    	function add_puja ($id, $nombre, $importe)
	{	  
	  $sql_script = "INSERT INTO subasta_pujas (id_articulo, nombre, fecha, importe)
    	  		 VALUES('$id', '$nombre', now(), '$importe')";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  $this->buscar("", "id", 1);
    	}//end add_puja
    
    	// N� total de art�culos
    	function nume_articulos () {
    	  $sql_script = "select count(*) from subasta_articulos";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  $myrow = mysql_fetch_row($this->datos);
    	  return $myrow[0]; 
    	}
    	
    	// Devuelve el art�culo m�s caro
    	function articulo_mas_caro () {
    	  $sql_script = "select max(precio_inicial) from subasta_articulos";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);
    	  $myrow = mysql_fetch_row($this->datos);
    	  return $myrow[0]; 
    	}
    	
    	// Borrar art�culo con sus pujas
    	function del_articulo($id_to_del) {
    	  $sql_script = "delete FROM subasta_articulos where id=$id_to_del";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);    			
    	  $sql_script = "delete FROM subasta_pujas where id_articulo=$id_to_del";
    	  $this->datos = mysql_query($sql_script,$this->id_conexion);    			
    	  $this->buscar("", "id", 1);
    	}
    
    	// A�adir o modificar art�culo. El campo ver se usa para distinguir si un art�culo est� vendido o no para mostrar sus datos.
    	function introduce($id_to_edit, $ver) {
    		
	   $campos=array(
		0=>array(0=>"titulo",1=>"T&iacute;tulo",2=>30, 3=>50, 4=>""),
    	   	1=>array(0=>"descripcion",1=>"Descripci&oacute;n",2=>70, 3=>254, 4=>""),
    	   	2=>array(0=>"precio_inicial", 1=>"Precio inicial",2=>7, 3=>8, 4=>""));
    	   
    	   
    	    if ($id_to_edit>0) {
    	 	$sql_script = "SELECT titulo, descripcion, precio_inicial, vendido  
    	 				FROM subasta_articulos where id='$id_to_edit'";
    	 			
    	 	$this->datos = @mysql_query($sql_script,$this->id_conexion)
    			or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
    					
    		$filas = mysql_num_rows($this->datos);
    		if ($filas==0) { //resultado query vac�o
    	  	echo "<CENTER>
    	  		<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  		<TR><TD ALIGN=CENTER VALIGN=MIDDLE>
    	  			<font size=+2>No se encuentra ning&uacute;n registro</font>
    	  		</TD></TR></TABLE></CENTER>";
    		}
    		else //la busqueda no es vacia
    		{
    			$myrow = mysql_fetch_row($this->datos);
    			for ($i=0; $i < count($campos); $i++)
    				$campos[$i][4]=$myrow[$i];
    			$campos[2][4]=formateaEuros($myrow[2]); // formateamos precio inicial
    		}
    	   }//end if $id_to_edit>0
    	
    	   if ($ver==0)
    	      echo "<FORM name='form9' method='post' action=\"index.php?operacion=exec_alta\">";
    	   echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' align='center' width='600'>";
    				
    	   for ($i=0; $i < count($campos); $i++){
    		echo "<TR><TD bgcolor='#0000C0' align=center width=140>
    			<FONT color='white'>".$campos[$i][1]."</FONT>
    		 	  </TD><TD>";
    		if ($ver>0) 
    			echo "<FONT><B>". $campos[$i][4]."</B></FONT>"; 
    		else echo "<input type='text' name='".$campos[$i][0]."' size='".$campos[$i][2]."' value = \"".$campos[$i][4].
    					"\" maxlength='".$campos[$i][3]."'>";
    		echo "</TD>
    		</TR>";
    	   }//for
    	    	
    	   if ($ver==0) {
    		if ($id_to_edit>0) { //estamos modificando
    			echo "<TR><TD bgcolor='#0000C0' align=center width=140>
    				<FONT color='white'>Vendido</FONT>
    		 	  	</TD><TD>";
    			echo "<select name='vendido'>
    				<OPTION value=0>NO</OPTION>
    				<OPTION value=1";
    				if ($myrow[3]==1) echo " selected";
    				echo ">SI</OPTION>
    		      	</select>";
    			echo "</TD></TR>";
    		}
    		echo "</TABLE>";    		
    		
    		echo "<CENTER><INPUT type='hidden' NAME='id' value = '$id_to_edit'>";
    		if ($id_to_edit>0) //estamos modificando
    			echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Modificar art&iacute;culo\">";
    		else echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Alta art&iacute;culo\">
    			   <INPUT type='hidden' NAME='vendido' value = '0'>";
    		echo "</CENTER>";
    	   } else echo "</TABLE>";
    	   if ($ver==0) echo "</FORM>";	
    	
   	}//end A�adir o modificar art�culo
   
   	// Buscar subasta
   	function buscar($lo_q_busco, $campo_busqueda, $desc=0) {
   	   $sql_script="SELECT * FROM subasta_articulos 
   	  		WHERE ".$campo_busqueda." like '%".$lo_q_busco."%' 
   			ORDER BY ".$campo_busqueda;
   	   if ($desc==1) $sql_script.=" DESC";

   	   $this->datos = @mysql_query($sql_script,$this->id_conexion)
   			  or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   		
   	   $filas = mysql_num_rows($this->datos);
   	   if ($filas==0) { //resultado query vac�o
   		echo "<CENTER>
   			<TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
   			<TR><TD ALIGN=CENTER VALIGN=CENTER>
   				<H2>No se encuentra ning&uacute;n registro</H2>
   			</TD></TR></TABLE></CENTER>";
   	   }else //la b�squeda no es vac�a
   	
   	   echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'>
   	         <TR>
   	             <TH bgcolor='#0000C0'><FONT color='white'>T&iacute;tulo</FONT></TH>
   	             <TH bgcolor='#0000C0'><FONT color='white'>Descripci&oacute;n</FONT></TH>
   	             <TH bgcolor='#0000C0'><FONT color='white'>Fecha alta</FONT></TH>
   	             <TH bgcolor='#0000C0'><FONT color='white'>Precio inicial</FONT></TH>
   	             <TH bgcolor='#0000C0' colspan='3'><FONT color='white'>Operaciones</FONT></TH>
   	         </TR>";
		 while ( $myrow = mysql_fetch_row($this->datos))
		 {		    
		    echo "<TR>
		             <TD><FONT size='-1'><B>".$myrow[1]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".formateaFecha($myrow[3])."</B></FONT></TD> 
		             <TD><FONT size='-1'><B>".formateaEuros($myrow[4])."</B></FONT></TD> 
		             <TD>";
		             if ($myrow[5]==0) echo  boton_ficticio("Pujar","index.php?operacion=introduce&ver=1&id=".$myrow[0]."#ancla");
		             else echo "<a href=index.php?operacion=introduce&ver=2&id=".$myrow[0]."#ancla><FONT color='red'>&iexcl;Vendido!</FONT></a>";
		             
		             echo "</TD>
			     <TD>".boton_ficticio("Editar","index.php?operacion=introduce&ver=0&id=".$myrow[0]."#ancla")."</TD>
			     <TD>".boton_ficticio("Borrar","index.php?operacion=borrar&id=".$myrow[0])."</TD>
			  </TR>";
		}
		echo "</TABLE><P>
		<TABLE><TR>
		     <TD><FONT color=#0000C0 size ='-1'>El n&deg; total de art&iacute;culos es: <b>".$this->nume_articulos()."</b></FONT><P></TD>
		</TR><TR>
		     <TD><FONT color=#0000C0 size ='-1'>El art&iacute;culo con mayor precio de salida es: <b>".formateaEuros($this->articulo_mas_caro())."</b></FONT><P></TD>
		 </TR></TABLE>";
	}//END function Buscar articulo
	
	
   	// Buscar pujas
   	function listado_pujas($id, $vendido) {
   	
   	    $sql_script="SELECT * FROM subasta_pujas
   	   		 WHERE id_articulo = $id 
   			 ORDER BY id DESC";

   	   $this->datos = @mysql_query($sql_script,$this->id_conexion)
   			  or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   		
   	   $filas = mysql_num_rows($this->datos);
   	
   	
   	    echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'>
   	          <TR>
   	      	    <TH bgcolor='#0000C0'><FONT color='white'>Nombre</FONT></TH>
   	      	    <TH bgcolor='#0000C0'><FONT color='white'>Fecha puja</FONT></TH>
   	      	    <TH bgcolor='#0000C0'><FONT color='white'>Importe</FONT></TH>   	      	
   	          </TR>";
   	      
   	   if ($vendido==0) // Si el objeto no est� vendido entonces podemos pujar.
   	     echo "<FORM name='form9' method='post' action=\"index.php?operacion=exec_puja\"><TR>
   		   <TD><input type='text' name='nombre' size='50' maxlength='50'></TD>
   		   <TD><FONT size='-1'><B>".date("j/m/Y")."</B></FONT></TD>
   		   <TD align=right><INPUT type='text' name='importe' size='7' maxlength='7'>
   		  		   <INPUT type='hidden' NAME='id' value = '$id'>
   				   <INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Pujar\"></TD> 
   	           </TR></FORM>";
   	         
   	   if ($filas>0)  //resultado query no vacio
   		while ( $myrow = mysql_fetch_row($this->datos))
   		{		    
   			echo "<TR>
		             <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".formateaFecha($myrow[3])."</B></FONT></TD>
		             <TD><FONT size='-1'><B>".formateaeuros($myrow[4])."</B></FONT></TD> 		             
			  </TR>";
		}//end while
	   echo "</TABLE><P>";
	   if ($vendido==0) //Si el objeto no est� vendido mostramos informaci�n al usuario del precio m�nimo de puja
	      echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'><TR><TD align=center>
		        La puja debe ser mayor que ".formateaeuros($this->precio_ult_puja($id, 1))." euros.</TD>
		    </TR></TABLE>";
		    
	}//END function listado pujas
	
	//Calcula el precio de la �ltima puja o devuelve el importe inicial
	function precio_ult_puja($id, $devuelve_precio_inicial) {
		$sql_script="select max(importe) from subasta_pujas where id_articulo=".$id;
		$this->datos = @mysql_query($sql_script,$this->id_conexion)
   			or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   		$filas = mysql_num_rows($this->datos);
   		$myrow = mysql_fetch_row($this->datos);
   		if ($filas>0 && $myrow[0]!="") {   			
   			return $myrow[0];
   		}
   		else 
   		if ($devuelve_precio_inicial==0) return 0;
   		else {
   			$sql_script="select precio_inicial from subasta_articulos where id=".$id;   			
			$this->datos = @mysql_query($sql_script,$this->id_conexion)
   				or die ("<CENTER><H2>Error al consultar la base de datos.</H2></CENTER>");
   			$filas = mysql_num_rows($this->datos);
   			$myrow = mysql_fetch_row($this->datos);
   			return $myrow[0];
   		}		
	} //Calcula el precio de la �ltima puja	
		
	
  }//END clase subasta
	
?>

