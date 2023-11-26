<?php

    // ruta
    if (isset($_REQUEST["titulo"]))       $titulo=$_REQUEST["titulo"];
    if (isset($_REQUEST["descripcion"]))  $descripcion=$_REQUEST["descripcion"];
    if (isset($_REQUEST["desnivel"]))     $desnivel=$_REQUEST["desnivel"];
    if (isset($_REQUEST["distancia"]))    $distancia=$_REQUEST["distancia"];
    if (isset($_REQUEST["dificultad"]))   $dificultad=$_REQUEST["dificultad"];
    // comentario
    if (isset($_REQUEST["nombre"]))     $nombre=$_REQUEST["nombre"];
    if (isset($_REQUEST["nota"]))       $nota=$_REQUEST["nota"];
    // menu
    if (isset($_REQUEST["referencia"])) $referencia=$_REQUEST["referencia"];  
    if (isset($_REQUEST["lo_q_busco"])) $lo_q_busco=$_REQUEST["lo_q_busco"];
    if (!isset($lo_q_busco))        $lo_q_busco="";
    if (isset($_REQUEST["ver"]))    $ver=$_REQUEST["ver"];  
    if (isset($_REQUEST["id"]))     $id=$_REQUEST["id"];
    if (!isset($id)) $id=-1; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas</title>
</head>
<body bgcolor="#C0C0C0" link="#0000C0" vlink="#0000C0" alink="#0000C0">
<BASEFONT face="arial, helvetica">
<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
<TR><TH colspan="2" width="100%" bgcolor="#0000C0"><FONT size="6" color="white">Rutas senderismo</FONT></TH>
</TR></TABLE><P>
<?php
    require "rutas.php";
    $la_subasta = new rutas();
    // form1 - buscar
    echo "<TABLE border='0' width='600'><TR>
        <TD valign=top align=CENTER colspan=2>
        <FORM name='form1' METHOD='POST' ACTION=\"index.php?operacion=buscar\">
            <FONT size ='-1'>Buscar por el campo <SELECT NAME='referencia'>
            <OPTION ";
            if ((isset($referencia)) && ($referencia=='titulo')) echo "SELECTED";
            echo " Value=titulo> T&iacute;tulo </OPTION>
            <OPTION ";
            if ((isset($referencia)) && ($referencia=='descripcion')) echo "SELECTED";
            echo " Value=descripcion> Descripci&oacute;n </OPTION>
            </SELECT> "; 
    echo "<P><INPUT TYPE='TEXT' NAME='lo_q_busco' value='".$lo_q_busco."' size='20'> ";
    echo "<INPUT TYPE='SUBMIT' NAME='boton_buscar' VALUE='&iexcl;Buscar!'>";

    // form2, form3 - alta (ver=0)
    echo "</FONT></FORM></TD><TD align=center>
        <FORM name='form2' METHOD='POST' ACTION='index.php?operacion=introduce&ver=0&nume=0'>
                <INPUT TYPE='SUBMIT' NAME='alta' VALUE=\"Nueva ruta\">
        </FORM>
        <FORM name='form3' METHOD='POST' ACTION='index.php?operacion=listado'>
            <INPUT TYPE='SUBMIT' NAME='alta' VALUE='Listado completo'>
        </FORM>             
        </TD></TR></TABLE>"; 
        
    if (isset($_REQUEST["operacion"])) {
        // echo $_REQUEST["operacion"] . " " . $ver . " " . $id;
        switch ($_REQUEST["operacion"]) {

        case "introduce": //ventana de alta o edicion
            if ($ver==1) $caption="Comentar ruta";
            else if ($id>0) $caption="Modificar ruta";
            else $caption="Alta de nueva ruta";
            echo "<P><HR><FONT color='#0000C0'><h4><u>$caption</u></h4></FONT>";
            $la_subasta->introduce($id, $ver);
            if ($id>0 && $ver==1) $la_subasta->listado_comentarios($id);
            break;
    
        case "buscar":
            $la_subasta->buscar($lo_q_busco, $referencia);
            break;

        case "borrar":
            $la_subasta->del_articulo($id);	
            break;

        case "exec_alta":
            if ($titulo=="") 
                echo "No se puede: el campo 'T&iacute;tulo' es obligatorio.<P>";
            else
            if ($descripcion=="") 
                echo "No se puede: el campo 'Descripci&oacute;n' es obligatorio.<P>";
            else 
            if ($desnivel=="") 
                echo "No se puede: el campo 'Desnivel' es obligatorio.<P>";
            else 
            if ($distancia=="")
                echo "No se puede: el campo 'Distancia' es obligatorio.<P>";
            else
            if ($dificultad=="")
                echo "No se puede: el campo 'Dificultad' es obligatorio.<P>";
            else{
                $la_subasta->add_ruta($id, $titulo, $descripcion, $desnivel, $distancia, $dificultad);
                if ($id>0) $caption="modificado";
                else $caption="dado de alta";
                echo "<P><FONT color='#0000C0'> Se ha $caption correctamente: ".$titulo."</FONT><P>";
            }
            break;

        case "exec_comentario":
            if ($nombre=="") 
                 echo "El campo 'Nombre' es obligatorio.<P>";
            else
            if ($nota=="") 
                 echo "El campo 'Nota' es obligatorio.<P>";
            else {
                $la_subasta->add_comentario($id, $nombre, $nota);
                echo "<P><FONT color='#0000C0'>Se ha comentado correctamente la ruta.</FONT><P>";
            }
            break;

        default:
            $la_subasta->buscar("", "id", 1);
            break;
        }
    }
    
?>
<hr>
Numero de rutas <?= $la_subasta->nume_rutas(); ?>  
</body>
</html>