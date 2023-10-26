<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4.1 - Monedero</title>
</head>
<body bgcolor="#C0C0C0" link="white" vlink="white" alink="white">
    <center>  
    <TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600" bgcolor="#669900">
    <TR>	
        <td width=30><img src=cerdito.gif></td>
        <TD align=center><FONT size="6" color="white" face="arial, helvetica">Monedero</FONT></TD>
        <td width=30><img src=cerdito.gif></td>
    </TR>
    </TABLE><P>
                
    <TABLE BORDER=0 cellspacing=2 cellpadding=2 align="center" width="600">
    <TR>
    <TH bgcolor=teal width=300><FONT face="arial, helvetica">
    <A href= index.php?ordena_por_campo=concepto&id=-1&buscar_texto= alt="Ordenar por Concepto">
        Concepto</A></FONT></TH>
    <TH bgcolor=#669900 width=100><FONT face="arial, helvetica">
    <A href= index.php?ordena_por_campo=fecha&id=-1&buscar_texto= alt="Ordenar por Fecha">
        Fecha</A></FONT></TH>
    <TH bgcolor=#669900 width=100><FONT face="arial, helvetica">
    <A href= index.php?ordena_por_campo=importe&id=-1&buscar_texto= alt="Ordenar por Importe">
        Importe (&euro;)</A></FONT></TH>
    <TH bgcolor=#669900 width=100 colspan="2"><FONT color=white face="arial, helvetica">
        Operaciones</FONT></TH>

    <?php

        echo "<TABLE BORDER=\"0\" cellspacing=\"2\" cellpadding=\"2\" align=\"center\" width=\"600\">
            <TR>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Nombre
                </FONT></th>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Apellidos
                </FONT></th>
            <th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Teléfono
                </FONT></th>
            <th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones
                </FONT></th>
            </TR>";	            



        require "funciones.php";
        require "monedero.php";

        echo "<TR><TD>1</TD>";
        echo "<TD>2</TD>";
        echo "<TD>2</TD>";
        echo "<TD>3</TD></TR>";
    ?>
    </TR>
    </TABLE><BR>
    NOTA: es obligatorio rellenar el campo Concepto.<br>
    <a href='http://olivo.mentor.mec.es/cursophp/iniciacion/php_ini_2014/unidad4/act1/'>Jump to Chapter 4</a>  
</center> 
</body>
</html>