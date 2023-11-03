<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4.2 - Farmacia</title>
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

    require "farmacia.php";
    $apoteke = new farmacia(getcwd());




    
    ?>
	<TABLE border=0 width=600>
		<TR><TD colspan="2"><HR></TD></TR>
		<TR><TD valign=top align=right>
			<FORM name="form3" METHOD="POST" ACTION="index.php?operacion=buscar">
				<FONT size ="-1" face="arial, helvetica"> Buscar medicamento</FONT></TD>
				<TD><INPUT TYPE="TEXT" NAME="buscar_edit" size="20"> 
				<INPUT TYPE="SUBMIT" NAME="buscar"  VALUE="¡Buscar!">
			</FORM></TD></TR>
		<TR><TD colspan="2"><HR></TD></TR>
	</TABLE>

    <TABLE BORDER="0" cellspacing="1" cellpadding="1" align="center" width="600">
		<TR>
			<TD><FONT size ="-1" face="arial, helvetica">
				El nº de medicamentos es: <?php echo $apoteke->numero_medicamentos;?></LEFT></FONT><P></TD>
			<TD valign=top align=right>		
			<?php echo boton_ficticio("Ver listado inicial","index.php?operacion=listado"); ?></TD>
		</TR>
	</TABLE>

    NOTA: no se puede repetir el nombre de un medicamento en esta farmacia.
    </center>
</body>
</html>