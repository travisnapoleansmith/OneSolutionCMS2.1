<?php

class XhtmlForm extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $TableNames = array();
	protected $FormLookupTableName = array();
		
	protected $FormSession;
	
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
	protected $FormFieldSetStopObjectID = array();
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
	
	// Xhtml Form Button Event Attributes
	protected $FormButtonJavascriptOnBlur = array();
	protected $FormButtonJavascriptOnClick = array();
	protected $FormButtonJavascriptOnDblClick = array();
	protected $FormButtonJavascriptOnFocus = array();
	protected $FormButtonJavascriptOnMouseDown = array();
	protected $FormButtonJavascriptOnMouseMove = array();
	protected $FormButtonJavascriptOnMouseOut = array();
	protected $FormButtonJavascriptOnMouseOver = array();
	protected $FormButtonJavascriptOnMouseUp = array();
	protected $FormButtonJavascriptOnKeyDown = array();
	protected $FormButtonJavascriptOnKeyPress = array();
	protected $FormButtonJavascriptOnKeyUp = array();
	
	protected $FormButtonEnableDisable = array();
	protected $FormButtonStatus = array();
	
	protected $Form;
	
	/**
	 * Create an instance of XtmlForm
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlForm'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlForm'][$hold];
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
		
		if ($DatabaseOptions['PrintPreview']) {
			$this->PrintPreview = $DatabaseOptions['PrintPreview'];
			unset($DatabaseOptions['PrintPreview']);
		}
		
		if ($DatabaseOptions['XhtmlFormSession']) {
			$this->FormSession = $DatabaseOptions['XhtmlFormSession'];
		}
		
		/*while (current($TableNames)) {
			$this->TableNames[current($TableNames)] = current($TableNames);
			next($TableNames);
		}*/
		$this->TableNames['Form'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormButton'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormFieldSet'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormInput'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormLabel'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormLegend'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormOptGroup'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormOption'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormSelect'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormTableListing'] = current($TableNames);
		next($TableNames);
		
		$this->TableNames['FormTextArea'] = current($TableNames);
		next($TableNames);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function FetchDatabase ($PageID) {
		$this->PrintPreview = $PageID['PrintPreview'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		
		unset($PageID['RevisionID']);
		unset($PageID['CurrentVersion']);
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		unset ($passarray['ObjectID']);
		reset($this->TableNames);
		
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		while (current($this->TableNames)) {
			$this->LayerModule->Connect(current($this->TableNames));
			$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect(current($this->TableNames));
			$this->FormLookupTableName[key($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getMultiRowField', array());
			
			next($this->TableNames);
		}
		
		//$this->sortFormOption('ASC');
		//print($this->FormLookupTableName);
		reset($this->TableNames);
		//print_r($this->TableNames);
		while (current($this->TableNames)) {
			$i = 0;
			//print "HERE\n";
			reset($this->FormLookupTableName);
			while ($this->FormLookupTableName[key($this->TableNames)][$i]) {
				if (key($this->TableNames) == 'Form') {
					$this->processForm($i);
				
				} else if (key($this->TableNames) == 'FormButton') {
					$this->processFormButton($i);
					
				} else if (key($this->TableNames) == 'FormFieldSet') {
					$this->processFormFieldSet($i);
					
				} else if (key($this->TableNames) == 'FormInput') {
					$this->processFormInput($i);
				
				} else if (key($this->TableNames) == 'FormLabel') {
					$this->processFormLabel($i);
					
				} else if (key($this->TableNames) == 'FormLegend') {
					$this->processFormLegend($i);
					
				} else if (key($this->TableNames) == 'FormOption') {
					$this->processFormOption($i);
					
				} else if (key($this->TableNames) == 'FormOptGroup') {
					$this->processFormOptGroup($i);
					
				} else if (key($this->TableNames) == 'FormSelect') {
					$this->processFormSelect($i);
					
				} else if (key($this->TableNames) == 'FormButton') {
					$this->processFormButton($i); 
					
				} else if (key($this->TableNames) == 'FormTableListing') {
					$this->processFormTableListing($i);
				
				} else if (key($this->TableNames) == 'FormTextArea') {
					$this->processFormTextArea($i);
				
				}
				$i++;
			}
			next($this->TableNames);
		}
		//$this->sortFormOption('ASC');
		//print_r($this->FormOptionText);
		$i = 0;
		$pageid = NULL;
		
		$passarray = $pageid;
	}
	
	protected function sortFormOption($ASCDSC) {
		/*foreach ($this->FormLookupTableName['FormOption'] as $Key => $Value) {
			$SortArray[$Key] = $Value['FormOptionText'];
		}*/
		
		if ($ASCDSC == 'DSC') {
			//$this->FormOptionText
			//array_multisort($this->FormOptionText, SORT_DESC, $this->FormLookupTableName['FormOption']);
			//array_multisort($SortArray, SORT_DESC, $this->FormLookupTableName['FormOption']);
		} else if ($ASCDSC == 'ASC') {
			//array_multisort($this->FormOptionText, SORT_ASC, $this->FormLookupTableName['FormOption']);
			//array_multisort($SortArray, SORT_ASC, $this->FormLookupTableName['FormOption']);
		}
		//unset($SortArray);
		
	}
	
	protected function processForm($i) {
		array_push($this->FormAction, $this->FormLookupTableName['Form'][$i]['FormAction']);
		
		array_push($this->FormAccept, $this->FormLookupTableName['Form'][$i]['FormAccept']);
		array_push($this->FormAcceptCharset, $this->FormLookupTableName['Form'][$i]['FormAcceptCharset']);
		array_push($this->FormEnctype, $this->FormLookupTableName['Form'][$i]['FormEnctype']);
		array_push($this->FormMethod, $this->FormLookupTableName['Form'][$i]['FormMethod']);
		array_push($this->FormName, $this->FormLookupTableName['Form'][$i]['FormName']);
		
		array_push($this->FormClass, $this->FormLookupTableName['Form'][$i]['FormClass']);
		array_push($this->FormDir, $this->FormLookupTableName['Form'][$i]['FormDir']);
		array_push($this->FormID, $this->FormLookupTableName['Form'][$i]['FormID']);
		array_push($this->FormLang, $this->FormLookupTableName['Form'][$i]['FormLang']);
		array_push($this->FormStyle, $this->FormLookupTableName['Form'][$i]['FormStyle']);
		array_push($this->FormTitle, $this->FormLookupTableName['Form'][$i]['FormTitle']);
		array_push($this->FormXMLLang, $this->FormLookupTableName['Form'][$i]['FormXMLLang']);
		
		array_push($this->FormEnableDisable, $this->FormLookupTableName['Form'][$i]['Enable/Disable']);
		array_push($this->FormStatus, $this->FormLookupTableName['Form'][$i]['Status']);
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
		
		array_push($this->FormButtonJavascriptOnBlur, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnBlur']);
		array_push($this->FormButtonJavascriptOnClick, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnClick']);
		array_push($this->FormButtonJavascriptOnDblClick, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnDblClick']);
		array_push($this->FormButtonJavascriptOnFocus, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnFocus']);
		array_push($this->FormButtonJavascriptOnMouseDown, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnMouseDown']);
		array_push($this->FormButtonJavascriptOnMouseMove, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnMouseMove']);
		array_push($this->FormButtonJavascriptOnMouseOut, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnMouseOut']);
		array_push($this->FormButtonJavascriptOnMouseOver, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnMouseOver']);
		array_push($this->FormButtonJavascriptOnMouseUp, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnMouseUp']);
		array_push($this->FormButtonJavascriptOnKeyDown, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnKeyDown']);
		array_push($this->FormButtonJavascriptOnKeyPress, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnKeyPress']);
		array_push($this->FormButtonJavascriptOnKeyUp, $this->FormLookupTableName['FormButton'][$i]['FormButtonJavascriptOnKeyUp']);
		
		array_push($this->FormButtonEnableDisable, $this->FormLookupTableName['FormButton'][$i]['Enable/Disable']);
		array_push($this->FormButtonStatus, $this->FormLookupTableName['FormButton'][$i]['Status']);
	}
	
	protected function processFormFieldSet($i) {
		array_push($this->FormFieldSetPageID, $this->FormLookupTableName['FormFieldSet'][$i]['PageID']);
		array_push($this->FormFieldSetObjectID, $this->FormLookupTableName['FormFieldSet'][$i]['ObjectID']);
		array_push($this->FormFieldSetStopObjectID, $this->FormLookupTableName['FormFieldSet'][$i]['StopObjectID']);
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
		array_push($this->FormTableListingPageID, $this->FormLookupTableName[key($this->TableNames)][$i]['PageID']);
		array_push($this->FormTableListingObjectID, $this->FormLookupTableName[key($this->TableNames)][$i]['ObjectID']);
		array_push($this->FormTableListingContainerObjectType, $this->FormLookupTableName[key($this->TableNames)][$i]['ContainerObjectType']);
		array_push($this->FormTableListingContainerObjectTypeName, $this->FormLookupTableName[key($this->TableNames)][$i]['ContainerObjectTypeName']);
		array_push($this->FormTableListingContainerObjectID, $this->FormLookupTableName[key($this->TableNames)][$i]['ContainerObjectID']);
		array_push($this->FormTableListingContentStartTag, $this->FormLookupTableName[key($this->TableNames)][$i]['ContentStartTag']);
		array_push($this->FormTableListingContentEndTag, $this->FormLookupTableName[key($this->TableNames)][$i]['ContentEndTag']);
		array_push($this->FormTableListingContent, $this->FormLookupTableName[key($this->TableNames)][$i]['Content']);
		array_push($this->FormTableListingEnableDisable, $this->FormLookupTableName[key($this->TableNames)][$i]['Enable/Disable']);
		array_push($this->FormTableListingStatus, $this->FormLookupTableName[key($this->TableNames)][$i]['Status']);
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
			$this->LayerModule->Connect($tablename);
			$this->LayerModule->pass ($tablename, 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect($tablename);
			$temp = $this->LayerModule->pass ($tablename, 'getRowField', array('rowfield' => $field));
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
						if ($this->FormSession[current($this->FormInputName)]) {
							$this->FormInputValue[key($this->FormInputValue)] = $this->FormSession[current($this->FormInputName)];
						}
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
					
					if ($this->FormSession[current($this->FormTextAreaName)]) {
						$this->FormTextAreaText[key($this->FormTextAreaText)] = $this->FormSession[current($this->FormTextAreaName)];
					}
					
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
					
					$this->Writer->fullEndElement(); // ENDS TEXTAREA
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
		$oldkey = key($this->FormFieldSetObjectID);
		$FormLookupTableName = $this->FormLookupTableName;
		$FormFieldSetPageID = $this->FormFieldSetPageID;
		$FormFieldSetObjectID = $this->FormFieldSetObjectID;
		$FormFieldSetStopObjectID = $this->FormFieldSetStopObjectID;
		$FormFieldSetContainerObjectType = $this->FormFieldSetContainerObjectType;
		$FormFieldSetContainerObjectTypeName = $this->FormFieldSetContainerObjectTypeName;
		$FormFieldSetContainerObjectID = $this->FormFieldSetContainerObjectID;
		
		$FormFieldSetTextStartTag = $this->FormFieldSetTextStartTag;
		$FormFieldSetTextEndTag = $this->FormFieldSetTextEndTag;
		$FormFieldSetText = $this->FormFieldSetText;
		$FormFieldSetTextDynamic = $this->FormFieldSetTextDynamic;
		$FormFieldSetTextTableName = $this->FormFieldSetTextTableName;
		$FormFieldSetTextField = $this->FormFieldSetTextField;
		$FormFieldSetTextPageID = $this->FormFieldSetTextPageID;
		$FormFieldSetTextObjectID = $this->FormFieldSetTextObjectID;
		$FormFieldSetTextRevisionID = $this->FormFieldSetTextRevisionID;
		
		$FormFieldSetClass = $this->FormFieldSetClass;
		$FormFieldSetDir = $this->FormFieldSetDir;
		$FormFieldSetID = $this->FormFieldSetID;
		$FormFieldSetLang = $this->FormFieldSetLang;
		$FormFieldSetStyle = $this->FormFieldSetStyle;
		$FormFieldSetTitle = $this->FormFieldSetTitle;
		$FormFieldSetXMLLang = $this->FormFieldSetXMLLang;
		
		$FormFieldSetEnableDisable = $this->FormFieldSetEnableDisable;
		$FormFieldSetStatus = $this->FormFieldSetStatus;
		
		reset($FormLookupTableName);
		
		reset($FormFieldSetPageID);
		reset($FormFieldSetObjectID);
		reset($FormFieldSetStopObjectID);
		reset($FormFieldSetContainerObjectType);
		reset($FormFieldSetContainerObjectTypeName);
		reset($FormFieldSetContainerObjectID);
		
		reset($FormFieldSetTextStartTag);
		reset($FormFieldSetTextEndTag);
		reset($FormFieldSetText);
		reset($FormFieldSetTextDynamic);
		reset($FormFieldSetTextTableName);
		reset($FormFieldSetTextField);
		reset($FormFieldSetTextPageID);
		reset($FormFieldSetTextObjectID);
		reset($FormFieldSetTextRevisionID);
		
		reset($FormFieldSetClass);
		reset($FormFieldSetDir);
		reset($FormFieldSetID);
		reset($FormFieldSetLang);
		reset($FormFieldSetStyle);
		reset($FormFieldSetTitle);
		reset($FormFieldSetXMLLang);
		
		reset($FormFieldSetEnableDisable);
		reset($FormFieldSetStatus);
		
		
		$flag = NULL;
		
		while (current($FormFieldSetObjectID) != $objectid) {
			next($FormLookupTableName['FormFieldSet']);
		
			next($FormFieldSetPageID);
			next($FormFieldSetObjectID);
			next($FormFieldSetStopObjectID);
			next($FormFieldSetContainerObjectType);
			next($FormFieldSetContainerObjectTypeName);
			next($FormFieldSetContainerObjectID);
			
			next($FormFieldSetTextStartTag);
			next($FormFieldSetTextEndTag);
			next($FormFieldSetText);
			next($FormFieldSetTextDynamic);
			next($FormFieldSetTextTableName);
			next($FormFieldSetTextField);
			next($FormFieldSetTextPageID);
			next($FormFieldSetTextObjectID);
			next($FormFieldSetTextRevisionID);
			
			next($FormFieldSetClass);
			next($FormFieldSetDir);
			next($FormFieldSetID);
			next($FormFieldSetLang);
			next($FormFieldSetStyle);
			next($FormFieldSetTitle);
			next($FormFieldSetXMLLang);
			
			next($FormFieldSetEnableDisable);
			next($FormFieldSetStatus);
		}
		
		while (current($FormFieldSetObjectID)) {
			if (current($FormFieldSetEnableDisable) == 'Enable' && current($FormFieldSetStatus) == 'Approved') {
				if (current($FormFieldSetObjectID) == $objectid && current($FormFieldSetPageID) == $this->PageID) {
					$this->Writer->startElement('fieldset');
					$flag = TRUE;
				}
				
				if (current($FormFieldSetTextStartTag) != NULL) {
					$Tag = current($FormFieldSetTextStartTag);
					$Tag = str_replace('<', '', $Tag);
					$Tag = str_replace('>', '', $Tag);
					$this->Writer->startElement($Tag);
					if (current($FormFieldSetClass) != NULL) {
						$this->Writer->writeAttribute('class', current($FormFieldSetClass));
					}
					
					if (current($FormFieldSetDir) != NULL){
						$this->Writer->writeAttribute('dir', current($FormFieldSetDir));
					}
					
					if (current($FormFieldSetID) != NULL){
						$this->Writer->writeAttribute('id', current($FormFieldSetID));
					}
					
					if (current($FormFieldSetLang) != NULL) {
						$this->Writer->writeAttribute('lang', current($FormFieldSetLang));
					}
					
					if (current($FormFieldSetStyle) != NULL) {
						$this->Writer->writeAttribute('style', current($FormFieldSetStyle));
					}
					
					if (current($FormFieldSetTitle) != NULL) {
						$this->Writer->writeAttribute('title', current($FormFieldSetTitle));
					}
					
					if (current($FormFieldSetXMLLang) != NULL) {
						$this->Writer->writeAttribute('xmllang', current($FormFieldSetXMLLang));
					}
				}
				
				if (current($FormFieldSetPageID) == $this->PageID) {
						$key = key($FormFieldSetObjectID);
						$this->resetFormFieldSet($key);
						if (current($FormFieldSetTextStartTag) == NULL) {
							$this->ProcessArrayStandardAttribute('FormFieldSet');
						}
						if (current($FormFieldSetText)) {
							$this->createTextArea('FormFieldSet', 'Text');
						} else if (current($FormFieldSetTextDynamic)) {
							$tablename = current($FormFieldSetTextTableName);
							$field = current($FormFieldSetTextField);
							$pageid = current($FormFieldSetTextPageID);
							$objectid = current($FormFieldSetTextObjectID);
							$revisionid = current($FormFieldSetTextRevisionID);
							$hold = $this->getDynamicElement ($tablename, $field, $pageid, $objectid, $revisionid);
							if ($hold) {
								$this->Writer->writeRaw("\n");
								$this->FormFieldSetText[key($this->FormFieldSetText)] = $hold;
								$this->createTextArea('FormFieldSet', 'Text');
							}
						} else {
							$this->Writer->writeRaw("\n  ");
						}
					
					if (current($FormFieldSetContainerObjectType) == 'Input') {
						$this->buildFormInput(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'TextArea') {
						$this->buildFormTextArea(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'Label') {
						$this->buildFormLabel(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'Legend') {
						$this->buildFormLegend(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'Select') {
						$this->buildFormSelect(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'Button') {
						$this->buildFormButton(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'FieldSet') {
						$this->buildFormFieldSet(current($FormFieldSetContainerObjectID));
					}
					
					if (current($FormFieldSetContainerObjectType) == 'Captcha') {
						$this->buildFormCaptcha();
					}
				}
				
			}
			
			if (current($FormFieldSetTextEndTag) != NULL) {
				$this->Writer->fullEndElement(); // ENDS START TAG
			}
			if (current($FormFieldSetStopObjectID)) {
				if (current($FormFieldSetObjectID) == current($FormFieldSetStopObjectID)) {
					end($FormFieldSetObjectID);
				}
			}
			
			next($FormLookupTableName['FormFieldSet']);
		
			next($FormFieldSetPageID);
			next($FormFieldSetObjectID);
			next($FormFieldSetStopObjectID);
			next($FormFieldSetContainerObjectType);
			next($FormFieldSetContainerObjectTypeName);
			next($FormFieldSetContainerObjectID);
			
			next($FormFieldSetTextStartTag);
			next($FormFieldSetTextEndTag);
			next($FormFieldSetText);
			next($FormFieldSetTextDynamic);
			next($FormFieldSetTextTableName);
			next($FormFieldSetTextField);
			next($FormFieldSetTextPageID);
			next($FormFieldSetTextObjectID);
			next($FormFieldSetTextRevisionID);
			
			next($FormFieldSetClass);
			next($FormFieldSetDir);
			next($FormFieldSetID);
			next($FormFieldSetLang);
			next($FormFieldSetStyle);
			next($FormFieldSetTitle);
			next($FormFieldSetXMLLang);
			
			next($FormFieldSetEnableDisable);
			next($FormFieldSetStatus);
		}
		if ($flag) {
			$this->Writer->endElement(); // ENDS FIELD SET
		}
		
		$this->resetFormFieldSet($oldkey);
	}
	
	protected function resetFormFieldSet($objectid) {
		$args = func_get_args();
		if ($args[1]) {
			/*next($this->FormLookupTableName['FormFieldSet']);
			
			next($this->FormFieldSetPageID);
			next($this->FormFieldSetObjectID);
			next($this->FormFieldSetStopObjectID);
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
			*/
		} else {
			reset($this->FormLookupTableName['FormFieldSet']);
			
			reset($this->FormFieldSetPageID);
			reset($this->FormFieldSetObjectID);
			reset($this->FormFieldSetStopObjectID);
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
			
			while (key($this->FormFieldSetObjectID) != $objectid) {
				next($this->FormLookupTableName['FormFieldSet']);
			
				next($this->FormFieldSetPageID);
				next($this->FormFieldSetObjectID);
				next($this->FormFieldSetStopObjectID);
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
	
	protected function buildFormSelect($ObjectID) {
		$Lookup = NULL;
		$Data = array();
		$StopObject = NULL;
		
		foreach ($this->FormLookupTableName['FormSelect'] as $Key => $Info) {
			if ($Lookup === NULL) {
				if ($Info['ObjectID'] == $ObjectID) {
					$Lookup = $Key;
				}
			}
			
			if ($Lookup !== NULL) {
				$StopObjectID = $Info['StopObjectID'];
				if ($Info['ObjectID'] == $StopObjectID) {
					$StopObject = $Key;
					break;
				}
			}
		}
		
		foreach ($this->FormLookupTableName['FormSelect'] as $Key => $Info) {
			if ($Key >= $Lookup) {
				if ($Key != $StopObject) {
					if ($Lookup !== NULL) {
						$Data[$Key] = $Info;
						
					}
				} else {
					$Data[$Key] = $Info;
					if ($StopObject !== NULL) {
						break;
					}
				}
			}
		}
		
		if (isset($Data)) { 
			$EnableDisable = $this->FormLookupTableName['FormSelect'][$Lookup]['Enable/Disable'];
			$Status = $this->FormLookupTableName['FormSelect'][$Lookup]['Status'];
			
			if ($EnableDisable == 'Enable' && $Status == 'Approved') {
				$this->Writer->startElement('select');
				$this->ProcessArrayStandardAttribute('FormSelect');
				if ($this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectDisabled']) {
					$this->Writer->writeAttribute('disabled', $this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectDisabled']);
				}
				
				if ($this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectMultiple']) {
					$this->Writer->writeAttribute('multiple', $this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectMultiple']);
				}
				
				if ($this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectSize']) {
					$this->Writer->writeAttribute('size', $this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectSize']);
				}
				
				if ($this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectName']) {
					$this->Writer->writeAttribute('name', $this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectName']);
				} else if ($this->FormLookupTableName['FormSelect'][$Lookup]['FormSelectNameDynamic']) {
					$TableName = $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameTableName'];
					$Field = $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameField'];
					$PageID = $this->FormLookupTableName['FormSelect'][$i]['FormSelectNamePageID'];
					$ObjectID = $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameObjectID'];
					$RevisionID = $this->FormLookupTableName['FormSelect'][$i]['FormSelectNameRevisionID'];
					$hold = $this->getDynamicElement ($TableName, $Field, $PageID, $ObjectID, $RevisionID);
					if ($hold) {
						$this->Writer->writeAttribute('name', $hold);
					}
				}
				
				foreach ($Data as $Key => $Info) {
					$SelectEnableDisable = $Info['Enable/Disable'];
					$SelectStatus = $Info['Status'];
					
					if ($SelectEnableDisable == 'Enable' && $SelectStatus == 'Approved') {
						if ($Info['ContainerObjectType'] == 'OptGroup') {
							$this->buildFormOptGroup($Info['ContainerObjectID'], $Info['FormSelectName']);
						} else if ($Info['ContainerObjectType'] == 'Option') {
							$this->buildFormOption($Info['ContainerObjectID'], $Info['FormSelectName']);
						} else if ($Info['ContainerObjectTypeName']) {
							$this->buildObjects($Info['ContainerObjectID'], 1, $Info['ContainerObjectTypeName'], $Info['ContainerObjectType']);
						}
						
					}
				}
				$this->Writer->endElement(); // ENDS SELECT
			}
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
		
		reset($this->FormButtonJavascriptOnBlur);
		reset($this->FormButtonJavascriptOnClick);
		reset($this->FormButtonJavascriptOnDblClick);
		reset($this->FormButtonJavascriptOnFocus);
		reset($this->FormButtonJavascriptOnMouseDown);
		reset($this->FormButtonJavascriptOnMouseMove);
		reset($this->FormButtonJavascriptOnMouseOut);
		reset($this->FormButtonJavascriptOnMouseOver);
		reset($this->FormButtonJavascriptOnMouseUp);
		reset($this->FormButtonJavascriptOnKeyDown);
		reset($this->FormButtonJavascriptOnKeyPress);
		reset($this->FormButtonJavascriptOnKeyUp);
		
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
					
					if (current($this->FormButtonType)) {
						$this->Writer->writeAttribute('type', current($this->FormButtonType));
					}
					
					if (current($this->FormButtonJavascriptOnBlur)) {
						$this->Writer->writeAttribute('onblur', current($this->FormButtonJavascriptOnBlur));
					}
					
					if (current($this->FormButtonJavascriptOnClick)) {
						$this->Writer->writeAttribute('onclick', current($this->FormButtonJavascriptOnClick));
					}
					
					if (current($this->FormButtonJavascriptOnDblClick)) {
						$this->Writer->writeAttribute('ondblclick', current($this->FormButtonJavascriptOnDblClick));
					}
					
					if (current($this->FormButtonJavascriptOnFocus)) {
						$this->Writer->writeAttribute('onfocus', current($this->FormButtonJavascriptOnFocus));
					}
					
					if (current($this->FormButtonJavascriptOnMouseDown)) {
						$this->Writer->writeAttribute('onmousedown', current($this->FormButtonJavascriptOnMouseDown));
					}
					
					if (current($this->FormButtonJavascriptOnMouseMove)) {
						$this->Writer->writeAttribute('onmousemove', current($this->FormButtonJavascriptOnMouseMove));
					}
					
					if (current($this->FormButtonJavascriptOnMouseOut)) {
						$this->Writer->writeAttribute('onmouseout', current($this->FormButtonJavascriptOnMouseOut));
					}
					
					if (current($this->FormButtonJavascriptOnMouseOver)) {
						$this->Writer->writeAttribute('onmouseover', current($this->FormButtonJavascriptOnMouseOver));
					}
					
					if (current($this->FormButtonJavascriptOnMouseUp)) {
						$this->Writer->writeAttribute('onmouseup', current($this->FormButtonJavascriptOnMouseUp));
					}
					
					if (current($this->FormButtonJavascriptOnKeyDown)) {
						$this->Writer->writeAttribute('onkeydown', current($this->FormButtonJavascriptOnKeyDown));
					}
					
					if (current($this->FormButtonJavascriptOnKeyPress)) {
						$this->Writer->writeAttribute('onkeypress', current($this->FormButtonJavascriptOnKeyPress));
					}
					
					if (current($this->FormButtonJavascriptOnKeyUp)) {
						$this->Writer->writeAttribute('onkeyup', current($this->FormButtonJavascriptOnKeyUp));
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
			
			next($this->FormButtonJavascriptOnBlur);
			next($this->FormButtonJavascriptOnClick);
			next($this->FormButtonJavascriptOnDblClick);
			next($this->FormButtonJavascriptOnFocus);
			next($this->FormButtonJavascriptOnMouseDown);
			next($this->FormButtonJavascriptOnMouseMove);
			next($this->FormButtonJavascriptOnMouseOut);
			next($this->FormButtonJavascriptOnMouseOver);
			next($this->FormButtonJavascriptOnMouseUp);
			next($this->FormButtonJavascriptOnKeyDown);
			next($this->FormButtonJavascriptOnKeyPress);
			next($this->FormButtonJavascriptOnKeyUp);
			
			next($this->FormButtonEnableDisable);
			next($this->FormButtonStatus);
		}
	}
	
	protected function buildFormOption($ObjectID, $FormSelectName) {
		$Data = NULL;
		
		foreach ($this->FormLookupTableName['FormOption'] as $Key => $Info) {
			if ($Info['ObjectID'] == $ObjectID) {
				$Data = $Info;
				break;
			}
		}
		
		if (isset($Data)) { 
			$EnableDisable = $Data['Enable/Disable'];
			$Status = $Data['Status'];
			
			if ($EnableDisable == 'Enable' && $Status == 'Approved') {
				$this->Writer->startElement('option');
				$this->ProcessArrayStandardAttribute('FormOption');
				
				if ($Data['FormOptionDisabled']) {
					$this->Writer->writeAttribute('disabled', $Data['FormOptionDisabled']);
				}
				
				if ($Data['FormOptionLabel']) {
					$this->Writer->writeAttribute('label', $Data['FormOptionLabel']);
				} else if ($Data['FormOptionLabelDynamic']) {
					$TableName = $Data['FormOptionLabelTableName'];
					$Field = $Data['FormOptionLabelField'];
					$PageID = $Data['FormOptionLabelPageID'];
					$ObjectID = $Data['FormOptionLabelObjectID'];
					$RevisionID = $Data['FormOptionLabelRevisionID'];
					$hold = $this->getDynamicElement ($TableName, $Field, $PageID, $ObjectID, $RevisionID);
					if ($hold) {
						$this->Writer->writeAttribute('label', $hold);
					}
				}
				if (isset($this->FormSession[$FormSelectName])) {
					$SessionInfo = $this->FormSession[$FormSelectName];
					$CurrentInfo = $Data['FormOptionText'];
					if ($SessionInfo == $CurrentInfo) {
						$Data['FormOptionSelected'] = 'selected';
						$DestroyArray[$Key] = $Data['FormOptionSelected'];
					}
				}
				
				if ($Data['FormOptionSelected']) {
					$this->Writer->writeAttribute('selected', $Data['FormOptionSelected']);
				}
				
				if ($Data['FormOptionValue']) {
					$this->Writer->writeAttribute('value', $Data['FormOptionValue']);
				} else if ($Data['FormOptionValueDynamic']) {
					$TableName = $Data['FormOptionValueTableName'];
					$Field = $Data['FormOptionValueField'];
					$PageID = $Data['FormOptionValuePageID'];
					$ObjectID = $Data['FormOptionValueObjectID'];
					$RevisionID = $Data['FormOptionValueRevisionID'];
					$hold = $this->getDynamicElement ($TableName, $Field, $PageID, $ObjectID, $RevisionID);
					if ($hold) {
						$this->Writer->writeAttribute('value', $hold);
					}
				}
				
				if ($Data['FormOptionText']) {
					$this->Writer->text($Data['FormOptionText']);
				} else if ($Data['FormOptionTextDynamic']) {
					$TableName = $Data['FormOptionTextTableName'];
					$Field = $Data['FormOptionTextField'];
					$PageID = $Data['FormOptionTextPageID'];
					$ObjectID = $Data['FormOptionTextObjectID'];
					$RevisionID = $Data['FormOptionTextRevisionID'];
					$hold = $this->getDynamicElement ($TableName, $Field, $PageID, $ObjectID, $RevisionID);
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
		
	}
	
	protected function buildFormOptGroup($objectid, $formselectname) {
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
						$this->buildFormOption(current($this->FormOptGroupContainerObjectID), $formselectname);
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
	
	protected function buildFormCaptcha() {
		$randomtext1 = md5(time());
		$randomtext2 = sha1($randomtext1);
		$randomtext1 = sha1(time());
		$randomtext1 = substr($randomtext1, 0, 5);
		$randomtext2 = substr($randomtext2, 0, 7);
		
		$randomtext = $randomtext1;
		$randomtext .= ' ';
		$randomtext .= $randomtext2;
		
		$image = imagecreate(70, 50);
		$background = imagecolorallocate($image, 0, 0, 255);
		$textcolor = imagecolorallocate($image, 255, 255, 255);
		$linecolor = imagecolorallocate($image, 200, 50, 35);
		
		imagesetthickness ($image, 1);
		$i = 0;
		$max = 5;
		$x = 0;
		$y = 15;
		while ($i < 5) {
			imageline($image, $x, 0, $y, 60, $linecolor);
			$i++;
			$x+=15;
			$y+=15;
		}
		
		$this->randomizeStringImage ($randomtext1, $image, $textcolor, 3, 5, -3, 5, 7);
		$this->randomizeStringImage ($randomtext2, $image, $textcolor, 2, 3, -3, 25, 27);
		
		$indexkey = md5($randomtext);
		$indexkey = sha1($indexkey);
		
		$imagekey = $indexkey;
		$imagekey = substr($imagekey, 0, 10);
		$imagename = 'captchaimage-';
		$imagename .= $imagekey;
		$imagename .= '.png';
		
		setcookie ('CaptchaImage', $imagename, NULL, '/');
		//setcookie ('CaptchaImage', $imagename);
		imagepng($image, "CAPTCHAIMAGE/$imagename");
		
		$captchakey = $indexkey;
		//setcookie('CaptchaKey', $captchakey, NULL, '/');
		setcookie('CaptchaKey', $captchakey);
		
		$this->Writer->startElement('div');
			$this->Writer->writeRaw("\n");
			$this->Writer->startElement('label');
			$this->ProcessArrayStandardAttribute('FormFieldSet');
			$this->Writer->text('Image Verification - ');
			$this->Writer->endElement(); // ENDS LABEL;
		$this->Writer->endElement(); // ENDS DIV;
		
		$this->Writer->startElement('div');
			$this->Writer->writeRaw("\n");
			$this->Writer->startElement('label');
			$this->ProcessArrayStandardAttribute('FormFieldSet');
			$this->Writer->text('Enter Two Words Below, ');
			$this->Writer->endElement(); // ENDS LABEL;
		$this->Writer->endElement(); // ENDS DIV;
		
		$this->Writer->startElement('div');
			$this->Writer->writeRaw("\n");
			$this->Writer->startElement('label');
			$this->ProcessArrayStandardAttribute('FormFieldSet');
			$this->Writer->text('Put Space After First Word!');
				$this->Writer->startElement('br');
				$this->Writer->endElement(); // ENDS BR;
			$this->Writer->endElement(); // ENDS LABEL;
		$this->Writer->endElement(); // ENDS DIV;
		
		$this->Writer->startElement('div');
			$this->Writer->writeRaw("\n");
			$this->Writer->startElement('label');
			$this->ProcessArrayStandardAttribute('FormFieldSet');
				$this->Writer->startElement('img');
				$this->Writer->writeAttribute('src', "CAPTCHAIMAGE/$imagename");
				$this->Writer->writeAttribute('alt', 'Captcha Verification');
				$this->Writer->endElement(); // ENDS IMG
			$this->Writer->endElement(); // ENDS LABEL;
		$this->Writer->endElement(); // ENDS DIV;
		
		$this->Writer->startElement('div');
			$this->Writer->writeRaw("\n");
			$this->Writer->startElement('input');
			$this->Writer->writeAttribute('type', 'text');
			$this->Writer->writeAttribute('name', 'CAPTCHA');
			$this->ProcessArrayStandardAttribute('FormFieldSet');
			$this->Writer->endElement(); // ENDS LABEL;
		$this->Writer->endElement(); // ENDS DIV;
		
	}
	
	protected function randomizeStringImage ($inputstring, $image, $textcolor, $fontodd, $fonteven, $x, $yodd, $yeven) {
		$inputstring = str_split($inputstring);
		reset ($inputstring);
		while (isset($inputstring[key($inputstring)])) {
			$x += 9;
			$key = key($inputstring);
			if ($key % 2) {
				imagestring($image, $fontodd, $x, $yodd, current($inputstring), $textcolor);
			} else {
				imagestring($image, $fonteven, $x, $yeven, current($inputstring), $textcolor);
			}
			next($inputstring);
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

		$this->LayerModule->Connect('ContentLayerTables');
		$this->LayerModule->pass ('ContentLayerTables', 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect('ContentLayerTables');
		
		$hold = $this->LayerModule->pass ('ContentLayerTables', 'getMultiRowField', array());
		
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
		
		$databaseoptions = array();
		$databaseoptions['NoAttributes'] = TRUE;

		$object = new $objecttype($objectdatabase, $databaseoptions, $this->LayerModule);
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
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	public function createFormSelect(array $Content) {
		if ($Content != NULL) {
			$this->LayerModule->pass ($this->TableNames['FormSelect'], 'BuildFieldNames', array('TableName' => $this->TableNames['FormSelect']));
			$Keys = $this->LayerModule->pass ($this->TableNames['FormSelect'], 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $Content, $this->TableNames['FormSelect']);
		} else {
			array_push($this->ErrorMessage,'createFormSelect: Content cannot be NULL!');
		}
	}
	
	public function updateFormSelect(array $PageID) {
		if ($PageID != NULL) {
			$this->updateRecord($PageID['PageID'], $PageID['Content'], $this->TableNames['FormSelect']);
		} else {
			array_push($this->ErrorMessage,'updateFormSelect: PageID cannot be NULL!');
		}
	}
	
	public function updateFormSelectStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			$PassID['ObjectID'] = $PageID['ObjectID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->TableNames['FormSelect']);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->TableNames['FormSelect']);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->TableNames['FormSelect']);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->TableNames['FormSelect']);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->TableNames['FormSelect']);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->TableNames['FormSelect']);
			}
		} else {
			array_push($this->ErrorMessage,'updateFormSelectStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteFormSelect(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->TableNames['FormSelect']);
		} else {
			array_push($this->ErrorMessage,'deleteFormSelect: PageID cannot be NULL!');
		}
	}
	
	public function createFormOption(array $Content) {
		if ($Content != NULL) {
			$this->LayerModule->pass ($this->TableNames['FormOption'], 'BuildFieldNames', array('TableName' => $this->TableNames['FormOption']));
			$Keys = $this->LayerModule->pass ($this->TableNames['FormOption'], 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $Content, $this->TableNames['FormOption']);
		} else {
			array_push($this->ErrorMessage,'createFormOption: Content cannot be NULL!');
		}
	}
	
	public function updateFormOption(array $PageID) {
		if ($PageID != NULL) {
			$this->updateRecord($PageID['PageID'], $PageID['Content'], $this->TableNames['FormOption']);
		} else {
			array_push($this->ErrorMessage,'updateFormSelect: PageID cannot be NULL!');
		}
	}
	
	public function updateFormOptionStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			$PassID['ObjectID'] = $PageID['ObjectID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->TableNames['FormOption']);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->TableNames['FormOption']);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->TableNames['FormOption']);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->TableNames['FormOption']);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->TableNames['FormOption']);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->TableNames['FormOption']);
			}
		} else {
			array_push($this->ErrorMessage,'updateFormOptionStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteFormOption(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->TableNames['FormOption']);
		} else {
			array_push($this->ErrorMessage,'deleteFormOption: PageID cannot be NULL!');
		}
	}
	
}
?>