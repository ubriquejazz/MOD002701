<?php
	if (isset($_POST["lo_q_busco"])) $lo_q_busco=$_POST["lo_q_busco"];
	else $lo_q_busco="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agenda de contactos </title>
	<style  TYPE="text/css">
		<!--
		input
			{
			font-family : Arial, Helvetica;
			font-size : 14;
			color : #000033;
			font-weight : normal;
   			border-color : #999999;
   			border-width : 1;
   			background-color : #FFFFFF;
			}
		-->
	</style>
</head>
<body bgcolor="#C0C0C0" link="teal" vlink="teal" alink="teal">
<BASEFONT face="arial, helvetica">

	<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
	<TR><TH colspan="2" width="100%" bgcolor="teal">&nbsp;
		<FONT size="6" color="white">Agenda de Contactos</FONT>&nbsp</TH>
	</TR></TABLE><P>
	<CENTER><P>

	<?php

	require ("agenda.php");		
	$mi_agenda=new agenda("ejercicios");
	
	// form1
  	echo "<TABLE border='0' width='600'><TR><TD valign=top align=left>
  		   <FORM name='form1' METHOD='POST' ACTION=\"index.php?operacion=buscar\">
  		   	<FONT size ='-1'>Buscar por apellido<BR>";
	echo "<INPUT TYPE='TEXT' NAME='lo_q_busco' value='$lo_q_busco' size='20'> ";
	echo "<INPUT TYPE='SUBMIT' NAME='boton_buscar' VALUE=\"¡Buscar!\"></FONT>
  		   </FORM></TD><TD>";
	
	// form2
	echo "<FORM name='form2' METHOD='POST' ACTION=\"index.php?operacion=introduce&ver=0&nume=0#ancla\">
  		   	<FONT size ='-1'><BR>";
	echo "<INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Nuevo contacto\"></FONT>
  		   </FORM></TD><TD>";
	 
	// form3
	echo "<FORM name='form3' METHOD='POST' ACTION=\"index.php?operacion=listado\">
  		   	<FONT size ='-1'><BR>
  		   	<INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Listado completo\"></FONT>
  		   </FORM></TD></TR><TR><TD><FONT size ='-1'>";
	echo "El nº total de contactos es: ". $mi_agenda->nume_contacto() . "</FONT><P></TD>
		 </TR></TABLE>";

	// operacion
	if (isset($_REQUEST["operacion"])){
		$operacion = $_REQUEST["operacion"];
		switch ($operacion) {

			case "buscar": 
				$mi_agenda->buscar($lo_q_busco);
				break;

			case "introduce":
				//ventana de alta o edición
				if ($_REQUEST["ver"]==1) $caption="Datos del contacto";
				else if ($_REQUEST["nume"]>0) $caption="Modificar de contacto";
				else $caption="Alta de nuevo contacto";
				echo "<A NAME='ancla'></A><FONT color='teal'>$caption</FONT>";
				$mi_agenda->introduce($_REQUEST["nume"], $_REQUEST["ver"]);
				break;

			case "exec_alta":
				if ($_POST["Apellidos"]=="") 
				  	echo "El campo 'Apellidos' es obligatorio.<P>";
			  	else {
				  	$mi_agenda->add_contacto($_POST["registro"], $_POST["Nombre"], 
						$_POST["Apellidos"], $_POST["Telefono_oficina"], $_POST["Telefono_movil"],
						$_POST["email"], $_POST["direccion"], $_POST["localidad"], $_POST["provincia"], 
						$_POST["codigo_postal"],$_POST["telefono"], $_POST["notas"]);
				  	$mi_agenda->buscar("", 0);
				  	if ($_REQUEST["registro"]>0) $caption="modificado";
				  	else $caption="dado de alta";
				  	echo "<P><FONT color='teal'>
						Se ha $caption correctamente el contacto: ".$_POST["Nombre"]." ".$_POST["Apellidos"]."</FONT><P>";
			  	}
				break;

			case "borrar":
				$mi_agenda->del_contacto($_REQUEST["nume"]);
				$mi_agenda->buscar("", 0);
				break;

			default:
				$mi_agenda->buscar("");
				break;
		}
	}
		 
	?>
	
	</CENTER>
</body>
</html>