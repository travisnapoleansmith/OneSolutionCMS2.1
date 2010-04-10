<?php

class XhtmlMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $NewsID;
	protected $ClassReplace;
	protected $ClassClass;
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
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		
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
		$ConnectionID = array();
		$ConnectionID['PageID'] = $PageID['PageID'];
		$ConnectionID['ObjectID'] = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->Connect($this->DatabaseTable);
		
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $ConnectionID));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $ConnectionID));
		$this->LayerModule->pass ($this->DatabaseTable, 'setEntireTable', array());
		
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
		
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTagClass'));
		
		$this->MainDiv = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div'));
		$this->MainDivID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('DivID'));
		$this->MainDivClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('DivClass'));
		$this->MainDivStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('DivStyle'));
		
		$this->Div = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1'));
		$this->DivTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1Title'));
		$this->DivID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1ID'));
		$this->DivClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1Class'));
		$this->DivStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1Style'));
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Status'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
		
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
			
			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->List .= '<div';
			}
			
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
			
			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->List .= ">\n";
			}
			
			if($this->Space) {
				$this->List .= $this->Space;
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}
			
			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->List .= '<div';
			}
			
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
			
			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->List .= ">\n";
			}
			
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
			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->List .= "</div>\n";
			}
			
			if($this->Space) {
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}
			
			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->List .= "</div>\n";
			}
			
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