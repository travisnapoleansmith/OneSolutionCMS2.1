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

class XhtmlNews extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $NewsButtonsTableName;
	protected $NewsStoriesTableName;
	protected $ContentLayerTablesName;

	protected $ContainerObjectType;
	protected $ContainerObjectID;
	protected $RevisionID;
	protected $CurrentVersion;
	protected $Empty;

	protected $Heading;
	protected $HeadingStartTag;
	protected $HeadingEndTag;
	protected $HeadingStartTagID;
	protected $HeadingStartTagClass;
	protected $HeadingStartTagStyle;

	protected $Content;
	protected $ContentStartTag;
	protected $ContentEndTag;
	protected $ContentStartTagID;
	protected $ContentStartTagClass;
	protected $ContentStartTagStyle;

	protected $News;

	protected $NewsButtonsRowCount;

	/**
	 * Create an instance of XtmlNews
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlNews'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlNews'][$hold];
		$this->ErrorMessage = array();

		$this->NewsButtonsTableName = current($TableNames);
		$this->NewsStoriesTableName = next($TableNames);
		$this->ContentLayerTablesName = next($TableNames);
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

	public function getNewsButtonsRowCount() {
		return $this->NewsButtonsRowCount;
	}

	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);

		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = &$PageID;
		$this->LayerModule->pass ($this->DatabaseTable, 'setEntireTable', array());
		$this->NewsButtonsRowCount = $this->LayerModule->pass ($this->DatabaseTable, 'getRowCount', array());
		$this->LayerModule->Disconnect($this->DatabaseTable);

		$this->NewsButtonsRowCount = $this->LayerModule->pass ($this->DatabaseTable, 'getTable', array('rownumber' => $this->NewsButtonsRowCount, 'rowcolumn' => 'PageID'));

		if ($PageID['PageID'] == NULL) {
			$this->PageID = $this->NewsButtonsRowCount;
			$PageID['PageID'] = $this->NewsButtonsRowCount;
		} else {
			$this->PageID = $PageID['PageID'];
		}
		$this->ObjectID = $PageID['ObjectID'];

		$this->LayerModule->Connect($this->DatabaseTable);
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));

		$this->ContainerObjectType = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectType'));
	    $this->ContainerObjectID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContainerObjectID'));
	    $this->RevisionID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'RevisionID'));
	    $this->CurrentVersion = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'CurrentVersion'));
	    $this->Empty = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Empty'));

		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));

		$this->Heading = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Heading'));
		$this->HeadingStartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTag'));
		$this->HeadingEndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingEndTag'));
		$this->HeadingStartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagID'));
		$this->HeadingStartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagClass'));
		$this->HeadingStartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'HeadingStartTagStyle'));

		$this->Content = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Content'));
		$this->ContentStartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTag'));
		$this->ContentEndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentEndTag'));
		$this->ContentStartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagID'));
		$this->ContentStartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagClass'));
		$this->ContentStartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'ContentStartTagStyle'));

		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));

		$this->LayerModule->Disconnect($this->DatabaseTable);

	}
	// MAKE THIS WORK WITH XHTMLCONTENT's WORDWRAP!
	protected function CreateWordWrap($wordwrapstring) {
		if (stristr($wordwrapstring, '<a href')) {
			// Strip AHef Tags for wordwrap then put them back in
			$firstpos = strpos($wordwrapstring, '<a href');
			$lastpos = strpos($wordwrapstring, '</a>');
			$lastpos = $lastpos + 3;

			// Split a string into an array - character by character
			$newwordwrapstring = Array();
			$j = 0;
			$end = strlen($wordwrapstring);
			while ($j <= $end) {
				array_push ($newwordwrapstring, $wordwrapstring[$j]);
				$j++;
			}

			$j = $firstpos;
			while ($j <= $lastpos) {
				$endstring .= $newwordwrapstring[$j];
				$j++;
			}

			$returnstring = $endstring;
			$returnstring = str_replace (' ', '<SPACE>', $returnstring);
			$wordwrapstring = str_replace ($endstring, $returnstring, $wordwrapstring);
			// END STRIP AHREF TAG FOR WORDWRAP

			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);

		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
		}
		return $wordwrapstring;
	}

	public function CreateOutput($space) {
		$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->StartTag){
				if ($this->StartTagID) {
					$temp = strrpos($this->StartTag, '>');
					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'id="';
					$this->StartTag .= $this->StartTagID;
					$this->StartTag .= '"';

					if ($this->StartTagStyle) {
						$this->StartTag .= ' style="';
						$this->StartTag .= $this->StartTagStyle;
						$this->StartTag .= '"';
					}
					if ($this->StartTagClass) {
						$this->StartTag .= ' class="';
						$this->StartTag .= $this->StartTagClass;
						$this->StartTag .= '"';
						$this->StartTag .= ">\n";
					} else {
						$this->StartTag .= ">\n";
					}
					$this->News .= $this->StartTag;
				} else if ($this->StartTagClass){
					$temp = strrpos($this->StartTag, '>');
					$this->StartTag[$temp] = ' ';

					if ($this->StartTagStyle) {
						$this->StartTag .= 'style="';
						$this->StartTag .= $this->StartTagStyle;
						$this->StartTag .= '" ';
					}

					$this->StartTag .= 'class="';
					$this->StartTag .= $this->StartTagClass;
					$this->StartTag .= '"';
					$this->StartTag .= ">\n";

					$this->News .= $this->StartTag;
				} else {
					$temp = strrpos($this->StartTag, '>');

					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'style="';
					$this->StartTag .= $this->StartTagStyle;
					$this->StartTag .= '"';
					$this->StartTag .= ">\n";

					$this->News .= $this->StartTag;
					$this->News .= "\n";
				}
			}

			if ($this->HeadingStartTag){
				if ($this->HeadingStartTagID) {
					$temp = strrpos($this->HeadingStartTag, '>');
					$this->HeadingStartTag[$temp] = ' ';
					$this->HeadingStartTag .= 'id="';
					$this->HeadingStartTag .= $this->HeadingStartTagID;
					$this->HeadingStartTag .= '"';

					if ($this->HeadingStartTagStyle) {
						$this->HeadingStartTag .= ' style="';
						$this->HeadingStartTag .= $this->HeadingStartTagStyle;
						$this->HeadingStartTag .= '"';
					}
					if ($this->HeadingStartTagClass) {
						$this->HeadingStartTag .= ' class="';
						$this->HeadingStartTag .= $this->HeadingStartTagClass;
						$this->HeadingStartTag .= '"';
						$this->HeadingStartTag .= ">\n";
					} else {
						$this->HeadingStartTag .= ">\n";
					}
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->HeadingStartTag;

					if ($this->Heading) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->News .= $this->Heading;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Heading;
							$this->News .= "\n";
						}
					}

				} else if ($this->HeadingStartTagClass){
					$temp = strrpos($this->HeadingStartTag, '>');
					$this->HeadingStartTag[$temp] = ' ';

					if ($this->HeadingStartTagStyle) {
						$this->HeadingStartTag .= 'style="';
						$this->HeadingStartTag .= $this->HeadingStartTagStyle;
						$this->HeadingStartTag .= '" ';
					}

					$this->HeadingStartTag .= 'class="';
					$this->HeadingStartTag .= $this->HeadingStartTagClass;
					$this->HeadingStartTag .= '"';
					$this->HeadingStartTag .= ">\n";
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->HeadingStartTag;

					if ($this->Heading) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->News .= $this->Heading;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Heading;
							$this->News .= "\n";
						}
					}
				} else {
					$temp = strrpos($this->HeadingStartTag, '>');

					$this->HeadingStartTag[$temp] = ' ';
					$this->HeadingStartTag .= 'style="';
					$this->HeadingStartTag .= $this->HeadingStartTagStyle;
					$this->HeadingStartTag .= '"';
					$this->HeadingStartTag .= ">\n";

					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->HeadingStartTag;

					if ($this->Heading) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->News .= $this->Heading;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Heading;
							$this->News .= "\n";
						}
					}
					$this->News .= "\n";
				}
			}

			if ($this->HeadingEndTag) {
				if($this->Space) {
					$this->News .= $this->Space;
				} else {
					$this->News .= '  ';
				}
				$this->News .= $this->HeadingEndTag;
				$this->News .= "\n";
			}

			if ($this->ContentStartTag){
				if ($this->ContentStartTagID) {
					$temp = strrpos($this->ContentStartTag, '>');
					$this->ContentStartTag[$temp] = ' ';
					$this->ContentStartTag .= 'id="';
					$this->ContentStartTag .= $this->ContentStartTagID;
					$this->ContentStartTag .= '"';

					if ($this->ContentStartTagStyle) {
						$this->ContentStartTag .= ' style="';
						$this->ContentStartTag .= $this->ContentStartTagStyle;
						$this->ContentStartTag .= '"';
					}
					if ($this->ContentStartTagClass) {
						$this->ContentStartTag .= ' class="';
						$this->ContentStartTag .= $this->ContentStartTagClass;
						$this->ContentStartTag .= '"';
						$this->ContentStartTag .= ">\n";
					} else {
						$this->ContentStartTag .= ">\n";
					}
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->ContentStartTag;

					if ($this->Content) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->News .= $this->Content;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Content;
							$this->News .= "\n";
						}
					}

				} else if ($this->ContentStartTagClass){
					$temp = strrpos($this->ContentStartTag, '>');
					$this->ContentStartTag[$temp] = ' ';

					if ($this->ContentStartTagStyle) {
						$this->ContentStartTag .= 'style="';
						$this->ContentStartTag .= $this->ContentStartTagStyle;
						$this->ContentStartTag .= '" ';
					}

					$this->ContentStartTag .= 'class="';
					$this->ContentStartTag .= $this->ContentStartTagClass;
					$this->ContentStartTag .= '"';
					$this->ContentStartTag .= ">\n";
					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->ContentStartTag;

					if ($this->Content) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->News .= $this->Content;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Content;
							$this->News .= "\n";
						}
					}
				} else {
					$temp = strrpos($this->ContentStartTag, '>');

					$this->ContentStartTag[$temp] = ' ';
					$this->ContentStartTag .= 'style="';
					$this->ContentStartTag .= $this->ContentStartTagStyle;
					$this->ContentStartTag .= '"';
					$this->ContentStartTag .= ">\n";

					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $this->ContentStartTag;

					if ($this->Content) {
						if($this->Space) {
							$this->News .= $this->Space;
							$this->News .= $this->Space;
							$this->Content = $this->CreateWordWrap($this->Content);
							$this->News .= $this->Content;
							$this->News .= "\n";
						} else {
							$this->News .= '  ';
							$this->News .= $this->Content;
							$this->News .= "\n";
						}
					}
					$this->News .= "\n";
				}
			}

			if ($this->ContentEndTag) {
				if($this->Space) {
					$this->News .= $this->Space;
				} else {
					$this->News .= '  ';
				}
				$this->News .= $this->ContentEndTag;
				$this->News .= "\n";
			}

			if ($this->EndTag) {
				$this->News .= "  ";
				$this->News .= $this->EndTag;
				$this->News .= "\n";
			}
		}

		if ($this->ContainerObjectType) {
			if ($this->ContainerObjectType == 'XhtmlNews') {
				if ($this->ContainerObjectID) {
					$newsidnumber = Array();
					$newsidnumber['PageID'] = $this->PageID;
					$newsidnumber['ObjectID'] = $this->ContainerObjectID;

					$newsdatabase = Array();
					$newsdatabase[$this->NewsButtonsTableName] = $this->NewsButtonsTableName;
					$newsdatabase[$this->NewsStoriesTableName] = $this->NewsStoriesTableName;
					$newsdatabase[$this->ContentLayerTablesName] = $this->ContentLayerTablesName;

					$databaseoptions = Array();

					$news = new XhtmlNews($newsdatabase, $databaseoptions, $this->LayerModule);
					$news->setHttpUserAgent($this->HttpUserAgent);
					$news->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTable);
					$news->FetchDatabase ($newsidnumber);
					$news->CreateOutput($this->Space);

					if ($this->Space) {
						$this->News .= $this->Space;
					}
					$this->News .= $news->getOutput();
				}
			} else {
				if ($this->ContainerObjectID != NULL) {
					$modulesidnumber = Array();
					$modulesidnumber['PageID'] = 100000;
					$modulesidnumber['ObjectID'] = $this->ContainerObjectID;

					$ContentLayerTableArray = Array();
					$ContentLayerTableArray['ObjectType'] = $this->ContainerObjectType;
					$this->LayerModule->setDatabaseAll ($this->hostname, $this->user, $this->password, $this->databasename, $this->ContentLayerTablesName);
					$this->LayerModule->Connect();
					$this->LayerModule->setDatabaseRow($ContentLayerTableArray);

					$hold = 'DatabaseTable';
					$i = 1;
					$databasetablename = Array();
					$hold .= $i;
					while ($this->LayerModule->getRowField($hold)) {
						array_push($databasetablename, $this->LayerModule->getRowField($hold));
						$i++;
						$hold = 'DatabaseTable';
						$hold .= $i;
					}

					$filearray = $this->buildModules('Modules/Tier6ContentLayer/', TRUE);
					$modulesfile = NULL;
					$modulesfile = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
					$modulesfile .= '/';
					$modulesfile .= $filearray[$this->ContainerObjectType];
					if ($modulesfile) {
						require_once($modulesfile);

						$modulesdatabase = Array();
						while (current($databasetablename)) {
							$modulesdatabase[current($databasetablename)] = &new ProtectionLayer();
							next($databasetablename);
						}
						$databaseoptions = Array();
						$module = new $this->ContainerObjectType($modulesdatabase, $databaseoptions, $this->LayerModule);
						reset($databasetablename);
						$module->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($databasetablename));
						$module->setHttpUserAgent($this->HttpUserAgent);
						$module->FetchDatabase($modulesidnumber);
						$module->CreateOutput('    ');

						$this->News = $module->getOutput();
					}

				}
			}
		}
	}

	public function getOutput() {
		return $this->News;
	}
}
?>