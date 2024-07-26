-- 26 07 2024
-- new table abouts

CREATE TABLE `abouts` (
  `idx` bigint(20) unsigned NOT NULL,
  `about_title` varchar(250) NOT NULL DEFAULT '',
  `about_detail` text NOT NULL DEFAULT '',
  `event_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `abouts_unique` (`about_title`),
  KEY `abouts_events_FK` (`event_id`),
  CONSTRAINT `abouts_events_FK` FOREIGN KEY (`event_id`) REFERENCES `events` (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- remove unused columns events
ALTER TABLE event_org.events DROP COLUMN about_event;
ALTER TABLE event_org.events DROP COLUMN about1_event;
ALTER TABLE event_org.events DROP COLUMN about2_event;
ALTER TABLE event_org.events DROP COLUMN about3_event;
