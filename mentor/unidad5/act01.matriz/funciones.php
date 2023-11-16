<?php

    function tabla_asientos($mapa, $choice) {

        for ($i=0; $i<count($mapa); $i++) {
            // outer loop
            echo "<TR><TD><font size=1>".($i+1)."</font></TD>";
            for ($j=0; $j<count($mapa[0]); $j++) {
                // inner loop
                $color = 'lime'; $link = "";
                if ($mapa[$i][$j] == 1) 
                    $color = 'red'; 
                else {
                    $link = "<A href=index.php?op=comprar&la_fila=".$i."&el_asiento=".$j.">";
                    foreach ($choice as $a) {
                        if (($a[0] == $i) and ($a[1] == $j)) {
                            $color = 'orange';
                            $link = "<A href=index.php?op=devolver&la_fila=".$i."&el_asiento=".$j.">";
                            break;
                        }
                    }  
                }
                echo "<TD bgcolor=".$color.">".$link."<img src=1px.gif height=10 width=10 border=1></A></TD>"; 
            } // end $j
            echo "</TR>";
        } // end $i
        echo "<TR><TD><img src=1px.gif height=10 width=10 border=0></TD>";
        for ($i=0; $i<20; $i++)
            echo"<TD><font size=1>".($i+1)."</font></TD>";
    }

    class Buffer {
        
        public function add($point) {
            $msg="";
            if (count($point) == 2) {
                $cookieName = 'point_' . count($_COOKIE);
                $jsonPoint = json_encode($point);
                setcookie($cookieName, $jsonPoint, time() + 3600); // Expira en 1 hora
                $msg = "Punto [$jsonPoint] añadido al buffer.\n";
            } 
            else {
                $msg = "Error: Los puntos deben ser de dos dimensiones.\n";
            }
       }

        public function erase($point) {
            foreach ($_COOKIE as $name => $value) {
                $storedPoint = json_decode($value, true);
                if ($storedPoint == $point) {
                    // Elimina la cookie correspondiente al punto
                    setcookie($name, '', time() - 3600); // Establece una fecha de expiración en el pasado
                    return "Punto [" . implode(", ", $point) . "] eliminado del buffer.\n";
                }
            }
            return "Punto [" . implode(", ", $point) . "] no encontrado en el buffer.\n";
        }

        public function read() {
            $a = array();
            foreach ($_COOKIE as $k => $value) {
                array_push($a, json_decode($value, true));
            }
            return $a;
        }

    }

    // Ejemplo de uso
    function test_buffer() {
        $buffer = new Buffer();
        echo $buffer->add([1, 2]);
        echo $buffer->add([3, 4]);
        echo $buffer->add([5, 6]);
        print_r($buffer->read());
    
        echo $buffer->add([7, 8]);
        echo $buffer->add([9, 10]);
        print_r($_COOKIE);
    
        echo $buffer->add([11, 12]);  // Intentar añadir un punto más allá del límite
        echo $buffer->erase([3, 4]);
        echo $buffer->display();
        echo $buffer->erase([13, 14]);  // Intentar eliminar un punto que no está en el buffer
        print_r($_COOKIE);
    }

?>