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

class XhtmlFlash extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $FlashPath;
	protected $Width;
	protected $Height;
	protected $Wmode;
	protected $AllowFullScreen;
	protected $AllowScriptAccess;
	protected $Quality;

	protected $FlashVars = array();

	protected $FlashVarsText;

	protected $AltText;

	protected $FlashID;
	protected $FlashStyle;
	protected $FlashClass;

	//protected $FlashRecord;

	protected $IsIE;

	/**
	 * Create an instance of XtmlFlash
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlFlash'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlFlash'][$hold];
		$this->ErrorMessage = array();

		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}

		if ($DatabaseOptions['FlashVars']) {
			$this->FlashVars = $DatabaseOptions['FlashVars'];
		}

		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
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
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];

		//unset($PageID['RevisionID']);
		//unset($PageID['CurrentVersion']);
		unset ($PageID['PrintPreview']);

		$this->LayerModule->createDatabaseTable($this->DatabaseTable);
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		//////$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('PageID' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('PageID' => $passarray));

		$this->FlashPath = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashPath'));
		$this->Width = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Height'));
		$this->Wmode = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Wmode'));
		$this->AllowFullScreen = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AllowFullScreen'));
		$this->AllowScriptAccess = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AllowScriptAccess'));
		$this->Quality = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Quality'));
		//$this->FlashRecord = $this->LayerModule->pass($this->DatabaseTable, 'getEntireRow', array());

		$this->AltText = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AltText'));

		$this->FlashID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashID'));
		$this->FlashStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashStyle'));
		$this->FlashClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashClass'));

		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagId = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagId'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->IsIE = $this->CheckUserString();

		$this->LayerModule->Disconnect($this->DatabaseTable);
	}

	protected function BuildFlashVars() {
		foreach ($this->FlashVars as $FlashVarsName => $FlashVars) {
			if (is_array($FlashVars)) {
				if (isset($FlashVars['value'])) {
					foreach($FlashVars['value'] as $Key => $Value) {
						$this->FlashVarsText .= $Key;
						$this->FlashVarsText .= '=';
						$this->FlashVarsText .= $Value;
						$this->FlashVarsText .= '&';
					}
				}
			} else if (isset($FlashVars)){
				$CurrentFlashVarsDatabaseValue = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $FlashVarsName));
				if ($CurrentFlashVarsDatabaseValue != NULL) {
					$this->FlashVarsText .= $FlashVars;
					$this->FlashVarsText .= '=';
					$this->FlashVarsText .= $CurrentFlashVarsDatabaseValue;
					$this->FlashVarsText .= '&';
				}
			}
		}
		$this->FlashVarsText = trim($this->FlashVarsText, '&');
	}

	public function CreateOutput($space) {
		$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
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
			if (strstr($this->FlashPath, "http://www.dailymotion.com")) {
				$this->Writer->startElement('iframe');
					$this->Writer->writeAttribute('frameborder', 0);
					$this->Writer->writeAttribute('width', 480);
					$this->Writer->writeAttribute('height', 270);
					
					if ($this->FlashPath) {
						$this->Writer->writeAttribute('src', $this->FlashPath);
					}
					
					if ($this->AllowFullScreen) {
						$this->Writer->writeAttribute('allowfullscreen', $this->AllowFullScreen);
					}
				$this->Writer->fullEndElement(); // END IFRAME TAG
			} else {
				$this->Writer->startElement('object');
		
				if ($this->IsIE) {
					$this->Writer->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
				}
		
				if ($this->Width) {
					$this->Writer->writeAttribute('width', $this->Width);
				}
		
				if ($this->Height) {
					$this->Writer->writeAttribute('height', $this->Height);
				}
		
				if ($this->IsIE) {
					$this->Writer->writeAttribute('id', 'player');
					$this->Writer->writeAttribute('name', 'player');
		
					if ($this->FlashStyle) {
						$this->Writer->writeAttribute('style', $this->FlashStyle);
					}
					if ($this->FlashClass) {
						$this->Writer->writeAttribute('class', $this->FlashClass);
					}
				} else {
					if ($this->FlashID) {
						$this->Writer->writeAttribute('id', $this->FlashID);
					}
					if ($this->FlashStyle) {
						$this->Writer->writeAttribute('style', $this->FlashStyle);
					}
					if ($this->FlashClass) {
						$this->Writer->writeAttribute('class', $this->FlashClass);
					}
					$this->Writer->writeAttribute('type', 'application/x-shockwave-flash');
				}
		
				if (!$this->IsIE) {
					if ($this->FlashPath) {
						$this->Writer->writeAttribute('data', $this->FlashPath);
					}
				}
		
				if ($this->FlashPath) {
					$this->Writer->startElement('param');
					$this->Writer->writeAttribute('name', 'movie');
					$this->Writer->writeAttribute('value', $this->FlashPath);
					$this->Writer->endElement();
				}
		
				if ($this->Wmode) {
					$this->Writer->startElement('param');
					$this->Writer->writeAttribute('name', 'wmode');
					$this->Writer->writeAttribute('value', $this->Wmode);
					$this->Writer->endElement();
				}
		
				if ($this->AllowFullScreen) {
					$this->Writer->startElement('param');
					$this->Writer->writeAttribute('name', 'allowfullscreen');
					$this->Writer->writeAttribute('value', $this->AllowFullScreen);
					$this->Writer->endElement();
				}
		
				if ($this->AllowScriptAccess) {
					$this->Writer->startElement('param');
					$this->Writer->writeAttribute('name', 'allowscriptaccess');
					$this->Writer->writeAttribute('value', $this->AllowScriptAccess);
					$this->Writer->endElement();
				}
		
				if ($this->Quality) {
					$this->Writer->startElement('param');
					$this->Writer->writeAttribute('name', 'quality');
					$this->Writer->writeAttribute('value', $this->Quality);
					$this->Writer->endElement();
				}
		
				if ($this->FlashVars) {
					$this->BuildFlashVars();
				}
		
				if ($this->FlashVarsText) {
					$this->Writer->startElement('param');
					$this->Writer->writeAttribute('name', 'flashvars');
					$this->Writer->writeAttribute('value', $this->FlashVarsText);
					$this->Writer->endElement();
				}
		
		
				if ($this->AltText) {
					$this->Writer->writeRaw("\t");
					$this->Writer->writeRaw($this->CreateWordWrap($this->AltText));
					$this->Writer->writeRaw("\n");
				}
		
				$this->Writer->writeRaw($this->Space);
				$this->Writer->writeRaw('  ');
				$this->Writer->endElement(); // END OBJECT TAG
			}
			if ($this->EndTag) {
				$this->Writer->writeRaw($this->Space);
				$this->Writer->fullEndElement(); // ENDS END TAG
				$this->Writer->writeRaw("\n");
			}
		}
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	public function createFlash(array $Flash) {
		if ($Flash != NULL) {
			$this->LayerModule->pass ($this->DatabaseTable, 'BuildFieldNames', array('TableName' => $this->DatabaseTable));
			$Keys = $this->LayerModule->pass ($this->DatabaseTable, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $Flash, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createFlash: Flash cannot be NULL!');
		}
	}
	
	public function updateFlash(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'updateFlash: PageID cannot be NULL!');
		}
	}

	public function deleteFlash(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'deleteFlash: PageID cannot be NULL!');
		}
	}

	public function updateFlashStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];

			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->DatabaseTable);
			}

			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->DatabaseTable);
			}
		} else {
			array_push($this->ErrorMessage,'updateFlashStatus: PageID cannot be NULL!');
		}
	}
}
?>