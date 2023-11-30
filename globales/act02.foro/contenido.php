<?php

    require("funciones.php");
    session_start();

    // Controlamos que la sesi�n sigue activa
    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");  
    }

    conectar_BD();
    imprimir_cabecera();

    $consulta="SELECT num_mensaje, fecha, asunto, contenido, nombre, email FROM mensajes M, usuarios U
        WHERE M.num_usuario=U.num_usuario AND num_mensaje=".$_REQUEST["num_mensaje"];

    $resultado = ejecuta_SQL($consulta);
    $matriz = $resultado->fetchAll();
    list($num_mensaje, $fecha, $asunto, $contenido, $nombre, $email)=$matriz[0];
    $array_fecha=explode ("-",$fecha);
    $fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";

    echo "<br><table align='center' border=0 width='80%' bgcolor='white'>
        <tr><td colspan='3'><b><U>ASUNTO:</U> <I>$asunto</b></I><td><td align=center rowspan=3>".boton_ficticio("Responder","responder.php?&num_mensaje=$num_mensaje")."</td></tr>
        <tr><td width='80%'><b><U>FECHA</U> : $fecha_modificada</b></td></tr>
        <tr><td colspan='3'><b><U>AUTOR</U> : </b>$nombre (<a href='mailto:$email'>$email</a>)<td></tr>
        <tr><td colspan='3'></td></tr></table><br>";
    
    echo "<table  bgcolor='#FFCC33' align='center' border=0 width='80%'><tr><td>$contenido</td></tr></table><BR>"; 
    echo "<table  bgcolor='#FFCC33' align='center' border=0 width='80%'><tr><td><u>RESPUESTAS:<u> </td></tr>";
    
    $consulta="SELECT num_mensaje, fecha, asunto, contenido, nombre, email FROM mensajes M, usuarios U
        WHERE M.num_usuario=U.num_usuario AND num_mensaje_origen=".$_REQUEST["num_mensaje"]." ORDER BY num_mensaje ASC";
    $resultado = ejecuta_SQL($consulta);
    $matriz = $resultado->fetchAll();
    foreach ($matriz as $myrow) {	
        //print_r($myrow); echo "<br>";
        $fecha  =$myrow[1];
        $asunto =$myrow[2];
        $contenido=$myrow[3];
        $nombre =$myrow[4];
        $email  =$myrow[5];
        //list($num_mensaje, $fecha, $asunto, $nombre, $num_respuestas)=$myrow;
		$array_fecha=explode ("-",$fecha);
		$fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
        echo "<tr><td>$contenido dijo $nombre(<a href='mailto:$email'>$email</a>) el dia $fecha_modificada<hr></td></tr>";
    }    	     	
    echo "</table>";
    echo "<BR><CENTER>".boton_ficticio('Volver a mensajes','foro.php')."</CENTER>";

    imprimir_footer();
?>