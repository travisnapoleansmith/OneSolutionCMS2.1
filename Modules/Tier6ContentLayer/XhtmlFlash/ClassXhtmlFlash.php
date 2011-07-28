<?php

class XhtmlFlash extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $FlashPath;
	protected $Width;
	protected $Height;
	protected $Wmode;
	protected $AllowFullScreen;
	protected $AllowScriptAccess;
	protected $Quality;
	
	protected $FlashVars = array();
	
	protected $FlashVarsText;
	
	protected $AltText;
	
	//protected $FlashRecord;
	
	protected $IsIE;
	
	public function __construct(array $tablenames, array $databaseoptions, ValidationLayer $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlFlash'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlFlash'][$hold];
		$this->ErrorMessage = array();
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($databaseoptions['FlashVars']) {
			$this->FlashVars = $databaseoptions['FlashVars'];
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
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		
		//unset($PageID['RevisionID']);
		//unset($PageID['CurrentVersion']);
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->createDatabaseTable($this->DatabaseTable);
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		//////$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('PageID' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('PageID' => $passarray));
		
		$this->FlashPath = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'FlashPath'));
		$this->Width = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Height'));
		$this->Wmode = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Wmode'));
		$this->AllowFullScreen = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AllowFullScreen'));
		$this->AllowScriptAccess = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AllowScriptAccess'));
		$this->Quality = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Quality'));
		//$this->FlashRecord = $this->LayerModule->pass($this->DatabaseTable, 'getEntireRow', array());
		
		$this->AltText = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'AltText'));
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagId = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagId'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->IsIE = $this->CheckUserString();
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
	protected function BuildFlashVars() {
		foreach ($this->FlashVars as $FlashVarsName => $FlashVars) {
			if (is_array($FlashVars)) {
				if (isset($FlashVars['value'])) {
					foreach($FlashVars['value'] as $Key => $Value) {
						$this->FlashVarsText .= $Key;
						$this->FlashVarsText .= '=';
						$this->FlashVarsText .= $Value;
						$this->FlashVarsText .= '&';
					}
				}
			} else if (isset($FlashVars)){
				$CurrentFlashVarsDatabaseValue = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $FlashVarsName));
				if ($CurrentFlashVarsDatabaseValue != NULL) {
					$this->FlashVarsText .= $FlashVars;
					$this->FlashVarsText .= '=';
					$this->FlashVarsText .= $CurrentFlashVarsDatabaseValue;
					$this->FlashVarsText .= '&';
				}
			}
		}
		$this->FlashVarsText = trim($this->FlashVarsText, '&');
	}
	
	public function CreateOutput($space) {
		$this->Space = $space;
		
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
		
		if ($this->Quality) {
			$this->Writer->startElement('param');
			$this->Writer->writeAttribute('name', 'quality');
			$this->Writer->writeAttribute('value', $this->Quality);
			$this->Writer->endElement();
		}
		
		if ($this->FlashVars) {
			$this->BuildFlashVars();
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
		
		$this->Writer->writeRaw($this->Space);
		$this->Writer->writeRaw('  ');
		$this->Writer->endElement(); // END OBJECT TAG
		if ($this->EndTag) {
			$this->Writer->writeRaw($this->Space);
			$this->Writer->fullEndElement(); // ENDS END TAG
			$this->Writer->writeRaw("\n");
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
}
?>