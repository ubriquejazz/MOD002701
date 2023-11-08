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

?>