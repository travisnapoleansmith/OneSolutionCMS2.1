<?php
	if (!isset($_GET['printpreview'])){
		$Writer = &$GLOBALS['Writer'];
		
		$Tier6Databases = $GLOBALS['Tier6Databases'];
		
		$Options = $Tier6Databases->getLayerModuleSetting();
		$NoticeActivate = $Options['NOTICE']['notice']['Activate']['SettingAttribute'];
		$MaintenanceMode = $Options['NOTICE']['notice']['MaintenanceMode']['SettingAttribute'];
		$MaintenanceFileName = $Options['NOTICE']['notice']['MaintenanceFileName']['SettingAttribute'];
		
		if ($MaintenanceMode == 'TRUE') {
			include('ContentFiles/Maintenance.php');
			if (file_exists($MaintenanceFileName)) {
				$Tier6Databases->processHTMLFile($MaintenanceFileName);
			}
		}
		
		if ($NoticeActivate == 'TRUE') {
			if (file_exists('ContentFiles/WebNotice.htm')) {
				$Tier6Databases->processHTMLFile('ContentFiles/WebNotice.htm');
			}
		}
	}
?>