<?php
    
    session_start();

    require_once "asientos.php";
    require_once "funciones.php";
    $obraTeatro = new asientos(getcwd());
    $mensaje = '';
 
    if(!isset($_SESSION['historial']))
        $_SESSION['historial'] = array();

    if(!isset($_SESSION['butacas']))
        $_SESSION['butacas'] = 0;

    switch ($_REQUEST['operacion'])
    {
        case 'comprar':
            $f = $_REQUEST['la_fila'];
            $c = $_REQUEST['el_asiento'];
            $ubic = '';
            
            //comprobar que ese asiento no esta ya incluido en historial
            for($i=0; $i<sizeof($_SESSION['historial']); $i++)
            {
                if($_SESSION['historial'][$i][0] == $f && $_SESSION['historial'][$i][1] == $c)
                    $ubic = $i;
            }

            // ese asiento es nuevo, incremento 
            if(sizeof($_SESSION['historial'])<5 && $ubic == ''){
                array_push($_SESSION['historial'], [$f, $c]);
                $_SESSION['butacas']++;
                $mensaje = "Butaca seleccionada correctamente";
            }

            // ese asiento ya esta en el historial
            else if($ubic != '') {
                array_splice($_SESSION['historial'],$ubic,1);
                $_SESSION['butacas']--;
                $mensaje = "Butaca deseleccionada correctamente";
            }
            break;

        case 'confirm':

            $butacas = $_SESSION['historial'];
            $obraTeatro->reservar($butacas);
            $_SESSION['butacas'] += sizeof($_SESSION['historial']);
            $_SESSION['historial'] = array();
            $mensaje = "La reserva se realizó con exito";
            break;

        case 'reset':

            if(isset($_COOKIE['PHPSESSID']))
            {
                setcookie('PHPSESSID', '', time() - 3600, '/');
                header('Location: index.php');
                exit;
            }
            break;
    }

    echo $_SESSION['butacas'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sala de asientos</title>
</head>

<body bgcolor="#C0C0C0" link="green" vlink="green" alink="green">
    <center>
    <table border="0" align="center" cellspacing="3" cellpadding="3" width="650">
        <tr>
            <th colspan="2" width="100%" bgcolor="green"><FONT size="6" color="white">Comprar entradas de teatro</FONT>
            </th>
        </tr>
    </table>
    
    <P>

    <table border='0' width='600'>
        <tr>
            <td valign=top align=CENTER colspan=2>
                <H2> ¡Bienvenid@ a la página de reserva de localidades!</H2>
                <BR>
            </td>
        </tr>
        <tr>
            <?php
                echo "<td valign=top align=CENTER colspan=2 >Numero de butacas disponibles para reservar: ".(5-$_SESSION['butacas'])."</td>";
                echo "</tr>";
                echo "<tr> <td valign=top align=CENTER colspan=2>". $mensaje . "</td> </tr>";
            ?>
        
    </table>
    <hr>
    <table BORDER='0' cellspacing='5' cellpadding='0' align='center' width='600'>
        <tr>
            <td bgcolor='green' align=center width=130>
                <FONT size=-1 color='white'>Nombre teatro</FONT>
            </td>
            <td>
                <FONT size=-1><B>Azorín</B></FONT>
            </td>
            <td bgcolor='green' align=center width=130>
                <FONT size=-1 color='white'>Nombre obra teatral</FONT>
            </td>
            <td>
                <FONT size=-1><B>Cosas de la vida</B></FONT>
            </td>
        </tr>
        <tr>
            <td bgcolor='green' align=center width=130>
                <FONT size=-1 color='white'>Sesión</FONT>
            </td>
            <td colspan=3>
                <FONT size=-1>Hora : <B>22:10</B></FONT>
            </td>
            <td colspan=3>
                <FONT size=-1>Día : <B>Martes<B></FONT>
            </td>
        </tr>
    </table>
    <br>
    <hr>
    <table BORDER='0' cellspacing='1' cellpadding='0' align='center' width='200'>
        <tr><td align=center>Escenario<BR><hr></td>
        </tr>
    </table>
    
    <BR>
    
    <table BORDER='0' cellspacing='4' cellpadding='0' align='center'>
        <?php
            $asientos = $obraTeatro->leer_mapa();
            imprimir_tablero($asientos);
        ?>

    <table>
        <tr><td bgcolor=lime><img src=1px.gif height=10 width=10 border=1></td><td><FONT size=2>Butaca libre.</FONT></td></tr>
        <tr><td bgcolor=orange><img src=1px.gif height=10 width=10 border=1></td><td><FONT size=2>Butaca reservada.</FONT></td></tr>
        <tr><td bgcolor=red><img src=1px.gif height=10 width=10 border=1></td><td><FONT size=2>Butaca ocupada.</FONT></td></tr>
    </table>
    <hr>
    <br>
    <form method="post" action="index.php">
        <button type="submit" name="operacion" value="confirm">Confirm</button>
        <button type="submit" name="operacion" value="reset">Reset</button>
    </form>
    </center>
</body>
</html>