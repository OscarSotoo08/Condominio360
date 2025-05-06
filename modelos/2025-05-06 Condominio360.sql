CREATE TABLE `Administrador` (
  `idAdministrador` int PRIMARY KEY,
  `nombre` varchar(45),
  `apellido` varchar(45),
  `correo` varchar(255) UNIQUE,
  `clave` varchar(45)
);

CREATE TABLE `Propietario` (
  `idPropietario` int PRIMARY KEY,
  `nombre` varchar(45),
  `apellido` varchar(45),
  `correo` varchar(255) UNIQUE,
  `clave` varchar(45),
  `saldo` double
);

CREATE TABLE `Apartamento` (
  `idApartamento` int PRIMARY KEY,
  `idPropietarioFK` int
);

CREATE TABLE `CuentaCobro` (
  `idCuentaCobro` int PRIMARY KEY,
  `idApartamentoFK` int,
  `idAdministradorFK` int,
  `idConceptoFK` int,
  `monto` double,
  `fechaGeneracion` datetime,
  `fechaVencimiento` datetime,
  `estadoPago` tinyint,
  `fechaPago` datetime
);

CREATE TABLE `Concepto` (
  `idConcepto` int PRIMARY KEY,
  `concepto` varchar(255)
);

CREATE TABLE `Pago` (
  `idPago` int PRIMARY KEY,
  `idCuentaCobro` int,
  `valorPagado` double,
  `fechaPago` date,
  `observaciones` varchar(255)
);

ALTER TABLE `Apartamento` ADD FOREIGN KEY (`idPropietarioFK`) REFERENCES `Propietario` (`idPropietario`);

ALTER TABLE `CuentaCobro` ADD FOREIGN KEY (`idApartamentoFK`) REFERENCES `Apartamento` (`idApartamento`);

ALTER TABLE `CuentaCobro` ADD FOREIGN KEY (`idAdministradorFK`) REFERENCES `Administrador` (`idAdministrador`);

ALTER TABLE `CuentaCobro` ADD FOREIGN KEY (`idConceptoFK`) REFERENCES `Concepto` (`idConcepto`);

ALTER TABLE `Pago` ADD FOREIGN KEY (`idCuentaCobro`) REFERENCES `CuentaCobro` (`idCuentaCobro`);
