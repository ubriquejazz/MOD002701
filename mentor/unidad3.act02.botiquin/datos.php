<?php

    $tipo = array("Antiseptico", "Materiales", "Analgesicos"); // 0, 1, 2

    function mostrar_fila($matriz, $reference) {
        global $tipo;
        $filas = 0;
        foreach ($matriz as $fila) {
            if (str_contains(strtoupper($fila[0]), strtoupper($reference)) or
                str_contains(strtoupper($tipo[$fila[1]]), strtoupper($reference))) {
                echo "<TR><TD>" . $fila[0] . "</TD>";
                echo "<TD>" . $tipo[$fila[1]] . "</TD>";
                echo "<TD>" . $fila[2] . "</TD>";
                echo "<TD>" . $fila[3] . "</TD></TR>";
                $filas += 1;     
            }
        } 
        return $filas;
    }

    $botiquin = array(
        array("Paracetamol", 2, 7.99, "te quita los dolores"),
        array("Alcohol", 0, 2.33, "para desinfectar termómetros clínicos"),
        array("H2O2", 0, 1.99, "para desinfectar heridas"),
        array("Gasas", 1, 14.99, "limpia y cubre heridas o quemaduras")
    );

?>