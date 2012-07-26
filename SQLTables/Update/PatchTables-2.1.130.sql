ALTER TABLE `ContentLayerThemeGlobalLayer` CHANGE `ObjectType` `ObjectType` ENUM('XhtmlContent','XhtmlMenu','XhtmlPicture','XhtmlTable','XhtmlForm','XhtmlUnorderedList','XhtmlFlash','XhtmlNews','XhtmlHeader','FOOTER','BACKGROUND','CONTENT','XhtmlMainMenu','XhtmlAd','NOTICE') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `ContentLayerThemeGlobalLayer` CHANGE `ObjectTypeName` `ObjectTypeName` ENUM('content','bottompanel2','toppanel2','picture','table','form','list','flash','news','header','footer','background','contentdummy','headerpanel1','mainmenu','adpanel1','ad','notice') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'content';

REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CaseyRed', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('ComputerAidBlue', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('OneSolutionCMSDefault', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'true', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 12, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 16, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 17, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('CountryPane', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

UPDATE `ContentLayerTables` SET `DatabaseTable1` = 'XhtmlTableLookup' WHERE CONVERT(`ContentLayerTables`.`ObjectType` USING utf8) = 'XhtmlTable' AND CONVERT(`ContentLayerTables`.`ObjectTypeName` USING utf8) = 'table' LIMIT 1;

DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 10 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 11 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 12 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 13 LIMIT 1;

UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '10' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 14 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '11' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 15 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '12' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 16 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '13' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 17 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '14' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 18 LIMIT 1;

DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 9 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 10 LIMIT 1;

UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '9' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 11 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '10' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 12 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '11' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 13 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '12' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'CountryPane' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 14 LIMIT 1;

DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 10 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 11 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 12 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 13 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 14 LIMIT 1;
 
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 9 LIMIT 1;
DELETE FROM `ContentLayerThemeGlobalLayer` WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 15 LIMIT 1;

UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '9' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 16 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '10' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 17 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '11' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 18 LIMIT 1;
UPDATE `ContentLayerThemeGlobalLayer` SET `ObjectID` = '12' WHERE CONVERT(`ContentLayerThemeGlobalLayer`.`ThemeName` USING utf8) = 'ComputerAidBlue' AND `ContentLayerThemeGlobalLayer`.`ObjectID` = 19 LIMIT 1;

DELETE FROM `AdministratorContentLayer` WHERE `Authenticate` = 'true';