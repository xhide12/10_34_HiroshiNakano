-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hiroshinakano`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `userdata`
--

CREATE TABLE `userdata` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `password`) VALUES
(1, 'test1', '$2y$10$9e5FlcK3T4L3OjkCP7C3/eAN/loUsjLw9S6vpQbphRjqUl/0wFspi'),
(2, 'test2', '$2y$10$fD8e8F0ktRhNcFjf1jfEVe/3dY6PCPAm1I9MWr2Ctng4JvYJ3HQvG'),
(3, 'test4', '$2y$10$I06FT0gRCL7WPntWDkRdQuLcgO4NwNhfRwlbMGF/nF/khMk/j7yDu'),
(4, 'test4', '$2y$10$mmI9RqMgabMX5Q.sCYGY2.vscoOa/qEb/8U/7sJIdxVfRhyl9VuDK'),
(5, 'test5', '$2y$10$6JEfLkQ5n9/5c.Yd/CJTdONDHC.8YUPVBthk8vbqfW90w4x0Cv.t.');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
