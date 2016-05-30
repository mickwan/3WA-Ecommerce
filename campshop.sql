-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 30 Mai 2016 à 15:59
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
-- Structure de la table `adress`
--

CREATE TABLE IF NOT EXISTS `adress` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(7) unsigned NOT NULL,
  `name` varchar(31) NOT NULL,
  `number` int(7) NOT NULL,
  `pathway` varchar(15) NOT NULL,
  `city` varchar(63) NOT NULL,
  `country` varchar(31) NOT NULL,
  `zipcode` int(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `ref`, `stock`, `size`, `price`, `tax`, `description`, `name`, `weight`, `id_sub_cat`, `status`, `picture`) VALUES
(1, '00001', 5, '1.5', 65.99, 19.6, 'GRAND SAC À DOS HAUT ROULÉ\r\nBoucle fermeture latérale, bretelles matelassées, poche avant zip, 2 poches plaquées latérales\r', 'swamis', 1.5, 1, 1, 'public/images/products/accessories/bags/swamis.png'),
(2, '00002', 5, '1.5', 65.99, 19.6, 'Signature striped fabric liner\r\nPadded and fleece lined 15" laptop sleeve\r\nMagnetic strap closures with metal pin clips\r\nMa', 'little america', 1.5, 1, 1, 'public/images/products/accessories/bags/little_america_black.jpeg'),
(3, '00003', 5, '1.5', 65.99, 19.6, 'Signature striped fabric liner\r\nFully padded and fleece lined 15" laptop sleeve pocket\r\nMain compartment cinch top closure\r', 'little america', 1.5, 1, 1, 'public/images/products/accessories/bags/little_america_beige.jpeg'),
(4, '00004', 5, 'M', 25.99, 19.6, 'BONNET EN ACRYLIQUE\r\nbonnet en grosses mailles confectionné à la main. Fil torsadé aux couleurs contrastées. Détail d’étiqu', 'tête brûlée', 0.1, 5, 1, 'public/images/products/accessories/caps&hats/tet_brulee_black.jpg'),
(5, '00005', 5, 'M', 25.99, 19.6, 'BONNET EN ACRYLIQUE\r\nbonnet en grosses mailles confectionné à la main. Fil torsadé aux couleurs contrastées. Détail d’étiqu', 'tête brûlée', 0.1, 5, 1, 'public/images/products/accessories/caps&hats/tete_brulee.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `id_category`, `name`, `description`) VALUES
(1, 1, 'bags', ''),
(2, 1, 'wallets', ''),
(3, 1, 'watches', ''),
(4, 1, 'glasses', ''),
(5, 1, 'caps&hats', ''),
(6, 2, 'sweaters', ''),
(7, 2, 'jackets', ''),
(8, 2, 'shirts&t-shirts', ''),
(9, 2, 'pants', ''),
(10, 2, 'accessories', ''),
(11, 3, 'sweaters', ''),
(12, 3, 'jackets', ''),
(13, 3, 'shirts&t-shirts', ''),
(14, 3, 'pants', ''),
(15, 3, 'accessories', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adress`
--
ALTER TABLE `adress`
  ADD CONSTRAINT `adress_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
