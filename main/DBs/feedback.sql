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
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `nameOfSender` text NOT NULL COMMENT 'Имя отправителя',
  `commentary` text NOT NULL COMMENT 'Текст комментария',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата отправки комментария'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Комментарии';

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `nameOfSender`, `commentary`, `date`) VALUES
(1, 'Андрей', 'Тест0', '2019-05-25 23:28:47'),
(2, 'Илья', 'Тест1', '2019-05-25 23:41:43'),
(3, 'Василий', 'Тест1', '2019-05-25 23:42:00'),
(5, 'Дарья', 'Тест3', '2019-05-25 23:55:31'),
(6, 'Дарья', 'Тест4', '2019-05-25 23:55:51'),
(10, 'Александр', 'Т\r\nЕ\r\nС\r\nТ\r\n6', '2019-05-26 00:02:45'),
(11, 'Игорь', 'Тест 7', '2019-05-26 00:03:57'),
(12, 'Дмитрий', 'Наверное, чтобы создать отзывы к каждому товару в отдельности, нужно в базу данных с товарами внести столбец, содержащий в себе массив. Однако я без понятия, как это сделать', '2019-05-26 00:04:16'),
(13, 'tester1', 'finalTest', '2019-05-26 01:42:54');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
