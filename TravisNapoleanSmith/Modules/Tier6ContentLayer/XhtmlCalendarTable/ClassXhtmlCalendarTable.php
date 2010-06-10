<?php

class XhtmlCalendarTable extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $TableNames = array();
	protected $CalendarLookupTableName = array();
	protected $CalendarAppointments = array();
	
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
	protected $CalendarTableID = array();
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
	protected $CalendarID = array();
	protected $CalendarLang = array();
	protected $CalendarStyle = array();
	protected $CalendarTitle = array();
	protected $CalendarXMLLang = array();
	
	// Calendars
	protected $CalendarEnableDisable = array();
	protected $CalendarStatus = array();
	
	// Appointments
	protected $AppointmentDay = array();
	protected $AppointmentMonth = array();
	protected $AppointmentYear = array();
	protected $AppointmentStartTime = array();
	protected $AppointmentStartTimeAmPm = array();
	protected $AppointmentStartTimeZone = array();
	protected $AppointmentEndTime = array();
	protected $AppointmentEndtimeAmPm = array();
	protected $AppointmentEndTimeZone = array();
	protected $Appointment = array();
	
	// Appointments Optional Attributes
	protected $AppointmentAbbr = array();
	protected $AppointmentAlign = array();
	protected $AppointmentAxis = array();
	protected $AppointmentChar = array();
	protected $AppointmentCharoff = array();
	protected $AppointmentColSpan = array();
	protected $AppointmentHeaders = array();
	protected $AppointmentRowSpan = array();
	protected $AppointmentScope = array();
	protected $AppointmentValign = array();
	
	// Appointments Standard Attributes
	protected $AppointmentClass = array();
	protected $AppointmentDir = array();
	protected $AppointmentID = array();
	protected $AppointmentLang = array();
	protected $AppointmentStyle = array();
	protected $AppointmentTitle = array();
	protected $AppointmentXMLLang = array();
	
	// Appointments
	protected $AppointmentEnableDisable = array();
	protected $AppointmentStatus = array();
	
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
	protected $AppointmentDayColumns = array();
	
	protected $Day;
	protected $Month;
	protected $Year;
	
	protected $CalendarTable;
	
	public function __construct($tablenames, $databaseoptions) {
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
		
		$this->AppointmentDayColumns['Day'] = 'Day';
		//$this->AppointmentDayColumns['Month'] = 'Month';
		//$this->AppointmentDayColumns['Year'] = 'Year';
		$this->AppointmentDayColumns['Start Time'] = 'Start Time';
		$this->AppointmentDayColumns['End Time'] = 'End Time';
		$this->AppointmentDayColumns['Appointment'] = 'Appointment';
		
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlCalendarTable'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlCalendarTable'][$hold];
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
		
		if ($databaseoptions['PrintPreview']) {
			$this->PrintPreview = $databaseoptions['PrintPreview'];
			unset($databaseoptions['PrintPreview']);
		}
		
		if ($databaseoptions['Day']) {
			$this->Day = $databaseoptions['Day'];
			unset($databaseoptions['Day']);
		}
		
		if ($databaseoptions['Month']) {
			$this->Month = $databaseoptions['Month'];
			unset($databaseoptions['Month']);
		}
		
		if ($databaseoptions['Year']) {
			$this->Year = $databaseoptions['Year'];
			unset($databaseoptions['Year']);
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
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function FetchDatabase ($PageID) {
		$this->PrintPreview = $PageID['PrintPreview'];
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		
		unset($PageID['RevisionID']);
		unset($PageID['CurrentVersion']);
		
		while (current($this->TableNames)) {
			$this->LayerModule->Connect(current($this->TableNames));
			$this->LayerModule->pass (current($this->TableNames), 'setEntireTable', array());
			$this->LayerModule->Disconnect(current($this->TableNames));
			$this->CalendarLookupTableName[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getEntireTable', array());
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
				array_push($this->CalendarTableID, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarID']);
				array_push($this->CalendarTableLang, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarLang']);
				array_push($this->CalendarTableStyle, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarStyle']);
				array_push($this->CalendarTableTitle, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarTitle']);
				array_push($this->CalendarTableXMLLang, $this->CalendarLookupTableName[current($this->TableNames)][$i]['CalendarXMLLang']);
				array_push($this->CalendarTableEnableDisable, $this->CalendarLookupTableName[current($this->TableNames)][$i]['Enable/Disable']);
				array_push($this->CalendarTableStatus, $this->CalendarLookupTableName[current($this->TableNames)][$i]['Status']);
				
				$this->LayerModule->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
				$j = $i-1;
				$this->LayerModule->Connect($this->CalendarTableNames[$j]);
				$this->LayerModule->pass ($this->CalendarTableNames[$j], 'setDatabaseField', array('idnumber' => $passarray));
				$this->LayerModule->pass ($this->CalendarTableNames[$j], 'setDatabaseRow', array('idnumber' => $passarray));
				$this->LayerModule->Disconnect($this->CalendarTableNames[$j]);
				$this->processCalendars ($this->CalendarTableNames[$j]);
				$i++;
			}
			
			next($this->TableNames);
		}
		$i = 0;
		$pageid = NULL;
		
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
		
		while ($this->CalendarAppointmentNames[$i]) {
			$this->LayerModule->Connect($this->CalendarAppointmentNames[$i]);
			if (!$pageid['Day']) {
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			} else {
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			}
			$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseField', array('idnumber' => $passarray));
			$this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect($this->CalendarAppointmentNames[$i]);
			$this->CalendarAppointments[$this->CalendarAppointmentNames[$i]] = $this->LayerModule->pass ($this->CalendarAppointmentNames[$i], 'getMultiRowField', array());
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
		}
	}
	
	protected function processCalendars ($calendarname) {
		array_push($this->CalendarPageID, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'PageID')));
		array_push($this->CalendarObjectID, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'ObjectID')));
		array_push($this->CalendarAppointmentNames, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarAppointmentName')));
		array_push($this->CalendarDay, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'Day')));
		array_push($this->CalendarMonth, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'Month')));
		array_push($this->CalendarYear, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'Year')));
		array_push($this->CalendarHeadingStartTag, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTag')));
		array_push($this->CalendarHeadingEndTag, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingEndTag')));
		array_push($this->CalendarHeadingStartTagID, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTagID')));
		array_push($this->CalendarHeadingStartTagStyle, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTagStyle')));
		array_push($this->CalendarHeadingStartTagClass, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTagClass')));
		
		array_push($this->CalendarAlign, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarAlign')));
		array_push($this->CalendarChar, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarChar')));
		array_push($this->CalendarCharoff, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarCharoff')));
		array_push($this->CalendarValign, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarValign')));
		
		array_push($this->CalendarClass, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarClass')));
		array_push($this->CalendarDir, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarDir')));
		array_push($this->CalendarID, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarID')));
		array_push($this->CalendarLang, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarLang')));
		array_push($this->CalendarStyle, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarStyle')));
		array_push($this->CalendarTitle, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarTitle')));
		array_push($this->CalendarXMLLang, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarXMLLang')));
		
		array_push($this->CalendarEnableDisable, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'Enable/Disable')));
		array_push($this->CalendarStatus, $this->LayerModule->pass ($calendarname, 'getRowField', array('rowfield' => 'Status')));
	}
	
	protected function processAppointments ($calendarappointmentname, $i) {
		$j = 0;
		while ($this->CalendarAppointments[$calendarappointmentname][$j]) {
			
			// Appointments
			$this->AppointmentDay[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['Day'];
			$this->AppointmentMonth[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['Month'];
			$this->AppointmentYear[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['Year'];
			$this->AppointmentStartTime[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['StartTime'];
			$this->AppointmentStartTimeAmPm[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['StartTimeAmPm'];
			$this->AppointmentStartTimeZone[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['StartTimeZone'];
			$this->AppointmentEndTime[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['EndTime'];
			$this->AppointmentEndtimeAmPm[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['EndTimeAmPm'];
			$this->AppointmentEndTimeZone[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['EndTimeZone'];
			$this->Appointment[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['Appointment'];
			
			// Appointment Optional Attributes
			$this->AppointmentAbbr[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentAbbr'];
			$this->AppointmentAlign[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentAlign'];
			$this->AppointmentAxis[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentAxis'];
			$this->AppointmentChar[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentChar'];
			$this->AppointmentCharoff[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentCharoff'];
			$this->AppointmentColSpan[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentColSpan'];
			$this->AppointmentHeaders[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentHeaders'];
			$this->AppointmentRowSpan[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentRowSpan'];
			$this->AppointmentScope[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentScope'];
			$this->AppointmentValign[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentValign'];
			
			// Appointment Standard Attributes
			$this->AppointmentClass[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentClass'];
			$this->AppointmentDir[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentDir'];
			$this->AppointmentID[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentID'];
			$this->AppointmentLang[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentLang'];
			$this->AppointmentStyle[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentStyle'];
			$this->AppointmentTitle[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentTitle'];
			$this->AppointmentXMLLang[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentXMLLang'];
			
			$this->AppointmentEnableDisable[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['Enable/Disable'];
			$this->AppointmentStatus[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['Status'];
			$j++;
		}
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
		if ($this->CalendarTableID[$i]) {
			$this->Writer->writeAttribute('id', $this->CalendarTableID[$i]);
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
		if ($this->CalendarID[$i]) {
			$this->Writer->writeAttribute('id', $this->CalendarID[$i]);
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
	
	protected function TableCell($i, $j) {
		// ATTRIBUTES FOR TD TAG
		// OPTIONAL ATTRIBUTES
		if ($this->AppointmentAbbr[$i][$j]) {
			$this->Writer->writeAttribute('abbr', $this->AppointmentAbbr[$i][$j]);
		}
		if ($this->AppointmentAlign[$i][$j]) {
			$this->Writer->writeAttribute('align', $this->AppointmentAlign[$i][$j]);
		}
		if ($this->AppointmentAxis[$i][$j]) {
			$this->Writer->writeAttribute('axis', $this->AppointmentAxis[$i][$j]);
		}
		if ($this->AppointmentChar[$i][$j]) {
			$this->Writer->writeAttribute('char', $this->AppointmentChar[$i][$j]);
		}
		if ($this->AppointmentCharoff[$i][$j]) {
			$this->Writer->writeAttribute('charoff', $this->AppointmentCharoff[$i][$j]);
		}
		if ($this->AppointmentColSpan[$i][$j]) {
			$this->Writer->writeAttribute('colspan', $this->AppointmentColSpan[$i][$j]);
		}
		if ($this->AppointmentHeaders[$i][$j]) {
			$this->Writer->writeAttribute('headers', $this->AppointmentHeaders[$i][$j]);
		}
		if ($this->AppointmentRowSpan[$i][$j]) {
			$this->Writer->writeAttribute('rowspan', $this->AppointmentRowSpan[$i][$j]);
		}
		if ($this->AppointmentScope[$i][$j]) {
			$this->Writer->writeAttribute('scope', $this->AppointmentScope[$i][$j]);
		}
		if ($this->AppointmentValign[$i][$j]) {
			$this->Writer->writeAttribute('valign', $this->AppointmentValign[$i][$j]);
		}
			
		// STANDARD ATTRIBUTES
		if ($this->AppointmentClass[$i][$j]) {
			$this->Writer->writeAttribute('class', $this->AppointmentClass[$i][$j]);
		}
		if ($this->AppointmentDir[$i][$j]) {
			$this->Writer->writeAttribute('dir', $this->AppointmentDir[$i][$j]);
		}
		if ($this->AppointmentID[$i][$j]) {
			$this->Writer->writeAttribute('id', $this->AppointmentID[$i][$j]);
			
		}
		if ($this->AppointmentLang[$i][$j]) {
			$this->Writer->writeAttribute('lang', $this->AppointmentLang[$i][$j]);
		}
		if ($this->AppointmentStyle[$i][$j]) {
			$this->Writer->writeAttribute('style', $this->AppointmentStyle[$i][$j]);
		}
		if ($this->AppointmentTitle[$i][$j]) {
			$this->Writer->writeAttribute('title', $this->AppointmentTitle[$i][$j]);
		}
		if ($this->AppointmentXMLLang[$i][$j]) {
			$this->Writer->writeAttribute('xml:lang', $this->AppointmentXMLLang[$i][$j]);
		}
		
	}
	
	protected function FirstDayOfMonth ($month, $year) {
		if ($year == 'Current') {
			$year = $this->CurrentYear;
		}
		$firstdayofmonth = getdate(mktime(0, 0, 0, $month, 1, $year));
		$dayofweek = $firstdayofmonth['weekday'];
		return $dayofweek;
	}
	
	protected function LastDayOfMonth ($month, $year) {
		if ($year == 'Current') {
			$year = $this->CurrentYear;
		}
		$lastdayofmonth = getdate(mktime(0, 0, 0, $month, 0, $year));
		$lastday = $lastdayofmonth['mday'];
		return $lastday;
	}
	
	protected function getCalendarMonthNumber ($month) {
		if ($month == 'Current') {
			$month = $this->CurrentMonth;
		}
		if ($month == 'January') {
			return 1;
		}
		if ($month == 'February') {
			return 2;
		}
		if ($month == 'March') {
			return 3;
		}
		if ($month == 'April') {
			return 4;
		}
		if ($month == 'May') {
			return 5;
		}
		if ($month == 'June') {
			return 6;
		}
		if ($month == 'July') {
			return 7;
		}
		if ($month == 'August') {
			return 8;
		}
		if ($month == 'September') {
			return 9;
		}
		if ($month == 'October') {
			return 10;
		}
		if ($month == 'November') {
			return 11;
		}
		if ($month == 'December') {
			return 12;
		}
		
	}
	
	protected function TableWeek(array $week, $i) {
		$Arguments = func_num_args();
		if ($Arguments == 3) {
			$TableCell = func_get_arg(2);
		}
		if ($this->CalendarEnableDisable[$i] == 'Enable' && $this->CalendarStatus[$i] == 'Approved'){
			$this->Writer->startElement('tr');
				$this->TableRow($i);
				reset($week);
				$max = count($week);
				$j = 0;
				
				while ($j < $max) {
					$this->Writer->startElement('td');
						if (!is_null($TableCell)) {
							$this->TableCell($i, $TableCell);
						}
						$this->Writer->writeRaw(current($week));
					$this->Writer->endElement(); // ENDS TD TAG
					next($week);
					$j++;
				}
			$this->Writer->endElement(); // ENDS TR TAG
		}
	}
	protected function TableWeekHeading(array $week, $i) {
		$Arguments = func_num_args();
		if ($Arguments == 3) {
			$TableCell = func_get_arg(2);
		}
		if ($this->CalendarEnableDisable[$i] == 'Enable' && $this->CalendarStatus[$i] == 'Approved'){
			$this->Writer->startElement('tr');
				$this->TableRow($i);
				reset($week);
				$max = count($week);
				$j = 0;
				
				while ($j < $max) {
					$this->Writer->startElement('th');
						if (!is_null($TableCell)) {
							$this->TableCell($i, $TableCell);
						}
						$this->Writer->writeRaw(current($week));
					$this->Writer->endElement(); // ENDS TH TAG
					next($week);
					$j++;
				}
			$this->Writer->endElement(); // ENDS TR TAG
		}
	}
	protected function DayWeek($week, $day, $dayofweek, $daysinmonth)
	{
		if ($day < 10) {
			$hold = $day;
			$day = '0';
			$day .= "$hold";
			unset ($hold);
		}
		
		if ($day == 0) {
			$dayofweek = $this->FirstDayOfMonth(date('n'), $this->CurrentYear);
			$day = '01';
		}
		
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
	protected function DayWeekAppointment($week, $day, $dayofweek, $daysinmonth, $i) {
		if (!is_null($week)) {
			reset($week);
			while (key($week)) {
				$j = 0;				
				while ($this->AppointmentDay[$i][$j]) {
					if (current($week) == $this->AppointmentDay[$i][$j]) {
						if ($this->AppointmentEnableDisable[$i][$j] == 'Enable' && $this->AppointmentStatus[$i][$j] == 'Approved') {
							$hold = $week[key($week)];
							$appointment = $this->Appointment[$i][$j];
							$starttime = $this->AppointmentStartTime[$i][$j];
							$starttime .= $this->AppointmentStartTimeAmPm[$i][$j];
							$week[key($week)] = '<a style="font-weight: bold">';
							$week[key($week)] .= $hold;
							$week[key($week)] .= '</a>';
						}
					}
					$j++;
				}
				
				next($week);
			}
			return $week;
		} else {
			return NULL;
		}
	}
	
	protected function MakeDayWeekAppointments($i) {
		if (!is_null($this->AppointmentDay[$i])) {
			$j = 0;
			$this->Writer->startElement('table');
			$this->TableElement($i);
				$this->Writer->startElement('tr');
				$this->TableRow($i);
				$this->Writer->startElement('td');
					//$this->Writer->writeAttribute('colspan', '6');
					$this->Writer->writeAttribute('colspan', '4');
					$this->Writer->writeAttribute('align', 'center');
					$this->Writer->text('Appointments');
					$this->Writer->endElement();  // ENDS TD TAG
				$this->Writer->endElement(); // ENDS TR TAG
				$this->TableWeekHeading($this->AppointmentDayColumns, $i);
				while ($this->AppointmentDay[$i][$j]) {
					if ($this->AppointmentEnableDisable[$i][$j] == 'Enable' && $this->AppointmentStatus[$i][$j] == 'Approved') {
						$appointment = $this->Appointment[$i][$j];
						$starttime = $this->AppointmentStartTime[$i][$j];
						$starttime .= $this->AppointmentStartTimeAmPm[$i][$j];
						$endtime = $this->AppointmentEndTime[$i][$j];
						$endtime .= $this->AppointmentEndtimeAmPm[$i][$j];
						$day = $this->AppointmentDay[$i][$j];
						//$month = $this->AppointmentMonth[$i][$j];
						//$year = $this->AppointmentYear[$i][$j];
					
						$passarray = array();
						$passarray['Day'] = $day;
						//$passarray['Month'] = $month;
						//$passarray['Year'] = $year;
						$passarray['StartTime'] = $starttime;
						$passarray['EndTime'] = $endtime;
						$passarray['Appointment'] = $appointment;
						$this->TableWeek($passarray, $i, $j);
					}
					$j++;
			}
			$this->Writer->endElement(); // ENDS TABLE TAG
		}
	}
	
	protected function MakeDayAppointments($i) {
		$j = 0;
		while ($this->AppointmentDay[$i][$j]) {
			if ($this->AppointmentEnableDisable[$i][$j] == 'Enable' && $this->AppointmentStatus[$i][$j] == 'Approved') {
				$appointment = $this->Appointment[$i][$j];
				$starttime = $this->AppointmentStartTime[$i][$j];
				$starttime .= $this->AppointmentStartTimeAmPm[$i][$j];
				$endtime = $this->AppointmentEndTime[$i][$j];
				$endtime .= $this->AppointmentEndtimeAmPm[$i][$j];
				$passarray = array();
				$passarray['StartTime'] = $starttime;
				$passarray['EndTime'] = $endtime;
				$passarray['Appointment'] = $appointment;
				$this->TableWeek($passarray, $i);
			}
			$j++;
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
			$this->Writer->endElement(); // ENDS TABLE TAG
			
			if (!$this->CalendarDay[$i]) {
				$this->MakeDayWeekAppointments($i);
			}
			
			$i++;
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
}
?>