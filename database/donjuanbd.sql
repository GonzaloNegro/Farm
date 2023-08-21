-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230322.7514e75794
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2023 a las 18:58:43
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `donjuanbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(5) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_Categoria` int(11) NOT NULL,
  `nombreCategoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_Categoria`, `nombreCategoria`) VALUES
(1, 'Ternero'),
(2, 'Novillito'),
(3, 'Vaquillona'),
(4, 'Novillo'),
(5, 'Vaca'),
(6, 'Toro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraproyecto`
--

CREATE TABLE `compraproyecto` (
  `id_CompraProyecto` int(11) NOT NULL,
  `id_Compras` int(11) NOT NULL,
  `id_Proyecto` int(11) DEFAULT NULL,
  `id_TipoCompra` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compraproyecto`
--

INSERT INTO `compraproyecto` (`id_CompraProyecto`, `id_Compras`, `id_Proyecto`, `id_TipoCompra`) VALUES
(34, 2, 0, 1),
(35, 1, 5, 2),
(36, 9, 7, 2),
(37, 22, 11, 2),
(38, 3, 0, 1),
(39, 4, 0, 1),
(40, 8, 0, 1),
(41, 10, 0, 1),
(42, 11, 0, 1),
(43, 18, 0, 1),
(44, 19, 0, 1),
(45, 20, 0, 1),
(46, 21, 0, 1),
(47, 22, 0, 1),
(48, 23, 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_Compras` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipoFactura` varchar(45) NOT NULL,
  `puntoDeVenta` int(11) NOT NULL,
  `nroFactura` int(11) NOT NULL,
  `tipoDocEmisor` varchar(45) NOT NULL,
  `nroDocEmisor` int(11) NOT NULL,
  `id_Proveedor` int(2) NOT NULL,
  `tipoCambio` varchar(45) NOT NULL,
  `id_Moneda` int(2) NOT NULL,
  `importeNeto` decimal(10,0) NOT NULL,
  `IVA` varchar(45) NOT NULL,
  `importeTotal` decimal(10,0) NOT NULL,
  `detalle` varchar(150) NOT NULL,
  `id_Forma` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_Compras`, `fecha`, `tipoFactura`, `puntoDeVenta`, `nroFactura`, `tipoDocEmisor`, `nroDocEmisor`, `id_Proveedor`, `tipoCambio`, `id_Moneda`, `importeNeto`, `IVA`, `importeTotal`, `detalle`, `id_Forma`) VALUES
(1, '2022-11-06', 'B', 123, 789456, 'DNI', 13150131, 1, '330', 2, 1500, '12,5', 1785, 'probando esto', 2),
(2, '2023-05-31', 'B', 234, 456789, 'CUIT', 23, 3, '400', 1, 99999, '21', 10101010, 'prueba2', 1),
(3, '2023-06-04', 'A', 147, 987654, 'DNI', 13150131, 4, '400', 1, 8963147, '21', 9000000, 'mejora', 3),
(4, '2023-06-22', 'A', 369, 852123, 'DNI', 8456123, 3, '430', 1, 8000800, '12,5', 9590001, 'mejorachat', 1),
(8, '2023-06-04', 'B', 111, 121, 'CUIT', 23, 2, '500', 1, 741555, '12,5', 999888, 'pruebacasifinal', 3),
(9, '2023-06-06', 'A', 999, 9999999, 'CUIT', 23, 5, '490', 1, 100, '12,5', 150, 'aumentar Importe', 2),
(10, '2023-06-26', 'A', 1, 123, 'CUIT', 0, 4, '500', 2, 100, '100', 100, '', 2),
(11, '2023-06-26', 'A', 1, 123, 'CUIT', 123, 4, '490', 2, 100, '100', 100, 'test', 1),
(18, '2023-06-26', 'A', 999, 999, 'CUIT', 89898989, 1, '88', 2, 890, '8', 890, 'aaa', 4),
(19, '2023-07-28', 'B', 234, 547787, 'CUIL', 232342453, 4, '540', 1, 1000, '21', 1210, 'TER', 3),
(20, '2023-07-28', 'C', 2312, 542354, 'CUIL', 123123, 4, '540', 1, 1000, '21', 1210, 'dssss', 1),
(21, '2023-07-28', 'B', 12, 35453453, 'CUIL', 1234537878, 5, '545', 1, 1000, '21', 1210, 'po', 1),
(22, '2023-07-28', 'B', 12, 35453453, 'CUIL', 1234537878, 5, '545', 1, 1000, '21', 1210, 'po', 1),
(23, '2023-08-01', 'B', 534, 654654, 'DNI', 2147483647, 4, '545', 1, 10000, '21', 12100, 'NNN', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultivos`
--

CREATE TABLE `cultivos` (
  `id_Cultivo` int(11) NOT NULL,
  `nombreCultivo` varchar(45) NOT NULL,
  `kgSemillaHas` int(11) NOT NULL,
  `rindeEsperadoHas` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cultivos`
--

INSERT INTO `cultivos` (`id_Cultivo`, `nombreCultivo`, `kgSemillaHas`, `rindeEsperadoHas`) VALUES
(1, 'Maiz de Primera', 20, '5000'),
(2, 'Maiz de Segunda', 20, '6000'),
(3, 'Girasol', 20, '2000'),
(4, 'Cebada', 110, '3000'),
(5, 'Avena', 6, '2000'),
(6, 'Alfalfa', 10, '5'),
(7, 'Soja', 70, '2500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallealquiler`
--

CREATE TABLE `detallealquiler` (
  `id_DetalleAlquiler` int(3) NOT NULL,
  `id_Proyecto` int(3) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaCierre` date NOT NULL,
  `montoEstipulado` varchar(45) NOT NULL,
  `id_Moneda` int(2) NOT NULL,
  `tipoCambio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallealquiler`
--

INSERT INTO `detallealquiler` (`id_DetalleAlquiler`, `id_Proyecto`, `fechaInicio`, `fechaCierre`, `montoEstipulado`, `id_Moneda`, `tipoCambio`) VALUES
(5, 111, '2023-07-03', '2023-07-21', '65000', 2, '580'),
(6, 112, '2023-07-01', '2023-09-30', '27000', 2, '585');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallehacienda`
--

CREATE TABLE `detallehacienda` (
  `id_DetalleHacienda` int(11) NOT NULL,
  `id_Proyecto` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaCierre` date NOT NULL,
  `cantidadCabezas` int(11) NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `inversion` varchar(45) NOT NULL,
  `id_Moneda` int(2) NOT NULL,
  `tipoCambio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallehacienda`
--

INSERT INTO `detallehacienda` (`id_DetalleHacienda`, `id_Proyecto`, `fechaInicio`, `fechaCierre`, `cantidadCabezas`, `id_Categoria`, `inversion`, `id_Moneda`, `tipoCambio`) VALUES
(1, 2, '2023-01-02', '2024-06-18', 12, 1, '1500000', 2, '500'),
(2, 4, '2022-09-21', '2023-08-26', 25, 1, '4500000', 2, '500'),
(3, 8, '2023-07-24', '2023-10-26', 15, 1, '55000', 2, '535'),
(4, 11, '2023-08-30', '2023-12-27', 10, 6, '2000000', 1, '545'),
(5, 10, '2023-06-10', '2023-07-27', 10, 3, '100000', 1, '560');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesiembra`
--

CREATE TABLE `detallesiembra` (
  `id_DetalleSiembra` int(11) NOT NULL,
  `id_Proyecto` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaCierre` date NOT NULL,
  `id_Cultivo` int(11) NOT NULL,
  `inversion` double NOT NULL,
  `id_Moneda` int(2) NOT NULL,
  `tipoCambio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallesiembra`
--

INSERT INTO `detallesiembra` (`id_DetalleSiembra`, `id_Proyecto`, `fechaInicio`, `fechaCierre`, `id_Cultivo`, `inversion`, `id_Moneda`, `tipoCambio`) VALUES
(4, 1, '2022-11-02', '2023-06-22', 2, 1500000, 2, '500'),
(5, 3, '2022-11-06', '2023-07-20', 3, 6500000, 2, '500'),
(6, 5, '2022-09-21', '2023-06-30', 7, 9906129, 2, '500'),
(7, 7, '2023-06-01', '2024-01-06', 1, 10000599, 2, '500'),
(8, 9, '2023-07-28', '2023-12-27', 2, 1500000, 1, '535'),
(9, 101, '2023-08-06', '2023-10-11', 4, 1500000, 2, '580');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproyecto`
--

CREATE TABLE `estadoproyecto` (
  `id_EstadoProyecto` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoproyecto`
--

INSERT INTO `estadoproyecto` (`id_EstadoProyecto`, `estado`) VALUES
(1, 'No iniciado'),
(2, 'Iniciado'),
(3, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadousuario`
--

CREATE TABLE `estadousuario` (
  `id_EstadoUsuario` int(1) NOT NULL,
  `estadoUsuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadousuario`
--

INSERT INTO `estadousuario` (`id_EstadoUsuario`, `estadoUsuario`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `id_Forma` int(2) NOT NULL,
  `formaPago` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`id_Forma`, `formaPago`) VALUES
(1, 'Efectivo'),
(2, 'Transferencia'),
(3, 'Cheque'),
(4, 'Se debe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id_Moneda` int(2) NOT NULL,
  `moneda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_Moneda`, `moneda`) VALUES
(1, 'ARS'),
(2, 'USD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcela`
--

CREATE TABLE `parcela` (
  `id_Parcela` int(11) NOT NULL,
  `dimension` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `parcela`
--

INSERT INTO `parcela` (`id_Parcela`, `dimension`) VALUES
(1, 43),
(2, 90),
(3, 100),
(4, 70),
(5, 100),
(6, 70),
(7, 100),
(8, 35),
(9, 65),
(10, 95),
(11, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_Proveedor` int(2) NOT NULL,
  `proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_Proveedor`, `proveedor`) VALUES
(1, 'Cereales Quemú'),
(2, 'Nutrien AG Solutions Argentina S.A.'),
(3, 'Servicios y Combustibles S.R.L'),
(4, 'Fedea SA'),
(5, 'Mapfre'),
(6, 'Municipalidad Villa Mirasol'),
(7, 'Thomas Jorge Adolfo'),
(8, 'Nuevoa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_Proyecto` int(11) NOT NULL,
  `id_Parcela` int(11) NOT NULL,
  `nombreProyecto` varchar(45) NOT NULL,
  `id_TipoProyecto` int(11) NOT NULL,
  `cantidadHas` int(11) NOT NULL,
  `id_EstadoProyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_Proyecto`, `id_Parcela`, `nombreProyecto`, `id_TipoProyecto`, `cantidadHas`, `id_EstadoProyecto`) VALUES
(1, 7, 'Cosecha Gruesa Maiz 2023', 2, 50, 3),
(2, 7, 'Aberdinangus', 1, 15, 2),
(3, 5, 'Girasol 2022', 2, 60, 3),
(4, 5, 'Heldford 2022', 1, 40, 2),
(5, 10, 'Soja 2023', 2, 60, 3),
(6, 4, 'Angus 2023', 1, 45, 2),
(7, 1, 'Loritoloco', 2, 35, 2),
(8, 1, 'proyectoNuevo', 1, 2, 2),
(9, 1, 'proyectoNuevo2', 2, 1, 2),
(10, 1, 'ProyectoFin', 1, 1, 3),
(11, 8, 'PoryectoFecha', 1, 10, 1),
(101, 8, 'ProyectoTrigo', 2, 5, 2),
(111, 10, 'ProyectoCorrecto', 3, 6, 3),
(112, 10, 'ProyAlqIni', 3, 12, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocompra`
--

CREATE TABLE `tipocompra` (
  `id_TipoCompra` int(1) NOT NULL,
  `tipoCompra` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipocompra`
--

INSERT INTO `tipocompra` (`id_TipoCompra`, `tipoCompra`) VALUES
(1, 'General'),
(2, 'Asignada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproyecto`
--

CREATE TABLE `tipoproyecto` (
  `id_tipoProyecto` int(11) NOT NULL,
  `tipoProyecto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoproyecto`
--

INSERT INTO `tipoproyecto` (`id_tipoProyecto`, `tipoProyecto`) VALUES
(1, 'Hacienda'),
(2, 'Siembra'),
(3, 'Alquiler');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipoUsuario` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipoUsuario`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Lector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `id_tipoUsuario` int(11) NOT NULL,
  `id_EstadoUsuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `nombre`, `apellido`, `id_tipoUsuario`, `id_EstadoUsuario`) VALUES
(1, 'admin', '123', 'lucila', 'dolce', 1, 1),
(3, 'Aldito', '1234', 'Aldo', 'Dolce', 1, 1),
(4, 'Silvia', '1234', 'Silvia', 'Unterman', 1, 1),
(7, 'tu turrito', '1234', 'hernan', 'altola', 2, 1),
(8, 'nuevoaa', 'nuevoa', 'nuevoa', 'nuevoa', 2, 2),
(9, 'nuevo', 'nuevo', 'nuevo', 'nuevo', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `compraproyecto`
--
ALTER TABLE `compraproyecto`
  ADD PRIMARY KEY (`id_CompraProyecto`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_Compras`);

--
-- Indices de la tabla `cultivos`
--
ALTER TABLE `cultivos`
  ADD PRIMARY KEY (`id_Cultivo`);

--
-- Indices de la tabla `detallealquiler`
--
ALTER TABLE `detallealquiler`
  ADD PRIMARY KEY (`id_DetalleAlquiler`);

--
-- Indices de la tabla `detallehacienda`
--
ALTER TABLE `detallehacienda`
  ADD PRIMARY KEY (`id_DetalleHacienda`);

--
-- Indices de la tabla `detallesiembra`
--
ALTER TABLE `detallesiembra`
  ADD PRIMARY KEY (`id_DetalleSiembra`);

--
-- Indices de la tabla `estadoproyecto`
--
ALTER TABLE `estadoproyecto`
  ADD PRIMARY KEY (`id_EstadoProyecto`);

--
-- Indices de la tabla `estadousuario`
--
ALTER TABLE `estadousuario`
  ADD PRIMARY KEY (`id_EstadoUsuario`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`id_Forma`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_Moneda`);

--
-- Indices de la tabla `parcela`
--
ALTER TABLE `parcela`
  ADD PRIMARY KEY (`id_Parcela`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_Proveedor`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_Proyecto`);

--
-- Indices de la tabla `tipocompra`
--
ALTER TABLE `tipocompra`
  ADD PRIMARY KEY (`id_TipoCompra`);

--
-- Indices de la tabla `tipoproyecto`
--
ALTER TABLE `tipoproyecto`
  ADD PRIMARY KEY (`id_tipoProyecto`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipoUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compraproyecto`
--
ALTER TABLE `compraproyecto`
  MODIFY `id_CompraProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_Compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `cultivos`
--
ALTER TABLE `cultivos`
  MODIFY `id_Cultivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detallealquiler`
--
ALTER TABLE `detallealquiler`
  MODIFY `id_DetalleAlquiler` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallehacienda`
--
ALTER TABLE `detallehacienda`
  MODIFY `id_DetalleHacienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallesiembra`
--
ALTER TABLE `detallesiembra`
  MODIFY `id_DetalleSiembra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estadoproyecto`
--
ALTER TABLE `estadoproyecto`
  MODIFY `id_EstadoProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadousuario`
--
ALTER TABLE `estadousuario`
  MODIFY `id_EstadoUsuario` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `id_Forma` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_Moneda` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parcela`
--
ALTER TABLE `parcela`
  MODIFY `id_Parcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_Proveedor` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_Proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `tipocompra`
--
ALTER TABLE `tipocompra`
  MODIFY `id_TipoCompra` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoproyecto`
--
ALTER TABLE `tipoproyecto`
  MODIFY `id_tipoProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
