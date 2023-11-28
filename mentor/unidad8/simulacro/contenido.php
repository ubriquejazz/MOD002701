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

    echo "<BR><CENTER>";
    echo "<h3>" . $matriz[$num_mensaje][4] . "</h3>"; 

    echo boton_ficticio('Eliminar','baja.php?num_mensaje=' . $num_mensaje);
    echo boton_ficticio('Volver a mensajes','foro.php')."</CENTER>";
    imprimir_footer();
?>