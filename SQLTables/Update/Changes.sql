DELETE FROM `AdministratorContentLayerModulesSettings` WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'adpanel1' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'FileName' LIMIT 1;
DELETE FROM `AdministratorContentLayerModulesSettings` WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'adpanel1' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'NoAttributes' LIMIT 1;

ALTER TABLE `CalendarAppointments` ADD `CalendarID` INT NOT NULL FIRST;
ALTER TABLE `CalendarAppointments` DROP INDEX `Day`;
ALTER TABLE `CalendarAppointments` ADD UNIQUE( `CalendarID`);

ALTER TABLE `ContentLayerVersion` CHANGE `ContentPageType` `ContentPageType` ENUM('ContentPage','NewsPage','SchedulePage','ListPage','PhotosPage','VideosPage','FormPage','BlockquotePage','MultiHeaderContentPage','MenuItem','SimpleViewerPage','TablesPage') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'ContentPage';
ALTER TABLE `AdministratorContentLayerVersion` CHANGE `ContentPageType` `ContentPageType` ENUM('ContentPage','NewsPage','SchedulePage','ListPage','PhotosPage','VideosPage','FormPage','BlockquotePage','MultiHeaderContentPage','MenuItem','SimpleViewerPage','TablesPage') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'FormPage';

ALTER TABLE `XhtmlTableLookup` ADD `RevisionID` INT NOT NULL AFTER `ObjectID`, ADD `CurrentVersion` ENUM('true','false') NOT NULL AFTER `RevisionID`;
ALTER TABLE `AdministratorXhtmlTableLookup` ADD `RevisionID` INT NOT NULL AFTER `ObjectID`, ADD `CurrentVersion` ENUM('true','false') NOT NULL AFTER `RevisionID`;

ALTER TABLE `AdministratorXhtmlTableLookup` DROP INDEX `PageID`;
ALTER TABLE `XhtmlTableLookup` DROP INDEX `PageID`;

ALTER TABLE `AdministratorXhtmlTableLookup` ADD UNIQUE(`PageID`, `ObjectID`, `RevisionID`);
ALTER TABLE `XhtmlTableLookup` ADD UNIQUE(`PageID`, `ObjectID`, `RevisionID`);

ALTER TABLE `XhtmlTable`
  DROP `TableBorder`,
  DROP `TableCellPadding`,
  DROP `TableCellSpacing`,
  DROP `TableFrame`,
  DROP `TablesRules`,
  DROP `TableSummary`,
  DROP `TableWidth`,
  DROP `TableClass`,
  DROP `TableDir`,
  DROP `TableID`,
  DROP `TableLang`,
  DROP `TableStyle`,
  DROP `TableTitle`,
  DROP `TableXMLLang`;

ALTER TABLE `AdministratorXhtmlTable`
  DROP `TableBorder`,
  DROP `TableCellPadding`,
  DROP `TableCellSpacing`,
  DROP `TableFrame`,
  DROP `TablesRules`,
  DROP `TableSummary`,
  DROP `TableWidth`,
  DROP `TableClass`,
  DROP `TableDir`,
  DROP `TableID`,
  DROP `TableLang`,
  DROP `TableStyle`,
  DROP `TableTitle`,
  DROP `TableXMLLang`;

ALTER TABLE `XhtmlTable` ADD `StopObjectID` INT NULL AFTER `ObjectID`;
ALTER TABLE `AdministratorXhtmlTable` ADD `StopObjectID` INT NULL AFTER `ObjectID`;

ALTER TABLE `XhtmlTableLookup` CHANGE `XhtmlTableName` `XhtmlTableName` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `TableName` `TableName` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableLookup` CHANGE `XhtmlTableName` `XhtmlTableName` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `TableName` `TableName` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableLookup` CHANGE `XhtmlTableName` `XhtmlTableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableLookup` CHANGE `XhtmlTableName` `XhtmlTableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTable` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTable` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableRow` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableRow` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableRowCell` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableRowCell` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableCaption` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableCaption` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableCol` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableCol` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableColGroup` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableColGroup` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableColGroupCol` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableColGroupCol` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

--
-- Table structure for table `XhtmlTableLinkedLookup`
--

DROP TABLE IF EXISTS `XhtmlTableLinkedLookup`;
CREATE TABLE `XhtmlTableLinkedLookup` (
  `TableName` varchar(250) NOT NULL,
  `LinkedTableName1` varchar(250) default NULL,
  `LinkedTableName1Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName1CustomOperation` text,
  `LinkedTableName2` varchar(250) default NULL,
  `LinkedTableName2Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName2CustomOperation` text,
  `LinkedTableName3` varchar(250) default NULL,
  `LinkedTableName3Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName3CustomOperation` text,
  `LinkedTableName4` varchar(250) default NULL,
  `LinkedTableName4Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName4CustomOperation` text,
  `LinkedTableName5` varchar(250) default NULL,
  `LinkedTableName5Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName5CustomOperation` text,
  `LinkedTableName6` varchar(250) default NULL,
  `LinkedTableName6Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName6CustomOperation` text,
  `LinkedTableName7` varchar(250) default NULL,
  `LinkedTableName7Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName7CustomOperation` text,
  `LinkedTableName8` varchar(250) default NULL,
  `LinkedTableName8Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName8CustomOperation` text,
  `LinkedTableName9` varchar(250) default NULL,
  `LinkedTableName9Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName9CustomOperation` text,
  `LinkedTableName10` varchar(250) default NULL,
  `LinkedTableName10Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName10CustomOperation` text,
  `LinkedTableName11` varchar(250) default NULL,
  `LinkedTableName11Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName11CustomOperation` text,
  `LinkedTableName12` varchar(250) default NULL,
  `LinkedTableName12Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName12CustomOperation` text,
  `LinkedTableName13` varchar(250) default NULL,
  `LinkedTableName13Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName13CustomOperation` text,
  `LinkedTableName14` varchar(250) default NULL,
  `LinkedTableName14Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName14CustomOperation` text,
  `LinkedTableName15` varchar(250) default NULL,
  `LinkedTableName15Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName15CustomOperation` text,
  `LinkedTableName16` varchar(250) default NULL,
  `LinkedTableName16Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName16CustomOperation` text,
  `LinkedTableName17` varchar(250) default NULL,
  `LinkedTableName17Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName17CustomOperation` text,
  `LinkedTableName18` varchar(250) default NULL,
  `LinkedTableName18Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName18CustomOperation` text,
  `LinkedTableName19` varchar(250) default NULL,
  `LinkedTableName19Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName19CustomOperation` text,
  `LinkedTableName20` varchar(250) default NULL,
  `LinkedTableName20Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName20CustomOperation` text,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `XhtmlTableLinkedLookup`
--

DROP TABLE IF EXISTS `AdministratorXhtmlTableLinkedLookup`;
CREATE TABLE `AdministratorXhtmlTableLinkedLookup` (
  `TableName` varchar(250) NOT NULL,
  `LinkedTableName1` varchar(250) default NULL,
  `LinkedTableName1Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName1CustomOperation` text,
  `LinkedTableName2` varchar(250) default NULL,
  `LinkedTableName2Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName2CustomOperation` text,
  `LinkedTableName3` varchar(250) default NULL,
  `LinkedTableName3Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName3CustomOperation` text,
  `LinkedTableName4` varchar(250) default NULL,
  `LinkedTableName4Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName4CustomOperation` text,
  `LinkedTableName5` varchar(250) default NULL,
  `LinkedTableName5Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName5CustomOperation` text,
  `LinkedTableName6` varchar(250) default NULL,
  `LinkedTableName6Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName6CustomOperation` text,
  `LinkedTableName7` varchar(250) default NULL,
  `LinkedTableName7Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName7CustomOperation` text,
  `LinkedTableName8` varchar(250) default NULL,
  `LinkedTableName8Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName8CustomOperation` text,
  `LinkedTableName9` varchar(250) default NULL,
  `LinkedTableName9Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName9CustomOperation` text,
  `LinkedTableName10` varchar(250) default NULL,
  `LinkedTableName10Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName10CustomOperation` text,
  `LinkedTableName11` varchar(250) default NULL,
  `LinkedTableName11Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName11CustomOperation` text,
  `LinkedTableName12` varchar(250) default NULL,
  `LinkedTableName12Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName12CustomOperation` text,
  `LinkedTableName13` varchar(250) default NULL,
  `LinkedTableName13Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName13CustomOperation` text,
  `LinkedTableName14` varchar(250) default NULL,
  `LinkedTableName14Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName14CustomOperation` text,
  `LinkedTableName15` varchar(250) default NULL,
  `LinkedTableName15Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName15CustomOperation` text,
  `LinkedTableName16` varchar(250) default NULL,
  `LinkedTableName16Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName16CustomOperation` text,
  `LinkedTableName17` varchar(250) default NULL,
  `LinkedTableName17Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName17CustomOperation` text,
  `LinkedTableName18` varchar(250) default NULL,
  `LinkedTableName18Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName18CustomOperation` text,
  `LinkedTableName19` varchar(250) default NULL,
  `LinkedTableName19Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName19CustomOperation` text,
  `LinkedTableName20` varchar(250) default NULL,
  `LinkedTableName20Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName20CustomOperation` text,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableTBody` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTBody` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableRowHeader` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableRowHeader` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

--
-- Table structure for table `XhtmlTableLinkedLookup`
--

DROP TABLE IF EXISTS `XhtmlTableRowLinkedLookup`;
CREATE TABLE `XhtmlTableRowLinkedLookup` (
  `TableName` varchar(250) NOT NULL,
  `LinkedTableName1` varchar(250) default NULL,
  `LinkedTableName1Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName1CustomOperation` text,
  `LinkedTableName2` varchar(250) default NULL,
  `LinkedTableName2Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName2CustomOperation` text,
  `LinkedTableName3` varchar(250) default NULL,
  `LinkedTableName3Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName3CustomOperation` text,
  `LinkedTableName4` varchar(250) default NULL,
  `LinkedTableName4Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName4CustomOperation` text,
  `LinkedTableName5` varchar(250) default NULL,
  `LinkedTableName5Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName5CustomOperation` text,
  `LinkedTableName6` varchar(250) default NULL,
  `LinkedTableName6Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName6CustomOperation` text,
  `LinkedTableName7` varchar(250) default NULL,
  `LinkedTableName7Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName7CustomOperation` text,
  `LinkedTableName8` varchar(250) default NULL,
  `LinkedTableName8Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName8CustomOperation` text,
  `LinkedTableName9` varchar(250) default NULL,
  `LinkedTableName9Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName9CustomOperation` text,
  `LinkedTableName10` varchar(250) default NULL,
  `LinkedTableName10Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName10CustomOperation` text,
  `LinkedTableName11` varchar(250) default NULL,
  `LinkedTableName11Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName11CustomOperation` text,
  `LinkedTableName12` varchar(250) default NULL,
  `LinkedTableName12Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName12CustomOperation` text,
  `LinkedTableName13` varchar(250) default NULL,
  `LinkedTableName13Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName13CustomOperation` text,
  `LinkedTableName14` varchar(250) default NULL,
  `LinkedTableName14Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName14CustomOperation` text,
  `LinkedTableName15` varchar(250) default NULL,
  `LinkedTableName15Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName15CustomOperation` text,
  `LinkedTableName16` varchar(250) default NULL,
  `LinkedTableName16Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName16CustomOperation` text,
  `LinkedTableName17` varchar(250) default NULL,
  `LinkedTableName17Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName17CustomOperation` text,
  `LinkedTableName18` varchar(250) default NULL,
  `LinkedTableName18Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName18CustomOperation` text,
  `LinkedTableName19` varchar(250) default NULL,
  `LinkedTableName19Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName19CustomOperation` text,
  `LinkedTableName20` varchar(250) default NULL,
  `LinkedTableName20Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName20CustomOperation` text,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `XhtmlTableLinkedLookup`
--

DROP TABLE IF EXISTS `AdministratorXhtmlTableRowLinkedLookup`;
CREATE TABLE `AdministratorXhtmlTableRowLinkedLookup` (
  `TableName` varchar(250) NOT NULL,
  `LinkedTableName1` varchar(250) default NULL,
  `LinkedTableName1Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName1CustomOperation` text,
  `LinkedTableName2` varchar(250) default NULL,
  `LinkedTableName2Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName2CustomOperation` text,
  `LinkedTableName3` varchar(250) default NULL,
  `LinkedTableName3Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName3CustomOperation` text,
  `LinkedTableName4` varchar(250) default NULL,
  `LinkedTableName4Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName4CustomOperation` text,
  `LinkedTableName5` varchar(250) default NULL,
  `LinkedTableName5Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName5CustomOperation` text,
  `LinkedTableName6` varchar(250) default NULL,
  `LinkedTableName6Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName6CustomOperation` text,
  `LinkedTableName7` varchar(250) default NULL,
  `LinkedTableName7Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName7CustomOperation` text,
  `LinkedTableName8` varchar(250) default NULL,
  `LinkedTableName8Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName8CustomOperation` text,
  `LinkedTableName9` varchar(250) default NULL,
  `LinkedTableName9Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName9CustomOperation` text,
  `LinkedTableName10` varchar(250) default NULL,
  `LinkedTableName10Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName10CustomOperation` text,
  `LinkedTableName11` varchar(250) default NULL,
  `LinkedTableName11Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName11CustomOperation` text,
  `LinkedTableName12` varchar(250) default NULL,
  `LinkedTableName12Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName12CustomOperation` text,
  `LinkedTableName13` varchar(250) default NULL,
  `LinkedTableName13Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName13CustomOperation` text,
  `LinkedTableName14` varchar(250) default NULL,
  `LinkedTableName14Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName14CustomOperation` text,
  `LinkedTableName15` varchar(250) default NULL,
  `LinkedTableName15Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName15CustomOperation` text,
  `LinkedTableName16` varchar(250) default NULL,
  `LinkedTableName16Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName16CustomOperation` text,
  `LinkedTableName17` varchar(250) default NULL,
  `LinkedTableName17Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName17CustomOperation` text,
  `LinkedTableName18` varchar(250) default NULL,
  `LinkedTableName18Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName18CustomOperation` text,
  `LinkedTableName19` varchar(250) default NULL,
  `LinkedTableName19Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName19CustomOperation` text,
  `LinkedTableName20` varchar(250) default NULL,
  `LinkedTableName20Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName20CustomOperation` text,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableTFoot` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTFoot` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableTFootCell` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTFootCell` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

--
-- Table structure for table `XhtmlTableLinkedLookup`
--

DROP TABLE IF EXISTS `XhtmlTableTFootLinkedLookup`;
CREATE TABLE `XhtmlTableTFootLinkedLookup` (
  `TableName` varchar(250) NOT NULL,
  `LinkedTableName1` varchar(250) default NULL,
  `LinkedTableName1Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName1CustomOperation` text,
  `LinkedTableName2` varchar(250) default NULL,
  `LinkedTableName2Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName2CustomOperation` text,
  `LinkedTableName3` varchar(250) default NULL,
  `LinkedTableName3Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName3CustomOperation` text,
  `LinkedTableName4` varchar(250) default NULL,
  `LinkedTableName4Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName4CustomOperation` text,
  `LinkedTableName5` varchar(250) default NULL,
  `LinkedTableName5Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName5CustomOperation` text,
  `LinkedTableName6` varchar(250) default NULL,
  `LinkedTableName6Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName6CustomOperation` text,
  `LinkedTableName7` varchar(250) default NULL,
  `LinkedTableName7Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName7CustomOperation` text,
  `LinkedTableName8` varchar(250) default NULL,
  `LinkedTableName8Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName8CustomOperation` text,
  `LinkedTableName9` varchar(250) default NULL,
  `LinkedTableName9Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName9CustomOperation` text,
  `LinkedTableName10` varchar(250) default NULL,
  `LinkedTableName10Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName10CustomOperation` text,
  `LinkedTableName11` varchar(250) default NULL,
  `LinkedTableName11Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName11CustomOperation` text,
  `LinkedTableName12` varchar(250) default NULL,
  `LinkedTableName12Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName12CustomOperation` text,
  `LinkedTableName13` varchar(250) default NULL,
  `LinkedTableName13Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName13CustomOperation` text,
  `LinkedTableName14` varchar(250) default NULL,
  `LinkedTableName14Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName14CustomOperation` text,
  `LinkedTableName15` varchar(250) default NULL,
  `LinkedTableName15Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName15CustomOperation` text,
  `LinkedTableName16` varchar(250) default NULL,
  `LinkedTableName16Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName16CustomOperation` text,
  `LinkedTableName17` varchar(250) default NULL,
  `LinkedTableName17Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName17CustomOperation` text,
  `LinkedTableName18` varchar(250) default NULL,
  `LinkedTableName18Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName18CustomOperation` text,
  `LinkedTableName19` varchar(250) default NULL,
  `LinkedTableName19Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName19CustomOperation` text,
  `LinkedTableName20` varchar(250) default NULL,
  `LinkedTableName20Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName20CustomOperation` text,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `XhtmlTableLinkedLookup`
--

DROP TABLE IF EXISTS `AdministratorXhtmlTableTFootLinkedLookup`;
CREATE TABLE `AdministratorXhtmlTableTFootLinkedLookup` (
  `TableName` varchar(250) NOT NULL,
  `LinkedTableName1` varchar(250) default NULL,
  `LinkedTableName1Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName1CustomOperation` text,
  `LinkedTableName2` varchar(250) default NULL,
  `LinkedTableName2Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName2CustomOperation` text,
  `LinkedTableName3` varchar(250) default NULL,
  `LinkedTableName3Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName3CustomOperation` text,
  `LinkedTableName4` varchar(250) default NULL,
  `LinkedTableName4Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName4CustomOperation` text,
  `LinkedTableName5` varchar(250) default NULL,
  `LinkedTableName5Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName5CustomOperation` text,
  `LinkedTableName6` varchar(250) default NULL,
  `LinkedTableName6Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName6CustomOperation` text,
  `LinkedTableName7` varchar(250) default NULL,
  `LinkedTableName7Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName7CustomOperation` text,
  `LinkedTableName8` varchar(250) default NULL,
  `LinkedTableName8Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName8CustomOperation` text,
  `LinkedTableName9` varchar(250) default NULL,
  `LinkedTableName9Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName9CustomOperation` text,
  `LinkedTableName10` varchar(250) default NULL,
  `LinkedTableName10Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName10CustomOperation` text,
  `LinkedTableName11` varchar(250) default NULL,
  `LinkedTableName11Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName11CustomOperation` text,
  `LinkedTableName12` varchar(250) default NULL,
  `LinkedTableName12Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName12CustomOperation` text,
  `LinkedTableName13` varchar(250) default NULL,
  `LinkedTableName13Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName13CustomOperation` text,
  `LinkedTableName14` varchar(250) default NULL,
  `LinkedTableName14Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName14CustomOperation` text,
  `LinkedTableName15` varchar(250) default NULL,
  `LinkedTableName15Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName15CustomOperation` text,
  `LinkedTableName16` varchar(250) default NULL,
  `LinkedTableName16Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName16CustomOperation` text,
  `LinkedTableName17` varchar(250) default NULL,
  `LinkedTableName17Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName17CustomOperation` text,
  `LinkedTableName18` varchar(250) default NULL,
  `LinkedTableName18Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName18CustomOperation` text,
  `LinkedTableName19` varchar(250) default NULL,
  `LinkedTableName19Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName19CustomOperation` text,
  `LinkedTableName20` varchar(250) default NULL,
  `LinkedTableName20Operation` enum('ADD','SUBTRACT','MULTIPLY','DIVIDE','AVERAGE','CUSTOM') default NULL,
  `LinkedTableName20CustomOperation` text,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableTHead` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTHead` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableTHeadHeader` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTHeadHeader` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

--
-- Table structure for table `XhtmlTableLookup`
--

DROP TABLE IF EXISTS `XhtmlTableLookup`;
CREATE TABLE `XhtmlTableLookup` (
  `PageID` int(11) NOT NULL,
  `ObjectID` int(11) default NULL,
  `RevisionID` int(11) NOT NULL,
  `CurrentVersion` enum('true','false') NOT NULL,
  `XhtmlTableName` varchar(250) NOT NULL,
  `TableName` varchar(250) NOT NULL,
  `LinkedTable` enum('True','False') NOT NULL default 'False',
  `TableBorder` int(11) default NULL,
  `TableCellPadding` int(11) default NULL,
  `TableCellSpacing` int(11) default NULL,
  `TableFrame` enum('void','above','below','hsides','lhs','rhs','vsides','box','border') default NULL,
  `TablesRules` enum('none','groups','rows','cols','all') default NULL,
  `TableSummary` text NOT NULL,
  `TableWidth` int(11) default NULL,
  `TableClass` text NOT NULL,
  `TableDir` enum('rtl','ltr') default NULL,
  `TableID` text NOT NULL,
  `TableLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableStyle` text NOT NULL,
  `TableTitle` text NOT NULL,
  `TableXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `PageID` (`PageID`,`ObjectID`,`RevisionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `AdministratorXhtmlTableLookup`
--

DROP TABLE IF EXISTS `AdministratorXhtmlTableLookup`;
CREATE TABLE `AdministratorXhtmlTableLookup` (
  `PageID` int(11) NOT NULL,
  `ObjectID` int(11) default NULL,
  `RevisionID` int(11) NOT NULL,
  `CurrentVersion` enum('true','false') NOT NULL,
  `XhtmlTableName` varchar(250) NOT NULL,
  `TableName` varchar(250) NOT NULL,
  `LinkedTable` enum('True','False') NOT NULL default 'False',
  `TableBorder` int(11) default NULL,
  `TableCellPadding` int(11) default NULL,
  `TableCellSpacing` int(11) default NULL,
  `TableFrame` enum('void','above','below','hsides','lhs','rhs','vsides','box','border') default NULL,
  `TablesRules` enum('none','groups','rows','cols','all') default NULL,
  `TableSummary` text NOT NULL,
  `TableWidth` int(11) default NULL,
  `TableClass` text NOT NULL,
  `TableDir` enum('rtl','ltr') default NULL,
  `TableID` text NOT NULL,
  `TableLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableStyle` text NOT NULL,
  `TableTitle` text NOT NULL,
  `TableXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `PageID` (`PageID`,`ObjectID`,`RevisionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableLookup` CHANGE `TableSummary` `TableSummary` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableClass` `TableClass` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableID` `TableID` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableStyle` `TableStyle` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableTitle` `TableTitle` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `AdministratorXhtmlTableLookup` CHANGE `TableSummary` `TableSummary` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableClass` `TableClass` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableID` `TableID` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableStyle` `TableStyle` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `TableTitle` `TableTitle` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

--
-- Table structure for table `XhtmlTableTHead`
--

DROP TABLE IF EXISTS `XhtmlTableTHead`;
CREATE TABLE `XhtmlTableTHead` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Header') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTHeadHeader') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `TableHeaderAlign` enum('right','left','center','justify','char') default NULL,
  `TableHeaderChar` varchar(50) default NULL,
  `TableHeaderCharOff` int(11) default NULL,
  `TableHeaderVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableHeaderClass` text,
  `TableHeaderDir` enum('rtl','ltr') default NULL,
  `TableHeaderID` text,
  `TableHeaderLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableHeaderStyle` text,
  `TableHeaderTitle` text,
  `TableHeaderXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `AdministratorXhtmlTableTHead`
--

DROP TABLE IF EXISTS `AdministratorXhtmlTableTHead`;
CREATE TABLE `AdministratorXhtmlTableTHead` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Header') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTHeadHeader') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `TableHeaderAlign` enum('right','left','center','justify','char') default NULL,
  `TableHeaderChar` varchar(50) default NULL,
  `TableHeaderCharOff` int(11) default NULL,
  `TableHeaderVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableHeaderClass` text,
  `TableHeaderDir` enum('rtl','ltr') default NULL,
  `TableHeaderID` text,
  `TableHeaderLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableHeaderStyle` text,
  `TableHeaderTitle` text,
  `TableHeaderXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableTBodyCell` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTBodyCell` CHANGE `TableName` `TableName` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `XhtmlTableTHead` CHANGE `ContainerObjectTypeName` `ContainerObjectTypeName` ENUM('XhtmlTableTHeadContent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `AdministratorXhtmlTableTHead` CHANGE `ContainerObjectTypeName` `ContainerObjectTypeName` ENUM('XhtmlTableTHeadContent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `XhtmlTableTFoot` CHANGE `ContainerObjectTypeName` `ContainerObjectTypeName` ENUM('XhtmlTableTFootContent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `AdministratorXhtmlTableTFoot` CHANGE `ContainerObjectTypeName` `ContainerObjectTypeName` ENUM('XhtmlTableTFootContent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `XhtmlTableTBody` CHANGE `ContainerObjectTypeName` `ContainerObjectTypeName` ENUM('XhtmlTableTBodyContent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `AdministratorXhtmlTableTBody` CHANGE `ContainerObjectTypeName` `ContainerObjectTypeName` ENUM('XhtmlTableTBodyContent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

--
-- Table structure for table `XhtmlTableTBodyContent`
--

CREATE TABLE `XhtmlTableTBodyContent` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Cell') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTBodyCell') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `LinkedTableRow` enum('True','False') NOT NULL default 'False',
  `TableRowAlign` enum('right','left','center','justify','char') default NULL,
  `TableRowChar` varchar(50) default NULL,
  `TableRowCharOff` int(11) default NULL,
  `TableRowVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableRowClass` text,
  `TableRowDir` enum('rtl','ltr') default NULL,
  `TableRowID` text,
  `TableRowLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableRowStyle` text,
  `TableRowTitle` text,
  `TableRowXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `AdministratorXhtmlTableTBodyContent`
--

CREATE TABLE `AdministratorXhtmlTableTBodyContent` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Cell') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTBodyCell') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `LinkedTableRow` enum('True','False') NOT NULL default 'False',
  `TableRowAlign` enum('right','left','center','justify','char') default NULL,
  `TableRowChar` varchar(50) default NULL,
  `TableRowCharOff` int(11) default NULL,
  `TableRowVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableRowClass` text,
  `TableRowDir` enum('rtl','ltr') default NULL,
  `TableRowID` text,
  `TableRowLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableRowStyle` text,
  `TableRowTitle` text,
  `TableRowXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `XhtmlTableTFootContent`
--

CREATE TABLE `XhtmlTableTFootContent` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Cell') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTFootCell') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `LinkedTableRow` enum('True','False') NOT NULL default 'False',
  `TableRowAlign` enum('right','left','center','justify','char') default NULL,
  `TableRowChar` varchar(50) default NULL,
  `TableRowCharOff` int(11) default NULL,
  `TableRowVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableRowClass` text,
  `TableRowDir` enum('rtl','ltr') default NULL,
  `TableRowID` text,
  `TableRowLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableRowStyle` text,
  `TableRowTitle` text,
  `TableRowXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `AdministratorXhtmlTableTFootContent`
--

CREATE TABLE `AdministratorXhtmlTableTFootContent` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Cell') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTFootCell') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `LinkedTableRow` enum('True','False') NOT NULL default 'False',
  `TableRowAlign` enum('right','left','center','justify','char') default NULL,
  `TableRowChar` varchar(50) default NULL,
  `TableRowCharOff` int(11) default NULL,
  `TableRowVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableRowClass` text,
  `TableRowDir` enum('rtl','ltr') default NULL,
  `TableRowID` text,
  `TableRowLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableRowStyle` text,
  `TableRowTitle` text,
  `TableRowXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `XhtmlTableTHeadContent`
--

CREATE TABLE `XhtmlTableTHeadContent` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Header') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTHeadHeader') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `TableHeaderAlign` enum('right','left','center','justify','char') default NULL,
  `TableHeaderChar` varchar(50) default NULL,
  `TableHeaderCharOff` int(11) default NULL,
  `TableHeaderVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableHeaderClass` text,
  `TableHeaderDir` enum('rtl','ltr') default NULL,
  `TableHeaderID` text,
  `TableHeaderLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableHeaderStyle` text,
  `TableHeaderTitle` text,
  `TableHeaderXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `AdministratorXhtmlTableTHeadContent`
--

CREATE TABLE `AdministratorXhtmlTableTHeadContent` (
  `TableName` varchar(250) NOT NULL,
  `ObjectID` int(11) NOT NULL,
  `StopObjectID` int(11) default NULL,
  `ContainerObjectType` enum('Header') default NULL,
  `ContainerObjectTypeName` enum('XhtmlTableTHeadHeader') default NULL,
  `ContainerObjectID` int(11) default NULL,
  `TableHeaderAlign` enum('right','left','center','justify','char') default NULL,
  `TableHeaderChar` varchar(50) default NULL,
  `TableHeaderCharOff` int(11) default NULL,
  `TableHeaderVAlign` enum('top','middle','bottom','baseline') default NULL,
  `TableHeaderClass` text,
  `TableHeaderDir` enum('rtl','ltr') default NULL,
  `TableHeaderID` text,
  `TableHeaderLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableHeaderStyle` text,
  `TableHeaderTitle` text,
  `TableHeaderXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `TableName` (`TableName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableCol` CHANGE `TableColColSpan` `TableColSpan` INT(11) NULL DEFAULT NULL;
ALTER TABLE `AdministratorXhtmlTableCol` CHANGE `TableColColSpan` `TableColSpan` INT(11) NULL DEFAULT NULL;

ALTER TABLE `XhtmlTableColGroupCol` CHANGE `TableColColSpan` `TableColSpan` INT(11) NULL DEFAULT NULL;
ALTER TABLE `AdministratorXhtmlTableColGroupCol` CHANGE `TableColColSpan` `TableColSpan` INT(11) NULL DEFAULT NULL;

