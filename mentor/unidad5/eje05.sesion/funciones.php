<?php

    function comprobar_usuario($nombre, $clave){
        if ($nombre === "usuario" and $clave === "1234") {
            $usu['nombre'] = "usuario";
            $usu['rol'] = 0;
        }
        return $usu;
    }

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

    // Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
    function boton_ficticio($caption,$url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=#669900><FONT size =\"-1\" face=\"arial, helvetica\">
                <a href = \"$url\">$caption</A></FONT>
            </TD></TR></TABLE>";
    }

?>