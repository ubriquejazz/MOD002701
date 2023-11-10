<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="#C0C0C0" link="green" vlink="green" alink="green">
    <center>
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="650">
        <TR><TH colspan="2" width="100%" bgcolor="green"><FONT size="6" color="white">Comprar entradas de teatro</FONT></TH></TR>
    </TABLE><P>
    <TABLE border='0' width='600'>
    <TR>
        <TD valign=top align=CENTER colspan=2>
        <H2> ¡Bienvenid@ a la página de reserva de localidades!    </H2><BR></TD>
    </TR></TABLE>

    <TABLE BORDER='0' cellspacing='1' cellpadding='0' align='center' width='200'>
        <TR><TD align=center>Escenario<BR><HR></TD></TR>
    </TABLE><BR>
    
    <TABLE BORDER='0' cellspacing='3' cellpadding='0' align='center'>
        <?php
            
            $num = $_COOKIE["num_entradas"]; // para guardar el número de entradas compradas
            $matriz = $_COOKIE["asientos"]; // para almacenar los asientos comprados (matriz)

            $color='lime';
            for ($i=0; $i<15; $i++) {
                echo "<TR><TD><font size=1>".($i+1)."</font></TD>";
                for ($j=0; $j<20; $j++) 
                    echo "<TD bgcolor=".$color.">
                        <A href=index.php?operacion=exec_comprar&la_fila=".$i."&el_asiento=".$j."&accion=0>
                        <img src=1px.gif height=10 width=10 border=1></A></TD>";
                echo "</TR>";
            }
            echo "<TR><TD><img src=1px.gif height=10 width=10 border=0></TD>";
            for ($i=0; $i<20; $i++)
                echo"<TD><font size=1>".($i+1)."</font></TD>";
        ?>

    <TABLE>
        <TR><TD bgcolor=lime><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca libre.</font></TD></TR>
        <TR><TD bgcolor=orange><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca reservada.</font></TD></TR>
        <TR><TD bgcolor=red><img src=1px.gif height=10 width=10 border=1></TD><TD><font size=2>Butaca ocupada.</font></TD></TR>
    </TABLE>
    </center>
</body>
</html>