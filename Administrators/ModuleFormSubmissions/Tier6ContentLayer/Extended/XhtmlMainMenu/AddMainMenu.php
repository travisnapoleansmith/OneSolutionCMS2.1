<?php
	$MainMenuSelectPage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
	$FormSelect['PageID'] = $MainMenuSelectPage;
	$FormSelect['ObjectID'] = $NewPageID;
	$FormSelect['ContainerObjectID'] = $NewPageID;
	$FormSelect['FormSelectName'] = 'MenuItem';
	$FormSelect['StopObjectID'] = NULL;
	$FormSelect['FormSelectStyle'] = NULL;
	$FormOption['PageID'] = $MainMenuSelectPage;
	$FormOption['ObjectID'] = $NewPageID;
	
	$FormOptionArray[] = $FormOption;
	$FormSelectionArray[] = $FormSelect;
	
	$MainMenuUpdatePage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
	$FormSelect['PageID'] = $MainMenuUpdatePage;
	$FormOption['PageID'] = $MainMenuUpdatePage;
	
	$FormOptionArray[] = $FormOption;
	$FormSelectionArray[] = $FormSelect;
	
	$j = $NewPageID;
	for ($i = 2; $i < 16; $i++) {
		$j += 10000;
		$FormSelect['ObjectID'] = $j;
		$FormSelect['FormSelectName'] = 'MenuItem';
		$FormSelect['FormSelectName'] .= $i;
		$FormSelectionArray[] = $FormSelect;
	}
	
	$j += 10000;
	$FormSelect['ObjectID'] = $j;
	$FormSelect['FormSelectName'] = 'TopMenu';
	$FormSelectionArray[] = $FormSelect;
	
	$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelectionArray);
	$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOptionArray);
				
?>