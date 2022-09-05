-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Лип 24 2022 р., 21:46
-- Версія сервера: 5.5.62
-- Версія PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблиці `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_cart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `id_product`, `id_author`, `text`, `date`) VALUES
(29, 50, 7, '<p>Ціна завищена, а так дуже зручні</p>', '2022-01-20 09:03:11'),
(30, 49, 16, '<p>sfsdfsfdsfd</p>', '2022-07-23 00:11:12');

-- --------------------------------------------------------

--
-- Структура таблиці `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_buyer` int(11) NOT NULL,
  `id_products` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_index` int(11) NOT NULL,
  `execute` int(1) DEFAULT NULL,
  `date` datetime NOT NULL,
  `counts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `orders`
--

INSERT INTO `orders` (`id`, `id_buyer`, `id_products`, `lastname`, `firstname`, `phone`, `address`, `post_index`, `execute`, `date`, `counts`, `sizes`) VALUES
(26, 7, '50, 49', 'zxc', 'sadfsdf', '063-855-19-22', 'zxc', 123, 1, '2022-01-20 00:28:35', '2, 1', 'XL, M'),
(27, 7, '50', 'dgfs', 'sdgf', '098-987-98-98', 'dfgsdfg', 132, NULL, '2022-01-20 00:29:29', '1', 'XL'),
(28, 7, '46', 'rafsafsd', 'Pavlo', '987-987-98-98', 'rgdfgg', 98, NULL, '2022-01-20 10:45:47', '1', 'M'),
(29, 7, '47', 'fgdagfd', 'dfggdf', '987-987-98-98', 'sdfsfd', 12, NULL, '2022-01-20 10:55:53', '1', 'M'),
(30, 7, '48, 47', 'qweqwe', 'adfsasfd', '987-987-98-98', '234234', 2342, 1, '2022-01-20 11:23:54', '2, 1', 'XS, L'),
(31, 7, '47, 49', 'zxc', 'sdfdsf', '063-855-19-22', 'zxc', 541, 1, '2022-02-05 13:38:45', '1, 1', 'S, M'),
(32, 14, '41', 'zxc', 'Pavlo', '063-855-19-22', 'zxc', 123, 1, '2022-06-13 14:19:24', '1', 'XS'),
(33, 16, '50', 'zxc', 'sfdfsd', '063-855-19-22', 'zxc', 123, 1, '2022-07-23 00:39:09', '1', 'XL'),
(34, 16, '45', 'zxc', 'qwe', '063-855-19-22', 'zxc', 123, 1, '2022-07-23 00:53:04', '1', 'L');

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `kind` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `datetime_last_edit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `title`, `size`, `price`, `description`, `kind`, `gender`, `photo`, `datetime`, `datetime_last_edit`) VALUES
(32, 'Gucci жакардова куртка', 'XS, S, M, L, XL, 2XL, 3XL', 1300, '<p><strong>Gucci </strong>жаккардовая куртка с узором GG</p><h4>Подробнее о товаре</h4><p>Жаккардовая куртка \'GG\' от Gucci (Гуччи).</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Хлопок 100%</p><p>&nbsp;</p>', 'Одяг', 'Для чоловіків', '32_61e76a8cf1298', '2022-01-19 04:34:04', '2022-07-23 00:56:13'),
(33, 'Palm Angels худи с принтом', 'XS, S', 460, '<p>Новый сезон</p><p><strong>Palm Angels </strong>худи с принтом</p><p>Трикотаж с петлями на изнаночной стороне, эффект разбрызганной краски, принт с логотипом на груди, длинные рукава, манжеты в рубчик, прямой подол и карман-муфта.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Наружный Материал: Полиэстер 100%, Хлопок 100%</p><p>Отделка: Хлопок 94%, Спандекс/Эластан 6%</p>', 'Одяг', 'Unisex', '33_61e770d8b95c0', '2022-01-19 05:00:56', '2022-01-19 17:42:11'),
(34, 'Balenciaga кросівки Phantom', 'XS, L, XL', 775, '<p>Новый сезон</p><p><strong>Balenciaga </strong>кроссовки Phantom</p><p>Вставки, сетка, задник с логотипом, нашивка с логотипом на язычке, логотип сбоку, закругленный носок и шнуровка спереди. Цвет: белый.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Наружный Материал: Ткань 100%</p><p>Подошва: Резина 100%</p><p>Подкладка: Ткань 100%</p>', 'Взуття', 'Для чоловіків', '34_61e771976bc58', '2022-01-19 05:04:07', '2022-01-19 17:41:57'),
(36, 'Off-White кардиган ', 'XS, S, L', 522, '<p>Новый сезон</p><p><strong>Off-White </strong>кардиган с логотипом</p><p>Отделка в рубчик, логотип в технике интарсия, V-образный вырез, приспущенные плечи, застежка на пуговицах спереди и длинные рукава.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Хлопок 57%, Полиамид 43%</p><h4>Рекомендации по уходу</h4><p>Только сухая чистка</p><p>Артикул бренда: OWHB026S22KNI0011003</p><h3>Модель и образ</h3><p>Рост модели: 1,79 м. Размер на модели: 40 (IT)</p><p>&nbsp;</p>', 'Одяг', 'Для жінок', '36_61e87501071c4', '2022-01-19 05:14:01', '2022-01-19 23:30:57'),
(37, 'Alexander McQueen футболка ', 'XS, S, M', 193, '<p>Новый сезон</p><p><strong>Alexander McQueen </strong>укороченная футболка с логотипом</p><p>Принт с логотипом на груди, круглый вырез, короткие рукава и прямой подол. Цвет: серый.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Хлопок 89%, Полиамид 10%, Эластан 1%</p><h4>Рекомендации по уходу</h4><p>Машинная стирка</p><p>Артикул бренда: 687014QZAFG</p><h3>Модель и образ</h3><p>Рост модели: 1,79 м. Размер на модели: 38 (IT)</p><p>&nbsp;</p>', 'Одяг', 'Для жінок', '37_61e874d05740d', '2022-01-19 05:15:33', '2022-01-19 23:30:08'),
(41, 'Acne Studios кепка ', 'XS, M, XL', 103, '<p>Новый сезон</p><p><strong>Acne Studios </strong>кепка с вышивкой</p><p>Вышитая надпись, закругленный козырек и регулируемый дизайн.</p><h4>Состав</h4><p>Хлопок 100%</p><h4>Рекомендации по уходу</h4><p>Только сухая чистка</p>', 'Аксесуари', 'Unisex', '41_61e85827c485d', '2022-01-19 21:27:51', '2022-01-19 23:29:42'),
(44, 'Gucci джемпер ', 'XS, S, M', 1111, '<p>Новый сезон</p><p><strong>Gucci </strong>джемпер с логотипом Interlocking G</p><p>Трикотажный материал, логотип GG, контрастная отделка, круглый вырез, длинные рукава, манжеты в рубчик и подол в рубчик. Цвет: красный.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Шерсть 98%, Эластан 1%, Полиамид 1%</p><h4>Рекомендации по уходу</h4><p>Только сухая чистка</p>', 'Одяг', 'Для жінок', '44_61e87984b9785', '2022-01-19 23:50:12', '2022-01-20 00:32:05'),
(45, 'Dolce & Gabbana Kids бомбер', 'S, L', 510, '<p>Новый сезон</p><p><strong>Dolce &amp; Gabbana Kids </strong>бомбер с логотипом DG</p><p>Нашивка с логотипом спереди, аппликация, воротник-стойка, застежка на пуговицах спереди, длинные рукава, два прорезных кармана по бокам, эластичные манжеты и эластичный подол.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Хлопок 95%, Спандекс/Эластан 5%</p>', 'Одяг', 'Для хлопчиків', '45_61e879fd7f1ec', '2022-01-19 23:52:13', '2022-01-19 23:52:13'),
(46, 'Fendi ремень ', 'XS', 550, '<p><strong>Fendi </strong>ремень с логотипом FF</p><p>Золотистая фурнитура, логотип FF, прорезанные отверстия и регулируемый дизайн. Цвет: серый.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Кожа Теленка 100%</p>', 'Аксесуари', 'Для жінок', '46_61e87af3aa20b', '2022-01-19 23:56:19', '2022-07-23 00:55:02'),
(47, 'Giorgio Armani пальто оверсайз', 'S, M, L', 1555, '<p><strong>Giorgio Armani </strong>пальто оверсайз</p><p>Тонкая вязка, длинные рукава, потайная пуговичная застежка спереди и длина миди.</p><p>Страна производства: Италия</p><h4>Состав</h4><p>Подкладка: Полиэстер 100%</p><p>Наружный Материал: Шерсть 52%, Альпака 48%</p><h4>Рекомендации по уходу</h4><p>Только сухая чистка</p>', 'Одяг', 'Для чоловіків', '47_61e87ba363e2b', '2022-01-19 23:59:15', '2022-01-20 10:54:26'),
(48, 'Jacquemus топ', 'XS', 283, '<p><strong>Jacquemus </strong>топ с короткими рукавами</p><h4>Подробнее о товаре</h4><ul><li>бежевый</li><li>хлопковая смесь</li><li>классический воротник</li><li>короткие рукава</li><li>укороченная длина</li><li>застежка на пуговицы</li></ul><p>Страна производства: Франция</p><h4>Состав</h4><p>Хлопок 83%, Полиамид 17%&nbsp;</p>', 'Одяг', 'Для жінок', '48_61e87c13aff57', '2022-01-20 00:01:07', '2022-01-20 00:01:07'),
(49, 'Bally сумка ', 'M, 3XL', 387, '<p><strong>Ball </strong>сумка на плечо Ranys</p><p>Нашивка с логотипом спереди, регулируемый ремень на плечо и застежка на молнии сверху.</p><h4>Состав</h4><p>Наружный Материал: Нейлон 100%, Кожа 100%</p><p>Подкладка: Нейлон 100%</p>', 'Аксесуари', 'Для чоловіків', '49_61e87cdc5b727', '2022-01-20 00:04:28', '2022-07-23 00:57:23'),
(50, 'adidas YEEZY кроссовки ', 'L, XL', 1000, '<p>Positively Conscious</p><p><strong>adidas YEEZY </strong>кроссовки Yeezy Boost 350 V2 True Form</p><p>Идеальным дополнением к коллекции любого сникерхеда станут серые кроссовки Yeezy Boost 350 V2 True Form от adidas (Адидас). Модель выполнена в расцветке True Form, релиз которой состоялся в марте 2019 года. Расцветка была доступна только в Европе и России. Текстильный верх Primeknit с контрастными боковыми полосками оранжевого цвета, промежуточная подошва, закругленный носок, шнуровка спереди, стелька с логотипом, петля для подтягивания сзади. Этот товар представлен на Stadium Goods — маркетплейсе, где можно найти самые редкие модели кроссовок и вещи из последних коллабораций. О подлинности можно не беспокоиться — все товары проходят проверку перед размещением на сайте. Лимитированная модель, выпущенная 16 марта 2019 года.</p><h4>Состав</h4><p>Подкладка: Полиэстер 100%</p><p>Наружный Материал: Металлические Волокна 100%, Нейлон 100%</p><p>Подошва: Резина 100%</p>', 'Взуття', 'Для жінок', '50_61e87da35de01', '2022-01-20 00:07:47', '2022-07-23 00:59:11');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `lastname`, `firstname`, `phone`, `access`) VALUES
(9, 'qwe@qwe', '25d55ad283aa400af464c76d713c07ad', 'zxc', 'zxc', '063-855-19-22', NULL),
(10, 'ashot@ashot', '25d55ad283aa400af464c76d713c07ad', 'Ашот', 'Ашот', '112-345-69-87', NULL),
(11, 'zcx@zxc', '25d55ad283aa400af464c76d713c07ad', 'zxc', 'zxc', '063-855-19-22', NULL),
(12, 'zxc@zxc', '25d55ad283aa400af464c76d713c07ad', 'zxc', 'Pavlo', '063-855-19-22', NULL),
(13, 'pasha@xn--as-ioc', '25d55ad283aa400af464c76d713c07ad', 'zxc', 'ячс', '063-855-19-22', NULL),
(14, 'pasha@asq', '25d55ad283aa400af464c76d713c07ad', 'zxc', 'Pavlo', '063-855-19-22', NULL),
(16, 'pasha@asd', 'f5bb0c8de146c67b44babbf4e6584cc0', 'qwe', 'Pavlo', '063-855-19-22', 1);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблиці `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
