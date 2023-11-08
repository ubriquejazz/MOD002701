<?php

	require_once "funciones.php";
	
	$resultadoStr="";

	if (isset($_POST["crearcookie"])) {
		if (trim($_POST["tu_nombre"])=='') 
			$resultadoStr .= "ERROR: debes indicar el nombre del usuario.";
		else if (is_numeric($_POST["duracion"]) && $_POST["duracion"]>0 && $_POST["duracion"]<61) {
			$resultadoStr .= update_cookie( $_POST["tu_nombre"], $_POST["duracion"]);
		}
		else 
			$resultadoStr .= "ERROR: en el campo duración debes indicar un número entero entre 1 y 60.";
   	}
   	else if (isset($_POST["borrarcookie"])){
   		setcookie("usuario");
   		$resultadoStr .= "La cookie ha sido borrada. ¡Pulsa el botón 'Actualizar página' para ver el resultado!<P>";		
   	} 
	else if (isset($_COOKIE["usuario"]) and $_COOKIE["usuario"]!="" )
   		$resultadoStr .= "Hola, " . $_COOKIE["usuario"] . 
					". Bienvenido a nuestra página web.<P>
   					La cookie <B>usuario</B> tiene el valor 
					<B>" . $_COOKIE["usuario"] . "</B><P>";
	else
		$resultadoStr .= "¡No hay ninguna cookie almacenada!";
	
	// Añadimos al resultado el formulario
  	$resultadoStr = "<FORM ACTION=\"cookie02.php\" METHOD=POST>
	  	Nombre de usuario: <INPUT TYPE=\"text\" NAME=\"tu_nombre\"><P>
	  	Duración cookie (entre 1 y 60 segundos): <INPUT TYPE=\"text\" NAME=\"duracion\" value=10>
	  	<P><INPUT TYPE=\"submit\" VALUE=\"Crear cookie\" name=\"crearcookie\">
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
	<H1><CENTER>CREACION Y DESTRUCCION COOKIE</H1>
	<?php echo $resultadoStr; ?>
</body>
</html>
