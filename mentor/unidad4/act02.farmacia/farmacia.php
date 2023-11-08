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

            $registros = array();    // resultado 
            $this->numero_medicamentos=0;
            $this->el_mas_caro=0;

            $max=0;
            while(!feof($id_fichero)) {
                $registro_str = trim(fgets($id_fichero));
                if ($registro_str!=""){
                    $registro = explode('~', $registro_str);
                    if ($registro[3] > $max) {
                        $max = $registro[3];
                        $this->el_mas_caro = $registro[1];
                    }
                    array_push($registros, $registro);
                    $this->numero_medicamentos++;
                }
            }
            fclose($id_fichero);
            return $registros;
        }

        function buscar($lo_q_busco) {	

            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            $registros = array();    // resultado 
            $this->numero_medicamentos=0;

            while(!feof($id_fichero)) {
                $registro_str = trim(fgets($id_fichero));
                if ($registro_str!=""){
                    $registro = explode('~', $registro_str);
                    if (stristr($registro[1], trim($lo_q_busco))) {
                        array_push($registros, $registro);
                        $this->numero_medicamentos++;
                    }
                }
            }
            fclose($id_fichero);
            return $registros;
        }

        function alta($nombre, $cantidad, $importe) {

            // Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            $this->leer_todos();
            $num = $this->numero_medicamentos;  

            // hacemos la cadena
            $registro = array($num, trim($nombre), $cantidad, $importe);
            $registro_str = "\n" . implode('~', $registro);

            // Añadimos la cadena al fichero
			fputs($id_fichero, $registro_str);
	    	fclose($id_fichero);
        }

        function modificar_helper($id_to_modi, $nombre, $cantidad, $importe) {
            $matriz = $this->leer_todos();      
            foreach ($matriz as $registro){
                $modificado = false;
                if($registro[0] == $id_to_modi) {   
                    $registro[1] = trim($nombre); // TODO: mejorar validacion
                    $registro[2] = $cantidad;
                    $registro[3] = $importe;
                    $modificado = true;
                }  
                $registro_str = implode('~', $registro);
                if ($modificado) 
                    $registro_str .= "\n";
                print($registro_str);   
            }
        }

        function modificar($id_to_modi, $nombre, $cantidad, $importe) {            

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            // leemos el fichero de datos
            $matriz = $this->leer_todos();
            for ($i=0;$i<sizeof($matriz);$i++) {
                
                // Si el id del registro corresponde al que queremos editar, modifico
                if ($$matriz[$i][0] == $id_to_modi) {
                    $matriz[$i][1]=trim($nombre); 
                    $matriz[$i][2]=$cantidad;
                    $matriz[$i][3]=$importe;
                }
                
                // Si estamos escribiendo el registro >0 entonces hay que añadir NL
                if ($i>0) fputs($id_fichero_temp, "\n"); 
              
                // Escribimos de nuevo los datos en el fichero de matriz 
                $registro_str = implode("~", $matriz[$i]);					
                fputs($id_fichero_temp, $registro_str);
            }

            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
        }
/*
            foreach ($matriz as $registro){
                if($registro[0] != $id_to_del) {
                    $registro_str = implode('~', $registro);
                    fputs($id_fichero_temp, $registro_str);
                }
            }
*/
        function borrar($id_to_del) {

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
    
            // leemos el contenido del fichero
            $matriz = $this->leer_todos();
            $j=0; // para renombrar el id de cada registro

            for ($i=0; $i<sizeof($matriz); $i++) {
                
    			// Si el id del registro NO es el id que queremos borrar, almaceno
    			if ($matriz[$i][0] != $id_to_del) {
    				$matriz[$i][0]=$j;
    				$registro_str = implode("~", $matriz[$i]);
                    
                    // Si estamos escribiendo el registro >0 entonces hay que añadir NL
    		        if ($j>0) fputs($id_fichero_temp, "\n"); 
                    
                    // Escribo y actualizo el nuevo id
    				fputs($id_fichero_temp, $registro_str);
    				$j+=1;
				}
    		} 
            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
        }
    }

    function test_searching() {
        $apoteke = new farmacia(getcwd());
        $apoteke->leer_todos();
        echo $apoteke->numero_medicamentos."\n";
        $matriz = $apoteke->buscar('ina');
        print_r($matriz);
        echo $apoteke->numero_medicamentos."\n";
        echo $apoteke->el_mas_caro; // TODO: mejorar el calculo
    }

    function test_alta() {
        $apoteke = new farmacia(getcwd());
        $apoteke->leer_todos();
        echo $apoteke->numero_medicamentos."\n";
        $apoteke->alta("Omeoprazol", 100, 8.75);
        print_r($apoteke->leer_todos());
        echo $apoteke->numero_medicamentos."\n";
    }

    function test_baja($id_to_del) {
        $apoteke = new farmacia(getcwd());
        $apoteke->leer_todos();
        echo $apoteke->numero_medicamentos."\n";
        $apoteke->borrar($id_to_del);
        print_r($apoteke->leer_todos());
        echo $apoteke->numero_medicamentos."\n";
    }

    function test_modificar() {
        $apoteke = new farmacia(getcwd());
        $apoteke->leer_todos();
        $apoteke->modificar(3, "Ibuprofeno", 100, 5.95);
        print_r($apoteke->leer_todos());
    }

    // test_baja(4);
?>