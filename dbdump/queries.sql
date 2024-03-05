-- Apoorva 5 Apr

UPDATE `vms_cms` SET `title` = 'See How It Works Video' WHERE `vms_cms`.`id` = 127;
UPDATE `vms_cms` SET `slug` = 'see-how-it-works-video' WHERE `vms_cms`.`id` = 127;
ALTER TABLE `vms_users` ADD `account_id` INT NULL AFTER `property_id`;
ALTER TABLE `vms_accounts` CHANGE `status` `status` ENUM('AC','IN','DL') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN';

-- Apoorva 13 Apr

ALTER TABLE `vms_accounts` ADD `otp_sent` BOOLEAN NOT NULL DEFAULT FALSE AFTER `otp`;