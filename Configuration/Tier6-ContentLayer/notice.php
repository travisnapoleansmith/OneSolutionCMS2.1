<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2013 One Solution CMS
	* This content management system is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 2 of the License, or
	* (at your option) any later version.
	*
	* This content management system is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/gpl-2.0.txt
	* @version    2.1.141, 2013-01-14
	*************************************************************************************
	*/

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