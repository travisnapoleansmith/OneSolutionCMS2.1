<?php

class XhtmlContent extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $ContentTableName;
	protected $ContentLayerTablesName;
	protected $ContentPrintPreviewTableName;
	protected $ContentLayerModulesTableName;
	
	protected $ContentLayerModulesTable;
	protected $PrintIdNumberArray;
	
	protected $ContainerObjectType;
	protected $ContainerObjectTypeName;
	protected $ContainerObjectID;
	protected $ContainerObjectPrintPreview;
	//protected $RevisionID;
	//protected $CurrentVersion;
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
	
	protected $OutputReturn = FALSE;
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		$hold = $tablenames['Content'];
		$GLOBALS['ErrorMessage']['XhtmlContent'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlContent'][$hold];
		$this->ErrorMessage = array();
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
		
		if ($databaseoptions['NoAttributes']) {
			$this->NoAttributes = $databaseoptions['NoAttributes'];
			unset($databaseoptions['NoAttributes']);
		}
		
		if ($databaseoptions['Insert']) {
			$this->Insert = $databaseoptions['Insert'];
			unset($databaseoptions['Insert']);
		}
		
		reset($tablenames);
		$this->ContentTableName = current($tablenames);
		$this->ContentLayerTablesName = next($tablenames);
		$this->ContentPrintPreviewTableName = next($tablenames);
		$this->ContentLayerModulesTableName = next($tablenames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user; 
		$this->Password = $password; 
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;

		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentTableName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentLayerTablesName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentPrintPreviewTableName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentLayerModulesTableName);
		
	}
	
	public function getLayerModule() {
		return $this->LayerModule;
	}
	
	public function getContentLayerTables() {
		return $this->LayerModule;
	}
	
	public function getContentTableName() {
		return $this->ContentTableName;
	}

	public function getContentLayerTablesName() {
		return $this->ContentLayerTablesName;
	}
	
	public function getContentPrintPreviewTable() {
		return $this->LayerModule;
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
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		unset($PageID['printpreview']);
		
		$this->LayerModule->Connect($this->ContentTableName);
		$passarray = array();
		$passarray = $PageID;
		
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));

		$this->ContainerObjectType = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectType'));
	    $this->ContainerObjectTypeName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectTypeName'));
		$this->ContainerObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectID'));
		$this->ContainerObjectPrintPreview = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectPrintPreview'));
	    $this->Empty = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Empty'));
		
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->Heading = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Heading'));
		$this->HeadingStartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTag'));
		$this->HeadingEndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingEndTag'));
		$this->HeadingStartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagID'));
		$this->HeadingStartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagClass'));
		$this->HeadingStartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagStyle'));
	
		$this->Content = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Content'));
		$this->ContentStartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTag'));
		$this->ContentEndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentEndTag'));
		$this->ContentStartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagClass'));
		$this->ContentStartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagStyle'));
		
		$this->ContentPTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentPTagID'));
		$this->ContentPTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentPTagClass'));
		$this->ContentPTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentPTagStyle'));
		
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->LayerModule->Disconnect($this->ContentTableName);
		
		if ($this->PrintPreview) {
			$this->PrintIdNumberArray = array();
			$passarray = array();
			$passarray['PageID'] = $PageID['PageID'];
			$this->LayerModule->Connect($this->ContentPrintPreviewTableName);
			
			$this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'setDatabaseField', array('idnumber' => $passarray));
			$this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'setDatabaseRow', array('idnumber' => $passarray));
			$i = 1;
			$hold = $this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'getRowField', array('rowfield' => "PrintPageID$i"));
			while ($hold) {
				$this->PrintIdNumberArray["PrintPageID$i"] = $hold;
				$i++;
				$hold = $this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'getRowField', array('rowfield' => "PrintPageID$i"));
			}
			$this->LayerModule->Disconnect($this->ContentPrintPreviewTableName);
		}
	}
	
	protected function buildObject($PageID, $ObjectID, $ContainerObjectType, $ContainerObjectTypeName, $print) {
		$modulesidnumber = Array();
		$modulesidnumber['PageID'] = $PageID;
		$modulesidnumber['ObjectID'] = $ObjectID;
		$modulesidnumber['PrintPreview'] = $this->PrintPreview;
		
		if ($this->RevisionID) {
			$modulesidnumber['RevisionID'] = $this->RevisionID;
		} 
		
		if ($this->CurrentVersion) {
			$modulesidnumber['CurrentVersion'] = $this->CurrentVersion;
		} else {
			$modulesidnumber['CurrentVersion'] = 'true';
		}
		
		$ContentLayerTableArray = Array();
		$ContentLayerTableArray['ObjectType'] = $ContainerObjectType;
		$ContentLayerTableArray['ObjectTypeName'] = $ContainerObjectTypeName;
		
		$this->LayerModule->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
		$this->LayerModule->setDatabaseTable ($this->ContentLayerTablesName);
		$this->LayerModule->Connect($this->ContentLayerTablesName);
		
		$this->LayerModule->pass ($this->ContentLayerTablesName, 'setDatabaseRow', array('idnumber' => $ContentLayerTableArray));
		$this->LayerModule->Disconnect($this->ContentLayerTablesName);
		
		$hold = 'DatabaseTable';
		$i = 1;
		$databasetablename = Array();
		$hold .= $i;
		
		while ($this->LayerModule->pass ($this->ContentLayerTablesName, 'getRowField', array('rowfield' => $hold))) {
			array_push($databasetablename, $this->LayerModule->pass ($this->ContentLayerTablesName, 'getRowField', array('rowfield' => $hold)));
			$i++;
			$hold = 'DatabaseTable';
			$hold .= $i;
		}
			
		$modulesdatabase = Array();
		while (current($databasetablename)) {
			$modulesdatabase[current($databasetablename)] = current($databasetablename);
			next($databasetablename);
		}
		$temp = &$GLOBALS['Tier6Databases'];
		$module = &$temp->getModules($ContainerObjectType, $ContainerObjectTypeName);
		
		reset($databasetablename);
		$module->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($databasetablename));
		$module->setHttpUserAgent($this->HttpUserAgent);
		$module->FetchDatabase($modulesidnumber);
		
		if ($print == TRUE) {
			$module->CreateOutput('    ');
		} else {
			return $module;
		}
	}
	
	protected function buildXhtmlContentObject ($PageID, $ContainerObjectID, $PrintPreview, $LayerModule, $LayerModule, $print) {
		$contentidnumber = Array();
		$contentidnumber['PageID'] = $PageID;
		$contentidnumber['ObjectID'] = $ContainerObjectID;
		$contentidnumber['printpreview'] = $PrintPreview;
		if ($this->RevisionID) {
			$contentidnumber['RevisionID'] = $this->RevisionID;
		}
		$contentidnumber['CurrentVersion'] = $this->CurrentVersion;
		
		$contentdatabase = Array();
		$contentdatabase[$this->ContentTableName] = $LayerModule;
		$contentdatabase[$this->ContentLayerTablesName] = $LayerModule;
		$this->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTable);
		$this->FetchDatabase ($contentidnumber);
		if ($print == TRUE) {
			$this->buildOutput($this->Space);
		} 
	}
	
	protected function buildOutput ($Space) {
		$this->Space = $Space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved' & (($this->PrintPreview & $this->ContainerObjectPrintPreview == 'true') | !$this->PrintPreview)) {
			parent::buildOutput($Space);
			if (!$this->Insert) {
				if ($this->EndTag) {
					$this->Writer->writeRaw("   ");
					$this->Writer->endElement();
				}
			}
			
			$this->OutputReturn = TRUE;
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
			$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->LayerModule, $this->LayerModule, FALSE);
			while ($this->EnableDisable) {
				if ($this->ContainerObjectType) {
					$containertype = $this->ContainerObjectType;
					
					if ($containertype ==  'XhtmlContent') {
						if ($this->ContainerObjectID) {
							if ($this->ContainerObjectPrintPreview == 'true' | ($this->ContainerObjectPrintPreview == 'false' && !$this->PrintPreview)) {
								$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->LayerModule, $this->LayerModule, TRUE);
							}
						}
					} else if ($containertype == 'XhtmlMenu') {
						if (($this->PrintPreview & $this->ContainerObjectPrintPreview) | !$this->PrintPreview) {
							$filename = 'Configuration/Tier6-ContentLayer/' . $this->ContainerObjectTypeName .'.php';
							require($filename);
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
				$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->LayerModule, $this->LayerModule, FALSE);
			}
			if ($this->Insert) {
				reset($this->Insert);
				while (current($this->Insert)) {
					$this->Writer->startElement('p');
					$this->Writer->writeAttribute('style', 'position: relative; left: 20px;');
						$this->Writer->startElement('span');
						$this->Writer->writeAttribute('style', 'color: #FFCC00;');
						$this->Writer->text(key($this->Insert));
						$this->Writer->writeRaw(":\n\t<br /> \n\t  ");
						$this->Writer->endElement();
					$this->Writer->writeRaw(current($this->Insert));
					$this->Writer->writeRaw("\n\t");
					$this->Writer->endElement();
					next ($this->Insert);
				}
				$this->Writer->writeRaw("   ");
				$this->Writer->endElement();
				
			} 
			
			// MUST BE INTEGRATED INTO Tier6ContentLayerModulesAbstract's CreateOutput
			if ($this->PrintPreview & !$NoPrintPreview) {
				reset($this->PrintIdNumberArray);
				next($this->PrintIdNumberArray);
				while (current($this->PrintIdNumberArray)) {
					$holdnow = current($this->PrintIdNumberArray);
					$contentidnumber = Array();
					$contentidnumber['PageID'] = $holdnow;
					$contentidnumber['ObjectID'] = 0;
					$contentidnumber['printpreview'] = TRUE;
					if ($this->RevisionID) {
						$contentidnumber['RevisionID'] = $this->RevisionID;
					}
					$contentidnumber['CurrentVersion'] = $this->CurrentVersion;
					
					$contentdatabase = Array();
					$contentdatabase[$this->ContentTableName] = $this->ContentTableName;
					$contentdatabase[$this->ContentLayerTablesName] = $this->ContentLayerTablesName;
					$contentdatabase[$this->ContentPrintPreviewTableName] = $this->ContentPrintPreviewTableName;
					
					$databaseoptions = NULL;
					
					$content = new XhtmlContent($contentdatabase, $databaseoptions, $this->LayerModule);
					$content->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTable);
					$content->setHttpUserAgent($this->HttpUserAgent);
					$content->FetchDatabase ($contentidnumber);
					$content->CreateOutput('    ', TRUE);
					
					$contentoutput = $content->getOutput();
					$this->Writer->writeRaw($contentoutput);
					$this->Writer->writeRaw("\n");
					
					next($this->PrintIdNumberArray);
				}
			}
			
			$this->OutputReturn = TRUE;
		}
		if ($this->FileName) {
			$this->Writer->flush();
		}
		
		if ($this->OutputReturn) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function getOutput() {
		return $this->ContentOutput;
	}
	
	public function getLastContentPageID() {
		$this->LayerModule->Connect($this->ContentTableName);
		$this->LayerModule->pass ($this->ContentTableName, 'setOrderbyname', array('orderbyname' => 'PageID` DESC, `ObjectID` DESC, `RevisionID'));
		$this->LayerModule->pass ($this->ContentTableName, 'setOrderbytype', array('orderbytype' => 'DESC'));
		$this->LayerModule->pass ($this->ContentTableName, 'setLimit', array('limit' => 1));
		$this->LayerModule->pass ($this->ContentTableName, 'setEntireTable', array());
		$this->LayerModule->Disconnect($this->ContentTableName);
		
		$hold = $this->LayerModule->pass ($this->ContentTableName, 'getEntireTable', array());
		
		$hold2 = $hold[1]['PageID'];
		return $hold2;
	}
	
	public function createContent(array $Content) {
		if ($Content != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'ContainerObjectType';
			$Keys[3] = 'ContainerObjectTypeName';
			$Keys[4] = 'ContainerObjectID';
			$Keys[5] = 'ContainerObjectPrintPreview';
			$Keys[6] = 'RevisionID';
			$Keys[7] = 'CurrentVersion';
			$Keys[8] = 'Empty';
			$Keys[9] = 'StartTag';
			$Keys[10] = 'EndTag';
			$Keys[11] = 'StartTagID';
			$Keys[12] = 'StartTagStyle';
			$Keys[13] = 'StartTagClass';
			$Keys[14] = 'Heading';
			$Keys[15] = 'HeadingStartTag';
			$Keys[16] = 'HeadingEndTag';
			$Keys[17] = 'HeadingStartTagID';
			$Keys[18] = 'HeadingStartTagStyle';
			$Keys[19] = 'HeadingStartTagClass';
			$Keys[20] = 'Content';
			$Keys[21] = 'ContentStartTag';
			$Keys[22] = 'ContentEndTag';
			$Keys[23] = 'ContentStartTagID';
			$Keys[24] = 'ContentStartTagStyle';
			$Keys[25] = 'ContentStartTagClass';
			$Keys[26] = 'ContentPTagID';
			$Keys[27] = 'ContentPTagStyle';
			$Keys[28] = 'ContentPTagClass';
			$Keys[29] = 'Enable/Disable';
			$Keys[30] = 'Status';
			
			$this->addModuleContent($Keys, $Content, $this->ContentTableName);
		} else {
			array_push($this->ErrorMessage,'createContent: Content cannot be NULL!');
		}
	}
	
	public function updateContent(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->ContentTableName);
		} else {
			array_push($this->ErrorMessage,'updateContent: PageID cannot be NULL!');
		}
	}
	
	public function updateContentStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->ContentTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->ContentTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->ContentTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->ContentTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->ContentTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->ContentTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateContentStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteContent(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->ContentTableName);
		} else {
			array_push($this->ErrorMessage,'deleteContent: PageID cannot be NULL!');
		}
	}
	
	public function createContentPrintPreview(array $Content) {
		if ($Content != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'PrintPageID1';
			$Keys[2] = 'PrintPageID2';
			$Keys[3] = 'PrintPageID3';
			$Keys[4] = 'PrintPageID4';
			$Keys[5] = 'PrintPageID5';
			$Keys[6] = 'PrintPageID6';
			$Keys[7] = 'PrintPageID7';
			$Keys[8] = 'PrintPageID8';
			$Keys[9] = 'PrintPageID9';
			$Keys[10] = 'PrintPageID10';
			$Keys[11] = 'PrintPageID11';
			$Keys[12] = 'PrintPageID12';
			$Keys[13] = 'PrintPageID13';
			$Keys[14] = 'PrintPageID14';
			$Keys[15] = 'PrintPageID15';
			$Keys[16] = 'PrintPageID16';
			$Keys[17] = 'PrintPageID17';
			$Keys[18] = 'PrintPageID18';
			$Keys[19] = 'PrintPageID19';
			$Keys[20] = 'PrintPageID20';
			$Keys[21] = 'Enable/Disable';
			$Keys[22] = 'Status';
			
			$this->addModuleContent($Keys, $Content, $this->ContentPrintPreviewTableName);
		} else {
			array_push($this->ErrorMessage,'createContentPrintPreview: Content cannot be NULL!');
		}
	}
	
	public function updateContentPrintPreview(array $PageID) {
		if ($PageID != NULL) {
			$this->updateRecord($PageID['PageID'], $PageID['Content'], $this->ContentPrintPreviewTableName);
		} else {
			array_push($this->ErrorMessage,'updateContentPrintPreview: PageID cannot be NULL!');
		}
	}
	
	public function updateContentPrintPreviewStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->ContentPrintPreviewTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->ContentPrintPreviewTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->ContentPrintPreviewTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->ContentPrintPreviewTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->ContentPrintPreviewTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->ContentPrintPreviewTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateContentPrintPreviewStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteContentPrintPreview(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->ContentPrintPreviewTableName);
		} else {
			array_push($this->ErrorMessage,'deleteContentPrintPreview: PageID cannot be NULL!');
		}
	}
	
}
?>