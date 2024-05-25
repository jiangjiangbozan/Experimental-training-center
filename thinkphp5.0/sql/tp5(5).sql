-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-05-23 15:37:47
-- 服务器版本： 10.1.13-MariaDB
-- PHP 版本： 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `tp5`
--

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_centre_radio`
--

CREATE TABLE `yunzhi_centre_radio` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `path` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_centre_radio`
--

INSERT INTO `yunzhi_centre_radio` (`id`, `name`, `path`) VALUES
(1, 'test', '20240428\\4c594e4f9a30505605b09e641d402c25.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_course`
--

CREATE TABLE `yunzhi_course` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_course`
--

INSERT INTO `yunzhi_course` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'thinkphp5入门实例', 0, 0),
(2, 'angularjs入门实例', 0, 0),
(3, 'thinkphp5入门实例', 2024, 1711965985),
(4, 'thinkphp5入门实例', 2024, 1711966033),
(5, 'thinkphp5入门实例', 2024, 1711966053),
(6, 'thinkphp5入门实例', 2024, 1711966138),
(7, 'thinkphp5入门实例', 2024, 1711966251),
(8, 'thinkphp5入门实例', 2024, 1711966419),
(9, 'thinkphp5入门实例', 2024, 1711966529),
(10, 'thinkphp5入门实例', 2024, 1711966591),
(11, 'thinkphp5入门实例', 2024, 1711966627),
(12, 'thinkphp5入门实例', 2024, 1711966703),
(13, 'thinkphp5入门实例', 2024, 1711966803),
(14, 'thinkphp5入门实例', 2024, 1711966810),
(15, '', 2024, 1711968663),
(16, 'thinkphp5入门实例', 2024, 1711968690),
(17, '', 2024, 1711969220),
(18, 'thinkphp5入门实例', 2024, 1711969230),
(19, 'thinkphp5入门实例', 2024, 1711970345),
(20, 'thinkphp5入门实例', 2024, 1711970348);

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_download`
--

CREATE TABLE `yunzhi_download` (
  `id` int(2) NOT NULL,
  `name` varchar(14) DEFAULT NULL,
  `createtime` date DEFAULT NULL,
  `path` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_innovation_experiment`
--

CREATE TABLE `yunzhi_innovation_experiment` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_klass`
--

CREATE TABLE `yunzhi_klass` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `teacher_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '教师ID',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_klass`
--

INSERT INTO `yunzhi_klass` (`id`, `name`, `teacher_id`, `create_time`, `update_time`) VALUES
(1, '实验1班', 9, 0, 1466493790),
(2, '实验2班', 2, 0, 0),
(3, '实验3班', 1, 0, 0),
(4, '实验4班', 2, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_klass_course`
--

CREATE TABLE `yunzhi_klass_course` (
  `id` int(11) UNSIGNED NOT NULL,
  `klass_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `create_time` int(11) UNSIGNED NOT NULL,
  `update_time` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_klass_course`
--

INSERT INTO `yunzhi_klass_course` (`id`, `klass_id`, `course_id`, `create_time`, `update_time`) VALUES
(2, 1, 2, 0, 0),
(4, 2, 2, 0, 0),
(6, 4, 2, 0, 0),
(8, 6, 2, 0, 0),
(9, 1, 3, 0, 0),
(10, 2, 3, 0, 0),
(11, 1, 4, 0, 0),
(12, 2, 4, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_laboratory`
--

CREATE TABLE `yunzhi_laboratory` (
  `lifepath` varchar(225) DEFAULT NULL,
  `id` int(2) NOT NULL,
  `name` varchar(225) NOT NULL,
  `wenpath` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_leader_teacher`
--

CREATE TABLE `yunzhi_leader_teacher` (
  `path` varchar(225) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_news`
--

CREATE TABLE `yunzhi_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `path` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_news`
--

INSERT INTO `yunzhi_news` (`id`, `title`, `content`, `publish_date`, `author`, `source`, `views`, `path`) VALUES
(1, 'dasdasdasdas', 'dasdasdasdasdas', '0000-00-00', 'dasdas', 'dasdasdas', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_notification`
--

CREATE TABLE `yunzhi_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `path` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_notification`
--

INSERT INTO `yunzhi_notification` (`id`, `title`, `content`, `publish_date`, `author`, `source`, `views`, `path`) VALUES
(1, 'dasdasd', 'dasdasdasd', '0000-00-00', 'dsadasd', 'sadasdas', 0, ''),
(2, 'dasdas', 'dasdasdavasasdas', '0000-00-00', 'adsdasd', 'dasdasd', 0, ''),
(3, '', '', '0000-00-00', '', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_professional_experiment`
--

CREATE TABLE `yunzhi_professional_experiment` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_rules`
--

CREATE TABLE `yunzhi_rules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_show`
--

CREATE TABLE `yunzhi_show` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(225) NOT NULL,
  `create_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_show`
--

INSERT INTO `yunzhi_show` (`id`, `name`, `path`, `create_time`) VALUES
(4, '实验室1', '20240520\\fbd7e9822312fa532c40f967b393c41f.png', '0000-00-00'),
(5, '实验室2', '20240520\\3bf1cfc30ada216bff41b3abdac86666.png', '0000-00-00'),
(6, '实验室3', '20240520\\0047f6878c60f19eb3222269d7b73e29.png', '0000-00-00');

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_specialty_experiment`
--

CREATE TABLE `yunzhi_specialty_experiment` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_specification_center`
--

CREATE TABLE `yunzhi_specification_center` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_student`
--

CREATE TABLE `yunzhi_student` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '姓名',
  `num` varchar(40) NOT NULL DEFAULT '',
  `sex` tinyint(2) NOT NULL DEFAULT '0',
  `klass_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(40) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_student`
--

INSERT INTO `yunzhi_student` (`id`, `name`, `num`, `sex`, `klass_id`, `email`, `create_time`, `update_time`) VALUES
(1, '徐琳杰', '111', 0, 1, 'xulinjie@yunzhiclub.com', 0, 0),
(2, '魏静云', '112', 1, 2, 'weijingyun@yunzhiclub.com', 0, 0),
(3, '刘茜', '113', 0, 2, 'liuxi@yunzhiclub.com', 0, 0),
(4, '李甜', '114', 1, 1, 'litian@yunzhiclub.com', 0, 0),
(5, '李翠彬', '115', 1, 3, 'licuibin@yunzhiclub.com', 0, 0),
(6, '孔瑞平', '115', 0, 4, 'kongruiping@yunzhiclub.com', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_teacher`
--

CREATE TABLE `yunzhi_teacher` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT '' COMMENT '姓名',
  `password` varchar(11) NOT NULL,
  `sex` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0男，1女',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `email` varchar(30) DEFAULT '' COMMENT '邮箱',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_teacher`
--

INSERT INTO `yunzhi_teacher` (`id`, `name`, `password`, `sex`, `username`, `email`, `create_time`, `update_time`) VALUES
(2, 'AWUDGAUI', '123', 1, 'AWLKFDBAO', 'FAWFLLK@', 1711368496, 1711368496),
(1, 'QEFQ[OP', '123', 1, 'QFQEF', 'FQFFAE@', 1711368508, 1711368508),
(3, '奥尔夫前', '123', 1, 'satha', 'wqfewq#@', 1711367960, 1711367960),
(9, '傻蛋', '', 0, 'shadan', 'shandanplus@qq.com', 1711778491, 1711779051),
(215, '大傻蛋', '', 1, 'dashadan', '123@11', 1711779151, 1711779151),
(216, '阿达', '', 1, 'ad', 'adadw@', 1711779188, 1711779188);

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_upload`
--

CREATE TABLE `yunzhi_upload` (
  `id` int(11) NOT NULL,
  `file_content` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_user`
--

CREATE TABLE `yunzhi_user` (
  `id` int(2) NOT NULL,
  `name` varchar(225) NOT NULL,
  `passwords` varchar(225) NOT NULL,
  `power` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunzhi_user`
--

INSERT INTO `yunzhi_user` (`id`, `name`, `passwords`, `power`) VALUES
(1, 'zhangsan', '123', 1),
(2, 'lisi', '123', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_video_teaching`
--

CREATE TABLE `yunzhi_video_teaching` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `publish_date` date NOT NULL,
  `clicks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_vr`
--

CREATE TABLE `yunzhi_vr` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yunzhi_zi`
--

CREATE TABLE `yunzhi_zi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `yunzhi_centre_radio`
--
ALTER TABLE `yunzhi_centre_radio`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_course`
--
ALTER TABLE `yunzhi_course`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_download`
--
ALTER TABLE `yunzhi_download`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_innovation_experiment`
--
ALTER TABLE `yunzhi_innovation_experiment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_klass`
--
ALTER TABLE `yunzhi_klass`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_klass_course`
--
ALTER TABLE `yunzhi_klass_course`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_laboratory`
--
ALTER TABLE `yunzhi_laboratory`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_leader_teacher`
--
ALTER TABLE `yunzhi_leader_teacher`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_news`
--
ALTER TABLE `yunzhi_news`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_notification`
--
ALTER TABLE `yunzhi_notification`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_professional_experiment`
--
ALTER TABLE `yunzhi_professional_experiment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_rules`
--
ALTER TABLE `yunzhi_rules`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_show`
--
ALTER TABLE `yunzhi_show`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_specialty_experiment`
--
ALTER TABLE `yunzhi_specialty_experiment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_specification_center`
--
ALTER TABLE `yunzhi_specification_center`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_student`
--
ALTER TABLE `yunzhi_student`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_teacher`
--
ALTER TABLE `yunzhi_teacher`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_upload`
--
ALTER TABLE `yunzhi_upload`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_user`
--
ALTER TABLE `yunzhi_user`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_video_teaching`
--
ALTER TABLE `yunzhi_video_teaching`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_vr`
--
ALTER TABLE `yunzhi_vr`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `yunzhi_zi`
--
ALTER TABLE `yunzhi_zi`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `yunzhi_centre_radio`
--
ALTER TABLE `yunzhi_centre_radio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `yunzhi_course`
--
ALTER TABLE `yunzhi_course`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用表AUTO_INCREMENT `yunzhi_download`
--
ALTER TABLE `yunzhi_download`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_innovation_experiment`
--
ALTER TABLE `yunzhi_innovation_experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_klass`
--
ALTER TABLE `yunzhi_klass`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `yunzhi_klass_course`
--
ALTER TABLE `yunzhi_klass_course`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `yunzhi_leader_teacher`
--
ALTER TABLE `yunzhi_leader_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_news`
--
ALTER TABLE `yunzhi_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `yunzhi_notification`
--
ALTER TABLE `yunzhi_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `yunzhi_professional_experiment`
--
ALTER TABLE `yunzhi_professional_experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_rules`
--
ALTER TABLE `yunzhi_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_show`
--
ALTER TABLE `yunzhi_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `yunzhi_specialty_experiment`
--
ALTER TABLE `yunzhi_specialty_experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_specification_center`
--
ALTER TABLE `yunzhi_specification_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_student`
--
ALTER TABLE `yunzhi_student`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `yunzhi_teacher`
--
ALTER TABLE `yunzhi_teacher`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- 使用表AUTO_INCREMENT `yunzhi_upload`
--
ALTER TABLE `yunzhi_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_user`
--
ALTER TABLE `yunzhi_user`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `yunzhi_video_teaching`
--
ALTER TABLE `yunzhi_video_teaching`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_vr`
--
ALTER TABLE `yunzhi_vr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `yunzhi_zi`
--
ALTER TABLE `yunzhi_zi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
