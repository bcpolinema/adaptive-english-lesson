-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 06:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
  `subject_id` int(11) NOT NULL,
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

INSERT INTO `m_exercises` (`id`, `subject_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `option_e`, `answer_key`, `weight`, `ts_entri`) VALUES
(1, 2, 'Cum exercitation et', 'Asperiores nesciunt', 'Molestiae sed harum', 'Accusamus in Nam non', 'Possimus quo culpa', 'Dolores veniam dign', 'e', 2, '2022-07-13 10:14:02'),
(2, 2, 'Qui consequuntur do', 'Ipsum consequuntur', 'Ratione voluptatem', 'Quam quos ea autem e', 'Amet omnis consecte', 'Eius molestiae ea du', 'a', 4, '2022-07-13 10:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `m_std_exercises`
--

CREATE TABLE `m_std_exercises` (
  `id` bigint(20) NOT NULL,
  `learning_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `answer` char(1) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `score` smallint(11) NOT NULL,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_std_learnings`
--

CREATE TABLE `m_std_learnings` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `ts_start` datetime NOT NULL,
  `is_validated` tinyint(1) NOT NULL DEFAULT 0,
  `ts_exercise` datetime DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `next_learning` bigint(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_termination` tinyint(1) NOT NULL DEFAULT 0,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_subjects`
--

CREATE TABLE `m_subjects` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `topic_id` int(11) NOT NULL,
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
-- Dumping data for table `m_subjects`
--

INSERT INTO `m_subjects` (`id`, `title`, `topic_id`, `is_pretest`, `content`, `video`, `audio`, `image`, `youtube`, `route1`, `route2`, `route3`, `route4`, `ts_entri`) VALUES
(1, 'Maiores consequat A', 1, 1, 'Provident exercitat', NULL, NULL, NULL, 'Labore voluptatem N', 23, 11, 62, 46, '2022-07-08 10:19:22'),
(2, 'Listening TOEIC 1', 1, 1, 'Listening TOEIC 1', '', '', '', 'https://www.youtube.com/watch?v=vXeirwIW5N0&ab_channel=AvengedSevenfold-Topic', 94, 41, 71, 58, '2022-07-13 10:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `m_topics`
--

CREATE TABLE `m_topics` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `ts_entri` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_topics`
--

INSERT INTO `m_topics` (`id`, `name`, `description`, `ts_entri`) VALUES
(1, 'Listening', 'Pembelajaran listening', '2022-07-11 07:00:58'),
(2, 'Vocabulary', 'Pembelajaran vocabulary', '2022-07-11 07:01:17'),
(3, 'Grammar', 'Pembelajaran Grammar', '2022-07-11 08:14:54'),
(10, 'Clinton George', 'Rerum facilis veniam', '2022-07-20 01:20:13');

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
(3, 'Student 1', 'student@mail.com', NULL, '$2y$10$z.xakYmC5Qs6WPp9.rdelugKEZXNkLeVrnTVnIF/uq06T4di7uSwG', 'student', NULL, '2022-07-13 10:15:10', '2022-07-13 10:15:10');

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
  ADD KEY `const_study` (`subject_id`);

--
-- Indexes for table `m_std_exercises`
--
ALTER TABLE `m_std_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_exc_to_learning` (`learning_id`),
  ADD KEY `std_exc_to_exercise` (`exercise_id`),
  ADD KEY `std_exc_to_user` (`user_id`);

--
-- Indexes for table `m_std_learnings`
--
ALTER TABLE `m_std_learnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_learning_to_sbj` (`subject_id`),
  ADD KEY `std_learning_to_user` (`user_id`),
  ADD KEY `route_study` (`next_learning`);

--
-- Indexes for table `m_subjects`
--
ALTER TABLE `m_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `study_to_topic` (`topic_id`);

--
-- Indexes for table `m_topics`
--
ALTER TABLE `m_topics`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_std_exercises`
--
ALTER TABLE `m_std_exercises`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_std_learnings`
--
ALTER TABLE `m_std_learnings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_subjects`
--
ALTER TABLE `m_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_topics`
--
ALTER TABLE `m_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_exercises`
--
ALTER TABLE `m_exercises`
  ADD CONSTRAINT `const_study` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`id`);

--
-- Constraints for table `m_std_exercises`
--
ALTER TABLE `m_std_exercises`
  ADD CONSTRAINT `std_exc_to_exercise` FOREIGN KEY (`exercise_id`) REFERENCES `m_exercises` (`id`),
  ADD CONSTRAINT `std_exc_to_learning` FOREIGN KEY (`learning_id`) REFERENCES `m_std_learnings` (`id`),
  ADD CONSTRAINT `std_exc_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `m_std_learnings`
--
ALTER TABLE `m_std_learnings`
  ADD CONSTRAINT `m_std_learnings_ibfk_1` FOREIGN KEY (`next_learning`) REFERENCES `m_std_learnings` (`id`),
  ADD CONSTRAINT `std_learning_to_sbj` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`id`),
  ADD CONSTRAINT `std_learning_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `m_subjects`
--
ALTER TABLE `m_subjects`
  ADD CONSTRAINT `study_to_topic` FOREIGN KEY (`topic_id`) REFERENCES `m_topics` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
