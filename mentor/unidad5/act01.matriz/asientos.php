<?php

    class asientos {
        private $nombre_fichero = "asientos.txt";
        public $numero_filas = 0;

        function __construct($path) {
            if(!chdir($path)) {
                echo "no encuentro directorio";
            }
            if ( !file_exists($this->nombre_fichero)) {
                echo "se ha creado un fichero nuevo";
                $id_fichero = @fopen($this->nombre_fichero, 'w')
                    or die("no se pudo abrir el fichero");
                fclose($id_fichero);
            }
        }

        function leer_filas() {
    		$id_fichero = @fopen($this->nombre_fichero,"r")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            $mapa = array();    // resultado 
            $this->numero_filas=0;

            while(!feof($id_fichero)) {
                $linea_str = trim(fgets($id_fichero));
                if ($linea_str!=""){
                    $fila = array(); 
                    for($i=0; $i<strlen($linea_str); $i++) {
                        array_push($fila, $linea_str[$i]);
                    }
                    array_push($mapa, $fila);
                    $this->numero_filas++;
                }
            }
            fclose($id_fichero);
            return $mapa;
        }

        function colorear($fila, $col) {
            $mapa = $this->leer_filas();
            if ($mapa[$fila][$col] == 0) return 'lime';
            else return 'red';
        }

        function actualizar($fila, $col, $valor) {

            $id_fichero_temp = @fopen("basura.tmp","w")
            or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            $mapa = $this->leer_filas();
            $mapa[$fila][$col] = $valor;

            for ($i=0; $i<count($mapa); $i++) {
                // Si estamos escribiendo el registro >0 entonces hay que añadir NL
                if ($i>0) fputs($id_fichero_temp, "\n"); 
    
                // Escribimos de nuevo los datos en el fichero de mapa 
                $linea_str = implode("", $mapa[$i]);					
                fputs($id_fichero_temp, $linea_str);
            }
            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
        }
        
        function mostrar_asientos() {
            $mapa = $this->leer_filas();
            for ($i=0; $i<count($mapa); $i++) {
                for ($j=0; $j<count($mapa[0]); $j++)
                    echo $mapa[$i][$j];
                echo "\n";
            }
        }

    } // end class

    function test_asientos() {
        $play = new asientos(getcwd());
        $play->leer_filas();
        // $play->numero_filas;
        $play->actualizar(2,0, 1);
        $play->mostrar_asientos();
    }

?>