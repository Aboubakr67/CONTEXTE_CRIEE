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
