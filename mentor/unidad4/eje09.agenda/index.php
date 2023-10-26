<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="#C0C0C0" link="teal" vlink="teal" alink="teal">
<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600">
<TR>
	<TH colspan="2" width="100%" bgcolor="teal">
		&nbsp;<FONT size="6" color="white" face="arial, helvetica">Agenda de Contactos</FONT>&nbsp
	</TH>	
</TR></TABLE><P>

<?php
	require ("funciones.php");
	require ("agenda.php");
	$mi_agenda=new agenda();

	if (isset($_REQUEST["operacion"])) $operacion = $_REQUEST["operacion"];
	else $operacion = '';
	switch ($operacion) {
		case "buscar":
			if (($_POST["buscar_edit"]) == "") echo "<CENTER>No se ha introducido ningúna cadena</CENTER><P>";
			else {
				echo "<CENTER>Los contactos que contienen '".$_POST["buscar_edit"]."' son: </CENTER><P>";
			}
			listado_contactos($mi_agenda->buscar($_POST["buscar_edit"]), -1);
			break;
		case "editar":
			listado_contactos($mi_agenda->leer_contactos(), $_REQUEST["nume"]);
			break;
		case "alta": 
			if ($_POST["nombre"]=="") echo "<CENTER>No se ha introducido ningún nombre</CENTER><P>";
			else {
				$mi_agenda->alta_contacto ($_POST["nombre"], $_POST["apellidos"], $_POST["telefono"]);
				echo "<CENTER>Se ha dado de alta correctamente el contacto: ".$_POST["nombre"]." ".$_POST["apellidos"]."</CENTER><P>";
			}
			listado_contactos($mi_agenda->leer_contactos(), -1);
			break;
		case "modificar":
			if ($_POST["nombre"]=="") echo "<CENTER>No se ha introducido ningún nombre</CENTER><P>";
			else {
				$mi_agenda->modificar_contacto ($_POST["el_nume"], $_POST["nombre"], $_POST["apellidos"], $_POST["telefono"]);
				echo "<CENTER>Se ha dado modificado correctamente el contacto: 
					".$_POST["nombre"]." ".$_POST["apellidos"]."</CENTER><P>";
			}
			listado_contactos($mi_agenda->leer_contactos(), -1);
			break;
		case "borrar":
			$mi_agenda->borrar_contacto($_REQUEST["nume"]);
			listado_contactos($mi_agenda->leer_contactos(), -1);
			break;
		default:
			listado_contactos($mi_agenda->leer_contactos(), -1);
	} 
    
?>
    <CENTER><P><TABLE border=0 width=600>
		<TR><TD colspan="2"><HR></TD></TR>
		<TR><TD valign=top align=right>
			<FORM METHOD="POST" ACTION="index.php?operacion=buscar">
			<FONT size ="-1" face="arial, helvetica"> Buscar contacto</FONT></TD>
			<TD><INPUT TYPE="TEXT" NAME="buscar_edit" size="20"> 
			<INPUT TYPE="SUBMIT" NAME="buscar"  VALUE="¡Buscar!">
			</FORM></TD></TR>
		<TR><TD colspan="2"><HR></TD></TR>
	</TABLE></CENTER>
		
	<TABLE BORDER="0" cellspacing="1" cellpadding="1" align="center" width="600">
	<TR><TD><FONT size ="-1" face="arial, helvetica">
		El nº total de contactos es: <?php echo $mi_agenda->numero_contactos;?></LEFT></FONT><P></TD><TD valign=top align=right>		
		<?php echo boton_ficticio("Ver listado completo","index.php?operacion=listado"); ?>
		</TD>
	</TR></TABLE>
</body>
</html>