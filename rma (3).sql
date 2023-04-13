-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 oct. 2022 à 01:09
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rma`
--

-- --------------------------------------------------------

--
-- Structure de la table `affaires`
--

CREATE TABLE `affaires` (
  `N_ATTESTATION` bigint(20) NOT NULL,
  `ID_VEHICULE` int(11) NOT NULL,
  `DATE_EFFET` datetime DEFAULT NULL,
  `DATE_ECHEANCE` datetime DEFAULT NULL,
  `DUREE` varchar(30) DEFAULT NULL,
  `MONTANT` decimal(60,0) DEFAULT NULL,
  `DATE_FAIT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `affaires`
--

INSERT INTO `affaires` (`N_ATTESTATION`, `ID_VEHICULE`, `DATE_EFFET`, `DATE_ECHEANCE`, `DUREE`, `MONTANT`, `DATE_FAIT`) VALUES
(1, 1, '2022-09-15 00:46:00', '2023-06-15 00:46:00', '12mois', '4000', '2022-09-15'),
(2, 1, '2022-09-15 00:47:00', '2022-09-30 00:47:00', '3mois', '1000', '2022-09-15'),
(3, 2, '2022-09-15 00:48:00', '2022-09-30 00:48:00', '6mois', '488', '2022-09-15'),
(4, 1, '2022-09-15 11:37:00', '2022-09-18 11:37:00', '3mois', '1000', '2022-09-15'),
(5, 3, '2022-09-17 14:00:00', '2022-12-17 14:00:00', '3mois', '1000', '2022-09-16'),
(6, 4, '2022-09-22 22:21:00', '2022-09-23 22:21:00', '3mois', '244', '2022-09-22'),
(7, 3, '2022-09-22 22:23:00', '2022-09-24 22:24:00', '12mois', '4000', '2022-09-22'),
(8, 4, '2022-09-23 16:54:00', '2022-10-09 16:54:00', '12mois', '976', '2022-09-23'),
(9, 4, '2022-09-23 16:55:00', '2022-09-23 16:55:00', '6mois', '488', '2022-09-23'),
(10, 4, '2022-10-01 16:55:00', '2022-09-30 16:55:00', '12mois', '976', '2022-09-23'),
(11, 4, '2022-09-23 16:56:00', '2022-10-02 16:56:00', '12mois', '976', '2022-09-23'),
(12, 4, '2022-09-23 16:59:00', '2022-09-24 16:59:00', '6mois', '488', '2022-09-23'),
(13, 5, '2022-09-29 12:00:00', '2023-09-29 12:09:00', '12mois', '2040', '2022-09-28');

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `NUM_A` int(11) NOT NULL,
  `NOM_A` varchar(80) DEFAULT NULL,
  `ADRESSE` varchar(100) DEFAULT NULL,
  `NUM_AVENU` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`NUM_A`, `NOM_A`, `ADRESSE`, `NUM_AVENU`) VALUES
(5998, 'rma wataniya', 'hniya hamriya safi', 333);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_C` int(11) NOT NULL,
  `CIN_C` varchar(20) NOT NULL,
  `NUM_A` int(11) NOT NULL DEFAULT 5998,
  `NOM_C` varchar(100) DEFAULT NULL,
  `PRENOM_C` varchar(100) DEFAULT NULL,
  `DATE_N` date DEFAULT NULL,
  `EMAIL_C` varchar(100) DEFAULT NULL,
  `NUM_TELE` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_C`, `CIN_C`, `NUM_A`, `NOM_C`, `PRENOM_C`, `DATE_N`, `EMAIL_C`, `NUM_TELE`) VALUES
(1, 'an132332', 5998, 'hnioua', 'abderrahmane', '2022-09-19', 'hniouaabdessamad@gmail.hhdjdiugai', '77524479'),
(2, '4321', 5998, 'sabkari', 'asma', '2022-09-16', 'sabkariasma@gmail.com', '6534478'),
(3, 'an13233', 5998, 'atifi', 'hanane', '2022-09-22', 'atifihanane@gmail.com', '7752448'),
(4, 'hh3553', 5998, 'talbi', 'wissal', '2022-09-28', 'wissaltalbi65@gmail.com', '629625035');

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

CREATE TABLE `employer` (
  `ID_EMP` bigint(20) NOT NULL,
  `NUM_A` int(11) NOT NULL DEFAULT 5998,
  `NOM_EMP` varchar(100) DEFAULT NULL,
  `PRENOM_EMP` varchar(100) DEFAULT NULL,
  `CIN_EMP` varchar(20) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `EMAIL_emp` varchar(100) DEFAULT NULL,
  `NUM_TELE` decimal(10,0) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `photo` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employer`
--

INSERT INTO `employer` (`ID_EMP`, `NUM_A`, `NOM_EMP`, `PRENOM_EMP`, `CIN_EMP`, `DATE_NAISSANCE`, `EMAIL_emp`, `NUM_TELE`, `PASSWORD`, `photo`) VALUES
(5, 5998, 'sabkari', 'abderrahmane', 'mc312787', '2004-02-15', 'abderrahmanerr@gmail.com', '777524479', '81dc9bdb52d04dc20036dbd8313ed055', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `ID_VEHICULE` int(11) NOT NULL,
  `ID_C` int(11) NOT NULL,
  `TYPE_V` varchar(100) DEFAULT NULL,
  `MARQUE` varchar(100) DEFAULT NULL,
  `MODEL` varchar(100) DEFAULT NULL,
  `CARBURANT` varchar(30) DEFAULT NULL,
  `NBR_PLACE` int(11) DEFAULT NULL,
  `MATRICULE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`ID_VEHICULE`, `ID_C`, `TYPE_V`, `MARQUE`, `MODEL`, `CARBURANT`, `NBR_PLACE`, `MATRICULE`) VALUES
(1, 1, 'camion', 'volvo', '2011', 'disel', 3, '15-25'),
(2, 1, 'cyclo', 'sh', '2018', 'essence', 3, '555-555'),
(3, 2, 'camion', 'volvo', '2006', 'disel', 2, '1234-89-9'),
(4, 3, 'cyclo', 'ss', '2018', 'essence', 2, '1234-89-99'),
(5, 4, 'automobile', 'jeep', '2020', 'disel', 5, '2003-15-15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affaires`
--
ALTER TABLE `affaires`
  ADD PRIMARY KEY (`N_ATTESTATION`),
  ADD KEY `FK_ASSOCIATION_5` (`ID_VEHICULE`);

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`NUM_A`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_C`),
  ADD UNIQUE KEY `CIN_C` (`CIN_C`),
  ADD UNIQUE KEY `EMAIL_C` (`EMAIL_C`),
  ADD UNIQUE KEY `NUM_TELE` (`NUM_TELE`),
  ADD KEY `FK_SERVIS` (`NUM_A`);

--
-- Index pour la table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`ID_EMP`),
  ADD UNIQUE KEY `CIN_EMP` (`CIN_EMP`),
  ADD UNIQUE KEY `EMAIL_emp` (`EMAIL_emp`),
  ADD UNIQUE KEY `NUM_TELE` (`NUM_TELE`),
  ADD KEY `FK_TRAVAILLE` (`NUM_A`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`ID_VEHICULE`),
  ADD UNIQUE KEY `MATRICULE` (`MATRICULE`),
  ADD KEY `FK_AVOIR` (`ID_C`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affaires`
--
ALTER TABLE `affaires`
  MODIFY `N_ATTESTATION` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_C` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `employer`
--
ALTER TABLE `employer`
  MODIFY `ID_EMP` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `ID_VEHICULE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affaires`
--
ALTER TABLE `affaires`
  ADD CONSTRAINT `FK_ASSOCIATION_5` FOREIGN KEY (`ID_VEHICULE`) REFERENCES `vehicule` (`ID_VEHICULE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_SERVIS` FOREIGN KEY (`NUM_A`) REFERENCES `agence` (`NUM_A`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `FK_TRAVAILLE` FOREIGN KEY (`NUM_A`) REFERENCES `agence` (`NUM_A`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `FK_AVOIR` FOREIGN KEY (`ID_C`) REFERENCES `client` (`ID_C`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
