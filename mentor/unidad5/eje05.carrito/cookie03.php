<?php

    require_once "funciones.php";

    $resultadoStr="";

    // Uso de $_COOKIE['visita']

    if (isset($_POST["borrarcookie"])){
        setcookie("visita");
        $resultadoStr .= "La cookie ha sido borrada. ¡Pulsa el botón 'Actualizar página' para ver el resultado!<P>";		
    } 
    else if (!isset($_COOKIE['visita'])) {
        setcookie('visita', 1, time() + 3600*24);
        $resultadoStr .= "Bienvenido por primera vez";
    }
    else {
        $visita = $_COOKIE['visita'];
        setcookie('visita', $visita+1, time() + 3600*24);
        $resultadoStr .= "Bienvenido $visita vez"; 
    }
    
	// Añadimos al resultado el formulario
    $resultadoStr = "<FORM ACTION=\"cookie03.php\" METHOD=POST>
        <INPUT TYPE=\"submit\" VALUE=\"Borrar cookie\" name=\"borrarcookie\">
        <INPUT TYPE=\"submit\" VALUE=\"Actualizar página\" name=\"actualizacookie\">
        </FORM>" . $resultadoStr; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php echo $resultadoStr; ?>

</body>
</html>