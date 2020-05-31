-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 07 mars 2020 à 23:56
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
  `etat` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `orientation` varchar(10) NOT NULL,
  `conventionne` tinyint(4) DEFAULT 0,
  `immeuble_id` int(11) NOT NULL,
  `bloc_id` int(11) NOT NULL,
  `tranche_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `prix` float NOT NULL,
  `superficie` float NOT NULL,
  `commentaire` text DEFAULT '  ',
  `titre_foncier` varchar(255) NOT NULL,
  `avance_min` float DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`id`, `propriete_dite_bien`, `numero`, `niveau`, `etat`, `type`, `orientation`, `conventionne`, `immeuble_id`, `bloc_id`, `tranche_id`, `projet_id`, `prix`, `superficie`, `commentaire`, `titre_foncier`, `avance_min`, `created_at`, `updated_at`) VALUES
(7, 'GH0102-01', 2, 0, 'disponible', 'F2', 'N', 0, 7, 18, 4, 1, 222000, 55, 'comment1', 'imm01gh01t04jb', 0, '2020-03-05 16:36:21', '2020-03-05 17:11:03');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bloc`
--

INSERT INTO `bloc` (`id`, `description`, `tranche_id`, `projet_id`, `titre_foncier`, `created_at`, `updated_at`) VALUES
(18, 'GH01', 4, 1, 'gh01t04jb', '2020-02-28 16:04:24', '2020-02-28 16:04:24'),
(8, 'GH02', 6, 1, 'gh02t06jb', '2020-02-26 20:01:47', '2020-02-26 20:01:47');

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
(9, 'IMM03', 18, 4, 1, 'imm03gh01t04jb', '2020-03-02 14:18:24', '2020-03-02 14:18:24');

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
(15, 'test', '775771', 'economique', '2020-02-15', '2020-02-26', '2020-02-16', 1, 1, 'test', '5862146', 0, 50000, NULL, '2020-02-20 20:56:30', '2020-02-21 15:07:22');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
(14, 19, 'T10', 5, '2020-08-23', '2020-02-25 12:33:29', '2020-02-25 12:33:29');

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
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(66, 'jb immobilier', 'jbimmobilier@gmail.com', 1, '$2y$10$Py8hs9cyHgympjORyIHVS.IvONJWUQRPF5u.2hDtR0gXLJV4Xtgdu', NULL, '2020-02-17 18:01:11', '2020-02-17 18:01:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
