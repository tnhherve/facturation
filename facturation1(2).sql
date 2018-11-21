-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 14 oct. 2018 à 17:35
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Déchargement des données de la table `admin`
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
-- Déchargement des données de la table `annee`
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
-- Déchargement des données de la table `consommateur`
--

INSERT INTO `consommateur` (`id_consommateur`, `nom_consommateur`, `telephone_consommateur`, `email_consommateur`, `nbre`, `etat`) VALUES
('CONSO01', 'Herve', 677135385, 'tnhherve@gmail.com', 1, 'present'),
('CONSO02', 'Françoise', 677383927, 'francoise@gmail.com', 1, 'absent'),
('CONSO06', 'Emelda', 674268747, 'jtchuanze@yahoo.fr', 1, 'present'),
('CONSO07', 'Restaurant', 677878996, 'resto@gmail.com', 0, 'present'),
('CONSO08', 'Cedric', 674507580, 'Vivoskalquinho@gmail.com', 1, 'present'),
('CONSO09', 'Ariane', 674748364, 'ariane@yahoo.fr', 1, 'absent'),
('CONSO11', 'Ricardo', 697564034, 'ricardonampe@gmail.com', 1, 'present'),
('CONSO12', 'Librairie', 677876655, 'librairie@gmail.com', 0, 'present'),
('CONSO13', 'Gaël', 679127665, 'Njiomiegahel@gmail.com', 1, 'absent'),
('CONSO14', 'Ramada job', 695067219, 'herve.tamethe@multicanalservices', 1, 'present'),
('CONSO15', 'Kodji zra francois', 694159675, 'kodjizrafrancois@gmail.com', 2, 'present'),
('CONSO16', 'OBOMO Jessie', 690537938, 'jessie@gmail.com', 1, 'present');

--
-- Déclencheurs `consommateur`
--
DELIMITER $$
CREATE TRIGGER `initialisation_index_consommateur` AFTER INSERT ON `consommateur` FOR EACH ROW INSERT INTO index_c(id_consommateur,ancien_index, nouvelle_index, difference_index) VALUES(NEW.id_consommateur, 0, 0, 0)
$$
DELIMITER ;

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
-- Déchargement des données de la table `consomme`
--

INSERT INTO `consomme` (`id_consommateur`, `id_annee`, `id_facture`, `periode`, `montant`) VALUES
('CONSO01', '2018', 'FACTURE04', 'Decembre-Janvier', '708.40'),
('CONSO01', '2018', 'FACTURE05', 'Janvier-Fevrier', '846.40'),
('CONSO01', '2018', 'FACTURE06', 'Fevrier-Mars', '1186.80'),
('CONSO01', '2018', 'FACTURE07', 'Mars-Avril', '1527.20'),
('CONSO01', '2018', 'FACTURE08', 'Avril-Mai', '1361.60'),
('CONSO01', '2018', 'FACTURE09', 'Mai-Juin', '975.20'),
('CONSO02', '2018', 'FACTURE04', 'Decembre-Janvier', '211.60'),
('CONSO02', '2018', 'FACTURE05', 'Janvier-Fevrier', '570.40'),
('CONSO02', '2018', 'FACTURE06', 'Fevrier-Mars', '1352.40'),
('CONSO02', '2018', 'FACTURE07', 'Mars-Avril', '1058.00'),
('CONSO02', '2018', 'FACTURE08', 'Avril-Mai', '848.24'),
('CONSO02', '2018', 'FACTURE09', 'Mai-Juin', '542.80'),
('CONSO06', '2018', 'FACTURE04', 'Decembre-Janvier', '165.60'),
('CONSO06', '2018', 'FACTURE06', 'Fevrier-Mars', '782.00'),
('CONSO06', '2018', 'FACTURE07', 'Mars-Avril', '818.80'),
('CONSO06', '2018', 'FACTURE09', 'Mai-Juin', '138.00'),
('CONSO07', '2018', 'FACTURE04', 'Decembre-Janvier', '4462.00'),
('CONSO07', '2018', 'FACTURE05', 'Janvier-Fevrier', '7194.40'),
('CONSO07', '2018', 'FACTURE06', 'Fevrier-Mars', '7130.00'),
('CONSO07', '2018', 'FACTURE07', 'Mars-Avril', '6973.60'),
('CONSO07', '2018', 'FACTURE08', 'Avril-Mai', '8519.20'),
('CONSO07', '2018', 'FACTURE09', 'Mai-Juin', '5142.80'),
('CONSO08', '2018', 'FACTURE04', 'Decembre-Janvier', '800.40'),
('CONSO08', '2018', 'FACTURE05', 'Janvier-Fevrier', '1012.00'),
('CONSO08', '2018', 'FACTURE06', 'Fevrier-Mars', '607.20'),
('CONSO08', '2018', 'FACTURE07', 'Mars-Avril', '1058.00'),
('CONSO08', '2018', 'FACTURE08', 'Avril-Mai', '671.60'),
('CONSO08', '2018', 'FACTURE09', 'Mai-Juin', '423.20'),
('CONSO09', '2018', 'FACTURE04', 'Decembre-Janvier', '55.20'),
('CONSO09', '2018', 'FACTURE05', 'Janvier-Fevrier', '266.80'),
('CONSO09', '2018', 'FACTURE06', 'Fevrier-Mars', '616.40'),
('CONSO09', '2018', 'FACTURE07', 'Mars-Avril', '708.40'),
('CONSO09', '2018', 'FACTURE08', 'Avril-Mai', '883.20'),
('CONSO09', '2018', 'FACTURE09', 'Mai-Juin', '708.40'),
('CONSO11', '2018', 'FACTURE04', 'Decembre-Janvier', '312.80'),
('CONSO11', '2018', 'FACTURE05', 'Janvier-Fevrier', '1223.60'),
('CONSO11', '2018', 'FACTURE06', 'Fevrier-Mars', '1343.20'),
('CONSO11', '2018', 'FACTURE07', 'Mars-Avril', '1260.40'),
('CONSO11', '2018', 'FACTURE08', 'Avril-Mai', '1242.00'),
('CONSO11', '2018', 'FACTURE09', 'Mai-Juin', '1094.80'),
('CONSO12', '2018', 'FACTURE04', 'Decembre-Janvier', '1002.80'),
('CONSO12', '2018', 'FACTURE05', 'Janvier-Fevrier', '1968.80'),
('CONSO12', '2018', 'FACTURE06', 'Fevrier-Mars', '2888.80'),
('CONSO12', '2018', 'FACTURE07', 'Mars-Avril', '1481.20'),
('CONSO12', '2018', 'FACTURE08', 'Avril-Mai', '3302.80'),
('CONSO12', '2018', 'FACTURE09', 'Mai-Juin', '2208.00'),
('CONSO13', '2018', 'FACTURE09', 'Mai-Juin', '736.00');

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
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `periode`, `montant_facture`, `prix_kwh`, `date_limite`, `annee`) VALUES
('FACTURE02', 'Novembre-Decembre', '19748.00', '92.00', '2017-12-18', 2017),
('FACTURE04', 'Decembre-Janvier', '13494.00', '92.00', '2018-01-15', 2018),
('FACTURE05', 'Janvier-Fevrier', '16127.00', '92.00', '2018-02-16', 2018),
('FACTURE06', 'Fevrier-Mars', '21174.00', '92.00', '2018-03-15', 2018),
('FACTURE07', 'Mars-Avril', '23039.00', '92.00', '2018-04-15', 2018),
('FACTURE08', 'Avril-Mai', '21064.00', '92.00', '2018-05-20', 2018),
('FACTURE09', 'Mai-Juin', '16676.00', '92.00', '2018-06-17', 2018),
('FACTURE10', 'Juin-Juillet', '13275.00', '92.00', '2018-07-25', 2018),
('FACTURE11', 'Juillet-Août', '10017.00', '84.00', '2018-08-25', 2018),
('FACTURE12', 'Août-Septembre', '13714.00', '92.00', '2018-09-25', 2018),
('FACTURE13', 'Septembre-Octobre', '18322.00', '92.00', '2018-10-20', 2018);

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
  `id_index` int(9) NOT NULL,
  `id_consommateur` char(32) NOT NULL,
  `ancien_index` decimal(10,2) DEFAULT '0.00',
  `nouvelle_index` decimal(10,2) DEFAULT '0.00',
  `difference_index` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `index_c`
--

INSERT INTO `index_c` (`id_index`, `id_consommateur`, `ancien_index`, `nouvelle_index`, `difference_index`) VALUES
(1, 'CONSO01', '83.60', '88.90', '10.60'),
(2, 'CONSO02', '57.90', '59.80', '5.90'),
(6, 'CONSO06', '102.60', '108.80', '1.50'),
(7, 'CONSO07', '647.90', '685.90', '55.90'),
(8, 'CONSO08', '288.00', '301.40', '4.60'),
(9, 'CONSO09', '55.20', '60.30', '7.70'),
(10, 'CONSO11', '157.10', '166.00', '11.90'),
(11, 'CONSO12', '266.30', '292.40', '24.00'),
(13, 'CONSO13', '12.50', '14.40', '8.00'),
(14, 'CONSO14', '0.00', '0.00', '0.00'),
(15, 'CONSO15', '26.30', '48.60', '0.00'),
(16, 'CONSO16', '0.00', '0.00', '0.00');

--
-- Index pour les tables déchargées
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
-- AUTO_INCREMENT pour les tables déchargées
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

--
-- AUTO_INCREMENT pour la table `index_c`
--
ALTER TABLE `index_c`
  MODIFY `id_index` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consomme`
--
ALTER TABLE `consomme`
  ADD CONSTRAINT `pk_id_consommateur_delete` FOREIGN KEY (`id_consommateur`) REFERENCES `consommateur` (`id_consommateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `index_c`
--
ALTER TABLE `index_c`
  ADD CONSTRAINT `pk_id_consommateur_delete_index` FOREIGN KEY (`id_consommateur`) REFERENCES `consommateur` (`id_consommateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
