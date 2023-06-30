-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 30 juin 2023 à 17:41
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portail_restart`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `enseignant` varchar(100) NOT NULL,
  `note` int(128) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `nom`, `enseignant`, `note`, `date`) VALUES
(1, 'Javascript', 'Louise PICOT', 3, '2023-05-04 11:01:06'),
(2, 'PHP/MySQL', 'Alexis BOUGY', 20, '2023-05-04 11:01:06'),
(3, 'HTML / CSS / Mise en ligne', 'Louise PICOT', 17, '2023-05-05 14:54:50'),
(4, 'Data & IOT', 'jsp', 10, '2023-05-05 16:27:31');

-- --------------------------------------------------------

--
-- Structure de la table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(128) NOT NULL,
  `tweet` varchar(2048) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hashtag` varchar(64) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `likes` int(10) UNSIGNED NOT NULL,
  `comments` int(10) UNSIGNED NOT NULL,
  `retweets` int(10) UNSIGNED NOT NULL,
  `pp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tweets`
--

INSERT INTO `tweets` (`id`, `author`, `tweet`, `date`, `hashtag`, `image`, `likes`, `comments`, `retweets`, `pp`) VALUES
(6, 'test3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-05-09 16:42:36', 'Gaming', '', 0, 0, 0, '/img/profile_500.png'),
(9, 'Brayan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-05-10 19:16:09', 'Technologie', '', 0, 0, 0, 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=128'),
(11, 'IAiiRoZz', 'Et nihil sint et rerum debitis eum dolorem enim et velit tempora sed esse nobis! In voluptas quaerat sit rerum ipsum ea molestiae illum ut sunt distinctio et autem magnam qui voluptas voluptas non deleniti omnis?', '2023-06-26 11:25:41', 'Photographie', '', 0, 0, 0, 'https://cdn.discordapp.com/avatars/547175019231313921/3c55f8f690e558e2c9fd9ea4dcec8fb0.png?size=128'),
(26, 'Brayan', 'Tweeté depuis un téléphone.', '2023-06-29 18:18:08', 'Technologie', '', 0, 0, 0, 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=1024'),
(27, 'Brayan', 'Tweeté depuis le menu de tweet rapide sur téléphone.', '2023-06-29 18:30:32', 'Technologie', '', 0, 0, 0, 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=128'),
(52, 'Brayan', 'backup test hashtag', '2023-06-30 18:23:17', 'Nanterre', '', 0, 0, 0, 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=128'),
(70, 'Brayan', 'backup test image', '2023-06-30 19:16:06', 'Aucun', '/img/uploaded/Brayan_649f0dd6a3406.png', 0, 0, 0, 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=128'),
(71, 'Brayan', 'backup test image + hashtag', '2023-06-30 19:16:47', 'Culture', '/img/uploaded/Brayan_649f0dffa8ee2.png', 0, 0, 0, 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=128');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `identifiant` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `photo` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `identifiant`, `email`, `password`, `photo`, `date`) VALUES
(1, 'Boudjemeline', 'Haider', 'Brayan', 'boudjemelinehaider@gmail.com', 'test', 'https://cdn.discordapp.com/avatars/421042798221852674/2acd8383958a8e4b6d9fb6ad70ef725b.png?size=128', '2023-05-07 19:58:16'),
(3, 'Touahria', 'Yanis', 'IAiiRoZz', '', '$2y$10$2eG7Q3XeUZ9MEUgmixz/2.pChoB7TKtZF1E.qWtrTBpPil/aKKZxe', 'https://cdn.discordapp.com/avatars/547175019231313921/3c55f8f690e558e2c9fd9ea4dcec8fb0.png?size=128', '2023-05-07 21:16:01'),
(7, 'test', 'test', 'test3', 'test@test.test', '$2y$10$YfKfu3wF9xKZIEzUJvn90OWQb1GVnyeUOBdtDrHahFbGe3UdCr20a', '/img/profile_500.png', '2023-05-08 22:16:34'),
(8, ' ', ' ', ' ', ' ', ' ', '/img/profile_500.png', '2023-06-30 10:14:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
