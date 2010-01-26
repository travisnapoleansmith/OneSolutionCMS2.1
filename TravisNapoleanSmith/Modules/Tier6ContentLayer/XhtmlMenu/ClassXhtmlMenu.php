<?php

class XhtmlMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $NewsID;
	protected $ClassReplace;
	protected $ClassClass;
	protected $MenuProtectionLayer;
	protected $DatabaseTableName;
	
	protected $newsflag;
	
	protected $MainDiv;
	protected $MainDivID;
	protected $MainDivClass;
	protected $MainDivStyle;
	
	protected $Div;
	protected $DivTitle;
	protected $DivID;
	protected $DivClass;
	protected $DivStyle;
	
	protected $List;
	
	public function XhtmlMenu($tablenames, $database) {
		$this->MenuProtectionLayer = &$database;
		$this->DatabaseTableName = current($tablenames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user; 
		$this->Password = $password; 
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->MenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->MenuProtectionLayer->setDatabasetable ($databasetable);
	}
	
	public function FetchDatabase ($PageID) {
		$ConnectionID = array();
		$ConnectionID['PageID'] = $PageID['PageID'];
		$ConnectionID['ObjectID'] = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);
		
		$this->MenuProtectionLayer->Connect($this->DatabaseTable);
		
		$this->MenuProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $ConnectionID));
		$this->MenuProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $ConnectionID));
		$this->MenuProtectionLayer->pass ($this->DatabaseTable, 'setEntireTable', array());
		
		$this->PageID = current($PageID);
		next($PageID);
		$this->ObjectID = current($PageID);
		next($PageID);
		$this->NewsID = current($PageID);
		if ($this->NewsID) {
			next($PageID);
			$this->ClassReplace = current($PageID);
			next($PageID);
			$this->ClassClass = current($PageID);
		}
		
		$this->StartTag = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('StartTag'));
		$this->EndTag = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('EndTag'));
		$this->StartTagID = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('StartTagID'));
		$this->StartTagStyle = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('StartTagStyle'));
		$this->StartTagClass = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('StartTagClass'));
		
		$this->MainDiv = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Div'));
		$this->MainDivID = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('DivID'));
		$this->MainDivClass = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('DivClass'));
		$this->MainDivStyle = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('DivStyle'));
		
		$this->Div = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Div1'));
		$this->DivTitle = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Div1Title'));
		$this->DivID = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Div1ID'));
		$this->DivClass = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Div1Class'));
		$this->DivStyle = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Div1Style'));
		
		$this->EnableDisable = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Enable/Disable'));
		$this->Status = $this->MenuProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('Status'));
		
		$this->MenuProtectionLayer->Disconnect($this->DatabaseTable);
		
	}
	
	public function CreateOutput($space) {
	  	$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->NewsID) {
				if (strstr($this->Div, $this->NewsID) | $this->NewsID == -1) {
					$this->StartTagClass = str_replace($this->ClassReplace, '', $this->StartTagClass);
					$this->StartTagClass = str_replace(' ','', $this->StartTagClass);
					$this->StartTagClass = $this->ClassClass ."$this->StartTagClass";
				}
			}
			if ($this->StartTag){
				if ($this->StartTagID) {
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
			
			if ($this->MainDiv) {
				if($this->Space) {
					$this->List .= $this->Space;
					$this->List .= $this->MainDiv;
					$this->List .= "\n";
				} else {
					$this->List .= '  ';
					$this->List .= $this->MainDiv;
					$this->List .= "\n";
				}
			}
			
			if ($this->Space) {
				$this->List .= $this->Space;
			} else {
				$this->List .= '    ';
			}
			
			$this->List .= '<div';
			
			if ($this->MainDivID) {
				$this->List .= ' id="';
				$this->List .= $this->MainDivID;
				$this->List .= "\"";
			}
			
			if ($this->MainDivClass) {
				$this->List .= ' class="';
				$this->List .= $this->MainDivClass;
				$this->List .= '"';
			}
			
			if ($this->MainDivStyle) {
				$this->List .= ' style="';
				$this->List .= $this->MainDivStyle;
				$this->List .= '"';
			}
			
			$this->List .= ">\n";

			if($this->Space) {
				$this->List .= $this->Space;
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}
			$this->List .= '<div';
			
			if ($this->DivID) {
				$this->List .= ' id="';
				$this->List .= $this->DivID;
				$this->List .= '"';
			}
			
			if ($this->DivClass) {
				$this->List .= ' class="';
				$this->List .= $this->DivClass;
				$this->List .= '"';
			}
			
			if ($this->DivStyle) {
				$this->List .= ' style="';
				$this->List .= $this->DivStyle;
				$this->List .= '"';
			}
			
			if ($this->DivTitle) {
				$this->List .= ' title="';
				$this->List .= $this->DivTitle;
				$this->List .= '"';
			}
			
			$this->List .= ">\n";
			
			if ($this->NewsID) {
				if (strstr($this->Div, $this->NewsID) | $this->NewsID == -1) {
					$this->Div = strip_tags($this->Div);
				}
			}
			if ($this->Div) {
				if($this->Space) {
					$this->List .= $this->Space;
					$this->List .= $this->Space;
					$this->List .= $this->Space;
					$this->Div = $this->CreateWordWrap($this->Div);
					$this->List .= $this->Div;
					$this->List .= "\n";
				} else {
					$this->List .= '    ';
					$this->Div = $this->CreateWordWrap($this->Div);
					$this->List .= $this->Div;
					$this->List .= "\n";
				}
			}
			
			if($this->Space) {
				$this->List .= $this->Space;
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}
			$this->List .= "</div>\n";
									
			if($this->Space) {
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}
			$this->List .= "</div>\n";
			
			if ($this->EndTag) {
				$this->List .= "  ";
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