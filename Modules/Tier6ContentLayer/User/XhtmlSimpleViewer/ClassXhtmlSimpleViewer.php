<?php
/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2012 One Solution CMS
*
* This content management system is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2.1 of the License, or (at your option) any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.
*
* You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
* @version    2.1.139, 2012-12-27
*************************************************************************************
*/

class XhtmlSimpleViewer extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $SimpleViewerFlashTableName;
	protected $SimpleViewerFlashObjectName;
	protected $SimpleViewerLookup;

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
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		unset ($PageID['PrintPreview']);

		$this->LayerModule->createDatabaseTable($this->DatabaseTable);
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));

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

			$Flash = new XhtmlFlash($FlashDatabase, $DatabaseOptions, $this->LayerModule);
			$Flash->setDatabaseAll($this->Hostname, $this->User, $this->Password, $this->Databasename, $this->SimpleViewerLookup['SimpleViewerTableName']);
			$Flash->setHttpUserAgent($this->HttpUserAgent);
			$Flash->FetchDatabase($PageID);
			$Flash->CreateOutput('  ');

			if ($this->EndTag) {
				$this->Writer->endElement(); // ENDS END TAG
			}

		}

		if ($this->FileName) {
			$this->Writer->flush();
		}
	}

	/*public function createFlash(array $Flash) {
		if ($Flash != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'RevisionID';
			$Keys[3] = 'CurrentVersion';
			$Keys[4] = 'StartTag';
			$Keys[5] = 'EndTag';
			$Keys[6] = 'StartTagID';
			$Keys[7] = 'StartTagStyle';
			$Keys[8] = 'StartTagClass';
			$Keys[9] = 'PictureID';
			$Keys[10] = 'PictureClass';
			$Keys[11] = 'PictureStyle';
			$Keys[12] = 'PictureLink';
			$Keys[13] = 'PictureAltText';
			$Keys[14] = 'Width';
			$Keys[15] = 'Height';
			$Keys[16] = 'Enable/Disable';
			$Keys[17] = 'Status';

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
	}*/
}
?>