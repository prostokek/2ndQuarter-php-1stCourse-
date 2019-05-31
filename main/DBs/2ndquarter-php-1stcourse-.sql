-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 31 2019 г., 16:08
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
(39, 23, 82, 'publicTester8', 1, 800, 'productsPics/minimalizm_svet_fon_pyatna_79685_1600x1200.jpg'),
(40, 2, 82, 'Honor View 20', 3, 600, './productsPics/huaweiHonorView20.jpg'),
(41, 1, 82, 'Samsung Galaxy S10', 2, 1000, './productsPics/samsungGalaxyS10.jpg');

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
(13, 'tester1', 'finalTest', '2019-05-26 01:42:54'),
(14, 'publicTest1', 'Public test', '2019-05-28 14:01:44'),
(15, 'newControllerTester1', 'New controller tester1', '2019-05-28 14:17:15');

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
(6, '/Gallery/cities-to-visit-once-20.jpg', 'cities-to-visit-once', 22),
(23, '/Gallery/samsungGalaxyS9.jpg', 'Samsung Galaxy S9', 0),
(24, '/Gallery/sakura_cvetenie.jpg', 'Цветение сакуры', 9),
(25, '/Gallery/more_ozero_ostrov_gory_118555_5932x3554.jpg', '123', 0);

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
(13, 'Test2', 2000, '/productsPics/abstraktsiya_geometriya_figury_tsveta_93400_2560x1600.jpg', '', ''),
(22, 'publicTester7', 700, 'productsPics/minimalizm_geometricheskij_pejzazh_124072_1600x1200.jpg', '', ''),
(23, 'publicTester8', 800, 'productsPics/minimalizm_svet_fon_pyatna_79685_1600x1200.jpg', '', '');

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
(264, 'tester9', 'test9', '2019-05-26 01:39:38', 2),
(265, 'tester10', 'tester10', '2019-05-26 01:41:49', 2),
(270, 'Tester1', 'test5', '2019-05-26 09:37:52', 2),
(279, 'Tester1', 'STest1', '2019-05-26 09:39:17', 1),
(280, 'Tester1', 'STest2', '2019-05-26 09:39:25', 1),
(281, 'Tester1', 'STest3', '2019-05-26 09:39:32', 1),
(282, 'Tester1', 'GTest1', '2019-05-26 09:40:58', 13),
(283, 'Tester1', 'GTest2', '2019-05-26 09:41:04', 13),
(284, 'publicTest1', 'Public test', '2019-05-28 14:01:58', 1);

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
(82, 'Administrator', 'admin', '985a4568fa416cdefe125887e7e02cf9', '2019-05-27 13:25:03', 'YES'),
(83, 'anonymous', 'saltTest1', '4f56b5a7df5f6ecb36b4dfd42f4be9e7', '2019-05-28 13:08:05', 'NO'),
(84, 'anonymous', 'test', '4b4e47738ba3b7aab65e421787b519ff', '2019-05-28 14:01:10', 'NO'),
(85, 'Tester', 'test2', '0df2118f81558aff1c4fcc9bad5d76f3', '2019-05-29 17:10:37', 'NO'),
(86, 'anonymous', 'registrationTester1', 'f3802ab89686836b8392212292c44420', '2019-05-29 23:02:03', 'NO'),
(87, 'regTester4', 'regTester4', 'a21a6406b0f195455cc2ed6e396e1c3f', '2019-05-29 23:16:36', 'NO'),
(88, 'regTester5', 'regTester5', '6e647a3a064b4714d51a62f50794360c', '2019-05-29 23:18:24', 'NO');

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
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`pic_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `productsfeedback`
--
ALTER TABLE `productsfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
