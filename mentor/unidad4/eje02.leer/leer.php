<?php

    $fichero = "fichero03.txt";
    $directorio = getcwd();
    $directorio .= "\unidad4\\eje02.leer";
    if (!chdir($directorio)) 
        die ("no se ha accedido al directorio");
    
	$id_fichero= @fopen($fichero,"r")
        or die("no se ha podido abrir " . $directorio);
        
    while (!feof($id_fichero)){
		$linea=fgets($id_fichero);
		echo $linea;
	} 
    fclose($id_fichero);
?>