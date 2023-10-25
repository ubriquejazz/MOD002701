<?php

    $fichero = "fichero02.txt";
    $directorio = getcwd();
    $directorio .= "\unidad4\\eje02.leer";
    if (!chdir($directorio)) 
        die ("no se ha accedido al directorio");

    $id_fichero= @fopen($fichero,"w")
        or die("no se ha podido abrir " . $directorio);

    fputs($id_fichero, "Verde que te quiero verde ".
        date("d/m/Y - G:i:s").chr(13).chr(10)); // salto de línea.

    fclose($id_fichero);         
?>