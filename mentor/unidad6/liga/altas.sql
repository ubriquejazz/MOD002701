# Base De Datos : `LIGA_BALONCESTO`

CREATE DATABASE LIGA_BALONCESTO;

# Abrimos la base de datos ejercicios
USE LIGA_BALONCESTO;

# Estructura de tabla `EQUIPOS`

CREATE TABLE EQUIPOS (
  registro int(4) unsigned NOT NULL auto_increment,
  nombre varchar(30) NOT NULL default '',
  nombre_entrenador varchar(35) NOT NULL default '',  
  nombre_cancha varchar(30) default NULL,  
  poblacion varchar(25) default NULL,
  anio_fundacion int(4) unsigned NOT NULL,
  anotaciones text,
  PRIMARY KEY  (registro),
  UNIQUE KEY registro (registro),
  KEY nombre (nombre)
) COMMENT='Tabla de EQUIPOS de la liga';

# Datos para la tabla `EQUIPOS`

INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (1, 'F.C. Barcelona', 'Dusko Ivanovic', 'Palau Blaugrana', 'BARCELONA', 1926, 'Ganador de copa de Europa');
INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (2, 'Real Madrid', 'Joan Plaza', 'Palacio de Vistalegre', 'MADRID', 1932, 'Ganador de copa de Europa y varias ligas');
INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (3, 'CB Estudiantes', 'Pedro Mart�nez', 'Madrid Arena', 'MADRID', 1948, '');
INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (4, 'Unicaja Malaga', 'Sergio Scariolo', 'Palacio de Deportes', 'MALAGA', 1992, 'Ganador de la liga ACB 2006');
INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (5, 'Caja San Fernando', 'Manel Comas', 'Palacio deportes San Pablo', 'SEVILLA', 1987, '');
INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (6, 'TAU Ceramica', 'Velimir Perasovic', 'Fernando Buesa Arena', 'VITORIA', 1959, '');
INSERT INTO EQUIPOS (registro, nombre, nombre_entrenador, nombre_cancha, poblacion, anio_fundacion,  anotaciones) 
			VALUES (7, 'Joventut de Badalona', 'Aito Garcia Reneses', 'Pabell�n Ol�mpico de Badalona', 'BADALONA', 1930, '');
		
# Datos para la tabla `PARTIDOS`

CREATE TABLE PARTIDOS (
  registro int(4) unsigned NOT NULL auto_increment,
  id_equipo1 int(4) unsigned NOT NULL,
  id_equipo2 int(4) unsigned NOT NULL,
  resultado_equipo1 int(3) unsigned NOT NULL,
  resultado_equipo2 int(3) unsigned NOT NULL,
  PRIMARY KEY  (registro),
  UNIQUE KEY registro (registro)  
) COMMENT='Tabla partidos jugados';


INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (1, 1, 7, 100, 99);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (2, 1, 3, 66, 45);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (3, 2, 3, 68, 92);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (4, 7, 1, 50,60);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (5, 5, 1, 76, 45);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (6, 2, 1, 99, 98);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (7, 6, 1, 101, 103);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (8, 6, 2, 80, 85);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (9, 3, 5, 80, 80);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (10, 3, 1, 57, 65);
INSERT INTO PARTIDOS (registro, id_equipo1, id_equipo2, resultado_equipo1, resultado_equipo2) VALUES (11, 3, 2, 67, 58);


# --------------------------------------------------------

# Ejercicio 4. Mostrar la informaci�n introducida de la forma siguiente:

# Todos los campos de todos los registros de la tabla equipos.

SELECT * FROM EQUIPOS;

# Los campos nombre, entrenador y nombre de cancha s�lo de los equipos
# de una determinada poblaci�n.

SELECT NOMBRE, NOMBRE_ENTRENADOR, NOMBRE_CANCHA
FROM EQUIPOS
WHERE POBLACION = 'MADRID';

# El nombre, poblaci�n y anotaciones de los equipos
# cuyo nombre empieza por el car�cter 'C'

SELECT NOMBRE, POBLACION, ANOTACIONES
FROM EQUIPOS
WHERE NOMBRE LIKE "C%";

# El n�mero de equipos y poblaci�n agrupados por la poblaci�n ordenados decrecientemente 
# por el n�mero de equipos

SELECT count(*) as TOTAL_EQUIPOS, POBLACION
FROM EQUIPOS
GROUP BY POBLACION
ORDER BY TOTAL_EQUIPOS desc;

# A�o de la fundaci�n del equipo m�s antiguo de la liga.
SELECT MIN(ANIO_FUNDACION)
FROM EQUIPOS;

# Partidos jugados: nombre del equipo1, nombre del equipo2, resultado equipo1, resultado equipo2
# ordenados por el nombre del equipo1. Ayuda: es recomendable usar renombramiento de tablas con 3 
# tablas en el SELECT. (Por ejemplo: EQUIPOS A, PARTIDOS B, EQUIPOS C)

SELECT A.NOMBRE, B.resultado_equipo1, C.NOMBRE, B.resultado_equipo2
FROM EQUIPOS A, PARTIDOS B, EQUIPOS C
WHERE A.registro=B.id_equipo1 and C.registro=B.id_equipo2
ORDER BY A.NOMBRE;

# N� total de partidos jugados y nombre del equipo ordenado decrecientemente por el n�
# de partidos jugados. 
# Nota: si te resulta muy complicada esta soluci�n, puedes hacer los c�lculos de los partidos 
# jugados a la ida, a la vuelta y sumar los resultados a mano para cada equipo.

SELECT count(*) as partidos_jugados, A.NOMBRE
     FROM EQUIPOS A, PARTIDOS B
     WHERE A.registro=B.id_equipo1
     GROUP BY A.NOMBRE;

SELECT count(*) as partidos_jugados, A.NOMBRE
     FROM EQUIPOS A, PARTIDOS B
     WHERE A.registro=B.id_equipo2
    GROUP BY A.NOMBRE;