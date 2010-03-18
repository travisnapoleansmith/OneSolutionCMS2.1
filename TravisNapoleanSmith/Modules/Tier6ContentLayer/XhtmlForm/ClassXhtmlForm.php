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
	
	// Xhtml Form InputStandard Attributes
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
				} else if (current($this->TableNames) == 'FormFieldSet') {
				
				} else if (current($this->TableNames) == 'FormInput') {
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
					
				} else if (current($this->TableNames) == 'FormLabel') {
				
				} else if (current($this->TableNames) == 'FormLegend') {
				
				} else if (current($this->TableNames) == 'FormTableListing') {
					array_push($this->FormTableListingPageID, $this->FormLookupTableName[current($this->TableNames)][$i]['PageID']);
					array_push($this->FormTableListingObjectID, $this->FormLookupTableName[current($this->TableNames)][$i]['ObjectID']);
					array_push($this->FormTableListingContainerObjectType, $this->FormLookupTableName[current($this->TableNames)][$i]['ContainerObjectType']);
					array_push($this->FormTableListingContainerObjectTypeName, $this->FormLookupTableName[current($this->TableNames)][$i]['ContainerObjectTypeName']);
					array_push($this->FormTableListingContainerObjectID, $this->FormLookupTableName[current($this->TableNames)][$i]['ContainerObjectID']);
					array_push($this->FormTableListingEnableDisable, $this->FormLookupTableName[current($this->TableNames)][$i]['Enable/Disable']);
					array_push($this->FormTableListingStatus, $this->FormLookupTableName[current($this->TableNames)][$i]['Status']);
					
				} else if (current($this->TableNames) == 'FormTextArea') {
				
				}
				/*
				$this->XhtmlFormProtectionLayer->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
				$j = $i-1;
				$this->XhtmlFormProtectionLayer->Connect($this->FormNames[$j]);
				$this->XhtmlFormProtectionLayer->pass ($this->FormNames[$j], 'setDatabaseField', array('idnumber' => $passarray));
				$this->XhtmlFormProtectionLayer->pass ($this->FormNames[$j], 'setDatabaseRow', array('idnumber' => $passarray));
				$this->XhtmlFormProtectionLayer->Disconnect($this->FormNames[$j]);
				$this->processCalendars ($this->FormNames[$j]);*/
				$i++;
			}
			
			next($this->TableNames);
		}
		print_r($this->FormLookupTableName);
		$i = 0;
		$pageid = NULL;
		
		$passarray = $pageid;
		/*
		while ($this->CalendarAppointmentNames[$i]) {
			$this->XhtmlFormProtectionLayer->Connect($this->CalendarAppointmentNames[$i]);
			if (!$pageid['Day']) {
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'Day`, `StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			} else {
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbyname', array('orderbyname' => 'StartTimeAmPm`, `StartTime'));
				$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setOrderbytype', array('orderbytype' => 'ASC'));
			}
			$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseField', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'setDatabaseRow', array('idnumber' => $passarray));
			$this->XhtmlFormProtectionLayer->Disconnect($this->CalendarAppointmentNames[$i]);
			$this->CalendarAppointments[$this->CalendarAppointmentNames[$i]] = $this->XhtmlFormProtectionLayer->pass ($this->CalendarAppointmentNames[$i], 'getMultiRowField', array());
			$this->processAppointments($this->CalendarAppointmentNames[$i], $i);

			$i++;
			if (current($this->CalendarDay[$i] == 'Current') {
				$pageid['Day'] = $this->CurrentDay;
			} else if (current($this->CalendarDay[$i]) {
				$pageid['Day'] = $this->CalendarDay[$i];
			}
			
			if (current($this->CalendarMonth[$i] == 'Current') {
				$pageid['Month'] = $this->CurrentMonth;
			} else if (current($this->CalendarMonth[$i]) {
				$pageid['Month'] = $this->CalendarMonth[$i];
			}
			
			if (current($this->CalendarYear[$i] == 'Current') {
				$pageid['Year'] = $this->CurrentYear;
			} else if (current($this->CalendarYear[$i]) {
				$pageid['Year'] = $this->CalendarYear[$i];
			}
			
			$passarray = $pageid;
		}*/
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
					reset($this->FormTableListingEnableDisable);
					reset($this->FormTableListingStatus);
					while (current($this->FormLookupTableName['FormTableListing'])) {
						if (current($this->FormTableListingEnableDisable) == 'Enable' && current($this->FormTableListingStatus) == 'Approved') {
							if (current($this->FormTableListingContainerObjectType) == 'Input') {
								$this->buildFormInput(current($this->FormTableListingContainerObjectID));
							}
						}
						next($this->FormLookupTableName['FormTableListing']);
						next($this->FormTableListingPageID);
						next($this->FormTableListingObjectID);
						next($this->FormTableListingContainerObjectType);
						next($this->FormTableListingContainerObjectTypeName);
						next($this->FormTableListingContainerObjectID);
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
		//while ($this->FormNames[$i] && $this->FormEnableDisable[$i] == 'Enable' && $this->FormStatus[$i] == 'Approved') {
			/*$this->Writer->startElement('table');
				$this->TableElement($i);
				$this->Writer->startElement('tr');
					$this->TableRow($i);
					$this->Writer->startElement('td');
						if (current($this->CalendarDay[$i]) {
							$this->Writer->writeAttribute('colspan', '4');
							$this->Writer->writeAttribute('align', 'center');
						} else {
							$this->Writer->writeAttribute('colspan', '7');
							$this->Writer->writeAttribute('align', 'center');
						}
						$text = NULL;
						if (current($this->CalendarMonth[$i]) {
							if (current($this->CalendarMonth[$i] == 'Current') {
								$text .= $this->CurrentMonth;
							} else {
								$text .= $this->CalendarMonth[$i];
							}
							$text .= ' ';
						}
						if (current($this->CalendarDay[$i]) {
							if (current($this->CalendarDay[$i] == 'Current') {
								$text .= $this->CurrentDay;
							} else {
								$text .= $this->CalendarDay[$i];
							}
							if (current($this->CalendarYear[$i]) {
								$text .= ', ';
							}
						}
						if (current($this->CalendarYear[$i]) {
							if (current($this->CalendarYear[$i] == 'Current') {
								$text .= $this->CurrentYear;
							} else {
								$text .= $this->CalendarYear[$i];
							}
						}
						
						$this->Writer->text($text);
					$this->Writer->endElement(); // ENDS TD TAG
				$this->Writer->endElement(); // ENDS TR TAG
				
				$week = array();
				$week['Sunday'] = NULL;
				$week['Monday'] = NULL;
				$week['Tuesday'] = NULL;
				$week['Wednesday'] = NULL;
				$week['Thursday'] = NULL;
				$week['Friday'] = NULL;
				$week['Saturday'] = NULL;
				if (current($this->CalendarDay[$i]) {
					$this->TableWeekHeading($this->AppointmentColumns, $i);
					$this->MakeDayAppointments($i);
				} else {
					$this->TableWeekHeading($this->DaysOfTheWeek, $i);
				}
				
				if (($this->CalendarMonth[$i] == 'Current' && $this->CalendarYear[$i] == 'Current') && is_null($this->CalendarDay[$i])) {
					if (current($this->CurrentDay >= 21) {
						$day = $this->CurrentDay - 21;	
					} else if (current($this->CurrentDay >= 14){
						$day = $this->CurrentDay - 14;
					} else if (current($this->CurrentDay >= 7) {
						//$day = 0;
						$day .= $this->CurrentDay - 7;
					} else {
						$day = $this->CurrentDay;
					}
					
					$j = 0;
					while ($j < 6) {
						$newweek = $this->DayWeek($week, $day, $this->CurrentDayOfWeek, date('t'));
						$newweek = $this->DayWeekAppointment($newweek, $day, $this->CurrentDayOfWeek, date('t'), $i);
						if ($newweek) {
							$this->TableWeek($newweek, $i);
							$day = $day + 7;
							$j++;
						} else {
							$j = 10;
						}
					}
				} else {
					$monthnumber = $this->getCalendarMonthNumber ($this->CalendarMonth[$i]);
					$firstday = $this->FirstDayOfMonth ($monthnumber, $this->CalendarYear[$i]);
					$lastday = $this->LastDayOfMonth ($monthnumber + 1, $this->CalendarYear[$i]);
					$day = 1;
					if (!$this->CalendarDay[$i]) {
						$j = 0;
						while ($j < 6) {
							$newweek = $this->DayWeek($week, $day, $firstday, $lastday);
							$newweek = $this->DayWeekAppointment($newweek, $day, $firstday, $lastday, $i);
							if ($newweek) {
								$this->TableWeek($newweek, $i);
								$day = $day + 7;
								$j++;
							} else {
								$j = 10;
							}
						}
					}
				}
				$this->Writer->endElement();  // ENDS TR TAG
			$this->Writer->endElement(); // ENDS TABLE TAG
			
			if (!$this->CalendarDay[$i]) {
				$this->MakeDayWeekAppointments($i);
			}
			
			$i++;
		}
		
		if (current($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->Form = $this->Writer->flush();
		}*/
		
	}
	
	public function getOutput() {
		return $this->Form;
	}
}
?>