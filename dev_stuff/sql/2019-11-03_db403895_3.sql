-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.3
-- Erstellungszeit: 03. November 2019 um 15:25
-- Server Version: 5.6.19
-- PHP-Version: 4.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db403895_3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_appointments`
--

CREATE TABLE `fw_appointments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `datum` date NOT NULL,
  `beginn` time NOT NULL,
  `ende` time NOT NULL,
  `ort_short` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_termine` (`id`,`category_id`,`name`,`datum`,`beginn`,`ende`,`ort_short`,`ort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=408 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_archives`
--

CREATE TABLE `fw_archives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` int(10) unsigned NOT NULL,
  `table_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `version` smallint(5) unsigned NOT NULL,
  `version_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `archived_user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5124 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_autosuggests`
--

CREATE TABLE `fw_autosuggests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_blocks`
--

CREATE TABLE `fw_blocks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_categories`
--

CREATE TABLE `fw_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `context` varchar(100) NOT NULL DEFAULT '',
  `language` varchar(30) NOT NULL DEFAULT 'english',
  `precedence` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_fahrzeuge`
--

CREATE TABLE `fw_fahrzeuge` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `name_lang` varchar(50) NOT NULL,
  `prefix_rufname` varchar(30) NOT NULL,
  `rufname` varchar(10) NOT NULL,
  `text_stage` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `besatzung` varchar(4) NOT NULL,
  `hersteller` varchar(50) NOT NULL,
  `aufbau` varchar(50) NOT NULL,
  `baujahr` int(4) NOT NULL,
  `ausserdienststellung` int(4) NOT NULL,
  `kw` int(4) NOT NULL,
  `kw_unit` varchar(10) NOT NULL DEFAULT 'KW',
  `laenge` decimal(4,2) NOT NULL,
  `breite` decimal(4,2) NOT NULL,
  `hoehe` decimal(4,2) NOT NULL,
  `leermasse` decimal(4,2) NOT NULL COMMENT 'deprecated',
  `gesamtmasse` decimal(4,2) NOT NULL,
  `setcard_image` varchar(255) NOT NULL,
  `stage_image` varchar(255) NOT NULL,
  `einsaetze_zeigen` enum('yes','no') NOT NULL DEFAULT 'yes',
  `abrollbehaelter_tauglich` enum('yes','no') NOT NULL DEFAULT 'no',
  `ist_abrollbehaelter` enum('yes','no') NOT NULL DEFAULT 'no',
  `show_loadings_header` enum('yes','no') NOT NULL DEFAULT 'yes',
  `show_specialfunctions_header` enum('yes','no') NOT NULL DEFAULT 'yes',
  `module_order` varchar(255) NOT NULL DEFAULT 'loadings,specialfunctions,fittings,gallery',
  `precedence` int(10) NOT NULL,
  `retired` enum('yes','no') NOT NULL DEFAULT 'no',
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_fahrzeug_fittings`
--

CREATE TABLE `fw_fahrzeug_fittings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_fahrzeug_images`
--

CREATE TABLE `fw_fahrzeug_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=150 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_fahrzeug_loadings`
--

CREATE TABLE `fw_fahrzeug_loadings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `fach` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_fahrzeug_special_functions`
--

CREATE TABLE `fw_fahrzeug_special_functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_forms`
--

CREATE TABLE `fw_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `save_entries` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `form_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `submit_button_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reset_button_text` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `form_display` enum('auto','block','html') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'auto',
  `block_view` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block_view_module` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `form_html` text COLLATE utf8_unicode_ci NOT NULL,
  `anti_spam_method` text COLLATE utf8_unicode_ci NOT NULL,
  `inputs` text COLLATE utf8_unicode_ci NOT NULL,
  `javascript_submit` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `javascript_validate` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `javascript_waiting_message` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_recipients` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_cc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_bcc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_message` text COLLATE utf8_unicode_ci NOT NULL,
  `after_submit_text` text COLLATE utf8_unicode_ci NOT NULL,
  `return_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_form_entries`
--

CREATE TABLE `fw_form_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remote_ip` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  `is_spam` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_fuel_search`
--

CREATE TABLE `fw_fuel_search` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL DEFAULT '',
  `scope` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `excerpt` text NOT NULL,
  `language` varchar(30) NOT NULL DEFAULT 'english',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`),
  FULLTEXT KEY `title` (`location`,`title`,`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_logs`
--

CREATE TABLE `fw_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10427 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mannschaft_executives`
--

CREATE TABLE `fw_mannschaft_executives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mannschaft_grades`
--

CREATE TABLE `fw_mannschaft_grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `name_m` varchar(100) NOT NULL,
  `name_w` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mannschaft_members`
--

CREATE TABLE `fw_mannschaft_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL DEFAULT '1',
  `grade_id` int(11) NOT NULL,
  `executive_id` int(11) NOT NULL DEFAULT '0',
  `team_id` int(11) NOT NULL DEFAULT '2',
  `name` varchar(100) NOT NULL,
  `vorname` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `show_image` enum('yes','no') NOT NULL DEFAULT 'yes',
  `geschlecht` enum('m','w') NOT NULL DEFAULT 'm',
  `geburtstag` date NOT NULL,
  `show_geburtstag` enum('yes','no') NOT NULL DEFAULT 'yes',
  `eintrittsdatum` date NOT NULL,
  `show_eintrittsdatum` enum('yes','no') NOT NULL DEFAULT 'yes',
  `beruf` varchar(255) NOT NULL,
  `show_beruf` enum('yes','no') NOT NULL DEFAULT 'yes',
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mannschaft_sections`
--

CREATE TABLE `fw_mannschaft_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mannschaft_teams`
--

CREATE TABLE `fw_mannschaft_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_missions`
--

CREATE TABLE `fw_missions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type_id` int(10) NOT NULL,
  `cue_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `datum_beginn` date NOT NULL,
  `uhrzeit_beginn` time NOT NULL,
  `datum_ende` date NOT NULL,
  `uhrzeit_ende` time NOT NULL,
  `einsatz_nr` int(5) NOT NULL,
  `bericht` text NOT NULL,
  `lage` text NOT NULL,
  `ort` varchar(255) NOT NULL,
  `weitere_kraefte` text NOT NULL,
  `anzahl_kraefte` int(3) NOT NULL,
  `anzahl_einsaetze` int(3) NOT NULL,
  `ueberoertlich` enum('yes','no') NOT NULL DEFAULT 'no',
  `ort_zeigen` enum('yes','no') NOT NULL DEFAULT 'yes',
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4039 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mission_cues`
--

CREATE TABLE `fw_mission_cues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mission_images`
--

CREATE TABLE `fw_mission_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `photographer` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1182 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mission_templates`
--

CREATE TABLE `fw_mission_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `einsatz_name` varchar(255) NOT NULL,
  `lage` text NOT NULL,
  `bericht` text NOT NULL,
  `ort` varchar(255) NOT NULL,
  `weitere_kraefte` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_mission_types`
--

CREATE TABLE `fw_mission_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(4) NOT NULL,
  `name_plural` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_navigation`
--

CREATE TABLE `fw_navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The part of the path after the domain name that you want the link to go to (e.g. comany/about_us)',
  `group_id` int(5) unsigned NOT NULL DEFAULT '1',
  `nav_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The nav key is a friendly ID that you can use for setting the selected state. If left blank, a default value will be set for you.',
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name you want to appear in the menu',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Used for creating menu hierarchies. No value means it is a root level menu item',
  `precedence` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The higher the number, the greater the precedence and farther up the list the navigational element will appear',
  `attributes` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Extra attributes that can be used for navigation implementation',
  `selected` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The pattern to match for the active state. Most likely you leave this field blank',
  `hidden` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'A hidden value can be used in rendering the menu. In some areas, the menu item may not want to be displayed',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'Determines whether the item is displayed or not',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id_nav_key_language` (`group_id`,`nav_key`,`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_navigation_groups`
--

CREATE TABLE `fw_navigation_groups` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_news_articles`
--

CREATE TABLE `fw_news_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `stage_title` varchar(20) NOT NULL,
  `link` varchar(255) NOT NULL,
  `teaser` text NOT NULL,
  `text` text NOT NULL,
  `text_detail_button` varchar(20) NOT NULL DEFAULT 'Mehr lesen',
  `teaser_image` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `datum` date NOT NULL,
  `last_modified_by` int(11) NOT NULL DEFAULT '0',
  `last_modified` datetime NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `stage_title` (`stage_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_news_images`
--

CREATE TABLE `fw_news_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `photographer` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=333 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_pages`
--

CREATE TABLE `fw_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Add the part of the url after the root of your site (usually after the domain name). For the homepage, just put the word ''home''',
  `layout` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the template to associate with this page',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'A ''yes'' value will display the page and an ''no'' value will give a 404 error message',
  `cache` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'Cache controls whether the page will pull from the database or from a saved file which is more effeicent. If a page has content that is dynamic, it''s best to set cache to ''no''',
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` int(10) unsigned NOT NULL,
  `stage_id` int(10) NOT NULL,
  `stage_id_detail` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`),
  KEY `layout` (`layout`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_page_variables`
--

CREATE TABLE `fw_page_variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('string','int','boolean','array') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'string',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_id` (`page_id`,`name`,`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=758 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_permissions`
--

CREATE TABLE `fw_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'In most cases, this should be the name of the module (e.g. news)',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=126 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_pressarticles`
--

CREATE TABLE `fw_pressarticles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `source_id` int(10) NOT NULL,
  `datum` date NOT NULL,
  `online_article` varchar(255) NOT NULL,
  `asset` varchar(255) NOT NULL,
  `published` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=175 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_pressarticle_sources`
--

CREATE TABLE `fw_pressarticle_sources` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_relationships`
--

CREATE TABLE `fw_relationships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_table` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `candidate_key` int(11) NOT NULL,
  `foreign_table` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidate_table_2` (`candidate_table`,`candidate_key`,`foreign_table`,`foreign_key`),
  UNIQUE KEY `candidate_table_3` (`candidate_table`,`candidate_key`,`foreign_table`,`foreign_key`),
  KEY `candidate_table` (`candidate_table`,`candidate_key`),
  KEY `foreign_table` (`foreign_table`,`foreign_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30964 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_settings`
--

CREATE TABLE `fw_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module` (`module`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_site_variables`
--

CREATE TABLE `fw_site_variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'leave blank if you want the variable to be available to all pages',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_stages`
--

CREATE TABLE `fw_stages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type_id` int(10) NOT NULL,
  `randomize` enum('yes','no') NOT NULL DEFAULT 'no',
  `img_count` tinyint(3) NOT NULL DEFAULT '1',
  `last_modified` datetime NOT NULL,
  `last_modified_by` int(10) NOT NULL,
  `published` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_stage_images`
--

CREATE TABLE `fw_stage_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stage_image_type_id` int(10) NOT NULL,
  `text_1` varchar(100) NOT NULL,
  `text_2` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `css_text_class_1` varchar(255) NOT NULL,
  `css_text_class_2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_stage_types`
--

CREATE TABLE `fw_stage_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `css_outer_class` varchar(255) NOT NULL,
  `css_slidewrapper_class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_tags`
--

CREATE TABLE `fw_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `precedence` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_tickets`
--

CREATE TABLE `fw_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(10) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `title` enum('Frau','Herr') NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `city` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `payed` enum('yes','no') NOT NULL DEFAULT 'no',
  `pay_date` date NOT NULL,
  `notified` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_users`
--

CREATE TABLE `fw_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `reset_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `super_admin` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fw_weather`
--

CREATE TABLE `fw_weather` (
  `id` int(11) NOT NULL,
  `last_call` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `json` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Nutzung für openweather Dienst als Puffertabelle';
