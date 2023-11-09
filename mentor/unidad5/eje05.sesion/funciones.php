<?php

    function update_cookie($nombre, $duracion) {
        if (setcookie("usuario", $nombre, time()+$duracion))
            return "La cookie ha sido creada. ¡Pulsa el botón 'Actualizar página' para ver el resultado!<P>";
        else 
            return "ERROR: el navegador no acepta Cookies<P>";
    }

    // Función que muestra los datos de la sesión 
    function dame_datos_sesion()
    {
        return "El identificador devuelto por la función session_id() es:<P>
                <B>
                    <FONT color=blue>".session_id()."</FONT>
                </B><P>
                El fichero que almacena los datos del identificador se 
                        ha guardado en el directorio:<P>
                <B>
                    <FONT color=blue>".session_save_path()."</FONT>
                </B><P>
                El nombre definido en php.ini para la sesión 
                        (nombre de la cookie) es: <P>
                <B>
                    <FONT color=blue>".session_name()."</FONT>
                </B><P>";
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

?>