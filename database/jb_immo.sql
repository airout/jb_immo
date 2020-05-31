-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 24 mars 2020 à 10:50
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jb_immo`
--

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

DROP TABLE IF EXISTS `bien`;
CREATE TABLE IF NOT EXISTS `bien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propriete_dite_bien` varchar(20) NOT NULL,
  `numero` int(11) NOT NULL,
  `niveau` int(2) NOT NULL,
  `etat` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `orientation` varchar(10) NOT NULL,
  `conventionne` tinyint(4) NOT NULL DEFAULT 0,
  `immeuble_id` int(11) NOT NULL,
  `bloc_id` int(11) NOT NULL,
  `tranche_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `prix` float NOT NULL,
  `superficie` float NOT NULL,
  `titre_foncier` varchar(255) DEFAULT NULL,
  `avance_min` float NOT NULL DEFAULT 0,
  `commentaire` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`id`, `propriete_dite_bien`, `numero`, `niveau`, `etat`, `type`, `orientation`, `conventionne`, `immeuble_id`, `bloc_id`, `tranche_id`, `projet_id`, `prix`, `superficie`, `titre_foncier`, `avance_min`, `commentaire`, `created_at`, `updated_at`) VALUES
(1, '01', 1, 0, 'reserve', 'F4', 'O/S', 1, 7, 18, 4, 1, 0, 0, NULL, 0, '', '2020-03-03 14:57:46', '2020-03-03 14:57:46'),
(2, 'GH0101-02', 2, 2, 'disponible', 'F2', 'E', 1, 7, 18, 4, 1, 50000, 25, 'ffh bbn', 0, '', '2020-03-13 11:47:58', '2020-03-13 11:47:58');

-- --------------------------------------------------------

--
-- Structure de la table `bloc`
--

DROP TABLE IF EXISTS `bloc`;
CREATE TABLE IF NOT EXISTS `bloc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(6) NOT NULL,
  `tranche_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `titre_foncier` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bloc`
--

INSERT INTO `bloc` (`id`, `description`, `tranche_id`, `projet_id`, `titre_foncier`, `created_at`, `updated_at`) VALUES
(18, 'GH01', 4, 1, 'gh01t04jb', '2020-02-28 16:04:24', '2020-02-28 16:04:24'),
(8, 'GH02', 6, 1, 'gh02t06jb', '2020-02-26 20:01:47', '2020-02-26 20:01:47'),
(19, 'TF', 16, 13, 'lll', '2020-03-19 15:21:41', '2020-03-19 15:21:41');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone1` varchar(255) NOT NULL,
  `telephone2` varchar(255) DEFAULT NULL,
  `civilite` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `situation_pro` varchar(255) DEFAULT NULL,
  `societe_id` int(11) DEFAULT NULL,
  `cin` varchar(255) NOT NULL,
  `lieu_naissance` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `nationalite` varchar(255) DEFAULT NULL,
  `nom_responsable` varchar(255) DEFAULT NULL,
  `relation_familiale` varchar(255) DEFAULT NULL,
  `situation_familiale` varchar(255) DEFAULT NULL,
  `nom_mari` varchar(255) DEFAULT NULL,
  `date_mariage` date DEFAULT NULL,
  `lieu_mariage` varchar(255) DEFAULT NULL,
  `nom_pere` varchar(255) DEFAULT NULL,
  `nom_mere` varchar(255) DEFAULT NULL,
  `mode_financement` varchar(255) DEFAULT NULL,
  `banque` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `telephone1`, `telephone2`, `civilite`, `adresse`, `ville`, `pays`, `profession`, `situation_pro`, `societe_id`, `cin`, `lieu_naissance`, `date_naissance`, `age`, `nationalite`, `nom_responsable`, `relation_familiale`, `situation_familiale`, `nom_mari`, `date_mariage`, `lieu_mariage`, `nom_pere`, `nom_mere`, `mode_financement`, `banque`, `created_at`, `updated_at`) VALUES
(21, 'client8', 'client8', '555', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', NULL, '444', NULL, NULL, NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-19 19:53:17', '2020-03-19 19:53:17'),
(22, 'cien888', 'hhh', '5555', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', 1, 'd444', NULL, NULL, NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-19 19:55:10', '2020-03-19 19:55:10'),
(23, 'testage', 'jjjjjj', '6554555', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', 1, 'D744', NULL, '1995-05-03', NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 16:57:44', '2020-03-20 16:57:44'),
(24, 'AGE2', 'HHHH', '4444', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', NULL, 'D4444', NULL, '1995-05-03', 24, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 17:00:32', '2020-03-20 17:00:32'),
(25, 'AGE44', 'GHRISSI', '0641622329', NULL, NULL, '131 MENZEH 2 BOUFAKRANE MEKNES', 'MEKNES', NULL, NULL, 'particulier', NULL, 'D7777', NULL, '1994-05-03', 25, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, 'GHRISSI FADWA', 'GHRISSI FADWA', 'credit', NULL, '2020-03-20 17:02:18', '2020-03-20 17:02:18'),
(26, 'age88', 'GHRISSI', '0641622329', NULL, NULL, '131 MENZEH 2 BOUFAKRANE MEKNES', 'MEKNES', NULL, NULL, 'particulier', NULL, 'fff', NULL, '1992-05-03', 27, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, 'GHRISSI FADWA', 'GHRISSI FADWA', 'credit', NULL, '2020-03-20 17:04:47', '2020-03-20 17:04:47'),
(27, 'age77', 'hhhhh', '444', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', NULL, 'sssdd', NULL, '1997-05-03', NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 17:06:03', '2020-03-20 17:06:03'),
(28, 'clienttest offf', 'gggg', '444', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', NULL, 'fff', NULL, '1998-05-03', NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 18:46:35', '2020-03-20 18:46:35'),
(30, 'hhhhhhhhhhhhh', 'ffff', 'ffff', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', NULL, 'gggg', NULL, '2003-03-01', NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 21:58:33', '2020-03-20 21:58:33'),
(31, 'hahhhhhhhhmkgkg', 'kkkkk', '88888', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', NULL, 'd444', NULL, '2005-02-03', 15, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 22:01:49', '2020-03-20 22:01:49'),
(32, 'yes', 'fff', '555', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', 1, 'd748759', NULL, '1995-10-02', NULL, NULL, NULL, NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-20 22:10:10', '2020-03-23 09:56:56'),
(33, 'FDWA', 'HHH', '526356', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', 1, 'FGG', NULL, '2003-05-03', 16, NULL, 'GG', 'KK', 'celibataire', NULL, NULL, NULL, NULL, NULL, 'credit', NULL, '2020-03-20 22:12:38', '2020-03-20 22:12:38'),
(34, 'clienttout', 'ffff', '4444444', NULL, NULL, NULL, NULL, NULL, NULL, 'particulier', 3, 'd748562', NULL, '1995-05-03', 24, NULL, 'ccc', NULL, 'celibataire', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-23 13:44:37', '2020-03-23 13:45:42'),
(35, 'Asmaa', 'AIROUT', '0672715849', NULL, 'Mme', '65 rue ifriquia', 'casablanca', 'maroc', 'developpeur', 'societe', 1, 'bh299846', 'casa', '2005-10-20', 14, 'marocaine', 'ouai', 'mari', 'marié', 'ouai', '2016-07-21', 'casa', 'Mostafa', 'Zahra', 'credit', 'Attijari', '2020-03-23 19:32:10', '2020-03-23 20:40:31');

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--

DROP TABLE IF EXISTS `convention`;
CREATE TABLE IF NOT EXISTS `convention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `societe` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `convention`
--

INSERT INTO `convention` (`id`, `societe`, `created_at`, `updated_at`) VALUES
(1, 'socite1', '2020-03-19 18:49:58', '0000-00-00 00:00:00'),
(2, 'societe2', '2020-03-23 10:43:32', '2020-03-23 10:43:32'),
(3, 'socite3', '2020-03-23 10:43:32', '2020-03-23 10:43:32');

-- --------------------------------------------------------

--
-- Structure de la table `immeuble`
--

DROP TABLE IF EXISTS `immeuble`;
CREATE TABLE IF NOT EXISTS `immeuble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(11) NOT NULL,
  `bloc_id` int(11) NOT NULL,
  `tranche_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `titre_foncier` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `immeuble`
--

INSERT INTO `immeuble` (`id`, `description`, `bloc_id`, `tranche_id`, `projet_id`, `titre_foncier`, `created_at`, `updated_at`) VALUES
(7, 'IMM01', 18, 4, 1, 'imm01gh01t04jb', '2020-02-28 16:04:49', '2020-03-02 15:22:06'),
(8, 'IMM02', 18, 4, 1, 'imm02gh01t04jb', '2020-02-28 16:06:00', '2020-02-28 16:06:00'),
(9, 'IMM03', 18, 4, 1, 'imm03gh01t04jb', '2020-03-02 14:18:24', '2020-03-02 14:18:24'),
(11, 'IMM04', 18, 4, 1, 'imm04gh01t04jb', '2020-03-02 14:24:27', '2020-03-02 15:27:32');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_11_16_205658_create_admins_table', 1),
('2014_12_02_152920_create_password_reminders_table', 1),
('2015_02_20_130902_create_url_table', 1),
('2015_03_15_123956_edit_url_table', 1),
('2016_02_10_181651_create_roles_tables', 1),
('2014_10_12_000000_create_users_table', 2),
('2014_10_12_100000_create_password_resets_table', 2),
('2016_08_15_214343_create_Visiteur_table', 2),
('2016_08_17_145301_create_Appartement_estime_table', 2),
('2016_08_17_163021_create_Maison_estime_table', 2),
('2016_08_19_091233_create_Villa_estime_table', 2),
('2016_08_19_094441_create_Annonce_table', 2),
('2016_08_23_103421_create_Annonce_residentiel_table', 2),
('2016_08_23_134739_create_Vue_ext_table', 2),
('2017_04_10_105102_create_annonce_residentiel_user_table', 3),
('2018_05_20_160354_create_messages_table', 4),
('2018_05_23_125944_create_actualites_table', 5),
('2016_08_24_150105_create_Terrain_estime_table', 6),
('2018_07_13_142230_add_prenom_to_users', 7),
('2018_07_13_142247_add_telephone_to_users', 7),
('2019_02_17_150130_add_timestamp_to_annonce', 8),
('2019_02_17_192410_add_active_to_annonce', 8);

-- --------------------------------------------------------

--
-- Structure de la table `password_reminders`
--

DROP TABLE IF EXISTS `password_reminders`;
CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('marrad@hotmail.fr', '609848c2eafbe580b8537894a072e18e0fa9964ef357869411da5f40369d76c4', '2017-02-23 11:09:33'),
('safaeakbour@gmail.com', '71f7bdba1b438b50ee4f89db5e36952fe908471a0eb2953bf46c9a843701cf6f', '2018-05-27 01:08:08'),
('a.airout@gmail.com', '$2y$10$e93DS2wutRX0hM9wB03hSOD3aavkd2hswhLAY9UnccVF3Ib4ac3iS', '2020-02-17 18:39:19');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `date_autorisation_construction` date DEFAULT NULL,
  `date_permis_habiter` date DEFAULT NULL,
  `prolongation_reservation` int(11) NOT NULL,
  `limite_annulation_reservation` int(11) NOT NULL,
  `propriete_dite_projet` varchar(255) DEFAULT NULL,
  `titre_foncier` varchar(255) DEFAULT NULL,
  `surface_terrain` float NOT NULL DEFAULT 0,
  `montant_min` float DEFAULT 0,
  `nbre_jour_remboursement` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `code`, `type`, `adresse`, `date_autorisation_construction`, `date_permis_habiter`, `prolongation_reservation`, `limite_annulation_reservation`, `propriete_dite_projet`, `titre_foncier`, `surface_terrain`, `montant_min`, `nbre_jour_remboursement`, `created_at`, `updated_at`) VALUES
(1, 'Jaouharat Al Bahr', '1', 'social', 'commune de sidi bouknadel, route de kenitra', '2020-02-22', '2020-04-25', 5, 30, 'blade radi et philippe', '10489/20 ET 21135/R', 207920, 0, 60, '2020-02-20 15:12:57', '2020-02-20 21:09:41'),
(19, 'alpha', '775771', 'moyen_standing', '10, rue du Colisée', '2020-02-27', '2020-02-22', 3, 2, 'residence blabla', '12362', 263526, 500000, 4, '2020-02-21 15:05:18', '2020-02-21 15:05:18'),
(12, 'test', '775771', 'haut_standing', 'Résidence Les Portes de Rabat, Boulevard Gaza', '0000-00-00', '2020-03-22', 60, 5, NULL, NULL, 0, NULL, NULL, '2020-02-20 18:19:12', '2020-02-20 18:19:12'),
(13, 'asmaaa', '1', 'social', 'sss', '2020-02-28', '2020-02-12', 5, 60, 'dddd', '12512', 12305, 0, 20, '2020-02-20 20:12:43', '2020-02-26 20:11:44'),
(14, 'esst', '12', 'social', 'njjj', '0000-00-00', '2020-10-12', 12, 2, 'kkk', '1221', 1202, 0, 12, '2020-02-20 20:19:09', '2020-02-20 20:19:09'),
(15, 'testt', '775771', 'economique', '2020-02-15', '2020-02-26', '2020-02-16', 1, 1, 'test', '5862146', 0, 50000, NULL, '2020-02-20 20:56:30', '2020-03-16 15:49:27');

-- --------------------------------------------------------

--
-- Structure de la table `tranche`
--

DROP TABLE IF EXISTS `tranche`;
CREATE TABLE IF NOT EXISTS `tranche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projet_id` int(11) NOT NULL,
  `description` varchar(5) NOT NULL,
  `niveau_etages` int(2) NOT NULL,
  `date_livraison` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tranche`
--

INSERT INTO `tranche` (`id`, `projet_id`, `description`, `niveau_etages`, `date_livraison`, `created_at`, `updated_at`) VALUES
(16, 13, 'T05', 5, '2020-07-25', '2020-02-26 16:41:40', '2020-02-26 16:41:40'),
(4, 1, 'T01', 6, '2020-02-29', '2020-02-22 20:25:54', '2020-03-03 13:26:22'),
(10, 19, 'T10', 6, '2020-11-21', '2020-02-25 12:28:37', '2020-02-25 12:28:37'),
(6, 1, 'T02', 5, '2020-02-28', '2020-02-22 20:31:28', '2020-03-03 13:26:32'),
(7, 1, 'T03', 5, '2020-02-26', '2020-02-22 20:34:23', '2020-03-03 13:26:40'),
(8, 1, 'T04', 2, '2020-02-28', '2020-02-22 20:36:41', '2020-03-03 13:26:49'),
(9, 19, 'T01', 5, '2020-02-28', '2020-02-22 20:43:27', '2020-02-22 20:43:27'),
(12, 19, 'T10', 5, '2020-11-20', '2020-02-25 12:31:04', '2020-02-25 12:31:04'),
(14, 19, 'T10', 5, '2020-08-23', '2020-02-25 12:33:29', '2020-02-25 12:33:29'),
(17, 0, 'ff', 55, '2020-03-09', '2020-03-19 18:03:26', '2020-03-19 18:03:26'),
(18, 1, 'kk', 2, '2020-03-18', '2020-03-19 18:04:05', '2020-03-19 18:04:05'),
(19, 1, 'yy', 4, '2020-03-04', '2020-03-19 19:49:11', '2020-03-19 19:49:11');

-- --------------------------------------------------------

--
-- Structure de la table `type_projet`
--

DROP TABLE IF EXISTS `type_projet`;
CREATE TABLE IF NOT EXISTS `type_projet` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_projet`
--

INSERT INTO `type_projet` (`id`, `type`) VALUES
(1, 'social'),
(2, 'economique'),
(3, 'moyen_standing'),
(4, 'haut_standing'),
(5, 'lot');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenom`, `email`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(66, 'jb immobilier', 'test', 'jbimmobilier@gmail.com', 1, '$2y$10$Py8hs9cyHgympjORyIHVS.IvONJWUQRPF5u.2hDtR0gXLJV4Xtgdu', 'AgJ651QF8mRg0Og25WsqZttEmZnQK7QeS260KP3y80q9k6wfT4iv01PJZ3MX', '2020-02-17 18:01:11', '2020-02-17 18:01:11'),
(77, 'fadwatest', 'fadwatest', 'fadwa@mail.com', 0, '$2y$10$Uezte9D0/rDKig/jY50b7eOX.nkXYrlpoXG3dfdLcbqCcwMGvmf5.', 'm8S3b467kHfmsNG9Ya075T7cESTd1ZTiY0YojoCrXOV4RNbXWsC03tXIxWlY', '2020-03-17 12:13:21', '2020-03-17 14:22:27'),
(78, 'user1', 'user1', 'user1@mail.com', 0, '$2y$10$GCw2kdfs1PuGIxbxOgWj1uW.aNO7M5tp8UFcnzxhA2DwXm5qGd776', '', '2020-03-17 17:08:43', '2020-03-17 20:53:25'),
(79, 'test', 'test', 'test@mail.com', 0, '$2y$10$P8ashXpJ1GuvCxdlfaa2HuiJ3B2m7/65ABtv9Gp4fLVczSBzX44zq', NULL, '2020-03-18 10:42:28', '2020-03-18 10:42:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
