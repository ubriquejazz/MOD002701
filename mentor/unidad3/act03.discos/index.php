<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Unidad 3 - Coleccion de discos</title>
</head>
<body bgcolor="#FF9900">

	<?php

	if (isset($_REQUEST['operacion'])) $operacion=$_REQUEST['operacion'];
	if (isset($_REQUEST['nombre'])) $nombre=$_REQUEST['nombre'];
	if (!isset($nombre)) $nombre="";

	?>

	<table border=0 align=center>
	<tr>
	<td valign=top align="center"><h1><FONT color="red">COLECCI&Oacute;N DE DISCOS</FONT></td>
	<td valign=bottom rowspan=2>
		<table border=0 align=center width=375><tr>
			<td colspan=2 height=40 align=center>
			  <H3><FONT color="red"><u>Operaciones con la colecci&oacute;n</u></FONT></H3>
			</td>
		</tr><tr>
			<td align=right height=30><font color=red><b>Buscar disco&nbsp;&nbsp;&nbsp;</b></font></td>
			<form name="form1" method="post" action="index.php">
			   <td>
			      <input type="text" name="nombre" size="10" maxlength="50" value="<?php echo $nombre; ?>"> 
			      <input type="submit" name="buscar" value="Buscar">
			      <input type="hidden" name="operacion" value="buscar">
			    </td>
			</form>
		</tr><tr>
			<form name="form2" method="post" action="index.php">
			<td colspan=2 align=center>				
			    <input type="submit" name="listado" value="Ver listado completo de discos">
			    <input type="hidden" name="operacion" value="listado">
			</td>
			</form>
		</tr><tr>
			<form name="form3" method="post" action="index.php">
			<td colspan=2 align=center>
			   <input type="submit" name="listado" value="Ver listado ordenado por t&iacute;tulo">
			   <input type="hidden" name="operacion" value="listado_ordenado">
			</td></form>
		</table></td>
	</tr><tr><td align=center><img src=musica.gif></td></tr>
	</table>	
<hr>
<P>
	    
<?php

	require ("discos.php");	

	$mi_coleccion=new coleccion();
	$mi_coleccion->add_disco ("Por la boca vive el pez", "Fito y Fitipaldis", "DRO", "2006");
	$mi_coleccion->add_disco ("Amar es combatir", "Manu", "Warner", "2006");
	$mi_coleccion->add_disco ("Mi sangre", "Juanes", "Universal Music Latino", "2005");
	$mi_coleccion->add_disco ("Voces De Ultrarumba", "Estopa", "SonyBmg", "2005");
	$mi_coleccion->add_disco ("1967-1970 (Blue Album)", "The Beatles", "Capitol", "1993");
	$mi_coleccion->add_disco ("A Bigger Bang", "The Rollings Stones", "Emi", "2005");	
	
	if (isset($operacion)){
		if ($operacion=="listado") {
			$total=$mi_coleccion->list_discos(false);
		} else
		if ($operacion=="buscar") {
			$total=$mi_coleccion->buscar($nombre);
		} 
		if ($operacion=="listado_ordenado") {
			$total=$mi_coleccion->list_discos(true);
		} 
		echo "<center><font color=red>El numero de discos encontrados es: ".$total."</font></center>";		
	} // end if isset($operacion)
	
?>

</body>
</html>