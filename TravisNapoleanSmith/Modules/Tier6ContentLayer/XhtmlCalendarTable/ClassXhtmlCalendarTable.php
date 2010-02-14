<?php

class XhtmlCalendarTable extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlCalendarTableProtectionLayer;
	
	protected $Writer;
	protected $FileName;
	
	protected $TableNames = array();
	protected $CalendarLookupTableName = array();
	
	// Xhtml Calendar Tables Optional Attributes
	protected $CalendarTableNames = array();
	protected $CalendarTableBorder = array();
	protected $CalendarTableCellPadding = array();
	protected $CalendarTableCellSpacing = array();
	protected $CalendarTableFrame = array();
	protected $CalendarTableRules = array();
	protected $CalendarTableSummary = array();
	protected $CalendarTableWidth = array();
	
	// Xhtml Calendar Tables Standard Attributes
	protected $CalendarTableClass = array();
	protected $CalendarTableDir = array();
	protected $CalendarTableId = array();
	protected $CalendarTableLang = array();
	protected $CalendarTableStyle = array();
	protected $CalendarTableTitle = array();
	protected $CalendarTableXMLLang = array();
	
	protected $CalendarTableEnableDisable = array();
	protected $CalendarTableStatus = array();
	
	// Calendars
	protected $CalendarPageID = array();
	protected $CalendarObjectID = array();
	protected $CalendarAppointmentNames = array();
	protected $CalendarDay = array();
	protected $CalendarMonth = array();
	protected $CalendarYear = array();
	protected $CalendarHeadingStartTag = array();
	protected $CalendarHeadingEndTag = array();
	protected $CalendarHeadingStartTagID = array();
	protected $CalendarHeadingStartTagStyle = array();
	protected $CalendarHeadingStartTagClass = array();
	
	// Calendars Optional Attributes
	protected $CalendarAlign = array();
	protected $CalendarChar = array();
	protected $CalendarCharoff = array();
	protected $CalendarValign = array();
	
	// Calendars Standard Attributes
	protected $CalendarClass = array();
	protected $CalendarDir = array();
	protected $CalendarId = array();
	protected $CalendarLang = array();
	protected $CalendarStyle = array();
	protected $CalendarTitle = array();
	protected $CalendarXMLLang = array();
	
	// Calendars
	protected $CalendarEnableDisable = array();
	protected $CalendarStatus = array();
	
	protected $EnableDisable = array();
	protected $Status = array();
	
	protected $CurrentDate;
	protected $CurrentTime;
	protected $CurrentDayOfWeek;
	protected $CurrentDay;
	protected $CurrentMonth;
	protected $CurrentYear;
	
	protected $DaysOfTheWeek = array();
	protected $CurrentCalendar = array();
	protected $AppointmentColumns = array();
	
	protected $Day;
	protected $Month;
	protected $Year;
	
	protected $CalendarTable;
	
	public function __construct($tablenames, $database) {
		$this->CurrentDate = date('D M d, Y');
		$this->CurrentTime = date('h:i A T');
		$this->CurrentDayOfWeek = date('l');
		$this->CurrentDay = date('d');
		$this->CurrentMonth = date('F');
		$this->CurrentYear = date('Y');
		
		$this->DaysOfTheWeek['Sunday'] = 'Sunday';
		$this->DaysOfTheWeek['Monday'] = 'Monday';
		$this->DaysOfTheWeek['Tuesday'] = 'Tuesday';
		$this->DaysOfTheWeek['Wednesday'] = 'Wednesday';
		$this->DaysOfTheWeek['Thursday'] = 'Thursday';
		$this->DaysOfTheWeek['Friday'] = 'Friday';
		$this->DaysOfTheWeek['Saturday'] = 'Saturday';
		
		$this->AppointmentColumns['Start Time'] = 'Start Time';
		$this->AppointmentColumns['End Time'] = 'End Time';
		$this->AppointmentColumns['Appointment'] = 'Appointment';
		
		$this->XhtmlCalendarTableProtectionLayer = &$database;
		/*
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		*/
		$this->Writer = new XMLWriter();
		if ($this->FileName) {
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer->openMemory();
		}
		$this->Writer->setIndent(4);
		
		$this->Day = $tablenames['Day'];
		$this->Month = $tablenames['Month'];
		$this->Year = $tablenames['Year'];
		unset ($tablenames['Day']);
		unset ($tablenames['Month']);
		unset ($tablenames['Year']);
		
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
		
		$this->XhtmlCalendarTableProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		/*
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XhtmlCalendarTableProtectionLayer->setDatabasetable (current($this->TableNames));
			next($this->TableNames);
		}*/
	}
	
	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XhtmlCalendarTableProtectionLayer->Connect(current($this->TableNames));
			$this->XhtmlCalendarTableProtectionLayer->pass (current($this->TableNames), 'setEntireTable', array());
			$this->XhtmlCalendarTableProtectionLayer->Disconnect(current($this->TableNames));
			$this->CalendarLookupTableName[current($this->TableNames)] = $this->XhtmlCalendarTableProtectionLayer->pass (current($this->TableNames), 'getEntireTable', array());
			$i = 1;
			
			while ($this->CalendarLookupTableName[current($this->TableNames)][$i]) {
				array_push($this->CalendarTableNames, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarTableName']);
				array_push($this->CalendarTableBorder, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarBorder']);
				array_push($this->CalendarTableCellPadding, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarCellPadding']);
				array_push($this->CalendarTableCellSpacing, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarCellSpacing']);
				array_push($this->CalendarTableFrame, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarFrame']);
				array_push($this->CalendarTableRules, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarRules']);
				array_push($this->CalendarTableSummary, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarSummary']);
				array_push($this->CalendarTableWidth, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarWidth']);
				array_push($this->CalendarTableClass, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarClass']);
				array_push($this->CalendarTableDir, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarDir']);
				array_push($this->CalendarTableId, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarId']);
				array_push($this->CalendarTableLang, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarLang']);
				array_push($this->CalendarTableStyle, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarStyle']);
				array_push($this->CalendarTableTitle, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarTitle']);
				array_push($this->CalendarTableXMLLang, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarXMLLang']);
				array_push($this->CalendarTableEnableDisable, $this->CalendarLookupTableName[current($this->TableNames)][$i]['Enable/Disable']);
				array_push($this->CalendarTableStatus, $this->CalendarLookupTableName[current($this->TableNames)][$i]['Status']);
				
				$this->XhtmlCalendarTableProtectionLayer->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
				$j = $i-1;
				
				$this->XhtmlCalendarTableProtectionLayer->Connect($this->CalendarTableNames[$j]);
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarTableNames[$j], 'setEntireTable', array());
				$this->XhtmlCalendarTableProtectionLayer->Disconnect($this->CalendarTableNames[$j]);
				$this->CalendarLookupTableName[current($this->TableNames)][$this->CalendarTableNames[$j]] = $this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarTableNames[$j], 'getEntireTable', array());
				$this->processCalendars (1, $this->CalendarTableNames[$j], current($this->TableNames));
				$i++;
			}
			
			next($this->TableNames);
		}
	}
	
	protected function processCalendars ($i, $calendarname, $calendartablename) {
		array_push($this->CalendarPageID, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['PageID']);
		array_push($this->CalendarObjectID, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['ObjectID']);
		array_push($this->CalendarAppointmentNames, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarAppointmentName']);
		array_push($this->CalendarDay, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['Day']);
		array_push($this->CalendarMonth, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['Month']);
		array_push($this->CalendarYear, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['Year']);
		array_push($this->CalendarHeadingStartTag, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['HeadingStartTag']);
		array_push($this->CalendarHeadingEndTag, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['HeadingEndTag']);
		array_push($this->CalendarHeadingStartTagID, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['HeadingStartTagID']);
		array_push($this->CalendarHeadingStartTagStyle, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['HeadingStartTagStyle']);
		array_push($this->CalendarHeadingStartTagClass, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['HeadingStartTagClass']);
		
		array_push($this->CalendarAlign, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarAlign']);
		array_push($this->CalendarChar, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarChar']);
		array_push($this->CalendarCharoff, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarCharoff']);
		array_push($this->CalendarValign, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarValign']);

		array_push($this->CalendarClass, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarClass']);
		array_push($this->CalendarDir, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarDir']);
		array_push($this->CalendarId, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarId']);
		array_push($this->CalendarLang, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarLang']);
		array_push($this->CalendarStyle, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarStyle']);
		array_push($this->CalendarTitle, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarTitle']);
		array_push($this->CalendarXMLLang, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['CalendarXMLLang']);
		
		array_push($this->CalendarEnableDisable, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['Enable/Disable']);
		array_push($this->CalendarStatus, $this->CalendarLookupTableName[$calendartablename][$calendarname][$i]['Status']);
	}
	
	protected function TableElement ($i) {
		// TABLE TAG ATTRIBUTES
		// OPTIONAL ATTRIBUTES
		if ($this->CalendarTableBorder[$i]) {
			$this->Writer->writeAttribute('border', $this->CalendarTableBorder[$i]);
		}
		if ($this->CalendarTableCellPadding[$i]) {
			$this->Writer->writeAttribute('cellpadding', $this->CalendarTableCellPadding[$i]);
		}
		if ($this->CalendarTableCellSpacing[$i]) {
			$this->Writer->writeAttribute('cellspacing', $this->CalendarTableCellSpacing[$i]);
		}
		if ($this->CalendarTableFrame[$i]) {
			$this->Writer->writeAttribute('frame', $this->CalendarTableFrame[$i]);
		}
		if ($this->CalendarTableRules[$i]) {
			$this->Writer->writeAttribute('rules', $this->CalendarTableRules[$i]);
		}
		if ($this->CalendarTableSummary[$i]) {
			$this->Writer->writeAttribute('summary', $this->CalendarTableSummary[$i]);
		}
		if ($this->CalendarTableWidth[$i]) {
			$this->Writer->writeAttribute('width', $this->CalendarTableWidth[$i]);
		}
		
		// STANDARD ATTRIBUTES
		if ($this->CalendarTableClass[$i]) {
			$this->Writer->writeAttribute('class', $this->CalendarTableClass[$i]);
		}
		if ($this->CalendarTableDir[$i]) {
			$this->Writer->writeAttribute('dir', $this->CalendarTableDir[$i]);
		}
		if ($this->CalendarTableId[$i]) {
			$this->Writer->writeAttribute('id', $this->CalendarTableId[$i]);
		}
		if ($this->CalendarTableLang[$i]) {
			$this->Writer->writeAttribute('lang', $this->CalendarTableLang[$i]);
		}
		if ($this->CalendarTableStyle[$i]) {
			$this->Writer->writeAttribute('style', $this->CalendarTableStyle[$i]);
		}
		if ($this->CalendarTableTitle[$i]) {
			$this->Writer->writeAttribute('title', $this->CalendarTableTitle[$i]);
		}
		if ($this->CalendarTableXMLLang[$i]) {
			$this->Writer->writeAttribute('xml:lang', $this->CalendarTableXMLLang[$i]);
		}
	}
	
	protected function TableRow ($i) {
		// ATTRIBUTES FOR TR TAG
		// OPTIONAL ATTRIBUTES
		if ($this->CalendarAlign[$i]){
			$this->Writer->writeAttribute('align', $this->CalendarAlign[$i]);
		}
		if ($this->CalendarChar[$i]) {
			$this->Writer->writeAttribute('char', $this->CalendarChar[$i]);
		}
		if ($this->CalendarCharoff[$i]) {
			$this->Writer->writeAttribute('charoff', $this->CalendarCharoff[$i]);
		}
		if ($this->CalendarValign[$i]) {
			$this->Writer->writeAttribute('valign', $this->CalendarValign[$i]);
		}
		
		// STANDARD ATTRIBUTES
		if ($this->CalendarClass[$i]) {
			$this->Writer->writeAttribute('class', $this->CalendarClass[$i]);
		}
		if ($this->CalendarDir[$i]) {
			$this->Writer->writeAttribute('dir', $this->CalendarDir[$i]);
		}
		if ($this->CalendarId[$i]) {
			$this->Writer->writeAttribute('id', $this->CalendarId[$i]);
		}
		if ($this->CalendarLang[$i]) {
			$this->Writer->writeAttribute('lang', $this->CalendarLang[$i]);
		}
		if ($this->CalendarStyle[$i]) {
			$this->Writer->writeAttribute('style', $this->CalendarStyle[$i]);
		}
		if ($this->CalendarTitle[$i]) {
			$this->Writer->writeAttribute('title', $this->CalendarTitle[$i]);
		}
		if ($this->CalendarXMLLang[$i]) {
			$this->Writer->writeAttribute('xml:lang', $this->CalendarXMLLang[$i]);
		}
		
	}
	
	protected function TableCell() {
		// ATTRIBUTES FOR TD TAG
		// OPTIONAL ATTRIBUTES
		//$this->Writer->writeAttribute('abbr', NULL);
		//$this->Writer->writeAttribute('align', NULL);
		//$this->Writer->writeAttribute('axis', NULL);
		//$this->Writer->writeAttribute('char', NULL);
		//$this->Writer->writeAttribute('charoff', NULL);
		//$this->Writer->writeAttribute('colspan', NULL);
		//$this->Writer->writeAttribute('rowspan', NULL);
		//$this->Writer->writeAttribute('scope', NULL);
		//$this->Writer->writeAttribute('valign', NULL);
		
		// STANDARD ATTRIBUTES
		//$this->Writer->writeAttribute('class', NULL);
		//$this->Writer->writeAttribute('dir', NULL);
		//$this->Writer->writeAttribute('id', NULL);
		//$this->Writer->writeAttribute('lang', NULL);
		//$this->Writer->writeAttribute('style', NULL);
		//$this->Writer->writeAttribute('title', NULL);
		//$this->Writer->writeAttribute('xml:lang', NULL);
	}
	
	protected function TableWeek(array $week, $i) {
		if ($this->CalendarEnableDisable[$i] == 'Enable' && $this->CalendarStatus[$i] == 'Approved'){
			$this->Writer->startElement('tr');
				$this->TableRow($i);
				reset($week);
				$max = count($week);
				$i = 0;
				while ($i < $max) {
					$this->Writer->startElement('td');
						$this->Writer->text(current($week));
					$this->Writer->endElement();
					next($week);
					$i++;
				}
			$this->Writer->endElement();
		}
	}
	protected function DayWeek($week, $day, $dayofweek, $daysinmonth) {
		/*$hold = NULL;
		if ($day == $this->CurrentDay) {
			$hold = '<b>';
			$hold .= $day;
			$hold .= '</b>';
		}
		*/
		if ($day <= $daysinmonth) {
			$week[$dayofweek] = $day;
		}
		
		reset($week);
		$max = count($week);
		$max2 = 0;
		$max3 = 0;
		
		$i = 0;
		while ($i < $max) {
			if (key($week) == $dayofweek) {
				$max3 = $i;
				$max2 = $max - $i;
				$i = $max;
			} else {
				next($week);
				$i++;
			}
		}
		
		$i = 0;
		$daytemp = $day;
		while ($i < $max2) {
			if ($i == 0) {
				if ($daytemp <= $daysinmonth) {
					$week[key($week)] = $daytemp++;
				}
			} else if ($daytemp < 10) {
				$week[key($week)] = '0' . $daytemp++;
			} else {
				if ($daytemp <= $daysinmonth) {
					$week[key($week)] = $daytemp++;
				}
			}
			next($week);
			$i++;
		}
		
		reset($week);
		$i = 0;
		
		$day = $day - $max3;
		while ($i < $max3) {
			if ($day >= 10) {
				if ($day > $daysinmonth) {
					$i = $max3;
				} else {
					$week[key($week)] = $day++;
				}
			} else if ($day >= 1) {
				$week[key($week)] = '0' . $day++;
			} else {
				$day++;
			}
			next($week);
			$i++;
		}
		
		$hold = implode($week);
		if ($hold) {
			return $week;
		} else {
			return NULL;
		}
	}
	
	public function CreateOutput($space) {
		$i = 0;
		while ($this->CalendarTableNames[$i] && $this->CalendarTableEnableDisable[$i] == 'Enable' && $this->CalendarTableStatus[$i] == 'Approved') {
			$this->Writer->startElement('table');
				$this->TableElement($i);
				$this->Writer->startElement('tr');
					$this->TableRow($i);
					$this->Writer->startElement('td');
						if ($this->CalendarDay[$i]) {
							$this->Writer->writeAttribute('colspan', '4');
						} else {
							$this->Writer->writeAttribute('colspan', '7');
						}
						$text = NULL;
						if ($this->CalendarMonth[$i]) {
							if ($this->CalendarMonth[$i] == 'Current') {
								$text .= $this->CurrentMonth;
							} else {
								$text .= $this->CalendarMonth[$i];
							}
							if (!$this->CalendarDay[$i] && $this->CalendarYear[$i]) {
								$text .= ', ';
							} else if ($this->CalendarYear[$i]) {
								$text .= ' ';
							}
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
					$this->Writer->endElement();
				$this->Writer->endElement();
				
				$week = array();
				$week['Sunday'] = NULL;
				$week['Monday'] = NULL;
				$week['Tuesday'] = NULL;
				$week['Wednesday'] = NULL;
				$week['Thursday'] = NULL;
				$week['Friday'] = NULL;
				$week['Saturday'] = NULL;
				if ($this->CalendarDay[$i]) {
					$this->TableWeek($this->AppointmentColumns, $i);
				} else {
					$this->TableWeek($this->DaysOfTheWeek, $i);
				}
				
				if ($this->CurrentDay > 7) {
					$day = 0;
					$day .= $this->CurrentDay - 7;
				} else if ($this->CurrentDay > 14){
					$day = $this->CurrentDay - 14;
				} else if ($this->CurrentDay > 21) {
					$day = $this->CurrentDay - 21;
				} else {
					$day = $this->CurrentDay;
				}
				if ($this->CalendarDay[$i]) {
				
				} else {
					$j = 0;
					while ($j < 5) {
						$newweek = $this->DayWeek($week, $day, $this->CurrentDayOfWeek, date('t'));
						if ($newweek) {
							$this->TableWeek($newweek, $i);
							$day = $day + 7;
							$j++;
						} else {
							$j = 10;
						}
					}
				}
			$this->Writer->endElement();
			$i++;
		}
		
		/*reset($this->PageID);
		while (current($this->PageID)) {
			$PageId = current($this->PageID);
			$Loc = current($this->Loc);
			$Lastmod = current($this->Lastmod);
			$ChangeFreq = current($this->ChangeFreq);
			$Priority = current($this->Priority);
			$EnableDisable = current($this->EnableDisable);
			$Status = current($this->Status);
			
			if ($EnableDisable == 'Enable' & $Status == 'Approved') {
				$this->Writer->startElement('url');
				if ($Loc) {
					$this->Writer->startElement('loc');
					$this->Writer->text($Loc);
					$this->Writer->endElement();
				}
				
				if ($Lastmod) {
					$this->Writer->startElement('lastmod');
					$this->Writer->text($Lastmod);
					$this->Writer->endElement();
				}
				
				if ($ChangeFreq) {
					$this->Writer->startElement('changefreq');
					$this->Writer->text($ChangeFreq);
					$this->Writer->endElement();
				}
				
				if ($Priority) {
					$this->Writer->startElement('priority');
					$this->Writer->text($Priority);
					$this->Writer->endElement();
				}
				
				$this->Writer->endElement();
			}
			next($this->PageID);
			next($this->Loc);
			next($this->Lastmod);
			next($this->ChangeFreq);
			next($this->Priority);
			next($this->EnableDisable);
			next($this->Status);
		}
		$this->Writer->endElement();
		$this->Writer->endDocument();
		*/
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->CalendarTable = $this->Writer->flush();
		}
		
	}
	
	public function getOutput() {
		return $this->CalendarTable;
	}
}
?>