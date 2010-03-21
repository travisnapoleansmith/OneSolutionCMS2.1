<?php

class XhtmlForm extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlFormProtectionLayer;
	
	protected $TableNames = array();
	protected $FormLookupTableName = array();
		
	// Xhtml Form Required Attributes
	protected $FormAction = array();
	
	// Xhtml Form Optional Attributes
	protected $FormAccept = array();
	protected $FormAcceptCharset = array();
	protected $FormEnctype = array();
	protected $FormMethod = array();
	protected $FormName = array();
	
	// Xhtml Form Standard Attributes
	protected $FormClass = array();
	protected $FormDir = array();
	protected $FormID = array();
	protected $FormLang = array();
	protected $FormStyle = array();
	protected $FormTitle = array();
	protected $FormXMLLang = array();
	
	protected $FormEnableDisable = array();
	protected $FormStatus = array();
	
	// Xhtml Form Table Listing
	protected $FormTableListingPageID = array();
	protected $FormTableListingObjectID = array();
	protected $FormTableListingContainerObjectType = array();
	protected $FormTableListingContainerObjectTypeName = array();
	protected $FormTableListingContainerObjectID = array();
	protected $FormTableListingContentStartTag = array();
	protected $FormTableListingContentEndTag = array();
	protected $FormTableListingContent = array();
	protected $FormTableListingEnableDisable = array();
	protected $FormTableListingStatus = array();
	
	// Xhtml Form Input
	protected $FormInputPageID = array();
	protected $FormInputObjectID = array();
	
	// Xhtml Form Input Text
	protected $FormInputText = array();
	protected $FormInputTextDynamic = array();
	protected $FormInputTextTableName = array();
	protected $FormInputTextField = array();
	protected $FormInputTextPageID = array();
	protected $FormInputTextObjectID = array();
	protected $FormInputTextRevisionID = array();
	
	protected $FormInputAccept = array();
	protected $FormInputAlt = array();
	protected $FormInputChecked = array();
	protected $FormInputDisabled = array();
	protected $FormInputMaxLength = array();
	
	// Xhtml Form Input Name
	protected $FormInputName = array();
	protected $FormInputNameDynamic = array();
	protected $FormInputNameTableName = array();
	protected $FormInputNameField = array();
	protected $FormInputNamePageID = array();
	protected $FormInputNameObjectID = array();
	protected $FormInputNameRevisionID = array();
	
	protected $FormInputReadOnly = array();
	protected $FormInputSize = array();
	protected $FormInputSrc = array();
	protected $FormInputType = array();
	
	// Xhtml Form Input Value
	protected $FormInputValue = array();
	protected $FormInputValueDynamic = array();
	protected $FormInputValueTableName = array();
	protected $FormInputValueField = array();
	protected $FormInputValuePageID = array();
	protected $FormInputValueObjectID = array();
	protected $FormInputValueRevisionID = array();
	
	// Xhtml Form Input Standard Attributes
	protected $FormInputAccessKey = array();
	protected $FormInputClass = array();
	protected $FormInputDir = array();
	protected $FormInputID = array();
	protected $FormInputLang = array();
	protected $FormInputStyle = array();
	protected $FormInputTitle = array();
	protected $FormInputXMLLang = array();
	
	protected $FormInputEnableDisable = array();
	protected $FormInputStatus = array();
	
	// Xhtml Form Label 
	protected $FormLabelPageID = array();
	protected $FormLabelObjectID = array();
	
	// Xhtml Form Label Text
	protected $FormLabelText = array();
	protected $FormLabelTextDynamic = array();
	protected $FormLabelTextTableName = array();
	protected $FormLabelTextField = array();
	protected $FormLabelTextPageID = array();
	protected $FormLabelTextObjectID = array();
	protected $FormLabelTextRevisionID = array();
	
	protected $FormLabelFor = array();
		
	// Xhtml Form Label Standard Attributes
	protected $FormLabelAccessKey = array();
	protected $FormLabelClass = array();
	protected $FormLabelDir = array();
	protected $FormLabelID = array();
	protected $FormLabelLang = array();
	protected $FormLabelStyle = array();
	protected $FormLabelTitle = array();
	protected $FormLabelXMLLang = array();
	
	protected $FormLabelEnableDisable = array();
	protected $FormLabelStatus = array();
	
	// Xhtml Form Text Area 
	protected $FormTextAreaPageID = array();
	protected $FormTextAreaObjectID = array();
	
	// Xhtml Form Text Area Text
	protected $FormTextAreaText = array();
	protected $FormTextAreaTextDynamic = array();
	protected $FormTextAreaTextTableName = array();
	protected $FormTextAreaTextField = array();
	protected $FormTextAreaTextPageID = array();
	protected $FormTextAreaTextObjectID = array();
	protected $FormTextAreaTextRevisionID = array();
	
	// Xhtml Form Text Area Required Attributes
	protected $FormTextAreaCols = array();
	protected $FormTextAreaRows = array();
	
	// Xhtml Form Text Area Optional Attributes
	protected $FormTextAreaDisabled = array();
	protected $FormTextAreaName = array();
	protected $FormTextAreaReadOnly = array();
	
	// Xhtml Form Text Area Standard Attributes
	protected $FormTextAreaAccessKey = array();
	protected $FormTextAreaClass = array();
	protected $FormTextAreaDir = array();
	protected $FormTextAreaID = array();
	protected $FormTextAreaLang = array();
	protected $FormTextAreaStyle = array();
	protected $FormTextAreaTitle = array();
	protected $FormTextAreaXMLLang = array();
	
	protected $FormTextAreaEnableDisable = array();
	protected $FormTextAreaStatus = array();
	
	protected $Form;
	
	public function __construct($tablenames, $database) {
		$this->XhtmlFormProtectionLayer = &$database;
		
		$this->PrintPreview = $tablenames['PrintPreview'];
		unset($tablenames['PrintPreview']);
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->GlobalWriter = $tablenames['GlobalWriter'];
		unset($tablenames['GlobalWriter']);
		
		if ($this->GlobalWriter) {
			$this->Writer = $this->GlobalWriter;
		} else {
			$this->Writer = new XMLWriter();
			if ($this->FileName) {
				$this->Writer->openURI($this->FileName);
			} else {
				$this->Writer->openMemory();
			}
			$this->Writer->setIndent(4);
		}
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->XhtmlFormProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function FetchDatabase ($PageID) {
		$this->PrintPreview = $PageID['PrintPreview'];
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		unset ($passarray['ObjectID']);
		reset($this->TableNames);
		
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		while (current($this->TableNames)) {
			$this->XhtmlFormProtectionLayer->Connect(current($this->TableNames));
			$this->XhtmlFormProtectionLayer->pass (current($this->TableNames), 'setDatabaseRow', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->Disconnect(current($this->TableNames));
			$this->FormLookupTableName[key($this->TableNames)] = $this->XhtmlFormProtectionLayer->pass (current($this->TableNames), 'getMultiRowField', array());
			$i = 0;
			reset($this->FormLookupTableName);
			while ($this->FormLookupTableName[current($this->TableNames)][$i]) {
				if (current($this->TableNames) == 'Form') {
					$this->processForm($i);
				
				} else if (current($this->TableNames) == 'FormFieldSet') {
					$this->processFormFieldSet($i); // NEEDS TO BE WORKED ON!
					
				} else if (current($this->TableNames) == 'FormInput') {
					$this->processFormInput($i);
				
				} else if (current($this->TableNames) == 'FormLabel') {
					$this->processFormLabel($i);
					
				} else if (current($this->TableNames) == 'FormLegend') {
					$this->processFormLegend($i); // NEEDS TO BE WORKED ON!
					
				} else if (current($this->TableNames) == 'FormSelect') {
					$this->processFormSelect($i); // NEEDS TO BE WORKED ON!
					
				} else if (current($this->TableNames) == 'FormButton') {
					$this->processFormButton($i); // NEEDS TO BE WORKED ON!
					
				} else if (current($this->TableNames) == 'FormTableListing') {
					$this->processFormTableListing($i);
				
				} else if (current($this->TableNames) == 'FormTextArea') {
					$this->processFormTextArea($i);
				}
				$i++;
			}
			
			next($this->TableNames);
		}
		print_r($this->FormLookupTableName);
		$i = 0;
		$pageid = NULL;
		
		$passarray = $pageid;
	}
	
	protected function processForm($i) {
		array_push($this->FormAction, $this->FormLookupTableName['Form'][$i]['FormAction']);
		
		array_push($this->FormAccept, $this->FormLookupTableName[current($this->TableNames)][$i]['FormAccept']);
		array_push($this->FormAcceptCharset, $this->FormLookupTableName[current($this->TableNames)][$i]['FormAcceptCharset']);
		array_push($this->FormEnctype, $this->FormLookupTableName[current($this->TableNames)][$i]['FormEnctype']);
		array_push($this->FormMethod, $this->FormLookupTableName[current($this->TableNames)][$i]['FormMethod']);
		array_push($this->FormName, $this->FormLookupTableName[current($this->TableNames)][$i]['FormName']);
		
		array_push($this->FormClass, $this->FormLookupTableName[current($this->TableNames)][$i]['FormClass']);
		array_push($this->FormDir, $this->FormLookupTableName[current($this->TableNames)][$i]['FormDir']);
		array_push($this->FormID, $this->FormLookupTableName[current($this->TableNames)][$i]['FormID']);
		array_push($this->FormLang, $this->FormLookupTableName[current($this->TableNames)][$i]['FormLang']);
		array_push($this->FormStyle, $this->FormLookupTableName[current($this->TableNames)][$i]['FormStyle']);
		array_push($this->FormTitle, $this->FormLookupTableName[current($this->TableNames)][$i]['FormTitle']);
		array_push($this->FormXMLLang, $this->FormLookupTableName[current($this->TableNames)][$i]['FormXMLLang']);
		
		array_push($this->FormEnableDisable, $this->FormLookupTableName[current($this->TableNames)][$i]['Enable/Disable']);
		array_push($this->FormStatus, $this->FormLookupTableName[current($this->TableNames)][$i]['Status']);
	}
	
	protected function processFormFieldSet($i) {
		
	}
	
	protected function processFormInput($i) {
		array_push($this->FormInputPageID, $this->FormLookupTableName['FormInput'][$i]['PageID']);
		array_push($this->FormInputObjectID, $this->FormLookupTableName['FormInput'][$i]['ObjectID']);
		
		array_push($this->FormInputText, $this->FormLookupTableName['FormInput'][$i]['FormInputText']);
		array_push($this->FormInputTextDynamic, $this->FormLookupTableName['FormInput'][$i]['FormInputTextDynamic']);
		array_push($this->FormInputTextTableName, $this->FormLookupTableName['FormInput'][$i]['FormInputTextTableName']);
		array_push($this->FormInputTextField, $this->FormLookupTableName['FormInput'][$i]['FormInputTextField']);
		array_push($this->FormInputTextPageID, $this->FormLookupTableName['FormInput'][$i]['FormInputTextPageID']);
		array_push($this->FormInputTextObjectID, $this->FormLookupTableName['FormInput'][$i]['FormInputTextObjectID']);
		array_push($this->FormInputTextRevisionID, $this->FormLookupTableName['FormInput'][$i]['FormInputTextRevisionID']);
		
		array_push($this->FormInputAccept, $this->FormLookupTableName['FormInput'][$i]['FormInputAccept']);
		array_push($this->FormInputAlt, $this->FormLookupTableName['FormInput'][$i]['FormInputAlt']);
		array_push($this->FormInputChecked, $this->FormLookupTableName['FormInput'][$i]['FormInputChecked']);
		array_push($this->FormInputDisabled, $this->FormLookupTableName['FormInput'][$i]['FormInputDisabled']);
		array_push($this->FormInputMaxLength, $this->FormLookupTableName['FormInput'][$i]['FormInputMaxLength']);
		
		array_push($this->FormInputName, $this->FormLookupTableName['FormInput'][$i]['FormInputName']);
		array_push($this->FormInputNameDynamic, $this->FormLookupTableName['FormInput'][$i]['FormInputNameDynamic']);
		array_push($this->FormInputNameTableName, $this->FormLookupTableName['FormInput'][$i]['FormInputNameTableName']);
		array_push($this->FormInputNameField, $this->FormLookupTableName['FormInput'][$i]['FormInputNameField']);
		array_push($this->FormInputNamePageID, $this->FormLookupTableName['FormInput'][$i]['FormInputNamePageID']);
		array_push($this->FormInputNameObjectID, $this->FormLookupTableName['FormInput'][$i]['FormInputNameObjectID']);
		array_push($this->FormInputNameRevisionID, $this->FormLookupTableName['FormInput'][$i]['FormInputNameRevisionID']);
		
		array_push($this->FormInputReadOnly, $this->FormLookupTableName['FormInput'][$i]['FormInputReadOnly']);
		array_push($this->FormInputSize, $this->FormLookupTableName['FormInput'][$i]['FormInputSize']);
		array_push($this->FormInputSrc, $this->FormLookupTableName['FormInput'][$i]['FormInputSrc']);
		array_push($this->FormInputType, $this->FormLookupTableName['FormInput'][$i]['FormInputType']);
		
		array_push($this->FormInputValue, $this->FormLookupTableName['FormInput'][$i]['FormInputValue']);
		array_push($this->FormInputValueDynamic, $this->FormLookupTableName['FormInput'][$i]['FormInputValueDynamic']);
		array_push($this->FormInputValueTableName, $this->FormLookupTableName['FormInput'][$i]['FormInputValueTableName']);
		array_push($this->FormInputValueField, $this->FormLookupTableName['FormInput'][$i]['FormInputValueField']);
		array_push($this->FormInputValuePageID, $this->FormLookupTableName['FormInput'][$i]['FormInputValuePageID']);
		array_push($this->FormInputValueObjectID, $this->FormLookupTableName['FormInput'][$i]['FormInputValueObjectID']);
		array_push($this->FormInputValueRevisionID, $this->FormLookupTableName['FormInput'][$i]['FormInputValueRevisionID']);
		
		array_push($this->FormInputAccessKey, $this->FormLookupTableName['FormInput'][$i]['FormInputAccessKey']);
		array_push($this->FormInputClass, $this->FormLookupTableName['FormInput'][$i]['FormInputClass']);
		array_push($this->FormInputDir, $this->FormLookupTableName['FormInput'][$i]['FormInputDir']);
		array_push($this->FormInputID, $this->FormLookupTableName['FormInput'][$i]['FormInputID']);
		array_push($this->FormInputLang, $this->FormLookupTableName['FormInput'][$i]['FormInputLang']);
		array_push($this->FormInputStyle, $this->FormLookupTableName['FormInput'][$i]['FormInputStyle']);
		array_push($this->FormInputTitle, $this->FormLookupTableName['FormInput'][$i]['FormInputTitle']);
		array_push($this->FormInputXMLLang, $this->FormLookupTableName['FormInput'][$i]['FormInputXMLLang']);
		
		array_push($this->FormInputEnableDisable, $this->FormLookupTableName['FormInput'][$i]['Enable/Disable']);
		array_push($this->FormInputStatus, $this->FormLookupTableName['FormInput'][$i]['Status']);
	}
	
	protected function processFormLabel($i) {
		array_push($this->FormLabelPageID, $this->FormLookupTableName['FormLabel'][$i]['PageID']);
		array_push($this->FormLabelObjectID, $this->FormLookupTableName['FormLabel'][$i]['ObjectID']);
		
		array_push($this->FormLabelText, $this->FormLookupTableName['FormLabel'][$i]['FormLabelText']);
		array_push($this->FormLabelTextDynamic, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTextDynamic']);
		array_push($this->FormLabelTextTableName, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTextTableName']);
		array_push($this->FormLabelTextField, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTextField']);
		array_push($this->FormLabelTextPageID, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTextPageID']);
		array_push($this->FormLabelTextObjectID, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTextObjectID']);
		array_push($this->FormLabelTextRevisionID, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTextRevisionID']);
		
		array_push($this->FormLabelFor, $this->FormLookupTableName['FormLabel'][$i]['FormLabelFor']);
		
		array_push($this->FormLabelAccessKey, $this->FormLookupTableName['FormLabel'][$i]['FormLabelAccessKey']);
		array_push($this->FormLabelClass, $this->FormLookupTableName['FormLabel'][$i]['FormLabelClass']);
		array_push($this->FormLabelDir, $this->FormLookupTableName['FormLabel'][$i]['FormLabelDir']);
		array_push($this->FormLabelID, $this->FormLookupTableName['FormLabel'][$i]['FormLabelID']);
		array_push($this->FormLabelLang, $this->FormLookupTableName['FormLabel'][$i]['FormLabelLang']);
		array_push($this->FormLabelStyle, $this->FormLookupTableName['FormLabel'][$i]['FormLabelStyle']);
		array_push($this->FormLabelTitle, $this->FormLookupTableName['FormLabel'][$i]['FormLabelTitle']);
		array_push($this->FormLabelXMLLang, $this->FormLookupTableName['FormLabel'][$i]['FormLabelXMLLang']);
		
		array_push($this->FormLabelEnableDisable, $this->FormLookupTableName['FormLabel'][$i]['Enable/Disable']);
		array_push($this->FormLabelStatus, $this->FormLookupTableName['FormLabel'][$i]['Status']);
	}
	
	protected function processFormLegend($i) {
		
	}
	
	protected function processFormSelect($i) {
		
	}
	
	protected function processFormButton($i) {
		
	}
	
	protected function processFormTableListing($i) {
		array_push($this->FormTableListingPageID, $this->FormLookupTableName[current($this->TableNames)][$i]['PageID']);
		array_push($this->FormTableListingObjectID, $this->FormLookupTableName[current($this->TableNames)][$i]['ObjectID']);
		array_push($this->FormTableListingContainerObjectType, $this->FormLookupTableName[current($this->TableNames)][$i]['ContainerObjectType']);
		array_push($this->FormTableListingContainerObjectTypeName, $this->FormLookupTableName[current($this->TableNames)][$i]['ContainerObjectTypeName']);
		array_push($this->FormTableListingContainerObjectID, $this->FormLookupTableName[current($this->TableNames)][$i]['ContainerObjectID']);
		array_push($this->FormTableListingContentStartTag, $this->FormLookupTableName[current($this->TableNames)][$i]['ContentStartTag']);
		array_push($this->FormTableListingContentEndTag, $this->FormLookupTableName[current($this->TableNames)][$i]['ContentEndTag']);
		array_push($this->FormTableListingContent, $this->FormLookupTableName[current($this->TableNames)][$i]['Content']);
		array_push($this->FormTableListingEnableDisable, $this->FormLookupTableName[current($this->TableNames)][$i]['Enable/Disable']);
		array_push($this->FormTableListingStatus, $this->FormLookupTableName[current($this->TableNames)][$i]['Status']);
	}
	
	protected function processFormTextArea($i) {
		array_push($this->FormTextAreaPageID, $this->FormLookupTableName['FormTextArea'][$i]['PageID']);
		array_push($this->FormTextAreaObjectID, $this->FormLookupTableName['FormTextArea'][$i]['ObjectID']);
		
		array_push($this->FormTextAreaText, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaText']);
		array_push($this->FormTextAreaTextDynamic, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTextDynamic']);
		array_push($this->FormTextAreaTextTableName, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTextTableName']);
		array_push($this->FormTextAreaTextField, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTextField']);
		array_push($this->FormTextAreaTextPageID, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTextPageID']);
		array_push($this->FormTextAreaTextObjectID, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTextObjectID']);
		array_push($this->FormTextAreaTextRevisionID, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTextRevisionID']);
		
		array_push($this->FormTextAreaCols, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaCols']);
		array_push($this->FormTextAreaRows, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaRows']);
		
		array_push($this->FormTextAreaDisabled, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaDisabled']);
		array_push($this->FormTextAreaName, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaName']);
		array_push($this->FormTextAreaReadOnly, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaReadOnly']);
		
		array_push($this->FormTextAreaAccessKey, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaAccessKey']);
		array_push($this->FormTextAreaClass, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaClass']);
		array_push($this->FormTextAreaDir, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaDir']);
		array_push($this->FormTextAreaID, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaID']);
		array_push($this->FormTextAreaLang, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaLang']);
		array_push($this->FormTextAreaStyle, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaStyle']);
		array_push($this->FormTextAreaTitle, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaTitle']);
		array_push($this->FormTextAreaXMLLang, $this->FormLookupTableName['FormTextArea'][$i]['FormTextAreaXMLLang']);
		
		array_push($this->FormTextAreaEnableDisable, $this->FormLookupTableName['FormTextArea'][$i]['Enable/Disable']);
		array_push($this->FormTextAreaStatus, $this->FormLookupTableName['FormTextArea'][$i]['Status']);
	}
	
	protected function getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid) {
		$passarray = array();
		$passarray['PageID'] = $pageid;
		$passarray['ObjectID'] = $objectid;
		$passarray['RevisionID'] = $revisionid;
		if ($tablename) {
			$this->XhtmlFormProtectionLayer->Connect($tablename);
			$this->XhtmlFormProtectionLayer->pass ($tablename, 'setDatabaseRow', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->Disconnect($tablename);
			$temp = $this->XhtmlFormProtectionLayer->pass ($tablename, 'getRowField', array('rowfield' => $field));
			return $temp;
		} else {
			return NULL;
		}
	}
	
	protected function buildFormInput($objectid) {
		reset($this->FormLookupTableName['FormInput']);
		
		reset($this->FormInputPageID);
		reset($this->FormInputObjectID);
		
		reset($this->FormInputText);
		reset($this->FormInputTextDynamic);
		reset($this->FormInputTextTableName);
		reset($this->FormInputTextField);
		reset($this->FormInputTextPageID);
		reset($this->FormInputTextObjectID);
		reset($this->FormInputTextRevisionID);
		
		reset($this->FormInputAccept);
		reset($this->FormInputAlt);
		reset($this->FormInputChecked);
		reset($this->FormInputDisabled);
		reset($this->FormInputMaxLength);
		
		reset($this->FormInputName);
		reset($this->FormInputNameDynamic);
		reset($this->FormInputNameTableName);
		reset($this->FormInputNameField);
		reset($this->FormInputNamePageID);
		reset($this->FormInputNameObjectID);
		reset($this->FormInputNameRevisionID);
		
		reset($this->FormInputReadOnly);
		reset($this->FormInputSize);
		reset($this->FormInputSrc);
		reset($this->FormInputType);
		
		reset($this->FormInputValue);
		reset($this->FormInputValueDynamic);
		reset($this->FormInputValueTableName);
		reset($this->FormInputValueField);
		reset($this->FormInputValuePageID);
		reset($this->FormInputValueObjectID);
		reset($this->FormInputValueRevisionID);
		
		reset($this->FormInputAccessKey);
		reset($this->FormInputClass);
		reset($this->FormInputDir);
		reset($this->FormInputID);
		reset($this->FormInputLang);
		reset($this->FormInputStyle);
		reset($this->FormInputTitle);
		reset($this->FormInputXMLLang);
		
		reset($this->FormInputEnableDisable);
		reset($this->FormInputStatus);

		while (current($this->FormLookupTableName['FormInput'])) {
			if (current($this->FormInputObjectID) == $objectid && current($this->FormInputPageID) == $this->PageID) {
				if (current($this->FormInputEnableDisable) == 'Enable' && current($this->FormInputStatus) == 'Approved') {
					if (current($this->FormInputText)) {
						$this->Writer->writeRaw("  ");
						$this->Writer->text(current($this->FormInputText));
					} else if (current($this->FormInputTextDynamic)) {
						$tablename = current($this->FormInputTextTableName);
						$field = current($this->FormInputTextField);
						$pageid = current($this->FormInputTextPageID);
						$objectid = current($this->FormInputTextObjectID);
						$revisionid = current($this->FormInputTextRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeRaw("  ");
							$this->Writer->text($hold);
						}
					}
					$this->Writer->startElement('input');
					if (current($this->FormInputAccept)) {
						$this->Writer->writeAttribute('accept', current($this->FormInputAccept));
					}
					if (current($this->FormInputAlt)) {
						$this->Writer->writeAttribute('alt', current($this->FormInputAlt));
					}
					if (current($this->FormInputChecked)) {
						$this->Writer->writeAttribute('checked', current($this->FormInputChecked));
					}
					if (current($this->FormInputDisabled)) {
						$this->Writer->writeAttribute('disabled', current($this->FormInputDisabled));
					}
					if (current($this->FormInputMaxLength)) {
						$this->Writer->writeAttribute('maxlength', current($this->FormInputMaxLength));
					}
					
					if (current($this->FormInputName)) {
						$this->Writer->writeAttribute('name', current($this->FormInputName));
					} else if (current($this->FormInputNameDynamic)) {
						$tablename = current($this->FormInputNameTableName);
						$field = current($this->FormInputNameField);
						$pageid = current($this->FormInputNamePageID);
						$objectid = current($this->FormInputNameObjectID);
						$revisionid = current($this->FormInputNameRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeAttribute('name', $hold);
						}
					}
					
					if (current($this->FormInputReadOnly)) {
						$this->Writer->writeAttribute('readonly', current($this->FormInputReadOnly));
					}
					if (current($this->FormInputSize)) {
						$this->Writer->writeAttribute('size', current($this->FormInputSize));
					}
					if (current($this->FormInputSrc)) {
						$this->Writer->writeAttribute('src', current($this->FormInputSrc));
					}
					if (current($this->FormInputType)) {
						$this->Writer->writeAttribute('type', current($this->FormInputType));
					}
					
					if (current($this->FormInputValue)) {
						$this->Writer->writeAttribute('value', current($this->FormInputValue));
					} else if (current($this->FormInputValueDynamic)) {
						$tablename = current($this->FormInputValueTableName);
						$field = current($this->FormInputValueField);
						$pageid = current($this->FormInputValuePageID);
						$objectid = current($this->FormInputValueObjectID);
						$revisionid = current($this->FormInputValueRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeAttribute('value', $hold);
						}
					}
					
					$this->ProcessArrayStandardAttribute('FormInput');
					$this->Writer->endElement(); // ENDS INPUT
				}
			}
			next($this->FormLookupTableName['FormInput']);
			
			next($this->FormInputPageID);
			next($this->FormInputObjectID);
			
			next($this->FormInputText);
			next($this->FormInputTextDynamic);
			next($this->FormInputTextTableName);
			next($this->FormInputTextField);
			next($this->FormInputTextPageID);
			next($this->FormInputTextObjectID);
			next($this->FormInputTextRevisionID);
			
			next($this->FormInputAccept);
			next($this->FormInputAlt);
			next($this->FormInputChecked);
			next($this->FormInputDisabled);
			next($this->FormInputMaxLength);
			
			next($this->FormInputName);
			next($this->FormInputNameDynamic);
			next($this->FormInputNameTableName);
			next($this->FormInputNameField);
			next($this->FormInputNamePageID);
			next($this->FormInputNameObjectID);
			next($this->FormInputNameRevisionID);
			
			next($this->FormInputReadOnly);
			next($this->FormInputSize);
			next($this->FormInputSrc);
			next($this->FormInputType);
			
			next($this->FormInputValue);
			next($this->FormInputValueDynamic);
			next($this->FormInputValueTableName);
			next($this->FormInputValueField);
			next($this->FormInputValuePageID);
			next($this->FormInputValueObjectID);
			next($this->FormInputValueRevisionID);
			
			next($this->FormInputAccessKey);
			next($this->FormInputClass);
			next($this->FormInputDir);
			next($this->FormInputID);
			next($this->FormInputLang);
			next($this->FormInputStyle);
			next($this->FormInputTitle);
			next($this->FormInputXMLLang);
			
			next($this->FormInputEnableDisable);
			next($this->FormInputStatus);
		}
	}
	
	protected function buildFormLabel ($objectid) {
		reset($this->FormLookupTableName['FormLabel']);
		
		reset($this->FormLabelPageID);
		reset($this->FormLabelObjectID);
		
		reset($this->FormLabelText);
		reset($this->FormLabelTextDynamic);
		reset($this->FormLabelTextTableName);
		reset($this->FormLabelTextField);
		reset($this->FormLabelTextPageID);
		reset($this->FormLabelTextObjectID);
		reset($this->FormLabelTextRevisionID);
		
		reset($this->FormLabelFor);
		
		reset($this->FormLabelAccessKey);
		reset($this->FormLabelClass);
		reset($this->FormLabelDir);
		reset($this->FormLabelID);
		reset($this->FormLabelLang);
		reset($this->FormLabelStyle);
		reset($this->FormLabelTitle);
		reset($this->FormLabelXMLLang);
		
		reset($this->FormLabelEnableDisable);
		reset($this->FormLabelStatus);
		
		while (current($this->FormLookupTableName['FormLabel'])) {
			if (current($this->FormLabelObjectID) == $objectid && current($this->FormLabelPageID) == $this->PageID) {
				if (current($this->FormLabelEnableDisable) == 'Enable' && current($this->FormLabelStatus) == 'Approved') {
					$this->Writer->startElement('label');
					
					if (current($this->FormLabelFor)) {
						$this->Writer->writeAttribute('for', current($this->FormLabelFor));
					}
					
					$this->ProcessArrayStandardAttribute('FormLabel');
					
					if (current($this->FormLabelText)) {
						$this->Writer->text(current($this->FormLabelText));
					} else if (current($this->FormLabelTextDynamic)) {
						$tablename = current($this->FormLabelTextTableName);
						$field = current($this->FormLabelTextField);
						$pageid = current($this->FormLabelTextPageID);
						$objectid = current($this->FormLabelTextObjectID);
						$revisionid = current($this->FormLabelTextRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						$hold = $this->CreateWordWrap($hold, '    ');
						if ($hold) {
							$this->Writer->writeRaw("\n    ");
							$this->Writer->text($hold);
							$this->Writer->writeRaw("\n  ");
						}
					}
					
					$this->Writer->endElement(); // ENDS INPUT
				}
			}
			next($this->FormLookupTableName['FormLabel']);
			
			next($this->FormLabelPageID);
			next($this->FormLabelObjectID);
			
			next($this->FormLabelText);
			next($this->FormLabelTextDynamic);
			next($this->FormLabelTextTableName);
			next($this->FormLabelTextField);
			next($this->FormLabelTextPageID);
			next($this->FormLabelTextObjectID);
			next($this->FormLabelTextRevisionID);
			
			next($this->FormLabelFor);
			
			next($this->FormLabelAccessKey);
			next($this->FormLabelClass);
			next($this->FormLabelDir);
			next($this->FormLabelID);
			next($this->FormLabelLang);
			next($this->FormLabelStyle);
			next($this->FormLabelTitle);
			next($this->FormLabelXMLLang);
			
			next($this->FormLabelEnableDisable);
			next($this->FormLabelStatus);
		}
	}
	
	protected function buildFormTextArea ($objectid) {
		reset($this->FormLookupTableName['FormTextArea']);
		
		reset($this->FormTextAreaPageID);
		reset($this->FormTextAreaObjectID);
		
		reset($this->FormTextAreaText);
		reset($this->FormTextAreaTextDynamic);
		reset($this->FormTextAreaTextTableName);
		reset($this->FormTextAreaTextField);
		reset($this->FormTextAreaTextPageID);
		reset($this->FormTextAreaTextObjectID);
		reset($this->FormTextAreaTextRevisionID);
		
		reset($this->FormTextAreaCols);
		reset($this->FormTextAreaRows);
		
		reset($this->FormTextAreaDisabled);
		reset($this->FormTextAreaName);
		reset($this->FormTextAreaReadOnly);
		
		reset($this->FormTextAreaAccessKey);
		reset($this->FormTextAreaClass);
		reset($this->FormTextAreaDir);
		reset($this->FormTextAreaID);
		reset($this->FormTextAreaLang);
		reset($this->FormTextAreaStyle);
		reset($this->FormTextAreaTitle);
		reset($this->FormTextAreaXMLLang);
		
		reset($this->FormTextAreaEnableDisable);
		reset($this->FormTextAreaStatus);
		
		while (current($this->FormLookupTableName['FormTextArea'])) {
			if (current($this->FormTextAreaObjectID) == $objectid && current($this->FormTextAreaPageID) == $this->PageID) {
				if (current($this->FormTextAreaEnableDisable) == 'Enable' && current($this->FormTextAreaStatus) == 'Approved') {
					$this->Writer->startElement('textarea');
					
					if (current($this->FormTextAreaCols)) {
						$this->Writer->writeAttribute('cols', current($this->FormTextAreaCols));
					}
					
					if (current($this->FormTextAreaRows)) {
						$this->Writer->writeAttribute('rows', current($this->FormTextAreaRows));
					}
					
					if (current($this->FormTextAreaDisabled)) {
						$this->Writer->writeAttribute('disabled', current($this->FormTextAreaDisabled));
					}
					
					if (current($this->FormTextAreaName)) {
						$this->Writer->writeAttribute('name', current($this->FormTextAreaName));
					}
					
					if (current($this->FormTextAreaReadOnly)) {
						$this->Writer->writeAttribute('readonly', current($this->FormTextAreaReadOnly));
					}
					
					$this->ProcessArrayStandardAttribute('FormTextArea');
					
					if (current($this->FormTextAreaText)) {
						$this->Writer->text(current($this->FormTextAreaText));
					} else if (current($this->FormTextAreaTextDynamic)) {
						$tablename = current($this->FormTextAreaTextTableName);
						$field = current($this->FormTextAreaTextField);
						$pageid = current($this->FormTextAreaTextPageID);
						$objectid = current($this->FormTextAreaTextObjectID);
						$revisionid = current($this->FormTextAreaTextRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						$hold = $this->CreateWordWrap($hold, '    ');
						if ($hold) {
							$this->Writer->writeRaw("\n    ");
							$this->Writer->text($hold);
							$this->Writer->writeRaw("\n  ");
						}
					}
					
					$this->Writer->endElement(); // ENDS INPUT
				}
			}
			next($this->FormLookupTableName['FormTextArea']);
			
			next($this->FormTextAreaPageID);
			next($this->FormTextAreaObjectID);
			
			next($this->FormTextAreaText);
			next($this->FormTextAreaTextDynamic);
			next($this->FormTextAreaTextTableName);
			next($this->FormTextAreaTextField);
			next($this->FormTextAreaTextPageID);
			next($this->FormTextAreaTextObjectID);
			next($this->FormTextAreaTextRevisionID);
			
			next($this->FormTextAreaCols);
			next($this->FormTextAreaRows);
			
			next($this->FormTextAreaDisabled);
			next($this->FormTextAreaName);
			next($this->FormTextAreaReadOnly);
			
			next($this->FormTextAreaAccessKey);
			next($this->FormTextAreaClass);
			next($this->FormTextAreaDir);
			next($this->FormTextAreaID);
			next($this->FormTextAreaLang);
			next($this->FormTextAreaStyle);
			next($this->FormTextAreaTitle);
			next($this->FormTextAreaXMLLang);
			
			next($this->FormTextAreaEnableDisable);
			next($this->FormTextAreaStatus);
		}
	}
	
	protected function createTextArea($startingvariablename) {
		$starttag = $startingvariablename;
		$starttag .= 'ContentStartTag';
		
		$endtag = $startingvariablename;
		$endtag .= 'ContentEndTag';
		
		$content = $startingvariablename;
		$content .= 'Content';
		
		if (current($this->$starttag) == '<p>'){
			$this->$starttag[key($this->$starttag)] = str_replace('<','', current($this->$starttag));
			$this->$starttag[key($this->$starttag)] = str_replace('>','', current($this->$starttag));
			$this->Writer->writeRaw("  ");
			$this->Writer->startElement(current($this->$starttag));
				//$this->ProcessStandardAttribute($starttag);
				$this->$content[key($this->$content)] = trim(current($this->$content));
				if (strpos(current($this->$content), "\n\r")) {
					$this->$content[key($this->$content)] = explode("\n\r", current($this->$content));
					$i = 0;
					$count = count(current($this->$content));
					$count--;
					while ($this->$content[key($this->$content)][$i]) {
						$this->$content[key($this->$content)][$i] = trim($this->$content[key($this->$content)][$i]);
						$this->$content[key($this->$content)][$i] = $this->CreateWordWrap($this->$content[key($this->$content)][$i], '    ');
						$this->Writer->writeRaw("\n     ");
						$this->Writer->writeRaw($this->$content[key($this->$content)][$i]);
						$this->Writer->writeRaw("\n  ");
						$this->Writer->endElement();
						$i++;
						if ($this->$content[key($this->$content)][$i]) {
							$this->Writer->writeRaw("  ");
							$this->Writer->startElement('p');
							///$this->ProcessStandardAttribute('ContentPTag');
						}
						
					}
				} else {
					$this->$content[key($this->$content)] = $this->CreateWordWrap(current($this->$content), '    ');
					$this->$content[key($this->$content)] .= "\n  ";
					$this->Writer->writeRaw("\n     ");
					$this->Writer->writeRaw(current($this->$content));
				}
		} else if (current($this->$starttag)){
			$this->$starttag[key($this->$starttag)] = str_replace('<','', current($this->$starttag));
			$this->$starttag[key($this->$starttag)] = str_replace('>','', current($this->$starttag));
			$this->Writer->startElement(current($this->$starttag));
				//$this->ProcessStandardAttribute($starttag);
				
			$this->$content[key($this->$content)] = trim(current($this->$content));
			if (strpos(current($this->$content), "\n\r")) {
				$this->$content[key($this->$content)] = explode("\n\r", current($this->$content));
				$i = 0;
				while ($this->$content[key($this->$content)][$i]) {
					$this->$content[key($this->$content)][$i] = trim($this->$content[key($this->$content)][$i]);
					$this->$content[key($this->$content)][$i] = $this->CreateWordWrap($this->$content[key($this->$content)][$i], '    ');
					$this->Writer->startElement('p');
						//$this->ProcessStandardAttribute('ContentPTag');
						$this->Writer->writeRaw("\n    ");
						$this->Writer->writeRaw($this->$content[key($this->$content)][$i]);
						$this->Writer->writeRaw("\n  ");
					$this->Writer->endElement();
					$i++;
				}
			} else {
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->startElement('p');
				}
				//$this->ProcessStandardAttribute('ContentPTag');
				$this->Writer->writeRaw(" ");
				$this->Writer->writeRaw(current($this->$content));
				$this->Writer->writeRaw("\n");
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->endElement();
				}
			}
		} else if (current($this->$content)) {
			$this->$starttag[key($this->$starttag)] = str_replace('<','', current($this->$starttag));
			$this->$starttag[key($this->$starttag)] = str_replace('>','', current($this->$starttag));
			//$this->ProcessStandardAttribute($starttag);
				
			$this->$content[key($this->$content)] = trim(current($this->$content));
			if (strpos(current($this->$content), "\n\r")) {
				$this->$content[key($this->$content)] = explode("\n\r", current($this->$content));
				$i = 0;
				while ($this->$content[key($this->$content)][$i]) {
					$this->$content[key($this->$content)][$i] = trim($this->$content[key($this->$content)][$i]);
					$this->$content[key($this->$content)][$i] = $this->CreateWordWrap($this->$content[key($this->$content)][$i], '    ');
					$this->Writer->startElement('p');
						//$this->ProcessStandardAttribute('ContentPTag');
						$this->Writer->writeRaw("\n    ");
						$this->Writer->writeRaw($this->$content[key($this->$content)][$i]);
						$this->Writer->writeRaw("\n  ");
					$this->Writer->endElement();
					$i++;
				}
			} else {
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->startElement('p');
				}
				//$this->ProcessStandardAttribute('ContentPTag');
				$this->Writer->writeRaw(" ");
				$this->Writer->writeRaw(current($this->$content));
				$this->Writer->writeRaw("\n");
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->endElement();
				}
			}
		}
		
		if (current($this->$endtag)) {
			$this->Writer->endElement();
		}
	}
	
	public function CreateOutput($space) {
		$i = 0;
		
		if (current($this->FormLookupTableName['Form'])) {
			reset($this->FormLookupTableName['Form']);
			
			reset($this->FormAction);
	 		reset($this->FormAccept);
	 		reset($this->FormAcceptCharset);
	 		reset($this->FormEnctype);
	 		reset($this->FormMethod);
	 		reset($this->FormName);
	 		
			// Standard Attributes
			reset($this->FormClass);
	 		reset($this->FormDir);
	 		reset($this->FormID);
	 		reset($this->FormLang);
	 		reset($this->FormStyle);
			reset($this->FormTitle);
			reset($this->FormXMLLang);
	
			reset($this->FormEnableDisable);
			reset($this->FormStatus);
			while (current($this->FormLookupTableName['Form'])) {
				if (current($this->FormEnableDisable) == 'Enable' && current($this->FormStatus) == 'Approved') {
					$this->Writer->startElement('form');
					//$this->Writer->writeRaw("\n");
					if (current($this->FormAction)) {
						$this->Writer->writeAttribute('action', current($this->FormAction));
					}
					if (current($this->FormAccept)) {
						$this->Writer->writeAttribute('accept', current($this->FormAccept));
					}
					if (current($this->FormAcceptCharset)) {
						$this->Writer->writeAttribute('accept-charset', current($this->FormAcceptCharset));
					}
					if (current($this->FormEnctype)) {
						$this->Writer->writeAttribute('enctype', current($this->FormEnctype));
					}
					if (current($this->FormMethod)) {
						$this->Writer->writeAttribute('method', current($this->FormMethod));
					}
					if (current($this->FormName)) {
						$this->Writer->writeAttribute('name', current($this->FormName));
					}
					$this->ProcessArrayStandardAttribute('Form');
					$this->Writer->writeRaw("\n");
					
					reset($this->FormLookupTableName['FormTableListing']);
					reset($this->FormTableListingPageID);
					reset($this->FormTableListingObjectID);
					reset($this->FormTableListingContainerObjectType);
					reset($this->FormTableListingContainerObjectTypeName);
					reset($this->FormTableListingContainerObjectID);
					reset($this->FormTableListingContentStartTag);
					reset($this->FormTableListingContentEndTag);
					reset($this->FormTableListingContent);
					reset($this->FormTableListingEnableDisable);
					reset($this->FormTableListingStatus);
					while (current($this->FormLookupTableName['FormTableListing'])) {
						if (current($this->FormTableListingEnableDisable) == 'Enable' && current($this->FormTableListingStatus) == 'Approved') {
							$this->createTextArea('FormTableListing');
							if (current($this->FormTableListingContainerObjectType) == 'Input') {
								$this->buildFormInput(current($this->FormTableListingContainerObjectID));
							}
							
							if (current($this->FormTableListingContainerObjectType) == 'Label') {
								$this->buildFormLabel(current($this->FormTableListingContainerObjectID));
							}
							
							if (current($this->FormTableListingContainerObjectType) == 'TextArea') {
								$this->buildFormTextArea(current($this->FormTableListingContainerObjectID));
							}
						}
						next($this->FormLookupTableName['FormTableListing']);
						next($this->FormTableListingPageID);
						next($this->FormTableListingObjectID);
						next($this->FormTableListingContainerObjectType);
						next($this->FormTableListingContainerObjectTypeName);
						next($this->FormTableListingContainerObjectID);
						next($this->FormTableListingContentStartTag);
						next($this->FormTableListingContentEndTag);
						next($this->FormTableListingContent);
						next($this->FormTableListingEnableDisable);
						next($this->FormTableListingStatus);
					}
					
					$this->Writer->endElement(); // ENDS FORM
				}
				next($this->FormLookupTableName['Form']);
				
				next($this->FormAction);
	 			next($this->FormAccept);
	 			next($this->FormAcceptCharset);
	 			next($this->FormEnctype);
	 			next($this->FormMethod);
	 			next($this->FormName);
	 			
				// Standard Attributes
				next($this->FormClass);
	 			next($this->FormDir);
	 			next($this->FormID);
	 			next($this->FormLang);
	 			next($this->FormStyle);
				next($this->FormTitle);
				next($this->FormXMLLang);
				next($this->FormEnableDisable);
				next($this->FormStatus);
			}
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->Form = $this->Writer->flush();
		}
		
	}
	
	public function getOutput() {
		return $this->Form;
	}
}
?>