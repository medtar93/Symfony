-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 08 oct. 2018 à 09:30
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pmbaye_portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_competences`
--

CREATE TABLE `t_competences` (
  `id_competence` int(3) NOT NULL,
  `competence` varchar(150) NOT NULL,
  `niveau` int(3) NOT NULL,
  `categorie` enum('Développement','Infographie','Gestion de projet','') NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_competences`
--

INSERT INTO `t_competences` (`id_competence`, `competence`, `niveau`, `categorie`, `id_utilisateur`) VALUES
(1, 'HTML', 80, 'Développement', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_experiences`
--

CREATE TABLE `t_experiences` (
  `id_experience` int(3) NOT NULL,
  `titre_exp` varchar(150) NOT NULL,
  `stitre_exp` varchar(200) NOT NULL,
  `dates_exp` varchar(100) NOT NULL,
  `description_exp` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE `t_formations` (
  `id_formation` int(3) NOT NULL,
  `titre_form` varchar(150) NOT NULL,
  `stitre_form` varchar(200) NOT NULL,
  `dates_form` varchar(100) NOT NULL,
  `description_form` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_loisirs`
--

CREATE TABLE `t_loisirs` (
  `id_loisir` int(3) NOT NULL,
  `loisir` varchar(200) NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_loisirs`
--

INSERT INTO `t_loisirs` (`id_loisir`, `loisir`, `id_utilisateur`) VALUES
(1, 'Séries', 1),
(2, 'Voyage', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_messages`
--

CREATE TABLE `t_messages` (
  `id_message` int(3) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sujet` varchar(150) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_realisations`
--

CREATE TABLE `t_realisations` (
  `id_realisation` int(3) NOT NULL,
  `titre_real` varchar(150) NOT NULL,
  `stitre_real` varchar(200) NOT NULL,
  `dates_real` varchar(100) NOT NULL,
  `description_real` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_reseaux`
--

CREATE TABLE `t_reseaux` (
  `id_reseau` int(3) NOT NULL,
  `url` varchar(120) NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_titres`
--

CREATE TABLE `t_titres` (
  `id_titre` int(3) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `accroche` tinyint(255) NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE `t_users` (
  `id_user` int(3) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_1` varchar(20) NOT NULL,
  `phone_2` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `pseudo` varchar(15) NOT NULL,
  `age` smallint(5) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('Homme','Femme','','') NOT NULL,
  `civilstatus` enum('m','mme','','') NOT NULL,
  `address` text NOT NULL,
  `zip` varchar(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_users`
--

INSERT INTO `t_users` (`id_user`, `firstname`, `lastname`, `email`, `phone_1`, `phone_2`, `password`, `pseudo`, `age`, `birthday`, `gender`, `civilstatus`, `address`, `zip`, `city`, `country`, `comments`) VALUES
(1, 'Jean', 'Dupont', 'jean.dupont@gmail.com', '0628569547', '0123456789', 'azerty', 'jdupont', 30, '1988-01-04', 'Homme', 'm', '15 avenue de la liberté \r\n', '75016', 'Paris', 'France', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateurs`
--

CREATE TABLE `t_utilisateurs` (
  `id_utilisateur` int(3) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `portable` varchar(20) NOT NULL,
  `mdp` varchar(15) NOT NULL,
  `pseudo` varchar(15) NOT NULL,
  `age` smallint(5) NOT NULL,
  `anniversaire` date NOT NULL,
  `genre` enum('Homme','Femme','','') NOT NULL,
  `civilite` enum('m','mme','','') NOT NULL,
  `adresse` tinytext NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `pays` varchar(30) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateurs`
--

INSERT INTO `t_utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `telephone`, `portable`, `mdp`, `pseudo`, `age`, `anniversaire`, `genre`, `civilite`, `adresse`, `code_postal`, `ville`, `pays`, `commentaire`) VALUES
(1, 'Papaoumar', 'Mbaye', 'papaoumar.mbaye@laposte.net', '0652317540', '', 'azerty', 'pmbaye', 24, '1994-03-20', 'Homme', 'm', '13, Avenue Jean Moulin', '93100', 'Montreuil', 'France', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_competences`
--
ALTER TABLE `t_competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  ADD PRIMARY KEY (`id_loisir`);

--
-- Index pour la table `t_messages`
--
ALTER TABLE `t_messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- Index pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  ADD PRIMARY KEY (`id_reseau`);

--
-- Index pour la table `t_titres`
--
ALTER TABLE `t_titres`
  ADD PRIMARY KEY (`id_titre`);

--
-- Index pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_competences`
--
ALTER TABLE `t_competences`
  MODIFY `id_competence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  MODIFY `id_experience` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `id_formation` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  MODIFY `id_loisir` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_messages`
--
ALTER TABLE `t_messages`
  MODIFY `id_message` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  MODIFY `id_realisation` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  MODIFY `id_reseau` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_titres`
--
ALTER TABLE `t_titres`
  MODIFY `id_titre` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  MODIFY `id_utilisateur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
