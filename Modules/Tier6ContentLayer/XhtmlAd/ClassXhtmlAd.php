<?php

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
	
	public function __construct(array $tablenames, array $databaseoptions, ValidationLayer $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlAd'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlAd'][$hold];
		$this->ErrorMessage = array();
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
		
		if ($databaseoptions['Class']) {
			$this->Class = $databaseoptions['Class'];
		}
		
		if ($databaseoptions['ID']) {
			$this->ID = $databaseoptions['ID'];
		}
		
		if ($databaseoptions['Style']) {
			$this->Style = $databaseoptions['Style'];
		}
		
		if ($databaseoptions['AdvertisingClass']) {
			$this->AdvertisingClass = $databaseoptions['AdvertisingClass'];
		}
		
		if ($databaseoptions['AdvertisingID']) {
			$this->AdvertisingID = $databaseoptions['AdvertisingID'];
		}
		
		if ($databaseoptions['AdvertisingStyle']) {
			$this->AdvertisingStyle = $databaseoptions['AdvertisingStyle'];
		}
		
		if ($databaseoptions['AdvertisingImageClass']) {
			$this->AdvertisingImageClass = $databaseoptions['AdvertisingImageClass'];
		}
		
		if ($databaseoptions['AdvertisingImageID']) {
			$this->AdvertisingImageID = $databaseoptions['AdvertisingImageID'];
		}
		
		if ($databaseoptions['AdvertisingImageStyle']) {
			$this->AdvertisingImageStyle = $databaseoptions['AdvertisingImageStyle'];
		}
		
		if ($databaseoptions['AdvertisingContentClass']) {
			$this->AdvertisingContentClass = $databaseoptions['AdvertisingContentClass'];
		}
		
		if ($databaseoptions['AdvertisingContentID']) {
			$this->AdvertisingContentID = $databaseoptions['AdvertisingContentID'];
		}
		
		if ($databaseoptions['AdvertisingContentStyle']) {
			$this->AdvertisingContentStyle = $databaseoptions['AdvertisingContentStyle'];
		}
		
		if ($databaseoptions['SeparatorClass']) {
			$this->SeparatorClass = $databaseoptions['SeparatorClass'];
		}
		
		if ($databaseoptions['SeparatorID']) {
			$this->SeparatorID = $databaseoptions['SeparatorID'];
		}
		
		if ($databaseoptions['SeparatorStyle']) {
			$this->SeparatorStyle = $databaseoptions['SeparatorStyle'];
		}
		
		if ($databaseoptions['StartTag']) {
			$this->StartTag = $databaseoptions['StartTag'];
		}
		
		if ($databaseoptions['AdvertisingStartTag']) {
			$this->AdvertisingStartTag = $databaseoptions['AdvertisingStartTag'];
		}
		
		if ($databaseoptions['AdvertisingContentStartTag']) {
			$this->AdvertisingContentStartTag = $databaseoptions['AdvertisingContentStartTag'];
		}
		
		if ($databaseoptions['SeparatorStartTag']) {
			$this->SeparatorStartTag = $databaseoptions['SeparatorStartTag'];
		}
		
		if ($databaseoptions['AdMax']) {
			$this->AdMax = $databaseoptions['AdMax'];
		} else {
			$this->AdMax = 0;
		}
		
		$this->LastAccess = date('Y-m-d H:i:s');
		
		$this->AdStatsTableName = $tablenames['DatabaseTable1'];
		foreach($tablenames as $key => $databasename) {
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
			
			if ($databaseoptions[$ShowNumber]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$ShowNumber] = $databaseoptions[$ShowNumber];
			}
			
			if ($databaseoptions[$Class]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$Class] = $databaseoptions[$Class];
			}
			
			if ($databaseoptions[$ID]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$ID] = $databaseoptions[$ID];
			}
			
			if ($databaseoptions[$Style]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$Style] = $databaseoptions[$Style];
			}
			
			if ($databaseoptions[$StartTag]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$StartTag] = $databaseoptions[$StartTag];
			}
			
			if ($databaseoptions[$Text]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$Text] = $databaseoptions[$Text];
			}
			
			if ($databaseoptions[$SeparatorClass]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorClass] = $databaseoptions[$SeparatorClass];
			}
			
			if ($databaseoptions[$SeparatorID]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorID] = $databaseoptions[$SeparatorID];
			}
			
			if ($databaseoptions[$SeparatorStyle]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorStyle] = $databaseoptions[$SeparatorStyle];
			}
			
			if ($databaseoptions[$SeparatorStartTag]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$SeparatorStartTag] = $databaseoptions[$SeparatorStartTag];
			}
			
			if ($databaseoptions[$AdvertisingImageClass]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageClass] = $databaseoptions[$AdvertisingImageClass];
			}
			
			if ($databaseoptions[$AdvertisingImageID]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageID] = $databaseoptions[$AdvertisingImageID];
			}
			
			if ($databaseoptions[$AdvertisingImageStyle]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageStyle] = $databaseoptions[$AdvertisingImageStyle];
			}
			
			if ($databaseoptions[$AdvertisingImageStartTag]) {
				$this->AdSponsorsDatabaseOptions[$TableName][$AdvertisingImageStartTag] = $databaseoptions[$AdvertisingImageStartTag];
			}
		}
		
	}
	
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
			
			$ShowNumber = $TableName . 'ShowNumber';
			$ShowNumber = $this->AdSponsorsDatabaseOptions[$TableName][$ShowNumber];
			
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
			$this->AdSponsorsOutputAdLookup[$TableNamePageID] = $this->sortArray ($this->AdSponsorsOutputAdLookup[$TableNamePageID], $this->AdSponsorsOutputAdsOrder[$TableNamePageID],$ShowNumber);
		}
		
		
		
		
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->AdStatsTable = $this->LayerModule->pass ($this->DatabaseTable, 'getMultiRowField', array());
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
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
				
				$this->Writer->endElement(); // ENDS START TAG OR P TAG
				
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
					
					$this->Writer->text($AdSponsorsData['Location']);
					
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
			$i = 0;
			foreach($DatabaseTable as $key => $value) {
				$i++;
			}
			
			$Index = rand(1,$i);
			
			$TRIP = NULL;
			
			if (!isset($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName])) {
				$this->AdSponsorsOutputAdLookup[$AdSponsorsTableName] = array();
				$Index = rand(1,$i);
				array_push($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName], $Index);
			} else {
				foreach($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName] as $value) {
					if ($Index == $value) {
						$Index = $this->recurssiveRand ($i, $Index, $value);
						if (array_search($Index, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName])) {
							$Index = $this->recurssiveRand ($i, $Index, $value);
						}
					}
				}
				
				array_push($this->AdSponsorsOutputAdLookup[$AdSponsorsTableName], $Index);
			}
			
			if (isset($this->AdSponsorsRemoveArray[$AdSponsorsTableName])) {
				foreach($this->AdSponsorsRemoveArray[$AdSponsorsTableName] as $value) {
					$ReplaceKey = array_search($value, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName]);
					if ($ReplaceKey !== FALSE){
						$Index = $this->recurssiveRand ($i, $Index, $value);
						$Key = array_search($Index, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName]);
						while ($Key !== FALSE) {
							$Index = $this->recurssiveRand ($i, $Index, $value);
							$Key = array_search($Index, $this->AdSponsorsOutputAdLookup[$AdSponsorsTableName]);
						}
						$this->AdSponsorsOutputAdLookup[$AdSponsorsTableName][$ReplaceKey] = $Index;
					}
				}
			}
			
		}
	}
	
	protected function recurssiveRand ($i, $Index, $Value) {
		$Index = rand(1,$i);
		if ($Index == $Value) {
			$Index = $this->recurssiveRand($i, $Index, $Value);
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