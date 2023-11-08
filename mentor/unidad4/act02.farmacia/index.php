<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4.2 - Farmacia</title>
</head>
<BODY bgcolor="#C0C0C0" link="white" vlink="white" alink="white">
    <center>
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600" bgcolor="orange">
        <TR>	
            <td width=30><img height=70 width=70 src=medicina.gif></td>
            <TD align=center><FONT size="6" color="white" face="arial, helvetica">Farmacia</FONT></TD>
            <td width=30><img height=70 width=70 src=medicina.gif></td>
        </TR>
    </TABLE><P>

    <?php

    require "farmacia.php";
    require "funciones.php";
    $apoteke = new farmacia(getcwd());
    $matriz = $apoteke->leer_todos();

    if (isset($_REQUEST["operacion"])) $operacion = $_REQUEST["operacion"];
    else $operacion = '';

    if (isset($_REQUEST["operacion2"])) $ordenar_por = $_REQUEST["operacion2"];
    else $ordenar_por = '';

    tabla_header();         // cabecera de la tabla, falta el body
    switch ($operacion) {

        case "buscar":
            $matriz = $apoteke->buscar($_POST["buscar_edit"]);
            tabla_body($matriz, -1);
            break;

        case "borrar":
            $apoteke->borrar($_REQUEST["nume"]);
            $matriz = $apoteke->leer_todos();
            tabla_body($matriz, -1);
            break;

        case "editar":
            $matriz = $apoteke->leer_todos();
            tabla_body($matriz, $_REQUEST["nume"]);
            break;

        case "modificar":            
            $el_nume = $_REQUEST["el_nume"];
            $nombre = sintilde($_REQUEST["nombre"]);
            $cantidad = $_REQUEST["cantidad"];
            $importe = $_REQUEST["importe"];
            if (isValidName($nombre, $apoteke->buscar($nombre), $el_nume)  
                && isFormValid($cantidad, $importe)) {
                $apoteke->modificar($el_nume, $nombre, $cantidad, $importe);
            }
            $matriz = $apoteke->leer_todos();
            tabla_body($matriz, -1);
            break;

        case "alta":
            $nombre = sintilde($_REQUEST["nombre"]);
            $cantidad = $_REQUEST["cantidad"];
            $importe = $_REQUEST["importe"];
            if (isValidName($nombre, $apoteke->buscar($nombre), -1) 
                && isFormValid($cantidad, $importe)) {
                $apoteke->alta($nombre, $cantidad, $importe);
            }            
            $matriz = $apoteke->leer_todos();
            tabla_body($matriz, -1);
            break;

        default: // listado ordenado o no
            switch ($ordenar_por) {
                case "por_nombre":
                    usort($matriz, function($a, $b) {
                        return $a[1] <=> $b[1];
                    });
                    break;
                case "por_cantidad";
                    usort($matriz, function($a, $b) {
                        return $a[2] <=> $b[2];
                    });
                    break;
                case "por_importe":
                    usort($matriz, function($a, $b) {
                        return $a[3] <=> $b[3];
                    });
                    break;
            } // inner switch
            tabla_body($matriz, -1);
            break;
    } // outer switch
    
    ?>
	<TABLE border=0 width=600>
		<TR><TD colspan="2"><HR></TD></TR>
		<TR><TD valign=top align=right>
			<FORM name="form3" METHOD="POST" ACTION="index.php?operacion=buscar">
				<FONT size ="-1" face="arial, helvetica"> Buscar medicamento</FONT></TD>
				<TD><INPUT TYPE="TEXT" NAME="buscar_edit" size="20"> 
				<INPUT TYPE="SUBMIT" NAME="buscar"  VALUE="¡Buscar!">
			</FORM></TD></TR>
		<TR><TD colspan="2"><HR></TD></TR>
	</TABLE>

    <TABLE BORDER="0" cellspacing="1" cellpadding="1" align="center" width="600">
		<TR>
			<TD><FONT size ="-1" face="arial, helvetica">
				El nº de medicamentos es: <?php echo $apoteke->numero_medicamentos;?><P>
                El mas caro es: <?php echo $apoteke->el_mas_caro;?></LEFT></FONT></TD>
			<TD valign=top align=right>		
			<?php echo boton_ficticio("Ver listado inicial","index.php?operacion=listado"); ?></TD>
		</TR>
	</TABLE>

    NOTA: no se puede repetir el nombre de un medicamento en esta farmacia.
    </center>
</body>
</html>