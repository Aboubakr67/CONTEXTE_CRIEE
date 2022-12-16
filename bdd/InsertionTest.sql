<<<<<<< HEAD


INSERT INTO `administrateur_vente` (`login`, `pwd`) VALUES ('laurent', '1234');

INSERT INTO `facture` () VALUES ();

INSERT INTO `qualite` (`idQualite`, `nomQualite`) VALUES ('1', 'qualite1'), ('2', 'qualite2');

INSERT INTO `taille` (`idTaille`, `specification`) VALUES ('1', 'Grande taille');

INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`, `nomEspece`) VALUES ('1', 'Baleine Bleue', 'Baleine', 'BalB');

INSERT INTO `bateau` (`nomBateau`) VALUES ('Aviso');


INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES ('1', '2022-11-18 19:45:22');

INSERT INTO `directeur_vente` (`nomDirecteur`, `login`, `pwd`) VALUES ('Paul', 'Marc', '1234');

INSERT INTO `presentation` (`idPresentation`, `libellePr`) VALUES ('1', 'Presentation1');

INSERT INTO `bac` (`idBac`, `tare`) VALUES ('1', 'Tare1');

INSERT INTO `acheteur` (`login`, `pwd`, `raisonSocialeEntreprise`, `numRueAcheteur`, `nomRueAcheteur`, `codePostal`, `ville`, `numHabilitation`) VALUES ('eric', '1234', 'SAPMER', '6', 'Rue de la peche', '30350', 'Le Gardon', 'Aucun');

INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`) VALUES ('1', '1', '2022-11-18 19:45:22', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1400', '650', '800', '1100', '2022-11-18 19:52:17', '2022-11-18 21:52:17', 'A');

INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`) VALUES ('2', '1', '2022-11-18 19:45:22', '1', '1', '1', '1', '2', '1', '1', '1', '1', '900', '850', '900', '1050', '2022-11-19 19:52:17', '2022-11-19 21:52:17', 'A');

INSERT INTO `historique` (`dateEnchere`) VALUES ('2022-11-18 19:53:52');

INSERT INTO `historique` (`dateEnchere`) VALUES ('2022-11-18 19:57:49');

INSERT INTO `encherir` (`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES ('1', '1', '2022-11-18 19:45:22', '2022-11-18 19:53:52', '1', '1200');

INSERT INTO `encherir` (`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES ('1', '1', '2022-11-18 19:45:22', '2022-11-18 19:57:49', '1', '1300');

=======
INSERT INTO `taille` (`idTaille`, `specification`) VALUES ('1', 'Grand taille');


INSERT INTO `bac` (`idBac`, `tare`) VALUES ('1', '6');

INSERT INTO `bateau` (`idBateau`) VALUES ('1');

INSERT INTO `espece` (`idEspece`) VALUES ('1');

INSERT INTO `qualite` (`idQualite`) VALUES ('1');

INSERT INTO `presentation` (`idPresentation`) VALUES ('1');


INSERT INTO `acheteur` (`idAcheteur`, `login`, `pwd`, `raisonSocialeEntreprise`, `adresse`, `ville`, `codePostal`, `numHabilitation`) VALUES ('1', 'ac1', 'jhjh765', 'AQUALANDE', '5 Rue des poissons', 'Cohade', '43000', 'CP67612876');


INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES ('1', '2022-10-14 10:38:17');


INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`, `idFacture`) VALUES ('1', '1', '2022-10-14 10:38:17', '1', '1', '1', '1', '1', '1', '3123', '1231231', '123213123', '123123131221', '2022-10-17 10:50:04', '2022-10-18 10:50:04', '123DS', '128');


INSERT INTO `poster` (`idAcheteur`, `idBateau`, `datePeche`, `idLot`, `prixEnchere`, `heureEnchere`) VALUES ('1', '1', '2022-10-14 10:38:17', '1', '42421', '2022-10-17 10:50:55');
>>>>>>> 4fa700f37353cbb8499ac3a9d9cefd3f50dea0d8
