-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 18, 2025 at 10:28 PM
-- Server version: 9.2.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistique_symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_conditionnement` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `emplacement` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `quota` int NOT NULL,
  `stock` int NOT NULL,
  `est_actif` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_maj` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `reference`, `type_conditionnement`, `quantite`, `emplacement`, `prix`, `quota`, `stock`, `est_actif`, `date_creation`, `date_maj`) VALUES
(1, 'Stylo Bic M10 1mm BLEU', '90121', 'Boîte', 50, 'B1T4R2E4', 38.95, 1, 35, 1, '2025-01-28 13:25:24', '2025-01-29 08:29:50'),
(2, 'Stylo Bic M10 1mm NOIR', '90125', 'Boîte', 50, 'B1T4R2E4', 38.95, 1, 35, 1, '2025-01-28 13:25:24', '2025-01-29 08:29:54'),
(3, 'Agrafeuse Rapid K1 - 50 feuilles', '50101', 'Sachet', 1, 'B1T4R2E4', 21.35, 1, 56, 1, '2025-01-28 13:39:01', '2025-01-29 08:29:56'),
(4, 'Agrafe Rapid 26/6 galvanisée', '70127', 'Boîte', 1000, 'B1T4R2E4', 1.05, 3, 247, 1, '2025-01-28 13:43:45', '2025-01-29 08:29:59'),
(5, 'Bloc Oxford A5 - 80 feuilles - Lot de 3', '781742', 'Carton', 1, 'B1T4R2E4', 5.39, 2, 15, 1, '2025-01-28 13:54:36', '2025-01-29 08:30:02'),
(6, 'Grand calendrier 2025', 'GC2025', 'Carton', 25, 'B1T4R3E1', 1.89, 5, 160, 1, '2025-01-28 14:04:21', '2025-01-29 08:30:08'),
(7, 'Petit calendrier 2025', 'PC2025', 'Carton', 25, 'B1T4R3E1', 1.89, 5, 85, 1, '2025-01-28 14:04:21', '2025-01-29 08:30:12'),
(8, 'Affiche Création d\'entreprise 60x80cm', 'AFF CETV 2025', 'Pochette', 5, 'B1T4R3E1', 12.45, 1, 12, 1, '2025-01-28 14:08:01', '2025-01-29 08:30:14'),
(9, 'Affiche Transition énergétique 80x120', 'AFF LTE 2025', 'Pochette', 5, 'B1T4R3E1', 21.3, 1, 20, 1, '2025-01-28 14:29:00', '2025-01-29 08:30:17'),
(10, 'Affiche Crédit pêche 60x80', 'AFF CMP 2025', 'Pochette', 5, 'B1T4R3E1', 12.5, 1, 20, 1, '2025-01-28 14:29:00', '2025-01-29 08:30:20'),
(11, 'Tote bag 2025', 'TOTEBAG 2025', 'Carton', 25, 'B1T4R3E2', 2.47, 3, 495, 1, '2025-01-28 14:35:54', '2025-01-29 10:44:25'),
(12, 'Pochette entreprise', 'POC ENT 2025', 'Carton', 25, 'B1T4R3E2', 1.89, 3, 495, 1, '2025-01-28 14:35:54', '2025-01-29 10:44:30'),
(13, 'Bidule', 'BDL', 'Sachet', 10, 'H23', 1.5, 3, 5, 0, '2025-03-18 22:27:26', '2025-03-18 22:27:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
