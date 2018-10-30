-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 05:37 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football`
--

-- --------------------------------------------------------

--
-- Table structure for table `league`
--

CREATE TABLE `league` (
  `league_id` int(10) NOT NULL,
  `official_id` int(20) DEFAULT NULL,
  `league_name` varchar(30) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `league`
--

INSERT INTO `league` (`league_id`, `official_id`, `league_name`, `start_date`, `end_date`) VALUES
(1, 1, 'Term', '2017-10-13', '2017-10-31'),
(4, 2, 'Fourth', '2017-10-23', '2017-11-04'),
(5, 2, 'Third term 2017 boys', '2017-10-31', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `uname` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`uname`, `password`, `category`) VALUES
('brimas', '$2y$10$vnXPQDYTwqPQ0xJgCFkPROUR9xwsawjAV5m6PuQ1akbARhiV4FSW6', 'referee'),
('carrol', '$2y$10$mfpZhfGzXP/0Np0ofz96rO.zcdAX6kE9MNz15dwnFAqNK.B9b1SrS', 'team'),
('embakasi', '$2y$10$Z8nLDtjB2Paz/8sk1btpn.oiVXzl88Sl4Ogj3jYh3kJ0bdQxlrWbe', 'team'),
('foothill', '$2y$10$2x1HuOsgjYC4JlZH9ORwb.TKmTfK5Sf5lmmwShupX15jv42OMpt.W', 'team'),
('glad', '$2y$10$qOJ/XoOTj2lurg0dJK5kKe1MhpATW9pIcPe6oh3PPfuua3aCTceD.', 'official'),
('Gucci', '$2y$10$t5vcYEM2OcnduO1hDgFCQOfOykIyafjd54xcBNWYJ/ZiRFa4T/IPq', 'referee'),
('khan', '$2y$10$BnhFTXxWIuyTkhxJJkvu6OjEOHMoWb2VEonMVm7S/o6AJicdwX916', 'official'),
('langata', '$2y$10$vXfpquBViOHhguFK4DyisulfTzr8ev08L3eNsLCNzPobG6.ePL.ZG', 'team'),
('ninja', '$2y$10$z0OYRXzv4UzVOOR0GE7y2OMs4Qej.L8TGccbyFxCW3sXZNAOpadSS', 'official'),
('ninjas', '$2y$10$xguvi3HlS92BChz0wQIno.pCeDd82bO/12eMzKgiRAfmPlVtqZHEG', 'official'),
('rast', '$2y$10$wKUxV5ZpT0zTRcyqnnV61O.gzRdjox8h9m3ebHKQ149y2Ythikcq2', 'referee'),
('river', '$2y$10$IKzCDWuuQpUEyo3YdjT9peDilYqGJJ0JZDFlse0084.BxpZ.ONhfu', 'team'),
('spring', '$2y$10$b2OH4KoGzrcN0RiO6GEHT.07V6vWOhG.BmWGcUhsb3GzcNQHj0kSm', 'team'),
('summer', '$2y$10$CNJTtjqiCrttk5iHU/8jO.H8JmNkSsjcQ4rrCXIJ/F8UUbBZQRs6m', 'team'),
('sunset', '$2y$10$mxaRXQ8E2e/F4HIfyhkKL.gMRwRBTcKwvLTGLY.WAVIX6YlFuDxpK', 'team'),
('teamruai', '$2y$10$Qulpqyo36DwLmi5mU6Zk4Ov4fX8DgVOUm0gaayDThyQDdvpK981tK', 'team'),
('tommy42', '$2y$10$OkzDNME/bO49XY/Rgw8Ab.2FSFdbn3VXzYLQShEdymCWTEH88.fea', 'official'),
('tommy43', '$2y$10$iQ1lxWRaCgqGUZ0G6v7Sm.6EbsOJX/Vp/A/J48//8t1fAgomc9ntu', 'referee'),
('tommy50', '$2y$10$yxLXg/Ov2EXNG8GSjUTtw.D3St6cOAgHpdS6.oUV7UZI1UgagquXq', 'referee'),
('tommy52', '$2y$10$WXu2DLl0fBm9KLzLqtGrGuJZ0Jyz0erTJBheWv/6XpepqulsS.yKO', 'referee'),
('valley', '$2y$10$9TNB4FmD48WgwgDPu.AXH.X0SfWB8A3UWM2r5.H8SkzOsvKOPnnk.', 'team');

-- --------------------------------------------------------

--
-- Table structure for table `match_fixtures`
--

CREATE TABLE `match_fixtures` (
  `match_fixture_id` int(10) NOT NULL,
  `match_date` date DEFAULT NULL,
  `team1_id` int(10) DEFAULT NULL,
  `team2_id` int(10) DEFAULT NULL,
  `league_id` int(20) NOT NULL,
  `referee_id` int(20) NOT NULL,
  `venue` varchar(30) NOT NULL,
  `comments` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_fixtures`
--

INSERT INTO `match_fixtures` (`match_fixture_id`, `match_date`, `team1_id`, `team2_id`, `league_id`, `referee_id`, `venue`, `comments`) VALUES
(20, '2017-11-13', 3, 4, 5, 14, 'Ruai High', ''),
(21, '2017-11-13', 4, 5, 5, 14, 'SpringField', ''),
(22, '2017-11-13', 5, 9, 5, 14, 'Embakasi East High', ''),
(23, '2017-11-13', 9, 10, 5, 14, 'Sunset', ''),
(24, '2017-11-13', 11, 12, 5, 14, 'Ruai High', ''),
(25, '2017-11-13', 12, 13, 5, 14, 'Kasarani', ''),
(26, '2017-11-13', 13, 14, 5, 14, 'Kasarani', ''),
(27, '2017-11-13', 15, 14, 5, 14, 'Kasarani', ''),
(28, '2017-11-13', 5, 10, 5, 14, 'Kasarani', '');

-- --------------------------------------------------------

--
-- Table structure for table `match_results`
--

CREATE TABLE `match_results` (
  `match_result_id` int(10) NOT NULL,
  `match_fixture_id` int(20) NOT NULL,
  `ref_id` int(10) DEFAULT NULL,
  `scores` int(10) DEFAULT NULL,
  `points` int(10) DEFAULT NULL,
  `team_id` int(10) DEFAULT NULL,
  `league_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_results`
--

INSERT INTO `match_results` (`match_result_id`, `match_fixture_id`, `ref_id`, `scores`, `points`, `team_id`, `league_id`) VALUES
(3, 20, 14, 4, 3, 3, 5),
(4, 20, 14, 1, 0, 4, 5),
(5, 27, 14, 1, 1, 15, 5),
(6, 27, 14, 1, 1, 14, 5),
(7, 26, 14, 0, 1, 13, 5),
(8, 26, 14, 0, 1, 14, 5),
(9, 25, 14, 3, 1, 12, 5),
(10, 25, 14, 3, 1, 13, 5),
(11, 24, 14, 3, 3, 11, 5),
(12, 24, 14, 2, 0, 12, 5),
(13, 23, 14, 4, 3, 9, 5),
(14, 23, 14, 0, 0, 10, 5),
(15, 21, 14, 3, 3, 4, 5),
(16, 21, 14, 1, 0, 5, 5),
(17, 22, 14, 0, 1, 5, 5),
(18, 22, 14, 0, 1, 9, 5),
(19, 28, 14, 0, 1, 5, 5),
(20, 28, 14, 0, 1, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `official_id` int(10) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `uname` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`official_id`, `name`, `uname`, `phone`, `email`, `image`, `category`) VALUES
(1, 'Hezekiah Njuguna', 'ninjas', '0703748544', 'bm@gmail.com', '1509020626im3.jpg', 'official'),
(2, 'Mr Austin Moon', 'ninja', '0703748541', 'bma@gmail.com', '1509548421man37974.png', 'super'),
(3, 'Mr Dennis Lacho', 'tommy42', '0703748544', 'bm@gmail.com', '1509208601andre-marriner.jpg', 'official'),
(4, 'Gladis Shiks', 'glad', '0703748544', 'bm@gmail.com', '15092077277f796d57218d9cd81a92d9e6e8e51ce4--free-avatars-online-profile.jpg', 'official'),
(6, 'Mr Dominic Khan', 'khan', '0703748544', 'bm@gmail.com', '1509370349football-referee-with-hand-gestures_318-42804.png-300x300.jpeg', 'official');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(10) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `birth_certificate` varchar(50) DEFAULT NULL,
  `current_team_id` int(10) NOT NULL,
  `date_joined` date NOT NULL,
  `date_left` date NOT NULL,
  `player_status` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `position` varchar(30) DEFAULT NULL,
  `sub_team` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `photo`, `birth_certificate`, `current_team_id`, `date_joined`, `date_left`, `player_status`, `name`, `phone`, `email`, `position`, `sub_team`) VALUES
(9, '1510568717306.jpg', '151020222357ae3a662bfc4.jpg', 3, '0000-00-00', '0000-00-00', 'active', 'Oliech', '0703748544', 'bm@gmail.com', 'striker', 'A'),
(10, '1510568737325.jpg', '1510201869birth2.jpg', 3, '0000-00-00', '0000-00-00', 'active', 'Austin', '0703748544', 'bm@gmail.com', 'striker', 'A'),
(11, '90.png', '1510202092birth2.jpg', 4, '0000-00-00', '0000-00-00', 'active', 'Jake', '0703748544', 'bm@gmail.com', 'striker', 'A'),
(12, '1510201289Alexis-Sanchez.jpg', '1510201289birth.jpeg', 4, '0000-00-00', '0000-00-00', 'active', 'Peter', '0703748544', 'bm@gmail.com', 'striker', 'A'),
(16, '1510015709p41328.png', '1510015709birth.jpeg', 5, '2017-11-01', '2017-11-07', 'Alumni', 'Caleb', '0703748541', 'bm@gmail.com', 'Striker', 'B'),
(18, '1510016881305db0612fd217e16b8f88dec2ba829d.png', '151020227857ae3a662bfc4.jpg', 3, '2017-11-07', '0000-00-00', 'active', 'Jadiel Vincent', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(19, '1510021083p19419.png', '151020229057ae3a662bfc4.jpg', 4, '2017-11-09', '0000-00-00', 'active', 'Harry Kamau', '0703748544', 'bm@gmail.com', 'Striker', 'B'),
(20, '1510561767p42786.png', '1510561767Birth_Certificate commerce.jpg', 5, '2017-11-13', '0000-00-00', 'active', 'Declan Stanley', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(21, '1510561849p49579.png', '1510561849Birth_Certificate commerce.jpg', 5, '2017-11-13', '0000-00-00', 'active', 'Jordan George', '0703748544', 'embakasi@gmail.com', 'Defender', 'A'),
(22, '1510561899p60772.png', '1510561899Birth_Certificate commerce.jpg', 5, '2017-11-13', '0000-00-00', 'active', 'Hayes Boyer', '0703748544', 'embakasi@gmail.com', 'GoalKeeper', 'A'),
(23, '1510561944p82263.png', '1510561944p94245.png', 5, '2017-11-13', '0000-00-00', 'active', 'Reese Mendoza', '0703748544', 'embakasi@gmail.com', 'Midfield', 'A'),
(24, '1510561981p116594.png', '1510561981birth.jpeg', 5, '2017-11-13', '0000-00-00', 'active', 'Jayce Lucas', '0703748544', 'embakasi@gmail.com', 'Midfield', 'A'),
(25, '1510562139p118335.png', '151056213957ae3a662bfc4.jpg', 5, '2017-11-13', '0000-00-00', 'active', 'Cameron Reynolds', '0703748544', 'embakasi@gmail.com', 'Defender', 'A'),
(26, '1510562297p126186.png', '1510562297birth2.jpg', 5, '2017-11-13', '0000-00-00', 'active', 'Dexter Butler', '0703748544', 'embakasi@gmail.com', 'Defender', 'A'),
(27, '1510562394p163793.png', '1510562394birth2.jpg', 5, '2017-11-13', '0000-00-00', 'active', 'Evan Roberts', '0703748544', 'embakasi@gmail.com', 'Defender', 'A'),
(28, '1510562440p167767.png', '1510562440birth.jpeg', 5, '2017-11-13', '0000-00-00', 'active', 'Arthur Davies', '0703748544', 'embakasi@gmail.com', 'Defender', 'A'),
(29, '1510562568174.jpg', '1510562568birth.jpeg', 15, '2017-11-13', '0000-00-00', 'active', 'Bradley Nyaga', '0703748544', 'langata_high@gmail.com', 'Striker', 'A'),
(30, '1510562625175.jpg', '1510562625Birth_Certificate commerce.jpg', 15, '2017-11-13', '0000-00-00', 'active', 'Adrein Shani ', '0703748544', 'langata_high@gmail.com', 'Defender', 'A'),
(31, '1510562669176.jpg', '1510562669Birth_Certificate commerce.jpg', 15, '2017-11-13', '0000-00-00', 'active', 'Arthur Moyo', '0703748544', 'langata_high@gmail.com', 'Defender', 'A'),
(32, '1510562713177.jpg', '1510562713Birth_Certificate commerce.jpg', 15, '2017-11-13', '0000-00-00', 'active', 'Kenneth Khalfani', '0703748544', 'langata_high@gmail.com', 'Defender', 'A'),
(33, '1510562752178.jpg', '151056275257ae3a662bfc4.jpg', 15, '2017-11-13', '0000-00-00', 'active', 'Louis Salehe', '0703748544', 'langata_high@gmail.com', 'Defender', 'A'),
(34, '1510562804180.jpg', '1510562804birth2.jpg', 15, '2017-11-13', '0000-00-00', 'active', 'Evan siwazuri', '0703748544', 'langata_high@gmail.com', 'Midfield', 'A'),
(35, '1510562863180.jpg', '1510562863Birth_Certificate commerce.jpg', 15, '2017-11-13', '0000-00-00', 'active', 'Scott Simba', '0703748544', 'langata_high@gmail.com', 'Midfield', 'A'),
(36, '151056309254.jpg', '1510563092Birth_Certificate commerce.jpg', 14, '2017-11-13', '0000-00-00', 'active', 'Allen Chane', '0703748544', 'valley@gmail.com', 'Striker', 'A'),
(37, '151056316759.jpg', '1510563167Birth_Certificate commerce.jpg', 14, '2017-11-13', '0000-00-00', 'active', 'Zachary Habab', '0703748544', 'valley@gmail.com', 'Defender', 'A'),
(38, '151056322257.jpg', '1510563222birth.jpeg', 14, '2017-11-13', '0000-00-00', 'active', 'John Busara', '0703748544', 'valley@gmail.com', 'Midfield', 'A'),
(39, '151056328063.jpg', '1510563280birth.jpeg', 14, '2017-11-13', '0000-00-00', 'active', 'Davian Zahur', '0703748544', 'valley@gmail.com', 'Defender', 'A'),
(40, '151056333365.jpg', '1510563333Birth_Certificate commerce.jpg', 14, '2017-11-13', '0000-00-00', 'active', 'Jordan Wachira', '0703748544', 'valley@gmail.com', 'Defender', 'A'),
(41, '1510563544247.jpg', '1510563544birth2.jpg', 13, '2017-11-10', '0000-00-00', 'active', 'James Khalfani', '0703748544', 'summmer@gmail.com', 'GoalKeeper', 'A'),
(42, '1510563626248.jpg', '1510563626birth.jpeg', 13, '2017-11-01', '0000-00-00', 'active', 'Koman Juma', '0703748544', 'summmer@gmail.com', 'Defender', 'A'),
(43, '1510563675249.jpg', '151056367557ae3a662bfc4.jpg', 13, '2017-11-13', '0000-00-00', 'active', 'Siwazuri James', '0703748544', 'summmer@gmail.com', 'Defender', 'A'),
(44, '1510563759250.jpg', '1510563759birth2.jpg', 13, '2017-11-03', '0000-00-00', 'active', 'Marquis Wade', '0703748544', 'summmer@gmail.com', 'Midfield', 'A'),
(45, '1510563893251.jpg', '1510563893birth2.jpg', 13, '2017-11-02', '0000-00-00', 'active', 'Reece Williamson', '0703748544', 'summmer@gmail.com', 'Midfield', 'A'),
(46, '1510563966121.jpg', '1510563966birth.jpeg', 12, '2017-11-13', '0000-00-00', 'active', 'Gabriel Murray', '0703748544', 'river_high@gmail.com', 'Defender', 'A'),
(47, '1510564031122.jpg', '1510564031birth2.jpg', 12, '2017-11-02', '0000-00-00', 'active', 'Jacob Harper', '0703748544', 'river_high@gmail.com', 'Defender', 'A'),
(48, '1510564066123.jpg', '151056406657ae3a662bfc4.jpg', 12, '2017-11-13', '0000-00-00', 'active', 'Tyler Robinson', '0703748544', 'river_high@gmail.com', 'Defender', 'B'),
(49, '15105641501.jpg', '151056415057ae3a662bfc4.jpg', 11, '2017-11-13', '0000-00-00', 'active', 'Brenden Cervantes', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(50, '15105642022.jpg', '1510564202birth2.jpg', 11, '2017-11-13', '0000-00-00', 'active', 'Nasir Stone', '0703748544', 'bm@gmail.com', 'Defender', 'B'),
(51, '15105654434.jpg', '1510565443birth2.jpg', 11, '2017-11-20', '0000-00-00', 'active', 'Brian Cortez', '0703748544', 'bm@gmail.com', 'Striker', 'A'),
(52, '1510566844368.jpg', '1510566844birth2.jpg', 10, '2017-11-13', '0000-00-00', 'active', 'Evan Austin', '0703748544', 'foothill@gmail.comm', 'Striker', 'A'),
(53, '1510567531369.jpg', '1510567531birth2.jpg', 10, '2017-11-07', '0000-00-00', 'active', 'Sebastian Gallagher', '0703748544', 'foothill@gmail.com', 'Midfield', 'A'),
(54, '1510567587370.jpg', '1510567587birth.jpeg', 10, '2017-11-01', '0000-00-00', 'active', 'Zak Hunter', '0703748544', 'foothill@gmail.com', 'Striker', 'A'),
(55, '151056777199.jpg', '1510567771birth.jpeg', 9, '2017-11-07', '0000-00-00', 'active', 'Joseph Cooper', '0703748544', 'bm@gmail.com', 'Striker', 'A'),
(56, '1510567808101.jpg', '1510567808birth.jpeg', 9, '2017-11-01', '0000-00-00', 'active', 'Rory Dixon', '0703748544', 'bm@gmail.com', 'Striker', 'A'),
(57, '1510567843103.jpg', '1510567843Birth_Certificate commerce.jpg', 9, '2017-11-07', '0000-00-00', 'active', 'Gaige Mcneil', '0703748544', 'bm@gmail.com', 'Midfield', 'A'),
(58, '1510567881104.jpg', '1510567881birth2.jpg', 9, '2017-11-07', '0000-00-00', 'active', 'Layne Santos', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(59, '1510567991p169102.png', '1510567991birth2.jpg', 5, '2017-11-01', '0000-00-00', 'active', 'Gary Haley', '0703748544', 'embakasi@gmail.com', 'Midfield', 'A'),
(60, '1510568031ZXcl8bfq_400x400.jpg', '1510568031birth2.jpg', 5, '2017-11-09', '0000-00-00', 'active', 'Andre Hammond', '0703748544', 'embakasi@gmail.com', 'Defender', 'A'),
(61, '1510568669304.jpg', '1510568669birth2.jpg', 3, '2017-11-01', '0000-00-00', 'active', 'Bruno Gilmore', '0703748544', 'spring@gmail.com', 'Striker', 'A'),
(62, '1510568808310.jpg', '1510568808birth2.jpg', 3, '2017-11-14', '0000-00-00', 'active', 'Max Rogers', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(63, '1510570087311.jpg', '151057008757ae3a662bfc4.jpg', 3, '2017-11-14', '0000-00-00', 'active', 'Billy Mitchell', '0703748544', 'bm@gmail.com', 'Midfield', 'A'),
(64, '1510570139313.jpg', '1510570139birth2.jpg', 3, '2017-11-13', '0000-00-00', 'active', 'Samuel Harrison', '0703748544', 'ruaihigh@gmail.com', 'Striker', 'A'),
(65, '1510570177315.jpg', '1510570177birth2.jpg', 3, '2017-11-11', '0000-00-00', 'active', 'Sam Hester', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(66, '1510570234317.jpg', '1510570234birth2.jpg', 3, '2017-11-08', '0000-00-00', 'active', 'Aron Schultz', '0703748544', 'bm@gmail.com', 'Defender', 'A'),
(67, '1510570298319.jpg', '1510570298Birth_Certificate commerce.jpg', 3, '2017-11-07', '0000-00-00', 'active', 'Dominik Mcdowell', '0703748544', 'bm@gmail.com', 'Midfield', 'A'),
(68, '1510570446321.jpg', '1510570446birth2.jpg', 3, '2017-11-07', '0000-00-00', 'active', 'Soren Whitley', '0703748544', 'bm@gmail.com', 'Defender', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `player_stats`
--

CREATE TABLE `player_stats` (
  `stats_id` int(10) NOT NULL,
  `match_fixture_id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL,
  `team_id` int(10) NOT NULL,
  `goals` int(4) NOT NULL DEFAULT '0',
  `match_time` datetime NOT NULL,
  `injured` varchar(5) NOT NULL,
  `cards` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player_stats`
--

INSERT INTO `player_stats` (`stats_id`, `match_fixture_id`, `player_id`, `team_id`, `goals`, `match_time`, `injured`, `cards`) VALUES
(88, 20, 9, 3, 1, '2017-11-13 19:18:24', '', ''),
(89, 20, 12, 4, 1, '2017-11-13 19:18:37', '', ''),
(90, 20, 61, 3, 1, '2017-11-13 19:18:45', '', ''),
(91, 20, 9, 3, 1, '2017-11-13 19:18:53', '', ''),
(92, 20, 65, 3, 1, '2017-11-13 19:19:30', '', ''),
(93, 27, 31, 15, 1, '2017-11-13 19:19:42', '', ''),
(94, 27, 36, 14, 0, '2017-11-13 19:19:45', '', 'yellow'),
(95, 27, 39, 14, 1, '2017-11-13 19:19:52', '', ''),
(96, 25, 47, 12, 1, '2017-11-13 19:22:55', '', ''),
(97, 25, 43, 13, 1, '2017-11-13 19:23:02', '', ''),
(98, 25, 48, 12, 1, '2017-11-13 19:23:31', '', ''),
(99, 25, 43, 13, 1, '2017-11-13 19:23:54', '', ''),
(100, 25, 48, 12, 1, '2017-11-13 19:24:12', '', ''),
(101, 25, 43, 13, 1, '2017-11-13 19:25:11', '', ''),
(102, 24, 50, 11, 1, '2017-11-13 19:25:27', '', ''),
(103, 24, 50, 11, 1, '2017-11-13 19:25:43', '', ''),
(104, 24, 50, 11, 1, '2017-11-13 19:26:14', '', ''),
(105, 24, 48, 12, 1, '2017-11-13 19:26:36', '', ''),
(106, 24, 47, 12, 1, '2017-11-13 19:26:41', '', ''),
(107, 23, 57, 9, 1, '2017-11-13 19:27:31', '', ''),
(108, 23, 56, 9, 1, '2017-11-13 19:27:55', '', ''),
(109, 23, 57, 9, 1, '2017-11-13 19:28:01', '', ''),
(110, 23, 56, 9, 1, '2017-11-13 19:28:34', '', ''),
(111, 23, 53, 10, 0, '2017-11-13 19:28:39', '', 'yellow'),
(112, 21, 12, 4, 1, '2017-11-13 19:28:48', '', ''),
(113, 21, 12, 4, 1, '2017-11-13 19:30:58', '', ''),
(114, 21, 12, 4, 1, '2017-11-13 19:31:44', '', ''),
(115, 21, 26, 5, 1, '2017-11-13 19:31:52', '', ''),
(116, 21, 11, 4, 0, '2017-11-13 19:32:34', '', 'yellow'),
(117, 21, 26, 5, 0, '2017-11-13 19:32:41', '', 'yellow'),
(118, 28, 20, 5, 0, '2017-11-13 19:36:45', 'yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `referee`
--

CREATE TABLE `referee` (
  `ref_id` int(10) NOT NULL,
  `ref_name` varchar(30) DEFAULT NULL,
  `uname` varchar(30) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referee`
--

INSERT INTO `referee` (`ref_id`, `ref_name`, `uname`, `phone`, `email`, `image`, `status`) VALUES
(8, 'Mr Davis', 'Gucci', '0703748544', 'bm@gmail.com', '', 'active'),
(9, 'Zac Beckham', 'brimas', '0703748544', 'bm@gmail.com', '', 'active'),
(10, 'Christopher Mwangi', 'tommy43', '0727497792', 'ck@gmail.com', '1510327154andre-marriner.jpg', 'active'),
(13, 'Mr Raul', 'tommy50', '0703748544', 'bm@gmail.com', '', 'active'),
(14, 'Liz Andrews', 'tommy52', '0703748549', 'bm@gmail1.com', '15098319937f796d57218d9cd81a92d9e6e8e51ce4--free-avatars-online-profile.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(20) NOT NULL,
  `team_name` varchar(50) DEFAULT NULL,
  `gender` varchar(30) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `coach_name` varchar(30) DEFAULT NULL,
  `constituency` varchar(30) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `gender`, `uname`, `phone`, `email`, `coach_name`, `constituency`, `image`) VALUES
(3, 'Ruai High School', 'boys', 'teamruai', '0703748544', 'ruaigirls@gmail.com', 'Mr Evans', 'kasarani', '1509030935american_soccer.png'),
(4, 'SpringField', 'boys', 'spring', '0703748544', 'bm@gmail.com', 'Mr Odanga', 'kamkunji', ''),
(5, 'Embakasi High', 'boys', 'embakasi', '0727407792', 'ma@gmail.com', 'Mr Raul', 'embakasi east', '1510242151Dallastown-Girls-Soccer-Logo.png'),
(9, 'Sunset High', 'boys', 'sunset', '0703748541', 'bm@gmail.com', 'Mr Aron Wachira', 'makadara', ''),
(10, 'Foothill High', 'boys', 'foothill', '0703748544', 'bm@gmail.com', 'Mrs Jeniffer Wairimu', 'embakasi east', '15093700603f5623655297e66116262e88b1500f4b--logo-retro-logo-sport.jpg'),
(11, 'Carroll High', 'mixed', 'carrol', '0703748544', 'bm@gmail.com', 'Mr Jake Wood', 'kasarani', '1509370218CarrollSoccerLogo.jpg'),
(12, 'Riverbank High', 'boys', 'river', '0703748544', 'bm@gmail.com', 'Mr James', 'westlands', '1510561200Boys-Soccer.jpg'),
(13, 'Summerfield  High', 'boys', 'summer', '0703748544', 'summmer@gmail.com', 'Mr Austin Moon', 'makadara', ''),
(14, 'Valley View High', 'boys', 'valley', '0703748544', 'valley@gmail.com', 'Mr Davis', 'makadara', '1510563375man37788.png'),
(15, 'Langata High', 'boys', 'langata', '0703748544', 'langata_high@gmail.com', 'Mr Dennis ', 'langata', '1510561521e3c593ffc1ce15ed88336c9146496559--soccer-stuff-us-soccer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL,
  `from_team_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `to_team_id` int(10) NOT NULL,
  `additional_info` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`transfer_id`, `player_id`, `from_team_id`, `start_date`, `end_date`, `to_team_id`, `additional_info`) VALUES
(5, 18, 5, '2017-11-01', '2017-11-07', 3, ''),
(6, 19, 5, '2017-11-11', '2017-11-09', 4, 'A Focused and talented player');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`league_id`),
  ADD KEY `management_id` (`official_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `match_fixtures`
--
ALTER TABLE `match_fixtures`
  ADD PRIMARY KEY (`match_fixture_id`),
  ADD KEY `league_id` (`league_id`),
  ADD KEY `referee_id` (`referee_id`),
  ADD KEY `team1_id` (`team1_id`,`team2_id`),
  ADD KEY `team2_id` (`team2_id`);

--
-- Indexes for table `match_results`
--
ALTER TABLE `match_results`
  ADD PRIMARY KEY (`match_result_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`official_id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `current_team_id` (`current_team_id`);

--
-- Indexes for table `player_stats`
--
ALTER TABLE `player_stats`
  ADD PRIMARY KEY (`stats_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `match_fixture_id` (`match_fixture_id`);

--
-- Indexes for table `referee`
--
ALTER TABLE `referee`
  ADD PRIMARY KEY (`ref_id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `from_team_id` (`from_team_id`),
  ADD KEY `to_team_id` (`to_team_id`),
  ADD KEY `player_id` (`player_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `league`
--
ALTER TABLE `league`
  MODIFY `league_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `match_fixtures`
--
ALTER TABLE `match_fixtures`
  MODIFY `match_fixture_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `match_results`
--
ALTER TABLE `match_results`
  MODIFY `match_result_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `player_stats`
--
ALTER TABLE `player_stats`
  MODIFY `stats_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `referee`
--
ALTER TABLE `referee`
  MODIFY `ref_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `league`
--
ALTER TABLE `league`
  ADD CONSTRAINT `league_ibfk_1` FOREIGN KEY (`official_id`) REFERENCES `officials` (`official_id`);

--
-- Constraints for table `match_fixtures`
--
ALTER TABLE `match_fixtures`
  ADD CONSTRAINT `match_fixtures_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `team` (`team_id`),
  ADD CONSTRAINT `match_fixtures_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `team` (`team_id`),
  ADD CONSTRAINT `match_fixtures_ibfk_3` FOREIGN KEY (`league_id`) REFERENCES `league` (`league_id`),
  ADD CONSTRAINT `match_fixtures_ibfk_4` FOREIGN KEY (`referee_id`) REFERENCES `referee` (`ref_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`current_team_id`) REFERENCES `team` (`team_id`);

--
-- Constraints for table `player_stats`
--
ALTER TABLE `player_stats`
  ADD CONSTRAINT `player_stats_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `player_stats_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`),
  ADD CONSTRAINT `player_stats_ibfk_3` FOREIGN KEY (`match_fixture_id`) REFERENCES `match_fixtures` (`match_fixture_id`);

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`from_team_id`) REFERENCES `team` (`team_id`),
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`to_team_id`) REFERENCES `team` (`team_id`),
  ADD CONSTRAINT `transfers_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
