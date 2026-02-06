-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2026 a las 10:01:18
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
-- Base de datos: `vivero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arboles`
--

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
-- Volcado de datos para la tabla `arboles`
--

INSERT INTO `arboles` (`id_arbol`, `nombre_cientifico`, `nombre_imagen`, `id_familia`, `nombre_comun`, `descripcion`, `fruto`, `floracion`, `usos`) VALUES
(73, 'Hypoestes phyllostachya', 'trefle_1770367899.jpg', 89, 'Flamingo-plant', 'asdasd', 'n/a', 'n/a', 'asdasd'),
(74, 'Quercus rotundifolia', 'trefle_77116.jpg', 90, 'Evergreen oak', 'Planta importada automáticamente. Año de descubrimiento: 1785. Bibliografía: Encycl. 1: 723 (1785)', 'No especificado', 'No especificada', 'Ornamental'),
(75, 'Urtica dioica', 'trefle_109482.jpg', 91, 'Common nettle', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 984 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(76, 'Dactylis glomerata', 'trefle_227114.jpg', 92, 'Barnyard grass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 71 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(77, 'Plantago lanceolata', 'trefle_128860.jpg', 93, 'Narrow-leaf plantain', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 113 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(78, 'Achillea millefolium', 'trefle_11971.jpg', 94, 'Milfoil', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 899 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(79, 'Trifolium repens', 'trefle_51662.jpg', 95, 'Dutch clover', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 767 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(80, 'Holcus lanatus', 'trefle_230202.jpg', 92, 'Yorkshire-fog', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 1048 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(81, 'Ranunculus repens', 'trefle_122042.jpg', 96, 'Creeping buttercup', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 554 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(82, 'Quercus robur', 'trefle_77107.jpg', 90, 'Pedunculate oak', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 996 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(83, 'Festuca rubra', 'trefle_229588.jpg', 92, 'Red fescue', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 1:74.  1753', 'No especificado', 'No especificada', 'Ornamental'),
(84, 'Fraxinus excelsior', 'trefle_221416.jpg', 97, 'European ash', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 1057 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(85, 'Cirsium arvense', 'trefle_1999.jpg', 94, 'California thistle', 'Planta importada automáticamente. Año de descubrimiento: 1771. Bibliografía: Fl. Carniol., ed. 2, 2: 126 (1771)', 'No especificado', 'No especificada', 'Ornamental'),
(86, 'Trifolium pratense', 'trefle_51657.jpg', 95, 'Cowgrass clover', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 768 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(87, 'Fagus sylvatica', 'trefle_257312.jpg', 90, 'Beech', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 998 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(88, 'Juncus effusus', 'trefle_208738.jpg', 98, 'Soft rush', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 326 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(89, 'Ranunculus acris', 'trefle_121255.jpg', 96, 'Meadow buttercup', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 554 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(90, 'Ranunculus acris', 'trefle_121255.jpg', 96, 'Meadow buttercup', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 554 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(91, 'Crataegus monogyna', 'trefle_265334.jpg', 99, 'Hawthorn', 'Planta importada automáticamente. Año de descubrimiento: 1775. Bibliografía: Fl. Austriac. 3: 50 (1775)', 'No especificado', 'No especificada', 'Ornamental'),
(92, 'Rumex acetosa', 'trefle_106738.jpg', 100, 'Garden sorrel', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 1:337.  1753, nom. cons.', 'No especificado', 'No especificada', 'Ornamental'),
(93, 'Rumex acetosa', 'trefle_106738.jpg', 100, 'Garden sorrel', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 1:337.  1753, nom. cons.', 'No especificado', 'No especificada', 'Ornamental'),
(94, 'Calluna vulgaris', 'trefle_155762.jpg', 101, 'Heather', 'Planta importada automáticamente. Año de descubrimiento: 1808. Bibliografía: Brit. Fl., ed. 2, 1: 114 (1808)', 'No especificado', 'No especificada', 'Ornamental'),
(95, 'Calluna vulgaris', 'trefle_155762.jpg', 101, 'Heather', 'Planta importada automáticamente. Año de descubrimiento: 1808. Bibliografía: Brit. Fl., ed. 2, 1: 114 (1808)', 'No especificado', 'No especificada', 'Ornamental'),
(96, 'Filipendula ulmaria', 'trefle_262017.jpg', 99, 'Meadowsweet', 'Planta importada automáticamente. Año de descubrimiento: 1879. Bibliografía: Trudy Imp. S.-Peterburgsk. Bot. Sada 6: 251 (1879)', 'No especificado', 'No especificada', 'Ornamental'),
(97, 'Filipendula ulmaria', 'trefle_262017.jpg', 99, 'Meadowsweet', 'Planta importada automáticamente. Año de descubrimiento: 1879. Bibliografía: Trudy Imp. S.-Peterburgsk. Bot. Sada 6: 251 (1879)', 'No especificado', 'No especificada', 'Ornamental'),
(98, 'Corylus avellana', 'trefle_243294.jpg', 102, 'European filbert', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 998 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(99, 'Corylus avellana', 'trefle_243294.jpg', 102, 'European filbert', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 998 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(100, 'Phragmites australis', 'trefle_233333.jpg', 92, 'Ditch reed', 'Planta importada automáticamente. Año de descubrimiento: 1841. Bibliografía: Nomencl. Bot., ed. 2, 2: 324 (1841)', 'No especificado', 'No especificada', 'Ornamental'),
(101, 'Phragmites australis', 'trefle_233333.jpg', 92, 'Ditch reed', 'Planta importada automáticamente. Año de descubrimiento: 1841. Bibliografía: Nomencl. Bot., ed. 2, 2: 324 (1841)', 'No especificado', 'No especificada', 'Ornamental'),
(102, 'Glechoma hederacea', 'trefle_259042.jpg', 103, 'Gill-over-the-ground', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 578 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(103, 'Glechoma hederacea', 'trefle_259042.jpg', 103, 'Gill-over-the-ground', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 578 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(104, 'Agrostis capillaris', 'trefle_223892.jpg', 92, 'New zealand bent grass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 62 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(105, 'Agrostis capillaris', 'trefle_223892.jpg', 92, 'New zealand bent grass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 62 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(106, 'Anthoxanthum odoratum', 'trefle_224694.jpg', 92, 'Scented vernal grass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 28 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(107, 'Anthoxanthum odoratum', 'trefle_224694.jpg', 92, 'Scented vernal grass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 28 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(108, 'Hedera helix', 'trefle_261115.jpg', 104, 'Ivy', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 202 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(109, 'Hedera helix', 'trefle_261115.jpg', 104, 'Ivy', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 202 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(110, 'Agrostis stolonifera', 'trefle_224250.jpg', 92, 'Spreading bent', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 62 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(111, 'Agrostis stolonifera', 'trefle_224250.jpg', 92, 'Spreading bent', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 62 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(112, 'Plantago major', 'trefle_128843.jpg', 93, 'Common plantain', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 112 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(113, 'Plantago major', 'trefle_128843.jpg', 93, 'Common plantain', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 112 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(114, 'Lotus corniculatus', 'trefle_51200.jpg', 95, 'Common bird\'s-foot trefoil', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 2:775.  1753', 'No especificado', 'No especificada', 'Ornamental'),
(115, 'Lotus corniculatus', 'trefle_51200.jpg', 95, 'Common bird\'s-foot trefoil', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 2:775.  1753', 'No especificado', 'No especificada', 'Ornamental'),
(116, 'Sorbus aucuparia', 'trefle_266232.jpg', 99, 'Quickbeam', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 477 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(117, 'Sorbus aucuparia', 'trefle_266232.jpg', 99, 'Quickbeam', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 477 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(118, 'Poa trivialis', 'trefle_234144.jpg', 92, 'Rough bluegrass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 67 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(119, 'Poa trivialis', 'trefle_234144.jpg', 92, 'Rough bluegrass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 67 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(120, 'Galium aparine', 'trefle_257909.jpg', 106, 'Cleavers', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 108 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(121, 'Galium aparine', 'trefle_257909.jpg', 105, 'Cleavers', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 108 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(122, 'Pinus sylvestris', 'trefle_127300.jpg', 107, 'Scotch pine', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 1000 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(123, 'Pinus sylvestris', 'trefle_127300.jpg', 107, 'Scotch pine', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 1000 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(124, 'Prunella vulgaris', 'trefle_74232.jpg', 103, 'Heal-all', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 600 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(125, 'Prunella vulgaris', 'trefle_74232.jpg', 103, 'Heal-all', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 600 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(126, 'Arrhenatherum elatius', 'trefle_225102.jpg', 92, 'Ray-grass-de-france', 'Planta importada automáticamente. Año de descubrimiento: 1819. Bibliografía: Fl. Cech.: 17 (1819)', 'No especificado', 'No especificada', 'Ornamental'),
(127, 'Arrhenatherum elatius', 'trefle_225102.jpg', 92, 'Ray-grass-de-france', 'Planta importada automáticamente. Año de descubrimiento: 1819. Bibliografía: Fl. Cech.: 17 (1819)', 'No especificado', 'No especificada', 'Ornamental'),
(128, 'Lolium perenne', 'trefle_231147.jpg', 92, 'Perennial ryegrass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 1:83.  1753', 'No especificado', 'No especificada', 'Ornamental'),
(129, 'Lolium perenne', 'trefle_231147.jpg', 92, 'Perennial ryegrass', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. pl. 1:83.  1753', 'No especificado', 'No especificada', 'Ornamental'),
(130, 'Quercus suber', 'trefle_77191.jpg', 90, 'Cork oak', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 995 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(131, 'Quercus suber', 'trefle_77191.jpg', 90, 'Cork oak', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 995 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(132, 'Prunus spinosa', 'trefle_265201.jpg', 99, 'Sloe', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 475 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(133, 'Prunus spinosa', 'trefle_265201.jpg', 99, 'Sloe', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 475 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(134, 'Heracleum sphondylium', 'trefle_193824.jpg', 108, 'Cow-parsnip', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 249 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(135, 'Heracleum sphondylium', 'trefle_193824.jpg', 108, 'Cow-parsnip', 'Planta importada automáticamente. Año de descubrimiento: 1753. Bibliografía: Sp. Pl.: 249 (1753)', 'No especificado', 'No especificada', 'Ornamental'),
(136, 'Deschampsia cespitosa', 'trefle_227247.jpg', 92, 'Tufted hairgrass', 'Planta importada automáticamente. Año de descubrimiento: 1812. Bibliografía: Ess. Agrostogr.: 91 (1812)', 'No especificado', 'No especificada', 'Ornamental'),
(137, 'Deschampsia cespitosa', 'trefle_227247.jpg', 92, 'Tufted hairgrass', 'Planta importada automáticamente. Año de descubrimiento: 1812. Bibliografía: Ess. Agrostogr.: 91 (1812)', 'No especificado', 'No especificada', 'Ornamental');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arboles`
--
ALTER TABLE `arboles`
  ADD PRIMARY KEY (`id_arbol`),
  ADD KEY `arboles_ibfk_1` (`id_familia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arboles`
--
ALTER TABLE `arboles`
  MODIFY `id_arbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arboles`
--
ALTER TABLE `arboles`
  ADD CONSTRAINT `arboles_ibfk_1` FOREIGN KEY (`id_familia`) REFERENCES `arboles_familia` (`id_familia`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
