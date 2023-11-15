<?php

    require_once "asientos.php";
    require_once "funciones.php";

    session_start();

    if (isset($_GET['op'])) $operacion = $_GET['op'];
    else $operacion = "";
    if (isset($_GET['la_fila'])) $fila = $_GET['la_fila'];
    else $fila = 0;
    if (isset($_GET['el_asiento'])) $col = $_GET['el_asiento'];
    else $col = 0;

    $coord = array($fila, $col);
    if ($operacion == 'devolver')
        echo "Gracias por devolver la entrada.";
    else 
        echo "Gracias por comprar en esta página.";

    if (!isset($_COOKIE["contador"])) {
		$contador=0;
        setcookie("contador", 0, time()+3600000);
        $_SESSION["naranja"][0] = $coord;
    }
    else {
        $contador=$_COOKIE["contador"];   
        $contador++;
        if ($contador > 4) {
            echo "Sólo se permite comprar 5 entradas como máximo.";
            $contador=0;
            clean_cookies();
        }
        else {
            setcookie("contador", $contador, time()+3600000); 
            $_SESSION["naranja"][$contador] = $coord;         
        }
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Teatro</title>
</head>
<body bgcolor="#C0C0C0" link="green" vlink="green" alink="green">
    <center>
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
        <TR><TH colspan="2" width="100%" bgcolor="green">
            <FONT size="6" color="white">Comprar entradas de teatro</FONT></TH></TR>
    </TABLE><P>

    <TABLE border='0' width='600'>
        <TR><TD valign=top align=CENTER colspan=2>
        <H2> ¡Bienvenid@ a la página de reserva de localidades!</H2><BR></TD>
        </TR>
    </TABLE>

    <TABLE BORDER='0' cellspacing='1' cellpadding='0' align='center' width='200'>
        <TR><TD align=center>Escenario<BR><HR></TD></TR>
    </TABLE><BR>
    
    <TABLE BORDER='0' cellspacing='3' cellpadding='0' align='center'>
        <?php 
            $play = new asientos(getcwd());
            $mapa = $play->leer_filas();
            tabla_asientos($mapa, $_SESSION["naranja"]);
        ?>

    <TABLE>
        <TR><TD bgcolor=lime><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca libre.</font></TD></TR>
        <TR><TD bgcolor=orange><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca reservada.</font></TD></TR>
        <TR><TD bgcolor=red><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca ocupada.</font></TD></TR>
    </TABLE>
    </center>
</body>
</html>