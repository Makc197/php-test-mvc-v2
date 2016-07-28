-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 27 2016 г., 17:42
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test-mvc-v2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'book',
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` double NOT NULL,
  `author` varchar(200) NOT NULL,
  `numpages` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `type`, `title`, `description`, `price`, `author`, `numpages`) VALUES
(2, 'book', 'Книга №2', 'Описание книги №2', 123210032433, 'Автор книги №2', '222');

-- --------------------------------------------------------

--
-- Структура таблицы `cds`
--

CREATE TABLE `cds` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'cd',
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` double NOT NULL,
  `author` varchar(200) NOT NULL,
  `playlenght` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cds`
--

INSERT INTO `cds` (`id`, `type`, `title`, `description`, `price`, `author`, `playlenght`) VALUES
(1, 'cd', 'CD №1', 'Описание CD1', 3155, 'Автор CD1', 0),
(3, 'cd', '123', '123123sdgds', 12213, '123123', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'product',
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `type`, `title`, `description`, `price`) VALUES
(1, 'product', 'Товар №1', 'Описание товара №1', 114545000),
(3, 'product', '1111111111', '222222222222222', 333333317812224),
(4, 'product', '123123', '123123123123123', 123),
(6, 'product', '123123', '123123123123123', 123),
(7, 'product', '123123', '123123123123123', 123),
(8, 'product', '123123', '123123123123123', 123),
(9, 'product', '123123', '123123123123123', 123),
(10, 'product', '123123', '123123123123123', 123),
(11, 'product', '123123', '123123123123123', 123),
(12, 'product', '123123', '123123123123123', 123),
(13, 'product', '123123', '123123123123123', 123),
(14, 'product', '123123', '123123123123123', 123),
(15, 'product', '123123', '123123123123123', 123),
(16, 'product', '123123', '123123123123123', 123),
(17, 'product', '123123', '123123123123123', 123),
(18, 'product', '123123', '123123123123123', 123),
(19, 'product', '123123', '123123123123123', 123),
(20, 'product', '123123', '123123123123123', 123),
(21, 'product', '123123', '123123123123123', 123),
(22, 'product', '123123', '123123123123123', 123),
(23, 'product', '123123', '123123123123123', 123),
(24, 'product', '123123', '123123123123123', 123),
(25, 'product', '123123', '123123123123123', 123),
(26, 'product', '123123', '123123123123123', 123),
(27, 'product', '123123', '123123123123123', 123),
(28, 'product', '123123', '123123123123123', 123),
(29, 'product', '123123', '123123123123123', 123),
(30, 'product', '123123', '123123123123123', 123),
(31, 'product', '123123', '123123123123123', 123),
(32, 'product', '123123', '123123123123123', 123),
(33, 'product', '123123', '123123123123123', 123),
(34, 'product', '123123', '123123123123123', 123),
(35, 'product', '123123', '123123123123123', 123),
(36, 'product', '123123', '123123123123123', 123),
(37, 'product', '123123', '123123123123123', 123),
(38, 'product', '123123', '123123123123123', 123),
(39, 'product', '123123', '123123123123123', 123),
(40, 'product', '123123', '123123123123123', 123),
(41, 'product', '123123', '123123123123123', 123),
(42, 'product', '123123', '123123123123123', 123),
(43, 'product', '123123', '123123123123123', 123),
(44, 'product', '123123', '123123123123123', 123),
(45, 'product', '123123', '123123123123123', 123),
(46, 'product', '123123', '123123123123123', 123),
(47, 'product', '123123', '123123123123123', 123),
(48, 'product', '123123', '123123123123123', 123),
(49, 'product', '123123', '123123123123123', 123),
(50, 'product', '123123', '123123123123123', 123),
(51, 'product', '123123', '123123123123123', 123),
(52, 'product', '123123', '123123123123123', 123),
(53, 'product', '123123', '123123123123123', 123),
(54, 'product', '123123', '123123123123123', 123),
(55, 'product', '123123', '123123123123123', 123),
(56, 'product', '123123', '123123123123123', 123),
(57, 'product', '123123', '123123123123123', 123),
(58, 'product', '123123', '123123123123123', 123),
(59, 'product', '123123', '123123123123123', 123),
(60, 'product', '123123', '123123123123123', 123),
(61, 'product', '123123', '123123123123123', 123),
(62, 'product', '123123', '123123123123123', 123),
(63, 'product', '123123', '123123123123123', 123),
(64, 'product', '123123', '123123123123123', 123),
(65, 'product', '123123', '123123123123123', 123),
(66, 'product', '123123', '123123123123123', 123),
(67, 'product', '123123', '123123123123123', 123),
(68, 'product', '123123', '123123123123123', 123),
(69, 'product', '123123', '123123123123123', 123),
(70, 'product', '123123', '123123123123123', 123),
(71, 'product', '123123', '123123123123123', 123),
(72, 'product', '123123', '123123123123123', 123),
(73, 'product', '123123', '123123123123123', 123),
(74, 'product', '123123', '123123123123123', 123),
(75, 'product', '123123', '123123123123123', 123),
(76, 'product', '123123', '123123123123123', 123);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `forename` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `forename`, `surname`, `username`, `password`, `token`, `role_id`) VALUES
(1, 'Админ', 'Админов', 'admin', 'admin', 'c5d290771e14868220de8b24f06ca94e', 2),
(2, 'Юзер1', 'Юзеров', 'user1', '123', 'bd40bcb37e77bf8b00ab9835de34c225', 2),
(3, 'Юзер2', 'Юзеров', 'user2', '123', 'bd40bcb37e77bf8b00ab9835de34c225', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_code` varchar(50) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_code`, `role_name`) VALUES
(1, 'user', 'Пользователь'),
(2, 'admin', 'Администратор');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cds`
--
ALTER TABLE `cds`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `cds`
--
ALTER TABLE `cds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
