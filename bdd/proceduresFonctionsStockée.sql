
------------------ ?  TOUTES LES PROCEDURES DE LA CRIEE --------------

-- Procédure affiche tous les lots
DROP procedure IF EXISTS affLot;
DELIMITER $$
CREATE procedure affLot()
BEGIN
    SELECT * from LOT;
    
END $$
DELIMITER ;

-- call affLot


-- Procédure recupNumAcheteur permet de recuperer le numero de l'acheteur
DROP procedure IF EXISTS recupNumAcheteur;
DELIMITER $$
CREATE procedure recupNumAcheteur(loginAch VARCHAR(30), pwdAch VARCHAR(30))
BEGIN
    SELECT idAcheteur FROM ACHETEUR WHERE login = loginAch 
    AND pwd = pwdAch;
    
END $$
DELIMITER ;

-- call recupNumAcheteur("Eric", "1234");


-- Procédure insertAcheteur permet d'inserer l'acheteur dans la BDD
DROP procedure IF EXISTS insertAcheteur;
DELIMITER $$
CREATE procedure insertAcheteur(mailAch VARCHAR(50),loginAch VARCHAR(30), pwdAch VARCHAR(30), raisonSocialeEntrepriseAch VARCHAR(50), numRueAcheteurAch VARCHAR(50), nomRueAcheteurAch VARCHAR(50), codePostalAch VARCHAR(7), villeAch VARCHAR(50), numHabilitationAch VARCHAR(50))
BEGIN
    INSERT INTO `acheteur` (`mailAcheteur`,`login`, `pwd`, `raisonSocialeEntreprise`, `numRueAcheteur`, `nomRueAcheteur`, `codePostal`, `ville`, `numHabilitation`) VALUES (mailAch, loginAch, pwdAch, raisonSocialeEntrepriseAch, numRueAcheteurAch, nomRueAcheteurAch, codePostalAch, villeAch, numHabilitationAch);

END $$
DELIMITER ;
-- call insertAcheteur('test@test.com','axel6GU', '1234', 'Poissonnier', '13', 'Rue du poisson', '54350', 'Le Kopa', 'Aucun')




-- Procédure verifConnectionAcheteur permet de verifier que l'acheteur est deja incrit
DROP procedure IF EXISTS verifConnectionAcheteur;
DELIMITER $$
CREATE procedure verifConnectionAcheteur(mailAch VARCHAR(50), pwdAch VARCHAR(255))
BEGIN
    SELECT COUNT(*) FROM acheteur WHERE mailAcheteur = mailAch AND
    pwd = pwdAch;

END $$
DELIMITER ;
-- CALL `verifConnectionAcheteur`('eric@gmail.com', '1234');





-- Procédure verifConnectionAdmin permet de verifier que l'acheteur est deja incrit
DROP procedure IF EXISTS verifConnectionAdmin;
DELIMITER $$
CREATE procedure verifConnectionAdmin(mailAd VARCHAR(50), pwdAd VARCHAR(255))
BEGIN
    SELECT COUNT(*) FROM administrateur_vente WHERE mailAdmin = mailAd AND
    pwd = pwdAd;

END $$
DELIMITER ;
-- CALL `verifConnectionAdmin`('laurent@gmail.com', '1234');





-- Procédure verifConnectionDirecteurVente permet de verifier que l'acheteur est deja incrit
DROP procedure IF EXISTS verifConnectionDirecteurVente;
DELIMITER $$
CREATE procedure verifConnectionDirecteurVente(mailD VARCHAR(50), pwdD VARCHAR(255))
BEGIN
    SELECT COUNT(*) FROM directeur_vente WHERE mailDirecteur = mailD AND
    pwd = pwdD;

END $$
DELIMITER ;
-- CALL `verifConnectionDirecteurVente`('paul.marc@gmail.com', '1234lang');


-- Procédure verifExistMail permet de verifier si le mail existe deja
DROP procedure IF EXISTS verifExistMail;
DELIMITER $$
CREATE procedure verifExistMail(mailD VARCHAR(255))
BEGIN
    SELECT COUNT(*) as verifMail FROM acheteur WHERE mailAcheteur = mailD;

END $$
DELIMITER ;
-- CALL `verifExistMail`('eric@gmail.com');


-- Procédure affEspece tout les noms des especes
DROP procedure IF EXISTS affEspece;
DELIMITER $$
CREATE procedure affEspece()
BEGIN
    SELECT idEspece, nomEspece from espece;
    
END $$
DELIMITER ;

-- call affEspece

DROP procedure IF EXISTS affInfoEspece;
DELIMITER $$
CREATE procedure affInfoEspece(esp int)
BEGIN
    SELECT nomCommunEspece, nomScientifiqueEspece FROM espece WHERE idEspece = esp;

END $$
DELIMITER ;
-- call affInfoEspece(1);


-- Procédure affTaille tout les noms des especes
DROP procedure IF EXISTS affTaille;
DELIMITER $$
CREATE procedure affTaille()
BEGIN
    SELECT specification from taille;
END $$
DELIMITER ;

-- call affTaille





-- Procédure affTare
DROP procedure IF EXISTS affTare;
DELIMITER $$
CREATE procedure affTare()
BEGIN
    SELECT idBac, tare FROM bac;
END $$
DELIMITER ;

-- call affTare


-- Procédure affQualite
DROP procedure IF EXISTS affQualite;
DELIMITER $$
CREATE procedure affQualite()
BEGIN
    select idQualite, codeQualite from qualite;
END $$
DELIMITER ;

-- call affQualite


-- Procédure affPresentation
DROP procedure IF EXISTS affPresentation;
DELIMITER $$
CREATE procedure affPresentation()
BEGIN
    select * from presentation;
END $$
DELIMITER ;

-- call affPresentation








-- Procédure affBateau
DROP procedure IF EXISTS affBateau;
DELIMITER $$
CREATE procedure affBateau()
BEGIN
    select * from bateau;
END $$
DELIMITER ;

-- call affBateau



-- Procédure insertLot permet d'inserer le lot dans la BDD
DROP procedure IF EXISTS insertLot;
DELIMITER $$
CREATE procedure insertLot(idLot INT(10),idBateau INT(10), datePeche DATETIME, idEspece INT(10), idTaille INT(10), idPresentation INT(50), idBac INT(10), idQualite INT(10), idAdmin INT(10), idDirecteur INT(10), poidsBrutLot VARCHAR(50), prixPlancher VARCHAR(50), prixDepart VARCHAR(50), prixEnchereMax VARCHAR(50), dateEnchereP DATE, codeEtat VARCHAR(10))
BEGIN
    INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idQualite`, `idAdmin`, `idDirecteur`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `codeEtat`) VALUES
(idLot, idBateau, datePeche, idEspece, idTaille, idPresentation, idBac, idQualite, idAdmin, idDirecteur, poidsBrutLot, prixPlancher, prixDepart, prixEnchereMax, dateEnchereP, codeEtat);

END $$
DELIMITER ;


-- Procédure insertPeche permet d'inserer la date de peche dans la BDD
DROP procedure IF EXISTS insertDatePeche;
DELIMITER $$
CREATE procedure insertDatePeche(idBateau INT(10), datePeche DATETIME)
BEGIN
    INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES (idBateau, datePeche);
END $$
DELIMITER ;


-- Procédure insertHistoriqueEnchere une enchere dans la table encherir et historique
DROP procedure IF EXISTS insertHistoriqueEnchere;
DELIMITER $$
CREATE procedure insertHistoriqueEnchere(idLot INT(10), idBateau INT(10), datePeche DATETIME, idAcheteur INT(10), prixEnchere VARCHAR(10))
BEGIN
    INSERT INTO `historique`(`dateEnchere`) VALUES (NOW());
    INSERT INTO `encherir`(`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES (idLot, idBateau, datePeche, NOW() , idAcheteur,prixEnchere);
END $$
DELIMITER ;

-- CALL insertHistoriqueEnchere(9, 8, '2023-04-11 17:55:10', 2, '1456');
-- DELETE FROM encherir WHERE idLot = 9 AND idBateau = 8 AND datePeche = '2023-04-11 17:55:10' AND dateEnchere = '2023-04-14 09:39:53';
-- DELETE FROM historique WHERE dateEnchere = '2023-04-14 09:39:53';





-- call insertAcheteur('test@test.com','axel6GU', '1234', 'Poissonnier', '13', 'Rue du poisson', '54350', 'Le Kopa', 'Aucun')


-- Procédure affMaxLot
DROP procedure IF EXISTS affMaxLot;
DELIMITER $$
CREATE procedure affMaxLot()
BEGIN
    SELECT MAX(idLot) FROM lot;
END $$
DELIMITER ;

-- call affMaxLot


DROP procedure IF EXISTS insertPeche;
DELIMITER $$
CREATE procedure insertPeche(idBat INT, dateP DATETIME)
BEGIN
    INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES (idBat, dateP);
END $$
DELIMITER ;


-- Procédure affToutLesAcheteurs
DROP procedure IF EXISTS affToutLesAcheteurs;
DELIMITER $$
CREATE procedure affToutLesAcheteurs()
BEGIN
    SELECT idAcheteur, login, raisonSocialeEntreprise, numRueAcheteur, nomRueAcheteur, codePostal, ville, numHabilitation FROM acheteur;
END $$
DELIMITER ;



-- Procédure modifieLot pour l'Admin
DROP PROCEDURE IF EXISTS modifieLot;
DELIMITER $$
CREATE PROCEDURE modifieLot(IN p_idLot INT, IN p_idEspece INT, IN p_idTaille INT, IN p_idPresentation VARCHAR(50), IN p_idBac INT, IN p_idAcheteur INT, IN p_idQualite INT, IN p_poidsBrutLot VARCHAR(50), IN p_prixPlancher VARCHAR(50), IN p_prixDepart VARCHAR(50), IN p_prixEnchereMax VARCHAR(50), IN p_dateEnchere DATE, IN p_codeEtat VARCHAR(10))
BEGIN
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
DELIMITER ;


-- Procédure affToutLesBac
DROP procedure IF EXISTS affToutLesBac;
DELIMITER $$
CREATE procedure affToutLesBac()
BEGIN
    SELECT * FROM `bac`;
END $$
DELIMITER ;


-- Procédure recupLoginAdmin
DROP procedure IF EXISTS recupLoginAdmin;
DELIMITER $$
CREATE procedure recupLoginAdmin(id INT(10))
BEGIN
    SELECT login from administrateur_vente where idAdmin = id;
END $$
DELIMITER ;


-- Procédure createFacture
DROP procedure IF EXISTS createFacture;
DELIMITER $$
CREATE procedure createFacture()
BEGIN
    INSERT INTO facture VALUES ();
END $$
DELIMITER ;

-- Initialiser autoincrement à 1 : ALTER TABLE facture AUTO_INCREMENT = 1;

-- Procédure recuperFactureCreate permet de recuperer la derniere idFacture créer
DROP procedure IF EXISTS recuperFactureCreate;
DELIMITER $$
CREATE procedure recuperFactureCreate()
BEGIN
    SELECT MAX(idFacture) as idFacture FROM facture;
END $$
DELIMITER ;


-- Procédure finEnchereLot permet de mettre fin à l'enchere
DROP procedure IF EXISTS finEnchereLot;
DELIMITER $$
CREATE procedure finEnchereLot(p_idLot INT(10), p_idBateau INT(10), p_datePeche DATETIME, p_idAcheteur INT(10), p_idFacture INT(10), p_codeEtat VARCHAR(5))
BEGIN
    UPDATE `lot` SET `idAcheteur`= p_idAcheteur,`idFacture`= p_idFacture,`codeEtat`= p_codeEtat WHERE `idLot`= p_idLot AND `idBateau`= p_idBateau AND `datePeche`= p_datePeche;
END $$
DELIMITER ;

-- UPDATE `lot` SET `idAcheteur`= null,`idFacture`= null,`codeEtat`= 'G' WHERE `idLot`= 1 AND `idBateau`= 1 AND `datePeche`= '2022-11-18 19:45:22';

-- precedent
SELECT DISTINCT L.idLot, ES.nomEspece, T.specification, L.poidsBrutLot, E.prixEnchere, A.login
	FROM LOT L 
	INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece 
	INNER JOIN TAILLE T ON L.idTaille = T.idTaille 
	INNER JOIN ENCHERIR E ON L.idLot = E.idLot 
	INNER JOIN ACHETEUR A ON E.idAcheteur = A.idAcheteur 
	INNER JOIN HISTORIQUE H ON E.dateEnchere = H.dateEnchere
	WHERE L.codeEtat = "C"
	ORDER BY L.dateEnchere DESC, L.heureDebutEnchere DESC LIMIT 2;



SELECT DISTINCT L.idLot, L.idBateau, L.datePeche, ES.nomEspece, T.specification, P.libellePr, Q.nomQualite, (L.poidsBrutLot - BAC.tare) , B.nomBateau FROM LOT L 
INNER JOIN ESPECE ES ON L.idEspece = ES.idEspece 
INNER JOIN TAILLE T ON L.idTaille = T.idTaille 
INNER JOIN PRESENTATION P ON L.idPresentation = P.idPresentation 
INNER JOIN QUALITE Q ON L.idQualite = Q.idQualite 
INNER JOIN BAC ON L.idBac = BAC.idBac 
INNER JOIN BATEAU B ON L.idBateau = B.idBateau 
WHERE L.codeEtat = "A" 
AND DATE(L.dateEnchere) = CURDATE() 
AND TIME(L.heureDebutEnchere) 
ORDER BY L.heureDebutEnchere ASC LIMIT 2;




-- Procédure affToutLesLotsAjd
DROP procedure IF EXISTS affToutLesLotsAjd;
DELIMITER $$
CREATE procedure affToutLesLotsAjd()
BEGIN
    SELECT DISTINCT L.idLot, ES.nomCommunEspece, L.poidsBrutLot, T.specification, MAX(E.prixEnchere) as prixEnchere, A.login, L.heureDebutEnchere, L.codeEtat
    FROM LOT L 
    INNER JOIN espece es ON L.idEspece = ES.idEspece 
    INNER JOIN TAILLE T ON L.idTaille = T.idTaille 
    LEFT OUTER JOIN ENCHERIR E ON L.idLot = E.idLot 
    LEFT OUTER JOIN ACHETEUR A ON E.idAcheteur = A.idAcheteur 
    WHERE L.dateEnchere = CURDATE() 
    GROUP BY L.idLot, ES.nomCommunEspece, L.poidsBrutLot, T.specification, A.login 
    ORDER BY L.idLot ASC;
END $$
DELIMITER ;