<?php

class asientos {

    private $nombre_mapa = "mapa_asientos.txt";
    
    function __construct($path) {
        if(!chdir($path)) {
            echo "no encuentro directorio";
        }
        if ( !file_exists($this->nombre_mapa)) {
            echo "creando nuevo fichero";
            $id_fichero = @fopen($this->nombre_mapa, 'w')
                or die("no se pudo abrir el fichero");
            fclose($id_fichero);
        }
    }

    function leer_mapa() {

        $id_fichero = @fopen($this->nombre_mapa, "r") 
        or die("<B>El fichero '$this->nombre_mapa' no se ha podido abrir.</B><P>");

        $asientos = array();
        while(!feof($id_fichero)) {
            $linea_str = trim(fgets($id_fichero));
            if ($linea_str!=""){
                $fila = array(); 
                for($i=0; $i<strlen($linea_str); $i++) {
                    array_push($fila, $linea_str[$i]);
                }
                array_push($asientos, $fila);
            }
        }
        
        fclose($id_fichero);
        return $asientos;
    }

    // devuelve 1 si el cambio se escrito bien
    function reservar($cambios)
    {
        $id_fichero_temp = @fopen("basura.tmp", "w") 
        or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

        $asientos = $this->leer_mapa();
        $vacio = 1;  //compruebo que todas las seleccionadas estan vacias

        for($i = 0; $i<sizeof($cambios); $i++)
        {
            $x = $cambios[$i][0];
            $y = $cambios[$i][1];
            if($asientos[$x][$y] == 1) {
                $vacio = 0;
                break; // no se puede reservar un asiento ocupado
            }
        }

        //si todas las posiciones estan vacias, empieza a cambiarlas
        if($vacio) {
            for($i = 0; $i<sizeof($cambios); $i++) {
                $x = $cambios[$i][0];
                $y = $cambios[$i][1];
                $asientos[$x][$y] = 1;
            }
        }

        //bucle que recorra el array de array de $asientos
        for($i = 0; $i<sizeof($asientos); $i++){
            if ($i>0) fputs($id_fichero_temp, "\n");
            $asientos_str = implode("", $asientos[$i]);
            fputs($id_fichero_temp,$asientos_str);
        }
        fclose($id_fichero_temp);
        unlink($this->nombre_mapa);
        rename("basura.tmp", $this->nombre_mapa);
        return $vacio;
    }
}

function test_leer() {
    $play = new asientos(getcwd());
    print_r($play->leer_mapa());
}

function test_reserva() {
    $cambio = array([0,0], [0,1]);
    $play = new asientos(getcwd());
    $asientos = $play->leer_mapa();
    echo $play->reservar($cambio);
}

// test_reserva()

?>