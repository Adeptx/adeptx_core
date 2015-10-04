
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 10 2015 г., 08:01
-- Версия сервера: 10.0.20-MariaDB
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u693893153_eosy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adeptx_session`
--

CREATE TABLE IF NOT EXISTS `adeptx_session` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(255) NOT NULL,
  `line_desc` varchar(255) NOT NULL,
  `line_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `adeptx_session`
--

INSERT INTO `adeptx_session` (`id`, `user_id`, `line_desc`, `line_value`) VALUES
(1, 1, 'cloud', 'fm');

-- --------------------------------------------------------

--
-- Структура таблицы `adeptx_user`
--

CREATE TABLE IF NOT EXISTS `adeptx_user` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `adeptx_user`
--

INSERT INTO `adeptx_user` (`id`, `email`, `hash`, `salt`) VALUES
(1, 'e.grinec@gmail.com', '6ab39c41030d3888846c4ecb11375bb3ad7138f7879ac19f2f9e192f7614cf1523f1b3ac951eea304b09d911d3797f32', '5024467d5acfd9d9d3592340ee2800cf'),
(2, 'gcorp.gcorp@gmail.com', '0359ac6aa8df54fe9dad42ef88a5134e5d2389e4339cdc91330de5f6bdf24e8f1c2081763a03d00838c1aa16f18db61e', '0cc27475046ec987dfc168c0669b6323');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
