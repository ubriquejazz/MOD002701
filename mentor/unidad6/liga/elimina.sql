# 1. Mostrar los campos nombre, nombre del entrenador, nombre de la cancha, poblaci�n y a�o de fundaci�n de todos los equipos

SELECT NOMBRE, NOMBRE_ENTRENADOR, NOMBRE_CANCHA, POBLACION, ANIO_FUNDACION
FROM EQUIPOS;

# 2. Mostrar los campos nombre, nombre del entrenador, nombre de la cancha, poblaci�n y a�o de fundaci�n 
#    de todos los equipos que se hayan jugado ning�n partido.

SELECT NOMBRE, NOMBRE_ENTRENADOR, NOMBRE_CANCHA, POBLACION, ANIO_FUNDACION
FROM EQUIPOS
WHERE REGISTRO NOT IN (SELECT ID_EQUIPO1 FROM PARTIDOS) 
    and REGISTRO NOT IN (SELECT ID_EQUIPO2 FROM PARTIDOS);

# 3. Borrar los equipos que no hayan jugado ning�n partido.

DELETE FROM EQUIPOS 
WHERE REGISTRO NOT IN (SELECT ID_EQUIPO1 FROM PARTIDOS) 
    and REGISTRO NOT IN (SELECT ID_EQUIPO2 FROM PARTIDOS);

# 4. Mostrar los campos nombre, nombre del entrenador, nombre de la cancha, poblaci�n y a�o de fundaci�n 
#    de los equipos no borrados

SELECT NOMBRE, NOMBRE_ENTRENADOR, NOMBRE_CANCHA, POBLACION, ANIO_FUNDACION
FROM EQUIPOS;

# 4. Borrar tablas de la base de datos liga_baloncesto
DROP TABLE equipos;
DROP TABLE partidos;

# 5. Borrar base de datos liga_baloncesto
DROP DATABASE liga_baloncesto;
