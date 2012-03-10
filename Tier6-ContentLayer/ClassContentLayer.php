<?php
/* Class Content Layer
 * 
 * Class ContentLayer is designed as the main content container for all One Solution CMS websites. This is where
 * all modules, services and add ons are used to be displayed to the end user.
 *
 * @author Travis Napolean Smith
 * @copyright Copyright (c) 1999 - 2011 One Solution CMS
 * @copyright PHP - Copyright (c) 2005 - 2011 One Solution CMS
 * @copyright C++ - Copyright (c) 1999 - 2005 One Solution CMS
 * @version PHP - 2.0
 * @version C++ - Unknown
 */ 
class ContentLayer extends LayerModulesAbstract
{
	/*
	 * Content Layer Modules
	 * 
	 * @var array
	 */
	protected $Modules;
	
	/*
	 * User settings for what is allowed to be done with the database -  set with Tier6ContentLayerSetting.php
	 * in /Configuration folder
	 * 
	 * @var array
	 */
	protected $DatabaseAllow;
	/*
	 * User setting for what is cannot be done with the database - set with Tier6ContentLayerSetting.php
	 * in /Configuration folder
	 * 
	 * @var array
	 */
	protected $DatabaseDeny;
	
	/*
	 * Print Preview array for the current page being displayed
	 * 
	 * @var array
	 */
	protected $PrintPreview;
	
	/*
	 * Current Database Table Name for Content Layer
	 * 
	 * @var string
	 */
	protected $DatabaseTableName;
	/*
	 * Current Database Table - Contains all the information retrieved from FetchDatabase
	 * 
	 * @var array
	 */
	protected $ContentLayerDatabase;
	
	/*
	 * Content Layer Version Table Name
	 * 
	 * @var string
	 */
	protected $ContentLayerVersionTableName;
	/*
	 * Content Layer Version Table - Contains all the information retrieved from FetchDatabase
	 * 
	 * @var array
	 */
	protected $ContentLayerVersionDatabase;
	
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$GLOBALS['ErrorMessage']['ContentLayer'] = array();
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['ContentLayer'];
		
		$this->DatabaseAllow = &$GLOBALS['Tier6DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier6DatabaseDeny'];
		
		$credentaillogonarray = $GLOBALS['credentaillogonarray'];
		$this->LayerModule = &new ValidationLayer();
		$this->LayerModule->setPriorLayerModule($this);
		$this->LayerModule->createDatabaseTable('ContentLayer');
		$this->LayerModule->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
		$this->LayerModule->buildModules('ValidationLayerModules', 'ValidationLayerTables', 'ValidationLayerModulesSettings');
		
		$this->PageID = $_GET['PageID'];
		
		$this->SessionName['SessionID'] = $_GET['SessionID'];
		
		$this->Writer = &$GLOBALS['Writer'];
	}
	
	public function setVersionTable($VersionTableName) {
		$this->ContentLayerVersionTableName = $VersionTableName;
	}
	
	public function setPrintPreview($PrintPreview) {
		$this->PrintPreview = $PrintPreview;
	}
	
	public function setModules() {
		
	}
	
	public function getModules($key, $key1) {
		return $this->Modules[$key][$key1];
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		
	}
	
	public function setDatabaseTableName ($databasetablename) {
		$this->DatabaseTableName = $databasetablename;
	}
	
	public function ConnectAll () {
		$this->LayerModule->ConnectAll();
	}
	
	public function Connect ($key) {
		$this->LayerModule->Connect($key);
	}
	
	public function DisconnectAll () {
		$this->LayerModule->DisconnectAll();
	}
	
	public function Disconnect ($key) {
		$this->LayerModule->Disconnect($key);
	}
	
	public function buildDatabase() {

	}
	
	public function createDatabaseTable($key) {
		$this->LayerModule->createDatabaseTable($key);
	}
	
	protected function checkPass($DatabaseTable, $function, $functionarguments) {
		reset($this->Modules);
		$hold = NULL;
		
		/*while (current($this->Modules)) {
			
			$tempobject = current($this->Modules[key($this->Modules)]);
			//$databasetables = $tempobject->getTableNames();
			//$tempobject->FetchDatabase ($this->PageID);
			//$tempobject->CreateOutput($this->Space);
			//$tempobject->getOutput();
			//$hold = $tempobject->Verify($function, $functionarguments);
			next($this->Modules);
		}*/
		
		$hold2 = $this->LayerModule->pass($DatabaseTable, $function, $functionarguments);
		if ($hold2) {
			return $hold2;
		} else {
			return FALSE;
		}
	}
	
	public function pass($databasetable, $function, $functionarguments) {
		if (!is_null($functionarguments)) {
			if (is_array($functionarguments)) {
				if (!is_null($function)) {
					if (!is_array($function)) {
						if ($this->DatabaseAllow[$function]) {
							$args = func_num_args();
							if ($args > 3) {
								$hookarguments = func_get_args(4);
								if (is_array($hookarguments)) {
									$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments, $hookargments);
								} else {
									array_push($this->ErrorMessage,'pass: Hook Arguments Must Be An Array!');
								}
							} else {
								$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments);
							}
							
							if ($hold) {
								return $hold;
							}
						} else if ($this->DatabaseDeny[$function]) {
							$args = func_num_args();
							if ($args > 3) {
								$hookarguments = func_get_args(4);
								if (is_array($hookarguments)) {
									$hold = $this->checkPass($databasetable, $function, $functionarguments, $hookargments);
								} else {
									array_push($this->ErrorMessage,'pass: Hook Arguments Must Be An Array!');
								}
							} else {
								$hold = $this->checkPass($databasetable, $function, $functionarguments);
							}
							
							if ($hold) {
								return $hold;
							} else {
								return FALSE;
							}
						} else {
							array_push($this->ErrorMessage,'pass: MySqlConnect Member Does Not Exist!');
						}
					} else {
						array_push($this->ErrorMessage,'pass: MySqlConnect Member Cannot Be An Array!');
					}
				} else {
					array_push($this->ErrorMessage,'pass: MySqlConnect Member Cannot Be Null!');
				}
			} else {
				array_push($this->ErrorMessage,'pass: Function Arguments Must Be An Array!');
			}
		} else {
			array_push($this->ErrorMessage,'pass: Function Arguments Cannot Be Null!');
		}
	}
	
	public function FetchDatabase($PageID) {
		if (!$PageID['PageID']) {
			if ($_GET['PageID']) {
				$PageID['PageID'] = $_GET['PageID'];
			} else {
				$StartID = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['StartID']['SettingAttribute'];
				$PageID['PageID'] = $StartID;
			}
		}
		
		$this->PageID = $PageID;
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->Connect($this->DatabaseTableName);
		$this->LayerModule->pass ($this->DatabaseTableName, 'setOrderbyname', array('OrderName' => 'ObjectID'));
		$this->LayerModule->pass ($this->DatabaseTableName, 'setOrderbytype', array('OrderType' => 'ASC'));
		$this->LayerModule->pass ($this->DatabaseTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->DatabaseTableName);
		
		$this->ContentLayerDatabase = $this->LayerModule->pass ($this->DatabaseTableName, 'getMultiRowField', array());
		
		$passarray = array();
		$passarray['PageID'] = $this->PageID['PageID'];
		if ($this->PageID['RevisionID']) {
			$passarray['RevisionID'] = $this->PageID['RevisionID'];
		}
		$passarray['CurrentVersion'] = $this->PageID['CurrentVersion'];
		
		$this->LayerModule->Connect($this->ContentLayerVersionTableName);
		$this->LayerModule->pass ($this->ContentLayerVersionTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->ContentLayerVersionTableName);
		
		$this->ContentLayerVersionDatabase = $this->LayerModule->pass ($this->ContentLayerVersionTableName, 'getMultiRowField', array());
		
		if (!isset($this->PageID['RevisionID'])) {
			$this->RevisionID = $this->ContentLayerVersionDatabase[0]['RevisionID'];
			$_GET['RevisionID'] = $this->RevisionID;
		}
		
	}
	
	public function CreateOutput($Space) {
		if ($this->ContentLayerVersionTableName) {
			foreach ($this->ContentLayerDatabase as $Key => $ContentLayerDatabase) {
				$PrintPreviewFlag = $ContentLayerDatabase['PrintPreview'];
				if ($this->PrintPreview == FALSE || $PrintPreviewFlag == 'true') {
					$ObjectType = $ContentLayerDatabase['ObjectType'];
					$ObjectTypeName = $ContentLayerDatabase['ObjectTypeName'];
					$ObjectTypeLocation = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeLocation'];
					if ($this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeConfiguration'] != NULL) {
						$ObjectTypeConfiguration = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
						$ObjectTypeConfiguration .= '/';
						$ObjectTypeConfiguration .= $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeConfiguration'];
					}
					$ObjectTypePrintPreview = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypePrintPreview'];
					$Authenticate = $ContentLayerDatabase['Authenticate'];
					
					$StartTag = $ContentLayerDatabase['StartTag'];
					$EndTag = $ContentLayerDatabase['EndTag'];
					$StartTagID = $ContentLayerDatabase['StartTagID'];
					$StartTagStyle = $ContentLayerDatabase['StartTagStyle'];
					$StartTagClass = $ContentLayerDatabase['StartTagClass'];
					
					$ImportFileName = $ContentLayerDatabase['ImportFileName'];
					$ImportFileType = $ContentLayerDatabase['ImportFileType'];
					
					$ObjectEnableDisable = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['Enable/Disable'];
					$EnableDisable = $ContentLayerDatabase['Enable/Disable'];
					
					if ($EnableDisable == 'Enable') {
						if ($Authenticate == 'true') {
							if (!$_COOKIE['LoggedIn']) {
								$AuthenticationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['Authentication']['SettingAttribute'];
								
								if ($_GET['DestinationPageID']) {
									$DestinationPageID = $_GET['DestinationPageID'];
									setcookie('DestinationPageID', $DestinationPageID, NULL, '/');
								} else {
									$PageID = $this->PageID['PageID'];
									setcookie('DestinationPageID', $PageID, NULL, '/');
								}
								header("Location: $AuthenticationPage");
							} else {
								$this->KeepLoggedIn();
								
							}
						}
						
						$UserAccessGroup = $this->ContentLayerVersionDatabase[0]['UserAccessGroup'];
						$CurrentAccessGroup = $_COOKIE[$UserAccessGroup];
						if ($UserAccessGroup == 'Guest' || $UserAccessGroup == ($CurrentAccessGroup == 'Yes')) {
							if ($StartTag) {
								$StartTag = str_replace('<','', $StartTag);
								$StartTag = str_replace('>','', $StartTag);
								
								$this->Writer->startElement($StartTag);
								
								if ($StartTagID) {
									$this->Writer->writeAttribute('id', $StartTagID);
								}
								
								if ($StartTagStyle) {
									$this->Writer->writeAttribute('style', $StartTagStyle);
								}
								
								if ($StartTagClass) {
									$this->Writer->writeAttribute('class', $StartTagClass);
								}
								$this->Writer->writeRaw("\n");
								
							}
							
							if ($ObjectEnableDisable == 'Enable') {
								if ($ObjectTypeConfiguration != NULL) {
									if (strstr($ObjectTypeConfiguration, '.html') || strstr($ObjectTypeConfiguration, '.htm')) {
										$file = file_get_contents($ObjectTypeConfiguration);
										$this->Writer->writeRaw($file);
									} else {
										require ("$ObjectTypeConfiguration");
									}
								} else {
									$idnumber = array();
									$idnumber['PageID'] = $this->PageID['PageID'];
									$idnumber['ObjectID'] = 1;
									$idnumber['RevisionID'] = $this->PageID['RevisionID'];
									$idnumber['CurrentVersion'] = $this->PageID['CurrentVersion'];
									$this->Modules[$ObjectType][$ObjectTypeName]->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
									$this->Modules[$ObjectType][$ObjectTypeName]->FetchDatabase ($idnumber);
									$this->Modules[$ObjectType][$ObjectTypeName]->CreateOutput('    ');
									
								}
							}
							if ($ImportFileName != NULL) {
								if ($ImportFileType == 'xml') {
									$this->processXMLFile($ImportFileName);
								}
								
								if ($ImportFileType == 'html') {
									$this->processHTMLFile($ImportFileName);
								}
							}
							
							if ($EndTag) {
								$this->Writer->endElement(); // ENDS END TAG
							}
														
							if ($ObjectType == 'XhtmlHeader') {
								$this->Writer->startElement('body');
							}
						} else {
							if (!$_COOKIE['LoggedIn']) {
								exit;
							} else {
								$DenyRedirectPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['DenyRedirect']['SettingAttribute'];
								header("Location: $DenyRedirectPage");
								exit;
							}
						}
					}
				}
			}
			
			$this->Writer->endElement(); // ENDS BODY
			$this->Writer->endElement(); // ENDS HTML
		} else {
			array_push($this->ErrorMessage,'CreateOutput: Content Layer Version Table Name Cannot Be Null!');
		}
	}
	
	private function transverseSimpleXMLAttribute (SimpleXMLElement $Attribute) {
		foreach ($Attribute->attributes() as $key => $attributes) {
			$this->Writer->writeAttribute($key, $attributes);
		}
	}

	private function transverseChildSimpleXMLToOutput(SimpleXMLElement $Child) {
		$hold = $Child->asXML();
		$hold = trim($hold);
		$hold = str_replace("\t", '    ', $hold);
		$RawText = '    ';
		$RawText .= $hold;
		$RawText .= "\n";
		$this->Writer->writeRaw($RawText);
	}
	
	public function processXMLFile($XMLFile) {
		if ($XMLFile != NULL) {
			if (file_exists($XMLFile)) {
				libxml_use_internal_errors(true);
				$Xml = simplexml_load_file($XMLFile);
				if ($Xml) {
					foreach($Xml as $child) {
						$this->transverseChildSimpleXMLToOutput($child);
					}
					$this->Writer->writeRaw('  ');
				}
			} else {
				array_push($this->ErrorMessage,'processXMLFile: XMLFile DOES NOT EXIST!');
			}
		} else {
			array_push($this->ErrorMessage,'processXMLFile: XMLFile cannot be NULL!');
		}
	}
	
	public function processHTMLFile($HTMLFile) {
		if ($HTMLFile != NULL) {
			if (file_exists($HTMLFile)) {
				libxml_use_internal_errors(true);
				$Html = simplexml_load_file($HTMLFile);
				if ($Html->body) {
					foreach($Html->body->children() as $child) {
						$this->transverseChildSimpleXMLToOutput($child);
					}
				} else if (!$Html->head) {
					$RootElement = $Html->getName();
					foreach($Html as $child) {
						$this->transverseChildSimpleXMLToOutput($child);
					}
				}
			} else {
				array_push($this->ErrorMessage,'processHTMLFile: HTMLFile DOES NOT EXIST!');
			}
		} else {
			array_push($this->ErrorMessage,'processHTMLFile: HTMLFile cannot be NULL!');
		}
	}
	
	public function SessionStart($SessionName) {
		if ($_COOKIE['SessionID']) {
			$this->SessionDestroy($_COOKIE['SessionID']);
		}
		$sessionname = $SessionName;
		$sessionname .= time();
		setcookie('SessionID', $sessionname, NULL, '/');
		session_name($sessionname);
		session_start();
		
		return $sessionname;
	}
	
	public function SessionDestroy($SessionName) {
		if ($SessionName) {
			session_name($SessionName);
			session_start();
			$_SESSION = array();
			if (ini_get('session.use_cookies')) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time()-1000,
					$params['path'], $params['domain'],
					$params['secure'], $params['httponly']
				);
			}
			session_destroy();
			
		}
	}
	
	public function PostCheck ($PostName, $FilteredInputName, array $Input) {
		if (!is_null($PostName)) {
			if (!is_null($Input)) {
				if ($_POST[$PostName] == 'Null' | $_POST[$PostName] == 'NULL') {
					if (is_null($FilteredInputName)) {
						$Input[$PostName] = NULL;
					} else {
						$_POST[$PostName] = NULL;
						$Input[$FilteredInputName][$PostName] = NULL;
					}
					
					return $Input;
				}
			} else {
				array_push($this->ErrorMessage,'PostCheck: Input cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'PostCheck: PostName cannot be NULL!');
		}
	}
	
	public function MultiPostCheck ($PostName, $StartNumber, $Input) {
		$functionarguments = func_get_args();
		$Seperator = NULL;
		$SecondStartNumber = NULL;
		$PostName2 = NULL;
		$StartNumber2 = NULL;
		$Seperator2 = NULL;
		$SecondStartNumber2 = NULL;
		
		if ($functionarguments[3]) {
			$Seperator = $functionarguments[3];
		}
		if ($functionarguments[4]) {
			$SecondStartNumber = $functionarguments[4];
			if (!is_int($SecondStartNumber)) {
				array_push($this->ErrorMessage,'MultiPostCheck: SecondStartNumber must be an integer!');
			}
		}
		
		if ($functionarguments[5]) {
			$PostName2 = $functionarguments[5];
			if (is_null($PostName2)) {
				array_push($this->ErrorMessage,'MultiPostCheck: PostName2 cannot be NULL!');
			}
		}
		if ($functionarguments[6]) {
			$StartNumber2 = $functionarguments[6];
			if (!is_int($StartNumber2)) {
				array_push($this->ErrorMessage,'MultiPostCheck: StartNumber2 must be an integer!');
			}
			
			if (is_null($StartNumber2)) {
				array_push($this->ErrorMessage,'MultiPostCheck: StartNumber2 cannot be NULL!');
			}
		}
		if ($functionarguments[7]) {
			$Seperator2 = $functionarguments[7];
			if (is_null($Seperator2)) {
				array_push($this->ErrorMessage,'MultiPostCheck: Seperator2 cannot be NULL!');
			}
		}
		if ($functionarguments[8]) {
			$SecondStartNumber2 = $functionarguments[8];
			if (is_int($SecondStartNumber2)) {
				array_push($this->ErrorMessage,'MultiPostCheck: SecondStartNumber2 must be an integer!');
			}
			
			if (is_null($SecondStartNumber2)) {
				array_push($this->ErrorMessage,'MultiPostCheck: SecondStartNumber2 cannot be NULL!');
			}
		}
		
		if (is_int($StartNumber)) {
			if (!is_null($StartNumber)) {
				if (!is_null($PostName)) {
					if (!is_null($Input)) {	
						if ($PostName2 == NULL & $StartNumber2 == NULL) {
							if (is_null($Seperator) & is_null($SecondStartNumber)) {
								$i = $StartNumber;
								$temp = $PostName;
								$temp .= $i;
								
								while (($_POST[$temp])) {
									$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
									if (!is_null($hold)) {
										$Input = $hold;
									}
									$i++;
									$temp = $PostName;
									$temp .= $i;
								}
								
								return $Input;
							} else {
								if (is_null($Seperator)) {
									array_push($this->ErrorMessage,'MultiPostCheck: Seperator cannot be NULL!');
								} else {
									if (is_null($SecondStartNumber)) {
										array_push($this->ErrorMessage,'MultiPostCheck: SecondStartNumber cannot be NULL!');
									} else {
										$i = $StartNumber;
										$j = $SecondStartNumber;
										$temp = $PostName;
										$temp .= $i;
										$temp .= $Seperator;
										$temp .= $j;
										while (($_POST[$temp])) {
											while (($_POST[$temp])) {
												$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
												if (!is_null($hold)) {
													$Input = $hold;
												}
												$j++;
												$temp = $PostName;
												$temp .= $i;
												$temp .= $Seperator;
												$temp .= $j;
											}
											$i++;
											$j = $SecondStartNumber;
											$temp = $PostName;
											$temp .= $i;
											$temp .= $Seperator;
											$temp .= $j;
										}
										
										return $Input;
									}
								}
							}
						} else {
							if ($StartNumber2 == NULL & $Seperator2 == NULL & is_null($SecondStartNumber2)) {
								if ($PostName2 != NULL) {
									$i = $StartNumber;
									$j = $SecondStartNumber;
									$temp = $PostName;
									$temp .= $i;
									$temp .= $Seperator;
									$temp .= $j;
									$temp .= $PostName2;
									while (array_key_exists($temp, $_POST)) {
										while (array_key_exists($temp, $_POST)) {
											$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
											if (!is_null($hold)) {
												$Input = $hold;
											}
											$j++;
											$temp = $PostName;
											$temp .= $i;
											$temp .= $Seperator;
											$temp .= $j;
											$temp .= $PostName2;
										}
										$i++;
										$j = $SecondStartNumber;
										$temp = $PostName;
										$temp .= $i;
										$temp .= $Seperator;
										$temp .= $j;
										$temp .= $PostName2;
									}
									return $Input;
								} 
							} else {
								if ($PostName2 != NULL & $StartNumber2 != NULL) {
									if ($Seperator != NULL & $SecondStartNumber != NULL & $Seperator2 != NULL & $SecondStartNumber2 != NULL) {
										$i = $StartNumber;
										$j = $SecondStartNumber;
										$k = $StartNumber2;
										$l = $SecondStartNumber2;
										$temp = $PostName;
										$temp .= $i;
										$temp .= $Seperator;
										$temp .= $j;
										$temp .= $PostName2;
										$temp .= $k;
										$temp .= $Seperator2;
										$temp .= $l;
										
										while (($_POST[$temp])) {
											while (($_POST[$temp])) {
												while (($_POST[$temp])) {
													while (($_POST[$temp])) {
														$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
														if (!is_null($hold)) {
															$Input = $hold;
														}
														$l++;
														$temp = $PostName;
														$temp .= $i;
														$temp .= $Seperator;
														$temp .= $j;
														$temp .= $PostName2;
														$temp .= $k;
														$temp .= $Seperator2;
														$temp .= $l;
													}
													$k++;
													$l = $SecondStartNumber2;
													$temp = $PostName;
													$temp .= $i;
													$temp .= $Seperator;
													$temp .= $j;
													$temp .= $PostName2;
													$temp .= $k;
													$temp .= $Seperator2;
													$temp .= $l;
												}
												$j++;
												$k = $StartNumber2;
												$l = $SecondStartNumber2;
												$temp = $PostName;
												$temp .= $i;
												$temp .= $Seperator;
												$temp .= $j;
												$temp .= $PostName2;
												$temp .= $k;
												$temp .= $Seperator2;
												$temp .= $l;
											}
											
											$i++;
											$j = $SecondStartNumber;
											$k = $StartNumber2;
											$l = $SecondStartNumber2;
											$temp = $PostName;
											$temp .= $i;
											$temp .= $Seperator;
											$temp .= $j;
											$temp .= $PostName2;
											$temp .= $k;
											$temp .= $Seperator2;
											$temp .= $l;
										}
										return $Input;
									} else {
										if (is_null($Seperator2) & !is_null($SecondStartNumber2)) {
											array_push($this->ErrorMessage,'MultiPostCheck: SecondStartNumber2 is set but Seperator2 cannot be NULL!');
										} else if (!is_null($Seperator2) & is_null($SecondStartNumber2)){
											array_push($this->ErrorMessage,'MultiPostCheck: Seperator2 is set but SecondStartNumber2 cannot be NULL!');
										} else {
											if (is_null($Seperator) & !is_null($SecondStartNumber)) {
												array_push($this->ErrorMessage,'MultiPostCheck: SecondStartNumber is set but Seperator cannot be NULL!');
											} else if (!is_null($Seperator) & is_null($SecondStartNumber)) {
												array_push($this->ErrorMessage,'MultiPostCheck: Seperator is set but SecondStartNumber cannot be NULL!');
											} else if (!is_null($Seperator) & !is_null($SecondStartNumber)){
												$i = $StartNumber;
												$j = $SecondStartNumber;
												$k = $StartNumber2;
												$temp = $PostName;
												$temp .= $i;
												$temp .= $Seperator;
												$temp .= $j;
												$temp .= $PostName2;
												$temp .= $k;
												
												while (($_POST[$temp])) {
													while (($_POST[$temp])) {
														while (($_POST[$temp])) {
															$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
															if (!is_null($hold)) {
																$Input = $hold;
															}
															$k++;
															$temp = $PostName;
															$temp .= $i;
															$temp .= $Seperator;
															$temp .= $j;
															$temp .= $PostName2;
															$temp .= $k;
														}
														$j++;
														$k = $StartNumber2;
														$temp = $PostName;
														$temp .= $i;
														$temp .= $Seperator;
														$temp .= $j;
														$temp .= $PostName2;
														$temp .= $k;
													}
													$i++;
													$j = $SecondStartNumber;
													$k = $StartNumber2;
													$temp = $PostName;
													$temp .= $i;
													$temp .= $Seperator;
													$temp .= $j;
													$temp .= $PostName2;
													$temp .= $k;
												}
												return $Input;
												
											} else if (!is_null($Seperator2) & !is_null($SecondStartNumber2)){
												$i = $StartNumber;
												$j = $StartNumber2;
												$k = $SecondStartNumber2;
												$temp = $PostName;
												$temp .= $i;
												$temp .= $PostName2;
												$temp .= $j;
												$temp .= $Seperator2;
												$temp .= $k;
												while (($_POST[$temp])) {
													while (($_POST[$temp])) {
														while (($_POST[$temp])) {
															$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
															if (!is_null($hold)) {
																$Input = $hold;
															}
															$k++;
															$temp = $PostName;
															$temp .= $i;
															$temp .= $PostName2;
															$temp .= $j;
															$temp .= $Seperator2;
															$temp .= $k;
														}
														$j++;
														$k = $SecondStartNumber2;
														$temp = $PostName;
														$temp .= $i;
														$temp .= $PostName2;
														$temp .= $j;
														$temp .= $Seperator2;
														$temp .= $k;
													}
													$i++;
													$j = $StartNumber2;
													$k = $SecondStartNumber2;
													$temp = $PostName;
													$temp .= $i;
													$temp .= $PostName2;
													$temp .= $j;
													$temp .= $Seperator2;
													$temp .= $k;
												}
												return $Input;
											} else {
												$i = $StartNumber;
												$j = $StartNumber2;
												$temp = $PostName;
												$temp .= $i;
												$temp .= $PostName2;
												$temp .= $j;
												while (($_POST[$temp])) {
													while (($_POST[$temp])) {
														$hold = $this->PostCheck ($temp, 'FilteredInput', $Input);
														if (!is_null($hold)) {
															$Input = $hold;
														}
														$j++;
														$temp = $PostName;
														$temp .= $i;
														$temp .= $PostName2;
														$temp .= $j;
													}
													$i++;
													$j = $StartNumber2;
													$temp = $PostName;
													$temp .= $i;
													$temp .= $PostName2;
													$temp .= $j;
												}
												
												return $Input;		
											}
										}
									}
								} else {
									array_push($this->ErrorMessage,'MultiPostCheck: StartNumber2 is set but PostName2 cannot be NULL!');
								}
							}
						}
					} else {
						array_push($this->ErrorMessage,'MultiPostCheck: Input cannot be NULL!');
					}
				} else {
					array_push($this->ErrorMessage,'MultiPostCheck: PostName cannot be NULL!');
				}
			} else {
				array_push($this->ErrorMessage,'MultiPostCheck: StartNumber cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'MultiPostCheck: StartNumber must be an integer!');
		}
	}
	
	public function EmptyStringToNullArray (array $Array) {
		foreach ($Array as $key => $value) {
			if ($value == "") {
				$Array[$key] = NULL;
			} else if (is_array($value)) {
				foreach ($value as $key2 => $value2) {
					if ($value2 == "") {
						$Array[$key][$key2] = NULL;
					}
				}
			}
		}
		return $Array;
	}
	
	public function MultiArrayBuild(array $Start, $StartKey, $ConditionalKey, $StartNumber, array $Source) {
		$functionarguments = func_get_args();
		
		$Sort = NULL;
		if ($functionarguments[5]) {
			$Sort = $functionarguments[5];
		}
		
		$EndKey = NULL;
		if ($functionarguments[6]) {
			$EndKey = $functionarguments[6];
		}
		
		if (is_null($StartKey)) {
			array_push($this->ErrorMessage,'MultiArrayBuild: RemoveKey cannot be NULL!');
		} else if (is_null($ConditionalKey)) {
			array_push($this->ErrorMessage,'MultiArrayBuild: Key cannot be NULL!');
		} else if (is_null($StartNumber)) {
			array_push($this->ErrorMessage,'MultiArrayBuild: StartNumber cannot be NULL!');
		} else {  
			$temp = array();
			$i = $StartNumber;
			if ($EndKey) {
				$SourceKey = $StartKey;
				$SourceKey .= $ConditionalKey;
				$SourceKey .= $i;
			} else {
				$SourceKey = $StartKey;
				$SourceKey .= $i;
				$SourceKey .= $ConditionalKey;
			}
			while (array_key_exists($SourceKey, $Source)) {
				if (isset($Source[$SourceKey])) {
					$SourceKeyHold = $SourceKey;
					foreach ($Start as $StartValue) {
						if ($EndKey) {
							$SourceKey = $StartKey;
							$SourceKey .= $StartValue;
							$SourceKey .= $i;
						} else {
							$SourceKey = $StartKey;
							$SourceKey .= $i;
							$SourceKey .= $StartValue;
						}
						
						if (is_null($Source[$SourceKey])) {
							unset($Source[$SourceKey]);
						} else {
							$temp[$i][$SourceKey] = $Source[$SourceKey];
							unset($Source[$SourceKey]);
						}
					}
					if (isset($Source[$SourceKeyHold])) {
						unset($Source[$SourceKeyHold]);
					}
				} else {
					$SourceKeyHold = $SourceKey;
					foreach ($Start as $StartValue) {
						if ($EndKey) {
							$SourceKey = $StartKey;
							$SourceKey .= $StartValue;
							$SourceKey .= $i;
						} else {
							$SourceKey = $StartKey;
							$SourceKey .= $i;
							$SourceKey .= $StartValue;
						}
						
						unset($Source[$SourceKey]);
					}
				}
				$i++;
				if ($EndKey) {
					$SourceKey = $StartKey;
					$SourceKey .= $ConditionalKey;
					$SourceKey .= $i;
				} else {
					$SourceKey = $StartKey;
					$SourceKey .= $i;
					$SourceKey .= $ConditionalKey;
				}
			}
			$Source = $Source + $temp;
			unset ($temp);
			if (!is_null($Sort)) {
				if (!is_array($Sort)) {
					$temp = $Source;
					$newtemp = array();
					$holdarray = array();
					
					for ($i = $StartNumber; $temp[$i]; $i++) {
						if ($EndKey) {
							$SetOrder = $StartKey;
							$SetOrder .= $Sort;
							$SetOrder .= $i;
						} else {
							$SetOrder = $StartKey;
							$SetOrder .= $i;
							$SetOrder .= $Sort;
						}

						if ($temp[$i][$SetOrder]) {
							try {
								if (is_numeric($temp[$i][$SetOrder])) {
									$index = $temp[$i][$SetOrder];
									
									if ($newtemp[$index]) {
										if ($newtemp[$i] == NULL) {
											$newtemp[$i] = $newtemp[$index];
											unset($newtemp[$index]);
										} else {
											$j = $i;
											while ($newtemp[$j]) {
												$j++;
											}
											$newtemp[$j] = $newtemp[$index];
											unset($newtemp[$index]);
										}
									}
									
									foreach ($temp[$i] as $key => $value) {
										$key = explode($StartKey, $key, 2);
										$hold = $key[0];
										$key[0] = $StartKey;
										if (is_null($EndKey)) {
											$key[0] .= $hold;
											$key[0] .= $index;
											$key[1] = preg_replace('([0-9]+)', '', $key[1], 1);
										} else {
											preg_match('([0-9]+)', $key[1], $oldindex);
											$oldindex = $oldindex[0];
											$key[1] = str_replace($oldindex, $index, $key[1]);
										}
										$key = implode($key);
										$newtemp[$index][$key] = $value;
									}
									unset($temp[$i]);
									unset($Source[$i]);
								} else {
									array_push($this->ErrorMessage,"MultiArrayBuild: Array Sort Order from index - $i key - $SetOrder MUST BE AN INTEGER!");
									throw new Exception("FATAL ERROR: MultiArrayBuild: Array Sort Order from index - $i key - $SetOrder MUST BE AN INTEGER!");
								}
							} catch (Exception $e) {
								print $e->getMessage();
								print "\n";
								return NULL;
							}
							
						} else if ($temp[$i]) {
							$temp[$i][$SetOrder] = NULL;
							array_push($holdarray, $temp[$i]);
							unset($temp[$i]);
							unset($Source[$i]);
						}
					}
					
					if ($holdarray) {
						foreach ($holdarray as $key => $values) {
							array_push($newtemp, $values);
						}
						unset($holdarray);
					}
					
					$holdarray = array();
					
					ksort($newtemp);
					$newtemp = array_merge($newtemp);
					
					//$newtemp = array_combine(range($StartNumber, count($newtemp)), array_values($newtemp));
					foreach ($newtemp as $key => $value) {
						if ($EndKey) {
							$SetOrder = $StartKey;
							$SetOrder .= $Sort;
							$SetOrder .= $key;
						} else {
							$SetOrder = $StartKey;
							$SetOrder .= $key;
							$SetOrder .= $Sort;
						}
						if (isset($key)) {
							$newkey = $key;
							$newkey++;
							$holdarray[$newkey] = $value;
							
							unset($newtemp[$key]);
							
						}
					}
					$newtemp = $newtemp + $holdarray;
					foreach ($newtemp as $key => $value) {
						if ($EndKey) {
							$SetOrder = $StartKey;
							$SetOrder .= $Sort;
							$SetOrder .= $key;
						} else {
							$SetOrder = $StartKey;
							$SetOrder .= $key;
							$SetOrder .= $Sort;
						}
						
						if ($key != $value[$SetOrder]) {
							foreach($value as $key2 => $value2) {
								preg_match('([0-9]+)', $key2, $oldcount);
								$oldcount = $oldcount[0];

								$replace = $StartKey;
								$replace .= $oldcount;
								$replacement = $StartKey;
								$replacement .= $key;
								
								$key3 = str_replace($replace, $replacement, $key2);
								if ($key2 != $key3) {
									$newtemp[$key][$key3] = $newtemp[$key][$key2];
									unset($newtemp[$key][$key2]);
								}
							}
						}
					}
					
					foreach ($newtemp as $key => $value) {
						if ($EndKey) {
							$SetOrder = $StartKey;
							$SetOrder .= $Sort;
							$SetOrder .= $key;
						} else {
							$SetOrder = $StartKey;
							$SetOrder .= $key;
							$SetOrder .= $Sort;
						}
						if (isset($value[$SetOrder])) {
							$newtemp[$key][$SetOrder] = NULL;
						}
					}
					
					$Source = $Source + $newtemp;
					unset($newtemp);
					unset($temp);
					
				} else {
					array_push($this->ErrorMessage,'MultiArrayBuild: Sort cannot be an ARRAY!');
				}
			}
			
			return $Source;
		}
		
	}
	
	public function MultiArrayCombine($StartNumber, array $Source) {
		if ($StartNumber != NULL) {
			try {
				if (is_numeric($StartNumber)) {
					for ($i = $StartNumber; $Source[$i]; $i++) {
						foreach ($Source[$i] as $key => $value) {
							if (is_numeric($key)) {
								$hold = $this->MultiArrayCombine($StartNumber, $value);
								if ($hold) {
									$Source = $Source + $hold;
								}
							} else {
								$Source[$key] = $value;
							}
							unset($Source[$i][$key]);
						}
						unset($Source[$i]);
					}
					return $Source;
					
				} else {
					array_push($this->ErrorMessage,"MultiArrayCombine: StartNumber MUST BE AN INTEGER!");
					throw new Exception("FATAL ERROR: MultiArrayCombine: StartNumber MUST BE AN INTEGER!");
				}
			} catch (Exception $e){
				print $e->getMessage();
				print "\n";
				return NULL;
			} 
		} else {
			array_push($this->ErrorMessage,'MultiArrayCombine: StartNumber MUST be set!');
		}
	}
	
	public function Login() {
		$sessionname = $this->SessionStart('UserAuthentication');
		
		$loginidnumber = Array();
		$loginidnumber['PageID'] = $_POST['Login'];
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$DestinationPageID = NULL;
		if ($_GET['DestinationPageID']) {
			$DestinationPageID = $_GET['DestinationPageID'];
		}
		
		$AuthenticationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['Authentication']['SettingAttribute'];
		
		$this->LayerModule->setPageID($loginidnumber['PageID']);
		$hold = $this->LayerModule->pass('FormValidation', 'FORM', $_POST);
		if ($hold['Error']) {
			$_SESSION['POST'] = $hold;
			header("Location: $AuthenticationPage&SessionID=$sessionname");
		} else {
			$hold = NULL;
			$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST);
			if ($hold['Error']) {
				$_SESSION['POST'] = $hold;
				header("Location: $AuthenticationPage&SessionID=$sessionname");
			} else {
				$passarray = array();
				$passarray['getUserInfo'] = array(array());
				$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
				$UserInfo = $hold['getUserInfo']['UserAccounts'][0];
				unset($UserInfo['Password']);
				unset($UserInfo['Salt']);

				$username = $_POST['UserName'];
				setcookie("UserName", $username, NULL, '/');
				setcookie("LoggedIn", TRUE, time()+3600, '/');
				setcookie('Administrator', $UserInfo['Administrator'], time()+3600, '/');
				setcookie('ContentCreator', $UserInfo['ContentCreator'], time()+3600, '/');
				setcookie('Editor', $UserInfo['Editor'], time()+3600, '/');
				setcookie('User', $UserInfo['User'], time()+3600, '/');
				setcookie('Guest', $UserInfo['Guest'], time()+3600, '/');
				if ($DestinationPageID) {
					header("Location: index.php?PageID=$DestinationPageID");
					exit;
				} else {
					header("Location: index.php");
					exit;
				}
			}
		}
	}
	
	public function KeepLoggedIn() {
		if ($_COOKIE['LoggedIn']) {
			setcookie("LoggedIn", TRUE, time()+3600, '/');
		}	
	}
	
	public function Logoff() {
		setcookie("UserName", '', time()-1000, '/');
		setcookie("LoggedIn", '', time()-1000, '/');
		setcookie('Administrator', '', time()-1000, '/');
		setcookie('ContentCreator', '', time()-1000, '/');
		setcookie('Editor', '', time()-1000, '/');
		setcookie('User', '', time()-1000, '/');
		setcookie('Guest', '', time()-1000, '/');
		
		$DestinationPageID = NULL;
		if ($_GET['DestinationPageID']) {
			$DestinationPageID = $_GET['DestinationPageID'];
		}
		
		if ($DestinationPageID) {
			header("Location: index.php?PageID=$DestinationPageID");
			exit;
		} else {
			$AuthenticationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['Authentication']['SettingAttribute'];
			header("Location: $AuthenticationPage");
			exit;
		}
	}
	
	public function Register() {
		$sessionname = $this->SessionStart('UserRegistration');
		
		$loginidnumber = Array();
		$loginidnumber['PageID'] = $_POST['Register'];
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$RegisterPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['Register']['SettingAttribute'];
		
		$this->LayerModule->setPageID($loginidnumber['PageID']);
		$hold = $this->LayerModule->pass('FormValidation', 'FORM', $_POST);
		
		if ($hold['Error']) {
			$_SESSION['POST'] = $hold;
			header("Location: $RegisterPage&SessionID=$sessionname");
		} else {
			$hold = NULL;
			$passarray = array();
			$passarray['checkUserName'] = $_POST['UserName'];
			$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
			if ($hold['checkUserName']) {
				$hold['Error']['UserName'] = 'User Name already exists, please try again!';
				$_SESSION['POST'] = $hold;
				header("Location: $RegisterPage&SessionID=$sessionname");
				exit;
			} else {
				$hold = array();
				$PasswordCreationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordCreation']['SettingAttribute'];
				$EmailVerificationLocation = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['EmailVerificationLocation']['SettingAttribute'];
				
				$location = $EmailVerificationLocation;
				$location .= $PasswordCreationPage;
				
				$passarray = array();
				$passarray['createUserAccount'] = array('UserName' => $_POST['UserName'], 'EmailAddress' => $_POST['Email']);
				$passarray['generateNewUserEmail'] = array('EmailAddress' => $_POST['Email'], 'Location' => $location);
				$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
				if ($hold['Error']) {
					$_SESSION['POST'] = $hold;
					header("Location: $RegisterPage&SessionID=$sessionname");
					exit;
				} else {
					//$this->SessionDestroy($sessionname);
					$RegisterRedirectPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['RegisterRedirect']['SettingAttribute'];
					header("Location: $RegisterRedirectPage");
					exit;
				}
			}
			
		}
	}
	
	public function NewUserChangePassword() {
		$sessionname = $this->SessionStart('PasswordCreation');
		
		$loginidnumber = Array();
		$loginidnumber['PageID'] = $_POST['PasswordCreation'];
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$PasswordCreationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordCreation']['SettingAttribute'];
		$PasswordChangedPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordChanged']['SettingAttribute'];
		$this->LayerModule->setPageID($loginidnumber['PageID']);
		$hold = $this->LayerModule->pass('FormValidation', 'FORM', $_POST);
		
		if ($hold['Error']) {
			$_SESSION['POST'] = $hold;
			header("Location: $PasswordCreationPage&SessionID=$sessionname");
			exit;
		} else {
			$hold = array();
			$passarray = array();
			$passarray['createNewUserPassword'] = array('UserName' => $_POST['UserName'], 'Password' => $_POST['Password'], 'UserCode' => $_POST['UserCode']);
			$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
			if ($hold['Error']) {
				$_SESSION['POST'] = $hold;
				header("Location: $PasswordCreationPage&SessionID=$sessionname");
				exit;
			} else {
				$this->SessionDestroy($sessionname);
				header("Location: $PasswordChangedPage");
				exit;
			}
		}		
	}
	
	public function ChangePassword() {
		
	}
	
	public function ResetPassword() {
		$sessionname = $this->SessionStart('PasswordReset');
		
		$loginidnumber = Array();
		$loginidnumber['PageID'] = $_POST['PasswordReset'];
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$EmailVerificationLocation = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['EmailVerificationLocation']['SettingAttribute'];
		$PasswordResetPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordReset']['SettingAttribute'];
		$PasswordResetChangePage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordResetChange']['SettingAttribute'];
		$PasswordResetLocationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordResetLocation']['SettingAttribute'];
		
		$this->LayerModule->setPageID($loginidnumber['PageID']);
		$hold = $this->LayerModule->pass('FormValidation', 'FORM', $_POST);
		
		if ($hold['Error']) {
			$_SESSION['POST'] = $hold;
			header("Location: $PasswordResetPage&SessionID=$sessionname");
			exit;
		} else {
			$hold = array();
			
			$location = $EmailVerificationLocation;
			$location .= $PasswordResetLocationPage;
				
			$passarray = array();
			$passarray['resetUserPassword'] = array('UserName' => $_POST['UserName'], 'Email' => $_POST['Email'], 'Location' => $location);
			$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
			
			if ($hold['Error']) {
				$_SESSION['POST'] = $hold;
				header("Location: $PasswordResetPage&SessionID=$sessionname");
				exit;
			} else {
				$this->SessionDestroy($sessionname);
				header("Location: $PasswordResetChangePage");
				exit;
			}
		}
	}
	
	public function ChangeResetPassword() {
		$sessionname = $this->SessionStart('PasswordResetChange');
		
		$loginidnumber = Array();
		$loginidnumber['PageID'] = $_POST['PasswordResetChange'];
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$PasswordResetChangePage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordResetChangePage']['SettingAttribute'];
		$PasswordResetLocation = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['PasswordResetLocation']['SettingAttribute'];
		$this->LayerModule->setPageID($loginidnumber['PageID']);
		$hold = $this->LayerModule->pass('FormValidation', 'FORM', $_POST);
		
		if ($hold['Error']) {
			$_SESSION['POST'] = $hold;
			header("Location: $PasswordResetLocation&SessionID=$sessionname");
			exit;
		} else {
			$hold = array();
			$passarray = array();
			$passarray['changeUserPassword'] = array('UserName' => $_POST['UserName'], 'Password' => $_POST['Password'], 'UserCode' => $_POST['UserCode']);
			$hold = $this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
			if ($hold['Error']) {
				$_SESSION['POST'] = $hold;
				header("Location: $PasswordResetLocation&SessionID=$sessionname");
				exit;
			} else {
				$this->SessionDestroy($sessionname);
				header("Location: $PasswordResetChangePage");
				exit;
			}
		}		
		
	}
	
	public function FormSubmitValidate($SessionName, $PageName) {
		$sessionname = $this->SessionStart($SessionName);
		$loginidnumber = Array();
		$loginidnumber['PageID'] = $_POST[$SessionName];
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}

		$this->LayerModule->setPageID($loginidnumber['PageID']);
		
		$hold = $this->LayerModule->pass('FormValidation', 'FORM', $_POST);
		
		if ($hold['FilteredInput']['Priority']) {
			$hold['FilteredInput']['Priority'] *= 10;
		}
		
		if ($hold['FilteredInput']['Frequency']) {
			$hold['FilteredInput']['Frequency'] = ucfirst($hold['FilteredInput']['Frequency']);
		}
		
		if ($hold['Error']) {
			$_SESSION['POST'] = $hold;
			header("Location: $PageName&SessionID=$sessionname");
			exit;
		} else {
			if ($hold) {
				return $hold;
			} else {
				return FALSE;
			}
		}
	}
	
	public function FormSubmit($SessionName, $PageName, $ObjectType, $Function, array $Arguments) {
		
	}
	
	public function ModulePass($ModuleType, $ModuleName, $Function, array $Arguments) {
		if ($ModuleType != NULL && $ModuleName != NULL && $Function != NULL) {
			$PassArguments = array();
			$PassArguments[0] = $Arguments;
			$hold = call_user_func_array(array($this->Modules[$ModuleType][$ModuleName], $Function), $PassArguments);
			if ($hold) {
				return $hold;
			}
		}
	}
	
	public function LayerModulePass($Function, array $Arguments) {
		if ($Function != NULL) {
			$PassArguments = array();
			$PassArguments[0] = $Arguments;
			$hold = call_user_func_array(array($this->LayerModule, $Function), $PassArguments);
			if ($hold) {
				return $hold;
			}
		}
	}
	
	public function getContentVersionRow(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'setDatabaseRow', array('idnumber' => $PageID));
			$this->LayerModule->Disconnect($DatabaseTableName);
			
			$hold = $this->LayerModule->pass ($DatabaseTableName, 'getMultiRowField', array());
			return $hold;
		} else {
			array_push($this->ErrorMessage,'getContentVersionRow: PageID and Database Table Name cannot be NULL!');
		}
	}
	
	public function createContentVersion(array $Content, $DatabaseTableName) {
		if ($Content != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'RevisionID';
			$Keys[2] = 'CurrentVersion';
			$Keys[3] = 'ContentPageType';
			$Keys[4] = 'ContentPageMenuName';
			$Keys[5] = 'ContentPageMenuTitle';
			$Keys[6] = 'ContentPageMenuObjectID';
			$Keys[7] = 'UserAccessGroup';
			$Keys[8] = 'Owner';
			$Keys[9] = 'Creator';
			$Keys[10] = 'LastChangeUser';
			$Keys[11] = 'CreationDateTime';
			$Keys[12] = 'LastChangeDateTime';
			$Keys[13] = 'PublishDate';
			$Keys[14] = 'UnpublishDate';
			
			$this->addModuleContent($Keys, $Content, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'createContentVersion: Content Version and Database Table Name cannot be NULL!');
		}
	}
	
	public function updateContentVersion(array $PageID, $DatabaseTableName) {
		$arguments = func_get_args();
		$Data = $arguments[2];
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			if ($Data != NULL) {
				$this->updateModuleContent($PageID, $DatabaseTableName, $Data);
			} else {
				$this->updateModuleContent($PageID, $DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateContentVersion: PageID and Database Table Name cannot be NULL!');
		}
	}
	
	public function updateContentVersionStatus(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $DatabaseTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateContentVersionStatus: PageID and Database Table Name cannot be NULL!');
		}
	}
	
	public function deleteContentVersion(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$this->deleteModuleContent($PageID, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'deleteContentVersion: PageID and Database Table Name cannot be NULL!');
		}
	}
	
	public function createContent(array $Content, $DatabaseTableName) {
		if ($Content != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'ObjectType';
			$Keys[3] = 'ObjectTypeName';
			$Keys[4] = 'ContainerObjectID';
			$Keys[5] = 'RevisionID';
			$Keys[6] = 'CurrentVersion';
			$Keys[7] = 'Authenticate';
			$Keys[8] = 'PrintPreview';
			$Keys[9] = 'StartTag';
			$Keys[10] = 'EndTag';
			$Keys[11] = 'StartTagID';
			$Keys[12] = 'StartTagStyle';
			$Keys[13] = 'StartTagClass';
			$Keys[14] = 'ImportFileName';
			$Keys[15] = 'ImportFileType';
			$Keys[16] = 'Enable/Disable';
			$Keys[17] = 'Status';
			
			$this->addModuleContent($Keys, $Content, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'createContent: Content Version and Database Table Name cannot be NULL!');
		}
	}
	
	public function updateContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$this->updateModuleContent($PageID, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'updateContent: PageID and Database Table Name cannot be NULL!');
		}
	}
	
	public function updateContentStatus(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $DatabaseTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $DatabaseTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateContentStatus: PageID and Database Table Name cannot be NULL!');
		}
	}
	
	public function deleteContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$this->deleteModuleContent($PageID, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'deleteContent: PageID and Database Table Name cannot be NULL!');
		}
	}
		
}

?>