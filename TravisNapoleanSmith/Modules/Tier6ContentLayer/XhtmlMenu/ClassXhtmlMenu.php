<?php

class XhtmlMenu implements Tier6ContentLayerModules {
	private $PageID;
	private $ObjectID;
	private $NewsID;
	private $ClassReplace;
	private $ClassClass;
	private $MenuProtectionLayer;
	private $DatabaseTableName;
	
	private $newsflag;
	
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
	
	private $MainDiv;
	private $MainDivID;
	private $MainDivClass;
	private $MainDivStyle;
	
	private $Div;
	private $DivTitle;
	private $DivID;
	private $DivClass;
	private $DivStyle;
	
	private $EnableDisable;
	private $Status;
	
	private $Space;
	private $List;
	private $HttpUserAgent;
	private $errormessage;
	
	public function XhtmlMenu($tablenames, $database) {
		$this->MenuProtectionLayer = &$database;
		$this->DatabaseTableName = current($tablenames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user; 
		$this->password = $password; 
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;
		
		$this->MenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->MenuProtectionLayer->setDatabasetable ($databasetable);
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
		$ConnectionID = array();
		$ConnectionID['PageID'] = $PageID['PageID'];
		$ConnectionID['ObjectID'] = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);
		
		$this->MenuProtectionLayer->Connect($this->databasetable);
		
		$this->MenuProtectionLayer->pass ($this->databasetable, 'setDatabaseField', array('idnumber' => $ConnectionID));
		$this->MenuProtectionLayer->pass ($this->databasetable, 'setDatabaseRow', array('idnumber' => $ConnectionID));
		$this->MenuProtectionLayer->pass ($this->databasetable, 'setEntireTable', array());

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
		
		$this->StartTag = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('StartTag'));
		$this->EndTag = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('EndTag'));
		$this->StartTagID = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('StartTagID'));
		$this->StartTagStyle = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('StartTagStyle'));
		$this->StartTagClass = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('StartTagClass'));
		
		$this->MainDiv = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Div'));
		$this->MainDivID = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('DivID'));
		$this->MainDivClass = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('DivClass'));
		$this->MainDivStyle = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('DivStyle'));
		
		$this->Div = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Div1'));
		$this->DivTitle = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Div1Title'));
		$this->DivID = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Div1ID'));
		$this->DivClass = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Div1Class'));
		$this->DivStyle = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Div1Style'));
		
		$this->EnableDisable = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Enable/Disable'));
		$this->Status = $this->MenuProtectionLayer->pass ($this->databasetable, 'getRowField', array('Status'));
		
		$this->MenuProtectionLayer->Disconnect($this->databasetable);
				
	}
	
	private function CreateWordWrap($wordwrapstring) {
		if (stristr($wordwrapstring, '<a href')) {
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
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
		}
		return $wordwrapstring;
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