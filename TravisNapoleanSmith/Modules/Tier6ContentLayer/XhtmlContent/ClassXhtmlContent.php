<?php

class XhtmlContent extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $ContentTable;
	protected $ContentLayerTables;
	protected $ContentTableName;
	protected $ContentLayerTablesName;
	protected $ContentPrintPreviewTable;
	protected $ContentPrintPreviewTableName;
	
	protected $PrintIdNumberArray;
	
	protected $ContainerObjectType;
	protected $ContainerObjectTypeName;
	protected $ContainerObjectID;
	protected $ContainerObjectPrintPreview;
	protected $RevisionID;
	protected $CurrentVersion;
	protected $Empty;
	
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
	
	protected $ContentOutput;
	
	public function __construct($tablenames, $database) {
		$this->ContentTable = &$database;
		$this->ContentTableName = current($tablenames);
		$this->ContentLayerTables = &$database;
		$this->ContentLayerTablesName = next($tablenames);
		$this->ContentPrintPreviewTable = &$database;
		$this->ContentPrintPreviewTableName = next($tablenames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user; 
		$this->Password = $password; 
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;

		$this->ContentTable->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentTable->setDatabasetable ($this->ContentTableName);
		
		$this->ContentLayerTables->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentLayerTables->setDatabasetable ($this->ContentLayerTablesName);
		
		$this->ContentPrintPreviewTable->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentPrintPreviewTable->setDatabasetable ($this->ContentPrintPreviewTableName);
		
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
	
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->PrintPreview = $PageID['printpreview'];
		unset($PageID['printpreview']);
		
		$this->ContentTable->Connect($this->ContentTableName);
		$passarray = array();
		$passarray = $PageID;
		$this->ContentTable->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->ContentTable->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->ContainerObjectType = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectType'));
	    $this->ContainerObjectTypeName = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectTypeName'));
		$this->ContainerObjectID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectID'));
		$this->ContainerObjectPrintPreview = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectPrintPreview'));
	    $this->RevisionID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'RevisionID'));
	    $this->CurrentVersion = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'CurrentVersion'));
	    $this->Empty = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Empty'));
		
		$this->StartTag = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Heading = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Heading'));
		$this->HeadingStartTag = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTag'));
		$this->HeadingEndTag = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingEndTag'));
		$this->HeadingStartTagID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagID'));
		$this->HeadingStartTagClass = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagClass'));
		$this->HeadingStartTagStyle = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagStyle'));
	
		$this->Content = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Content'));
		$this->ContentStartTag = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTag'));
		$this->ContentEndTag = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentEndTag'));
		$this->ContentStartTagID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagClass = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagClass'));
		$this->ContentStartTagStyle = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagStyle'));
	
		$this->EnableDisable = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
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
	
	protected function buildObject($PageID, $ObjectID, $ContainerObjectType, $ContainerObjectTypeName, $print) {
		$modulesidnumber = Array();
		$modulesidnumber['PageID'] = $PageID;
		$modulesidnumber['ObjectID'] = $ObjectID;
		$modulesidnumber['PrintPreview'] = $this->PrintPreview;
		
		$ContentLayerTableArray = Array();
		$ContentLayerTableArray['ObjectType'] = $ContainerObjectType;
		$ContentLayerTableArray['ObjectTypeName'] = $ContainerObjectTypeName;
		
		$this->ContentLayerTables->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
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

		$filearray = $this->buildModules('Modules/Tier6ContentLayer/', TRUE);
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
			$module->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($databasetablename));
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
	
	protected function buildXhtmlContentObject ($PageID, $ContainerObjectID, $PrintPreview, $ContentTable, $ContentLayerTables, $print) {
		$contentidnumber = Array();
		$contentidnumber['PageID'] = $PageID;
		$contentidnumber['ObjectID'] = $ContainerObjectID;
		$contentidnumber['printpreview'] = $PrintPreview;
		
		$contentdatabase = Array();
		$contentdatabase[$this->ContentTableName] = $ContentTable;
		$contentdatabase[$this->ContentLayerTablesName] = $ContentLayerTables;
		$this->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTable);
		$this->FetchDatabase ($contentidnumber);
		if ($print == TRUE) {
			$this->buildOutput($this->Space);
		} 
	}
	
	protected function buildOutput ($Space) {
		$this->Space = $Space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved' & (($this->PrintPreview & $this->ContainerObjectPrintPreview == 'true') | !$this->PrintPreview)) {
			$this->ContentOutput .= '  ';
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
					$content->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTable);
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