-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 01 nov. 2022 à 14:41
-- Version du serveur : 8.0.30-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Javoy`
--

-- --------------------------------------------------------

--
-- Structure de la table `actuality`
--

CREATE TABLE `actuality` (
  `id` int NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `actuality`
--

INSERT INTO `actuality` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(137, 'Quand le vin et la littérature font bon ménage', 'Vous pouvez partager un article en cliquant sur les icônes de partage en haut à droite de celui-ci. \r\nLa reproduction totale ou partielle d’un article, sans l’autorisation écrite et préalable du Monde, est strictement interdite. \r\nPour plus d’informations, consultez nos conditions générales de vente. \r\nPour toute demande d’autorisation, contactez droitsdauteur@lemonde.fr. \r\nEn tant qu’abonné, vous pouvez offrir jusqu’à cinq articles par mois à l’un de vos proches grâce à la fonctionnalité « Offrir un article ». \r\n\r\nhttps://www.lemonde.fr/le-monde-passe-a-table/article/2022/10/30/quand-le-vin-et-la-litterature-font-bon-menage_6147896_6082232.html\r\n\r\ne nombre d’ouvrages sur le vin, dont les essais thématiques, ne cesse de croître. Les livres pédagogiques, un temps boudés, ont trouvé leur public, notamment sous la forme de BD\r\n\r\nLes livres pédagogiques, de moins en moins ennuyeux\r\nCantonnés aux étagères poussiéreuses, écrits trop petit, touffus, ornés de photos tristounes dans les tons marron et bordeaux, les livres pédagogiques sur le vin, longtemps, n’étaient pas sexy. Au moins jusqu’au début des années 2010.\r\n\r\nUn ouvrage, en particulier, a totalement rebattu les cartes de la connaissance du monde du vin par l’écrit. En passant par le dessin. Les Ignorants (Futuropolis) paraît en octobre 2011 et devient rapidement une référence incontestée pour le grand public. Bande dessinée documentaire, elle propose le regard croisé d’Etienne Davodeau, l’auteur, et d’un vigneron, Richard Leroy, chacun ignorant tout du métier de l’autre. Le second va apprendre, un peu, de la fabrication d’un livre ; le premier va apprendre, beaucoup, de la viticulture et de la vinification. Evidemment, le talent de l’auteur, qui s’exprime à travers la finesse du récit et la précision des dialogues, contribue largement au succès. Mais aussi, le choix de dessiner les gestes et les manipulations (l’épopée du décavaillonnage, où Etienne Davodeau apprend à labourer entre les pieds de vigne, notamment) permet de mieux comprendre le travail du vigneron, la précision et l’effort nécessaires. Et ça change tout.\r\n\r\nLire aussi : Article réservé à nos abonnés Etienne Davodeau : « Mon approche du vin reste décontractée »\r\nDepuis, les BD pédagogiques sur le vin n’ont cessé de fleurir. Retenons par exemple les deux tomes de Pur jus, de Justine Saint-Lô et Fleur Godart, parus en 2016 et 2019 (Marabout). Entièrement consacrés au vin nature, ils célèbrent joyeusement les vignerons les plus militants du milieu.\r\n\r\nPlus récemment et sur un registre plus accessible, saluons le travail de Benoist Simmat et Daniel Casanave, avec L’Incroyable Histoire du vin (Les Arènes, 368 pages, 25 euros). Superbe succès en librairie (vendu à plus de 90 000 exemplaires), cet ouvrage léger, amusant et pourtant très bien documenté, qui a été réédité pour la troisième fois en août, retrace dix mille ans d’aventure viticole et montre pourquoi le vin a toujours fasciné. On imagine les premières vinifications de la préhistoire, on revient sur la culture au Moyen Age (le florissant vignoble d’Argenteuil), on assiste à la naissance du tire-bouchon ou des appellations. L’ouvrage vient également d’être décliné en jeu de société.\r\n\r\nDans le même genre, Œnologix est une autre bande dessinée, bien faite, parue en septembre chez Dunod (144 pages, 19,90 euros). Signée François Bachelot et Vincent Burgeon, elle adopte les mêmes codes : un ton léger, de l’humour, un dessin tonique et sympathique. A travers quelques personnages (du plus néophyte au plus savant), elle aborde, avec beaucoup de fraîcheur, non pas l’histoire mais l’ensemble de l’univers du vin – la dégustation, la vinification, la classification des AOC ou les accords mets-vins. Sans en avoir l’air, c’est un vrai petit précis œnologique.\r\n\r\nIl vous reste 69.06% de cet article à lire. La suite est réservée aux abonnés.\r\n\r\nCONTENUS SPONSORISÉS PAROUTBRAIN\r\nPUBLICITÉ\r\nFRANCE 24\r\nLiban : le président Aoun quitte le palais présidentiel, après un mandat marqué par les crises\r\nPUBLICITÉ\r\nWMSHOE.FR\r\nLes meilleurs chaussures à marcher et à être debout pour homme', '636061560a8d8_7383987_1666864128575-illu-livres-vin.jpg', '2022-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `description`) VALUES
(1, 'Vin rouge', 'vin_rouge.jpg', 'Il faut découvrir ces vins rouges légers et fleuris, aux arômes de petits fruits rouges, qui s’étendent sur la rive gauche de la Loire, entre Orléans et la Sologne.\nUne vraie typicité sur le rouge, un assemblage Meunier et Pinot Noir. Le cépage Meunier ne se trouve nulle part ailleurs, une spécificité de l’AOC Orléans, reconnue en appellation en 2006.\nLe cépage Meunier vinifié en rouge, ne se trouve nulle part ailleurs, c’est une spécificité de l’AOC Orléans reconnue en appellation en 2006, il produit un vin rouge fruité et légèrement épicé.'),
(2, 'Vin Blanc', 'vin_blanc.jpg', 'Reconnue en 2006 en Appellation, le vignoble de l’AOC est situé au sud de la Loire, entre Orléans et la Sologne. Le blanc d’Orléans est issu d’un seul cépage, le Chardonnay. Ce cépage offre une finesse particulière. Il peut être assemblé avec du Pinot Gris. Les raisins sont cueillis à bonne maturité pour obtenir des vins blancs secs frais avec des arômes de fleurs blanches.\r\nLes blancs d’AOC Orléans sont, plutôt secs, avec un bouquet subtil et fruité. Ce sont des vins à boire jeunes.\r\nLe blanc d’AOC Orléans est frais et fruité avec des arômes de fleurs blanches.'),
(3, 'Vin Rosé', 'rose.jpg', 'Reconnue en 2006 en Appellation, le vignoble de l’AOC est situé au sud de la Loire, entre Orléans et la Sologne. Le cépage Meunier constitue l’originalité de ses vins de Loire. Il est vinifié soit pur, soit en assemblage avec le Pinot Noir et/ou Pinot Gris. Le climat est intéressant pour le terroir en raison de son influence continental et d’une pluviométrie équilibrée. Les vignes de cette appellation profitent des excellents sols de graviers siliceux que leur offre la région Centre Val de Loire.\r\nLes rosés d’AOC Orléans sont des vins frais et désaltérant, c’est un vin d’été par excellence.\r\nLe rosé d’AOC Orléans est frais et fruité avec des parfums de petits fruits rouges');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `detail` varchar(2000) NOT NULL,
  `status_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `reference`, `firstname`, `lastname`, `email`, `detail`, `status_id`) VALUES
(22, 'P2Sy7udTDn', 'Endrick', 'Losange', 'racolad413@evilant.com', 'endricktrx3', 1),
(23, 'JdLRs24OpP', 'Endrick', 'Losange', 'endricklosange@gmail.com', 'endricktrx3', 3),
(24, 'hf25tWeBB3', 'Endrick', 'Losange', 'endricklosange@gmail.com', 'endricktrx3', 1),
(25, '2eCdzP1sCc', 'Endrick', 'Losange', 'rosiya9538@keshitv.com', 'Orléans L’Excellence rouge|2/Orléans L’Excellence blanc|1/Orléans blanc|1/', 1),
(26, 'ArzLCC67vH', 'Endrick', 'Losange', 'endricklosange@gmail.com', 'Orléans rouge|3/Orléans blanc|1/Orléans rosé|3/', 1);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text,
  `year` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `year`, `image`, `category_id`) VALUES
(5, 'Orléans L’Excellence rouge', 20.3, 'Assemblage de pinot meunier et pinot noir, ce vin issu de vignes de 50 ans sur des terroirs argilo-calcaire est élevé en fûts. Complexe et structuré, il révèle des arômes de fraises confites et une bouche ample et soyeuse. Ce vin tout en finesse accompagnera vos viandes et gibier à plumes.', 2022, '63605a040fdab_excellence-rouge.jpg', 1),
(6, 'Orléans rouge', 9.8, 'Ce vin est issu de l’assemblage du pinot meunier et du pinot noir grande originalité de notre appellation. La robe d’un rubis chatoyant et un nez explosif de fruits rouges nuancé d’épices douces composent une approche des plus avenantes. On retrouve ces arômes dans une bouche parfaitement équilibrée, longue, suave et d’une grande souplesse. Il est à la fois juteux et tonique, parfait pour accompagner viandes blanches, grillades et poissons grillés.', 2020, '636059d529caf_orleans-rouge.jpg', 1),
(7, 'Orléans blanc', 9.8, 'Ce 100 % chardonnay est un vin tout en finesse au nez de fleurs blanches, de fruits d’été et d’agrumes. D’abord vive, la bouche se montre ensuite chaleureuse et onctueuse avec une finale saline. Il accompagnera parfaitement vos apéritifs et vos plats iodés.', 2020, '63605a5468a5d_orleans-blanc.jpg', 2),
(8, 'Orléans L’Excellence blanc', 20.3, 'Issue de nos meilleurs chardonnays sur des terroirs calcaires, cette cuvée vinifiée et élevée en fûts développe une belle complexité. On trouve au nez des notes de pêches et la bouche est suave, ample, avec une finale d’agrumes. À déguster avec des crustacés, des poissons en sauce, des volailles ou des fromages.', 2020, '63605aa07e858_excellence-blanc.jpg', 2),
(9, 'Orléans rosé', 9.3, 'Assemblage de pinot meunier et de pinot gris, ce vin aux notes de fruits rouges offre une bouche ample avec une finale fraîche et tannique. Il accompagnera parfaitement vos apéritifs, charcuteries et salades.', 2021, '636060997b5a3_orleans-rose.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'En cours'),
(2, 'Terminé '),
(3, 'Annulée');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'endricklosange@gmail.com', '$2y$10$qN6mdjI.CJ9MdRiEAty9juWPImm0.cmuXIVELXY2cmJyQWw6lCXxq');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actuality`
--
ALTER TABLE `actuality`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actuality`
--
ALTER TABLE `actuality`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
