-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 18 déc. 2022 à 14:09
-- Version du serveur : 5.7.11
-- Version de PHP : 7.2.7

DROP DATABASE IF EXISTS bddCriee;
CREATE DATABASE bddCriee;
USE bddCriee;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddcriee`
--
DROP procedure IF EXISTS afficheInformationConnexionAcheteur;
DROP procedure IF EXISTS afficheInformationConnexionAdmin;
DROP procedure IF EXISTS afficheInformationConnexionDirecteurVente;
DROP procedure IF EXISTS affLot;
DROP procedure IF EXISTS insertAcheteur;
DROP procedure IF EXISTS recupNumAcheteur;
DROP procedure IF EXISTS verifExistMail;
DROP procedure IF EXISTS affEspece;
DELIMITER $$
--
-- Procédures
--

CREATE DEFINER=`root`@`localhost` PROCEDURE `afficheInformationConnexionAcheteur` (IN `mailAch` VARCHAR(255))   BEGIN
    SELECT pwd, login, mailAcheteur, raisonSocialeEntreprise, numRueAcheteur, nomRueAcheteur, codePostal, ville FROM acheteur WHERE mailAcheteur = mailAch ;

END$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `afficheInformationConnexionAdmin` (IN `mailAdmin` VARCHAR(255))   BEGIN
    SELECT pwd, mailAdmin, login FROM administrateur_vente WHERE mailAdmin = mailAdmin ;
END$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `afficheInformationConnexionDirecteurVente` (IN `mailDirecteurVente` VARCHAR(255))   BEGIN
    SELECT pwd, nomDirecteur, mailDirecteur, login FROM directeur_vente WHERE mailDirecteur = mailDirecteurVente ;
END$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `affLot` ()   BEGIN
    SELECT * from LOT;
    
END$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `insertAcheteur` (IN `mailAch` VARCHAR(255), IN `loginAch` VARCHAR(30), IN `pwdAch` VARCHAR(255), IN `raisonSocialeEntrepriseAch` VARCHAR(50), IN `numRueAcheteurAch` VARCHAR(50), IN `nomRueAcheteurAch` VARCHAR(50), IN `codePostalAch` VARCHAR(30), IN `villeAch` VARCHAR(50), IN `numHabilitationAch` VARCHAR(50))   BEGIN
    INSERT INTO `acheteur` (`mailAcheteur`,`login`, `pwd`, `raisonSocialeEntreprise`, `numRueAcheteur`, `nomRueAcheteur`, `codePostal`, `ville`, `numHabilitation`) VALUES (mailAch, loginAch, pwdAch, raisonSocialeEntrepriseAch, numRueAcheteurAch, nomRueAcheteurAch, codePostalAch, villeAch, numHabilitationAch);

END$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `recupNumAcheteur` (`loginAch` VARCHAR(30), `pwdAch` VARCHAR(30))   BEGIN
    SELECT idAcheteur FROM ACHETEUR WHERE login = loginAch 
    AND pwd = pwdAch;
    
END$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `verifExistMail` (IN `mailD` VARCHAR(255))   BEGIN
    SELECT mailAcheteur FROM acheteur WHERE mailAcheteur = mailD;

END$$


CREATE procedure affEspece()
BEGIN
    SELECT idEspece, nomEspece from espece;
    
END $$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE `acheteur` (
  `idAcheteur` int(10) NOT NULL,
  `mailAcheteur` varchar(255) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `raisonSocialeEntreprise` varchar(50) DEFAULT NULL,
  `numRueAcheteur` varchar(50) DEFAULT NULL,
  `nomRueAcheteur` varchar(50) DEFAULT NULL,
  `codePostal` varchar(7) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `numHabilitation` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`idAcheteur`, `mailAcheteur`, `login`, `pwd`, `raisonSocialeEntreprise`, `numRueAcheteur`, `nomRueAcheteur`, `codePostal`, `ville`, `numHabilitation`) VALUES
(1, 'eric@gmail.com', 'eric', '$2y$10$WSglPpUuxi1rGjlUhde7zObynxf7OaOAbG3.dycXBIAFq6KrPcwLG', 'SAPMER', '6', 'Rue de la peche', '30350', 'Le Gardon', 'Aucun'),
(2, 'axel@gmail.com', 'axel6GU', '1234', 'Poissonnier', '13', 'Rue du poisson', '54350', 'Le Kopa', 'Aucun'),
(27, 'fffeferfrrefff@gmail.com', 'jo', '$2y$10$dAOdB.IgYWg1ZQYBd5/queQLkTwKj4dmsoGIMyKf92KJoHK4LuVOG', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(28, 'fffeferfrrefff@gmail.com', 'jo', '$2y$10$t/xXLUeud3bxQWeH52nONujUcus4EDNNdbXqL3Ibmg74UHCJZZxAe', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(29, 'fffeferfrrefff@gmail.com', 'jo', '$2y$10$gNBugeF.3YoM2GJtIll6hurChcvB254qRSFk4zSV5P29I8UByFoKm', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(30, 'fffeferfrrefff@gmail.com', 'jo', '$2y$10$bpQHwsybLwxTQb09PPeAF.BPZ1Wcy8EXVZ2TKKUxRQrTcBMaD9nEK', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(31, 'fffeferfrrefff@gmail.com', 'jo', '$2y$10$11oGJchyOrzrEObRnjLL6utJyG.p8gZvx9EjaYSQBY06fPrUxCh3S', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(32, 'fezfezfezfez@gmail.com', 'jo', '$2y$10$LHwfE3agnI2OGqcgvfRNV.6M9FW8xa/O8fxS3e.OuJMxO6Yebd9R2', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(33, 'fezfezfdvezfez@gmail.com', 'jo', '$2y$10$JEg6u7F2iNxCXL6kJi1zpe5p6xRumsa./Lq/K3md3PVuit3xrzQ4y', 'll', 'll', 'll', 'gui', 'll', 'fez'),
(34, 'wassimty@gmail.com', 'fezfez', '$2y$10$3Zpk8wezJR3WzaLIBViSgOSNCVykjijr.vFDSMD4JtckNghY1FQOa', 'd', 'hui', 'j', 'fez', 'vds', 'aucun'),
(35, 'jeanaimare@gmail.com', 'da', '$2y$10$rc4a4u9UxtfJ5aTCgitO2u6M4Hv6XZHUI71yteWQRp/Nqv3/HJv.2', 'pop', '3', 'hiu', 'fez', 'strasbourg', 'vds');

-- --------------------------------------------------------

--
-- Structure de la table `administrateur_vente`
--

CREATE TABLE `administrateur_vente` (
  `idAdmin` int(10) NOT NULL,
  `mailAdmin` varchar(255) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur_vente`
--

INSERT INTO `administrateur_vente` (`idAdmin`, `mailAdmin`, `login`, `pwd`) VALUES
(1, 'laurent@gmail.com', 'laurent', '$2y$10$rc4a4u9UxtfJ5aTCgitO2u6M4Hv6XZHUI71yteWQRp/Nqv3/HJv.2');

-- --------------------------------------------------------

--
-- Structure de la table `bac`
--

CREATE TABLE `bac` (
  `idBac` int(10) NOT NULL,
  `tare` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bac`
--

INSERT INTO `bac` (`idBac`, `tare`) VALUES
(1, '2,5');

INSERT INTO `bac` (`idBac`, `tare`) VALUES
(2, '4');

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `idBateau` int(10) NOT NULL,
  `nomBateau` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`idBateau`, `nomBateau`) VALUES
(1, 'Aviso');

-- --------------------------------------------------------

--
-- Structure de la table `directeur_vente`
--

CREATE TABLE `directeur_vente` (
  `idDirecteur` int(10) NOT NULL,
  `nomDirecteur` varchar(30) DEFAULT NULL,
  `mailDirecteur` varchar(255) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `directeur_vente`
--

INSERT INTO `directeur_vente` (`idDirecteur`, `nomDirecteur`, `mailDirecteur`, `login`, `pwd`) VALUES
(1, 'Paul', 'paul.marc@gmail.com', 'Marc', '$2y$10$rc4a4u9UxtfJ5aTCgitO2u6M4Hv6XZHUI71yteWQRp/Nqv3/HJv.2');

-- --------------------------------------------------------

--
-- Structure de la table `encherir`
--

CREATE TABLE `encherir` (
  `idLot` int(10) NOT NULL,
  `idBateau` int(10) NOT NULL,
  `datePeche` datetime NOT NULL,
  `dateEnchere` datetime NOT NULL,
  `idAcheteur` int(10) NOT NULL,
  `prixEnchere` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `encherir`
--

INSERT INTO `encherir` (`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES
(1, 1, '2022-11-18 19:45:22', '2022-11-18 19:53:52', 1, '1200'),
(1, 1, '2022-11-18 19:45:22', '2022-11-18 19:57:49', 1, '1300');

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `idEspece` int(10) NOT NULL,
  `nomScientifiqueEspece` varchar(30) DEFAULT NULL,
  `nomCommunEspece` varchar(30) DEFAULT NULL,
  `nomEspece` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES
(1, 'Baleine Bleue', 'Baleine', 'BalB');


INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES ('2', 'Kingklip', 'Abadeche', 'Abadeche'), ('3', 'Engraulis encrasicolus', 'Anchois', 'Anchois');

INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES ('4', 'Anguilla anguilla', 'Anguille', 'Anguille'), ('5', 'Dicentrarchus labrax', 'Bar', 'Bar');

INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES ('6', 'Sprattus sprattus', 'Brisling', 'Brisling'), ('7', 'Essox lucius', 'Brochet', 'Brochet');

INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES ('8', 'Loligo forbesi', 'Calmar', 'Calmar'), ('9', 'Mallotus villosus', 'Capelan', 'Capelan');

INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES ('10', 'Cyprinidae', 'Carpe', 'Carpe'), ('11', 'Trachurus trachurus', 'Chinchard', 'Chinchard');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`idFacture`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `dateEnchere` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`dateEnchere`) VALUES
('2022-11-18 19:53:52'),
('2022-11-18 19:57:49');

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `idLot` int(10) NOT NULL,
  `idBateau` int(10) NOT NULL,
  `datePeche` datetime NOT NULL,
  `idEspece` int(10) DEFAULT NULL,
  `idTaille` int(10) DEFAULT NULL,
  `idPresentation` varchar(50) DEFAULT NULL,
  `idBac` int(10) DEFAULT NULL,
  `idAcheteur` int(10) DEFAULT NULL,
  `idQualite` int(10) DEFAULT NULL,
  `idAdmin` int(10) DEFAULT NULL,
  `idDirecteur` int(10) DEFAULT NULL,
  `idFacture` int(10) DEFAULT NULL,
  `poidsBrutLot` varchar(50) DEFAULT NULL,
  `prixPlancher` varchar(50) DEFAULT NULL,
  `prixDepart` varchar(50) DEFAULT NULL,
  `prixEnchereMax` varchar(50) DEFAULT NULL,
  `dateEnchere` datetime DEFAULT NULL,
  `heureDebutEnchere` datetime DEFAULT NULL,
  `codeEtat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`) VALUES
(1, 1, '2022-11-18 19:45:22', 1, 1, '1', 1, 1, 1, 1, 1, 1, '1400', '650', '800', '1100', '2022-11-18 19:52:17', '2022-11-18 21:52:17', 'A'),
(2, 1, '2022-11-18 19:45:22', 1, 1, '1', 1, 2, 1, 1, 1, 1, '900', '850', '900', '1050', '2022-11-19 19:52:17', '2022-11-19 21:52:17', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `peche`
--

CREATE TABLE `peche` (
  `idBateau` int(10) NOT NULL,
  `datePeche` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `peche`
--

INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES
(1, '2022-11-18 19:45:22');

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

CREATE TABLE `presentation` (
  `idPresentation` varchar(50) NOT NULL,
  `libellePr` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `presentation`
--

INSERT INTO `presentation` (`idPresentation`, `libellePr`) VALUES
('1', 'Presentation1');

-- --------------------------------------------------------

--
-- Structure de la table `qualite`
--

CREATE TABLE `qualite` (
  `idQualite` int(10) NOT NULL,
  `nomQualite` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `qualite`
--

INSERT INTO `qualite` (`idQualite`, `nomQualite`) VALUES
(1, 'qualite1'),
(2, 'qualite2');

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

CREATE TABLE `taille` (
  `idTaille` int(10) NOT NULL,
  `specification` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`idTaille`, `specification`) VALUES
('1', 'Petite taille');

INSERT INTO `taille` (`idTaille`, `specification`) VALUES
(2, 'Grande taille');



--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`idAcheteur`);

--
-- Index pour la table `administrateur_vente`
--
ALTER TABLE `administrateur_vente`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `bac`
--
ALTER TABLE `bac`
  ADD PRIMARY KEY (`idBac`);

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD PRIMARY KEY (`idBateau`);

--
-- Index pour la table `directeur_vente`
--
ALTER TABLE `directeur_vente`
  ADD PRIMARY KEY (`idDirecteur`);

--
-- Index pour la table `encherir`
--
ALTER TABLE `encherir`
  ADD PRIMARY KEY (`dateEnchere`,`idAcheteur`,`idBateau`,`datePeche`,`idLot`),
  ADD KEY `idBateau` (`idBateau`,`datePeche`,`idLot`),
  ADD KEY `idAcheteur` (`idAcheteur`);

--
-- Index pour la table `espece`
--
ALTER TABLE `espece`
  ADD PRIMARY KEY (`idEspece`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idFacture`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`dateEnchere`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`idBateau`,`datePeche`,`idLot`),
  ADD KEY `idQualite` (`idQualite`),
  ADD KEY `idTaille` (`idTaille`),
  ADD KEY `idEspece` (`idEspece`),
  ADD KEY `idBac` (`idBac`),
  ADD KEY `idAcheteur` (`idAcheteur`),
  ADD KEY `idPresentation` (`idPresentation`),
  ADD KEY `idFacture` (`idFacture`),
  ADD KEY `idAdmin` (`idAdmin`),
  ADD KEY `idDirecteur` (`idDirecteur`);

--
-- Index pour la table `peche`
--
ALTER TABLE `peche`
  ADD PRIMARY KEY (`idBateau`,`datePeche`);

--
-- Index pour la table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`idPresentation`);

--
-- Index pour la table `qualite`
--
ALTER TABLE `qualite`
  ADD PRIMARY KEY (`idQualite`);

--
-- Index pour la table `taille`
--
ALTER TABLE `taille`
  ADD PRIMARY KEY (`idTaille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acheteur`
--
ALTER TABLE `acheteur`
  MODIFY `idAcheteur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `administrateur_vente`
--
ALTER TABLE `administrateur_vente`
  MODIFY `idAdmin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `bateau`
--
ALTER TABLE `bateau`
  MODIFY `idBateau` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `directeur_vente`
--
ALTER TABLE `directeur_vente`
  MODIFY `idDirecteur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `encherir`
--
ALTER TABLE `encherir`
  ADD CONSTRAINT `encherir_ibfk_1` FOREIGN KEY (`idBateau`,`datePeche`,`idLot`) REFERENCES `lot` (`idBateau`, `datePeche`, `idLot`),
  ADD CONSTRAINT `encherir_ibfk_2` FOREIGN KEY (`dateEnchere`) REFERENCES `historique` (`dateEnchere`),
  ADD CONSTRAINT `encherir_ibfk_3` FOREIGN KEY (`idAcheteur`) REFERENCES `acheteur` (`idAcheteur`);

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`idQualite`) REFERENCES `qualite` (`idQualite`),
  ADD CONSTRAINT `lot_ibfk_10` FOREIGN KEY (`idDirecteur`) REFERENCES `directeur_vente` (`idDirecteur`),
  ADD CONSTRAINT `lot_ibfk_2` FOREIGN KEY (`idTaille`) REFERENCES `taille` (`idTaille`),
  ADD CONSTRAINT `lot_ibfk_3` FOREIGN KEY (`idEspece`) REFERENCES `espece` (`idEspece`),
  ADD CONSTRAINT `lot_ibfk_4` FOREIGN KEY (`idBateau`,`datePeche`) REFERENCES `peche` (`idBateau`, `datePeche`),
  ADD CONSTRAINT `lot_ibfk_5` FOREIGN KEY (`idBac`) REFERENCES `bac` (`idBac`),
  ADD CONSTRAINT `lot_ibfk_6` FOREIGN KEY (`idAcheteur`) REFERENCES `acheteur` (`idAcheteur`),
  ADD CONSTRAINT `lot_ibfk_7` FOREIGN KEY (`idPresentation`) REFERENCES `presentation` (`idPresentation`),
  ADD CONSTRAINT `lot_ibfk_8` FOREIGN KEY (`idFacture`) REFERENCES `facture` (`idFacture`),
  ADD CONSTRAINT `lot_ibfk_9` FOREIGN KEY (`idAdmin`) REFERENCES `administrateur_vente` (`idAdmin`);

--
-- Contraintes pour la table `peche`
--
ALTER TABLE `peche`
  ADD CONSTRAINT `peche_ibfk_1` FOREIGN KEY (`idBateau`) REFERENCES `bateau` (`idBateau`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
