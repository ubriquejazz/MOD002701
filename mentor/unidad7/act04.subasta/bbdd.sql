use ejercicios;

CREATE TABLE subasta_articulos (
  id int(11) NOT NULL auto_increment,
  titulo varchar(50) NOT NULL DEFAULT '' ,
  descripcion varchar(254) NOT NULL DEFAULT '' ,
  fecha_publicacion date NOT NULL DEFAULT '0000-00-00' ,
  precio_inicial double NOT NULL DEFAULT '0' ,
  vendido tinyint(1) unsigned DEFAULT '0' ,
  PRIMARY KEY (id),
  KEY titulo (titulo)
);


INSERT INTO subasta_articulos VALUES("1","Libros","Encicloperias varias de Historia del Arte","2004-09-29","250.88","0");
INSERT INTO subasta_articulos VALUES("2","Discos","Coleccion de 3100 discos de vinilo","2004-09-29","345.99","0");
INSERT INTO subasta_articulos VALUES("3","Comics","1200 comics variados","2004-09-29","456.88","0");
INSERT INTO subasta_articulos VALUES("4","Deportes","250 camisetas deportivas","2004-09-29","1400.25","1");

CREATE TABLE subasta_pujas (
  id int(11) NOT NULL auto_increment,
  id_articulo int(11) NOT NULL DEFAULT '0' ,
  nombre varchar(50) NOT NULL DEFAULT '' ,
  fecha date NOT NULL DEFAULT '0000-00-00' ,
  importe double NOT NULL DEFAULT '0' ,
  PRIMARY KEY (id),
  KEY nombre (nombre)
);


INSERT INTO subasta_pujas VALUES("1","4","Clodoaldo","2006-10-27","1500.35");
INSERT INTO subasta_pujas VALUES("2","2","david","2006-10-27","350");
