UPDATE `ContentLayer` SET `Enable/Disable` = 'Disable';
-- UPDATE `AdministratorContentLayer` SET `Enable/Disable` = 'Disable';
UPDATE `AdministratorContentLayer` SET `Enable/Disable` = 'Disable' WHERE `Authenticate` = 'true';

ALTER TABLE `XhtmlTableLookup` ADD `XhtmlTableID` INT NOT NULL AFTER `XhtmlTableName`;
ALTER TABLE `AdministratorXhtmlTableLookup` ADD `XhtmlTableID` INT NOT NULL AFTER `XhtmlTableName`;

ALTER TABLE `XhtmlTable` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTable` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableCaption` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableCaption` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableCol` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableCol` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableColGroup` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableColGroup` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableColGroupCol` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableColGroupCol` CHANGE `TableName` `TableID` INT NOT NULL;

DROP TABLE `XhtmlTableLinkedLookup`;
DROP TABLE `AdministratorXhtmlTableLinkedLookup`;

ALTER TABLE `XhtmlTableRow` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableRow` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableRowCell` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableRowCell` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableRowHeader` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableRowHeader` CHANGE `TableName` `TableID` INT NOT NULL;

DROP TABLE `XhtmlTableRowLinkedLookup`;
DROP TABLE `AdministratorXhtmlTableRowLinkedLookup`;

ALTER TABLE `XhtmlTableTBody` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTBody` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableTBodyCell` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTBodyCell` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableTBodyContent` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTBodyContent` CHANGE `TableName` `TableID` INT NOT NULL;

DROP TABLE `XhtmlTableTBodyLinkedLookup`;
DROP TABLE `AdministratorXhtmlTableTBodyLinkedLookup`;

ALTER TABLE `XhtmlTableTFoot` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTFoot` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableTFootCell` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTFootCell` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableTFootContent` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTFootContent` CHANGE `TableName` `TableID` INT NOT NULL;

DROP TABLE `XhtmlTableTFootLinkedLookup`;
DROP TABLE `AdministratorXhtmlTableTFootLinkedLookup`;

ALTER TABLE `XhtmlTableTHead` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTHead` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableTHeadContent` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTHeadContent` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableTHeadHeader` CHANGE `TableName` `TableID` INT NOT NULL;
ALTER TABLE `AdministratorXhtmlTableTHeadHeader` CHANGE `TableName` `TableID` INT NOT NULL;

ALTER TABLE `XhtmlTableLookup`
  DROP `LinkedTable`,
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

ALTER TABLE `AdministratorXhtmlTableLookup`
  DROP `LinkedTable`,
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

ALTER TABLE `XhtmlTableLookup`
  DROP `TableName`;

ALTER TABLE `AdministratorXhtmlTableLookup`
  DROP `TableName`;

--
-- Table structure for table `XhtmlTableListing`
--

CREATE TABLE `XhtmlTableListing` (
  `XhtmlTableName` varchar(250) NOT NULL,
  `XhtmlTableID` int(11) NOT NULL,
  `TableName` varchar(250) NOT NULL,
  `LinkedTable` enum('True','False') NOT NULL default 'False',
  `TableBorder` int(11) default NULL,
  `TableCellPadding` int(11) default NULL,
  `TableCellSpacing` int(11) default NULL,
  `TableFrame` enum('void','above','below','hsides','lhs','rhs','vsides','box','border') default NULL,
  `TablesRules` enum('none','groups','rows','cols','all') default NULL,
  `TableSummary` text,
  `TableWidth` int(11) default NULL,
  `TableClass` text,
  `TableDir` enum('rtl','ltr') default NULL,
  `TableID` text,
  `TableLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableStyle` text,
  `TableTitle` text,
  `TableXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `XhtmlTableName` (`XhtmlTableName`,`XhtmlTableID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `AdministratorXhtmlTableListing`
--

CREATE TABLE `AdministratorXhtmlTableListing` (
  `XhtmlTableName` varchar(250) NOT NULL,
  `XhtmlTableID` int(11) NOT NULL,
  `TableName` varchar(250) NOT NULL,
  `LinkedTable` enum('True','False') NOT NULL default 'False',
  `TableBorder` int(11) default NULL,
  `TableCellPadding` int(11) default NULL,
  `TableCellSpacing` int(11) default NULL,
  `TableFrame` enum('void','above','below','hsides','lhs','rhs','vsides','box','border') default NULL,
  `TablesRules` enum('none','groups','rows','cols','all') default NULL,
  `TableSummary` text,
  `TableWidth` int(11) default NULL,
  `TableClass` text,
  `TableDir` enum('rtl','ltr') default NULL,
  `TableID` text,
  `TableLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `TableStyle` text,
  `TableTitle` text,
  `TableXMLLang` enum('af','sq','eu','be','bg','ca','zh-cn','zh-tw','hr','cs','da','nl','nl-be','nl-nl','en','en-au','en-bz','en-ca','en-ie','en-jm','en-nz','en-ph','en-za','en-tt','en-gb','en-us','en-zq','et','fo','fi','fr','fr-be','fr-ca','fr-fr','fr-lu','fr-mc','fr-ch','gl','gd','de','de-at','de-de','de-li','de-lu','de-ch','el','haw','hu','is','in','ga','it','it-it','it-ch','ja','ko','mk','no','pl','pt-br','pt-pt','ro','ro-mo','ro-ro','ru','ru-mo','ru-ru','sr','sk','sl','es','es-ar','es-bo','es-cl','es-co','es-cr','es-do','es-ec','es-sv','es-gt','es-hn','es-mx','es-ni','es-pa','es-pe','es-pr','es-es','es-ve','sv','sv-fi','sv-se','tr','uk') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `XhtmlTableName` (`XhtmlTableName`,`XhtmlTableID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `XhtmlTableLookup` CHANGE `XhtmlTableID` `TableID` INT(11) NOT NULL;
ALTER TABLE `AdministratorXhtmlTableLookup` CHANGE `XhtmlTableID` `TableID` INT(11) NOT NULL;

UPDATE `ContentLayerTables` SET `DatabaseTable2` = 'XhtmlTableListing' WHERE CONVERT(`ContentLayerTables`.`ObjectType` USING utf8) = 'XhtmlTable' AND CONVERT(`ContentLayerTables`.`ObjectTypeName` USING utf8) = 'table' LIMIT 1;
UPDATE `AdministratorContentLayerTables` SET `DatabaseTable2` = 'XhtmlTableListing' WHERE CONVERT(`AdministratorContentLayerTables`.`ObjectType` USING utf8) = 'XhtmlTable' AND CONVERT(`AdministratorContentLayerTables`.`ObjectTypeName` USING utf8) = 'table' LIMIT 1;
UPDATE `AdministratorContentLayerTables` SET `DatabaseTable2` = 'AdministratorXhtmlTableListing' WHERE CONVERT(`AdministratorContentLayerTables`.`ObjectType` USING utf8) = 'XhtmlTable' AND CONVERT(`AdministratorContentLayerTables`.`ObjectTypeName` USING utf8) = 'admintable' LIMIT 1;

INSERT INTO `AdministratorFormValidation` (`PageID`, `FormFieldName`, `FormFieldAttribute`, `FormFieldMinLength`, `FormFieldMaxLength`, `FormFieldMinValue`, `FormFieldMaxValue`) VALUES ('160', 'RawData', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `AdministratorFormValidation` (`PageID`, `FormFieldName`, `FormFieldAttribute`, `FormFieldMinLength`, `FormFieldMaxLength`, `FormFieldMinValue`, `FormFieldMaxValue`) VALUES ('163', 'RawData', NULL, NULL, NULL, NULL, NULL);

REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 1, NULL, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 2, NULL, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 3, NULL, 'TextArea', 'AdministratorFormTextArea', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 4, NULL, 'Label', 'AdministratorFormLabel', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 5, NULL, 'TextArea', 'AdministratorFormTextArea', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 6, NULL, 'Label', 'AdministratorFormLabel', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 7, NULL, 'TextArea', 'AdministratorFormTextArea', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 8, NULL, 'Label', 'AdministratorFormLabel', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 9, NULL, 'TextArea', 'AdministratorFormTextArea', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 10, NULL, 'Label', 'AdministratorFormLabel', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 11, NULL, 'TextArea', 'AdministratorFormTextArea', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 12, NULL, 'Label', 'AdministratorFormLabel', 6, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 13, NULL, 'TextArea', 'AdministratorFormTextArea', 6, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 14, NULL, 'Label', 'AdministratorFormLabel', 7, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 15, NULL, 'Input', 'AdministratorFormInput', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 16, NULL, 'Label', 'AdministratorFormLabel', 8, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 17, NULL, 'Input', 'AdministratorFormInput', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 18, NULL, 'Label', 'AdministratorFormLabel', 9, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 19, NULL, 'Input', 'AdministratorFormInput', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 20, NULL, 'Label', 'AdministratorFormLabel', 10, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 21, NULL, 'Select', 'AdministratorFormSelect', 9, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 22, NULL, 'Label', 'AdministratorFormLabel', 11, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 23, NULL, 'Select', 'AdministratorFormSelect', 20, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 24, NULL, 'Label', 'AdministratorFormLabel', 12, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 25, NULL, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 26, NULL, 'Label', 'AdministratorFormLabel', 13, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 27, NULL, 'Select', 'AdministratorFormSelect', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 28, NULL, 'Label', 'AdministratorFormLabel', 14, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(160, 29, NULL, 'Captcha', 'AdministratorFormCaptcha', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 1, NULL, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 2, NULL, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 3, NULL, 'TextArea', 'AdministratorFormTextArea', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 4, NULL, 'Label', 'AdministratorFormLabel', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 5, NULL, 'TextArea', 'AdministratorFormTextArea', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 6, NULL, 'Label', 'AdministratorFormLabel', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 7, NULL, 'TextArea', 'AdministratorFormTextArea', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 8, NULL, 'Label', 'AdministratorFormLabel', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 9, NULL, 'TextArea', 'AdministratorFormTextArea', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 10, NULL, 'Label', 'AdministratorFormLabel', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 11, NULL, 'TextArea', 'AdministratorFormTextArea', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 12, NULL, 'Label', 'AdministratorFormLabel', 6, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 13, NULL, 'TextArea', 'AdministratorFormTextArea', 6, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 14, NULL, 'Label', 'AdministratorFormLabel', 7, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 15, NULL, 'Input', 'AdministratorFormInput', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 16, NULL, 'Label', 'AdministratorFormLabel', 8, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 17, NULL, 'Input', 'AdministratorFormInput', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 18, NULL, 'Label', 'AdministratorFormLabel', 9, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 19, NULL, 'Input', 'AdministratorFormInput', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 20, NULL, 'Label', 'AdministratorFormLabel', 10, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 21, NULL, 'Select', 'AdministratorFormSelect', 9, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 22, NULL, 'Label', 'AdministratorFormLabel', 11, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 23, NULL, 'Select', 'AdministratorFormSelect', 20, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 24, NULL, 'Label', 'AdministratorFormLabel', 12, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 25, NULL, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 26, NULL, 'Label', 'AdministratorFormLabel', 13, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 27, NULL, 'Select', 'AdministratorFormSelect', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 28, NULL, 'Label', 'AdministratorFormLabel', 14, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(163, 29, NULL, 'Captcha', 'AdministratorFormCaptcha', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormInput` VALUES(160, 1, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RawData', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'left: -15px;', NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormInput` VALUES(160, 2, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MenuName', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'NULL', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormInput` VALUES(160, 3, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MenuTitle', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'NULL', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormInput` VALUES(163, 1, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RawData', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'left: -15px;', NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormInput` VALUES(163, 2, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MenuName', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'NULL', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormInput` VALUES(163, 3, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MenuTitle', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'NULL', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormLabel` VALUES(160, 1, 'Page Title', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 2, '*Keywords', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 3, '*Description', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 4, 'Header', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 5, '*Heading', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 6, '*Content', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 7, '*Raw Data', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 8, '*Menu Name', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 9, '*Menu Title', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 10, 'Priority', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 11, 'Frequency', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 12, 'Enable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 13, 'Status', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(160, 14, '* = Field Can Be empty. Enter NULL for empty.', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormLabel` VALUES(163, 1, 'Page Title', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 2, '*Keywords', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 3, '*Description', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 4, 'Header', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 5, '*Heading', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 6, '*Content', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 7, '*Raw Data', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 8, '*Menu Name', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 9, '*Menu Title', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 10, 'Priority', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 11, 'Frequency', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 12, 'Enable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 13, 'Status', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(163, 14, '* = Field Can Be empty. Enter NULL for empty.', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

UPDATE `AdministratorForm` SET `FormAction` = 'PageTypes/ContentPage/AddContentPage.php' WHERE `AdministratorForm`.`PageID` = 160 AND `AdministratorForm`.`ObjectID` = 1;
UPDATE `AdministratorForm` SET `FormAction` = 'PageTypes/ContentPage/SelectContentPage.php' WHERE `AdministratorForm`.`PageID` = 162 AND `AdministratorForm`.`ObjectID` = 1;
UPDATE `AdministratorForm` SET `FormAction` = 'PageTypes/ContentPage/UpdateContentPage.php' WHERE `AdministratorForm`.`PageID` = 163 AND `AdministratorForm`.`ObjectID` = 1;
UPDATE `AdministratorForm` SET `FormAction` = 'PageTypes/ContentPage/DeleteContentPage.php' WHERE `AdministratorForm`.`PageID` = 165 AND `AdministratorForm`.`ObjectID` = 1;
UPDATE `AdministratorForm` SET `FormAction` = 'PageTypes/ContentPage/EnableDisableStatusChangeContentPage.php' WHERE `AdministratorForm`.`PageID` = 167 AND `AdministratorForm`.`ObjectID` = 1;

UPDATE `AdministratorContentLayerModulesSettings` SET `SettingAttribute` = '../../index.php?PageID=164' WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'content' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'CreatedUpdateContentPage' LIMIT 1;
UPDATE `AdministratorContentLayerModulesSettings` SET `SettingAttribute` = '../../index.php?PageID=161' WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'content' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'ContentPageCreatedPage' LIMIT 1;
UPDATE `AdministratorContentLayerModulesSettings` SET `SettingAttribute` = '../../index.php?PageID=166' WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'content' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'DeletedContentPage' LIMIT 1;
UPDATE `AdministratorContentLayerModulesSettings` SET `SettingAttribute` = '../../index.php?PageID=168' WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'content' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'EnableDisableContentPage' LIMIT 1;
UPDATE `AdministratorContentLayerModulesSettings` SET `SettingAttribute` = '../../index.php?PageID=163' WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'content' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'UpdateContentPage' LIMIT 1;

--
-- Table structure for table `ContentLayerThemeGlobalLayer`
--

CREATE TABLE `ContentLayerThemeGlobalLayer` (
  `ThemeName` varchar(100) NOT NULL default '0',
  `ObjectID` int(4) NOT NULL default '0',
  `ObjectType` enum('XhtmlContent','XhtmlMenu','XhtmlPicture','XhtmlTable','XhtmlForm','XhtmlUnorderedList','XhtmlFlash','XhtmlNews','XhtmlHeader','FOOTER','BACKGROUND','CONTENT','XhtmlMainMenu') default NULL,
  `ObjectTypeName` enum('admincontent','bottompanel2','toppanel2','picture','table','form','list','flash','news','adminheader','footer','background','contentdummy','headerpanel1','adminmainmenu','adpanel1') NOT NULL default 'admincontent',
  `ContainerObjectID` int(11) default NULL,
  `CurrentVersion` enum('true','false') NOT NULL default 'false',
  `Authenticate` enum('true','false') NOT NULL default 'false',
  `PrintPreview` enum('true','false') NOT NULL default 'true',
  `StartTag` enum('<div>','<p>') default NULL,
  `EndTag` enum('</div>','</p>') default NULL,
  `StartTagID` text,
  `StartTagStyle` text,
  `StartTagClass` text,
  `ImportFileName` text,
  `ImportFileType` enum('xml','html') default NULL,
  `Enable/Disable` enum('Enable','Disable') default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') default 'Pending',
  UNIQUE KEY `PageID` (`ThemeName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ContentLayerThemeGlobalLayer`
--

INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 12, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 16, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 17, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

--
-- Table structure for table `AdministratorContentLayerThemeGlobalLayer`
--

CREATE TABLE `AdministratorContentLayerThemeGlobalLayer` (
  `ThemeName` varchar(100) NOT NULL default '0',
  `ObjectID` int(4) NOT NULL default '0',
  `ObjectType` enum('XhtmlContent','XhtmlMenu','XhtmlPicture','XhtmlTable','XhtmlForm','XhtmlUnorderedList','XhtmlFlash','XhtmlNews','XhtmlHeader','FOOTER','BACKGROUND','CONTENT','XhtmlMainMenu') default NULL,
  `ObjectTypeName` enum('admincontent','bottompanel2','toppanel2','picture','table','form','list','flash','news','adminheader','footer','background','contentdummy','headerpanel1','adminmainmenu','adpanel1') NOT NULL default 'admincontent',
  `ContainerObjectID` int(11) default NULL,
  `CurrentVersion` enum('true','false') NOT NULL default 'false',
  `Authenticate` enum('true','false') NOT NULL default 'false',
  `PrintPreview` enum('true','false') NOT NULL default 'true',
  `StartTag` enum('<div>','<p>') default NULL,
  `EndTag` enum('</div>','</p>') default NULL,
  `StartTagID` text,
  `StartTagStyle` text,
  `StartTagClass` text,
  `ImportFileName` text,
  `ImportFileType` enum('xml','html') default NULL,
  `Enable/Disable` enum('Enable','Disable') default 'Enable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') default 'Pending',
  UNIQUE KEY `PageID` (`ThemeName`,`ObjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AdministratorContentLayerThemeGlobalLayer`
--

INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 0, 'XhtmlHeader', 'adminheader', 0, 'true', 'true', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 1, 'BACKGROUND', 'background', 0, 'true', 'true', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 2, 'CONTENT', 'contentdummy', 0, 'true', 'true', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 3, 'CONTENT', 'contentdummy', 0, 'true', 'true', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 4, 'CONTENT', 'contentdummy', 0, 'true', 'true', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'true', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 6, 'XhtmlMainMenu', 'adminmainmenu', 0, 'true', 'true', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 7, 'XhtmlContent', 'admincontent', 0, 'true', 'true', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 8, 'CONTENT', 'contentdummy', 0, 'true', 'true', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 9, 'FOOTER', 'footer', 0, 'true', 'true', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 10, 'CONTENT', 'contentdummy', 0, 'true', 'true', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
INSERT INTO `AdministratorContentLayerThemeGlobalLayer` VALUES('AdminTheme', 11, 'CONTENT', 'contentdummy', 0, 'true', 'true', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `ContentLayerTheme` VALUES('PullersGreen', 'Tier8-PresentationLayer/PullersGreen/Settings.css', 'Tier8-PresentationLayer/PullersGreen/TextSettings.css', 'Tier8-PresentationLayer/PullersGreen/Menus.css', 'Tier8-PresentationLayer/PullersGreen/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/PullersGreen/SettingsIE6.css', 'Tier8-PresentationLayer/PullersGreen/MenuSettingsIE6.css', NULL, NULL, NULL, 'Tier8-PresentationLayer/PullersGreen/MenuSettingsIE7.css', 'Tier8-PresentationLayer/PullersGreen/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('PullersRetro', 'Tier8-PresentationLayer/PullersRetro/Menus.css', 'Tier8-PresentationLayer/PullersRetro/MenuSettings.css', 'Tier8-PresentationLayer/PullersRetro/Settings.css', 'Tier8-PresentationLayer/PullersRetro/TextSettings.css', 'Tier8-PresentationLayer/PullersRetro/style_sheet.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/PullersRetro/MenuSettingsIE6.css', 'Tier8-PresentationLayer/PullersRetro/style_sheetIE6.css', NULL, NULL, NULL, 'Tier8-PresentationLayer/PullersRetro/MenuSettingsIE7.css', 'Tier8-PresentationLayer/PullersRetro/style_sheetIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('ComputerAidBlue', 'Tier8-PresentationLayer/ComputerAidBlue/Settings.css', 'Tier8-PresentationLayer/ComputerAidBlue/TextSettings.css', 'Tier8-PresentationLayer/ComputerAidBlue/Menus.css', 'Tier8-PresentationLayer/ComputerAidBlue/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/ComputerAidBlue/SettingsIE6.css', 'Tier8-PresentationLayer/ComputerAidBlue/MenuSettingsIE6.css', NULL, NULL, NULL, 'Tier8-PresentationLayer/ComputerAidBlue/MenuSettingsIE7.css', 'Tier8-PresentationLayer/ComputerAidBlue/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('NeoMightBlue', 'Tier8-PresentationLayer/NeoMightBlue/Settings.css', 'Tier8-PresentationLayer/NeoMightBlue/TextSettings.css', 'Tier8-PresentationLayer/NeoMightBlue/Menus.css', 'Tier8-PresentationLayer/NeoMightBlue/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/NeoMightBlue/MenuSettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('CaseyRed', 'Tier8-PresentationLayer/CaseyRed/Settings.css', 'Tier8-PresentationLayer/CaseyRed/TextSettings.css', 'Tier8-PresentationLayer/CaseyRed/Menus.css', 'Tier8-PresentationLayer/CaseyRed/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/CaseyRed/SettingsIE6.css', 'Tier8-PresentationLayer/CaseyRed/MenuSettingsIE6.css', NULL, NULL, NULL, 'Tier8-PresentationLayer/CaseyRed/MenuSettingsIE7.css', 'Tier8-PresentationLayer/CaseyRed/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable');
REPLACE INTO `ContentLayerTheme` VALUES('CountryPane', 'Tier8-PresentationLayer/CountryPane/Settings.css', 'Tier8-PresentationLayer/CountryPane/TextSettings.css', 'Tier8-PresentationLayer/CountryPane/Menus.css', 'Tier8-PresentationLayer/CountryPane/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/CountryPane/SettingsIE6.css', 'Tier8-PresentationLayer/CountryPane/MenuSettingsIE6.css', NULL, NULL, NULL, 'Tier8-PresentationLayer/CountryPane/MenuSettingsIE7.css', 'Tier8-PresentationLayer/CountryPane/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');

DELETE FROM `ContentLayerTheme` WHERE CONVERT(`ContentLayerTheme`.`ThemeName` USING utf8) = 'CaseyBlue' LIMIT 1;

