UPDATE `AdministratorFormInput` SET `FormInputValue` = 'http://images.NEWSITE.com/' WHERE `FormInputValue` = 'http://images.NEWSITE.com/';

UPDATE `AdministratorFormTextArea` SET `FormTextAreaText` = 'NEW SITE META KEY WORDS' WHERE `FormTextAreaText` = 'NEW SITE META KEY WORDS';

UPDATE `AdministratorFormTextArea` SET `FormTextAreaText` = 'NEW SITE META DESCRIPTION' WHERE `FormTextAreaText` = 'NEW SITE META DESCRIPTION';

UPDATE `AdministratorContentLayerModulesSettings` SET `SettingAttribute` = 'http://$SITEADDRESS/Administrators/' WHERE CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectType` USING utf8) = 'ContentLayer' AND CONVERT(`AdministratorContentLayerModulesSettings`.`ObjectTypeName` USING utf8) = 'ContentLayer' AND CONVERT(`AdministratorContentLayerModulesSettings`.`Setting` USING utf8) = 'EmailVerificationLocation' LIMIT 1;
