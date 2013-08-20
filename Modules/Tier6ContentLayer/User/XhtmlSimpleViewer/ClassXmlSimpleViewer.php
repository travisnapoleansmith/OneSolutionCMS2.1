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

class XmlSimpleViewer extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XMLSimpleViewerLookupStopObjectID;
	protected $XMLSimpleViewerLookupContinueObjectID;

	protected $XMLSimpleViewerLookupXMLSimpleViewerTableName;
	protected $XMLSimpleViewerLookupXMLSimpleViewerObjectID;

	protected $XMLSimpleViewerLookupGalleryStyle;
	protected $XMLSimpleViewerLookupGalleryWidth;
	protected $XMLSimpleViewerLookupGalleryHeight;
	
	protected $XMLSimpleViewerName;
	protected $XMLSimpleViewerLookupTitle;
	protected $XMLSimpleViewerLookupTextColor;

	protected $XMLSimpleViewerLookupFrameColor;
	protected $XMLSimpleViewerLookupFrameWidth;

	protected $XMLSimpleViewerLookupThumbPosition;
	protected $XMLSimpleViewerLookupThumbColumns;
	protected $XMLSimpleViewerLookupThumbRows;
	protected $XMLSimpleViewerLookupThumbWidth;
	protected $XMLSimpleViewerLookupThumbHeight;
	protected $XMLSimpleViewerLookupThumbQuality;

	protected $XMLSimpleViewerLookupShowOpenButton;
	protected $XMLSimpleViewerLookupShowFullscreenButton;

	protected $XMLSimpleViewerLookupImageQuality;
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

	/**
	 * Create an instance of XmlSimpleViewer
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
		//$this->RevisionID = $PageID['RevisionID'];
		//$this->CurrentVersion = $PageID['CurrentVersion'];
		unset ($PageID['PrintPreview']);
		unset ($PageID['RevisionID']);
		unset ($PageID['CurrentVersion']);
		
		$PageID['CurrentVersion'] = 'true';
		$this->CurrentVersion = $PageID['CurrentVersion'];
		
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;

		//$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->RevisionID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'RevisionID'));
		
		$this->XMLSimpleViewerLookupStopObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StopObjectID'));
		$this->XMLSimpleViewerLookupContinueObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContinueObjectID'));
		$this->XMLSimpleViewerLookupXMLSimpleViewerTableName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerTableName'));
		$this->XMLSimpleViewerLookupXMLSimpleViewerObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerObjectID'));

		$this->XMLSimpleViewerLookupGalleryStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGalleryStyle'));
		$this->XMLSimpleViewerLookupGalleryWidth = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGalleryWidth'));
		$this->XMLSimpleViewerLookupGalleryHeight = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerGalleryHeight'));

		$this->XMLSimpleViewerName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerName'));
		$this->XMLSimpleViewerLookupTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerTitle'));
		$this->XMLSimpleViewerLookupTextColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerTextColor'));

		$this->XMLSimpleViewerLookupFrameColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerFrameColor'));
		$this->XMLSimpleViewerLookupFrameWidth = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerFrameWidth'));

		$this->XMLSimpleViewerLookupThumbPosition = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbPosition'));
		$this->XMLSimpleViewerLookupThumbColumns = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbColumns'));
		$this->XMLSimpleViewerLookupThumbRows = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbRows'));
		$this->XMLSimpleViewerLookupThumbWidth = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbWidth'));
		$this->XMLSimpleViewerLookupThumbHeight = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbHeight'));
		$this->XMLSimpleViewerLookupThumbQuality = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerThumbQuality'));

		$this->XMLSimpleViewerLookupShowOpenButton = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerShowOpenButton'));
		$this->XMLSimpleViewerLookupShowFullscreenButton = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerShowFullscreenButton'));

		$this->XMLSimpleViewerLookupImageQuality = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'XMLSimpleViewerImageQuality'));
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

			if ($this->XMLSimpleViewerLookupGalleryStyle) {
				$this->Writer->writeAttribute('galleryStyle', $this->XMLSimpleViewerLookupGalleryStyle);
			}

			if ($this->XMLSimpleViewerLookupGalleryWidth) {
				$this->Writer->writeAttribute('galleryWidth', $this->XMLSimpleViewerLookupGalleryWidth);
			}

			if ($this->XMLSimpleViewerLookupGalleryHeight) {
				$this->Writer->writeAttribute('galleryHeight', $this->XMLSimpleViewerLookupGalleryHeight);
			}

			if ($this->XMLSimpleViewerLookupTitle) {
				$this->Writer->writeAttribute('title', $this->XMLSimpleViewerLookupTitle);
			}

			if ($this->XMLSimpleViewerLookupTextColor) {
				$this->Writer->writeAttribute('textColor', $this->XMLSimpleViewerLookupTextColor);
			}

			if ($this->XMLSimpleViewerLookupFrameColor) {
				$this->Writer->writeAttribute('frameColor', $this->XMLSimpleViewerLookupFrameColor);
			}

			if ($this->XMLSimpleViewerLookupFrameWidth) {
				$this->Writer->writeAttribute('frameWidth', $this->XMLSimpleViewerLookupFrameWidth);
			}

			if ($this->XMLSimpleViewerLookupThumbPosition) {
				$this->Writer->writeAttribute('thumbPosition', $this->XMLSimpleViewerLookupThumbPosition);
			}

			if ($this->XMLSimpleViewerLookupThumbColumns) {
				$this->Writer->writeAttribute('thumbColumns', $this->XMLSimpleViewerLookupThumbColumns);
			}

			if ($this->XMLSimpleViewerLookupThumbRows) {
				$this->Writer->writeAttribute('thumbRows', $this->XMLSimpleViewerLookupThumbRows);
			}

			if ($this->XMLSimpleViewerLookupThumbWidth) {
				$this->Writer->writeAttribute('thumbWidth', $this->XMLSimpleViewerLookupThumbWidth);
			}

			if ($this->XMLSimpleViewerLookupThumbHeight) {
				$this->Writer->writeAttribute('thumbHeight', $this->XMLSimpleViewerLookupThumbHeight);
			}

			if ($this->XMLSimpleViewerLookupThumbQuality) {
				$this->Writer->writeAttribute('thumbQuality', $this->XMLSimpleViewerLookupThumbQuality);
			}

			if ($this->XMLSimpleViewerLookupShowOpenButton) {
				$this->Writer->writeAttribute('showOpenButton', $this->XMLSimpleViewerLookupShowOpenButton);
			}

			if ($this->XMLSimpleViewerLookupShowFullscreenButton) {
				$this->Writer->writeAttribute('showFullscreenButton', $this->XMLSimpleViewerLookupShowFullscreenButton);
			}

			if ($this->XMLSimpleViewerLookupImageQuality) {
				$this->Writer->writeAttribute('imageQuality', $this->XMLSimpleViewerLookupImageQuality);
			}

			if ($this->XMLSimpleViewerLookupMaxImageWidth) {
				$this->Writer->writeAttribute('maxImageWidth', $this->XMLSimpleViewerLookupMaxImageWidth);
			}

			if ($this->XMLSimpleViewerLookupMaxImageHeight) {
				$this->Writer->writeAttribute('maxImageHeight', $this->XMLSimpleViewerLookupMaxImageHeight);
			}

			if ($this->XMLSimpleViewerLookupUseFlickr) {
				$this->Writer->writeAttribute('useFlickr', $this->XMLSimpleViewerLookupUseFlickr);
			}

			if ($this->XMLSimpleViewerLookupFlickrUserName) {
				$this->Writer->writeAttribute('flickrUserName', $this->XMLSimpleViewerLookupFlickrUserName);
			}

			if ($this->XMLSimpleViewerLookupFlickrTags) {
				$this->Writer->writeAttribute('flickrTags', $this->XMLSimpleViewerLookupFlickrTags);
			}

			if ($this->XMLSimpleViewerLookupLanguageCode) {
				$this->Writer->writeAttribute('languageCode', $this->XMLSimpleViewerLookupLanguageCode);
			}

			if ($this->XMLSimpleViewerLookupLanguageList) {
				$this->Writer->writeAttribute('languageList', $this->XMLSimpleViewerLookupLanguageList);
			}

			if ($this->XMLSimpleViewerLookupImagePath) {
				$this->Writer->writeAttribute('imagePath', $this->XMLSimpleViewerLookupImagePath);
			}

			if ($this->XMLSimpleViewerLookupThumbPath) {
				$this->Writer->writeAttribute('thumbPath', $this->XMLSimpleViewerLookupThumbPath);
			}

			$this->Writer->startElement('PageID');
			$this->Writer->writeRaw($this->PageID);
			$this->Writer->endElement();
			if ($this->XMLSimpleViewerLookupStopObjectID != NULL) {
				foreach ($this->XMLSimpleViewerXMLTable as $Key => $Value) {
					if ($Value['ObjectID'] > $this->XMLSimpleViewerLookupStopObjectID) {
						unset($this->XMLSimpleViewerXMLTable[$Key]);
					}
				}
			}

			if ($this->XMLSimpleViewerLookupContinueObjectID != NULL) {
				foreach ($this->XMLSimpleViewerXMLTable as $Key => $Value) {
					if ($Value['ObjectID'] < $this->XMLSimpleViewerLookupContinueObjectID) {
						unset($this->XMLSimpleViewerXMLTable[$Key]);
					}
				}
			}

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

	public function importGalleryFile($XMLFile, array $Path = NULL) {
		if ($XMLFile != NULL) {
			if (file_exists($XMLFile)) {
				libxml_use_internal_errors(true);
				$Xml = simplexml_load_file($XMLFile);

				if ($Xml) {
					$i = $this->ObjectID;
					foreach($Xml as $Child) {
						$SimpleViewerGallery = array();
						$SimpleViewerGallery['PageID'] = $this->PageID;
						$SimpleViewerGallery['ObjectID'] = $i;
						$SimpleViewerGallery['RevisionID'] = $this->RevisionID;
						$SimpleViewerGallery['CurrentVersion'] = $this->CurrentVersion;
						$SimpleViewerGallery['ImageUrl'] = NULL;
						$SimpleViewerGallery['ThumbUrl'] = NULL;
						$SimpleViewerGallery['LinkUrl'] = NULL;
						$SimpleViewerGallery['LinkTarget'] = NULL;
						$SimpleViewerGallery['Caption'] = NULL;
						$SimpleViewerGallery['Enable/Disable'] = 'Enable';
						$SimpleViewerGallery['Status'] = 'Approved';

						foreach ($Child->attributes() as $AttributesName => $Attributes){
							if ($AttributesName == 'imageURL') {
								$Attribute = $Attributes->asXML();
								$Attribute = str_replace('imageURL=', '', $Attribute);
								$Attribute = str_replace('"', '', $Attribute);
								if ($Path['imageURL'] != NULL) {
									$Attribute = str_replace('images/', $Path['imageURL'], $Attribute);
								}
								$SimpleViewerGallery['ImageUrl'] = $Attribute;
							}

							if ($AttributesName == 'thumbURL') {
								$Attribute = $Attributes->asXML();
								$Attribute = str_replace('thumbURL=', '', $Attribute);
								$Attribute = str_replace('"', '', $Attribute);
								if ($Path['thumbURL'] != NULL) {
									$Attribute = str_replace('thumbs/', $Path['thumbURL'], $Attribute);
								}
								$SimpleViewerGallery['ThumbUrl'] = $Attribute;
							}

							if ($AttributesName == 'linkURL') {
								$Attribute = $Attributes->asXML();
								$Attribute = str_replace('linkURL=', '', $Attribute);
								$Attribute = str_replace('"', '', $Attribute);
								if ($Path['linkURL'] != NULL) {
									$Attribute = str_replace('images/', $Path['linkURL'], $Attribute);
								}
								$SimpleViewerGallery['LinkUrl'] = $Attribute;
							}

							if ($AttributesName == 'linkTarget') {
								$Attribute = $Attributes->asXML();
								$Attribute = str_replace('linkTarget=', '', $Attribute);
								$Attribute = str_replace('"', '', $Attribute);

								$SimpleViewerGallery['LinkTarget'] = $Attribute;
							}
						}
						$Caption = $Child->caption->asXML();
						$Caption = str_replace('<caption>', '', $Caption);
						$Caption = str_replace('</caption>', '', $Caption);
						if (empty($Caption)) {
							$SimpleViewerGallery['Caption'] = '<![CDATA[]]>';
						} else {
							$SimpleViewerGallery['Caption'] = $Caption;
						}
						$this->createGallery($SimpleViewerGallery);
						$i++;
					}
				}
			} else {
				array_push($this->ErrorMessage,'importGalleryFile: XMLFile DOES NOT EXIST!');
			}
		} else {
			array_push($this->ErrorMessage,'importGalleryFile: XMLFile cannot be NULL!');
		}
	}
	public function createGallery(array $Gallery) {
		if ($Gallery != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'RevisionID';
			$Keys[3] = 'CurrentVersion';
			$Keys[4] = 'ImageUrl';
			$Keys[5] = 'ThumbUrl';
			$Keys[6] = 'LinkUrl';
			$Keys[7] = 'LinkTarget';
			$Keys[8] = 'Caption';
			$Keys[9] = 'Enable/Disable';
			$Keys[10] = 'Status';
			
			$this->addModuleContent($Keys, $Gallery, $this->XMLSimpleViewerTableName);
		} else {
			array_push($this->ErrorMessage,'createGallery: Gallery cannot be NULL!');
		}
	}
	
	public function updateGallery(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->XMLSimpleViewerTableName);
		} else {
			array_push($this->ErrorMessage,'updateGallery: PageID cannot be NULL!');
		}
	}

	public function deleteGallery(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->XMLSimpleViewerTableName);
		} else {
			array_push($this->ErrorMessage,'deleteGallery: PageID cannot be NULL!');
		}
	}

	public function updateGalleryStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];

			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->XMLSimpleViewerTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->XMLSimpleViewerTableName);
			}

			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->XMLSimpleViewerTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->XMLSimpleViewerTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->XMLSimpleViewerTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->XMLSimpleViewerTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateGalleryStatus: PageID cannot be NULL!');
		}
	}
	
	public function createLookupGallery(array $Gallery) {
		if ($Gallery != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'RevisionID';
			$Keys[3] = 'CurrentVersion';
			$Keys[4] = 'StopObjectID';
			$Keys[5] = 'ContinueObjectID';
			$Keys[6] = 'XMLSimpleViewerTableName';
			$Keys[7] = 'XMLSimpleViewerObjectID';
			$Keys[8] = 'XMLSimpleViewerGalleryStyle';
			$Keys[9] = 'XMLSimpleViewerGalleryWidth';
			$Keys[10] = 'XMLSimpleViewerGalleryHeight';
			$Keys[11] = 'XMLSimpleViewerName';
			$Keys[12] = 'XMLSimpleViewerTitle';
			$Keys[13] = 'XMLSimpleViewerTextColor';
			$Keys[14] = 'XMLSimpleViewerFrameColor';
			$Keys[15] = 'XMLSimpleViewerFrameWidth';
			$Keys[16] = 'XMLSimpleViewerThumbPosition';
			$Keys[17] = 'XMLSimpleViewerThumbColumns';
			$Keys[18] = 'XMLSimpleViewerThumbRows';
			$Keys[19] = 'XMLSimpleViewerThumbWidth';
			$Keys[20] = 'XMLSimpleViewerThumbHeight';
			$Keys[21] = 'XMLSimpleViewerThumbQuality';
			$Keys[22] = 'XMLSimpleViewerShowOpenButton';
			$Keys[23] = 'XMLSimpleViewerShowFullscreenButton';
			$Keys[24] = 'XMLSimpleViewerImageQuality';
			$Keys[25] = 'XMLSimpleViewerMaxImageWidth';
			$Keys[26] = 'XMLSimpleViewerMaxImageHeight';
			$Keys[27] = 'XMLSimpleViewerUseFlickr';
			$Keys[28] = 'XMLSimpleViewerFlickrUserName';
			$Keys[29] = 'XMLSimpleViewerFlickrTags';
			$Keys[30] = 'XMLSimpleViewerLanguageCode';
			$Keys[31] = 'XMLSimpleViewerLanguageList';
			$Keys[32] = 'XMLSimpleViewerImagePath';
			$Keys[33] = 'XMLSimpleViewerThumbPath';
			$Keys[34] = 'Enable/Disable';
			$Keys[35] = 'Status';

			$this->addModuleContent($Keys, $Gallery, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createGallery: Gallery cannot be NULL!');
		}
	}
	
	
	public function updateLookupGallery(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'updateGallery: PageID cannot be NULL!');
		}
	}

	public function deleteLookupGallery(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'deleteGallery: PageID cannot be NULL!');
		}
	}

	public function updateLookupGalleryStatus(array $PageID) {
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
			array_push($this->ErrorMessage,'updateGalleryStatus: PageID cannot be NULL!');
		}
	}
}
?>