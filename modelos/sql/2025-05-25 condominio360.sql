-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2025 a las 01:11:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `condominio360`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
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
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombre`, `apellido`, `correo`, `clave`, `codigoRecuperacion`, `fechaExpiracion`) VALUES
(1, 'Oscar', 'Gonzalez', 'oscaralejandrosoto9@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', 'e18e6eb21d51d894e87a80a57b31bcf5', '2025-05-12 03:20:27'),
(2, 'admin', ':3', 'admin1@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', NULL, NULL),
(3, 'Danna', 'Molina', 'dannaa.molina.b@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE `apartamento` (
  `idApartamento` int(11) NOT NULL,
  `idPropietarioFK` int(11) DEFAULT NULL,
  `torre` varchar(50) DEFAULT NULL,
  `numero_identificador` varchar(50) DEFAULT NULL,
  `piso` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`idApartamento`, `idPropietarioFK`, `torre`, `numero_identificador`, `piso`) VALUES
(101, 1, 'Torre A', '101', '1'),
(102, 2, 'Torre B', '202', '2'),
(103, 2, 'Torre B', '303', '3'),
(104, 3, 'Torre C', '404', '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE `concepto` (
  `idConcepto` int(11) NOT NULL,
  `concepto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`idConcepto`, `concepto`) VALUES
(1, 'Cuota de administración mensual'),
(2, 'Mantenimiento ascensor'),
(3, 'Reparación de zonas comunes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacobro`
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
-- Volcado de datos para la tabla `cuentacobro`
--

INSERT INTO `cuentacobro` (`idCuentaCobro`, `idApartamentoFK`, `idAdministradorFK`, `idConceptoFK`, `monto`, `fechaGeneracion`, `fechaVencimiento`, `estadoPago`, `fechaPago`) VALUES
(1001, 101, 1, 1, 200000, '2025-05-01 10:00:00', '2025-05-10 23:59:59', 1, '2025-05-05 09:30:00'),
(1002, 102, 2, 2, 150000, '2025-05-01 11:00:00', '2025-05-12 23:59:59', 0, NULL),
(1003, 103, 2, 1, 200000, '2025-05-01 12:00:00', '2025-05-10 23:59:59', 1, '2025-05-08 14:00:00'),
(1004, 104, 1, 3, 100000, '2025-05-02 09:00:00', '2025-05-15 23:59:59', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idPago` int(11) NOT NULL,
  `idCuentaCobro` int(11) DEFAULT NULL,
  `valorPagado` double DEFAULT NULL,
  `fechaPago` date DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idPago`, `idCuentaCobro`, `valorPagado`, `fechaPago`, `observaciones`) VALUES
(1, 1001, 200000, '2025-05-05', 'Pago completo realizado a tiempo'),
(2, 1003, 200000, '2025-05-08', 'Pago realizado sin observaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
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
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`idPropietario`, `nombre`, `apellido`, `correo`, `clave`, `saldo`, `codigoRecuperacion`, `fechaExpiracion`) VALUES
(1, 'Ana', 'Pérez', 'oscaralejandrosoto99@gmail.com', 'ana123', 1500000, 'de1e3909986b50816429c16ea74bf7d2', '2025-05-12 03:52:19'),
(2, 'Juan', 'Martínez', 'juan.mtz@correo.com', 'juan456', 500000, NULL, NULL),
(3, 'Diana', 'Ríos', 'diana.rios@correo.com', 'diana789', 800000, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`idApartamento`),
  ADD KEY `idPropietarioFK` (`idPropietarioFK`);

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`idConcepto`);

--
-- Indices de la tabla `cuentacobro`
--
ALTER TABLE `cuentacobro`
  ADD PRIMARY KEY (`idCuentaCobro`),
  ADD KEY `idApartamentoFK` (`idApartamentoFK`),
  ADD KEY `idAdministradorFK` (`idAdministradorFK`),
  ADD KEY `idConceptoFK` (`idConceptoFK`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idCuentaCobro` (`idCuentaCobro`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`idPropietario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`idPropietarioFK`) REFERENCES `propietario` (`idPropietario`);

--
-- Filtros para la tabla `cuentacobro`
--
ALTER TABLE `cuentacobro`
  ADD CONSTRAINT `cuentacobro_ibfk_1` FOREIGN KEY (`idApartamentoFK`) REFERENCES `apartamento` (`idApartamento`),
  ADD CONSTRAINT `cuentacobro_ibfk_2` FOREIGN KEY (`idAdministradorFK`) REFERENCES `administrador` (`idAdministrador`),
  ADD CONSTRAINT `cuentacobro_ibfk_3` FOREIGN KEY (`idConceptoFK`) REFERENCES `concepto` (`idConcepto`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idCuentaCobro`) REFERENCES `cuentacobro` (`idCuentaCobro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
