<?php
    // Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
    function boton_ficticio($caption, $url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=orange>
                <FONT size =\"-1\" face=\"arial, helvetica\">
                    <a href = \"$url\">$caption</A></FONT>
            </TD></TR></TABLE>";
    }

    function tabla_header() {
        echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" width=\"600\">
        <TR>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Medicamento </FONT></th>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Cantidad </FONT></th>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Importe(€) </FONT></th>
            <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones</FONT></th>
        </TR>";
    }

    // El parámetro $id_edit indica el registro que el usuario desea editar (-1)
    function tabla_body($matriz, $id_edit)
    {
        // Bucle que recorre todos los registros de la matriz 
        for ($i=0; $i<sizeof($matriz); $i++) {
            // Si el id_edit no coincide con ningun registro entonces imprimimos los datos
            $id_current = $matriz[$i][0];
            if ($id_current != $id_edit) {
                echo "<TR><TD>".$matriz[$i][1]."</TD>
                        <TD>".$matriz[$i][2]."</TD>
                        <TD>".$matriz[$i][3]."</TD>";
                echo "<TD>".boton_ficticio("Editar","index.php?operacion=editar&nume=".$id_current)."</TD>";
                echo "<TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$id_current)."</TD>";
                echo "</TD></TR>";	
            }	
            else {
                echo "<TR><FORM name=\"form1\" method=\"post\" action=\"index.php?operacion=modificar\">
                        <TD><input type=\"text\" name=\"nombre\" size=\"10\" 
                            value = \"". $matriz[$i][1] . "\" maxlength=\"30\"></TD>
                        <TD><input type=\"text\" name=\"cantidad\" size=\"25\" 
                            value = \"". $matriz[$i][2] . "\" maxlength=\"100\"></TD>
                        <TD><input type=\"text\" name=\"importe\" size=\"10\" 
                            value = \"". $matriz[$i][3] . "\" maxlength=\"30\"></TD>";

                // Usamos la etiqueta de tipo hidden para pasar el nº de id a la página destino.
                echo " <TD colspan=\"2\">
                        <INPUT type=\"hidden\" NAME=\"el_nume\" value = \"$id_edit\">
                        <INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Modificar registro\"></TD>
                        </FORM></TR>";
            }
        }

        // Formulario de alta de registros
        echo "<TR><FORM name=\"form2\" method=\"post\" action=\"index.php?operacion=alta\">
                <TD><input type=\"text\" name=\"nombre\" size=\"10\" maxlength=\"30\"></TD>
                <TD><input type=\"text\" name=\"cantidad\" size=\"25\" maxlength=\"100\"></TD>
                <TD><input type=\"text\" name=\"importe\" size=\"10\" maxlength=\"30\"></TD> 
                <TD colspan=\"2\"><INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\" VALUE=\"Añadir registro\"></TD>
            </FORM></TR>
            </TABLE>";
    }

    function isValidDate($date) {
        if (!strstr($date, "/")) return false;
        $len = strlen($date);
        if (($len < 8) || ($len > 10)) return false;
        list($day, $month, $year) = explode('/', $date);
        return checkdate($month, $day, $year);
    }

    function isValidName($nombre, $busqueda) {
        $retVal = true;
        if ($nombre=="") 
            echo "No se ha introducido ningún nombre<br>";
        else if (!empty ($coincide) and strtoupper($busqueda[1]) === strtoupper($nombre))
            echo "El medicamento '$nombre' ya existe<br>";
        echo "<p>";
        return $retVal;
    }

    function isFormValid_Monedero($concepto, $fecha, $importe) {
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

    function isFormValid($cantidad, $importe) {
        $retVal = true;
        if (!isValidDate($cantidad)) {
            echo "No se ha introducido una cantidad valida<br>";
            $retVal = false; 
        }
        if (!is_numeric($importe)) {
            echo "No se ha introducido un importe correcto<br>";
            $retVal = false; 
        }
        echo "<p>";
        return $retVal;
    }

    function ordenar($matriz, $criterio) {
        switch ($criterio) {
            case "nombre":
                usort($matriz, function($a, $b) {
                    return $a[1] <=> $b[1];
                });
                tabla_registros($matriz, -1);
                break;
            case "cantidad";
                usort($matriz, function($a, $b) {
                    return $a[2] <=> $b[2];
                });
                tabla_registros($matriz, -1);
                break;
            case "importe":
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