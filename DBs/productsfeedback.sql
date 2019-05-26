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
-- Структура таблицы `productsfeedback`
--

CREATE TABLE `productsfeedback` (
  `id` int(11) NOT NULL,
  `nameOfSender` text NOT NULL COMMENT 'Имя отправителя',
  `commentary` text NOT NULL COMMENT 'Текст комментария',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата отправки комментария',
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Комментарии к товарам (отдельно к каждому)';

--
-- Дамп данных таблицы `productsfeedback`
--

INSERT INTO `productsfeedback` (`id`, `nameOfSender`, `commentary`, `date`, `product_id`) VALUES
(1, 'Тестер1', 'Тест1', '2019-05-26 01:22:47', 2),
(262, 'tester8', 'test2', '2019-05-26 01:39:13', 2),
(263, 'tester9', 'test9', '2019-05-26 01:39:38', 2),
(264, 'tester9', 'test9', '2019-05-26 01:39:38', 2),
(265, 'tester10', 'tester10', '2019-05-26 01:41:49', 2),
(266, 'tester10', 'tester10', '2019-05-26 01:41:49', 2),
(267, 'tester10', 'tester10', '2019-05-26 01:41:49', 2),
(268, 'tester10', 'tester10', '2019-05-26 01:41:49', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `productsfeedback`
--
ALTER TABLE `productsfeedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `productsfeedback`
--
ALTER TABLE `productsfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
