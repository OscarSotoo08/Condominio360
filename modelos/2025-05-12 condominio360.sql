-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 04:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `condominio360`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `codigoRecuperacion` varchar(255) DEFAULT NULL,
  `fechaExpiracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombre`, `apellido`, `correo`, `clave`, `codigoRecuperacion`, `fechaExpiracion`) VALUES
(1, 'Oscar', 'Gonzalez', 'oscaralejandrosoto9@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', 'e18e6eb21d51d894e87a80a57b31bcf5', '2025-05-12 03:20:27'),
(2, 'admin', ':3', 'admin1@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', NULL, NULL),
(3, 'Danna', 'Molina', 'dannaa.molina.b@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apartamento`
--

CREATE TABLE `apartamento` (
  `idApartamento` int(11) NOT NULL,
  `idPropietarioFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartamento`
--

INSERT INTO `apartamento` (`idApartamento`, `idPropietarioFK`) VALUES
(101, 1),
(102, 2),
(103, 2),
(104, 3);

-- --------------------------------------------------------

--
-- Table structure for table `concepto`
--

CREATE TABLE `concepto` (
  `idConcepto` int(11) NOT NULL,
  `concepto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concepto`
--

INSERT INTO `concepto` (`idConcepto`, `concepto`) VALUES
(1, 'Cuota de administración mensual'),
(2, 'Mantenimiento ascensor'),
(3, 'Reparación de zonas comunes');

-- --------------------------------------------------------

--
-- Table structure for table `cuentacobro`
--

CREATE TABLE `cuentacobro` (
  `idCuentaCobro` int(11) NOT NULL,
  `idApartamentoFK` int(11) DEFAULT NULL,
  `idAdministradorFK` int(11) DEFAULT NULL,
  `idConceptoFK` int(11) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `fechaGeneracion` datetime DEFAULT NULL,
  `fechaVencimiento` datetime DEFAULT NULL,
  `estadoPago` tinyint(4) DEFAULT NULL,
  `fechaPago` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuentacobro`
--

INSERT INTO `cuentacobro` (`idCuentaCobro`, `idApartamentoFK`, `idAdministradorFK`, `idConceptoFK`, `monto`, `fechaGeneracion`, `fechaVencimiento`, `estadoPago`, `fechaPago`) VALUES
(1001, 101, 1, 1, 200000, '2025-05-01 10:00:00', '2025-05-10 23:59:59', 1, '2025-05-05 09:30:00'),
(1002, 102, 2, 2, 150000, '2025-05-01 11:00:00', '2025-05-12 23:59:59', 0, NULL),
(1003, 103, 2, 1, 200000, '2025-05-01 12:00:00', '2025-05-10 23:59:59', 1, '2025-05-08 14:00:00'),
(1004, 104, 1, 3, 100000, '2025-05-02 09:00:00', '2025-05-15 23:59:59', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE `pago` (
  `idPago` int(11) NOT NULL,
  `idCuentaCobro` int(11) DEFAULT NULL,
  `valorPagado` double DEFAULT NULL,
  `fechaPago` date DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pago`
--

INSERT INTO `pago` (`idPago`, `idCuentaCobro`, `valorPagado`, `fechaPago`, `observaciones`) VALUES
(1, 1001, 200000, '2025-05-05', 'Pago completo realizado a tiempo'),
(2, 1003, 200000, '2025-05-08', 'Pago realizado sin observaciones');

-- --------------------------------------------------------

--
-- Table structure for table `propietario`
--

CREATE TABLE `propietario` (
  `idPropietario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `codigoRecuperacion` varchar(255) DEFAULT NULL,
  `fechaExpiracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propietario`
--

INSERT INTO `propietario` (`idPropietario`, `nombre`, `apellido`, `correo`, `clave`, `saldo`, `codigoRecuperacion`, `fechaExpiracion`) VALUES
(1, 'Ana', 'Pérez', 'oscaralejandrosoto99@gmail.com', 'ana123', 1500000, 'de1e3909986b50816429c16ea74bf7d2', '2025-05-12 03:52:19'),
(2, 'Juan', 'Martínez', 'juan.mtz@correo.com', 'juan456', 500000, NULL, NULL),
(3, 'Diana', 'Ríos', 'diana.rios@correo.com', 'diana789', 800000, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indexes for table `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`idApartamento`),
  ADD KEY `idPropietarioFK` (`idPropietarioFK`);

--
-- Indexes for table `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`idConcepto`);

--
-- Indexes for table `cuentacobro`
--
ALTER TABLE `cuentacobro`
  ADD PRIMARY KEY (`idCuentaCobro`),
  ADD KEY `idApartamentoFK` (`idApartamentoFK`),
  ADD KEY `idAdministradorFK` (`idAdministradorFK`),
  ADD KEY `idConceptoFK` (`idConceptoFK`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idCuentaCobro` (`idCuentaCobro`);

--
-- Indexes for table `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`idPropietario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartamento`
--
ALTER TABLE `apartamento`
  ADD CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`idPropietarioFK`) REFERENCES `propietario` (`idPropietario`);

--
-- Constraints for table `cuentacobro`
--
ALTER TABLE `cuentacobro`
  ADD CONSTRAINT `cuentacobro_ibfk_1` FOREIGN KEY (`idApartamentoFK`) REFERENCES `apartamento` (`idApartamento`),
  ADD CONSTRAINT `cuentacobro_ibfk_2` FOREIGN KEY (`idAdministradorFK`) REFERENCES `administrador` (`idAdministrador`),
  ADD CONSTRAINT `cuentacobro_ibfk_3` FOREIGN KEY (`idConceptoFK`) REFERENCES `concepto` (`idConcepto`);

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idCuentaCobro`) REFERENCES `cuentacobro` (`idCuentaCobro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
