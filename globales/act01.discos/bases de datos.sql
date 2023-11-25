USE ejercicios;


#
# Table structure for table 'discos'
#

DROP TABLE /*!32312 IF EXISTS*/ discos;
CREATE TABLE /*!32312 IF NOT EXISTS*/ discos (
  id tinyint(5) unsigned NOT NULL auto_increment,
  titulo varchar(100) NOT NULL DEFAULT '' ,
  interprete varchar(50) NOT NULL DEFAULT '' ,
  estilo varchar(50) ,
  casa_discografica varchar(50) ,
  formato varchar(50) ,
  duracion int(3) unsigned ,
  anio int(4) unsigned ,
  imagen varchar(255),
  PRIMARY KEY (id),
  KEY titulo (titulo),
  KEY interprete (interprete)
);


#
# Dumping data for table 'discos'
#
INSERT INTO discos VALUES("1","Por la boca vive el pez","Fito y Fitipaldis","Rock","Universal","CD","100","2007","fito.jpg");
INSERT INTO discos VALUES("4","Vivir para contarlo","Violadores del verso","RAP","","CD","70","2006","doblev.jpg");
INSERT INTO discos VALUES("12","As I Am","Alicia Keys","Soul, Funk, R&B","Universal","CD","100","2007","imagen_alicia_keys.jpg");
