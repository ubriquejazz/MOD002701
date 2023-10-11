<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1 - Unidad 2 - Curso Iniciación de PHP 5 - Motos GP</title>
</head>
<body bgcolor="#003399" text='white'>
    <CENTER>
    <hr><img src=motos_gp.png>
	<h1>INFORMACION PILOTO</h1>
  	<hr>
    <?php 
        require("script.php");

        if (!isset($_REQUEST['piloto'])) $idx = '';
        else $idx = $_REQUEST['piloto'];

    ?>  
    <p> La clasificacion del piloto <?php echo $piloto[$idx]; ?> es: </p>
    <TABLE BORDER=2 width=300>
        <TR>
            <TD width=70 align="CENTER"> <B>Gran Premio</B> </TD>		
            <TD width=70 align="CENTER"> <B>Posición</B> </TD>
            <TD width=70 align="CENTER"> <B>Puntos</B> </TD>
        </TR>
        <?php
            $suma = 0;
            foreach($premio as $place => $resultado) {
                $posEnCarrera = posicion($resultado, $idx);
                $puntosEnCarrera = premiar($posEnCarrera);
                $suma += $puntosEnCarrera;
                echo "<tr>";
                    echo "<td>" . $place . "</td>";
                    echo "<td>" . $posEnCarrera . "</td>";
                    echo "<td>" . $puntosEnCarrera . "</td>";                    
                echo "</tr>";
            }
        ?>
    </TABLE>
    <P>N&uacute;mero total de puntos conseguidos en el campeonato: <b><?php echo $suma; ?></b><br>
    <input type="button" value="Volver" onclick="history.back();">
    </CENTER>

</body>
</html>