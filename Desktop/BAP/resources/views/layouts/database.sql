-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 26, 2020 at 04:49 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bap`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `author`, `author_id`, `title`, `content`, `image_name`) VALUES
(24, 'Owen De Waele', 1, 'Article with support files', '<p><strong>Lorem ipsum dolo</strong>r sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', 'home-banner-greyscale.jpg'),
(25, 'Owen De Waele', 1, 'article 2', '<p>Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit ametLorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit ametLorem ipsum t amet Lorem ipsum&nbsp; dorem sit ametLorem ipsum dorem sit ametLorem ipsum dorem sit ametLorem ipsum dorem sit amet Lorem ipsum dorem sit amet&nbsp; Lorem ipsum dorem sit ameLorem ipsum dorem sit ametLorem ipsum dorem sit ametLorem ipsum dorem sit amet&nbsp;Lorem ipsum dorem sit ametLorem ipsum dorem sit ametLorem ipsum dorem sit ametLorem ipsum&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'home-banner.jpg'),
(27, 'Owen De Waele', 1, 'Puffskein 123', '<p>article 1 content</p>', 'home-banner.jpg'),
(28, 'Owen De Waele', 1, 'test article', 'test test test test', 'logo2.png'),
(29, 'Owen De Waele', 1, 'test artikel', '<p><strong>Lorem ipsum dolo</strong>r sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>', 'Database ER implementatie.png'),
(30, 'Test User', 2, 'test article 3', '<p><strong>Lorem ipsum dolo</strong>r sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n\r\n\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', 'home-banner-greyscale.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `tutorial_id` int(11) DEFAULT NULL,
  `content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `thread_id`, `article_id`, `tutorial_id`, `content`) VALUES
(2, 1, 1, NULL, NULL, '<p>De beste manier is <strong><em>ziff</em></strong> kuisproduct naar mijn mening</p>'),
(3, 2, 1, NULL, NULL, '<p><strong>Ik&nbsp;</strong>vind persoonlijk dat de beste manier zeep is in combinatie met natte doekjes</p>'),
(4, 1, 1, NULL, NULL, '<p><strong>Ik denk dat de beste manier is om gewoon niks vuil te maken</strong></p>'),
(5, 1, 2, NULL, NULL, '<p><em>Door te&nbsp;</em><strong>OEFENEN</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event-signs`
--

CREATE TABLE `event-signs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event-signs`
--

INSERT INTO `event-signs` (`id`, `user_id`, `event_id`) VALUES
(2, 2, 4),
(3, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `author`, `author_id`, `title`, `description`, `capacity`, `location`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(14, 'Owen De Waele2', 1, 'test event 1', 'test event 1', 1, 'test locatie 24, Gent', '2020-12-25', '2020-12-25', '23:59', '23:59'),
(15, 'Owen De Waele2', 1, 'test event 2', 'test event 2', 1, 'test locatie 24, Gent', '2020-12-26', '2020-12-26', '00:00', '00:00'),
(16, 'Owen De Waele2', 1, 'Puffskein 2', 'Puffskein 2 info', 3, 'test locatie 24, Gent', '2020-12-26', '2020-12-26', '00:08', '00:08'),
(17, 'Owen De Waele2', 1, 'Puffskein 2', 'sdfsdfsdfsdfdsfsdfsdfsdfsdfdsfsdfsdfsdfsdfdsfsdfsdfsdfsdfdsf', 3, 'test locatie 24, Gent', '2020-12-26', '2020-12-26', '00:26', '00:26');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
(35552666, 2, 1, '2020-11-30 12:28:09', '2020-11-30 12:28:09'),
(66986259, 1, 2, '2020-11-30 12:37:55', '2020-11-30 12:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `tutorial_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(1617929207, 'user', 2, 2, 'hello', NULL, 1, '2020-11-30 12:28:32', '2020-11-30 12:28:32'),
(1767562117, 'user', 2, 2, 'hi', NULL, 1, '2020-11-30 12:26:08', '2020-11-30 12:26:08'),
(1778401644, 'user', 2, 2, 'test message', NULL, 1, '2020-11-30 12:31:09', '2020-11-30 12:31:09'),
(1867238957, 'user', 2, 1, 'message 1', NULL, 1, '2020-12-04 10:34:30', '2020-12-04 10:47:11'),
(1889024561, 'user', 1, 2, 'hello', NULL, 1, '2020-11-30 12:29:44', '2020-11-30 12:30:35'),
(1894571100, 'user', 2, 1, 'message 2', NULL, 1, '2020-12-04 10:34:33', '2020-12-04 10:47:11'),
(2205214837, 'user', 2, 1, 'hi', NULL, 1, '2020-11-30 12:26:30', '2020-11-30 12:29:41'),
(2212885180, 'user', 1, 2, 'how do you do?', NULL, 1, '2020-11-30 12:29:57', '2020-11-30 12:30:35'),
(2249346388, 'user', 1, 2, 'i\'m doing good', NULL, 1, '2020-11-30 12:30:07', '2020-11-30 12:30:35'),
(2253232925, 'user', 2, 1, 'hello again', NULL, 1, '2020-12-15 19:25:55', '2020-12-15 19:40:37'),
(2290605450, 'user', 2, 1, 'how about you?', NULL, 1, '2020-11-30 12:30:40', '2020-11-30 12:34:05'),
(2345652891, 'user', 2, 1, 'banner image', '65d789d8-a937-4936-bee2-f6f576a67f0a.jpg,home-banner-greyscale.jpg', 1, '2020-11-30 12:33:35', '2020-11-30 12:34:05'),
(2528135744, 'user', 2, 1, 'test message 1', NULL, 1, '2020-12-04 10:53:51', '2020-12-10 12:20:01');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_22_192348_create_messages_table', 2),
(5, '2019_10_16_211433_create_favorites_table', 2),
(6, '2019_10_18_223259_add_avatar_to_users', 2),
(7, '2019_10_20_211056_add_messenger_color_to_users', 2),
(8, '2019_10_22_000539_add_dark_mode_to_users', 2),
(9, '2019_10_25_214038_add_active_status_to_users', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `content`) VALUES
(22, 1, 'display-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-container'),
(23, 1, 'display-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-container'),
(24, 1, 'display-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-containerdisplay-notes-container');

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
-- Table structure for table `profile_image`
--

CREATE TABLE `profile_image` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_image`
--

INSERT INTO `profile_image` (`id`, `user_id`, `image`) VALUES
(1, 1, 'me.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `replies` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `author`, `author_id`, `title`, `question`, `likes`, `replies`, `views`) VALUES
(1, 'Owen De Waele', 1, 'Wat is de beste manier om te desinfecteren bla', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, NULL),
(2, 'Owen De Waele 2', 2, 'Hoe kan ik het beste tribal aanleren?', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, NULL),
(3, 'Owen De Waele', 1, 'Wat zijn de beste naalden?', 'Ik ben op zoek naar de beste naalden heeft iemand hier meer info over', NULL, NULL, NULL),
(4, 'Owen De Waele2', 1, 'wqsdfgh jknbhgvytcdrxteswrzesx rdtfygbuhnjiok', 'jiuohyigtufrydtfgyhunjikol;k,jnhbgvfcyd rxtesrwertyuiop^lokijuhygtfrde§\'edr(f§tèyh!uçioplokijuohyigtuyretzrtyuiopkijuohyigtufrydeszedr§tèy! uçiàolplokijuhygtfrdese\'(r§tèy!uçiàop', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro` varchar(500) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `type` int(11) NOT NULL,
  `small_image_one` int(11) DEFAULT NULL,
  `small_image_two` int(11) DEFAULT NULL,
  `small_image_three` int(11) DEFAULT NULL,
  `small_image_four` int(11) DEFAULT NULL,
  `video` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shoplocation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `profile_image` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `shopname`, `shoplocation`, `active_status`, `dark_mode`, `messenger_color`, `avatar`, `email_verified_at`, `password`, `role`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Owen De Waele2', 'owen.de.waele@hotmail.com', 'dotattoonu', 'Belzeelsestraat 29B, Evergem', 0, 1, '#2180f3', '8f32ded2-73f2-4532-b2ba-5c1e32d3aaad.jpg', NULL, '$2y$10$NJyT1zIgZ2fMuoCkSVmVQe7dXcgxS8V.672Nfc126FB8FwU.KRguq', 1, 0, NULL, '2020-11-10 11:10:41', '2020-11-30 12:36:28'),
(2, 'test user', 'test.test@test.be', 'newtattoo', 'voetbalstraat 2 evergem', 0, 0, '#2180f3', '8c2e52aa-c81d-4aa0-9374-98f7c3f534aa.jpg', NULL, '$2y$10$PwK5XOJgXejSVWWiCF6/f.10TJ/FZbFaviEhnAEJd0aDRajc2Sdki', 0, 0, NULL, '2020-11-14 11:22:18', '2020-11-30 12:31:44'),
(3, 'testuser3', 'test3@test.be', '\"', '\"', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$qWbhTcEfQrmVY5OGPkHv3.P8ijjM.u05AlLa46MpY3UNPexOVtpMG', 0, NULL, NULL, '2020-12-17 15:11:18', '2020-12-17 15:11:18'),
(4, 'testuser3', 'testuser3@gmail.be', 'testusershop', 'sdf', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$mN7YhNqmvjv5ZIMzqiD6su2rGNQ2B/zAupDWJgxThlM7VJO4Twri6', 0, NULL, NULL, '2020-12-25 21:10:03', '2020-12-25 21:10:03'),
(5, 'testsuser4', 'testuser4@gmail.be', 'v', 'v', 0, 0, '#2180f3', 'avatar.png', NULL, '$2y$10$rfGivodlofvl9wgQm/9ABupIKLKcixY6Klresbd4G9Ig9fWWCPh.y', 0, NULL, NULL, '2020-12-25 21:31:55', '2020-12-25 21:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `article_id` int(255) DEFAULT NULL,
  `thread_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `article_id`, `thread_id`) VALUES
(1, 24, NULL),
(2, 24, NULL),
(3, 24, NULL),
(4, 24, NULL),
(5, 24, NULL),
(6, 24, NULL),
(7, 24, NULL),
(8, 24, NULL),
(9, 29, NULL),
(10, 29, NULL),
(11, 29, NULL),
(12, 24, NULL),
(13, 24, NULL),
(14, 24, NULL),
(15, 24, NULL),
(16, 24, NULL),
(17, 24, NULL),
(18, 24, NULL),
(19, 24, NULL),
(20, 24, NULL),
(21, 24, NULL),
(22, 24, NULL),
(23, 24, NULL),
(24, 24, NULL),
(25, 24, NULL),
(26, 24, NULL),
(27, 24, NULL),
(28, 24, NULL),
(29, 24, NULL),
(30, 24, NULL),
(31, 24, NULL),
(32, 24, NULL),
(33, 24, NULL),
(34, 24, NULL),
(35, 24, NULL),
(36, 24, NULL),
(37, 24, NULL),
(38, 24, NULL),
(39, 24, NULL),
(40, 24, NULL),
(41, 29, NULL),
(42, 30, NULL),
(43, 30, NULL),
(44, 30, NULL),
(45, 30, NULL),
(46, 30, NULL),
(47, 30, NULL),
(48, 30, NULL),
(49, 30, NULL),
(50, 30, NULL),
(51, 30, NULL),
(52, 30, NULL),
(53, 30, NULL),
(54, 30, NULL),
(55, 30, NULL),
(56, 30, NULL),
(57, 30, NULL),
(58, 30, NULL),
(59, 30, NULL),
(60, 30, NULL),
(61, 30, NULL),
(62, 30, NULL),
(63, 30, NULL),
(64, 30, NULL),
(65, 30, NULL),
(66, 30, NULL),
(67, 30, NULL),
(68, 30, NULL),
(69, 30, NULL),
(70, 30, NULL),
(71, 30, NULL),
(72, 30, NULL),
(73, 30, NULL),
(74, 30, NULL),
(75, 30, NULL),
(76, 30, NULL),
(77, 30, NULL),
(78, 30, NULL),
(79, 30, NULL),
(80, 30, NULL),
(81, 30, NULL),
(82, 30, NULL),
(83, 30, NULL),
(84, 30, NULL),
(85, 30, NULL),
(86, 30, NULL),
(87, 30, NULL),
(88, 30, NULL),
(89, 30, NULL),
(90, 30, NULL),
(91, 30, NULL),
(92, 30, NULL),
(93, 30, NULL),
(94, 30, NULL),
(95, 30, NULL),
(96, 30, NULL),
(97, 30, NULL),
(98, 30, NULL),
(99, 30, NULL),
(100, 30, NULL),
(101, 30, NULL),
(102, 30, NULL),
(103, 30, NULL),
(104, 30, NULL),
(105, 30, NULL),
(106, 30, NULL),
(107, 30, NULL),
(108, 30, NULL),
(109, 30, NULL),
(110, 30, NULL),
(111, 30, NULL),
(112, 30, NULL),
(113, 30, NULL),
(114, 30, NULL),
(115, 30, NULL),
(116, 30, NULL),
(117, 30, NULL),
(118, 30, NULL),
(119, 30, NULL),
(120, 30, NULL),
(121, 30, NULL),
(122, 30, NULL),
(123, 30, NULL),
(124, 30, NULL),
(125, 30, NULL),
(126, 30, NULL),
(127, 30, NULL),
(128, 30, NULL),
(129, 30, NULL),
(130, 30, NULL),
(131, 30, NULL),
(132, 30, NULL),
(133, 30, NULL),
(134, 30, NULL),
(135, 30, NULL),
(136, 30, NULL),
(137, 30, NULL),
(138, 30, NULL),
(139, 30, NULL),
(140, 30, NULL),
(141, 30, NULL),
(142, 25, NULL),
(143, 25, NULL),
(144, 24, NULL),
(145, 24, NULL),
(146, 24, NULL),
(147, 24, NULL),
(148, 24, NULL),
(149, 24, NULL),
(150, 30, NULL),
(151, 30, NULL),
(152, 30, NULL),
(153, 30, NULL),
(154, 30, NULL),
(155, 30, NULL),
(156, 30, NULL),
(157, 30, NULL),
(158, 30, NULL),
(159, 30, NULL),
(160, 30, NULL),
(161, 30, NULL),
(162, 30, NULL),
(163, 30, NULL),
(164, 30, NULL),
(165, 30, NULL),
(166, 30, NULL),
(167, 30, NULL),
(168, 30, NULL),
(169, 30, NULL),
(170, 30, NULL),
(171, 30, NULL),
(172, 30, NULL),
(173, 30, NULL),
(174, 24, NULL),
(175, 24, NULL),
(176, 24, NULL),
(177, 24, NULL),
(178, 24, NULL),
(179, 24, NULL),
(180, 24, NULL),
(181, 24, NULL),
(182, 24, NULL),
(183, 24, NULL),
(184, 24, NULL),
(185, 24, NULL),
(186, 24, NULL),
(187, 24, NULL),
(188, 24, NULL),
(189, 24, NULL),
(190, 24, NULL),
(191, 30, NULL),
(192, 30, NULL),
(193, 24, NULL),
(194, 24, NULL),
(195, 24, NULL),
(196, 24, NULL),
(197, 24, NULL),
(198, 30, NULL),
(199, 30, NULL),
(200, 24, NULL),
(201, 24, NULL),
(202, 28, NULL),
(203, 24, NULL),
(204, 24, NULL),
(205, 24, NULL),
(206, 24, NULL),
(207, 24, NULL),
(208, 25, NULL),
(209, 30, NULL),
(210, 24, NULL),
(211, 24, NULL),
(212, 24, NULL),
(213, 24, NULL),
(214, 24, NULL),
(215, 24, NULL),
(216, 24, NULL),
(217, 24, NULL),
(218, 24, NULL),
(219, 24, NULL),
(220, 24, NULL),
(221, 24, NULL),
(222, 24, NULL),
(223, 24, NULL),
(224, 24, NULL),
(225, 30, NULL),
(226, 24, NULL),
(227, 24, NULL),
(228, 24, NULL),
(229, 24, NULL),
(230, 24, NULL),
(231, 24, NULL),
(232, 24, NULL),
(233, 30, NULL),
(234, 24, NULL),
(235, 24, NULL),
(236, 24, NULL),
(237, 24, NULL),
(238, 24, NULL),
(239, 24, NULL),
(240, 24, NULL),
(241, 24, NULL),
(242, 24, NULL),
(243, 25, NULL),
(244, 24, NULL),
(245, 25, NULL),
(246, 25, NULL),
(247, 25, NULL),
(248, 25, NULL),
(249, 25, NULL),
(250, 25, NULL),
(251, 25, NULL),
(252, 25, NULL),
(253, 25, NULL),
(254, 24, NULL),
(255, 27, NULL),
(256, 27, NULL),
(257, 24, NULL),
(258, 24, NULL),
(259, 25, NULL),
(260, 25, NULL),
(261, 25, NULL),
(262, 25, NULL),
(263, 25, NULL),
(264, 25, NULL),
(265, 25, NULL),
(266, 25, NULL),
(267, 25, NULL),
(268, 25, NULL),
(269, 25, NULL),
(270, 25, NULL),
(271, 25, NULL),
(272, 25, NULL),
(273, 25, NULL),
(274, 25, NULL),
(275, 25, NULL),
(276, 25, NULL),
(277, 25, NULL),
(278, 25, NULL),
(279, 25, NULL),
(280, 25, NULL),
(281, 25, NULL),
(282, 25, NULL),
(283, 25, NULL),
(284, 25, NULL),
(285, 25, NULL),
(286, 25, NULL),
(287, 25, NULL),
(288, 25, NULL),
(289, 25, NULL),
(290, 25, NULL),
(291, 25, NULL),
(292, 25, NULL),
(293, 25, NULL),
(294, 25, NULL),
(295, 25, NULL),
(296, 25, NULL),
(297, 25, NULL),
(298, 25, NULL),
(299, 25, NULL),
(300, 25, NULL),
(301, 25, NULL),
(302, 25, NULL),
(303, 25, NULL),
(304, 25, NULL),
(305, 25, NULL),
(306, 25, NULL),
(307, 25, NULL),
(308, 25, NULL),
(309, 25, NULL),
(310, 25, NULL),
(311, 25, NULL),
(312, 25, NULL),
(313, 25, NULL),
(314, 25, NULL),
(315, 25, NULL),
(316, 25, NULL),
(317, 25, NULL),
(318, 25, NULL),
(319, 25, NULL),
(320, 25, NULL),
(321, 25, NULL),
(322, 25, NULL),
(323, 25, NULL),
(324, 25, NULL),
(325, 25, NULL),
(326, 25, NULL),
(327, 25, NULL),
(328, 25, NULL),
(329, 25, NULL),
(330, 25, NULL),
(331, 25, NULL),
(332, 25, NULL),
(333, 25, NULL),
(334, 25, NULL),
(335, 25, NULL),
(336, 25, NULL),
(337, 25, NULL),
(338, 25, NULL),
(339, 25, NULL),
(340, 25, NULL),
(341, 25, NULL),
(342, 25, NULL),
(343, 25, NULL),
(344, 25, NULL),
(345, 25, NULL),
(346, 25, NULL),
(347, 25, NULL),
(348, 25, NULL),
(349, 25, NULL),
(350, 25, NULL),
(351, 25, NULL),
(352, 25, NULL),
(353, 25, NULL),
(354, 25, NULL),
(355, 25, NULL),
(356, 25, NULL),
(357, 25, NULL),
(358, 24, NULL),
(359, 25, NULL),
(360, 25, NULL),
(361, 25, NULL),
(362, 25, NULL),
(363, 25, NULL),
(364, 25, NULL),
(365, 25, NULL),
(366, 24, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event-signs`
--
ALTER TABLE `event-signs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `profile_image`
--
ALTER TABLE `profile_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event-signs`
--
ALTER TABLE `event-signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `profile_image`
--
ALTER TABLE `profile_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;
