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

        require "funciones.php";
        require "farmacia.php";
        $apoteke = new farmacia(getcwd());

        if (isset($_REQUEST["ordena_por_campo"])) $ordena_por_campo = $_REQUEST["ordena_por_campo"];
        else $ordena_por_campo = '';

    	if (isset($_REQUEST["operacion"])) $operacion = $_REQUEST["operacion"];
        else $operacion = '';
        switch ($operacion) {
            case "buscar": 
                listado_registros($apoteke->buscar($_POST["buscar_edit"]), -1);
                break;
            case "editar":
                listado_registros($apoteke->leer_todos(), $_REQUEST["nume"]);
                break;
            case "borrar":
                $apoteke->borrar($_REQUEST["nume"]);
                listado_registros($apoteke->leer_todos(), -1);
                break;

            case "alta": 
                if (isset($_POST["nombre"])) $nombre = $_POST["nombre"];
                else $nombre = '';
                $coincide = $apoteke->buscar($nombre);
                if ($nombre=="") 
                    echo "No se ha introducido ningún nombre<P>";
                else if (!empty ($coincide) and strtoupper($coincide[0][1]) === strtoupper($nombre))
                    echo "El medicamento '$nombre' ya existe<P>";
                    // TODO: mejorar el sistema de busqueda con stristr()
                else {
                    $apoteke->alta($nombre, $_POST["cantidad"], $_POST["importe"]);
                    echo "Se ha dado de alta correctamente: ".$nombre."<P>";
                }
                listado_registros($apoteke->leer_todos(), -1);
                break;    
        
            case "modificar":
                if ($_POST["nombre"]=="") 
                    echo "No se ha introducido ningún nombre<P>";
                else {
                    $apoteke->modificar ($_POST["el_nume"], $_POST["nombre"], $_POST["cantidad"], $_POST["importe"]);
                    echo "Se ha dado modificado correctamente: ".$_POST["nombre"]."<P>";
                }
                listado_contactos($mi_agenda->leer_contactos(), -1);
                break;

            default:
                listado_registros($apoteke->leer_todos(), -1);
	    } 

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
				El nº de medicamentos es: <?php echo $apoteke->numero_registros;?></LEFT></FONT><P></TD>
			<TD valign=top align=right>		
			<?php echo boton_ficticio("Ver listado inicial","index.php?operacion=listado"); ?></TD>
		</TR>
	</TABLE>

    NOTA: no se puede repetir el nombre de un medicamento en esta farmacia.
    </center>
</BODY>             
</html>