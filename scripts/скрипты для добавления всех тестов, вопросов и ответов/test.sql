-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 02 2018 г., 13:11
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
  `comment` text COLLATE utf8_unicode_ci,
  `description` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`, `weight`, `comment`, `description`) VALUES
(15, 'activity_levels', 3, '', 'Уровни деятельности'),
(3, 'platonic_solids', 0.5, '', 'Платоновые тела'),
(4, 'elements', 0.15, '', 'Стихии'),
(16, 'sence', 1, '', 'Органы чувств'),
(6, 'taste', 0.25, '', 'Вкусовые предпочтения'),
(7, 'colors', 1, 'Colors testing', 'Цвета'),
(8, 'antropometric', 0.4, 'Тестирование по антропометрическим данным', 'Антропометрические данные'),
(9, 'preferences_of_school_subjects', 1, 'Выявление индивидуально-типологических различий на основе предпочтения школьных предметов.', 'Школьные предметы'),
(10, 'man_from_shapes', 1, 'Выявление индивидуально-типологических различий на основе конструктивного рисунка человека из геометрических фигур.', 'Рисунок человека из фигур'),
(11, 'temperament', 3, 'Прогноз темперамента на основании психологического теста.', 'Темперамент'),
(12, 'film_genre', 2, 'Выявление индивидуально-типологических различий предпочтения жанров фильмов.', 'Жанры кино'),
(13, 'lifeline', 1, 'Проверка (уточнение) прогноза темперамента на основании психологического теста, выполненного в тесте «Темперамент».', 'Дорога жизни'),
(14, 'aspects', 1.5, '', 'Аспекты деятельности');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
