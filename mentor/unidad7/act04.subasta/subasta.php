<?php

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

// Dibuja un botón sencillo mediante una tabla HTML
function boton_ficticio($caption,$url){
    return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=\"white\"><FONT size =\"-1\">
          <a href = \"$url\">$caption</A></FONT></TD></TR></TABLE>";
}

class subasta {
  	
    protected $db;
    
    function __construct() {
        $DBHost="localhost";
        $DBUser="root";
        $DBPass="";
        $DB="ejercicios";
      
        try {
            $this->db = new PDO("mysql:host=" . $DBHost. ";dbname=" . $DB. ";charset=utf8", 
                $DBUser, $DBPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,  true);
            $this->db->setAttribute(PDO::NULL_TO_STRING, true);
        } 
        catch (PDOException $e) {
            die ("<p><H3>No se ha podido establecer la conexión.
            <P>Compruebe si está activado el servidor de bases de datos MySQL.</H3></p>\n <p>Error: " . 
            $e->getMessage() . "</p>\n");
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
	
    function nume_articulos () {
        $sql_script = "select count(*) from subasta_articulos";
        $resultado = $this->ejecuta_SQL($sql_script);
        $myrow = $resultado->fetchAll();
        return $myrow[0][0]; 
    }

    function buscar($lo_q_busco, $campo_busqueda, $desc=0) {

        $sql_script="SELECT * FROM subasta_articulos WHERE ".$campo_busqueda." like '%".$lo_q_busco."%' ORDER BY ".$campo_busqueda;
        if ($desc==1) $sql_script.=" DESC";

        $resultado = $this->ejecuta_SQL($sql_script);
        $filas = $resultado->rowCount();
        if ($filas==0) { //resultado query vacio
            echo "<CENTER>
                 <TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
                 <TR><TD ALIGN=CENTER VALIGN=CENTER><H2>No se encuentran registro</H2>
                 </TD></TR></TABLE></CENTER>";
        }
        else {
            echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'>
                  <TR>
                      <TH bgcolor='#0000C0'><FONT color='white'>T&iacute;tulo</FONT></TH>
                      <TH bgcolor='#0000C0'><FONT color='white'>Descripci&oacute;n</FONT></TH>
                      <TH bgcolor='#0000C0'><FONT color='white'>Fecha alta</FONT></TH>
                      <TH bgcolor='#0000C0'><FONT color='white'>Precio inicial</FONT></TH>
                      <TH bgcolor='#0000C0' colspan='3'><FONT color='white'>Operaciones</FONT></TH>
                  </TR>";
        }
        $matriz = $resultado->fetchAll();
        foreach ($matriz as $myrow) {	
            echo "<TR>
                <TD><FONT size='-1'><B>".$myrow[1]."</B></FONT></TD>
                <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
                <TD><FONT size='-1'><B>".($myrow[3])."</B></FONT></TD> 
                <TD><FONT size='-1'><B>".formateaEuros($myrow[4])."</B></FONT></TD> 
                <TD>";
            if ($myrow[5]==0) 
                echo  boton_ficticio("Pujar","index.php?operacion=introduce&ver=1&id=".$myrow[0]."#ancla");
            else 
                echo "<a href=index.php?operacion=introduce&ver=2&id=".$myrow[0]."#ancla><FONT color='red'>&iexcl;Vendido!</FONT></a>";
            
            echo "</TD>
                <TD>".boton_ficticio("Editar","index.php?operacion=introduce&ver=0&id=".$myrow[0]."#ancla")."</TD>
                <TD>".boton_ficticio("Borrar","index.php?operacion=borrar&id=".$myrow[0])."</TD></TR>";
        }
        echo "</TABLE><P>";
    }

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
    	  			
        $this->ejecuta_SQL($sql_script);
        $this->buscar("", "id", 1);
    }
    
    //Pujar por un art�culo
    function add_puja ($id, $nombre, $importe)
	{	  
	    $sql_script = "INSERT INTO subasta_pujas (id_articulo, nombre, fecha, importe)
    	  		 VALUES('$id', '$nombre', now(), '$importe')";
        $this->ejecuta_SQL($sql_script);
        $this->buscar("", "id", 1);
    }	

    // Borrar art�culo con sus pujas
    function del_articulo($id_to_del) {
        $sql_script = "delete FROM subasta_articulos where id=$id_to_del";
        $this->ejecuta_SQL($sql_script);   			
        $sql_script = "delete FROM subasta_pujas where id_articulo=$id_to_del";
        $this->ejecuta_SQL($sql_script);    			
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
    	 	$resultado = $this->ejecuta_SQL($sql_script);		
    		$filas = $resultado->rowCount();
    		if ($filas==0) { //resultado query vacio
    	  	    echo "<CENTER>
    	  		<TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
    	  		<TR><TD ALIGN=CENTER VALIGN=MIDDLE><font size=+2>No se encuentran registro</font>
    	  		</TD></TR></TABLE></CENTER>";
    		}
    		else //la busqueda no es vacia
    		{
    			$myrow = $resultado->fetchAll();
    			for ($i=0; $i < count($campos); $i++) {
                    $campos[$i][4]=$myrow[$i];
                }
    			$campos[2][4]=formateaEuros($myrow[2]); // formateamos precio inicial
    		}
    	}//end if $id_to_edit>0
    	
    	if ($ver==0)
    	      echo "<FORM name='form9' method='post' action=\"index.php?operacion=exec_alta\">";
    	echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' align='center' width='600'>";
    				
    	for ($i=0; $i < count($campos); $i++){
    		echo "<TR><TD bgcolor='#0000C0' align=center width=140>
    			<FONT color='white'>".$campos[$i][1]."</FONT></TD><TD>";
    		if ($ver>0) 
    			echo "<FONT><B>". $campos[$i][4]."</B></FONT>"; 
    		else 
                echo "<input type='text' name='".$campos[$i][0].
                    "' size='".$campos[$i][2]."' value = \"".$campos[$i][4]."\" maxlength='".$campos[$i][3]."'>";
    		echo "</TD></TR>";
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
    	} 
        else echo "</TABLE>";
        if ($ver==0) echo "</FORM>";
   	}
   
    //Calcula el precio de la �ltima puja o devuelve el importe inicial
	function precio_ult_puja($id, $devuelve_precio_inicial) {
		$sql_script="select max(importe) from subasta_pujas where id_articulo=".$id;    
        return 0;	
	}
       
    function listado_pujas($id, $vendido) {
   	
        $sql_script="SELECT * FROM subasta_pujas WHERE id_articulo = $id  ORDER BY id DESC";
        $resultado = $this->ejecuta_SQL($sql_script);		
        $filas = $resultado->rowCount();
    
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
             
        if ($filas>0) {
            $matriz = $resultado->fetchAll();
            foreach ($matriz as $myrow) {	
                echo "<TR>
                <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
                <TD><FONT size='-1'><B>".($myrow[3])."</B></FONT></TD>
                <TD><FONT size='-1'><B>".formateaeuros($myrow[4])."</B></FONT></TD> 		             
                </TR>";
            }
        }

        echo "</TABLE><P>";
        if ($vendido==0) //Si el objeto no est� vendido mostramos informaci�n al usuario del precio m�nimo de puja
            echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='650'><TR><TD align=center>
             La puja debe ser mayor que ".formateaeuros($this->precio_ult_puja($id, 1))." euros.</TD></TR></TABLE>";
         
    }

      
}// end class

?>
