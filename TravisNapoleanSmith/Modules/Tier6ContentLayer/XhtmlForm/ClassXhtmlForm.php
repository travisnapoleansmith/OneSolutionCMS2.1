<?php

class XhtmlForm extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlFormProtectionLayer;
	
	protected $TableNames = array();
	protected $FormLookupTableName = array();
	
	//protected $CalendarAppointments = array();
	
	// Xhtml Form Required Attributes
	protected $FormAction = array();
	
	// Xhtml Form Optional Attributes
	protected $FormAccept = array();
	protected $FormAccptCharset = array();
	protected $FormEnctype = array();
	protected $FormMethod = array();
	protected $FormName = array();
	
	// Xhtml Form Standard Attributes
	protected $FormClass = array();
	protected $FormDir = array();
	protected $FormId = array();
	protected $FormLang = array();
	protected $FormStyle = array();
	protected $FormTitle = array();
	protected $FormXMLLang = array();
	
	protected $FormEnableDisable = array();
	protected $FormStatus = array();
	
	// Xhtml Form Table Listing
	protected $FormTableListingPageID = array();
	protected $FormTableListingObjectID = array();
	protected $FormTableListingContainerObjectType = array();
	protected $FormTableListingContainerObjectTypeName = array();
	protected $FormTableListingContainerObjectID = array();
	protected $FormTableListingEnableDisable = array();
	protected $FormTableListingStatus = array();
	
	protected $Form;
	
	public function __construct($tablenames, $database) {
		$this->XhtmlFormProtectionLayer = &$database;
		
		$this->PrintPreview = $tablenames['PrintPreview'];
		unset($tablenames['PrintPreview']);
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->GlobalWriter = $tablenames['GlobalWriter'];
		unset($tablenames['GlobalWriter']);
		
		if ($this->GlobalWriter) {
			$this->Writer = $this->GlobalWriter;
		} else {
			$this->Writer = new XMLWriter();
			if ($this->FileName) {
				$this->Writer->openURI($this->FileName);
			} else {
				$this->Writer->openMemory();
			}
			$this->Writer->setIndent(4);
		}
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->XhtmlFormProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function FetchDatabase ($PageID) {
		$this->PrintPreview = $PageID['PrintPreview'];
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		unset ($passarray['ObjectID']);
		reset($this->TableNames);
		
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		//$this->
		//print_r($this->TableNames);
		while (current($this->TableNames)) {
			$this->XhtmlFormProtectionLayer->Connect(current($this->TableNames));
			$this->XhtmlFormProtectionLayer->pass (current($this->TableNames), 'setDatabaseRow', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->Disconnect(current($this->TableNames));
			$this->FormLookupTableName[key($this->TableNames)] = $this->XhtmlFormProtectionLayer->pass (current($this->TableNames), 'getMultiRowField', array());
			$i = 1;
			
			while ($this->FormLookupTableName[current($this->TableNames)][$i]) {
				if (current($this->TableNames) == 'Form') {
					array_push($this->FormAction, $this->FormLookupTableName[current($this->TableNames)]['FormAction']);
					
					array_push($this->FormAccept, $this->FormLookupTableName[current($this->TableNames)]['FormAccept']);
					array_push($this->FormAccptCharset, $this->FormLookupTableName[current($this->TableNames)]['FormAccptCharset']);
					array_push($this->FormEnctype, $this->FormLookupTableName[current($this->TableNames)]['FormEnctype']);
					array_push($this->FormMethod, $this->FormLookupTableName[current($this->TableNames)]['FormMethod']);
					array_push($this->FormName, $this->FormLookupTableName[current($this->TableNames)]['FormName']);
					
					array_push($this->FormClass, $this->FormLookupTableName[current($this->TableNames)]['FormClass']);
					array_push($this->FormDir, $this->FormLookupTableName[current($this->TableNames)]['FormDir']);
					array_push($this->FormId, $this->FormLookupTableName[current($this->TableNames)]['FormId']);
					array_push($this->FormLang, $this->FormLookupTableName[current($this->TableNames)]['FormLang']);
					array_push($this->FormStyle, $this->FormLookupTableName[current($this->TableNames)]['FormStyle']);
					array_push($this->FormTitle, $this->FormLookupTableName[current($this->TableNames)]['FormTitle']);
					array_push($this->FormXMLLang, $this->FormLookupTableName[current($this->TableNames)]['FormXMLLang']);
					
					array_push($this->FormEnableDisable, $this->FormLookupTableName[current($this->TableNames)]['Enable/Disable']);
					array_push($this->FormStatus, $this->FormLookupTableName[current($this->TableNames)]['Status']);
				} else if (current($this->TableNames) == 'FormFieldSet') {
				
				} else if (current($this->TableNames) == 'FormInput') {
				
				} else if (current($this->TableNames) == 'FormLabel') {
				
				} else if (current($this->TableNames) == 'FormLegend') {
				
				} else if (current($this->TableNames) == 'FormTableListing') {
					array_push($this->FormTableListingPageID, $this->FormLookupTableName[current($this->TableNames)]['PageID']);
					array_push($this->FormTableListingObjectID, $this->FormLookupTableName[current($this->TableNames)]['ObjectID']);
					array_push($this->FormTableListingContainerObjectType, $this->FormLookupTableName[current($this->TableNames)]['ContainerObjectType']);
					array_push($this->FormTableListingContainerObjectTypeName, $this->FormLookupTableName[current($this->TableNames)]['ContainerObjectTypeName']);
					array_push($this->FormTableListingContainerObjectID, $this->FormLookupTableName[current($this->TableNames)]['ContainerObjectID']);
					array_push($this->FormTableListingEnableDisable, $this->FormLookupTableName[current($this->TableNames)]['Enable/Disable']);
					array_push($this->FormTableListingStatus, $this->FormLookupTableName[current($this->TableNames)]['Status']);
					
				} else if (current($this->TableNames) == 'FormTextArea') {
				
				}
				/*
				$this->XhtmlFormProtectionLayer->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
				$j = $i-1;
				$this->XhtmlFormProtectionLayer->Connect($this->FormNames[$j]);
				$this->XhtmlFormProtectionLayer->pass ($this->FormNames[$j], 'setDatabaseField', array('idnumber' => $passarray));
				$this->XhtmlFormProtectionLayer->pass ($this->FormNames[$j], 'setDatabaseRow', array('idnumber' => $passarray));
				$this->XhtmlFormProtectionLayer->Disconnect($this->FormNames[$j]);
				$this->processCalendars ($this->FormNames[$j]);*/
				$i++;
			}
			
			next($this->TableNames);
		}
		print_r($this->FormLookupTableName);
		$i = 0;
		$pageid = NULL;
		
		$passarray = $pageid;
		/*
		while ($this->CalendarAppointmentNames[$i]) {
			$this->XhtmlFormProtectionLayer->Connect($this->CalendarAppointmentNames[$i]);
			if (!$pageid['Day']) {
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			} else {
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			}
			$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseField', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseRow', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->Disconnect($this->CalendarAppointmentNames[$i]);
			$this->CalendarAppointments[$this->CalendarAppointmentNames[$i]] = $this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'getMultiRowField', array());
			$this->processAppointments($this->CalendarAppointmentNames[$i], $i);

			$i++;
			if ($this->CalendarDay[$i] == 'Current') {
				$pageid['Day'] = $this->CurrentDay;
			} else if ($this->CalendarDay[$i]) {
				$pageid['Day'] = $this->CalendarDay[$i];
			}
			
			if ($this->CalendarMonth[$i] == 'Current') {
				$pageid['Month'] = $this->CurrentMonth;
			} else if ($this->CalendarMonth[$i]) {
				$pageid['Month'] = $this->CalendarMonth[$i];
			}
			
			if ($this->CalendarYear[$i] == 'Current') {
				$pageid['Year'] = $this->CurrentYear;
			} else if ($this->CalendarYear[$i]) {
				$pageid['Year'] = $this->CalendarYear[$i];
			}
			
			$passarray = $pageid;
		}*/
	}
	
	public function CreateOutput($space) {
		$i = 0;
		while ($this->FormNames[$i] && $this->FormEnableDisable[$i] == 'Enable' && $this->FormStatus[$i] == 'Approved') {
			$this->Writer->startElement('table');
				$this->TableElement($i);
				$this->Writer->startElement('tr');
					$this->TableRow($i);
					$this->Writer->startElement('td');
						if ($this->CalendarDay[$i]) {
							$this->Writer->writeAttribute('colspan', '4');
							$this->Writer->writeAttribute('align', 'center');
						} else {
							$this->Writer->writeAttribute('colspan', '7');
							$this->Writer->writeAttribute('align', 'center');
						}
						$text = NULL;
						if ($this->CalendarMonth[$i]) {
							if ($this->CalendarMonth[$i] == 'Current') {
								$text .= $this->CurrentMonth;
							} else {
								$text .= $this->CalendarMonth[$i];
							}
							$text .= ' ';
						}
						if ($this->CalendarDay[$i]) {
							if ($this->CalendarDay[$i] == 'Current') {
								$text .= $this->CurrentDay;
							} else {
								$text .= $this->CalendarDay[$i];
							}
							if ($this->CalendarYear[$i]) {
								$text .= ', ';
							}
						}
						if ($this->CalendarYear[$i]) {
							if ($this->CalendarYear[$i] == 'Current') {
								$text .= $this->CurrentYear;
							} else {
								$text .= $this->CalendarYear[$i];
							}
						}
						
						$this->Writer->text($text);
					$this->Writer->endElement(); // ENDS TD TAG
				$this->Writer->endElement(); // ENDS TR TAG
				
				$week = array();
				$week['Sunday'] = NULL;
				$week['Monday'] = NULL;
				$week['Tuesday'] = NULL;
				$week['Wednesday'] = NULL;
				$week['Thursday'] = NULL;
				$week['Friday'] = NULL;
				$week['Saturday'] = NULL;
				if ($this->CalendarDay[$i]) {
					$this->TableWeekHeading($this->AppointmentColumns, $i);
					$this->MakeDayAppointments($i);
				} else {
					$this->TableWeekHeading($this->DaysOfTheWeek, $i);
				}
				
				if (($this->CalendarMonth[$i] == 'Current' && $this->CalendarYear[$i] == 'Current') && is_null($this->CalendarDay[$i])) {
					if ($this->CurrentDay >= 21) {
						$day = $this->CurrentDay - 21;	
					} else if ($this->CurrentDay >= 14){
						$day = $this->CurrentDay - 14;
					} else if ($this->CurrentDay >= 7) {
						//$day = 0;
						$day .= $this->CurrentDay - 7;
					} else {
						$day = $this->CurrentDay;
					}
					
					$j = 0;
					while ($j < 6) {
						$newweek = $this->DayWeek($week, $day, $this->CurrentDayOfWeek, date('t'));
						$newweek = $this->DayWeekAppointment($newweek, $day, $this->CurrentDayOfWeek, date('t'), $i);
						if ($newweek) {
							$this->TableWeek($newweek, $i);
							$day = $day + 7;
							$j++;
						} else {
							$j = 10;
						}
					}
				} else {
					$monthnumber = $this->getCalendarMonthNumber ($this->CalendarMonth[$i]);
					$firstday = $this->FirstDayOfMonth ($monthnumber, $this->CalendarYear[$i]);
					$lastday = $this->LastDayOfMonth ($monthnumber + 1, $this->CalendarYear[$i]);
					$day = 1;
					if (!$this->CalendarDay[$i]) {
						$j = 0;
						while ($j < 6) {
							$newweek = $this->DayWeek($week, $day, $firstday, $lastday);
							$newweek = $this->DayWeekAppointment($newweek, $day, $firstday, $lastday, $i);
							if ($newweek) {
								$this->TableWeek($newweek, $i);
								$day = $day + 7;
								$j++;
							} else {
								$j = 10;
							}
						}
					}
				}
				$this->Writer->endElement();  // ENDS TR TAG
			$this->Writer->endElement(); // ENDS TABLE TAG
			
			if (!$this->CalendarDay[$i]) {
				$this->MakeDayWeekAppointments($i);
			}
			
			$i++;
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->Form = $this->Writer->flush();
		}
		
	}
	
	public function getOutput() {
		return $this->Form;
	}
}
?>