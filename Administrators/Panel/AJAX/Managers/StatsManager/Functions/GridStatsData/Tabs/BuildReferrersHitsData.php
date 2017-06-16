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
	//require_once('Functions/BuildRows.php');
	
	function buildReferrersHitsData($SiteStats, $PageListings, $ConfigurationFileName) {
		/*if ($ConfigurationFileName == NULL) {
			return FALSE;
		}
		
		if (is_array($ConfigurationFileName) === TRUE) {
			return FALSE;
		}
		*/
		// MUST PASS A CONFIGURATION FILE NAME
		
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				foreach ($PageListings as $Key => $Data) {
					if ($SiteStats != NULL) {
						if (is_array($SiteStats) === TRUE) {
							if (file_exists($ConfigurationFileName) === TRUE) {
								$Configuration = parse_ini_file($ConfigurationFileName, true);
							} else {
								$Configuration = NULL;
							}
							
							$ReferrersArray = array();
							$ReferrersAddress = NULL;
							$ReferrersHit = NULL;
							
							$Temp = $SiteStats[$Data['PageID']];
								
							// Figures out refereals hits
							if (is_array($Temp) === TRUE) {
								foreach ($Temp as $Key => $Value) {
									$ReferrersAddress = $Value['HttpRefer'];
									
									if ($ReferrersAddress != NULL) {
										if ($ReferrersArray[$ReferrersAddress] != NULL) {
											$ReferrersArray[$ReferrersAddress]['Data'][] = $Value;
											$ReferrersHit = $ReferrersArray[$ReferrersAddress]['Hits'];
											$ReferrersHit++; 
											$ReferrersArray[$ReferrersAddress]['Hits'] = $ReferrersHit;
										} else {
											$ReferrersArray[$ReferrersAddress]['Hits'] = 1;
											$ReferrersArray[$ReferrersAddress]['Data'][] = $Value;
										}
									}
								}
							}
							
							$ReferrersData[$Data['PageID']] = $ReferrersArray;
						} else {
							return FALSE;
						}
					} else {
						return FALSE;
					}
				}
				
				// RETURN DATA HERE
				$ReturnData = array();
				$ReturnData['Data'] = $ReferrersData;
				return $ReturnData;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>