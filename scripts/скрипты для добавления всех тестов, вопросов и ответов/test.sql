-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 27 2017 г., 15:48
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `analysis_site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`, `weight`, `comment`) VALUES
(1, 'activity_levels', 3, ''),
(2, 'aspects', 1.5, ''),
(3, 'platonic_solids', 0.5, ''),
(4, 'elements', 0.15, ''),
(5, 'sence', 1, ''),
(6, 'taste', 0.25, ''),
(7, 'colors', 1, 'Colors testing'),
(8, 'antropometric', 0.4, 'Тестирование по антропометрическим данным'),
(9, 'Preferences_of_school_subjects', 1, 'Выявление индивидуально-типологических различий на основе предпочтения школьных предметов.'),
(10, 'Man_from_shapes', 1, 'Выявление индивидуально-типологических различий на основе конструктивного рисунка человека из геометрических фигур.'),
(11, 'Temperament', 3, 'Прогноз темперамента на основании психологического теста.'),
(12, 'Film_genre', 2, 'Выявление индивидуально-типологических различий предпочтения жанров фильмов.'),
(13, 'Lifeline', 1, 'Проверка (уточнение) прогноза темперамента на основании психологического теста, выполненного в тесте «Темперамент».');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
