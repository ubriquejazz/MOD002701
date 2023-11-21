<HTML>
<HEAD><TITLE>Unidad 7 - Subastas</TITLE>
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

<BODY bgcolor="#C0C0C0" link="#0000C0" vlink="#0000C0" alink="#0000C0">
<BASEFONT face="arial, helvetica">


<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
<TR><TH colspan="2" width="100%" bgcolor="#0000C0"><FONT size="6" color="white">SUBASTAS</FONT></TH>
</TR></TABLE><P>

<?php
  
  if (isset($_REQUEST["campo_busqueda"])) $campo_busqueda=$_REQUEST["campo_busqueda"];  
  if (isset($_REQUEST["lo_q_busco"])) $lo_q_busco=$_REQUEST["lo_q_busco"];
  if (isset($_REQUEST["operacion"])) $operacion=$_REQUEST["operacion"];
  // El campo ver se usa para distinguir si un art�culo est� vendido o no mostrando sus datos o permitiendo m�s pujas.
  if (isset($_REQUEST["ver"])) $ver=$_REQUEST["ver"];  
  if (isset($_REQUEST["titulo"])) $titulo=$_REQUEST["titulo"];
  if (isset($_REQUEST["descripcion"])) $descripcion=$_REQUEST["descripcion"];
  if (isset($_REQUEST["precio_inicial"])) $precio_inicial=$_REQUEST["precio_inicial"];
  if (isset($_REQUEST["vendido"])) $vendido=$_REQUEST["vendido"];
  if (isset($_REQUEST["nombre"])) $nombre=$_REQUEST["nombre"];
  if (isset($_REQUEST["importe"])) $importe=$_REQUEST["importe"];
  if (isset($_REQUEST["id"])) $id=$_REQUEST["id"];
  if (!isset($id)) $id=-1;  

  require ("subasta.php");	
	
  $la_subasta=new subasta();
	
  echo "<CENTER><P>
     	  <TABLE border='0' width='600'>
     	  <TR>
     	     <TD valign=top align=CENTER colspan=2>
     	     <FORM name='form1' METHOD='POST' ACTION=\"index.php?operacion=buscar\">
     	     	<FONT size ='-1'>Buscar por el campo <SELECT NAME='campo_busqueda'>
  		   	<OPTION ";
  		   	if ((isset($campo_busqueda)) && ($campo_busqueda=='titulo')) echo "SELECTED";
  		   	echo " Value=titulo> T&iacute;tulo </OPTION>
  		   	<OPTION ";
  		   	if ((isset($campo_busqueda)) && ($campo_busqueda=='descripcion')) echo "SELECTED";
  		   	echo " Value=descripcion> Descripci&oacute;n </OPTION>
  		   	</SELECT> "; 
  	        if (!isset($lo_q_busco)) $lo_q_busco="";
  	        echo "<P><INPUT TYPE='TEXT' NAME='lo_q_busco' value='".$lo_q_busco."' size='20'> ";
  	        echo "<INPUT TYPE='SUBMIT' NAME='boton_buscar' VALUE='&iexcl;Buscar!'>
  	        </FONT>
             </FORM>
             </TD><TD align=center>
             <FORM name='form2' METHOD='POST' ACTION='index.php?operacion=introduce&ver=0&nume=0#ancla'>
                   <INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Nuevo art&iacute;culo\">
             </FORM>
             <FORM name='form3' METHOD='POST' ACTION='index.php?operacion=listado'>
                   <INPUT TYPE='SUBMIT' NAME='alta' VALUE='Listado completo'>
             </FORM>             
             </TD>
          </TR></TABLE>";
	
  if (isset($operacion)){
  	if ($operacion=="listado") $la_subasta->buscar("", "id", 1);
  	else
  	if ($operacion=="buscar") $la_subasta->buscar($lo_q_busco, $campo_busqueda);
  	else
  	if ($operacion=="introduce") {//ventana de alta o edici�n
  		if ($ver==2) $caption="Datos del art&iacute;culo vendido";
  		else if ($ver==1) $caption="Pujar por art&iacute;culo";
  		else if ($id>0) $caption="Modificar art&iacute;culo";
  		else $caption="Alta de nuevo art&iacute;culo";
  		echo "<P><HR><A NAME='ancla'></A><FONT color='#0000C0'><h2><u>$caption</u></h2></FONT>";
  		$la_subasta->introduce($id,$ver);
  		if ($id>0 && $ver==1) $la_subasta->listado_pujas($id, 0);
  		else if ($ver==2)$la_subasta->listado_pujas($id, 1);
  	} else
  	if ($operacion=="exec_alta") {
  	    if ($titulo=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'T&iacute;tulo' es obligatorio.</CENTER><P>";
  	    else
  	    if ($descripcion=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'Descripci&oacute;n' es obligatorio.</CENTER><P>";
  	    else 
  	    if ($precio_inicial=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'Precio inicial' es obligatorio.</CENTER><P>";
  	    else 
  	    if (!checkEuros($precio_inicial)) 
  	         echo "<CENTER>ERROR: El formato del precio inicial indicado es incorrecto.</CENTER><P>";
  	    else
  	    if ($id>0 && $la_subasta->precio_ult_puja($id, 0)>0 && $la_subasta->precio_ult_puja($id, 0)<=$precio_inicial)
  	    	echo "<CENTER>ERROR: el importe inicial debe ser menor que la puja m&aacute;xima: ".$la_subasta->precio_ult_puja($id, 0)." euros</CENTER><P>";
  	    else{
  	    	$la_subasta->add_articulo($id, $titulo, 
  	    					$descripcion, $precio_inicial, $vendido);
		if ($id>0) $caption="modificado";
		else $caption="dado de alta";
		echo "<P><CENTER><FONT color='#0000C0'> Se ha $caption correctamente el art&iacute;culo:
			<B>".$titulo."</B> </FONT></CENTER><P>";
	    }
	} else
	if ($operacion=="exec_puja") {
  	    if ($nombre=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'Nombre' es obligatorio.</CENTER><P>";
  	    else
  	    if ($importe=="") 
  	         echo "<CENTER>No se puede realizar la operaci&oacute;n: el campo 'Importe' es obligatorio.</CENTER><P>";
  	    else 
  	    if (!checkEuros($importe)) 
  	         echo "<CENTER>ERROR: El formato del importe indicado es incorrecto.</CENTER><P>";
  	    else
  	    if ($la_subasta->precio_ult_puja($id, 1)>=$importe) 
  	         echo "<CENTER>ERROR: El importe de puja debe ser superior a ".$la_subasta->precio_ult_puja($id, 1)." euros.</CENTER><P>";
  	    else {
  	    	$la_subasta->add_puja($id, $nombre,$importe);
		echo "<P><CENTER><FONT color='#0000C0'>Se ha dado de alta correctamente la puja.</FONT></CENTER><P>";
	    }
	} else
	if ($operacion=="borrar") $la_subasta->del_articulo($id);	
	
  } else //end if isset($_REQUEST["operacion"])
  $la_subasta->buscar("", "id", 1);// Por defecto, listamos todos los registros si no se ha pulsado ning�n bot�n
	
?>

</BODY>
</HTML>

