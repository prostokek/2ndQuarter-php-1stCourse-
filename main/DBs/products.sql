-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2019 г., 04:43
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `2ndquarter-php-1stcourse-`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL COMMENT 'Название товара',
  `price` mediumint(10) NOT NULL COMMENT 'Цена',
  `picPath` longtext NOT NULL COMMENT 'Путь к фото',
  `info` text NOT NULL COMMENT 'Краткая информация о товаре',
  `detailedInfo` longtext NOT NULL COMMENT 'Более полная информация о товаре'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товары';

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `picPath`, `info`, `detailedInfo`) VALUES
(1, 'Samsung Galaxy S10', 1000, './productsPics/samsungGalaxyS10.jpg', 'Диагональ (дюйм): 6.1\r\nРазрешение (пикс): 3040x1440\r\nВстроенная память (Гб): 128\r\nФотокамера (Мп): 12 + 12 + 16 (тройная)\r\nОптический зум: x2', 'А здесь некоторое более подробное описание, которое нет смысла сюда копировать'),
(2, 'Honor View 20', 600, './productsPics/huaweiHonorView20.jpg', 'Диагональ (дюйм): 6.4\r\nРазрешение (пикс): 2310x1080\r\nВстроенная память (Гб): 128\r\nФотокамера (Мп): 48 + 3D-камера TOF\r\nПроцессор: Huawei Kirin 980 с двойным нейромодулем', 'А здесь некоторое более подробное описание, которое нет смысла сюда копировать'),
(12, 'Test1', 1000, '/productsPics/gory_reka_sneg_zima_93245_1024x768.jpg', '', ''),
(13, 'Test2', 2000, '/productsPics/abstraktsiya_geometriya_figury_tsveta_93400_2560x1600.jpg', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
