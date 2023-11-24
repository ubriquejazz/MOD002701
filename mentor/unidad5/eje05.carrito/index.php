<?php
    
	require "funciones.php";
	session_start();

	if (isset($_GET["op"]) && $_GET["op"]=="limpiar") {
		$_SESSION = array();
		session_destroy();
		setcookie(session_name(), 123, time() - 1000);
	}

	// Si el usuario indica un producto distinto de vacío
	if ( (isset($_POST["producto"])) && (trim($_POST["producto"])!="") ){
		$encontrado=0;
		
		// Si la variable de sesión productosEnCesta no existe, la creamos
		if (!isset($_SESSION["productosEnCesta"])){
			$_SESSION["productosEnCesta"][$_POST["producto"]]=$_POST["cantidad"];
		} 
		else {	
			foreach($_SESSION["productosEnCesta"] as $k => $v){
				if ($_POST["producto"]==$k){
					$_SESSION["productosEnCesta"][$k] += $_POST["cantidad"];
					$encontrado=1;
				}
			}

			// Si el producto no está ya en la lista, lo añadimos a la variable de sesión productosEnCesta
			if (!$encontrado) 
				$_SESSION["productosEnCesta"][$_POST["producto"]]=$_POST["cantidad"];

		} // end else 
	} // end if 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ejemplo 6 - Unidad 5</title>
</head>
<body bgcolor='#CCCCCC' link='blue' vlink='blue' alink='blue'>


	<TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
		<TR><TH colspan='2' width='100%' bgcolor='yellow'>&nbsp;
			<FONT size='6' color='black' face='arial, helvetica'>Carrito de la compra</FONT>&nbsp
		</TH></TR>
	</TABLE><P>
	<CENTER><TT>

	<TABLE border='0' align='center' cellspacing='0' cellpadding='1' width='600'>
		<TR><TD colspan='2' width='100%' bgcolor='yellow'>
			<FORM action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
				<TR><TD width='100%' bgcolor='white'>		
					Dime el producto <input type="text" name="producto" size="20"></td>
					<TD rowspan='2' valign=middle>
					<input type="submit" value="Añadir a la cesta">
					</TD>
				</TR>
				<TR><TD bgcolor='white'>Cuántas unidades 
					<select name="cantidad" size="1">
						<option value="1" selected>1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						</select></TD>
				</TR></TABLE>
			</FORM>
	</TD></TR></TABLE>

			
	<?php

	// Si existe la variable de sesión productosEnCesta mostramos su contenido en una tabla
	if (isset($_SESSION["productosEnCesta"])){
		tabla_header('carrito');
		// Recorremos todos los elementos de la variable de sesión productosEnCesta (tipo matriz)
		foreach($_SESSION["productosEnCesta"] as $k => $v){
			echo "<TR><TD>".$k."</TD><TD>".$v."</TD></TR>";		
		} 
		echo "</TABLE>";
	}
	?>
	
	<br><a href="index.php?op=limpiar"> Limpiar </a>
	</CENTER></TT>
</body>
</html>
