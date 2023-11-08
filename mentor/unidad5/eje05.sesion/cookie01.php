<?php
	// Formateamos la fecha actual
	setlocale(LC_ALL,"spanish");
	$fecha_nueva=strftime("%d de %B de %Y %H:%M:%S");
	
	// Si el usuario ha pulsado el botón Borrar cookie entonces la borramos
	if (isset($_POST['borrar'])) {

		// Vemos si hay definidas cookies
		if (isset($_SERVER['HTTP_COOKIE'])) {

			// Separamos todas las cookies mediante el caracter ";"
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			
			foreach($cookies as $cookie) {
				$partes = explode('=', $cookie);		// separamos en partes el contenido de la cookie
				$nombre = trim($partes[0]);				// nombre de la cookie en la posicion 0
				setcookie($nombre, '', time()-1000);	// tiempo anterior al actual
			}
		}
		// Texto nuevo al visitante
		$fecha_ultima = "Se ha borrado el histórico de visitas.";
		$contador=0;
	}
	else if (isset($_COOKIE["contador"]))   
	{
		// Si existe la cookie contador, aumentamos el contador de visitas
		$contador=$_COOKIE["contador"];   
		$contador++;

		// Recorremos en orden inverso el cookie "fecha" que es de tipo matriz
		$fecha_ultima = "Las últimas veces que nos visitó fue en :<P>";
		for ($i=sizeof($_COOKIE["fecha"]); $i>0; $i--) {
			$fecha_ultima .= $_COOKIE["fecha"][$i]. "<P>";
		}

		// Guardamos en el elemento $contador de la matriz fecha 
		setcookie("fecha[$contador]",$fecha_nueva, time()+3600000);
		setcookie("contador",$contador, time()+3600000); 
	}
	else  //si la cookie no existe, la creamos
	{		
		$fecha_ultima = "Ésta es la primera vez que nos visita";
		setcookie("fecha[1]",$fecha_nueva, time()+3600000);
		setcookie("contador",1, time()+3600000); 
		$contador=1;
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ejemplo 2 - Unidad 5</title>
</head>
<body>
	<center>
	<H1>CONTROL VISITAS PAGINA CON COOKIES</H1><BR>
	 <FORM method="post" action="cookie01.php">
		<INPUT TYPE="submit" name="borrar" value="Borrar cookie"> 
		<INPUT TYPE="submit" name="recargar" value="Recargar página">
     </FORM>

	<?php
		echo "<P><TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
			<TR>
				<TH colspan='2' width='100%' bgcolor='blue'>&nbsp;
				<FONT size='2' color='white' face='arial, helvetica'>
					Usted ha visitado esta página ". $contador . " veces.<P>" .
					$fecha_ultima . "</FONT>&nbsp
				</TH>
			</TR></TABLE>";
	?>
	</center>
</body>
</html>