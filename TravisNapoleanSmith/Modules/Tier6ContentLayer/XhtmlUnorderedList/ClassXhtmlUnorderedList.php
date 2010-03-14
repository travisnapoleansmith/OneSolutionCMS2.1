<?php

class XhtmlUnorderedList extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $ListProtectionLayer;
	protected $DatabaseTableName;
	
	protected $Insert;
	
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
	
	public function __construct($tablenames, $database) {
		$this->ListProtectionLayer = &$database;
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->Insert = $tablenames['Insert'];
		unset($tablenames['Insert']);
		
		$this->GlobalWriter = $tablenames['GlobalWriter'];
		unset($tablenames['GlobalWriter']);
		
		$this->DatabaseTableName = current($tablenames);

		if ($this->GlobalWriter) {
			$this->Writer = $this->GlobalWriter;
		} else {
			$this->Writer = new XMLWriter();
			if ($this->FileName) {
				$this->Writer->openURI($this->FileName);
			} else {
				$this->Writer->openMemory();
			}
			$this->Writer->setIndent(3);
		}
		
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user; 
		$this->Password = $password; 
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->ListProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ListProtectionLayer->setDatabasetable ($databasetable);
	}
	
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->PrintPreview = $PageID['PrintPreview'];
		unset ($PageID['PrintPreview']);
		
		$this->ListProtectionLayer->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		$this->ListProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->ListProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->StartTag = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Ul = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Ul'));
		$this->UlClass = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlClass'));
		$this->UlDir = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlDir'));
		$this->UlID = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlID'));
		$this->UlLang = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlLang'));
		$this->UlStyle = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlStyle'));
		$this->UlTitle = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlTitle'));
		$this->UlXMLLang = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlXMLLang'));

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
	
		$this->EnableDisable = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->ListProtectionLayer->Disconnect($this->DatabaseTable);
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
			while($this->ListProtectionLayer->pass ($this->DatabaseTable, 'searchFieldNames', array('rowfield' => $FieldName))) {
				$temp = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $FieldName));
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
			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					if ($this->StartTagID) {
						$this->Writer->writeAttribute('id', $this->StartTagID);
					}
					if ($this->StartTagStyle) {
						$this->Writer->writeAttribute('style', $this->StartTagStyle);
					}
					if ($this->StartTagClass) {
						$this->Writer->writeAttribute('class', $this->StartTagClass);
					}
			}
			if ($this->Ul){
				$this->Writer->writeRaw("\n ");
				$this->Writer->writeRaw($this->CreateWordWrap($this->Ul));
				$this->Writer->writeRaw("\n");
			}
			
			$this->Writer->startElement('ul');
				if ($this->UlClass) {
					$this->Writer->writeAttribute('class', $this->UlClass);
				}
				if ($this->UlDir) {
					$this->Writer->writeAttribute('dir', $this->UlDir);
				}
				if ($this->UlID) {
					$this->Writer->writeAttribute('id', $this->UlID);
				}
				if ($this->UlLang) {
					$this->Writer->writeAttribute('lang', $this->UlLang);
				}
				if ($this->UlStyle) {
					$this->Writer->writeAttribute('style', $this->UlStyle);
				}
				if ($this->UlTitle) {
					$this->Writer->writeAttribute('title', $this->UlTitle);
				}
				if ($this->UlXMLLang) {
					$this->Writer->writeAttribute('xmllang', $this->UlXMLLang);
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
												if (current($this->LiClass)) {
													$this->Writer->writeAttribute('class', current($this->LiClass));
												}
												if (current($this->LiDir)) {
													$this->Writer->writeAttribute('dir', current($this->LiDir));
												}
												if (current($this->LiID)) {
													$this->Writer->writeAttribute('id', current($this->LiID));
												}
												if (current($this->LiLang)) {
													$this->Writer->writeAttribute('lang', current($this->LiLang));
												}
												if (current($this->LiStyle)) {
													$this->Writer->writeAttribute('style', current($this->LiStyle));
												}
												if (current($this->LiTitle)) {
													$this->Writer->writeAttribute('title', current($this->LiTitle));
												}
												if (current($this->LiXMLLang)) {
													$this->Writer->writeAttribute('xmllang', current($this->LiXMLLang));
												}
											
											if (current($this->Li)) {
												$this->Li[key($this->Li)] = $this->CreateWordWrap(current($this->Li));
												$this->Writer->writeRaw("\n\t");
												$this->Writer->writeRaw(current($this->Li));
												$this->Writer->writeRaw("\n  ");
											}
											if (current($this->LiChildID)){
												$listidnumber = array();
												$listidnumber['PageID'] = $this->PageID;
												$listidnumber['ObjectID'] = current($this->LiChildID);
												$listdatabase = Array();
												$listdatabase[$this->DatabaseTableName] = $this->DatabaseTableName;
												
												$databases = &$this->ListProtectionLayer;
												
												$list = new XhtmlUnorderedList($listdatabase, $databases);
												
												$list->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTableName);
												$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
												$list->FetchDatabase ($listidnumber);
												
												$tempspace = $this->Space;
												$tempspace .= '    ';
												$list->CreateOutput($tempspace);
												
												$listoutput = $list->getOutput();
												$listoutput = str_replace("\n","\n$this->Space", $listoutput);
												$this->Writer->writeRaw($listoutput);
											}
											
											$this->Writer->endElement(); // ENDS LI
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
			
			if ($this->EndTag) {
				$this->Writer->endElement(); // ENDS END TAG
			} else {
				$this->Writer->endElement(); // ENDS END TAG
			}
			
		}
		$this->Writer->endDocument();
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->List = $this->Writer->flush();
		}
	}
	
	public function getOutput() {
		return $this->List;
	}
}
?>