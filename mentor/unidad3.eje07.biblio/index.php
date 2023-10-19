<HTML>
<HEAD><TITLE>Ejemplo 7 - Unidad 3 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

    require "biblioteca.php";

    $la_biblioteca = new biblioteca();

    // Añadimos registros
    $la_biblioteca->add_registro("El médico", "Noah Gordon", 1);
    $la_biblioteca->add_registro("Marina", "Carlos Ruíz Zafón", 2);
    $la_biblioteca->add_registro("El Quijote", "Miguel de Cervantes y Saavedra", 0);

    // Mostramos los registros
    $la_biblioteca->mostrar();

?>

</BODY>
</HTML>