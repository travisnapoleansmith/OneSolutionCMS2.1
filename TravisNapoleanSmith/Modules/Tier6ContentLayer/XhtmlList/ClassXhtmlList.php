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
				$this->List .= '  ';
				if ($this->StartTagID & !$this->PrintPreview) {
					$temp = strrpos($this->StartTag, '>');
					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'id="';
					$this->StartTag .= $this->StartTagID;
					$this->StartTag .= '"';
					
					if ($this->StartTagStyle) {
						$this->StartTag .= ' style="';
						$this->StartTag .= $this->StartTagStyle;
						$this->StartTag .= '"';
					}
					if ($this->StartTagClass) {
						$this->StartTag .= ' class="';
						$this->StartTag .= $this->StartTagClass;
						$this->StartTag .= '"';
						$this->StartTag .= ">\n";
					} else {
						$this->StartTag .= ">\n";
					}
					$this->List .= $this->StartTag;
				} else if ($this->StartTagClass){
					$temp = strrpos($this->StartTag, '>');
					$this->StartTag[$temp] = ' ';
				
					if ($this->StartTagStyle) {
						$this->StartTag .= 'style="';
						$this->StartTag .= $this->StartTagStyle;
						$this->StartTag .= '" ';
					}
					
					$this->StartTag .= 'class="';
					$this->StartTag .= $this->StartTagClass;
					$this->StartTag .= '"';
					$this->StartTag .= ">\n";
					$this->List .= $this->StartTag;
				} else if ($this->StartTagStyle){
					$temp = strrpos($this->StartTag, '>');
					
					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'style="';
					$this->StartTag .= $this->StartTagStyle;
					$this->StartTag .= '"';
					$this->StartTag .= ">";
					
					$this->List .= $this->StartTag;
					$this->List .= "\n";
				} else {
					$this->List .= $this->StartTag;
					$this->List .= "\n";
				}
			}
			if ($this->Ul) {
				if($this->Space) {
					$this->List .= $this->Space;
					$this->List .= $this->Ul;
					$this->List .= "\n";
				} else {
					$this->List .= '  ';
					$this->List .= $this->Ul;
					$this->List .= "\n";
				}
			}
			
			if ($this->Space) {
				$this->List .= $this->Space;
			} else {
				$this->List .= '    ';
			}
			
			$this->List .= '<ul';
			
			if ($this->UlID & !$this->PrintPreview) {
				$this->List .= ' id="';
				$this->List .= $this->UlID;
				$this->List .= "\"";
			}
			
			if ($this->UlClass) {
				$this->List .= ' class="';
				$this->List .= $this->UlClass;
				$this->List .= '"';
			}
			
			if ($this->UlStyle) {
				$this->List .= ' style="';
				$this->List .= $this->UlStyle;
				$this->List .= '"';
			}
		
			$this->List .= ">\n";
			
			if (is_array($this->Li)) {
				if (is_array($this->LiChildID)){
					if (is_array($this->LiID)){
						if (is_array($this->LiClass)){
							if (is_array($this->LiStyle)){
								while (current($this->Li)) {
									if($this->Space) {
										$this->List .= $this->Space;
										$this->List .= $this->Space;
									} else {
										$this->List .= '  ';
									}
									$this->List .= '<li';
			
									if (current($this->LiID) & !$this->PrintPreview) {
										$this->List .= ' id="';
										$this->List .= current($this->LiID);
										$this->List .= '"';
									}
									
									if (current($this->LiClass)) {
										$this->List .= ' class="';
										$this->List .= current($this->LiClass);
										$this->List .= '"';
									}
									
									if (current($this->LiStyle)) {
										$this->List .= ' style="';
										$this->List .= current($this->LiStyle);
										$this->List .= '"';
									}
		
									$this->List .= ">\n";
									
									if (current($this->Li)) {
										if($this->Space) {
											$this->List .= $this->Space;
											$this->List .= $this->Space;
											$this->List .= $this->Space;
											$this->Li[key($this->Li)] = $this->CreateWordWrap(current($this->Li));
											$this->List .= $this->Li[key($this->Li)];
											$this->List .= "\n";
										} else {
											$this->List .= '    ';
											$this->Li[key($this->Li)] = $this->CreateWordWrap(current($this->Li));
											$this->List .= $this->Li[key($this->Li)];
											$this->List .= "\n";
										}
									}
									if (current($this->LiChildID)){
										$idnumber = Array();
										$idnumber['PageID'] = $this->PageID;
										$idnumber['ObjectID'] = current($this->LiChildID);
										$database = Array();
										$database['List'] = $this->ListProtectionLayer;
										$temp = new XhtmlList($database);
										$temp->FetchDatabase ($idnumber);
										$tempspace = $this->Space;
										$tempspace .= '    ';
										$temp->CreateOutput($tempspace);
										$tempoutput = $temp->getOutput();
										$this->List .= $tempoutput;
									}
									
									if($this->Space) {
										$this->List .= $this->Space;
										$this->List .= $this->Space;
									} else {
										$this->List .= '  ';
									}
									$this->List .= "</li>\n";
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
			if($this->Space) {
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}
			$this->List .= "</ul>\n";
			
			if ($this->EndTag) {
				$this->List .= '  ';
				$this->List .= $this->EndTag;
				$this->List .= "\n";
			}
		}
	}
	
	public function getOutput() {
		return $this->List;
	}
}
?>