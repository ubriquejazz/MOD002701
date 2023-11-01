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

        function buscar($lo_q_busco) {	
    		$id_fichero = @fopen($this->nombre_fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

    		$registros = array();   // resultados de la búsqueda
    		while (!feof($id_fichero))  {
        		$registro_str = trim(fgets($id_fichero));
        		if ($registro_str!=""){
        			$registro = explode("~", $registro_str);
        			// Buscamos si hay alguna coincidencia en el campo de concepto. 
                    if (stristr($registro[1], $lo_q_busco)) {
                        $this->numero_registros++;
                        array_push($registros, explode("~", $registro_str));
                    }
				}
            }
            fclose($id_fichero);
			return $registros;
        }

        function alta_registro ($concepto, $fecha, $importe) {
    		// Primero leemos los registros para obtener así el nº de registros
    		$this->leer_registros();
            $nume=$this->numero_registros;
			
            // Juntamos todos los datos de la matriz en una cadena separada por el carácter ~
			$registro = array("nume"=>$nume, "concepto"=>$concepto, "fecha"=>strtotime($fecha), "importe"=>$importe);
    		$registro_str = "\n".implode("~", $registro);
            echo $registro_str;

            // Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
			
            // Añadimos la cadena anterior al fichero
			fputs($id_fichero, $registro_str);
	    	fclose($id_fichero);
    	}


        function modificar_registro($id_to_modi, $concepto, $fecha, $importe) {            

            // Como se trata de un fichero de tipo texto (poco eficaz)
            // podemos guardar todos los registros a la vez.
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

            $registros=$this->leer_registros();                
            for ($i=0;$i<sizeof($registros);$i++) {
                $id_current = $registros[$i][0];
                // Si el id del registro corresponde al que queremos editar, modifico
                if ($id_current == $id_to_modi) {
                    $registros[$i][1]=$concepto;
                    $registros[$i][2]=strtotime($fecha);
                    $registros[$i][3]=$importe;
                }

                
                // Si estamos escribiendo el registro >0 entonces hay que añadir NL
                if ($i>0) fputs($id_fichero_temp, "\n"); 
              
                // Escribimos de nuevo los datos en el fichero de registros 
                $registro_str = implode("~", $registros[$i]);					
                fputs($id_fichero_temp, $registro_str);
            }
            fclose($id_fichero_temp);
			unlink($this->nombre_fichero);
			rename("basura.tmp", $this->nombre_fichero); 
        }

        function borrar_registro($id_to_del) {
            $registros=$this->leer_registros();
            $id_fichero_temp = @fopen("basura.tmp","w")
                or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
            
            $j=0; // para renombrar el id de cada registro
            for ($i=0; $i<sizeof($registros); $i++) {
                $id_current = $registros[$i][0];
    			// Si el id del registro NO es el id que queremos borrar entonces 
    			// lo añadimos al fichero temporal e incrementamos el contador j.
    			if ($id_current != $id_to_del) {
    				$registros[$i][0]=$j;
    				$registro_str = implode("~", $registros[$i]);
    				
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

?>