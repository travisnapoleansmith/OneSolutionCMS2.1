<?php

class XhtmlFlash extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $FlashPath;
	protected $Width;
	protected $Height;
	protected $Wmode;
	protected $AllowFullScreen;
	protected $AllowScriptAccess;
	
	// Flashprotecteds File Properties
	protected $FlashprotectedsAuthor;
	protected $FlashprotectedsDate;
	protected $FlashprotectedsDescription;
	protected $FlashprotectedsDuration;
	protected $FlashprotectedsFile;
	protected $FlashprotectedsImage;
	protected $FlashprotectedsLink;
	protected $FlashprotectedsStart;
	protected $FlashprotectedsStreamer;
	protected $FlashprotectedsTags;
	protected $FlashprotectedsTitle;
	protected $FlashprotectedsType;
	
	//Flashprotecteds Layout Properties
	protected $FlashprotectedsBackColor;
	protected $FlashprotectedsControlBar;
	protected $FlashprotectedsDock;
	protected $FlashprotectedsFrontColor;
	protected $FlashprotectedsHeight;
	protected $FlashprotectedsIcons;
	protected $FlashprotectedsLightColor;
	protected $FlashprotectedsLogo;
	protected $FlashprotectedsPlaylist;
	protected $FlashprotectedsPlaylistSize;
	protected $FlashprotectedsSkin;
	protected $FlashprotectedsScreenColor;
	protected $FlashprotectedsWidth;
	
	//Flashprotecteds Behavior Properties
	protected $FlashprotectedsAutoStart;
	protected $FlashprotectedsBufferLength;
	protected $FlashprotectedsDisplayClick;
	protected $FlashprotectedsDisplayTitle;
	protected $FlashprotectedsFullScreen;
	protected $FlashprotectedsItem;
	protected $FlashprotectedsLinkTarget;
	protected $FlashprotectedsMute;
	protected $FlashprotectedsRepeat;
	protected $FlashprotectedsShuffle;
	protected $FlashprotectedsSmoothing;
	protected $FlashprotectedsState;
	protected $FlashprotectedsStretching;
	protected $FlashprotectedsVolume;
	
	//Flashprotecteds API Properties
	protected $FlashprotectedsClient;
	protected $FlashprotectedsDebug;
	protected $FlashprotectedsId;
	protected $FlashprotectedsPlugins;
	protected $FlashprotectedsVersion;
	
	//Flashprotecteds ConfigXML Properties
	protected $FlashprotectedsConfig;
	
	protected $FlashprotectedsText;
	protected $AltText;
	
	protected $Flash;
	
	protected $IsIE;
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlFlash'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlFlash'][$hold];
		$this->ErrorMessage = array();
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
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
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('PageID' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('PageID' => $passarray));
		
		$this->FlashPath = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashPath'));
		$this->Width = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Height'));
		$this->Wmode = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Wmode'));
		$this->AllowFullScreen = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AllowFullScreen'));
		$this->AllowScriptAccess = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AllowScriptAccess'));
		
		// FlashVars File Properties
		$this->FlashVarsAuthor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsAuthor'));
		$this->FlashVarsDate = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDate'));
		$this->FlashVarsDescription = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDescription'));
		$this->FlashVarsDuration = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDuration'));
		$this->FlashVarsFile = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsFile'));
		$this->FlashVarsImage = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsImage'));
		$this->FlashVarsLink = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsLink'));
		$this->FlashVarsStart = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsStart'));
		$this->FlashVarsStreamer = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsStreamer'));
		$this->FlashVarsTags = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsTags'));
		$this->FlashVarsTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsTitle'));
		$this->FlashVarsType = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsType'));
		
		//FlashVars Layout Properties
		$this->FlashVarsBackColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsBackColor'));
		$this->FlashVarsControlBar = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsControlBar'));
		$this->FlashVarsDock = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDock'));
		$this->FlashVarsFrontColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsFrontColor'));
		$this->FlashVarsHeight = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsHeight'));
		$this->FlashVarsIcons = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsIcons'));
		$this->FlashVarsLightColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsLightColor'));
		$this->FlashVarsLogo = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsLogo'));
		$this->FlashVarsPlaylist = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsPlaylist'));
		$this->FlashVarsPlaylistSize = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsPlaylistSize'));
		$this->FlashVarsSkin = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsSkin'));
		$this->FlashVarsScreenColor = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsScreenColor'));
		$this->FlashVarsWidth = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsWidth'));
		
		//FlashVars Behavior Properties
		$this->FlashVarsAutoStart = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsAutoStart'));
		$this->FlashVarsBufferLength = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsBufferLength'));
		$this->FlashVarsDisplayClick = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDisplayClick'));
		$this->FlashVarsDisplayTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDisplayTitle'));
		$this->FlashVarsFullScreen = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsFullScreen'));
		$this->FlashVarsItem = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsItem'));
		$this->FlashVarsLinkTarget = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsLinkTarget'));
		$this->FlashVarsMute = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsMute'));
		$this->FlashVarsRepeat = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsRepeat'));
		$this->FlashVarsShuffle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsShuffle'));
		$this->FlashVarsSmoothing = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsSmoothing'));
		$this->FlashVarsState = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsState'));
		$this->FlashVarsStretching = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsStretching'));
		$this->FlashVarsVolume = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsVolume'));
	
		//FlashVars API Properties
		$this->FlashVarsClient = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsClient'));
		$this->FlashVarsDebug = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsDebug'));
		$this->FlashVarsId = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsId'));
		$this->FlashVarsPlugins = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsPlugins'));
		$this->FlashVarsVersion = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsVersion'));
	
		//FlashVars ConfigXML Properties
		$this->FlashVarsConfig = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashVarsConfig'));
		
		$this->AltText = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AltText'));
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagId = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagId'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->IsIE = $this->CheckUserString();
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
	protected function BuildFlashVarsText() {
		// FlashVars File Properties
		if ($this->FlashVarsAuthor) {
			$this->FlashVarsAuthor = trim($this->FlashVarsAuthor, '"');
			$this->FlashVarsText .= 'author=';
			$this->FlashVarsText .= $this->FlashVarsAuthor;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDate) {
			$this->FlashVarsText .= 'date=';
			$this->FlashVarsText .= $this->FlashVarsDate;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDescription) {
			$this->FlashVarsDescription = trim($this->FlashVarsDescription, '"');
			$this->FlashVarsText .= 'description=';
			$this->FlashVarsText .= $this->FlashVarsDescription;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDuration) {
			$this->FlashVarsText .= 'duration=';
			$this->FlashVarsText .= $this->FlashVarsDuration;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsFile) {
			$this->FlashVarsFile = trim($this->FlashVarsFile, '"');
			$this->FlashVarsText .= 'file=';
			$this->FlashVarsText .= $this->FlashVarsFile;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsImage) {
			$this->FlashVarsImage = trim($this->FlashVarsImage, '"');
			$this->FlashVarsText .= 'image=';
			$this->FlashVarsText .= $this->FlashVarsImage;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsLink) {
			$this->FlashVarsLink = trim($this->FlashVarsLink, '"');
			$this->FlashVarsText .= 'link=';
			$this->FlashVarsText .= $this->FlashVarsLink;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsStart) {
			$this->FlashVarsText .= 'start=';
			$this->FlashVarsText .= $this->FlashVarsStart;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsStreamer) {
			$this->FlashVarsStreamer = trim($this->FlashVarsStreamer, '"');
			$this->FlashVarsText .= 'streamer=';
			$this->FlashVarsText .= $this->FlashVarsStreamer;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsTags) {
			$this->FlashVarsTags = trim($this->FlashVarsTags, '"');
			$this->FlashVarsText .= 'tags=';
			$this->FlashVarsText .= $this->FlashVarsTags;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsTitle) {
			$this->FlashVarsTitle = trim($this->FlashVarsTitle, '"');
			$this->FlashVarsText .= 'title=';
			$this->FlashVarsText .= $this->FlashVarsTitle;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsType) {
			$this->FlashVarsText .= 'type=';
			$this->FlashVarsText .= $this->FlashVarsType;
			$this->FlashVarsText .= '&';
		}

		//FlashVars Layout Properties
		if ($this->FlashVarsBackColor) {
			$this->FlashVarsBackColor = trim($this->FlashVarsBackColor, '"');
			$this->FlashVarsText .= 'backcolor=';
			$this->FlashVarsText .= $this->FlashVarsBackColor;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsControlBar) {
			$this->FlashVarsText .= 'controlbar=';
			$this->FlashVarsText .= $this->FlashVarsControlBar;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDock) {
			$this->FlashVarsText .= 'dock=';
			$this->FlashVarsText .= $this->FlashVarsDock;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsFrontColor) {
			$this->FlashVarsFrontColor = trim($this->FlashVarsFrontColor, '"');
			$this->FlashVarsText .= 'frontcolor=';
			$this->FlashVarsText .= $this->FlashVarsFrontColor;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsHeight) {
			$this->FlashVarsText .= 'height=';
			$this->FlashVarsText .= $this->FlashVarsHeight;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsIcons) {
			$this->FlashVarsText .= 'icons=';
			$this->FlashVarsText .= $this->FlashVarsIcons;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsLightColor) {
			$this->FlashVarsLightColor = trim($this->FlashVarsLightColor, '"');
			$this->FlashVarsText .= 'lightcolor=';
			$this->FlashVarsText .= $this->FlashVarsLightColor;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsLogo) {
			$this->FlashVarsLogo = trim($this->FlashVarsLogo, '"');
			$this->FlashVarsText .= 'logo=';
			$this->FlashVarsText .= $this->FlashVarsLogo;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsPlaylist) {
			$this->FlashVarsPlaylist = trim($this->FlashVarsPlaylist, '"');
			$this->FlashVarsText .= 'playlist=';
			$this->FlashVarsText .= $this->FlashVarsPlaylist;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsPlaylistSize) {
			$this->FlashVarsText .= 'playlistsize=';
			$this->FlashVarsText .= $this->FlashVarsPlaylistSize;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsSkin) {
			$this->FlashVarsSkin = trim($this->FlashVarsSkin, '"');
			$this->FlashVarsText .= 'skin=';
			$this->FlashVarsText .= $this->FlashVarsSkin;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsScreenColor) {
			$this->FlashVarsScreenColor = trim($this->FlashVarsScreenColor, '"');
			$this->FlashVarsText .= 'screencolor=';
			$this->FlashVarsText .= $this->FlashVarsScreenColor;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsWidth) {
			$this->FlashVarsText .= 'width=';
			$this->FlashVarsText .= $this->FlashVarsWidth;
			$this->FlashVarsText .= '&';
		}
		
		//FlashVars Behavior Properties
		if ($this->FlashVarsAutoStart) {
			$this->FlashVarsText .= 'autostart=';
			$this->FlashVarsText .= $this->FlashVarsAutoStart;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsBufferLength) {
			$this->FlashVarsText .= 'bufferlength=';
			$this->FlashVarsText .= $this->FlashVarsBufferLength;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDisplayClick) {
			$this->FlashVarsText .= 'displayclick=';
			$this->FlashVarsText .= $this->FlashVarsDisplayClick;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDisplayTitle) {
			$this->FlashVarsText .= 'displaytitle=';
			$this->FlashVarsText .= $this->FlashVarsDisplayTitle;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsFullScreen) {
			$this->FlashVarsText .= 'fullscreen=';
			$this->FlashVarsText .= $this->FlashVarsFullScreen;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsItem) {
			$this->FlashVarsText .= 'item=';
			$this->FlashVarsText .= $this->FlashVarsItem;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsLinkTarget) {
			$this->FlashVarsText .= 'linktarget=';
			$this->FlashVarsText .= $this->FlashVarsLinkTarget;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsMute) {
			$this->FlashVarsText .= 'mute=';
			$this->FlashVarsText .= $this->FlashVarsMute;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsRepeat) {
			$this->FlashVarsText .= 'repeat=';
			$this->FlashVarsText .= $this->FlashVarsRepeat;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsShuffle) {
			$this->FlashVarsText .= 'shuffle=';
			$this->FlashVarsText .= $this->FlashVarsShuffle;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsSmoothing) {
			$this->FlashVarsText .= 'smoothing=';
			$this->FlashVarsText .= $this->FlashVarsSmoothing;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsState) {
			$this->FlashVarsText .= 'state=';
			$this->FlashVarsText .= $this->FlashVarsState;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsStretching) {
			$this->FlashVarsText .= 'stretching=';
			$this->FlashVarsText .= $this->FlashVarsStretching;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsVolume) {
			$this->FlashVarsText .= 'volume=';
			$this->FlashVarsText .= $this->FlashVarsVolume;
			$this->FlashVarsText .= '&';
		}
		
		//FlashVars API Properties		
		if ($this->FlashVarsClient) {
			$this->FlashVarsClient = trim($this->FlashVarsClient, '"');
			$this->FlashVarsText .= 'client=';
			$this->FlashVarsText .= $this->FlashVarsClient;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsDebug) {
			$this->FlashVarsDebug = trim($this->FlashVarsDebug, '"');
			$this->FlashVarsText .= 'debug=';
			$this->FlashVarsText .= $this->FlashVarsDebug;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsId) {
			$this->FlashVarsId = trim($this->FlashVarsId, '"');
			$this->FlashVarsText .= 'id=';
			$this->FlashVarsText .= $this->FlashVarsId;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsPlugins) {
			$this->FlashVarsPlugins = trim($this->FlashVarsPlugins, '"');
			$this->FlashVarsText .= 'plugins=';
			$this->FlashVarsText .= $this->FlashVarsPlugins;
			$this->FlashVarsText .= '&';
		}
		if ($this->FlashVarsVersion) {
			$this->FlashVarsVersion = trim($this->FlashVarsVersion, '"');
			$this->FlashVarsText .= 'version=';
			$this->FlashVarsText .= $this->FlashVarsVersion;
			$this->FlashVarsText .= '&';
		}
		
		//FlashVars ConfigXML Properties
		if ($this->FlashVarsConfig) {
			$this->FlashVarsConfig = trim($this->FlashVarsConfig, '"');
			$this->FlashVarsText .= 'config=';
			$this->FlashVarsText .= $this->FlashVarsConfig;
			$this->FlashVarsText .= '&';
		}
		
		$this->FlashVarsText = trim($this->FlashVarsText, '&');
	}
	
	public function CreateOutput($space) {
		$this->Space = $space;
		$this->BuildFlashVarsText();
		
		if ($this->StartTag){
			$this->StartTag = str_replace('<','', $this->StartTag);
			$this->StartTag = str_replace('>','', $this->StartTag);
			$this->Writer->startElement($this->StartTag);
			
				if ($this->StartTagID) {
					$this->Writer->writeAttribute('id', $this->StartTagID);
				}
				if ($this->StartTagStyle) {
					$this->Writer->writeAttribute('style', $this->StartTagStyle);
				}
				if ($this->StartTagClass) {
					$this->Writer->writeAttribute('class', $this->StartTagClass);
				}
		}
		
		$this->Writer->startElement('object');
		
		if ($this->IsIE) {
			$this->Writer->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		}
		
		if ($this->Width) {
			$this->Writer->writeAttribute('width', $this->Width);
		}
		
		if ($this->Height) {
			$this->Writer->writeAttribute('height', $this->Height);
		}
		
		if ($this->IsIE) {
			$this->Writer->writeAttribute('id', 'player');
			$this->Writer->writeAttribute('name', 'player');
		} else {
			$this->Writer->writeAttribute('type', 'application/x-shockwave-flash');
		}
		
		if (!$this->IsIE) {
			if ($this->FlashPath) {
				$this->Writer->writeAttribute('data', $this->FlashPath);
			}
		}
	  	
		if ($this->FlashPath) {
			$this->Writer->startElement('param');
			$this->Writer->writeAttribute('name', 'movie');
			$this->Writer->writeAttribute('value', $this->FlashPath);
			$this->Writer->endElement();
		}
		
		if ($this->Wmode) {
			$this->Writer->startElement('param');
			$this->Writer->writeAttribute('name', 'wmode');
			$this->Writer->writeAttribute('value', $this->Wmode);
			$this->Writer->endElement();
		}
		
		if ($this->AllowFullScreen) {
			$this->Writer->startElement('param');
			$this->Writer->writeAttribute('name', 'allowfullscreen');
			$this->Writer->writeAttribute('value', $this->AllowFullScreen);
			$this->Writer->endElement();
		}
		
		if ($this->AllowScriptAccess) {
			$this->Writer->startElement('param');
			$this->Writer->writeAttribute('name', 'allowscriptaccess');
			$this->Writer->writeAttribute('value', $this->AllowScriptAccess);
			$this->Writer->endElement();
		}
		
		if ($this->FlashVarsText) {
			$this->Writer->startElement('param');
			$this->Writer->writeAttribute('name', 'flashvars');
			$this->Writer->writeAttribute('value', $this->FlashVarsText);
			$this->Writer->endElement();
		}
		
		if ($this->AltText) {
			$this->Writer->writeRaw("\t");
			$this->Writer->writeRaw($this->CreateWordWrap($this->AltText));
			$this->Writer->writeRaw("\n");
	  	}
		
		$this->Writer->writeRaw($this->Space); // END OBJECT TAG
		$this->Writer->endElement();
		if ($this->EndTag) {
			$this->Writer->fullEndElement(); // ENDS END TAG
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
}
?>