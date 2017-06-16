INSERT INTO `AdministratorContentLayerModulesSettings` (`ObjectType`, `ObjectTypeName`, `Setting`, `SettingAttribute`) VALUES ('XhtmlTable', 'table', 'LastTablesPage', '0');

REPLACE INTO `AdministratorContent` VALUES(1, 0, 'XhtmlContent', 'admincontent', 1, 'true', 0, 'true', 'false', '<div>', NULL, 'main-content-middle', NULL, NULL, 'Warning', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'Unauthorized access to this system is forbidden and will be prosecuted by law. By accessing this system, you agree that your actions may be monitored if unauthorized usage is suspected.', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(1, 1, 'XhtmlContent', 'admincontent', 2, 'true', 0, 'true', 'false', NULL, NULL, NULL, NULL, NULL, 'User Authentication Page', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'Please enter a valid username and password to gain entry!', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(1, 2, 'XhtmlForm', 'form', 1, 'true', 0, 'true', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(1, 3, 'XhtmlContent', 'admincontent', 4, 'true', 0, 'true', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No account - register it <a href=''index.php?PageID=2''>here</a>\n\nForgot password - reset it <a href=''index.php?PageID=6''>here</a>\n\nAccount locked out - reset password <a href=''index.php?PageID=6''>here</a>', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, 'BodyText', 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(1, 4, 'XhtmlContent', 'admincontent', 5, 'true', 0, 'true', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

ALTER TABLE `AdministratorContent` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorContent` ORDER BY `PageID`;

INSERT INTO `AdministratorContentLayerModulesSettings` (`ObjectType`, `ObjectTypeName`, `Setting`, `SettingAttribute`) VALUES ('XhtmlTable', 'table', 'TablePageCreatedPage', '../../index.php?PageID=211'), ('XhtmlTable', 'table', 'TablePageCreatedUpdatePage', '../../index.php?PageID=214'), ('XhtmlTable', 'table', 'TablePageDeletePage', '../../index.php?PageID=216'), ('XhtmlTable', 'table', 'TablePageDeleteSelectPage', '215'), ('XhtmlTable', 'table', 'TablePageEnableDisablePage', '../../index.php?PageID=218'), ('XhtmlTable', 'table', 'TablePageEnableDisableSelectPage', '217'), ('XhtmlTable', 'table', 'TablePageUpdatePage', '../../index.php?PageID=213'), ('XhtmlTable', 'table', 'TablePageUpdateSelectPage', '212');

UPDATE `AdministratorList` SET `Li12` = '<a href=''index.php?PageID=219''>Table Page</a>' WHERE `AdministratorList`.`PageID` = 11 AND `AdministratorList`.`ObjectID` = 3 LIMIT 1;

REPLACE INTO `AdministratorFormButton` VALUES(213, 1, 'Submit', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'UpdateTablePage', NULL, NULL, NULL, NULL, NULL, NULL, 'submit', '213', NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormInput` VALUES(213, 3, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PageID', 'false', NULL, NULL, NULL, NULL, NULL, 'readonly', NULL, NULL, 'hidden', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

INSERT INTO `AdministratorFormFieldSet` (`PageID`, `ObjectID`, `StopObjectID`, `ContainerObjectType`, `ContainerObjectTypeName`, `ContainerObjectID`, `FormFieldSetTextStartTag`, `FormFieldSetTextEndTag`, `FormFieldSetText`, `FormFieldSetTextDynamic`, `FormFieldSetTextTableName`, `FormFieldSetTextField`, `FormFieldSetTextPageID`, `FormFieldSetTextObjectID`, `FormFieldSetTextRevisionID`, `FormFieldSetClass`, `FormFieldSetDir`, `FormFieldSetID`, `FormFieldSetLang`, `FormFieldSetStyle`, `FormFieldSetTitle`, `FormFieldSetXMLLang`, `Enable/Disable`, `Status`) VALUES ('213', '115', NULL, 'Input', 'AdministratorFormInput', '3', NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

REPLACE INTO `AdministratorFormInput` VALUES(213, 4, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RevisionID', 'false', NULL, NULL, NULL, NULL, NULL, 'readonly', NULL, NULL, 'hidden', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
INSERT INTO `AdministratorFormFieldSet` (`PageID`, `ObjectID`, `StopObjectID`, `ContainerObjectType`, `ContainerObjectTypeName`, `ContainerObjectID`, `FormFieldSetTextStartTag`, `FormFieldSetTextEndTag`, `FormFieldSetText`, `FormFieldSetTextDynamic`, `FormFieldSetTextTableName`, `FormFieldSetTextField`, `FormFieldSetTextPageID`, `FormFieldSetTextObjectID`, `FormFieldSetTextRevisionID`, `FormFieldSetClass`, `FormFieldSetDir`, `FormFieldSetID`, `FormFieldSetLang`, `FormFieldSetStyle`, `FormFieldSetTitle`, `FormFieldSetXMLLang`, `Enable/Disable`, `Status`) VALUES ('213', '116', NULL, 'Input', 'AdministratorFormInput', '4', NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

INSERT INTO `AdministratorFormValidation` (`PageID`, `FormFieldName`, `FormFieldAttribute`, `FormFieldMinLength`, `FormFieldMaxLength`, `FormFieldMinValue`, `FormFieldMaxValue`) VALUES ('213', 'PageID', NULL, NULL, NULL, NULL, NULL), ('213', 'RevisionID', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `AdministratorFormValidation` (`PageID`, `FormFieldName`, `FormFieldAttribute`, `FormFieldMinLength`, `FormFieldMaxLength`, `FormFieldMinValue`, `FormFieldMaxValue`) VALUES ('213', 'FormOptionID', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormInput` VALUES(213, 5, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FormOptionID', 'false', NULL, NULL, NULL, NULL, NULL, 'readonly', NULL, NULL, 'hidden', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

INSERT INTO `AdministratorFormFieldSet` (`PageID`, `ObjectID`, `StopObjectID`, `ContainerObjectType`, `ContainerObjectTypeName`, `ContainerObjectID`, `FormFieldSetTextStartTag`, `FormFieldSetTextEndTag`, `FormFieldSetText`, `FormFieldSetTextDynamic`, `FormFieldSetTextTableName`, `FormFieldSetTextField`, `FormFieldSetTextPageID`, `FormFieldSetTextObjectID`, `FormFieldSetTextRevisionID`, `FormFieldSetClass`, `FormFieldSetDir`, `FormFieldSetID`, `FormFieldSetLang`, `FormFieldSetStyle`, `FormFieldSetTitle`, `FormFieldSetXMLLang`, `Enable/Disable`, `Status`) VALUES ('213', '117', NULL, 'Input', 'AdministratorFormInput', '5', NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
