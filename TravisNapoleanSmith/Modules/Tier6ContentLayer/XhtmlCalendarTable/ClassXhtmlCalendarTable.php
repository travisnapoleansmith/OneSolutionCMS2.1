<?php

class XhtmlCalendarTable extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlCalendarTableProtectionLayer;
	
	protected $Writer;
	protected $FileName;
	
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
	protected $AppointmentId = array();
	protected $AppointmentLang = array();
	protected $AppiointmentStyle = array();
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
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
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
		
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		
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
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarTableNames[$j], 'setDatabaseField', array('idnumber' => $passarray));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarTableNames[$j], 'setDatabaseRow', array('idnumber' => $passarray));
				$this->XhtmlCalendarTableProtectionLayer->Disconnect($this->CalendarTableNames[$j]);
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
		$pageid['Month'] = $this->CalendarMonth[$i];
		$pageid['Year'] = $this->CalendarYear[$i];
		$passarray = $pageid;
		
		while ($this->CalendarAppointmentNames[$i]) {
			$this->XhtmlCalendarTableProtectionLayer->Connect($this->CalendarAppointmentNames[$i]);
			if (!$pageid['Day']) {
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			} else {
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			}
			$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseField', array('idnumber' => $passarray));
			$this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseRow', array('idnumber' => $passarray));
			$this->XhtmlCalendarTableProtectionLayer->Disconnect($this->CalendarAppointmentNames[$i]);
			$this->CalendarAppointments[$this->CalendarAppointmentNames[$i]] = $this->XhtmlCalendarTableProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'getMultiRowField', array());
			$this->processAppointments($this->CalendarAppointmentNames[$i], $i);
			$i++;
			if ($this->CalendarDay[$i] == 'Current') {
				$pageid['Day'] = $this->CurrentDay;
			} else if ($this->CalendarDay[$i]) {
				$pageid['Day'] = $this->CalendarDay[$i];
			}
			$pageid['Month'] = $this->CalendarMonth[$i];
			$pageid['Year'] = $this->CalendarYear[$i];
			
			$passarray = $pageid;
		}
	}
	
	protected function processCalendars ($calendarname) {
		array_push($this->CalendarPageID, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'PageID')));
		array_push($this->CalendarObjectID, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'ObjectID')));
		array_push($this->CalendarAppointmentNames, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarAppointmentName')));
		array_push($this->CalendarDay, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'Day')));
		array_push($this->CalendarMonth, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'Month')));
		array_push($this->CalendarYear, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'Year')));
		array_push($this->CalendarHeadingStartTag, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTag')));
		array_push($this->CalendarHeadingEndTag, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingEndTag')));
		array_push($this->CalendarHeadingStartTagID, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTagID')));
		array_push($this->CalendarHeadingStartTagStyle, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTagStyle')));
		array_push($this->CalendarHeadingStartTagClass, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'HeadingStartTagClass')));
		
		array_push($this->CalendarAlign, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarAlign')));
		array_push($this->CalendarChar, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarChar')));
		array_push($this->CalendarCharoff, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarCharoff')));
		array_push($this->CalendarValign, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarValign')));
		
		array_push($this->CalendarClass, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarClass')));
		array_push($this->CalendarDir, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarDir')));
		array_push($this->CalendarId, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarId')));
		array_push($this->CalendarLang, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarLang')));
		array_push($this->CalendarStyle, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarStyle')));
		array_push($this->CalendarTitle, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarTitle')));
		array_push($this->CalendarXMLLang, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'CalendarXMLLang')));
		
		array_push($this->CalendarEnableDisable, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'Enable/Disable')));
		array_push($this->CalendarStatus, $this->XhtmlCalendarTableProtectionLayer->pass ($calendarname, 'getRowField', array('rowfield' => 'Status')));
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
			$this->AppointmentEndtimeAmPm[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['EndtimeAmPm'];
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
			$this->AppointmentId[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentId'];
			$this->AppointmentLang[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentLang'];
			$this->AppiointmentStyle[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentStyle'];
			$this->AppointmentTitle[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentTitle'];
			$this->AppointmentXMLLang[$i][$j] = $this->CalendarAppointments[$calendarappointmentname][$j]['AppointmentXMLLang'];
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
		if ($this->AppointmentId[$i][$j]) {
			$this->Writer->writeAttribute('id', $this->AppointmentId[$i][$j]);
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
		$firstdayofmonth = getdate(mktime(0, 0, 0, $month, 1, $year));
		$dayofweek = $firstdayofmonth['weekday'];
		return $dayofweek;
	}
	
	protected function LastDayOfMonth ($month, $year) {
		$lastdayofmonth = getdate(mktime(0, 0, 0, $month, 0, $year));
		$lastday = $lastdayofmonth['mday'];
		return $lastday;
	}
	
	protected function getCalendarMonthNumber ($month) {
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
		if ($this->CalendarEnableDisable[$i] == 'Enable' && $this->CalendarStatus[$i] == 'Approved'){
			$this->Writer->startElement('tr');
				$this->TableRow($i);
				reset($week);
				$max = count($week);
				$j = 0;
				while ($j < $max) {
					$this->Writer->startElement('td');
						$this->Writer->writeRaw(current($week));
					$this->Writer->endElement();
					next($week);
					$j++;
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
		reset($week);
		while (current($week)) {
			$j = 0;
			while ($this->AppointmentDay[$i][$j]) {
				if (current($week) == $this->AppointmentDay[$i][$j]) {
					$hold = $week[key($week)];
					$appointment = $this->Appointment[$i][$j];
					$starttime = $this->AppointmentStartTime[$i][$j];
					$starttime .= $this->AppointmentStartTimeAmPm[$i][$j];
					$week[key($week)] = '<a style="font-weight: bold">';
					$week[key($week)] .= $hold;
					$week[key($week)] .= '</a>';
					//$week[key($week)] .= "- $appointment at $starttime";
				}
				$j++;
			}
			
			next($week);
		}
		return $week;
	}
	
	protected function BuildAppointmentTree($day) {
		//print "$day\n";
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
				
				if ($this->CalendarMonth[$i] == $this->CurrentMonth && $this->CalendarYear[$i] == $this->CurrentYear) {
					if ($this->CurrentDay >= 21) {
						$day = $this->CurrentDay - 21;	
					} else if ($this->CurrentDay >= 14){
						$day = $this->CurrentDay - 14;
					} else if ($this->CurrentDay >= 7) {
						$day = 0;
						$day .= $this->CurrentDay - 7;
					} else {
						$day = $this->CurrentDay;
					}
					
					if ($this->CalendarDay[$i] | !$this->CalendarDay[$i] == 'Current') {
						
					} else if ($this->CalendarDay[$i] == 'Current') {
						$this->BuildAppointmentTree($this->CurrentDay);
					} else {
						$j = 0;
						while ($j < 5) {
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
					}
				} else {
					$firstday = $this->FirstDayOfMonth ($this->getCalendarMonthNumber ($this->CalendarMonth[$i]), $this->CalendarYear[$i]);
					$lastday = $this->LastDayOfMonth ($this->getCalendarMonthNumber ($this->CalendarMonth[$i]), $this->CalendarYear[$i]);
					$day = 1;
					
					if ($this->CalendarDay[$i]) {
						
					} else {
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
			$this->Writer->endElement();
			$i++;
		}
		
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