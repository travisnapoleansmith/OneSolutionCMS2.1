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

class XhtmlOrderedList extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $DatabaseTableName;

	protected $Insert;

	protected $Ol;

	// Ol Standard Attributes
	protected $OlClass;
	protected $OlDir;
	protected $OlID;
	protected $OlLang;
	protected $OlStyle;
	protected $OlTitle;
	protected $OlXMLLang;

	protected $Li = array();
	protected $LiChildID = array();

	// Li Standard Attributes
	protected $LiClass = array();
	protected $LiDir = array();
	protected $LiID = array();
	protected $LiLang = array();
	protected $LiStyle = array();
	protected $LiTitle = array();
	protected $LiXMLLang = array();

	protected $LiEnableDisable = array();

	//protected $List;

	/**
	 * Create an instance of XtmlOrderedList
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlOrderedList'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlOrderedList'][$hold];
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

		if ($DatabaseOptions['Insert']) {
			$this->Insert = $DatabaseOptions['Insert'];
			unset($DatabaseOptions['Insert']);
		}

		if ($DatabaseOptions['NoAttributes']) {
			$this->NoAttributes = $DatabaseOptions['NoAttributes'];
			unset($DatabaseOptions['NoAttributes']);
		}

		if ($DatabaseOptions['NoGlobal']) {
			$this->NoGlobal = $DatabaseOptions['NoGlobal'];
			unset($DatabaseOptions['NoGlobal']);
		}

		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}

		if ($DatabaseOptions['Indent']) {
			$this->Indent = $DatabaseOptions['Indent'];
			unset($DatabaseOptions['Indent']);
		}

		$this->DatabaseTableName = current($TableNames);

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
		$this->PrintPreview = $PageID['PrintPreview'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];

		unset($PageID['RevisionID']);
		unset($PageID['CurrentVersion']);
		unset ($PageID['PrintPreview']);

		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		//$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));

		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));

		$this->Ol = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Ol'));
		$this->OlClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlClass'));
		$this->OlDir = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlDir'));
		$this->OlID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlID'));
		$this->OlLang = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlLang'));
		$this->OlStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlStyle'));
		$this->OlTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlTitle'));
		$this->OlXMLLang = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'OlXMLLang'));

		$this->BuildLiList('Li', 'Li');
		$this->BuildLiList('LiChildID', 'LiChildID');

		$this->BuildLiList('LiClass', 'LiClass');
		$this->BuildLiList('LiDir', 'LiDir');
		$this->BuildLiList('LiID', 'LiID');
		$this->BuildLiList('LiLang', 'LiLang');
		$this->BuildLiList('LiStyle', 'LiStyle');
		$this->BuildLiList('LiTitle', 'LiTitle');
		$this->BuildLiList('LiXMLLang', 'LiXMLLang');

		$this->BuildLiList('LiEnableDisable', 'LiEnable/Disable');

		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));

		$this->LayerModule->Disconnect($this->DatabaseTable);
	}

	protected function BuildLiList($LiList, $LiListField) {
		if ($this->$LiList) {
			$this->$LiList = NOlL;
			$this->$LiList = array();
		}

		if (is_array($this->$LiList)) {
			$i = 1;
			$Field = 'Li';
			$Field .= $i;
			$FieldName = str_replace('Li', $Field, $LiListField);
			while($this->LayerModule->pass ($this->DatabaseTable, 'searchFieldNames', array('rowfield' => $FieldName))) {
				$temp = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $FieldName));
				array_push($this->$LiList, $temp);
				$i++;
				$Field = 'Li';
				$Field .= $i;
				$FieldName = str_replace('Li', $Field, $LiListField);
			}
		}
	}

	public function CreateOutput($space) {
		$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->StartTag && !$this->NoAttributes){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					if (!$this->NoAttributes) {
						$this->ProcessStandardAttribute('StartTag');
					}
			}
			if ($this->Ul){
				$this->Writer->writeRaw("\n    ");
				$this->Writer->writeRaw($this->CreateWordWrap($this->Ul));
				$this->Writer->writeRaw("\n");
			}

			$this->Writer->startElement('ol');
				if (!$this->NoAttributes) {
					$this->ProcessStandardAttribute('OL');
				}
			if (is_array($this->Li)) {
				if (is_array($this->LiChildID)){
					if (is_array($this->LiID)){
						if (is_array($this->LiClass)){
							if (is_array($this->LiStyle)){
								if (is_array($this->LiEnableDisable)) {
									while (current($this->Li)) {
										if (current($this->LiEnableDisable) == 'Enable') {
											$this->Writer->startElement('li');
												if (!$this->NoAttributes) {
													$this->ProcessArrayStandardAttribute('Li');
												}
											if (current($this->Li)) {
												$this->Li[key($this->Li)] = $this->CreateWordWrap(current($this->Li));
												$this->Li[key($this->Li)] = trim (current($this->Li));
												if ($this->Indent) {
													$this->Writer->writeRaw("\n\t $this->Indent");
												} else {
													$this->Writer->writeRaw("\n\t ");
												}
												$this->Writer->writeRaw(current($this->Li));
												if (current($this->LiChildID)) {
													$this->Writer->writeRaw("\n");
												} else {
													$this->Writer->writeRaw("\n     ");
												}
											}
											if (current($this->LiChildID)){
												$listidnumber = array();
												$listidnumber['PageID'] = $this->PageID;
												$listidnumber['ObjectID'] = current($this->LiChildID);
												$listdatabase = array();
												$listdatabase[$this->DatabaseTableName] = $this->DatabaseTableName;
												$databaseoptions = array();
												if ($this->NoAttributes) {
													$databaseoptions['NoAttributes'] = $this->NoAttributes;
												}

												$databaseoptions['NoGlobal'] = FALSE;
												if ($this->Indent) {
													$databaseoptions['Indent'] = $this->Indent;
													$databaseoptions['Indent'] .= "  ";
												} else {
													$databaseoptions['Indent'] = "  ";
												}
												$list = new XhtmlUnorderedList($listdatabase, $databaseoptions, $this->LayerModule);

												$list->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTableName);
												$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
												$list->FetchDatabase ($listidnumber);

												$tempspace = $this->Space;
												$tempspace .= '    ';
												$list->CreateOutput($tempspace);
												$this->Writer->writeRaw("\n");
												$this->Writer->writeRaw("   ");
											} else {
												$this->Writer->writeRaw("   ");
											}

											if ($this->Indent) {
												$this->Writer->writeRaw($this->Indent);
											}
											$this->Writer->endElement(); // ENDS LI
											// CHANGED
											//$this->Writer->writeRaw("\n");
										}
										next($this->Li);
										next($this->LiChildID);
										next($this->LiClass);
										next($this->LiDir);
										next($this->LiID);
										next($this->LiLang);
										next($this->LiStyle);
										next($this->LiTitle);
										next($this->LiXMLLang);
										next($this->LiEnableDisable);
									}
								} else {
									array_push($this->ErrorMessage,'CreateOutput: LiEnableDisable must be an Array!');
								}
							} else {
								array_push($this->ErrorMessage,'CreateOutput: LiStyle must be an Array!');
							}
						} else {
							array_push($this->ErrorMessage,'CreateOutput: LiClass must be an Array!');
						}
					} else {
						array_push($this->ErrorMessage,'CreateOutput: LiID must be an Array!');
					}
				} else {
					array_push($this->ErrorMessage,'CreateOutput: LiChildID must be an Array!');
				}
			} else {
				array_push($this->ErrorMessage,'CreateOutput: Li must be an Array!');
			}

			$this->Writer->endElement(); // ENDS OL

			if ($this->Insert) {
				$this->Writer->writeRaw(' ');
				$this->Writer->writeRaw($this->Insert); // WRITES INSERT
				$this->Writer->writeRaw("\n ");
			}

			if ($this->EndTag && !$this->NoAttributes) {
				$this->Writer->endElement(); // ENDS END TAG
			} else {
				$this->Writer->endElement(); // ENDS END TAG
			}

		}

		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
}
?>