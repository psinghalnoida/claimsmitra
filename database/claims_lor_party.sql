-- LOR chase (R-33): stored appointment-mail people per assignment.

CREATE TABLE IF NOT EXISTS `claims_lor_party` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` varchar(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `header_kind` varchar(16) DEFAULT NULL,
  `send_as` varchar(8) NOT NULL DEFAULT 'cc',
  `source` varchar(32) NOT NULL DEFAULT 'paste',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aid_email` (`aid`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `claims_sendlor`
  ADD COLUMN IF NOT EXISTS `reminder_frequency_days` INT NULL,
  ADD COLUMN IF NOT EXISTS `next_due_on` DATE NULL,
  ADD COLUMN IF NOT EXISTS `appointment_subject` TEXT NULL,
  ADD COLUMN IF NOT EXISTS `our_ref` VARCHAR(100) NULL;
