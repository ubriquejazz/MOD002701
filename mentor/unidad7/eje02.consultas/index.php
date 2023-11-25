<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<STYLE type="text/css">
	<!--A {font-family: Arial; color: #00FF00}-->
</STYLE></head>
<body>
	<CENTER>
	<FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
	<TABLE width="40%" border="0" cellpadding="2" cellspacing="2">

	<?php 
	
	/* Definimos una matriz con las opciones del menú  */
	$matriz_opciones = array(1=>"Creación BD biblioteca",
							2=>"Consulta de la tabla 'libros'",
							3=>"Libros de la editorial 'Alfaguara'",
							4=>"Flags de algunos campos",
							5=>"Libros prestados y libros devueltos",
							6=>"Libros no devueltos en el año 2013",
							7=>"Número de libros por materias");
							
	for ($i=1; $i<=sizeof($matriz_opciones); $i++) {						
	 	echo ' <TR><TD bgcolor="#333333"> 
		<A href="index.php?tipo='.$i.'"> '. $i. '. '. $matriz_opciones[$i].'
		</A></TD></TR>';
	}

	?>

</TABLE>
</FONT>

<?php 
   
   require("../utilidades.php");
   if (!isset($_GET["tipo"])) exit;
   
   /******** Creación BD biblioteca *********/
   if ($_GET["tipo"]==1) {
	   /* Intentamos establecer una conexión con el servidor.*/
	   $db = conectaBD();
	   
	   /* Si la conexión se ha podido establecer, se informa de ello
	    y de los datos de la misma.*/
	   echo "<H3>Se ha establecido correctamente la conexión.</H3>";
	   echo "<H4>Los datos de la conexión son:
	            <BR>Servidor: " . SERVIDOR . "<BR>Usuario: " . USUARIO . " 
	            <BR>Clave: " . CLAVE. "</H4>";

	   // Ejecutamos la SQL de Creación de BD directamente en el servidor MySQL.
	   $sql = file_get_contents('biblioteca.sql');
	   
	   if ($db->query($sql)) {
	   		print("<H3>La base de datos \"biblioteca\" se ha creado correctamente y 
				sus tablas asociadas también.</H3>");
	   }
	   else {
	   		echo"<H3>No se ha podido crear la base de datos \"biblioteca\". Errores: </H3><PRE>";
	      	print_r($db->errorInfo());
	   		echo "</PRE>";
	   }
	   // Desconectamos y volvemos a conectar a la BD pruebas
	   $db=null;
	} else // end if

	// Consulta de la tabla 'libros' 
	if ($_GET["tipo"]==2) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD('biblioteca');
		$consulta = "select titulo, autor from bis_libros";
		$resultado = $db->query($consulta);
		if (!$resultado) {
			$error=$db->errorInfo();
			print "<p>Error en la consulta. Error ". $error[2] ."</p>\n";
		} else {
			echo "<P>Resultado Consulta de la tabla 'libros':<P>";
			echo "<TABLE border=1><TR><th>Título</th><th>Autor</th></TR>";
			foreach ($resultado as $valor) {
				print "<TR><TD>$valor[titulo]</TD><TD>$valor[autor]</TD></TR>\n";
			}
			echo "</TABLE>";
		} // end else consulta
	}
	else // end if

	// Libros de la editorial 'Alfaguara' 
	if ($_GET["tipo"]==3) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD('biblioteca');
		echo "<CENTER><H3>Ahora vemos algunos datos sólo de los libros 
               <P>de la Editorial Alfaguara ordenados por título.<P></H3></CENTER>";

      	$consulta="select titulo,editorial,anno_publica,paginas,
					precio_euros from bis_libros where editorial='Alfaguara' 
					order by titulo";
      
		$resultado = $db->query($consulta);
		if (!$resultado) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			echo "<P>Resultado Consulta de la tabla 'libros':<P>";
			echo "<TABLE border=1><TR><th>Título</th>
					<th>Editorial</th><th>Año publicación</th><th>Páginas</th><th>Precio</th></TR>";
			
			foreach ($resultado as $valor) {
				print "<TR><TD>$valor[titulo]</TD><TD>$valor[editorial]</TD>
						<TD>$valor[anno_publica]</TD><TD>$valor[paginas]</TD>
						<TD>$valor[precio_euros]</TD></TR>\n";
			}
			echo "</TABLE></P>";
			echo "<CENTER><H4>En la consulta anterior se han visto
					afectados " .  $resultado->columnCount() .  " campos.<P></H4></CENTER>";
		} // end else consulta
	}
	else // end if

	// Propiedades y flags de algunos campos 
	if ($_GET["tipo"]==4) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD('biblioteca');
		echo "<CENTER><H3>Los campos de la tabla \"usuarios\" tienen las siguientes propiedades:<P></H3></CENTER>";
		echo "<P><TABLE border=1><TR><th>Nombre</th>
					<th>Tabla</th><th>Tipo</th><th>Longitud</th></TR>";
		
		// Consulta
      	$consulta="select * from bis_usuarios";
      
		$resultado = $db->query($consulta);
		if (!$resultado) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			for ($i = 0; $i < $resultado->columnCount(); $i++) {
			    $col = $resultado->getColumnMeta($i);
			    print "<TR><TD> $col[name]</TD><TD>$col[table]</TD>
			    <TD>$col[native_type]</TD><TD>$col[len]</TD>\n";
			} // end for
			echo "</TABLE></P>";
		} // end else consulta
	}
	else // end if

	// Libros prestados y libros devueltos 
	if ($_GET["tipo"]==5) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD('biblioteca');
      	$consulta= "select lib.registro as reg_lib,titulo,autor,
                  usu.registro as reg_usu,nombre,apellidos,reg_libro,
                  DATE_FORMAT(fecha_pres, '%d/%m/%Y') as fecha_pres 
				  from bis_libros lib, bis_usuarios usu, bis_prestados
                  where prestado='S' and lib.registro=reg_libro
                  and usu.registro=reg_usu order by titulo";
      
		$resultado = $db->query($consulta);
		
		if (!$resultado) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			echo "<CENTER><H3>En la tabla \"libros\" aparecen ". $resultado->rowCount() ."
		 			libros prestados, que son éstos, ordenados por título:
					<P></H3></CENTER>";
			echo "<P><TABLE border=1><TR><TD>Nº registro</TD>
					<TD>Título</TD><TD>Autor</TD><TD>Nombre</TD><TD>Apellidos</TD><TD>Fecha Préstamo</TD></TR>";
			foreach ($resultado as $valor) {
				print "<TR><TD>$valor[reg_lib]</TD><TD>$valor[titulo]</TD>
						<TD>$valor[autor]</TD><TD>$valor[nombre]</TD>
						<TD>$valor[apellidos]</TD><TD>$valor[fecha_pres]</TD></TR>\n";
			}
			echo "</TABLE></P>";
		} // end else consulta
		// Segunda consulta
		$consulta= "select lib.registro as reg_lib,titulo,autor,
                  usu.registro as reg_usu,nombre,apellidos,reg_libro,
                  DATE_FORMAT(fecha_pres, '%d/%m/%Y') as fecha_pres 
				  from bis_libros lib, bis_usuarios usu, bis_prestados
                  where fecha_dev is null and lib.registro=reg_libro
                  and usu.registro=reg_usu order by titulo";
		
		$resultado = $db->query($consulta);
		
		if (!$resultado) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			echo "<CENTER><H3>En cambio, en la tabla \"prestamos\" sólo
					aparecen estos  ". $resultado->rowCount() ." libros sin fecha de devolución:
					<P></H3></CENTER>";
			echo "<P><TABLE border=1><TR><TD>Nº registro</TD>
					<TD>Título</TD><TD>Autor</TD><TD>Nombre</TD><TD>Apellidos</TD><TD>Fecha Préstamo</TD></TR>";
			foreach ($resultado as $valor) {
				print "<TR><TD>$valor[reg_lib]</TD><TD>$valor[titulo]</TD>
				<TD>$valor[autor]</TD><TD>$valor[nombre]</TD>
				<TD>$valor[apellidos]</TD><TD>";
				if (empty($valor['fecha_pres'])) echo "No tiene";
				else echo $valor['fecha_pres'];
				echo "</TD></TR>\n";
			}
			echo "</TABLE></P>";
		}
	}
	else // end if

	// Libros no devueltos en el año 2013 
	if ($_GET["tipo"]==6) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD('biblioteca');
		$consulta= "select lib.registro as reg_lib,titulo,autor,
                  usu.registro as reg_usu,nombre,apellidos,reg_libro,
                  DATE_FORMAT(fecha_dev, '%d/%m/%Y') as fecha_dev 
				  from bis_libros lib, bis_usuarios usu, bis_prestados
                  where (year(fecha_dev)>2013 or fecha_dev is null)
                  and lib.registro=reg_libro and usu.registro=reg_usu
                  order by titulo";
	
		$resultado = $db->query($consulta);
	
		if (!$resultado) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			echo "<CENTER><H3>En la tabla \"libros\" aparecen ". $resultado->rowCount() ."
		 			libros prestados, que son éstos, ordenados por título:
					<P></H3></CENTER>";
			echo "<P><TABLE border=1><TR><TD>Nº registro</TD>
					<TD>Título</TD><TD>Autor</TD><TD>Nombre</TD><TD>Apellidos</TD><TD>Fecha Devolución</TD></TR>";
			foreach ($resultado as $valor) {
				print "<TR><TD>$valor[reg_lib]</TD><TD>$valor[titulo]</TD>
				<TD>$valor[autor]</TD><TD>$valor[nombre]</TD>
				<TD>$valor[apellidos]</TD><TD>";
				if (empty($valor['fecha_dev'])) echo "No tiene";
				else echo $valor['fecha_dev'];
				echo "</TD></TR>\n";;
			}
			echo "</TABLE></P>";
		} // end else consulta
	}
	else // end if


	// Número de libros por materias
	if ($_GET["tipo"]==7) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD('biblioteca');
		$consulta= "select count(materia) as num_materia, materia as
                 nom_materia from bis_libros group by materia";
	
		$resultado = $db->query($consulta);
	
		if (!$resultado) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			echo "<CENTER><H3>En la tabla \"libros\" aparecen ". $resultado->rowCount() ."
		 			libros prestados, que son éstos, ordenados por título:
					<P></H3></CENTER>";
			echo "<P><TABLE border=1><TR><TD>Nombre materia</TD><TD>Número de libros</TD></TR>";
			foreach ($resultado as $valor) {
				print "<TR><TD>$valor[nom_materia]</TD><TD>$valor[num_materia]</TD></TR>\n";
			}
			echo "</TABLE></P>";
		} // end else consulta
	}

?>
  
</CENTER>

</body>
</html>