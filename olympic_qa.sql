-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2022-02-03 17:29:42
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `olympic_qa`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answer_table`
--

CREATE TABLE `answer_table` (
  `id` int(11) NOT NULL,
  `event_name` varchar(64) NOT NULL,
  `event_jp` varchar(64) NOT NULL,
  `event_no` int(11) NOT NULL,
  `omoide` text NOT NULL,
  `nickname` text NOT NULL,
  `mailaddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `answer_table`
--

INSERT INTO `answer_table` (`id`, `event_name`, `event_jp`, `event_no`, `omoide`, `nickname`, `mailaddress`) VALUES
(1, 'curling', 'カーリング', 11, 'もぐもぐタイム', 'aaa', 'bbb'),
(2, 'curling', 'カーリング', 11, '赤いサイロ', 'kitami', 'fwhfor'),
(3, 'alpen', 'スキーアルペン', 2, '回転', 'kurukuru', 'ioejhfwij'),
(4, 'sskate', 'スピードスケート', 8, 'しみずさん', 'simizu', 'dfwiopfhw');

-- --------------------------------------------------------

--
-- テーブルの構造 `event_table`
--

CREATE TABLE `event_table` (
  `event_name` text NOT NULL,
  `event_jp` text NOT NULL,
  `id` int(11) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `event_table`
--

INSERT INTO `event_table` (`event_name`, `event_jp`, `id`, `counter`) VALUES
('freestyle', 'フリースタイル', 1, 0),
('alpen', 'スキーアルペン', 2, 1),
('ccs', 'スキークロスカントリー', 3, 0),
('jump', 'スキージャンプ', 4, 0),
('nordic', 'ノルディック複合', 5, 0),
('figure', 'フィギュアスケート', 6, 0),
('st', 'ショートトラック', 7, 0),
('sskate', 'スピードスケート', 8, 1),
('sb', 'スノーボード', 9, 0),
('ih', 'アイスホッケー', 10, 0),
('curling', 'カーリング', 11, 2),
('biaslon', 'バイアスロン', 12, 0),
('skelton', 'スケルトン', 13, 0),
('luge', 'リュージュ', 14, 0),
('bb', 'ボブスレー', 15, 0),
('none', '特にない', 16, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answer_table`
--
ALTER TABLE `answer_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `event_table`
--
ALTER TABLE `event_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `answer_table`
--
ALTER TABLE `answer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `event_table`
--
ALTER TABLE `event_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
