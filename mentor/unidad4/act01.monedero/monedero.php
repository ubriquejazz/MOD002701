<?php

    function get_directory() {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // 'This is a server using Windows!';
            return getcwd()."\unidad4\\act01.monedero";
        } 
        else {
            // 'This is a server not using Windows!';
            return getcwd()."/mentor/unidad4/act01.monedero";
        }
    }

    class monedero {

        private $nombre_fichero = "monedero.txt";
        public $numero_registros = 0;
        public $balance_total = 0;

        function __construct($path) {
            if (!chdir($path)) 
                die ("<B>El directorio '$path' no se ha accedido");

            if (!file_exists($this->nombre_fichero)){
                $id_fichero=@fopen($this->nombre_fichero,"w") 
                    or die("<B>El fichero '$this->nombre_fichero' no se ha podido crear.</B><P>");
                fclose($id_fichero);
            }
        }

        function leer_todos() {

            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

    		$this->numero_registros=0;
            $this->balance_total=0;
    		$matriz = array();  // array que se devuelve

            while (!feof($id_fichero)){
                $registro_str = trim(fgets($id_fichero));
        		if ($registro_str!=""){
                    $registro= explode("~", $registro_str);
    				array_push($matriz, $registro);  

                    // actualizacion de atributos
                    $this->balance_total += $registro[3];
    				$this->numero_registros++;
				}
            } 
            fclose($id_fichero);
            return $matriz;
        }

        function buscar($lo_q_busco) {	

            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

    		$matriz = array();   // resultados de la búsqueda

    		while (!feof($id_fichero))  {
        		$registro_str = trim(fgets($id_fichero));
        		if ($registro_str!=""){
        			$registro = explode("~", $registro_str);
        			// Buscamos si hay alguna coincidencia en el campo de concepto. 
                    if (stristr($registro[1], $lo_q_busco)) {
                        $this->numero_registros++;
                        array_push($matriz, explode("~", $registro_str));
                    }
				}
            }
            fclose($id_fichero);
			return $matriz;
        }

        function alta($concepto, $fecha, $importe) {

            // Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
			
    		// Despues leemos los matriz para obtener así los atributos
    		$this->leer_todos();
            $nume=$this->numero_registros;

            // Juntamos los datos en una cadena separada por ~. La fecha se guarda en modo UTC
			$registro = array("nume"=>$nume, "concepto"=>$concepto, "fecha"=>strtotime($fecha), "importe"=>$importe);
    		$registro_str = "\n".implode("~", $registro);

            // Añadimos la cadena anterior al fichero
			fputs($id_fichero, $registro_str);
	    	fclose($id_fichero);
    	}

        function modificar($id_to_modi, $concepto, $fecha, $importe) {            

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            $matriz=$this->leer_todos();   
                         
            for ($i=0;$i<sizeof($matriz);$i++) {
                $id_current = $matriz[$i][0];
                // Si el id del registro corresponde al que queremos editar, modifico
                if ($id_current == $id_to_modi) {
                    $matriz[$i][1]=$concepto;
                    $matriz[$i][2]=strtotime($fecha);
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

        function borrar($id_to_del) {

            // Abrimos un nuevo fichero de datos en modo escritura
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
            
            $matriz=$this->leer_todos();
            $j=0; // para renombrar el id de cada registro

            for ($i=0; $i<sizeof($matriz); $i++) {
                $id_current = $matriz[$i][0];
    			// Si el id del registro NO es el id que queremos borrar ...
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
        $cash = new monedero(get_directory());
        print_r($cash->leer_todos());
        echo $cash->balance_total . "\n";
        print_r($cash->buscar("alicia"));
    }
    function test_alta() {
        $cash = new monedero(get_directory());
        $cash->leer_todos();
        echo $cash->balance_total . "\n";
        $cash->alta("Prestamo", "10/10/2010", 1000);
        $cash->leer_todos();
        echo "Tras alta: ".$cash->balance_total . "\n";
    }
    function test_baja() {
        $cash = new monedero(get_directory());
        $cash->leer_todos();
        echo $cash->balance_total . "\n";
        $cash->borrar(4);
        $cash->leer_todos();
        echo "Tras baja: ".$cash->balance_total . "\n";
    }
    function test_edit() {
        $cash = new monedero(get_directory());
        $cash->leer_todos();
        echo $cash->balance_total . "\n";
        $cash->modificar(4, "Prestamo", "21/13/2023", 0);
        $cash->leer_todos();
        echo "Tras edit: ".$cash->balance_total . "\n";
    }

    //test_alta();
    //test_edit();
?>