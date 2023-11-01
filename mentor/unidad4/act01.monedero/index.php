<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4.1 - Monedero</title>
</head>
<body bgcolor="#C0C0C0" link="white" vlink="white" alink="white">
    <center>  
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600" bgcolor="#669900">
    <TR>	
        <td width=30><img src=cerdito.gif></td>
        <td align=center><FONT size="6" color="white" face="arial, helvetica">Monedero</FONT></td>
        <td width=30><img src=cerdito.gif></td>
    </TR>
    </TABLE><P>
    <?php

        require "funciones.php";
        require "monedero.php";
        $cash = new monedero();

        if (isset($_REQUEST["ordena_por_campo"])) $ordena_por_campo = $_REQUEST["ordena_por_campo"];
        else $ordena_por_campo = '';

    	if (isset($_REQUEST["operacion"])) $operacion = $_REQUEST["operacion"];
        else $operacion = '';

        switch ($operacion) {
            case "buscar": 
                listado_registros($cash->buscar($_POST["buscar_edit"]), -1);
                break;

            case "alta": 
                if ($_POST["concepto"]=="") echo "<CENTER>No se ha introducido ningún concepto</CENTER><P>";
                else {
                    $cash->alta_registro ($_POST["concepto"], $_POST["fecha"], $_POST["importe"]);
                    echo "<CENTER>Se ha dado de alta correctamente el registro: ".$_POST["concepto"]." ".$_POST["fecha"]."</CENTER><P>";
                }
                listado_registros($cash->leer_registros(), -1);
                break;

            case "editar":
                listado_registros($cash->leer_registros(), $_REQUEST["nume"]);
                break;

            case "modificar":
                if ($_POST["concepto"]=="") echo "<CENTER>No se ha introducido ningún concepto</CENTER><P>";
                else {
                    $fecha = isValidDate($_POST["fecha"])? $_POST["fecha"] : "01/01/1970";
                    $importe = is_numeric($_POST["importe"])? $_POST["importe"] : 0;
                    echo $_POST["concepto"] . " " . $fecha . " " . $importe;
                    $cash->modificar_registro ($_POST["el_nume"], $_POST["concepto"], $fecha, $importe);
                    echo "<CENTER>Se ha dado modificado correctamente el registro: ".$_POST["concepto"]." ".$_POST["fecha"]."</CENTER><P>";
                }
                listado_registros($cash->leer_registros(), -1);
                break;

            case "borrar":
                $cash->borrar_registro($_REQUEST["nume"]);
                listado_registros($cash->leer_registros(), -1);
                break;
                
            default:
                listado_registros($cash->leer_registros(), -1);
	    } 

    ?>

	<TABLE border=0 width=600>
		<TR><TD colspan="2"><HR></TD></TR>
		<TR><TD valign=top align=right>
			<FORM name="form3" METHOD="POST" ACTION="index.php?operacion=buscar">
				<FONT size ="-1" face="arial, helvetica"> Buscar concepto</FONT></TD>
				<TD><INPUT TYPE="TEXT" NAME="buscar_edit" size="20"> 
				<INPUT TYPE="SUBMIT" NAME="buscar"  VALUE="¡Buscar!">
			</FORM></TD></TR>
		<TR><TD colspan="2"><HR></TD></TR>
	</TABLE>

	<TABLE BORDER="0" cellspacing="1" cellpadding="1" align="center" width="600">
		<TR>
			<TD><FONT size ="-1" face="arial, helvetica">
				El nº total de registros es: <?php echo $cash->numero_registros;?></LEFT></FONT><P></TD>
			<TD valign=top align=right>		
			<?php echo boton_ficticio("Ver listado inicial","index.php?operacion=listado"); ?></TD>
		</TR>
	</TABLE>
    NOTA: es obligatorio rellenar el campo Concepto.<br> 
</center> 
</body>
</html>