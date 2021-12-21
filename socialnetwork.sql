-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 21 Δεκ 2021 στις 16:05:57
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
-- Δομή πίνακα για τον πίνακα `follow`
--

CREATE TABLE `follow` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `follow_user_id` int(10) UNSIGNED NOT NULL,
  `date_followed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `follow`
--

INSERT INTO `follow` (`user_id`, `follow_user_id`, `date_followed`) VALUES
(17, 7, '2021-12-03 09:11:19');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `message` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(463, 16, NULL, 'post 1\r\n', NULL, NULL, NULL, '2021-11-30 13:11:19', 0, 0, 0, 1, NULL, NULL, NULL),
(464, 7, NULL, 'post 2', NULL, NULL, NULL, '2021-11-30 13:11:24', 0, 0, 1, 0, NULL, NULL, NULL),
(507, 17, NULL, 'post 3', NULL, NULL, NULL, '2021-12-02 12:20:06', 0, 0, 1, 1, NULL, NULL, NULL),
(529, 7, 507, 'comment 1', NULL, NULL, NULL, '2021-12-20 10:15:26', 0, 0, 0, 0, NULL, NULL, NULL),
(553, 1, NULL, 'post 4', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 3, NULL, NULL, NULL),
(562, 17, 553, 'comment 2', NULL, NULL, NULL, '2021-12-20 11:06:26', 0, 0, 0, 0, NULL, NULL, NULL),
(563, 7, 553, 'comment 3', NULL, NULL, NULL, '2021-12-20 11:06:29', 0, 0, 0, 0, NULL, NULL, NULL),
(565, 16, 553, 'comment 4', NULL, NULL, NULL, '2021-12-20 12:19:47', 0, 0, 0, 0, NULL, NULL, NULL),
(567, 17, NULL, 'post 5', NULL, NULL, NULL, '2021-11-30 13:11:24', 0, 0, 1, 0, NULL, NULL, NULL),
(568, 16, NULL, 'post 6', NULL, NULL, NULL, '2021-12-02 12:20:06', 0, 0, 1, 1, NULL, NULL, NULL),
(569, 7, NULL, 'post 7', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 3, NULL, NULL, NULL),
(571, 1, NULL, 'post 8', NULL, NULL, NULL, '2021-11-30 13:11:24', 0, 0, 1, 0, NULL, NULL, NULL),
(572, 17, NULL, 'post 9', NULL, NULL, NULL, '2021-12-02 12:20:06', 0, 0, 1, 1, NULL, NULL, NULL),
(573, 7, NULL, 'post 10', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 3, NULL, NULL, NULL),
(574, 17, 553, 'comment 5', NULL, NULL, NULL, '2021-12-20 11:06:26', 0, 0, 0, 0, NULL, NULL, NULL),
(575, 7, 553, 'comment 6', NULL, NULL, NULL, '2021-12-20 11:06:29', 0, 0, 0, 0, NULL, NULL, NULL),
(576, 16, 553, 'comment 7', NULL, NULL, NULL, '2021-12-20 12:19:47', 0, 0, 0, 0, NULL, NULL, NULL),
(578, 17, NULL, 'post 11', NULL, NULL, NULL, '2021-11-30 13:11:24', 0, 0, 1, 1, NULL, NULL, NULL),
(579, 1, NULL, 'post 12', NULL, NULL, NULL, '2021-12-02 12:20:06', 0, 0, 1, 1, NULL, NULL, NULL),
(580, 7, NULL, 'post 13', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 3, NULL, NULL, NULL),
(581, 7, 578, 'text', NULL, NULL, NULL, '2021-12-20 15:52:13', 0, 0, 0, 0, NULL, NULL, NULL),
(582, 7, NULL, 'post 14', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 3, NULL, NULL, NULL),
(583, 7, NULL, 'post 15', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 0, NULL, NULL, NULL),
(585, 17, NULL, 'post 16', NULL, NULL, NULL, '2021-11-30 13:11:24', 0, 0, 1, 1, NULL, NULL, NULL),
(586, 1, NULL, 'post 17', NULL, NULL, NULL, '2021-12-02 12:20:06', 0, 0, 1, 1, NULL, NULL, NULL),
(587, 7, NULL, 'post 18', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 3, NULL, NULL, NULL),
(588, 7, NULL, 'post 19', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 0, 3, NULL, NULL, NULL),
(589, 7, NULL, 'post 20', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 0, NULL, NULL, NULL),
(590, 7, NULL, 'post 21', NULL, NULL, NULL, '2021-12-20 10:12:56', 0, 0, 1, 0, NULL, NULL, NULL);

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

--
-- Άδειασμα δεδομένων του πίνακα `posts_likes`
--

INSERT INTO `posts_likes` (`post_id`, `user_id`, `date`) VALUES
(464, 7, '2021-12-20 12:36:31'),
(507, 7, '2021-12-20 12:37:31'),
(573, 7, '2021-12-20 12:58:13'),
(579, 7, '2021-12-20 12:58:21'),
(553, 7, '2021-12-20 15:21:51'),
(578, 7, '2021-12-20 15:52:03'),
(569, 7, '2021-12-20 16:38:31'),
(580, 7, '2021-12-21 09:23:15'),
(582, 7, '2021-12-21 09:32:33'),
(583, 7, '2021-12-21 13:31:09'),
(589, 7, '2021-12-21 15:42:16'),
(590, 7, '2021-12-21 15:42:17'),
(587, 7, '2021-12-21 15:42:21');

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
(7, 'gregoris', 'Gregoris Bachtsevanos', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae amet aliquam saepe nemo ad ea quasi minima mollitia odio, ab cupiditate veritatis odit quisquam excepturi ex dignissimos dolores ipsa aut?', '4.jpg', 1, 1, 1, 0, NULL),
(16, 'mike', 'Mike Junior', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae sit delectus reiciendis suscipit exercitationem tempore laboriosam, maxime odit reprehenderit deleniti alias omnis libero vitae, neque quae modi laborum nam voluptatibus?', NULL, 1, 1, 0, 0, NULL),
(17, 'jason', 'Jason Pots', NULL, NULL, 1, 1, 0, 1, NULL);

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
  `instagram` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_registered` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users_extra_info`
--

INSERT INTO `users_extra_info` (`user_id`, `cover_image`, `phone_number`, `website`, `youtube`, `instagram`, `tiktok`, `date_registered`) VALUES
(1, 'novibet-1-1024x576-1.png', NULL, 'https://globalconcept.gr', '#', NULL, NULL, '2021-11-05 21:14:05'),
(7, NULL, '6972510728', 'https://www.google.com', 'https://www.youtube.com', 'https://www.instagram.com', 'https://www.tiktok.com', '2021-11-30 12:50:33'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(7, 'greg@gmail.com', '$2y$10$d.o/3uY7ixbh93UnR2OHAu7MDqzOQI6AcHqr47sI.bfdu37kKzBfO'),
(16, 'mike@gmail.com', '$2y$10$XOe0mxavNchcpj.BKtiaL.BZt2iFIytjPzEbdl.V9vUR6vzXKxGce'),
(17, 'jason@gmail.com', '$2y$10$j6qV5Sj55j2s6eAoARSR.OOg7GmUqHMoNuxBz5Y9uwtFwi2CpUb/q');

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
(7, 1, '2021-11-05 21:19:39', 1, '2021-11-06 19:33:06', 'Google Chrome', '::1', 'Windows 10'),
(8, 7, '2021-11-16 10:58:25', 1, '2021-11-16 11:16:46', 'Google Chrome', '::1', 'Windows 10'),
(9, 7, '2021-11-18 11:03:02', 1, '2021-11-18 11:03:36', 'Google Chrome', '::1', 'Windows 10');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`user_id`,`follow_user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follow_user_id` (`follow_user_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT για πίνακα `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_user_id` FOREIGN KEY (`follow_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_d` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
