INSERT INTO `administrateur_vente` (`idAdmin`, `login`, `pwd`) VALUES ('1', 'laurent', '1234');
INSERT INTO `facture` (`idFacture`) VALUES ('1');
INSERT INTO `qualite` (`idQualite`, `nomQualite`) VALUES ('1', 'qualite1'), ('2', 'qualite2');
INSERT INTO `taille` (`idTaille`, `specification`) VALUES ('1', 'Grande taille');
INSERT INTO `espece` (`idEspece`, `nomScientifiqueEspece`, `nomCommunEspece`) VALUES ('1', 'Baleine Bleue', 'Baleine');
INSERT INTO `bateau` (`idBateau`, `nomBateau`) VALUES ('1', 'Aviso');
INSERT INTO `peche` (`idBateau`, `datePeche`) VALUES ('1', '2022-11-18 19:45:22');
INSERT INTO `directeur_vente` (`idDirecteur`, `nomDirecteur`) VALUES ('1', 'Paul');
INSERT INTO `presentation` (`idPresentation`, `libellePr`) VALUES ('1', 'Presentation1');
INSERT INTO `bac` (`idBac`, `tare`) VALUES ('1', 'Tare1');
INSERT INTO `acheteur` (`idAcheteur`, `login`, `pwd`, `raisonSocialeEntreprise`, `adresse`, `ville`, `codePostal`, `numHabilitation`) VALUES ('1', 'eric', '1234', 'SAPMER', '6 Rue de la peche', 'Le Gardon', '30350', 'Aucun');
INSERT INTO `lot` (`idLot`, `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`) VALUES ('1', '1', '2022-11-18 19:45:22', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1400', '650', '800', '1100', '2022-11-18 19:52:17', '2022-11-18 21:52:17', 'A');
INSERT INTO `historique` (`dateEnchere`) VALUES ('2022-11-18 19:53:52');
INSERT INTO `historique` (`dateEnchere`) VALUES ('2022-11-18 19:57:49');
INSERT INTO `encherir` (`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES ('1', '1', '2022-11-18 19:45:22', '2022-11-18 19:53:52', '1', '1200');
INSERT INTO `encherir` (`idLot`, `idBateau`, `datePeche`, `dateEnchere`, `idAcheteur`, `prixEnchere`) VALUES ('1', '1', '2022-11-18 19:45:22', '2022-11-18 19:57:49', '1', '1300');

