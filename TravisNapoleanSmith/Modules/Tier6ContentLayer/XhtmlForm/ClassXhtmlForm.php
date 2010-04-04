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
	
	// Xhtml Form Select
	protected $FormSelectPageID = array();
	protected $FormSelectObjectID = array();
	protected $FormSelectContainerObjectType = array();
	protected $FormSelectContainerObjectTypeName = array();
	protected $FormSelectContainerObjectID = array();
	
	protected $FormSelectDisabled = array();
	protected $FormSelectMultiple = array();
	
	// Xhtml Form Select Name
	protected $FormSelectName = array();
	protected $FormSelectNameDynamic = array();
	protected $FormSelectNameTableName = array();
	protected $FormSelectNameField = array();
	protected $FormSelectNamePageID = array();
	protected $FormSelectNameObjectID = array();
	protected $FormSelectNameRevisionID = array();
	
	protected $FormSelectSize = array();
	
	// Xhtml Form Select Standard Attributes
	protected $FormSelectClass = array();
	protected $FormSelectDir = array();
	protected $FormSelectID = array();
	protected $FormSelectLang = array();
	protected $FormSelectStyle = array();
	protected $FormSelectTabIndex = array();
	protected $FormSelectTitle = array();
	protected $FormSelectXMLLang = array();
	
	protected $FormSelectEnableDisable = array();
	protected $FormSelectStatus = array();
	
	// Xhtml Form Option 
	protected $FormOptionPageID = array();
	protected $FormOptionObjectID = array();
	
	// Xhtml Form Option Text
	protected $FormOptionText = array();
	protected $FormOptionTextDynamic = array();
	protected $FormOptionTextTableName = array();
	protected $FormOptionTextField = array();
	protected $FormOptionTextPageID = array();
	protected $FormOptionTextObjectID = array();
	protected $FormOptionTextRevisionID = array();
	
	protected $FormOptionDisabled = array();
	
	// Xhtml Form Option Label
	protected $FormOptionLabel = array();
	protected $FormOptionLabelDynamic = array();
	protected $FormOptionLabelTableName = array();
	protected $FormOptionLabelField = array();
	protected $FormOptionLabelPageID = array();
	protected $FormOptionLabelObjectID = array();
	protected $FormOptionLabelRevisionID = array();
	
	protected $FormOptionSelected = array();
	
	// Xhtml Form Option Value
	protected $FormOptionValue = array();
	protected $FormOptionValueDynamic = array();
	protected $FormOptionValueTableName = array();
	protected $FormOptionValueField = array();
	protected $FormOptionValuePageID = array();
	protected $FormOptionValueObjectID = array();
	protected $FormOptionValueRevisionID = array();
	
	// Xhtml Form Option Standard Attributes
	protected $FormOptionClass = array();
	protected $FormOptionDir = array();
	protected $FormOptionID = array();
	protected $FormOptionLang = array();
	protected $FormOptionStyle = array();
	protected $FormOptionTitle = array();
	protected $FormOptionXMLLang = array();
	
	protected $FormOptionEnableDisable = array();
	protected $FormOptionStatus = array();
	
	// Xhtml Form Opt Group
	protected $FormOptGroupPageID = array();
	protected $FormOptGroupObjectID = array();
	protected $FormOptGroupContainerObjectType = array();
	protected $FormOptGroupContainerObjectTypeName = array();
	protected $FormOptGroupContainerObjectID = array();
	
	// Xhtml Form Opt Group Label
	protected $FormOptGroupLabel = array();
	protected $FormOptGroupLabelDynamic = array();
	protected $FormOptGroupLabelTableName = array();
	protected $FormOptGroupLabelField = array();
	protected $FormOptGroupLabelPageID = array();
	protected $FormOptGroupLabelObjectID = array();
	protected $FormOptGroupLabelRevisionID = array();
	
	protected $FormOptGroupDisabled = array();
	
	// Xhtml Form Opt Group Standard Attributes
	protected $FormOptGroupClass = array();
	protected $FormOptGroupDir = array();
	protected $FormOptGroupID = array();
	protected $FormOptGroupLang = array();
	protected $FormOptGroupStyle = array();
	protected $FormOptGroupTabIndex = array();
	protected $FormOptGroupTitle = array();
	protected $FormOptGroupXMLLang = array();
	
	protected $FormOptGroupEnableDisable = array();
	protected $FormOptGroupStatus = array();
	
	// Xhtml Form Button
	protected $FormButtonPageID = array();
	protected $FormButtonObjectID = array();
	
	// Xhtml Form Button Text
	protected $FormButtonText = array();
	protected $FormButtonTextDynamic = array();
	protected $FormButtonTextTableName = array();
	protected $FormButtonTextField = array();
	protected $FormButtonTextPageID = array();
	protected $FormButtonTextObjectID = array();
	protected $FormButtonTextRevisionID = array();
	
	protected $FormButtonDisabled = array();
	
	// Xhtml Form Button Name
	protected $FormButtonName = array();
	protected $FormButtonNameDynamic = array();
	protected $FormButtonNameTableName = array();
	protected $FormButtonNameField = array();
	protected $FormButtonNamePageID = array();
	protected $FormButtonNameObjectID = array();
	protected $FormButtonNameRevisionID = array();
	
	protected $FormButtonType = array();
	
	// Xhtml Form Button Value
	protected $FormButtonValue = array();
	protected $FormButtonValueDynamic = array();
	protected $FormButtonValueTableName = array();
	protected $FormButtonValueField = array();
	protected $FormButtonValuePageID = array();
	protected $FormButtonValueObjectID = array();
	protected $FormButtonValueRevisionID = array();
	
	// Xhtml Form Button Standard Attributes
	protected $FormButtonClass = array();
	protected $FormButtonDir = array();
	protected $FormButtonID = array();
	protected $FormButtonLang = array();
	protected $FormButtonStyle = array();
	protected $FormButtonTabIndex = array();
	protected $FormButtonTitle = array();
	protected $FormButtonXMLLang = array();
	
	protected $FormButtonEnableDisable = array();
	protected $FormButtonStatus = array();
	
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
				
				} else if (current($this->TableNames) == 'FormButton') {
					$this->processFormButton($i);
					
				} else if (current($this->TableNames) == 'FormFieldSet') {
					$this->processFormFieldSet($i);
					
				} else if (current($this->TableNames) == 'FormInput') {
					$this->processFormInput($i);
				
				} else if (current($this->TableNames) == 'FormLabel') {
					$this->processFormLabel($i);
					
				} else if (current($this->TableNames) == 'FormLegend') {
					$this->processFormLegend($i);
					
				} else if (current($this->TableNames) == 'FormOption') {
					$this->processFormOption($i); 
					
				} else if (current($this->TableNames) == 'FormOptGroup') {
					$this->processFormOptGroup($i);
					
				} else if (current($this->TableNames) == 'FormSelect') {
					$this->processFormSelect($i);
					
				} else if (current($this->TableNames) == 'FormButton') {
					$this->processFormButton($i); 
					
				} else if (current($this->TableNames) == 'FormTableListing') {
					$this->processFormTableListing($i);
				
				} else if (current($this->TableNames) == 'FormTextArea') {
					$this->processFormTextArea($i);
				}
				$i++;
			}
			
			next($this->TableNames);
		}
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
	
	protected function processFormButton($i) {
		array_push($this->FormButtonPageID, $this->FormLookupTableName['FormButton'][$i]['PageID']);
		array_push($this->FormButtonObjectID, $this->FormLookupTableName['FormButton'][$i]['ObjectID']);
		
		array_push($this->FormButtonText, $this->FormLookupTableName['FormButton'][$i]['FormButtonText']);
		array_push($this->FormButtonTextDynamic, $this->FormLookupTableName['FormButton'][$i]['FormButtonTextDynamic']);
		array_push($this->FormButtonTextTableName, $this->FormLookupTableName['FormButton'][$i]['FormButtonTextTableName']);
		array_push($this->FormButtonTextField, $this->FormLookupTableName['FormButton'][$i]['FormButtonTextField']);
		array_push($this->FormButtonTextPageID, $this->FormLookupTableName['FormButton'][$i]['FormButtonTextPageID']);
		array_push($this->FormButtonTextObjectID, $this->FormLookupTableName['FormButton'][$i]['FormButtonTextObjectID']);
		array_push($this->FormButtonTextRevisionID, $this->FormLookupTableName['FormButton'][$i]['FormButtonTextRevisionID']);
		
		array_push($this->FormButtonDisabled, $this->FormLookupTableName['FormButton'][$i]['FormButtonDisabled']);
		
		array_push($this->FormButtonName, $this->FormLookupTableName['FormButton'][$i]['FormButtonName']);
		array_push($this->FormButtonNameDynamic, $this->FormLookupTableName['FormButton'][$i]['FormButtonNameDynamic']);
		array_push($this->FormButtonNameTableName, $this->FormLookupTableName['FormButton'][$i]['FormButtonNameTableName']);
		array_push($this->FormButtonNameField, $this->FormLookupTableName['FormButton'][$i]['FormButtonNameField']);
		array_push($this->FormButtonNamePageID, $this->FormLookupTableName['FormButton'][$i]['FormButtonNamePageID']);
		array_push($this->FormButtonNameObjectID, $this->FormLookupTableName['FormButton'][$i]['FormButtonNameObjectID']);
		array_push($this->FormButtonNameRevisionID, $this->FormLookupTableName['FormButton'][$i]['FormButtonNameRevisionID']);
		
		array_push($this->FormButtonType, $this->FormLookupTableName['FormButton'][$i]['FormButtonType']);
		
		array_push($this->FormButtonValue, $this->FormLookupTableName['FormButton'][$i]['FormButtonValue']);
		array_push($this->FormButtonValueDynamic, $this->FormLookupTableName['FormButton'][$i]['FormButtonValueDynamic']);
		array_push($this->FormButtonValueTableName, $this->FormLookupTableName['FormButton'][$i]['FormButtonValueTableName']);
		array_push($this->FormButtonValueField, $this->FormLookupTableName['FormButton'][$i]['FormButtonValueField']);
		array_push($this->FormButtonValuePageID, $this->FormLookupTableName['FormButton'][$i]['FormButtonValuePageID']);
		array_push($this->FormButtonValueObjectID, $this->FormLookupTableName['FormButton'][$i]['FormButtonValueObjectID']);
		array_push($this->FormButtonValueRevisionID, $this->FormLookupTableName['FormButton'][$i]['FormButtonValueRevisionID']);
		
		array_push($this->FormButtonClass, $this->FormLookupTableName['FormButton'][$i]['FormButtonClass']);
		array_push($this->FormButtonDir, $this->FormLookupTableName['FormButton'][$i]['FormButtonDir']);
		array_push($this->FormButtonID, $this->FormLookupTableName['FormButton'][$i]['FormButtonID']);
		array_push($this->FormButtonLang, $this->FormLookupTableName['FormButton'][$i]['FormButtonLang']);
		array_push($this->FormButtonStyle, $this->FormLookupTableName['FormButton'][$i]['FormButtonStyle']);
		array_push($this->FormButtonTitle, $this->FormLookupTableName['FormButton'][$i]['FormButtonTitle']);
		array_push($this->FormButtonXMLLang, $this->FormLookupTableName['FormButton'][$i]['FormButtonXMLLang']);
		
		array_push($this->FormButtonEnableDisable, $this->FormLookupTableName['FormButton'][$i]['Enable/Disable']);
		array_push($this->FormButtonStatus, $this->FormLookupTableName['FormButton'][$i]['Status']);
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
	
	protected function processFormOption($i) {
		array_push($this->FormOptionPageID, $this->FormLookupTableName['FormOption'][$i]['PageID']);
		array_push($this->FormOptionObjectID, $this->FormLookupTableName['FormOption'][$i]['ObjectID']);
		
		array_push($this->FormOptionText, $this->FormLookupTableName['FormOption'][$i]['FormOptionText']);
		array_push($this->FormOptionTextDynamic, $this->FormLookupTableName['FormOption'][$i]['FormOptionTextDynamic']);
		array_push($this->FormOptionTextTableName, $this->FormLookupTableName['FormOption'][$i]['FormOptionTextTableName']);
		array_push($this->FormOptionTextField, $this->FormLookupTableName['FormOption'][$i]['FormOptionTextField']);
		array_push($this->FormOptionTextPageID, $this->FormLookupTableName['FormOption'][$i]['FormOptionTextPageID']);
		array_push($this->FormOptionTextObjectID, $this->FormLookupTableName['FormOption'][$i]['FormOptionTextObjectID']);
		array_push($this->FormOptionTextRevisionID, $this->FormLookupTableName['FormOption'][$i]['FormOptionTextRevisionID']);
		
		array_push($this->FormOptionDisabled, $this->FormLookupTableName['FormOption'][$i]['FormOptionDisabled']);
		
		array_push($this->FormOptionLabel, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabel']);
		array_push($this->FormOptionLabelDynamic, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabelDynamic']);
		array_push($this->FormOptionLabelTableName, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabelTableName']);
		array_push($this->FormOptionLabelField, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabelField']);
		array_push($this->FormOptionLabelPageID, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabelPageID']);
		array_push($this->FormOptionLabelObjectID, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabelObjectID']);
		array_push($this->FormOptionLabelRevisionID, $this->FormLookupTableName['FormOption'][$i]['FormOptionLabelRevisionID']);
		
		array_push($this->FormOptionSelected, $this->FormLookupTableName['FormOption'][$i]['FormOptionSelected']);
		
		array_push($this->FormOptionValue, $this->FormLookupTableName['FormOption'][$i]['FormOptionValue']);
		array_push($this->FormOptionValueDynamic, $this->FormLookupTableName['FormOption'][$i]['FormOptionValueDynamic']);
		array_push($this->FormOptionValueTableName, $this->FormLookupTableName['FormOption'][$i]['FormOptionValueTableName']);
		array_push($this->FormOptionValueField, $this->FormLookupTableName['FormOption'][$i]['FormOptionValueField']);
		array_push($this->FormOptionValuePageID, $this->FormLookupTableName['FormOption'][$i]['FormOptionValuePageID']);
		array_push($this->FormOptionValueObjectID, $this->FormLookupTableName['FormOption'][$i]['FormOptionValueObjectID']);
		array_push($this->FormOptionValueRevisionID, $this->FormLookupTableName['FormOption'][$i]['FormOptionValueRevisionID']);
		
		array_push($this->FormOptionClass, $this->FormLookupTableName['FormOption'][$i]['FormOptionClass']);
		array_push($this->FormOptionDir, $this->FormLookupTableName['FormOption'][$i]['FormOptionDir']);
		array_push($this->FormOptionID, $this->FormLookupTableName['FormOption'][$i]['FormOptionID']);
		array_push($this->FormOptionLang, $this->FormLookupTableName['FormOption'][$i]['FormOptionLang']);
		array_push($this->FormOptionStyle, $this->FormLookupTableName['FormOption'][$i]['FormOptionStyle']);
		array_push($this->FormOptionTitle, $this->FormLookupTableName['FormOption'][$i]['FormOptionTitle']);
		array_push($this->FormOptionXMLLang, $this->FormLookupTableName['FormOption'][$i]['FormOptionXMLLang']);
		
		array_push($this->FormOptionEnableDisable, $this->FormLookupTableName['FormOption'][$i]['Enable/Disable']);
		array_push($this->FormOptionStatus, $this->FormLookupTableName['FormOption'][$i]['Status']);
	}
	
	protected function processFormOptGroup($i) {
		array_push($this->FormOptGroupPageID, $this->FormLookupTableName['FormOptGroup'][$i]['PageID']);
		array_push($this->FormOptGroupObjectID, $this->FormLookupTableName['FormOptGroup'][$i]['ObjectID']);
		array_push($this->FormOptGroupContainerObjectType, $this->FormLookupTableName['FormOptGroup'][$i]['ContainerObjectType']);
		array_push($this->FormOptGroupContainerObjectTypeName, $this->FormLookupTableName['FormOptGroup'][$i]['ContainerObjectTypeName']);
		array_push($this->FormOptGroupContainerObjectID, $this->FormLookupTableName['FormOptGroup'][$i]['ContainerObjectID']);
		
		array_push($this->FormOptGroupLabel, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabel']);
		array_push($this->FormOptGroupLabelDynamic, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabelDynamic']);
		array_push($this->FormOptGroupLabelTableName, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabelTableName']);
		array_push($this->FormOptGroupLabelField, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabelField']);
		array_push($this->FormOptGroupLabelPageID, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabelPageID']);
		array_push($this->FormOptGroupLabelObjectID, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabelObjectID']);
		array_push($this->FormOptGroupLabelRevisionID, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLabelRevisionID']);
		
		array_push($this->FormOptGroupDisabled, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupDisabled']);
		
		array_push($this->FormOptGroupClass, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupClass']);
		array_push($this->FormOptGroupDir, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupDir']);
		array_push($this->FormOptGroupID, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupID']);
		array_push($this->FormOptGroupLang, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupLang']);
		array_push($this->FormOptGroupStyle, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupStyle']);
		array_push($this->FormOptGroupTabIndex, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupTabIndex']);
		array_push($this->FormOptGroupTitle, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupTitle']);
		array_push($this->FormOptGroupXMLLang, $this->FormLookupTableName['FormOptGroup'][$i]['FormOptGroupXMLLang']);
		
		array_push($this->FormOptGroupEnableDisable, $this->FormLookupTableName['FormOptGroup'][$i]['Enable/Disable']);
		array_push($this->FormOptGroupStatus, $this->FormLookupTableName['FormOptGroup'][$i]['Status']);
	}
	
	protected function processFormSelect($i) {
		array_push($this->FormSelectPageID, $this->FormLookupTableName['FormSelect'][$i]['PageID']);
		array_push($this->FormSelectObjectID, $this->FormLookupTableName['FormSelect'][$i]['ObjectID']);
		array_push($this->FormSelectContainerObjectType, $this->FormLookupTableName['FormSelect'][$i]['ContainerObjectType']);
		array_push($this->FormSelectContainerObjectTypeName, $this->FormLookupTableName['FormSelect'][$i]['ContainerObjectTypeName']);
		array_push($this->FormSelectContainerObjectID, $this->FormLookupTableName['FormSelect'][$i]['ContainerObjectID']);
		
		array_push($this->FormSelectDisabled, $this->FormLookupTableName['FormSelect'][$i]['FormSelectDisabled']);
		array_push($this->FormSelectMultiple, $this->FormLookupTableName['FormSelect'][$i]['FormSelectMultiple']);
		
		array_push($this->FormSelectName, $this->FormLookupTableName['FormSelect'][$i]['FormSelectName']);
		array_push($this->FormSelectNameDynamic, $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameDynamic']);
		array_push($this->FormSelectNameTableName, $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameTableName']);
		array_push($this->FormSelectNameField, $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameField']);
		array_push($this->FormSelectNamePageID, $this->FormLookupTableName['FormSelect'][$i]['FormSelectNamePageID']);
		array_push($this->FormSelectNameObjectID, $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameObjectID']);
		array_push($this->FormSelectNameRevisionID, $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameRevisionID']);
		
		array_push($this->FormSelectSize, $this->FormLookupTableName['FormSelect'][$i]['FormSelectSize']);
		
		array_push($this->FormSelectClass, $this->FormLookupTableName['FormSelect'][$i]['FormSelectClass']);
		array_push($this->FormSelectDir, $this->FormLookupTableName['FormSelect'][$i]['FormSelectDir']);
		array_push($this->FormSelectID, $this->FormLookupTableName['FormSelect'][$i]['FormSelectID']);
		array_push($this->FormSelectLang, $this->FormLookupTableName['FormSelect'][$i]['FormSelectLang']);
		array_push($this->FormSelectStyle, $this->FormLookupTableName['FormSelect'][$i]['FormSelectStyle']);
		array_push($this->FormSelectTabIndex, $this->FormLookupTableName['FormSelect'][$i]['FormSelectTabIndex']);
		array_push($this->FormSelectTitle, $this->FormLookupTableName['FormSelect'][$i]['FormSelectTitle']);
		array_push($this->FormSelectXMLLang, $this->FormLookupTableName['FormSelect'][$i]['FormSelectXMLLang']);
		
		array_push($this->FormSelectEnableDisable, $this->FormLookupTableName['FormSelect'][$i]['Enable/Disable']);
		array_push($this->FormSelectStatus, $this->FormLookupTableName['FormSelect'][$i]['Status']);
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
		reset($this->FormFieldSetContainerObjectID);
		
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
			next($this->FormFieldSetContainerObjectID);
			
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
		reset($this->FormLookupTableName['FormSelect']);
		
		reset($this->FormSelectPageID);
		reset($this->FormSelectObjectID);
		reset($this->FormSelectContainerObjectType);
		reset($this->FormSelectContainerObjectTypeName);
		reset($this->FormSelectContainerObjectID);
		
		reset($this->FormSelectDisabled);
		reset($this->FormSelectMultiple);
		
		reset($this->FormSelectName);
		reset($this->FormSelectNameDynamic);
		reset($this->FormSelectNameTableName);
		reset($this->FormSelectNameField);
		reset($this->FormSelectNamePageID);
		reset($this->FormSelectNameObjectID);
		reset($this->FormSelectNameRevisionID);
		
		reset($this->FormSelectSize);
		
		reset($this->FormSelectClass);
		reset($this->FormSelectDir);
		reset($this->FormSelectID);
		reset($this->FormSelectLang);
		reset($this->FormSelectStyle);
		reset($this->FormSelectTabIndex);
		reset($this->FormSelectTitle);
		reset($this->FormSelectXMLLang);
		
		reset($this->FormSelectEnableDisable);
		reset($this->FormSelectStatus);
		
		$flag = NULL;
		
		while (current($this->FormLookupTableName['FormSelect'])) {
			if (current($this->FormSelectEnableDisable) == 'Enable' && current($this->FormSelectStatus) == 'Approved') {
				if (current($this->FormSelectObjectID) == $objectid && current($this->FormSelectPageID) == $this->PageID) {
					$this->Writer->startElement('select');
					$flag = TRUE;
				}
				
				if (current($this->FormSelectPageID) == $this->PageID) {
						$this->ProcessArrayStandardAttribute('FormSelect');
						
						if (current($this->FormSelectDisabled)) {
							$this->Writer->writeAttribute('disabled', current($this->FormSelectDisabled));
						}
						
						if (current($this->FormSelectMultiple)) {
							$this->Writer->writeAttribute('multiple', current($this->FormSelectMultiple));
						}
						
						if (current($this->FormSelectSize)) {
							$this->Writer->writeAttribute('size', current($this->FormSelectSize));
						}
						
						if (current($this->FormSelectName)) {
							$this->Writer->writeAttribute('name', current($this->FormSelectName));
						} else if (current($this->FormSelectNameDynamic)) {
							$tablename = current($this->FormSelectNameTableName);
							$field = current($this->FormSelectNameField);
							$pageid = current($this->FormSelectNamePageID);
							$objectid = current($this->FormSelectNameObjectID);
							$revisionid = current($this->FormSelectNameRevisionID);
							$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
							if ($hold) {
								$this->Writer->writeAttribute('name', $hold);
							}
						}
					if (current($this->FormSelectContainerObjectTypeName) == 'FormOptGroup' && current($this->FormSelectContainerObjectType) == 'OptGroup') {
						$this->buildFormOptGroup(current($this->FormSelectContainerObjectID));
					} else if (current($this->FormSelectContainerObjectTypeName) == 'FormOption' && current($this->FormSelectContainerObjectType) == 'Option') {
						$this->buildFormOption(current($this->FormSelectContainerObjectID));
					} else if (current($this->FormSelectContainerObjectType)) {
						$this->buildObjects(current($this->FormSelectContainerObjectID), 1, current($this->FormSelectContainerObjectTypeName), current($this->FormSelectContainerObjectType));
					}
				}
			}
			next($this->FormLookupTableName['FormSelect']);
			
			next($this->FormSelectPageID);
			next($this->FormSelectObjectID);
			next($this->FormSelectContainerObjectType);
			next($this->FormSelectContainerObjectTypeName);
			next($this->FormSelectContainerObjectID);
			
			next($this->FormSelectDisabled);
			next($this->FormSelectMultiple);
			
			next($this->FormSelectName);
			next($this->FormSelectNameDynamic);
			next($this->FormSelectNameTableName);
			next($this->FormSelectNameField);
			next($this->FormSelectNamePageID);
			next($this->FormSelectNameObjectID);
			next($this->FormSelectNameRevisionID);
			
			next($this->FormSelectSize);
			
			next($this->FormSelectClass);
			next($this->FormSelectDir);
			next($this->FormSelectID);
			next($this->FormSelectLang);
			next($this->FormSelectStyle);
			next($this->FormSelectTabIndex);
			next($this->FormSelectTitle);
			next($this->FormSelectXMLLang);
			
			next($this->FormSelectEnableDisable);
			next($this->FormSelectStatus);
		}
		
		if ($flag) {
			$this->Writer->endElement(); // ENDS SELECT
		}
	}
	
	protected function buildFormButton($objectid) {
		reset($this->FormLookupTableName['FormButton']);
		
		reset($this->FormButtonPageID);
		reset($this->FormButtonObjectID);
		
		reset($this->FormButtonText);
		reset($this->FormButtonTextDynamic);
		reset($this->FormButtonTextTableName);
		reset($this->FormButtonTextField);
		reset($this->FormButtonTextPageID);
		reset($this->FormButtonTextObjectID);
		reset($this->FormButtonTextRevisionID);
		
		reset($this->FormButtonDisabled);
		
		reset($this->FormButtonName);
		reset($this->FormButtonNameDynamic);
		reset($this->FormButtonNameTableName);
		reset($this->FormButtonNameField);
		reset($this->FormButtonNamePageID);
		reset($this->FormButtonNameObjectID);
		reset($this->FormButtonNameRevisionID);
		
		reset($this->FormButtonType);
		
		reset($this->FormButtonValue);
		reset($this->FormButtonValueDynamic);
		reset($this->FormButtonValueTableName);
		reset($this->FormButtonValueField);
		reset($this->FormButtonValuePageID);
		reset($this->FormButtonValueObjectID);
		reset($this->FormButtonValueRevisionID);
		
		reset($this->FormButtonClass);
		reset($this->FormButtonDir);
		reset($this->FormButtonID);
		reset($this->FormButtonLang);
		reset($this->FormButtonStyle);
		reset($this->FormButtonTitle);
		reset($this->FormButtonXMLLang);
		
		reset($this->FormButtonEnableDisable);
		reset($this->FormButtonStatus);
		
		while (current($this->FormLookupTableName['FormButton'])) {
			if (current($this->FormButtonObjectID) == $objectid && current($this->FormButtonPageID) == $this->PageID) {
				if (current($this->FormButtonEnableDisable) == 'Enable' && current($this->FormButtonStatus) == 'Approved') {
					$this->Writer->startElement('button');
					
					$this->ProcessArrayStandardAttribute('FormButton');
					
					if (current($this->FormButtonDisabled)) {
						$this->Writer->writeAttribute('disabled', current($this->FormButtonDisabled));
					}
					
					if (current($this->FormButtonName)) {
						$this->Writer->writeAttribute('name', current($this->FormButtonName));
					} else if (current($this->FormButtonNameDynamic)) {
						$tablename = current($this->FormButtonNameTableName);
						$field = current($this->FormButtonNameField);
						$pageid = current($this->FormButtonNamePageID);
						$objectid = current($this->FormButtonNameObjectID);
						$revisionid = current($this->FormButtonNameRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeAttribute('name', $hold);
						}
					}
					
					if (current($this->FormButtonValue)) {
						$this->Writer->writeAttribute('value', current($this->FormButtonValue));
					} else if (current($this->FormButtonValueDynamic)) {
						$tablename = current($this->FormButtonValueTableName);
						$field = current($this->FormButtonValueField);
						$pageid = current($this->FormButtonValuePageID);
						$objectid = current($this->FormButtonValueObjectID);
						$revisionid = current($this->FormButtonValueRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeAttribute('value', $hold);
						}
					}
					
					if (current($this->FormButtonText)) {
						$this->Writer->text(current($this->FormButtonText));
					} else if (current($this->FormButtonTextDynamic)) {
						$tablename = current($this->FormButtonTextTableName);
						$field = current($this->FormButtonTextField);
						$pageid = current($this->FormButtonTextPageID);
						$objectid = current($this->FormButtonTextObjectID);
						$revisionid = current($this->FormButtonTextRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						$hold = $this->CreateWordWrap($hold, '    ');
						if ($hold) {
							$this->Writer->writeRaw("\n    ");
							$this->Writer->text($hold);
							$this->Writer->writeRaw("\n  ");
						}
					}
					
					$this->Writer->endElement(); // ENDS BUTTON
				}
			}
			
			next($this->FormLookupTableName['FormButton']);
			
			next($this->FormButtonPageID);
			next($this->FormButtonObjectID);
			
			next($this->FormButtonText);
			next($this->FormButtonTextDynamic);
			next($this->FormButtonTextTableName);
			next($this->FormButtonTextField);
			next($this->FormButtonTextPageID);
			next($this->FormButtonTextObjectID);
			next($this->FormButtonTextRevisionID);
			
			next($this->FormButtonDisabled);
			
			next($this->FormButtonName);
			next($this->FormButtonNameDynamic);
			next($this->FormButtonNameTableName);
			next($this->FormButtonNameField);
			next($this->FormButtonNamePageID);
			next($this->FormButtonNameObjectID);
			next($this->FormButtonNameRevisionID);
			
			next($this->FormButtonType);
			
			next($this->FormButtonValue);
			next($this->FormButtonValueDynamic);
			next($this->FormButtonValueTableName);
			next($this->FormButtonValueField);
			next($this->FormButtonValuePageID);
			next($this->FormButtonValueObjectID);
			next($this->FormButtonValueRevisionID);
			
			next($this->FormButtonClass);
			next($this->FormButtonDir);
			next($this->FormButtonID);
			next($this->FormButtonLang);
			next($this->FormButtonStyle);
			next($this->FormButtonTitle);
			next($this->FormButtonXMLLang);
			
			next($this->FormButtonEnableDisable);
			next($this->FormButtonStatus);
		}
	}
	
	protected function buildFormOption($objectid) {
		reset($this->FormLookupTableName['FormOption']);
		
		reset($this->FormOptionPageID);
		reset($this->FormOptionObjectID);
		
		reset($this->FormOptionText);
		reset($this->FormOptionTextDynamic);
		reset($this->FormOptionTextTableName);
		reset($this->FormOptionTextField);
		reset($this->FormOptionTextPageID);
		reset($this->FormOptionTextObjectID);
		reset($this->FormOptionTextRevisionID);
		
		reset($this->FormOptionDisabled);
		
		reset($this->FormOptionLabel);
		reset($this->FormOptionLabelDynamic);
		reset($this->FormOptionLabelTableName);
		reset($this->FormOptionLabelField);
		reset($this->FormOptionLabelPageID);
		reset($this->FormOptionLabelObjectID);
		reset($this->FormOptionLabelRevisionID);
		
		reset($this->FormOptionSelected);
		
		reset($this->FormOptionValue);
		reset($this->FormOptionValueDynamic);
		reset($this->FormOptionValueTableName);
		reset($this->FormOptionValueField);
		reset($this->FormOptionValuePageID);
		reset($this->FormOptionValueObjectID);
		reset($this->FormOptionValueRevisionID);
		
		reset($this->FormOptionClass);
		reset($this->FormOptionDir);
		reset($this->FormOptionID);
		reset($this->FormOptionLang);
		reset($this->FormOptionStyle);
		reset($this->FormOptionTitle);
		reset($this->FormOptionXMLLang);
		
		reset($this->FormOptionEnableDisable);
		reset($this->FormOptionStatus);
		
		while (current($this->FormLookupTableName['FormOption'])) {
			if (current($this->FormOptionObjectID) == $objectid && current($this->FormOptionPageID) == $this->PageID) {
				if (current($this->FormOptionEnableDisable) == 'Enable' && current($this->FormOptionStatus) == 'Approved') {
					$this->Writer->startElement('option');
					
					$this->ProcessArrayStandardAttribute('FormOption');
					
					if (current($this->FormOptionDisabled)) {
						$this->Writer->writeAttribute('disabled', current($this->FormOptionDisabled));
					}
					
					if (current($this->FormOptionLabel)) {
						$this->Writer->writeAttribute('label', current($this->FormOptionLabel));
					} else if (current($this->FormOptionLabelDynamic)) {
						$tablename = current($this->FormOptionLabelTableName);
						$field = current($this->FormOptionLabelField);
						$pageid = current($this->FormOptionLabelPageID);
						$objectid = current($this->FormOptionLabelObjectID);
						$revisionid = current($this->FormOptionLabelRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeAttribute('label', $hold);
						}
					}
					
					if (current($this->FormOptionSelected)) {
						$this->Writer->writeAttribute('selected', current($this->FormOptionSelected));
					}
					
					if (current($this->FormOptionValue)) {
						$this->Writer->writeAttribute('value', current($this->FormOptionValue));
					} else if (current($this->FormOptionValueDynamic)) {
						$tablename = current($this->FormOptionValueTableName);
						$field = current($this->FormOptionValueField);
						$pageid = current($this->FormOptionValuePageID);
						$objectid = current($this->FormOptionValueObjectID);
						$revisionid = current($this->FormOptionValueRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						if ($hold) {
							$this->Writer->writeAttribute('value', $hold);
						}
					}
					
					if (current($this->FormOptionText)) {
						$this->Writer->text(current($this->FormOptionText));
					} else if (current($this->FormOptionTextDynamic)) {
						$tablename = current($this->FormOptionTextTableName);
						$field = current($this->FormOptionTextField);
						$pageid = current($this->FormOptionTextPageID);
						$objectid = current($this->FormOptionTextObjectID);
						$revisionid = current($this->FormOptionTextRevisionID);
						$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
						$hold = $this->CreateWordWrap($hold, '    ');
						if ($hold) {
							$this->Writer->writeRaw("\n    ");
							$this->Writer->text($hold);
							$this->Writer->writeRaw("\n  ");
						}
					}
					
					$this->Writer->endElement(); // ENDS OPTION
				}
			}
			next($this->FormLookupTableName['FormOption']);
			
			next($this->FormOptionPageID);
			next($this->FormOptionObjectID);
			
			next($this->FormOptionText);
			next($this->FormOptionTextDynamic);
			next($this->FormOptionTextTableName);
			next($this->FormOptionTextField);
			next($this->FormOptionTextPageID);
			next($this->FormOptionTextObjectID);
			next($this->FormOptionTextRevisionID);
			
			next($this->FormOptionDisabled);
			
			next($this->FormOptionLabel);
			next($this->FormOptionLabelDynamic);
			next($this->FormOptionLabelTableName);
			next($this->FormOptionLabelField);
			next($this->FormOptionLabelPageID);
			next($this->FormOptionLabelObjectID);
			next($this->FormOptionLabelRevisionID);
			
			next($this->FormOptionSelected);
			
			next($this->FormOptionValue);
			next($this->FormOptionValueDynamic);
			next($this->FormOptionValueTableName);
			next($this->FormOptionValueField);
			next($this->FormOptionValuePageID);
			next($this->FormOptionValueObjectID);
			next($this->FormOptionValueRevisionID);
			
			next($this->FormOptionClass);
			next($this->FormOptionDir);
			next($this->FormOptionID);
			next($this->FormOptionLang);
			next($this->FormOptionStyle);
			next($this->FormOptionTitle);
			next($this->FormOptionXMLLang);
			
			next($this->FormOptionEnableDisable);
			next($this->FormOptionStatus);
		}
	}
	
	protected function buildFormOptGroup($objectid) {
		reset($this->FormLookupTableName['FormOptGroup']);
		
		reset($this->FormOptGroupPageID);
		reset($this->FormOptGroupObjectID);
		reset($this->FormOptGroupContainerObjectType);
		reset($this->FormOptGroupContainerObjectTypeName);
		reset($this->FormOptGroupContainerObjectID);
		
		reset($this->FormOptGroupLabel);
		reset($this->FormOptGroupLabelDynamic);
		reset($this->FormOptGroupLabelTableName);
		reset($this->FormOptGroupLabelField);
		reset($this->FormOptGroupLabelPageID);
		reset($this->FormOptGroupLabelObjectID);
		reset($this->FormOptGroupLabelRevisionID);
		
		reset($this->FormOptGroupDisabled);
		
		reset($this->FormOptGroupClass);
		reset($this->FormOptGroupDir);
		reset($this->FormOptGroupID);
		reset($this->FormOptGroupLang);
		reset($this->FormOptGroupStyle);
		reset($this->FormOptGroupTabIndex);
		reset($this->FormOptGroupTitle);
		reset($this->FormOptGroupXMLLang);
		
		reset($this->FormOptGroupEnableDisable);
		reset($this->FormOptGroupStatus);
				
		$flag = NULL;
		while (current($this->FormLookupTableName['FormOptGroup'])) {
			if (current($this->FormOptGroupEnableDisable) == 'Enable' && current($this->FormOptGroupStatus) == 'Approved') {
				if (current($this->FormOptGroupObjectID) == $objectid && current($this->FormOptGroupPageID) == $this->PageID) {
					$this->Writer->startElement('optgroup');
					$flag = TRUE;
				}
				
				if (current($this->FormOptGroupPageID) == $this->PageID) {
						$this->ProcessArrayStandardAttribute('FormOptGroup');
						
						if (current($this->FormOptGroupDisabled)) {
							$this->Writer->writeAttribute('disabled', current($this->FormOptGroupDisabled));
						}
						
						if (current($this->FormOptGroupLabel)) {
							$this->Writer->writeAttribute('label', current($this->FormOptGroupLabel));
						} else if (current($this->FormOptGroupLabelDynamic)) {
							$tablename = current($this->FormOptGroupLabelTableName);
							$field = current($this->FormOptGroupLabelField);
							$pageid = current($this->FormOptGroupLabelPageID);
							$objectid = current($this->FormOptGroupLabelObjectID);
							$revisionid = current($this->FormOptGroupLabelRevisionID);
							$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
							if ($hold) {
								$this->Writer->writeAttribute('label', $hold);
							}
						} else {
							$this->Writer->writeRaw("\n  ");
						}
					
					if (current($this->FormOptGroupContainerObjectTypeName) == 'FormOption' && current($this->FormOptGroupContainerObjectType) == 'Option') {
						$this->buildFormOption(current($this->FormOptGroupContainerObjectID));
					}
				}
			}
			next($this->FormLookupTableName['FormOptGroup']);
			
			next($this->FormOptGroupPageID);
			next($this->FormOptGroupObjectID);
			next($this->FormOptGroupContainerObjectType);
			next($this->FormOptGroupContainerObjectTypeName);
			next($this->FormOptGroupContainerObjectID);
			
			next($this->FormOptGroupLabel);
			next($this->FormOptGroupLabelDynamic);
			next($this->FormOptGroupLabelTableName);
			next($this->FormOptGroupLabelField);
			next($this->FormOptGroupLabelPageID);
			next($this->FormOptGroupLabelObjectID);
			next($this->FormOptGroupLabelRevisionID);
			
			next($this->FormOptGroupDisabled);
			
			next($this->FormOptGroupClass);
			next($this->FormOptGroupDir);
			next($this->FormOptGroupID);
			next($this->FormOptGroupLang);
			next($this->FormOptGroupStyle);
			next($this->FormOptGroupTabIndex);
			next($this->FormOptGroupTitle);
			next($this->FormOptGroupXMLLang);
			
			next($this->FormOptGroupEnableDisable);
			next($this->FormOptGroupStatus);
		}
		
		if ($flag) {
			$this->Writer->endElement(); // ENDS OPTGROUP
		}
	}
	
	protected function buildObjects($pageid, $objectid, $objecttypename, $objecttype) {
		$hostname = $this->Hostname;
		$user = $this->User;
		$password = $this->Password;
		$databasename = $this->DatabaseName;
				
		$passarray = array();
		$passarray['ObjectType'] = $objecttype;
		$passarray['ObjectTypeName'] = $objecttypename;

		$this->XhtmlFormProtectionLayer->Connect('ContentLayerTables');
		$this->XhtmlFormProtectionLayer->pass ('ContentLayerTables', 'setDatabaseRow', array('idnumber' => $passarray));
		$this->XhtmlFormProtectionLayer->Disconnect('ContentLayerTables');
		
		$hold = $this->XhtmlFormProtectionLayer->pass ('ContentLayerTables', 'getMultiRowField', array());
		
		$idnumber = Array();
		$idnumber['PageID'] = $pageid;
		$idnumber['ObjectID'] = $objectid;
		
		$objectdatabase = Array();
		
		$i = 1;
		$name = 'DatabaseTable';
		$name .= $i;
		while ($hold[0][$name]) {
			$objectdatabase[$hold[0][$name]] = $hold[0][$name];
			$i++;
			$name = 'DatabaseTable';
			$name .= $i;
		}
			
		$objectdatabase['NoAttributes'] = TRUE;
		$databases = &$this->XhtmlFormProtectionLayer;
		
		$object = new $objecttype($objectdatabase, $databases);
		$object->setDatabaseAll ($hostname, $user, $password, $databasename, $hold[0]['DatabaseTable1']);
		$object->setHttpUserAgent($this->HttpUserAgent);
		$object->FetchDatabase ($idnumber);
		$object->CreateOutput('    ');
		
		$objectoutput = $object->getOutput();
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
							
							if (current($this->FormTableListingContainerObjectType) == 'Select') {
								$this->buildFormSelect(current($this->FormTableListingContainerObjectID));
							}
							
							if (current($this->FormTableListingContainerObjectType) == 'Button') {
								$this->buildFormButton(current($this->FormTableListingContainerObjectID));
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