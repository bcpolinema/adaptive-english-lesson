-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 05:45 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_000000_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_exercises`
--

CREATE TABLE `m_exercises` (
  `id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(200) NOT NULL,
  `option_b` varchar(200) NOT NULL,
  `option_c` varchar(200) NOT NULL,
  `option_d` varchar(200) NOT NULL,
  `option_e` varchar(200) NOT NULL,
  `answer_key` varchar(5) NOT NULL,
  `weight` smallint(6) NOT NULL DEFAULT 1,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_exercises`
--

INSERT INTO `m_exercises` (`id`, `level_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `option_e`, `answer_key`, `weight`, `ts_entri`) VALUES
(1, 2, 'Cum exercitation et', 'Asperiores nesciunt', 'Molestiae sed harum', 'Accusamus in Nam non', 'Possimus quo culpa', 'Dolores veniam dign', 'E', 2, '2022-08-04 13:26:12'),
(2, 1, 'Qui consequuntur do', 'Ipsum consequuntur', 'Ratione voluptatem', 'Quam quos ea autem e', 'Amet omnis consecte', 'Eius molestiae ea du', 'A', 4, '2022-08-07 15:55:41'),
(5, 20, 'Apakah Singa itu Mamalia?', 'Bukan', 'Bukan', 'Bukan', 'Bukan', 'Bukan', 'B', 2, '2022-08-10 01:10:06'),
(7, 20, 'apakah ini soal?', 'ya', 'tidak', 'ya', 'ya', 'ya', 'A', 2, '2022-09-05 13:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `m_levels`
--

CREATE TABLE `m_levels` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `is_pretest` tinyint(1) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `audio` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `route1` int(11) NOT NULL,
  `route2` int(11) NOT NULL,
  `route3` int(11) NOT NULL,
  `route4` int(11) NOT NULL,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_levels`
--

INSERT INTO `m_levels` (`id`, `title`, `subject_id`, `topic_id`, `is_pretest`, `content`, `video`, `audio`, `image`, `youtube`, `route1`, `route2`, `route3`, `route4`, `ts_entri`) VALUES
(1, '1', 1, 12, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 2, 2, 20, '2022-12-03 13:53:43'),
(2, '1', 1, 13, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 2, 2, 20, '2022-12-07 01:29:36'),
(20, '1', 1, 14, 0, 'あなたの声が道しるべ あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ  あなたの声が道しるべ', 'Violet Evergarden ED - \'Michishirube\' (Piano _ Orchestral).mp4', '[Ada2Ajh]~Minori Chihara - Michishirube.mp3', 'wallpaperflare.com_wallpaper (1).jpg', 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 20, 20, 20, 20, '2022-12-07 01:29:44'),
(38, '1', 1, 15, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 2, 20, 38, '2022-12-07 01:29:51'),
(39, '2', 1, 12, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 1, 1, 1, '2022-12-08 02:01:21'),
(40, '3', 1, 12, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 39, 1, 39, '2022-12-08 02:01:25'),
(41, '4', 1, 12, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 39, 40, 1, '2022-12-08 02:01:33'),
(42, '5', 1, 12, 0, 'tes', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=NeQM1c-XCDc', 1, 39, 40, 41, '2022-12-08 02:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `m_std_exercises`
--

CREATE TABLE `m_std_exercises` (
  `id` bigint(20) NOT NULL,
  `std_learning_id` bigint(20) DEFAULT NULL,
  `exercise_id` int(11) NOT NULL,
  `answer` char(1) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `score` smallint(11) NOT NULL,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_std_exercises`
--

INSERT INTO `m_std_exercises` (`id`, `std_learning_id`, `exercise_id`, `answer`, `is_correct`, `score`, `ts_entri`) VALUES
(95, 171, 5, 'B', 1, 2, '2022-12-03 14:21:41'),
(96, 171, 7, 'A', 1, 2, '2022-12-03 14:21:41'),
(97, 174, 2, 'B', 0, 0, '2022-12-06 10:29:27'),
(98, 178, 2, 'B', 0, 0, '2022-12-07 01:25:06'),
(99, 180, 2, 'B', 0, 0, '2022-12-08 01:41:15'),
(100, 207, 2, 'B', 0, 0, '2022-12-08 02:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `m_std_learnings`
--

CREATE TABLE `m_std_learnings` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `ts_start` datetime NOT NULL,
  `is_validated` tinyint(1) NOT NULL DEFAULT 0,
  `ts_exercise` datetime DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `next_learning` bigint(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_termination` tinyint(1) NOT NULL DEFAULT 0,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_std_learnings`
--

INSERT INTO `m_std_learnings` (`id`, `user_id`, `level_id`, `ts_start`, `is_validated`, `ts_exercise`, `score`, `next_learning`, `comment`, `is_termination`, `ts_entri`) VALUES
(171, 9, 20, '2022-12-03 21:20:58', 0, '2022-12-03 21:21:25', 4, NULL, NULL, 0, '2022-12-03 14:21:41'),
(174, 9, 1, '2022-12-06 17:29:19', 0, '2022-12-06 17:29:22', 0, NULL, NULL, 0, '2022-12-06 10:29:27'),
(178, 9, 1, '2022-12-07 08:24:54', 0, '2022-12-07 08:25:02', 0, NULL, NULL, 0, '2022-12-07 01:25:06'),
(180, 9, 1, '2022-12-08 08:34:57', 0, '2022-12-08 08:35:00', 0, NULL, 'ini komen', 0, '2022-12-08 01:41:15'),
(207, 9, 1, '2022-12-08 09:22:15', 0, '2022-12-08 09:22:17', 0, NULL, 'tes', 0, '2022-12-08 02:22:22'),
(211, 9, 1, '2022-12-09 17:40:22', 0, NULL, NULL, NULL, NULL, 0, '2022-12-09 10:40:22'),
(212, 9, 39, '2022-12-09 17:40:26', 0, NULL, NULL, NULL, NULL, 0, '2022-12-09 10:40:26'),
(213, 9, 1, '2022-12-09 17:41:17', 0, NULL, NULL, NULL, NULL, 0, '2022-12-09 10:41:17'),
(214, 9, 39, '2022-12-09 17:41:25', 0, NULL, NULL, NULL, NULL, 0, '2022-12-09 10:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `m_subjects`
--

CREATE TABLE `m_subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_subjects`
--

INSERT INTO `m_subjects` (`id`, `name`, `description`, `icon`, `thumbnail`, `ts_entri`) VALUES
(1, 'Listening', 'Listening section is designed to measure your ability to understand conversations and lectures in English', 'headphones-listening-svgrepo-com.ico', 'listening.jpg', '2022-08-13 11:50:59'),
(2, 'Vocabulary', '​Vocabulary is an important focus of literacy teaching and refers to the knowledge or words', '987811.ico', 'vocabulary.jpg', '2022-08-13 11:51:13'),
(3, 'Grammar', 'Grammar is the breaking down of the building blocks, or parts of speech, in language, and the use of those pieces to form complete sentences.', '2463150.png', 'wp11021892-grammar-wallpapers.jpg', '2022-08-13 11:54:46'),
(10, 'Reading', 'Reading is defined as a cognitive process that involves decoding symbols to arrive at meaning', '201612.png', 'wallpaperflare.com_wallpaper (2).jpg', '2022-08-13 11:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `m_topics`
--

CREATE TABLE `m_topics` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ts_entri` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_topics`
--

INSERT INTO `m_topics` (`id`, `subject_id`, `title`, `ts_entri`) VALUES
(1, 10, 'Talking about Self (emails)', '2022-11-22 04:13:55'),
(2, 10, 'Congratulating & Complimenting Others', '2022-11-22 04:19:06'),
(3, 10, 'Talking About Intentions', '2022-11-22 04:19:25'),
(4, 10, 'Presenting Information', '2022-11-22 04:19:49'),
(5, 10, 'Describing a Place', '2022-11-22 04:19:58'),
(6, 10, 'Giving Information to Public', '2022-11-22 04:21:29'),
(7, 10, 'Retelling Past Events', '2022-11-22 04:21:41'),
(8, 10, 'Entertaining', '2022-11-22 04:22:21'),
(9, 10, 'Introducing Moral Values', '2022-11-22 04:22:35'),
(10, 10, 'Developing Interactional Communication', '2022-11-22 04:22:56'),
(11, 10, 'Appreciating Cultural Values', '2022-11-22 04:23:15'),
(12, 1, 'Talking about Self', '2022-11-22 04:24:46'),
(13, 1, 'Congratulating & Complimenting Others', '2022-11-22 04:25:01'),
(14, 1, 'Talking About Intentions', '2022-11-22 04:25:13'),
(15, 1, 'Presenting Information', '2022-11-22 04:25:20'),
(16, 1, 'Describing a Place', '2022-11-22 04:59:33'),
(17, 1, 'Giving Information to Public', '2022-11-22 05:00:20'),
(18, 1, 'Retelling Past Events', '2022-11-22 05:00:30'),
(19, 1, 'Entertaining', '2022-11-22 05:00:39'),
(20, 1, 'Introducing Moral Values', '2022-11-22 05:00:49'),
(21, 1, 'Developing Interactional Communication', '2022-11-22 05:01:05'),
(22, 1, 'Appreciating Cultural Values', '2022-11-22 05:01:19'),
(23, 2, 'Talking about Self', '2022-11-22 05:03:42'),
(24, 2, 'Congratulating & Complimenting Others', '2022-11-22 05:03:54'),
(25, 2, 'Recreation; Holidays', '2022-11-22 05:04:05'),
(26, 2, 'Ecotourism, Historical Buildings', '2022-11-22 05:04:25'),
(27, 2, 'Recreational Places', '2022-11-22 05:04:40'),
(28, 2, 'Public Places', '2022-11-22 05:04:53'),
(29, 2, 'Idol', '2022-11-22 05:04:58'),
(30, 2, 'Past Events', '2022-11-22 05:05:07'),
(31, 2, 'Prominent Figures', '2022-11-22 05:05:20'),
(32, 2, 'Folktales', '2022-11-22 05:05:31'),
(33, 2, 'Life of Famous People', '2022-11-22 05:05:46'),
(34, 2, 'Characters', '2022-11-22 05:05:54'),
(35, 2, 'Friendship', '2022-11-22 05:06:01'),
(36, 3, 'Pronouns', '2022-11-22 05:06:37'),
(37, 3, 'Noun Phrases', '2022-11-22 05:06:52'),
(38, 3, 'Derivatives: Nouns from Verbs', '2022-11-22 05:07:20'),
(39, 3, 'Adjectives and Adverbs', '2022-11-22 05:07:36'),
(40, 3, 'Adverbial Clauses; Adverbial Phrases', '2022-11-22 05:08:04'),
(41, 3, 'Adverb of Time Clauses', '2022-11-22 05:08:17'),
(42, 3, 'Would Like; Be going to', '2022-11-22 05:08:29'),
(43, 3, 'Simple Past; Adjectives', '2022-11-22 05:08:42'),
(44, 3, 'Simple Past, Present Perfect', '2022-11-22 05:08:57'),
(45, 3, 'Reported Speech vs. Direct Speech', '2022-11-22 05:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', 'admin@mail.com', NULL, '$2y$10$dp/EIXyLSnw0yM6nHB4P0eXpNSKqVYjXd6lA25WD6wR7SxefaxUJe', 'admin', NULL, '2022-07-06 01:58:07', '2022-07-06 01:58:07'),
(3, 'Student 1', 'student@mail.com', NULL, '$2y$10$z.xakYmC5Qs6WPp9.rdelugKEZXNkLeVrnTVnIF/uq06T4di7uSwG', 'student', NULL, '2022-07-13 10:15:10', '2022-07-13 10:15:10'),
(9, 'yusuf', 'mchyush@gmail.com', NULL, '$2y$10$lMuS0dP8Hi2C/J4E058b0ObXOHzR6jRDI9VjRzdMoD2i.wYGCQmb2', 'student', NULL, '2022-08-04 14:37:22', '2022-08-04 14:37:22'),
(10, 'tes', 'tes@mail.com', NULL, '$2y$10$pid1hBAaQ4Ln4Km7ZeyEZ.S6jex8zLPPsIbk.CHy10kRcMh2MT3/C', 'student', NULL, '2022-11-29 01:33:42', '2022-11-29 01:33:42');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view1`
-- (See below for the actual view)
--
CREATE TABLE `view1` (
`id` int(11)
,`level_id` int(11)
,`question` text
,`option_a` varchar(200)
,`option_b` varchar(200)
,`option_c` varchar(200)
,`option_d` varchar(200)
,`option_e` varchar(200)
,`answer_key` varchar(5)
,`weight` smallint(6)
,`ts_entri` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_std_exercises`
-- (See below for the actual view)
--
CREATE TABLE `v_std_exercises` (
`id` bigint(20)
,`std_learning_id` bigint(20)
,`exercise_id` int(11)
,`answer` char(1)
,`is_correct` tinyint(1)
,`score` smallint(11)
,`answer_key` varchar(5)
,`weight` smallint(6)
,`question` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_std_exercises_route`
-- (See below for the actual view)
--
CREATE TABLE `v_std_exercises_route` (
`std_learning_id` bigint(20)
,`score_exercise` decimal(39,4)
,`level_id` int(11)
,`ROUTE` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_std_exercises_score`
-- (See below for the actual view)
--
CREATE TABLE `v_std_exercises_score` (
`std_learning_id` bigint(20)
,`score_exercise` decimal(39,4)
);

-- --------------------------------------------------------

--
-- Structure for view `view1`
--
DROP TABLE IF EXISTS `view1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view1`  AS SELECT `m_exercises`.`id` AS `id`, `m_exercises`.`level_id` AS `level_id`, `m_exercises`.`question` AS `question`, `m_exercises`.`option_a` AS `option_a`, `m_exercises`.`option_b` AS `option_b`, `m_exercises`.`option_c` AS `option_c`, `m_exercises`.`option_d` AS `option_d`, `m_exercises`.`option_e` AS `option_e`, `m_exercises`.`answer_key` AS `answer_key`, `m_exercises`.`weight` AS `weight`, `m_exercises`.`ts_entri` AS `ts_entri` FROM `m_exercises` ;

-- --------------------------------------------------------

--
-- Structure for view `v_std_exercises`
--
DROP TABLE IF EXISTS `v_std_exercises`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_std_exercises`  AS SELECT `a`.`id` AS `id`, `a`.`std_learning_id` AS `std_learning_id`, `a`.`exercise_id` AS `exercise_id`, `a`.`answer` AS `answer`, `a`.`is_correct` AS `is_correct`, `a`.`score` AS `score`, `b`.`answer_key` AS `answer_key`, `b`.`weight` AS `weight`, `b`.`question` AS `question` FROM (`m_std_exercises` `a` join `m_exercises` `b` on(`a`.`exercise_id` = `b`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_std_exercises_route`
--
DROP TABLE IF EXISTS `v_std_exercises_route`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_std_exercises_route`  AS SELECT `a`.`std_learning_id` AS `std_learning_id`, `a`.`score_exercise` AS `score_exercise`, `b`.`level_id` AS `level_id`, if(`a`.`score_exercise` < 26,`c`.`route1`,if(`a`.`score_exercise` < 51,`c`.`route2`,if(`a`.`score_exercise` < 76,`c`.`route3`,`c`.`route4`))) AS `ROUTE` FROM ((`v_std_exercises_score` `a` join `m_std_learnings` `b` on(`a`.`std_learning_id` = `b`.`id`)) join `m_levels` `c` on(`b`.`level_id` = `c`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_std_exercises_score`
--
DROP TABLE IF EXISTS `v_std_exercises_score`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_std_exercises_score`  AS SELECT `v_std_exercises`.`std_learning_id` AS `std_learning_id`, sum(`v_std_exercises`.`score`) / sum(`v_std_exercises`.`weight`) * 100 AS `score_exercise` FROM `v_std_exercises` GROUP BY `v_std_exercises`.`std_learning_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_exercises`
--
ALTER TABLE `m_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `const_study` (`level_id`);

--
-- Indexes for table `m_levels`
--
ALTER TABLE `m_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `study_to_topic` (`subject_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `m_std_exercises`
--
ALTER TABLE `m_std_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_exc_to_exercise` (`exercise_id`),
  ADD KEY `std_exc_to_user` (`std_learning_id`);

--
-- Indexes for table `m_std_learnings`
--
ALTER TABLE `m_std_learnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_learning_to_sbj` (`level_id`),
  ADD KEY `std_learning_to_user` (`user_id`),
  ADD KEY `route_study` (`next_learning`);

--
-- Indexes for table `m_subjects`
--
ALTER TABLE `m_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_topics`
--
ALTER TABLE `m_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_exercises`
--
ALTER TABLE `m_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_levels`
--
ALTER TABLE `m_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `m_std_exercises`
--
ALTER TABLE `m_std_exercises`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `m_std_learnings`
--
ALTER TABLE `m_std_learnings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `m_subjects`
--
ALTER TABLE `m_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `m_topics`
--
ALTER TABLE `m_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_exercises`
--
ALTER TABLE `m_exercises`
  ADD CONSTRAINT `const_study` FOREIGN KEY (`level_id`) REFERENCES `m_levels` (`id`);

--
-- Constraints for table `m_levels`
--
ALTER TABLE `m_levels`
  ADD CONSTRAINT `level_to_topic` FOREIGN KEY (`topic_id`) REFERENCES `m_topics` (`id`),
  ADD CONSTRAINT `study_to_topic` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`id`);

--
-- Constraints for table `m_std_exercises`
--
ALTER TABLE `m_std_exercises`
  ADD CONSTRAINT `std_exc_to_exercise` FOREIGN KEY (`exercise_id`) REFERENCES `m_exercises` (`id`),
  ADD CONSTRAINT `std_exc_to_std_learning` FOREIGN KEY (`std_learning_id`) REFERENCES `m_std_learnings` (`id`);

--
-- Constraints for table `m_std_learnings`
--
ALTER TABLE `m_std_learnings`
  ADD CONSTRAINT `m_std_learnings_ibfk_1` FOREIGN KEY (`next_learning`) REFERENCES `m_std_learnings` (`id`),
  ADD CONSTRAINT `std_learning_to_sbj` FOREIGN KEY (`level_id`) REFERENCES `m_levels` (`id`),
  ADD CONSTRAINT `std_learning_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `m_topics`
--
ALTER TABLE `m_topics`
  ADD CONSTRAINT `topics_to_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
