<?php

    function clean_cookies() {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $partes = explode('=', $cookie);		// separamos en partes el contenido de la cookie
            $nombre = trim($partes[0]);				// nombre de la cookie en la posicion 0
            setcookie($nombre, '', time()-1000);	// tiempo anterior al actual
        }
        $_SESSION["naranja"] = array();
    }
    
    function tabla_asientos($mapa, $naranja) {

        foreach ($naranja as $a) 
            echo $a[0] . "," . $a[1] . "   ";

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
                    foreach ($naranja as $a) {
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

?>