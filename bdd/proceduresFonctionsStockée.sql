
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
CREATE procedure insertAcheteur(loginAch VARCHAR(30), pwdAch VARCHAR(30), raisonSocialeEntrepriseAch VARCHAR(50), numRueAcheteurAch VARCHAR(50), nomRueAcheteurAch VARCHAR(50), codePostalAch VARCHAR(7), villeAch VARCHAR(50), numHabilitationAch VARCHAR(50))
BEGIN
    INSERT INTO `acheteur` (`login`, `pwd`, `raisonSocialeEntreprise`, `numRueAcheteur`, `nomRueAcheteur`, `codePostal`, `ville`, `numHabilitation`) VALUES (loginAch, pwdAch, raisonSocialeEntrepriseAch, numRueAcheteurAch, nomRueAcheteurAch, codePostalAch, villeAch, numHabilitationAch);

END $$
DELIMITER ;
-- call insertAcheteur('axel6GU', '1234', 'Poissonnier', '13', 'Rue du poisson', '54350', 'Le Kopa', 'Aucun')







