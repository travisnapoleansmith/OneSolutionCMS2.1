<?php

class XmlSimpleViewer extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XMLSimpleViewerLookupStopObjectID;
	protected $XMLSimpleViewerLookupContinueObjectID;
	
	protected $XMLSimpleViewerLookupXMLSimpleViewerTableName;
	protected $XMLSimpleViewerLookupXMLSimpleViewerObjectID;
	
	protected $XMLSimpleViewerLookupGalleryStyle;
	
	protected $XMLSimpleViewerLookupTitle;
	protected $XMLSimpleViewerLookupTextColor;
	
	protected $XMLSimpleViewerLookupFrameColor;
	protected $XMLSimpleViewerLookupFrameWidth;
	
	protected $XMLSimpleViewerLookupThumbPosition;
	protected $XMLSimpleViewerLookupThumbColumns;
	protected $XMLSimpleViewerLookupThumbRows;
	
	protected $XMLSimpleViewerLookupShowOpenButton;
	protected $XMLSimpleViewerLookupShowFullscreenButton;
	
	protected $XMLSimpleViewerLookupMaxImageWidth;
	protected $XMLSimpleViewerLookupMaxImageHeight;
	
	protected $XMLSimpleViewerLookupUseFlickr;
	protected $XMLSimpleViewerLookupFlickrUserName;
	protected $XMLSimpleViewerLookupFlickrTags;
	
	protected $XMLSimpleViewerLookupLanguageCode;
	protected $XMLSimpleViewerLookupLanguageList;
	
	protected $XMLSimpleViewerLookupImagePath;
	protected $XMLSimpleViewerLookupThumbPath;
			
	protected $XMLSimpleViewerLookupTableName;
	protected $XMLSimpleViewerTableName;
	
	protected $XMLSimpleViewerXMLTable;
	
	protected $XMLSimpleViewer;
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
		} else if ($GLOBALS['Writer']){
			$this->Writer = &$GLOBALS['Writer'];
		} else {
			$this->Writer = new XMLWriter();
			$this->Writer->openMemory();
		}
		
		$this->Writer->startDocument('1.0' , 'UTF-8');
		$this->Writer->setIndent(4);
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
		
		$this->XMLSimpleViewerLookupStopObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StopObjectID'));
		$this->XMLSimpleViewerLookupContinueObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContinueObjectID'));
		$this->XMLSimpleViewerLookupXMLSimpleViewerTableName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerTableName'));
		$this->XMLSimpleViewerLookupXMLSimpleViewerObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerObjectID'));
		
		$this->XMLSimpleViewerLookupGalleryStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGalleryStyle'));
		
		$this->XMLSimpleViewerLookupTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerTitle'));
		$this->XMLSimpleViewerLookupTextColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerTextColor'));
		
		$this->XMLSimpleViewerLookupFrameColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerFrameColor'));
		$this->XMLSimpleViewerLookupFrameWidth = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGFrameWidth'));
		
		$this->XMLSimpleViewerLookupThumbPosition = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbPosition'));
		$this->XMLSimpleViewerLookupThumbColumns = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbColumns'));
		$this->XMLSimpleViewerLookupThumbRows = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbRows'));
		
		$this->XMLSimpleViewerLookupShowOpenButton = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerShowOpenButton'));
		$this->XMLSimpleViewerLookupShowFullscreenButton = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerShowFullscreenButton'));
		
		$this->XMLSimpleViewerLookupMaxImageWidth = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerMaxImageWidth'));
		$this->XMLSimpleViewerLookupMaxImageHeight = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerMaxImageHeight'));
		
		$this->XMLSimpleViewerLookupUseFlickr = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerUseFlickr'));
		$this->XMLSimpleViewerLookupFlickrUserName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerFlickrUserName'));
		$this->XMLSimpleViewerLookupFlickrTags = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerFlickrTags'));
		
		$this->XMLSimpleViewerLookupLanguageCode = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerLanguageCode'));
		$this->XMLSimpleViewerLookupLanguageList = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerLanguageList'));
		
		$this->XMLSimpleViewerLookupImagePath = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerImagePath'));
		$this->XMLSimpleViewerLookupThumbPath = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbPath'));
		
		$this->XMLSimpleViewerLookupTableName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGalleryStyle'));
		$this->XMLSimpleViewerTableName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGalleryStyle'));
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
		if ($this->XMLSimpleViewerLookupXMLSimpleViewerTableName) {
			$this->XMLSimpleViewerTableName = $this->XMLSimpleViewerLookupXMLSimpleViewerTableName;
			
			$this->LayerModule->createDatabaseTable($this->XMLSimpleViewerTableName);
			$this->LayerModule->Connect($this->XMLSimpleViewerTableName);
			
			$passarray = array();
			$passarray['PageID'] = $this->PageID;
			$passarray['RevisionID'] = $this->RevisionID;
			$passarray['CurrentVersion'] = $this->CurrentVersion;
			$this->LayerModule->pass ($this->XMLSimpleViewerTableName, 'setDatabaseField', array('idnumber' => $passarray));
			$this->LayerModule->pass ($this->XMLSimpleViewerTableName, 'setDatabaseRow', array('idnumber' => $passarray));
			
			$this->XMLSimpleViewerXMLTable = $this->LayerModule->pass ($this->XMLSimpleViewerTableName, 'getMultiRowField', array());
			$this->LayerModule->Disconnect($this->XMLSimpleViewerTableName);
		}
		
	}
	
	public function CreateOutput($space) {
	  	$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			
			$this->Writer->startElement('simpleviewergallery');
			
			$this->Writer->writeAttribute('galleryStyle', 'MODERN');
			$this->Writer->writeAttribute('title', '2010 Baseball');
			$this->Writer->writeAttribute('textColor', 'FFFFFF');
			$this->Writer->writeAttribute('frameColor', 'FFFFFF');
			$this->Writer->writeAttribute('frameWidth', '2');
			$this->Writer->writeAttribute('thumbPosition', 'RIGHT');
			$this->Writer->writeAttribute('thumbColumns', '3');
			$this->Writer->writeAttribute('thumbRows', '5');
			$this->Writer->writeAttribute('showOpenButton', 'FALSE');
			$this->Writer->writeAttribute('showFullscreenButton', 'FALSE');
			$this->Writer->writeAttribute('maxImageWidth', '300');
			$this->Writer->writeAttribute('maxImageHeight', '300');
			$this->Writer->writeAttribute('useFlickr', 'false');
			$this->Writer->writeAttribute('flickrUserName', '');
			$this->Writer->writeAttribute('flickrTags', '');
			$this->Writer->writeAttribute('languageCode', 'EN');
			$this->Writer->writeAttribute('languageList', '');
			$this->Writer->writeAttribute('imagePath', 'images/');
			$this->Writer->writeAttribute('thumbPath', 'thumbs/');
			
			$this->Writer->startElement('PageID');
			$this->Writer->writeRaw($this->PageID);
			$this->Writer->endElement();
			
			foreach ($this->XMLSimpleViewerXMLTable as $Key => $Value) {
				if ($Value['Enable/Disable'] == 'Enable' & $Value['Status'] == 'Approved') {
					$this->Writer->startElement('image');
						$this->Writer->writeAttribute('imageURL', $Value['ImageUrl']);
						$this->Writer->writeAttribute('thumbURL', $Value['ThumbUrl']);
						$this->Writer->writeAttribute('linkURL', $Value['LinkUrl']);
						$this->Writer->writeAttribute('linkTarget', $Value['LinkTarget']);
						
						$this->Writer->startElement('caption');
							$this->Writer->writeRaw($Value['Caption']);
						$this->Writer->endElement();
					$this->Writer->endElement();
				}
			}
			$this->Writer->endElement();
			$this->Writer->endDocument();
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		} /*else {
			$this->XMLSimpleViewer = $this->Writer->flush();
		}*/
	}
	
	public function getOutput() {
		return $this->XmlSimpleViewer;
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