-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 09 Şub 2025, 08:48:42
-- Sunucu sürümü: 5.7.43-log
-- PHP Sürümü: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dfdgdfg54fd4`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `earn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_earnings` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `tokens`
--

INSERT INTO `tokens` (`id`, `name`, `deposit`, `earn`, `daily_earnings`, `image_url`, `link`) VALUES
(3, 'ETHEREUM', 'Ethereum', 'ETH', '5', 'https://cryptologos.cc/logos/ethereum-eth-logo.svg?v=040', 'Jk'),
(4, 'BNB', 'BNB', 'bnb', '5', 'https://cryptologos.cc/logos/bnb-bnb-logo.png?v=040', 'Nsmks'),
(5, 'SHIBA INU', 'Shiba', 'shiba', '5', 'https://cryptologos.cc/logos/shiba-inu-shib-logo.png?v=040', 'shib'),
(6, 'USDT ERC20 ', 'USDT ERC20 ', 'usdt erc20', '5', 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=040', 'Jsjs'),
(7, 'USDC ', 'USDC', 'usdc', '5', 'uploads/usd-coin-usdc-logo.png', 'Jskks'),
(8, 'UNİSWAP', 'UNI', 'uni', '5', 'uploads/uniswap-uni-logo.png', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
