<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>
    <title>Sesiones</title>
  </head>
  <body>
    <table>
      <tr><th>Nombre</th><th>Valor</th></tr>

        <?php
            session_start();
            foreach ($_SESSION as $nombre => $valor) {
                echo "<tr><td>$nombre</td>";
                echo "<td>$valor</td></tr>";
            }
        ?>

    </table>
  </body>
</html>