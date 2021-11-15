-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 15 Νοε 2021 στις 12:06:45
-- Έκδοση διακομιστή: 10.4.21-MariaDB
-- Έκδοση PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `message` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `total_views` int(10) UNSIGNED DEFAULT 0,
  `total_reposts` int(10) UNSIGNED DEFAULT 0,
  `total_likes` int(10) UNSIGNED DEFAULT 0,
  `total_comments` int(10) UNSIGNED DEFAULT 0,
  `mentions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hashtags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repost_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `parent_id`, `message`, `video`, `images`, `audio`, `date_created`, `total_views`, `total_reposts`, `total_likes`, `total_comments`, `mentions`, `hashtags`, `repost_id`) VALUES
(35, 11, NULL, 'i am a new feed', NULL, NULL, NULL, '2021-11-10 10:17:08', 0, 0, 0, 0, NULL, NULL, NULL),
(49, 7, NULL, 'and anohter feed ', NULL, NULL, NULL, '2021-11-12 03:39:50', 0, 0, 0, 0, NULL, NULL, NULL),
(55, 7, NULL, 'and one post', NULL, NULL, NULL, '2021-11-12 03:50:09', 0, 0, 0, 0, NULL, NULL, NULL),
(58, 7, NULL, 'and one more', NULL, NULL, NULL, '2021-11-12 03:54:38', 0, 0, 0, 0, NULL, NULL, NULL),
(59, 7, NULL, 'and one more', NULL, NULL, NULL, '2021-11-12 04:00:15', 0, 0, 0, 0, NULL, NULL, NULL),
(60, 7, NULL, 'ασδφ', NULL, NULL, NULL, '2021-11-15 07:13:29', 0, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts_hashtags`
--

CREATE TABLE `posts_hashtags` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `hashtag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts_likes`
--

CREATE TABLE `posts_likes` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts_mentions`
--

CREATE TABLE `posts_mentions` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts_views`
--

CREATE TABLE `posts_views` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT 1,
  `status` tinyint(4) DEFAULT 0,
  `followers` int(10) UNSIGNED DEFAULT 0,
  `following` int(10) UNSIGNED DEFAULT 0,
  `auth_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `bio`, `avatar`, `type`, `status`, `followers`, `following`, `auth_key`) VALUES
(1, 'nikos', 'Nikos Antoniadis', 'Καλημέρα κόσμε!', NULL, 1, 1, 0, 0, '6a8ywu9xh3uxgie9vla6b9bcwab5qm50'),
(7, 'gregoris', 'Gregoris Bachtsevanos', NULL, NULL, 1, 1, 0, 0, NULL),
(11, 'jason', 'jason born', NULL, NULL, 1, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users_extra_info`
--

CREATE TABLE `users_extra_info` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `cover_image` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_registered` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users_extra_info`
--

INSERT INTO `users_extra_info` (`user_id`, `cover_image`, `phone_number`, `website`, `youtube`, `date_registered`) VALUES
(1, 'novibet-1-1024x576-1.png', NULL, 'https://globalconcept.gr', '#', '2021-11-05 21:14:05');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users_login`
--

CREATE TABLE `users_login` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users_login`
--

INSERT INTO `users_login` (`user_id`, `email`, `password`) VALUES
(1, 'antoniadis.gr@gmail.com', '$2y$10$z2uvLoNJsxbbcw9IfAFvMO1iOdbawPm6lXcwQpKZyXs800YL3to9e'),
(7, 'greg@gmail.com', '$2y$10$swZsi2JKFqwwr0j.ax5dguYGwtPTcDeER1zS7.IscVgYlADB1IvcC'),
(11, 'jason#@gmail.com', '$2y$10$6FotnrvOQW0PgO9pCTFCL.KAzGAP1y2X690B.v.2hYQ9yEYgoqicS');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users_login_history`
--

CREATE TABLE `users_login_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `output` tinyint(4) DEFAULT NULL,
  `last_online` datetime DEFAULT NULL,
  `browser` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users_login_history`
--

INSERT INTO `users_login_history` (`id`, `user_id`, `date`, `output`, `last_online`, `browser`, `ip`, `os`) VALUES
(1, 1, '2021-11-05 21:14:46', 0, '2021-11-05 21:14:46', 'Google Chrome', '::1', 'Windows 10'),
(2, 1, '2021-11-05 21:14:51', 0, '2021-11-05 21:14:51', 'Google Chrome', '::1', 'Windows 10'),
(3, 1, '2021-11-05 21:14:56', 1, '2021-11-05 21:14:56', 'Google Chrome', '::1', 'Windows 10'),
(4, 1, '2021-11-05 21:18:56', 0, '2021-11-05 21:18:56', 'Google Chrome', '::1', 'Windows 10'),
(5, 1, '2021-11-05 21:19:00', 1, '2021-11-05 21:19:00', 'Google Chrome', '::1', 'Windows 10'),
(6, 1, '2021-11-05 21:19:35', 0, '2021-11-05 21:19:35', 'Google Chrome', '::1', 'Windows 10'),
(7, 1, '2021-11-05 21:19:39', 1, '2021-11-06 19:33:06', 'Google Chrome', '::1', 'Windows 10');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id` (`user_id`),
  ADD KEY `posts_parent_id` (`parent_id`),
  ADD KEY `posts_date_created` (`date_created`) USING BTREE,
  ADD KEY `posts_report_id` (`repost_id`);

--
-- Ευρετήρια για πίνακα `posts_hashtags`
--
ALTER TABLE `posts_hashtags`
  ADD PRIMARY KEY (`post_id`,`hashtag`);

--
-- Ευρετήρια για πίνακα `posts_likes`
--
ALTER TABLE `posts_likes`
  ADD KEY `posts_likes_post_id` (`post_id`),
  ADD KEY `posts_likes_user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `posts_mentions`
--
ALTER TABLE `posts_mentions`
  ADD PRIMARY KEY (`post_id`,`user_id`),
  ADD KEY `posts_mentions_user_id` (`user_id`),
  ADD KEY `posts_mentions_is_read` (`is_read`);

--
-- Ευρετήρια για πίνακα `posts_views`
--
ALTER TABLE `posts_views`
  ADD KEY `posts_views_post_id` (`post_id`),
  ADD KEY `posts_views_user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username` (`username`) USING BTREE,
  ADD KEY `users_status` (`status`) USING BTREE,
  ADD KEY `users_full_name` (`fullname`) USING BTREE;

--
-- Ευρετήρια για πίνακα `users_extra_info`
--
ALTER TABLE `users_extra_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Ευρετήρια για πίνακα `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_login_email` (`email`);

--
-- Ευρετήρια για πίνακα `users_login_history`
--
ALTER TABLE `users_login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_login_history_user_id` (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT για πίνακα `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `posts_report_id` FOREIGN KEY (`repost_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `posts_hashtags`
--
ALTER TABLE `posts_hashtags`
  ADD CONSTRAINT `posts_hashtags_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Περιορισμοί για πίνακα `posts_likes`
--
ALTER TABLE `posts_likes`
  ADD CONSTRAINT `posts_likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `posts_likes_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `posts_mentions`
--
ALTER TABLE `posts_mentions`
  ADD CONSTRAINT `posts_mentions_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `posts_mentions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `posts_views`
--
ALTER TABLE `posts_views`
  ADD CONSTRAINT `posts_views_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `posts_views_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `users_extra_info`
--
ALTER TABLE `users_extra_info`
  ADD CONSTRAINT `users_extra_info_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `users_login_history`
--
ALTER TABLE `users_login_history`
  ADD CONSTRAINT `users_login_history_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
