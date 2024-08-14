SELECT pu.*, p.*, r.*
FROM plantaUsuario pu
JOIN planta p ON pu.idPlanta = p.idPlanta
LEFT JOIN recordatorio r ON pu.idPlantaUsu = r.idPlantaUsu
WHERE pu.idUsuario = 1;

SELECT r.*
FROM recordatorio r
WHERE r.idPlantaUsu = 1;