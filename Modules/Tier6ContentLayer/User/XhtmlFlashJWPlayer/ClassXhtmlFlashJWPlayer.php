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

class XhtmlFlashJWPlayer extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {

	/**
	 * Create an instance of XtmlFlashJWPlayer
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlFlashJWPlayer'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlFlashJWPlayer'][$hold];
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

		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));

		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));

		$this->LayerModule->Disconnect($this->DatabaseTable);

	}

	public function CreateOutput($space) {
		require_once 'Modules/Tier6ContentLayer/Core/XhtmlFlash/ClassXhtmlFlash.php';
		$this->Space = $space;

		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			$PageID = array();
			$PageID['PageID'] = $this->PageID;
			$PageID['ObjectID'] = $this->ObjectID;
			$PageID['RevisionID'] = $this->RevisionID;
			$PageID['CurrentVersion'] = $this->CurrentVersion;

			$FlashDatabase = Array();
			$FlashDatabase['Flash'] = $this->DatabaseTable;

			$DatabaseOptions = Array();
			$DatabaseOptions['FlashVars'] = array();

			// EXAMPLE OF PASSING DATA TO FLASHVARS
			//$DatabaseOptions['FlashVars']['GalleryUrl']['value']['galleryURL'] = $GalleryUrl;

			// FlashVars File Properties
			$DatabaseOptions['FlashVars']['FlashVarsAuthor']= 'author';
			$DatabaseOptions['FlashVars']['FlashVarsDate']= 'date';
			$DatabaseOptions['FlashVars']['FlashVarsDescription']= 'description';
			$DatabaseOptions['FlashVars']['FlashVarsDuration']= 'duration';
			$DatabaseOptions['FlashVars']['FlashVarsFile']= 'file';
			$DatabaseOptions['FlashVars']['FlashVarsImage']= 'image';
			$DatabaseOptions['FlashVars']['FlashVarsLink']= 'link';
			$DatabaseOptions['FlashVars']['FlashVarsStart']= 'start';
			$DatabaseOptions['FlashVars']['FlashVarsStreamer']= 'streamer';
			$DatabaseOptions['FlashVars']['FlashVarsTags']= 'tags';
			$DatabaseOptions['FlashVars']['FlashVarsTitle']= 'title';
			$DatabaseOptions['FlashVars']['FlashVarsType']= 'type';

			//FlashVars Layout Properties
			$DatabaseOptions['FlashVars']['FlashVarsBackColor']= 'backcolor';
			$DatabaseOptions['FlashVars']['FlashVarsControlBar']= 'controlbar';
			$DatabaseOptions['FlashVars']['FlashVarsDock']= 'dock';
			$DatabaseOptions['FlashVars']['FlashVarsFrontColor']= 'frontcolor';
			$DatabaseOptions['FlashVars']['FlashVarsHeight']= 'height';
			$DatabaseOptions['FlashVars']['FlashVarsIcons']= 'icons';
			$DatabaseOptions['FlashVars']['FlashVarsLightColor']= 'lightcolor';
			$DatabaseOptions['FlashVars']['FlashVarsLogo']= 'logo';
			$DatabaseOptions['FlashVars']['FlashVarsPlaylist']= 'playlist';
			$DatabaseOptions['FlashVars']['FlashVarsPlaylistSize']= 'playlistsize';
			$DatabaseOptions['FlashVars']['FlashVarsSkin']= 'skin';
			$DatabaseOptions['FlashVars']['FlashVarsScreenColor']= 'screencolor';
			$DatabaseOptions['FlashVars']['FlashVarsWidth']= 'width';

			//FlashVars Behavior Properties
			$DatabaseOptions['FlashVars']['FlashVarsAutoStart']= 'autostart';
			$DatabaseOptions['FlashVars']['FlashVarsBufferLength']= 'bufferlength';
			$DatabaseOptions['FlashVars']['FlashVarsDisplayClick']= 'displayclick';
			$DatabaseOptions['FlashVars']['FlashVarsDisplayTitle']= 'displaytitle';
			$DatabaseOptions['FlashVars']['FlashVarsFullScreen']= 'fullscreen';
			$DatabaseOptions['FlashVars']['FlashVarsItem']= 'item';
			$DatabaseOptions['FlashVars']['FlashVarsLinkTarget']= 'linktarget';
			$DatabaseOptions['FlashVars']['FlashVarsMute']= 'mute';
			$DatabaseOptions['FlashVars']['FlashVarsRepeat']= 'repeat';
			$DatabaseOptions['FlashVars']['FlashVarsShuffle']= 'shuffle';
			$DatabaseOptions['FlashVars']['FlashVarsSmoothing']= 'smoothing';
			$DatabaseOptions['FlashVars']['FlashVarsState']= 'state';
			$DatabaseOptions['FlashVars']['FlashVarsStretching']= 'stretching';
			$DatabaseOptions['FlashVars']['FlashVarsVolume']= 'volume';

			//FlashVars API Properties
			$DatabaseOptions['FlashVars']['FlashVarsClient']= 'client';
			$DatabaseOptions['FlashVars']['FlashVarsDebug']= 'debug';
			$DatabaseOptions['FlashVars']['FlashVarsId']= 'id';
			$DatabaseOptions['FlashVars']['FlashVarsPlugins']= 'plugins';
			$DatabaseOptions['FlashVars']['FlashVarsVersion']= 'version';

			//FlashVars ConfigXML Properties
			$DatabaseOptions['FlashVars']['FlashVarsConfig']= 'config';

			$Flash = new XhtmlFlash($FlashDatabase, $DatabaseOptions, $this->LayerModule);
			$Flash->setDatabaseAll($this->Hostname, $this->User, $this->Password, $this->Databasename, $this->DatabaseTable);
			$Flash->setHttpUserAgent($this->HttpUserAgent);
			$Flash->FetchDatabase($PageID);
			$Flash->CreateOutput('  ');

			if ($this->FileName) {
				$this->Writer->flush();
			}
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