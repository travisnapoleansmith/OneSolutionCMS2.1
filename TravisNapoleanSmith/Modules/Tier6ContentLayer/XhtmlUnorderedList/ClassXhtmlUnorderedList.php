<?php

class XhtmlUnorderedList extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $DatabaseTableName;
	
	protected $Insert;
	protected $NoGlobal;
	protected $Indent;
	
	protected $Ul;
	
	// UL Standard Attributes
	protected $UlClass;
	protected $UlDir;
	protected $UlID;
	protected $UlLang;
	protected $UlStyle;
	protected $UlTitle;
	protected $UlXMLLang;
	
	protected $Li = array();
	protected $LiChildID = array();
	
	// Li Standard Attributes
	protected $LiClass = array();
	protected $LiDir = array();
	protected $LiID = array();
	protected $LiLang = array();
	protected $LiStyle = array();
	protected $LiTitle = array();
	protected $LiXMLLang = array();
	
	protected $LiEnableDisable = array();
	
	protected $List;
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlUnorderedList'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlUnorderedList'][$hold];
		$this->ErrorMessage = array();
		
		if ($databaseoptions['Insert']) {
			$this->Insert = $databaseoptions['Insert'];
			unset($databaseoptions['Insert']);
		}
		
		if ($databaseoptions['NoAttributes']) {
			$this->NoAttributes = $databaseoptions['NoAttributes'];
			unset($databaseoptions['NoAttributes']);
		}
		
		if ($databaseoptions['NoGlobal']) {
			$this->NoGlobal = $databaseoptions['NoGlobal'];
			unset($databaseoptions['NoGlobal']);
		}
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($databaseoptions['Indent']) {
			$this->Indent = $databaseoptions['Indent'];
			unset($databaseoptions['Indent']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} if ($this->NoAttibutes || $this->NoGlobal) {
			$this->Writer = new XMLWriter();
			$this->Writer->openMemory();
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
		
		
		$this->DatabaseTableName = current($tablenames);
		
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
	
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->PrintPreview = $PageID['PrintPreview'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		
		unset($PageID['RevisionID']);
		unset($PageID['CurrentVersion']);
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Ul = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Ul'));
		$this->UlClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlClass'));
		$this->UlDir = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlDir'));
		$this->UlID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlID'));
		$this->UlLang = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlLang'));
		$this->UlStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlStyle'));
		$this->UlTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlTitle'));
		$this->UlXMLLang = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlXMLLang'));

		$this->BuildLiList('Li', 'Li');
		$this->BuildLiList('LiChildID', 'LiChildID');
		
		$this->BuildLiList('LiClass', 'LiClass');
		$this->BuildLiList('LiDir', 'LiDir');
		$this->BuildLiList('LiID', 'LiID');
		$this->BuildLiList('LiLang', 'LiLang');
		$this->BuildLiList('LiStyle', 'LiStyle');
		$this->BuildLiList('LiTitle', 'LiTitle');
		$this->BuildLiList('LiXMLLang', 'LiXMLLang');
		
		$this->BuildLiList('LiEnableDisable', 'LiEnable/Disable');
	
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
	protected function BuildLiList($LiList, $LiListField) {
		if ($this->$LiList) {
			$this->$LiList = NULL;
			$this->$LiList = array();
		}
		
		if (is_array($this->$LiList)) {
			$i = 1;
			$Field = 'Li';
			$Field .= $i;
			$FieldName = str_replace('Li', $Field, $LiListField);
			while($this->LayerModule->pass ($this->DatabaseTable, 'searchFieldNames', array('rowfield' => $FieldName))) {
				$temp = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $FieldName));
				array_push($this->$LiList, $temp);
				$i++;
				$Field = 'Li';
				$Field .= $i;
				$FieldName = str_replace('Li', $Field, $LiListField);
			}
		}
	}
	
	public function CreateOutput($space) {
		$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->StartTag && !$this->NoAttributes){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					if (!$this->NoAttributes) {
						$this->ProcessStandardAttribute('StartTag');
					}
				
			}
			if ($this->Ul){
				//$this->Writer->writeRaw("\n");
				$this->Writer->writeRaw("\n    ");
				$this->Writer->writeRaw($this->CreateWordWrap($this->Ul));
				$this->Writer->writeRaw("\n");
			}
			
			$this->Writer->startElement('ul');
				if (!$this->NoAttributes) {
					$this->ProcessStandardAttribute('Ul');
				}
			if (is_array($this->Li)) {
				if (is_array($this->LiChildID)){
					if (is_array($this->LiID)){
						if (is_array($this->LiClass)){
							if (is_array($this->LiStyle)){
								if (is_array($this->LiEnableDisable)) {
									while (current($this->Li)) {
										if (current($this->LiEnableDisable) == 'Enable') {
											$this->Writer->startElement('li');
												if (!$this->NoAttributes) {
													$this->ProcessArrayStandardAttribute('Li');
												}
											if (current($this->Li)) {
												$this->Li[key($this->Li)] = $this->CreateWordWrap(current($this->Li));
												$this->Li[key($this->Li)] = trim (current($this->Li));
												if ($this->Indent) {
													$this->Writer->writeRaw("\n\t $this->Indent");
												} else {
													$this->Writer->writeRaw("\n\t ");
												}
												$this->Writer->writeRaw(current($this->Li));
												if (current($this->LiChildID)) {
													$this->Writer->writeRaw("\n");
												} else {
													$this->Writer->writeRaw("\n     ");
												}
											}
											if (current($this->LiChildID)){
												$listidnumber = array();
												$listidnumber['PageID'] = $this->PageID;
												$listidnumber['ObjectID'] = current($this->LiChildID);
												$listdatabase = array();
												$listdatabase[$this->DatabaseTableName] = $this->DatabaseTableName;
												$databaseoptions = array();
												if ($this->NoAttributes) {
													$databaseoptions['NoAttributes'] = $this->NoAttributes;
												}
												
												$databaseoptions['NoGlobal'] = FALSE;
												if ($this->Indent) {
													$databaseoptions['Indent'] = $this->Indent;
													$databaseoptions['Indent'] .= "  ";
												} else {
													$databaseoptions['Indent'] = "  ";
												}
												$list = new XhtmlUnorderedList($listdatabase, $databaseoptions);
												
												$list->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTableName);
												$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
												$list->FetchDatabase ($listidnumber);
												
												$tempspace = $this->Space;
												$tempspace .= '    ';
												$list->CreateOutput($tempspace);
												$this->Writer->writeRaw("\n");
												$this->Writer->writeRaw("   ");
											} else {
												$this->Writer->writeRaw("   ");
											}
											
											if ($this->Indent) {
												$this->Writer->writeRaw($this->Indent);
											}
											$this->Writer->endElement(); // ENDS LI
											// CHANGED
											//$this->Writer->writeRaw("\n");
										}
										next($this->Li);
										next($this->LiChildID);
										next($this->LiClass);
										next($this->LiDir);
										next($this->LiID);
										next($this->LiLang);
										next($this->LiStyle);
										next($this->LiTitle);
										next($this->LiXMLLang);
										next($this->LiEnableDisable);
									}
								} else {
									array_push($this->ErrorMessage,'CreateOutput: LiEnableDisable must be an Array!');
								}
							} else {
								array_push($this->ErrorMessage,'CreateOutput: LiStyle must be an Array!');
							}
						} else {
							array_push($this->ErrorMessage,'CreateOutput: LiClass must be an Array!');
						}
					} else {
						array_push($this->ErrorMessage,'CreateOutput: LiID must be an Array!');
					}
				} else {
					array_push($this->ErrorMessage,'CreateOutput: LiChildID must be an Array!');
				}
			} else {
				array_push($this->ErrorMessage,'CreateOutput: Li must be an Array!');
			}
			
			$this->Writer->endElement(); // ENDS UL
			
			if ($this->Insert) {
				$this->Writer->writeRaw(' ');
				$this->Writer->writeRaw($this->Insert); // WRITES INSERT
				$this->Writer->writeRaw("\n ");
			}
			
			if ($this->EndTag && !$this->NoAttributes) {
				$this->Writer->endElement(); // ENDS END TAG
			}
			
		}
		if ($this->FileName) {
			$this->Writer->flush();
		}
		
		if ($this->NoAttributes || $this->NoGlobal) {
			$this->List = $this->Writer->flush();
		}
		
	}
	
	public function getOutput() {
		return $this->List;
	}
}
?>