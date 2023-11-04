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
    
    if (isset($_REQUEST["ordena_por_campo"])) $ordena_por_campo = $_REQUEST["ordena_por_campo"];
    else $ordena_por_campo = '';
    if (isset($_REQUEST["operacion"])) $operacion = $_REQUEST["operacion"];
    else $operacion = '';

    $cash = new monedero(getcwd());
    $matriz = $cash->leer_todos();
    tabla_header();

    switch ($operacion) {
        case "buscar": 
            tabla_registros($cash->buscar($_POST["buscar_edit"]), -1);
            break;
        case "editar":
            tabla_registros($matriz, $_REQUEST["nume"]);
            break;
       case "borrar":
            $cash->borrar($_REQUEST["nume"]);
            $matriz = $cash->leer_todos();
            tabla_registros($matriz, -1);
            break;

        case "alta":
            if (isFormValid($_POST["concepto"], $_POST["fecha"], $_POST["importe"])) {
                $cash->alta($_POST["concepto"], $_POST["fecha"], $_POST["importe"]);
                echo "Se ha dado de alta correctamente: ".$_POST["concepto"]."<P>";
            }
            $matriz = $cash->leer_todos();
            tabla_registros($matriz, -1);
            break;

        case "modificar":
            if (isFormValid($_POST["concepto"], $_POST["fecha"], $_POST["importe"])) {
                $cash->modificar($_POST["el_nume"], $_POST["concepto"], $_POST["fecha"], $_POST["importe"]);
                echo "Se ha dado modificado correctamente: ".$_POST["concepto"]."<P>";
            }
            $matriz = $cash->leer_todos();
            tabla_registros($matriz, -1);
            break;

        default:
            //tabla_registros($matriz, -1);
            ordenar($matriz, $ordena_por_campo);
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
    </TR><TR>
        <TD><FONT size ="-1" face="arial, helvetica" color=red>
            El balance del monedero es de <b>
                <?php echo number_format($cash->balance_total,2,'.',''); ?> </b> &euro;</FONT><P></TD>  
    </TR>
	</TABLE>
    NOTA: es obligatorio rellenar el campo Concepto.<br> 
</center> 
</body>
</html>