-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 juil. 2024 à 10:25
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gest_assurance`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

DROP TABLE IF EXISTS `agence`;
CREATE TABLE IF NOT EXISTS `agence` (
  `ID_Agence` int NOT NULL AUTO_INCREMENT,
  `Nom_Agence` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Adresse_Agence` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Ville_Agence` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Agence`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`ID_Agence`, `Nom_Agence`, `Adresse_Agence`, `Ville_Agence`) VALUES
(1, 'Wimax', 'Wimax11@gmail.com', 'Bouaké'),
(2, 'Upci', 'Upci23@gmail.com', 'Abidjan'),
(3, 'Youi', 'youi2@gmail.com', 'Bouaké'),
(4, 'remix', 'remix@gmail.com', 'Sassandra'),
(5, 'sidick', 'abou@gmail.com', 'Oumé'),
(6, 'sidick', 'sidick10@gmail.com', 'Bouaké'),
(8, 'nicolo', 'nicolo23@gmail.com', 'Sassandra'),
(9, 'toure', 'toure9@gmail.com', 'Oumé'),
(11, 'traore', 'traore2310@gmail.com', 'Bouaké'),
(12, 'traore', 'Aicha@gmail.com', 'Abidjan'),
(13, 'traore', 'Aicha@gmail.com', 'Abidjan'),
(14, 'traore', 'Aicha@gmail.com', 'Abidjan'),
(15, 'traore', 'Aicha@gmail.com', 'Abidjan'),
(16, 'traore', 'Aicha@gmail.com', 'Abidjan'),
(18, 'traore', 'Aicha@gmail.com', 'Abidjan'),
(19, 'traore', 'Aicha@gmail.com', 'Abidjan');

-- --------------------------------------------------------

--
-- Structure de la table `assurerprincipal`
--

DROP TABLE IF EXISTS `assurerprincipal`;
CREATE TABLE IF NOT EXISTS `assurerprincipal` (
  `ID_AssurerPrincipal` int NOT NULL AUTO_INCREMENT,
  `Nom_AssurerPrincipal` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Prenom_AssurerPrincipal` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email_AssurerPrincipal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Telephone_AssurerPrincipal` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DateNaissance_AssurerPrincipal` date DEFAULT NULL,
  `Sexe_AssurerPrincipal` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DateSouscription_AssurerPrincipal` date DEFAULT NULL,
  `Fonction_AssurerPrincipal` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Photo_AssurerPrincipal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ID_Agence` int DEFAULT NULL,
  PRIMARY KEY (`ID_AssurerPrincipal`),
  KEY `FK_AssurerPrincipal_ID_Agence` (`ID_Agence`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assurerprincipal`
--

INSERT INTO `assurerprincipal` (`ID_AssurerPrincipal`, `Nom_AssurerPrincipal`, `Prenom_AssurerPrincipal`, `Email_AssurerPrincipal`, `Telephone_AssurerPrincipal`, `DateNaissance_AssurerPrincipal`, `Sexe_AssurerPrincipal`, `DateSouscription_AssurerPrincipal`, `Fonction_AssurerPrincipal`, `Photo_AssurerPrincipal`, `ID_Agence`) VALUES
(2, 'Lida', 'Tetia', 'Tetia2Lida1@gmail.com', '0587543595', '2004-12-10', 'F', '2024-03-01', 'Medecin', 'assurerman.png', 3),
(4, 'Traore', 'sidick', 'abou210trao@gmail.co', '0799128759', '2024-07-16', 'M', '2024-07-01', 'Informaticien', 'assurergirl.png', 4),
(5, 'Messi', 'Leo', 'abou210trao@gmail.co', '0799128759', '0000-00-00', 'M', '2024-07-02', 'footballeur', 'FB_IMG_1706478174810.jpg', 5),
(9, 'M\'GBRA', 'Yao', 'davy@gmail.com', '0777527611', '2000-08-02', 'F', '2024-07-09', 'developpeur', 'IMG-20240229-WA0089.jpg', 9),
(11, 'Diomandé', 'Axel Latif', 'nico@gmail.com', '097876545', '2010-05-03', 'F', '2024-07-09', 'sddjdhbdhb', 'IMG-20240301-WA0049.jpg', 12),
(13, 'dzdzdzddd', 'fefededed', 'DEERERE@GMAIL.com', '345655454', '0000-00-00', 'M', '0000-00-00', 'dgfrgfgggtg', 'FB_IMG_1706478174810.jpg', 2),
(16, 'celio', 'namory', 'celio@gmail.com', '0777527611', '2024-07-09', 'M', '2024-07-16', 'proffesseur', 'IMG-20240301-WA0037.jpg', 16),
(17, 'traore', 'Axel Latif', 'nico@gmail.com', '0983364746', '0000-00-00', 'F', '2024-07-01', 'developpeur', 'boy.png', 1),
(18, 'fadi', 'Axel Latif', 'celio@gmail.com', '097876545', '2024-07-26', 'M', '2024-07-10', 'proffesseur', 'boy.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaire`
--

DROP TABLE IF EXISTS `beneficiaire`;
CREATE TABLE IF NOT EXISTS `beneficiaire` (
  `ID_Beneficiaire` int NOT NULL AUTO_INCREMENT,
  `Nom_Beneficiaire` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Prenom_Beneficiaire` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DateNaissance_Beneficiaire` date DEFAULT NULL,
  `Sexe_Beneficiaire` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Photo_Beneficiaire` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ID_AssurerPrincipal` int DEFAULT NULL,
  PRIMARY KEY (`ID_Beneficiaire`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `beneficiaire`
--

INSERT INTO `beneficiaire` (`ID_Beneficiaire`, `Nom_Beneficiaire`, `Prenom_Beneficiaire`, `DateNaissance_Beneficiaire`, `Sexe_Beneficiaire`, `Photo_Beneficiaire`, `ID_AssurerPrincipal`) VALUES
(1, 'sidick', 'rocki', '2001-07-22', 'F', 'assurerboy.png', 9),
(2, 'soro', 'samuel', '2003-09-08', 'F', 'IMG-20240301-WA0069.jpg', 2),
(3, 'soro', 'samuel', '2024-07-09', 'F', 'girl.png', 5),
(4, 'sidick', 'samuel', '2024-07-11', 'F', 'IMG-20240301-WA0069.jpg', 2),
(5, 'toure', 'fatim', '2024-07-24', 'F', 'man.png', 18),
(6, 'sidibe', 'djamila', '2024-07-02', 'F', '382993.png', 16),
(10, 'sidibe', 'traore', '2024-07-02', 'F', 'boy.png', 11);

-- --------------------------------------------------------

--
-- Structure de la table `cente_sante`
--

DROP TABLE IF EXISTS `cente_sante`;
CREATE TABLE IF NOT EXISTS `cente_sante` (
  `ID_Cente_Sante` int NOT NULL AUTO_INCREMENT,
  `Nom_Cente_Sante` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Addrees_Cente_Sante` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Ville_Cente_Sante` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Cente_Sante`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cente_sante`
--

INSERT INTO `cente_sante` (`ID_Cente_Sante`, `Nom_Cente_Sante`, `Addrees_Cente_Sante`, `Ville_Cente_Sante`) VALUES
(1, 'andokoi', 'andokoi@gmail.com', 'Bouaké'),
(2, 'andokoi', 'andokoi@gmail.com', 'Sassandra'),
(3, 'wassakara', 'wassakara@gmail.com', 'Abidjan');

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `ID_Consultation` int NOT NULL AUTO_INCREMENT,
  `frai_Consultation` decimal(10,2) NOT NULL,
  `Date_Consultation` date DEFAULT NULL,
  `ID_Medecin` int DEFAULT NULL,
  `ID_Beneficiaire` int DEFAULT NULL,
  PRIMARY KEY (`ID_Consultation`),
  KEY `FK1_Consultation_ID_Beneficiaire` (`ID_Beneficiaire`),
  KEY `FK2_Consultation_ID_Medecin` (`ID_Medecin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consultation`
--

INSERT INTO `consultation` (`ID_Consultation`, `frai_Consultation`, `Date_Consultation`, `ID_Medecin`, `ID_Beneficiaire`) VALUES
(1, 120000.00, '2024-07-11', 21, 1),
(2, 14000.00, '2024-07-18', 19, 5),
(3, 15000.00, '2024-07-11', 20, 6),
(4, 10000.00, '2024-07-10', 18, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `Code_Contrat` int NOT NULL AUTO_INCREMENT,
  `Date_signature_Contrat` date DEFAULT NULL,
  `DateDebut_Contrat` date DEFAULT NULL,
  `DateFin_Contrat` date DEFAULT NULL,
  `medecin_id_medecin` int DEFAULT NULL,
  `ID_Cente_Sante` int NOT NULL,
  PRIMARY KEY (`Code_Contrat`),
  KEY `FK_Contrat_medecin_id_medecin` (`medecin_id_medecin`),
  KEY `ID_Cente_Sante` (`ID_Cente_Sante`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`Code_Contrat`, `Date_signature_Contrat`, `DateDebut_Contrat`, `DateFin_Contrat`, `medecin_id_medecin`, `ID_Cente_Sante`) VALUES
(1, '2024-07-21', '2024-08-03', '2024-08-09', 23, 3),
(2, '2024-07-26', '2024-07-28', '2024-07-31', 18, 1),
(3, '2024-07-24', '2024-07-24', '2024-07-24', 18, 1),
(4, '2024-07-26', '2024-08-02', '2024-08-10', 18, 3);

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `ID_Agence` int NOT NULL AUTO_INCREMENT,
  `Code_Contract` int NOT NULL,
  PRIMARY KEY (`ID_Agence`,`Code_Contract`),
  KEY `FK_Gerer_Code_Contrat` (`Code_Contract`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `ID_Medecin` int NOT NULL AUTO_INCREMENT,
  `Nom_Medecin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Prenom_Medecin` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Specialite_Medecin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Adresse_Medecin` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ID_Cente_Sante` int DEFAULT NULL,
  PRIMARY KEY (`ID_Medecin`),
  KEY `FK_Medecin_ID_Cente_Sante` (`ID_Cente_Sante`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`ID_Medecin`, `Nom_Medecin`, `Prenom_Medecin`, `Specialite_Medecin`, `Adresse_Medecin`, `ID_Cente_Sante`) VALUES
(18, 'Diomandé ', 'Axel Latif', 'Dentiste', 'diomande21@gmail.com', 2),
(19, 'Lobouhé', 'Angelo', 'Ophtamologue', 'Angelo@gmail.com', 3),
(20, 'Konaté', 'Fatim', 'Dentiste', 'wimax@gmail.com', 3),
(21, 'traoré', 'sidick', 'Churirgie', 'Abou210traore@gmail.com', 1),
(23, 'fadi', 'Angelo', 'Churirgie', 'trao@gmail.com', 1),
(24, 'Diomandé', 'Axel Latif', 'Churirgie', 'Angelo@gmail.com', 1),
(25, 'dgcdfdf', 'sidick', 'Churirgie', 'vvfvfvfvf@vcdhbh', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prescription_medical`
--

DROP TABLE IF EXISTS `prescription_medical`;
CREATE TABLE IF NOT EXISTS `prescription_medical` (
  `ID_Prescription` int NOT NULL AUTO_INCREMENT,
  `Medicament_Prescription` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Quantite_Prescription` int DEFAULT NULL,
  `Prix_Prescription_Medical` float DEFAULT NULL,
  `ID_Consultation` int DEFAULT NULL,
  PRIMARY KEY (`ID_Prescription`),
  KEY `FK_Prescription_Medical_ID_Consultation` (`ID_Consultation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `soins`
--

DROP TABLE IF EXISTS `soins`;
CREATE TABLE IF NOT EXISTS `soins` (
  `ID_Soins` int NOT NULL AUTO_INCREMENT,
  `Nature_Soins` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date_Soins` date DEFAULT NULL,
  `Montant_Soins` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Analyse_Soins` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ID_Medecin` int DEFAULT NULL,
  PRIMARY KEY (`ID_Soins`),
  KEY `FK_Soins_ID_Medecin` (`ID_Medecin`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `soins`
--

INSERT INTO `soins` (`ID_Soins`, `Nature_Soins`, `Date_Soins`, `Montant_Soins`, `Analyse_Soins`, `ID_Medecin`) VALUES
(26, 'remplacement de dent', '2024-07-06', '120000', 'Voir dentiste', 19),
(77, 'Consultation Générale', '2024-07-25', '12000', 'Examen de routine', 24),
(78, 'palu', '2024-07-24', '12000', 'dinde', 21);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_Utilisateur` int NOT NULL AUTO_INCREMENT,
  `Login_Utilisateur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Role_Utilisateur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email_Utilisateur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Etat_Utilisateur` int NOT NULL,
  `Mdp_Utilisateur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_Utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_Utilisateur`, `Login_Utilisateur`, `Role_Utilisateur`, `email_Utilisateur`, `Etat_Utilisateur`, `Mdp_Utilisateur`) VALUES
(10, 'admin', 'ADMIN', 'abou210traore@gmail.com', 1, '48f1fd593026907d9903ae11e9008856'),
(6, 'sidick', 'ADMIN', 'sidic12k@gmail.com', 1, '502e4a16930e414107ee22b6198c578f'),
(5, 'User', 'ADMIN', 'ab2123traore@gmail.com', 1, 'b7425036e94c120a5b78ee4810384a56'),
(11, 'admin', 'ADMIN', 'admin@gmail.com', 1, '202cb962ac59075b964b07152d234b70'),
(8, 'User2', 'VISITEUR', 'sidick12@gmail.com', 1, '17b3c7061788dbe82de5abe9f6fe22b3'),
(12, 'Issouf', 'ADMIN', 'Issouf@gmail.com', 1, '202cb962ac59075b964b07152d234b70'),
(13, 'luka', 'VISITEUR', 'luka@gmail.com', 0, '81dc9bdb52d04dc20036dbd8313ed055'),
(14, 'oumar', 'VISITEUR', 'oumar@gmail.com', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 'Lamté', 'VISITEUR', 'lamte@gmail.com', 0, '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assurerprincipal`
--
ALTER TABLE `assurerprincipal`
  ADD CONSTRAINT `FK_AssurerPrincipal_ID_Agence` FOREIGN KEY (`ID_Agence`) REFERENCES `agence` (`ID_Agence`);

--
-- Contraintes pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `FK1_Consultation_ID_Beneficiaire` FOREIGN KEY (`ID_Beneficiaire`) REFERENCES `beneficiaire` (`ID_Beneficiaire`),
  ADD CONSTRAINT `FK2_Consultation_ID_Medecin` FOREIGN KEY (`ID_Medecin`) REFERENCES `medecin` (`ID_Medecin`),
  ADD CONSTRAINT `FK_Consultation_ID_Beneficiaire` FOREIGN KEY (`ID_Beneficiaire`) REFERENCES `beneficiaire` (`ID_Beneficiaire`),
  ADD CONSTRAINT `FK_Consultation_ID_Medecin` FOREIGN KEY (`ID_Medecin`) REFERENCES `medecin` (`ID_Medecin`);

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat_ibfk_1` FOREIGN KEY (`ID_Cente_Sante`) REFERENCES `cente_sante` (`ID_Cente_Sante`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Contrat_medecin_id_medecin` FOREIGN KEY (`medecin_id_medecin`) REFERENCES `medecin` (`ID_Medecin`);

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `FK_Gerer_Code_Contrat` FOREIGN KEY (`Code_Contract`) REFERENCES `contrat` (`Code_Contrat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Gerer_ID_Agence` FOREIGN KEY (`ID_Agence`) REFERENCES `agence` (`ID_Agence`);

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `FK_Medecin_ID_Cente_Sante` FOREIGN KEY (`ID_Cente_Sante`) REFERENCES `cente_sante` (`ID_Cente_Sante`);

--
-- Contraintes pour la table `prescription_medical`
--
ALTER TABLE `prescription_medical`
  ADD CONSTRAINT `FK_Prescription_Medical_ID_Consultation` FOREIGN KEY (`ID_Consultation`) REFERENCES `consultation` (`ID_Consultation`);

--
-- Contraintes pour la table `soins`
--
ALTER TABLE `soins`
  ADD CONSTRAINT `FK_Soins_ID_Medecin` FOREIGN KEY (`ID_Medecin`) REFERENCES `medecin` (`ID_Medecin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
