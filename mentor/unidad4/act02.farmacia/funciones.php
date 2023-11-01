<?php

    // Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
    function boton_ficticio($caption,$url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=orange>
                <FONT size =\"-1\" face=\"arial, helvetica\">
                    <a href = \"$url\">$caption</A></FONT>
            </TD></TR></TABLE>";
    }

    // Muestra el listado de los registros a partir de una matriz de registros.
	// El parámetro $id_edit indica el registro que el usuario desea editar (-1)
	function listado_registros($matriz, $id_edit)
	{
        // Cabecera
		echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" width=\"600\">
            <TR>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Medicamento </FONT></th>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Cantidad </FONT></th>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Importe(€) </FONT></th>
                <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones</FONT></th>
            </TR>";

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

?>