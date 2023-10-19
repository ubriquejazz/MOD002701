<?php


    $genero = array('Comedia', 'Aventuras', 'Thriller',     // 0, 1, 2
                'Historica', 'Alternativo', 'Ciencia');     // 3, 4, 5

    function mostrar_pelis($matriz, $ref) {
        global $genero;
        echo "<TABLE border=1 align=center width=600>";
        echo "<TR><TD><B>T&iacute;tulo</B></TD>
                <TD><B>Director</B></TD>
                <TD><B>G&eacute;nero</B></TD>
                <TD><B>A&ntilde;o</B></TD></TR>";
        $count = 0;
        foreach($matriz as $film) {
            if (str_contains($film[0], $ref) or str_contains($film[1], $ref)) 
            {
                echo "<TR><TD>" . $film[0] . "</TD>";
                echo "<TD>" . $film[1] . "</TD>";
                echo "<TD>" . $genero[$film[2]] . "</TD>";
                echo "<TD>" . $film[3] . "</TD>";
                echo "</TD></TR>";
                $count += 1;
            }
        }
        return $count;
    }

    /*
    El gran dictador 	Charles Chaplin 	Comedia 	1940
    En busca del arca  	Steven Spielberg 	Aventuras 	1981
    Los pájaros 	    Alfred Hitchcock 	Thriller 	1963
    Pulp Fiction 	    Quentin Tarantino 	Alternativo 1994
    The Matrix 	        David Wachowski 	Ciencia  	1999
    2001:una odisea     Stanley Kubrick 	Ciencia  	1968
    Lawrence de Arabia 	David Lean 	        Histórica 	1962
    */

    $pelis = array (
        array("El gran dictador", "Charles Chaplin", 0, 1940),
        array("En busca del arca", "Steven Spielberg", 1, 1981),
        array("Los pajaros", "Alfred Hitchcock", 2, 1963),
        array("Pulp Fiction", "Quentin Tarantino", 4, 1994),
        array("The Matrix", "David Wachowski", 5, 1999),
        array("2001 una odisea", "Stanlay Kubrick", 5, 1968),
        array("Lawrence Arabia", "David Lean", 3, 1962)
    );

?>