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

    imprimir_cabecera();
    conectar_BD(); 

    $consulta="SELECT login, password FROM usuarios WHERE num_usuario=".$_SESSION['num_user'];
    $resultado=ejecuta_SQL($consulta);
    
    if ($resultado->rowCount()>0) {
        $consulta="SELECT num_mensaje, fecha, asunto, nombre, num_respuestas
            FROM mensajes M, usuarios U WHERE M.num_usuario=U.num_usuario and num_mensaje_origen<0";
        $resultado=ejecuta_SQL($consulta);
        $matriz = $resultado->fetchAll();
        echo "<br><TABLE BORDER='0' cellspacing='1' cellpadding='1' width='80%' align='center'>
            <TR><th bgcolor='black'><FONT color='white' face='arial, helvetica'>Fecha</FONT></th>
                <th bgcolor='black'><FONT color='white' face='arial, helvetica'>Asunto</FONT></th>
                <th bgcolor='black'><FONT color='white' face='arial, helvetica'>Autor</FONT></th>
                <th bgcolor='black' width=100><FONT color='white' face='arial, helvetica'>Respuestas</FONT></th>
            </TR>";
        foreach ($matriz as $myrow) {	
            //print_r($myrow); echo "<br>";
            list($num_mensaje, $fecha, $asunto, $nombre, $num_respuestas)=$myrow;
            $array_fecha=explode ("-",$fecha);
            $fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
            echo "<TR>
                <TD align='center'>$fecha_modificada</TD>
                    <TD align='left'>&nbsp;&nbsp;<a href='contenido.php?num_mensaje=$num_mensaje'>$asunto</a></TD>
                    <TD align='left'>&nbsp;&nbsp;$nombre</TD>
                    <TD align='center'>$num_respuestas</TD>
                </TR>";       
        }
        echo "</table><BR><CENTER>";
        echo boton_ficticio('Nuevo mensaje','responder.php');
        echo "</CENTER>";
    }
    else
        echo "<br><br><center><h3>No hay mensajes que mostrar</h3><br><br><a href='index.php'>Vuelva a Intentarlo</a>";

    imprimir_footer();
?>
