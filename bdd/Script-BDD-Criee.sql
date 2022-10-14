DROP DATABASE IF EXISTS BddCriee ;

CREATE DATABASE BddCriee ;

USE BddCriee ;

CREATE TABLE TAILLE(
   idTaille INT(10) PRIMARY KEY,
   specification VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE BAC(
   idBac INT(10) PRIMARY KEY,
   tare VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE BATEAU(
   idBateau INT(10) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE ESPECE(
   idEspece INT(10) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE QUALITE(
   idQualite INT(10) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE PRESENTATION(
   idPresentation VARCHAR(50) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE ACHETEUR(
   idAcheteur INT(10) PRIMARY KEY,
   login VARCHAR(50),
   pwd VARCHAR(50),
   raisonSocialeEntreprise VARCHAR(50),
   adresse VARCHAR(50),
   ville VARCHAR(50),
   codePostal VARCHAR(7),
   numHabilitation VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE PECHE(
   idBateau INT(10),
   datePeche DATETIME,
   PRIMARY KEY(idBateau, datePeche),
   FOREIGN KEY (idBateau) REFERENCES BATEAU(idBateau)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LOT(
   idLot INT(10),
   idBateau INT(10),
   datePeche DATETIME,
   idEspece INT(10),
   idTaille INT(10),
   idPresentation VARCHAR(50),
   idBac INT(10),
   idAcheteur INT(10),
   idQualite INT(10),
   poidsBrutLot VARCHAR(50),
   prixPlancher VARCHAR(50),
   prixDepart VARCHAR(50),
   prixEnchereMax VARCHAR(50),
   dateEnchere DATETIME,
   heureDebutEnchere DATETIME,
   codeEtat VARCHAR(10),
   idFacture INT(10),
   PRIMARY KEY(idBateau, datePeche, idLot),
   FOREIGN KEY(idQualite) REFERENCES QUALITE(idQualite),
   FOREIGN KEY(idTaille) REFERENCES TAILLE(idTaille),
   FOREIGN KEY(idEspece) REFERENCES ESPECE(idEspece),
   FOREIGN KEY(idBateau, datePeche) REFERENCES PECHE(idBateau, datePeche),
   FOREIGN KEY(idBac) REFERENCES BAC(idBac),
   FOREIGN KEY(idAcheteur) REFERENCES ACHETEUR(idAcheteur),
   FOREIGN KEY(idPresentation) REFERENCES PRESENTATION(idPresentation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE POSTER(
   idAcheteur INT(10),
   idBateau INT(10),
   datePeche DATETIME,
   idLot INT(10),
   prixEnchere VARCHAR(50),
   heureEnchere DATETIME,
   PRIMARY KEY(idBateau, datePeche, idLot, idAcheteur),
   FOREIGN KEY(idBateau, datePeche, idLot) REFERENCES LOT(idBateau, datePeche, idLot),
   FOREIGN KEY(idAcheteur) REFERENCES ACHETEUR(idAcheteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
