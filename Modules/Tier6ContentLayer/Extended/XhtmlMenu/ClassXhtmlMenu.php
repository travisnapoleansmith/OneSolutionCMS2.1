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

	/**
	 * Create an instance of XtmlMenu
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlMenu'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlMenu'][$hold];
		$this->ErrorMessage = array();

		$this->DatabaseTableName = current($TableNames);

		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}

		if ($DatabaseOptions['NoAttributes']) {
			$this->NoAttributes = $DatabaseOptions['NoAttributes'];
			unset($DatabaseOptions['NoAttributes']);
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
		$ConnectionID = array();
		$ConnectionID['PageID'] = $PageID['PageID'];
		$ConnectionID['ObjectID'] = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);

		$this->LayerModule->Connect($this->DatabaseTable);

		//$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $ConnectionID));
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
				if (strpos ($this->Div, $this->NewsID) | $this->NewsID == -1) {
					$this->StartTagClass = str_replace($this->ClassReplace, '', $this->StartTagClass);
					$this->StartTagClass = str_replace(' ','', $this->StartTagClass);
					$this->StartTagClass = $this->ClassClass ."$this->StartTagClass";
				}
			}

			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					if (!$this->NoAttributes) {
						$this->ProcessStandardAttribute('StartTag');
					}
			}

			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->Writer->startElement('div');
				$this->ProcessStandardAttribute('MainDiv');
			}

			if ($this->MainDiv) {
				$this->MainDiv = $this->CreateWordWrap($this->MainDiv);
				$this->Writer->writeRaw("\n$this->Space    ");
				$this->Writer->writeRaw($this->MainDiv);
				$this->Writer->writeRaw("\n$this->Space ");
			}

			/*DONT USE THIS! if($this->Space) {
				$this->List .= $this->Space;
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}*/

			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->Writer->startElement('div');
				$this->ProcessStandardAttribute('Div');
			}


			if ($this->NewsID) {
				if (strpos ($this->Div, $this->NewsID) | $this->NewsID == -1) {
					$this->Div = strip_tags($this->Div);
				}
			}

			if ($this->Div) {
				$this->Div = $this->CreateWordWrap($this->Div);
				$this->Writer->writeRaw("\n$this->Space    ");
				$this->Writer->writeRaw($this->Div);
				$this->Writer->writeRaw("\n$this->Space ");
			}

			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->Writer->endElement(); // ENDS DIV
			}

			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->Writer->endElement(); // ENDS DIV
			}

			if ($this->EndTag) {
				$this->Writer->endElement(); // ENDS END TAG
			}

		}
		if ($this->FileName) {
			$this->Writer->flush();
		}

		if ($this->NoAttributes) {
			$this->List = $this->Writer->flush();
		}
	}

	public function getOutput() {
		return $this->List;
	}

	public function createMenu(array $Menu) {
		if ($Menu != NULL) {
			$this->LayerModule->pass ($this->DatabaseTableName, 'BuildFieldNames', array('TableName' => $this->DatabaseTableName));
			$Keys = $this->LayerModule->pass ($this->DatabaseTableName, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $Menu, $this->DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'createMenu: Menu cannot be NULL!');
		}
	}

	public function updateMenu(array $PageID) {
		if ($PageID != NULL) {
			$this->updateRecord($PageID['PageID'], $PageID['Content'], $this->DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'updateMenu: PageID cannot be NULL!');
		}
	}

	public function updateMenuStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];

			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->DatabaseTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->DatabaseTableName);
			}

			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->DatabaseTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->DatabaseTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->DatabaseTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateMenuStatus: PageID cannot be NULL!');
		}
	}

	public function deleteMenu(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'deleteMenu: PageID cannot be NULL!');
		}
	}
}
?>