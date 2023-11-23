<?php

function imprimir_tablero($mapa)
{
    $color='';
    $filas = sizeof($mapa);
    $colum = sizeof($mapa[0]);

    for ($i=0; $i<$filas; $i++) {
        echo "<tr><td><font size=2>".($i+1)."</font></td>";
        for ($j=0; $j<$colum; $j++)
        {
            //el link que tendra el boton solo estara en caso de que sea verde o naranja, si es rojo ya no contara con link
            $link = '';
            if($mapa[$i][$j] == 0) {
                $color = 'lime';
                $link = '<a href=index.php?operacion=comprar&la_fila='.$i.'&el_asiento='.$j.'>';
            }
            else $color = 'red';
                
            //comparo el seleccionado con la lista reservada para colocar los naranja
            $reserva = $_SESSION['historial'];
            for($x=0; $x<sizeof($reserva); $x++) {
                if($reserva[$x][0] == $i && $reserva[$x][1] == $j)
                    $color = 'orange';
            }
            
            echo "<td bgcolor=".$color.">";
            echo $link;
            echo "<img alt='Comprar/Devolver' src=1px.gif height=10 width=10 border=1></a></td>";
        }
        echo "</tr>";
    }

    // eje x con los indices de las columnas
    echo "<tr><td><img src=1px.gif height=100% width=100% border=0></td>";
    for ($i=0; $i<$colum; $i++)
        echo"<td><font size=1>".($i+1)."</font></td>";
}

?>