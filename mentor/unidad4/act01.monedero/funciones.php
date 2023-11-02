<?php

    // Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
    function boton_ficticio($caption,$url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=#669900>
                <FONT size =\"-1\" face=\"arial, helvetica\">
                    <a href = \"$url\">$caption</A></FONT>
            </TD></TR></TABLE>";
    }

    // Muestra el listado de los registros a partir de una matriz de registros.
	// El parámetro $id_edit indica el registro que el usuario desea editar (-1)
	function listado_registros($registros_array, $id_edit)
	{
        // Cabecera
		echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" width=\"600\">
            <TR>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\"><A href= index.php?ordena_por_campo=concepto>
                    Concepto</A></FONT></th>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\"><A href= index.php?ordena_por_campo=fecha>
                    Fecha</A></FONT></th>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\"><A href= index.php?ordena_por_campo=importe>
                    Importe(&euro;)</A></FONT></th>
                <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones</FONT></th>
            </TR>";

        // Bucle que recorre todos los registros de la matriz registros
        for ($i=0; $i<sizeof($registros_array); $i++) {
            // Si el id_edit no coincide con ningun registro entonces imprimimos los datos
            $id_current = $registros_array[$i][0];
            $timestamp = $registros_array[$i][2];   // segundo desde 1970-01-01
            if ($id_current != $id_edit) {
                echo "<TR><TD>".$registros_array[$i][1]."</TD>
                        <TD>".date("d/m/Y",$timestamp)."</TD>
                        <TD>".$registros_array[$i][3]."</TD>";
                echo "<TD>".boton_ficticio("Editar","index.php?operacion=editar&nume=".$id_current)."</TD>";
                echo "<TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$id_current)."</TD>";
                echo "</TD></TR>";	
            }	
            else {
                echo "<TR><FORM name=\"form1\" method=\"post\" action=\"index.php?operacion=modificar\">
                        <TD><input type=\"text\" name=\"concepto\" size=\"30\" 
                            value = \"".$registros_array[$i][1]. "\" maxlength=\"50\"></TD>
                        <TD><input type=\"text\" name=\"fecha\" size=\"20\" 
                            value = \"".date("d/m/Y",$timestamp). "\" maxlength=\"20\"></TD>
                        <TD><input type=\"text\" name=\"importe\" size=\"10\" 
                            value = \"".$registros_array[$i][3]. "\" maxlength=\"10\"></TD>";

                // Usamos la etiqueta de tipo hidden para pasar el nº de id a la página destino.
                echo " <TD colspan=\"2\">
                        <INPUT type=\"hidden\" NAME=\"el_nume\" value = \"$id_edit\">
                        <INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Modificar registro\"></TD>
                        </FORM></TR>";
            }
        }

        // Formulario de alta de registros
        echo "<TR><FORM name=\"form2\" method=\"post\" action=\"index.php?operacion=alta\">
                <TD><input type=\"text\" name=\"concepto\" size=\"30\" maxlength=\"50\"></TD>
                <TD><input type=\"text\" name=\"fecha\" size=\"20\" maxlength=\"20\"></TD>
                <TD><input type=\"text\" name=\"importe\" size=\"10\" maxlength=\"10\"></TD> 
                <TD colspan=\"2\"><INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Añadir registro\"></TD>
            </FORM></TR>
            </TABLE>";
    }

    function extractColumn($matrix, $index) {
        $columna = array();
        foreach($matrix as $fila) {
            array_push($columna, $fila[$index]); 
        }
        return $columna;
    }

    function isFormValid($concepto, $fecha, $importe) {
        $retVal = true;
        if ($concepto=="") {
            echo "No se ha introducido ningún concepto<br>";
            $retVal = false;
        }
        if (!isValidDate($fecha)) {
            echo "No se ha introducido una fecha valida";
            $retVal = false; 
        }
        if (!is_numeric($importe)) {
            echo "No se ha introducido un importe correcto<br>";
            $retVal = false; 
        }
        echo "<p>";
        return $retVal;
    }

    function isValidDate($date) {
        if (!strstr($date, "/")) return false;
        $len = strlen($date);
        if (($len < 8) || ($len > 10)) return false;
        list($day, $month, $year) = explode('/', $date);
        return checkdate($month, $day, $year);
    }

    function test_date() {
        $timestamp = 1418338801;
        //echo date("d/m/Y",$timestamp);
        $date = "11/11/2023";
        if (isValidDate($date)) {
            echo "Valid date";
        } else {
            echo "Invalid date";
        }
    }

?>