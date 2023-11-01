<?php

    function get_directory() {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // 'This is a server using Windows!';
            return getcwd()."\unidad4\\act02.farmacia";
        } 
        else {
            // 'This is a server not using Windows!';
            return getcwd()."/mentor/unidad4/act02.farmacia";
        }
    }

    class farmacia {

        private $nombre_fichero = "farmacia.txt";
        public $numero_registros = 0;

        function __construct($path) {
            if (!chdir($path)) 
                die ("no se ha accedido al directorio");

            if (!file_exists($this->nombre_fichero)){
                $id_fichero=@fopen($this->nombre_fichero,"w") 
                    or die("<B>El fichero '$this->nombre_fichero' no se ha podido crear.</B><P>");
                fclose($id_fichero);
            }
        }

        function leer_todos() {
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
    		$this->numero_registros=0;
    		$matriz = array();
            while (!feof($id_fichero)){
                $registro_str = trim(fgets($id_fichero));
        		if ($registro_str!=""){
        			// Usamos explode para separar los datos de la cadena en una array  
        			// despues la añadimos con array_push a la matriz 
    				array_push($matriz, explode("~", $registro_str));
    				$this->numero_registros++;
				}
            } 
            fclose($id_fichero);
            return $matriz;
        }

        function buscar($lo_q_busco) {	
    		$id_fichero = @fopen($this->nombre_fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

    		$matriz = array();   // resultados de la búsqueda
    		while (!feof($id_fichero))  {
        		$registro_str = trim(fgets($id_fichero));
        		if ($registro_str!=""){
        			$registro = explode("~", $registro_str);
        			// Buscamos si hay alguna coincidencia en el campo medicamento. 
                    if (stristr($registro[1], $lo_q_busco)) {
                        $this->numero_registros++;
                        array_push($matriz, explode("~", $registro_str));
                    }
				}
            }
            fclose($id_fichero);
			return $matriz;
        }

        function alta ($nombre, $cantidad, $importe) {
                		
            // leemos los registros para obtener así el nº de registros
    		$this->leer_todos();
            $nume=$this->numero_registros;

            // Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
			
            // Juntamos todos los datos de la matriz en una cadena separada por el carácter ~
			$registro = array("nume"=>$nume, "nombre"=>$nombre, "cantidad"=>$cantidad, "importe"=>$importe);
    		$registro_str = "\n".implode("~", $registro);

            // Añadimos la cadena anterior al fichero
			fputs($id_fichero, $registro_str);
	    	fclose($id_fichero);
    	}

        function modificar ($id_to_modi, $nombre, $cantidad, $importe) {            

            // Como se trata de un fichero de tipo texto (poco eficaz)
            // podemos guardar todos los registros a la vez.
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            $matriz=$this->leer_todos();                
            for ($i=0;$i<sizeof($matriz);$i++) {
                $id_current = $matriz[$i][0];
                // Si el id del registro corresponde al que queremos editar, modifico
                if ($id_current == $id_to_modi) {
                    $matriz[$i][1]=$nombre;
                    $matriz[$i][2]=$cantidad;
                    $matriz[$i][3]=$importe;
                }
                
                // Si estamos escribiendo el registro > 0 entonces hay que añadir NL
                if ($i>0) fputs($id_fichero_temp, "\n"); 
              
                // Escribimos de nuevo los datos en el fichero 
                $registro_str = implode("~", $matriz[$i]);					
                fputs($id_fichero_temp, $registro_str);
            }
            fclose($id_fichero_temp);
			unlink($this->nombre_fichero);
			rename("basura.tmp", $this->nombre_fichero); 
        }

        function borrar ($id_to_del) {
            $matriz=$this->leer_todos();
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
            
            $j=0; // para renombrar el id de cada registro
            for ($i=0; $i<sizeof($matriz); $i++) {
                $id_current = $matriz[$i][0];
    			// Si el id del registro NO es el id que queremos borrar entonces 
    			// lo añadimos al fichero temporal e incrementamos el contador j.
    			if ($id_current != $id_to_del) {
    				$matriz[$i][0]=$j;
    				$registro_str = implode("~", $matriz[$i]);
    				
                    // Si estamos escribiendo el registro >0 entonces hay que añadir NL
    		        if ($j>0) fputs($id_fichero_temp, "\n"); 					
    				fputs($id_fichero_temp, $registro_str);
    				$j+=1;
				}
    		} 
            fclose($id_fichero_temp);
			unlink($this->nombre_fichero);
			rename("basura.tmp", $this->nombre_fichero);          
        }

    }

    function test01() {
        $farma = new farmacia(get_directory());
        // print_r($farma->leer_todos());
        print_r($farma->buscar("tos"));
    }
    function test02() {
        $farma = new farmacia(get_directory());
        //$farma->alta("Quina San Martin", 100, "10.10");
        //$farma->borrar(4);
        print_r($farma->leer_todos());
    }

    function test03() {
        $farma = new farmacia(get_directory());
        $farma->modificar(1, "Aspirina", 115, "1.99");
        print_r($farma->leer_todos()); 
    }

?>