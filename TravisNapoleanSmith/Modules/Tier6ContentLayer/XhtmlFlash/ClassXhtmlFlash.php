<?php
require_once ("ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php");

class XhtmlFlash implements Tier6ContentLayerModules {
	private $idnumber;
	private $idnumber1;
	
	private $hostname;
	private $user;
	private $password;
	private $databasename;
	private $databasetable;
	
	private $FlashProtectionLayer;
	private $FlashPath;
	private $Width;
	private $Height;
	private $Wmode;
	private $AllowFullScreen;
	private $AllowScriptAccess;
	
	// Flashprivates File Properties
	private $FlashprivatesAuthor;
	private $FlashprivatesDate;
	private $FlashprivatesDescription;
	private $FlashprivatesDuration;
	private $FlashprivatesFile;
	private $FlashprivatesImage;
	private $FlashprivatesLink;
	private $FlashprivatesStart;
	private $FlashprivatesStreamer;
	private $FlashprivatesTags;
	private $FlashprivatesTitle;
	private $FlashprivatesType;
	
	//Flashprivates Layout Properties
	private $FlashprivatesBackColor;
	private $FlashprivatesControlBar;
	private $FlashprivatesDock;
	private $FlashprivatesFrontColor;
	private $FlashprivatesHeight;
	private $FlashprivatesIcons;
	private $FlashprivatesLightColor;
	private $FlashprivatesLogo;
	private $FlashprivatesPlaylist;
	private $FlashprivatesPlaylistSize;
	private $FlashprivatesSkin;
	private $FlashprivatesScreenColor;
	private $FlashprivatesWidth;
	
	//Flashprivates Behavior Properties
	private $FlashprivatesAutoStart;
	private $FlashprivatesBufferLength;
	private $FlashprivatesDisplayClick;
	private $FlashprivatesDisplayTitle;
	private $FlashprivatesFullScreen;
	private $FlashprivatesItem;
	private $FlashprivatesLinkTarget;
	private $FlashprivatesMute;
	private $FlashprivatesRepeat;
	private $FlashprivatesShuffle;
	private $FlashprivatesSmoothing;
	private $FlashprivatesState;
	private $FlashprivatesStretching;
	private $FlashprivatesVolume;
	
	//Flashprivates API Properties
	private $FlashprivatesClient;
	private $FlashprivatesDebug;
	private $FlashprivatesId;
	private $FlashprivatesPlugins;
	private $FlashprivatesVersion;
	
	//Flashprivates ConfigXML Properties
	private $FlashprivatesConfig;
	
	private $FlashprivatesText;
	private $AltText;
	private $StartTag;
	private $EndTag;
	private $StartTagId;
	private $StartTagStyle;
	private $StartTagClass;
	private $Flash;
	private $Space;
	private $HttpUserAgent;
	private $IsIE;
	
	public function XhtmlFlash($tablenames, $database) {
		$this->FlashProtectionLayer = &$database;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user;
		$this->password = $password;
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;
		
		$this->FlashProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->FlashProtectionLayer->setDatabasetable ($databasetable);
	}
	
	public function setIdnumber($idnumber) {
		$this->idnumber = $idnumber;
	}
	
	public function getIdNumber() {
		return $this->idnumber;
	}
	
	public function getIdnumber1() {
		return $this->idnumber1;
	}
	
	public function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	public function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	
	public function FetchDatabase ($idnumber) {
		$this->FlashProtectionLayer->Connect($this->databasetable);
		$passarray = array();
		$passarray = $idnumber;
		$this->FlashProtectionLayer->pass ($this->databasetable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->FlashProtectionLayer->pass ($this->databasetable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->idnumber = $idnumber;
		$this->idnumber1 = $idnumber1;
		$this->FlashPath = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashPath'));
		$this->Width = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Height'));
		$this->Wmode = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Wmode'));
		$this->AllowFullScreen = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'AllowFullScreen'));
		$this->AllowScriptAccess = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'AllowScriptAccess'));
		
		// FlashVars File Properties
		$this->FlashVarsAuthor = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsAuthor'));
		$this->FlashVarsDate = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDate'));
		$this->FlashVarsDescription = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDescription'));
		$this->FlashVarsDuration = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDuration'));
		$this->FlashVarsFile = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsFile'));
		$this->FlashVarsImage = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsImage'));
		$this->FlashVarsLink = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsLink'));
		$this->FlashVarsStart = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsStart'));
		$this->FlashVarsStreamer = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsStreamer'));
		$this->FlashVarsTags = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsTags'));
		$this->FlashVarsTitle = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsTitle'));
		$this->FlashVarsType = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsType'));
		
		//FlashVars Layout Properties
		$this->FlashVarsBackColor = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsBackColor'));
		$this->FlashVarsControlBar = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsControlBar'));
		$this->FlashVarsDock = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDock'));
		$this->FlashVarsFrontColor = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsFrontColor'));
		$this->FlashVarsHeight = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsHeight'));
		$this->FlashVarsIcons = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsIcons'));
		$this->FlashVarsLightColor = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsLightColor'));
		$this->FlashVarsLogo = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsLogo'));
		$this->FlashVarsPlaylist = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsPlaylist'));
		$this->FlashVarsPlaylistSize = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsPlaylistSize'));
		$this->FlashVarsSkin = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsSkin'));
		$this->FlashVarsScreenColor = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsScreenColor'));
		$this->FlashVarsWidth = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsWidth'));
		
		//FlashVars Behavior Properties
		$this->FlashVarsAutoStart = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsAutoStart'));
		$this->FlashVarsBufferLength = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsBufferLength'));
		$this->FlashVarsDisplayClick = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDisplayClick'));
		$this->FlashVarsDisplayTitle = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDisplayTitle'));
		$this->FlashVarsFullScreen = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsFullScreen'));
		$this->FlashVarsItem = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsItem'));
		$this->FlashVarsLinkTarget = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsLinkTarget'));
		$this->FlashVarsMute = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsMute'));
		$this->FlashVarsRepeat = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsRepeat'));
		$this->FlashVarsShuffle = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsShuffle'));
		$this->FlashVarsSmoothing = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsSmoothing'));
		$this->FlashVarsState = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsState'));
		$this->FlashVarsStretching = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsStretching'));
		$this->FlashVarsVolume = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsVolume'));
	
		//FlashVars API Properties
		$this->FlashVarsClient = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsClient'));
		$this->FlashVarsDebug = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsDebug'));
		$this->FlashVarsId = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsId'));
		$this->FlashVarsPlugins = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsPlugins'));
		$this->FlashVarsVersion = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsVersion'));
	
		//FlashVars ConfigXML Properties
		$this->FlashVarsConfig = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'FlashVarsConfig'));
		
		$this->AltText = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'AltText'));
		$this->StartTag = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagId = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagId'));
		$this->StartTagStyle = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->FlashProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->CheckUserString();
		
		$this->FlashProtectionLayer->Disconnect($this->databasetable);
	}
	
	private function CheckUserString() {
		if (strstr($this->HttpUserAgent, 'MSIE 6.0')) {
			if ($this->AllowScriptAccess == 'true') {
				$this->AllowScriptAccess = 'always';
			}
			$this->IsIE = TRUE;
		}
		
		if (strstr($this->HttpUserAgent,'MSIE 7.0')) {
			if ($this->AllowScriptAccess == 'true') {
				$this->AllowScriptAccess = 'always';
			}
			$this->IsIE = TRUE;
		}
		
		if (strstr($this->HttpUserAgent,'MSIE 8.0')) {
			if ($this->AllowScriptAccess == 'true') {
				$this->AllowScriptAccess = 'always';
			}
			$this->IsIE = TRUE;
		}
	}
	
	private function BuildFlashVarsText() {
		// FlashVars File Properties
		if ($this->FlashVarsAuthor) {
			$this->FlashVarsAuthor = trim($this->FlashVarsAuthor, '"');
			$this->FlashVarsText .= 'author=';
			$this->FlashVarsText .= $this->FlashVarsAuthor;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDate) {
			$this->FlashVarsText .= 'date=';
			$this->FlashVarsText .= $this->FlashVarsDate;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDescription) {
			$this->FlashVarsDescription = trim($this->FlashVarsDescription, '"');
			$this->FlashVarsText .= 'description=';
			$this->FlashVarsText .= $this->FlashVarsDescription;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDuration) {
			$this->FlashVarsText .= 'duration=';
			$this->FlashVarsText .= $this->FlashVarsDuration;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsFile) {
			$this->FlashVarsFile = trim($this->FlashVarsFile, '"');
			$this->FlashVarsText .= 'file=';
			$this->FlashVarsText .= $this->FlashVarsFile;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsImage) {
			$this->FlashVarsImage = trim($this->FlashVarsImage, '"');
			$this->FlashVarsText .= 'image=';
			$this->FlashVarsText .= $this->FlashVarsImage;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsLink) {
			$this->FlashVarsLink = trim($this->FlashVarsLink, '"');
			$this->FlashVarsText .= 'link=';
			$this->FlashVarsText .= $this->FlashVarsLink;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsStart) {
			$this->FlashVarsText .= 'start=';
			$this->FlashVarsText .= $this->FlashVarsStart;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsStreamer) {
			$this->FlashVarsStreamer = trim($this->FlashVarsStreamer, '"');
			$this->FlashVarsText .= 'streamer=';
			$this->FlashVarsText .= $this->FlashVarsStreamer;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsTags) {
			$this->FlashVarsTags = trim($this->FlashVarsTags, '"');
			$this->FlashVarsText .= 'tags=';
			$this->FlashVarsText .= $this->FlashVarsTags;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsTitle) {
			$this->FlashVarsTitle = trim($this->FlashVarsTitle, '"');
			$this->FlashVarsText .= 'title=';
			$this->FlashVarsText .= $this->FlashVarsTitle;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsType) {
			$this->FlashVarsText .= 'type=';
			$this->FlashVarsText .= $this->FlashVarsType;
			$this->FlashVarsText .= '&amp;';
		}

		//FlashVars Layout Properties
		if ($this->FlashVarsBackColor) {
			$this->FlashVarsBackColor = trim($this->FlashVarsBackColor, '"');
			$this->FlashVarsText .= 'backcolor=';
			$this->FlashVarsText .= $this->FlashVarsBackColor;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsControlBar) {
			$this->FlashVarsText .= 'controlbar=';
			$this->FlashVarsText .= $this->FlashVarsControlBar;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDock) {
			$this->FlashVarsText .= 'dock=';
			$this->FlashVarsText .= $this->FlashVarsDock;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsFrontColor) {
			$this->FlashVarsFrontColor = trim($this->FlashVarsFrontColor, '"');
			$this->FlashVarsText .= 'frontcolor=';
			$this->FlashVarsText .= $this->FlashVarsFrontColor;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsHeight) {
			$this->FlashVarsText .= 'height=';
			$this->FlashVarsText .= $this->FlashVarsHeight;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsIcons) {
			$this->FlashVarsText .= 'icons=';
			$this->FlashVarsText .= $this->FlashVarsIcons;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsLightColor) {
			$this->FlashVarsLightColor = trim($this->FlashVarsLightColor, '"');
			$this->FlashVarsText .= 'lightcolor=';
			$this->FlashVarsText .= $this->FlashVarsLightColor;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsLogo) {
			$this->FlashVarsLogo = trim($this->FlashVarsLogo, '"');
			$this->FlashVarsText .= 'logo=';
			$this->FlashVarsText .= $this->FlashVarsLogo;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsPlaylist) {
			$this->FlashVarsPlaylist = trim($this->FlashVarsPlaylist, '"');
			$this->FlashVarsText .= 'playlist=';
			$this->FlashVarsText .= $this->FlashVarsPlaylist;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsPlaylistSize) {
			$this->FlashVarsText .= 'playlistsize=';
			$this->FlashVarsText .= $this->FlashVarsPlaylistSize;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsSkin) {
			$this->FlashVarsSkin = trim($this->FlashVarsSkin, '"');
			$this->FlashVarsText .= 'skin=';
			$this->FlashVarsText .= $this->FlashVarsSkin;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsScreenColor) {
			$this->FlashVarsScreenColor = trim($this->FlashVarsScreenColor, '"');
			$this->FlashVarsText .= 'screencolor=';
			$this->FlashVarsText .= $this->FlashVarsScreenColor;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsWidth) {
			$this->FlashVarsText .= 'width=';
			$this->FlashVarsText .= $this->FlashVarsWidth;
			$this->FlashVarsText .= '&amp;';
		}
		
		//FlashVars Behavior Properties
		if ($this->FlashVarsAutoStart) {
			$this->FlashVarsText .= 'autostart=';
			$this->FlashVarsText .= $this->FlashVarsAutoStart;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsBufferLength) {
			$this->FlashVarsText .= 'bufferlength=';
			$this->FlashVarsText .= $this->FlashVarsBufferLength;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDisplayClick) {
			$this->FlashVarsText .= 'displayclick=';
			$this->FlashVarsText .= $this->FlashVarsDisplayClick;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDisplayTitle) {
			$this->FlashVarsText .= 'displaytitle=';
			$this->FlashVarsText .= $this->FlashVarsDisplayTitle;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsFullScreen) {
			$this->FlashVarsText .= 'fullscreen=';
			$this->FlashVarsText .= $this->FlashVarsFullScreen;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsItem) {
			$this->FlashVarsText .= 'item=';
			$this->FlashVarsText .= $this->FlashVarsItem;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsLinkTarget) {
			$this->FlashVarsText .= 'linktarget=';
			$this->FlashVarsText .= $this->FlashVarsLinkTarget;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsMute) {
			$this->FlashVarsText .= 'mute=';
			$this->FlashVarsText .= $this->FlashVarsMute;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsRepeat) {
			$this->FlashVarsText .= 'repeat=';
			$this->FlashVarsText .= $this->FlashVarsRepeat;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsShuffle) {
			$this->FlashVarsText .= 'shuffle=';
			$this->FlashVarsText .= $this->FlashVarsShuffle;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsSmoothing) {
			$this->FlashVarsText .= 'smoothing=';
			$this->FlashVarsText .= $this->FlashVarsSmoothing;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsState) {
			$this->FlashVarsText .= 'state=';
			$this->FlashVarsText .= $this->FlashVarsState;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsStretching) {
			$this->FlashVarsText .= 'stretching=';
			$this->FlashVarsText .= $this->FlashVarsStretching;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsVolume) {
			$this->FlashVarsText .= 'volume=';
			$this->FlashVarsText .= $this->FlashVarsVolume;
			$this->FlashVarsText .= '&amp;';
		}
		
		//FlashVars API Properties		
		if ($this->FlashVarsClient) {
			$this->FlashVarsClient = trim($this->FlashVarsClient, '"');
			$this->FlashVarsText .= 'client=';
			$this->FlashVarsText .= $this->FlashVarsClient;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsDebug) {
			$this->FlashVarsDebug = trim($this->FlashVarsDebug, '"');
			$this->FlashVarsText .= 'debug=';
			$this->FlashVarsText .= $this->FlashVarsDebug;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsId) {
			$this->FlashVarsId = trim($this->FlashVarsId, '"');
			$this->FlashVarsText .= 'id=';
			$this->FlashVarsText .= $this->FlashVarsId;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsPlugins) {
			$this->FlashVarsPlugins = trim($this->FlashVarsPlugins, '"');
			$this->FlashVarsText .= 'plugins=';
			$this->FlashVarsText .= $this->FlashVarsPlugins;
			$this->FlashVarsText .= '&amp;';
		}
		if ($this->FlashVarsVersion) {
			$this->FlashVarsVersion = trim($this->FlashVarsVersion, '"');
			$this->FlashVarsText .= 'version=';
			$this->FlashVarsText .= $this->FlashVarsVersion;
			$this->FlashVarsText .= '&amp;';
		}
		
		//FlashVars ConfigXML Properties
		if ($this->FlashVarsConfig) {
			$this->FlashVarsConfig = trim($this->FlashVarsConfig, '"');
			$this->FlashVarsText .= 'config=';
			$this->FlashVarsText .= $this->FlashVarsConfig;
			$this->FlashVarsText .= '&amp;';
		}
		
		$this->FlashVarsText = trim($this->FlashVarsText, '&amp;');
	}
	
	public function CreateOutput($space) {
	  	$this->BuildFlashVarsText();
		$this->Space = $space;
		
		if ($this->StartTag){
			if ($this->StartTagId) {
				$temp = strrpos($this->StartTag, '>');
				$this->StartTag[$temp] = ' ';
				$this->StartTag .= 'id="';
				$this->StartTag .= $this->StartTagId;
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
				$this->flash .= $this->StartTag;
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
				$this->flash .= $this->StartTag;
			} else {
				$temp = strrpos($this->StartTag, '>');
				
				$this->StartTag[$temp] = ' ';
				$this->StartTag .= 'style="';
				$this->StartTag .= $this->StartTagStyle;
				$this->StartTag .= '"';
				$this->StartTag .= ">";
				
				$this->flash .= $this->StartTag;
				$this->flash .= "\n";
			}
		}
		
		if ($this->Space) {
			$this->flash .= $this->Space;
		}
		
		$this->flash .= "<object";
		
		if ($this->IsIE) {
			$this->flash .= ' classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"';
		}
		
		if ($this->Width) {
			$this->flash .= " width=\"";
			$this->flash .= $this->Width;
			$this->flash .= "\"";
		}
		
		if ($this->Height) {
			$this->flash .= " height=\"";
			$this->flash .= $this->Height;
			$this->flash .= "\"";
		}
		
		if ($this->IsIE) {
			$this->flash .= 'id="player" name="player"';
		} else {
			$this->flash .= " type=\"application/x-shockwave-flash\"";
		}
		
		if (!$this->IsIE) {
			if ($this->FlashPath) {
				$this->flash .= " data=\"";
				$this->flash .= $this->FlashPath;
				$this->flash .= "\"";
			}
		}
		$this->flash .= ">\n";
	  	
		if ($this->FlashPath) {
			if ($this->Space) {
				$this->flash .= $this->Space;
			}
			$this->flash .= "  <param name=\"movie\" value=\"";
			$this->flash .= $this->FlashPath;
			$this->flash .= "\" />\n";
		}
		
		if ($this->Wmode) {
			if ($this->Space) {
				$this->flash .= $this->Space;
			}
			$this->flash .= "  <param name=\"wmode\" value=\"";
			$this->flash .= $this->Wmode;
			$this->flash .= "\" />\n";
		}
		
		if ($this->AllowFullScreen) {
			if ($this->Space) {
				$this->flash .= $this->Space;
			}
			$this->flash .= "  <param name=\"allowfullscreen\" value=\"";
			$this->flash .= $this->AllowFullScreen;
			$this->flash .= "\" />\n";
		}
		
		if ($this->AllowScriptAccess) {
			if ($this->Space) {
				$this->flash .= $this->Space;
			}
			$this->flash .= "  <param name=\"allowscriptaccess\" value=\"";
			$this->flash .= $this->AllowScriptAccess;
			$this->flash .= "\" />\n";
		}
		
		if ($this->FlashVarsText) {
			if ($this->Space) {
				$this->flash .= $this->Space;
			}
			$this->flash .= "  <param name=\"flashvars\" value=\"";
			$this->flash .= $this->FlashVarsText;
			$this->flash .= "\" />\n";
		}
		
		if ($this->AltText) {
			if ($this->Space) {
				$this->flash .= $this->Space;
			}
			$this->flash .= "\t ";
			$this->flash .= $this->AltText;
			$this->flash .= "\n";
	  	}
		if ($this->Space) {
			$this->flash .= $this->Space;
		}
		
		$this->flash .= "</object>\n";
		
		if ($this->EndTag) {
			$this->flash .= "  ";
			$this->flash .= $this->EndTag;
			$this->flash .= "\n";
		}
	}
	
	public function getOutput() {
		return $this->flash;
	}
}
?>