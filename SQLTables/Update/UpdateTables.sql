ALTER TABLE `ContentLayerVersion` CHANGE `ContentPageMenuTitle` `ContentPageMenuTitle` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `AdministratorContentLayerTheme` ADD `JavaScriptSheet7` VARCHAR(200) NULL AFTER `JavaScriptSheet6`;

UPDATE `AdministratorContentLayerTheme` SET `JavaScriptSheet7` = '../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandard/dhtmlxGrid/codebase/ext/dhtmlxgrid_drag.js' WHERE CONVERT(`AdministratorContentLayerTheme`.`ThemeName` USING utf8) = 'AdminTheme' LIMIT 1;

ALTER TABLE `AdministratorContentLayerTheme` ADD `JavaScriptSheet8` VARCHAR(200) NULL AFTER `JavaScriptSheet7`, ADD `JavaScriptSheet9` VARCHAR(200) NULL AFTER `JavaScriptSheet8`, ADD `JavaScriptSheet10` VARCHAR(200) NULL AFTER `JavaScriptSheet9`;

ALTER TABLE `AdministratorContentLayerTheme` CHANGE `JavaScriptSheet7` `JavaScriptSheet7` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

ALTER TABLE `ContentLayerTheme` ADD `JavaScriptSheet6` VARCHAR(200) NULL AFTER `JavaScriptSheet5`, ADD `JavaScriptSheet7` VARCHAR(200) NULL AFTER `JavaScriptSheet6`, ADD `JavaScriptSheet8` VARCHAR(200) NULL AFTER `JavaScriptSheet7`, ADD `JavaScriptSheet9` VARCHAR(200) NULL AFTER `JavaScriptSheet8`, ADD `JavaScriptSheet10` VARCHAR(200) NULL AFTER `JavaScriptSheet9`;

