<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestor de discos</title>
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
<body bgcolor="#C0C0C0" link="blue" vlink="blue" alink="blue">
	<BASEFONT face="arial, helvetica">

	<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
	<TR><TH colspan="2" width="100%" bgcolor="blue"><FONT size="6" color="white">Gestor de Discos</FONT></TH>
	</TR></TABLE><P>
	<CENTER><P>

<?php 

	
	require "funciones.php";
	require "discos.php";
	//$los_discos=new discos();
	
  	echo "<TABLE border='0' width='600'><TR>";
  	echo "<TD valign=top align=CENTER colspan=2>
		<FORM name='form1' METHOD='POST' ACTION=\"index.php?operacion=buscar\">
		<FONT size ='-1'>Buscar por el campo <SELECT NAME='campo_busqueda'>
		<OPTION ";
  		   	if ((isset($_REQUEST["campo_busqueda"])) && ($_REQUEST["campo_busqueda"]=='titulo')) echo "SELECTED";
  		   	echo " Value=titulo> T&iacute;tulo </OPTION>
		<OPTION ";
  		   	if ((isset($_REQUEST["campo_busqueda"])) && ($_REQUEST["campo_busqueda"]=='interprete')) echo "SELECTED";
  		   	echo " Value=interprete> Int&eacute;rprete </OPTION>
		</SELECT> "; 
  	        if (!isset($_REQUEST["lo_q_busco"])) $_REQUEST["lo_q_busco"]="";
  	        echo "<P><INPUT TYPE='TEXT' NAME='lo_q_busco' value='".$_REQUEST["lo_q_busco"]."' size='20'> ";
  	        echo "<INPUT TYPE='SUBMIT' NAME='boton_buscar' VALUE='&iexcl;Buscar!'>
  	        </FONT>
		</FORM>";
	echo "</TD><TD align=center>
		<FORM name='form2' METHOD='POST' ACTION='index.php?operacion=introduce&ver=0&nume=0#ancla'>
			<INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Nuevo disco\">
		</FORM>
		<FORM name='form3' METHOD='POST' ACTION='index.php?operacion=listado'>
			<INPUT TYPE='SUBMIT' NAME='alta' VALUE='Listado completo'>
		</FORM>";
    echo "</TD></TR></TABLE>";

	if (isset($_REQUEST["operacion"])){
		$operacion = $_REQUEST["operacion"];
		echo $operacion;
		switch ($operacion) {
			case "buscar":
				break;
			case "introduce":
				break;
			case "exec_alta":
				break;
			case "borrar":
				break;
			default: // listado
				break;
		}

	}
	
?>

</body>
</html>