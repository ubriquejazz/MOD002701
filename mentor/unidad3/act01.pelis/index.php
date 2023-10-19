<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colección de películas</title>
</head>
<body bgcolor="#FF9900">
<hr>
<table border=0 align=center>
<tr>
	<td valign=top align="center"><h1>COLECCI&Oacute;N DE PELÍCULAS</td>
	<td valign=bottom rowspan=2>
		<table border=0 align=center width=375><tr>
			<td colspan=2 height=40 align=center>
                <H3><u>Operaciones con la colecci&oacute;n</u></H3>
			</td></tr><tr>
			<td align=right height=30><b>Buscar película&nbsp;&nbsp;&nbsp;</b></td>
			<form name="form1" method="post" action="index.php">
			   <td>
			      <input type="text" name="nombre" size="10" maxlength="50" value=""> 
			      <input type="submit" name="buscar" value="Buscar">
			      <input type="hidden" name="operacion" value="buscar">
			    </td>
			</form>
		    </tr><tr>
			<form name="form2" method="post" action="index.php">
                <td colspan=2 align=center>				
                    <input type="submit" name="listado" value="Ver listado completo de películas">
                    <input type="hidden" name="operacion" value="listado">
                </td>
			</form>
		    </tr><tr>
			<form name="form3" method="post" action="index.php">
                <td colspan=2 align=center>
                    <input type="submit" name="listado" value="Ver listado ordenado por titulo">
                    <input type="hidden" name="operacion" value="listado_ordenado">
                </td>
            </form>
        </table>
    </td>
</tr><tr><td align=center><img src=peliculas.png></td></tr>
</table>	
<hr>
    <?php
        require "data.php";

        // Buscamos si se ha pulsado una operacion
	    if (!isset($_POST["operacion"])) $op = '';
        else $op = $_POST["operacion"];

        // Si es $op es buscar, necesitamo la referencia
        if (!isset($_POST["nombre"])) $referencia = '';
        else $referencia = $_POST["nombre"];

        $filas = 0; // numero de filas encontradas
        if ($op != '') {
            if ($op == 'listado') {
                $filas = mostrar_pelis($pelis, '');
            }
            if ($op == 'listado_ordenado') {
                asort($pelis);
                $filas = mostrar_pelis($pelis, '');
            }
            else if ($op == 'buscar') {
                if ($referencia == '') echo "No se ha introducido ninguna palabra";
                else {
                    $filas = mostrar_pelis($pelis, $referencia);
                }
            }
            echo "</TABLE><center>El nº de registros encontrados es: " . $filas . "</center>";
        }
    ?>
</body>
</html>