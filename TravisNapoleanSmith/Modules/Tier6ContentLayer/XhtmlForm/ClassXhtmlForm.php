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
	
	// Xhtml Form Field Set
	protected $FormFieldSetPageID = array();
	protected $FormFieldSetObjectID = array();
	protected $FormFieldSetContainerObjectType = array();
	protected $FormFieldSetContainerObjectTypeName = array();
	protected $FormFieldSetContainerObjectID = array();
	
	// Xhtml Form Field Set Text
	protected $FormFieldSetTextStartTag = array();
	protected $FormFieldSetTextEndTag = array();
	protected $FormFieldSetText = array();
	protected $FormFieldSetTextDynamic = array();
	protected $FormFieldSetTextTableName = array();
	protected $FormFieldSetTextField = array();
	protected $FormFieldSetTextPageID = array();
	protected $FormFieldSetTextObjectID = array();
	protected $FormFieldSetTextRevisionID = array();
	
	// Xhtml Form Field Set Standard Attributes
	protected $FormFieldSetClass = array();
	protected $FormFieldSetDir = array();
	protected $FormFieldSetID = array();
	protected $FormFieldSetLang = array();
	protected $FormFieldSetStyle = array();
	protected $FormFieldSetTitle = array();
	protected $FormFieldSetXMLLang = array();
	
	protected $FormFieldSetEnableDisable = array();
	protected $FormFieldSetStatus = array();
	
	// Xhtml Form Legend
	protected $FormLegendPageID = array();
	protected $FormLegendObjectID = array();
	
	// Xhtml Form Legend Text
	protected $FormLegendText = array();
	protected $FormLegendTextDynamic = array();
	protected $FormLegendTextTableName = array();
	protected $FormLegendTextField = array();
	protected $FormLegendTextPageID = array();
	protected $FormLegendTextObjectID = array();
	protected $FormLegendTextRevisionID = array();
	
	// Xhtml Form Legend Standard Attributes
	protected $FormLegendAccessKey = array();
	protected $FormLegendClass = array();
	protected $FormLegendDir = array();
	protected $FormLegendID = array();
	protected $FormLegendLang = array();
	protected $FormLegendStyle = array();
	protected $FormLegendTitle = array();
	protected $FormLegendXMLLang = array();
	
	protected $FormLegendEnableDisable = array();
	protected $FormLegendStatus = array();
	
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
					$this->processFormFieldSet($i);
					
				} else if (current($this->TableNames) == 'FormInput') {
					$this->processFormInput($i);
				
				} else if (current($this->TableNames) == 'FormLabel') {
					$this->processFormLabel($i);
					
				} else if (current($this->TableNames) == 'FormLegend') {
					$this->processFormLegend($i);
					
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
		//print_r($this->FormLookupTableName);
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
		array_push($this->FormFieldSetPageID, $this->FormLookupTableName['FormFieldSet'][$i]['PageID']);
		array_push($this->FormFieldSetObjectID, $this->FormLookupTableName['FormFieldSet'][$i]['ObjectID']);
		array_push($this->FormFieldSetContainerObjectType, $this->FormLookupTableName['FormFieldSet'][$i]['ContainerObjectType']);
		array_push($this->FormFieldSetContainerObjectTypeName, $this->FormLookupTableName['FormFieldSet'][$i]['ContainerObjectTypeName']);
		array_push($this->FormFieldSetContainerObjectID, $this->FormLookupTableName['FormFieldSet'][$i]['ContainerObjectID']);
		
		array_push($this->FormFieldSetTextStartTag, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextStartTag']);
		array_push($this->FormFieldSetTextEndTag, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextEndTag']);
		array_push($this->FormFieldSetText, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetText']);
		array_push($this->FormFieldSetTextDynamic, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextDynamic']);
		array_push($this->FormFieldSetTextTableName, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextTableName']);
		array_push($this->FormFieldSetTextField, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextField']);
		array_push($this->FormFieldSetTextPageID, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextPageID']);
		array_push($this->FormFieldSetTextObjectID, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextObjectID']);
		array_push($this->FormFieldSetTextRevisionID, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTextRevisionID']);
		
		array_push($this->FormFieldSetClass, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetClass']);
		array_push($this->FormFieldSetDir, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetDir']);
		array_push($this->FormFieldSetID, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetID']);
		array_push($this->FormFieldSetLang, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetLang']);
		array_push($this->FormFieldSetStyle, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetStyle']);
		array_push($this->FormFieldSetTitle, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetTitle']);
		array_push($this->FormFieldSetXMLLang, $this->FormLookupTableName['FormFieldSet'][$i]['FormFieldSetXMLLang']);
		
		array_push($this->FormFieldSetEnableDisable, $this->FormLookupTableName['FormFieldSet'][$i]['Enable/Disable']);
		array_push($this->FormFieldSetStatus, $this->FormLookupTableName['FormFieldSet'][$i]['Status']);
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
		array_push($this->FormLegendPageID, $this->FormLookupTableName['FormLegend'][$i]['PageID']);
		array_push($this->FormLegendObjectID, $this->FormLookupTableName['FormLegend'][$i]['ObjectID']);
		
		array_push($this->FormLegendText, $this->FormLookupTableName['FormLegend'][$i]['FormLegendText']);
		array_push($this->FormLegendTextDynamic, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTextDynamic']);
		array_push($this->FormLegendTextTableName, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTextTableName']);
		array_push($this->FormLegendTextField, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTextField']);
		array_push($this->FormLegendTextPageID, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTextPageID']);
		array_push($this->FormLegendTextObjectID, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTextObjectID']);
		array_push($this->FormLegendTextRevisionID, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTextRevisionID']);
		
		array_push($this->FormLegendAccessKey, $this->FormLookupTableName['FormLegend'][$i]['FormLegendAccessKey']);
		array_push($this->FormLegendClass, $this->FormLookupTableName['FormLegend'][$i]['FormLegendClass']);
		array_push($this->FormLegendDir, $this->FormLookupTableName['FormLegend'][$i]['FormLegendDir']);
		array_push($this->FormLegendID, $this->FormLookupTableName['FormLegend'][$i]['FormLegendID']);
		array_push($this->FormLegendLang, $this->FormLookupTableName['FormLegend'][$i]['FormLegendLang']);
		array_push($this->FormLegendStyle, $this->FormLookupTableName['FormLegend'][$i]['FormLegendStyle']);
		array_push($this->FormLegendTitle, $this->FormLookupTableName['FormLegend'][$i]['FormLegendTitle']);
		array_push($this->FormLegendXMLLang, $this->FormLookupTableName['FormLegend'][$i]['FormLegendXMLLang']);
		
		array_push($this->FormLegendEnableDisable, $this->FormLookupTableName['FormLegend'][$i]['Enable/Disable']);
		array_push($this->FormLegendStatus, $this->FormLookupTableName['FormLegend'][$i]['Status']);
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
					$this->Writer->startElement('div');
					$this->Writer->writeRaw("\n");
					if (current($this->FormInputText)) {
						$this->Writer->writeRaw("   ");
						$this->Writer->text(current($this->FormInputText));
					} else if (current($this->FormInputTextDynamic)) {
						$tablename = current($this->FormInputTextTableName);
						$field = current($this->FormInputTextField);
						$pageid = current($this->FormInputTextPageID);
						$objectid = current($this->FormInputTextObjectID);
						$revisionid = current($this->FormInputTextRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeRaw("   ");
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
					$this->Writer->endElement(); // ENDS DIV
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
					$this->Writer->startElement('div');
					$this->Writer->writeRaw("\n");
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
					
					$this->Writer->endElement(); // ENDS LABEL
					$this->Writer->endElement(); // ENDS DIV
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
					$this->Writer->startElement('div');
					$this->Writer->writeRaw("\n");
					
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
					
					$this->Writer->endElement(); // ENDS TEXTAREA
					$this->Writer->endElement(); // ENDS DIV
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
	
	protected function createTextArea($startingvariablename, $contentvariablename) {
		$starttag = $startingvariablename;
		$starttag .= $contentvariablename;
		$starttag .= 'StartTag';
		
		$endtag = $startingvariablename;
		$endtag .= $contentvariablename;
		$endtag .= 'EndTag';
		
		$content = $startingvariablename;
		$content .= $contentvariablename;
		
		if (current($this->$starttag) == '<p>'){
			$hold = str_replace('<','', current($this->$starttag));
			$this->$starttag[key($this->$starttag)] = str_replace('>','', $hold);
			
			$this->Writer->startElement($this->$starttag[key($this->$starttag)]);
				//$this->ProcessStandardAttribute($starttag);
				$temp = trim(current($this->$content));
				if (strpos($temp, "\n\r")) {
					$hold = explode("\n\r", $temp);
					$i = 0;
					while ($hold[$i]) {
						$hold[$i] = trim($hold[$i]);
						$hold[$i] = $this->CreateWordWrap($hold[$i], '    ');
						$this->Writer->writeRaw("\n    ");
						$this->Writer->writeRaw($hold[$i]);
						$this->Writer->writeRaw("\n  ");
						$this->Writer->endElement();
						
						$i++;
						if ($hold[$i]) {
							$this->Writer->startElement('p');
							///$this->ProcessStandardAttribute('ContentPTag');
						}
						
					}
				} else {
					$hold = $this->CreateWordWrap($this->$content[key($this->$content)], '    ');
					$hold .= "\n  ";
					$this->$content[key($this->$content)] = $hold;
					$this->Writer->writeRaw("\n    ");
					$this->Writer->writeRaw($this->$content[key($this->$content)]);
				}
				
				
		} else if (current($this->$starttag)){
			$hold = str_replace('<','', current($this->$starttag));
			$this->$starttag[key($this->$starttag)] = str_replace('>','', $hold);
			$this->Writer->startElement($this->$starttag[key($this->$starttag)]);
				//$this->ProcessStandardAttribute($starttag);
				
			$temp = trim(current($this->$content));
			if (strpos($temp, "\n\r")) {
				$hold = explode("\n\r", $temp);
				$i = 0;
				while ($hold[$i]) {
					$hold[$i] = trim($hold[$i]);
					$hold[$i] = $this->CreateWordWrap($hold[$i], '     ');
					$this->Writer->startElement('p');
						//$this->ProcessStandardAttribute('ContentPTag');
						$this->Writer->writeRaw("\n     ");
						$this->Writer->writeRaw($hold[$i]);
						$this->Writer->writeRaw("\n   ");
					$this->Writer->endElement();
					$i++;
				}
			} else {
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->startElement('p');
				}
				$hold = $this->CreateWordWrap($this->$content[key($this->$content)], '     ');
				$hold .= "\n   ";
				$this->$content[key($this->$content)] = $hold;
				$this->Writer->writeRaw("\n     ");
				$this->Writer->writeRaw($this->$content[key($this->$content)]);
				
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->endElement();
				}
			}
		} else if (current($this->$content)) {
			$temp = trim(current($this->$content));
			if (strpos($temp, "\n\r")) {
				$hold = explode("\n\r", $temp);
				$i = 0;
				while ($hold[$i]) {
					$hold[$i] = trim($hold[$i]);
					$hold[$i] = $this->CreateWordWrap($hold[$i], '    ');
					$this->Writer->startElement('p');
						//$this->ProcessStandardAttribute('ContentPTag');
						$this->Writer->writeRaw("\n    ");
						$this->Writer->writeRaw($hold[$i]);
						$this->Writer->writeRaw("\n  ");
					$this->Writer->endElement();
					$i++;
				}
				
			} else {
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->startElement('p');
				}
				//$this->ProcessStandardAttribute('ContentPTag');
				if (!strstr(current($this->$content), "<br />")){
					$hold = $this->CreateWordWrap($this->$content[key($this->$content)], '    ');
					$hold .= "\n  ";
					$this->$content[key($this->$content)] = $hold;
					$this->Writer->writeRaw("\n    ");
					$this->Writer->writeRaw($this->$content[key($this->$content)]);
				} else {
					$this->Writer->writeRaw(" ");
					$this->Writer->writeRaw(current($this->$content));
					$this->Writer->writeRaw("\n");
				}
				
				if (!strstr(current($this->$content), "<br />")){
					$this->Writer->endElement();
				}
			}
		}
		
		if (current($this->$endtag)) {
			$this->Writer->endElement();
		}
	}
	
	protected function buildFormFieldSet($objectid) {
		reset($this->FormLookupTableName['FormFieldSet']);
		
		reset($this->FormFieldSetPageID);
		reset($this->FormFieldSetObjectID);
		reset($this->FormFieldSetContainerObjectType);
		reset($this->FormFieldSetContainerObjectTypeName);
		
		reset($this->FormFieldSetTextStartTag);
		reset($this->FormFieldSetTextEndTag);
		reset($this->FormFieldSetText);
		reset($this->FormFieldSetTextDynamic);
		reset($this->FormFieldSetTextTableName);
		reset($this->FormFieldSetTextField);
		reset($this->FormFieldSetTextPageID);
		reset($this->FormFieldSetTextObjectID);
		reset($this->FormFieldSetTextRevisionID);
		
		reset($this->FormFieldSetClass);
		reset($this->FormFieldSetDir);
		reset($this->FormFieldSetID);
		reset($this->FormFieldSetLang);
		reset($this->FormFieldSetStyle);
		reset($this->FormFieldSetTitle);
		reset($this->FormFieldSetXMLLang);
		
		reset($this->FormFieldSetEnableDisable);
		reset($this->FormFieldSetStatus);
		
		$flag = NULL;
		
		while (current($this->FormLookupTableName['FormFieldSet'])) {
			if (current($this->FormFieldSetEnableDisable) == 'Enable' && current($this->FormFieldSetStatus) == 'Approved') {
				if (current($this->FormFieldSetObjectID) == $objectid && current($this->FormFieldSetPageID) == $this->PageID) {
					$this->Writer->startElement('fieldset');
					$flag = TRUE;
				}
				
				if (current($this->FormFieldSetPageID) == $this->PageID) {
						$this->ProcessArrayStandardAttribute('FormFieldSet');
						
						if (current($this->FormFieldSetText)) {
							$this->createTextArea('FormFieldSet', 'Text');
						} else if (current($this->FormFieldSetTextDynamic)) {
							$tablename = current($this->FormFieldSetTextTableName);
							$field = current($this->FormFieldSetTextField);
							$pageid = current($this->FormFieldSetTextPageID);
							$objectid = current($this->FormFieldSetTextObjectID);
							$revisionid = current($this->FormFieldSetTextRevisionID);
							$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
							if ($hold) {
								$this->Writer->writeRaw("\n");
								$this->FormFieldSetText[key($this->FormFieldSetText)] = $hold;
								$this->createTextArea('FormFieldSet', 'Text');
							}
						} else {
							$this->Writer->writeRaw("\n  ");
						}
					
					if (current($this->FormFieldSetContainerObjectTypeName) == 'FormInput' && current($this->FormFieldSetContainerObjectType) == 'Input') {
						$this->buildFormInput(current($this->FormFieldSetContainerObjectID));
					}
					
					if (current($this->FormFieldSetContainerObjectTypeName) == 'FormTextArea' && current($this->FormFieldSetContainerObjectType) == 'TextArea') {
						$this->buildFormTextArea(current($this->FormFieldSetContainerObjectID));
					}
					
					if (current($this->FormFieldSetContainerObjectTypeName) == 'FormLabel' && current($this->FormFieldSetContainerObjectType) == 'Label') {
						$this->buildFormLabel(current($this->FormFieldSetContainerObjectID));
					}
					
					if (current($this->FormFieldSetContainerObjectTypeName) == 'FormLegend' && current($this->FormFieldSetContainerObjectType) == 'Legend') {
						$this->buildFormLegend(current($this->FormFieldSetContainerObjectID));
					}
					
					if (current($this->FormFieldSetContainerObjectTypeName) == 'FormSelect' && current($this->FormFieldSetContainerObjectType) == 'Select') {
						$this->buildFormSelect(current($this->FormFieldSetContainerObjectID));
					}
					
					if (current($this->FormFieldSetContainerObjectTypeName) == 'FormButton' && current($this->FormFieldSetContainerObjectType) == 'Button') {
						$this->buildFormButton(current($this->FormFieldSetContainerObjectID));
					}
				}
				
			}
			
			next($this->FormLookupTableName['FormFieldSet']);
		
			next($this->FormFieldSetPageID);
			next($this->FormFieldSetObjectID);
			next($this->FormFieldSetContainerObjectType);
			next($this->FormFieldSetContainerObjectTypeName);
			
			next($this->FormFieldSetTextStartTag);
			next($this->FormFieldSetTextEndTag);
			next($this->FormFieldSetText);
			next($this->FormFieldSetTextDynamic);
			next($this->FormFieldSetTextTableName);
			next($this->FormFieldSetTextField);
			next($this->FormFieldSetTextPageID);
			next($this->FormFieldSetTextObjectID);
			next($this->FormFieldSetTextRevisionID);
			
			next($this->FormFieldSetClass);
			next($this->FormFieldSetDir);
			next($this->FormFieldSetID);
			next($this->FormFieldSetLang);
			next($this->FormFieldSetStyle);
			next($this->FormFieldSetTitle);
			next($this->FormFieldSetXMLLang);
			
			next($this->FormFieldSetEnableDisable);
			next($this->FormFieldSetStatus);
		}
		if ($flag) {
			$this->Writer->endElement(); // ENDS FIELD SET
		}
	}
	
	protected function buildFormLegend($objectid) {
		reset($this->FormLookupTableName['FormLegend']);
		
		reset($this->FormLegendPageID);
		reset($this->FormLegendObjectID);
		
		reset($this->FormLegendText);
		reset($this->FormLegendTextDynamic);
		reset($this->FormLegendTextTableName);
		reset($this->FormLegendTextField);
		reset($this->FormLegendTextPageID);
		reset($this->FormLegendTextObjectID);
		reset($this->FormLegendTextRevisionID);
				
		reset($this->FormLegendAccessKey);
		reset($this->FormLegendClass);
		reset($this->FormLegendDir);
		reset($this->FormLegendID);
		reset($this->FormLegendLang);
		reset($this->FormLegendStyle);
		reset($this->FormLegendTitle);
		reset($this->FormLegendXMLLang);
		
		reset($this->FormLegendEnableDisable);
		reset($this->FormLegendStatus);
		
		while (current($this->FormLookupTableName['FormLegend'])) {
			if (current($this->FormLegendObjectID) == $objectid && current($this->FormLegendPageID) == $this->PageID) {
				if (current($this->FormLegendEnableDisable) == 'Enable' && current($this->FormLegendStatus) == 'Approved') {
					$this->Writer->startElement('legend');
					
					$this->ProcessArrayStandardAttribute('FormLegend');
					
					if (current($this->FormLegendText)) {
						$this->Writer->text(current($this->FormLegendText));
					} else if (current($this->FormLegendTextDynamic)) {
						$tablename = current($this->FormLegendTextTableName);
						$field = current($this->FormLegendTextField);
						$pageid = current($this->FormLegendTextPageID);
						$objectid = current($this->FormLegendTextObjectID);
						$revisionid = current($this->FormLegendTextRevisionID);
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
			next($this->FormLookupTableName['FormLegend']);
			
			next($this->FormLegendPageID);
			next($this->FormLegendObjectID);
			
			next($this->FormLegendText);
			next($this->FormLegendTextDynamic);
			next($this->FormLegendTextTableName);
			next($this->FormLegendTextField);
			next($this->FormLegendTextPageID);
			next($this->FormLegendTextObjectID);
			next($this->FormLegendTextRevisionID);
			
			next($this->FormLegendAccessKey);
			next($this->FormLegendClass);
			next($this->FormLegendDir);
			next($this->FormLegendID);
			next($this->FormLegendLang);
			next($this->FormLegendStyle);
			next($this->FormLegendTitle);
			next($this->FormLegendXMLLang);
			
			next($this->FormLegendEnableDisable);
			next($this->FormLegendStatus);
		}
		
	}
	
	protected function buildFormSelect($objectid) {
	
	}
	
	protected function buildFormButton($objectid) {
	
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
							$this->createTextArea('FormTableListing', 'Content');
							if (current($this->FormTableListingContainerObjectType) == 'Input') {
								$this->buildFormInput(current($this->FormTableListingContainerObjectID));
							}
							
							if (current($this->FormTableListingContainerObjectType) == 'Label') {
								$this->buildFormLabel(current($this->FormTableListingContainerObjectID));
							}
							
							if (current($this->FormTableListingContainerObjectType) == 'TextArea') {
								$this->buildFormTextArea(current($this->FormTableListingContainerObjectID));
							}
							
							if (current($this->FormTableListingContainerObjectType) == 'FieldSet') {
								$this->buildFormFieldSet(current($this->FormTableListingContainerObjectID));
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
		//print_r($this->FormFieldSetContainerObjectType);
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