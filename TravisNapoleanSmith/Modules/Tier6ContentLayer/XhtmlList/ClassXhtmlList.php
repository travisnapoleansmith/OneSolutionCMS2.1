<?php
require_once ("ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php");

class XhtmlList implements Tier6ContentLayerModules {
	private $PageID;
	private $ObjectID;
	private $ListProtectionLayer;
	private $DatabaseTableName;
	
	private $PrintPreview;
	
	private $hostname;
	private $user; 
	private $password; 
	private $databasename;
	private $databasetable;
	
	private $StartTag;
	private $EndTag;
	private $StartTagID;
	private $StartTagStyle;
	private $StartTagClass;
	
	private $Ul;
	private $UlID;
	private $UlClass;
	private $UlStyle;
	
	private $Li;
	private $LiChildID;
	private $LiID;
	private $LiClass;
	private $LiStyle;
	
	private $EnableDisable;
	private $Status;
	
	private $Space;
	private $List;
	private $HttpUserAgent;
	private $errormessage;
	
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
		$this->hostname = $hostname;
		$this->user = $user; 
		$this->password = $password; 
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;
		
		$this->ListProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ListProtectionLayer->setDatabasetable ($databasetable);
	}
	
	public function setPageID($PageID) {
		$this->PageID = $PageID;
	}
	
	public function getPageID() {
		return $this->PageID;
	}
	
	public function setObjectID($ObjectID) {
		$this->ObjectID = $ObjectID;
	}
	
	public function getObjectID() {
		return $this->ObjectID;
	}
	
	public function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	public function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	
	public function getError ($idnumber) {
		return $this->errormessage[$idnumber];
	}
	
	public function getErrorArray() {
		return $this->errormessage;
	}
	
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->PrintPreview = $PageID['PrintPreview'];
		unset ($PageID['PrintPreview']);
		
		$this->ListProtectionLayer->Connect($this->databasetable);
		$passarray = array();
		$passarray = $PageID;
		$this->ListProtectionLayer->pass ($this->databasetable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->ListProtectionLayer->pass ($this->databasetable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->StartTag = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Ul = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Ul'));
		$this->UlID = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'UlID'));
		$this->UlClass = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'UlClass'));
		$this->UlStyle = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'UlStyle'));
		
		$this->BuildLiList('Li');
		$this->BuildLiList('LiChildID');
		$this->BuildLiList('LiID');
		$this->BuildLiList('LiClass');
		$this->BuildLiList('LiStyle');
		
		$this->EnableDisable = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->ListProtectionLayer->Disconnect($this->databasetable);
	}
	
	private function BuildLiList($LiList) {
		if (is_array($this->$LiList)) {
			$i = 1;
			$Field = 'Li';
			$Field .= $i;
			$FieldName = str_replace('Li', $Field, $LiList);
			while($this->ListProtectionLayer->pass ($this->databasetable, 'searchFieldNames', array('rowfield' => $FieldName))) {
				$temp = $this->ListProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => $FieldName));
				array_push($this->$LiList, $temp);
				$i++;
				$Field = 'Li';
				$Field .= $i;
				$FieldName = str_replace('Li', $Field, $LiList);
			}
		}
	}
	
	private function CreateWordWrap($wordwrapstring) {
		if (stristr($wordwrapstring, "<a href")) {
			// Strip AHef Tags for wordwrap then put them back in
			$firstpos = strpos($wordwrapstring, '<a href');
			$lastpos = strpos($wordwrapstring, '</a>');
			$lastpos = $lastpos + 3;
			
			// Split a string into an array - character by character
			$newwordwrapstring = Array();
			$j = 0;
			$end = strlen($wordwrapstring);
			while ($j <= $end) {
				array_push ($newwordwrapstring, $wordwrapstring[$j]);
				$j++;
			}
			
			$j = $firstpos;
			while ($j <= $lastpos) {
				$endstring .= $newwordwrapstring[$j];
				$j++;
			}
			
			$returnstring = $endstring;
			$returnstring = str_replace (' ', '<SPACE>', $returnstring);
			$wordwrapstring = str_replace ($endstring, $returnstring, $wordwrapstring);
			// END STRIP AHREF TAG FOR WORDWRAP
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n    $this->Space$this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n    $this->Space$this->Space");
		}
		return $wordwrapstring;
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