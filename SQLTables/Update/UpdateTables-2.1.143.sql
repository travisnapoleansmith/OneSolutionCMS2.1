UPDATE `AdministratorHeaderPanel1` SET `Div1` = '<h1 class=''MainHeading''>One Solution CMS</h1>' WHERE `AdministratorHeaderPanel1`.`ObjectID` = 1;

UPDATE `AdministratorContentLayerTheme` SET `JavaScriptSheet6` = '../Libraries/Tier7BehavioralLayer/jQuery/jquery-1.9.1.min.js' WHERE CONVERT(`AdministratorContentLayerTheme`.`ThemeName` USING utf8) = 'AdminTheme' LIMIT 1;

REPLACE INTO `AdministratorFormLabel` VALUES(132, 1, 'Calendar Page', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormLabel` VALUES(137, 1, 'Calendar Page', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

UPDATE `AdministratorFormSelect` SET `FormSelectStyle` = 'width: 550px;';

REPLACE INTO `AdministratorFormLabel` VALUES(117, 1, 'News Page', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `ContentLayerVersion` CHANGE `ContentPageType` `ContentPageType` ENUM('ContentPage','NewsPage','CalendarPage','ListPage','PhotosPage','VideosPage','FormPage','BlockquotePage','MultiHeaderContentPage','MenuItem','SimpleViewerPage','TablesPage') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'ContentPage';

UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarDay' WHERE `AdministratorFormValidation`.`PageID` = 130 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsDay' LIMIT 1; 
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarMonth' WHERE `AdministratorFormValidation`.`PageID` = 130 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsMonth' LIMIT 1; 
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarYear' WHERE `AdministratorFormValidation`.`PageID` = 130 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsYear' LIMIT 1;
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarDay' WHERE `AdministratorFormValidation`.`PageID` = 133 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsDay' LIMIT 1; 
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarMonth' WHERE `AdministratorFormValidation`.`PageID` = 133 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsMonth' LIMIT 1; 
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarYear' WHERE `AdministratorFormValidation`.`PageID` = 133 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsYear' LIMIT 1;

UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarDay' WHERE `AdministratorFormValidation`.`PageID` = 133 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsDay' LIMIT 1; 
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarMonth' WHERE `AdministratorFormValidation`.`PageID` = 133 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsMonth' LIMIT 1; 
UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'CalendarYear' WHERE `AdministratorFormValidation`.`PageID` = 133 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'NewsYear' LIMIT 1;

ALTER TABLE `CalendarTable` ADD `RevisionID` INT NOT NULL AFTER `ObjectID`;
ALTER TABLE `CalendarTable` ADD `CurrentVersion` ENUM('true','false') NOT NULL DEFAULT 'false' AFTER `RevisionID`;
ALTER TABLE `CalendarTable` DROP INDEX `PageID`;
ALTER TABLE `CalendarTable` ADD UNIQUE( `PageID`, `ObjectID`, `RevisionID`, `CalendarAppointmentName`);

UPDATE `AdministratorList` SET `Li4` = '<a href=''index.php?PageID=139''>Calendar Page</a>' WHERE `AdministratorList`.`PageID` = 11 AND `AdministratorList`.`ObjectID` = 3 LIMIT 1;
