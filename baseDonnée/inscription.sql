-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 15 juil. 2020 à 00:43
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `inscription`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(20) NOT NULL AUTO_INCREMENT,
  `emailAdmin` varchar(60) NOT NULL,
  `nomAdmin` varchar(20) NOT NULL,
  `prenomAdmin` varchar(20) NOT NULL,
  `mdpAdmin` varchar(20) NOT NULL,
  `deadline` date NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `emailAdmin`, `nomAdmin`, `prenomAdmin`, `mdpAdmin`, `deadline`) VALUES
(1, 'admin1_insea@gmail.com', 'Skalli', 'Ahmed', 'inscriptionprojet202', '2020-07-22');

-- --------------------------------------------------------

--
-- Structure de la table `demandesvalidee`
--

DROP TABLE IF EXISTS `demandesvalidee`;
CREATE TABLE IF NOT EXISTS `demandesvalidee` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `Matricule` int(20) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Cycle` varchar(30) NOT NULL,
  `Niveau` varchar(30) NOT NULL,
  `Date_naissance` date NOT NULL DEFAULT current_timestamp(),
  `Date_inscp` date NOT NULL DEFAULT current_timestamp(),
  `Sexe` varchar(20) NOT NULL,
  `Filiere` varchar(50) NOT NULL,
  `photos` varchar(300) NOT NULL,
  `copie_CIN` varchar(300) NOT NULL,
  `copie_BAC` varchar(300) NOT NULL,
  `attestation_R` varchar(300) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `valid` int(2) NOT NULL,
  `token` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demandesvalidee`
--

INSERT INTO `demandesvalidee` (`id`, `Matricule`, `Nom`, `Prenom`, `Cycle`, `Niveau`, `Date_naissance`, `Date_inscp`, `Sexe`, `Filiere`, `photos`, `copie_CIN`, `copie_BAC`, `attestation_R`, `Email`, `password`, `valid`, `token`) VALUES
(35, 48487, 'Zarrouq', 'Soukaina', 'Ingenieur', '2A', '2020-07-14', '2020-07-14', 'Femme', 'Ac finance', '_Stat demo_1A.png', '_Stat demo_1A. png', '_Stat demo_1A. png', '_Stat demo_1A. png', 'zarrouqsoukaina@gmail.com', '$2y$10$TpPn0LBkzlyrdoOAGfH.TON0MsBfLmsrh7HGPHhfxNW9n90H27H4W', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

DROP TABLE IF EXISTS `informations`;
CREATE TABLE IF NOT EXISTS `informations` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `Matricule` int(20) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Cycle` varchar(30) NOT NULL,
  `Niveau` varchar(30) NOT NULL,
  `Date_naissance` date NOT NULL DEFAULT current_timestamp(),
  `Date_inscp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sexe` varchar(20) NOT NULL,
  `Filiere` varchar(50) NOT NULL,
  `photos` varchar(300) NOT NULL,
  `copie_CIN` varchar(300) NOT NULL,
  `copie_BAC` varchar(300) NOT NULL,
  `attestation_R` varchar(300) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `valid` int(2) NOT NULL,
  `token` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
