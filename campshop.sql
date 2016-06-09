-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 09 Juin 2016 à 10:31
-- Version du serveur: 5.5.47-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `campshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(7) unsigned NOT NULL,
  `name` varchar(31) NOT NULL,
  `number` int(7) NOT NULL,
  `pathway` varchar(123) NOT NULL,
  `city` varchar(63) NOT NULL,
  `country` varchar(31) NOT NULL,
  `zipcode` int(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`id`, `id_user`, `name`, `number`, `pathway`, `city`, `country`, `zipcode`, `type`) VALUES
(3, 7, 'momo', 1, 'rue du taf', 'Strasbourg', 'France', 67000, '0');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(7) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0:non validé / 1:validé user / 2:validé admin',
  `price` float NOT NULL DEFAULT '0',
  `nb_products` int(7) NOT NULL DEFAULT '0',
  `weight` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `description` varchar(123) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'accessories', ''),
(2, 'men', ''),
(3, 'women', '');

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_author` int(7) unsigned DEFAULT NULL,
  `id_product` int(7) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0:attente / 1:validé / 2:refusé',
  PRIMARY KEY (`id`),
  KEY `id_author` (`id_author`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `feedback`
--

INSERT INTO `feedback` (`id`, `id_author`, `id_product`, `content`, `date`, `status`) VALUES
(1, 6, 1, 'voila voila', '2016-06-07 11:54:21', 2),
(2, 4, 3, 'houlaaaaaa', '2016-06-07 11:54:21', 2),
(3, 6, 1, 'coucou c''est moi FEEDBACK =)', '2016-06-07 12:46:21', 1),
(4, 7, 1, 'je suis un commentaire', '2016-06-08 13:58:53', 0);

-- --------------------------------------------------------

--
-- Structure de la table `link_cart_product`
--

CREATE TABLE IF NOT EXISTS `link_cart_product` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_cart` int(7) unsigned NOT NULL,
  `id_product` int(7) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cart` (`id_cart`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(63) NOT NULL,
  `stock` int(7) NOT NULL,
  `size` varchar(3) NOT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `description` varchar(123) NOT NULL,
  `name` varchar(15) NOT NULL,
  `weight` float NOT NULL,
  `id_sub_cat` int(7) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0:indispo / 1:dispo',
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sub_cat` (`id_sub_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `ref`, `stock`, `size`, `price`, `tax`, `description`, `name`, `weight`, `id_sub_cat`, `status`, `picture`) VALUES
(1, '00001', 10, '0', 69.99, 19.6, 'je suis un sac', 'sac a dos', 5, 1, 1, 'public/images/little_america_beige.jpeg'),
(2, '00002', 10, '0', 69.99, 19.6, 'je suis une montre', 'montre', 1, 3, 1, 'public/images/products/accessories/watches/kenzi_leather.jpg'),
(3, '00003', 10, '0', 69.99, 19.6, 'je suis une lunette', 'lunette', 1, 4, 1, 'public/images/products/accessories/glasses/shelter.png'),
(4, '00004', 10, '0', 69.99, 19.6, 'je suis un porte-monaie', 'porte-monaie', 1, 2, 1, 'public/images/products/accessories/wallets/showtime.png'),
(5, '00005', 10, 'M', 69.99, 19.6, 'je suis un bonnet', 'bonnet', 1, 5, 1, 'public/images/products/accessories/caps&hats/Nouveau dossier 2/milo.jpg'),
(6, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(7, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(8, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(9, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(10, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(11, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(12, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg'),
(13, '00006', 10, 'M', 69.99, 19.6, 'je suis un pull', 'pull', 1, 6, 1, 'public/images/pull.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(7) unsigned DEFAULT NULL,
  `name` varchar(31) NOT NULL,
  `description` varchar(123) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `id_category`, `name`, `description`) VALUES
(1, 1, 'Bags', ''),
(2, 1, 'wallets', ''),
(3, 1, 'watches', ''),
(4, 1, 'glasses', ''),
(5, 1, 'caps & hats', ''),
(6, 2, 'sweaters', ''),
(8, 2, 'shirts & t-shirts', ''),
(9, 2, 'pants', ''),
(10, 2, 'accessories', ''),
(11, 3, 'sweaters', ''),
(12, 3, 'jackets', ''),
(13, 3, 'shirts & t-shirts', ''),
(14, 3, 'pants', ''),
(15, 3, 'accessories', ''),
(16, 2, 'Sous cat ', 'new newnenw ');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(31) NOT NULL,
  `firstname` varchar(63) NOT NULL,
  `lastname` varchar(63) NOT NULL,
  `email` varchar(123) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `birth_date` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `sex` varchar(31) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:user / 1:admin',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:inactif / 1:actif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `firstname`, `lastname`, `email`, `password`, `register_date`, `birth_date`, `phone`, `sex`, `admin`, `status`) VALUES
(4, 'test', 'test', 'test', 'test@test.fr', '$2y$08$0qBo6z48Ljz2/VAXVvQvQe106MYCZP6hi0KguP2pnAqjQmkAYz/pm', '2016-06-02 11:43:19', '1990-11-29', '0688330599', 'W', 0, 1),
(5, 'mickwan', 'mickael', 'rinner', 'mickael.rinner@hotmail.fr', '$2y$08$Kt2LF.bt0fnebG3PbOdyaeMFezNkKkH6NYlYEOZezi87OWMShme3m', '2016-06-02 11:44:14', '1990-11-29', '0688330599', 'M', 1, 1),
(6, 'Arteast', 'thomas', 'loegel', 'arteast.academy@gmail.com', '$2y$08$ZtSu9f6l2rSZ8RAmxvLlmOxB9.o914eAeO89QOBb78lX9qoC4i8Qe', '2016-06-06 12:51:35', '1986-11-02', '0771719925', 'M', 0, 1),
(7, 'momo', 'momo', 'momo', 'momo@momo.fr', '$2y$08$KE/UywIyGnAhPfcIu2etZOowXy2CuEis1OR0vmvLzXR.SwlaRO/1u', '2016-06-08 13:30:26', '1990-11-29', '0688330599', 'M', 0, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `link_cart_product`
--
ALTER TABLE `link_cart_product`
  ADD CONSTRAINT `link_cart_product_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_cart_product_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_sub_cat`) REFERENCES `sub_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
