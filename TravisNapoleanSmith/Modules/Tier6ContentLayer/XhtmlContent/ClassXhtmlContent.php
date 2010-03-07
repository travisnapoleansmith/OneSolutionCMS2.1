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
	protected $ContentPTagID;
	protected $ContentPTagClass;
	protected $ContentPTagStyle;
	
	protected $ContentOutput;
	
	public function __construct($tablenames, $database) {
		$this->ContentTable = &$database;
		$this->ContentTableName = current($tablenames);
		$this->ContentLayerTables = &$database;
		$this->ContentLayerTablesName = next($tablenames);
		$this->ContentPrintPreviewTable = &$database;
		$this->ContentPrintPreviewTableName = next($tablenames);
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->GlobalWriter = $tablenames['GlobalWriter'];
		unset($tablenames['GlobalWriter']);
		
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
		$this->ContentStartTagClass = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagClass'));
		$this->ContentStartTagStyle = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagStyle'));
		
		$this->ContentPTagID = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentPTagID'));
		$this->ContentPTagClass = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentPTagClass'));
		$this->ContentPTagStyle = $this->ContentTable->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentPTagStyle'));
		
		
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
			//$modulesdatabase['GlobalWriter'] = &$this->Writer;
			$module = new $this->ContainerObjectType($modulesdatabase, $this->ContentLayerTables);
			reset($databasetablename);
			$module->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($databasetablename));
			$module->setHttpUserAgent($this->HttpUserAgent);
			$module->FetchDatabase($modulesidnumber);
			$module->CreateOutput('    ');
			
			//print_r($module);
			if ($print == TRUE) {
				if ($module->getOutput()) {
					//$this->ContentOutput .= $module->getOutput();
					$this->Writer->writeRaw($module->getOutput());
					$this->Writer->writeRaw("\n");
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
		//$contentidnumber['GlobalWriter'] = &$this->Writer;
		
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
			
			if ($this->HeadingStartTag){
				$this->HeadingStartTag = str_replace('<','', $this->HeadingStartTag);
				$this->HeadingStartTag = str_replace('>','', $this->HeadingStartTag);
				$this->Writer->startElement($this->HeadingStartTag);
					if ($this->HeadingStartTagID) {
						$this->Writer->writeAttribute('id', $this->HeadingStartTagID);
					}
					
					if ($this->HeadingStartTagClass) {
						$this->Writer->writeAttribute('class', $this->HeadingStartTagClass);
					}
					
					if ($this->HeadingStartTagStyle) {
						$this->Writer->writeAttribute('style', $this->HeadingStartTagStyle);
					}
					$this->Writer->writeRaw($this->Heading);
			}
			
			if ($this->HeadingEndTag) {
				$this->Writer->endElement();
			}
			
			if ($this->ContentStartTag == '<p>'){
				$this->ContentStartTag = str_replace('<','', $this->ContentStartTag);
				$this->ContentStartTag = str_replace('>','', $this->ContentStartTag);
				$this->Writer->startElement($this->ContentStartTag);
					if ($this->ContentStartTagID) {
						$this->Writer->writeAttribute('id', $this->ContentStartTagID);
					}
					
					if ($this->ContentStartTagClass) {
						$this->Writer->writeAttribute('class', $this->ContentStartTagClass);
					}
					
					if ($this->ContentStartTagStyle) {
						$this->Writer->writeAttribute('style', $this->ContentStartTagStyle);
					}
					
					$this->Content = trim($this->Content);
					// NEEDS TO BE WORKED ON!
					if (strpos($this->Content, "\n\r")) {
						$this->Content = explode("\n\r", $this->Content);
						$i = 0;
						$count = count($this->Content);
						$count--;
						while (current($this->Content)) {
							$this->Content[key($this->Content)] = trim(current($this->Content));
							$this->Content[key($this->Content)] = $this->CreateWordWrap(current($this->Content));
							if ($this->ContentStartTag == 'p' & $i == 0) {
								/*$this->Writer->startElement('p');
									if ($this->ContentPTagID) {
										$this->Writer->writeAttribute('id', $this->ContentPTagID);
									}
									
									if ($this->ContentPTagClass) {
										$this->Writer->writeAttribute('class', $this->ContentPTagClass);
									}
									
									if ($this->ContentPTagStyle) {
										$this->Writer->writeAttribute('style', $this->ContentPTagStyle);
									}*/
								$this->Writer->writeRaw("\n\t");
								$this->Writer->writeRaw(current($this->Content));
								$this->Writer->writeRaw("\n  ");
								$this->Writer->endElement();
							} else if ($this->ContentStartTag == 'p' & $count == $i /*&& $this->ContainerObjectID == NULL*/) {
								/*print_r($this->Content);
								print "$this->ContainerObjectType\n";
								print "$i\n";*/
								$this->Writer->startElement('p');
									if ($this->ContentPTagID) {
										$this->Writer->writeAttribute('id', $this->ContentPTagID);
									}
									
									if ($this->ContentPTagClass) {
										$this->Writer->writeAttribute('class', $this->ContentPTagClass);
									}
									
									if ($this->ContentPTagStyle) {
										$this->Writer->writeAttribute('style', $this->ContentPTagStyle);
									}
									$this->Writer->writeRaw("\n    ");
									$this->Writer->writeRaw(current($this->Content));
									$this->Writer->writeRaw("\n  ");
							} else {
								$this->Writer->startElement('p');
									if ($this->ContentPTagID) {
										$this->Writer->writeAttribute('id', $this->ContentPTagID);
									}
									
									if ($this->ContentPTagClass) {
										$this->Writer->writeAttribute('class', $this->ContentPTagClass);
									}
									
									if ($this->ContentPTagStyle) {
										$this->Writer->writeAttribute('style', $this->ContentPTagStyle);
									}
									$this->Writer->writeRaw("\n    ");
									$this->Writer->writeRaw(current($this->Content));
									$this->Writer->writeRaw("\n  ");
								$this->Writer->endElement();
							}
							next($this->Content);
							$i++;
						}
						//print_r($this->Content);
					} else {
						$this->Content = $this->CreateWordWrap($this->Content);
						$this->Content .= "\n  ";
						$this->Writer->writeRaw("\n   ");
						$this->Writer->writeRaw($this->Content);
					}
					
					//print_r($this->Content);
					
					
					//$this->Writer->writeRaw("\n");
			} else if ($this->ContentStartTag){
				$this->ContentStartTag = str_replace('<','', $this->ContentStartTag);
				$this->ContentStartTag = str_replace('>','', $this->ContentStartTag);
				$this->Writer->startElement($this->ContentStartTag);
					if ($this->ContentStartTagID) {
						$this->Writer->writeAttribute('id', $this->ContentStartTagID);
					}
					
					if ($this->ContentStartTagClass) {
						$this->Writer->writeAttribute('class', $this->ContentStartTagClass);
					}
					
					if ($this->ContentStartTagStyle) {
						$this->Writer->writeAttribute('style', $this->ContentStartTagStyle);
					}
					
				$this->Content = trim($this->Content);
				if (strpos($this->Content, "\n\r")) {
					$this->Content = explode("\n\r", $this->Content);
					
					while (current($this->Content)) {
						$this->Writer->startElement('p');
							if ($this->ContentPTagID) {
								$this->Writer->writeAttribute('id', $this->ContentPTagID);
							}
							
							if ($this->ContentPTagClass) {
								$this->Writer->writeAttribute('class', $this->ContentPTagClass);
							}
							
							if ($this->ContentPTagStyle) {
								$this->Writer->writeAttribute('style', $this->ContentPTagStyle);
							}
							$this->Writer->writeRaw("\n    ");
							$this->Writer->writeRaw(current($this->Content));
							$this->Writer->writeRaw("\n  ");
						$this->Writer->endElement();
						next($this->Content);
					}
				} else {
					$this->Writer->startElement('p');
					if ($this->ContentPTagID) {
						$this->Writer->writeAttribute('id', $this->ContentPTagID);
					}
					
					if ($this->ContentPTagClass) {
						$this->Writer->writeAttribute('class', $this->ContentPTagClass);
					}
					
					if ($this->ContentPTagStyle) {
						$this->Writer->writeAttribute('style', $this->ContentPTagStyle);
					}
					$this->Writer->writeRaw("\n    ");
					$this->Writer->writeRaw($this->Content);
					$this->Writer->writeRaw("\n  ");
					$this->Writer->endElement();
				}
			}
			
			if ($this->ContentEndTag) {
				$this->Writer->endElement();
			}
			
			if ($this->EndTag) {
				$this->Writer->endElement();
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
							//$this->ContentOutput .= $hold;
							$this->Writer->writeRaw($hold);
							$this->Writer->writeRaw("\n");
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
					//$this->ContentOutput .= $contentoutput;
					$this->Writer->writeRaw($contentoutput);
					$this->Writer->writeRaw("\n");
					
					next($this->PrintIdNumberArray);
				}
			}
		}
		$this->Writer->endDocument();
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->ContentOutput = $this->Writer->flush();
		}
	}
	
	public function getOutput() {
		return $this->ContentOutput;
	}
}
?>