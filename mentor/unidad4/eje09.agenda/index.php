<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 4.9 - Agenda de Contactos</title>
</head>
<body bgcolor="#C0C0C0" link="teal" vlink="teal" alink="teal">
	<center>
	<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600">
		<TR><TH colspan="2" width="100%" bgcolor="teal">
			&nbsp;<FONT size="6" color="white" face="arial, helvetica">Agenda de Contactos</FONT>&nbsp
		</TH></TR>
	</TABLE><P>

<?php
	require ("funciones.php");
	require ("agenda.php");
	$chorba=new agenda(getcwd());

	if (isset($_REQUEST["operacion"])) $operacion = $_REQUEST["operacion"];
	else $operacion = '';
	switch ($operacion) {
		case "buscar":
			if (($_POST["buscar_edit"]) == "") 
				echo "No se ha introducido ningúna cadena<P>";
			else {
				echo "Los contactos que contienen '".$_POST["buscar_edit"]."' son:<P>";
			}
			listado_contactos($chorba->buscar($_POST["buscar_edit"]), -1);
			break;
		case "editar":
			listado_contactos($chorba->leer_contactos(), $_REQUEST["nume"]);
			break;
		case "alta": 
			if ($_POST["nombre"]=="") 
				echo "No se ha introducido ningún nombre<P>";
			else {
				$chorba->alta_contacto ($_POST["nombre"], $_POST["apellidos"], $_POST["telefono"]);
				echo "Se ha dado de alta correctamente el contacto: ".$_POST["nombre"]." ".$_POST["apellidos"]."<P>";
			}
			listado_contactos($chorba->leer_contactos(), -1);
			break;
		case "modificar":
			if ($_POST["nombre"]=="") 
				echo "No se ha introducido ningún nombre<P>";
			else {
				$chorba->modificar_contacto ($_POST["el_nume"], $_POST["nombre"], $_POST["apellidos"], $_POST["telefono"]);
				echo "Se ha dado modificado correctamente el contacto: ".$_POST["nombre"]." ".$_POST["apellidos"]."<P>";
			}
			listado_contactos($chorba->leer_contactos(), -1);
			break;
		case "borrar":
			$chorba->borrar_contacto($_REQUEST["nume"]);
			listado_contactos($chorba->leer_contactos(), -1);
			break;
		default:
			listado_contactos($chorba->leer_contactos(), -1);
	} 
    
?>
	<TABLE border=0 width=600>
		<TR><TD colspan="2"><HR></TD></TR>
		<TR><TD valign=top align=right>
			<FORM name="form3" METHOD="POST" ACTION="index.php?operacion=buscar">
				<FONT size ="-1" face="arial, helvetica"> Buscar contacto</FONT></TD>
				<TD><INPUT TYPE="TEXT" NAME="buscar_edit" size="20"> 
				<INPUT TYPE="SUBMIT" NAME="buscar"  VALUE="¡Buscar!">
			</FORM></TD></TR>
		<TR><TD colspan="2"><HR></TD></TR>
	</TABLE>
	<TABLE BORDER="0" cellspacing="1" cellpadding="1" align="center" width="600">
		<TR><TD><FONT size ="-1" face="arial, helvetica">
			El nº total de contactos es: <?php echo $chorba->numero_contactos;?></LEFT></FONT><P></TD>
		<TD valign=top align=right>		
			<?php echo boton_ficticio("Ver listado completo","index.php?operacion=listado"); ?></TD>
		</TR>
	</TABLE>

</center>
</body>
</html>