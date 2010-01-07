<?php

class XhtmlNews extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	//protected $PageID;
	//protected $ObjectID;
	protected $NewsButtons;
	protected $NewsStories;
	protected $ContentLayerTables;
	protected $NewsButtonsTableName;
	protected $NewsStoriesTableName;
	protected $ContentLayerTablesName;
	/*
	protected $hostname;
	protected $user; 
	protected $password; 
	protected $databasename;
	protected $databasetable;
	*/
	protected $ContainerObjectType;
	protected $ContainerObjectID;
	protected $RevisionID;
	protected $CurrentVersion;
	protected $Empty;
	/*
	protected $StartTag;
	protected $EndTag;
	protected $StartTagID;
	protected $StartTagStyle;
	protected $StartTagClass;
	*/
	protected $Heading;
	protected $HeadingStartTag;
	protected $HeadingEndTag;
	protected $HeadingStartTagID;
	protected $HeadingStartTagClass;
	protected $HeadingStartTagStyle;
	
	protected $Content;
	protected $ContentStartTag;
	protected $ContentEndTag;
	protected $ContentStartTagID;
	protected $ContentStartTagClass;
	protected $ContentStartTagStyle;
	/*
	protected $EnableDisable;
	protected $Status;
	*/
	//protected $Space;
	protected $News;
	//protected $HttpUserAgent;
	//protected $ErrorMessage;
	protected $NewsButtonsRowCount;
	
	public function XhtmlNews($tablenames, $database) {
		$this->NewsButtons = &$database;
		$this->NewsButtonsTableName = current($tablenames);
		$this->NewsStories = &$database;
		$this->NewsStoriesTableName = next($tablenames);
		$this->ContentLayerTables = &$database;
		$this->ContentLayerTablesName = next($tablenames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user; 
		$this->password = $password; 
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;
		
		$this->NewsButtons->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->NewsButtons->setDatabasetable ($databasetable);
		
		$this->NewsStories->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->NewsStories->setDatabasetable ($databasetable);
		
	}
	/*
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
		return $this->ErrorMessage[$idnumber];
	}
	
	public function getErrorArray() {
		return $this->ErrorMessage;
	}
	*/
	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);
		
		$this->NewsButtons->Connect($this->databasetable);
		$passarray = array();
		$passarray = &$PageID;
		$this->NewsButtons->pass ($this->databasetable, 'setEntireTable', array());
		$this->NewsButtonsRowCount = $this->NewsButtons->pass ($this->databasetable, 'getRowCount', array());
		$this->NewsButtons->Disconnect($this->databasetable);
		
		$this->NewsButtonsRowCount = $this->NewsButtons->pass ($this->databasetable, 'getTable', array('rownumber' => $this->NewsButtonsRowCount, 'rowcolumn' => 'PageID'));
		
		if ($PageID['PageID'] == NULL) {
			$this->PageID = $this->NewsButtonsRowCount;
			$PageID['PageID'] = $this->NewsButtonsRowCount;
		} else {
			$this->PageID = $PageID['PageID'];
		}
		$this->ObjectID = $PageID['ObjectID'];
		
		$this->NewsStories->Connect($this->databasetable);
		$this->NewsStories->pass ($this->databasetable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->NewsStories->pass ($this->databasetable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->ContainerObjectType = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContainerObjectType'));
	    $this->ContainerObjectID = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContainerObjectID'));
	    $this->RevisionID = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'RevisionID'));
	    $this->CurrentVersion = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'CurrentVersion'));
	    $this->Empty = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Empty'));
		
		$this->StartTag = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Heading = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Heading'));
		$this->HeadingStartTag = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTag'));
		$this->HeadingEndTag = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingEndTag'));
		$this->HeadingStartTagID = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTagID'));
		$this->HeadingStartTagClass = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTagClass'));
		$this->HeadingStartTagStyle = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTagStyle'));
	
		$this->Content = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Content'));
		$this->ContentStartTag = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTag'));
		$this->ContentEndTag = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentEndTag'));
		$this->ContentStartTagID = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagID = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagClass = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagClass'));
		$this->ContentStartTagStyle = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagStyle'));
	
		$this->EnableDisable = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->NewsStories->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->NewsStories->Disconnect($this->databasetable);
				
	}
	// MAKE THIS WORK WITH XHTMLCONTENT's WORDWRAP!
	protected function CreateWordWrap($wordwrapstring) {
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
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
		}
		return $wordwrapstring;
	}
	/*
	protected function buildModules($moduleslocation) {
		if ($moduleslocation) {
			$hold = Array();
			$dir = dir($moduleslocation);
			
			while ($entry = $dir->read()) {
				
				$filestring = $moduleslocation;
				$filestring .= $entry;
				if (!($entry == '.' | $entry == '..')) {
					if (is_dir($filestring)) {
						$modulesfile = $filestring;
						$modulesfile .= '/Class';
						$modulesfile .= $entry;
						$modulesfile .= '.php';
						if (is_file($modulesfile)) {
							$hold[$entry] = $modulesfile;
						} else {
							array_push($this->ErrorMessage,'buildModules: Module file does not exist!');
						}
					}
				}
			}
			return $hold;
		} else {
			array_push($this->ErrorMessage,'buildModules: Module Location is not set!');
		}
	}*/
	
	public function CreateOutput($space) {
	  	$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
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
					$this->News .= $this->StartTag;
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
					
					$this->News .= $this->StartTag;
				} else {
					$temp = strrpos($this->StartTag, '>');
					
					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'style="';
					$this->StartTag .= $this->StartTagStyle;
					$this->StartTag .= '"';
					$this->StartTag .= ">\n";
					
					$this->News .= $this->StartTag;
					$this->News .= "\n";
				}
			}
			
			if ($this->HeadingStartTag){
				if ($this->HeadingStartTagID) {
					$temp = strrpos($this->HeadingStartTag, '>');
					$this->HeadingStartTag[$temp] = ' ';
					$this->HeadingStartTag .= 'id="';
					$this->HeadingStartTag .= $this->HeadingStartTagID;
					$this->HeadingStartTag .= '"';
					
					if ($this->HeadingStartTagStyle) {
						$this->HeadingStartTag .= ' style="';
						$this->HeadingStartTag .= $this->HeadingStartTagStyle;
						$this->HeadingStartTag .= '"';
					}
					if ($this->HeadingStartTagClass) {
						$this->HeadingStartTag .= ' class="';
						$this->HeadingStartTag .= $this->HeadingStartTagClass;
						$this->HeadingStartTag .= '"';
						$this->HeadingStartTag .= ">\n";
					} else {
						$this->HeadingStartTag .= ">\n";
					}
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->HeadingStartTag;
					
					if ($this->Heading) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->News .= $this->Heading;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Heading;
							$this->News .= "\n";
						}
					}
					
				} else if ($this->HeadingStartTagClass){
					$temp = strrpos($this->HeadingStartTag, '>');
					$this->HeadingStartTag[$temp] = ' ';
				
					if ($this->HeadingStartTagStyle) {
						$this->HeadingStartTag .= 'style="';
						$this->HeadingStartTag .= $this->HeadingStartTagStyle;
						$this->HeadingStartTag .= '" ';
					}
					
					$this->HeadingStartTag .= 'class="';
					$this->HeadingStartTag .= $this->HeadingStartTagClass;
					$this->HeadingStartTag .= '"';
					$this->HeadingStartTag .= ">\n";
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->HeadingStartTag;
					
					if ($this->Heading) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->News .= $this->Heading;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Heading;
							$this->News .= "\n";
						}
					}
				} else {
					$temp = strrpos($this->HeadingStartTag, '>');
					
					$this->HeadingStartTag[$temp] = ' ';
					$this->HeadingStartTag .= 'style="';
					$this->HeadingStartTag .= $this->HeadingStartTagStyle;
					$this->HeadingStartTag .= '"';
					$this->HeadingStartTag .= ">\n";
					
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->HeadingStartTag;
					
					if ($this->Heading) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->News .= $this->Heading;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Heading;
							$this->News .= "\n";
						}
					}
					$this->News .= "\n";
				}
			}
			
			if ($this->HeadingEndTag) {
				if($this->Space) {
					$this->News .= $this->Space;
				} else {
					$this->News .= '  ';
				}
				$this->News .= $this->HeadingEndTag;
				$this->News .= "\n";
			}
			
			if ($this->ContentStartTag){
				if ($this->ContentStartTagID) {
					$temp = strrpos($this->ContentStartTag, '>');
					$this->ContentStartTag[$temp] = ' ';
					$this->ContentStartTag .= 'id="';
					$this->ContentStartTag .= $this->ContentStartTagID;
					$this->ContentStartTag .= '"';
					
					if ($this->ContentStartTagStyle) {
						$this->ContentStartTag .= ' style="';
						$this->ContentStartTag .= $this->ContentStartTagStyle;
						$this->ContentStartTag .= '"';
					}
					if ($this->ContentStartTagClass) {
						$this->ContentStartTag .= ' class="';
						$this->ContentStartTag .= $this->ContentStartTagClass;
						$this->ContentStartTag .= '"';
						$this->ContentStartTag .= ">\n";
					} else {
						$this->ContentStartTag .= ">\n";
					}
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->ContentStartTag;
					
					if ($this->Content) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->News .= $this->Content;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Content;
							$this->News .= "\n";
						}
					}
					
				} else if ($this->ContentStartTagClass){
					$temp = strrpos($this->ContentStartTag, '>');
					$this->ContentStartTag[$temp] = ' ';
				
					if ($this->ContentStartTagStyle) {
						$this->ContentStartTag .= 'style="';
						$this->ContentStartTag .= $this->ContentStartTagStyle;
						$this->ContentStartTag .= '" ';
					}
					
					$this->ContentStartTag .= 'class="';
					$this->ContentStartTag .= $this->ContentStartTagClass;
					$this->ContentStartTag .= '"';
					$this->ContentStartTag .= ">\n";
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->ContentStartTag;
					
					if ($this->Content) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->News .= $this->Content;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Content;
							$this->News .= "\n";
						}
					}
				} else {
					$temp = strrpos($this->ContentStartTag, '>');
					
					$this->ContentStartTag[$temp] = ' ';
					$this->ContentStartTag .= 'style="';
					$this->ContentStartTag .= $this->ContentStartTagStyle;
					$this->ContentStartTag .= '"';
					$this->ContentStartTag .= ">\n";
					
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->ContentStartTag;
					
					if ($this->Content) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->News .= $this->Content;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Content;
							$this->News .= "\n";
						}
					}
					$this->News .= "\n";
				}
			}
			
			if ($this->ContentEndTag) {
				if($this->Space) {
					$this->News .= $this->Space;
				} else {
					$this->News .= '  ';
				}
				$this->News .= $this->ContentEndTag;
				$this->News .= "\n";
			}
			
			if ($this->EndTag) {
				$this->News .= "  ";
				$this->News .= $this->EndTag;
				$this->News .= "\n";
			}
		}
		
		if ($this->ContainerObjectType) {
			if ($this->ContainerObjectType == 'XhtmlNews') {	
				if ($this->ContainerObjectID) {
					$newsidnumber = Array();
					$newsidnumber['PageID'] = $this->PageID;
					$newsidnumber['ObjectID'] = $this->ContainerObjectID;
					
					$newsdatabase = Array();
					$newsdatabase[$this->NewsButtonsTableName] = $this->NewsButtonsTableName;
					$newsdatabase[$this->NewsStoriesTableName] = $this->NewsStoriesTableName;
					$newsdatabase[$this->ContentLayerTablesName] = $this->ContentLayerTablesName;
					
					$news = new XhtmlNews($newsdatabase, $this->NewsButtons);
					$news->setHttpUserAgent($this->HttpUserAgent);
					$news->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, $this->databasetable);
					$news->FetchDatabase ($newsidnumber);
					$news->CreateOutput($this->Space);
					
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $news->getOutput();
				}
			} else {				
				if ($this->ContainerObjectID != NULL) {
					$modulesidnumber = Array();
					$modulesidnumber['PageID'] = 100000;
					$modulesidnumber['ObjectID'] = $this->ContainerObjectID;
					
					$ContentLayerTableArray = Array();
					$ContentLayerTableArray['ObjectType'] = $this->ContainerObjectType;
					$this->ContentLayerTables->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, $this->ContentLayerTablesName);
					$this->ContentLayerTables->Connect();
					$this->ContentLayerTables->setDatabaseRow($ContentLayerTableArray);
					
					$hold = 'DatabaseTable';
					$i = 1;
					$databasetablename = Array();
					$hold .= $i;
					while ($this->ContentLayerTables->getRowField($hold)) {
						array_push($databasetablename, $this->ContentLayerTables->getRowField($hold));
						$i++;
						$hold = 'DatabaseTable';
						$hold .= $i;
					}
					
					$filearray = $this->buildModules('Modules/Tier6ContentLayer/');
					$modulesfile = NULL;
					$modulesfile = $filearray[$this->ContainerObjectType];
					if ($modulesfile) {
						require_once($modulesfile);
						
						$modulesdatabase = Array();
						while (current($databasetablename)) {
							$modulesdatabase[current($databasetablename)] = &new ProtectionLayer();
							next($databasetablename);
						}
						$module = new $this->ContainerObjectType($modulesdatabase);
						reset($databasetablename);
						$module->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, current($databasetablename));
						$module->setHttpUserAgent($this->HttpUserAgent);
						$module->FetchDatabase($modulesidnumber);
						$module->CreateOutput('    ');
						
						$this->News = $module->getOutput();
					}
					
				}
			}
		}
	}
	
	public function getOutput() {
		return $this->News;
	}
}
?>