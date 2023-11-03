<?php

    // Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
    function boton_ficticio($caption,$url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=#669900>
                <FONT size =\"-1\" face=\"arial, helvetica\">
                    <a href = \"$url\">$caption</A></FONT>
            </TD></TR></TABLE>";
    }

    function tabla_header() {
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
    }

    // Muestra el listado de los registros a partir de una matriz de registros.
	// El parámetro $id_edit indica el registro que el usuario desea editar (-1)
	function tabla_registros($matriz, $id_edit) {

        for ($i=0; $i<sizeof($matriz)-1; $i++) {
            $id_current = $matriz[$i][0];
            $timestamp = $matriz[$i][2];   // segundo desde 1970-01-01

            // Si el id_edit no coincide con ningun registro...
            if ($id_current != $id_edit) {
                echo "<TR><TD>".$matriz[$i][1]."</TD>
                        <TD>".date("d/m/Y", $timestamp)."</TD>
                        <TD>".$matriz[$i][3]."</TD>";
                echo "<TD>".boton_ficticio("Editar","index.php?operacion=editar&nume=".$id_current)."</TD>";
                echo "<TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$id_current)."</TD>";
                echo "</TR>";	
            }	
            else {
                echo "<TR><FORM name=\"form1\" method=\"post\" action=\"index.php?operacion=modificar\">
                        <TD><input type=\"text\" name=\"concepto\" size=\"30\" 
                            value = \"".$matriz[$i][1]. "\" maxlength=\"50\"></TD>
                        <TD><input type=\"text\" name=\"fecha\" size=\"20\" 
                            value = \"".date("d/m/Y",$timestamp). "\" maxlength=\"20\"></TD>
                        <TD><input type=\"text\" name=\"importe\" size=\"10\" 
                            value = \"".$matriz[$i][3]. "\" maxlength=\"10\"></TD>";

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

    function isFormValid($concepto, $fecha, $importe) {
        $retVal = true;
        if ($concepto=="") {
            echo "No se ha introducido ningún concepto<br>";
            $retVal = false;
        }
        if (!isValidDate($fecha)) {
            echo "No se ha introducido una fecha valida<br>";
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

    function extractColumn($matrix, $index) {
        $columna = array();
        foreach($matrix as $fila) {
            array_push($columna, $fila[$index]); 
        }
        return $columna;
    }

    function ordenar($matriz, $referencia) {
        //echo $referencia;
        switch ($referencia) {
            case "concepto":
                // $columna = extractColumn($matriz, 1);
                usort($matriz, function($a, $b) {
                    return $a[1] <=> $b[1];
                });
                tabla_registros($matriz, -1);
                break;
            case "fecha";
                $columna = extractColumn($matriz, 2);
                //print_r($columna);        
                
                usort($matriz, function($a, $b) {
                    return $a[2] <=> $b[2];
                });
                tabla_registros($matriz, -1);
                break;
            case "importe":
                // $columna = extractColumn($matriz, 3);
                usort($matriz, function($a, $b) {
                    return $a[3] <=> $b[3];
                });
                tabla_registros($matriz, -1);
                break;
            default:
            tabla_registros($matriz, -1);
        } 
    }

?>