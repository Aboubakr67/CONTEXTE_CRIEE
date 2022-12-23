
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


-- Procédure affTaille tout les noms des especes
DROP procedure IF EXISTS affTaille;
DELIMITER $$
CREATE procedure affTaille()
BEGIN
    SELECT idBac, tare from bac;
    
END $$
DELIMITER ;

-- call affTaille


DROP procedure IF EXISTS afficheInfoNomCommun;
DELIMITER $$
CREATE procedure afficheInfoNomCommun(esp int)
BEGIN
    SELECT nomCommunEspece, nomScientifiqueEspece FROM espece WHERE idEspece = esp;

END $$
DELIMITER ;
-- call afficheInfoNomCommun
