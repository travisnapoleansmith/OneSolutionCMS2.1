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

class XhtmlAd extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $AdStatsTableName;
	protected $AdStatsTable = array();
	protected $AdSponsorsTableName = array();
	protected $AdSponsorsDatabaseOptions = array();
	protected $AdSponsorsDatabaseTable = array();
	protected $AdSponsorsOutputAdLookup = array();
	protected $AdSponsorsOutputAdsOrder = array();
	protected $AdSponsorsRemoveArray = array();

	protected $LastAccess;

	protected $Class;
	protected $ID;
	protected $Style;

	protected $AdvertisingClass;
	protected $AdvertisingID;
	protected $AdvertisingStyle;

	protected $AdvertisingContentClass;
	protected $AdvertisingContentID;
	protected $AdvertisingContentStyle;

	protected $AdvertisingImageClass;
	protected $AdvertisingImageID;
	protected $AdvertisingImageStyle;

	protected $SeparatorImageClass;
	protected $SeparatorImageID;
	protected $SeparatorImageStyle;

	protected $StartTag;
	protected $AdvertisingStartTag;
	protected $AdvertisingContentStartTag;
	protected $SeparatorStartTag;

	protected $AdMax;

	/**
	 * Create an instance of XtmlAd
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlAd'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlAd'][$hold];
		$this->ErrorMessage = array();

		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}

		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}

		if ($DatabaseOptions['Class']) {
			$this->Class = $DatabaseOptions['Class'];
		}

		if ($DatabaseOptions['ID']) {
			$this->ID = $DatabaseOptions['ID'];
		}

		if ($DatabaseOptions['Style']) {
			$this->Style = $DatabaseOptions['Style'];
		}

		if ($DatabaseOptions['AdvertisingClass']) {
			$this->AdvertisingClass = $DatabaseOptions['AdvertisingClass'];
		}

		if ($DatabaseOptions['AdvertisingID']) {
			$this->AdvertisingID = $DatabaseOptions['AdvertisingID'];
		}

		if ($DatabaseOptions['AdvertisingStyle']) {
			$this->AdvertisingStyle = $DatabaseOptions['AdvertisingStyle'];
		}

		if ($DatabaseOptions['AdvertisingImageClass']) {
			$this->AdvertisingImageClass = $DatabaseOptions['AdvertisingImageClass'];
		}

		if ($DatabaseOptions['AdvertisingImageID']) {
			$this->AdvertisingImageID = $DatabaseOptions['AdvertisingImageID'];
		}

		if ($DatabaseOptions['AdvertisingImageStyle']) {
			$this->AdvertisingImageStyle = $DatabaseOptions['AdvertisingImageStyle'];
		}

		if ($DatabaseOptions['AdvertisingContentClass']) {
			$this->AdvertisingContentClass = $DatabaseOptions['AdvertisingContentClass'];
		}

		if ($DatabaseOptions['AdvertisingContentID']) {
			$this->AdvertisingContentID = $DatabaseOptions['AdvertisingContentID'];
		}

		if ($DatabaseOptions['AdvertisingContentStyle']) {
			$this->AdvertisingContentStyle = $DatabaseOptions['AdvertisingContentStyle'];
		}

		if ($DatabaseOptions['SeparatorClass']) {
			$this->SeparatorClass = $DatabaseOptions['SeparatorClass'];
		}

		if ($DatabaseOptions['SeparatorID']) {
			$this->SeparatorID = $DatabaseOptions['SeparatorID'];
		}

		if ($DatabaseOptions['SeparatorStyle']) {
			$this->SeparatorStyle = $DatabaseOptions['SeparatorStyle'];
		}

		if ($DatabaseOptions['StartTag']) {
			$this->StartTag = $DatabaseOptions['StartTag'];
		}

		if ($DatabaseOptions['AdvertisingStartTag']) {
			$this->AdvertisingStartTag = $DatabaseOptions['AdvertisingStartTag'];
		}

		if ($DatabaseOptions['AdvertisingContentStartTag']) {
			$this->AdvertisingContentStartTag = $DatabaseOptions['AdvertisingContentStartTag'];
		}

		if ($DatabaseOptions['SeparatorStartTag']) {
			$this->SeparatorStartTag = $DatabaseOptions['SeparatorStartTag'];
		}

		if ($DatabaseOptions['AdMax']) {
			$this->AdMax = $DatabaseOptions['AdMax'];
		} else {
			$this->AdMax = 0;
		}

		$this->LastAccess = date('Y-m-d H:i:s');

		$this->AdStatsTableName = $tablenames['DatabaseTable1'];
		foreach($TableNames as $key => $databasename) {
			if ($key != 'DatabaseTable1') {
				$this->AdSponsorsTableName[$key] = $databasename;
			}
		}
		
		foreach($this->AdSponsorsTableName as $TableName) {
			$this->AdSponsorsDatabaseOptions[$TableName] = array();
			$ShowNumber = $TableName . 'ShowNumber';
			$Class = $TableName . 'Class';
			$ID = $TableName . 'ID';
			$Style = $TableName . 'Style';
			$StartTag = $TableName . 'StartTag';
			$Text = $TableName . 'Text';

			$SeparatorClass = $TableName . 'SeparatorClass';
			$SeparatorID = $TableName . 'SeparatorID';
			$SeparatorStyle = $TableName . 'SeparatorStyle';
			$SeparatorStartTag = $TableName . 'SeparatorStartTag';

			$AdvertisingImageClass = $TableName . 'ImageClass';
			$AdvertisingImageID = $TableName . 'ImageID';
			$AdvertisingImageStyle = $TableName . 'ImageStyle';
			$AdvertisingImageStartTag = $TableName . 'ImageStartTag';

			if ($DatabaseOptions[$ShowNumber]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$ShowNumber] = $DatabaseOptions[$ShowNumber];
			}

			if ($DatabaseOptions[$Class]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$Class] = $DatabaseOptions[$Class];
			}

			if ($DatabaseOptions[$ID]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$ID] = $DatabaseOptions[$ID];
			}

			if ($DatabaseOptions[$Style]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$Style] = $DatabaseOptions[$Style];
			}

			if ($DatabaseOptions[$StartTag]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$StartTag] = $DatabaseOptions[$StartTag];
			}

			if ($DatabaseOptions[$Text]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$Text] = $DatabaseOptions[$Text];
			}

			if ($DatabaseOptions[$SeparatorClass]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorClass] = $DatabaseOptions[$SeparatorClass];
			}

			if ($DatabaseOptions[$SeparatorID]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorID] = $DatabaseOptions[$SeparatorID];
			}

			if ($DatabaseOptions[$SeparatorStyle]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorStyle] = $DatabaseOptions[$SeparatorStyle];
			}

			if ($DatabaseOptions[$SeparatorStartTag]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorStartTag] = $DatabaseOptions[$SeparatorStartTag];
			}

			if ($DatabaseOptions[$AdvertisingImageClass]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageClass] = $DatabaseOptions[$AdvertisingImageClass];
			}

			if ($DatabaseOptions[$AdvertisingImageID]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageID] = $DatabaseOptions[$AdvertisingImageID];
			}

			if ($DatabaseOptions[$AdvertisingImageStyle]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageStyle] = $DatabaseOptions[$AdvertisingImageStyle];
			}

			if ($DatabaseOptions[$AdvertisingImageStartTag]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageStartTag] = $DatabaseOptions[$AdvertisingImageStartTag];
			}
		}
	}
	
	/**
	 * setDatabaseAll
	 *
	 * Sets the hostname, user, password, databasename and databasetable.
	 *
	 * @param string $hostname = Database Host Name
	 * @param string $user = Database User
	 * @param string $password = Database User's Password
	 * @param string $databasename = Database Name
	 * @param string $databasetable = Database Table
	 *
	 */
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;

		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($databasetable);
	}

	// FIX SORT ORDER OF ADS!
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		unset ($PageID['PrintPreview']);

		foreach ($this->AdSponsorsTableName as $TableName) {
			$this->LayerModule->createDatabaseTable($TableName);
			$TableNamePageID = $TableName . 'PageID';
			$this->LayerModule->createDatabaseTable($TableNamePageID);

			$this->LayerModule->Connect($TableName);
			$this->LayerModule->pass ($TableName, 'setEntireTable', array());
			$this->AdSponsorsDatabaseTable[$TableName] = $this->LayerModule->pass ($TableName, 'getEntireTable', array());
			$this->LayerModule->Disconnect($TableName);

			$this->LayerModule->Connect($TableNamePageID);
			$this->LayerModule->pass ($TableNamePageID, 'setEntireTable', array());
			$this->AdSponsorsDatabaseTable[$TableNamePageID] = $this->LayerModule->pass ($TableNamePageID, 'getEntireTable', array());
			$this->LayerModule->Disconnect($TableNamePageID);

			$AdCount = count($this->AdSponsorsDatabaseTable[$TableName]);

			$ShowNumber = $TableName . 'ShowNumber';
			$ShowNumber = $this->AdSponsorsDatabaseOptions[$TableName][$ShowNumber];

			if ($ShowNumber > $AdCount) {
				$ShowNumber = $AdCount;
			}

			$PrintOrder = $this->AdSponsorsDatabaseTable[$TableNamePageID];

			$this->AdSponsorsOutputAdsOrder[$TableNamePageID] = array();
			$j = 1;

			foreach ($this->AdSponsorsDatabaseTable[$TableName] as $DatabaseKey => $DatabaseTable) {
				if ($DatabaseTable['Enable/Disable'] == 'Disable') {
					unset($this->AdSponsorsDatabaseTable[$TableName][$DatabaseKey]);
					$AdvertisingKey = $DatabaseTable['AdvertisingID'];
					foreach ($this->AdSponsorsDatabaseTable[$TableNamePageID] as $AdSponsorsKey => $AdSponsorsDatabaseTable) {
						if ($AdSponsorsDatabaseTable['AdvertisingID'] == $AdvertisingKey) {
							unset($this->AdSponsorsDatabaseTable[$TableNamePageID][$AdSponsorsKey]);
						}
					}
				}

				if (isset($DatabaseTable['AdStartDateTime']) | isset($DatabaseTable['AdEndDateTime'])) {
					$CurrentTime = time();

					$AdStartTimeStamp = strtotime($DatabaseTable['AdStartDateTime']);
					$AdEndTimeStamp = strtotime($DatabaseTable['AdEndDateTime']);

					if ((int)$AdStartTimeStamp > (int)$CurrentTime & $DatabaseTable['AdStartDateTime'] != NULL) {
						unset($this->AdSponsorsDatabaseTable[$TableName][$DatabaseKey]);
						$AdvertisingKey = $DatabaseTable['AdvertisingID'];
						foreach ($this->AdSponsorsDatabaseTable[$TableNamePageID] as $AdSponsorsKey => $AdSponsorsDatabaseTable) {
							if ($AdSponsorsDatabaseTable['AdvertisingID'] == $AdvertisingKey) {
								unset($this->AdSponsorsDatabaseTable[$TableNamePageID][$AdSponsorsKey]);
							}
						}
					} else if ((int)$AdEndTimeStamp < (int)$CurrentTime & $DatabaseTable['AdEndDateTime'] != NULL) {
						unset($this->AdSponsorsDatabaseTable[$TableName][$DatabaseKey]);
						$AdvertisingKey = $DatabaseTable['AdvertisingID'];
						foreach ($this->AdSponsorsDatabaseTable[$TableNamePageID] as $AdSponsorsKey => $AdSponsorsDatabaseTable) {
							if ($AdSponsorsDatabaseTable['AdvertisingID'] == $AdvertisingKey) {
								unset($this->AdSponsorsDatabaseTable[$TableNamePageID][$AdSponsorsKey]);
							}
						}
					}
				}
			}

			foreach ($this->AdSponsorsDatabaseTable[$TableNamePageID] as $AdSponsorsKey => $AdSponsorsDatabaseTable) {
				$RemoveFlag = FALSE;
				foreach ($AdSponsorsDatabaseTable as $SponsorsKey => $SponsorsItem) {
					if ($SponsorsKey != 'AdvertisingID') {
						if (!strstr($SponsorsKey, 'Order')) {
							if ($SponsorsItem == 0) {
								if ($RemoveFlag !== TRUE) {
									$RemoveFlag == FALSE;
								}
							} else {
								if ($this->PageID == $SponsorsItem) {
									$RemoveFlag = FALSE;
								} else if ($RemoveFlag === FALSE) {
									$RemoveFlag = TRUE;
								}
							}
						}
					}
				}

				if ($RemoveFlag === TRUE) {
					unset($this->AdSponsorsDatabaseTable[$TableNamePageID][$AdSponsorsKey]);
					$AdvertisingKey = $AdSponsorsDatabaseTable['AdvertisingID'];
					foreach ($this->AdSponsorsDatabaseTable[$TableName] as $DatabaseKey => $DatabaseTable) {
						if ($DatabaseTable['AdvertisingID'] == $AdvertisingKey) {
							unset($this->AdSponsorsDatabaseTable[$TableName][$DatabaseKey]);
						}
					}
				}
			}

			// PUT IN AD HOC SENSE IN HERE - ALL MODULES ARE IN /AdHocSense FOLDER.
			$AdHocSensePath = dirname(__FILE__) . '/AdHocSense';
			if (is_dir($AdHocSensePath)) {
				if (opendir($AdHocSensePath)) {
					//print "OPENED AD HOC SENSE PATH\n";
				}
			}
			
			foreach ($PrintOrder as $CurrentData) {
				$i = 1;
				$PageIDKey = 'PageID' . $i;
				$OrderKey = 'PageID' .$i . 'Order';

				if ($CurrentData[$PageIDKey] != 0) {
					foreach ($CurrentData as $LookupKey => $LookupData) {
						if (!strstr($LookupKey,'Order')) {
							if ($LookupKey != 'AdvertisingID') {
								if ($LookupData != 0) {
									if ($LookupData == $this->PageID) {
										if (!isset($this->AdSponsorsOutputAdLookup[$TableNamePageID])) {
											$this->AdSponsorsOutputAdLookup[$TableNamePageID] = array();
										}
										array_push($this->AdSponsorsOutputAdLookup[$TableNamePageID], $CurrentData['AdvertisingID']);
										$ShowNumber--;
									} else {
										$KeyName = 'REMOVE' . $j;
										$this->AdSponsorsRemoveArray[$TableNamePageID][$KeyName] = $CurrentData['AdvertisingID'];
										$j++;
									}
								}
							}
						} else {
							$NewKey = str_replace('Order', '', $LookupKey);
							if ($CurrentData[$NewKey] == $this->PageID) {
								if ($LookupData != 'NA') {
									$this->AdSponsorsOutputAdsOrder[$TableNamePageID][$CurrentData['AdvertisingID']] = $LookupData;
								}
							}
						}
					}
				}
			}
			
			for ($i = 0; $i < $ShowNumber; $i++) {
				$this->selectRandomSponsor ($TableNamePageID, $this->AdSponsorsDatabaseTable[$TableNamePageID]);
			}

			$i = 0;

			foreach($this->AdSponsorsDatabaseTable[$TableNamePageID] as $key => $value) {
				$i++;
			}

			$ShowNumber = $TableName . 'ShowNumber';
			$ShowNumber = $this->AdSponsorsDatabaseOptions[$TableName][$ShowNumber];

			if ($ShowNumber > $AdCount) {
				$ShowNumber = $AdCount;
			}

			$this->AdSponsorsOutputAdLookup[$TableNamePageID] = $this->sortArray ($this->AdSponsorsOutputAdLookup[$TableNamePageID], $this->AdSponsorsOutputAdsOrder[$TableNamePageID],$ShowNumber);
			
		}

		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));

		$this->AdStatsTable = $this->LayerModule->pass ($this->DatabaseTable, 'getMultiRowField', array());
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
	/**
	 * FetchDatabaseAll
	 *
	 * Retrieved the entire database table.
	 *
	 * @param string $DatabaseTable = A Database Table to get. OPTIONAL
	 * @return array Entire Database Table
	 */
	public function FetchDatabaseAll () {
		$Arguments = func_get_args();
		$DatabaseTable = $Arguments[0];
		
		if ($DatabaseTable === NULL) {
			$this->LayerModule->Connect($this->DatabaseTable);
			
			$this->LayerModule->pass ($this->DatabaseTable, 'setEntireTable', array());
			$EntireDatabaseTable = $this->LayerModule->pass ($this->DatabaseTable, 'getEntireTable', array());
	
			$this->LayerModule->Disconnect($this->DatabaseTable);
		} else {
			$this->LayerModule->Connect($DatabaseTable);
			
			$this->LayerModule->pass ($DatabaseTable, 'setEntireTable', array());
			$EntireDatabaseTable = $this->LayerModule->pass ($DatabaseTable, 'getEntireTable', array());
	
			$this->LayerModule->Disconnect($DatabaseTable);
		}
		
		return $EntireDatabaseTable;
	}
	
	/**
	 * getAdTablesName
	 *
	 * Retrieved the entire database table.
	 *
	 * @return array Entire Database Table
	 */
	public function getAdTablesName() {
		return $this->AdSponsorsTableName;
	}
	
	/**
	 * CreateOutput
	 *
	 * Creates Output based on what the database entried have in them with space being the indentation of each line.
	 *
	 * @param string $space = Indentation for each new line
	 *
	 */
	public function CreateOutput($space) {
		// Figuring Out The Last Index Name For An Array Of Arrays
		$LastIndex = NULL;
		foreach ($this->AdSponsorsOutputAdLookup as $key => $value) {
			$LastIndex = $key;
		}
		$LastIndex = str_replace('PageID', '', $LastIndex);

		if ($this->StartTag != NULL) {
			$this->Writer->startElement($this->StartTag);
		} else {
			$this->Writer->startElement('div');
		}

		$this->ProcessStandardAttribute('');
		
		foreach ($this->AdSponsorsOutputAdLookup as $AdSponsorsTableName => $AdSponsorsLookupValues) {
			$AdvertisingTableName = str_replace('PageID', '', $AdSponsorsTableName);

			$Class = $AdvertisingTableName . 'Class';
			$ID = $AdvertisingTableName . 'ID';
			$Style = $AdvertisingTableName . 'Style';
			$StartTag = $AdvertisingTableName . 'StartTag';
			$Text = $AdvertisingTableName . 'Text';

			$SeparatorClass = $AdvertisingTableName . 'SeparatorClass';
			$SeparatorID = $AdvertisingTableName . 'SeparatorID';
			$SeparatorStyle = $AdvertisingTableName . 'SeparatorStyle';
			$SeparatorStartTag = $AdvertisingTableName . 'SeparatorStartTag';

			$AdvertisingImageClass = $AdvertisingTableName . 'ImageClass';
			$AdvertisingImageID = $AdvertisingTableName . 'ImageID';
			$AdvertisingImageStyle = $AdvertisingTableName . 'ImageStyle';
			$AdvertisingImageStartTag = $AdvertisingTableName . 'ImageStartTag';

			if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$StartTag]) {
				$this->Writer->startElement($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$StartTag]);
				if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$Class]) {
					$this->Writer->writeAttribute('class', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$Class]);
				}

				if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$ID]) {
					$this->Writer->writeAttribute('id', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$ID]);
				}

				if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$Style]) {
					$this->Writer->writeAttribute('style', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$Style]);
				}

				if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$Text]) {
					$this->Writer->text($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$Text]);
				}

			}

			if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$StartTag]) {
				$this->Writer->endElement(); // ENDS START TAG
			}

			foreach ($AdSponsorsLookupValues as $LookupKey => $LookupValue) {
				$LastAdValue = end($AdSponsorsLookupValues);
				$ReturnPage = $this->checkAdPage ($AdSponsorsTableName, $LookupValue);
				$PageID = array();
				$PageID['PageID'] = $this->PageID;
				$PageID['AdvertisingID'] = $LookupValue;
				$PageID['AdvertisingTableName'] = $AdvertisingTableName;

				if ($ReturnPage !== 'FALSE') {
					$this->updateAdStatPage($PageID, $ReturnPage);
				} else {
					$AdStatPage = array();
					$AdStatPage['PageID'] = $this->PageID;
					$AdStatPage['AdvertisingID'] = $LookupValue;
					$AdStatPage['AdvertisingTableName'] = $AdvertisingTableName;

					$this->createAdStatPage($AdStatPage);
					$this->updateAdStatPage($PageID, $ReturnPage);
					$this->sortAdStatPage();
				}

				// OUTPUT ADS
				$AdSponsorsData = $this->AdSponsorsDatabaseTable[$AdvertisingTableName][$LookupValue];

				if ($this->AdvertisingStartTag) {
					$this->Writer->startElement($this->AdvertisingStartTag);
					if ($this->AdvertisingClass) {
						$this->Writer->writeAttribute('class', $this->AdvertisingClass);
					}

					if ($this->AdvertisingID) {
						$this->Writer->writeAttribute('id', $this->AdvertisingID);
					}

					if ($this->AdvertisingStyle) {
						$this->Writer->writeAttribute('style', $this->AdvertisingStyle);
					}

				}

				if ($AdSponsorsData['ImageLocation'] != NULL) {
					if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageStartTag]) {
						$this->Writer->startElement($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageStartTag]);

						if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageClass]) {
							$this->Writer->writeAttribute('class', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageClass]);
						}

						if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageID]) {
							$this->Writer->writeAttribute('id', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageID]);
						}

						if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageStyle]) {
							$this->Writer->writeAttribute('style', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageStyle]);
						}
					}

					$this->Writer->startElement('img');
					if ($this->AdvertisingImageClass) {
						$this->Writer->writeAttribute('class', $this->AdvertisingImageClass);
					}

					if ($this->AdvertisingImageID) {
						$this->Writer->writeAttribute('id', $this->AdvertisingImageID);
					}

					if ($this->AdvertisingImageStyle) {
						$this->Writer->writeAttribute('style', $this->AdvertisingImageStyle);
					}

					$this->Writer->writeAttribute('src', $AdSponsorsData['ImageLocation']);

					if ($AdSponsorsData['ImageCaption']) {
						$this->Writer->writeAttribute('alt', $AdSponsorsData['ImageCaption']);
					}

					$this->Writer->endElement(); // ENDS IMG TAG

					if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$AdvertisingImageStartTag]) {
						$this->Writer->endElement(); // ENDS IMAGE START TAG
					}
				}

				if ($this->AdvertisingContentStartTag) {
					$this->Writer->startElement($this->AdvertisingContentStartTag);
				} else {
					$this->Writer->startElement('p');
				}

				if ($this->AdvertisingContentClass) {
					$this->Writer->writeAttribute('class', $this->AdvertisingContentClass);
				}

				if ($this->AdvertisingContentID) {
					$this->Writer->writeAttribute('id', $this->AdvertisingContentID);
				}

				if ($this->AdvertisingContentStyle) {
					$this->Writer->writeAttribute('style', $this->AdvertisingContentStyle);
				}

				if ($AdSponsorsData['Link']) {
					$this->Writer->startElement('a');
					$this->Writer->writeAttribute('href', $AdSponsorsData['Link']);
					$this->Writer->writeAttribute('onclick', 'window.open(this); return false;');
					$this->Writer->text($AdSponsorsData['Name']);
					$this->Writer->endElement(); // ENDS A TAG
				} else{
					$this->Writer->text($AdSponsorsData['Name']);
				}

				if ($this->AdvertisingStartTag) {
					$this->Writer->endElement(); // ENDS START TAG OR P TAG
				}

				if ($AdSponsorsData['Location']) {
					if ($this->AdvertisingContentStartTag) {
						$this->Writer->startElement($this->AdvertisingContentStartTag);
					} else {
						$this->Writer->startElement('p');
					}

					if ($this->AdvertisingContentClass) {
						$this->Writer->writeAttribute('class', $this->AdvertisingContentClass);
					}

					if ($this->AdvertisingContentID) {
						$this->Writer->writeAttribute('id', $this->AdvertisingContentID);
					}

					if ($this->AdvertisingContentStyle) {
						$this->Writer->writeAttribute('style', $this->AdvertisingContentStyle);
					}

					$this->Writer->writeRaw($AdSponsorsData['Location']);

					$this->Writer->endElement(); // ENDS START TAG OR P TAG
				}
				if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$StartTag]) {
					$this->Writer->endElement(); // ENDS START TAG
				}

				if ($LastAdValue != $LookupValue) {
					if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorStartTag]) {
						$this->Writer->startElement($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorStartTag]);
						if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorClass]) {
							$this->Writer->writeAttribute('class', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorClass]);
						}

						if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorID]) {
							$this->Writer->writeAttribute('id', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorID]);
						}

						if ($this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorStyle]) {
							$this->Writer->writeAttribute('style', $this->AdSponsorsDatabaseOptions[$AdvertisingTableName][$SeparatorStyle]);
						}
						$this->Writer->endElement();

					}
				}
				// ENDS OUTPUT ADS
			}



			if ($AdvertisingTableName != $LastIndex) {
				if ($this->SeparatorStartTag) {
					$this->Writer->startElement($this->SeparatorStartTag);
					if ($this->SeparatorClass) {
						$this->Writer->writeAttribute('class', $this->SeparatorClass);
					}

					if ($this->SeparatorID) {
						$this->Writer->writeAttribute('id', $this->SeparatorID);
					}

					if ($this->SeparatorStyle) {
						$this->Writer->writeAttribute('style', $this->SeparatorStyle);
					}

					$this->Writer->endElement();

				}
			}
		}

		$this->Writer->endElement(); // ENDS START TAG

		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	protected function selectRandomSponsor ($AdSponsorsTableName, Array $DatabaseTable) {
		if ($AdSponsorsTableName != NULL) {
			$Index = array_rand($DatabaseTable);
			$TRIP = NULL;

			if (!isset($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName])) {
				$this->AdSponsorsOutputAdLookup[$AdSponsorsTableName] = array();
				$Index = array_rand($DatabaseTable);
				array_push($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName], $Index);
			} else {
				$Count = count($DatabaseTable);
				if ($Count != 1) {
					foreach($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName] as $value) {
						if ($Index == $value) {
							$Index = $this->recurssiveRand ($DatabaseTable, $Index, $value);
							
							if (array_search($Index, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName])) {
								$Index = $this->recurssiveRand ($DatabaseTable, $Index, $value);
							}
						}
					}
	
					array_push($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName], $Index);
				}
			}

			if (isset($this->AdSponsorsRemoveArray[$AdSponsorsTableName])) {
				foreach($this->AdSponsorsRemoveArray[$AdSponsorsTableName] as $value) {
					$ReplaceKey = array_search($value, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName]);
					if ($ReplaceKey !== FALSE){
						$Index = $this->recurssiveRand ($DatabaseTable, $Index, $value);
						$Key = array_search($Index, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName]);
						while ($Key !== FALSE) {
							$Index = $this->recurssiveRand ($DatabaseTable, $Index, $value);
							$Key = array_search($Index, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName]);
						}
						$this->AdSponsorsOutputAdLookup[$AdSponsorsTableName][$ReplaceKey] = $Index;
					}
				}
			}

		}
	}

	protected function recurssiveRand (Array $DatabaseTable, $Index, $Value) {
		$Index = array_rand($DatabaseTable);
		if ($Index == $Value) {
			$Index = $this->recurssiveRand($DatabaseTable, $Index, $Value);
		}

		return $Index;
	}

	protected function sortArray (Array $SourceArray, Array $LookupArray, $Limit) {
		if ($LookupArray == NULL) {
			return $SourceArray;
		}

		if (count($SourceArray) == 1) {
			return $SourceArray;
		}

		$Hold = array();
		asort($LookupArray);
		foreach ($LookupArray as $Key => $Value) {
			array_push($Hold, $Key);
		}

		if ($Limit > 0) {
			if ($Limit < $End = count($Hold)) {
				$End = $End - $Limit;
				for ($i = 0; $i < $End; $i++) {
					array_pop($Hold);
				}
			}
		}
		return $Hold;
	}

	protected function checkAdPage ($AdSponsorsTableName, $AdvertisingID) {
		if ($this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PageID'))) {
			$AdSponsorsTableName = str_replace('PageID', '', $AdSponsorsTableName);
			foreach ($this->AdStatsTable as $Key => $AdSponsorsTableValues) {
				if ($AdSponsorsTableValues['AdvertisingID'] == $AdvertisingID) {
					if ($AdSponsorsTableValues['AdvertisingTableName'] == $AdSponsorsTableName) {
						return $Key;
					}
				}
			}
			return 'FALSE';
		} else {
			return 'FALSE';
		}
	}

	public function sortAdStatPage() {
		$this->LayerModule->pass ($this->DatabaseTable, 'sortTable', array('AdvertisingTableName' => 'AdvertisingTableName'));
		$this->LayerModule->pass ($this->DatabaseTable, 'sortTable', array('AdvertisingID' => 'AdvertisingID'));
		$this->LayerModule->pass ($this->DatabaseTable, 'sortTable', array('PageID' => 'PageID'));
	}

	public function createAdStatPage(array $AdPage) {
		if ($AdPage != NULL) {
			$this->LayerModule->pass ($this->DatabaseTable, 'BuildFieldNames', array('TableName' => $this->DatabaseTable));
			$Keys = $this->LayerModule->pass ($this->DatabaseTable, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $AdPage, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createAdStatPage: AdPage cannot be NULL!');
		}
	}

	public function updateAdStatPage(array $PageID, $StatsPageLookup) {
		if ($PageID != NULL) {
			if ($StatsPageLookup !== NULL) {
				$StatsPageLookup = str_replace('PageID', '', $StatsPageLookup);
				$NewCount = $this->AdStatsTable[$StatsPageLookup]['Count'];
				$NewCount++;
				$Content = array('Count' => $NewCount);
				$CurrentMonthYear = date('FY');
				$Content['LastAccess'] = $this->LastAccess;
				$passarray = array('TableName' => $this->DatabaseTable);

				$this->LayerModule->pass ($this->DatabaseTable, 'BuildFieldNames', $passarray);
				$RowFieldName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowFieldNames', array());
				$Key = array_search($CurrentMonthYear, $RowFieldName);
				if ($Key) {
					$CurrentMonthYearCount = $this->AdStatsTable[$StatsPageLookup][$CurrentMonthYear];
					$CurrentMonthYearCount++;
					$Content[$CurrentMonthYear] = $CurrentMonthYearCount;
				} else {
					$passarray = array('fieldstring' => "`$CurrentMonthYear` INT NOT NULL DEFAULT '0'", 'fieldflag' => '', 'fieldflagcolumn' => '');
					$this->LayerModule->pass ($this->DatabaseTable, 'createField', $passarray);
					$CurrentMonthYearCount = $this->AdStatsTable[$StatsPageLookup][$CurrentMonthYear];
					$CurrentMonthYearCount++;
					$Content[$CurrentMonthYear] = $CurrentMonthYearCount;
				}
				$this->updateModuleContent($PageID, $this->DatabaseTable, $Content);
			} else {
				array_push($this->ErrorMessage,'updateAdStatPage: StatsPageLookup cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'updateAdStatPage: PageID cannot be NULL!');
		}
	}
}
?>