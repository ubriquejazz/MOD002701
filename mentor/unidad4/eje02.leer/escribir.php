<?php

    $fichero = "fichero02.txt";
    $path = getcwd();
    $path .= "/mentor/unidad4/eje02.leer";
    if (!@chdir($path)) 
        die ("no se ha accedido al directorio ".$path);

    $id_fichero= @fopen($fichero,"w")
        or die("no se ha podido abrir " . $fichero);

    fputs($id_fichero, "Verde que te quiero verde ".
        date("d/m/Y - G:i:s").chr(13).chr(10)); // salto de línea.

    fclose($id_fichero);         
?>