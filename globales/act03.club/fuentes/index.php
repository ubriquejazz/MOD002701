<HTML>
<HEAD><TITLE>Club deportivo</TITLE>
   <STYLE  TYPE="text/css">
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
</HEAD>

<BODY bgcolor="#C0C0C0" link="blue" vlink="blue" alink="blue">
<BASEFONT face="arial, helvetica">

<?
  $el_anio=2003;
  $el_mes=5;
  $el_dia=7;
  
  $el_dia=mktime(10, 0, 0, $el_mes, $el_dia, $el_anio);
  if (time()<$el_dia){echo "<font color=red><BR><CENTER><H2><B>El examen todav&iacute;a no est&aacute; activo.</B></H2></CENTER></font>";exit;} 
?>

<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
<TR><TH colspan="2" width="100%" bgcolor="blue"><FONT size="6" color="white">Club deportivo</FONT></TH>
</TR></TABLE><P>

<?
  if (isset($_REQUEST["operacion"])) $operacion= $_REQUEST["operacion"];
  if (isset($_REQUEST["campo_busqueda"])) $campo_busqueda=$_REQUEST["campo_busqueda"];
  if (isset($_REQUEST["nume"])) $nume=$_REQUEST["nume"];
  if (isset($_REQUEST["ver"])) $ver=$_REQUEST["ver"];
  if (isset($_REQUEST["registro"])) $registro=$_REQUEST["registro"];
  if (isset($_REQUEST["dni"])) $dni=$_REQUEST["dni"];
  if (isset($_REQUEST["apellidos"])) $apellidos=$_REQUEST["apellidos"];
  if (isset($_REQUEST["nombre"])) $nombre=$_REQUEST["nombre"];
  if (isset($_REQUEST["domicilio"])) $domicilio=$_REQUEST["domicilio"];
  if (isset($_REQUEST["localidad"])) $localidad=$_REQUEST["localidad"];
  if (isset($_REQUEST["id_cuota"])) $id_cuota=$_REQUEST["id_cuota"];
  if (isset($_REQUEST["fecha"])) $fecha=$_REQUEST["fecha"];
  if (isset($_REQUEST["importe"])) $importe=$_REQUEST["importe"];
  
  isset($_REQUEST["lo_q_busco"]) ? $lo_q_busco=$_REQUEST["lo_q_busco"] : $lo_q_busco="";
  
  require ("club_deportivo.php");	
	
  $el_club=new club_deportivo();
	
  echo "<CENTER><P>
     	  <TABLE border='0' width='600'>
     	  <TR>
     	     <TD valign=top align=CENTER colspan=2>
     	     <FORM name='form1' METHOD='POST' ACTION=\"index.php?operacion=buscar\">
     	     	<FONT size ='-1'>Buscar por el campo <SELECT NAME='campo_busqueda'>
  		   	<OPTION ";
  		   	if ((isset($campo_busqueda)) && ($campo_busqueda=='apellidos')) echo "SELECTED";
  		   	echo " Value=apellidos> Apellidos </OPTION>
  		   	<OPTION ";
  		   	if ((isset($campo_busqueda)) && ($campo_busqueda=='dni')) echo "SELECTED";
  		   	echo " Value=dni> DNI </OPTION>
  		   	</SELECT> "; 
  	        echo "<P><INPUT TYPE='TEXT' NAME='lo_q_busco' value='$lo_q_busco' size='20'> ";
  	        echo "<INPUT TYPE='SUBMIT' NAME='boton_buscar' VALUE='&iexcl;Buscar!'>
  	        </FONT>
             </FORM>
             </TD><TD align=center>
             <FORM name='form2' METHOD='POST' ACTION='index.php?operacion=introduce&ver=0&nume=0#ancla'>
                   <INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Nuevo socio\">
             </FORM>
             <FORM name='form3' METHOD='POST' ACTION='index.php?operacion=listado'>
                   <INPUT TYPE='SUBMIT' NAME='alta' VALUE='Listado completo'>
             </FORM>
             </TD>
          </TR></TABLE>";
	
  if (isset($operacion)){
  	if ($operacion=="listado") $el_club->buscar("", "dni");
  	else
  	if ($operacion=="buscar") $el_club->buscar($lo_q_busco, $campo_busqueda);
  	else
  	if ($operacion=="introduce") {//ventana de alta o edición
  		if ($ver==1) $caption="DATOS DEL SOCIO";
  		else if ($nume>0) $caption="MODIFICAR SOCIO";
  		else $caption="ALTA NUEVO SOCIO";
  		echo "<P><HR><A NAME='ancla'></A><FONT color='blue' size=+1><U><B>$caption</B></U></FONT>";
  		$el_club->introduce($nume, $ver);
  	} else
  	if ($operacion=="exec_alta") {
  	    if ($dni=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'DNI' es obligatorio.</CENTER><P>";
  	    else
  	    if ($apellidos=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'Apellidos' es obligatorio.</CENTER><P>";
  	    else {
  	    	$el_club->add_socio($registro, $dni, $apellidos, $nombre, 
  	    					$domicilio, $localidad);
		if ($_REQUEST["registro"]>0) $caption="modificado";
		else $caption="dado de alta";
		echo "<P><CENTER><FONT color='blue'> Se ha $caption correctamente el socio:
			<B>$nombre $apellidos</B></FONT></CENTER><P>";
	    }
	} else
	if ($operacion=="borrar") $el_club->del_socio($nume);
	else if ($operacion=="cuotas") {
		if (!isset($id_cuota)) $id_cuota=-1;
		$el_club->listar_cuotas($nume, $id_cuota, true);
	}
	else if ($operacion=="baja_cuota") {
		$el_club->baja_cuota($nume, $id_cuota);
	}
	else if ($operacion=="gestiona_cuota") {
		$el_club->gestiona_cuota($nume, $id_cuota, $fecha, $importe);
	}
  } else //end if isset($operacion)
  	$el_club->buscar("", "dni");
	
?>

</BODY>
</HTML>

