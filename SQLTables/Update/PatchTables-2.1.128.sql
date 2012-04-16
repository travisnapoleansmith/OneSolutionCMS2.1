
--
-- Patch for table `AdministratorContent`
--

INSERT INTO `AdministratorContent` VALUES(15, 0, 'XhtmlContent', 'admincontent', 1, 'true', 0, 'true', 'false', '<div>', NULL, 'main-content-middle', NULL, NULL, 'Site Configuration', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'Welcome to the Site Configuration section. This section allows you to configure your site. You can add, update and remove modules. You can upgrade the system. See below for all of your options.', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContent` VALUES(15, 1, 'XhtmlUnorderedList', 'adminlist', 1, 'true', 0, 'true', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContent` VALUES(15, 2, 'XhtmlContent', 'admincontent', 3, 'true', 0, 'true', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
DELETE FROM `AdministratorContent` WHERE `AdministratorContent`.`PageID` = 121 AND `AdministratorContent`.`ObjectID` = 2 AND `AdministratorContent`.`RevisionID` = 0 LIMIT 1;
DELETE FROM `AdministratorContent` WHERE `AdministratorContent`.`PageID` = 124 AND `AdministratorContent`.`ObjectID` = 2 AND `AdministratorContent`.`RevisionID` = 0 LIMIT 1;
