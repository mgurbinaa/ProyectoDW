DROP DATABASE appdesc;
CREATE DATABASE appdesc;

CREATE TABLE appdesc.users(
	id_user			int(15)			AUTO_INCREMENT NOT NULL,
	usuario			varchar(16)		NOT NULL UNIQUE,
	correo			varchar(50)		NOT NULL UNIQUE,
	nombre			varchar(50)		NOT NULL,
	apellido		varchar(50)		NOT NULL,
	password		varchar(500)	NOT NULL,
	PRIMARY KEY (id_user)
);

CREATE TABLE appdesc.estadosPublicaciones(
	id_status		int(1)			AUTO_INCREMENT NOT NULL,
	status 			varchar(10)		NOT NULL,
	PRIMARY KEY (id_status)
);

INSERT INTO appdesc.estadosPublicaciones VALUES (1, "Activa");
INSERT INTO appdesc.estadosPublicaciones VALUES (2, "Expirada");
INSERT INTO appdesc.estadosPublicaciones VALUES (3, "Eliminada");

CREATE TABLE appdesc.publicaciones(
	id_publi		int(15)			AUTO_INCREMENT NOT NULL,
	shop			varchar(30)		NOT NULL,
	title			varchar(70)		NOT NULL,
	link			varchar(300)	NOT NULL,
	descripcion		text			NOT NULL,
	precio			decimal(5,2)	DEFAULT NULL,
	calificacion	int(3)			DEFAULT NULL,
	fecha_creada	date	 		NOT NULL,
	fecha_expira	date 			NOT NULL,
	fk_id_user		int(15)			NOT NULL,
	fk_status		int(1)			NOT NULL,
	PRIMARY KEY (id_publi),
	FOREIGN KEY (fk_id_user) REFERENCES appdesc.users(id_user),
	FOREIGN KEY (fk_status) REFERENCES appdesc.estadosPublicaciones(id_status)
);

CREATE TABLE appdesc.comentarios(
	contenido			text			NOT NULL,
	fecha_comment		datetime		NOT NULL,
	fk_id_publi			int(15)			NOT NULL,
	fk_id_user_comment	int(15)			NOT NULL,
	FOREIGN KEY (fk_id_publi) REFERENCES appdesc.publicaciones(id_publi),
	FOREIGN KEY (fk_id_user_comment) REFERENCES appdesc.users(id_user)
);

CREATE TABLE appdesc.votos(
	fk_id_user_voto		int(15)			NOT NULL,
	fk_id_publi_voto	int(15)			NOT NULL,
	tipo_voto 			boolean			NOT NULL,
	FOREIGN KEY (fk_id_user_voto) REFERENCES appdesc.users(id_user),
	FOREIGN KEY (fk_id_publi_voto) REFERENCES appdesc.publicaciones(id_publi)
);
