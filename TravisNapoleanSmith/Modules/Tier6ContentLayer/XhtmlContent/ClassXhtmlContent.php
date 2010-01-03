<?php
require_once ("ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php");

class XhtmlContent implements Tier6ContentLayerModules {
	private $PageID;
	private $ObjectID;
	private $ContentTable;
	private $ContentLayerTables;
	private $ContentTableName;
	private $ContentLayerTablesName;
	private $ContentPrintPreviewTable;
	private $ContentPrintPreviewTableName;
	
	private $PrintPreview;
	private $PrintIdNumberArray;
	
	private $hostname;
	private $user; 
	private $password; 
	private $databasename;
	private $databasetable;
	
	private $ContainerObjectType;
	private $ContainerObjectTypeName;
	private $ContainerObjectID;
	private $ContainerObjectPrintPreview;
	private $RevisionID;
	private $CurrentVersion;
	private $Empty;
	
	private $StartTag;
	private $EndTag;
	private $StartTagID;
	private $StartTagStyle;
	private $StartTagClass;
	
	private $Heading;
	private $HeadingStartTag;
	private $HeadingEndTag;
	private $HeadingStartTagID;
	private $HeadingStartTagClass;
	private $HeadingStartTagStyle;
	
	private $Content;
	private $ContentStartTag;
	private $ContentEndTag;
	private $ContentStartTagID;
	private $ContentStartTagClass;
	private $ContentStartTagStyle;
	
	private $EnableDisable;
	private $Status;
	
	private $Space;
	private $ContentOutput;
	private $HttpUserAgent;
	private $errormessage;
	
	public function XhtmlContent($tablenames, $database) {
		$this->ContentTable = &$database;
		$this->ContentTableName = current($tablenames);
		$this->ContentLayerTables = &$database;
		$this->ContentLayerTablesName = next($tablenames);
		$this->ContentPrintPreviewTable = &$database;
		$this->ContentPrintPreviewTableName = next($tablenames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user; 
		$this->password = $password; 
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;

		$this->ContentTable->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentTable->setDatabasetable ($this->ContentTableName);
		
		$this->ContentLayerTables->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentLayerTables->setDatabasetable ($this->ContentLayerTablesName);
		
		$this->ContentPrintPreviewTable->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentPrintPreviewTable->setDatabasetable ($this->ContentPrintPreviewTableName);
		
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
	
	public function getContentTable() {
		return $this->ContentTable;
	}
	
	public function getContentLayerTables() {
		return $this->ContentLayerTables;
	}
	
	public function getContentTableName() {
		return $this->ContentTableName;
	}

	public function getContentLayerTablesName() {
		return $this->ContentLayerTablesName;
	}
	
	public function getContentPrintPreviewTable() {
		return $this->ContentPrintPreviewTable;
	}
	
	public function getContentPrintPreviewTableName() {
		return $this->ContentPrintPreviewTableName;
	}
	
	public function getPrintPreview() {
		return $this->PrintPreview;
	}
	
	public function gethostname() {
		return $this->hostname;
	}
	
	public function getuser() {
		return $this->user;
	}
	
	public function getpassword() {
		return $this->password;
	}
	
	public function getdatabasename() {
		return $this->databasename;
	}
	
	public function getdatabasetable() {
		return $this->databasetable;
	}
	
	public function getContainerObjectType() {
		return $this->ContainerObjectType;
	}
	
	public function getContainerObjectID() {
		return $this->ContainerObjectID;
	}
	
	public function getContainerObjectPrintPreview() {
		return $this->ContainerObjectPrintPreview;
	}
	
	public function getRevisionID() {
		return $this->RevisionID;
	}
	
	public function getCurrentVersion() {
		return $this->CurrentVersion;
	}
	
	public function getEmpty() {
		return $this->Empty;
	}
	
	public function getStartTag() {
		return $this->StartTag;
	}
	
	public function getEndTag() {
		return $this->EndTag;
	}
	
	public function getStartTagID() {
		return $this->StartTagID;
	}
	
	public function getStartTagStyle() {
		return $this->StartTagStyle;
	}		
	
	public function getStartTagClass() {
		return $this->StartTagClass;
	}
	
	public function getHeading() {
		return $this->Heading;
	}
		
	public function getHeadingStartTag() {
		return $this->HeadingStartTag;
	}
	
	public function getHeadingEndTag() {
		return $this->HeadingEndTag;
	}	
	
	public function getHeadingStartTagID() {
		return $this->HeadingStartTagID;
	}
	
	public function getHeadingStartTagClass() {
		return $this->HeadingStartTagClass;
	}
	
	public function getHeadingStartTagStyle() {
		return $this->HeadingStartTagStyle;
	}
	
	public function getContent() {
		return $this->Content;
	}
	
	public function getContentStartTag() {
		return $this->ContentStartTag;
	}
	
	public function getContentEndTag() {
		return $this->ContentEndTag;
	}
	
	public function getContentStartTagID() {
		return $this->ContentStartTagID;
	}
	
	public function getContentStartTagClass() {
		return $this->ContentStartTagClass;
	}
	
	public function getContentStartTagStyle() {
		return $this->ContentStartTagStyle;
	}
	
	public function getEnableDisable() {
		return $this->EnableDisable;
	}
	
	public function getStatus() {
		return $this->Status;
	}
	
	public function getSpace() {
		return $this->Space;
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
		$this->PrintPreview = $PageID['printpreview'];
		unset($PageID['printpreview']);
		
		$this->ContentTable->Connect($this->ContentTableName);
		$passarray = array();
		$passarray = $PageID;
		$this->ContentTable->pass ($this->databasetable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->ContentTable->pass ($this->databasetable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->ContainerObjectType = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContainerObjectType'));
	    $this->ContainerObjectTypeName = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContainerObjectTypeName'));
		$this->ContainerObjectID = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContainerObjectID'));
		$this->ContainerObjectPrintPreview = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContainerObjectPrintPreview'));
	    $this->RevisionID = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'RevisionID'));
	    $this->CurrentVersion = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'CurrentVersion'));
	    $this->Empty = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Empty'));
		
		$this->StartTag = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Heading = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Heading'));
		$this->HeadingStartTag = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTag'));
		$this->HeadingEndTag = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingEndTag'));
		$this->HeadingStartTagID = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTagID'));
		$this->HeadingStartTagClass = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTagClass'));
		$this->HeadingStartTagStyle = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'HeadingStartTagStyle'));
	
		$this->Content = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Content'));
		$this->ContentStartTag = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTag'));
		$this->ContentEndTag = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentEndTag'));
		$this->ContentStartTagID = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagID = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagClass = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagClass'));
		$this->ContentStartTagStyle = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'ContentStartTagStyle'));
	
		$this->EnableDisable = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->ContentTable->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->ContentTable->Disconnect($this->ContentTableName);
		
		if ($this->PrintPreview) {
			$this->PrintIdNumberArray = array();
			$passarray = array();
			$passarray['PageID'] = $PageID['PageID'];
			$this->ContentPrintPreviewTable->Connect($this->ContentPrintPreviewTableName);
			
			$this->ContentPrintPreviewTable->pass ($this->ContentPrintPreviewTableName, 'setDatabaseField', array('idnumber' => $passarray));
			$this->ContentPrintPreviewTable->pass ($this->ContentPrintPreviewTableName, 'setDatabaseRow', array('idnumber' => $passarray));
			$i = 1;
			$hold = $this->ContentPrintPreviewTable->pass ($this->ContentPrintPreviewTableName, 'getRowField', array('rowfield' => "PrintPageID$i"));
			while ($hold) {
				$this->PrintIdNumberArray["PrintPageID$i"] = $hold;
				$i++;
				$hold = $this->ContentPrintPreviewTable->pass ($this->ContentPrintPreviewTableName, 'getRowField', array('rowfield' => "PrintPageID$i"));
			}
			$this->ContentPrintPreviewTable->Disconnect($this->ContentPrintPreviewTableName);
		}
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
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n       $this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n       $this->Space$this->Space");
		}
		
		return $wordwrapstring;
	}
	
	private function buildModules($moduleslocation) {
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
							array_push($this->errormessage,'buildModules: Module file does not exist!');
						}
					}
				}
			}
			return $hold;
		} else {
			array_push($this->errormessage,'buildModules: Module Location is not set!');
		}
	}
	
	private function buildObject($PageID, $ObjectID, $ContainerObjectType, $ContainerObjectTypeName, $print) {
		$modulesidnumber = Array();
		$modulesidnumber['PageID'] = $PageID;
		$modulesidnumber['ObjectID'] = $ObjectID;
		$modulesidnumber['PrintPreview'] = $this->PrintPreview;
		
		$ContentLayerTableArray = Array();
		$ContentLayerTableArray['ObjectType'] = $ContainerObjectType;
		$ContentLayerTableArray['ObjectTypeName'] = $ContainerObjectTypeName;
		
		$this->ContentLayerTables->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename);
		$this->ContentLayerTables->setDatabaseTable ($this->ContentLayerTablesName);
		$this->ContentLayerTables->Connect($this->ContentLayerTablesName);
		
		$this->ContentLayerTables->pass ($this->ContentLayerTablesName, 'setDatabaseRow', array('idnumber' => $ContentLayerTableArray));
		$hold = 'DatabaseTable';
		$i = 1;
		$databasetablename = Array();
		$hold .= $i;
		
		while ($this->ContentLayerTables->pass ($this->ContentLayerTablesName, 'getRowField', array('rowfield' => $hold))) {
			array_push($databasetablename, $this->ContentLayerTables->pass ($this->ContentLayerTablesName, 'getRowField', array('rowfield' => $hold)));
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
				$modulesdatabase[current($databasetablename)] = current($databasetablename);
				next($databasetablename);
			}
			
			$module = new $this->ContainerObjectType($modulesdatabase, $this->ContentLayerTables);
			reset($databasetablename);
			$module->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, current($databasetablename));
			$module->setHttpUserAgent($this->HttpUserAgent);
			$module->FetchDatabase($modulesidnumber);
			$module->CreateOutput('    ');
			
			if ($print == TRUE) {
				if ($module->getOutput()) {
					$this->ContentOutput .= $module->getOutput();
				}
			} else {
				return $module;
			}
		}
	}
	
	private function buildXhtmlContentObject ($PageID, $ContainerObjectID, $PrintPreview, $ContentTable, $ContentLayerTables, $print) {
		$contentidnumber = Array();
		$contentidnumber['PageID'] = $PageID;
		$contentidnumber['ObjectID'] = $ContainerObjectID;
		$contentidnumber['printpreview'] = $PrintPreview;
		
		$contentdatabase = Array();
		$contentdatabase[$this->ContentTableName] = $ContentTable;
		$contentdatabase[$this->ContentLayerTablesName] = $ContentLayerTables;
		$this->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, $this->databasetable);
		$this->FetchDatabase ($contentidnumber);
		if ($print == TRUE) {
			$this->buildOutput($this->Space);
		} 
	}
	
	private function buildOutput ($Space) {
		$this->Space = $Space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved' & (($this->PrintPreview & $this->ContainerObjectPrintPreview == 'true') | !$this->PrintPreview)) {
			$this->ContentOutput .= '  ';
			if ($this->StartTag){
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
					
					$this->ContentOutput .= $this->StartTag;
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
					
					$this->ContentOutput .= $this->StartTag;
				} else {
					$temp = strrpos($this->StartTag, '>');
					
					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'style="';
					$this->StartTag .= $this->StartTagStyle;
					$this->StartTag .= '"';
					$this->StartTag .= ">\n";
					
					$this->ContentOutput .= $this->StartTag;
					$this->ContentOutput .= "\n";
				}
			}
			
			if ($this->HeadingStartTag){
				$this->ContentOutput .= '     ';
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
						$this->ContentOutput .= $this->Space;
					}

					$this->ContentOutput .= $this->HeadingStartTag;
					
					if ($this->Heading) {
						$this->ContentOutput .= '     ';
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Heading;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->ContentOutput .= $this->Heading;
							$this->ContentOutput .= "\n";
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
						$this->ContentOutput .= $this->Space;
					}
					$this->ContentOutput .= $this->HeadingStartTag;
					
					if ($this->Heading) {
						$this->ContentOutput .= '     ';
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Heading;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->ContentOutput .= $this->Heading;
							$this->ContentOutput .= "\n";
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
						$this->ContentOutput .= $this->Space;
					}
					$this->ContentOutput .= $this->HeadingStartTag;
					
					if ($this->Heading) {
						$this->ContentOutput .= '     ';
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Heading;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->ContentOutput .= $this->Heading;
							$this->ContentOutput .= "\n";
						}
					}
					$this->ContentOutput .= "\n";
				}
			}
			
			if ($this->HeadingEndTag) {
				$this->ContentOutput .= '   ';
				if($this->Space) {
					$this->ContentOutput .= $this->Space;
				} else {
					$this->ContentOutput .= '  ';
				}
				$this->ContentOutput .= $this->HeadingEndTag;
				$this->ContentOutput .= "\n";
			}
			
			if ($this->ContentStartTag){
				$this->ContentOutput .= '     ';
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
						$this->ContentOutput .= $this->Space;
					}
					$this->ContentOutput .= $this->ContentStartTag;
					
					if ($this->Content) {
						$this->ContentOutput .= '     ';
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
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
						$this->ContentOutput .= $this->Space;
					}
					$this->ContentOutput .= $this->ContentStartTag;
					
					if ($this->Content) {
						$this->ContentOutput .=  '     ';
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
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
						$this->ContentOutput .= $this->Space;
					}
					$this->ContentOutput .= $this->ContentStartTag;
					
					if ($this->Content) {
						$this->ContentOutput .= '     ';
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						}
					}
					$this->ContentOutput .= "\n";
				}
			}
			
			if ($this->ContentEndTag) {
				$this->ContentOutput .= '    ';
				if($this->Space) {
					$this->ContentOutput .= $this->Space;
				} else {
					$this->ContentOutput .= '  ';
				}
				$this->ContentOutput .= $this->ContentEndTag;
				$this->ContentOutput .= "\n";
			}
			
			if ($this->EndTag) {
				$this->ContentOutput .= "  ";
				$this->ContentOutput .= $this->EndTag;
				$this->ContentOutput .= "\n";
			}
		}
	}
	
	public function CreateOutput($space) {
		$arguments = func_get_args();
		$NoPrintPreview = $arguments[1];
		
		if ($NoPrintPreview) {
			$PrintPreview = TRUE;
		} else if ($this->PrintPreview){
			$PrintPreview = $this->PrintPreview;
		} else {
			$PrintPreview = TRUE;
		}
		$this->buildOutput($Space);
	
		if ($this->ContainerObjectType) {
			$temp = $this->ObjectID;
			$temp++;
			$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->ContentTable, $this->ContentLayerTables, FALSE);
			while ($this->EnableDisable) {
				if ($this->ContainerObjectType) {
					$containertype = $this->ContainerObjectType;
					
					if ($containertype ==  'XhtmlContent') {
						if ($this->ContainerObjectID) {
							if ($this->ContainerObjectPrintPreview == 'true' | ($this->ContainerObjectPrintPreview == 'false' && !$this->PrintPreview)) {
								$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->ContentTable, $this->ContentLayerTables, TRUE);
							}
						}
					} else if ($containertype == 'XhtmlMenu') {
						if (($this->PrintPreview & $this->ContainerObjectPrintPreview) | !$this->PrintPreview) {
							$filename = 'Configuration/Tier6-ContentLayer/' . $this->ContainerObjectTypeName .'.php';
							require($filename);
							$hold = bottompanel1();
							$this->ContentOutput .= $hold;
						}
					} else {
						if (!is_null($this->ContainerObjectID) | $this->ContainerObjectID == 0) {
							if ($this->ContainerObjectPrintPreview == 'true' | ($this->ContainerObjectPrintPreview == 'false' && !$this->PrintPreview)) {
								$this->buildObject($this->PageID, $this->ContainerObjectID, $this->ContainerObjectType, $this->ContainerObjectTypeName, TRUE);
							}
						}
					}
				}
				$temp++;
				$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->ContentTable, $this->ContentLayerTables, FALSE);
			}
			
			if ($this->PrintPreview & !$NoPrintPreview) {
				reset($this->PrintIdNumberArray);
				$this->ContentOutput = NULL;
				while (current($this->PrintIdNumberArray)) {
					$holdnow = current($this->PrintIdNumberArray);
					
					$contentidnumber = Array();
					$contentidnumber['PageID'] = $holdnow;
					$contentidnumber['ObjectID'] = 0;
					$contentidnumber['printpreview'] = TRUE;
					
					$contentdatabase = Array();
					$contentdatabase[$this->ContentTableName] = $this->ContentTableName;
					$contentdatabase[$this->ContentLayerTablesName] = $this->ContentLayerTablesName;
					$contentdatabase[$this->ContentPrintPreviewTableName] = $this->ContentPrintPreviewTableName;
					
					$content = new XhtmlContent($contentdatabase, $this->ContentTable);
					$content->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, $this->databasetable);
					$content->setHttpUserAgent($this->HttpUserAgent);
					$content->FetchDatabase ($contentidnumber);
					$content->CreateOutput('    ', TRUE);
					
					$contentoutput = $content->getOutput();
					$this->ContentOutput .= $contentoutput;
					
					next($this->PrintIdNumberArray);
				}
			}
		}
	}
	
	public function getOutput() {
		return $this->ContentOutput;
	}
}
?>