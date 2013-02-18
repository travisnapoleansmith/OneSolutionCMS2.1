<?php
/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2013 One Solution CMS
* This content management system is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* (at your option) any later version.
*
* This content management system is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/gpl-2.0.txt
* @version    2.1.141, 2013-01-14
*************************************************************************************
*/

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

	/**
	 * Create an instance of XtmlContent
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		$hold = $TableNames['Content'];
		$GLOBALS['ErrorMessage']['XhtmlContent'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlContent'][$hold];
		$this->ErrorMessage = array();

		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}

		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}

		if ($DatabaseOptions['NoAttributes']) {
			$this->NoAttributes = $DatabaseOptions['NoAttributes'];
			unset($DatabaseOptions['NoAttributes']);
		}

		if ($DatabaseOptions['Insert']) {
			$this->Insert = $DatabaseOptions['Insert'];
			unset($DatabaseOptions['Insert']);
		}

		reset($TableNames);
		$this->ContentTableName = current($TableNames);
		$this->ContentLayerTablesName = next($TableNames);
		$this->ContentPrintPreviewTableName = next($TableNames);
		$this->ContentLayerModulesTableName = next($TableNames);
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

		//$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
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

			//$this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'setDatabaseField', array('idnumber' => $passarray));
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

	protected function buildXhtmlContentObject ($PageID, $ContainerObjectID, $PrintPreview, $LayerModule, $print) {
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

			$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->LayerModule, FALSE);

			while ($this->EnableDisable) {
				if ($this->ContainerObjectType) {
					$containertype = $this->ContainerObjectType;
					if ($containertype ==  'XhtmlContent') {
						if ($this->ContainerObjectID) {
							if ($this->ContainerObjectPrintPreview == 'true' | ($this->ContainerObjectPrintPreview == 'false' && !$this->PrintPreview)) {
								$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->LayerModule, TRUE);
							}
						}

					} else if ($containertype == 'XhtmlMenu') {
						if (($this->PrintPreview & $this->ContainerObjectPrintPreview) | !$this->PrintPreview) {
							$filename = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
							$filename .= '/';
							$filename .= 'Configuration/Tier6-ContentLayer/' . $this->ContainerObjectTypeName .'.php';
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
				$this->buildXhtmlContentObject ($this->PageID, $temp, $this->PrintPreview, $this->LayerModule, FALSE);
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
			$this->LayerModule->pass ($this->ContentTableName, 'BuildFieldNames', array('TableName' => $this->ContentTableName));
			$Keys = $this->LayerModule->pass ($this->ContentTableName, 'getRowFieldNames', array());
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
			$this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'BuildFieldNames', array('TableName' => $this->ContentPrintPreviewTableName));
			$Keys = $this->LayerModule->pass ($this->ContentPrintPreviewTableName, 'getRowFieldNames', array());
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