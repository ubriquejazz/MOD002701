<?php

    function update_cookie($nombre, $duracion) {
        if (setcookie("usuario", $nombre, time()+$duracion))
            return "La cookie ha sido creada. ¡Pulsa el botón 'Actualizar página' para ver el resultado!<P>";
        else 
            return "ERROR: el navegador no acepta Cookies<P>";
    }

    function tabla_header($aplicacion) {
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

    // Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
    function boton_ficticio($caption,$url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=#669900><FONT size =\"-1\" face=\"arial, helvetica\">
                <a href = \"$url\">$caption</A></FONT>
            </TD></TR></TABLE>";
    }

?>