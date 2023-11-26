use ejercicios;

CREATE TABLE hike_rutas (
    id int(11) NOT NULL auto_increment,
    titulo varchar(50) NOT NULL DEFAULT '' ,
    descripcion varchar(254) NOT NULL DEFAULT '' ,
    desnivel int(4) unsigned NOT NULL DEFAULT '0' ,
    distancia double NOT NULL DEFAULT '0' ,
    dificultad tinyint(1) unsigned DEFAULT '0' ,
    PRIMARY KEY (id),
    KEY titulo (titulo)
);

INSERT INTO hike_rutas VALUES("1", "Pico del Adrion", "Ipso lorem ipsum", 535, 7.32, 0);
INSERT INTO hike_rutas VALUES("2", "Simancon", "Ipso lorem ipsum", 1200, 9.72, 2);

CREATE TABLE hike_comentarios (
    id int(11) NOT NULL auto_increment,
    id_ruta int(11) NOT NULL DEFAULT '0' ,
    nombre varchar(50) NOT NULL DEFAULT '' ,
    fecha date NOT NULL DEFAULT '0000-00-00' ,
    comentario varchar(254) NOT NULL DEFAULT '' ,
    PRIMARY KEY (id),
    KEY nombre (nombre)
);

INSERT INTO hike_comentarios VALUES ("1", "1", "Pedro", "2023-10-10", "Me ha encantado");
INSERT INTO hike_comentarios VALUES ("2", "2", "Juan", "2011-10-10", "Muy dura");
