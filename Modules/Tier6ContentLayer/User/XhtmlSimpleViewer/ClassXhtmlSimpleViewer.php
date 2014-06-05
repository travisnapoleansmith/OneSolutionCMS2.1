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

class XhtmlSimpleViewer extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $SimpleViewerFlashTableName;
	protected $SimpleViewerFlashObjectName;
	protected $SimpleViewerLookup;
	
	protected $Flash;
	/**
	 * Create an instance of XtmlSimpleViewer
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlSimpleViewer'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlSimpleViewer'][$hold];
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
		//$this->RevisionID = $PageID['RevisionID'];
		//$this->CurrentVersion = $PageID['CurrentVersion'];
		unset ($PageID['PrintPreview']);
		unset ($PageID['RevisionID']);
		unset ($PageID['CurrentVersion']);
		
		$PageID['CurrentVersion'] = 'true';
		$this->CurrentVersion = $PageID['CurrentVersion'];
		
		$this->LayerModule->createDatabaseTable($this->DatabaseTable);
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->RevisionID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'RevisionID'));
		
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));

		$this->SimpleViewerFlashTableName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerFlashTableName'));
		$this->SimpleViewerFlashObjectName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerFlashObjectName'));

		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));

		//$this->LayerModule->Disconnect($this->DatabaseTable);

		$this->LayerModule->createDatabaseTable($this->SimpleViewerFlashTableName);
		$this->LayerModule->Connect($this->SimpleViewerFlashTableName);

		$this->LayerModule->pass ($this->SimpleViewerFlashTableName, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->SimpleViewerFlashTableName, 'setDatabaseRow', array('idnumber' => $passarray));

		$this->SimpleViewerLookup = $this->LayerModule->pass ($this->SimpleViewerFlashTableName, 'getMultiRowField', array());
		$this->SimpleViewerLookup = $this->SimpleViewerLookup[0];

		//$this->LayerModule->Disconnect($this->SimpleViewerFlashTableName);
		
		$GalleryUrl = "/Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=";
		$GalleryUrl .= $this->SimpleViewerLookup['SimpleViewerPageID'];
		$GalleryUrl .= '%26ObjectID=';
		$GalleryUrl .= $this->SimpleViewerLookup['SimpleViewerObjectID'];
		
		$PageID = array();
		$PageID['PageID'] = $this->SimpleViewerLookup['SimpleViewerPageID'];
		$PageID['ObjectID'] = $this->SimpleViewerLookup['SimpleViewerObjectID'];
		$PageID['RevisionID'] = $this->SimpleViewerLookup['SimpleViewerRevisionID'];
		$PageID['CurrentVersion'] = $this->SimpleViewerLookup['SimpleViewerCurrentVersion'];

		$FlashDatabase = Array();
		$FlashDatabase['Flash'] = $this->SimpleViewerLookup['SimpleViewerTableName'];

		$DatabaseOptions = Array();
		$DatabaseOptions['FlashVars'] = array();
		$DatabaseOptions['FlashVars']['GalleryUrl']['value']['galleryURL'] = $GalleryUrl;
		
		// EXAMPLE OF PASSING DATABASE COLUMNS TO FLASHVARS
		//$DatabaseOptions['FlashVars']['FlashVarsVersion']= 'version';
		
		$this->Flash = new XhtmlFlash($FlashDatabase, $DatabaseOptions, $this->LayerModule);
		$this->Flash->setDatabaseAll($this->Hostname, $this->User, $this->Password, $this->Databasename, $this->SimpleViewerLookup['SimpleViewerTableName']);
		$this->Flash->setHttpUserAgent($this->HttpUserAgent);
		$this->Flash->FetchDatabase($PageID);
		
	}

	public function CreateOutput($space) {
		$HOME = $GLOBALS['HOME'];
		require_once "$HOME/Modules/Tier6ContentLayer/Core/XhtmlFlash/ClassXhtmlFlash.php";
		$this->Space = $space;

		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					$this->ProcessStandardAttribute('StartTag');
			}

			/*$GalleryUrl = "/Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=";
			$GalleryUrl .= $this->SimpleViewerLookup['SimpleViewerPageID'];
			$GalleryUrl .= '%26ObjectID=';
			$GalleryUrl .= $this->SimpleViewerLookup['SimpleViewerObjectID'];
			
			
			$PageID = array();
			$PageID['PageID'] = $this->SimpleViewerLookup['SimpleViewerPageID'];
			$PageID['ObjectID'] = $this->SimpleViewerLookup['SimpleViewerObjectID'];
			$PageID['RevisionID'] = $this->SimpleViewerLookup['SimpleViewerRevisionID'];
			$PageID['CurrentVersion'] = $this->SimpleViewerLookup['SimpleViewerCurrentVersion'];

			$FlashDatabase = Array();
			$FlashDatabase['Flash'] = $this->SimpleViewerLookup['SimpleViewerTableName'];

			$DatabaseOptions = Array();
			$DatabaseOptions['FlashVars'] = array();
			$DatabaseOptions['FlashVars']['GalleryUrl']['value']['galleryURL'] = $GalleryUrl;
			
			
			// EXAMPLE OF PASSING DATABASE COLUMNS TO FLASHVARS
			//$DatabaseOptions['FlashVars']['FlashVarsVersion']= 'version';

			$this->Flash = new XhtmlFlash($FlashDatabase, $DatabaseOptions, $this->LayerModule);
			$this->Flash->setDatabaseAll($this->Hostname, $this->User, $this->Password, $this->Databasename, $this->SimpleViewerLookup['SimpleViewerTableName']);
			$this->Flash->setHttpUserAgent($this->HttpUserAgent);
			$this->Flash->FetchDatabase($PageID);
			*/
			$this->Flash->CreateOutput('  ');
			
			if ($this->EndTag) {
				$this->Writer->fullEndElement(); // ENDS END TAG
			}

		}

		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	public function createFlash(array $Flash) {
		if (isset($Flash['OBJECT'])) {
			$Object = $Flash['OBJECT'];
			unset($Flash['OBJECT']);
			$Object->createFlash($Flash);
		} else {
			$this->Flash->createFlash($Flash);
		}
	}
	
	public function updateFlash(array $PageID) {
		if (isset($PageID['OBJECT'])) {
			$Object = $PageID['OBJECT'];
			unset($PageID['OBJECT']);
			$Object->updateFlash($PageID);
		} else {
			$this->Flash->updateFlash($PageID);
		}
	}
	
	public function deleteFlash(array $PageID) {
		if (isset($PageID['OBJECT'])) {
			$Object = $PageID['OBJECT'];
			unset($PageID['OBJECT']);
			$Object->deleteFlash($PageID);
		} else {
			$this->Flash->deleteFlash($PageID);
		}
	}
	
	public function updateFlashStatus(array $PageID) {
		if (isset($PageID['OBJECT'])) {
			$Object = $PageID['OBJECT'];
			unset($PageID['OBJECT']);
			$Object->updateFlashStatus($PageID);
		} else {
			$this->Flash->updateFlashStatus($PageID);
		}
	}
	
	public function createFlashLookup(array $Flash) {
		if ($Flash != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'RevisionID';
			$Keys[3] = 'CurrentVersion';
			$Keys[4] = 'SimpleViewerMenuName';
			$Keys[5] = 'SimpleViewerTableName';
			$Keys[6] = 'SimpleViewerPageID';
			$Keys[7] = 'SimpleViewerObjectID';
			$Keys[8] = 'Enable/Disable';
			$Keys[9] = 'Status';
			
			if (!isset($this->SimpleViewerFlashTableName)) {
				$this->SimpleViewerFlashTableName = 'FlashSimpleViewerLookup';
				$this->LayerModule->createDatabaseTable($this->SimpleViewerFlashTableName);
			}
			
			$this->addModuleContent($Keys, $Flash, $this->SimpleViewerFlashTableName);
		} else {
			array_push($this->ErrorMessage,'createFlash: Flash cannot be NULL!');
		}
	}
	
	public function updateFlashLookup(array $PageID) {
		if ($PageID != NULL) {
			if (!isset($this->SimpleViewerFlashTableName)) {
				$this->SimpleViewerFlashTableName = 'FlashSimpleViewerLookup';
				$this->LayerModule->createDatabaseTable($this->SimpleViewerFlashTableName);
			}
			
			$this->updateModuleContent($PageID, $this->SimpleViewerFlashTableName);
		} else {
			array_push($this->ErrorMessage,'updateFlash: PageID cannot be NULL!');
		}
	}

	public function deleteFlashLookup(array $PageID) {
		if ($PageID != NULL) {
			if (!isset($this->SimpleViewerFlashTableName)) {
				$this->SimpleViewerFlashTableName = 'FlashSimpleViewerLookup';
				$this->LayerModule->createDatabaseTable($this->SimpleViewerFlashTableName);
			}
			
			$this->deleteModuleContent($PageID, $this->SimpleViewerFlashTableName);
		} else {
			array_push($this->ErrorMessage,'deleteFlash: PageID cannot be NULL!');
		}
	}

	public function updateFlashLookupStatus(array $PageID) {
		if ($PageID != NULL) {
			if (!isset($this->SimpleViewerFlashTableName)) {
				$this->SimpleViewerFlashTableName = 'FlashSimpleViewerLookup';
				$this->LayerModule->createDatabaseTable($this->SimpleViewerFlashTableName);
			}
			
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];

			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->SimpleViewerFlashTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->SimpleViewerFlashTableName);
			}

			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->SimpleViewerFlashTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->SimpleViewerFlashTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->SimpleViewerFlashTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->SimpleViewerFlashTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateFlashStatus: PageID cannot be NULL!');
		}
	}
	
	public function createSimpleViewer(array $Flash) {
		if ($Flash != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'RevisionID';
			$Keys[3] = 'CurrentVersion';
			$Keys[4] = 'SimpleViewerFlashTableName';
			$Keys[5] = 'SimpleViewerFlashObjectName';
			$Keys[6] = 'StartTag';
			$Keys[7] = 'EndTag';
			$Keys[8] = 'StartTagID';
			$Keys[9] = 'StartTagClass';
			$Keys[10] = 'StartTagStyle';
			$Keys[11] = 'Enable/Disable';
			$Keys[12] = 'Status';
			
			$this->addModuleContent($Keys, $Flash, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createSimpleViewer: Flash cannot be NULL!');
		}
	}
	
	public function updateSimpleViewer(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'updateSimpleViewer: PageID cannot be NULL!');
		}
	}

	public function deleteSimpleViewer(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'deleteSimpleViewer: PageID cannot be NULL!');
		}
	}

	public function updateSimpleViewerStatus(array $PageID) {
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
			array_push($this->ErrorMessage,'updateSimpleViewerStatus: PageID cannot be NULL!');
		}
	}
}
?>