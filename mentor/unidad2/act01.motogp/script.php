<?php

    $piloto = array(
        1 => "Jorge Lorenzo", 
        2 => "Hector Barbera", 
        3 => "Valentino Rossi",
        4 => "Marc Marquez",
        5 => "Dani Pedrosa"
    );

    $premio = array (
        'catar' => array(5, 3, 1, 2, 4),
        'america' => array(2, 4, 5, 1, 3),
        'francia' => array(3, 5, 2, 1, 4),
        'italia' => array(2, 4, 5, 1, 3),
        'assen' => array(1, 2, 4, 3 , 5)
    );    
    function posicion($vector, $token) {
        $pos = -1;
        for ($i=0; $i < count($vector); $i++) 
            if ($vector[$i] == $token) $pos = $i;
        return $pos + 1; 
    }
 
    // Test del calculo de la posicion de un piloto en una carrera
    // $carrera = array(5, 3, 1, 2, 4);
    // echo posicion($carrera, 1);

    $puntuacion = array (25, 20, 16, 13, 11);
    function premiar($piloto) {
        $puntos = 0;
        global $puntuacion;
        if ($piloto < 6)
            $puntos = $puntuacion[$piloto-1];
        return $puntos;
    }  

    // Test de la asignacion de premios
    // for ($i=1; $i<6; $i++) print $i . " " . premiar($i) . "\n";


?>