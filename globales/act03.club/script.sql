

USE ejercicios;

CREATE TABLE cuotas (
  id tinyint(3) unsigned NOT NULL auto_increment,
  fecha date NOT NULL DEFAULT '0000-00-00' ,
  importe float NOT NULL DEFAULT '0' ,
  id_socio tinyint(3) unsigned NOT NULL DEFAULT '0' ,
  PRIMARY KEY (id),
  KEY dni (id_socio)
);

INSERT INTO cuotas VALUES("1","2007-12-01","12.23","1");
INSERT INTO cuotas VALUES("2","2007-12-21","1.95","1");

CREATE TABLE socios (
  id tinyint(3) unsigned NOT NULL auto_increment,
  nombre varchar(100) ,
  apellidos varchar(150) NOT NULL DEFAULT '' ,
  dni varchar(9) NOT NULL DEFAULT '' ,
  domicilio varchar(150) ,
  localidad varchar(100) ,
  PRIMARY KEY (id),
  UNIQUE dni (dni),
  KEY apellidos (apellidos)
);

INSERT INTO socios VALUES("1","Pedro","Sanz","321312321","La Paz, 3","Tres Cantos");
INSERT INTO socios VALUES("2","Elisa","Gordillo","423423432","Yelmo, 24","Barcelona");
