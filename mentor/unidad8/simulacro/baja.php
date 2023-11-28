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
    if (isset($_REQUEST["num_mensaje"])) $num_mensaje = $_REQUEST["num_mensaje"];

    $apoteke->baja($num_mensaje);
    echo "<center><br><br><br><h3>El mensaje se ha eliminado correctamente</h3></center>";
    
    echo "<BR><CENTER>".boton_ficticio('Volver a mensajes','foro.php')."</CENTER>";
    imprimir_footer();
?>