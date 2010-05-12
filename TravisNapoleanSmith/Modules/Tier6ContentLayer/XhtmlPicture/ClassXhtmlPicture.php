<?php

class XhtmlPicture extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $PictureID;
	protected $PictureClass;
	protected $PictureStyle;
	protected $PictureLink;
	protected $PictureAltText;
	
	protected $Width;
	protected $Height;
		
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlPicture'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlPicture'][$hold];
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
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->PictureID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureID'));
		$this->PictureClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureClass'));
		$this->PictureStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureStyle'));
		$this->PictureLink = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureLink'));
		$this->PictureAltText = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureAltText'));
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		$this->Width = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Height'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
				
	}
	
	public function CreateOutput($space) {
	  	$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					$this->ProcessStandardAttribute('StartTag');
			}
			
			$this->Writer->startElement('img');
				$this->ProcessStandardAttribute('Picture');
				
				if ($this->PictureLink) {
					$this->Writer->writeAttribute('src', $this->PictureLink);
				}
				
				if ($this->PictureAltText) {
					$this->Writer->writeAttribute('alt', $this->PictureAltText);
				}
				
				if ($this->Width) {
					$this->Writer->writeAttribute('width', $this->Width);
				}
				
				if ($this->Height) {
					$this->Writer->writeAttribute('height', $this->Height);
				}
			$this->Writer->endElement(); // ENDS IMG TAG
			
			if ($this->EndTag) {
				$this->Writer->endElement(); // ENDS END TAG
			}
			
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
}
?>