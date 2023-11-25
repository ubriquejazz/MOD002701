<BODY bgcolor="#C0C0C0" link="blue" vlink="blue" alink="blue">
<BASEFONT face="arial, helvetica">

<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
<TR><TH colspan="2" width="100%" bgcolor="blue"><FONT size="6" color="white">Gestor de Discos</FONT></TH>
</TR></TABLE><P>

<?
  require ("discos.php");	
	
  $los_discos=new discos();
	
  echo "<CENTER><P>
     	  <TABLE border='0' width='600'>
     	  <TR>
     	     <TD valign=top align=CENTER colspan=2>
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
             </FORM>
             </TD><TD align=center>
             <FORM name='form2' METHOD='POST' ACTION='index.php?operacion=introduce&ver=0&nume=0#ancla'>
                   <INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Nuevo disco\">
             </FORM>
             <FORM name='form3' METHOD='POST' ACTION='index.php?operacion=listado'>
                   <INPUT TYPE='SUBMIT' NAME='alta' VALUE='Listado completo'>
             </FORM>
             </TD>
          </TR></TABLE>";
	
  if (isset($_REQUEST["operacion"])){
  	if ($_REQUEST["operacion"]=="listado") $los_discos->buscar("", "titulo");
  	else
  	if ($_REQUEST["operacion"]=="buscar") $los_discos->buscar($_REQUEST["lo_q_busco"], $_REQUEST["campo_busqueda"]);
  	else
  	if ($_REQUEST["operacion"]=="introduce") {//ventana de alta o edici&oacute;n
  		if ($_REQUEST["ver"]==1) $caption="Datos del disco";
  		else if ($_REQUEST["nume"]>0) $caption="Modificar disco";
  		else $caption="Alta de nuevo disco";
  		echo "<P><HR><A NAME='ancla'></A><FONT color='blue' size=+1>$caption</FONT>";
  		$los_discos->introduce($_REQUEST["nume"], $_REQUEST["ver"]);
  	} else
  	if ($_REQUEST["operacion"]=="exec_alta") {
  	    if ($_REQUEST["titulo"]=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'T&iacute;tulo' es obligatorio.</CENTER><P>";
  	    else
  	    if ($_REQUEST["interprete"]=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'Int&eacute;rprete' es obligatorio.</CENTER><P>";
  	    else {
  	    	$los_discos->add_disco($_REQUEST["registro"], $_REQUEST["titulo"], 
  	    					$_REQUEST["interprete"], $_REQUEST["estilo"], 
  	    					$_REQUEST["casa_discografica"], $_REQUEST["formato"],
  	    					$_REQUEST["duracion"], $_REQUEST["anio"], $_FILES['imagen']);
		if ($_REQUEST["registro"]>0) $caption="modificado";
		else $caption="dado de alta";
		echo "<P><CENTER><FONT color='blue'> Se ha $caption correctamente el disco:
			<B>".$_REQUEST["titulo"]."</B> del int&eacute;rprete <B>".$_REQUEST["interprete"]."</b></FONT></CENTER><P>";
	    }
	} else
	if ($_REQUEST["operacion"]=="borrar") $los_discos->del_disco($_REQUEST["nume"]);
  } else //end if isset($_REQUEST["operacion"])
  $los_discos->buscar("", "titulo");
	
?>

</BODY>
</HTML>

