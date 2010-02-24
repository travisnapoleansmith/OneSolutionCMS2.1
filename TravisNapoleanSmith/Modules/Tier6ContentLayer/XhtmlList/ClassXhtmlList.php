<?php

class XhtmlList extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $ListProtectionLayer;
	protected $DatabaseTableName;
	
	protected $Ul;
	protected $UlID;
	protected $UlClass;
	protected $UlStyle;
	
	protected $Li;
	protected $LiChildID;
	protected $LiID;
	protected $LiClass;
	protected $LiStyle;
	
	protected $List;
	
	public function XhtmlList($tablenames, $database) {
		$this->ListProtectionLayer = &$database;
		$this->DatabaseTableName = current($tablenames);
		$this->Li = Array();
		$this->LiChildID = Array();
		$this->LiID = Array();
		$this->LiClass = Array();
		$this->LiStyle = Array();
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);

		$this->Writer = new XMLWriter();
		if ($this->FileName) {
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer->openMemory();
		}
		
		$this->Writer->setIndent(3);
		
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
		$this->UlID = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlID'));
		$this->UlClass = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlClass'));
		$this->UlStyle = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'UlStyle'));
		
		$this->BuildLiList('Li');
		$this->BuildLiList('LiChildID');
		$this->BuildLiList('LiID');
		$this->BuildLiList('LiClass');
		$this->BuildLiList('LiStyle');
		
		$this->EnableDisable = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->ListProtectionLayer->Disconnect($this->DatabaseTable);
	}
	
	protected function BuildLiList($LiList) {
		if (is_array($this->$LiList)) {
			$i = 1;
			$Field = 'Li';
			$Field .= $i;
			$FieldName = str_replace('Li', $Field, $LiList);
			while($this->ListProtectionLayer->pass ($this->DatabaseTable, 'searchFieldNames', array('rowfield' => $FieldName))) {
				$temp = $this->ListProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $FieldName));
				array_push($this->$LiList, $temp);
				$i++;
				$Field = 'Li';
				$Field .= $i;
				$FieldName = str_replace('Li', $Field, $LiList);
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
				if ($this->UlID) {
					$this->Writer->writeAttribute('id', $this->UlID);
				}
				if ($this->UlStyle) {
					$this->Writer->writeAttribute('style', $this->UlStyle);
				}
				if ($this->UlClass) {
					$this->Writer->writeAttribute('class', $this->UlClass);
				}
			
			if (is_array($this->Li)) {
				if (is_array($this->LiChildID)){
					if (is_array($this->LiID)){
						if (is_array($this->LiClass)){
							if (is_array($this->LiStyle)){
								while (current($this->Li)) {
									$this->Writer->startElement('li');
										if (current($this->LiID)) {
											$this->Writer->writeAttribute('id', current($this->LiID));
										}
										if (current($this->LiStyle)) {
											$this->Writer->writeAttribute('style', current($this->LiStyle));
										}
										if (current($this->LiClass)) {
											$this->Writer->writeAttribute('class', current($this->LiClass));
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
			
										$list = new XhtmlList($listdatabase, $databases);
										
										$list->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTableName);
										$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
										$list->FetchDatabase ($listidnumber);
										
										$tempspace = $this->Space;
										$tempspace .= '    ';
										$list->CreateOutput($tempspace);
										
										$listoutput = $list->getOutput();
										$listoutput = str_replace("\n","\n$this->Space", $listoutput);
										//$this->Writer->writeRaw("\n$this->Space");
										$this->Writer->writeRaw($listoutput);
										//$this->Writer->writeRaw("\n$this->Space");
									}
									
									$this->Writer->endElement(); // ENDS LI
									next($this->Li);
									next($this->LiChildID);
									next($this->LiID);
									next($this->LiClass);
									next($this->LiStyle);
								}
							} else {
								array_push($this->errormessage,'CreateOutput: LiStyle must be an Array!');
							}
						} else {
							array_push($this->errormessage,'CreateOutput: LiClass must be an Array!');
						}
					} else {
						array_push($this->errormessage,'CreateOutput: LiID must be an Array!');
					}
				} else {
					array_push($this->errormessage,'CreateOutput: LiChildID must be an Array!');
				}
			} else {
				array_push($this->errormessage,'CreateOutput: Li must be an Array!');
			}
			
			$this->Writer->endElement(); // ENDS UL
			
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