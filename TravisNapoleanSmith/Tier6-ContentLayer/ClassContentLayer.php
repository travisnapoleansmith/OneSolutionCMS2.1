<?php

class ContentLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	protected $PrintPreview;
	
	protected $DatabaseTableName;
	protected $ContentLayerDatabase;
	
	protected $ContentLayerVersionTableName;
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
		$passarray['RevisionID'] = $this->PageID['RevisionID'];
		$passarray['CurrentVersion'] = $this->PageID['CurrentVersion'];
		
		$this->LayerModule->Connect($this->ContentLayerVersionTableName);
		$this->LayerModule->pass ($this->ContentLayerVersionTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->ContentLayerVersionTableName);
		
		$this->ContentLayerVersionDatabase = $this->LayerModule->pass ($this->ContentLayerVersionTableName, 'getMultiRowField', array());
		
	}
	
	public function CreateOutput($Space) {
		if ($this->ContentLayerVersionTableName) {
			reset($this->ContentLayerDatabase);
			while (current($this->ContentLayerDatabase)) {
				$ObjectType = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['ObjectType'];
				$ObjectTypeName = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['ObjectTypeName'];
				$ObjectTypeLocation = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeLocation'];
				$ObjectTypeConfiguration = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeConfiguration'];
				$ObjectTypePrintPreview = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypePrintPreview'];
				
				$Authenticate = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['Authenticate'];
				
				$StartTag = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTag'];
				$EndTag = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['EndTag'];
				$StartTagID = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTagID'];
				$StartTagStyle = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTagStyle'];
				$StartTagClass = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTagClass'];
				
				$EnableDisable = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['Enable/Disable'];
				
				if ($EnableDisable == 'Enable') {
					if ($Authenticate == 'true') {
						if (!$_COOKIE['LoggedIn']) {
							$AuthenticationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['Authentication']['SettingAttribute'];
							
							if ($_GET['DestinationPageID']) {
								$DestinationPageID = $_GET['DestinationPageID'];
								setcookie('DestinationPageID', $DestinationPageID);
							} else {
								$PageID = $this->PageID['PageID'];
								setcookie('DestinationPageID', $PageID);
							}
							header("Location: $AuthenticationPage");
						}
					}
					
					$UserAccessGroup = $this->ContentLayerVersionDatabase[0]['UserAccessGroup'];
					$CurrentAccessGroup = $_COOKIE[$UserAccessGroup];
					if ($UserAccessGroup == 'Guest' || $UserAccessGroup == ($CurrentAccessGroup == 'Yes')) {
						if ($this->PrintPreview == FALSE || $ObjectTypePrintPreview == 'true') {
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
							
							if ($ObjectTypeConfiguration) {
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
							
							
							if ($EndTag) {
								$this->Writer->endElement(); // ENDS END TAG
							}
							
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
				next($this->ContentLayerDatabase);
				
				if (!current($this->ContentLayerDatabase)) {
					$this->Writer->endElement(); // ENDS BODY
					$this->Writer->endElement(); // ENDS HTML
				}
			}
		} else {
			array_push($this->ErrorMessage,'CreateOutput: Content Layer Version Table Name Cannot Be Null!');
		}
	}
	
	public function SessionStart($SessionName) {
		if ($_COOKIE['SessionID']) {
			$this->SessionDestroy($_COOKIE['SessionID']);
		}
		$sessionname = $SessionName;
		$sessionname .= time();
		setcookie('SessionID', $sessionname);
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
				setcookie("UserName", $username);
				setcookie("LoggedIn", TRUE, time()+3600);
				setcookie('Administrator', $UserInfo['Administrator'], time()+3600);
				setcookie('ContentCreator', $UserInfo['ContentCreator'], time()+3600);
				setcookie('Editor', $UserInfo['Editor'], time()+3600);
				setcookie('User', $UserInfo['User'], time()+3600);
				setcookie('Guest', $UserInfo['Guest'], time()+3600);
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
	
	public function Logoff() {
		setcookie("UserName", '', time()-1000);
		setcookie("LoggedIn", '', time()-1000);
		setcookie('Administrator', '', time()-1000);
		setcookie('ContentCreator', '', time()-1000);
		setcookie('Editor', '', time()-1000);
		setcookie('User', '', time()-1000);
		setcookie('Guest', '', time()-1000);
		
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
			$Keys[3] = 'UserAccessGroup';
			$Keys[4] = 'Owner';
			$Keys[5] = 'Creator';
			$Keys[6] = 'LastChangeUser';
			$Keys[7] = 'CreationDateTime';
			$Keys[8] = 'LastChangeDateTime';
			
			$this->addModuleContent($Keys, $Content, $DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'createContentVersion: Content Version and Database Table Name cannot be NULL!');
		}
	}
	
	public function updateContentVersion(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL & $DatabaseTableName != NULL) {
			$this->createDatabaseTable($DatabaseTableName);
			$this->updateModuleContent($PageID, $DatabaseTableName);
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
			$Keys[8] = 'StartTag';
			$Keys[9] = 'EndTag';
			$Keys[10] = 'StartTagID';
			$Keys[11] = 'StartTagStyle';
			$Keys[12] = 'StartTagClass';
			$Keys[13] = 'Enable/Disable';
			$Keys[14] = 'Status';
			
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