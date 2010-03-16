<?php

class XhtmlPicture extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $PictureProtectionLayer;
	
	protected $PictureID;
	protected $PictureClass;
	protected $PictureStyle;
	protected $PictureLink;
	protected $PictureAltText;
	
	protected $Width;
	protected $Height;
	
	protected $Picture;
	
	public function __construct($tablenames, $database) {
		$this->PictureProtectionLayer = &$database;
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->GlobalWriter = $tablenames['GlobalWriter'];
		unset($tablenames['GlobalWriter']);
		
		if ($this->GlobalWriter) {
			$this->Writer = $this->GlobalWriter;
		} else {
			$this->Writer = new XMLWriter();
			if ($this->FileName) {
				$this->Writer->openURI($this->FileName);
			} else {
				$this->Writer->openMemory();
			}
			$this->Writer->setIndent(3);
		}
		//print_r($this->Writer);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->PictureProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->PictureProtectionLayer->setDatabasetable ($databasetable);
	}

	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);
		
		$this->PictureProtectionLayer->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		$this->PictureProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->PictureProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->StartTag = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->PictureID = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureID'));
		$this->PictureClass = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureClass'));
		$this->PictureStyle = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureStyle'));
		$this->PictureLink = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureLink'));
		$this->PictureAltText = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PictureAltText'));
		
		$this->EnableDisable = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Status'));
		$this->Width = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->PictureProtectionLayer->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Height'));
		
		$this->PictureProtectionLayer->Disconnect($this->DatabaseTable);
				
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
		$this->Writer->endDocument();
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->Picture = $this->Writer->flush();
		}
	}
	
	public function getOutput() {
		return $this->Picture;
	}
}
?>