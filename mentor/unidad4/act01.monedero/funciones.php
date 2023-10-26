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
    }

?>