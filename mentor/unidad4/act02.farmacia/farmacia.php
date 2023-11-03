<?php

    class farmacia {

        private $nombre_fichero = "farmacia.txt";
        public $numero_medicamentos = 0;
        public $el_mas_caro = 0;

        function __construct($path) {
            if(!chdir($path)) {
                echo "no encuentro directorio";
            }
            if ( !file_exists($this->nombre_fichero)) {
                $id_fichero = @fopen($this->nombre_fichero, 'w')
                    or die("no se pudo abrir el fichero");
                fclose($id_fichero);
            }
        }

        function leer_todos() {
            
            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            $regitros = array();    // resultado 

            while(!feof($id_fichero)) {
                $registro_str = fgets($id_fichero);
                if ($registro_str!=""){
                    array_push($registros, explode('~', $registro_str));
                }
            }
            fclose($id_fichero);
            return $registros;
        }

        function buscar($lo_q_busco) {	

            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            $regitros = array();    // resultado 
            fclose($id_fichero);
            return $registros;
        }

        function alta($nombre, $cantidad, $importe) {

            // Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            // Añadimos la cadena al fichero
			fputs($id_fichero, $registro_str);
	    	fclose($id_fichero);
        }

        function modificar($id_to_modi, $nombre, $cantidad, $importe) {            

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
        }

        function borrar($id_to_del) {

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
    
            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
        }
    }

    function test_construct() {
        $apoteke = new farmacia(getcwd());
        print_r($apoteke->leer_todos());
    }
?>