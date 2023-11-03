<?php

    $fichero = "fichero03.txt";
    $path = getcwd();
    $path .= "/mentor/unidad4/eje02.leer";
    if (!@chdir($path)) 
        die ("no se ha accedido al directorio ".$path);

	$id_fichero= @fopen($fichero,"r")
        or die("no se ha podido abrir " . $fichero);
        
    while (!feof($id_fichero)){
		$linea=fgets($id_fichero);
		echo $linea;
	} 
    fclose($id_fichero);
?>