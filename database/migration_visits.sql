USE nyg_transporte;

CREATE TABLE IF NOT EXISTS `visits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(150) NOT NULL,
  `referrer` varchar(500) DEFAULT NULL,
  `utm_source` varchar(100) DEFAULT NULL,
  `utm_medium` varchar(100) DEFAULT NULL,
  `utm_campaign` varchar(100) DEFAULT NULL,
  `device_type` varchar(30) DEFAULT 'Escritorio',
  `browser` varchar(50) DEFAULT NULL,
  `has_submitted_form` tinyint(1) NOT NULL DEFAULT 0,
  `form_type` varchar(50) DEFAULT NULL,
  `form_request_id` int(11) DEFAULT NULL,
  `visited_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_visited_at` (`visited_at`),
  KEY `idx_session_id` (`session_id`),
  KEY `idx_ip_address` (`ip_address`),
  KEY `idx_form` (`has_submitted_form`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
