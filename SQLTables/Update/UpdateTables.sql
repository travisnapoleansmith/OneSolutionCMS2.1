-- ADDITIONS

--
-- Table structure for table `FlashSimpleViewerLookup`
--

CREATE TABLE `FlashSimpleViewerLookup` (
  `PageID` int(11) NOT NULL default '0',
  `ObjectID` int(4) NOT NULL default '0',
  `RevisionID` int(11) NOT NULL,
  `CurrentVersion` enum('true','false') NOT NULL default 'false',
  `SimpleViewerMenuName` varchar(50) default NULL,
  `SimpleViewerTableName` enum('FlashSimpleViewer') default NULL,
  `SimpleViewerPageID` int(11) NOT NULL,
  `SimpleViewerObjectID` int(11) NOT NULL,
  `SimpleViewerRevisionID` int(11) NOT NULL,
  `SimpleViewerCurrentVersion` enum('true','false') NOT NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Disable',
  `Status` enum('Approved','Not-Approved','Spam','Pending') NOT NULL default 'Pending',
  UNIQUE KEY `PageID` (`PageID`,`ObjectID`,`RevisionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Add content for table `AdministratorContentLayerModulesSettings`
--

INSERT INTO `AdministratorContentLayerModulesSettings` (`ObjectType`, `ObjectTypeName`, `Setting`, `SettingAttribute`) VALUES ('XhtmlMainMenu', 'mainmenu', 'CreatedMainMenuUpdatedPage', '22');


-- UPDATES

--
-- Update content for table `AdministratorContentLayerModules`
--

UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/User/Menu' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'Menu' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'menu';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlCalendarDiv' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlCalendarDiv' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'calendardiv';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlCalendarTable' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlCalendarTable' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'calendar';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlContent' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'admincontent';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlContent' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'adpanel1';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlContent' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'content';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlFlash' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlFlash' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'flash';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlForm' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlForm' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'form';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlHeader' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlHeader' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminheader';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlHeader' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlHeader' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'header';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMainMenu' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMainMenu' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminmainmenu';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMainMenu' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMainMenu' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'mainmenu';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMenu' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMenu' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminheaderpanel1';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMenu' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMenu' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'headerpanel1';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlNews' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlNews' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'news';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlNewsStories' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlNewsStories' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'news';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlPicture' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlPicture' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'adpicture1';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlPicture' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlPicture' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'newspicture';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlPicture' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlPicture' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'picture';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlTable' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlTable' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'table';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlUnorderedList' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlUnorderedList' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminlist';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlUnorderedList' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlUnorderedList' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'list';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlUnorderedList' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlUnorderedList' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'menulist';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XmlFeed' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XmlFeed' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'feed';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XmlSitemap' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XmlSitemap' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'sitemap';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'NULL' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'FOOTER' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'footer';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'NULL' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'BACKGROUND' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'background';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'NULL' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'CONTENT' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'contentdummy';
UPDATE `AdministratorContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/User/XhtmlSimpleViewer' WHERE  CONVERT(`AdministratorContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlSimpleViewer' AND CONVERT(`AdministratorContentLayerModules`.`ObjectTypeName` USING utf8) = 'simpleviewer';

--
-- Update content for table `AdministratorList`
--

UPDATE `AdministratorList` SET `Li1` = '<a href=''index.php?PageID=20''>Update Menu</a>' WHERE `AdministratorList`.`PageID` = 11 AND `AdministratorList`.`ObjectID` = 4;


--
-- Update content for table `AuthenticationLayerModules`
--

UPDATE `AuthenticationLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier4AuthenticationLayer/Core/UserAccounts' WHERE  CONVERT(`AuthenticationLayerModules`.`ObjectType` USING utf8) = 'UserAccounts' AND CONVERT(`AuthenticationLayerModules`.`ObjectTypeName` USING utf8) = 'useraccounts';


--
-- Update content for table `ContentLayerModules`
--

UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/User/Menu' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'Menu' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'menu';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlCalendarDiv' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlCalendarDiv' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'calendardiv';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlCalendarTable' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlCalendarTable' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'calendar';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlContent' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'admincontent';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlContent' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'adpanel1';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlContent' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlContent' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'content';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlFlash' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlFlash' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'flash';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlForm' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlForm' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'form';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlHeader' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlHeader' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminheader';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlHeader' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlHeader' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'header';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMainMenu' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMainMenu' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminmainmenu';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMainMenu' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMainMenu' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'mainmenu';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMenu' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMenu' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminheaderpanel1';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlMenu' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlMenu' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'headerpanel1';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlNews' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlNews' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'news';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlNewsStories' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlNewsStories' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'news';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlPicture' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlPicture' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'adpicture1';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlPicture' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlPicture' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'newspicture';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlPicture' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlPicture' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'picture';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlTable' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlTable' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'table';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlUnorderedList' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlUnorderedList' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'adminlist';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlUnorderedList' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlUnorderedList' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'list';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlUnorderedList' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlUnorderedList' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'menulist';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XmlFeed' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XmlFeed' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'feed';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XmlSitemap' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XmlSitemap' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'sitemap';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'NULL' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'FOOTER' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'footer';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'NULL' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'BACKGROUND' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'background';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'NULL' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'CONTENT' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'contentdummy';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/User/XhtmlSimpleViewer' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlSimpleViewer' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'simpleviewer';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Extended/XhtmlAd' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlAd' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'ad';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/Core/XhtmlSiteStats' WHERE  CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlSiteStats' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'sitestats';
UPDATE `ContentLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier6ContentLayer/User/XhtmlFlashJWPlayer' WHERE CONVERT(`ContentLayerModules`.`ObjectType` USING utf8) = 'XhtmlFlashJWPlayer' AND CONVERT(`ContentLayerModules`.`ObjectTypeName` USING utf8) = 'flashjwplayer';

--
-- Update content for table `DataAccessLayerModules`
--

UPDATE `DataAccessLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier3ProtectionLayer/Core/MySqlConnect' WHERE  CONVERT(`DataAccessLayerModules`.`ObjectType` USING utf8) = 'MySqlConnect' AND CONVERT(`DataAccessLayerModules`.`ObjectTypeName` USING utf8) = 'mysqlconnect';


--
-- Update content for table `ProtectionLayerModules`
--

UPDATE `ProtectionLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier3ProtectionLayer/Core/Audit' WHERE  CONVERT(`ProtectionLayerModules`.`ObjectType` USING utf8) = 'Audit' AND CONVERT(`ProtectionLayerModules`.`ObjectTypeName` USING utf8) = 'audit';
UPDATE `ProtectionLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier3ProtectionLayer/Core/Revisions' WHERE  CONVERT(`ProtectionLayerModules`.`ObjectType` USING utf8) = 'Revisions' AND CONVERT(`ProtectionLayerModules`.`ObjectTypeName` USING utf8) = 'revisions';
UPDATE `ProtectionLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier3ProtectionLayer/Core/SpamFilter' WHERE  CONVERT(`ProtectionLayerModules`.`ObjectType` USING utf8) = 'SpamFilter' AND CONVERT(`ProtectionLayerModules`.`ObjectTypeName` USING utf8) = 'spamfilter';
UPDATE `ProtectionLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier3ProtectionLayer/Core/SqlInjection' WHERE  CONVERT(`ProtectionLayerModules`.`ObjectType` USING utf8) = 'SqlInjection' AND CONVERT(`ProtectionLayerModules`.`ObjectTypeName` USING utf8) = 'sqlinjection';
UPDATE `ProtectionLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier3ProtectionLayer/Core/UserPermissions' WHERE  CONVERT(`ProtectionLayerModules`.`ObjectType` USING utf8) = 'UserPermissions' AND CONVERT(`ProtectionLayerModules`.`ObjectTypeName` USING utf8) = 'userpermissions';


--
-- Update content for table `ValidationLayerModules`
--

UPDATE `ValidationLayerModules` SET `ObjectTypeLocation` = 'Modules/Tier5ValidationLayer/Core/FormValidation' WHERE  CONVERT(`ValidationLayerModules`.`ObjectType` USING utf8) = 'FormValidation' AND CONVERT(`ValidationLayerModules`.`ObjectTypeName` USING utf8) = 'formvalidation';


--
-- Update content for table 'AdministratorFormValidation'
--

REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem1', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem10', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem11', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem12', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem13', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem14', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem15', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem2', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem3', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem4', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem5', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem6', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem7', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem8', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItem9', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup1', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup10', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup11', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup12', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup13', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup14', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup15', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup2', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup3', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup4', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup5', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup6', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup7', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup8', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'MenuItemLookup9', 'MenuRepeat', NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'TopMenu', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO AdministratorFormValidation VALUES(21, 'TopMenuHidden', NULL, NULL, NULL, NULL, NULL);
