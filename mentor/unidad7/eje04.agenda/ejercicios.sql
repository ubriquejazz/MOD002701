-- Script que crea la BD de este ejemplo
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS ejercicios;
USE ejercicios;

-- Estructura Tabla 'agenda'

DROP TABLE IF EXISTS agenda;
CREATE TABLE IF NOT EXISTS agenda (
  registro int(4) unsigned NOT NULL auto_increment,
  Apellidos varchar(150) NOT NULL DEFAULT '' ,
  Nombre varchar(60) ,
  Telefono_oficina varchar(20) ,
  Telefono_movil varchar(20) ,
  email varchar(200) ,
  direccion varchar(150) ,
  localidad varchar(100) ,
  provincia varchar(60) ,
  codigo_postal varchar(5) ,
  telefono varchar(20) ,
  notas blob ,
  PRIMARY KEY (registro),
  KEY apellidos (Apellidos)
) CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Datos tabla 'agenda'
INSERT INTO agenda VALUES("1","García Pérez","Fernando","91-8765432","611-876142","jgarcia@mecd.es","C/ Alicante, 25 - 4º B","Madrid","Madrid","255","91-8765432","Alumno del curso de PHP.");
INSERT INTO agenda VALUES("2","Fernández de Juana","María","91-8044167","291-226974","maria.fernandez@email.com","C/ Escultores, 23 3º J","Tres Cantos","Madrid","255","91-8034567","Secretaria del director");
INSERT INTO agenda VALUES("3","Ortega Mora","Jaime","921-444444","196-555889","jortega@correo.net","C/ La rana, 11 7º L","Aguilafuente","Segovia","255","921-444442","Vecino del pueblo");
INSERT INTO agenda VALUES("4","Robledo Sacristán","Clodoaldo","91-4123836","","","","","","0","","");