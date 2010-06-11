<?php

class XhtmlMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $NewsID;
	protected $ClassReplace;
	protected $ClassClass;
	protected $DatabaseTableName;
	
	protected $newsflag;
	
	protected $MainDiv;
	protected $MainDivID;
	protected $MainDivClass;
	protected $MainDivStyle;
	
	protected $Div;
	protected $DivTitle;
	protected $DivID;
	protected $DivClass;
	protected $DivStyle;
	
	protected $List;
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlMenu'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlMenu'][$hold];
		$this->ErrorMessage = array();
		
		$this->DatabaseTableName = current($tablenames);
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($databaseoptions['NoAttributes']) {
			$this->NoAttributes = $databaseoptions['NoAttributes'];
			unset($databaseoptions['NoAttributes']);
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
		$ConnectionID = array();
		$ConnectionID['PageID'] = $PageID['PageID'];
		$ConnectionID['ObjectID'] = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->Connect($this->DatabaseTable);
		
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $ConnectionID));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $ConnectionID));
		$this->LayerModule->pass ($this->DatabaseTable, 'setEntireTable', array());
		
		$this->PageID = current($PageID);
		next($PageID);
		$this->ObjectID = current($PageID);
		next($PageID);
		$this->NewsID = current($PageID);
		if ($this->NewsID) {
			next($PageID);
			$this->ClassReplace = current($PageID);
			next($PageID);
			$this->ClassClass = current($PageID);
		}
		
		$this->StartTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTag'));
		$this->EndTag = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('EndTag'));
		$this->StartTagID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTagID'));
		$this->StartTagStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTagStyle'));
		$this->StartTagClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('StartTagClass'));
		
		$this->MainDiv = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div'));
		$this->MainDivID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('DivID'));
		$this->MainDivClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('DivClass'));
		$this->MainDivStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('DivStyle'));
		
		$this->Div = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1'));
		$this->DivTitle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1Title'));
		$this->DivID = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1ID'));
		$this->DivClass = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1Class'));
		$this->DivStyle = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Div1Style'));
		
		$this->EnableDisable = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Enable/Disable'));
		$this->Status = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('Status'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
		
	}
	
	public function CreateOutput($space) {
	  	$this->Space = $space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			if ($this->NewsID) {
				if (strstr($this->Div, $this->NewsID) | $this->NewsID == -1) {
					$this->StartTagClass = str_replace($this->ClassReplace, '', $this->StartTagClass);
					$this->StartTagClass = str_replace(' ','', $this->StartTagClass);
					$this->StartTagClass = $this->ClassClass ."$this->StartTagClass";
				}
			}
			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->startElement($this->StartTag);
					if (!$this->NoAttributes) {
						$this->ProcessStandardAttribute('StartTag');
					}
			}
			
			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->Writer->startElement('div');
				$this->ProcessStandardAttribute('MainDiv');
			}
			
			if ($this->MainDiv) {
				$this->MainDiv = $this->CreateWordWrap($this->MainDiv);
				$this->Writer->writeRaw("\n$this->Space    ");
				$this->Writer->writeRaw($this->MainDiv);
				$this->Writer->writeRaw("\n$this->Space ");
			}
			
			/*if($this->Space) {
				$this->List .= $this->Space;
				$this->List .= $this->Space;
			} else {
				$this->List .= '  ';
			}*/
			
			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->Writer->startElement('div');
				$this->ProcessStandardAttribute('Div');
			}
			
			if ($this->NewsID) {
				if (strstr($this->Div, $this->NewsID) | $this->NewsID == -1) {
					$this->Div = strip_tags($this->Div);
				}
			}
			
			if ($this->Div) {
				$this->Div = $this->CreateWordWrap($this->Div);
				$this->Writer->writeRaw("\n$this->Space    ");
				$this->Writer->writeRaw($this->Div);
				$this->Writer->writeRaw("\n$this->Space ");
			}
			
			if (!is_null($this->Div) || $this->DivID || $this->DivClass || $this->DivStyle || $this->DivTitle) {
				$this->Writer->endElement(); // ENDS DIV
			}
			
			if (!is_null($this->MainDiv || $this->MainDivID || $this->MainDivClass || $this->MainDivStyle)){
				$this->Writer->endElement(); // ENDS DIV
			}
			
			if ($this->EndTag) {
				$this->Writer->endElement(); // ENDS END TAG
			}
			
		}
		if ($this->FileName) {
			$this->Writer->flush();
		}
		
		if ($this->NoAttributes) {
			$this->List = $this->Writer->flush();
		}
	}
	
	public function getOutput() {
		return $this->List;
	}
}
?>