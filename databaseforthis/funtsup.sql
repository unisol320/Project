-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 23 2020 г., 17:35
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `funtsup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(14, 'test1'),
(15, 'test2'),
(16, 'test3');

-- --------------------------------------------------------

--
-- Структура таблицы `category_startup`
--

CREATE TABLE `category_startup` (
  `category_id` int(11) DEFAULT NULL,
  `startup_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_startup`
--

INSERT INTO `category_startup` (`category_id`, `startup_id`) VALUES
(14, 336),
(15, 336),
(15, 337),
(16, 337),
(16, 338),
(15, 339),
(14, 340);

-- --------------------------------------------------------

--
-- Структура таблицы `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `galery`
--

INSERT INTO `galery` (`id`, `startup_id`, `photo`) VALUES
(254, 336, 'RubZB0OzIprvUMGAH2x1_NSwitch_Minecraft_image1600w.jpg'),
(255, 336, 'RubZB0OzIprvUMGAH2x1_NSwitch_Minecraft_image1600w1.jpg'),
(256, 336, 'RubZB0OzIprvUMGAH2x1_NSwitch_Minecraft_image1600w2.jpg'),
(257, 337, 'gncvHWjDXCm7Za0kH2x1_NSwitch_Minecraft_image1600w.jpg'),
(258, 337, 'gncvHWjDXCm7Za0kH2x1_NSwitch_Minecraft_image1600w1.jpg'),
(259, 337, 'gncvHWjDXCm7Za0kH2x1_NSwitch_Minecraft_image1600w2.jpg'),
(260, 338, 'PfcjLwzFp328WJ9eindex-hero-og.jpg'),
(261, 338, 'PfcjLwzFp328WJ9eindex-hero-og1.jpg'),
(262, 339, 'BUGrjCQkbRYL14DvH2x1_NSwitch_Minecraft_image1600w.jpg'),
(263, 340, 'rsNoLTWdAmEw3OF2H2x1_NSwitch_Minecraft_image1600w.jpg'),
(264, 340, 'rsNoLTWdAmEw3OF2H2x1_NSwitch_Minecraft_image1600w1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `startups`
--

CREATE TABLE `startups` (
  `id` int(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `startups`
--

INSERT INTO `startups` (`id`, `user_id`, `country`, `company`, `title`, `descriptions`, `status`) VALUES
(336, 65, 'Ukraine', 'test1', 'test1', '<p>1</p>', 1),
(337, 65, 'Ukraine', 'test2', 'test2', '<p>2</p>', 1),
(338, 65, 'Ukraine', 'test3', 'test3', '<p>3</p>', 1),
(339, 65, 'Ukraine', 'test4', 'test4', '<p>4</p>', 0),
(340, 65, 'Ukraine', 'test5', 'test5', '<p>5</p>', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role`) VALUES
(65, 'unisol', '$2y$10$7/CMElDkDTDeEzC7M3Hgr.FvKgqe3Ug99xRPfBAQAWFnhVQOqN8me', 'unisol1020@gmail.com', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_startups_map`
--

CREATE TABLE `user_startups_map` (
  `user_id` int(11) DEFAULT NULL,
  `startup_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `category_startup`
--
ALTER TABLE `category_startup`
  ADD KEY `FK_table1_category_id` (`category_id`),
  ADD KEY `FK_table1_startup_id` (`startup_id`);

--
-- Индексы таблицы `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_galery_startup_id` (`startup_id`);

--
-- Индексы таблицы `startups`
--
ALTER TABLE `startups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `FK_startups_user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user_startups_map`
--
ALTER TABLE `user_startups_map`
  ADD KEY `FK_user_startups_map_user_id` (`user_id`),
  ADD KEY `FK_user_startups_map_startup_id` (`startup_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT для таблицы `startups`
--
ALTER TABLE `startups`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category_startup`
--
ALTER TABLE `category_startup`
  ADD CONSTRAINT `FK_table1_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_table1_startup_id` FOREIGN KEY (`startup_id`) REFERENCES `startups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `FK_galery_startup_id` FOREIGN KEY (`startup_id`) REFERENCES `startups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `startups`
--
ALTER TABLE `startups`
  ADD CONSTRAINT `FK_startups_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_startups_map`
--
ALTER TABLE `user_startups_map`
  ADD CONSTRAINT `FK_user_startups_map_startup_id` FOREIGN KEY (`startup_id`) REFERENCES `startups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_startups_map_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
