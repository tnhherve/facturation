-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Février 2018 à 12:59
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `facturation1`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `pseudo` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `pseudo`, `password`) VALUES
(1, 'herve', '50d7436039744c253f9b2a4e90cbedb02ebfb82d');

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE `annee` (
  `id_annee` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `annee`
--

INSERT INTO `annee` (`id_annee`) VALUES
('2018');

-- --------------------------------------------------------

--
-- Structure de la table `consommateur`
--

CREATE TABLE `consommateur` (
  `id_consommateur` char(32) NOT NULL,
  `nom_consommateur` char(32) DEFAULT NULL,
  `telephone_consommateur` int(32) DEFAULT NULL,
  `email_consommateur` char(32) DEFAULT NULL,
  `nbre` int(9) NOT NULL,
  `etat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consommateur`
--

INSERT INTO `consommateur` (`id_consommateur`, `nom_consommateur`, `telephone_consommateur`, `email_consommateur`, `nbre`, `etat`) VALUES
('CONSO01', 'Herve', 677135385, 'tnhherve@gmail.com', 1, 'present'),
('CONSO02', 'Françoise', 677383927, 'francoise@gmail.com', 1, 'present'),
('CONSO03', 'Thierry', 699098765, 'thierry@gmail.com', 1, 'present'),
('CONSO04', 'carole', 698645375, 'carole@gmail.com', 1, 'present'),
('CONSO05', 'Tadjou lionel', 655375539, 'tuba@yahoo.fr', 1, 'present'),
('CONSO06', 'Josephine', 674268747, 'jtchuanze@yahoo.fr', 1, 'absent'),
('CONSO07', 'Restaurant', 677878996, 'resto@gmail.com', 0, 'present'),
('CONSO08', 'Cedric', 674507580, 'Vivoskalquinho@gmail.com', 2, 'present'),
('CONSO09', 'Ariane', 674748364, 'ariane@yahoo.fr', 1, 'present'),
('CONSO11', 'Ricardo', 697564034, 'ricardonampe@gmail.com', 2, 'present'),
('CONSO12', 'Librairie', 677876655, 'librairie@gmail.com', 0, 'present');

-- --------------------------------------------------------

--
-- Structure de la table `consomme`
--

CREATE TABLE `consomme` (
  `id_consommateur` char(32) NOT NULL,
  `id_annee` char(32) NOT NULL,
  `id_facture` char(32) NOT NULL,
  `periode` char(32) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consomme`
--

INSERT INTO `consomme` (`id_consommateur`, `id_annee`, `id_facture`, `periode`, `montant`) VALUES
('CONSO01', '2018', 'FACTURE04', 'Decembre-Janvier', '708.40'),
('CONSO01', '2018', 'FACTURE05', 'Janvier-Fevrier', '846.40'),
('CONSO02', '2018', 'FACTURE04', 'Decembre-Janvier', '211.60'),
('CONSO02', '2018', 'FACTURE05', 'Janvier-Fevrier', '570.40'),
('CONSO03', '2018', 'FACTURE04', 'Decembre-Janvier', '46.00'),
('CONSO03', '2018', 'FACTURE05', 'Janvier-Fevrier', '257.60'),
('CONSO04', '2018', 'FACTURE04', 'Decembre-Janvier', '27.60'),
('CONSO04', '2018', 'FACTURE05', 'Janvier-Fevrier', '138.00'),
('CONSO05', '2018', 'FACTURE04', 'Decembre-Janvier', '745.20'),
('CONSO05', '2018', 'FACTURE05', 'Janvier-Fevrier', '1398.40'),
('CONSO06', '2018', 'FACTURE04', 'Decembre-Janvier', '165.60'),
('CONSO07', '2018', 'FACTURE04', 'Decembre-Janvier', '4462.00'),
('CONSO07', '2018', 'FACTURE05', 'Janvier-Fevrier', '7194.40'),
('CONSO08', '2018', 'FACTURE04', 'Decembre-Janvier', '800.40'),
('CONSO08', '2018', 'FACTURE05', 'Janvier-Fevrier', '1012.00'),
('CONSO09', '2018', 'FACTURE04', 'Decembre-Janvier', '55.20'),
('CONSO09', '2018', 'FACTURE05', 'Janvier-Fevrier', '266.80'),
('CONSO11', '2018', 'FACTURE04', 'Decembre-Janvier', '312.80'),
('CONSO11', '2018', 'FACTURE05', 'Janvier-Fevrier', '1223.60'),
('CONSO12', '2018', 'FACTURE04', 'Decembre-Janvier', '1002.80'),
('CONSO12', '2018', 'FACTURE05', 'Janvier-Fevrier', '1968.80');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` char(32) NOT NULL,
  `periode` char(32) DEFAULT NULL,
  `montant_facture` decimal(10,2) DEFAULT '0.00',
  `prix_kwh` decimal(10,2) DEFAULT NULL,
  `date_limite` date NOT NULL,
  `annee` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `periode`, `montant_facture`, `prix_kwh`, `date_limite`, `annee`) VALUES
('FACTURE02', 'Novembre-Decembre', '19748.00', '92.00', '2017-12-18', 2017),
('FACTURE04', 'Decembre-Janvier', '13494.00', '92.00', '2018-01-15', 2018),
('FACTURE05', 'Janvier-Fevrier', '16127.00', '92.00', '2018-02-16', 2018);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `nombre` int(10) NOT NULL,
  `ancien_index` decimal(10,2) NOT NULL,
  `nouvelle_index` decimal(10,2) NOT NULL,
  `difference_index` decimal(10,2) NOT NULL,
  `prix_kwh` decimal(10,2) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `fuite` decimal(10,2) NOT NULL,
  `deplacement` int(3) NOT NULL,
  `montant_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `index_c`
--

CREATE TABLE `index_c` (
  `id_index` char(32) NOT NULL,
  `id_consommateur` char(32) NOT NULL,
  `ancien_index` decimal(10,2) DEFAULT '0.00',
  `nouvelle_index` decimal(10,2) DEFAULT '0.00',
  `difference_index` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `index_c`
--

INSERT INTO `index_c` (`id_index`, `id_consommateur`, `ancien_index`, `nouvelle_index`, `difference_index`) VALUES
('INDEX01', 'CONSO01', '16.80', '26.00', '9.20'),
('INDEX02', 'CONSO02', '10.38', '16.58', '6.20'),
('INDEX03', 'CONSO03', '89.10', '91.90', '2.80'),
('INDEX04', 'CONSO04', '47.00', '48.50', '1.50'),
('INDEX05', 'CONSO05', '421.60', '436.80', '15.20'),
('INDEX06', 'CONSO06', '78.90', '80.70', '1.80'),
('INDEX07', 'CONSO07', '165.90', '244.10', '78.20'),
('INDEX08', 'CONSO08', '226.90', '237.90', '11.00'),
('INDEX09', 'CONSO09', '20.60', '23.50', '2.90'),
('INDEX11', 'CONSO11', '80.30', '93.60', '13.30'),
('INDEX12', 'CONSO12', '99.80', '121.20', '21.40');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`id_annee`);

--
-- Index pour la table `consommateur`
--
ALTER TABLE `consommateur`
  ADD PRIMARY KEY (`id_consommateur`);

--
-- Index pour la table `consomme`
--
ALTER TABLE `consomme`
  ADD PRIMARY KEY (`id_consommateur`,`id_annee`,`id_facture`),
  ADD KEY `I_FK_CONSOMME_CONSOMMATEUR` (`id_consommateur`),
  ADD KEY `I_FK_CONSOMME_ANNEE` (`id_annee`),
  ADD KEY `I_FK_CONSOMME_FACTURE` (`id_facture`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `index_c`
--
ALTER TABLE `index_c`
  ADD PRIMARY KEY (`id_index`),
  ADD KEY `I_FK_INDEX_CONSOMMATEUR` (`id_consommateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
