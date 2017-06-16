REPLACE INTO `AdministratorForm` VALUES(220, 1, 'AdministratorFormTableListing', 'PageTypes/SimpleViewerPage/AddSimpleViewerGallery.php', NULL, NULL, NULL, 'post', NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorForm` VALUES(222, 1, 'AdministratorFormTableListing', 'PageTypes/SimpleViewerPage/SelectSimpleViewerGallery.php', NULL, NULL, NULL, 'post', NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorForm` VALUES(223, 1, 'AdministratorFormTableListing', 'PageTypes/SimpleViewerPage/UpdateSimpleViewerGallery.php', NULL, NULL, NULL, 'post', NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorForm` VALUES(225, 1, 'AdministratorFormTableListing', 'PageTypes/SimpleViewerPage/DeleteSimpleViewerGallery.php', NULL, NULL, NULL, 'post', NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorForm` VALUES(227, 1, 'AdministratorFormTableListing', 'PageTypes/SimpleViewerPage/EnableDisableStatusChangeSimpleViewerGallery.php', NULL, NULL, NULL, 'post', NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `AdministratorForm` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorForm` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormTableListing` VALUES(220, 1, 'FieldSet', 'AdministratorFormFieldSet', 1, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(220, 2, 'Button', 'AdministratorFormButton', 1, '<div>', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(220, 3, NULL, NULL, NULL, NULL, '</div>', NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(222, 1, 'FieldSet', 'AdministratorFormFieldSet', 1, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(222, 2, 'Button', 'AdministratorFormButton', 1, '<div>', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(222, 3, NULL, NULL, NULL, NULL, '</div>', NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(223, 1, 'FieldSet', 'AdministratorFormFieldSet', 1, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(223, 2, 'Button', 'AdministratorFormButton', 1, '<div>', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(223, 3, NULL, NULL, NULL, NULL, '</div>', NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(225, 1, 'FieldSet', 'AdministratorFormFieldSet', 1, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(225, 2, 'Button', 'AdministratorFormButton', 1, '<div>', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(225, 3, NULL, NULL, NULL, NULL, '</div>', NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(227, 1, 'FieldSet', 'AdministratorFormFieldSet', 1, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(227, 2, 'Button', 'AdministratorFormButton', 1, '<div>', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTableListing` VALUES(227, 3, NULL, NULL, NULL, NULL, '</div>', NULL, 'Enable', 'Approved');

ALTER TABLE `AdministratorFormTableListing` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormTableListing` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormButton` VALUES(220, 1, 'Submit', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'AddSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL, NULL, 'submit', '220', NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(220, 2, 'Add Image 1', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'AddImage1', NULL, NULL, NULL, NULL, NULL, NULL, 'button', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm ShortFormButton', 'ltr', 'AddImage1', 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(220, 3, 'Remove Image 1', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'RemoveImage1', NULL, NULL, NULL, NULL, NULL, NULL, 'button', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm ShortFormButton', 'ltr', 'RemoveImage1', 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(220, 4, 'Import', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'Import', NULL, NULL, NULL, NULL, NULL, NULL, 'button', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm ShortFormButton', 'ltr', 'Import', 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(222, 1, 'Submit', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'UpdateSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL, NULL, 'submit', '222', NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(223, 1, 'Submit', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'UpdateSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL, NULL, 'submit', '223', NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(223, 2, 'Add Image 1', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'AddImage1', NULL, NULL, NULL, NULL, NULL, NULL, 'button', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm ShortFormButton', 'ltr', 'AddImage1', 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(223, 3, 'Remove Image 1', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'RemoveImage1', NULL, NULL, NULL, NULL, NULL, NULL, 'button', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm ShortFormButton', 'ltr', 'RemoveImage1', 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(223, 4, 'Import', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'Import', NULL, NULL, NULL, NULL, NULL, NULL, 'button', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm ShortFormButton', 'ltr', 'Import', 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(225, 1, 'Submit', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'DeleteSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL, NULL, 'submit', '225', NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormButton` VALUES(227, 1, 'Submit', 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'EnableDisableSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL, NULL, 'submit', '227', NULL, NULL, NULL, NULL, NULL, NULL, 'BodyTextButton ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

ALTER TABLE `AdministratorFormButton` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormButton` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 1, 99, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 2, 99, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 3, 99, 'TextArea', 'AdministratorFormTextArea', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 4, 99, 'Label', 'AdministratorFormLabel', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 5, 99, 'TextArea', 'AdministratorFormTextArea', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 6, 99, 'Label', 'AdministratorFormLabel', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 7, 99, 'TextArea', 'AdministratorFormTextArea', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 8, 99, 'Label', 'AdministratorFormLabel', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 9, 99, 'TextArea', 'AdministratorFormTextArea', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 10, 99, 'Label', 'AdministratorFormLabel', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 11, 99, 'TextArea', 'AdministratorFormTextArea', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 12, 99, 'Button', 'AdministratorFormButton', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 13, 99, 'Button', 'AdministratorFormButton', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 14, 99, 'Button', 'AdministratorFormButton', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 15, 99, NULL, NULL, NULL, '<div>', '</div>', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Vault', NULL, 'position: relative; left:120px; width: 550px;', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 16, 99, 'Label', 'AdministratorFormLabel', 6, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 17, 99, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 18, 99, 'Label', 'AdministratorFormLabel', 7, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 19, 99, 'Select', 'AdministratorFormSelect', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 20, 99, 'Label', 'AdministratorFormLabel', 8, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 21, 99, 'Captcha', 'AdministratorFormCaptcha', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(220, 99, 99, NULL, NULL, NULL, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(222, 1, NULL, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(222, 2, NULL, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(222, 3, NULL, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 1, 99, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 2, 99, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 3, 99, 'TextArea', 'AdministratorFormTextArea', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 4, 99, 'Label', 'AdministratorFormLabel', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 5, 99, 'TextArea', 'AdministratorFormTextArea', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 6, 99, 'Label', 'AdministratorFormLabel', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 7, 99, 'TextArea', 'AdministratorFormTextArea', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 8, 99, 'Label', 'AdministratorFormLabel', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 9, 99, 'TextArea', 'AdministratorFormTextArea', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 10, 99, 'Label', 'AdministratorFormLabel', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 11, 99, 'TextArea', 'AdministratorFormTextArea', 5, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 12, 99, 'Button', 'AdministratorFormButton', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 13, 99, 'Button', 'AdministratorFormButton', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 14, 99, 'Button', 'AdministratorFormButton', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 15, 99, NULL, NULL, NULL, '<div>', '</div>', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Vault', NULL, 'position: relative; left:120px; width: 550px;', NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 16, 99, 'Label', 'AdministratorFormLabel', 6, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 17, 99, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 18, 99, 'Label', 'AdministratorFormLabel', 7, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 19, 99, 'Select', 'AdministratorFormSelect', 4, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 20, 99, 'Label', 'AdministratorFormLabel', 8, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 21, 99, 'Captcha', 'AdministratorFormCaptcha', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 22, 99, 'Input', 'AdministratorFormInput', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(223, 99, 99, NULL, NULL, NULL, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(225, 1, NULL, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(225, 2, NULL, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(225, 3, NULL, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 1, NULL, 'Legend', 'AdministratorFormLegend', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 2, NULL, 'Label', 'AdministratorFormLabel', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 3, NULL, 'Select', 'AdministratorFormSelect', 1, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 4, NULL, 'Label', 'AdministratorFormLabel', 2, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 5, NULL, 'Select', 'AdministratorFormSelect', 1000000, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 6, NULL, 'Label', 'AdministratorFormLabel', 3, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormFieldSet` VALUES(227, 7, NULL, 'Select', 'AdministratorFormSelect', 1000003, NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `AdministratorFormFieldSet` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormFieldSet` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormLabel` VALUES(220, 1, 'Gallery Name', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 2, 'Gallery Heading', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 3, 'Image Location', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 4, 'Thumb Location', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 5, 'Link Location', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 6, 'Enabled', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 7, 'Status', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(220, 8, '* = Field Can Be empty. Enter NULL for empty.', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(222, 1, 'Gallery Name', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 2, 'Gallery Heading', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 3, 'Image Location', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 4, 'Thumb Location', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 5, 'Link Location', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 6, 'Enabled', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 7, 'Status', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(223, 8, '* = Field Can Be empty. Enter NULL for empty.', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(225, 1, 'Gallery Name', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(227, 1, 'Gallery Name', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(227, 2, 'Enable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormLabel` VALUES(227, 3, 'Status', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BodyText ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `AdministratorFormLabel` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormLabel` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormTextArea` VALUES(220, 1, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'GalleryName', NULL, NULL, 'ShortForm', 'ltr', 'GalleryName', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(220, 2, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'GalleryHeading', NULL, NULL, 'ShortForm', 'ltr', 'GalleryHeading', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(220, 3, '../../../../UserData/Images/SimpleViewer/images/', 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'ImageLocation', NULL, NULL, 'ShortForm', 'ltr', 'ImageLocation', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(220, 4, '../../../../UserData/Images/SimpleViewer/thumbs/', 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'ThumbLocation', NULL, NULL, 'ShortForm', 'ltr', 'ThumbLocation', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(220, 5, '../../../../UserData/Images/SimpleViewer/images/', 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'LinkLocation', NULL, NULL, 'ShortForm', 'ltr', 'LinkLocation', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(223, 1, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'GalleryName', NULL, NULL, 'ShortForm', 'ltr', 'GalleryName', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(223, 2, NULL, 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'GalleryHeading', NULL, NULL, 'ShortForm', 'ltr', 'GalleryHeading', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(223, 3, '../../../../UserData/Images/SimpleViewer/images/', 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'ImageLocation', NULL, NULL, 'ShortForm', 'ltr', 'ImageLocation', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(223, 4, '../../../../UserData/Images/SimpleViewer/thumbs/', 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'ThumbLocation', NULL, NULL, 'ShortForm', 'ltr', 'ThumbLocation', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormTextArea` VALUES(223, 5, '../../../../UserData/Images/SimpleViewer/images', 'false', NULL, NULL, NULL, NULL, NULL, 30, 4, NULL, 'LinkLocation', NULL, NULL, 'ShortForm', 'ltr', 'LinkLocation', 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `AdministratorFormTextArea` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormTextArea` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormOption` VALUES(220, 1, 'Enable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(220, 2, 'Disable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(220, 3, 'Approved', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(220, 4, 'Not-Approved', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(220, 5, 'Spam', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(220, 6, 'Pending', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(223, 1, 'Enable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(223, 2, 'Disable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(223, 3, 'Approved', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(223, 4, 'Not-Approved', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(223, 5, 'Spam', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(223, 6, 'Pending', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(227, 1000000, 'Enable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(227, 1000001, 'Disable', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(227, 1000003, 'Approved', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(227, 1000004, 'Not-Approved', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(227, 1000005, 'Spam', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormOption` VALUES(227, 1000006, 'Pending', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `AdministratorFormOption` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormOption` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormSelect` VALUES(220, 1, 3, NULL, 'Option', 'AdministratorFormOption', 1, NULL, NULL, 'EnableDisable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 2, 3, NULL, 'Option', 'AdministratorFormOption', 2, NULL, NULL, 'EnableDisable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 4, 8, NULL, 'Option', 'AdministratorFormOption', 3, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 5, 8, NULL, 'Option', 'AdministratorFormOption', 4, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 6, 8, NULL, 'Option', 'AdministratorFormOption', 5, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 7, 8, NULL, 'Option', 'AdministratorFormOption', 6, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(220, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(222, 999999, 999999, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 1, 3, NULL, 'Option', 'AdministratorFormOption', 1, NULL, NULL, 'EnableDisable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 2, 3, NULL, 'Option', 'AdministratorFormOption', 2, NULL, NULL, 'EnableDisable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 4, 8, NULL, 'Option', 'AdministratorFormOption', 3, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 5, 8, NULL, 'Option', 'AdministratorFormOption', 4, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 6, 8, NULL, 'Option', 'AdministratorFormOption', 5, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 7, 8, NULL, 'Option', 'AdministratorFormOption', 6, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(223, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(225, 999999, 999999, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 999999, 999999, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000000, 1000002, NULL, 'Option', 'AdministratorFormOption', 1000000, NULL, NULL, 'EnableDisable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000001, 1000002, NULL, 'Option', 'AdministratorFormOption', 1000001, NULL, NULL, 'EnableDisable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000002, 1000002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000003, 1000007, NULL, 'Option', 'AdministratorFormOption', 1000003, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000004, 1000007, NULL, 'Option', 'AdministratorFormOption', 1000004, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000005, 1000007, NULL, 'Option', 'AdministratorFormOption', 1000005, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000006, 1000007, NULL, 'Option', 'AdministratorFormOption', 1000006, NULL, NULL, 'Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', 'width: 550px;', NULL, NULL, 'en-us', 'Enable', 'Approved');
REPLACE INTO `AdministratorFormSelect` VALUES(227, 1000007, 1000007, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'width: 550px;', NULL, NULL, NULL, 'Enable', 'Approved');

ALTER TABLE `AdministratorFormSelect` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormSelect` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormInput` VALUES(223, 1, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GalleryID', 'false', NULL, NULL, NULL, NULL, NULL, 'readonly', NULL, NULL, 'hidden', NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, 'ShortForm', 'ltr', NULL, 'en-us', NULL, NULL, 'en-us', 'Enable', 'Approved');

ALTER TABLE `AdministratorFormInput` ORDER BY `ObjectID`;
ALTER TABLE `AdministratorFormInput` ORDER BY `PageID`;

REPLACE INTO `AdministratorFormValidation` VALUES(220, 'AddSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'CAPTCHA', 'Captcha', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'EnableDisable', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'GalleryHeading', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'GalleryName', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'ImageLocation', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'LinkLocation', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'Status', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(220, 'ThumbLocation', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'CAPTCHA', 'Captcha', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'EnableDisable', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'GalleryHeading', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'GalleryID', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'GalleryName', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'ImageLocation', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'LinkLocation', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'Status', NULL, NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'ThumbLocation', 'AlphaNum', NULL, NULL, NULL, NULL);
REPLACE INTO `AdministratorFormValidation` VALUES(223, 'UpdateSimpleViewerGallery', NULL, NULL, NULL, NULL, NULL);

ALTER TABLE `AdministratorFormValidation` ORDER BY `PageID`;

UPDATE `AdministratorFormValidation` SET `FormFieldName` = 'UpdateTableContent' WHERE `AdministratorFormValidation`.`PageID` = 203 AND CONVERT(`AdministratorFormValidation`.`FormFieldName` USING utf8) = 'AddTableContent' LIMIT 1;

REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 0, 'XhtmlHeader', 'header', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 1, 'BACKGROUND', 'background', 0, 'true', 'false', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 2, 'NOTICE', 'notice', 0, 'true', 'false', 'false', '<div>', NULL, 'content', NULL, NULL, NULL, 'xml', 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 3, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'container-box', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 4, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', '<div>', NULL, 'content-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 5, 'XhtmlMenu', 'headerpanel1', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 6, 'XhtmlMainMenu', 'mainmenu', 0, 'true', 'false', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 7, 'XhtmlContent', 'content', 0, 'true', 'false', 'true', '<div>', '</div>', 'main-content', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 8, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 9, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'false', '<div>', NULL, 'ad-side', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 10, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'false', '<div>', NULL, 'side-ad', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 11, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'false', '<div>', '</div>', 'side-ad-top', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 12, 'XhtmlAd', 'ad', 0, 'true', 'false', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 13, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'false', '<div>', '</div>', 'side-ad-bottom', NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 14, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 15, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 16, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 17, 'FOOTER', 'footer', 0, 'true', 'false', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 18, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `ContentLayerThemeGlobalLayer` VALUES('PullersGreen', 19, 'CONTENT', 'contentdummy', 0, 'true', 'false', 'true', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `AdministratorContent` VALUES(220, 0, 'XhtmlContent', 'admincontent', 1, 'true', 0, 'true', 'false', '<div>', NULL, 'main-content-middle', NULL, NULL, 'Add SimpleViewer Gallery', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'Please complete the form below to add a SimpleViewer gallery!', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(220, 1, 'XhtmlForm', 'form', 1, 'true', 0, 'true', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(220, 2, 'XhtmlContent', 'admincontent', 3, 'true', 0, 'true', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<script src="../Administrators/PageTypes/SimpleViewerPage/SimpleViewerContentBehavior.js" >\r\n</script>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `AdministratorContent` VALUES(223, 0, 'XhtmlContent', 'admincontent', 1, 'true', 0, 'true', 'false', '<div>', NULL, 'main-content-middle', NULL, NULL, 'Update SimpleViewer Gallery', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'Please complete the form below to update a SimpleViewer gallery!', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(223, 1, 'XhtmlForm', 'form', 1, 'true', 0, 'true', 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(223, 2, 'XhtmlContent', 'admincontent', 3, 'true', 0, 'true', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<script src="../Administrators/PageTypes/SimpleViewerPage/SimpleViewerContentBehavior.js" >\r\n</script>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'LastGallery', '0');

DROP TABLE IF EXISTS `ContentLayerTheme`;
CREATE TABLE `ContentLayerTheme` (
  `ThemeName` varchar(100) NOT NULL,
  `ThemeLocation` varchar(150) NOT NULL,
  `StyleSheet1` varchar(100) default NULL,
  `StyleSheet2` varchar(100) default NULL,
  `StyleSheet3` varchar(100) default NULL,
  `StyleSheet4` varchar(100) default NULL,
  `StyleSheet5` varchar(100) default NULL,
  `StyleSheet6` varchar(100) default NULL,
  `StyleSheet7` varchar(100) default NULL,
  `StyleSheet8` varchar(100) default NULL,
  `StyleSheet9` varchar(100) default NULL,
  `StyleSheet10` varchar(100) default NULL,
  `StyleSheet11` varchar(100) default NULL,
  `StyleSheet12` varchar(100) default NULL,
  `StyleSheet13` varchar(100) default NULL,
  `StyleSheet14` varchar(100) default NULL,
  `StyleSheet15` varchar(100) default NULL,
  `StyleSheet16` varchar(100) default NULL,
  `StyleSheet17` varchar(100) default NULL,
  `StyleSheet18` varchar(100) default NULL,
  `StyleSheet19` varchar(100) default NULL,
  `StyleSheet20` varchar(100) default NULL,
  `IE6StyleSheet1` varchar(100) default NULL,
  `IE6StyleSheet2` varchar(100) default NULL,
  `IE6StyleSheet3` varchar(100) default NULL,
  `IE6StyleSheet4` varchar(100) default NULL,
  `IE6StyleSheet5` varchar(100) default NULL,
  `IE7StyleSheet1` varchar(100) default NULL,
  `IE7StyleSheet2` varchar(100) default NULL,
  `IE7StyleSheet3` varchar(100) default NULL,
  `IE7StyleSheet4` varchar(100) default NULL,
  `IE7StyleSheet5` varchar(100) default NULL,
  `IE8StyleSheet1` varchar(100) default NULL,
  `IE8StyleSheet2` varchar(100) default NULL,
  `IE8StyleSheet3` varchar(100) default NULL,
  `IE8StyleSheet4` varchar(100) default NULL,
  `IE8StyleSheet5` varchar(100) default NULL,
  `IE9StyleSheet1` varchar(100) default NULL,
  `IE9StyleSheet2` varchar(100) default NULL,
  `IE9StyleSheet3` varchar(100) default NULL,
  `IE9StyleSheet4` varchar(100) default NULL,
  `IE9StyleSheet5` varchar(100) default NULL,
  `BlackBerryOS5StyleSheet1` varchar(100) default NULL,
  `BlackBerryOS5StyleSheet2` varchar(100) default NULL,
  `BlackBerryOS5StyleSheet3` varchar(100) default NULL,
  `BlackBerryOS5StyleSheet4` varchar(100) default NULL,
  `BlackBerryOS5StyleSheet5` varchar(100) default NULL,
  `BlackBerryOS6StyleSheet1` varchar(100) default NULL,
  `BlackBerryOS6StyleSheet2` varchar(100) default NULL,
  `BlackBerryOS6StyleSheet3` varchar(100) default NULL,
  `BlackBerryOS6StyleSheet4` varchar(100) default NULL,
  `BlackBerryOS6StyleSheet5` varchar(100) default NULL,
  `BlackBerryPlaybookStyleSheet1` varchar(100) default NULL,
  `BlackBerryPlaybookStyleSheet2` varchar(100) default NULL,
  `BlackBerryPlaybookStyleSheet3` varchar(100) default NULL,
  `BlackBerryPlaybookStyleSheet4` varchar(100) default NULL,
  `BlackBerryPlaybookStyleSheet5` varchar(100) default NULL,
  `AppleiPhoneStyleSheet1` varchar(100) default NULL,
  `AppleiPhoneStyleSheet2` varchar(100) default NULL,
  `AppleiPhoneStyleSheet3` varchar(100) default NULL,
  `AppleiPhoneStyleSheet4` varchar(100) default NULL,
  `AppleiPhoneStyleSheet5` varchar(100) default NULL,
  `AppleiPadStyleSheet1` varchar(100) default NULL,
  `AppleiPadStyleSheet2` varchar(100) default NULL,
  `AppleiPadStyleSheet3` varchar(100) default NULL,
  `AppleiPadStyleSheet4` varchar(100) default NULL,
  `AppleiPadStyleSheet5` varchar(100) default NULL,
  `AppleiPodStyleSheet1` varchar(100) default NULL,
  `AppleiPodStyleSheet2` varchar(100) default NULL,
  `AppleiPodStyleSheet3` varchar(100) default NULL,
  `AppleiPodStyleSheet4` varchar(100) default NULL,
  `AppleiPodStyleSheet5` varchar(100) default NULL,
  `AndroidStyleSheet1` varchar(100) default NULL,
  `AndroidStyleSheet2` varchar(100) default NULL,
  `AndroidStyleSheet3` varchar(100) default NULL,
  `AndroidStyleSheet4` varchar(100) default NULL,
  `AndroidStyleSheet5` varchar(100) default NULL,
  `JavaScriptSheet1` varchar(100) default NULL,
  `JavaScriptSheet2` varchar(100) default NULL,
  `JavaScriptSheet3` varchar(100) default NULL,
  `JavaScriptSheet4` varchar(100) default NULL,
  `JavaScriptSheet5` varchar(100) default NULL,
  `JavaScriptSheet6` varchar(200) default NULL,
  `JavaScriptSheet7` varchar(200) default NULL,
  `JavaScriptSheet8` varchar(200) default NULL,
  `JavaScriptSheet9` varchar(200) default NULL,
  `JavaScriptSheet10` varchar(200) default NULL,
  `PrintPreviewStyleSheet1` varchar(100) default NULL,
  `PrintPreviewStyleSheet2` varchar(100) default NULL,
  `PrintPreviewStyleSheet3` varchar(100) default NULL,
  `PrintPreviewStyleSheet4` varchar(100) default NULL,
  `PrintPreviewStyleSheet5` varchar(100) default NULL,
  `ScriptStyleSheet1` varchar(100) default NULL,
  `ScriptStyleSheet2` varchar(100) default NULL,
  `ScriptStyleSheet3` varchar(100) default NULL,
  `ScriptStyleSheet4` varchar(100) default NULL,
  `ScriptStyleSheet5` varchar(100) default NULL,
  `ScriptStyleSheetCharset1` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptStyleSheetCharset2` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptStyleSheetCharset3` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptStyleSheetCharset4` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptStyleSheetCharset5` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptStyleSheetCode1` text,
  `ScriptStyleSheetCode2` text,
  `ScriptStyleSheetCode3` text,
  `ScriptStyleSheetCode4` text,
  `ScriptStyleSheetCode5` text,
  `ScriptStyleSheetDefer1` enum('defer') default NULL,
  `ScriptStyleSheetDefer2` enum('defer') default NULL,
  `ScriptStyleSheetDefer3` enum('defer') default NULL,
  `ScriptStyleSheetDefer4` enum('defer') default NULL,
  `ScriptStyleSheetDefer5` enum('defer') default NULL,
  `ScriptJavaScriptSheet1` varchar(100) default NULL,
  `ScriptJavaScriptSheet2` varchar(100) default NULL,
  `ScriptJavaScriptSheet3` varchar(100) default NULL,
  `ScriptJavaScriptSheet4` varchar(100) default NULL,
  `ScriptJavaScriptSheet5` varchar(100) default NULL,
  `ScriptJavaScriptSheetCharset1` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptJavaScriptSheetCharset2` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptJavaScriptSheetCharset3` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptJavaScriptSheetCharset4` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptJavaScriptSheetCharset5` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptJavaScriptSheetCode1` text,
  `ScriptJavaScriptSheetCode2` text,
  `ScriptJavaScriptSheetCode3` text,
  `ScriptJavaScriptSheetCode4` text,
  `ScriptJavaScriptSheetCode5` text,
  `ScriptJavaScriptSheetDefer1` enum('defer') default NULL,
  `ScriptJavaScriptSheetDefer2` enum('defer') default NULL,
  `ScriptJavaScriptSheetDefer3` enum('defer') default NULL,
  `ScriptJavaScriptSheetDefer4` enum('defer') default NULL,
  `ScriptJavaScriptSheetDefer5` enum('defer') default NULL,
  `ScriptVBScriptSheet1` varchar(100) default NULL,
  `ScriptVBScriptSheet2` varchar(100) default NULL,
  `ScriptVBScriptSheet3` varchar(100) default NULL,
  `ScriptVBScriptSheet4` varchar(100) default NULL,
  `ScriptVBScriptSheet5` varchar(100) default NULL,
  `ScriptVBScriptSheetCharset1` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptVBScriptSheetCharset2` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptVBScriptSheetCharset3` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptVBScriptSheetCharset4` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptVBScriptSheetCharset5` enum('ISO-8859-1','ISO-8859-2','ISO-8859-3','ISO-8859-4','ISO-8859-5','ISO-8859-6','ISO-8859-7','ISO-8859-8','ISO-8859-9','ISO-8859-10','ISO-8859-15','ISO-2022-JP','ISO-2022-JP-2','ISO-2022-KR','UTF-8','UTF-16') default NULL,
  `ScriptVBScriptSheetCode1` text,
  `ScriptVBScriptSheetCode2` text,
  `ScriptVBScriptSheetCode3` text,
  `ScriptVBScriptSheetCode4` text,
  `ScriptVBScriptSheetCode5` text,
  `ScriptVBScriptSheetDefer1` enum('defer') default NULL,
  `ScriptVBScriptSheetDefer2` enum('defer') default NULL,
  `ScriptVBScriptSheetDefer3` enum('defer') default NULL,
  `ScriptVBScriptSheetDefer4` enum('defer') default NULL,
  `ScriptVBScriptSheetDefer5` enum('defer') default NULL,
  `Enable/Disable` enum('Enable','Disable') NOT NULL default 'Disable',
  UNIQUE KEY `ThemeName` (`ThemeName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ContentLayerTheme`
--

REPLACE INTO `ContentLayerTheme` VALUES('CaseyRed', 'UserData/', 'UserData/Tier8-PresentationLayer/CaseyRed/Settings.css', 'UserData/Tier8-PresentationLayer/CaseyRed/TextSettings.css', 'UserData/Tier8-PresentationLayer/CaseyRed/Menus.css', 'UserData/Tier8-PresentationLayer/CaseyRed/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/CaseyRed/SettingsIE6.css', 'UserData/Tier8-PresentationLayer/CaseyRed/MenuSettingsIE6.css', NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/CaseyRed/MenuSettingsIE7.css', 'UserData/Tier8-PresentationLayer/CaseyRed/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('PullersGreen', 'UserData/', 'UserData/Tier8-PresentationLayer/PullersGreen/Settings.css', 'UserData/Tier8-PresentationLayer/PullersGreen/TextSettings.css', 'UserData/Tier8-PresentationLayer/PullersGreen/Menus.css', 'UserData/Tier8-PresentationLayer/PullersGreen/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/PullersGreen/SettingsIE6.css', 'UserData/Tier8-PresentationLayer/PullersGreen/MenuSettingsIE6.css', NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/PullersGreen/MenuSettingsIE7.css', 'UserData/Tier8-PresentationLayer/PullersGreen/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('ComputerAidBlue', 'UserData/', 'UserData/Tier8-PresentationLayer/ComputerAidBlue/Settings.css', 'UserData/Tier8-PresentationLayer/ComputerAidBlue/TextSettings.css', 'UserData/Tier8-PresentationLayer/ComputerAidBlue/Menus.css', 'UserData/Tier8-PresentationLayer/ComputerAidBlue/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/ComputerAidBlue/SettingsIE6.css', 'UserData/Tier8-PresentationLayer/ComputerAidBlue/MenuSettingsIE6.css', NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/ComputerAidBlue/MenuSettingsIE7.css', 'UserData/Tier8-PresentationLayer/ComputerAidBlue/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('CountryPane', 'UserData/', 'UserData/Tier8-PresentationLayer/CountryPane/Settings.css', 'UserData/Tier8-PresentationLayer/CountryPane/TextSettings.css', 'UserData/Tier8-PresentationLayer/CountryPane/Menus.css', 'UserData/Tier8-PresentationLayer/CountryPane/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/CountryPane/SettingsIE6.css', 'UserData/Tier8-PresentationLayer/CountryPane/MenuSettingsIE6.css', NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/CountryPane/MenuSettingsIE7.css', 'UserData/Tier8-PresentationLayer/CountryPane/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('OneSolutionCMSDefault', '', 'Tier8-PresentationLayer/OneSolutionCMSDefault/Settings.css', 'Tier8-PresentationLayer/OneSolutionCMSDefault/TextSettings.css', 'Tier8-PresentationLayer/OneSolutionCMSDefault/Menus.css', 'Tier8-PresentationLayer/OneSolutionCMSDefault/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tier8-PresentationLayer/OneSolutionCMSDefault/SettingsIE6.css', 'Tier8-PresentationLayer/OneSolutionCMSDefault/MenuSettingsIE6.css', NULL, NULL, NULL, 'Tier8-PresentationLayer/OneSolutionCMSDefault/MenuSettingsIE7.css', 'Tier8-PresentationLayer/OneSolutionCMSDefault/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');
REPLACE INTO `ContentLayerTheme` VALUES('ForestGreen', 'UserData/', 'UserData/Tier8-PresentationLayer/ForestGreen/Settings.css', 'UserData/Tier8-PresentationLayer/ForestGreen/TextSettings.css', 'UserData/Tier8-PresentationLayer/ForestGreen/Menus.css', 'UserData/Tier8-PresentationLayer/ForestGreen/MenuSettings.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/ForestGreen/SettingsIE6.css', 'UserData/Tier8-PresentationLayer/ForestGreen/MenuSettingsIE6.css', NULL, NULL, NULL, 'UserData/Tier8-PresentationLayer/ForestGreen/MenuSettingsIE7.css', 'UserData/Tier8-PresentationLayer/ForestGreen/SettingsIE7.css', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Disable');

ALTER TABLE `AdministratorContentLayerTheme` ADD `ThemeLocation` VARCHAR(150) NOT NULL AFTER `ThemeName`;

UPDATE `AdministratorContentLayerTheme` SET `JavaScriptSheet9` = '../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandard/codebase/excells/dhtmlxgrid_excell_cntr.js' WHERE CONVERT(`AdministratorContentLayerTheme`.`ThemeName` USING utf8) = 'AdminTheme' LIMIT 1;

REPLACE INTO `XhtmlTable` VALUES(0, 1, NULL, 'Caption', 'XhtmlTableCaption', 1, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 2, NULL, 'THead', 'XhtmlTableTHead', 1, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 3, NULL, 'TableRow', 'XhtmlTableRow', 1, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 4, NULL, 'TableRow', 'XhtmlTableRow', 100, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 5, NULL, 'TableRow', 'XhtmlTableRow', 200, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 6, NULL, 'TableRow', 'XhtmlTableRow', 300, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 7, NULL, 'TableRow', 'XhtmlTableRow', 400, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 8, NULL, 'TableRow', 'XhtmlTableRow', 500, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 9, NULL, 'TableRow', 'XhtmlTableRow', 600, 'Enable', 'Approved');
REPLACE INTO `XhtmlTable` VALUES(0, 10, NULL, 'TFoot', 'XhtmlTableTFoot', 1, 'Enable', 'Approved');

INSERT INTO `XhtmlTableTHeadContent` (`TableID`, `ObjectID`, `StopObjectID`, `ContainerObjectType`, `ContainerObjectTypeName`, `ContainerObjectID`, `TableHeaderAlign`, `TableHeaderChar`, `TableHeaderCharOff`, `TableHeaderVAlign`, `TableHeaderClass`, `TableHeaderDir`, `TableHeaderID`, `TableHeaderLang`, `TableHeaderStyle`, `TableHeaderTitle`, `TableHeaderXMLLang`, `Enable/Disable`, `Status`) VALUES ('0', '6', NULL, 'Header', 'XhtmlTableTHeadHeader', '6', 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `XhtmlTableTHeadHeader` VALUES(0, 1, '', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableTHeadHeader` VALUES(0, 2, 'Column 1', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableTHeadHeader` VALUES(0, 3, 'Column 2', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableTHeadHeader` VALUES(0, 4, 'Column 3', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableTHeadHeader` VALUES(0, 5, 'Column 4', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableTHeadHeader` VALUES(0, 6, 'Column 5', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

INSERT INTO `XhtmlTableTFootCell` (`TableID`, `ObjectID`, `TableCellText`, `TableCellAbbr`, `TableCellAlign`, `TableCellAxis`, `TableCellChar`, `TableCellCharoff`, `TableCellColSpan`, `TableCellHeaders`, `TableCellRowSpan`, `TableCellScope`, `TableCellVAlign`, `TableCellClass`, `TableCellDir`, `TableCellID`, `TableCellLang`, `TableCellStyle`, `TableCellTitle`, `TableCellXMLLang`, `Enable/Disable`, `Status`) VALUES ('0', '6', 'NULL', NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

INSERT INTO `XhtmlTableTFootContent` (`TableID`, `ObjectID`, `StopObjectID`, `ContainerObjectType`, `ContainerObjectTypeName`, `ContainerObjectID`, `LinkedTableRow`, `TableRowAlign`, `TableRowChar`, `TableRowCharOff`, `TableRowVAlign`, `TableRowClass`, `TableRowDir`, `TableRowID`, `TableRowLang`, `TableRowStyle`, `TableRowTitle`, `TableRowXMLLang`, `Enable/Disable`, `Status`) VALUES ('0', '6', NULL, 'Cell', 'XhtmlTableTFootCell', '6', 'False', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `XhtmlTableRow` VALUES(0, 1, 99, 'Cell', 'XhtmlTableRowCell', 1, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 2, 99, 'Cell', 'XhtmlTableRowCell', 2, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 3, 99, 'Cell', 'XhtmlTableRowCell', 3, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 4, 99, 'Cell', 'XhtmlTableRowCell', 4, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 5, 99, 'Cell', 'XhtmlTableRowCell', 5, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 99, 99, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 100, 199, 'Cell', 'XhtmlTableRowCell', 100, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 101, 199, 'Cell', 'XhtmlTableRowCell', 101, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 102, 199, 'Cell', 'XhtmlTableRowCell', 102, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 103, 199, 'Cell', 'XhtmlTableRowCell', 103, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 104, 199, 'Cell', 'XhtmlTableRowCell', 104, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 199, 199, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 200, 299, 'Cell', 'XhtmlTableRowCell', 200, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 201, 299, 'Cell', 'XhtmlTableRowCell', 201, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 202, 299, 'Cell', 'XhtmlTableRowCell', 202, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 203, 299, 'Cell', 'XhtmlTableRowCell', 203, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 204, 299, 'Cell', 'XhtmlTableRowCell', 204, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 299, 299, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 300, 399, 'Cell', 'XhtmlTableRowCell', 300, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 301, 399, 'Cell', 'XhtmlTableRowCell', 301, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 302, 399, 'Cell', 'XhtmlTableRowCell', 302, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 303, 399, 'Cell', 'XhtmlTableRowCell', 303, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 304, 399, 'Cell', 'XhtmlTableRowCell', 304, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 399, 399, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 400, 499, 'Cell', 'XhtmlTableRowCell', 400, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 401, 499, 'Cell', 'XhtmlTableRowCell', 401, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 402, 499, 'Cell', 'XhtmlTableRowCell', 402, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 403, 499, 'Cell', 'XhtmlTableRowCell', 403, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 404, 499, 'Cell', 'XhtmlTableRowCell', 404, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 499, 499, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 500, 599, 'Cell', 'XhtmlTableRowCell', 500, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 501, 599, 'Cell', 'XhtmlTableRowCell', 501, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 502, 599, 'Cell', 'XhtmlTableRowCell', 502, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 503, 599, 'Cell', 'XhtmlTableRowCell', 503, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 504, 599, 'Cell', 'XhtmlTableRowCell', 504, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 599, 599, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 600, 699, 'Cell', 'XhtmlTableRowCell', 600, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 601, 699, 'Cell', 'XhtmlTableRowCell', 601, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 602, 699, 'Cell', 'XhtmlTableRowCell', 602, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 603, 699, 'Cell', 'XhtmlTableRowCell', 503, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 604, 699, 'Cell', 'XhtmlTableRowCell', 604, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRow` VALUES(0, 699, 699, NULL, NULL, NULL, 'True', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `XhtmlTableRowCell` VALUES(0, 1, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 2, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 3, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 4, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 5, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 100, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 101, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 102, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 103, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 104, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 200, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 201, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 202, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 203, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 204, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 300, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 301, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 302, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 303, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 304, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 400, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 401, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 402, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 403, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 404, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 500, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 501, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 502, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 503, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 504, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 600, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 601, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 602, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 603, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `XhtmlTableRowCell` VALUES(0, 604, NULL, NULL, 'center', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

UPDATE `AdministratorList` SET `Li13` = '<a href=''index.php?PageID=229''>SimpleViewer Gallery</a>' WHERE `AdministratorList`.`PageID` = 11 AND `AdministratorList`.`ObjectID` = 3 LIMIT 1;

REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyCreatedPage', '../../index.php?PageID=221');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyCreatedUpdatePage', '../../index.php?PageID=224');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyDeletePage', '../../index.php?PageID=226');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyDeleteSelectPage', '225');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyEnableDisablePage', '../../index.php?PageID=228');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyEnableDisableSelectPage', '227');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyUpdatePage', '../../index.php?PageID=223');
REPLACE INTO `AdministratorContentLayerModulesSettings` VALUES('XhtmlSimpleViewer', 'simpleviewer', 'SimpleViewerGalleyUpdateSelectPage', '222');

REPLACE INTO `AdministratorContent` VALUES(221, 0, 'XhtmlContent', 'admincontent', 1, 'true', 0, 'true', 'false', '<div>', NULL, 'main-content-middle', NULL, NULL, 'SimpleViewer Gallery Has Been Created!', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'The SimpleViewer gallery you wanted to create, has been created. Below is the gallerythat has been created!', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, 'BodyText', 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(221, 1, 'XhtmlContent', 'admincontent', 2, 'true', 0, 'true', 'false', '<div>', '</div>', 'sv-container', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(221, 2, 'XhtmlContent', 'admincontent', 3, 'true', 0, 'true', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<script src="../Libraries/Tier7BehavioralLayer/jQuery/jquery.flash.min.js" >\r\n\r\n</script>\r\n\r\n<script src="../Administrators/PageTypes/SimpleViewerPage/SimpleViewerReadBehavior.js" >\r\n  \r\n</script>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

REPLACE INTO `AdministratorContent` VALUES(224, 0, 'XhtmlContent', 'admincontent', 1, 'true', 0, 'true', 'false', '<div>', NULL, 'main-content-middle', NULL, NULL, 'SimpleViewer Gallery Has Been Updated!', '<h2>', '</h2>', NULL, NULL, 'BodyHeading', 'The SimpleViewer gallery you wanted to update, has been updated. Below is the gallery that has been updated!', '<p>', '</p>', NULL, NULL, 'BodyText', NULL, NULL, 'BodyText', 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(224, 1, 'XhtmlContent', 'admincontent', 2, 'true', 0, 'true', 'false', '<div>', '</div>', 'sv-container', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');
REPLACE INTO `AdministratorContent` VALUES(224, 2, 'XhtmlContent', 'admincontent', 3, 'true', 0, 'true', 'false', NULL, '</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<script src="../Libraries/Tier7BehavioralLayer/jQuery/jquery.flash.min.js" >\r\n\r\n</script>\r\n\r\n<script src="../Administrators/PageTypes/SimpleViewerPage/SimpleViewerReadBehavior.js" >\r\n  \r\n</script>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Approved');

ALTER TABLE `XMLSimpleViewerLookup` ADD `XMLSimpleViewerName` TEXT NULL AFTER `XMLSimpleViewerGalleryHeight`;

ALTER TABLE `FlashSimpleViewerLookup` DROP `SimpleViewerRevisionID`;
ALTER TABLE `FlashSimpleViewerLookup` DROP `SimpleViewerCurrentVersion`;

REPLACE INTO `AdministratorList` VALUES(15, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Site Settings:', 'BodyText', NULL, 2, NULL, NULL, NULL, NULL, NULL, 'Disable', 'Upgrade System:', 'BodyText', NULL, 3, NULL, NULL, NULL, NULL, NULL, 'Enable', 'System Utilities:', 'BodyText', NULL, 4, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Site Stats:', 'BodyText', NULL, 5, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Ad Stats:', 'BodyText', NULL, 6, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Tables Pages:', 'BodyText', NULL, 7, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Videos Pages:', 'BodyText', NULL, 8, NULL, NULL, NULL, NULL, NULL, 'Enable', 'SimpleViewer Galleries:', 'BodyText', NULL, 9, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Security Tools:', 'BodyText', NULL, 10, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'System Message', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Maintenance Mode', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Server Settings', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''index.php?PageID=23''>Upload System Update</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''SystemUpdater/SystemUpdater.php''>System Updater</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''System/EmptyCaptchaImageDirectory/EmptyCaptchaImageDirectory.php''>Empty Captcha Image Directory</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''System/SessionDataCleanupRemover/SessionDataCleanupRemover.php''>Session Data Cleanup Remover</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''System/PHPInfo/PHPInfo.php''>PHP Configuration Information</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''System/SystemUpdateFileRemover/SystemUpdateFileRemover.php''>System Update File Remover Tool</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''System/SystemUpdateUpgradeFolderRemover/SystemUpdateUpgradeFolderRemover.php''>System Update Upgrade Folder Remover Tool</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''System/DatabaseBackup/DatabaseBackup.php''>Database Backup Utility</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLSiteStatsListing.php?Format=XML''>Site Stats as XML Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLSiteStatsListing.php?Format=CSV''>Site Stats as CSV Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLDailySiteStatsListing.php?Format=XML''>Daily Site Stats as XML Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLIPAddressSiteStatsListing.php?Format=CSV''>Daily Site Stats as CSV Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLIPAddressSiteStatsListing.php?Format=XML''>IP Address Site Stats as XML Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLDailyIPAddressSiteStatsListing.php?Format=CSV''>IP Address Site Stats as CSV Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLDailyIPAddressSiteStatsListing.php?Format=XML''>Daily IP Address Site Stats as XML Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLDailyIPAddressSiteStatsListing.php?Format=CSV''>Daily IP Address Site Stats as CSV Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLTimestampLogListing.php?Format=XML''>Timestamp Site Stats as XML Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLTimestampLogListing.php?Format=CSV''>Timestamp Site Stats as CSV Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''../Modules/Tier6ContentLayer/Extended/XhtmlAd/XMLAdStatsListing.php?Format=XML''>Ad Stats as XML Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''../Modules/Tier6ContentLayer/Extended/XhtmlAd/XMLAdStatsListing.php?Format=CSV''>Ad Stats as CSV Format</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''PageTypes/TablePage/EmptyUploadDirectory.php''>Empty Table Upload Directory</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''PageTypes/TablePage/EmptyTempFilesDirectory.php''>Empty Table Temp Files Directory</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''PageTypes/VideosPage/EmptyTempFilesDirectory.php''>Empty Videos Page Temp Files Directory</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''PageTypes/SimpleViewerPage/EmptyUploadDirectory.php''>Empty SimpleViewer Galleries Upload Directory</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''PageTypes/SimpleViewerPage/EmptyTempFilesDirectory.php''>Empty SimpleViewer Galleries Temp Files Directory</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
REPLACE INTO `AdministratorList` VALUES(15, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<a href=''System/SystemFileIntegrityScanner/UpdateSystemFileIntegrityDatabaseTable.php''>Update System File Integrity Database Table</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', '<a href=''System/SystemFileIntegrityScanner/SystemFileIntegrityScanner.php''>System File Integrity Scanner</a>', 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', NULL, 'BodyText', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Enable', 'Enable', 'Approved');
