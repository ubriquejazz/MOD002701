<?php

// Dibuja un botón sencillo mediante una tabla HTML
function boton_ficticio($caption,$url){
    return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=\"white\"><FONT size =\"-1\">
          <a href = \"$url\">$caption</A></FONT></TD></TR></TABLE>";
}

class rutas {

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

    function nume_rutas () {
        $sql_script = "select count(*) from hike_rutas";
        $resultado = $this->ejecuta_SQL($sql_script);
        $myrow = $resultado->fetchAll();
        return $myrow[0][0]; 
    }

    function buscar($lo_q_busco, $campo_busqueda, $desc=0) {

        $sql_script="SELECT * FROM hike_rutas WHERE ".$campo_busqueda." like '%".$lo_q_busco."%' ORDER BY ".$campo_busqueda;
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
                      <TH bgcolor='#0000C0'><FONT color='white'>Desnivel(m)</FONT></TH>
                      <TH bgcolor='#0000C0'><FONT color='white'>Distancia(Km)</FONT></TH>
                      <TH bgcolor='#0000C0'><FONT color='white'>Dificultad</FONT></TH>
                      <TH bgcolor='#0000C0' colspan='3'><FONT color='white'>Operaciones</FONT></TH>
                  </TR>";
        }
        $matriz = $resultado->fetchAll();
        foreach ($matriz as $myrow) {	
            echo "<TR>
                <TD><FONT size='-1'><B>".$myrow[1]."</B></FONT></TD>
                <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
                <TD><FONT size='-1'><B>".$myrow[3]."</B></FONT></TD> 
                <TD><FONT size='-1'><B>".$myrow[4]."</B></FONT></TD> 
                <TD><FONT size='-1'><B>".$myrow[5]."</B></FONT></TD> 
                <TD>";
            echo boton_ficticio("Comentar","index.php?operacion=introduce&ver=1&id=".$myrow[0]);
            echo "</TD><TD>";
            echo boton_ficticio("Editar","index.php?operacion=introduce&ver=0&id=".$myrow[0]);
            echo "</TD><TD>";
            echo boton_ficticio("Borrar","index.php?operacion=borrar&id=".$myrow[0])."</TD></TR>";
        }
        echo "</TABLE><P>";
    }

	function add_ruta ($id, $titulo, $descripcion, $desnivel, $distancia, $dificultad) {
	    if ($id>0) 
	        $sql_script = "UPDATE hike_rutas SET titulo='$titulo', descripcion='$descripcion', 
                desnivel='$desnivel', distancia='$distancia', dificultad='$dificultad' WHERE id=$id";
        else
    	    $sql_script = "INSERT INTO hike_rutas (titulo, descripcion, desnivel, distancia, dificultad)
                VALUES('$titulo', '$descripcion', '$desnivel', '$distancia', '$dificultad')";
    	// echo $sql_script;	
        $this->ejecuta_SQL($sql_script);
    }
    
    function add_comentario ($id, $nombre, $nota) {	  
        $sql_script = "INSERT INTO hike_comentarios (id_ruta, nombre, fecha, comentario)
            VALUES ('$id', '$nombre', now(), '$nota')";
        // echo $sql_script;
        $this->ejecuta_SQL($sql_script);
    }	

    function del_ruta($id_to_del) {
        $sql_script = "delete FROM hike_rutas where id=$id_to_del";
        $this->ejecuta_SQL($sql_script);   			
        $sql_script = "delete FROM hike_comentarios where id_ruta=$id_to_del";
        $this->ejecuta_SQL($sql_script);    			
        $this->buscar("", "id", 1);
    }
    
    function listado_comentarios($id) {
        echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' align='center' width='600'>
              <TR>
                  <TH bgcolor='#0000C0'><FONT color='white'>Nombre</FONT></TH>
                  <TH bgcolor='#0000C0'><FONT color='white'>Fecha </FONT></TH>
                  <TH bgcolor='#0000C0'><FONT color='white'>Comentario</FONT></TH>   	      	
              </TR>";
          
        echo "<FORM name='form9' method='post' action=\"index.php?operacion=exec_comentario\"><TR>
            <TD><input type='text' name='nombre' size='10' maxlength='10'></TD>
            <TD><FONT size='-1'><B>".date("j/m/Y")."</B></FONT></TD>
            <TD align=right>
            <INPUT type='text' NAME='nota' size='50' maxlength='50'>
            <INPUT type='hidden' NAME='id' value = '$id'>
            <INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Comentar\"></TD> 
            </TR></FORM>";

        $sql_script="SELECT * FROM hike_comentarios WHERE id_ruta = $id ORDER BY id DESC";
        $resultado = $this->ejecuta_SQL($sql_script);		
        $filas = $resultado->rowCount();         
        if ($filas>0) {
            $matriz = $resultado->fetchAll();
            foreach ($matriz as $myrow) {	
                echo "<TR>
                <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
                <TD><FONT size='-1'><B>".($myrow[3])."</B></FONT></TD>
                <TD><FONT size='-1'><B>".($myrow[4])."</B></FONT></TD> 		             
                </TR>";
            }
        }
        echo "</TABLE><P>";
    }

    // ver=0 alta/edit ruta; ver=1 comentar ruta
    function introduce($id_to_edit, $ver) {
	    $campos=array(
		    0=>array(0=>"titulo",1=>"T&iacute;tulo",2=>30, 3=>50, 4=>""),
    	   	1=>array(0=>"descripcion",1=>"Descripci&oacute;n",2=>70, 3=>254, 4=>""),
            2=>array(0=>"desnivel", 1=>"Desnivel",2=>7, 3=>8, 4=>"0"),
            3=>array(0=>"distancia", 1=>"Distancia",2=>7, 3=>8, 4=>"1.0"),
    	   	4=>array(0=>"dificultad", 1=>"Dificultad",2=>7, 3=>8, 4=>"0")
        );

        if ($id_to_edit>0) {
            $sql_script = "SELECT titulo, descripcion, desnivel, distancia, dificultad FROM hike_rutas where id='$id_to_edit'";
            $resultado = $this->ejecuta_SQL($sql_script);		
            $filas = $resultado->rowCount();

            if ($filas==0) { //resultado query vacio
                 echo "No se encuentran registro";
            }
            else {
                $myrow = $resultado->fetchAll();
                for ($i=0; $i < count($campos); $i++) {
                    $campos[$i][4] = $myrow[0][$i];
                }
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
                echo "<input type='text' name='".$campos[$i][0]."' size='".$campos[$i][2].
                    "' value = \"".$campos[$i][4]."\" maxlength='".$campos[$i][3]."'>";
    		echo "</TD></TR>";
    	}
        echo "</TABLE>"; 

        if ($ver==0) {
    		echo "<INPUT type='hidden' NAME='id' value = '$id_to_edit'>";
    		if ($id_to_edit>0) //estamos modificando
    			echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Modificar ruta\">";
    		else 
                echo "<INPUT TYPE='SUBMIT' NAME='pulsa' VALUE=\"Alta ruta\">
    			    <INPUT type='hidden' NAME='vendido' value = '0'>";
    	} 
        if ($ver==0) echo "</FORM>";
    }


}
?>