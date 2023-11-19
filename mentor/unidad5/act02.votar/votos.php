<?php

    class votos {
        
        private $nombre_fichero = "votos.txt";

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

        function leer_todos() {
            
            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
            
            $votos = array();
            while(!feof($id_fichero)) {
                $registro_str = trim(fgets($id_fichero));
                if ($registro_str!=""){
                    $votos = explode(',', $registro_str);
                }
            }
            fclose($id_fichero);
            return $votos;
        }       

        function modificar($id_to_modi, $cantidad) {            

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            // leemos el fichero de datos
            $votos = $this->leer_todos();
            $votos[$id_to_modi] = $cantidad;
            
            // Escribimos de nuevo los datos en el fichero de matriz 
            $registro_str = implode(',', $votos);					
            fputs($id_fichero_temp, $registro_str);
            
            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
            return $votos;
        }

    }

    function test_votos() {
        $obj = new votos(getcwd());
        $result = $obj->leer_todos();
        print_r($result);
        $result = $obj->modificar(4, 11);
        print_r($result);
    }

    
?>