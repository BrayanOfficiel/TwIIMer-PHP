-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 18, 2023 at 09:39 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portail_restart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `enseignant` varchar(100) NOT NULL,
  `note` int(128) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `nom`, `enseignant`, `note`, `date`) VALUES
(1, 'Javascript', 'Louise PICOT', 3, '2023-05-04 11:01:06'),
(2, 'PHP/MySQL', 'Alexis BOUGY', 20, '2023-05-04 11:01:06'),
(3, 'HTML / CSS / Mise en ligne', 'Louise PICOT', 17, '2023-05-05 14:54:50'),
(4, 'Data & IOT', 'jsp', 10, '2023-05-05 16:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(128) NOT NULL,
  `tweet` varchar(2048) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int(10) UNSIGNED NOT NULL,
  `comments` int(10) UNSIGNED NOT NULL,
  `retweets` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `author`, `tweet`, `date`, `likes`, `comments`, `retweets`) VALUES
(1, 'Brayan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-05-07 21:13:57', 0, 0, 0),
(2, 'new', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2023-05-07 21:18:17', 0, 0, 0),
(4, 'Brayan', ' fv', '2023-05-21 21:54:06', 0, 0, 0),
(5, 'Zakariiz', 'je sais pas vous mais les arabes ils sont tous trop sympa wsh ils te nourrissent et t\'accueillent tu peux même dodo chez eux wlh vive les rebeus <3', '2023-05-22 14:43:42', 0, 0, 0),
(10, 'Zakariiz', 'ghfdjkkfghjk', '2023-05-22 14:56:05', 0, 0, 0),
(11, 'Zakariiz', 'kon,', '2023-05-22 14:58:32', 0, 0, 0),
(12, 'Zakariiz', 'edfzf', '2023-05-22 14:59:49', 0, 0, 0),
(13, 'Zakariiz', 'gedsf', '2023-05-22 15:03:13', 0, 0, 0),
(14, 'IAiiRoZz', 'Wesh\r\n', '2023-06-02 01:40:35', 0, 0, 0),
(15, 'Brayan', 'test', '2023-06-12 00:11:26', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `identifiant`, `email`, `password`, `photo`, `date`) VALUES
(1, 'Boudjemeline', 'Haider', 'Brayan', 'boudjemelinehaider@gmail.com', 'test', 'img/profile_500.png', '2023-05-07 19:58:16'),
(2, 'test', 'test', 'test', '', 'test', '/img/profile_500.png', '2023-05-07 19:59:19'),
(3, 'test', 'test', 'AIRROZ', '', 'test', '/img/profile_500.png', '2023-05-07 21:16:01'),
(4, 'test', 'test', 'new', '', 'test', '/img/profile_500.png', '2023-05-07 21:17:53'),
(6, 'test', 'test', 'test2', '', 'test', '/img/profile_500.png', '2023-05-08 16:42:43'),
(7, 'test3', 'test3', 'test3', 'test3@test3.test3', 'test3', 'https://img.freepik.com/icones-gratuites/netflix_318-566093.jpg', '2023-05-08 22:16:34'),
(8, 'test9', 'test9', 'test9', 'test9@test9.test9', 'test9', '/img/profile_500.png', '2023-05-18 21:23:11'),
(9, 'de RIBIER-MAZOUNI', 'Zakary', 'Zakariiz', 'mazounizakary75@gmail.com', 'azertyuiop', '/img/profile_500.png', '2023-05-22 14:40:49'),
(10, 'TOUAHRIA', 'Yanis', 'IAiiRoZz', 'yanistouahria84@gmail.com', 'Skala2019', '/img/profile_500.png', '2023-06-02 01:39:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
