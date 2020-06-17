SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `type_user` tinyint(1) UNSIGNED NOT NULL COMMENT '0: user 1: page',
  `idwall` int(10) UNSIGNED NOT NULL,
  `type_wall` tinyint(1) UNSIGNED NOT NULL COMMENT '0: user 1: page  2: group   3: event',
  `action` tinyint(1) UNSIGNED NOT NULL COMMENT '1: Insert Post   2: Insert Comment',
  `type_activity` tinyint(1) UNSIGNED NOT NULL COMMENT '0: post   1: photo   2: video   3: audio   4: album   5: cover   6: avatar   7: event   8: share   9: embed link   10: embed media   11: article   12: product   31: comment',
  `moreinfo` varchar(255) NOT NULL,
  `where_was_made` tinyint(1) UNSIGNED NOT NULL COMMENT '0: post',
  `code_where` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_where` bigint(20) UNSIGNED NOT NULL,
  `code_result` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_result` bigint(20) UNSIGNED NOT NULL,
  `who_view` tinyint(1) NOT NULL COMMENT '0: All  1:Friends  2: Only creator',
  `whendate` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0: inactive   1: active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `advertising` (
  `idad` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `headline` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionline1` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionline2` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `url_destination` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `url_visible` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0: pause   1: run   2: deleted',
  `typeaction` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Undefinied   1: Impressions   2: Clicks',
  `clicks_available` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `impressions_available` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_impressions` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_impressions_unique` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_clicks` int(10) UNSIGNED DEFAULT '0',
  `num_clicks_unique` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `available` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: no available   1: available',
  `last_assignedby` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Indefined   1: Admin   2: Paypal',
  `status_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: authorized   1: Under review'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_basic` (
  `idbasic` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idslot` int(10) UNSIGNED NOT NULL COMMENT '1: dashboard   2: profile',
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `thefile` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `theurl` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `target` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: In the same window   1: Blank Window',
  `type_ads` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1: Image 2: HTML',
  `the_html` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0: Disabled   1: Active',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `advertising_basic` (`idbasic`, `code`, `idslot`, `name`, `thefile`, `theurl`, `target`, `type_ads`, `the_html`, `status`, `whendate`) VALUES
(1, 'VX5fNSn7Vxf', 1, 'Ads for Kanorika', 'VX5fNSn7Vxf.png', 'https://codecanyon.net/user/kanorika/portfolio?ref=kanorika', 1, 1, '', 1, 1513788165),
(2, '7J8SFfNKBXj', 2, 'Ads for Kanorika - Small', '7J8SFfNKBXj.png', 'https://codecanyon.net/user/kanorika/portfolio?ref=kanorika', 1, 1, '', 1, 1513788192);

CREATE TABLE `advertising_clicks_days` (
  `idclick` bigint(20) UNSIGNED NOT NULL,
  `idad` int(10) UNSIGNED NOT NULL,
  `id_plan_assigned` int(10) UNSIGNED NOT NULL,
  `whendate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `clicks_unique` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `clicks_simple` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_clicks_hours` (
  `idclick` bigint(20) UNSIGNED NOT NULL,
  `idad` int(10) UNSIGNED NOT NULL,
  `id_plan_assigned` int(10) UNSIGNED NOT NULL,
  `whendate` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `clicks_unique` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `clicks_simple` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_impress_days` (
  `idimpress` bigint(20) UNSIGNED NOT NULL,
  `idad` int(10) UNSIGNED NOT NULL,
  `id_plan_assigned` int(10) UNSIGNED NOT NULL,
  `whendate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `impress_unique` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `impress_simple` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_impress_hours` (
  `idimpress` bigint(20) UNSIGNED NOT NULL,
  `idad` int(10) UNSIGNED NOT NULL,
  `id_plan_assigned` int(10) UNSIGNED NOT NULL,
  `whendate` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `impress_unique` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `impress_simple` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_paypal` (
  `id` int(11) UNSIGNED NOT NULL,
  `whendate` int(10) UNSIGNED DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) UNSIGNED DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_plans` (
  `idplan` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name_plan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `typeaction` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1: Impressions   2: Clicks   3: Days',
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `advertising_plans_assigned` (
  `idassigned` int(10) UNSIGNED NOT NULL,
  `idad` int(10) UNSIGNED NOT NULL,
  `idplan` int(10) UNSIGNED NOT NULL,
  `assignedby` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1: Admin   2: Paypal',
  `idassigner` int(10) UNSIGNED NOT NULL COMMENT 'may be the "id" in the paypal table',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `albums` (
  `idalbum` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idcreator` int(10) UNSIGNED NOT NULL,
  `typecreator` tinyint(1) UNSIGNED NOT NULL COMMENT '0: user 1: page',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `privacy` tinyint(1) UNSIGNED NOT NULL COMMENT '0: Public   1: Friends   2: Only me',
  `numphotos` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `idpost` bigint(20) UNSIGNED NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `modified` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `albums_items` (
  `iditem` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idalbum` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `idmedia` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `articles` (
  `idarticle` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idwriter` int(10) UNSIGNED NOT NULL,
  `idcategory` int(10) UNSIGNED NOT NULL,
  `idsubcategory` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `summary` text NOT NULL,
  `text_article` text NOT NULL,
  `photo` varchar(250) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `idpost` bigint(20) UNSIGNED NOT NULL,
  `numviews` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `articles_cat` (
  `idcategory` int(10) UNSIGNED NOT NULL,
  `idfather` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `num_children` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `articles_cat` (`idcategory`, `idfather`, `name`, `num_children`) VALUES
(1, 0, 'Arts &amp; Photography', 10),
(2, 0, 'Biographies &amp; Memoirs', 10),
(3, 0, 'Children&#039;s Texts', 4),
(4, 0, 'Cooking, Food &amp; Wine', 8),
(5, 0, 'History', 3),
(6, 0, 'Literature &amp; Fiction', 6),
(7, 0, 'Mystery &amp; Suspense', 3),
(8, 0, 'Romance', 7),
(9, 0, 'Sci-Fi &amp; Fantasy', 3),
(10, 0, 'Teens &amp; Young Adult', 10),
(11, 1, 'Photography &amp; Video', 0),
(12, 1, 'Music', 0),
(13, 1, 'Graphic Design', 0),
(14, 1, 'Architecture', 0),
(15, 1, 'Drawing', 0),
(16, 1, 'Individual Artists', 0),
(17, 1, 'Painting', 0),
(18, 1, 'Performing Arts', 0),
(19, 1, 'Decorative Arts &amp; Design', 0),
(20, 1, 'Fashion', 0),
(21, 2, 'Memoirs', 0),
(22, 2, 'Leaders &amp; Notable People', 0),
(23, 2, 'Historical', 0),
(24, 2, 'Sports &amp; Outdoors', 0),
(25, 2, 'Arts &amp; Literature', 0),
(26, 2, 'True Crime', 0),
(27, 2, 'Professionals &amp; Academics', 0),
(28, 2, 'Travelers &amp; Explorers', 0),
(29, 2, 'Ethnic &amp; National', 0),
(30, 2, 'Reference &amp; Collections', 0),
(31, 3, 'Animals', 0),
(32, 3, 'Action &amp; Adventure', 0),
(33, 3, 'Literature &amp; Fiction', 0),
(34, 3, 'Humor', 0),
(35, 4, 'Baking', 0),
(36, 4, 'Regional &amp; International', 0),
(37, 4, 'Vegetarian &amp; Vegan', 0),
(38, 4, 'Special Diet', 0),
(39, 4, 'Professional Cooking', 0),
(40, 4, 'Beverages &amp; Wine', 0),
(41, 4, 'Quick &amp; Easy', 0),
(42, 4, 'Cooking Methods', 0),
(43, 5, 'Military', 0),
(44, 5, 'Ancient Civilizations', 0),
(45, 5, 'World', 0),
(46, 6, 'Erotica', 0),
(47, 6, 'Historical Fiction', 0),
(48, 6, 'Genre Fiction', 0),
(49, 6, 'Action &amp; Adventure', 0),
(50, 6, 'Poetry', 0),
(51, 6, 'Short Stories', 0),
(52, 7, 'Thrillers &amp; Suspense', 0),
(53, 7, 'Mystery', 0),
(54, 7, 'Paranormal', 0),
(55, 8, 'Erotica', 0),
(56, 8, 'Contemporary', 0),
(57, 8, 'Romantic Suspense', 0),
(58, 8, 'Historical', 0),
(59, 8, 'Romantic Comedy', 0),
(60, 8, 'Fantasy', 0),
(61, 8, 'Inspirational', 0),
(62, 9, 'Science Fiction', 0),
(63, 9, 'Fantasy', 0),
(64, 9, 'Gaming', 0),
(65, 10, 'Science Fiction &amp; Fantasy', 0),
(66, 10, 'Romance', 0),
(67, 10, 'Mysteries &amp; Thrillers', 0),
(68, 10, 'Historical Fiction', 0),
(69, 10, 'Biographies', 0),
(70, 10, 'Social Issues', 0),
(71, 10, 'Personal Health', 0),
(72, 10, 'Religion &amp; Spirituality', 0),
(73, 10, 'Sports &amp; Outdoors', 0),
(74, 10, 'Art, Music &amp; Photography', 0);

CREATE TABLE `comments` (
  `idcomment` bigint(20) UNSIGNED NOT NULL,
  `idwriter` int(10) UNSIGNED NOT NULL COMMENT 'iduser or idpage',
  `type_writer` tinyint(1) UNSIGNED NOT NULL COMMENT '0: as User   1: as Page',
  `iditem` int(10) UNSIGNED NOT NULL,
  `typeitem` tinyint(1) UNSIGNED NOT NULL COMMENT '0: Post   1: Media',
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `typecomment` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1: normal   2: photo   3:sticker',
  `idattach` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Id media',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `currencies` (
  `idcurrency` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `code_iso` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `currencies` (`idcurrency`, `name`, `code_iso`, `symbol`) VALUES
(1, 'US Dollar', 'USD', '$'),
(2, 'Euro', 'EUR', '&euro;');

CREATE TABLE `events` (
  `idevent` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idcreator` int(10) UNSIGNED NOT NULL,
  `typecreator` tinyint(3) UNSIGNED NOT NULL COMMENT '0: User   1: Page   2: Group   ',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover_media` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cover_position` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date_start` date NOT NULL,
  `time_start` time NOT NULL,
  `start_unix` int(10) UNSIGNED NOT NULL,
  `date_end` date NOT NULL,
  `time_end` time NOT NULL,
  `end_unix` int(10) UNSIGNED NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lon` decimal(11,8) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `privacy` tinyint(1) UNSIGNED NOT NULL COMMENT '0: public   1: private',
  `idpost` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `events_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `idevent` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `type_action` tinyint(1) NOT NULL COMMENT '1: interested   2: going'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `events_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `idevent` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `invited_by` int(10) UNSIGNED NOT NULL,
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `friend1` int(10) UNSIGNED NOT NULL,
  `friend2` int(10) UNSIGNED NOT NULL,
  `send_date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `accepted_date` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `games` (
  `idgame` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(300) NOT NULL,
  `url_game` varchar(300) NOT NULL,
  `url_owner` varchar(300) NOT NULL,
  `thumbnail` varchar(300) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `groups` (
  `idgroup` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `idcreator` int(10) UNSIGNED NOT NULL,
  `guname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover_media` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cover_position` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `nummembers` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `numfollowers` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `privacy` tinyint(1) UNSIGNED NOT NULL COMMENT '0: Public  1: Closed  2: Secret',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `groups_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idgroup` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `accepted_by` tinyint(1) UNSIGNED NOT NULL,
  `when_request` int(10) UNSIGNED NOT NULL,
  `when_accepted` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: pending   1: accepted',
  `is_admin` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: No   1: Yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `hashtags` (
  `idhashtag` bigint(20) UNSIGNED NOT NULL,
  `hashtag` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `idwriter` int(10) UNSIGNED NOT NULL COMMENT 'iduser or idpage',
  `type_writer` tinyint(1) UNSIGNED NOT NULL COMMENT '0: iduser   1: idpage',
  `idpost` int(10) UNSIGNED NOT NULL,
  `thedate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `hiddens` (
  `idhidden` bigint(20) UNSIGNED NOT NULL,
  `typeitem` tinyint(1) UNSIGNED NOT NULL COMMENT '0: Post   1: Comment',
  `iditem` bigint(20) UNSIGNED NOT NULL,
  `idactivity` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `whendate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `likes` (
  `idlike` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `typeuser` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: User   1: Page',
  `iditem` int(10) UNSIGNED NOT NULL,
  `typeitem` tinyint(1) UNSIGNED NOT NULL COMMENT '0: Post   1: Comment   2: Media   3: Page',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `medias` (
  `idmedia` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idwriter` int(10) UNSIGNED NOT NULL COMMENT 'iduser or idpage',
  `type_writer` tinyint(1) UNSIGNED NOT NULL COMMENT '0: iduser   1: idpage',
  `posted_in` tinyint(1) UNSIGNED NOT NULL COMMENT '0: In Post   1: In Comment   2: In Album',
  `codecontainer` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Code post, Code comment, Code Album',
  `idcontainer` int(10) UNSIGNED NOT NULL,
  `namefile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numcomments` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `numlikes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `typemedia` tinyint(1) UNSIGNED NOT NULL COMMENT '0: photo   1: video   2: audio',
  `width` smallint(5) UNSIGNED NOT NULL,
  `height` smallint(5) UNSIGNED NOT NULL,
  `server_media` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `url_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `mentions` (
  `idmention` bigint(20) UNSIGNED NOT NULL,
  `typecontainer` tinyint(3) UNSIGNED NOT NULL COMMENT '0: in Post   1: in comment',
  `idcontainer` int(10) UNSIGNED NOT NULL COMMENT 'id post, or id comment',
  `idwriter` int(10) UNSIGNED NOT NULL COMMENT 'iduser or idpage',
  `type_writer` tinyint(1) UNSIGNED NOT NULL COMMENT '0: user    1: page',
  `iduser_mentioned` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_notif` tinyint(1) UNSIGNED NOT NULL COMMENT '1: Follow me   2: like my post   3: Comment my post   4: Send me a message    5: Friend Request Sent   6: Confirm to Friend Request   7:Share my post   8: Write in my wall   9: Like my page   10: Send request to my group   11: Accepted request group   12: Add how member to Group   13: Like my comment   14: Like my Media   15: Comment my media',
  `result` int(10) UNSIGNED NOT NULL COMMENT 'idcomment   or   idlike   or   idpost shared   or   idpost in other wall',
  `from_user` int(10) UNSIGNED NOT NULL,
  `from_user_type` tinyint(3) UNSIGNED NOT NULL COMMENT '0: user   1: page   2: group',
  `to_user` int(10) UNSIGNED NOT NULL,
  `iditem_notif` int(10) UNSIGNED NOT NULL COMMENT 'idpost or idalbum or idpage or idgroup or idcomment or idmedia',
  `typeitem_notif` tinyint(1) UNSIGNED NOT NULL COMMENT '1: Post   2: Album   3: Page   4: Group   5: Comment   6: Media',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pages` (
  `idpage` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idcat` int(10) UNSIGNED NOT NULL,
  `idsubcat` int(10) UNSIGNED NOT NULL,
  `idcreator` int(10) UNSIGNED NOT NULL,
  `puname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_media` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover_media` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cover_position` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `numlikes` int(10) UNSIGNED NOT NULL,
  `numfollowers` int(10) UNSIGNED NOT NULL,
  `verified` tinyint(1) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pages_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idpage` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pages_cat` (
  `idcategory` int(10) UNSIGNED NOT NULL,
  `idfather` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `num_children` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pages_cat` (`idcategory`, `idfather`, `name`, `num_children`) VALUES
(1, 0, 'Cause or Community', 41),
(2, 0, 'Company, Organization or Institution', 38),
(3, 0, 'Brand or Product', 34),
(4, 0, 'Artist, Band or Public Figure', 25),
(5, 0, 'Entertainment', 28),
(6, 4, 'Actor/Director', 0),
(7, 4, 'Artist', 0),
(8, 4, 'Athlete', 0),
(9, 4, 'Author', 0),
(10, 4, 'Business Person', 0),
(11, 4, 'Chef', 0),
(12, 4, 'Coach', 0),
(13, 4, 'Comedian', 0),
(14, 4, 'Dancer', 0),
(15, 4, 'Designer', 0),
(16, 4, 'Entertainer', 0),
(17, 4, 'Entrepreneur', 0),
(18, 4, 'Fictional Character', 0),
(19, 4, 'Government Official', 0),
(20, 4, 'Journalist', 0),
(21, 4, 'Movie Character', 0),
(22, 4, 'Musician/Band', 0),
(23, 4, 'News Personality', 0),
(24, 4, 'Pet', 0),
(25, 4, 'Photographer', 0),
(26, 4, 'Politician', 0),
(27, 4, 'Producer', 0),
(28, 4, 'Public Figure', 0),
(29, 4, 'Teacher', 0),
(30, 4, 'Writer', 0),
(31, 3, 'App Page', 0),
(32, 3, 'Appliances', 0),
(33, 3, 'Baby Goods/Kids Goods', 0),
(34, 3, 'Bags/Luggage', 0),
(35, 3, 'Board Game', 0),
(36, 3, 'Building Materials', 0),
(37, 3, 'Camera/Photo', 0),
(38, 3, 'Cars', 0),
(39, 3, 'Clothing', 0),
(40, 3, 'Commercial Equipment', 0),
(41, 3, 'Computers', 0),
(42, 3, 'Drugs', 0),
(43, 3, 'Electronics', 0),
(44, 3, 'Food/Beverages', 0),
(45, 3, 'Furniture', 0),
(46, 3, 'Games/Toys', 0),
(47, 3, 'Health/Beauty', 0),
(48, 3, 'Home Decor', 0),
(49, 3, 'Household Supplies', 0),
(50, 3, 'Jewelry/Watches', 0),
(51, 3, 'Kitchen/Cooking', 0),
(52, 3, 'Office Supplies', 0),
(53, 3, 'Outdoor Gear/Sporting Goods', 0),
(54, 3, 'Patio/Garden', 0),
(55, 3, 'Pet Supplies', 0),
(56, 3, 'Phone/Tablet', 0),
(57, 3, 'Product/Service', 0),
(58, 3, 'Software', 0),
(59, 3, 'Tools/Equipment', 0),
(60, 3, 'Video Game', 0),
(61, 3, 'Vitamins/Supplements', 0),
(62, 3, 'Website', 0),
(63, 3, 'Wine/Spirits', 0),
(64, 3, 'Sportswear', 0),
(65, 1, 'Airport', 0),
(66, 1, 'Arts/Entertainment/Nightlife', 0),
(67, 1, 'Attractions/Things to Do', 0),
(68, 1, 'Automotive', 0),
(69, 1, 'Bank/Financial Services', 0),
(70, 1, 'Bar', 0),
(71, 1, 'Book Store', 0),
(72, 1, 'Business Services', 0),
(73, 1, 'Church/Religious Organization', 0),
(74, 1, 'Club', 0),
(75, 1, 'Community/Government', 0),
(76, 1, 'Concert Venue', 0),
(77, 1, 'Doctor', 0),
(78, 1, 'Education', 0),
(79, 1, 'Event Planning/Event Services', 0),
(80, 1, 'Food/Grocery', 0),
(81, 1, 'Health/Medical/Pharmacy', 0),
(82, 1, 'Home Improvement', 0),
(83, 1, 'Hospital/Clinic', 0),
(84, 1, 'Hotel', 0),
(85, 1, 'Landmark', 0),
(86, 1, 'Lawyer', 0),
(87, 1, 'Library', 0),
(88, 1, 'Local Business', 0),
(89, 1, 'Middle School', 0),
(90, 1, 'Movie Theater', 0),
(91, 1, 'Museum/Art Gallery', 0),
(92, 1, 'Outdoor Gear/Sporting Goods', 0),
(93, 1, 'Pet Services', 0),
(94, 1, 'Professional Services', 0),
(95, 1, 'Public Places', 0),
(96, 1, 'Real Estate', 0),
(97, 1, 'Restaurant/Cafe', 0),
(98, 1, 'School', 0),
(99, 1, 'Shopping/Retail', 0),
(100, 1, 'Spas/Beauty/Personal Care', 0),
(101, 1, 'Sports Venue', 0),
(102, 1, 'Sports/Recreation/Activities', 0),
(103, 1, 'Tours/Sightseeing', 0),
(104, 1, 'Transportation', 0),
(105, 1, 'University', 0),
(106, 2, 'Aerospace/Defense', 0),
(107, 2, 'Automobiles and Parts', 0),
(108, 2, 'Bank/Financial Institution', 0),
(109, 2, 'Biotechnology', 0),
(110, 2, 'Cause', 0),
(111, 2, 'Chemicals', 0),
(112, 2, 'Church/Religious Organization', 0),
(113, 2, 'Community Organization', 0),
(114, 2, 'Company', 0),
(115, 2, 'Computers/Technology', 0),
(116, 2, 'Consulting/Business Services', 0),
(117, 2, 'Education', 0),
(118, 2, 'Energy/Utility', 0),
(119, 2, 'Engineering/Construction', 0),
(120, 2, 'Farming/Agriculture', 0),
(121, 2, 'Food/Beverages', 0),
(122, 2, 'Government Organization', 0),
(123, 2, 'Health/Beauty', 0),
(124, 2, 'Health/Medical/Pharmaceuticals', 0),
(125, 2, 'Industrials', 0),
(126, 2, 'Insurance Company', 0),
(127, 2, 'Internet/Software', 0),
(128, 2, 'Legal/Law', 0),
(129, 2, 'Media/News/Publishing', 0),
(130, 2, 'Middle School', 0),
(131, 2, 'Mining/Materials', 0),
(132, 2, 'Non-Governmental Organization (NGO)', 0),
(133, 2, 'Non-Profit Organization', 0),
(134, 2, 'Organization', 0),
(135, 2, 'Political Organization', 0),
(136, 2, 'Political Party', 0),
(137, 2, 'Retail and Consumer Merchandise', 0),
(138, 2, 'School', 0),
(139, 2, 'Small Business', 0),
(140, 2, 'Telecommunication', 0),
(141, 2, 'Transport/Freight', 0),
(142, 2, 'Travel/Leisure', 0),
(143, 2, 'University', 0),
(144, 5, 'Album', 0),
(145, 5, 'Amateur Sports Team', 0),
(146, 5, 'Book', 0),
(147, 5, 'Book Series', 0),
(148, 5, 'Book Store', 0),
(149, 5, 'Concert Tour', 0),
(150, 5, 'Concert Venue', 0),
(151, 5, 'Fictional Character', 0),
(152, 5, 'Library', 0),
(153, 5, 'Magazine', 0),
(154, 5, 'Movie', 0),
(155, 5, 'Movie Character', 0),
(156, 5, 'Movie Theater', 0),
(157, 5, 'Music Award', 0),
(158, 5, 'Music Chart', 0),
(159, 5, 'Music Video', 0),
(160, 5, 'Radio Station', 0),
(161, 5, 'Record Label', 0),
(162, 5, 'School Sports Team', 0),
(163, 5, 'Song', 0),
(164, 5, 'Sports League', 0),
(165, 5, 'Sports Team', 0),
(166, 5, 'Sports Venue', 0),
(167, 5, 'Studio', 0),
(168, 5, 'TV Channel', 0),
(169, 5, 'TV Network', 0),
(170, 5, 'TV Show', 0),
(171, 5, 'TV/Movie Award', 0);

CREATE TABLE `posts` (
  `idpost` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idwriter` int(10) UNSIGNED NOT NULL COMMENT 'iduser or idpage',
  `type_writer` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: user    1: page',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `typepost` tinyint(3) UNSIGNED NOT NULL COMMENT '0: post   1: photo   2: video   3: audio   4: album   5: cover   6: avatar   7: event   8: share   9: embed link   10: embed media   11: article   12: product',
  `moreinfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posted_in` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: profile   1: page   2: group   3: event',
  `id_wall` int(10) UNSIGNED NOT NULL COMMENT 'id user,  id page,  id group, id event',
  `idmedia` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'id video or id audio',
  `idembed` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `idactivity` bigint(20) UNSIGNED NOT NULL,
  `for_who` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Public   1: Friends   2: Me',
  `numcomments` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `numlikes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `numshares` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `with_users` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feeling` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_in` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_date` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `posts_embed` (
  `idembed` int(10) UNSIGNED NOT NULL,
  `type_embed` tinyint(3) UNSIGNED NOT NULL COMMENT '1: link   2: media',
  `e_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `e_text` text COLLATE utf8_unicode_ci NOT NULL,
  `e_thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_html` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `posts_saved` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idpost` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `type_save` smallint(1) UNSIGNED NOT NULL,
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `products` (
  `idproduct` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idsell` int(10) UNSIGNED NOT NULL,
  `idcategory` int(10) UNSIGNED NOT NULL,
  `idsubcategory` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `currency` int(10) UNSIGNED NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `type_product` tinyint(1) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `idpost` bigint(20) UNSIGNED NOT NULL,
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `products_cat` (
  `idcategory` int(10) UNSIGNED NOT NULL,
  `idfather` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `num_children` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `products_cat` (`idcategory`, `idfather`, `name`, `num_children`) VALUES
(1, 0, 'Home &amp; Garden', 5),
(2, 0, 'Housing', 2),
(3, 0, 'Entertainment', 2),
(4, 0, 'Clothing &amp; Accessories', 4),
(5, 0, 'Family', 4),
(6, 0, 'Electronics', 2),
(7, 0, 'Hobbies', 4),
(8, 0, 'Vehicles &amp; Bicycles', 3),
(9, 0, 'Classifieds', 3),
(10, 9, 'Garage Sale', 0),
(11, 9, 'Miscellaneous', 0),
(12, 9, 'Services', 0),
(13, 1, 'Tools', 0),
(14, 1, 'Furniture', 0),
(15, 1, 'Garden', 0),
(16, 1, 'Appliances', 0),
(17, 1, 'Household', 0),
(18, 2, 'Property For Sale', 0),
(19, 2, 'Property Rentals', 0),
(20, 3, 'Books, Movies &amp; Music', 0),
(21, 3, 'Video Games', 0),
(22, 4, 'Jewelry &amp; Accessories', 0),
(23, 4, 'Bags &amp; Luggage', 0),
(24, 4, 'Clothing &amp; Shoes - Men', 0),
(25, 4, 'Clothing &amp; Shoes - Women', 0),
(26, 5, 'Toys &amp; Games', 0),
(27, 5, 'Baby &amp; Kids', 0),
(28, 5, 'Pet Supplies', 0),
(29, 5, 'Health &amp; Beauty', 0),
(30, 6, 'Mobile Phones', 0),
(31, 6, 'Electronics &amp; Computers', 0),
(32, 7, 'Sports &amp; Outdoors', 0),
(33, 7, 'Musical Instruments', 0),
(34, 7, 'Arts &amp; Crafts', 0),
(35, 7, 'Antiques &amp; Collectibles', 0),
(36, 8, 'Auto Parts', 0),
(37, 8, 'Bicycles', 0),
(38, 8, 'Cars, Trucks &amp; Motorcycles', 0);

CREATE TABLE `products_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `idproduct` int(10) UNSIGNED NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `recent_searches` (
  `id` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `iditem` int(10) UNSIGNED NOT NULL,
  `typeitem` tinyint(3) UNSIGNED NOT NULL COMMENT '1: user   2: page   3: page',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leader` int(10) UNSIGNED NOT NULL,
  `type_leader` tinyint(3) UNSIGNED NOT NULL COMMENT '0: user  1: page   2: group   3: event',
  `follower` int(10) UNSIGNED NOT NULL,
  `blocked` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `reports` (
  `idreport` bigint(20) NOT NULL,
  `typeitem` tinyint(1) UNSIGNED NOT NULL COMMENT '0: post   1: comment   2: user   3: page   4: group   5: article    6: product   7: event',
  `iditem` bigint(20) UNSIGNED NOT NULL,
  `idinformer` int(10) UNSIGNED NOT NULL,
  `reasons` text COLLATE utf8_unicode_ci NOT NULL,
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `word` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `settings` (`id`, `word`, `value`) VALUES
(1, 'SITE_TITLE', 'iSocial'),
(2, 'SITE_LIVE', '1'),
(3, 'SITE_PRIVACY', '0'),
(4, 'SEO_KEYWORDS', 'iSocial, social network, Kanorika'),
(5, 'SEO_DESCRIPTION', 'iSocial is the social network for all'),
(6, 'COMPANY', 'Kanorika Team'),
(7, 'SIGNUP_WITH_VALIDATION', '0'),
(8, 'LOGIN_WITH_REMEMBER', '1'),
(9, 'SIGNUP_MIN_AGE', '10'),
(10, 'SIGNUP_MAX_AGE', '50'),
(11, 'THEME', 'default'),
(12, 'LANGUAGE', 'en'),
(13, 'widthAvatar1', '32'),
(14, 'heightAvatar1', '32'),
(15, 'widthAvatar2', '50'),
(16, 'heightAvatar2', '50'),
(17, 'widthAvatar3', '100'),
(18, 'heightAvatar3', '100'),
(19, 'widthAvatar4', '168'),
(20, 'heightAvatar4', '168'),
(21, 'widthCover1', '946'),
(22, 'heightCover1', '300'),
(23, 'widthCover2', '712'),
(24, 'heightCover2', '226'),
(25, 'widthCover3', '350'),
(26, 'heightCover3', '111'),
(27, 'WITH_INFINITE_SCROLL', '1'),
(28, 'widthAd1', '180'),
(29, 'heightAd1', '90'),
(30, 'widthAd2', '100'),
(31, 'heightAd2', '50'),
(32, 'INTERVAL_NOTIFICATIONS_PEOPLE', '5000'),
(33, 'INTERVAL_NOTIFICATIONS_GLOBAL', '5000'),
(34, 'INTERVAL_NOTIFICATIONS_MESSAGES', '5000'),
(35, 'INTERVAL_CHECK_USER_ONLINE', '10000'),
(36, 'ACTIVITIES_PER_PAGE', '10'),
(37, 'ITEMS_PER_PAGE', '10'),
(38, 'QUANTITY_PHOTOS_POST', '6'),
(39, 'WIDTH_PHOTO_1', '960'),
(40, 'WIDTH_PHOTO_2', '600'),
(41, 'WIDTH_PHOTO_3', '300'),
(42, 'WIDTH_PHOTO_4', '200'),
(43, 'CHARS_VIEW_IN_POST', '300'),
(44, 'CHARS_VIEW_IN_COMMENT', '200'),
(45, 'NUM_NOTIFICATIONS_TOP', '10'),
(46, 'LOGIN_WITH_FACEBOOK', '0'),
(47, 'FB_APPID', ''),
(48, 'FB_SECRET', ''),
(49, 'LOGIN_WITH_TWITTER', '0'),
(50, 'TW_APPID', ''),
(51, 'TW_SECRET', ''),
(52, 'DOMAIN_EMAIL_TW', ''),
(53, 'INTERVAL_CHECK_NEW_MSG_CHAT', '5000'),
(54, 'ITEMS_PER_PAGE_DIRECTORY', '12'),
(55, 'ITEMS_PER_PAGE_MARKETPLACE', '12'),
(56, 'ITEMS_PER_PAGE_LIBRARY', '10'),
(57, 'MAIL_WITH_PHPMAILER', '1'),
(58, 'MAIL_FROM', 'no-reply@kanorika.com'),
(59, 'MAIL_FROMNAME', 'iSocial'),
(60, 'MAIL_HOST', 'mail.kanorika.com'),
(61, 'MAIL_PORT', '25'),
(62, 'MAIL_USERNAME', 'no-reply@kanorika.com'),
(63, 'MAIL_PASSWORD', '123456'),
(64, 'TIMEZONE', 'America/New_York'),
(65, 'CURRENCY', 'USD'),
(66, 'EMAIL_PAYPAL', ''),
(67, 'EMAIL_NOTIFICATION_PAYPAL', ''),
(68, 'URL_ACTION_PAYPAL', ''),
(69, 'URL_ACTION_PAYPAL_IPN', ''),
(70, 'SIDEBAR_USERS', '1'),
(71, 'SHOW_APP_ANDROID', '0'),
(72, 'FILE_APP_ANDROID', ''),
(73, 'KEY_API_GOOGLE', 'AIzaSyB-DVuPCSaqQnW6kqADlG-578YrWEmwDqQ');

CREATE TABLE `statics` (
  `idstatic` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `texthtml` text COLLATE utf8_unicode_ci NOT NULL,
  `show_in_foot` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `statics` (`idstatic`, `code`, `url`, `title`, `texthtml`, `show_in_foot`) VALUES
(1, 'about', 'about', 'About Us', 'Text about here...', 1),
(2, 'privacy', 'privacy', 'Privacy Policy', 'Text Privacy Policy here...', 1),
(3, 'termsofuse', 'terms', 'Terms of Use', 'Text Terms of Use here...', 1);

CREATE TABLE `talks` (
  `idtalk` int(10) UNSIGNED NOT NULL,
  `idlastmessage` int(10) UNSIGNED NOT NULL,
  `idcreator` int(10) UNSIGNED NOT NULL,
  `date_creation` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `talks_messages` (
  `idmessage` int(10) UNSIGNED NOT NULL,
  `idtalk` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `idmedia` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `typemessage` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1: normal   2: photo   3: attach   4:sticker',
  `nameattach` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `talks_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `idtalk` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `viewed` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `last_message_view` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `users` (
  `iduser` int(10) UNSIGNED NOT NULL,
  `code` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover_position` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  `aboutme` text COLLATE utf8_unicode_ci NOT NULL,
  `currentcity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hometown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lon` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `num_friends` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_followers` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_following` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_albums` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `privacy` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Public   1: Friends   2: Privado',
  `with_validation` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `validated` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `datevalidated` int(10) UNSIGNED NOT NULL,
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `registerdate` int(10) UNSIGNED NOT NULL,
  `ipregister` bigint(20) UNSIGNED NOT NULL,
  `previousaccess` int(10) UNSIGNED NOT NULL,
  `ippreviousaccess` bigint(20) UNSIGNED NOT NULL,
  `lastaccess` int(10) UNSIGNED NOT NULL,
  `iplastaccess` bigint(20) UNSIGNED NOT NULL,
  `lastclick` int(10) UNSIGNED NOT NULL,
  `num_activities` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_notifications_people` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `num_notifications_messages` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `num_notifications_global` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `num_notifications` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_pages` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_groups` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_events` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_articles` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num_products` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `auth` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gplus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass_reset_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `who_write_on_my_wall` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `who_can_sendme_messages` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Fiends   2: Nobody',
  `who_can_see_friends` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `who_can_see_liked_pages` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `who_can_see_joined_groups` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `who_can_see_birthdate` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `who_can_see_location` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `who_can_see_about_me` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: Any   1: Friends   2: Only me',
  `chat` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0: Offline   1: Online',
  `chat_mute` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: You receive chat messages   1: You do not receive chat messages',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `leveladmin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: observer   1: Administrator   2: Super Administrator',
  `req_delete` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`iduser`, `code`, `firstname`, `lastname`, `user_email`, `user_username`, `user_password`, `avatar`, `avatar_media`, `cover`, `cover_media`, `cover_position`, `gender`, `birthday`, `aboutme`, `currentcity`, `hometown`, `lat`, `lon`, `language`, `timezone`, `num_friends`, `num_followers`, `num_following`, `num_albums`, `privacy`, `with_validation`, `validated`, `datevalidated`, `verified`, `active`, `registerdate`, `ipregister`, `previousaccess`, `ippreviousaccess`, `lastaccess`, `iplastaccess`, `lastclick`, `num_activities`, `num_notifications_people`, `num_notifications_messages`, `num_notifications_global`, `num_notifications`, `num_pages`, `num_groups`, `num_events`, `num_articles`, `num_products`, `auth`, `auth_id`, `facebook`, `twitter`, `linkedin`, `gplus`, `pass_reset_key`, `who_write_on_my_wall`, `who_can_sendme_messages`, `who_can_see_friends`, `who_can_see_liked_pages`, `who_can_see_joined_groups`, `who_can_see_birthdate`, `who_can_see_location`, `who_can_see_about_me`, `chat`, `chat_mute`, `is_admin`, `leveladmin`, `req_delete`) VALUES
(1, 'yCWgzVQcTfH', 'User', 'Main', 'info@kanorika.com', 'usermain', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', 1, '1973-11-16', 'About me ;-)', 'Earth', 'Mars', '', '', 'en', 'America/New_York', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1475124306, 0, 1513940322, 2130706433, 1513942218, 2130706433, 1513946786, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 2, 0);

CREATE TABLE `users_blocked` (
  `id` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `iduserblocked` int(10) UNSIGNED NOT NULL,
  `type_blocked` tinyint(1) UNSIGNED NOT NULL COMMENT '1: General   2: Chat',
  `whendate` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `advertising`
  ADD PRIMARY KEY (`idad`);

ALTER TABLE `advertising_basic`
  ADD PRIMARY KEY (`idbasic`);

ALTER TABLE `advertising_clicks_days`
  ADD PRIMARY KEY (`idclick`);

ALTER TABLE `advertising_clicks_hours`
  ADD PRIMARY KEY (`idclick`);

ALTER TABLE `advertising_impress_days`
  ADD PRIMARY KEY (`idimpress`);

ALTER TABLE `advertising_impress_hours`
  ADD PRIMARY KEY (`idimpress`);

ALTER TABLE `advertising_paypal`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `advertising_plans`
  ADD PRIMARY KEY (`idplan`);

ALTER TABLE `advertising_plans_assigned`
  ADD PRIMARY KEY (`idassigned`);

ALTER TABLE `albums`
  ADD PRIMARY KEY (`idalbum`);

ALTER TABLE `albums_items`
  ADD PRIMARY KEY (`iditem`);

ALTER TABLE `articles`
  ADD PRIMARY KEY (`idarticle`);

ALTER TABLE `articles_cat`
  ADD PRIMARY KEY (`idcategory`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`idcomment`);

ALTER TABLE `currencies`
  ADD PRIMARY KEY (`idcurrency`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`idevent`);

ALTER TABLE `events_actions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `events_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `games`
  ADD PRIMARY KEY (`idgame`);

ALTER TABLE `groups`
  ADD PRIMARY KEY (`idgroup`);

ALTER TABLE `groups_members`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`idhashtag`);

ALTER TABLE `hiddens`
  ADD PRIMARY KEY (`idhidden`);

ALTER TABLE `likes`
  ADD PRIMARY KEY (`idlike`);

ALTER TABLE `medias`
  ADD PRIMARY KEY (`idmedia`);

ALTER TABLE `mentions`
  ADD PRIMARY KEY (`idmention`);

ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pages`
  ADD PRIMARY KEY (`idpage`);

ALTER TABLE `pages_admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pages_cat`
  ADD PRIMARY KEY (`idcategory`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`idpost`);

ALTER TABLE `posts_embed`
  ADD PRIMARY KEY (`idembed`);

ALTER TABLE `posts_saved`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`idproduct`);

ALTER TABLE `products_cat`
  ADD PRIMARY KEY (`idcategory`);

ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `recent_searches`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reports`
  ADD PRIMARY KEY (`idreport`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `word` (`word`);

ALTER TABLE `statics`
  ADD PRIMARY KEY (`idstatic`);

ALTER TABLE `talks`
  ADD PRIMARY KEY (`idtalk`);

ALTER TABLE `talks_messages`
  ADD PRIMARY KEY (`idmessage`);

ALTER TABLE `talks_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

ALTER TABLE `users_blocked`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising`
  MODIFY `idad` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_basic`
  MODIFY `idbasic` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `advertising_clicks_days`
  MODIFY `idclick` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_clicks_hours`
  MODIFY `idclick` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_impress_days`
  MODIFY `idimpress` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_impress_hours`
  MODIFY `idimpress` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_paypal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_plans`
  MODIFY `idplan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `advertising_plans_assigned`
  MODIFY `idassigned` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `albums`
  MODIFY `idalbum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `albums_items`
  MODIFY `iditem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `articles`
  MODIFY `idarticle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `articles_cat`
  MODIFY `idcategory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
ALTER TABLE `comments`
  MODIFY `idcomment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `currencies`
  MODIFY `idcurrency` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `events`
  MODIFY `idevent` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `events_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `events_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `games`
  MODIFY `idgame` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `groups`
  MODIFY `idgroup` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `groups_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `hashtags`
  MODIFY `idhashtag` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `hiddens`
  MODIFY `idhidden` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `likes`
  MODIFY `idlike` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `medias`
  MODIFY `idmedia` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `mentions`
  MODIFY `idmention` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `pages`
  MODIFY `idpage` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `pages_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `pages_cat`
  MODIFY `idcategory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
ALTER TABLE `posts`
  MODIFY `idpost` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `posts_embed`
  MODIFY `idembed` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `posts_saved`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `products`
  MODIFY `idproduct` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `products_cat`
  MODIFY `idcategory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `recent_searches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `reports`
  MODIFY `idreport` bigint(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
ALTER TABLE `statics`
  MODIFY `idstatic` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `talks`
  MODIFY `idtalk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `talks_messages`
  MODIFY `idmessage` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `talks_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `iduser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `users_blocked`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
