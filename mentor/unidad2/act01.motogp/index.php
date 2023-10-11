<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1 - Unidad 2 - Curso Iniciación de PHP 5 - Motos GP</title>
</head>
<body bgcolor="#ffff66">
    <CENTER>
	<hr><img src=motos_gp.png>
    <h1> CLASIFICACION </h1>
    <hr>
    <form action='resultado.php' method='post'>
        Seleccione el piloto que desea consultar: 
        <select name='piloto'>
            <option value=1>Jorge Lorenzo</option>
            <option value=2>Hector Barbera</option>
            <option value=3>Valentino Rossi</option>
            <option value=4>Marc Márquez</option>
            <option value=5>Dani Pedrosa</option>
        </select> <br>
        <input type='submit' name='button' value='Buscar'>        
    </form>
    </FORM>

</body>
</html>