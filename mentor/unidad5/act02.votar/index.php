<?php

    $preguntas = array (
        "Más de una vez al día",
        "Una vez al día",
        "Una vez a la semana",
        "Una vez al mes",
        "No accedo");

    echo $_POST["voteID"];
    $msg_ok = "<FONT size=3 color=blue>¡Gracias por votar!</FONT><P>";
    $msg_ko = "<FONT size=3 color=red>¡Sólo se permite votar una vez!</FONT><P>";

    // Supongamos que $votos es tu array de votos
    $votos = array(25, 30, 45, 20, 10);
    $totalVotos = array_sum($votos);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor=91E5F2 text=000000 link=000000 vlink=000000>

    <CENTER>
    <BR><?php echo $msg_ok; ?>

    <TABLE border=1><TR><TD>
    <TABLE width=100% border=0 cellspacing=0 cellpadding=10>
        <TR><TD colspan=2 bgcolor=CCCCCC>
            <FONT size=3><B>Encuesta</B></TD></TR>
        <TR><TD bgcolor=FFFFFF><FONT size=3>
        <FORM action="index.php" method="post">
            <BR><FONT size=3><B>¿Cuántas veces accedes a Internet?</B></FONT><BR><BR>
            <INPUT type="radio" name="voteID" value="0"> Más de una vez al día<BR>
            <INPUT type="radio" name="voteID" value="1"> Una vez al día<BR>
            <INPUT type="radio" name="voteID" value="2"> Una vez a la semana<BR>
            <INPUT type="radio" name="voteID" value="3"> Una vez al mes<BR>
            <INPUT type="radio" name="voteID" value="4"> No accedo<BR>
            <INPUT type="hidden" name="total_opciones" value="5"><BR>
            <TD align=LEFT bgcolor=FFFFFF>
                <INPUT type=submit name="boton_votar" value="Votar">
            </TD>
        </FORM>
    </TD></TR></TABLE>
    </TD></TR></TABLE>
    <BR>

    <TABLE cellSpacing=0 cellPadding=2 width="100%" border=0>
    <TR><TD vAlign=top width="100%"><CENTER>
	<TABLE cellspacing=2 cellPadding=0 bgColor=#000000 border=0>
	<TR><TD colspan=2 height=50 bgcolor=CCCCCC>
		<FONT size=3><B>&nbsp;&nbsp; Resultados</B></TD></TR>
       	<TR><TD colspan=2> 
            <TABLE cellSpacing=2 cellPadding=5 bgColor=#ffffff border=0>
            <TR><TD>
                <BR><B>¿Cuántas veces accedes a Internet?</B><BR><BR>
                <TABLE>
                    <?php
                        foreach ($votos as $index => $voto) {
                            $porcentaje = ($voto / $totalVotos) * 100;
                            echo "<TR><TD>" . $preguntas[$index] . "</TD><TD>" . 
                                round($porcentaje, 2) . "% (" . $voto . ")</TD></TR>";
                        }
                    ?>
                </TABLE>   
			</TD></TR>
			</TABLE> <!-- Tabla de resultados -->
		</TD></TR></TABLE>
    </TD></TR>
    </TABLE>
  
    <BR><CENTER>
    <B><FONT color=blue>Nº total de votos: <?php echo $totalVotos ?></FONT></B></CENTER>
    
</body>
</html>