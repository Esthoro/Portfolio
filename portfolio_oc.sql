-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 02:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_oc`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `edited_at` date NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `author_id`, `edited_at`, `content`, `statut`) VALUES
(4, 3, 6, '2024-08-22', 'Super commentaire', 1),
(6, 8, 1, '2024-09-30', 'Super article !', 1),
(7, 8, 1, '2024-09-30', 'Effectivement !', 0),
(8, 3, 5, '2024-09-30', 'J\'adore ce blog', 0);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `first_name`, `surname`, `email`, `pseudo`, `password`, `role`, `statut`) VALUES
(1, 'Esther', '@admin', 'esther@pp-communication.fr', 'Esth', '$2y$10$4Pn1tyaJpUPwHFPpRMZph.r73tbUQAy8P1AY4aooeUdRCZlYZ8bwW', 2, 1),
(5, 'User', 'User', 'user@user.com', 'User', '$2y$10$/lRsTn79uzkqmOAkACzOTeNIvfRvOHg0FnDpOf090MxSVJ3.QKAqe', 1, 1),
(6, 'User2', 'User2', 'user2@user2.fr', 'User2', '$2y$10$BzMqwqyd8o6ddw.lRHPfJ.r0vUhpSwSv/A.ANArab.o1gtlLyp7ZS', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `chapo` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `chapo`, `content`, `author_id`, `updated_at`, `created_at`) VALUES
(3, 'Bienvenue sur mon blog !', 'Code, créativité et apprentissage', 'Bienvenue sur mon blog ! Je m\'appelle Esther, développeuse web junior en alternance dans le cadre d\'une formation de développement web PHP. Passionnée par le code et les nouvelles technologies, je partage ici mon parcours, mes découvertes et des conseils pratiques sur le développement web. Que vous soyez débutant ou déjà dans le milieu, j\'espère que vous trouverez des ressources utiles et des astuces qui vous aideront dans vos projets. N\'hésitez pas à me suivre pour des contenus réguliers sur PHP, JavaScript, HTML/CSS, et bien plus encore ! Bonne lecture et à bientôt !', 1, '2024-09-23 08:18:02', '2024-06-10 00:00:00'),
(5, 'Mes outils de travails (I)', 'Langages', 'En tant que développeuse web, j\'utilise plusieurs langages au quotidien pour construire des sites et des applications web dynamiques et interactifs.\n\nPHP est mon langage de prédilection pour la partie serveur. Il me permet de gérer la logique derrière un site web, comme la gestion des bases de données, l\'authentification des utilisateurs, ou encore l\'envoi de formulaires. Avec PHP, je peux aussi facilement interagir avec des systèmes de gestion de contenu (CMS) comme WordPress, ce qui simplifie énormément le travail sur des projets complexes.\n\nJavaScript est l\'outil incontournable pour rendre un site interactif du côté client. C’est un langage que j’utilise pour gérer des événements comme des clics, des formulaires ou des animations. Il permet aussi de communiquer avec des APIs pour afficher du contenu dynamique sans avoir à recharger la page. Grâce à des frameworks comme React ou Vue.js, JavaScript me permet de créer des interfaces utilisateur modernes et réactives.\n\nMySQL est le système de gestion de bases de données que j\'utilise le plus souvent pour stocker et gérer les données d\'un site web. Il fonctionne en tandem avec PHP pour récupérer, insérer, modifier ou supprimer des informations dans une base de données. Par exemple, pour un site e-commerce, MySQL gère les informations des produits, des utilisateurs, des commandes, etc. Grâce au langage SQL, je peux écrire des requêtes complexes pour filtrer, trier ou agréger les données selon les besoins du projet. C’est un outil très puissant, surtout lorsqu\'il est bien optimisé pour traiter de gros volumes d’informations.\n\nHTML est la structure de base de toutes les pages web. C\'est un langage de balisage que j\'utilise pour organiser le contenu d\'une page, en définissant des titres, des paragraphes, des liens, des images, et bien plus encore. C\'est un langage simple mais essentiel, qui pose les fondations de tout site web.\n\nCSS vient habiller le HTML pour lui donner du style. J\'utilise ce langage pour contrôler l\'apparence visuelle des pages, en ajustant les couleurs, les polices, les marges, ou encore les animations.', 1, '2024-09-23 08:13:16', '2024-08-05 13:45:46'),
(8, 'Mes outils de travails (II)', 'CMS', 'Les CMS (Content Management Systems) ou systèmes de gestion de contenu sont des plateformes qui permettent de créer, gérer et modifier facilement un site web sans avoir besoin de coder chaque aspect manuellement. Ils sont particulièrement utiles pour les personnes ou les entreprises qui veulent publier du contenu rapidement et régulièrement sans avoir à s\'occuper des détails techniques.\r\n\r\nParmi les CMS les plus populaires, on trouve WordPress, Joomla et Drupal. Ces outils offrent une interface utilisateur conviviale où l’on peut ajouter du texte, des images, des vidéos et même gérer les utilisateurs du site, sans écrire une seule ligne de code. Le grand avantage des CMS est leur extensibilité. Grâce aux thèmes et aux plugins, il est possible de personnaliser le design et les fonctionnalités du site selon les besoins, qu’il s’agisse d’un simple blog ou d’une boutique en ligne.\r\n\r\nLes développeurs web, comme moi, utilisent également les CMS pour accélérer le développement d’un site. Plutôt que de créer un site de zéro, on peut partir d’un CMS et y ajouter des fonctionnalités spécifiques en écrivant du code PHP ou en intégrant des API. Cela permet de combiner la flexibilité du code sur mesure avec la facilité d’utilisation des CMS, offrant ainsi un bon compromis entre rapidité et personnalisation.\r\n\r\nEn résumé, les CMS sont un excellent outil pour gérer le contenu d’un site web sans avoir besoin de compétences techniques avancées, tout en offrant la possibilité aux développeurs de les adapter aux besoins spécifiques d’un projet.', 1, '2024-09-23 08:19:31', '2024-09-23 10:19:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
