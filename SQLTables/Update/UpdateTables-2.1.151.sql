ALTER TABLE `SiteStatsTimestampLogCurrent` CHANGE `PageID` `PageID` TEXT NOT NULL;

UPDATE `AdministratorList` SET `Li2` = '<a href=''index.php?PageID=27''>Create Menu Items</a>', `Li3` = '<a href=''index.php?PageID=28''>Update Menu Items</a>' WHERE `AdministratorList`.`PageID` = 11 AND `AdministratorList`.`ObjectID` = 4 LIMIT 1;

REPLACE INTO `AdministratorFormInput` VALUES(29, 4, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MenuItemHidden', 'false', NULL, NULL, NULL, NULL, NULL, 'readonly', NULL, NULL, 'hidden', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

INSERT INTO `AdministratorFormFieldSet` (`PageID`, `ObjectID`, `StopObjectID`, `ContainerObjectType`, `ContainerObjectTypeName`, `ContainerObjectID`, `FormFieldSetTextStartTag`, `FormFieldSetTextEndTag`, `FormFieldSetText`, `FormFieldSetTextDynamic`, `FormFieldSetTextTableName`, `FormFieldSetTextField`, `FormFieldSetTextPageID`, `FormFieldSetTextObjectID`, `FormFieldSetTextRevisionID`, `FormFieldSetClass`, `FormFieldSetDir`, `FormFieldSetID`, `FormFieldSetLang`, `FormFieldSetStyle`, `FormFieldSetTitle`, `FormFieldSetXMLLang`, `Enable/Disable`, `Status`) VALUES ('29', '12', NULL, 'Input', 'AdministratorFormInput', '4', NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

INSERT INTO `AdministratorFormValidation` (`PageID`, `FormFieldName`, `FormFieldAttribute`, `FormFieldMinLength`, `FormFieldMaxLength`, `FormFieldMinValue`, `FormFieldMaxValue`) VALUES ('29', 'MenuItemHidden', 'AlphaNum', NULL, NULL, NULL, NULL);
