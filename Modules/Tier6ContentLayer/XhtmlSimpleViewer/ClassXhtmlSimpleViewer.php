<?php

class XhtmlSimpleViewer extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $SimpleViewerID;
	protected $SimpleViewerClass;
	protected $SimpleViewerStyle;
	
	protected $SimpleViewerFlashTableName;
	protected $SimpleViewerFlashObjectName;
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlSimpleViewer'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlSimpleViewer'][$hold];
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
		/*$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		unset ($PageID['PrintPreview']);
		
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
		
		$this->SimpleViewerID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerID'));
		$this->SimpleViewerClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerClass'));
		$this->SimpleViewerStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerStyle'));
		
		$this->SimpleViewerFlashTableName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerFlashTableName'));
		$this->SimpleViewerFlashObjectName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'SimpleViewerFlashObjectName'));
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
		*/		
	}
	
	public function CreateOutput($space) {
	  	require_once '../Configuration/Tier6-ContentLayer/simpleviewer.php';
		/*$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					$this->ProcessStandardAttribute('StartTag');
			}
			
			$this->Writer->startElement('div');
				$this->ProcessStandardAttribute('SimpleViewer');
				
				$FlashDatabase = Array();
				$FlashDatabase['Flash'] = $this->SimpleViewerFlashTableName;
				
				$Flash = new XhtmlFlash($FlashDatabase, $this->DatabaseTable);
				
			$this->Writer->endElement(); // ENDS IMG TAG
			
			if ($this->EndTag) {
				$this->Writer->endElement(); // ENDS END TAG
			}
			
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}*/
	}
	
	/*public function createPicture(array $Picture) {
		if ($Picture != NULL) {
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
			
			$this->addModuleContent($Keys, $Picture, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createPicture: Picture cannot be NULL!');
		}
	}
	
	public function updatePicture(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'updatePicture: PageID cannot be NULL!');
		}
	}
	
	public function deletePicture(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'deletePicture: PageID cannot be NULL!');
		}
	}
	
	public function updatePictureStatus(array $PageID) {
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
			array_push($this->ErrorMessage,'updatePictureStatus: PageID cannot be NULL!');
		}
	}*/
}
?>