-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 27 2017 г., 12:30
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `test.ram`
--

-- --------------------------------------------------------

--
-- Структура таблицы `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `operations`
--

INSERT INTO `operations` (`id`, `user_id`, `amount`, `type`, `address`, `date`) VALUES
  (1, 6, '123.00', 'in', '4276 0600 1191 4888', 1511698696),
  (2, 7, '124.00', 'in', '4276 0600 1191 4880', 1511698096),
  (3, 7, '345.12', 'in', '4276 0600 1191 4888', 1511638696),
  (4, 7, '124.16', 'out', '4276 0600 1191 4588', 1511648696),
  (5, 7, '785.24', 'in', '4276 0600 1191 6888', 1511658696),
  (6, 8, '427.77', 'in', '4276 0600 1191 4288', 1511668696),
  (7, 7, '732.65', 'in', '4276 0600 1191 4858', 1511678696),
  (8, 7, '456.28', 'out', '4276 0600 1191 4868', 1511688696),
  (9, 6, '951.49', 'in', '4276 0600 1191 4788', 1511698696),
  (11, 7, '100.00', 'out', '12345678', 1511730443),
  (12, 7, '100.00', 'out', '123567890', 1511769644),
  (14, 7, '50.00', 'out', '243423', 1511771764),
  (15, 7, '12.00', 'out', 'wdwefw', 1511773605),
  (16, 7, '11.00', 'out', 'erferfer', 1511773707);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `payPass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `payPass`) VALUES
  (6, 'wefw', '76d80224611fc919a5d54f0ff9fba446', '621a72de1437ba88e1e3560c9b33bc96'),
  (7, 'login', '5f4dcc3b5aa765d61d8327deb882cf99', '6cb75f652a9b52798eb6cf2201057c73');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;