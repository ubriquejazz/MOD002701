<?php
    if (isset($_REQUEST['operacion']))		$operacion=$_REQUEST['operacion'];
    if (isset($_REQUEST['ver']))		    $ver=$_REQUEST['ver'];
    if (isset($_REQUEST['nume']))		    $nume=$_REQUEST['nume'];
    if (isset($_REQUEST['nombre_cine']))	$nombre_cine=$_REQUEST['nombre_cine'];
    if (isset($_REQUEST['nombre_peli']))	$nombre_peli=$_REQUEST['nombre_peli'];
    if (isset($_REQUEST['nume_filas']))		$nume_filas=$_REQUEST['nume_filas'];
    if (isset($_REQUEST['nume_asientos']))	$nume_asientos=$_REQUEST['nume_asientos'];
    if (isset($_REQUEST['registro']))		$registro=$_REQUEST['registro'];
    if (isset($_REQUEST['descripcion']))	$descripcion=$_REQUEST['descripcion'];
    if (isset($_REQUEST['sesion1']))		$sesion1=$_REQUEST['sesion1'];
    if (isset($_REQUEST['sesion2']))		$sesion2=$_REQUEST['sesion2'];
    if (isset($_REQUEST['sesion3']))		$sesion3=$_REQUEST['sesion3'];
    if (isset($_REQUEST['sesion']))		    $sesion=$_REQUEST['sesion'];
    if (isset($_REQUEST['dia']))		    $dia=$_REQUEST['dia'];
    if (isset($_REQUEST['Id']))			    $Id=$_REQUEST['Id'];
    if (isset($_REQUEST['fila']))		    $fila=$_REQUEST['fila'];
    if (isset($_REQUEST['asiento']))		$asiento=$_REQUEST['asiento'];
    if (isset($_REQUEST['accion']))		    $accion=$_REQUEST['accion'];
    if (isset($_REQUEST['lo_q_busco']))		$lo_q_busco=$_REQUEST['lo_q_busco'];
    else $lo_q_busco="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cines</title>
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
</head>
<body bgcolor="#C0C0C0" link="green" vlink="green" alink="green">
    <BASEFONT face="arial, helvetica">
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="800">
    <TR><TH colspan="2" width="100%" bgcolor="green"><FONT size="6" color="white">Cines</FONT></TH>
    </TR></TABLE><P>
    <CENTER><P>

    <?php

    require ("cine.php");	
    $los_cine=new cine("ejercicios");
	
    // form1
    echo "<TABLE border='0' width='600'><TR>
	    <TD valign=top align=CENTER colspan=2>
	    <FORM name='form1' METHOD='POST' ACTION='index.php?operacion=buscar'>
	    <FONT size ='-1'>Buscar pel&iacute;cula </FONT>";
    echo "<INPUT TYPE='TEXT' NAME='lo_q_busco' value='$lo_q_busco' size='20'> ";
    echo "<INPUT TYPE='SUBMIT' NAME='boton_buscar' VALUE='Buscar!'></FORM>";
    
    // form2
	echo "</TD></TR><TR><TD align=right>
	    <FORM name='form2' METHOD='POST' ACTION='index.php?operacion=introduce&ver=0&nume=0#ancla'>
	    <INPUT TYPE='SUBMIT' NAME='alta' VALUE='Nuevo cine'></FORM>";
    
    // form 3
    echo "</TD><TD width=100 align=left>
        <FORM name='form3' METHOD='POST' ACTION='index.php?operacion=listado'>
        <INPUT TYPE='SUBMIT' NAME='alta' VALUE='Listado completo'></FORM>
	    </TD></TR></TABLE>";

    if (isset($operacion)){

        switch($operacion) {

            case "buscar": 
                $los_cine->buscar($lo_q_busco);
                break;

            case "introduce": //ventana de alta o edici�n
                if ($ver==1) $caption="Datos del cine";
                else if ($nume>0) $caption="Modificar cine";
                else $caption="Alta de nuevo cine";
                echo "<A NAME='ancla'></A><FONT color='green'>$caption</FONT>";
                $los_cine->introduce($nume, $ver);
                break;

            case "exec_alta": //Alta cine/pel�cula
                if ($nombre_cine=="") 
                    echo "No se puede realizar la operacion: el campo 'Nombre del cine' es obligatorio.<P>";
                else if ($nombre_peli=="") 
                    echo "El campo 'Nombre de la pelcula' es obligatorio.<P>";
                else if ($nume_filas*$nume_asientos>1000) 
                    echo "El cine es demasiado grande.<P>";
                else {
                     $los_cine->add_cine($registro, $nombre_peli, $nombre_cine, $descripcion, 
                        $sesion1, $sesion2, $sesion3, $nume_filas, $nume_asientos);
                     if ($registro>0) 
                        $caption="modificado";
                     else 
                        $caption="dado de alta";
                     echo "<P><FONT color='green'> Se ha $caption correctamente el cine: <B>$nombre_cine</B></FONT><P>";
               }
               break;

            case "borrar": 
                $los_cine->del_cine($nume);
                break;

            case "comprar": 
                $los_cine->comprar($nume, $sesion, $dia);
                break;

            case "exec_comprar":
                $los_cine->exec_comprar($Id, $sesion, $fila, $asiento, $accion, $dia);
                break;

            dafault:
                $los_cine->buscar("");
                break;
        }
    } 
    ?>
</body>
</html>
            