<?php
	class coleccion {
					
		public function __construct() {
			$this->la_coleccion=array(); // Matriz con todos los discos
		}

		// Anadir una disco a la lista
		function add_disco ($titulo, $interprete, $discografica, $anio) {
			$disco = array("titulo"=>$titulo, "interprete"=>$interprete, 
						"discografica"=>$discografica, "anio"=>$anio);
			array_push($this->la_coleccion, $disco);
		}

		// Funcion que devuelve el n� de discos = tama�o de la matriz    		
		function nume_discos () {
			return sizeof($this->la_coleccion);
		}
		
		// Funcion que imprime todos los discos en una tabla
		function list_discos($ordenado) {
			//Ordenamos la matriz si el usuario lo ha pedido
			if ($ordenado) sort($this->la_coleccion);

			echo "<TABLE border=1 align=center width=600>
				<TR><TD><FONT color=red><B>T&iacute;tulo</B></FONT></TD>
					<TD><FONT color=red><B>Interprete</B></FONT></TD>
					<TD><FONT color=red><B>Discografica</B></FONT></TD>
					<TD><FONT color=red><B>A&ntilde;o</B></FONT></TD></TR>";

			for ($i=0;$i<sizeof($this->la_coleccion);$i++){
				echo "<TR><TD><B>".$this->la_coleccion[$i]["titulo"]."</B></TD>
						<TD><B>".$this->la_coleccion[$i]["interprete"]."</B></TD>
						<TD><B>".$this->la_coleccion[$i]["discografica"]."</B></TD>
						<TD><B>".$this->la_coleccion[$i]["anio"]."</B></TD></TR>";
			}//end bucle for

			echo "</TABLE>";
			return $this->nume_discos();
		} //end funcion list_discos
    		
		// Funcion que busca $lo_q_busco e imprime los registros que coincidan parcialmente.
		function buscar($lo_q_busco) {    			
			$total=0;
			if (($lo_q_busco) == "") echo "No se ha introducido ninguna palabra";
			else {
    				
				echo "<center>Los discos que contienen '<b>$lo_q_busco</b>' en el campo 't&iacute;tulo' o en el 'int�rprete' son: </center><P>";
									
				echo "<TABLE border=1 align=center width=600>
					<TR><TD><FONT color=red><B>T&iacute;tulo</B></FONT></TD>
					<TD><FONT color=red><B>Interprete</B></FONT></TD>
					<TD><FONT color=red><B>Discografica</B></FONT></TD>
					<TD><FONT color=red><B>A&ntilde;o</B></FONT></TD></TR>";

				for ($i=0;$i<sizeof($this->la_coleccion);$i++){
					if ((stristr($this->la_coleccion[$i]["titulo"], $lo_q_busco)) || 
					    (stristr($this->la_coleccion[$i]["interprete"], $lo_q_busco))) 
					{
					  echo "<TR><TD><B>".$this->la_coleccion[$i]["titulo"]."</B></TD>
							<TD><B>".$this->la_coleccion[$i]["interprete"]."</B></TD>
							<TD><B>".$this->la_coleccion[$i]["discografica"]."</B></TD>
							<TD><B>".$this->la_coleccion[$i]["anio"]."</B></TD></TR>";
					  $total++;
					}
				}//end bucle for
				echo "</TABLE>";
				return $total;
			}//end else
		} //end funcion buscar
   
	} // Final de la clase coleccion

?>