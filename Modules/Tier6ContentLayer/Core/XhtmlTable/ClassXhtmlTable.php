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

/**
 * Class XhtmlTable
 *
 * Class XhtmlTable is designed to allow a user to interact with Xhtml Tables inside of the Content Layer class.
 *
 * @author Travis Napolean Smith
 * @copyright Copyright (c) 1999 - 2013 One Solution CMS
 * @copyright PHP - Copyright (c) 2005 - 2013 One Solution CMS
 * @copyright C++ - Copyright (c) 1999 - 2005 One Solution CMS
 * @version PHP - 2.1.140
 * @version C++ - Unknown
 */

class XhtmlTable extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	/**
	 * DHtmlXGridTable Output, if true display for DHtmlX Grid Table
	 *
	 * @var array
	 */
	protected $DHtmlXGridTable = FALSE;

	/**
	 * Table Names passed to contructor
	 *
	 * @var array
	 */
	protected $TablesNames = array();

	/**
	 * Table Listing Table Name.
	 *
	 * @var array
	 */
	protected $TablesListingTableName;

	/**
	 * Content from database table listing table.
	 *
	 * @var string
	 */
	protected $TablesListingContent = array();

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

		if ($DatabaseOptions['DHtmlXGrid']) {
			$this->DHtmlXGridTable = $DatabaseOptions['DHtmlXGrid'];
			unset($DatabaseOptions['DHtmlXGrid']);
			$this->Writer->startDocument('1.0', 'utf-8');
		}

		if (isset($TableNames['DatabaseTable2'])) {
			$this->TablesListingTableName = $TableNames['DatabaseTable2'];
			$TableNames['DatabaseTable2'] = NULL;
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
			$ContentXhtmlTableID = $this->TablesLookup[$TableContent][0]['TableID'];
			$passarray = array('TableID' => $ContentXhtmlTableID);
			$this->LayerModule->createDatabaseTable($ContentXhtmlTableName);
			$this->LayerModule->Connect($ContentXhtmlTableName);
			$this->LayerModule->pass ($ContentXhtmlTableName, 'setDatabaseRow', array('PageID' => $passarray));
			$this->LayerModule->Disconnect($ContentXhtmlTableName);
			$this->TablesContent[$ContentXhtmlTableName][$ContentXhtmlTableID] = $this->LayerModule->pass ($ContentXhtmlTableName, 'getMultiRowField', array());

			$newpassarray = array();
			$newpassarray['XhtmlTableName'] = $ContentXhtmlTableName;
			$newpassarray['XhtmlTableID'] = $ContentXhtmlTableID;
			$this->LayerModule->createDatabaseTable($this->TablesListingTableName);
			$this->LayerModule->Connect($this->TablesListingTableName);
			$this->LayerModule->pass ($this->TablesListingTableName, 'setDatabaseRow', array('PageID' => $newpassarray));
			$this->LayerModule->Disconnect($this->TablesListingTableName);
			$this->TablesListingContent[$ContentXhtmlTableName][$ContentXhtmlTableID] = $this->LayerModule->pass ($this->TablesListingTableName, 'getMultiRowField', array());

			$DatabaseTables = array();
			foreach ($this->TablesContent[$ContentXhtmlTableName][$ContentXhtmlTableID] as $CurrentRowName => $CurrentRow) {
				$ObjectType = $CurrentRow['ContainerObjectType'];
				$ObjectTypeName = $CurrentRow['ContainerObjectTypeName'];
				if ($ObjectType != NULL) {
					if ($ObjectTypeName != NULL) {
						$DatabaseTables[$ObjectType][$ObjectTypeName] = $ObjectTypeName;
					}
				}

			}

			foreach ($DatabaseTables as $Key => $Content) {
				foreach($Content as $TableContentKey => $TableContentName) {
					$this->LayerModule->createDatabaseTable($TableContentName);
					$this->LayerModule->Connect($TableContentName);
					$this->LayerModule->pass ($TableContentName, 'setDatabaseRow', array('PageID' => $passarray));
					$this->LayerModule->Disconnect($TableContentName);
					if ($Key == 'Caption') {
						$this->TablesCaptionContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesCaptionContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesCaptionContent[$ContentXhtmlTableID], 'ObjectID');
					} else if ($Key == 'Col') {
						$this->TablesColContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesColContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesColContent[$ContentXhtmlTableID], 'ObjectID');
					} else if ($Key == 'Colgroup') {
						$this->TablesColgroupContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesColgroupContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesColgroupContent[$ContentXhtmlTableID], 'ObjectID');
						foreach ($this->TablesColgroupContent[$ContentXhtmlTableID] as $TableRowName => $TableRowContent) {
							// DO SAME AS WITH TABLES USE THE TEMPORARY DATABASE TABLES VARIABLE
							$ContainerObjectType = $TableRowContent['ContainerObjectType'];
							$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
							if ($ContainerObjectTypeName != NULL) {
								$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
								$this->LayerModule->Connect($ContainerObjectTypeName);
								$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
								$this->LayerModule->Disconnect($ContainerObjectTypeName);

								if ($ContainerObjectType == 'Col') {
									$this->TablesColgroupColContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
									$this->TablesColgroupColContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesColgroupColContent[$ContentXhtmlTableID], 'ObjectID');
								}
							}
						}
					} else if ($Key == 'THead') {
						$this->TablesTHeadContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesTHeadContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTHeadContent[$ContentXhtmlTableID], 'ObjectID');
						
						foreach ($this->TablesTHeadContent[$ContentXhtmlTableID] as $TableRowName => $TableRowContent) {
							// DO SAME AS WITH TABLES USE THE TEMPORARY DATABASE TABLES VARIABLE
							$ContainerObjectType = $TableRowContent['ContainerObjectType'];
							$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
							if ($ContainerObjectTypeName != NULL) {
								$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
								$this->LayerModule->Connect($ContainerObjectTypeName);
								$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
								$this->LayerModule->Disconnect($ContainerObjectTypeName);

								if ($ContainerObjectType == 'Header') {
									$this->TablesTHeadContentContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
									$this->TablesTHeadContentContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTHeadContentContent[$ContentXhtmlTableID], 'ObjectID');
									foreach ($this->TablesTHeadContentContent[$ContentXhtmlTableID] as $TableRowContentName => $TableRowContentContent) {
										$ContentContainerObjectType = $TableRowContentContent['ContainerObjectType'];
										$ContentContainerObjectTypeName = $TableRowContentContent['ContainerObjectTypeName'];
										if ($ContentContainerObjectTypeName != NULL) {
											$this->LayerModule->createDatabaseTable($ContentContainerObjectTypeName);
											$this->LayerModule->Connect($ContentContainerObjectTypeName);
											$contentpassarray = $passarray;
											$this->LayerModule->pass ($ContentContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $contentpassarray));
											$this->LayerModule->Disconnect($ContentContainerObjectTypeName);
											if ($ContentContainerObjectType == 'Header') {
												$this->TablesTHeadHeaderContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContentContainerObjectTypeName, 'getMultiRowField', array());
												$this->TablesTHeadHeaderContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTHeadHeaderContent[$ContentXhtmlTableID], 'ObjectID');
											}
										}
									}
								}
							}
						}
					} else if ($Key == 'TFoot') {
						$this->TablesTFootContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesTFootContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTFootContent[$ContentXhtmlTableID], 'ObjectID');
						foreach ($this->TablesTFootContent[$ContentXhtmlTableID] as $TableRowName => $TableRowContent) {
							// DO SAME AS WITH TABLES USE THE TEMPORARY DATABASE TABLES VARIABLE
							$ContainerObjectType = $TableRowContent['ContainerObjectType'];
							$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
							if ($ContainerObjectTypeName != NULL) {
								$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
								$this->LayerModule->Connect($ContainerObjectTypeName);
								$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
								$this->LayerModule->Disconnect($ContainerObjectTypeName);

								if ($ContainerObjectType == 'Cell') {
									$this->TablesTFootContentContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
									$this->TablesTFootContentContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTFootContentContent[$ContentXhtmlTableID], 'ObjectID');
									foreach ($this->TablesTFootContentContent[$ContentXhtmlTableID] as $TableRowContentName => $TableRowContentContent) {
										$ContentContainerObjectType = $TableRowContentContent['ContainerObjectType'];
										$ContentContainerObjectTypeName = $TableRowContentContent['ContainerObjectTypeName'];
										if ($ContentContainerObjectTypeName != NULL) {
											$this->LayerModule->createDatabaseTable($ContentContainerObjectTypeName);
											$this->LayerModule->Connect($ContentContainerObjectTypeName);
											$contentpassarray = $passarray;
											$this->LayerModule->pass ($ContentContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $contentpassarray));
											$this->LayerModule->Disconnect($ContentContainerObjectTypeName);
											if ($ContentContainerObjectType == 'Cell') {
												$this->TablesTFooterContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContentContainerObjectTypeName, 'getMultiRowField', array());
												$this->TablesTFooterContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTFooterContent[$ContentXhtmlTableID], 'ObjectID');
											}
										}
									}
								}
							}
						}
					} else if ($Key == 'TBody') {
						$this->TablesTBodyContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesTBodyContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTBodyContent[$ContentXhtmlTableID], 'ObjectID');
						foreach ($this->TablesTBodyContent[$ContentXhtmlTableID] as $TableRowName => $TableRowContent) {
							// DO SAME AS WITH TABLES USE THE TEMPORARY DATABASE TABLES VARIABLE
							$ContainerObjectType = $TableRowContent['ContainerObjectType'];
							$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
							if ($ContainerObjectTypeName != NULL) {
								$this->LayerModule->createDatabaseTable($ContainerObjectTypeName);
								$this->LayerModule->Connect($ContainerObjectTypeName);
								$this->LayerModule->pass ($ContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $passarray));
								$this->LayerModule->Disconnect($ContainerObjectTypeName);

								if ($ContainerObjectType == 'Cell') {
									$this->TablesTBodyContentContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContainerObjectTypeName, 'getMultiRowField', array());
									$this->TablesTBodyContentContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTBodyContentContent[$ContentXhtmlTableID], 'ObjectID');
									foreach ($this->TablesTBodyContentContent[$ContentXhtmlTableID] as $TableRowContentName => $TableRowContentContent) {
										$ContentContainerObjectType = $TableRowContentContent['ContainerObjectType'];
										$ContentContainerObjectTypeName = $TableRowContentContent['ContainerObjectTypeName'];
										if ($ContentContainerObjectTypeName != NULL) {
											$this->LayerModule->createDatabaseTable($ContentContainerObjectTypeName);
											$this->LayerModule->Connect($ContentContainerObjectTypeName);
											$contentpassarray = $passarray;
											$this->LayerModule->pass ($ContentContainerObjectTypeName, 'setDatabaseRow', array('PageID' => $contentpassarray));
											$this->LayerModule->Disconnect($ContentContainerObjectTypeName);
											if ($ContentContainerObjectType == 'Cell') {
												$this->TablesTBodyCellContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($ContentContainerObjectTypeName, 'getMultiRowField', array());
												$this->TablesTBodyCellContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTBodyCellContent[$ContentXhtmlTableID], 'ObjectID');
											}
										}
									}
								}
							}
						}

					} else if ($Key == 'TableRow') {
						// USE THIS AS MODEL FOR ACCESSING THE DATABASE
						$TableRowTableName = $CurrentRow['ContainerObjectTypeName'];
						$this->TablesTableRowContent[$ContentXhtmlTableID] = $this->LayerModule->pass ($TableContentName, 'getMultiRowField', array());
						$this->TablesTableRowContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTableRowContent[$ContentXhtmlTableID], 'ObjectID');
						
						$TableNameArray = array();
						
						foreach ($this->TablesTableRowContent[$ContentXhtmlTableID] as $TableRowName => $TableRowContent) {
							$ContainerObjectType = $TableRowContent['ContainerObjectType'];
							$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
							
							if ($ContainerObjectTypeName != NULL) {
								if ($TableNameArray == NULL) {
									array_push($TableNameArray, $ContainerObjectTypeName);
								} else {
									if (in_array($ContainerObjectTypeName, $TableNameArray) == FALSE) {
										array_push($TableNameArray, $ContainerObjectTypeName);
									}
								}
							}
						}
						
						$DatabaseResults = array();
						foreach ($TableNameArray as $DatabaseName) {
							if ($DatabaseName != NULL) {
								$this->LayerModule->createDatabaseTable($DatabaseName);
								$this->LayerModule->Connect($DatabaseName);
								$this->LayerModule->pass ($DatabaseName, 'setDatabaseRow', array('PageID' => $passarray));
								$this->LayerModule->Disconnect($DatabaseName);
								
								$DatabaseResults[$DatabaseName] = $this->LayerModule->pass ($DatabaseName, 'getMultiRowField', array());
							}
						}
						
						foreach ($this->TablesTableRowContent[$ContentXhtmlTableID] as $TableRowName => $TableRowContent) {
							$ContainerObjectType = $TableRowContent['ContainerObjectType'];
							$ContainerObjectTypeName = $TableRowContent['ContainerObjectTypeName'];
							if ($ContainerObjectTypeName != NULL) {
								if ($ContainerObjectType == 'Header') {
									$this->TablesTableRowHeaderContent[$ContentXhtmlTableID] = $DatabaseResults[$ContainerObjectTypeName];
									$this->TablesTableRowHeaderContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTableRowHeaderContent[$ContentXhtmlTableID], 'ObjectID');
								} else if ($ContainerObjectType == 'Cell') {
									$this->TablesTableRowCellContent[$ContentXhtmlTableID] = $DatabaseResults[$ContainerObjectTypeName];
									$this->TablesTableRowCellContent[$ContentXhtmlTableID] = $this->SortTableContent ($this->TablesTableRowCellContent[$ContentXhtmlTableID], 'ObjectID');
								}
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
				$TableID = $TablesLookupValue[0]['TableID'];

				if ($this->TablesListingContent[$XhtmlTableName][$TableID][0]['Enable/Disable'] == 'Enable' & $this->TablesListingContent[$XhtmlTableName][$TableID][0]['Status'] == 'Approved') {
					$XhtmlTableName = $TablesLookupValue[0]['XhtmlTableName'];
					$TableID = $TablesLookupValue[0]['TableID'];
					if ($this->DHtmlXGridTable == TRUE) {
						$this->Writer->startElement('rows');
					} else {
						$this->Writer->startElement('table');
					}
						if ($this->DHtmlXGridTable == FALSE) {
							$this->TableElement($this->TablesListingContent[$XhtmlTableName][$TableID][0]);
						}
						foreach ($this->TablesContent[$XhtmlTableName][$TableID] as $TablesContentKey => $TablesContentValue) {
							if ($TablesContentValue['Enable/Disable'] == 'Enable' & $TablesContentValue['Status'] == 'Approved') {
								$ObjectType = $TablesContentValue['ContainerObjectType'];
								$ContainerObjectID = $TablesContentValue['ContainerObjectID'];
								if ($ObjectType == 'Caption') {
									$TableContent = $this->TablesCaptionContent[$TableID];
									$this->TableCaption($TableContent, $ContainerObjectID);
								} else if ($ObjectType == 'Col') {
									$TableContent = $this->TablesColContent[$TableID];
									$this->TableCol($TableContent, $ContainerObjectID);
								} else if ($ObjectType == 'Colgroup') {
									$TableContent = $this->TablesColgroupContent[$TableID];
									$this->TableColgroup($TableContent, $ContainerObjectID);
								} else if ($ObjectType == 'THead') {
									$TableContent = $this->TablesTHeadContent[$TableID];
									$this->TableTHead($TableContent, $ContainerObjectID);
								} else if ($ObjectType == 'TFoot') {
									$TableContent = $this->TablesTFootContent[$TableID];
									$this->TableTFoot($TableContent, $ContainerObjectID);
								} else if ($ObjectType == 'TBody') {
									$TableContent = $this->TablesTBodyContent[$TableID];
									$this->TableTBody($TableContent, $ContainerObjectID);
								} else if ($ObjectType == 'TableRow') {
									$TableContent = $this->TablesTableRowContent[$TableID];
									$this->TableRow($TableContent, $ContainerObjectID);
								}
							}
						}
					$this->Writer->endElement(); // END TABLE OR ROWS
				}
			}
		}
	}

	/**
	 * FetchTableListingContent
	 *
	 * Retrieves data from the database the entire contents of XhtmlTableListing
	 *
	 * @access public
	 *
	 */
	public function FetchTableListingContent() {
		$ContentXhtmlTableName = $this->TablesLookup[$this->TableNames['DatabaseTable1']][0]['XhtmlTableName'];
		$PageID = array();
		$PageID['XhtmlTableName'] = $ContentXhtmlTableName;
		$this->LayerModule->createDatabaseTable($this->TablesListingTableName);
		$this->LayerModule->Connect($this->TablesListingTableName);
		$this->LayerModule->pass ($this->TablesListingTableName, 'setDatabaseRow', array('PageID' => $PageID));
		$this->LayerModule->Disconnect($this->TablesListingTableName);
		$this->TablesListingContent = $this->LayerModule->pass ($this->TablesListingTableName, 'getMultiRowField', array());
	}

	/**
	 * getTablesListingContent
	 *
	 * Returns the TablesListingContent member. This contains the entire contents of the database table XhtmlTableListing
	 *
	 * @access public
	 *
	 */
	public function getTablesListingContent(){
		return $this->TablesListingContent;
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
									$RowContent = $this->TablesColgroupColContent[$Content['TableID']];
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
				if ($this->DHtmlXGridTable == FALSE) {
					$this->Writer->startElement('tr');
				}
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
									$RowContent = $this->TablesTHeadHeaderContent[$Content['TableID']];
									$this->TableRowHeader ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}

				if ($this->DHtmlXGridTable == FALSE) {
					$this->Writer->endElement(); // ENDS TR OR HEAD
				}

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
				if ($this->DHtmlXGridTable == TRUE) {
					$this->Writer->startElement('head');
				} else {
					$this->Writer->startElement('thead');
				}
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
									$RowContent = $this->TablesTHeadContentContent[$Content['TableID']];
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
									$RowContent = $this->TablesTFooterContent[$Content['TableID']];
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
									$RowContent = $this->TablesTFootContentContent[$Content['TableID']];
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
									$RowContent = $this->TablesTBodyCellContent[$Content['TableID']];
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
									$RowContent = $this->TablesTBodyContentContent[$Content['TableID']];
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
				if ($this->DHtmlXGridTable == TRUE) {
					$this->Writer->startElement('row');
					$this->Writer->writeAttribute('id' , $ObjectID);
				} else {
					$this->Writer->startElement('tr');
				}
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
									$RowContent = $this->TablesTableRowHeaderContent[$Content['TableID']];
									$this->TableRowHeader ($RowContent, $ContainerObjectID);
								} else if ($ContainerObjectType == 'Cell') {
									$RowContent = $this->TablesTableRowCellContent[$Content['TableID']];
									$this->TableRowCell ($RowContent, $ContainerObjectID);
								}
						} else if ($ObjectID == $StopObjectID) {
							break;
						}
					}
				}
				$this->Writer->endElement(); // ENDS TR OR ROW
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
				if ($this->DHtmlXGridTable == TRUE) {
					$this->Writer->startElement('column');
					$this->Writer->writeAttribute('type', 'ed');
					$this->Writer->writeAttribute('sort', 'str');
					$this->Writer->writeAttribute('width', '110');
				} else {
					$this->Writer->startElement('th');
				}
					$Text = $CurrentRecord['TableHeaderText'];
					if ($Text != NULL) {
						if ($this->DHtmlXGridTable == FALSE) {
							$this->TableHeaderElement ($CurrentRecord);
						}
						$this->Writer->text($Text);
					}
				$this->Writer->endElement(); // END TD OR COLUMN TAG
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
				if ($this->DHtmlXGridTable == TRUE) {
					$this->Writer->startElement('cell');
				} else {
					$this->Writer->startElement('td');
				}
					$Text = $CurrentRecord['TableCellText'];
					if ($Text != NULL) {
						if ($this->DHtmlXGridTable == FALSE) {
							$this->TableCellElement ($CurrentRecord);
						}
						$this->Writer->text($Text);
					}
				$this->Writer->endElement(); // END TD OR CELL TAG
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

	 /**
	 * getLastTableID
	 *
	 * Returns the last TableID for XhtmlTableName.
	 *
	 * @param array $XhtmlTableNames = an array of XhtmlTableNames to get the Last Table ID for.
	 * @access public
	 * @return array LastTableID
	 *
	 */

	 public function getLastTableID($XhtmlTableNames) {
		$LastTableID = array();
		if (is_array($XhtmlTableNames)) {
			foreach($XhtmlTableNames as $Key => $Value) {
				$passarray = array();
				$passarray['XhtmlTableName'] = $Value;
				$this->LayerModule->Connect($this->TablesListingTableName);
				$this->LayerModule->pass ($this->TablesListingTableName, 'setOrderbyname', array('orderbyname' => 'XhtmlTableID'));
				$this->LayerModule->pass ($this->TablesListingTableName, 'setOrderbytype', array('orderbytype' => 'DESC'));
				$this->LayerModule->pass ($this->TablesListingTableName, 'setLimit', array('limit' => 1));
				$this->LayerModule->pass ($this->TablesListingTableName, 'setDatabaseRow', array('PageID' => $passarray));
				$this->LayerModule->Disconnect($this->TablesListingTableName);
				$hold = $this->LayerModule->pass ($this->TablesListingTableName, 'getMultiRowField', array());
				$TableID = $hold[0]['XhtmlTableID'];
				$LastTableID[$Value] = $TableID;
			}
			return $LastTableID;
		}
	 }

	 /**
	 * createTable
	 *
	 * Creates A Table.
	 *
	 * @param array $Table = Table content to create, must have three fields: Content - Table Content To Add, TableName - Database Table Name, TableType - Type Of Table Added.
	 * @access public
	 *
	 */
	public function createTable(array $Table) {
		if ($Table != NULL) {
			$TableContent = $Table['Content'];
			$DatabaseTableName = $Table['TableName'];

			$this->LayerModule->createDatabaseTable($DatabaseTableName);
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'BuildFieldNames', array('TableName' => $DatabaseTableName));
			$this->LayerModule->Disconnect($DatabaseTableName);

			$Keys = $this->LayerModule->pass ($DatabaseTableName, 'getRowFieldNames', array());

			$this->addModuleContent($Keys, $TableContent, $DatabaseTableName);

		} else {
			array_push($this->ErrorMessage,'createTable: Table cannot be NULL!');
		}
	}

	 /**
	 * updateTable
	 *
	 * Updates A Table.
	 *
	 * @param array $TableID = Table ID to update.
	 * @access public
	 *
	 */
	public function updateTable(array $TableID) {
		if ($TableID != NULL) {
			$TableName = $TableID['TableName'];
			$TableType = $TableID['TableType'];
			if ($TableType === NULL) {
				$RowName = 'TableID';
				$RowValue = $TableID['Content'][0]['TableID'];
				$this->LayerModule->createDatabaseTable($TableName);
				$this->LayerModule->Connect($TableName);
				$this->LayerModule->pass ($TableName, 'deleteRow', array('rowname' => $RowName, 'rowvalue' => $RowValue));
				$this->LayerModule->Disconnect($TableName);

				$this->createTable($TableID);
			} else if ($TableType == 'XhtmlTableLookup') {

			} else if ($TableType == 'XhtmlTableListing') {
				$RowName = 'XhtmlTableID';
				$RowValue = $TableID['Content'][0]['XhtmlTableID'];

				$this->LayerModule->createDatabaseTable($TableName);
				$this->LayerModule->Connect($TableName);
				$this->LayerModule->pass ($TableName, 'deleteRow', array('rowname' => $RowName, 'rowvalue' => $RowValue));
				$this->LayerModule->Disconnect($TableName);

				$this->createTable($TableID);
			}
		} else {
			array_push($this->ErrorMessage,'updateTable: TableID cannot be NULL!');
		}
	}

	 /**
	 * deleteTable
	 *
	 * Deletes A Table.
	 *
	 * @param array $TableID = Table ID to delete.
	 * @access public
	 *
	 */
	public function deleteTable(array $TableID) {
		if ($TableID != NULL) {
			$this->deleteModuleContent($TableID, $this->TablesListingTableName);
		} else {
			array_push($this->ErrorMessage,'deleteTable: TableID cannot be NULL!');
		}
	}
	
	/**
	 * deleteTableLookup
	 *
	 * Deletes A Table Lookup.
	 *
	 * @param array $TableID = Table ID to delete, must have key TableName - Database Table Name.
	 * @access public
	 *
	 */
	public function deleteTableLookup(array $TableID) {
		if ($TableID != NULL) {
			$DatabaseTableName = $TableID['TableName'];
			unset($TableID['TableName']);
			
			$this->deleteModuleContent($TableID, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'deleteTableLookup: TableID cannot be NULL!');
		}
	}
	
	 /**
	 * updateTableStatus
	 *
	 * Updates Status Of Table.
	 *
	 * @param array $TableID = Table ID to update status.
	 * @access public
	 *
	 */
	public function updateTableStatus(array $TableID) {
		if ($TableID != NULL) {
			if ($TableID['Enable/Disable'] == 'Enable') {
				$this->enableModuleContent($TableID, $this->TablesListingTableName);
			} else if ($TableID['Enable/Disable'] == 'Disable') {
				$this->disableModuleContent($TableID, $this->TablesListingTableName);
			}

			if ($TableID['Status'] == 'Approved') {
				$this->approvedModuleContent($TableID, $this->TablesListingTableName);
			} else if ($TableID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($TableID, $this->TablesListingTableName);
			} else if ($TableID['Status'] == 'Pending') {
				$this->pendingModuleContent($TableID, $this->TablesListingTableName);
			} else if ($TableID['Status'] == 'Spam') {
				$this->spamModuleContent($TableID, $this->TablesListingTableName);
			}
			
		} else {
			array_push($this->ErrorMessage,'updateTableStatus: TableID cannot be NULL!');
		}
	}
	
	/**
	 * updateTableLookup
	 *
	 * Updates Status Of Table Lookup Record.
	 *
	 * @param array $TableID = Table ID to update status, must have key TableName - Database Table Name.
	 * @access public
	 *
	 */
	public function updateTableLookup(array $TableID) {
		if ($TableID != NULL) {
			$DatabaseTableName = $TableID['TableName'];
			unset($TableID['TableName']);
			$UpdateTable = $TableID['UpdateTable'];
			unset($TableID['UpdateTable']);
			
			if ($TableID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($TableID, $DatabaseTableName);
			} else if ($TableID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($TableID, $DatabaseTableName);
			}

			if ($TableID['Status'] == 'Approved') {
				$this->approvedModuleContent($TableID, $DatabaseTableName);
			} else if ($TableID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($TableID, $DatabaseTableName);
			} else if ($TableID['Status'] == 'Pending') {
				$this->pendingModuleContent($TableID, $DatabaseTableName);
			} else if ($TableID['Status'] == 'Spam') {
				$this->spamModuleContent($TableID, $DatabaseTableName);
			}
			
			if ($UpdateTable == 'UpdateTable') {
				$this->updateModuleContent($TableID, $DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateTableLookup: TableID cannot be NULL!');
		}
	}

}
?>