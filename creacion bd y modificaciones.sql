CREATE DATABASE greenkeeper1;
USE greenkeeper1;

CREATE TABLE rol (
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    identificacion VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    correo VARCHAR(100) NOT NULL,
    sexo VARCHAR(10),
    noCelular VARCHAR(20),
    password VARCHAR(100) NOT NULL,
    idRol INT,
    FOREIGN KEY (idRol) REFERENCES rol(idRol)
);

CREATE TABLE planta (
    idPlanta INT AUTO_INCREMENT PRIMARY KEY,
    nombreCientifico VARCHAR(100),
    nombreComun VARCHAR(100),
    familia VARCHAR(100),
    genero VARCHAR(100),
    especie VARCHAR(100),
    variedad VARCHAR(100),
    tipo VARCHAR(50),
    frecuenciaRiego VARCHAR(50)
);

CREATE TABLE ubicacion (
    idUbicacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tipo VARCHAR(50)
);

CREATE TABLE recordatorio (
    idRecordatorio INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    estado VARCHAR(20),
    frecuencia VARCHAR(50)
);

CREATE TABLE plantaUsuario (
    idPlantaUsu INT AUTO_INCREMENT PRIMARY KEY,
    idPlanta INT,
    idUsuario INT,
    fechaPlantacion DATE,
    estado VARCHAR(20),
    idUbicacion INT,
    idRecordatorio INT,
    FOREIGN KEY (idPlanta) REFERENCES planta(idPlanta),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idUbicacion) REFERENCES ubicacion(idUbicacion),
    FOREIGN KEY (idRecordatorio) REFERENCES recordatorio(idRecordatorio)
);

ALTER TABLE planta ADD COLUMN imagen VARCHAR(255);
ALTER TABLE ubicacion ADD COLUMN imagen VARCHAR(255);

ALTER TABLE plantaUsuario ADD COLUMN idRecordatorio INT;
ALTER TABLE plantaUsuario ADD CONSTRAINT fk_idRecordatorio FOREIGN KEY (idRecordatorio) REFERENCES recordatorio(idRecordatorio);

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE TABLE_NAME = 'plantaUsuario' AND COLUMN_NAME = 'idRecordatorio';
ALTER TABLE plantaUsuario DROP FOREIGN KEY fk_idRecordatorio;
ALTER TABLE plantaUsuario DROP COLUMN idRecordatorio;
DROP TABLE IF EXISTS plantaUsuario;
DROP TABLE IF EXISTS recordatorio;

USE greenkeeper1;

ALTER TABLE recordatorio
DROP COLUMN fecha,
DROP COLUMN hora;
ALTER TABLE plantaUsuario
ADD COLUMN fechaCreacion DATE;
ALTER TABLE recordatorio
    DROP COLUMN frecuencia,
    ADD COLUMN fecha DATE;
ALTER TABLE recordatorio 
ADD COLUMN hora TIME;

-- Ver las plantas que tiene el usuario --
SELECT pu.idPlantaUsu, pu.fechaPlantacion, pu.estado, p.nombreComun, p.nombreCientifico, u.nombre AS nombreUbicacion, u.tipo
FROM plantaUsuario pu
JOIN planta p ON pu.idPlanta = p.idPlanta
JOIN ubicacion u ON pu.idUbicacion = u.idUbicacion
WHERE pu.idUsuario = <ID_DEL_USUARIO>;

Ver los recordatorios asignados a plantaUsuario:
SELECT r.idRecordatorio, r.estado, r.fecha, pu.idPlantaUsu, p.nombreComun, p.nombreCientifico
FROM recordatorio r
JOIN plantaUsuario pu ON r.idPlantaUsu = pu.idPlantaUsu
JOIN planta p ON pu.idPlanta = p.idPlanta
WHERE pu.idPlantaUsu = <ID_DE_PLANTAUSUARIO>;
Ver qué recordatorio tiene plantaUsuario
SELECT pu.idPlantaUsu, pu.fechaCreacion, pu.estado, pu.idUbicacion, r.estado AS estadoRecordatorio, r.frecuencia
FROM plantaUsuario pu
JOIN recordatorio r ON pu.idRecordatorio = r.idRecordatorio;

-- Ver qué plantaUsuario tiene un recordatorio específico --
SELECT pu.idPlantaUsu, pu.fechaCreacion, pu.estado, pu.idUbicacion, p.nombreComun, p.nombreCientifico
FROM plantaUsuario pu
JOIN recordatorio r ON pu.idRecordatorio = r.idRecordatorio
JOIN planta p ON pu.idPlanta = p.idPlanta
WHERE r.idRecordatorio = <ID_DEL_RECORDATORIO>;
-- Ver plantaUsuario por ubicación--
SELECT pu.idPlantaUsu, pu.fechaPlantacion, pu.estado, u.nombre AS nombreUbicacion, u.tipo, p.nombreComun, p.nombreCientifico
FROM plantaUsuario pu
JOIN ubicacion u ON pu.idUbicacion = u.idUbicacion
JOIN planta p ON pu.idPlanta = p.idPlanta
WHERE u.idUbicacion = <ID_DE_LA_UBICACION>;
-- Ver plantaUsuario por recordatorio: --
SELECT pu.idPlantaUsu, pu.fechaPlantacion, pu.estado, r.estado AS estadoRecordatorio, r.fecha, p.nombreComun, p.nombreCientifico
FROM plantaUsuario pu
JOIN recordatorio r ON pu.idPlantaUsu = r.idPlantaUsu
JOIN planta p ON pu.idPlanta = p.idPlanta
WHERE r.idRecordatorio = <ID_DEL_RECORDATORIO>;

-- Consulta para contar recordatorios por ubicación
SELECT u.nombre AS Ubicacion, COUNT(r.idRecordatorio) AS NumeroDeRecordatorios
FROM plantaUsuario pu
JOIN ubicacion u ON pu.idUbicacion = u.idUbicacion
JOIN recordatorio r ON pu.idRecordatorio = r.idRecordatorio
GROUP BY u.nombre;

INSERT INTO rol (nombre) VALUES ('Administrador');
INSERT INTO usuario (identificacion, nombre, apellido, fechaNacimiento, correo, sexo, noCelular, password, idRol) 
VALUES ('123456', 'Juan', 'Pérez', '1990-01-01', 'juan@example.com', 'M', '555-1234', 'password', 1);

INSERT INTO planta (nombreCientifico, nombreComun, familia, genero, especie, variedad, tipo, frecuenciaRiego, imagen) 
VALUES ('Plantae', 'Rosa', 'Rosaceae', 'Rosa', 'Rosa sp.', 'Variedad 1', 'Exterior', '3', 'imagen1.jpg');

INSERT INTO ubicacion (nombre, tipo, imagen) VALUES ('Jardin', 'Exterior', 'imagen2.jpg');

INSERT INTO recordatorio (estado, fecha) VALUES ('Activo', '2024-01-01');

INSERT INTO plantaUsuario (idPlanta, idUsuario, fechaPlantacion, estado, idUbicacion, idRecordatorio, fechaCreacion)
VALUES (1, 1, '2024-07-01', 'Saludable', 1, 1, '2024-07-01');


-- Insertar recordatorios con frecuencias de 1 a 7
INSERT INTO recordatorio (idRecordatorio, estado, frecuencia)
VALUES 
(1, 'pendiente', '1 día'),
(2, 'pendiente', '2 días'),
(3, 'pendiente', '3 días'),
(4, 'pendiente', '4 días'),
(5, 'pendiente', '5 días'),
(6, 'pendiente', '6 días'),
(7, 'pendiente', '7 días');


