
CREATE TABLE alumno
(
	rut INT NOT NULL,
	dv CHAR(1) NOT NULL,
	nombres VARCHAR(200) NOT NULL,
	apellidos VARCHAR(200) NOT NULL,
	email VARCHAR(255),
	deuda_total INTEGER,
	PRIMARY KEY(rut)
);

CREATE TABLE administrador
(
	id SERIAL, 
	username VARCHAR(100) NOT NULL,
	passwd VARCHAR(100) NOT NULL,
	nombres VARCHAR(200) NOT NULL,
	apellidos VARCHAR(200) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE categoria
(
	id SERIAL,
	nombre VARCHAR(200) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE autor
(
	id SERIAL,
	nombre VARCHAR(200) NOT NULL, 
	PRIMARY KEY(id)
);

CREATE TABLE libro
(
	id SERIAL,
	autor_id INTEGER NOT NULL,
	titulo VARCHAR(200) NOT NULL,
	descripcion VARCHAR(2000) NOT NULL,
	stock INTEGER NOT NULL,
	FOREIGN KEY(autor_id) REFERENCES autor(id),
	PRIMARY KEY(id)
);

CREATE TABLE categoria_libro
(
	libro_id INTEGER NOT NULL,
	categoria_id INTEGER NOT NULL,
	FOREIGN KEY(libro_id) REFERENCES libro(id),
	FOREIGN KEY(categoria_id) REFERENCES categoria(id),
	PRIMARY KEY(libro_id,categoria_id)
);

CREATE TABLE copia_libro
(
	libro_id INTEGER NOT NULL,
	numero INTEGER NOT NULL,
	prestado BOOL NOT NULL,
	FOREIGN KEY(libro_id) REFERENCES libro(id),
	PRIMARY KEY(libro_id,numero)
);

CREATE TABLE prestamo
(
	alumno_rut INTEGER NOT NULL,
	fecha_prestamo TIMESTAMP NOT NULL,
	copia_libro_libro_id INTEGER NOT NULL,
	copia_libro_numero INTEGER NOT NULL,
	administrador_id INTEGER NOT NULL,
	fecha_devolucion TIMESTAMP NOT NULL,
	devuelto BOOL NOT NULL,
	deuda INTEGER,
	FOREIGN KEY(alumno_rut) REFERENCES alumno(rut),
	FOREIGN KEY(copia_libro_libro_id, copia_libro_numero) REFERENCES copia_libro(libro_id, numero),
	FOREIGN KEY(administrador_id) REFERENCES administrador(id),
	PRIMARY KEY(alumno_rut,fecha_prestamo,copia_libro_libro_id,copia_libro_numero)

);
