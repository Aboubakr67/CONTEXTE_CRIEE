-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 mai 2023 à 15:16
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.18

DROP DATABASE IF EXISTS bddcriee;
CREATE DATABASE bddcriee;
USE bddcriee;


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

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `affBateau` ()   BEGIN
    select * from bateau;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affDeuxLotsPrecedents` ()   BEGIN
SELECT L.idLot, ES.nomEspece, T.specification, L.poidsBrutLot, P.libellePr, Q.nomQualite, B.nomBateau, L.poidsBrutLot, L.prixPlancher, L.prixDepart, L.prixEnchereMax, L.datePeche, L.idBateau, L.heureDebutEnchere, en.prixEnchere, A.login 
FROM LOT L 
INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece 
INNER JOIN TAILLE T ON L.idTaille = T.idTaille 
INNER JOIN PRESENTATION P ON L.idPresentation = P.idPresentation 
INNER JOIN QUALITE Q ON L.idQualite = Q.idQualite 
INNER JOIN BATEAU B ON L.idBateau = B.idBateau 
LEFT OUTER JOIN encherir en ON L.idLot = en.idLot AND en.prixEnchere = (SELECT MAX(prixEnchere) FROM encherir WHERE idLot = L.idLot)
LEFT OUTER JOIN acheteur A ON A.idAcheteur = en.idAcheteur 
WHERE L.codeEtat = "C" 
ORDER BY L.dateEnchere DESC, L.heureDebutEnchere DESC 
LIMIT 2;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affEspece` ()   BEGIN
    SELECT idEspece, nomEspece from espece;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affFactureAcheteur` (IN `p_idFacture` INT(10))   BEGIN
    SELECT L.idLot, ES.nomEspece, T.specification, L.poidsBrutLot, P.libellePr, Q.nomQualite, B.nomBateau, EN.prixEnchere, A.login, L.dateEnchere, L.heureDebutEnchere, L.datePeche, L.idFacture, A.numRueAcheteur, A.nomRueAcheteur, A.codePostal, A.ville, A.idAcheteur
    FROM LOT L INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece 
    INNER JOIN TAILLE T ON L.idTaille = T.idTaille 
    INNER JOIN PRESENTATION P ON L.idPresentation = P.idPresentation 
    INNER JOIN QUALITE Q ON L.idQualite = Q.idQualite 
    INNER JOIN BATEAU B ON L.idBateau = B.idBateau 
    INNER JOIN ENCHERIR EN ON L.idLot = EN.idLot 
    INNER JOIN ACHETEUR A ON L.idAcheteur = A.idAcheteur 
    WHERE L.codeEtat = "C"
    AND EN.prixEnchere = (SELECT MAX(prixEnchere) FROM ENCHERIR WHERE idLot = L.idLot) 
    AND L.idFacture = p_idFacture
    ORDER BY L.dateEnchere, L.heureDebutEnchere DESC;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affHeureJourBloquee` (IN `dateDuJour` DATE)   BEGIN

SELECT heureDebutEnchere as heureUtilisee FROM lot WHERE dateEnchere = dateDuJour;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affHeureUtiliseDuJour` (IN `heureFormulaire` TIME, IN `dateDuJour` DATE)   BEGIN

SELECT COUNT(heureDebutEnchere) as verificationHeure FROM lot WHERE heureDebutEnchere = heureFormulaire AND dateEnchere = dateDuJour;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `afficheInformationConnexionAcheteur` (IN `mailAch` VARCHAR(255))   BEGIN
    SELECT idAcheteur, pwd, login, mailAcheteur, raisonSocialeEntreprise, numRueAcheteur, nomRueAcheteur, codePostal, ville FROM acheteur WHERE mailAcheteur = mailAch ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `afficheInformationConnexionAdmin` (IN `mailA` VARCHAR(255))   BEGIN
    SELECT idAdmin, pwd, mailAdmin, login FROM administrateur_vente WHERE mailAdmin = mailA ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `afficheInformationConnexionDirecteurVente` (IN `mailDirecteurVente` VARCHAR(255))   BEGIN
    SELECT idDirecteur, pwd, nomDirecteur, mailDirecteur, login FROM directeur_vente WHERE mailDirecteur = mailDirecteurVente ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affInfoEspece` (`esp` INT)   BEGIN
    SELECT nomCommunEspece, nomScientifiqueEspece FROM espece WHERE idEspece = esp;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affLot` ()   BEGIN
    SELECT * FROM lot;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affLotCodeA` ()   BEGIN

SELECT espece.nomEspece, bateau.nomBateau, qualite.nomQualite, lot.poidsBrutLot, lot.idLot, lot.datePeche, lot.idBateau FROM LOT,espece,bateau,qualite WHERE CodeEtat='A' AND espece.idEspece= lot.idEspece AND bateau.idBateau= lot.idBateau AND qualite.idQualite = lot.idQualite; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affLotCodeADirecteurVente` (IN `laDate` DATE)   BEGIN

SELECT espece.nomEspece, bateau.nomBateau, qualite.nomQualite, lot.poidsBrutLot, lot.idLot, lot.datePeche, lot.idBateau, lot.heureDebutEnchere FROM LOT,espece,bateau,qualite WHERE CodeEtat='A' AND espece.idEspece= lot.idEspece AND bateau.idBateau= lot.idBateau AND qualite.idQualite = lot.idQualite AND lot.dateEnchere = laDate; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affLotEnVente` ()   BEGIN
SELECT DISTINCT L.idLot, ES.nomEspece, T.specification, L.poidsBrutLot, P.libellePr, Q.nomQualite, B.nomBateau, L.poidsBrutLot,L.prixPlancher, L.prixDepart,L.prixEnchereMax, L.datePeche,L.idBateau, L.heureDebutEnchere, en.prixEnchere, A.login, A.idAcheteur
FROM LOT L INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece INNER JOIN TAILLE T ON L.idTaille = T.idTaille INNER JOIN PRESENTATION P ON L.idPresentation = P.idPresentation INNER JOIN QUALITE Q ON L.idQualite = Q.idQualite INNER JOIN BATEAU B ON L.idBateau = B.idBateau LEFT OUTER JOIN encherir en ON L.idLot = en.idLot LEFT OUTER JOIN acheteur A ON A.idAcheteur = en.idAcheteur WHERE L.codeEtat = "B" AND CONCAT(L.dateEnchere, ' ', L.heureDebutEnchere) <= NOW() ORDER BY L.dateEnchere, L.heureDebutEnchere, en.dateEnchere DESC LIMIT 1; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affLotsSuivants` ()   BEGIN
SELECT DISTINCT L.idLot, L.idBateau, L.datePeche, ES.nomEspece, T.specification, P.libellePr, Q.nomQualite, (L.poidsBrutLot - BAC.tare) , B.nomBateau, L.heureDebutEnchere
FROM LOT L 
INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece 
INNER JOIN TAILLE T ON L.idTaille = T.idTaille 
INNER JOIN PRESENTATION P ON L.idPresentation = P.idPresentation 
INNER JOIN QUALITE Q ON L.idQualite = Q.idQualite 
INNER JOIN BAC ON L.idBac = BAC.idBac 
INNER JOIN BATEAU B ON L.idBateau = B.idBateau 
WHERE L.codeEtat = "B" 
AND DATE(L.dateEnchere) = CURDATE()
AND TIME(L.heureDebutEnchere) >= CURTIME()
ORDER BY L.heureDebutEnchere ASC 
LIMIT 2;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affPanier` (IN `loginAch` VARCHAR(50))   BEGIN
	SELECT L.idLot, ES.nomEspece, T.specification, L.poidsBrutLot, P.libellePr, Q.nomQualite, B.nomBateau, EN.prixEnchere, L.idFacture, L.dateEnchere, L.heureDebutEnchere
FROM LOT L
INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece 
INNER JOIN TAILLE T ON L.idTaille = T.idTaille
INNER JOIN PRESENTATION P ON L.idPresentation = P.idPresentation
INNER JOIN QUALITE Q ON L.idQualite = Q.idQualite
INNER JOIN BATEAU B ON L.idBateau = B.idBateau
INNER JOIN ENCHERIR EN ON L.idLot = EN.idLot
INNER JOIN ACHETEUR A ON L.idAcheteur = A.idAcheteur
WHERE L.codeEtat = "C"
AND A.login = loginAch
AND EN.prixEnchere = (SELECT MAX(prixEnchere) FROM ENCHERIR WHERE idLot = L.idLot)
ORDER BY L.dateEnchere, L.heureDebutEnchere DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affPresentation` ()   BEGIN
    select * from presentation;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affQualite` ()   BEGIN
    select idQualite, codeQualite, nomQualite from qualite;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affTaille` ()   BEGIN
    SELECT idTaille, codeTaille, specification from taille;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affTare` (IN `taille` INT)   BEGIN
    SELECT idBac, tare FROM bac WHERE idBac = taille;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affToutLesAcheteurs` ()   BEGIN
    SELECT idAcheteur, login, raisonSocialeEntreprise, numRueAcheteur, nomRueAcheteur, codePostal, ville, numHabilitation FROM acheteur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affToutLesBac` ()   BEGIN
    SELECT * FROM `bac`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `affToutLesLotsAjd` ()   BEGIN
    SELECT DISTINCT L.idLot, ES.nomCommunEspece, L.poidsBrutLot, T.specification, MAX(E.prixEnchere) as prixEnchere, A.login, L.heureDebutEnchere, L.codeEtat FROM LOT L INNER JOIN espece es ON L.idEspece = ES.idEspece INNER JOIN TAILLE T ON L.idTaille = T.idTaille LEFT OUTER JOIN ENCHERIR E ON L.idLot = E.idLot LEFT OUTER JOIN ACHETEUR A ON E.idAcheteur = A.idAcheteur WHERE L.dateEnchere = CURDATE() GROUP BY L.idLot, ES.nomCommunEspece, L.poidsBrutLot, T.specification, A.login ORDER BY L.idLot ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createFacture` ()   BEGIN
    INSERT INTO facture VALUES ();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `finEnchereLot` (`p_idLot` INT(10), `p_idBateau` INT(10), `p_datePeche` DATETIME, `p_idAcheteur` INT(10), `p_idFacture` INT(10), `p_codeEtat` VARCHAR(5))   BEGIN
    UPDATE `lot` SET `idAcheteur`= p_idAcheteur,`idFacture`= p_idFacture,`codeEtat`= p_codeEtat WHERE `idLot`= p_idLot AND `idBateau`= p_idBateau AND `datePeche`= p_datePeche;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertAcheteur` (IN `mailAch` VARCHAR(255), IN `loginAch` VARCHAR(30), IN `pwdAch` VARCHAR(255), IN `raisonSocialeEntrepriseAch` VARCHAR(50), IN `numRueAcheteurAch` VARCHAR(50), IN `nomRueAcheteurAch` VARCHAR(50), IN `codePostalAch` VARCHAR(30), IN `villeAch` VARCHAR(50), IN `numHabilitationAch` VARCHAR(50))   BEGIN
    INSERT INTO `acheteur` (`mailAcheteur`,`login`, `pwd`, `raisonSocialeEntreprise`, `numRueAcheteur`, `nomRueAcheteur`, `codePostal`, `ville`, `numHabilitation`) VALUES (mailAch, loginAch, pwdAch, raisonSocialeEntrepriseAch, numRueAcheteurAch, nomRueAcheteurAch, codePostalAch, villeAch, numHabilitationAch);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDatePeche` (`idBateau` INT(10), `datePeche` DATETIME)   BEGIN
    INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES (idBateau, datePeche);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertHistoriqueEnchere` (`idLot` INT(10), `idBateau` INT(10), `datePeche` DATETIME, `idAcheteur` INT(10), `prixEnchere` VARCHAR(10))   BEGIN
    INSERT INTO `historique`(`dateEnchere`) VALUES (NOW());
    INSERT INTO `encherir`(`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES (idLot, idBateau, datePeche, NOW() , idAcheteur,prixEnchere);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertLot` (`idLot` INT(10), `idBateau` INT(10), `datePeche` DATETIME, `idEspece` INT(10), `idTaille` INT(10), `idPresentation` INT(50), `idBac` INT(10), `idQualite` INT(10), `idAdmin` INT(10), `idDirecteur` INT(10), `poidsBrutLot` VARCHAR(50), `prixPlancher` VARCHAR(50), `prixDepart` VARCHAR(50), `prixEnchereMax` VARCHAR(50), `dateEnchereP` DATE, `codeEtat` VARCHAR(10))   BEGIN
    INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idQualite`, `idAdmin`, `idDirecteur`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `codeEtat`) VALUES
(idLot, idBateau, datePeche, idEspece, idTaille, idPresentation, idBac, idQualite, idAdmin, idDirecteur, poidsBrutLot, prixPlancher, prixDepart, prixEnchereMax, dateEnchereP, codeEtat);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modifieCodeEtatLot` (IN `heureFormulaire` TIME, IN `codeEtat` VARCHAR(255), IN `idLotForm` INT, IN `idBateauForm` INT, IN `datePecheForm` DATETIME)   BEGIN
UPDATE lot SET heureDebutEnchere = heureFormulaire, codeEtat = codeEtat WHERE lot.idLot = idLotForm AND lot.idBateau = idBateauForm AND lot.datePeche = datePecheForm;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modifieLot` (IN `p_idLot` INT, IN `p_idEspece` INT, IN `p_idTaille` INT, IN `p_idPresentation` VARCHAR(50), IN `p_idBac` INT, IN `p_idAcheteur` INT, IN `p_idQualite` INT, IN `p_poidsBrutLot` VARCHAR(50), IN `p_prixPlancher` VARCHAR(50), IN `p_prixDepart` VARCHAR(50), IN `p_prixEnchereMax` VARCHAR(50), IN `p_dateEnchere` DATE, IN `p_codeEtat` VARCHAR(10))   BEGIN
    UPDATE `lot` SET
        `idEspece` = p_idEspece,
        `idTaille` = p_idTaille,
        `idPresentation` = p_idPresentation,
        `idBac` = p_idBac,
        `idAcheteur` = p_idAcheteur,
        `idQualite` = p_idQualite,
        `poidsBrutLot` = p_poidsBrutLot,
        `prixPlancher` = p_prixPlancher,
        `prixDepart` = p_prixDepart,
        `prixEnchereMax` = p_prixEnchereMax,
        `dateEnchere` = p_dateEnchere,
        `codeEtat` = p_codeEtat
    WHERE `idLot` = p_idLot;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RecupDernierLot` ()   SELECT MAX(idLot) as valeurMax FROM lot$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recuperFactureCreate` ()   BEGIN
    SELECT MAX(idFacture) as idFacture FROM facture;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupLoginAdmin` (`id` INT(10))   BEGIN
    SELECT login from administrateur_vente where idAdmin = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupNumAcheteur` (IN `loginAch` VARCHAR(30))   BEGIN
    SELECT idAcheteur FROM ACHETEUR WHERE login = loginAch;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupNumAdmin` (IN `loginAd` VARCHAR(30))   BEGIN
	SELECT idAdmin FROM administrateur_vente WHERE login = loginAd;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupNumDirecteurVente` (IN `loginDirec` VARCHAR(30))   BEGIN
    SELECT idDirecteur FROM directeur_vente WHERE login = loginDirec;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupPrixLotActuel` (IN `idL` INT, IN `idB` INT, IN `dateP` DATETIME)   BEGIN

SELECT prixEnchere, A.login from encherir, acheteur A WHERE idLot = idL AND idBateau = idB AND datePeche = dateP AND encherir.idAcheteur = A.idAcheteur ORDER BY dateEnchere DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verifExistMail` (IN `mailD` VARCHAR(255))   BEGIN
    SELECT mailAcheteur FROM acheteur WHERE mailAcheteur = mailD;

END$$

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
(1, 'eric@gmail.com', 'eric', '$2y$10$60pcAjFxg07w.Ou.EAbRceTyCJJM9Cq/JZXLEFpX80OZWVmAqbXH6', 'SAPMER', '6', 'Rue de la peche', '30350', 'Le Gardon', 'Aucun'),
(2, 'axel@gmail.com', 'axel6GU', '$2y$10$mPzoA8xh8YCeuhILmsk4fOQamiGwXwrlUoUTTzI09ivu6P004HpR.', 'Poissonnier', '13', 'Rue du poisson', '54350', 'Le Kopa', 'Aucun'),
(3, 'john.doe@gmail.com', 'john', '$2y$10$6zff7rLlSnI/2qhkOB58TuFGTtmJe.3LYPTw2QqCGu812e3VNiSbC', 'ACME Corporation', '15', 'Rue de la Liberté', '75001', 'Paris', 'Aucun'),
(4, 'jane.doe@gmail.com', 'jane', '$2y$10$5vjqEvPlfEgNjFpZxVpi5.bZbLwp7C9XVtwRH74EPHLDeVAiz37Fy', 'Globex Corporation', '42', 'Rue du Commerce', '69002', 'Lyon', '123456'),
(5, 'sara.smith@gmail.com', 'sara', '$2y$10$AoQiCUb7T4hrKKh6Srws..WZlj0wYg0VYxemm3S1PD3OmVDsrlFsu', 'Wayne Enterprises', '25', 'Rue de l\"Industrie', '13001', 'Marseille', '654321'),
(6, 'william.davis@gmail.com', 'william', '$2y$10$jXseGNr9gmngVnLcqnP8AuytBkwEyZXffpXqgP2KndEPB0R.MXFI6', 'Stark Industries', '8', 'Rue des Champs', '33000', 'Bordeaux', 'Aucun'),
(7, 'wassimty@gmail.com', 'wassim', '$2y$10$CSbI1qv5zpimTmnVRsV9Ae8L2KFbZHMdb7DBptPoUL8A8m8p3G4Xe', 'd', 'hui', 'j', 'fez', 'vds', 'aucun'),
(8, 'ab@gmail.com', 'aboubakr', '$2y$10$jHse6R2m9lfLfVlLz3M6tefDbdWdaMX4qQE3.7usXaY5zLKeU9HPm', 'MULLER', '5', 'Rue de la pierre jaune', '67000', 'Strasbourg', 'Aucun');

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
(1, 'laurent@gmail.com', 'laurent', '$2y$10$Oyj4zdizDNmdp.Plc.Kd6OW85Y0SvCLwcAde/.qjOx9FqlskY2KGm');

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
(1, '2,5'),
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
(1, 'Aviso'),
(2, 'Baleinier'),
(3, 'Bateau ostréicole'),
(4, 'Bolincheur'),
(5, 'Caseyeur'),
(6, 'Chalutier'),
(7, 'Chalutier à perche'),
(8, 'Coquillier'),
(9, 'Doris'),
(10, 'Fileyeur'),
(11, 'Harenguier'),
(12, 'Goémonier'),
(13, 'Langoustier'),
(14, 'Ligneur'),
(15, 'Morutier'),
(16, 'Palangrier'),
(17, 'Pointu'),
(18, 'Aviso'),
(19, 'Terre-neuvier'),
(20, 'Thonailleur'),
(21, 'Thonier');

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
(1, 'Paul', 'paul.marc@gmail.com', 'Marc', '$2y$10$YVHZgvqpelvpk3qi4gHjpOkNpbWiRpTzRMwjtur44lhNLA0BweXje');

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
  `prixEnchere` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `encherir`
--

INSERT INTO `encherir` (`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:50:25', 7, 1300),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:50:40', 8, 1350),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:50:46', 7, 1400),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:50:59', 7, 1500),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:51:04', 8, 1550),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:51:18', 7, 1600),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:51:32', 8, 1700),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:51:40', 7, 1750),
(3, 11, '2023-05-01 15:54:59', '2023-05-02 17:51:46', 8, 1799),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:13', 7, 800),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:18', 8, 801),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:24', 7, 900),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:29', 8, 1000),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:44', 7, 1050),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:49', 8, 1100),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:00:56', 7, 1200),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:01:03', 8, 1300),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:01:07', 7, 1390),
(5, 11, '2023-05-01 15:56:21', '2023-05-02 18:01:11', 8, 1400),
(1, 4, '2023-05-01 15:53:49', '2023-05-02 18:27:15', 8, 1500),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:11', 3, 1004),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:24', 3, 1005),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:30', 8, 1100),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:36', 3, 1200),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:41', 8, 1250),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:46', 3, 1500),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:30:54', 8, 1600),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:31:04', 3, 1680),
(2, 10, '2023-05-01 15:54:24', '2023-05-02 18:45:38', 3, 1681),
(6, 10, '2023-05-01 15:56:53', '2023-05-03 08:40:20', 8, 800),
(6, 10, '2023-05-01 15:56:53', '2023-05-03 08:40:28', 7, 850),
(6, 10, '2023-05-01 15:56:53', '2023-05-03 08:40:32', 1, 900),
(6, 10, '2023-05-01 15:56:53', '2023-05-03 08:40:42', 7, 1231),
(6, 10, '2023-05-01 15:56:53', '2023-05-03 08:40:49', 8, 1232),
(10, 12, '2023-05-03 08:36:03', '2023-05-03 09:27:36', 8, 4100),
(10, 12, '2023-05-03 08:36:03', '2023-05-03 09:27:37', 7, 6999),
(12, 9, '2023-05-03 17:00:00', '2023-05-03 17:25:58', 7, 605),
(12, 9, '2023-05-03 17:00:00', '2023-05-03 17:27:28', 1, 700),
(12, 9, '2023-05-03 17:00:00', '2023-05-03 17:27:42', 1, 710),
(12, 9, '2023-05-03 17:00:00', '2023-05-03 17:33:39', 1, 720),
(12, 9, '2023-05-03 17:00:00', '2023-05-03 17:39:15', 7, 796),
(9, 12, '2023-05-03 08:35:01', '2023-05-03 17:40:03', 7, 800),
(9, 12, '2023-05-03 08:35:01', '2023-05-03 17:40:18', 7, 801),
(9, 12, '2023-05-03 08:35:01', '2023-05-03 17:40:31', 8, 802),
(9, 12, '2023-05-03 08:35:01', '2023-05-03 17:40:38', 7, 803),
(13, 11, '2023-05-04 09:44:16', '2023-05-04 09:47:42', 8, 650),
(14, 14, '2023-05-04 09:45:00', '2023-05-10 10:00:41', 8, 218),
(16, 11, '2023-05-22 12:58:49', '2023-05-22 13:04:11', 8, 389);

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
(1, 'Baleine Bleue', 'Baleine', 'BalB'),
(2, 'Kingklip', 'Abadeche', 'Abadeche'),
(3, 'Engraulis encrasicolus', 'Anchois', 'Anchois'),
(4, 'Anguilla anguilla', 'Anguille', 'Anguille'),
(5, 'Dicentrarchus labrax', 'Bar', 'Bar'),
(6, 'Sprattus sprattus', 'Brisling', 'Brisling'),
(7, 'Essox lucius', 'Brochet', 'Brochet'),
(8, 'Loligo forbesi', 'Calmar', 'Calmar'),
(9, 'Mallotus villosus', 'Capelan', 'Capelan'),
(10, 'Cyprinidae', 'Carpe', 'Carpe'),
(11, 'Trachurus trachurus', 'Chinchard', 'Chinchard');

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
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40);

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
('2023-05-02 17:50:25'),
('2023-05-02 17:50:40'),
('2023-05-02 17:50:46'),
('2023-05-02 17:50:59'),
('2023-05-02 17:51:04'),
('2023-05-02 17:51:18'),
('2023-05-02 17:51:32'),
('2023-05-02 17:51:40'),
('2023-05-02 17:51:46'),
('2023-05-02 18:00:13'),
('2023-05-02 18:00:18'),
('2023-05-02 18:00:24'),
('2023-05-02 18:00:29'),
('2023-05-02 18:00:44'),
('2023-05-02 18:00:49'),
('2023-05-02 18:00:56'),
('2023-05-02 18:01:03'),
('2023-05-02 18:01:07'),
('2023-05-02 18:01:11'),
('2023-05-02 18:27:15'),
('2023-05-02 18:30:11'),
('2023-05-02 18:30:24'),
('2023-05-02 18:30:30'),
('2023-05-02 18:30:36'),
('2023-05-02 18:30:41'),
('2023-05-02 18:30:46'),
('2023-05-02 18:30:54'),
('2023-05-02 18:31:04'),
('2023-05-02 18:45:38'),
('2023-05-03 08:40:20'),
('2023-05-03 08:40:28'),
('2023-05-03 08:40:32'),
('2023-05-03 08:40:42'),
('2023-05-03 08:40:49'),
('2023-05-03 09:27:36'),
('2023-05-03 09:27:37'),
('2023-05-03 17:25:58'),
('2023-05-03 17:27:28'),
('2023-05-03 17:27:42'),
('2023-05-03 17:33:39'),
('2023-05-03 17:39:15'),
('2023-05-03 17:40:03'),
('2023-05-03 17:40:18'),
('2023-05-03 17:40:31'),
('2023-05-03 17:40:38'),
('2023-05-04 09:47:42'),
('2023-05-10 10:00:41'),
('2023-05-22 13:04:11');

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
  `dateEnchere` date DEFAULT NULL,
  `heureDebutEnchere` time DEFAULT NULL,
  `codeEtat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`) VALUES
(1, 4, '2023-05-01 15:53:49', 1, 1, '1', 1, 8, 1, 1, 1, 9, '500', '800', '888', '1500', '2023-05-02', '18:20:00', 'C'),
(18, 4, '2023-05-22 12:59:57', 5, 1, '1', 1, NULL, 1, 1, 1, 40, '700', '1200', '1300', '1900', '2023-05-22', '13:20:00', 'C'),
(11, 9, '2023-05-03 13:44:11', 1, 2, '1', 2, NULL, 1, 1, 1, 20, '500', '600', '699', '1000', '2023-05-03', '13:46:00', 'C'),
(12, 9, '2023-05-03 17:00:00', 2, 2, '1', 2, 7, 2, 1, 1, 26, '123', '500', '600', '796', '2023-05-03', '17:31:00', 'C'),
(2, 10, '2023-05-01 15:54:24', 2, 1, '1', 1, 3, 1, 1, 1, 10, '389', '900', '1004', '1699', '2023-05-02', '18:30:00', 'C'),
(6, 10, '2023-05-01 15:56:53', 11, 1, '2', 1, 8, 1, 1, 1, 11, '345', '700', '799', '1232', '2023-05-03', '08:40:00', 'C'),
(7, 10, '2023-05-01 15:57:32', 2, 1, '2', 1, NULL, 1, 1, 1, 13, '780', '1100', '1200', '1700', '2023-05-03', '08:50:00', 'C'),
(8, 10, '2023-05-01 15:57:58', 9, 2, '1', 2, NULL, 2, 1, 1, 18, '821', '1234', '1499', '3000', '2023-05-03', '09:10:00', 'C'),
(3, 11, '2023-05-01 15:54:59', 2, 1, '1', 1, 8, 1, 1, 1, 6, '800', '1200', '1300', '1799', '2023-05-02', '17:50:00', 'C'),
(5, 11, '2023-05-01 15:56:21', 9, 2, '2', 2, 8, 2, 1, 1, 7, '567', '700', '800', '1400', '2023-05-02', '18:00:00', 'C'),
(13, 11, '2023-05-04 09:44:16', 2, 1, '2', 1, NULL, 1, 1, 1, 35, '137', '500', '600', '1000', '2023-05-04', '09:40:00', 'C'),
(16, 11, '2023-05-22 12:58:49', 5, 2, '1', 2, NULL, 2, 1, 1, 38, '120', '300', '389', '792', '2023-05-22', '13:00:00', 'C'),
(4, 12, '2023-05-01 15:55:40', 8, 2, '2', 2, NULL, 2, 1, 1, 8, '1300', '2000', '2200', '3500', '2023-05-02', '18:10:00', 'C'),
(9, 12, '2023-05-03 08:35:01', 2, 1, '1', 1, NULL, 1, 1, 1, 33, '150', '398', '600', '1199', '2023-05-03', '17:35:00', 'C'),
(10, 12, '2023-05-03 08:36:03', 1, 1, '1', 1, 7, 1, 1, 1, 19, '1200', '3999', '4100', '6999', '2023-05-03', '09:20:00', 'C'),
(17, 12, '2023-05-22 12:59:27', 4, 2, '2', 2, NULL, 3, 1, 1, 39, '100', '200', '245', '500', '2023-05-22', '13:10:00', 'C'),
(14, 14, '2023-05-04 09:45:00', 4, 1, '1', 1, 8, 2, 1, 1, 37, '80', '110', '130', '218', '2023-05-04', '10:00:00', 'C'),
(15, 14, '2023-05-04 09:45:35', 8, 1, '2', 1, NULL, 1, 1, 1, 36, '90', '234', '300', '500', '2023-05-04', '09:50:00', 'C');

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
(4, '2023-05-01 15:53:49'),
(4, '2023-05-22 12:59:57'),
(9, '2023-05-03 13:44:11'),
(9, '2023-05-03 17:00:00'),
(10, '2023-05-01 15:54:24'),
(10, '2023-05-01 15:56:53'),
(10, '2023-05-01 15:57:32'),
(10, '2023-05-01 15:57:58'),
(11, '2023-05-01 15:54:59'),
(11, '2023-05-01 15:56:21'),
(11, '2023-05-04 09:44:16'),
(11, '2023-05-22 12:58:49'),
(12, '2023-05-01 15:55:40'),
(12, '2023-05-03 08:35:01'),
(12, '2023-05-03 08:36:03'),
(12, '2023-05-22 12:59:27'),
(14, '2023-05-04 09:45:00'),
(14, '2023-05-04 09:45:35');

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
('1', 'ENTIER'),
('2', 'VIDÉ');

-- --------------------------------------------------------

--
-- Structure de la table `qualite`
--

CREATE TABLE `qualite` (
  `idQualite` int(10) NOT NULL,
  `codeQualite` varchar(1) NOT NULL,
  `nomQualite` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `qualite`
--

INSERT INTO `qualite` (`idQualite`, `codeQualite`, `nomQualite`) VALUES
(1, 'E', 'EXTRA'),
(2, 'A', 'GLACE'),
(3, 'B', 'DEGLASSE');

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

CREATE TABLE `taille` (
  `idTaille` int(10) NOT NULL,
  `codeTaille` varchar(10) NOT NULL,
  `specification` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`idTaille`, `codeTaille`, `specification`) VALUES
(1, 'B', 'Petite taille'),
(2, 'F', 'Grande taille');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vuedeuxlotsprecedents`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vuedeuxlotsprecedents` (
`idLot` int(10)
,`nomEspece` varchar(30)
,`poidsBrutLot` varchar(50)
,`specification` varchar(50)
,`prixEnchere` int(10)
,`login` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_lot_info`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_lot_info` (
`idLot` int(10)
,`nomBateau` varchar(30)
,`datePeche` datetime
,`nomEspece` varchar(30)
,`specification` varchar(50)
,`libellePr` varchar(30)
,`tare` varchar(50)
,`acheteur` varchar(50)
,`nomQualite` varchar(10)
,`admin` varchar(50)
,`directeurVente` varchar(50)
,`idFacture` int(10)
,`poidsBrutLot` varchar(50)
,`prixPlancher` varchar(50)
,`prixDepart` varchar(50)
,`prixEnchereMax` varchar(50)
,`dateEnchere` date
,`heureDebutEnchere` time
,`codeEtat` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vuedeuxlotsprecedents`
--
DROP TABLE IF EXISTS `vuedeuxlotsprecedents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vuedeuxlotsprecedents`  AS SELECT DISTINCT `l`.`idLot` AS `idLot`, `es`.`nomEspece` AS `nomEspece`, `l`.`poidsBrutLot` AS `poidsBrutLot`, `t`.`specification` AS `specification`, `e`.`prixEnchere` AS `prixEnchere`, `a`.`login` AS `login` FROM ((((`lot` `l` join `espece` `es` on(`l`.`idEspece` = `es`.`idEspece`)) join `encherir` `e` on(`l`.`idLot` = `e`.`idLot`)) join `taille` `t` on(`l`.`idTaille` = `t`.`idTaille`)) join `acheteur` `a` on(`e`.`idAcheteur` = `a`.`idAcheteur`)) WHERE `l`.`codeEtat` = 'C' AND cast(`l`.`dateEnchere` as date) = curdate() AND cast(`l`.`heureDebutEnchere` as time) ORDER BY `l`.`dateEnchere` DESC, `l`.`heureDebutEnchere` DESC LIMIT 0, 2222222222222222  ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_lot_info`
--
DROP TABLE IF EXISTS `vue_lot_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_lot_info`  AS SELECT `lot`.`idLot` AS `idLot`, `bateau`.`nomBateau` AS `nomBateau`, `lot`.`datePeche` AS `datePeche`, `espece`.`nomEspece` AS `nomEspece`, `taille`.`specification` AS `specification`, `presentation`.`libellePr` AS `libellePr`, `bac`.`tare` AS `tare`, `acheteur`.`login` AS `acheteur`, `qualite`.`nomQualite` AS `nomQualite`, `administrateur_vente`.`login` AS `admin`, `directeur_vente`.`login` AS `directeurVente`, `lot`.`idFacture` AS `idFacture`, `lot`.`poidsBrutLot` AS `poidsBrutLot`, `lot`.`prixPlancher` AS `prixPlancher`, `lot`.`prixDepart` AS `prixDepart`, `lot`.`prixEnchereMax` AS `prixEnchereMax`, `lot`.`dateEnchere` AS `dateEnchere`, `lot`.`heureDebutEnchere` AS `heureDebutEnchere`, `lot`.`codeEtat` AS `codeEtat` FROM (((((((((((`lot` join `bateau` on(`bateau`.`idBateau` = `lot`.`idBateau`)) join `espece` on(`espece`.`idEspece` = `lot`.`idEspece`)) join `taille` on(`taille`.`idTaille` = `lot`.`idTaille`)) join `presentation` on(`presentation`.`idPresentation` = `lot`.`idPresentation`)) join `bac` on(`bac`.`idBac` = `lot`.`idBac`)) left join `acheteur` on(`acheteur`.`idAcheteur` = `lot`.`idAcheteur`)) join `qualite` on(`qualite`.`idQualite` = `lot`.`idQualite`)) join `administrateur_vente` on(`administrateur_vente`.`idAdmin` = `lot`.`idAdmin`)) join `directeur_vente` on(`directeur_vente`.`idDirecteur` = `lot`.`idDirecteur`)) join `peche` on(`peche`.`idBateau` = `lot`.`idBateau` and `peche`.`datePeche` = `lot`.`datePeche`)) left join `facture` on(`facture`.`idFacture` = `lot`.`idFacture`)) ORDER BY `lot`.`idLot` ASC  ;

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
  MODIFY `idAcheteur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `administrateur_vente`
--
ALTER TABLE `administrateur_vente`
  MODIFY `idAdmin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `directeur_vente`
--
ALTER TABLE `directeur_vente`
  MODIFY `idDirecteur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
