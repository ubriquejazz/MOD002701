<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2 - Unidad 3 - Botiquín</title>
</head>
<body bgcolor="green" text="white">
<!---->
<hr>
<table border=0 align=center>
    <tr>
	<td valign=top align="center"><h1>BOTIQU&Iacute;N</td>
	<td valign=bottom rowspan=2>
		<table border=0 align=center width=375><tr>
			<td colspan=2 height=40 align=center>
			  <H3><u>Operaciones con la el botoqu&iacute;n</u></H3>
			</td>
		</tr><tr>
			<td align=right height=30><b>Buscar medicamento&nbsp;&nbsp;&nbsp;</b></font></td>
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
			    <input type="submit" name="listado" value="Ver listado completo de medicamentos">
			    <input type="hidden" name="operacion" value="listado">
			</td>
			</form>
		</tr><tr>
			<form name="form3" method="post" action="index.php">
			<td colspan=2 align=center>
			   <input type="submit" name="listado" value="Ver listado ordenado por nombre">
			   <input type="hidden" name="operacion" value="listado_ordenado">
			</td></form>
		</table></td>
	</tr><tr><td align=center><img src=botiquin.jpg></td></tr>
	</table>	

    <hr>

    <?php

        require "datos.php";

        if (!isset($_POST["operacion"])) $op = '';
        else $op = $_POST["operacion"];

        if (!isset($_POST["nombre"])) $nombre = '';
        else $nombre = $_POST["nombre"];

        $filas = 0; // contiene el numero de filas encotradas
        if ($op != '') {
            echo "<TABLE border=1 align=center width=600>
                <TR><TD><B>Nombre</B></TD>
                <TD><B>Tipo</B></TD>
                <TD><B>Precio</B></TD>
                <TD><B>Descripcion</B></TD></TR>";

            if($op == 'buscar') {
                // buscar medicamento por $nombre
                $filas = mostrar_fila ($botiquin, $nombre);                                 
            }
            else if ($op == 'listado') {
                // listado completo de medicamentos
                $filas = mostrar_fila ($botiquin, '');
            }
            else if ($op == 'listado_ordenado') {
                // listado por ordenado nombre
                asort($botiquin);
                $filas = mostrar_fila ($botiquin, '');
            }
            echo "</TABLE><center>El nº de medicamentos encontrados es: " . $filas . "</center>";
        }
    ?>
</body>
</html>