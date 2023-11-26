<?php
  
  if (isset($_REQUEST["campo_busqueda"])) $campo_busqueda=$_REQUEST["campo_busqueda"];  
  if (isset($_REQUEST["lo_q_busco"])) $lo_q_busco=$_REQUEST["lo_q_busco"];
  if (!isset($lo_q_busco)) $lo_q_busco="";
  if (isset($_REQUEST["operacion"])) $operacion=$_REQUEST["operacion"];
  // El campo ver se usa para distinguir si un art�culo est� vendido o no 
  // mostrando sus datos o permitiendo m�s pujas.
  if (isset($_REQUEST["ver"])) $ver=$_REQUEST["ver"];  
  if (isset($_REQUEST["titulo"])) $titulo=$_REQUEST["titulo"];
  if (isset($_REQUEST["descripcion"])) $descripcion=$_REQUEST["descripcion"];
  if (isset($_REQUEST["precio_inicial"])) $precio_inicial=$_REQUEST["precio_inicial"];
  if (isset($_REQUEST["vendido"])) $vendido=$_REQUEST["vendido"];
  if (isset($_REQUEST["nombre"])) $nombre=$_REQUEST["nombre"];
  if (isset($_REQUEST["importe"])) $importe=$_REQUEST["importe"];
  if (isset($_REQUEST["id"])) $id=$_REQUEST["id"];
  if (!isset($id)) $id=-1; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="#C0C0C0" link="#0000C0" vlink="#0000C0" alink="#0000C0">
    <BASEFONT face="arial, helvetica">
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
    <TR><TH colspan="2" width="100%" bgcolor="#0000C0"><FONT size="6" color="white">SUBASTAS</FONT></TH>
    </TR></TABLE><P>
    <CENTER><P>
    
    <?php

    require ("subasta.php");	
    $la_subasta=new subasta();

    echo "<TABLE border='0' width='600'>
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

        switch ($operacion) {

            case "buscar":
                $la_subasta->buscar($lo_q_busco, $campo_busqueda);
                break;

            case "borrar":
                $la_subasta->del_articulo($id);	
                break;
	
            case "introduce": //ventana de alta o edicion
                if ($ver==2) $caption="Datos del art&iacute;culo vendido";
                else if ($ver==1) $caption="Pujar por art&iacute;culo";
                else if ($id>0) $caption="Modificar art&iacute;culo";
                else $caption="Alta de nuevo art&iacute;culo";
                echo "<P><HR><A NAME='ancla'></A><FONT color='#0000C0'><h2><u>$caption</u></h2></FONT>";
                $la_subasta->introduce($id, $ver);
                if ($id>0 && $ver==1) $la_subasta->listado_pujas($id, 0);
                else if ($ver==2)$la_subasta->listado_pujas($id, 1); 
                break;

            case "exec_alta": 
                if ($titulo=="") 
                     echo "No se puede: el campo 'T&iacute;tulo' es obligatorio.<P>";
                else
                if ($descripcion=="") 
                     echo "No se puede: el campo 'Descripci&oacute;n' es obligatorio.<P>";
                else 
                if ($precio_inicial=="") 
                     echo "No se puede: el campo 'Precio inicial' es obligatorio.<P>";
                else 
                if (!checkEuros($precio_inicial)) 
                     echo "El formato del precio inicial indicado es incorrecto.<P>";
                else {
                    $la_subasta->add_articulo($id, $titulo, $descripcion, $precio_inicial, $vendido);
                    if ($id>0) $caption="modificado";
                    else $caption="dado de alta";
                    echo "<P><FONT color='#0000C0'> Se ha $caption correctamente el art&iacute;culo:<B>".$titulo."</B> </FONT><P>";
                }
                break;

            case "exec_puja": 
                if ($nombre=="") 
                     echo "No se puede: el campo 'Nombre' es obligatorio.<P>";
                else
                if ($importe=="") 
                     echo "No se puede: el campo 'Importe' es obligatorio.<P>";
                else 
                if (!checkEuros($importe)) 
                     echo "El formato del importe indicado es incorrecto.<P>";
                else {
                    $la_subasta->add_puja($id, $nombre,$importe);
                    echo "<P><FONT color='#0000C0'>Se ha dado de alta correctamente la puja.</FONT><P>";
                }
                break;
            
            default:
                $la_subasta->buscar("", "id", 1);
                break;
        }

    }
 

    ?>

    Numero de articulos <?= $la_subasta->nume_articulos(); ?>

</body>
</html>