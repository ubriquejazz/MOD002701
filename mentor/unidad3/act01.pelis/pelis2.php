<?php

    class coleccion {

        /*
        clase que contiene las funciones para añadir las películas, 
        para hallar el número de registros que tiene el resultado del listado, 
        para buscar una película determinada 
        para mostrar el listado completo de registros ordenado y sin ordenar.
        */

        public function __construct() {
            $this->la_coleccion=array(); // Matriz con todos los discos
        }

        function add_peli($titulo, $director, $genero, $anio) {
            $disco = array("titulo"=>$titulo, "director"=>$director, 
                        "genero"=>$genero, "anio"=>$anio);
            array_push($this->la_coleccion, $disco);
        }

        function nume_pelis () {
            return sizeof($this->la_coleccion);
        }

        function list_pelis($ordenado) {
            //Ordenamos la matriz si el usuario lo ha pedido
            if ($ordenado) sort($this->la_coleccion);

            echo "<TABLE border=1 align=center width=600>
                <TR><TD><FONT color=red><B>T&iacute;tulo</B></FONT></TD>
                    <TD><FONT color=red><B>Director</B></FONT></TD>
                    <TD><FONT color=red><B>Genero</B></FONT></TD>
                    <TD><FONT color=red><B>A&ntilde;o</B></FONT></TD></TR>";

            for ($i=0;$i<sizeof($this->la_coleccion);$i++){
                echo "<TR><TD><B>".$this->la_coleccion[$i]["titulo"]."</B></TD>
                        <TD><B>".$this->la_coleccion[$i]["director"]."</B></TD>
                        <TD><B>".$this->la_coleccion[$i]["genero"]."</B></TD>
                        <TD><B>".$this->la_coleccion[$i]["anio"]."</B></TD></TR>";
            }//end bucle for

            echo "</TABLE>";
            return $this->nume_pelis();
        }

        function buscar($lo_q_busco) {    			
            $total=0;
            if (($lo_q_busco) == "") echo "No se ha introducido ninguna palabra";
            else {
                echo "<center>Las pelis que contienen '<b>$lo_q_busco</b>' en el campo 't&iacute;tulo' o en el 'director' son: </center><P>";
                                        
                echo "<TABLE border=1 align=center width=600>
                    <TR><TD><FONT color=red><B>T&iacute;tulo</B></FONT></TD>
                    <TD><FONT color=red><B>Director</B></FONT></TD>
                    <TD><FONT color=red><B>Genero</B></FONT></TD>
                    <TD><FONT color=red><B>A&ntilde;o</B></FONT></TD></TR>";

                for ($i=0;$i<sizeof($this->la_coleccion);$i++){
                    if ((stristr($this->la_coleccion[$i]["titulo"], $lo_q_busco)) || 
                        (stristr($this->la_coleccion[$i]["director"], $lo_q_busco))) 
                    {
                    echo "<TR><TD><B>".$this->la_coleccion[$i]["titulo"]."</B></TD>
                            <TD><B>".$this->la_coleccion[$i]["director"]."</B></TD>
                            <TD><B>".$this->la_coleccion[$i]["genero"]."</B></TD>
                            <TD><B>".$this->la_coleccion[$i]["anio"]."</B></TD></TR>";
                    $total++;
                    }
                }
                echo "</TABLE>";
                return $total;
            }
        }
    }

    $mi_coleccion=new coleccion();
    $miColeccion.add_peli("Pulp Fiction", "Quentin Tarantino", 'Alternativo', 1994);
    
?>