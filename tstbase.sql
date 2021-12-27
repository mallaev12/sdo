-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2021 г., 07:12
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tstbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `del` int(11) NOT NULL DEFAULT 0,
  `alias` varchar(20) NOT NULL,
  `file_name` varchar(40) NOT NULL,
  `class_name` varchar(40) NOT NULL,
  `header` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `del`, `alias`, `file_name`, `class_name`, `header`) VALUES
(1, 0, 'pages', 'Mpage.php', 'Mpage', 'Страницы'),
(2, 0, 'main', 'Mmain.php', 'Mmain', 'Главная'),
(3, 0, 'users', 'Musers.php', 'Musers', 'Пользователи'),
(4, 0, 'notes', 'Mnotes.php', 'Mnotes', 'Записи');

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `del` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `userid` varchar(40) NOT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `del`, `name`, `date`, `userid`, `text`) VALUES
(1, 0, 'Vadim', '2000-06-14', 'Lavash', '159');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `del` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `val` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `del`, `name`, `val`) VALUES
(1, 0, 'systemName', 'Наша система'),
(2, 0, 'mainTemplate', 'page.html'),
(3, 0, 'loginTemplate', 'login.html'),
(4, 0, 'templateDir', 'template/');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `del` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) NOT NULL,
  `position` varchar(40) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `login` varchar(40) NOT NULL,
  `passw` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `del`, `name`, `position`, `date`, `login`, `passw`) VALUES
(1, 0, 'Vadim', 'Admin', '2000-06-14', 'Lavash', '159');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
