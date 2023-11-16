<?php

    require_once "asientos.php";
    require_once "funciones.php";

    $play = new asientos(getcwd());
    $mapa = $play->leer_filas();
    $buffer = new Buffer();
    $msg = "<FONT size=3 color=green> Escenario</FONT>";

    if (isset($_POST['confirmar'])) {
        $seleccion = $buffer->read();
        foreach ($seleccion as $a) {
            $play->actualizar($a[0],$a[1],1);
        }
        $msg = "<FONT size=3 color=green> Saved cookies";
        $msg .= "<BR>Pulse reload to continue.</FONT>";
    }
    else if (isset($_POST['borrar'])) {

		// Vemos si hay definidas cookies
		if (isset($_SERVER['HTTP_COOKIE'])) {

			// Separamos todas las cookies mediante el caracter ";"
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$partes = explode('=', $cookie);		// separamos en partes el contenido de la cookie
				$nombre = trim($partes[0]);				// nombre de la cookie en la posicion 0
				setcookie($nombre, '', time()-1000);	// tiempo anterior al actual
			}
		}
        $seleccion = array();
        $msg = "<FONT size=3 color=green> Cookies reseted";
        $msg .= "<BR>Pulse reload to continue.</FONT>";
    }
    else if (isset($_GET['la_fila'])) {
        $x0 = $_GET['la_fila'];
        $x1 = $_GET['el_asiento'];

        $msg = "<FONT size=3 color=green>Gracias por ";
        $contador=count($_COOKIE);   
    
        if ($contador<5 and $_GET['op'] == 'comprar') {
            $msg .= "comprar en esta pagina.";
            $buffer->add([$x0, $x1]);
        }
        else if ($contador>0 and $_GET['op'] == 'devolver') {
            $msg .= "devolver la entrada.";
            $buffer->erase([$x0, $x1]);
        }
        else if ($contador==5) {
            $msg = "<FONT size=3 color=red>Sólo se permite comprar 5 entradas como máximo.";
        }
        $msg .= "<BR>Pulse reload to continue.</FONT>";
    }
    $seleccion = $buffer->read();
    echo ".";
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
        <TR><TD align=center> <?php echo $msg; ?></TD></TR>
    </TABLE><BR>

    <FORM method="post" action="index.php">
		<INPUT TYPE="submit" name="borrar" value="Reset"> 
        <INPUT TYPE="submit" name="confirmar" value="Confirm">
		<INPUT TYPE="submit" name="recargar" value="Reload">
    </FORM>
    
        <?php 
            echo "<TABLE BORDER='0' cellspacing='3' cellpadding='0' align='center'>";
            tabla_asientos($mapa, $seleccion);
        ?>

    <TABLE>
        <TR><TD bgcolor=lime><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca libre.</font></TD></TR>
        <TR><TD bgcolor=orange><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca reservada.</font></TD></TR>
        <TR><TD bgcolor=red><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca ocupada.</font></TD></TR>
    </TABLE>

    </center>
</body>
</html>