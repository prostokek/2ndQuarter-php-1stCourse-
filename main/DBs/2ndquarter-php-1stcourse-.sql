-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 04 2019 г., 16:46
-- Версия сервера: 5.7.23-log
-- Версия PHP: 7.2.10

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
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `productCatalogueId` int(11) NOT NULL COMMENT 'ID продукта в каталоге',
  `user_id` int(11) NOT NULL COMMENT 'id пользователя, которому принадлежит корзина',
  `product_name` varchar(64) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1' COMMENT 'Количество',
  `price` int(11) NOT NULL COMMENT 'Цена',
  `picPath` text NOT NULL COMMENT 'Путь к фотографии'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Корзина';

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `productCatalogueId`, `user_id`, `product_name`, `count`, `price`, `picPath`) VALUES
(112, 25, 95, 'MySQL5.7Test', 4, 370, 'productsPics/nebo_svet_abstrakciya_85064_1400x1050.jpg');

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
(16, 'MySQL5.7Tester1', 'Testing with new version of MySQL (5.6 => 5.7)', '2019-06-03 14:05:48'),
(17, 'MySQL5.7Tester1', 'Testing with new version of MySQL (5.6 => 5.7) [2]', '2019-06-03 14:10:22'),
(18, 'MySQL5.7Tester3', 'Testing with new version of MySQL (5.6 => 5.7) [3]', '2019-06-03 14:12:34'),
(19, 'MySQL5.7Tester5', 'sssssss', '2019-06-03 17:13:13');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'id заказа',
  `user_id` int(11) NOT NULL COMMENT 'id пользователя',
  `order_items` json NOT NULL,
  `commentary` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания заказа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы';

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_items`, `commentary`, `date`) VALUES
(1, 89, '[{\"count\": \"4\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test\"}, {\"count\": \"2\", \"price\": \"480\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test2\"}, {\"count\": \"3\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test3\"}]', 'TestSQLQuery', '2019-06-04 13:28:36'),
(2, 89, '[{\"count\": \"4\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test\"}, {\"count\": \"2\", \"price\": \"480\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test2\"}, {\"count\": \"3\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test3\"}]', 'Testing with CartClearing', '2019-06-04 13:34:26'),
(3, 89, '[{\"count\": \"4\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test\"}, {\"count\": \"2\", \"price\": \"480\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test2\"}, {\"count\": \"3\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test3\"}]', 'Testing CartClearing', '2019-06-04 13:35:36'),
(4, 89, '[{\"count\": \"2\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test\"}, {\"count\": \"1\", \"price\": \"480\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test2\"}]', 'Testing', '2019-06-04 13:36:26'),
(5, 89, '[{\"count\": \"1\", \"price\": \"370\", \"user_id\": \"89\", \"product_name\": \"MySQL5.7Test\"}]', 'Test', '2019-06-04 13:41:06');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL COMMENT 'Название товара',
  `price` mediumint(10) NOT NULL COMMENT 'Цена',
  `picPath` longtext NOT NULL COMMENT 'Путь к фото',
  `info` mediumtext COMMENT 'Краткая информация о товаре',
  `detailedInfo` longtext COMMENT 'Более полная информация о товаре'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Товары';

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `picPath`, `info`, `detailedInfo`) VALUES
(25, 'MySQL5.7Test', 370, 'productsPics/nebo_svet_abstrakciya_85064_1400x1050.jpg', NULL, NULL),
(26, 'MySQL5.7Test2', 480, 'productsPics/peyzazh_argentina_gory_ozero_patagonia_oblaka_priroda_82778_3264x2139.jpg', NULL, NULL),
(27, 'MySQL5.7Test3', 370, 'productsPics/abstraktsiya_geometriya_figury_tsveta_93400_1600x1200.jpg', NULL, NULL),
(28, 'adminRightsTest1', 620, 'productsPics/minimalizm_geometricheskij_pejzazh_124072_1600x1200.jpg', NULL, NULL);

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
(285, 'MySQL5.7Tester1', 'Test: adding feedback to a product; product_id = 25', '2019-06-03 14:38:00', 25),
(286, 'MySQL5.7Tester1', 'Test: adding feedback to a product; product_id = 26', '2019-06-03 14:38:48', 26);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(50) NOT NULL DEFAULT 'anonymous',
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата регистрации',
  `isAdmin` varchar(11) NOT NULL DEFAULT 'NO' COMMENT 'Администратор ли?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `date`, `isAdmin`) VALUES
(89, '__Admin__', 'admin', '985a4568fa416cdefe125887e7e02cf9', '2019-06-03 14:22:25', 'YES'),
(90, 'anonymous', 'notAdminTester1', '64d0480c78d466da261fc65ec52d52e1', '2019-06-03 14:55:31', 'NO'),
(91, 'Not an Admin, a Tester', 'notAdminTester2', '8e9e1e7a48c97956c00c132c964d5d44', '2019-06-03 15:01:53', 'NO'),
(95, 'Not Admin Tester 4', 'notAdminTester4', 'b7343f54855b235572e6e593ae880704', '2019-06-03 15:10:32', 'NO');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productsfeedback`
--
ALTER TABLE `productsfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id заказа', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `productsfeedback`
--
ALTER TABLE `productsfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
