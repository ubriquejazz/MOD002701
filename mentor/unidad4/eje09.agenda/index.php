<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    require ("funciones.php");
    require ("agenda.php");
    $mi_agenda=new agenda();
    
?>
    <CENTER><P><TABLE border=0 width=600>
		<TR><TD colspan="2"><HR></TD></TR>
		<TR><TD valign=top align=right>
			<FORM METHOD="POST" ACTION="index_agenda.php?operacion=buscar">
			<FONT size ="-1" face="arial, helvetica"> Buscar contacto</FONT></TD>
			<TD><INPUT TYPE="TEXT" NAME="buscar_edit" size="20"> 
			<INPUT TYPE="SUBMIT" NAME="buscar"  VALUE="¡Buscar!">
			</FORM></TD></TR>
		<TR><TD colspan="2"><HR></TD></TR>
	</TABLE></CENTER>
		
	<TABLE BORDER="0" cellspacing="1" cellpadding="1" align="center" width="600">
	<TR><TD><FONT size ="-1" face="arial, helvetica">
		El nº total de contactos es: <?php echo $mi_agenda->numero_contactos;?></LEFT></FONT><P></TD><TD valign=top align=right>		
		<?php echo boton_ficticio("Ver listado completo","index_agenda.php?operacion=listado"); ?>
		</TD>
	</TR></TABLE>
</body>
</html>