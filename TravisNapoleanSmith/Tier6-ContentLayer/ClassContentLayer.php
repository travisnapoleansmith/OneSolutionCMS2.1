<?php

class ContentLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	protected $PrintPreview;
	
	protected $DatabaseTableName;
	protected $ContentLayerDatabase;
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$GLOBALS['ErrorMessage']['ContentLayer'] = array();
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['ContentLayer'];
		
		$this->DatabaseAllow = &$GLOBALS['Tier6DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier6DatabaseDeny'];
		$this->LayerModule = &$GLOBALS['Tier5Databases'];
		
		$this->Layers['Tier5Databases'] = &$GLOBALS['Tier5Databases'];
		$this->Layers['Tier4Databases'] = &$GLOBALS['Tier4Databases'];
		$this->Layers['Tier3Databases'] = &$GLOBALS['Tier3Databases'];
		$this->Layers['Tier2Databases'] = &$GLOBALS['Tier2Databases'];
		
		$this->PageID = $_GET['PageID'];
		
		$this->SessionName['SessionID'] = $_GET['SessionID'];
		
		$this->Writer = &$GLOBALS['Writer'];
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
		
		while (current($this->Modules)) {
			$tempobject = current($this->Modules[key($this->Modules)]);
			$databasetables = $tempobject->getTableNames();
			$tempobject->FetchDatabase ($this->PageID);
			$tempobject->CreateOutput($this->Space);
			$tempobject->getOutput();
			//$hold = $tempobject->Verify($function, $functionarguments);
			next($this->Modules);
		}
		
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
	}
	
	public function CreateOutput($Space) {
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
			}
			next($this->ContentLayerDatabase);

			if (!current($this->ContentLayerDatabase)) {
				$this->Writer->endElement(); // ENDS BODY
				$this->Writer->endElement(); // ENDS HTML
			}
		}
	}
	
	protected function SessionStart($SessionName) {
		/*if ($_COOKIE['SessionID']) {
			session_name($_COOKIE['SessionID']);
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
		}*/
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
	
	protected function SessionDestroy($SessionName) {
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
		/*if ($_COOKIE['SessionID']) {
			session_name($_COOKIE['SessionID']);
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
		
		$sessionname = 'UserAuthentication';
		$sessionname .= time();
		setcookie('SessionID', $sessionname);
		session_name($sessionname);
		session_start();
		*/
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
				$username = $_POST['UserName'];
				setcookie("UserName", $username);
				setcookie("LoggedIn", TRUE, time()+3600);
				if ($DestinationPageID) {
					header("Location: index.php?PageID=$DestinationPageID");
				} else {
					header("Location: index.php");
				}
			}
		}
	}
	
	public function Logoff() {
		setcookie("UserName", '', time()-1000);
		setcookie("LoggedIn", '', time()-1000);
		
		$DestinationPageID = NULL;
		if ($_GET['DestinationPageID']) {
			$DestinationPageID = $_GET['DestinationPageID'];
		}
		
		if ($DestinationPageID) {
			header("Location: index.php?PageID=$DestinationPageID");
		} else {
			$AuthenticationPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['Authentication']['SettingAttribute'];
			header("Location: $AuthenticationPage");
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
			} else {
				$location = 'http://kcphotovideoversion1.travisnapoleansmith.com/Administrators/newuser.php?UserName=dogcatbird';
				$passarray = array();
				$passarray['createUserAccount'] = array('UserName' => $_POST['UserName'], 'EmailAddress' => $_POST['Email']);
				$passarray['generateNewUserEmail'] = array('EmailAddress' => $_POST['Email'], 'Location' => $location);
				$this->LayerModule->pass('UserAccounts', 'AUTHENTICATE', $_POST, $passarray);
			}
			
			//$this->SessionDestroy($sessionname);
			
			$RegisterRedirectPage = $this->LayerModuleSetting['ContentLayer']['ContentLayer']['RegisterRedirect']['SettingAttribute'];
			header("Location: $RegisterRedirectPage");
		}
	}
	
	public function NewUserChangePassword() {
		print_r($_GET);
	}
	
	public function ChangePassword() {
		
	}
	
	public function ResetUser() {
	
	}
		
}

?>