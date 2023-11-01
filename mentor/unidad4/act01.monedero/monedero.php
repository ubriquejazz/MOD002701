<?php

    class monedero {

        private $nombre_fichero = "monedero.txt";
        public $numero_registros = 0;

        function __construct() {
            if (!file_exists($this->nombre_fichero)){
                $id_fichero=@fopen($this->nombre_fichero,"w") 
                    or die("<B>El fichero '$this->nombre_fichero' no se ha podido crear.</B><P>");
                fclose($id_fichero);
            }
        }

        function leer_registros() {
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
    		$this->numero_registros=0;
    		$registros = array();
            while (!feof($id_fichero)){
                $registro_str = trim(fgets($id_fichero));
        		if ($registro_str!=""){
        			// Usamos explode para separar los datos de la cadena en una matriz  
        			// despues la añadimos con array_push a la matriz $registros
    				array_push($registros, explode("~", $registro_str));
    				$this->numero_registros++;
				}
            } 
            fclose($id_fichero);
            return $registros;
        }

    }

?>