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
    $fecha_modificada=modifica(date("Y-m-d"));

    //La variable enviar es la que se recibe al rellenar un formulario de envio de mensaje. Es el boton
    if (isset($_REQUEST['enviar'])) {
        if (trim($_REQUEST['asunto'])=='') $asunto="[Sin Asunto]";
        else $asunto=str_replace("'", "\'", $_REQUEST['asunto']);
        $apoteke->alta($_SESSION['usuario'], $fecha_modificada, $asunto, $_REQUEST['contenido'], 0);
        echo "<center><br><br><br><h3>El mensaje se ha dado de alta correctamente</h3></center>";
    }
    else {
        echo "<br><br><table align='center'border='0'>
        <tr><td colspan='2' align='right'><b>$fecha_modificada</b></td></tr>
        <tr><td colspan='2'><form name='form1' method='post' action='mensaje.php'>
        <b>Asunto</b>   
            <input type='text' name='asunto' value='' size='42' maxlength='50'></td></tr>
        <tr><td colspan='2' valign='top'>
            <textarea name='contenido' rows='20' cols='38'></textarea></td></tr>
        <tr align='center'><td>
            <input type='submit' name='enviar' value='Enviar Mensaje'></td>
        </tr></table>";
    }
    echo "<BR><CENTER>".boton_ficticio('Volver a mensajes','foro.php')."</CENTER>";

    imprimir_footer();
?>
