CREATE SCHEMA IF NOT EXISTS `condominio360`;
USE `condominio360`;

CREATE TABLE `administrador` (
  `idAdministrador` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45),
  `correo` VARCHAR(255) NOT NULL,
  `clave` VARCHAR(45) NOT NULL,
  `codigoRecuperacion` VARCHAR(255),
  `fechaExpiracion` DATETIME,
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `correo` (`correo`)
);

CREATE TABLE `propietario` (
  `idPropietario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45),
  `correo` VARCHAR(255) NOT NULL,
  `clave` VARCHAR(45) NOT NULL,
  `codigoRecuperacion` VARCHAR(255),
  `fechaExpiracion` DATETIME,
  PRIMARY KEY (`idPropietario`),
  UNIQUE KEY `correo` (`correo`)
);

CREATE TABLE `apartamento` (
  `idApartamento` INT NOT NULL AUTO_INCREMENT,
  `idPropietarioFK` INT NOT NULL,
  `torre` VARCHAR(50) NOT NULL,
  `numero_identificador` VARCHAR(50) NOT NULL,
  `piso` VARCHAR(10) NOT NULL,
  `valorAdministracion` DOUBLE NOT NULL,
  PRIMARY KEY (`idApartamento`),
  KEY `idPropietarioFK` (`idPropietarioFK`),
  FOREIGN KEY (`idPropietarioFK`) REFERENCES `propietario` (`idPropietario`)
);

CREATE TABLE `concepto` (
  `idConcepto` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(255),
  PRIMARY KEY (`idConcepto`)
);

CREATE TABLE `EstadoPago` (
  `idEstadoPago` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEstadoPago`)
);

CREATE TABLE `cuentacobro` (
  `idCuentaCobro` INT NOT NULL AUTO_INCREMENT,
  `idApartamentoFK` INT NOT NULL,
  `idAdministradorFK` INT NOT NULL,
  `idConceptoFK` INT NOT NULL,
  `monto` DOUBLE NOT NULL,
  `fechaGeneracion` DATETIME NOT NULL,
  `fechaVencimiento` DATETIME NOT NULL,
  `fechaPago` DATETIME,
  `EstadoPago_idEstadoPago` INT NOT NULL,
  PRIMARY KEY (`idCuentaCobro`),
  KEY `idApartamentoFK` (`idApartamentoFK`),
  KEY `idAdministradorFK` (`idAdministradorFK`),
  KEY `idConceptoFK` (`idConceptoFK`),
  KEY `EstadoPago_idEstadoPago` (`EstadoPago_idEstadoPago`),
  FOREIGN KEY (`idApartamentoFK`) REFERENCES `apartamento` (`idApartamento`),
  FOREIGN KEY (`idAdministradorFK`) REFERENCES `administrador` (`idAdministrador`),
  FOREIGN KEY (`idConceptoFK`) REFERENCES `concepto` (`idConcepto`),
  FOREIGN KEY (`EstadoPago_idEstadoPago`) REFERENCES `EstadoPago` (`idEstadoPago`)
);

CREATE TABLE `pago` (
  `idPago` INT NOT NULL AUTO_INCREMENT,
  `idCuentaCobro` INT NOT NULL,
  `valorPagado` DOUBLE NOT NULL,
  `fechaPago` DATE NOT NULL,
  PRIMARY KEY (`idPago`),
  KEY `idCuentaCobro` (`idCuentaCobro`),
  FOREIGN KEY (`idCuentaCobro`) REFERENCES `cuentacobro` (`idCuentaCobro`)
);

-- Insertar datos de prueba

-- Estados de pago
INSERT INTO `EstadoPago` VALUES (1, 'pagado');
INSERT INTO `EstadoPago` VALUES (2, 'parcialmente pagado');
INSERT INTO `EstadoPago` VALUES (3, 'no pagado');

-- Administradores
INSERT INTO `administrador` VALUES (1, 'Oscar', 'Gonzalez', 'oscaralejandrosoto9@gmail.com', '123', NULL, NULL);
INSERT INTO `administrador` VALUES (2, 'Danna', NULL, 'danna@gmail.com', '123', NULL, NULL);
INSERT INTO `administrador` VALUES (3, 'Carlos', 'Rodríguez', 'carlos.rodriguez@condominio360.com', 'admin789', NULL, NULL);

-- Propietarios
INSERT INTO `propietario` VALUES (1, 'Ana', 'López', 'ana.lopez@email.com', 'prop123', NULL, NULL);
INSERT INTO `propietario` VALUES (2, 'Pedro', 'Martín', 'pedro.martin@email.com', 'prop456', NULL, NULL);
INSERT INTO `propietario` VALUES (3, 'Carmen', 'Sánchez', 'carmen.sanchez@email.com', 'prop789', NULL, NULL);
INSERT INTO `propietario` VALUES (4, 'Luis', 'Torres', 'luis.torres@email.com', 'prop101', NULL, NULL);
INSERT INTO `propietario` VALUES (5, 'Elena', 'Jiménez', 'elena.jimenez@email.com', 'prop102', NULL, NULL);
INSERT INTO `propietario` VALUES (6, 'Miguel', 'Herrera', 'miguel.herrera@email.com', 'prop103', NULL, NULL);
INSERT INTO `propietario` VALUES (7, 'Rosa', 'Morales', 'rosa.morales@email.com', 'prop104', NULL, NULL);
INSERT INTO `propietario` VALUES (8, 'Jorge', 'Vargas', 'jorge.vargas@email.com', 'prop105', NULL, NULL);
INSERT INTO `propietario` VALUES (9, 'Sofía', 'Ramírez', 'sofia.ramirez@email.com', 'prop106', NULL, NULL);
INSERT INTO `propietario` VALUES (10, 'David', 'Castro', 'david.castro@email.com', 'prop107', NULL, NULL);
INSERT INTO `propietario` VALUES (11, 'Patricia', 'Ortega', 'patricia.ortega@email.com', 'prop108', NULL, NULL);
INSERT INTO `propietario` VALUES (12, 'Roberto', 'Mendoza', 'roberto.mendoza@email.com', 'prop109', NULL, NULL);
INSERT INTO `propietario` VALUES (13, 'Lucía', 'Flores', 'lucia.flores@email.com', 'prop110', NULL, NULL);
INSERT INTO `propietario` VALUES (14, 'Fernando', 'Silva', 'fernando.silva@email.com', 'prop111', NULL, NULL);
INSERT INTO `propietario` VALUES (15, 'Isabella', 'Ramos', 'isabella.ramos@email.com', 'prop112', NULL, NULL);
INSERT INTO `propietario` VALUES (16, 'Alejandro', 'Guerrero', 'alejandro.guerrero@email.com', 'prop113', NULL, NULL);
INSERT INTO `propietario` VALUES (17, 'Gabriela', 'Paredes', 'gabriela.paredes@email.com', 'prop114', NULL, NULL);
INSERT INTO `propietario` VALUES (18, 'Ricardo', 'Delgado', 'ricardo.delgado@email.com', 'prop115', NULL, NULL);
INSERT INTO `propietario` VALUES (19, 'Valeria', 'Aguilar', 'valeria.aguilar@email.com', 'prop116', NULL, NULL);
INSERT INTO `propietario` VALUES (20, 'Andrés', 'Vega', 'andres.vega@email.com', 'prop117', NULL, NULL);

-- Apartamentos
INSERT INTO `apartamento` VALUES (1, 1, 'Torre A', 'A101', '1', 250000);
INSERT INTO `apartamento` VALUES (2, 2, 'Torre A', 'A102', '1', 250000);
INSERT INTO `apartamento` VALUES (3, 3, 'Torre A', 'A201', '2', 275000);
INSERT INTO `apartamento` VALUES (4, 4, 'Torre A', 'A202', '2', 275000);
INSERT INTO `apartamento` VALUES (5, 5, 'Torre A', 'A301', '3', 300000);
INSERT INTO `apartamento` VALUES (6, 6, 'Torre A', 'A302', '3', 300000);
INSERT INTO `apartamento` VALUES (7, 7, 'Torre B', 'B101', '1', 280000);
INSERT INTO `apartamento` VALUES (8, 8, 'Torre B', 'B102', '1', 280000);
INSERT INTO `apartamento` VALUES (9, 9, 'Torre B', 'B201', '2', 320000);
INSERT INTO `apartamento` VALUES (10, 10, 'Torre B', 'B202', '2', 320000);
INSERT INTO `apartamento` VALUES (11, 11, 'Torre B', 'B301', '3', 350000);
INSERT INTO `apartamento` VALUES (12, 12, 'Torre B', 'B302', '3', 350000);
INSERT INTO `apartamento` VALUES (13, 13, 'Torre C', 'C101', '1', 260000);
INSERT INTO `apartamento` VALUES (14, 14, 'Torre C', 'C102', '1', 260000);
INSERT INTO `apartamento` VALUES (15, 15, 'Torre C', 'C201', '2', 285000);
INSERT INTO `apartamento` VALUES (16, 16, 'Torre C', 'C202', '2', 285000);
INSERT INTO `apartamento` VALUES (17, 17, 'Torre C', 'C301', '3', 310000);
INSERT INTO `apartamento` VALUES (18, 18, 'Torre C', 'C302', '3', 310000);
INSERT INTO `apartamento` VALUES (19, 19, 'Torre D', 'D101', '1', 270000);
INSERT INTO `apartamento` VALUES (20, 20, 'Torre D', 'D102', '1', 270000);

-- Conceptos
INSERT INTO `concepto` VALUES (1, 'Administración mensual');
INSERT INTO `concepto` VALUES (2, 'Fondo de reserva');
INSERT INTO `concepto` VALUES (3, 'Servicios públicos comunes');
INSERT INTO `concepto` VALUES (4, 'Mantenimiento ascensores');
INSERT INTO `concepto` VALUES (5, 'Seguridad y vigilancia');
INSERT INTO `concepto` VALUES (6, 'Limpieza áreas comunes');
INSERT INTO `concepto` VALUES (7, 'Jardinería');
INSERT INTO `concepto` VALUES (8, 'Seguros');
INSERT INTO `concepto` VALUES (9, 'Reparaciones menores');
INSERT INTO `concepto` VALUES (10, 'Gastos administrativos');

-- Cuentas de cobro
INSERT INTO `cuentacobro` VALUES (1, 1, 1, 1, 250000, '2024-01-01 08:00:00', '2024-01-15 23:59:59', '2024-01-10 14:30:00', 1);
INSERT INTO `cuentacobro` VALUES (2, 2, 1, 1, 250000, '2024-01-01 08:00:00', '2024-01-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (3, 3, 1, 1, 275000, '2024-01-01 08:00:00', '2024-01-15 23:59:59', '2024-01-12 16:45:00', 1);
INSERT INTO `cuentacobro` VALUES (4, 4, 2, 1, 275000, '2024-01-01 08:00:00', '2024-01-15 23:59:59', '2024-01-14 10:20:00', 2);
INSERT INTO `cuentacobro` VALUES (5, 5, 2, 1, 300000, '2024-01-01 08:00:00', '2024-01-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (6, 6, 2, 1, 300000, '2024-01-01 08:00:00', '2024-01-15 23:59:59', '2024-01-13 09:15:00', 1);
INSERT INTO `cuentacobro` VALUES (7, 7, 1, 2, 50000, '2024-01-01 08:00:00', '2024-01-31 23:59:59', '2024-01-25 11:30:00', 1);
INSERT INTO `cuentacobro` VALUES (8, 8, 1, 2, 50000, '2024-01-01 08:00:00', '2024-01-31 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (9, 9, 3, 3, 45000, '2024-01-01 08:00:00', '2024-01-20 23:59:59', '2024-01-18 15:45:00', 1);
INSERT INTO `cuentacobro` VALUES (10, 10, 3, 3, 45000, '2024-01-01 08:00:00', '2024-01-20 23:59:59', '2024-01-19 12:30:00', 2);
INSERT INTO `cuentacobro` VALUES (11, 11, 1, 4, 35000, '2024-02-01 08:00:00', '2024-02-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (12, 12, 2, 4, 35000, '2024-02-01 08:00:00', '2024-02-15 23:59:59', '2024-02-10 13:20:00', 1);
INSERT INTO `cuentacobro` VALUES (13, 13, 2, 5, 80000, '2024-02-01 08:00:00', '2024-02-28 23:59:59', '2024-02-20 16:10:00', 1);
INSERT INTO `cuentacobro` VALUES (14, 14, 3, 5, 80000, '2024-02-01 08:00:00', '2024-02-28 23:59:59', '2024-02-22 14:45:00', 2);
INSERT INTO `cuentacobro` VALUES (15, 15, 1, 6, 25000, '2024-02-01 08:00:00', '2024-02-25 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (16, 16, 1, 6, 25000, '2024-02-01 08:00:00', '2024-02-25 23:59:59', '2024-02-15 10:30:00', 1);
INSERT INTO `cuentacobro` VALUES (17, 17, 2, 7, 30000, '2024-03-01 08:00:00', '2024-03-15 23:59:59', '2024-03-12 11:45:00', 1);
INSERT INTO `cuentacobro` VALUES (18, 18, 2, 7, 30000, '2024-03-01 08:00:00', '2024-03-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (19, 19, 3, 8, 40000, '2024-03-01 08:00:00', '2024-03-31 23:59:59', '2024-03-20 09:15:00', 1);
INSERT INTO `cuentacobro` VALUES (20, 20, 3, 8, 40000, '2024-03-01 08:00:00', '2024-03-31 23:59:59', '2024-03-25 14:30:00', 2);
INSERT INTO `cuentacobro` VALUES (21, 1, 1, 9, 60000, '2024-03-01 08:00:00', '2024-03-20 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (22, 2, 1, 9, 60000, '2024-03-01 08:00:00', '2024-03-20 23:59:59', '2024-03-18 16:20:00', 1);
INSERT INTO `cuentacobro` VALUES (23, 3, 2, 10, 15000, '2024-04-01 08:00:00', '2024-04-15 23:59:59', '2024-04-10 13:45:00', 1);
INSERT INTO `cuentacobro` VALUES (24, 4, 2, 10, 15000, '2024-04-01 08:00:00', '2024-04-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (25, 5, 3, 1, 300000, '2024-04-01 08:00:00', '2024-04-15 23:59:59', '2024-04-12 15:30:00', 1);
INSERT INTO `cuentacobro` VALUES (26, 6, 1, 1, 300000, '2024-04-01 08:00:00', '2024-04-15 23:59:59', '2024-04-14 11:20:00', 2);
INSERT INTO `cuentacobro` VALUES (27, 7, 1, 2, 50000, '2024-04-01 08:00:00', '2024-04-30 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (28, 8, 2, 2, 50000, '2024-04-01 08:00:00', '2024-04-30 23:59:59', '2024-04-25 10:45:00', 1);
INSERT INTO `cuentacobro` VALUES (29, 9, 2, 3, 45000, '2024-05-01 08:00:00', '2024-05-20 23:59:59', '2024-05-15 14:10:00', 1);
INSERT INTO `cuentacobro` VALUES (30, 10, 3, 3, 45000, '2024-05-01 08:00:00', '2024-05-20 23:59:59', '2024-05-18 12:35:00', 2);
INSERT INTO `cuentacobro` VALUES (31, 11, 3, 4, 35000, '2024-05-01 08:00:00', '2024-05-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (32, 12, 1, 4, 35000, '2024-05-01 08:00:00', '2024-05-15 23:59:59', '2024-05-12 16:45:00', 1);
INSERT INTO `cuentacobro` VALUES (33, 13, 1, 5, 80000, '2024-05-01 08:00:00', '2024-05-31 23:59:59', '2024-05-28 13:20:00', 1);
INSERT INTO `cuentacobro` VALUES (34, 14, 2, 5, 80000, '2024-05-01 08:00:00', '2024-05-31 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (35, 15, 2, 6, 25000, '2024-06-01 08:00:00', '2024-06-25 23:59:59', '2024-06-20 11:15:00', 1);
INSERT INTO `cuentacobro` VALUES (36, 16, 3, 6, 25000, '2024-06-01 08:00:00', '2024-06-25 23:59:59', '2024-06-22 15:40:00', 2);
INSERT INTO `cuentacobro` VALUES (37, 17, 3, 7, 30000, '2024-06-01 08:00:00', '2024-06-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (38, 18, 1, 7, 30000, '2024-06-01 08:00:00', '2024-06-15 23:59:59', '2024-06-12 09:25:00', 1);
INSERT INTO `cuentacobro` VALUES (39, 19, 1, 8, 40000, '2024-06-01 08:00:00', '2024-06-30 23:59:59', '2024-06-25 14:50:00', 1);
INSERT INTO `cuentacobro` VALUES (40, 20, 2, 8, 40000, '2024-06-01 08:00:00', '2024-06-30 23:59:59', '2024-06-28 12:30:00', 2);
INSERT INTO `cuentacobro` VALUES (41, 1, 2, 9, 60000, '2024-07-01 08:00:00', '2024-07-20 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (42, 2, 2, 9, 60000, '2024-07-01 08:00:00', '2024-07-20 23:59:59', '2024-07-18 16:15:00', 1);
INSERT INTO `cuentacobro` VALUES (43, 3, 3, 10, 15000, '2024-07-01 08:00:00', '2024-07-15 23:59:59', '2024-07-10 10:40:00', 1);
INSERT INTO `cuentacobro` VALUES (44, 4, 3, 10, 15000, '2024-07-01 08:00:00', '2024-07-15 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (45, 5, 1, 1, 300000, '2024-08-01 08:00:00', '2024-08-15 23:59:59', '2024-08-10 13:25:00', 1);
INSERT INTO `cuentacobro` VALUES (46, 6, 1, 1, 300000, '2024-08-01 08:00:00', '2024-08-15 23:59:59', '2024-08-12 15:50:00', 2);
INSERT INTO `cuentacobro` VALUES (47, 7, 2, 2, 50000, '2024-08-01 08:00:00', '2024-08-31 23:59:59', NULL, 3);
INSERT INTO `cuentacobro` VALUES (48, 8, 2, 2, 50000, '2024-08-01 08:00:00', '2024-08-31 23:59:59', '2024-08-28 11:30:00', 1);
INSERT INTO `cuentacobro` VALUES (49, 9, 3, 3, 45000, '2024-09-01 08:00:00', '2024-09-20 23:59:59', '2024-09-15 14:20:00', 1);
INSERT INTO `cuentacobro` VALUES (50, 10, 3, 3, 45000, '2024-09-01 08:00:00', '2024-09-20 23:59:59', '2024-09-18 16:45:00', 2);

-- Pagos
INSERT INTO `pago` VALUES (1, 1, 250000, '2024-01-10');
INSERT INTO `pago` VALUES (2, 3, 275000, '2024-01-12');
INSERT INTO `pago` VALUES (3, 4, 150000, '2024-01-14');
INSERT INTO `pago` VALUES (4, 6, 300000, '2024-01-13');
INSERT INTO `pago` VALUES (5, 7, 50000, '2024-01-25');
INSERT INTO `pago` VALUES (6, 9, 45000, '2024-01-18');
INSERT INTO `pago` VALUES (7, 10, 25000, '2024-01-19');
INSERT INTO `pago` VALUES (8, 12, 35000, '2024-02-10');
INSERT INTO `pago` VALUES (9, 13, 80000, '2024-02-20');
INSERT INTO `pago` VALUES (10, 14, 40000, '2024-02-22');
INSERT INTO `pago` VALUES (11, 16, 25000, '2024-02-15');
INSERT INTO `pago` VALUES (12, 17, 30000, '2024-03-12');
INSERT INTO `pago` VALUES (13, 19, 40000, '2024-03-20');
INSERT INTO `pago` VALUES (14, 20, 20000, '2024-03-25');
INSERT INTO `pago` VALUES (15, 22, 60000, '2024-03-18');
INSERT INTO `pago` VALUES (16, 23, 15000, '2024-04-10');
INSERT INTO `pago` VALUES (17, 25, 300000, '2024-04-12');
INSERT INTO `pago` VALUES (18, 26, 200000, '2024-04-14');
INSERT INTO `pago` VALUES (19, 28, 50000, '2024-04-25');
INSERT INTO `pago` VALUES (20, 29, 45000, '2024-05-15');
INSERT INTO `pago` VALUES (21, 30, 30000, '2024-05-18');
INSERT INTO `pago` VALUES (22, 32, 35000, '2024-05-12');
INSERT INTO `pago` VALUES (23, 33, 80000, '2024-05-28');
INSERT INTO `pago` VALUES (24, 35, 25000, '2024-06-20');
INSERT INTO `pago` VALUES (25, 36, 15000, '2024-06-22');
INSERT INTO `pago` VALUES (26, 38, 30000, '2024-06-12');
INSERT INTO `pago` VALUES (27, 39, 40000, '2024-06-25');
INSERT INTO `pago` VALUES (28, 40, 25000, '2024-06-28');
INSERT INTO `pago` VALUES (29, 42, 60000, '2024-07-18');
INSERT INTO `pago` VALUES (30, 43, 15000, '2024-07-10');
INSERT INTO `pago` VALUES (31, 45, 300000, '2024-08-10');
INSERT INTO `pago` VALUES (32, 46, 180000, '2024-08-12');
INSERT INTO `pago` VALUES (33, 48, 50000, '2024-08-28');
INSERT INTO `pago` VALUES (34, 49, 45000, '2024-09-15');
INSERT INTO `pago` VALUES (35, 50, 30000, '2024-09-18');


UPDATE administrador SET clave = md5(clave);
UPDATE propietario SET clave = md5(clave);

ALTER TABLE cuentacobro AUTO_INCREMENT = 0;
