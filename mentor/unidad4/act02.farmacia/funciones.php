<?php

    $conTilde = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú');
    $sinTilde = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');

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
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\"><a href='index.php?operacion2=por_nombre'> Nombre </a></FONT></th>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\"><a href='index.php?operacion2=por_cantidad'>Cantidad </a></FONT></th>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\"><a href='index.php?operacion2=por_importe'>Importe(€) </a></FONT></th>
            <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones</FONT></th>
            <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Carrito</FONT></th>
        </TR>";
    }

    function tabla_header2($aplicacion) {
        if ($aplicacion === 'carrito') {
            echo'<P>El contenido de la cesta de la compra es:<br>';
            echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" width=\"600\">
                <TR>
                    <th bgcolor=\"yellow\"><FONT color=\"black\" face=\"arial, helvetica\">
                    Artículo</FONT></th>
                    <th bgcolor=\"yellow\"><FONT color=\"black\" face=\"arial, helvetica\">
                    Cantidad</FONT></th>
                </TR>";	
        }
    }

    function tabla_body($matriz, $id_edit) {

        for ($i=0; $i<sizeof($matriz); $i++) {
            // Si el id_edit no coincide con ningun registro entonces imprimimos los datos
            $id_current = $matriz[$i][0];
            if ($id_current != $id_edit) {
                echo "<TR><TD>".$matriz[$i][1]."</TD>
                        <TD>".$matriz[$i][2]."</TD>
                        <TD>".$matriz[$i][3]."</TD>";
                echo "<TD>".boton_ficticio("Editar","index.php?operacion=editar&nume=".$id_current)."</TD>";
                echo "<TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$id_current)."</TD>";
                echo "<TD>".boton_ficticio("Agregar","index.php?operacion=agregar&nume=".$id_current);
                echo "</TD></TR>";	
            }
            else {
                echo "<TR><FORM name=\"form1\" method=\"post\" action=\"index.php?operacion=modificar\">
                <TD><input type=\"text\" name=\"nombre\" size=\"20\" 
                    value = \"".$matriz[$i][1]. "\" maxlength=\"20\"></TD>
                <TD><input type=\"text\" name=\"cantidad\" size=\"10\" 
                    value = \"".$matriz[$i][2]. "\" maxlength=\"20\"></TD>
                <TD><input type=\"text\" name=\"importe\" size=\"10\" 
                    value = \"".$matriz[$i][3]. "\" maxlength=\"10\"></TD>";

                // Usamos la etiqueta de tipo hidden para pasar el nº de id a la página destino.
                echo " <TD colspan=\"2\">
                    <INPUT type=\"hidden\" NAME=\"el_nume\" value = \"$id_edit\">
                    <INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Modificar registro\"></TD>
                    </FORM></TR>";
            }
        }

        // tabla de alta
        echo "<TR><FORM name=\"form2\" method=\"post\" action=\"index.php?operacion=alta\">
                <TD><input type=\"text\" name=\"nombre\" size=\"20\" maxlength=\"50\"></TD>
                <TD><input type=\"text\" name=\"cantidad\" size=\"10\" maxlength=\"20\"></TD>
                <TD><input type=\"text\" name=\"importe\" size=\"10\" maxlength=\"10\"></TD> 
                <TD colspan=\"2\"><INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Añadir registro\"></TD>
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

    function sintilde($cadena) {
        global $conTilde, $sinTilde;
        return str_replace($conTilde, $sinTilde, $cadena);
    }

    function isValidName($nombre, $busqueda, $id_edit) {
        $retVal = true;
        if ($nombre=="")  {
            echo "No se ha introducido ningun nombre<br>";
            $retVal = false;
        }            
        if (!empty($busqueda) && $busqueda[0][0] != $id_edit
                && strtoupper($busqueda[0][1]) === strtoupper($nombre)) {
            echo "El medicamento '$nombre' ya existe<br>";
            $retVal = false;
        }              
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
        if (!is_numeric($cantidad)) {
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


?>