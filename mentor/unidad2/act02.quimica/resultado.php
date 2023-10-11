<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act 2.2 : Tabla periódica de los elementos</title>
</head>
<body bgcolor="#003399" text='white'>
    <CENTER>
	<HR><img src=imagen.jpg>
    <H1>Tabla Periódica de los Elementos</H1>
    <HR>
    <?php
        require("script.php");
        //print_r($_REQUEST);
        if(!isset($_REQUEST["pepito"])) {
            //redirect("404.php");
            exit();
        }
        else 
            $grupo = $_REQUEST["pepito"];   

    ?>
    El grupo <B><font size=+1> <?php echo $grupo_data[$grupo]; ?></font></B> está formado por los siguientes elementos:
    <table border=1>
        <TR>
		    <TD width=75 align="CENTER"><B> Nombre </B></TD>		
		    <TD width=100 align="CENTER"><B> Nº atómico </B></TD>
	    </TR>
        <?php
            $total = 0;
            for ($i=0; $i < count($elemento_data); $i++) {
                if ($elemento_data[$i][0] == $grupo) {
                    echo "<TR>";            
                    echo "<TD align='CENTER'>".$elemento_data[$i][1]."</TD>";
                    echo "<TD align='CENTER'>".$elemento_data[$i][2]." </TD>";
                    echo "</TR>";   
                    $total++;
                }
            }    
        ?>
    </table>

    <P>N&uacute;mero total: <?php echo $total; ?>
    <P><input type="button" value="<- Volver atr&aacute;s" onclick="history.back();">
    </CENTER>

</body>
</html>