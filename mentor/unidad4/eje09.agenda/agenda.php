<?php	
	
	class agenda {
		
		private $nombre_fichero = "contactos.txt";
        private $directorio;
		public $numero_contactos = 0;
		
        function set_directory() {
            $this->directorio = getcwd();
            $this->directorio .= "\unidad4\\eje09.agenda";
        }

		function __construct () {
            $this->set_directory();
            if (!chdir($this->directorio)) 
                die ("no se ha accedido al directorio");

      		if (!file_exists($this->nombre_fichero)){
      			$id_fichero=@fopen($this->nombre_fichero,"w") 
      				or die("<B>El fichero '$this->nombre_fichero' no se ha podido crear.</B><P>");
      			fclose($id_fichero);
      		}
            // else echo "existe ya!";
      	}

    	// Función que lee los contactos del fichero de datos
    	function leer_contactos() {
    		$id_fichero = @fopen($this->nombre_fichero,"r")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
    		$this->numero_contactos=0;
    		$contactos = array();
            while (!feof($id_fichero)){
                $contacto_str = trim(fgets($id_fichero));
        		if ($contacto_str!=""){
        			// Usamos explode para separar los datos de la cadena en una matriz  
        			// despues la añadimos con array_push a la matriz $contactos
    				array_push($contactos, explode("~", $contacto_str));
    				$this->numero_contactos++;
				}
            } 
            fclose($id_fichero);
            return $contactos;
        }

    	// Añadir un contacto a la lista
    	function alta_contacto ($nombre, $apellidos, $telefono) {
    		// Primero leemos los contactos para obtener así el nº de contactos
    		$this->leer_contactos();
            $nume=$this->numero_contactos;

    		// Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
                or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
			
            // Juntamos todos los datos de la matriz en una cadena separada por el carácter ~
			$contacto = array("nume"=>$nume, "nombre"=>$nombre, "apellidos"=>$apellidos, "telefono"=>$telefono);
    		$contacto_str = "\n".implode("~", $contacto);
			
            // Añadimos la cadena anterior al fichero
			fputs($id_fichero, $contacto_str);
	    	fclose($id_fichero);
    	}

        // Función que borra un contecto
 	   	function borrar_contacto($id_to_del) {
            $contactos=$this->leer_contactos();
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
            
            $j=0; // para renombrar el id de cada registro
            for ($i=0; $i<sizeof($contactos); $i++) {
    			// Si el id del contacto NO es el id que queremos borrar entonces
    			// lo añadimos a la matriz de resultados e incrementamos el contador j.
    			if ($contactos[$i][0] != $id_to_del) {
    				$contactos[$i][0]=$j;
    				$contacto_str = implode("~", $contactos[$i]);
    				// Si estamos escribiendo el registro >0 entonces hay que añadir NL
    		        if ($j>0) fputs($id_fichero_temp, "\n"); 					
    				fputs($id_fichero_temp, $contacto_str);
    				$j+=1;
				}
    		} 
            fclose($id_fichero_temp);
			unlink($this->nombre_fichero);
			rename("basura.tmp", $this->nombre_fichero);          
        }

        // Función que busca un contacto
    	function buscar($lo_q_busco) {	
    		$id_fichero = @fopen($this->nombre_fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

    		$contactos = array();   // resultados de la búsqueda
    		while (!feof($id_fichero))  {
        		$contacto_str = trim(fgets($id_fichero));
        		if ($contacto_str!=""){
        			$contacto = explode("~", $contacto_str);
        			// Buscamos si hay alguna coincidencia en alguno de los campos de búsqueda. 
                    if ((stristr($contacto[1], $lo_q_busco)) || (stristr($contacto[2], $lo_q_busco)))
        				array_push($contactos, explode("~", $contacto_str));
				}
            }
            fclose($id_fichero);
			return $contactos;
        }

        // Función que modifica los datos del contacto en un fichero
    	function modificar_contacto($id_to_modi, $nombre, $apellidos, $telefono) {            
            
            // Como se trata de un fichero de tipo texto (poco eficaz)
            // podemos guardar todos los registros a la vez.
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            $contactos=$this->leer_contactos();                
            for ($i=0;$i<sizeof($contactos);$i++) {
                // Si el id del contacto corresponde al que queremos editar, modifico
                if ($contactos[$i][0] == $id_to_modi) {
                    $contactos[$i][1]=$nombre;
                    $contactos[$i][2]=$apellidos;
                    $contactos[$i][3]=$telefono;
                }
                
                // Si estamos escribiendo el registro >0 entonces hay que añadir NL
                if ($i>0) fputs($id_fichero_temp, "\n"); 
              
                // Escribimos de nuevo los datos en el fichero de registros 
                $contacto_str = implode("~", $contactos[$i]);					
                fputs($id_fichero_temp, $contacto_str);
            }
            fclose($id_fichero_temp);
			unlink($this->nombre_fichero);
			rename("basura.tmp", $this->nombre_fichero); 
        }
    }

    function test() {
        $mi=new agenda();
        print_r($mi->buscar("ortega"));
        //$mi->alta_contacto("Juan", "Gago", "1122334455");
        //print_r($mi->leer_contactos());
        //$mi->borrar_contacto(4);
        $mi->modificar_contacto(2, "Fernando", "Mora", "921444444");
        print_r($mi->leer_contactos());    
    }

    
?>