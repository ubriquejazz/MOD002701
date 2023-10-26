<?php

	// Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
	function boton_ficticio($caption,$url) {
		return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
			<TR><TD bgcolor=\"white\">
				<FONT size =\"-1\" face=\"arial, helvetica\">
					<a href = \"$url\">$caption</A></FONT>
			</TD></TR></TABLE>";
	}
	
	// Muestra el listado de los contactos a partir de una matriz de registros.
	// El parámetro $id_edit indica el registro que el usuario desea editar (-1)
	function listado_contactos($contactos_array, $id_edit)
	{
		echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" 
            align=\"center\" width=\"600\">
                <TR>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Nombre
                    </FONT></th>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Apellidos
                    </FONT></th>
                <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Teléfono
                    </FONT></th>
                <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones
                    </FONT></th>
            </TR>";	
				
		// Bucle que recorre todos los registros de la matriz
		for ($i=0;$i<sizeof($contactos_array);$i++) {
            // Si el id_edit no coincide con el id del registro $i de la matriz entonces imprimimos los datos
            if ($id_edit != $contactos_array[$i][0])
                echo "<TR><TD>".$contactos_array[$i][1]."</TD>
                        <TD>".$contactos_array[$i][2]."</TD>
                        <TD>".$contactos_array[$i][3]."</TD> 
                        <TD>".boton_ficticio("Editar","index.php?operacion=editar&nume=".$contactos_array[$i][0])."</TD>
                        <TD>".boton_ficticio("Borrar","index.php?operacion=borrar&nume=".$contactos_array[$i][0]).
                    "</TD></TR>";			
            else // En caso contrario, estamos editando el registro $id y mostramos el correspondiente formulario 
            // con los valores del registro. Usamos la etiqueta de tipo hidden para pasar el nº de id a la página destino.
                echo "<TR><FORM name=\"form3\" method=\"post\" action=\"index.php?operacion=modificar\">
                    <TD><input type=\"text\" name=\"nombre\" size=\"10\" 
                        value = \"".$contactos_array[$i][1]. "\" maxlength=\"30\"></TD>
                    <TD><input type=\"text\" name=\"apellidos\" size=\"25\" 
                        value = \"".$contactos_array[$i][2]. "\" maxlength=\"100\"></TD>
                    <TD><input type=\"text\" name=\"telefono\" size=\"10\" 
                        value = \"".$contactos_array[$i][3]. "\" maxlength=\"30\"></TD> 
                    <TD colspan=\"2\">
                    <INPUT type=\"hidden\" NAME=\"el_nume\" value = \"$id_edit\">
                    <INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Modificar contacto\"></TD>
                    </FORM></TR>";				
        }

        // Formulario de alta de registros
        echo "<TR><FORM name=\"form2\" method=\"post\" action=\"index.php?operacion=alta\">
                <TD><input type=\"text\" name=\"nombre\" size=\"10\" maxlength=\"30\"></TD>
                <TD><input type=\"text\" name=\"apellidos\" size=\"25\" maxlength=\"100\"></TD>
                <TD><input type=\"text\" name=\"telefono\" size=\"10\" maxlength=\"30\"></TD> 
                <TD colspan=\"2\"><INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Añadir contacto\"></TD>
            </FORM></TR>
            </TABLE>";
    }

?>