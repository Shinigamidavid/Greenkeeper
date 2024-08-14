-- Insertar roles
INSERT INTO rol (nombre) VALUES ('Administrador'), ('Cliente');

-- Insertar usuarios
INSERT INTO usuario (identificacion, nombre, apellido, fechaNacimiento, correo, sexo, noCelular, password, idRol)
VALUES ('123456789', 'Juan', 'Perez', '1990-01-01', 'juan.perez@example.com', 'M', '1234567890', 'password123', 1),
       ('987654321', 'Maria', 'Gonzalez', '1985-05-05', 'maria.gonzalez@example.com', 'F', '0987654321', 'password456', 2);

-- Insertar plantas
INSERT INTO planta (nombreCientifico, nombreComun, familia, genero, especie, variedad, tipo, frecuenciaRiego, imagen)
VALUES ('Ficus lyrata', 'Fiddle Leaf Fig', 'Moraceae', 'Ficus', 'lyrata', 'Variegata', 'Interior', 'Semanal', 'archivos/Primula-obconica-banca.jpg'),
       ('Rosa spp.', 'Rose', 'Rosaceae', 'Rosa', 'spp.', 'Hybrid Tea', 'Exterior', 'Diaria', 'archivos/Rosa-rose-banca.jpg');

-- Insertar ubicaciones
INSERT INTO ubicacion (nombre, tipo, imagen)
VALUES ('Balcón', 'Exterior', 'ruta/a/la/imagen.jpg');


-- Insertar plantas de usuario
INSERT INTO plantaUsuario (idPlanta, idUsuario, fechaPlantacion, estado, idUbicacion)
VALUES (1, 1, '2024-07-01', 'activo', 1),
       (2, 2, '2024-07-02', 'activo', 2);

-- Insertar recordatorios para una planta de usuario
INSERT INTO recordatorio (idPlantaUsu, fecha, hora, estado, frecuencia)
SELECT pu.idPlantaUsu, '2024-07-15', '08:00:00', 'pendiente', p.frecuenciaRiego
FROM plantaUsuario pu
JOIN planta p ON pu.idPlanta = p.idPlanta
WHERE pu.idPlantaUsu = 1;

INSERT INTO recordatorio (idPlantaUsu, fecha, hora, estado, frecuencia)
SELECT pu.idPlantaUsu, '2024-07-15', '08:00:00', 'pendiente', p.frecuenciaRiego
FROM plantaUsuario pu
JOIN planta p ON pu.idPlanta = p.idPlanta
WHERE pu.idPlantaUsu = 2;
