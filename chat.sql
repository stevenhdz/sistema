-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 03-11-2020 a las 23:06:22
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `chat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `from` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `message`, `from`, `created`, `image`) VALUES
(301, 'Hola', 'Steven Alexander hernandez', '2020-10-24 20:33:12', '1602969637.jpg'),
(302, 'hol', 'Alexander Hernandez Torres', '2020-10-24 20:36:16', '1601756043.jpg'),
(303, 'll', 'Steven Alexander hernandez', '2020-10-24 20:39:23', '1602969637.jpg'),
(304, 'hola', 'Steven Alexander hernandez', '2020-10-24 20:39:31', '1602969637.jpg'),
(305, 'feo', 'Alexander Hernandez Torres', '2020-10-24 21:15:09', '1601756043.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;
