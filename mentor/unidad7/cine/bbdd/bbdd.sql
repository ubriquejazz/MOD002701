USE ejercicios;


DROP TABLE cine;
CREATE TABLE cine (
  Id tinyint(3) unsigned NOT NULL auto_increment,
  nombre_cine varchar(100) NOT NULL DEFAULT '' ,
  nombre_peli varchar(100) NOT NULL DEFAULT '' ,
  descripcion varchar(200) ,
  sesion1 time NOT NULL DEFAULT '00:00:00' ,
  sesion2 time NOT NULL DEFAULT '00:00:00' ,
  sesion3 time NOT NULL DEFAULT '00:00:00' ,
  nume_filas tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  nume_asientos tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  PRIMARY KEY (Id),
  KEY nombre_cine (nombre_cine)
);


INSERT INTO cine VALUES("1","Odeón","El nombre de la rosa","El nombre de la rosa narra las actividades detectivescas de Guillermo de Baskerville para esclarecer los crímenes cometidos en una abadía benedictina...","16:00:00","19:00:00","22:00:00","10","15");
INSERT INTO cine VALUES("2","Odeón","Matrix","Existen dos realidades: una consiste en la vida que vivimos cada día. Y otra se encuentra detrás de ella. Una es sueño. La otra es Matrix.","16:30:00","19:10:00","23:00:00","15","20");
INSERT INTO cine VALUES("3","La torre","Ice Age La edad de hielo","Veinte mil años atrás. La Tierra es un mundo prehistórico maravilloso y lleno de peligros, así como también lo son los inicios de la Edad de Hielo.","12:00:00","16:00:00","18:00:00","10","10");


DROP TABLE cine_entradas;
CREATE TABLE cine_entradas (
  Id tinyint(6) unsigned NOT NULL auto_increment,
  Id_cine tinyint(3) unsigned NOT NULL DEFAULT '0' ,
  sesion tinyint(1) unsigned NOT NULL DEFAULT '0' ,
  fila tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  asiento tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  dia date NOT NULL DEFAULT '0000-00-00' ,
  PRIMARY KEY (Id)
);


INSERT INTO cine_entradas VALUES("1","1","2","4","5","2006-10-27");
INSERT INTO cine_entradas VALUES("2","1","3","2","3","2006-10-27");
INSERT INTO cine_entradas VALUES("3","1","3","4","3","2006-10-27");
INSERT INTO cine_entradas VALUES("4","1","3","5","6","2006-10-27");
INSERT INTO cine_entradas VALUES("5","1","3","6","2","2006-10-27");
INSERT INTO cine_entradas VALUES("6","1","3","7","8","2006-10-27");
INSERT INTO cine_entradas VALUES("7","1","3","7","7","2006-10-27");
INSERT INTO cine_entradas VALUES("8","1","3","5","7","2006-10-27");
INSERT INTO cine_entradas VALUES("9","1","3","4","2","2006-10-27");
INSERT INTO cine_entradas VALUES("10","1","3","2","2","2006-10-27");
INSERT INTO cine_entradas VALUES("11","1","3","6","3","2006-10-27");
INSERT INTO cine_entradas VALUES("12","1","3","6","4","2006-10-27");
INSERT INTO cine_entradas VALUES("13","1","2","4","4","2006-10-27");
INSERT INTO cine_entradas VALUES("14","1","2","4","3","2006-10-27");
INSERT INTO cine_entradas VALUES("15","1","2","4","2","2006-10-27");
INSERT INTO cine_entradas VALUES("16","1","2","4","1","2006-10-27");
INSERT INTO cine_entradas VALUES("17","1","1","6","4","2006-10-27");
INSERT INTO cine_entradas VALUES("18","1","1","6","5","2006-10-27");
INSERT INTO cine_entradas VALUES("19","1","1","6","6","2006-10-27");
INSERT INTO cine_entradas VALUES("20","1","1","6","7","2006-10-27");
INSERT INTO cine_entradas VALUES("21","1","2","7","7","2006-10-28");
INSERT INTO cine_entradas VALUES("22","1","2","6","7","2006-10-28");
INSERT INTO cine_entradas VALUES("23","2","1","5","6","2006-10-27");
INSERT INTO cine_entradas VALUES("24","2","1","5","7","2006-10-27");
INSERT INTO cine_entradas VALUES("25","2","1","5","9","2006-10-27");
INSERT INTO cine_entradas VALUES("26","2","1","5","8","2006-10-27");
INSERT INTO cine_entradas VALUES("27","3","1","7","5","2006-10-27");
INSERT INTO cine_entradas VALUES("28","3","1","7","4","2006-10-27");
INSERT INTO cine_entradas VALUES("29","3","1","7","3","2006-10-27");
INSERT INTO cine_entradas VALUES("30","3","1","7","2","2006-10-27");
