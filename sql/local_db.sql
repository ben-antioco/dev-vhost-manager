-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 06 fév. 2019 à 09:11
-- Version du serveur :  10.3.12-MariaDB-log
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `local_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `view` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dev` int(1) DEFAULT 0,
  `local` int(1) DEFAULT 0,
  `stag` int(1) DEFAULT 0,
  `prod` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `params`
--

INSERT INTO `params` (`id`, `view`, `dev`, `local`, `stag`, `prod`) VALUES
(1, 'block', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vhost`
--

CREATE TABLE `vhost` (
  `id` int(11) NOT NULL,
  `vhost_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vhost_local_domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vhost_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT 0,
  `env` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'local'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vhost`
--
ALTER TABLE `vhost`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vhost`
--
ALTER TABLE `vhost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
