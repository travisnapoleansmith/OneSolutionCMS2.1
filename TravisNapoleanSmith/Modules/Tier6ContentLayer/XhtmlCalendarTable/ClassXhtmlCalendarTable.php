<?php

class XhtmlCalendarTable extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlCalendarTableProtectionLayer;
	
	protected $Writer;
	protected $FileName;
	/*
	protected $TableNames = array();
	protected $SitemapTables = array();
	
	protected $PageID = array();
	protected $Loc = array();
	protected $Lastmod = array();
	protected $ChangeFreq = array();
	protected $Priority = array();
	*/
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
		/*
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
		
		$this->Writer->startDocument('1.0' , 'UTF-8');
		$this->Writer->setIndent(4);
		
		$this->Writer->startElement('urlset');
		$this->Writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
		*/
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
		/*
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XhtmlCalendarTableProtectionLayer->Connect(current($this->TableNames));
			$this->XhtmlCalendarTableProtectionLayer->pass (current($this->TableNames), 'setEntireTable', array());
			$this->XhtmlCalendarTableProtectionLayer->Disconnect(current($this->TableNames));
			$this->SitemapTables[current($this->TableNames)] = $this->XhtmlCalendarTableProtectionLayer->pass (current($this->TableNames), 'getEntireTable', array());
			$i = 1;
			while ($this->SitemapTables[current($this->TableNames)][$i]['PageID']) {
				array_push($this->PageID, $this->SitemapTables[current($this->TableNames)][$i]['PageID']);
				array_push($this->Loc, $this->SitemapTables[current($this->TableNames)][$i]['Loc']);
				array_push($this->Lastmod, $this->SitemapTables[current($this->TableNames)][$i]['Lastmod']);
				array_push($this->ChangeFreq, $this->SitemapTables[current($this->TableNames)][$i]['ChangeFreq']);
				array_push($this->Priority, $this->SitemapTables[current($this->TableNames)][$i]['Priority']);
				array_push($this->EnableDisable, $this->SitemapTables[current($this->TableNames)][$i]['Enable/Disable']);
				array_push($this->Status, $this->SitemapTables[current($this->TableNames)][$i]['Status']);

				$i++;
			}
			next($this->TableNames);
		}
		*/		
	}
	
	protected function TableWeek(array $week) {
		$this->Writer->startElement('tr');
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
		// ATTRIBUTES FOR TR TAG
		// OPTIONAL ATTRIBUTES
		//$this->Writer->writeAttibute('align', NULL);
		//$this->Writer->writeAttibute('char', NULL);
		//$this->Writer->writeAttibute('charoff', NULL);
		//$this->Writer->writeAttibute('valign', NULL);
		
		// STANDARD ATTRIBUTES
		//$this->Writer->writeAttibute('class', NULL);
		//$this->Writer->writeAttibute('dir', NULL);
		//$this->Writer->writeAttibute('id', NULL);
		//$this->Writer->writeAttibute('lang', NULL);
		//$this->Writer->writeAttibute('style', NULL);
		//$this->Writer->writeAttibute('title', NULL);
		//$this->Writer->writeAttibute('xml:lang', NULL);
		//----------------------
		
		// ATTRIBUTES FOR TD TAG
		// OPTIONAL ATTRIBUTES
		//$this->Writer->writeAttibute('abbr', NULL);
		//$this->Writer->writeAttibute('align', NULL);
		//$this->Writer->writeAttibute('axis', NULL);
		//$this->Writer->writeAttibute('char', NULL);
		//$this->Writer->writeAttibute('charoff', NULL);
		//$this->Writer->writeAttibute('colspan', NULL);
		//$this->Writer->writeAttibute('rowspan', NULL);
		//$this->Writer->writeAttibute('scope', NULL);
		//$this->Writer->writeAttibute('valign', NULL);
		
		// STANDARD ATTRIBUTES
		//$this->Writer->writeAttibute('class', NULL);
		//$this->Writer->writeAttibute('dir', NULL);
		//$this->Writer->writeAttibute('id', NULL);
		//$this->Writer->writeAttibute('lang', NULL);
		//$this->Writer->writeAttibute('style', NULL);
		//$this->Writer->writeAttibute('title', NULL);
		//$this->Writer->writeAttibute('xml:lang', NULL);
		//----------------------
	}
	protected function DayWeek($week, $day, $dayofweek, $daysinmonth) {
		
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
			if ($day > 10) {
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
		$this->Writer->startElement('table');
			$this->Writer->writeAttribute('style', 'text-align=center');
			
			// TABLE TAG ATTRIBUTES
			// OPTIONAL ATTRIBUTES
			//$this->Writer->writeAttibute('border', NULL);
			//$this->Writer->writeAttibute('cellpadding', NULL);
			//$this->Writer->writeAttibute('cellspacing', NULL);
			//$this->Writer->writeAttibute('frame', NULL);
			//$this->Writer->writeAttibute('rules', NULL);
			//$this->Writer->writeAttibute('summary', NULL);
			//$this->Writer->writeAttibute('width', NULL);
			
			// STANDARD ATTRIBUTES
			//$this->Writer->writeAttibute('class', NULL);
			//$this->Writer->writeAttibute('dir', NULL);
			//$this->Writer->writeAttibute('id', NULL);
			//$this->Writer->writeAttibute('lang', NULL);
			//$this->Writer->writeAttibute('style', NULL);
			//$this->Writer->writeAttibute('title', NULL);
			//$this->Writer->writeAttibute('xml:lang', NULL);
			
			$this->Writer->startElement('tr');
				$this->Writer->startElement('td');
					$this->Writer->writeAttribute('colspan', '7');
					$this->Writer->text("$this->CurrentMonth, $this->CurrentYear");
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
			$this->TableWeek($this->DaysOfTheWeek);
			
			$day = $this->CurrentDay;
			$i = 0;
			while ($i < 5) {
				$newweek = $this->DayWeek($week, $day, $this->CurrentDayOfWeek, date('t'));
				if ($newweek) {
					$this->TableWeek($newweek);
					$day = $day + 7;
					$i++;
				} else {
					$i = 10;
				}
			}
			
		$this->Writer->endElement();
		
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