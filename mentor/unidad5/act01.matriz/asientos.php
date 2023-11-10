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

        function leer_todos() {
            
            // Abrimos el fichero de datos en modo lectura
    		$id_fichero = @fopen($this->nombre_fichero,"r")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");

            $registros = array();    // resultado 
            $this->numero_filas=0;

            while(!feof($id_fichero)) {
                $registro_str = trim(fgets($id_fichero));
                if ($registro_str!=""){
                    array_push($registros, $registro_str);
                    $this->numero_filas++;
                }
            }
            fclose($id_fichero);
            return $registros;
        }

        
    }
    // Para cambiar el color de esta imagen, la incluimos dentro de la etiqueta <TD bgcolor=color></TD> 
    // cuyo color cambia en función del estado del asiento.
    function pintar($i, $j, $color) {
        echo "<TD bgcolor=".$color.">
            <A href=index.php?operacion=exec_comprar&la_fila=".$i."&el_asiento=".$j."&accion=0>
            <img src=1px.gif height=10 width=10 border=1></A></TD>";
    }

    $play = new asientos(getcwd());
    $matriz = $play->leer_todos();
    print_r($matriz);
    echo $play->numero_filas;

?>