# 1. Mostrar todos los campos de todos los registros de las dos tablas:

SELECT * FROM EQUIPOS;
SELECT * FROM PARTIDOS;


# 2. Actualizar los datos de algunos registros de las dos tablas de forma que
# los cambios afecten a varios campos

UPDATE EQUIPOS
SET ANOTACIONES = CONCAT(ANOTACIONES, 'Registro modificado')
WHERE REGISTRO > 4;

UPDATE PARTIDOS
SET RESULTADO_EQUIPO1 = RESULTADO_EQUIPO1 - 10, RESULTADO_EQUIPO2 = RESULTADO_EQUIPO2 + 10
WHERE ID_EQUIPO1 = 1;

# 3. Volver a mostrar todos los campos de todos los registros de las tres tablas

SELECT * FROM EQUIPOS;
SELECT * FROM PARTIDOS;

# 4. Mostrar la informaci�n introducida...

# Mostrar el n�mero de registro, el nombre equipo, la poblaci�n y a�o de fundaci�n 
# de aquellos equipos fundados despu�s de 1980.
SELECT REGISTRO, NOMBRE, POBLACION, ANIO_FUNDACION
FROM EQUIPOS
WHERE ANIO_FUNDACION > 1980;

# Hallar la media de puntos de cada partido entre los dos equipos
SELECT AVG((RESULTADO_EQUIPO1+RESULTADO_EQUIPO2) / 2)
FROM PARTIDOS;

# Hallar la media de la puntuaci�n de cada equipo y nombre del equipo 
# ordenada decrecientemente por el n� de puntos.
SELECT AVG(TABLA.RESULTADO) as media_puntos, NOMBRE FROM (
     SELECT B.resultado_equipo1 as resultado, A.NOMBRE
     FROM EQUIPOS A, PARTIDOS B
     WHERE A.registro=B.id_equipo1
    UNION ALL
     SELECT B.resultado_equipo2 as resultado, A.NOMBRE
     FROM EQUIPOS A, PARTIDOS B
     WHERE A.registro=B.id_equipo2)
as tabla
GROUP BY NOMBRE
order by media_puntos desc;

# Hallar la m�xima diferencia de puntos entre todos los partidos de los equipos a�adiendo el nombre 
# del equipo1 y equipo2 ordenados descrecientemente por el nuevo campo calculado m�xima diferencia de puntos

SELECT A.NOMBRE, C.NOMBRE, ABS(B.resultado_equipo1-1.0*B.resultado_equipo2) as max_diferencia
FROM EQUIPOS A, PARTIDOS B, EQUIPOS C
WHERE A.registro=B.id_equipo1 and C.registro=B.id_equipo2
ORDER BY max_diferencia desc;


# Hallar el mayor n�mero de partidos ganados por cada equipo a�adiendo el nombre del equipo
# y ordenar el resultado decrecientemente por el n� de partidos ganados.
SELECT count(*) as partidos_ganados, A.NOMBRE
     FROM EQUIPOS A, PARTIDOS B
     WHERE A.registro=B.id_equipo1 and B.resultado_equipo1>B.resultado_equipo2
     GROUP BY A.NOMBRE;

SELECT count(*) as partidos_ganados, A.NOMBRE
     FROM EQUIPOS A, PARTIDOS B
     WHERE A.registro=B.id_equipo2 and B.resultado_equipo2>B.resultado_equipo1
     GROUP BY A.NOMBRE;
