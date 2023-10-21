<?php

$Editor = array ("Agostini", "Planeta", "Paraninfo");

class biblioteca {
	
	function __construct () {
        $this->coleccion=array(); // Matriz con todos los registros
    }
   
	// Añadir un registro a la lista
	function add_registro($titulo, $autor, $codigo_editor) {
		$book = array("titulo"=>$titulo, "autor"=>$autor, "codigo_editor"=>$codigo_editor);
		array_push($this->coleccion, $book);
	} // end add_registros

	function mostrar() {
		global $Editor;
		echo "<table border=1 ALIGN=center CELLPACING=7 width=400>";
		echo "<td>Título</td><td>Autor</td><td>Editorial</td>";
		foreach ($this->coleccion as $fila) {	
			echo "
			<tr>
				<td ALIGN=center>".$fila["titulo"]."</td>
				<td ALIGN=right>".$fila["autor"]."</td>
				<td ALIGN=right>".$Editor[$fila["codigo_editor"]]."</td>
			</tr>";    
		} // end for
		echo "</table>";	
	} //end mostrar

} //end clase

?>