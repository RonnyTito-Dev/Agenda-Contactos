CREATE TABLE estadoContacto (
	idEstadoContacto INT(4) AUTO_INCREMENT PRIMARY KEY,
	nombreEstadoContacto VARCHAR(50) NOT NULL
);

CREATE TABLE estadoGrupo (
	idEstadoGrupo INT(4) AUTO_INCREMENT PRIMARY KEY,
	nombreEstadoGrupo VARCHAR(50) NOT NULL
);

CREATE TABLE Usuarios (

	idUsuario INT(4) AUTO_INCREMENT PRIMARY KEY,
    nombresUsuario VARCHAR(100) NOT NULL,
    apellidosUsuario VARCHAR(100) NOT NULL,
   	emailUsuario VARCHAR(50) NOT NULL UNIQUE,
   	contraseniaUsuario VARCHAR(64) NOT NULL,
	registroUsuario DATETIME DEFAULT CURRENT_TIMESTAMP,
	ultimoInicioSesion DATETIME,
	ultimoCierreSesion DATETIME,
	duracionUltimaSesion VARCHAR(50)
);

CREATE TABLE Grupos (

	idGrupo INT(4) AUTO_INCREMENT PRIMARY KEY,
	idUsuario INT(4),
	nombreGrupo VARCHAR(50)  NOT NULL,
	descripcionGrupo VARCHAR(100),
	fotoGrupo VARCHAR(100),
	creacionGrupo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	idEstadoGrupo INT(4) DEFAULT 1,
	ultimaModificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario),
	FOREIGN KEY (idEstadoGrupo) REFERENCES estadoGrupo(idEstadoGrupo)
	
);

CREATE TABLE Contactos (

	idContacto INT(4) AUTO_INCREMENT PRIMARY KEY,
	idUsuario INT(4),
	idGrupo INT(4) DEFAULT NULL,
	nombreContacto VARCHAR(100) NOT NULL,
	apellidoContacto VARCHAR(100) NOT NULL,
	numeroCelular VARCHAR(12) NOT NULL,
	emailContacto VARCHAR(50) NOT NULL,
	direccionContacto VARCHAR(50),
	fotoContacto VARCHAR(100),
	creacionContacto TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	idEstadoContacto INT(4) DEFAULT 1,
	ultimaModificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario),
	FOREIGN KEY (idEstadoContacto) REFERENCES estadoContacto(idEstadoContacto),
	FOREIGN KEY (idGrupo) REFERENCES Grupos(idGrupo)
);





-- ESTADO DEL CONTACTO
INSERT INTO estadoContacto (nombreEstadoContacto) VALUES 
('Activo'),
('Eliminado');

-- ESTADO DEL GRUPO
INSERT INTO estadoGrupo (nombreEstadoGrupo) VALUES 
('Activo'),
('Eliminado');
