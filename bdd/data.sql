-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 avr. 2023 à 12:44
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `data`
--

-- --------------------------------------------------------

--
-- Structure de la table `autres`
--

CREATE TABLE `autres` (
  `autre_id` int(11) NOT NULL,
  `autre_name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date_f` date DEFAULT curdate(),
  `marque` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `materiel_info_bureau`
--

CREATE TABLE `materiel_info_bureau` (
  `mat_id` int(11) NOT NULL,
  `mat_type` varchar(50) NOT NULL,
  `mat_name` varchar(50) NOT NULL,
  `mat_num` varchar(50) NOT NULL,
  `info_caract` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `office_id` int(11) NOT NULL DEFAULT 0,
  `mat_ondu` varchar(50) NOT NULL,
  `mat_clav` varchar(50) NOT NULL,
  `mat_souris` varchar(50) NOT NULL,
  `mat_ecr` varchar(50) NOT NULL,
  `date_first` date NOT NULL,
  `observation_b` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `materiel_info_laptop`
--

CREATE TABLE `materiel_info_laptop` (
  `matl_id` int(11) NOT NULL,
  `matl_type` varchar(50) NOT NULL,
  `matl_name` varchar(50) NOT NULL,
  `matl_num` varchar(50) NOT NULL,
  `matl_caract` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `office_id` int(11) NOT NULL DEFAULT 0,
  `matl_ondu` varchar(50) NOT NULL,
  `date_debut` date NOT NULL,
  `observation_l` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `office`
--

INSERT INTO `office` (`office_id`, `office_name`) VALUES
(1, 'CIRDOMA'),
(2, 'BAV 1'),
(3, 'BAV 2'),
(4, 'BAV 4'),
(5, 'ARCHIVE'),
(6, 'GUICHET');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_fonction` varchar(50) NOT NULL,
  `office_id` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_fonction`, `office_id`, `contact`, `password`) VALUES
(1, 'test1', 'Secretaire', 1, 321564789, '123');

-- --------------------------------------------------------

--
-- Structure de la table `user_admin`
--

CREATE TABLE `user_admin` (
  `usera_id` int(11) NOT NULL,
  `useraname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_admin`
--

INSERT INTO `user_admin` (`usera_id`, `useraname`, `password`) VALUES
(1, 'test', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `autres`
--
ALTER TABLE `autres`
  ADD PRIMARY KEY (`autre_id`),
  ADD KEY `FK__users` (`user_id`);

--
-- Index pour la table `materiel_info_bureau`
--
ALTER TABLE `materiel_info_bureau`
  ADD PRIMARY KEY (`mat_id`) USING BTREE,
  ADD KEY `FK_materiel_info_laptop_users` (`user_id`) USING BTREE,
  ADD KEY `FK_materiel_info_laptop_office` (`office_id`) USING BTREE;

--
-- Index pour la table `materiel_info_laptop`
--
ALTER TABLE `materiel_info_laptop`
  ADD PRIMARY KEY (`matl_id`),
  ADD KEY `FK_materiel_info_laptop_users` (`user_id`),
  ADD KEY `FK_materiel_info_laptop_office` (`office_id`);

--
-- Index pour la table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_users_office` (`office_id`);

--
-- Index pour la table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`usera_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `autres`
--
ALTER TABLE `autres`
  MODIFY `autre_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel_info_bureau`
--
ALTER TABLE `materiel_info_bureau`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel_info_laptop`
--
ALTER TABLE `materiel_info_laptop`
  MODIFY `matl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `usera_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `autres`
--
ALTER TABLE `autres`
  ADD CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `materiel_info_bureau`
--
ALTER TABLE `materiel_info_bureau`
  ADD CONSTRAINT `materiel_info_bureau_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `materiel_info_bureau_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `materiel_info_laptop`
--
ALTER TABLE `materiel_info_laptop`
  ADD CONSTRAINT `FK_materiel_info_laptop_office` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_materiel_info_laptop_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_office` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
