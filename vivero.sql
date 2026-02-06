-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 02:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vivero`
--
CREATE DATABASE IF NOT EXISTS `vivero` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vivero`;

-- --------------------------------------------------------

--
-- Table structure for table `arboles`
--

DROP TABLE IF EXISTS `arboles`;
CREATE TABLE `arboles` (
  `id_arbol` int(11) NOT NULL,
  `nombre_cientifico` varchar(100) NOT NULL,
  `nombre_imagen` varchar(255) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `nombre_comun` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fruto` text NOT NULL,
  `floracion` text NOT NULL,
  `usos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arboles`
--

INSERT INTO `arboles` (`id_arbol`, `nombre_cientifico`, `nombre_imagen`, `id_familia`, `nombre_comun`, `descripcion`,
                       `fruto`, `floracion`, `usos`)
VALUES (51, 'a', 'RSULogo.png', 7, 'a', 'a', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `arboles_familia`
--

DROP TABLE IF EXISTS `arboles_familia`;
CREATE TABLE `arboles_familia` (
  `id_familia` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arboles_familia`
--

INSERT INTO `arboles_familia` (`id_familia`, `nombre`) VALUES

-- --------------------------------------------------------

--
-- Stand-in structure for view `arbol_descripcion`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `arbol_descripcion`;
CREATE TABLE `arbol_descripcion` (
`id_arbol` int(11)
,`familia` varchar(20),
`nombre_imagen` varchar(255)
,`nombre_cientifico` varchar(100)
,`nombre_comun` varchar(100)
,`descripcion` text
,`fruto` text
,`floracion` text
,`usos` text
);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `contrasena` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `nombre`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure for view `arbol_descripcion`
--
DROP TABLE IF EXISTS `arbol_descripcion`;

DROP VIEW IF EXISTS `arbol_descripcion`;
CREATE ALGORITHM = UNDEFINED DEFINER =`root`@`localhost` SQL SECURITY DEFINER VIEW `arbol_descripcion` AS
SELECT `a`.`id_arbol`          AS `id_arbol`,
       `af`.`nombre`           AS `familia`,
       `a`.`nombre_imagen`     AS `nombre_imagen`,
       `a`.`nombre_cientifico` AS `nombre_cientifico`,
       `a`.`nombre_comun`      AS `nombre_comun`,
       `a`.`descripcion`       AS `descripcion`,
       `a`.`fruto`             AS `fruto`,
       `a`.`floracion`         AS `floracion`,
       `a`.`usos`              AS `usos`
FROM (`arboles` `a` join `arboles_familia` `af`)
WHERE `a`.`id_familia` = `af`.`id_familia`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arboles`
--
ALTER TABLE `arboles`
  ADD PRIMARY KEY (`id_arbol`),
  ADD KEY `arboles_ibfk_1` (`id_familia`);

--
-- Indexes for table `arboles_familia`
--
ALTER TABLE `arboles_familia`
  ADD PRIMARY KEY (`id_familia`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arboles`
--
ALTER TABLE `arboles`
    MODIFY `id_arbol` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 52;

--
-- AUTO_INCREMENT for table `arboles_familia`
--
ALTER TABLE `arboles_familia` 
    MODIFY `nombre` VARCHAR(100) NOT NULL;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arboles`
--
ALTER TABLE `arboles`
 - ADD CONSTRAINT `arboles_ibfk_1` FOREIGN KEY (`id_familia`) REFERENCES `arboles_familia` (`id_familia`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
