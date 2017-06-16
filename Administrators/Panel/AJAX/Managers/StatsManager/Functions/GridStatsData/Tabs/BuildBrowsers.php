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
	require_once('Functions/BuildRows.php');
	
	function buildBrowsers($CurrentRecord, $BrowsersStats, $BuildRowsInformation, $ConfigurationFileName) {
		$Format = $GLOBALS['Format'];
		
		if (is_null($Format) === TRUE) {
			return FALSE;
		} else if (isset($Format) === FALSE){
			return FALSE;
		} else {
			if ($BuildRowsInformation == NULL) {
				return FALSE;
			}
			
			if (is_array($BuildRowsInformation) === FALSE) {
				return FALSE;
			}
			
			if (is_array($BuildRowsInformation['Information']) === FALSE) {
				return FALSE;
			}
			
			if ($BuildRowsInformation['Information'] != NULL) {
				$Information = $BuildRowsInformation['Information'];
			} else {
				$Information = array();
			}
			
			if ($BuildRowsInformation['Attributes'] != NULL) {
				$Attributes = $BuildRowsInformation['Attributes'];
			} else {
				$Attributes = array();
			}
			
			if ($BuildRowsInformation['Page'] != NULL) {
				$Page = $BuildRowsInformation['Page'];
			} else {
				$Page = array();
			}
			
			if ($BrowsersStats != NULL) {
				if (is_array($BrowsersStats) === TRUE) {
					if (file_exists($ConfigurationFileName) === TRUE) {
						$Configuration = parse_ini_file($ConfigurationFileName, true);
					} else {
						$Configuration = NULL;
					}
					
					$Types = $Configuration['Types'];
					$NonHumanTypes = $Configuration['Non Human Types'];
					
					$UserAgent = $Configuration['UserAgent'];
					$NonHumanUserAgent = $Configuration['Non Human UserAgent'];
					$NonUserAgentValue = $Configuration['Non UserAgent Value'];
					
					if (is_array($Types) === TRUE) {
						foreach($Types as $TypesKey => $TypesValue) {
							$$TypesValue = 0;
						}
					}
					
					if (is_array($NonHumanTypes) === TRUE) {
						foreach($NonHumanTypes as $NonHumanTypesKey => $NonHumanTypesValue) {
							$$NonHumanTypesValue = 0;
						}
					}
					
					$Temp = $BrowsersStats[$CurrentRecord['PageID']];
					
					if (is_array($Temp)) {
						foreach ($Temp as $Key => $Value) {
							// Value with data.
							if (isset($Value['Timestamp']) === TRUE) {
								if (is_array($NonHumanUserAgent) === TRUE) {
									$BREAK = FALSE;
									foreach ($NonHumanUserAgent as $NonHumanUserAgentKey => $NonHumanUserAgentValue) {
										if (strstr($Value['NavigatorUserAgent'], $NonHumanUserAgentValue) == TRUE) {
											$$NonHumanUserAgentKey++;
											$BREAK = TRUE;
											break;
										}
									}
									if ($BREAK === TRUE) {
										$BREAK = FALSE;
										continue;
									}
								}
		
								if (is_array($UserAgent) === TRUE & is_array($NonUserAgentValue) === TRUE) {
									$BREAK = FALSE;
									foreach ($UserAgent as $UserAgentKey => $UserAgentValue) {
										if (is_array($NonUserAgentValue[$UserAgentKey]) === TRUE) {
											// For Non UserAgent Value that are set as arrays like with Internet Explorer.
											foreach ($NonUserAgentValue[$UserAgentKey] as $NonUserAgentKey => $NonUserAgentValueValue) {
												if ($Value[$NonUserAgentValueValue] != NULL) {
													$$UserAgentKey++;
													$BREAK = TRUE;
													break;
												}
											}
											
											if ($BREAK === TRUE) {
												$BREAK = FALSE;
												break;
											}
										} else if (is_array($UserAgentValue) === TRUE) {
											// For UserAgent that are set as arrays like Safari is.
											$AND = FALSE;
											$NOT = NULL;
											$COUNT = 0;
											$ArrayCount = count($UserAgentValue);
											foreach ($UserAgentValue as $UserAgentValueKey => $UserAgentValueValue) {
												// UserAgent INI setting has a value that is an array, there are two options that can be taken.
													// Option 1 is if number of elements in that array is 2 then 
														// The first element must be the user agent value that you want to compare as true. 
														// The second element must be the user agent value that you want to compare as false.
													// Option 2 is if the number of elements in that array is anything other than 2 it will treat them as all user agents value that are true. 
												
												// Option 1
												if ($ArrayCount == 2) {
													if ($UserAgentValueKey === 0) {
														if (strstr($Value['NavigatorUserAgent'], $UserAgentValueValue) == TRUE) {
															$AND = TRUE;
															continue;
														} else {
															$AND = FALSE;
															break;
														}
													} else if ($UserAgentValueKey === 1) {
														if (strstr($Value['NavigatorUserAgent'], $UserAgentValueValue) == FALSE) {
															$NOT = TRUE;
															continue;
														} else {
															$NOT = FALSE;
															break;
														}
													} 
												// Option 2
												} else {
													if (strstr($Value['NavigatorUserAgent'], $UserAgentValueValue) == TRUE) {
														if ($COUNT === 0 | ($COUNT > 0 && $AND === TRUE)) {
															$AND = TRUE;
															$COUNT++;
														} else {
															$AND = FALSE;
															break;
														}
													} else {
														$AND = FALSE;
														break;
													}
												}
												
											}
											
											if ($AND === TRUE && $NOT === NULL) {
												$$UserAgentKey++;
												break;
											} else if ($AND === TRUE && $NOT === TRUE) {
												$$UserAgentKey++;
												break;
											}
										}
										
										if (isset($NonUserAgentValue[$UserAgentKey]) === TRUE) {
											// For all other browsers that do not fit above
											if (strstr($Value['NavigatorUserAgent'], $UserAgentValue) == TRUE) {
												$$UserAgentKey++;
												break;
											}
										}
										
										if ($UserAgentValue == '') {
											// For all unknown browsers.
											$$UserAgentKey++;
											break;
										}
									}
								}
							} else {
								// Value with no data
							}
						}
					}
					
					if (is_array($NonHumanTypes) === TRUE) {
						foreach($NonHumanTypes as $NonHumanTypesKey => $NonHumanTypesValue) {
							$Information[] = $$NonHumanTypesValue;
						}
					}
					
					if (is_array($Types) === TRUE) {
						foreach($Types as $TypesKey => $TypesValue) {
							$Information[] = $$TypesValue;
						}
					}
					
					switch ($Format) {
						case 'XML':
							buildRows($Information, $Attributes, $Page);
							break;
						case 'Excel':
							$PHPExcel = $GLOBALS['PHPExcel'];
							$Number = $GLOBALS['Number'];
							if (is_null($PHPExcel) === TRUE) {
								return FALSE;
							} else if (isset($PHPExcel) === FALSE){
								return FALSE;
							} else {
								if (is_null($Number) === TRUE) {
									return FALSE;
								} else if (isset($Number) === FALSE){
									return FALSE;
								} else {
									$Letter = 'A';
									
									foreach ($Information as $Key => $Value) {
										$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, $Value);
										
										$Letter++;
									}
								}
							}
							
							break;
						case 'CSV':
							$Output = $GLOBALS['Output'];
							if (is_null($Output) === TRUE) {
								return FALSE;
							} else if (isset($Output) === FALSE){
								return FALSE;
							} else {
								fputcsv($Output, $Information);
							}
							break;
						default:
							return FALSE;
					}
					
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}
?>