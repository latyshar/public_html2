-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 16 2022 г., 18:53
-- Версия сервера: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `690-19_manikurchik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(6) NOT NULL,
  `fio` varchar(60) NOT NULL,
  `phone` char(10) NOT NULL,
  `dateofbirth` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(500) DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `fio`, `phone`, `dateofbirth`, `email`, `password`, `token`, `isadmin`) VALUES
(1, 'Акакий', '8955676789', '2003-12-10', 'lala@mail.ru', 'kaka123', NULL, 0),
(3, 'Эрик', '888888886', '2002-12-04', 'gfdsw@mail.ru', '$2y$13$2tiHQfej.MGHtsmzXot9DOdy6Sw1AF8yjsK5qqBQlf/uHGsBtys1.', 'heMGidbza94SmGeW8TuXnVQas25lWxAi', 1),
(4, 'Эрук', '4455666', '2002-12-04', 'gfdsw@mail.ru', '$2y$13$t3WQ6nfcnHjjHDihRxt.neXUE8KtcLYDmW9nW/Xf55V11CBc8.bjG', NULL, 0),
(5, 'квака', '888888882', '2000-01-01', 'sos@mail.ru', '$2y$13$Kmt1XseKe5vgzGBUFFpfROKDpUYsnoR1xk2iWnRiFg5DPBIyUYim6', 'NchgO8kRbwZLFKEGXbuqMzzB1eqJgU2l', 0),
(6, 'квака1', '7899900', '2000-01-01', 'sos1@mail.ru', '$2y$13$cl.sWIJ7YRG/vTFwyhJq0u3o4ucESzaxW3YJS59jztfA6V638LRzO', 'tREhlXatsz0ENAUB2txpyPAwTEqdS1TN', 1),
(8, 'Аня2', '78999001', '2001-01-01', 'sos12@mail.ru', '$2y$13$em1o/FnHhu7kb0Jjcte79uY8gZGifnkoJlm7gFSe6VLT/BnvicloO', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Employee`
--

CREATE TABLE `Employee` (
  `ID_Empl` int(6) NOT NULL,
  `L_EName` varchar(40) NOT NULL,
  `F_EName` varchar(40) NOT NULL,
  `M_EName` varchar(40) NOT NULL,
  `P_ENumber` char(20) NOT NULL,
  `Adress` varchar(60) NOT NULL,
  `Passport` char(20) NOT NULL,
  `J_Title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Employee`
--

INSERT INTO `Employee` (`ID_Empl`, `L_EName`, `F_EName`, `M_EName`, `P_ENumber`, `Adress`, `Passport`, `J_Title`) VALUES
(1, 'Марикович', 'Эдик', 'Татарстан', '895444787', 'ул прикопа', '5677 84473', 'Маникюрщица'),
(2, 'Марикович', 'Эдик', 'Татарстан', '895444787', 'ул прикопа', '5677 84473', 'Маникюрщица');

-- --------------------------------------------------------

--
-- Структура таблицы `Registration`
--

CREATE TABLE `Registration` (
  `ID_Reg` int(11) NOT NULL,
  `ID_Cl` int(11) NOT NULL,
  `ID_Empl` int(11) NOT NULL,
  `ID_Serv` int(11) NOT NULL,
  `Reg_Date` date NOT NULL DEFAULT current_timestamp(),
  `Visit_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `Service`
--

CREATE TABLE `Service` (
  `ID_Serv` int(6) NOT NULL,
  `Serv_Name` varchar(20) NOT NULL,
  `opisanie` varchar(500) NOT NULL,
  `Serv_Price` int(11) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Service`
--

INSERT INTO `Service` (`ID_Serv`, `Serv_Name`, `opisanie`, `Serv_Price`, `image`) VALUES
(15, 'Японский маникюр', 'Массаж для ваших ручек', 800, '/photo/serv_photo/Kx-R4SPNfSJiLuAR3AwVsrD62un19-7V.jpg'),
(16, 'Японский маникюр', 'Массаж для ваших ручек', 800, '/photo/serv_photo/BCRRUSAJ-vpRvT4ElkdannclZBcD6KrQ.jpg'),
(17, 'Японский маникюр', 'Массаж для ваших ручек', 800, '/photo/serv_photo/1YPmOC8WG26F3DSedizIbOLUeTPfI6Qd.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`ID_Empl`);

--
-- Индексы таблицы `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`ID_Reg`),
  ADD KEY `Id_Serv` (`ID_Serv`),
  ADD KEY `ID_Cl` (`ID_Cl`,`ID_Empl`),
  ADD KEY `ID_Serv_2` (`ID_Serv`),
  ADD KEY `ID_Empl` (`ID_Empl`);

--
-- Индексы таблицы `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`ID_Serv`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `Employee`
--
ALTER TABLE `Employee`
  MODIFY `ID_Empl` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Registration`
--
ALTER TABLE `Registration`
  MODIFY `ID_Reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Service`
--
ALTER TABLE `Service`
  MODIFY `ID_Serv` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Registration`
--
ALTER TABLE `Registration`
  ADD CONSTRAINT `Registration_ibfk_1` FOREIGN KEY (`ID_Cl`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Registration_ibfk_2` FOREIGN KEY (`ID_Serv`) REFERENCES `Service` (`ID_Serv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Registration_ibfk_3` FOREIGN KEY (`ID_Empl`) REFERENCES `Employee` (`ID_Empl`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
