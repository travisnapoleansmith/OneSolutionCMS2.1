<?php

/**
 * Class XhtmlTable
 * 
 * Class XhtmlTable is designed to allow a user to interact with Xhtml Tables inside of the Content Layer class.
 *
 * @author Travis Napolean Smith
 * @copyright Copyright (c) 1999 - 2012 One Solution CMS
 * @copyright PHP - Copyright (c) 2005 - 2012 One Solution CMS
 * @copyright C++ - Copyright (c) 1999 - 2005 One Solution CMS
 * @version PHP - 2.1.129
 * @version C++ - Unknown
 */ 

class XhtmlTable extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	/**
	 * Table Names passed to contructor
	 * 
	 * @var array
	 */
	protected $TablesNames = array();
	
	/**
	 * Content from database tables retrieved from TablesNames.
	 * 
	 * @var array
	 */
	protected $TablesLookup = array();
	
	/**
	 * Content from database table retrieved from $TablesLookup[CURRENTROW][0]['XhtmlTableName'];
	 * 
	 * @var array
	 */
	protected $TablesContent = array();
	
	/**
	 * Content from TableCaption Table 
	 * 
	 * @var array
	 */
	protected $TablesCaptionContent = array();
	
	/**
	 * Content from TableCol Table
	 * 
	 * @var array
	 */
	protected $TablesColContent = array();
	
	/**
	 * Content from TableColgroup Table
	 * 
	 * @var array
	 */
	protected $TablesColgroupContent = array();
	
	/**
	 * Content from TableColgroupCol Table
	 * 
	 * @var array
	 */
	protected $TablesColgroupColContent = array();
	
	/**
	 * Content from TableTHead Table
	 * 
	 * @var array
	 */
	protected $TablesTHeadContent = array();
	
	/**
	 * Content from TableTHeadContent Table
	 * 
	 * @var array
	 */
	protected $TablesTHeadContentContent = array();
	
	/**
	 * Content from TableTHeadHeader Table
	 * 
	 * @var array
	 */
	protected $TablesTHeadHeaderContent = array();
	
	/**
	 * Content from TableTFoot Table
	 * 
	 * @var array
	 */
	protected $TablesTFootContent = array();
	
	/**
	 * Content from TableTFootContent Table
	 * 
	 * @var array
	 */
	protected $TablesTFootContentContent = array();
	
	/**
	 * Content from TableTFooter Table
	 * 
	 * @var array
	 */
	protected $TablesTFooterContent = array();

	/**
	 * Content from TableTBody Table
	 * 
	 * @var array
	 */
	protected $TablesTBodyContent = array();
	
	/**
	 * Content from TableTBodyContent Table
	 * 
	 * @var array
	 */
	protected $TablesTBodyContentContent = array();
	
	/**
	 * Content from TableTBodyCell Table
	 * 
	 * @var array
	 */
	protected $TablesTBodyCellContent = array();

	/**
	 * Content from TableRow Table
	 * 
	 * @var array
	 */
	protected $TablesTableRowContent = array();
	
	/**
	 * Content from TableRowHeader Table
	 * 
	 * @var array
	 */
	protected $TablesTableRowHeaderContent = array();
	
	/**
	 * Content from TableRowCell Table
	 * 
	 * @var array
	 */
	protected $TablesTableRowCellContent = array();
	
	/**
	 * Enable/Disable for Table Content
	 * 
	 * @var array
	 */
	protected $EnableDisable = array();
	
	/**
	 * Status for Table Content
	 * 
	 * @var array
	 */
	protected $Status = array();
	
	/**
	 * Create an instance of XtmlTable
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlTable'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlTable'][$hold];
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
		
		while (current($TableNames)) {
			$this->TableNames[key($TableNames)] = current($TableNames);
			next($TableNames);
		}
		
	}
	
	/**
	 * setDatabaseAll
	 * 
	 * Sets the Hostname, User, Password, Databasename and DatabaseTable.
	 * 
	 * @param string $HostName = Database Host Name
	 * @param string $User = Database User
	 * @param string $Password = Database User's Password
	 * @param string $DatabaseName = Database Name
	 * @param string $DatabaseTable = Database Table
	 * @access public
	 *
	 */
	public function setDatabaseAll ($Hostname, $User, $Password, $DatabaseName, $DatabaseTable) {
		$this->Hostname = $Hostname;
		$this->User = $User;
		$this->Password = $Password;
		$this->DatabaseName = $DatabaseName;
		$this->DatabaseTable = $DatabaseTable;
		
		$this->LayerModule->setDatabaseAll ($Hostname, $User, $Password, $DatabaseName);
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->LayerModule->setDatabasetable (current($this->TableNames));
			next($this->TableNames);
		}
	}
	
	/**
	 * FetchDatabase
	 * 
	 * Retrieved the database based on the PageID.
	 * 
	 * @param array $PageID = A Database lookup or key array for the database
	 * @access public
	 * 
	 */
	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		
		foreach ($this->TableNames as $TableName => $TableContent) {
			$this->LayerModule->Connect($TableContent);
			$this->LayerModule->pass ($TableContent, 'setDatabaseRow', array('PageID' => $passarray));
			$this->LayerModule->Disconnect($TableContent);
			$this->TablesLookup[$TableContent] = $this->LayerModule->pass ($TableContent, 'getMultiRowField', array());
			
			$ContentXhtmlTableName = $this->TablesLookup[$TableContent][0]['XhtmlTableName'];
			$ContentTableName = $this->TablesLookup[$TableContent][0]['TableName'];
			$passarray = array('TableName' => $ContentTableName);
			$this->LayerModule->createDatabaseTable($ContentXhtmlTableName);
			$this->LayerModule->Connect($ContentXhtmlTableName);
			$this->LayerModule->pass ($ContentXhtmlTableName, 'setDatabaseRow', array('PageID' => $passarray));
			$this->LayerModule->Disconnect($ContentXhtmlTableName);
			$this->TablesContent[$ContentXhtmlTableName][$ContentTableName] = $this->LayerModule->pass ($ContentXhtmlTableName, 'getMultiRowField', array());
			foreach ($this->TablesContent[$ContentXhtmlTableName][$ContentTableName] as $CurrentRowName => $CurrentRow) {
				$TableContentName = $CurrentRow['ContainerObjectTypeName'];
				$this->LayerModule->createDatabaseTable($TableContentName);
				$this->LayerModule->Connect($TableContentName);
				$this->LayerModule->pass ($TableContentName, 'setDatabaseRow', array('PageID' => $passarray));
				$this->LayerModule->Disconnect($TableContentName);
				
				if ($CurrentRow['ContainerObjectType'] == 'Caption') {
					$this->TablesCaptionContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesCaptionContent[$ContentTableName] = $this->SortTableContent ($this->TablesCaptionContent[$ContentTableName], 'ObjectID');
				} else if ($CurrentRow['ContainerObjectType'] == 'Col') {
					$this->TablesColContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesColContent[$ContentTableName] = $this->SortTableContent ($this->TablesColContent[$ContentTableName], 'ObjectID');
				} else if ($CurrentRow['ContainerObjectType'] == 'Colgroup') {
					$this->TablesColgroupContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesColgroupContent[$ContentTableName] = $this->SortTableContent ($this->TablesColgroupContent[$ContentTableName], 'ObjectID');
					foreach ($this->TablesColgroupContent[$ContentTableName] as $TableRowName => $TableRowContent) {
						$ContainerObjectType = $TableRowContent['ContainerObjectType'];
						$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
						if ($ContainerObjectTypeName != NULL) {
							$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
							$this->LayerModule->Connect($ContainerObjectTypeName);
							$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
							$this->LayerModule->Disconnect($ContainerObjectTypeName);
							
							if ($ContainerObjectType == 'Col') {
								$this->TablesColgroupColContent[$ContentTableName] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
								$this->TablesColgroupColContent[$ContentTableName] = $this->SortTableContent ($this->TablesColgroupColContent[$ContentTableName], 'ObjectID');
							}
						}
					}
				} else if ($CurrentRow['ContainerObjectType'] == 'THead') {
					$this->TablesTHeadContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesTHeadContent[$ContentTableName] = $this->SortTableContent ($this->TablesTHeadContent[$ContentTableName], 'ObjectID');
					foreach ($this->TablesTHeadContent[$ContentTableName] as $TableRowName => $TableRowContent) {
						$ContainerObjectType = $TableRowContent['ContainerObjectType'];
						$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
						if ($ContainerObjectTypeName != NULL) {
							$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
							$this->LayerModule->Connect($ContainerObjectTypeName);
							$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
							$this->LayerModule->Disconnect($ContainerObjectTypeName);
							
							if ($ContainerObjectType == 'Header') {
								$this->TablesTHeadContentContent[$ContentTableName] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
								$this->TablesTHeadContentContent[$ContentTableName] = $this->SortTableContent ($this->TablesTHeadContentContent[$ContentTableName], 'ObjectID');
								foreach ($this->TablesTHeadContentContent[$ContentTableName] as $TableRowContentName => $TableRowContentContent) {
									$ContentContainerObjectType = $TableRowContentContent['ContainerObjectType'];
									$ContentContainerObjectTypeName = $TableRowContentContent['ContainerObjectTypeName'];
									if ($ContentContainerObjectTypeName != NULL) {
										$this->LayerModule->createDatabaseTable($ContentContainerObjectTypeName);
										$this->LayerModule->Connect($ContentContainerObjectTypeName);
										$contentpassarray = $passarray;
										$this->LayerModule->pass ($ContentContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $contentpassarray));
										$this->LayerModule->Disconnect($ContentContainerObjectTypeName);
										if ($ContentContainerObjectType == 'Header') {
											$this->TablesTHeadHeaderContent[$ContentTableName] = $this->LayerModule->pass ($ContentContainerObjectTypeName, 'getMultiRowField', array());
											$this->TablesTHeadHeaderContent[$ContentTableName] = $this->SortTableContent ($this->TablesTHeadHeaderContent[$ContentTableName], 'ObjectID');
										}
									}
								}
							}
						}
					}					
				} else if ($CurrentRow['ContainerObjectType'] == 'TFoot') {
					$this->TablesTFootContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesTFootContent[$ContentTableName] = $this->SortTableContent ($this->TablesTFootContent[$ContentTableName], 'ObjectID');
					foreach ($this->TablesTFootContent[$ContentTableName] as $TableRowName => $TableRowContent) {
						$ContainerObjectType = $TableRowContent['ContainerObjectType'];
						$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
						if ($ContainerObjectTypeName != NULL) {
							$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
							$this->LayerModule->Connect($ContainerObjectTypeName);
							$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
							$this->LayerModule->Disconnect($ContainerObjectTypeName);
							
							if ($ContainerObjectType == 'Cell') {
								$this->TablesTFootContentContent[$ContentTableName] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
								$this->TablesTFootContentContent[$ContentTableName] = $this->SortTableContent ($this->TablesTFootContentContent[$ContentTableName], 'ObjectID');
								foreach ($this->TablesTFootContentContent[$ContentTableName] as $TableRowContentName => $TableRowContentContent) {
									$ContentContainerObjectType = $TableRowContentContent['ContainerObjectType'];
									$ContentContainerObjectTypeName = $TableRowContentContent['ContainerObjectTypeName'];
									if ($ContentContainerObjectTypeName != NULL) {
										$this->LayerModule->createDatabaseTable($ContentContainerObjectTypeName);
										$this->LayerModule->Connect($ContentContainerObjectTypeName);
										$contentpassarray = $passarray;
										$this->LayerModule->pass ($ContentContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $contentpassarray));
										$this->LayerModule->Disconnect($ContentContainerObjectTypeName);
										if ($ContentContainerObjectType == 'Cell') {
											$this->TablesTFooterContent[$ContentTableName] = $this->LayerModule->pass ($ContentContainerObjectTypeName, 'getMultiRowField', array());
											$this->TablesTFooterContent[$ContentTableName] = $this->SortTableContent ($this->TablesTFooterContent[$ContentTableName], 'ObjectID');
										}
									}
								}
							}
						}
					}
				} else if ($CurrentRow['ContainerObjectType'] == 'TBody') {
					$this->TablesTBodyContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesTBodyContent[$ContentTableName] = $this->SortTableContent ($this->TablesTBodyContent[$ContentTableName], 'ObjectID');
					foreach ($this->TablesTBodyContent[$ContentTableName] as $TableRowName => $TableRowContent) {
						$ContainerObjectType = $TableRowContent['ContainerObjectType'];
						$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
						if ($ContainerObjectTypeName != NULL) {
							$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
							$this->LayerModule->Connect($ContainerObjectTypeName);
							$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
							$this->LayerModule->Disconnect($ContainerObjectTypeName);
							
							if ($ContainerObjectType == 'Cell') {
								$this->TablesTBodyContentContent[$ContentTableName] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
								$this->TablesTBodyContentContent[$ContentTableName] = $this->SortTableContent ($this->TablesTBodyContentContent[$ContentTableName], 'ObjectID');
								foreach ($this->TablesTBodyContentContent[$ContentTableName] as $TableRowContentName => $TableRowContentContent) {
									$ContentContainerObjectType = $TableRowContentContent['ContainerObjectType'];
									$ContentContainerObjectTypeName = $TableRowContentContent['ContainerObjectTypeName'];
									if ($ContentContainerObjectTypeName != NULL) {
										$this->LayerModule->createDatabaseTable($ContentContainerObjectTypeName);
										$this->LayerModule->Connect($ContentContainerObjectTypeName);
										$contentpassarray = $passarray;
										$this->LayerModule->pass ($ContentContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $contentpassarray));
										$this->LayerModule->Disconnect($ContentContainerObjectTypeName);
										if ($ContentContainerObjectType == 'Cell') {
											$this->TablesTBodyCellContent[$ContentTableName] = $this->LayerModule->pass ($ContentContainerObjectTypeName, 'getMultiRowField', array());
											$this->TablesTBodyCellContent[$ContentTableName] = $this->SortTableContent ($this->TablesTBodyCellContent[$ContentTableName], 'ObjectID');
										}
									}
								}
							}
						}
					}
					
				} else if ($CurrentRow['ContainerObjectType'] == 'TableRow') {
					$TableRowTableName = $CurrentRow['ContainerObjectTypeName'];
					$this->TablesTableRowContent[$ContentTableName] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
					$this->TablesTableRowContent[$ContentTableName] = $this->SortTableContent ($this->TablesTableRowContent[$ContentTableName], 'ObjectID');
					foreach ($this->TablesTableRowContent[$ContentTableName] as $TableRowName => $TableRowContent) {
						$ContainerObjectType = $TableRowContent['ContainerObjectType'];
						$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
						if ($ContainerObjectTypeName != NULL) {
							$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
							$this->LayerModule->Connect($ContainerObjectTypeName);
							$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
							$this->LayerModule->Disconnect($ContainerObjectTypeName);
							
							if ($ContainerObjectType == 'Header') {
								$this->TablesTableRowHeaderContent[$ContentTableName] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
								$this->TablesTableRowHeaderContent[$ContentTableName] = $this->SortTableContent ($this->TablesTableRowHeaderContent[$ContentTableName], 'ObjectID');
							} else if ($ContainerObjectType == 'Cell') {
								$this->TablesTableRowCellContent[$ContentTableName] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
								$this->TablesTableRowCellContent[$ContentTableName] = $this->SortTableContent ($this->TablesTableRowCellContent[$ContentTableName], 'ObjectID');
							}
						}
					}
				}
			}
		}
	}
	
	/**
	 * CreateOutput
	 * 
	 * Creates Output based on what the database entried have in them with space being the indentation of each line.
	 * 
	 * @param string $space = Indentation for each new line
	 * @access public
	 * 
	 */
	public function CreateOutput($space) {
		foreach ($this->TablesLookup as $TablesLookupKey => $TablesLookupValue) {
			if ($TablesLookupValue[0]['Enable/Disable'] == 'Enable' & $TablesLookupValue[0]['Status'] == 'Approved') {
				$XhtmlTableName = $TablesLookupValue[0]['XhtmlTableName'];
				$TableName = $TablesLookupValue[0]['TableName'];
				$this->Writer->startElement('table');
					$this->TableElement($TablesLookupValue[0]);
					foreach ($this->TablesContent[$XhtmlTableName][$TableName] as $TablesContentKey => $TablesContentValue) {
						if ($TablesContentValue['Enable/Disable'] == 'Enable' & $TablesContentValue['Status'] == 'Approved') {
							$ObjectType = $TablesContentValue['ContainerObjectType'];
							$ContainerObjectID = $TablesContentValue['ContainerObjectID'];
							if ($ObjectType == 'Caption') {
								$TableContent = $this->TablesCaptionContent[$TableName];
								$this->TableCaption($TableContent, $ContainerObjectID);
							} else if ($ObjectType == 'Col') {
								$TableContent = $this->TablesColContent[$TableName];
								$this->TableCol($TableContent, $ContainerObjectID);
							} else if ($ObjectType == 'Colgroup') {
								$TableContent = $this->TablesColgroupContent[$TableName];
								$this->TableColgroup($TableContent, $ContainerObjectID);
							} else if ($ObjectType == 'THead') {
								$TableContent = $this->TablesTHeadContent[$TableName];
								$this->TableTHead($TableContent, $ContainerObjectID);
							} else if ($ObjectType == 'TFoot') {
								$TableContent = $this->TablesTFootContent[$TableName];
								$this->TableTFoot($TableContent, $ContainerObjectID);
							} else if ($ObjectType == 'TBody') {
								$TableContent = $this->TablesTBodyContent[$TableName];
								$this->TableTBody($TableContent, $ContainerObjectID);
							} else if ($ObjectType == 'TableRow') {
								$TableContent = $this->TablesTableRowContent[$TableName];
								$this->TableRow($TableContent, $ContainerObjectID);
							}
						}
					}
				$this->Writer->endElement(); // END TABLE
				
			}
		}
	}
	
	/**
	 * TableElement
	 * 
	 * Creates optional and standard attributes of the table tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableElement (array $TableContent) {
	 	// TABLE TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableBorder'] != NULL) {
			$this->Writer->writeAttribute('border', $TableContent['TableBorder']);
		}
		if ($TableContent['TableCellPadding'] != NULL) {
			$this->Writer->writeAttribute('cellpadding', $TableContent['TableCellPadding']);
		}
		if ($TableContent['TableCellSpacing'] != NULL) {
			$this->Writer->writeAttribute('cellspacing', $TableContent['TableCellSpacing']);
		}
		if ($TableContent['TableFrame'] != NULL) {
			$this->Writer->writeAttribute('frame', $TableContent['TableFrame']);
		}
		if ($TableContent['TableRules'] != NULL) {
			$this->Writer->writeAttribute('rules', $TableContent['TableRules']);
		}
		if ($TableContent['TableSummary'] != NULL) {
			$this->Writer->writeAttribute('summary', $TableContent['TableSummary']);
		}
		if ($TableContent['TableWidth'] != NULL) {
			$this->Writer->writeAttribute('width', $TableContent['TableWidth']);
		}
		
		// Standard Attributes
		if ($TableContent['TableClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableClass']);
		}
		if ($TableContent['TableDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableDir']);
		}
		if ($TableContent['TableID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableID']);
		}
		if ($TableContent['TableLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableLang']);
		}
		if ($TableContent['TableStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableStyle']);
		}
		if ($TableContent['TableTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableTitle']);
		}
		if ($TableContent['TableXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableXMLLang']);
		}
	 }
	 
	 /**
	 * TableRowElement
	 * 
	 * Creates optional and standard attributes of the table row tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableRowElement (array $TableContent) {
	 	// TABLE ROW TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableRowAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableRowAlign']);
		}
		if ($TableContent['TableRowChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableRowChar']);
		}
		if ($TableContent['TableRowCharoff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableRowCharoff']);
		}
		if ($TableContent['TableRowVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableRowVAlign']);
		}
		
		// Standard Attributes
		if ($TableContent['TableRowClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableRowClass']);
		}
		if ($TableContent['TableRowDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableRowDir']);
		}
		if ($TableContent['TableRowID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableRowID']);
		}
		if ($TableContent['TableRowLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableRowLang']);
		}
		if ($TableContent['TableRowStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableRowStyle']);
		}
		if ($TableContent['TableRowTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableRowTitle']);
		}
		if ($TableContent['TableRowXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableRowXMLLang']);
		}
	 }
	 
	 /**
	 * TableCellElement
	 * 
	 * Creates optional and standard attributes of the table cell tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableCellElement (array $TableContent) {
	 	// TABLE CELL TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableCellAbbr'] != NULL) {
			$this->Writer->writeAttribute('abbr', $TableContent['TableCellAbbr']);
		}
		if ($TableContent['TableCellAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableCellAlign']);
		}
		if ($TableContent['TableCellAxis'] != NULL) {
			$this->Writer->writeAttribute('axis', $TableContent['TableCellAxis']);
		}
		if ($TableContent['TableCellChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableCellChar']);
		}
		if ($TableContent['TableCellCharoff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableCellCharoff']);
		}
		if ($TableContent['TableCellColSpan'] != NULL) {
			$this->Writer->writeAttribute('colspan', $TableContent['TableCellColSpan']);
		}
		if ($TableContent['TableCellHeaders'] != NULL) {
			$this->Writer->writeAttribute('headers', $TableContent['TableCellHeaders']);
		}
		if ($TableContent['TableCellRowSpan'] != NULL) {
			$this->Writer->writeAttribute('rowspan', $TableContent['TableCellRowSpan']);
		}
		if ($TableContent['TableCellScope'] != NULL) {
			$this->Writer->writeAttribute('scope', $TableContent['TableCellScope']);
		}
		if ($TableContent['TableCellVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableCellVAlign']);
		}
		
		// Standard Attributes
		if ($TableContent['TableCellClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableCellClass']);
		}
		if ($TableContent['TableCellDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableCellDir']);
		}
		if ($TableContent['TableCellID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableCellID']);
		}
		if ($TableContent['TableCellLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableCellLang']);
		}
		if ($TableContent['TableCellStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableCellStyle']);
		}
		if ($TableContent['TableCellTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableCellTitle']);
		}
		if ($TableContent['TableCellXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableCellXMLLang']);
		}
	 }
	 
	 /**
	 * TableHeaderElement
	 * 
	 * Creates optional and standard attributes of the table header tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableHeaderElement (array $TableContent) {
	 	// TABLE HEADER TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableHeaderAbbr'] != NULL) {
			$this->Writer->writeAttribute('abbr', $TableContent['TableHeaderAbbr']);
		}
		if ($TableContent['TableHeaderAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableHeaderAlign']);
		}
		if ($TableContent['TableHeaderAxis'] != NULL) {
			$this->Writer->writeAttribute('axis', $TableContent['TableHeaderAxis']);
		}
		if ($TableContent['TableHeaderChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableHeaderChar']);
		}
		if ($TableContent['TableHeaderCharoff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableHeaderCharoff']);
		}
		if ($TableContent['TableHeaderColSpan'] != NULL) {
			$this->Writer->writeAttribute('colspan', $TableContent['TableHeaderColSpan']);
		}
		if ($TableContent['TableHeaderRowSpan'] != NULL) {
			$this->Writer->writeAttribute('rowspan', $TableContent['TableHeaderRowSpan']);
		}
		if ($TableContent['TableHeaderScope'] != NULL) {
			$this->Writer->writeAttribute('scope', $TableContent['TableHeaderScope']);
		}
		if ($TableContent['TableHeaderVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableHeaderVAlign']);
		}
		
		// Standard Attributes
		if ($TableContent['TableHeaderClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableHeaderClass']);
		}
		if ($TableContent['TableHeaderDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableHeaderDir']);
		}
		if ($TableContent['TableHeaderID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableHeaderID']);
		}
		if ($TableContent['TableHeaderLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableHeaderLang']);
		}
		if ($TableContent['TableHeaderStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableHeaderStyle']);
		}
		if ($TableContent['TableHeaderTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableHeaderTitle']);
		}
		if ($TableContent['TableHeaderXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableHeaderXMLLang']);
		}
	 }
	 
	  /**
	 * TableTHeaderElement
	 * 
	 * Creates optional and standard attributes of the table header tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableTHeaderElement (array $TableContent) {
		// TABLE THEAD TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableHeaderAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableHeaderAlign']);
		}
		if ($TableContent['TableHeaderChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableHeaderChar']);
		}
		if ($TableContent['TableHeaderCharOff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableHeaderCharOff']);
		}
		if ($TableContent['TableHeaderVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableHeaderVAlign']);
		}
		
		// Standard Attributes
		if ($TableContent['TableHeaderClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableHeaderClass']);
		}
		if ($TableContent['TableHeaderDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableHeaderDir']);
		}
		if ($TableContent['TableHeaderID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableHeaderID']);
		}
		if ($TableContent['TableHeaderLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableHeaderLang']);
		}
		if ($TableContent['TableHeaderStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableHeaderStyle']);
		}
		if ($TableContent['TableHeaderTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableHeaderTitle']);
		}
		if ($TableContent['TableHeaderXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableHeaderXMLLang']);
		}
	 }
	 
	  /**
	 * TableTFooterElement
	 * 
	 * Creates optional and standard attributes of the table footer tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableTFooterElement (array $TableContent) {
		// TABLE THEAD TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableCellAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableCellAlign']);
		}
		if ($TableContent['TableCellChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableCellChar']);
		}
		if ($TableContent['TableCellCharOff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableCellCharOff']);
		}
		if ($TableContent['TableCellVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableCellVAlign']);
		}
		
		// Standard Attributes
		if ($TableContent['TableCellClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableCellClass']);
		}
		if ($TableContent['TableCellDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableCellDir']);
		}
		if ($TableContent['TableCellID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableCellID']);
		}
		if ($TableContent['TableCellLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableCellLang']);
		}
		if ($TableContent['TableCellStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableCellStyle']);
		}
		if ($TableContent['TableCellTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableCellTitle']);
		}
		if ($TableContent['TableCellXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableCellXMLLang']);
		}
	 }
	 
	 /**
	 * TableCaptionElement
	 * 
	 * Creates optional and standard attributes of the table caption tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableCaptionElement (array $TableContent) {
	 	// TABLE CAPTION TAG ATTRIBUTES
		// Optional Attributes
		
		// Standard Attributes
		if ($TableContent['TableCaptionClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableCaptionClass']);
		}
		if ($TableContent['TableCaptionDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableCaptionDir']);
		}
		if ($TableContent['TableCaptionID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableCaptionID']);
		}
		if ($TableContent['TableCaptionLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableCaptionLang']);
		}
		if ($TableContent['TableCaptionStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableCaptionStyle']);
		}
		if ($TableContent['TableCaptionTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableCaptionTitle']);
		}
		if ($TableContent['TableCaptionXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableCaptionXMLLang']);
		}
	 }
	 
	 
	  /**
	 * TableColElement
	 * 
	 * Creates optional and standard attributes of the table column tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableColElement (array $TableContent) {
		// TABLE THEAD TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableColAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableColAlign']);
		}
		if ($TableContent['TableColChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableColChar']);
		}
		if ($TableContent['TableColCharOff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableColCharOff']);
		}
		if ($TableContent['TableColSpan'] != NULL) {
			$this->Writer->writeAttribute('span', $TableContent['TableColSpan']);
		}
		if ($TableContent['TableColVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableColVAlign']);
		}
		if ($TableContent['TableColWidth'] != NULL) {
			$this->Writer->writeAttribute('width', $TableContent['TableColWidth']);
		}
		
		// Standard Attributes
		if ($TableContent['TableColClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableColClass']);
		}
		if ($TableContent['TableColDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableColDir']);
		}
		if ($TableContent['TableColID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableColID']);
		}
		if ($TableContent['TableColLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableColLang']);
		}
		if ($TableContent['TableColStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableColStyle']);
		}
		if ($TableContent['TableColTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableColTitle']);
		}
		if ($TableContent['TableColXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableColXMLLang']);
		}
	 }
	 
	 /**
	 * TableColgroupElement
	 * 
	 * Creates optional and standard attributes of the table column group tag.
	 * 
	 * @param array $TableContent = Table Content to set attributes with
	 * @access protected
	 * 
	 */
	 protected function TableColgroupElement (array $TableContent) {
		// TABLE THEAD TAG ATTRIBUTES
		// Optional Attributes
		if ($TableContent['TableColGroupAlign'] != NULL) {
			$this->Writer->writeAttribute('align', $TableContent['TableColGroupAlign']);
		}
		if ($TableContent['TableColGroupChar'] != NULL) {
			$this->Writer->writeAttribute('char', $TableContent['TableColGroupChar']);
		}
		if ($TableContent['TableColGroupCharOff'] != NULL) {
			$this->Writer->writeAttribute('charoff', $TableContent['TableColGroupCharOff']);
		}
		if ($TableContent['TableColGroupSpan'] != NULL) {
			$this->Writer->writeAttribute('span', $TableContent['TableColGroupSpan']);
		}
		if ($TableContent['TableColGroupVAlign'] != NULL) {
			$this->Writer->writeAttribute('valign', $TableContent['TableColGroupVAlign']);
		}
		if ($TableContent['TableColGroupWidth'] != NULL) {
			$this->Writer->writeAttribute('width', $TableContent['TableColGroupWidth']);
		}
		
		// Standard Attributes
		if ($TableContent['TableColGroupClass'] != NULL) {
			$this->Writer->writeAttribute('class', $TableContent['TableColGroupClass']);
		}
		if ($TableContent['TableColGroupDir'] != NULL) {
			$this->Writer->writeAttribute('dir', $TableContent['TableColGroupDir']);
		}
		if ($TableContent['TableColGroupID'] != NULL) {
			$this->Writer->writeAttribute('id', $TableContent['TableColGroupID']);
		}
		if ($TableContent['TableColGroupLang'] != NULL) {
			$this->Writer->writeAttribute('lang', $TableContent['TableColGroupLang']);
		}
		if ($TableContent['TableColGroupStyle'] != NULL) {
			$this->Writer->writeAttribute('style', $TableContent['TableColGroupStyle']);
		}
		if ($TableContent['TableColGroupTitle'] != NULL) {
			$this->Writer->writeAttribute('title', $TableContent['TableColGroupTitle']);
		}
		if ($TableContent['TableColGroupXMLLang'] != NULL) {
			$this->Writer->writeAttribute('xml:lang', $TableContent['TableColGroupXMLLang']);
		}
	 }
	 
	 /**
	 * TableCaption
	 * 
	 * Creates a table caption.
	 * 
	 * @param array $TableContent = Table Content for table caption
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableCaption (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				foreach ($TableContent as $Content) {
					if ($Content['ObjectID'] == $ObjectID) {
						$CurrentRecord = $Content;
						break;
						
					}
				}
				if ($CurrentRecord != NULL) {
					$this->Writer->startElement('caption');
						$Text = $CurrentRecord['TableCaptionText'];
						if ($Text != NULL) {
							$this->TableCaptionElement ($CurrentRecord);
							$this->Writer->text($Text);
						}
					$this->Writer->endElement(); // END CAPTION TAG
				}
			}
		}
	 }
	 
	 /**
	 * TableCol
	 * 
	 * Creates a table column.
	 * 
	 * @param array $TableContent = Table Content for table column
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableCol (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				foreach ($TableContent as $Content) {
					if ($Content['ObjectID'] == $ObjectID) {
						$CurrentRecord = $Content;
						break;
						
					}
				}
				if ($CurrentRecord != NULL) {
					$this->Writer->startElement('col');
						$this->TableColElement ($CurrentRecord);
					$this->Writer->endElement(); // END COL TAG
				}
			}
		}
	 }
	 
	 /**
	 * TableColgroup
	 * 
	 * Creates a table column group.
	 * 
	 * @param array $TableContent = Table Content for table column group
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableColgroup (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('colgroup');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				$this->TableColgroupElement ($TableContent[1]);
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Col') {
									$RowContent = $this->TablesColgroupColContent[$Content['TableName']];
									$this->TableCol ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				
				$this->Writer->endElement(); // ENDS TR
			}
		}
	 }
	 
	/**
	 * TableTHeadContent
	 * 
	 * Creates a table header content.
	 * 
	 * @param array $TableContent = Table Content for table header
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableTHeadContent (array $TableContent, $ObjectID) {
	 	if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('tr');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				$this->TableTHeaderElement ($TableContent[1]);
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Header') {
									$RowContent = $this->TablesTHeadHeaderContent[$Content['TableName']];
									$this->TableRowHeader ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				
				$this->Writer->endElement(); // ENDS TR
			}
			
		}
	 }
	 
	 /**
	 * TableTHead
	 * 
	 * Creates a table header.
	 * 
	 * @param array $TableContent = Table Content for table header
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableTHead (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('thead');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				$this->TableTHeaderElement ($TableContent[1]);
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Header') {
									$RowContent = $this->TablesTHeadContentContent[$Content['TableName']];
									$this->TableTHeadContent ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				
				$this->Writer->endElement(); // ENDS THEAD
			}
		}
	 }
	 
	 /**
	 * TableTFootContent
	 * 
	 * Creates a table footer content.
	 * 
	 * @param array $TableContent = Table Content for table footer
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableTFootContent (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('tr');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				$this->TableTFooterElement ($TableContent[1]);
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Cell') {
									$RowContent = $this->TablesTFooterContent[$Content['TableName']];
									$this->TableRowCell ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				
				$this->Writer->endElement(); // ENDS TR
			}
		}
	 }
	 
	 /**
	 * TableTFoot
	 * 
	 * Creates a table footer.
	 * 
	 * @param array $TableContent = Table Content for table footer
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableTFoot (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('tfoot');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				$this->TableTFooterElement ($TableContent[1]);
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Cell') {
									$RowContent = $this->TablesTFootContentContent[$Content['TableName']];
									$this->TableTFootContent ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				
				$this->Writer->endElement(); // ENDS TFOOT
			}
		}
	 }
	 
	 /**
	 * TableTBodyContent
	 * 
	 * Creates a table body content.
	 * 
	 * @param array $TableContent = Table Content for table body
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableTBodyContent (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('tr');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Cell') {
									$RowContent = $this->TablesTBodyCellContent[$Content['TableName']];
									$this->TableRowCell ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				$this->Writer->endElement(); // ENDS TR
			}
		}
	 }
	 
	 /**
	 * TableTBody
	 * 
	 * Creates a table body.
	 * 
	 * @param array $TableContent = Table Content for table body
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableTBody (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('tbody');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Cell') {
									$RowContent = $this->TablesTBodyContentContent[$Content['TableName']];
									$this->TableTBodyContent ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				
				$this->Writer->endElement(); // ENDS TBODY
			}
		}
	 }
	
	 /**
	 * TableRow
	 * 
	 * Creates a table row.
	 * 
	 * @param array $TableContent = Table Content for table row
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableRow (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			if (!is_array($ObjectID)) {
				$this->Writer->startElement('tr');
				foreach ($TableContent as $Key => $Content) {
					if ($Content['ObjectID'] != $ObjectID) {
						unset($TableContent[$Key]);
					} else {
						break;
					}
				}
				foreach ($TableContent as $Key => $Content) {
					if ($Content['Enable/Disable'] == 'Enable' & $Content['Status'] == 'Approved') {
						$ContainerObjectType = $Content['ContainerObjectType'];
						$ContainerObjectTypeName = $Content['ContainerObjectTypeName'];
						$ContainerObjectID = $Content['ContainerObjectID'];
						$ObjectID = $Content['ObjectID'];
						$StopObjectID = $Content['StopObjectID'];
						
						if ($ObjectID < $StopObjectID | is_null($StopObjectID)) {
								$this->TableRowElement($Content);
								if ($ContainerObjectType == 'Header') {
									$RowContent = $this->TablesTableRowHeaderContent[$Content['TableName']];
									$this->TableRowHeader ($RowContent, $ContainerObjectID);
								} else if ($ContainerObjectType == 'Cell') {
									$RowContent = $this->TablesTableRowCellContent[$Content['TableName']];
									$this->TableRowCell ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				$this->Writer->endElement(); // ENDS TR
			}
		}
	 }
	 
	 /**
	 * TableRowHeader
	 * 
	 * Creates a table row header.
	 * 
	 * @param array $TableContent = Table Content for table row
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableRowHeader (array $TableContent, $ObjectID) {
	 	if ($ObjectID != NULL) {
			foreach ($TableContent as $Content) {
				if ($Content['ObjectID'] == $ObjectID) {
					$CurrentRecord = $Content;
					break;
					
				}
			}
			if ($CurrentRecord != NULL) {
				$this->Writer->startElement('th');
					$Text = $CurrentRecord['TableHeaderText'];
					if ($Text != NULL) {
						$this->TableHeaderElement ($CurrentRecord);
						$this->Writer->text($Text);
					}
				$this->Writer->endElement(); // END TD TAG
			}
		}
	 }
	 
	 /**
	 * TableRowCell
	 * 
	 * Creates a table row cell.
	 * 
	 * @param array $TableContent = Table Content for table row
	 * @param string $ObjectId = Lookup Object ID
	 * @access protected
	 * 
	 */
	 protected function TableRowCell (array $TableContent, $ObjectID) {
		if ($ObjectID != NULL) {
			foreach ($TableContent as $Content) {
				if ($Content['ObjectID'] == $ObjectID) {
					$CurrentRecord = $Content;
					break;
					
				}
			}
			if ($CurrentRecord != NULL) {
				$this->Writer->startElement('td');
					$Text = $CurrentRecord['TableCellText'];
					if ($Text != NULL) {
						$this->TableCellElement ($CurrentRecord);
						$this->Writer->text($Text);
					}
				$this->Writer->endElement(); // END TD TAG
			}
		}
	 }
	  /**
	 * SortTableContent
	 * 
	 * Sorts TableContent by table key.
	 * 
	 * @param array $TableContent = Table Content for table row
	 * @param string $SortKey = Key to sort table content by.
	 * @access protected
	 * @return array TableContent
	 * 
	 */
	 protected function SortTableContent (array $TableContent, $SortKey) {
	 	if ($SortKey != NULL) {
			if (!is_array($SortKey)) {
				$SortBy = array();
				foreach ($TableContent as $Key => $Value) {
					$SortBy[$Key] = $Value[$SortKey];
				}
				array_multisort($SortBy, SORT_ASC, $TableContent);
				$Values = array_values($TableContent);
				$TableContent = array_combine(range(1, count($Values)), $Values);
				return($TableContent);
			}
		}
	 }
}
?>