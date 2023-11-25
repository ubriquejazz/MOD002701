drop database IF EXISTS biblioteca;

CREATE DATABASE IF NOT EXISTS biblioteca;

USE biblioteca;


#
# Estructura Tabla bis_libros
#

DROP TABLE IF EXISTS bis_libros;
CREATE TABLE IF NOT EXISTS bis_libros (
  Autor varchar(20) NOT NULL DEFAULT '' ,
  Titulo varchar(50) NOT NULL DEFAULT '' ,
  Editorial varchar(20) ,
  Anno_Publica year(4) DEFAULT '2013' ,
  Paginas int(4) unsigned ,
  Precio_euros float(5,3) DEFAULT '0.000' ,
  Prestado set('S','N') DEFAULT 'N' ,
  Materia enum('FIL','LIT','MAT','HIS','ART','INF','OTR','CIE','GEO') DEFAULT 'LIT',
  ISBN varchar(14) NOT NULL DEFAULT '' ,
  Resumen text ,
  Notas blob ,
  Registro mediumint(9) NOT NULL auto_increment,
  PRIMARY KEY (ISBN,Registro),
  UNIQUE Registro (Registro),
  KEY ISBN_2 (ISBN),
  KEY Titulo (Titulo)
);


#
# Datos tabla 'bis_libros'
#
INSERT INTO bis_libros VALUES("Jennings, Gary","El viajero","Planeta","1999","821","15.050","S","LIT","84-08-03310-7","Narra el vieje y aventuras de Marcolo Polo a China","De lectura entretenida y documentada","10");
INSERT INTO bis_libros VALUES("Oliveras, Alberto","Vicente Ferrer. La revolución silenciosa","Planeta Singular","2000","250","25.900","N","OTR","84-08-03501-0","Resume la vida y obra en la India de Vicente Ferrer","El dinero que se saque de su venta se destina ala FudaciÃ³n Vicente Ferrer","19");
INSERT INTO bis_libros VALUES("National Geographic","El reino animal. Los mejores reportajes fotográfic","El País","1996","202","12.850","N","CIE","84-12717-9","Primer volumen dedidcado al Elefante","Excelnetes fotos. Texto simple","27");
INSERT INTO bis_libros VALUES("Fuentes, Carlos","Instinto de Inez","Alfaguara","2001","189","20.550","N","LIT","84-204-4272-0","Dos historias con personajes del mundillo musical","Regalo de un amigo despuÃ©s de mi operaciÃ³n","11");
INSERT INTO bis_libros VALUES("Fábrega, Pedro Pablo","PHP 4","Prentice Hall","2000","352","28.540","N","INF","84-205-3112-X","Explicación del lenguaje informático PHP, versión 4","Aceptable libro de aprendizaje, mÃ¡s teÃ³rico que prÃ¡ctico","14");
INSERT INTO bis_libros VALUES("Messadié, Gerard","Grabdes descubrimientos de la ciencia","Biblioteca Newton","1989","262","18.000","N","CIE","84-206-9163-1","Ordenados de la A a la Z, el autor describe más de 120 descubrimientos de la humanidad de forma clara, breve y sencilla","Dispone de una introducciÃ³n muy acertada","22");
INSERT INTO bis_libros VALUES("Borges, Jorge Luis","Obras completas III","Círculo de Lectores","1993","434","30.450","S","LIT","84-226-4148-8","Abarca el periodo de las obras escritas entre 1964 y 1975: El otro,el mismo; Para las seis cuerdas; Elogio de la sombra; El informe de Brodie; El oro de los tigres; El libro de la arena; y La rosa profunda","Los cuatro tomos fueron el regalo de mi cupleaÃ±os 2000","12");
INSERT INTO bis_libros VALUES("Sopena","Gran Atlas Columbus","Sopena","1981","128","40.000","N","GEO","84-303-0859-8","Atlas mundial","Buena factura, aunque algo antiguo","24");
INSERT INTO bis_libros VALUES("Avilés Farré, Juan","Atlas histórico universal","El País Aguilar","1995","263","38.670","S","HIS","84-30721-7","Buen atlas histórico","Excelentes croquis y mapas","25");
INSERT INTO bis_libros VALUES("Trigos García, Esteb","PHP 4","Anaya Multimedia","2000","284","15.340","S","INF","84-415-1079-2","Funciones del lenguaje PHP 4 para crear páginas dinámicas web","Sencillo manual","15");
INSERT INTO bis_libros VALUES("Camous, Henri","Problemas y jegos con las matemáticas","Gedisa","1995","182","14.500","N","MAT","84-7432-38-4","Propuesta atractiva y lúdica para dominar los temas de matemátidas para alumnos de bachillerato y profesionales","En lenguaje comÃºn se cuestionan las evidencias matemÃ¡ticas","17");
INSERT INTO bis_libros VALUES("Stewart, Ian","Ingeniosos encuentros entre juegos y maemáticas","Gedisa","2000","206","13.670","N","MAT","84-7432-408-4","En 12 jegos se plantea las matemáticas como si fueran un juego","Material extraido de la revista Scientific American","16");
INSERT INTO bis_libros VALUES("Edey, Maitland","Los orígenes del hombre. El eslabón perdido","Time Life Folio","1993","77","10.000","S","HIS","84-7583-366-7","Volumen I de esta prestigiosa obra sobre antropología","Texto muy acertado y buenas fotos","26");
INSERT INTO bis_libros VALUES("Huxley, Aldous","Un mundo feliz","Alfaguara","1989","287","2.250","N","LIT","84-81 30-121-3","Descripción fantástica de un mundo futuro","PrÃ³logo de LucÃ­a EtxebarrÃ­a","6");
INSERT INTO bis_libros VALUES("Cela, Camilo José","La colmena","Espasa Calpe","1985","320","4.240","N","LIT","84-81 30-124-8","En esta obra surge la lengua coloquial, urbana, cotidiana de la clase media en tiempos de la guerra civil española","ColecciÃ³n Mullenium","7");
INSERT INTO bis_libros VALUES("Sábato, Ernesto","El túnel","Alfaguara","2000","128","5.650","N","LIT","84-81 30-133-7","Historia de amor, obsesión, celos y muerte","MartÃ­n Casariego hace una excelente introducciÃ³n","8");
INSERT INTO bis_libros VALUES("Stevenson, R. L.","Dr. Jekyll y Mr. Hyde","Unidad Editorial","1975","95","3.250","S","LIT","84-81 30-134-5","La doble personalidad de un mismo personaje dado a las drogas","DiseÃ±o de cubierta e interiores de ZAC. IlustraciÃ³n de ToÃ±o Benavides","4");
INSERT INTO bis_libros VALUES("Defoe, Daniel","Robinson Crusoe","Bibliotex","1924","318","5.600","S","LIT","84-81 30-140-X","Aventuras de un náufrago en na isla solitaria","Publicada por El Mundo como una de las 100 joyas de la colecciÃ³n Millenium","5");
INSERT INTO bis_libros VALUES("Cortázar, Julio","Las armas secretas y otros relatos","Unidad Editorial","1980","126","1.350","N","LIT","84-81 30-142-6","El primer relato es un inmenso truco para vencer al tiempo, para engañar a la muerte","Excelente prÃ³logo de Fernando R. Lafuente. ColecciÃ³n Millenium de El Mundo","3");
INSERT INTO bis_libros VALUES("Tolstoi, León","Ana Karenina","Unidad Editorial","1999","800","4.560","S","LIT","84-81 30-146-9","Amores desgraciados de la protagonista","Editado en dos tomos en la colecciÃ³n Millenium de El Mundo","1");
INSERT INTO bis_libros VALUES("Baudelaire, Charles","Las flores del mal","Unidad Editorial","1999","253","2.120","S","LIT","84-81 30-152-3","Libro de poemas que pone en evidencia las contradicciones de la vida moderna con vívidas imánes","Traducido por Ãngel LÃ¡zaro y prologado por Rafael Agullol","2");
INSERT INTO bis_libros VALUES("Arguiñano, Karlos","1.069 recetas","Asegarce Debate","1996","723","40.670","N","OTR","84-8306-037-X","Presentación odenada y por temas de las recetas elaboradas por este conocido cocinero vasco","Al final de la obra aparece un breve diccionario de cocina muy bueno","21");
INSERT INTO bis_libros VALUES("Stendhal","Rojo y Negro","Alba","2000","563","12.340","N","LIT","84-8336-092-6","Historia de Julián Sorel en su ascensión hacia el éxito","La traducciÃ³n es muy regular y las incorrecciones abundantes","9");
INSERT INTO bis_libros VALUES("Nietzsche, Friedrich","Así habló Zaratustra","Edimat Libros","1999","303","30.000","S","FIL","84-8403-114-4","Libro considerado como la obra más representativa de este autor, que pone en boca del legendario filósofo persa Zaratustra la quintaesencia de su mensjae: el superhombre, la muerte de Dios, la voluntad de poder y el eterno retorno de los idéntico","Buen estudio preliminar de Enrique LÃ³pez CastellÃ³n","20");
INSERT INTO bis_libros VALUES("Subirana, Rosa María","Museos de España. Museo Picaso","Ediciones Orgaz","1979","131","14.350","N","ART","84-85407-21-0","Excelente descripción de las obras de Picaso alojadas en el Museo Picaso","Las pinturas son lÃ¡minas pegadas sobre las hojas del libro","28");
INSERT INTO bis_libros VALUES("García Guinea, M. Án","Guía turística de Cantabria","Librería Estvdio","1991","311","20.750","N","OTR","84-85429-67-2","Excelente guía que abarca todas las regiones de Cantabria: la costa, Liébana, Valles de Nansa y Saja, Cuenca del Besaya, Cuencas del Pas y Pisueña, Cuencas del Miera y Asón y Campoo-Valderredible","Tiene abundantes fotos y grÃ¡ficos","18");
INSERT INTO bis_libros VALUES("Yarza Luaces, Joaquí","Beato de Liébana. Manuscritos iluminados","Moleiro Editor","1998","325","85.990","N","ART","84-88526-39-3","Comentarios sobre la iluminación del libro con excelentes gráficos del Beato de Liébana a modo de Facsímil","Dos buenas introducciones sobre el ambiente lebaniego y los Apocalipsis en EspaÃ±a","23");
INSERT INTO bis_libros VALUES("Mourad, Konizé","Un jardín en Badalpur","Taller de Mario Much","1998","467","38.760","N","LIT","84-923869-0-8","Segunda parte de De parte de la princesa muerta, donde la hija de la princesa cuenta su vida","Regalo a mi mujer en el verano de 1999","13");


#
# Estructura tabla 'bis_prestados'
#

DROP TABLE IF EXISTS bis_prestados;
CREATE TABLE IF NOT EXISTS bis_prestados (
  registro mediumint(9) unsigned NOT NULL auto_increment,
  reg_libro mediumint(9) unsigned NOT NULL DEFAULT '0' ,
  reg_usu mediumint(9) unsigned NOT NULL DEFAULT '0' ,
  fecha_pres datetime ,
  fecha_dev datetime ,
  notas text ,
  PRIMARY KEY (registro),
  UNIQUE FieldName (registro)
);


#
# Datos de la tabla 'bis_prestados'
#
INSERT INTO bis_prestados VALUES("1","10","3","2013-09-03 00:00:00",NULL,"Debe devolverlo");
INSERT INTO bis_prestados VALUES("2","5","8","2014-10-20 00:00:00","2001-01-12 00:00:00","Fuera de plazo");
INSERT INTO bis_prestados VALUES("3","1","1","2013-09-25 00:00:00",NULL,"Pedirle el libro");
INSERT INTO bis_prestados VALUES("4","11","10","2014-02-28 00:00:00","2001-03-25 00:00:00","Lo devuelve bien");
INSERT INTO bis_prestados VALUES("5","3","2","2013-12-31 00:00:00","2000-05-31 00:00:00","Le gustó mucho");
INSERT INTO bis_prestados VALUES("6","25","9","2014-09-23 00:00:00",NULL,"Reclamar el libro");
INSERT INTO bis_prestados VALUES("7","7","4","2013-03-30 00:00:00","2001-03-30 00:00:00","Tardón");
INSERT INTO bis_prestados VALUES("8","28","7",NULL,NULL,"Pregunta fechas");
INSERT INTO bis_prestados VALUES("9","15","5","2012-01-25 00:00:00",NULL,NULL);
INSERT INTO bis_prestados VALUES("10","9","6","2014-03-20 00:00:00",NULL,"Pedirle opinión si la tiene");


#
# Estructura tabla 'bis_usuarios'
#

DROP TABLE IF EXISTS bis_usuarios;
CREATE TABLE IF NOT EXISTS bis_usuarios (
  Nombre varchar(15) NOT NULL DEFAULT '' ,
  Apellidos varchar(25) NOT NULL DEFAULT '' ,
  DNI varchar(8) NOT NULL DEFAULT '' ,
  Fecha_nacim date ,
  Domicilio varchar(35) ,
  Localidad varchar(30) ,
  Provincia varchar(25) ,
  Sueldo_euros float(8,3) DEFAULT '0.000' ,
  Telefono varchar(10) DEFAULT '0' ,
  E_mail varchar(40) ,
  Notas text ,
  Registro mediumint(1) unsigned NOT NULL auto_increment,
  PRIMARY KEY (Registro),
  UNIQUE Registro (Registro)
);


#
# Datos tabla 'bis_usuarios'
#
INSERT INTO bis_usuarios VALUES("Fernando","García Pérez","12345678","1942-11-30","C/ Alicante, 25 - 4º B","Madrid","Madrid","100000.000","91-8765432","Fernando@teleline.es","Se le pueden prestar libros, pues los devuelve siempre y los lee","1");
INSERT INTO bis_usuarios VALUES("María","Fernández de Juana","23456789","1925-12-25","C/ Escultores, 23 3º J","Tres Cantos","Madrid","85000.563","91-8034567","Maria@pntic.mec.es","Lee mucho de arte","2");
INSERT INTO bis_usuarios VALUES("Jaime","Ortega Mora","01357900","1975-10-30","C/ La rana, 11 7º L","Aguilafuente","Segovia","70000.977","921-444444","rana@wol.es","Presta libros más que leerolos","3");
INSERT INTO bis_usuarios VALUES("Juan","Pereda Hermoso","0246801O","1970-01-01","C/ El león","San Vicente de la Barquera","Santander","35000.000","942-987654","barquera@terra.es","Pide muchos libros prestados","4");
INSERT INTO bis_usuarios VALUES("Inés","Sastre Prieto","12457890","1914-01-28","C/ Alcalá 450 2º B","Madrid","Madrid","100000.000","912357234",NULL,"Ya casi o ve, pero insiste en leer","5");
INSERT INTO bis_usuarios VALUES("Antonia","Perlado Perote","87654321","1925-03-10","C/ La farola, 45 3º A","Sotillos","Ávila","100000.000","676897654","sotifarola@wol.es","No devuelve los libros. ¿Los lee?","6");
INSERT INTO bis_usuarios VALUES("Leoncio","Puga Gamo","98076543","1980-06-02","Avda. Valladolid s/n 3ºIzq.","León","León","100000.000","902879532","vallado@inicia.es",NULL,"7");
INSERT INTO bis_usuarios VALUES("Inmaculada","Soto Linares","13513542","1960-07-15","Avda. los madroños","Sigüenza, 23 5º C","Sigüenza","100000.000","678932121","siguenza@licos.es","Presta mucho","8");
INSERT INTO bis_usuarios VALUES("Jerónimo","Urdiales Pérez","12121212","1932-08-10","Ronda de Segovia, 22 9º J","Madrid","Madrid","100000.000","897654321",NULL,NULL,"9");
INSERT INTO bis_usuarios VALUES("Rosa","Fernández Huertas","86465755","1955-09-18","Travesía de Valencia, s/n 4º G","Valencia","Valencia","100000.000","765432123",NULL,"Pide pocos libros","10");


#
# Estructura tabla 'centros'
#

DROP TABLE IF EXISTS centros;
CREATE TABLE IF NOT EXISTS centros (
  CodCentro varchar(8) NOT NULL DEFAULT '' ,
  Tipo text ,
  DtoInspección text ,
  Centro text ,
  Domicilio text ,
  CodPostal text ,
  Localidad text ,
  Teléfono text ,
  Zona text ,
  AreaT text ,
  PRI tinyint(1) ,
  ESO tinyint(1) ,
  BAC tinyint(1) ,
  Público tinyint(1) ,
  PRIMARY KEY (CodCentro)
);


#
# Dtos tabla 'centros'
#
INSERT INTO centros VALUES("28000595","CP",NULL,"FEDERICO GARCÍA LORCA","C/ MARQUÉS DE LA VALDAVIA, 91","28100","ALCOBENDAS","6624593","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28000601","CP",NULL,"ANTONIO MACHADO","C/ MIRAFLORES, 59","28100","ALCOBENDAS","6526807","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28000649","CC",NULL,"SAN ANTONIO","C/ BARCELONA, 13","28100","ALCOBENDAS","6527169","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28000650","CP",NULL,"BACHILLER ALONSO LÓPEZ","PASEO DE LA CHOPERA, 46","28100","ALCOBENDAS","6618157","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28000662","CC",NULL,"JUAN XXIII","TVSÍA. Pablo PICASO, 3","28100","ALCOBENDAS","6516468","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28000698","PRI",NULL,"EUROPEO LICEO","C/ CAMINO SUR, 10-12","28109","ALCOBENDAS","6501062","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28000753","IES",NULL,"FRANCISCO GINER DE LOS RÍOS","CTRA. DE BARAJAS, KM. 1.400","28100","ALCOBENDAS","6525466","ALCOBENDAS","N","0","1","1","1");
INSERT INTO centros VALUES("28000765","CP",NULL,"DAOIZ Y VELARDE","AVDA. VALDELAPARRA, S/N","28100","ALCOBENDAS","6616095","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28000777","PRI",NULL,"BIENAVENTURADA VIRGEN MARÍA","C/ BEGONIA, 275","28109","ALCOBENDAS","6501500","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28000807","CC",NULL,"SAN VICENTE FERRER","CONJUNTO AVENIDA BLOQUE B-10","28100","ALCOBENDAS","6528983","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28000819","PRI",NULL,"SANTA HELENA","C/ CAMINO ANCHO, 12","28109","ALCOBENDAS","6500317","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28000832","PRI",NULL,"MARY WARD","C/ BEGONIA, 275","28109","ALCOBENDAS",NULL,"ALCOBENDAS","N","0","0","0","0");
INSERT INTO centros VALUES("28001277","CP",NULL,"OBISPO MOSCOSO","C/ RETAMAR, S/N","28110","ALGETE","6290464","ALGETE","N","1","0","0","1");
INSERT INTO centros VALUES("28001678","IES",NULL,"JORGE MANRIQUE","C/ MAR ADRIÁTICO, 2",NULL,"TRES CANTOS","8040964","TRES CANTOS","N","0","1","1","1");
INSERT INTO centros VALUES("28001952","CP",NULL,"PEÑALTA","C/ PEÑALTA, S/N","28730","BUITRAGO DEL LOZOYA","8680107","RURAL","N","1","1","0","1");
INSERT INTO centros VALUES("28001976","CC",NULL,"SANTA MARIA DEL CASTILLO","AVDA. DE MADRID, 16","28730","BUITRAGO DEL LOZOYA","8680150","RURAL","N","0","1","1","0");
INSERT INTO centros VALUES("28001991","CP",NULL,"MONTELINDO","CTRA. VALDEMANCO, S/N","28720","BUSTARVIEJO","8482308","RURAL","N","1","1","0","1");
INSERT INTO centros VALUES("28002014","CP",NULL,"PICO DE LA MIEL","C/ LOS COLEGIOS, S/N","28751","LA CABRERA","8688038","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28002211","CP",NULL,"VILLA DE COBEÑA","C/ LAFUENTE S/N","28863","COBEÑA","6208425","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28002270","CP",NULL,"SOLEDAD SAINZ","C/ AMARGURA, 20","28770","COLMENAR VIEJO","8450878","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28002282","CP",NULL,"VIRGEN DE LOS REMEDIOS","AVDA. LIBERTAD, 5","28770","COLMENAR VIEJO","8452097","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28002312","IES",NULL,"MARQUÉS DE SANTILLANA","C/ ISLA DEL REY, 5","28770","COLMENAR VIEJO","8452114","COLMENAR VIEJO","N","0","1","1","1");
INSERT INTO centros VALUES("28002351","PRI",NULL,"PINOSIERRA, INTERNACIONAL COE","CTRA. COLMENAR VIEJO, KM. 22","28790","TRES CANTOS","8034800","TRES CANTOS","N","1","1","0","0");
INSERT INTO centros VALUES("28002853","CP",NULL,"MARTINA GARCÍA","AVDA. JULIAN SANCHÉZ, S/N","28140","FUENTE EL SAZ","6200825","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28003420","CP",NULL,"ALEJANDRO RUBIO","C/ ALEJANDRO RUBIO, S/N","28794","GUADALIX DE LA SIERRA","8470256","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28006001","PRI",NULL,"SUIZO DE MADRID, COLEGIO","CTRA. DE BURGOS KM. 14","28109","ALCOBENDAS","6505817","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28022864","CP",NULL,"VIRGEN DE LA PEÑA SACRA","AVDA. DE LA PEDRIZA","28410","MANZANARES EL REAL","8530566","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28022891","CP",NULL,"VICENTE ALEIXANDRE","AVDA. DE LA CONSTITUCIÓN, S/N","28792","MIRAFLORES DE LA SIERRA","8443873","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28022918","CC",NULL,"SAN PABLO","C/ SAN PABLO, S/N BAR. CANTAGAL","28792","MIRAFLORES DE LA SIERRA","8443579","RURAL","N","1","0","0","0");
INSERT INTO centros VALUES("28022943","CP",NULL,"NTRA. SRA. DEL REMOLINO","C/ SAN ISIDRO, 8","28710","EL MOLAR","8410285","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28024034","CP",NULL,"ENRIQUE DE MESA","C/ MODESTO O. LOBON, 12","28740","RASCAFRÍA","8691159","RURAL","N","1","1","0","1");
INSERT INTO centros VALUES("28024253","CP",NULL,"VIRGEN DE NAVALAZARZA","C/ FELIX RDGUEZ. DE LA FUENTE","28750","SAN AGUSTíN DE GUADALIX","8418643","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28024551","CP",NULL,"FRANCISCO CARRILLO","AVDA. CHAPARRAL, 2","28700","SAN SEBASTIÁN DE LOS REYES","6526847","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28024617","CP",NULL,"NUESTRA SRA. DE VALVANERA","AVDA. DE LA SIERRA, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6517150","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28024629","CP",NULL,"SILVIO ABAD","C/ DOS DE MAYO, 2","28700","SAN SEBASTIÁN DE LOS REYES","6520221","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28024642","IES",NULL,"JOAN MIRÓ","C/ ISLA DE LA PALMA, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6527002","SAN SEBASTIÁN DE LOS","N","0","1","1","1");
INSERT INTO centros VALUES("28024654","PRI",NULL,"INTERNACIONAL SEK CIUDALCAMPO","URBANIZACIÓN CIUDALCAMPO","28700","SAN SEBASTIÁN DE LOS REYES","6570505","SAN SEBASTIÁN DE LOS","N","1","1","0","0");
INSERT INTO centros VALUES("28024800","CP",NULL,"VIRGEN DEL ROSARIO","C/ LA ORDEN, S/N","28791","SOTO DEL REAL","8478141","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28024812","CC",NULL,"EL PILAR","C/CAIDOS, 21","28791","SOTO DEL REAL","8476927","RURAL","N","1","1","0","0");
INSERT INTO centros VALUES("28025129","IES",NULL,"ALTO JARAMA","PASEO DE LA VARGUILLA, S/N","28180","TORRELAGUNA","8430237","RURAL","N","0","1","1","1");
INSERT INTO centros VALUES("28025130","CP",NULL,"CARDENAL CISNEROS","C/ FRAY JOSÉ DE ALMONACID, 13","28180","TORRELAGUNA","8430443","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28025403","CP",NULL,"JESUS ARAMBURU","C/ SOTO, S/N","28150","VALDETORRES DEL JARAMA","8415722","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28025816","CP",NULL,"SAN ANDRÉS","C/ PARAJE DE SAN ANDRÉS, S/N","28770","COLMENAR VIEJO","8453256","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28026043","CP",NULL,"PRÍNCIPE FELIPE","AVDA. VALDELAFUENTE, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6512211","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28026195","CP",NULL,"TIRSO DE MOLINA","C/ OLIVO, 17","28770","COLMENAR VIEJO","8452090","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28026638","CP",NULL,"GABRIEL Y GALÁN","AVDA. DE LA GUINDALERA,16","28100","ALCOBENDAS","6528965","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28028143","CP",NULL,"ISABEL LA CATÓLICA","C/ ISABEL LA CATOLICA, 3","28770","COLMENAR VIEJO","8451292","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28028611","IES",NULL,"GONZALO TORRENTE BALLESTER","AVDA. DE ARAGÓN, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6526533","SAN SEBASTIÁN DE LOS","N","0","1","1","1");
INSERT INTO centros VALUES("28028775","CP",NULL,"EMILIO CASADO","C/ CASIMIRO MORCILLO, 51","28100","ALCOBENDAS","6618407","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28029810","PRI",NULL,"ESCANDINAVO, COLEGIO","C/ CAMINO ANCHO, 14","28109","ALCOBENDAS","6500127","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28029871","PRI",NULL,"RUNNYMEDE COLLEGE","CAMINO ANCHO, 87","28100","ALCOBENDAS","6508302","ALCOBENDAS","N","1","1","1","0");
INSERT INTO centros VALUES("28029883","PRI",NULL,"SAN EXUPERY",NULL,"28100","ALCOBENDAS","6507019","ALCOBENDAS","N","1","0","0","0");
INSERT INTO centros VALUES("28030435","CP",NULL,"SAN SEBASTIÁN","AVDA. VALENCIA, 5","28700","SAN SEBASTIÁN DE LOS REYES","6519284","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28030745","PRI",NULL,"ALDEAFUENTE","CAMINO ANCHO, 87","28100","ALCOBENDAS","6520070","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28030824","CP",NULL,"VALDEPALITOS","AVDA. CONSTITUCIÓN, 127","28100","ALCOBENDAS","6536638","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28031166","CP",NULL,"LEÓN FELIPE","AVDA. VALENCIA, 7","28700","SAN SEBASTIÁN DE LOS REYES","6535520","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28031211","CP",NULL,"FUENTE SANTA","AVDA. ANDALUCIA, 53","28770","COLMENAR VIEJO","8452904","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28031521","CP",NULL,"ANTONIO MACHADO","AVDA. VALENCIA, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6534935","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28031981","CP",NULL,"BRAOJOS","C/ CONSTITUCIÓN, S/N","28737","BRAOJOS","8681104","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28032353","CP",NULL,"MIGUEL HERNÁNDEZ","C/ SEGOVIA, 11","28100","ALCOBENDAS","6532914","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28032602","PRI",NULL,"ALDOVEA","PASEO DE ALCOBENDAS, 5","28109","ALCOBENDAS","6500661","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28032614","PRI",NULL,"BASE","C/ CAMINO ANCHO, 10","28109","ALCOBENDAS","6500313","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28032638","CC",NULL,"PADRE MANYANET","CTRA. DE EL GOLOSO, KM. 3.780 Ap. 3","28100","ALCOBENDAS","6624620","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28033643","CP",NULL,"SEIS DE DICIEMBRE","C/ PINTOR SOROLLA, 19","28100","ALCOBENDAS","6613656","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28033655","CP",NULL,"CASTILLA","PLAZA DE CASTILLA, 4","28100","ALCOBENDAS","6530448","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28033680","CP",NULL,"GABRIEL GARCIA MARQUÉZ","SECTOR MÚSICOS, 11","28760","TRES CANTOS","8030996","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28033710","CC",NULL,"SAN FRANCISCO DE ASÍS","C\\ MÁRTIRES, 2","28730","SAN MAMÉS (BUITRAGO DEL LOZOYA)","8695307","RURAL","N","0","0","0","0");
INSERT INTO centros VALUES("28033837","CP",NULL,"FEDERICO GARCÍA LORCA","RESIDENCIAL EL OLIVAR, S/N","28770","COLMENAR VIEJO","8453656","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28034015","CC",NULL,"LICEO - 3","C/ ZARAGOZA, 23","28100","ALCOBENDAS","6613183","ALCOBENDAS","N","0","1","0","0");
INSERT INTO centros VALUES("28034118","CC",NULL,"ZURBARÁN","C/ ZURBARÁN, 7","28770","COLMENAR VIEJO","8450912","COLMENAR VIEJO","N","1","0","0","0");
INSERT INTO centros VALUES("28035317","IES",NULL,"JOSÉ LUIS SAMPEDRO","AVDA. DE LA VEGA, S/N","28760","TRES CANTOS","8031142","TRES CANTOS","N","0","1","1","1");
INSERT INTO centros VALUES("28035366","CP",NULL,"MIRAFLORES","C/ MIRAFLORES, 16","28100","ALCOBENDAS","6543885","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28035391","CP",NULL,"JULIO PINTO GÓMEZ","C/ DESCUBRIDORES, 26","28760","TRES CANTOS","8030997","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28035691","CP",NULL,"INFANTAS ELENA Y CRISTINA","AVDA. MOSCATELAR, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6543775","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28035780","PRI",NULL,"LAMBDA ACADEMIA","C/ CONSTITUCIÓN, 53","28100","ALCOBENDAS","6527595","ALCOBENDAS","N","0","0","0","0");
INSERT INTO centros VALUES("28035913","PRI",NULL,"APEAL ACADEMÍA","C/ SEGURA,15","28100","ALCOBENDAS","908821422","ALCOBENDAS","N","0","0","0","0");
INSERT INTO centros VALUES("28036085","PRI",NULL,"INTERNATIONAL COLLEGE SPAIN","C/ VEREDA NORTE, 3","28109","ALCOBENDAS","6502398","ALCOBENDAS","N","1","1","1","0");
INSERT INTO centros VALUES("28036450","PRI",NULL,"ESTRELLA TOLEDANO","PASEO DE ALCOBENDAS, 7","28109","ALCOBENDAS","6501229","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28036991","IES",NULL,"ALEXANDER GRAHAM BELL","POLIGONO DE LA MINA, S/N","28770","COLMENAR VIEJO","8455650","COLMENAR VIEJO","N","0","1","1","1");
INSERT INTO centros VALUES("28037171","CP",NULL,"PADRE JERÓNIMO","C/ ALCALA, S/N","28110","ALGETE","6290522","ALGETE","N","1","0","0","1");
INSERT INTO centros VALUES("28037508","CP",NULL,"LUIS BUÑUEL","C/ JAEN, 73","28100","ALCOBENDAS","6512323","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28037740","CP",NULL,"ANTONIO BUERO VALLEJO","C/ VIZCAYA, 28","28700","SAN SEBASTIÁN DE LOS REYES","6527825","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28037879","PRI",NULL,"SAN PATRICIO DE LA MORALEJA","PASEO DE ALCOBENDAS, 9","28109","ALCOBENDAS","6500791","ALCOBENDAS","N","1","0","0","0");
INSERT INTO centros VALUES("28038069","CP",NULL,"TIERNO GALVÁN","C/ TRIANA, 29","28100","ALCOBENDAS","6534130","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28038070","IES",NULL,"VIRGEN DE LA PAZ","C/ FRANCISCO CHICO MENDES, 4","28100","ALCOBENDAS","6615943","ALCOBENDAS","N","0","1","1","1");
INSERT INTO centros VALUES("28038112","CP",NULL,"PEDRO MUÑOZ SECA","C/ CARRACHEL, S/N","28110","ALGETE","6291517","ALGETE","N","1","0","0","1");
INSERT INTO centros VALUES("28038136","CP",NULL,"MIGUEL DE CERVANTES","C/ SECTOR LITERATOS, 11","28760","TRES CANTOS","8036188","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28038471","CP",NULL,"FUENTESANTA","C/ REAL, 114","28700","SAN SEBASTIÁN DE LOS REYES","6511311","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28038847","IES",NULL,"SEVERO OCHOA","C/ FRANCISCO CHICO MENDES, 3","28100","ALCOBENDAS","6620443","ALCOBENDAS","N","0","1","1","1");
INSERT INTO centros VALUES("28039013","CP",NULL,"PARQUE DE CATALUÑA","C/ ISLA DE CÓRCEGA, 3","28100","ALCOBENDAS","6618907","ALCOBENDAS","N","1","1","0","1");
INSERT INTO centros VALUES("28039165","CP",NULL,"ENRIQUE TIERNO GALVÁN","AVDA. DE VALENCIA, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6530590","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28039268","PRI",NULL,"SAUCES, LOS","C/ CAMINO ANCHO, 87","28109","ALCOBENDAS","6501790","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28039359","CP",NULL,"ANTONIO MACHADO","TRAV. PILAR DE ZARAGOZA, S/N","28770","COLMENAR VIEJO","8455004","COLMENAR VIEJO","N","1","0","0","1");
INSERT INTO centros VALUES("28039384","CP",NULL,"ENRIQUE TIERNO GALVÁN","C/ EMBARCACIONES, 34","28760","TRES CANTOS","8032957","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28039669","CP",NULL,"SANTO DOMINGO","AVDA. GUADALIX, 35","28110","ALGETE","6221690","ALGETE","N","1","0","0","1");
INSERT INTO centros VALUES("28040611","IES",NULL,"AL-SATT","CTRA. TORRELAGUNA, S/N","28110","ALGETE","6282412","ALGETE","N","0","1","1","1");
INSERT INTO centros VALUES("28040660","IES",NULL,"ALDEBARÁN","C/ FRANCISCO CHICO MENDES, 5","28100","ALCOBENDAS","6618085","ALCOBENDAS","N","0","1","1","1");
INSERT INTO centros VALUES("28040672","IES",NULL,"GUSTAVO ADOLFO BÉCQUER","CTRA. DE TORRELAGUNA, KM. 19,5","28100","ALGETE","6291606","ALGETE","N","0","1","1","1");
INSERT INTO centros VALUES("28040799","IES",NULL,"JULIO PALACIOS","AVDA. MOSCATELAR, S/N","28700","SAN SEBASTIÁN DE LOS REYES",NULL,"SAN SEBASTIÁN DE LOS","N","0","1","1","1");
INSERT INTO centros VALUES("28040881","CP",NULL,"QUINTO CENTENARIO","C/ REAL, 116","28700","SAN SEBASTIÁN DE LOS REYES","6539270","SAN SEBASTIÁN DE LOS","N","1","1","0","1");
INSERT INTO centros VALUES("28041354","IES",NULL,"ÁGORA","C/ MANUEL DE FALLA, 54-56","28100","ALCOBENDAS","6515845","ALCOBENDAS","N","0","1","1","1");
INSERT INTO centros VALUES("28041381","IES",NULL,"CABRERA, LA","C/ AZUCENAS, 12","28751","LA CABRERA","8688003","RURAL","N","0","1","1","1");
INSERT INTO centros VALUES("28041901","PRI",NULL,"SAN PATRICIO DEL SOTO","C/ JAZMÍN, 170","28109","ALCOBENDAS","6500655","ALCOBENDAS","N","0","1","0","0");
INSERT INTO centros VALUES("28042103","IES",NULL,"PINTOR ANTONIO LÓPEZ","C/ EL VADO (PROLONGACIÓN)","28760","TRES CANTOS","8039102","TRES CANTOS","N","0","1","1","1");
INSERT INTO centros VALUES("28042346","PRI",NULL,"ARETEIA","C/ SALVIA, 24","28109","ALCOBENDAS","6509102","ALCOBENDAS","N","1","1","1","0");
INSERT INTO centros VALUES("28042358","PRI",NULL,"KING\'S COLLEGE","PASEO DE LOS ANDES, S/N","28790","TRES CANTOS","8034800","TRES CANTOS","N","1","1","0","0");
INSERT INTO centros VALUES("28042802","CP",NULL,"VALDERREY","C/ BALEARES, S/N","28110","ALGETE","6282531","ALGETE","N","1","0","0","1");
INSERT INTO centros VALUES("28042826","CP",NULL,"CIUDAD DE COLUMBIA","C/ SECTOR PUEBLOS, 19","28760","TRES CANTOS","8032800","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28042863","CP",NULL,"LLE DE LOZOYA","C/ LUNA, S/N","28742","LOZOYA","8693143","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28042981","IES",NULL,"ROSA CHACEL","C/ HUERTAS, S/N","28770","COLMENAR VIEJO","8464801","COLMENAR VIEJO","N","0","1","1","1");
INSERT INTO centros VALUES("28043028","IES",NULL,"JUAN DE MAIRENA","AVDA. GUADARRAMA, S/N","28700","SAN SEBASTIÁN DE LOS REYES","6518199","SAN SEBASTIÁN DE LOS","N","0","1","1","1");
INSERT INTO centros VALUES("28043041","CP",NULL,"VIRGEN DE VALDERRABE","C/ CHILE, 6","28110","ALGETE","6280514","ALGETE","N","1","0","0","1");
INSERT INTO centros VALUES("28043387","CP",NULL,"ANTONIO OSUNA","C/ SECTOR ISLAS, 26","28760","TRES CANTOS","8038300","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28044641","CP",NULL,"ALDEBARÁN","C/ SALVIA, 1","28760","TRES CANTOS","8043398","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28044771","CP",NULL," TALAMANCA","C/ LA CRUZ","28160","TALAMANCA DEL JARAMA","8417515","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28044781","CP",NULL," LOZOYUELA","AVDA. DE MADRID, 32","28752","LOZOYUELA","8694002","RURAL","N","1","0","0","1");
INSERT INTO centros VALUES("28045074","CP",NULL,"CIUDAD DE NEJAPA","AVD. LABRADORES, 26","28760","TRES CANTOS","8033835","TRES CANTOS","N","1","0","0","1");
INSERT INTO centros VALUES("28046339","IES",NULL,"SAN AGUSTÍN DE GUADALIX","C/FÉLIX RODRÍGUEZ DE LA FUENTE","28750","SAN AGUSTíN DE GUADALIX","8419927","RURAL","N","0","1","1","1");
INSERT INTO centros VALUES("28047368","PRI",NULL,"LOS ABETOS","C/ MARQUÉS DE SANTILLANA, 29","28410","MANZANARES EL REAL","8539660","RURAL","N","1","0","0","0");
INSERT INTO centros VALUES("28048324","PRI",NULL,"BRAINS","C/ LA SALVIA , 48 (LA MORALEJA)","28109","ALCOBENDAS","6504527","ALCOBENDAS","N","1","1","0","0");
INSERT INTO centros VALUES("28048932","PRI",NULL,"NORFOLK","CRTA. DE DAGANZO S/N FINCA Nº. 4 DE","28863","COBEÑA",NULL,"RURAL","N","1","1","0","0");


#
# Estructura tabla 'libros'
#

DROP TABLE IF EXISTS libros;
CREATE TABLE IF NOT EXISTS libros (
  Autor varchar(20) NOT NULL DEFAULT '' ,
  Titulo varchar(50) NOT NULL DEFAULT '' ,
  Editorial varchar(20) ,
  Anno_Publica year(4) DEFAULT '2000' ,
  Paginas int(4) unsigned ,
  Precio_euros float(5,3) DEFAULT '0.000' ,
  Prestado set('S','N') DEFAULT 'N' ,
  Materia enum('FIL','LIT','MAT','HIS','ART','INF','OTR','CIE','GEO') DEFAULT 'LIT' ,
  ISBN varchar(14) NOT NULL DEFAULT '' ,
  Resumen text ,
  Notas blob ,
  Registro mediumint(9) NOT NULL auto_increment,
  PRIMARY KEY (ISBN,Registro),
  UNIQUE Registro (Registro),
  KEY ISBN_2 (ISBN),
  KEY Titulo (Titulo)
);


#
# Datos tabla 'libros'
#
INSERT INTO libros VALUES("Jennings, Gary","El viajero","Planeta","1999","821","15.050","S","LIT","84-08-03310-7","Narra el vieje y aventuras de Marcolo Polo a China","De lectura entretenida y documentada","10");
INSERT INTO libros VALUES("Oliveras, Alberto","Vicente Ferrer. La revolución silenciosa","Planeta Singular","2000","250","25.900","N","OTR","84-08-03501-0","Resume la vida y obra en la India de Vicente Ferrer","El dinero que se saque de su venta se destina ala FudaciÃ³n Vicente Ferrer","19");
INSERT INTO libros VALUES("National Geographic","El reino animal. Los mejores reportajes fotográfic","El País","1996","202","12.850","N","CIE","84-12717-9","Primer volumen dedidcado al Elefante","Excelnetes fotos. Texto simple","27");
INSERT INTO libros VALUES("Fuentes, Carlos","Instinto de Inez","Alfaguara","2001","189","20.550","N","LIT","84-204-4272-0","Dos historias con personajes del mundillo musical","Regalo de un amigo despuÃ©s de mi operaciÃ³n","11");
INSERT INTO libros VALUES("Fábrega, Pedro Pablo","PHP 4","Prentice Hall","2000","352","28.540","N","INF","84-205-3112-X","Explicación del lenguaje informático PHP, versión 4","Aceptable libro de aprendizaje, mÃ¡s teÃ³rico que prÃ¡ctico","14");
INSERT INTO libros VALUES("Messadié, Gerard","Grabdes descubrimientos de la ciencia","Biblioteca Newton","1989","262","18.000","N","CIE","84-206-9163-1","Ordenados de la A a la Z, el autor describe más de 120 descubrimientos de la humanidad de forma clara, breve y sencilla","Dispone de una introducciÃ³n muy acertada","22");
INSERT INTO libros VALUES("Borges, Jorge Luis","Obras completas III","Círculo de Lectores","1993","434","30.450","S","LIT","84-226-4148-8","Abarca el periodo de las obras escritas entre 1964 y 1975: El otro,el mismo; Para las seis cuerdas; Elogio de la sombra; El informe de Brodie; El oro de los tigres; El libro de la arena; y La rosa profunda","Los cuatro tomos fueron el regalo de mi cupleaÃ±os 2000","12");
INSERT INTO libros VALUES("Sopena","Gran Atlas Columbus","Sopena","1981","128","40.000","N","GEO","84-303-0859-8","Atlas mundial","Buena factura, aunque algo antiguo","24");
INSERT INTO libros VALUES("Avilés Farré, Juan","Atlas histórico universal","El País Aguilar","1995","263","38.670","S","HIS","84-30721-7","Buen atlas histórico","Excelentes croquis y mapas","25");
INSERT INTO libros VALUES("Trigos García, Esteb","PHP 4","Anaya Multimedia","2000","284","15.340","S","INF","84-415-1079-2","Funciones del lenguaje PHP 4 para crear páginas dinámicas web","Sencillo manual","15");
INSERT INTO libros VALUES("Camous, Henri","Problemas y jegos con las matemáticas","Gedisa","1995","182","14.500","N","MAT","84-7432-38-4","Propuesta atractiva y lúdica para dominar los temas de matemátidas para alumnos de bachillerato y profesionales","En lenguaje comÃºn se cuestionan las evidencias matemÃ¡ticas","17");
INSERT INTO libros VALUES("Stewart, Ian","Ingeniosos encuentros entre juegos y maemáticas","Gedisa","2000","206","13.670","N","MAT","84-7432-408-4","En 12 jegos se plantea las matemáticas como si fueran un juego","Material extraido de la revista Scientific American","16");
INSERT INTO libros VALUES("Edey, Maitland","Los orígenes del hombre. El eslabón perdido","Time Life Folio","1993","77","10.000","S","HIS","84-7583-366-7","Volumen I de esta prestigiosa obra sobre antropología","Texto muy acertado y buenas fotos","26");
INSERT INTO libros VALUES("Huxley, Aldous","Un mundo feliz","Alfaguara","1989","287","2.250","N","LIT","84-81 30-121-3","Descripción fantástica de un mundo futuro","PrÃ³logo de LucÃ­a EtxebarrÃ­a","6");
INSERT INTO libros VALUES("Cela, Camilo José","La colmena","Espasa Calpe","1985","320","4.240","N","LIT","84-81 30-124-8","En esta obra surge la lengua coloquial, urbana, cotidiana de la clase media en tiempos de la guerra civil española","ColecciÃ³n Mullenium","7");
INSERT INTO libros VALUES("Sábato, Ernesto","El túnel","Alfaguara","2000","128","5.650","N","LIT","84-81 30-133-7","Historia de amor, obsesión, celos y muerte","MartÃ­n Casariego hace una excelente introducciÃ³n","8");
INSERT INTO libros VALUES("Stevenson, R. L.","Dr. Jekyll y Mr. Hyde","Unidad Editorial","1975","95","3.250","S","LIT","84-81 30-134-5","La doble personalidad de un mismo personaje dado a las drogas","DiseÃ±o de cubierta e interiores de ZAC. IlustraciÃ³n de ToÃ±o Benavides","4");
INSERT INTO libros VALUES("Defoe, Daniel","Robinson Crusoe","Bibliotex","1924","318","5.600","S","LIT","84-81 30-140-X","Aventuras de un náufrago en na isla solitaria","Publicada por El Mundo como una de las 100 joyas de la colecciÃ³n Millenium","5");
INSERT INTO libros VALUES("Cortázar, Julio","Las armas secretas y otros relatos","Unidad Editorial","1980","126","1.350","N","LIT","84-81 30-142-6","El primer relato es un inmenso truco para vencer al tiempo, para engañar a la muerte","Excelente prÃ³logo de Fernando R. Lafuente. ColecciÃ³n Millenium de El Mundo","3");
INSERT INTO libros VALUES("Tolstoi, León","Ana Karenina","Unidad Editorial","1999","800","4.560","S","LIT","84-81 30-146-9","Amores desgraciados de la protagonista","Editado en dos tomos en la colecciÃ³n Millenium de El Mundo","1");
INSERT INTO libros VALUES("Baudelaire, Charles","Las flores del mal","Unidad Editorial","1999","253","2.120","S","LIT","84-81 30-152-3","Libro de poemas que pone en evidencia las contradicciones de la vida moderna con vívidas imánes","Traducido por Ãngel LÃ¡zaro y prologado por Rafael Agullol","2");
INSERT INTO libros VALUES("Arguiñano, Karlos","1.069 recetas","Asegarce Debate","1996","723","40.670","N","OTR","84-8306-037-X","Presentación odenada y por temas de las recetas elaboradas por este conocido cocinero vasco","Al final de la obra aparece un breve diccionario de cocina muy bueno","21");
INSERT INTO libros VALUES("Stendhal","Rojo y Negro","Alba","2000","563","12.340","N","LIT","84-8336-092-6","Historia de Julián Sorel en su ascensión hacia el éxito","La traducciÃ³n es muy regular y las incorrecciones abundantes","9");
INSERT INTO libros VALUES("Nietzsche, Friedrich","Así habló Zaratustra","Edimat Libros","1999","303","30.000","S","FIL","84-8403-114-4","Libro considerado como la obra más representativa de este autor, que pone en boca del legendario filósofo persa Zaratustra la quintaesencia de su mensjae: el superhombre, la muerte de Dios, la voluntad de poder y el eterno retorno de los idéntico","Buen estudio preliminar de Enrique LÃ³pez CastellÃ³n","20");
INSERT INTO libros VALUES("Subirana, Rosa María","Museos de España. Museo Picaso","Ediciones Orgaz","1979","131","14.350","N","ART","84-85407-21-0","Excelente descripción de las obras de Picaso alojadas en el Museo Picaso","Las pinturas son lÃ¡minas pegadas sobre las hojas del libro","28");
INSERT INTO libros VALUES("García Guinea, M. Án","Guía turística de Cantabria","Librería Estvdio","1991","311","20.750","N","OTR","84-85429-67-2","Excelente guía que abarca todas las regiones de Cantabria: la costa, Liébana, Valles de Nansa y Saja, Cuenca del Besaya, Cuencas del Pas y Pisueña, Cuencas del Miera y Asón y Campoo-Valderredible","Tiene abundantes fotos y grÃ¡ficos","18");
INSERT INTO libros VALUES("Yarza Luaces, Joaquí","Beato de Liébana. Manuscritos iluminados","Moleiro Editor","1998","325","85.990","N","ART","84-88526-39-3","Comentarios sobre la iluminación del libro con excelentes gráficos del Beato de Liébana a modo de Facsímil","Dos buenas introducciones sobre el ambiente lebaniego y los Apocalipsis en EspaÃ±a","23");
INSERT INTO libros VALUES("Mourad, Konizé","Un jardín en Badalpur","Taller de Mario Much","1998","467","38.760","N","LIT","84-923869-0-8","Segunda parte de De parte de la princesa muerta, donde la hija de la princesa cuenta su vida","Regalo a mi mujer en el verano de 1999","13");


#
# Estructura tabla 'prestados'
#

DROP TABLE IF EXISTS prestados;
CREATE TABLE IF NOT EXISTS prestados (
  registro mediumint(9) unsigned NOT NULL auto_increment,
  reg_libro mediumint(9) unsigned NOT NULL DEFAULT '0' ,
  reg_usu mediumint(9) unsigned NOT NULL DEFAULT '0' ,
  fecha_pres datetime ,
  fecha_dev datetime ,
  notas text ,
  PRIMARY KEY (registro),
  UNIQUE FieldName (registro)
);


#
# Datos tabla 'prestados'
#
INSERT INTO prestados VALUES("1","10","3","2014-09-03 00:00:00",NULL,"Debe devolverlo");
INSERT INTO prestados VALUES("2","5","8","2012-10-20 00:00:00","2013-01-12 00:00:00","Fuera de plazo");
INSERT INTO prestados VALUES("3","1","1","2014-09-25 00:00:00",NULL,"Pedirle el libro");
INSERT INTO prestados VALUES("4","11","10","2014-02-28 00:00:00","2014-03-25 00:00:00","Lo devuelve bien");
INSERT INTO prestados VALUES("5","3","2","2012-12-31 00:00:00","2013-05-31 00:00:00","Le gustó mucho");
INSERT INTO prestados VALUES("6","25","9","2013-09-23 00:00:00",NULL,"Reclamar el libro");
INSERT INTO prestados VALUES("7","7","4","2012-03-30 00:00:00","2014-03-30 00:00:00","Tardón");
INSERT INTO prestados VALUES("8","28","7",NULL,NULL,"Pregunta fechas");
INSERT INTO prestados VALUES("9","15","5","2014-01-25 00:00:00",NULL,NULL);
INSERT INTO prestados VALUES("10","9","6","2014-03-20 00:00:00",NULL,"Pedirle opinión si la tiene");


#
# Estructura tabla 'usuarios'
#

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios (
  Nombre varchar(15) NOT NULL DEFAULT '' ,
  Apellidos varchar(25) NOT NULL DEFAULT '' ,
  DNI varchar(8) NOT NULL DEFAULT '' ,
  Fecha_nacim date ,
  Domicilio varchar(35) ,
  Localidad varchar(30) ,
  Provincia varchar(25) ,
  Sueldo_euros float(8,3) DEFAULT '0.000' ,
  Telefono varchar(10) DEFAULT '0' ,
  E_mail varchar(40) ,
  Notas text ,
  Registro mediumint(9) unsigned NOT NULL auto_increment,
  PRIMARY KEY (Registro),
  UNIQUE Registro (Registro)
);


#
# Datos tabla 'usuarios'
#
INSERT INTO usuarios VALUES("Fernando","García Pérez","12345678","1942-11-30","C/ Alicante, 25 - 4º B","Madrid","Madrid","100000.000","91-8765432","Fernando@teleline.es","Se le pueden prestar libros, pues los devuelve siempre y los lee","1");
INSERT INTO usuarios VALUES("María","Fernández de Juana","23456789","1925-12-25","C/ Escultores, 23 3º J","Tres Cantos","Madrid","85000.563","91-8034567","Maria@pntic.mec.es","Lee mucho de arte","2");
INSERT INTO usuarios VALUES("Jaime","Ortega Mora","01357900","1975-10-30","C/ La rana, 11 7º L","Aguilafuente","Segovia","70000.977","921-444444","rana@wol.es","Presta libros más que leerolos","3");
INSERT INTO usuarios VALUES("Juan","Pereda Hermoso","0246801O","1970-01-01","C/ El león","San Vicente de la Barquera","Santander","35000.000","942-987654","barquera@terra.es","Pide muchos libros prestados","4");
INSERT INTO usuarios VALUES("Inés","Sastre Prieto","12457890","1914-01-28","C/ Alcalá 450 2º B","Madrid","Madrid","100000.000","912357234",NULL,"Ya casi o ve, pero insiste en leer","5");
INSERT INTO usuarios VALUES("Antonia","Perlado Perote","87654321","1925-03-10","C/ La farola, 45 3º A","Sotillos","Ávila","100000.000","676897654","sotifarola@wol.es","No devuelve los libros. ¿Los lee?","6");
INSERT INTO usuarios VALUES("Leoncio","Puga Gamo","98076543","1980-06-02","Avda. Valladolid s/n 3ºIzq.","León","León","100000.000","902879532","vallado@inicia.es",NULL,"7");
INSERT INTO usuarios VALUES("Inmaculada","Soto Linares","13513542","1960-07-15","Avda. los madroños","Sigüenza, 23 5º C","Sigüenza","100000.000","678932121","siguenza@licos.es","Presta mucho","8");
INSERT INTO usuarios VALUES("Jerónimo","Urdiales Pérez","12121212","1932-08-10","Ronda de Segovia, 22 9º J","Madrid","Madrid","100000.000","897654321",NULL,NULL,"9");
INSERT INTO usuarios VALUES("Rosa","Fernández Huertas","86465755","1955-09-18","Travesía de Valencia, s/n 4º G","Valencia","Valencia","100000.000","765432123",NULL,"Pide pocos libros","10");
