-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2025 a las 15:54:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_seguridadciudadana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `tipo_incidencia` varchar(50) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `barrio` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `nivel_urgencia` varchar(20) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'En proceso',
  `fecha_finalizacion` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `tipo_incidencia`, `fecha`, `hora`, `barrio`, `descripcion`, `latitud`, `longitud`, `imagen`, `nivel_urgencia`, `idUsuario`, `nota`, `estado`, `fecha_finalizacion`, `nombre`, `correo`) VALUES
(1, 'robo/hurto', '2024-02-04', '13:22', 'Buenos aires', 'prueba', '5.686211127732348', '-76.65610649484718', '20231004202227_MicrosoftTeams-image_(3).png', 'bajo', 2, 'Se envío patrulla al lugar de los hechos a revisar lo sucedido ,\n04/10/2023 se logro capturar a los implicados en el robo, esta conformado por un grupo de 4 personas donde 3 de ellos son hombres en los 18 y 25 años y una mujer entre 30 y 38 años, fueron puesto ante la fiscxalía general de la nación.', 'Finalizada', '2023-10-04 23:35:28', NULL, NULL),
(3, 'vandalismo', '2023-03-11', '17:08', 'prueba', 'prueba', '5.686208636494454', '-76.65610436700142', '20231005000833_MicrosoftTeams-image_(1).png', 'bajo', NULL, NULL, 'Finalizada', '2023-10-05 00:10:47', NULL, NULL),
(4, 'vandalismo', '2023-10-04', '17:12', 'Medrano', 'prueba', '5.686211127732348', '-76.65610649484718', '20231005001244_MicrosoftTeams-image_(3).png', 'bajo', 2, '04/10/2023 se realizaron pruebas', 'Finalizada', '2023-10-05 00:15:22', NULL, NULL),
(5, 'robo/hurto', '2023-05-05', '10:41', 'palenque', 'prueba', '5.0561024', '-75.4843648', '20231005174319_MicrosoftTeams-image_(3).png', 'bajo', NULL, '05/10/2023 se envío una patrulla al lugar de los hechos.', 'Finalizada', '2023-10-05 17:46:57', NULL, NULL),
(6, 'robo/hurto', '2023-10-05', '17:58', 'palenque', 'prueba', '5.6851847', '-76.6602155', '20231006005834_MicrosoftTeams-image_(1).png', 'bajo', NULL, '03/10/2023 se envio una patrulla al lugar del incidente\n05/10/2023 se capturaron a los implicados y estan puesto ante la fiscalía general de la nacion', 'Finalizada', '2023-10-06 01:02:01', NULL, NULL),
(7, 'vandalismo', '2023-10-10', '17:47', 'entrada a sanvicente', 'prueba', '5.68537475', '-76.66020925', '20231011004754_MenaCode.png', 'bajo', NULL, '10-10-2023 se envio una patrulla al lugar de los echos\n11-10-2023 se se capturaron a los implicados del hurto calificado', 'Finalizada', '2023-10-11 00:51:07', NULL, NULL),
(8, 'emergencia', '2023-10-14', '18:38', 'aurora', 'Anciano del barrio requiere de atención médica, se necesita que se envié una ambulancia lo mas rápido posible', '5.686214', '-76.656109', '20231015014325_MicrosoftTeams-image.png', 'medio', 2, NULL, 'En proceso', NULL, NULL, NULL),
(9, 'incendio', '2024-09-19', '15:25', 'Medrano', 'prueba', '5.6828574', '-76.6470809', 'default.png', 'alto', NULL, 'hhh', 'Finalizada', '2023-10-19 23:49:23', 'Haminton Mena Mena', 'hamintonjair@gmail.com'),
(10, 'robo/hurto', '2023-11-07', '19:23', 'Sanvicente', 'dos personas llegaron a la universidad con arma de fuego y amenazaron a unos estudiantes', '5.685010399495082', '-76.66021434063549', '20231108012915_Captura_de_pantalla_2023-05-12_085937.png', 'alto', NULL, NULL, 'Finalizada', '2024-04-01 02:07:43', 'horacio palacios', 'mafia00796@hotmail.com'),
(18, 'otro', '2024-01-28', '14:44', 'Sanvicente', 'prueba', '5.705606083455933', '-76.6585695455337', 'default.png', 'medio', 2, NULL, 'Finalizada', '2024-04-01 02:07:07', 'Haminton Mena Mena', 'mafia00796@hotmail.com'),
(19, 'accidente transito', '2024-01-28', '14:46', 'Medrano', 'prueba', '5.704328560435225', '-76.6523474043015', 'default.png', 'alto', 2, 'prueba', 'Finalizada', '2024-01-29 00:49:17', 'Haminton Mena Mena', 'mafia00796@hotmail.com'),
(20, 'robo/hurto', '2024-09-09', '16:21', 'Sanvicente', 'Dos personas llegaron con arma de fuego y le dispararon a un señor', '5.685261919659202', '-76.6602130358422', 'default.png', 'alto', NULL, '09/09/2024 se envio un patrullero al lugar de los hechos', 'Finalizada', '2024-09-09 23:28:15', 'Haminton Jair Mena Mena', 'hamintonjair@gmail.com'),
(21, 'accidente laborales', '2024-09-15', '09:21', 'Buenos aires', 'prueba ', '5.704857950511639', '-76.65285715584838', '20240916162208_Autoliquidaciones_72703939_Consolidado_page-0001.jpg', 'bajo', NULL, NULL, 'Finalizada', '2024-09-19 23:28:15', 'Duvan Mateo Mena', 'duvan3374@gmail.com'),
(22, 'accidente laborales', '2024-09-15', '09:21', 'Buenos aires', 'prueba ', '5.704857950511639', '-76.65285715584838', '20240916162617_Autoliquidaciones_72703939_Consolidado_page-0001.jpg', 'bajo', NULL, NULL, 'Finalizada', '2024-09-14 23:28:15', 'Duvan Mateo Mena', 'duvan3374@gmail.com'),
(23, 'robo/hurto', '2024-09-15', '09:26', 'Buenos aires', 'prueba', '5.70506537785176', '-76.65299926593006', '20240916162702_Autoliquidaciones_72703939_Consolidado_page-0001.jpg', 'bajo', NULL, NULL, 'En proceso', NULL, 'Duvan Mateo Mena', 'duvan3374@gmail.com'),
(24, 'desastres', '2024-09-24', '10:19', 'kennedy', 'el atrato se llevo una casa', '5.705619451455383', '-76.65316247567135', '20240924171944_Captura_de_pantalla_2024-09-19_175934.png', 'alto', NULL, NULL, 'En proceso', NULL, 'Haminton Jair Mena Mena', 'hmenam@miuniclaretiana.edu.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_emergencias`
--

CREATE TABLE `lineas_emergencias` (
  `id` int(11) NOT NULL,
  `entidad` varchar(50) NOT NULL,
  `linea` int(11) NOT NULL,
  `nota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lineas_emergencias`
--

INSERT INTO `lineas_emergencias` (`id`, `entidad`, `linea`, `nota`) VALUES
(1, 'Policia', 123, 'Llama a la policía en caso de situaciones de emergencia que requieran su atención.'),
(3, 'Bomberos', 456, 'Si hay un incendio u otra emergencia relacionada con el fuego, comunícate con los bomberos.'),
(4, 'Centros de Denuncia de Delitos', 911, 'Para denunciar delitos o emergencias policiales.'),
(5, 'Ministerio de salud y protección social', 106, 'El objetivo de esta línea es brindar un espacio de comunicación telefónica gratis a niños, niñas y adolescentes de Bogotá a través de una red profesional. Aquí se escuchan y orientan en problemas académicos, trastornos de conductas alimentarias, violencia familiar, social y escolar, abuso sexual, uso y abuso de sustancias psicoactivas, conducta suicida, embarazo juvenil y matoneo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `link`
--

INSERT INTO `link` (`id`, `url`) VALUES
(2, '8nHCWRtWam0'),
(3, 'DBF8iAEejVU'),
(4, 'LZgqXsGJQ7Y'),
(6, 'wULPW2oIVhQ'),
(7, 'erQx6BemELQ'),
(8, 'd2fNv2D_kVI'),
(9, 'znVLDo_kyIc'),
(10, 'RDNSznVLDo_kyIc'),
(11, 'RDNSznVLDo_kyIc'),
(12, 'RDNSznVLDo_kyIc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session_temporal`
--

CREATE TABLE `session_temporal` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `session_temporal`
--

INSERT INTO `session_temporal` (`id`, `idUsuario`, `nombre`, `rol`) VALUES
(53, 1, 'Administrador', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `clave`, `rol`) VALUES
(1, 'Administrador', 'hamintonjair@gmail.com', 'menaH01+', 'admin'),
(2, 'Haminton Mena Mena', 'mafia00796@hotmail.com', 'menaH01+', 'usuario'),
(3, 'Digna Luz Mena Cordoba', 'diluzmeco@gmail.com', 'menaH01+', 'usuario'),
(5, 'Horacio Palacios Palacios', 'horacio@gmail.com', 'menaH01+', 'operador'),
(6, 'prueba', 'prueb@gmail.com', '12345', 'operador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_emergencias`
--
ALTER TABLE `lineas_emergencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `session_temporal`
--
ALTER TABLE `session_temporal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `lineas_emergencias`
--
ALTER TABLE `lineas_emergencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `session_temporal`
--
ALTER TABLE `session_temporal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
