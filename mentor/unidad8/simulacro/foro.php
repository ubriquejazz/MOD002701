<?php

    require("funciones.php");
    $apoteke = new foro(getcwd());
    $matriz = $apoteke->leer_todos();

    imprimir_cabecera();
    session_start();
    
    // Controlamos que la sesi�n sigue activa   
    if ($_SESSION["usuario"] == null) {
        $_SESSION["error"] = "You should login to access to this page";
        header("Location: index.php");
    }
    
    echo "<br><TABLE BORDER='0' cellspacing='1' cellpadding='1' width='80%' align='center'>
    <TR><th bgcolor='black'><FONT color='white' face='arial, helvetica'>Fecha</FONT></th>
        <th bgcolor='black'><FONT color='white' face='arial, helvetica'>Asunto</FONT></th>
        <th bgcolor='black'><FONT color='white' face='arial, helvetica'>Autor</FONT></th>
        <th bgcolor='black' width=100><FONT color='white' face='arial, helvetica'>Respuestas</FONT></th>
    </TR>";  

    for ($i=0; $i<count($matriz); $i++) {    
        $fecha_modificada=$matriz[$i][2];
        $num = $matriz[$i][0];
        $nombre = $matriz[$i][1];
        $asunto = $matriz[$i][3];
        $num_respuestas = $matriz[$i][5];
        echo "<TR>
            <TD align='center'>$fecha_modificada</TD>
                  <TD align='left'>&nbsp;&nbsp;<a href='contenido.php?num_mensaje=$num'>$asunto</a></TD>
                  <TD align='left'>&nbsp;&nbsp;$nombre</TD>
                  <TD align='center'>$num_respuestas</TD>
            </TR>";
    } // end for

    echo "</table><BR><CENTER>";
    echo boton_ficticio('Nuevo mensaje','mensaje.php');
    echo "</CENTER>";
    
    imprimir_footer();
?>
