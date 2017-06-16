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
	
	function buildLanguages($BrowsersStats, $LanguagesConfiguration) {
		if (is_array($BrowsersStats) === TRUE) {
			if (is_array($LanguagesConfiguration) === TRUE) {
				$Languages = array();
				$LanguagesData = array();
				foreach($BrowsersStats as $Key => $Value) {
					foreach ($Value as $SubKey => $SubValue) {
						// Has Data
						if (isset($SubValue['Timestamp']) === TRUE) {
							$TempPageID = $SubValue['PageID'];
							
							$LanguageType = $SubValue['HttpAcceptLanguage'];
							$LanguageType = strtolower($LanguageType);
							$LanguageType = rtrim($LanguageType, ',');
							$LanguageType = rtrim($LanguageType, ',*');
							
							if (isset($LanguagesConfiguration['Languages'][$LanguageType]) === TRUE) {
								$LanguageType = $LanguagesConfiguration['Languages'][$LanguageType];
							} else {
								$LanguageTemp = str_replace(array(';', ','), '-|-', $LanguageType);
								$LanguageTemp = array_filter(explode('-|-', $LanguageTemp));
								if (!empty($LanguageTemp)) {
									foreach ($LanguageTemp as $Key => $Value) {
										$Value = trim($Value);
										$LanguageTemp[$Key] = $Value;
										if (strpos($Value, 'q=') !== FALSE) {
											unset($LanguageTemp[$Key]);
										} else {
											if (isset($LanguagesConfiguration['Languages'][$Value])) {
												$Value = $LanguagesConfiguration['Languages'][$Value];
												$LanguageTemp[$Key] = $Value;
											}
										}
									}
									
									$LanguageType = $LanguageTemp;
									
								} else {
								
								}
							}
							if (strstr($SubValue['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
								$LanguageType = 'Google Bot Views';
							}
							
							if (is_array($LanguageType) === TRUE) {
								foreach ($LanguageType as $LanguageTypeKey => $LanguageTypeValue) {
									if ($LanguageTypeValue !== 'Google Bot Views') {
										$Languages[$LanguageTypeValue] = $LanguageTypeValue;
									}
									
									if (isset($LanguagesData[$TempPageID][$LanguageTypeValue])) {
										$LanguagesData[$TempPageID][$LanguageTypeValue]++;
									} else {
										$LanguagesData[$TempPageID][$LanguageTypeValue] = 1;
									}
									
									if (!isset($Languages[$LanguageTypeValue])) {
										$Languages[$LanguageTypeValue] = $LanguageTypeValue;
									}
								}
							} else {
								if ($LanguageType !== 'Google Bot Views') {
									$Languages[$LanguageType] = $LanguageType;
								}
								
								if (isset($LanguagesData[$TempPageID][$LanguageType]) === TRUE) {
									$LanguagesData[$TempPageID][$LanguageType]++;
								} else {
									$LanguagesData[$TempPageID][$LanguageType] = 1;
								}
								
								if (!isset($Languages[$LanguageType])) {
									$Languages[$LanguageType] = $LanguageType;
								}
							}
						} else {
							// Has No Data
							$TempPageID = $Data['PageID'];
							$LanguageType = 'Unknown';
							if (isset($Languages[$LanguageType]) === FALSE) {
								$Languages[$LanguageType] = $LanguageType;
							}
							if (isset($LanguagesData[$TempPageID][$LanguageType]) === FALSE) {
								$LanguagesData[$TempPageID][$LanguageType] = 0;
							}
						}
					}
				}
				
				unset($Languages['Google Bot Views']);
				
				ksort($Languages, SORT_STRING);
				
				$ReturnData = array();
				$ReturnData['Types'] = $Languages;
				$ReturnData['Data'] = $LanguagesData;
				
				return ($ReturnData);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>