# drop database bookstore;
# drop database administrator;
# create databases

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Create a database (if not exists)
CREATE DATABASE IF NOT EXISTS `administrator`;

USE administrator;
CREATE TABLE `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
  (1, 'admin', 'b9f385c68320e27d5a4ea0618eef4a94');

ALTER TABLE `users` ADD UNIQUE KEY `username` (`username`);



-- Create a database (if not exists)
CREATE DATABASE IF NOT EXISTS `bookstore`;

USE bookstore;
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL
);

INSERT INTO books (title, author, image, description) VALUES 
  ('Wireless Router with AiMesh', 'ASUS RT-AX53U', 'Router.Jpeg', 'Periode promo ASUS RT-AX53U berlangsung dari 7 hingga 31 Agustus 2023, dengan garansi resmi 3 tahun dari ASUS Indonesia. Router WiFi 6 ini menawarkan kecepatan total hingga 1800Mbps, dengan 574Mbps di 2.4GHz dan 1201Mbps di 5GHz. Dilengkapi dengan teknologi MU-MIMO, OFDMA, serta 4 port Gigabit (1 WAN, 3 LAN), RT-AX53U mendukung koneksi lebih efisien dan cepat. Fitur AiProtection dan kontrol orang tua memastikan keamanan dan pengelolaan penggunaan jaringan yang optimal.'),