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
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `pic_id` int(11) NOT NULL,
  `path` longtext NOT NULL COMMENT 'Путь к картинке',
  `name` text NOT NULL,
  `viewCount` int(10) NOT NULL DEFAULT '0' COMMENT 'Количество просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`pic_id`, `path`, `name`, `viewCount`) VALUES
(1, '/Gallery/ru-city-780.jpg', 'ru-city-780', 30),
(2, '/Gallery/image0019.jpg', 'image0019', 5),
(3, '/Gallery/Tokyo_Tower_and_Tokyo_Sky_Tree_2011_January.jpg', 'Tokyo', 15),
(6, '/Gallery/cities-to-visit-once-20.jpg', 'cities-to-visit-once', 13),
(23, '/Gallery/samsungGalaxyS9.jpg', 'Samsung Galaxy S9', 0),
(24, '/Gallery/sakura_cvetenie.jpg', 'Цветение сакуры', 9),
(25, '/Gallery/more_ozero_ostrov_gory_118555_5932x3554.jpg', '123', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`pic_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
