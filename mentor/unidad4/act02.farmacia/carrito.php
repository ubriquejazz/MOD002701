<?php
    
	session_start();

	if (isset($_GET["op"]) && $_GET["op"]=="limpiar") {
		$_SESSION = array();
		session_destroy();
		setcookie(session_name(), 123, time() - 1000);
	}
    if (isset($_GET["op"]) && $_GET["op"]=="limpiar") {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<BODY bgcolor="#C0C0C0" link="white" vlink="white" alink="white">
    <center>
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600" bgcolor="orange">
        <TR>	
            <td width=30><img height=70 width=70 src=medicina.gif></td>
            <TD align=center><FONT size="6" color="white" face="arial, helvetica">Farmacia</FONT></TD>
            <td width=30><img height=70 width=70 src=medicina.gif></td>
        </TR>
    </TABLE><P>

    <?php

    echo'<P>El contenido de la cesta de la compra es:<br>';
    echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" width=\"600\">
        <TR>
            <th bgcolor=\"yellow\"><FONT color=\"black\" face=\"arial, helvetica\">
            Artículo</FONT></th>
            <th bgcolor=\"yellow\"><FONT color=\"black\" face=\"arial, helvetica\">
            Cantidad</FONT></th>
        </TR>";	

	// Si existe la variable de sesión productosEnCesta mostramos su contenido en una tabla
	if (isset($_SESSION["productosEnCesta"])){
		
		// Recorremos todos los elementos de la variable de sesión productosEnCesta (tipo matriz)
		foreach($_SESSION["productosEnCesta"] as $k => $v){
			echo "<TR><TD>".$k."</TD><TD>".$v."</TD></TR>";		
		} 
	}
    echo "</TABLE>";
	?>
	
	<br><a href="carrito.php?op=limpiar"> Limpiar </a>
    <br><a href="index.php"> Volver </a>

</body>
</html>