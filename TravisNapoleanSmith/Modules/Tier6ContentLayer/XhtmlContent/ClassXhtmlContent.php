<?php
class XhtmlContent {
	var $PageID;
	var $ObjectID;
	var $ContentTable;
	var $ContentLayerTables;
	var $ContentTableName;
	var $ContentLayerTablesName;
	
	var $PrintPreview;
	
	var $hostname;
	var $user; 
	var $password; 
	var $databasename;
	var $databasetable;
	
	var $ContainerObjectType;
	var $ContainerObjectTypeName;
	var $ContainerObjectID;
	var $ContainerObjectPrintPreview;
	var $RevisionID;
	var $CurrentVersion;
	var $Empty;
	
	var $StartTag;
	var $EndTag;
	var $StartTagID;
	var $StartTagStyle;
	var $StartTagClass;
	
	var $Heading;
	var $HeadingStartTag;
	var $HeadingEndTag;
	var $HeadingStartTagID;
	var $HeadingStartTagClass;
	var $HeadingStartTagStyle;
	
	var $Content;
	var $ContentStartTag;
	var $ContentEndTag;
	var $ContentStartTagID;
	var $ContentStartTagClass;
	var $ContentStartTagStyle;
	
	var $EnableDisable;
	var $Status;
	
	var $Space;
	var $ContentOutput;
	var $HttpUserAgent;
	var $errormessage;
	
	function XhtmlContent($tablenames, $database) {
		$this->ContentTable = &$database;
		$this->ContentTableName = current($tablenames);
		$this->ContentLayerTables = &$database;
		$this->ContentLayerTablesName = next($tablenames);
	}
	
	function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user; 
		$this->password = $password; 
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;

		$this->ContentTable->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentTable->setDatabasetable ($this->ContentTableName);
		$this->ContentLayerTables->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->ContentLayerTables->setDatabasetable ($this->ContentLayerTablesName);
		
	}
	
	function setPageID($PageID) {
		$this->PageID = $PageID;
	}
	
	function getPageID() {
		return $this->PageID;
	}
	
	function setObjectID($ObjectID) {
		$this->ObjectID = $ObjectID;
	}
	
	function getObjectID() {
		return $this->ObjectID;
	}
	
	function getContentTable() {
		return $this->ContentTable;
	}
	
	function getContentLayerTables() {
		return $this->ContentLayerTables;
	}
	
	function getContentTableName() {
		return $this->ContentTableName;
	}
	
	function getContentLayerTablesName() {
		return $this->ContentLayerTablesName;
	}
	
	function getPrintPreview() {
		return $this->PrintPreview;
	}
	
	function gethostname() {
		return $this->hostname;
	}
	
	function getuser() {
		return $this->user;
	}
	
	function getpassword() {
		return $this->password;
	}
	
	function getdatabasename() {
		return $this->databasename;
	}
	
	function getdatabasetable() {
		return $this->databasetable;
	}
	
	function getContainerObjectType() {
		return $this->ContainerObjectType;
	}
	
	function getContainerObjectID() {
		return $this->ContainerObjectID;
	}
	
	function getContainerObjectPrintPreview() {
		return $this->ContainerObjectPrintPreview;
	}
	
	function getRevisionID() {
		return $this->RevisionID;
	}
	
	function getCurrentVersion() {
		return $this->CurrentVersion;
	}
	
	function getEmpty() {
		return $this->Empty;
	}
	
	function getStartTag() {
		return $this->StartTag;
	}
	
	function getEndTag() {
		return $this->EndTag;
	}
	
	function getStartTagID() {
		return $this->StartTagID;
	}
	
	function getStartTagStyle() {
		return $this->StartTagStyle;
	}		
	
	function getStartTagClass() {
		return $this->StartTagClass;
	}
	
	function getHeading() {
		return $this->Heading;
	}
		
	function getHeadingStartTag() {
		return $this->HeadingStartTag;
	}
	
	function getHeadingEndTag() {
		return $this->HeadingEndTag;
	}	
	
	function getHeadingStartTagID() {
		return $this->HeadingStartTagID;
	}
	
	function getHeadingStartTagClass() {
		return $this->HeadingStartTagClass;
	}
	
	function getHeadingStartTagStyle() {
		return $this->HeadingStartTagStyle;
	}
	
	function getContent() {
		return $this->Content;
	}
	
	function getContentStartTag() {
		return $this->ContentStartTag;
	}
	
	function getContentEndTag() {
		return $this->ContentEndTag;
	}
	
	function getContentStartTagID() {
		return $this->ContentStartTagID;
	}
	
	
	function getContentStartTagClass() {
		return $this->ContentStartTagClass;
	}
	
	function getContentStartTagStyle() {
		return $this->ContentStartTagStyle;
	}
	
	function getEnableDisable() {
		return $this->EnableDisable;
	}
	
	function getStatus() {
		return $this->Status;
	}
	
	function getSpace() {
		return $this->Space;
	}	
	
	function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	
	function getError ($idnumber) {
		return $this->errormessage[$idnumber];
	}
	
	function getErrorArray() {
		return $this->errormessage;
	}
	
	function FetchDatabase ($PageID) {
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
	}
	
	function CreateWordWrap($wordwrapstring) {
		if (stristr($wordwrapstring, "<a href")) {
			// Strip AHef Tags for wordwrap then put them back in
			$firstpos = strpos($wordwrapstring, "<a href");
			$lastpos = strpos($wordwrapstring, "</a>");
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
			$returnstring = str_replace (" ", "<SPACE>", $returnstring);
			$wordwrapstring = str_replace ($endstring, $returnstring, $wordwrapstring);
			// END STRIP AHREF TAG FOR WORDWRAP
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
		}
		return $wordwrapstring;
	}
	
	function buildModules($moduleslocation) {
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
	
	function buildObject($PageID, $ObjectID, $ContainerObjectType, $ContainerObjectTypeName, $print) {
		$modulesidnumber = Array();
		$modulesidnumber['PageID'] = $PageID;
		$modulesidnumber['ObjectID'] = $ObjectID;
		
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
	
	function buildXhtmlContentObject ($PageID, $ContainerObjectID, $PrintPreview, $ContentTable, $ContentLayerTables, $print) {
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
	
	function buildOutput ($Space) {
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
				if($this->Space) {
					$this->ContentOutput .= $this->Space;
				} else {
					$this->ContentOutput .= '  ';
				}
				$this->ContentOutput .= $this->HeadingEndTag;
				$this->ContentOutput .= "\n";
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
						$this->ContentOutput .= $this->Space;
					}
					$this->ContentOutput .= $this->ContentStartTag;
					
					if ($this->Content) {
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
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
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
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
						if($this->Space) {
							$this->ContentOutput .= $this->Space;
							$this->ContentOutput .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						} else {
							$this->ContentOutput .= '  ';
							$this->ContentOutput .= $this->Content;
							$this->ContentOutput .= "\n";
						}
					}
					$this->ContentOutput .= "\n";
				}
			}
			
			if ($this->ContentEndTag) {
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
	
	function CreateOutput($space) {
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
		}
	}
	
	function getOutput() {
		return $this->ContentOutput;
	}
}
?>