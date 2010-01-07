<?php

class XhtmlPicture extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	/*protected $PageID;
	protected $ObjectID;*/
	protected $PictureProtectionLayer;
	/*
	protected $hostname;
	protected $user;
	protected $password;
	protected $databasename;
	protected $databasetable;
	
	protected $StartTag;
	protected $EndTag;
	protected $StartTagID;
	protected $StartTagStyle;
	protected $StartTagClass;
	*/
	protected $PictureID;
	protected $PictureClass;
	protected $PictureStyle;
	protected $PictureLink;
	protected $PictureAltText;
	/*
	protected $EnableDisable;
	protected $Status;*/
	protected $Width;
	protected $Height;
	
	//protected $Space;
	protected $Picture;
	//protected $HttpUserAgent;
	
	public function XhtmlPicture($tablenames, $database) {
		$this->PictureProtectionLayer = &$database;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user;
		$this->password = $password;
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;
		
		$this->PictureProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->PictureProtectionLayer->setDatabasetable ($databasetable);
	}
	/*
	public function setPageID($PageID) {
		$this->PageID = $PageID;
	}
	
	public function getPageID() {
		return $this->PageID;
	}
	
	public function setObjectID($ObjectID) {
		$this->ObjectID = $ObjectID;
	}
	
	public function getObjectID() {
		return $this->ObjectID;
	}
	
	public function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	public function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	*/
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		unset ($PageID['PrintPreview']);
		
		$this->PictureProtectionLayer->Connect($this->databasetable);
		$passarray = array();
		$passarray = $PageID;
		$this->PictureProtectionLayer->pass ($this->databasetable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->PictureProtectionLayer->pass ($this->databasetable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->StartTag = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTag'));
		$this->EndTag = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'EndTag'));
		$this->StartTagID = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagID'));
		$this->StartTagStyle = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagStyle'));
		$this->StartTagClass = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'StartTagClass'));
		
		$this->PictureID = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'PictureID'));
		$this->PictureClass = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'PictureClass'));
		$this->PictureStyle = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'PictureStyle'));
		$this->PictureLink = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'PictureLink'));
		$this->PictureAltText = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'PictureAltText'));
		
		$this->EnableDisable = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Status'));
		$this->Width = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Width'));
		$this->Height = $this->PictureProtectionLayer->pass ($this->databasetable, 'getRowField', array('rowfield' => 'Height'));
		
		$this->PictureProtectionLayer->Disconnect($this->databasetable);
				
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
					$this->Picture .= $this->StartTag;
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
					$this->Picture .= $this->StartTag;
				} else if ($this->StartTagClass){
					$temp = strrpos($this->StartTag, '>');
					
					$this->StartTag[$temp] = ' ';
					$this->StartTag .= 'style="';
					$this->StartTag .= $this->StartTagStyle;
					$this->StartTag .= '"';
					$this->StartTag .= ">";
					
					$this->Picture .= $this->StartTag;
					$this->Picture .= "\n";
				} else {
					$this->Picture .= $this->StartTag;
					$this->Picture .= "\n";
				}
			}
			
			if ($this->Space) {
				$this->Picture .= $this->Space;
			}
			
			$this->Picture .= '<img';
			
			if ($this->PictureID) {
				$this->Picture .= ' id="';
				$this->Picture .= $this->PictureID;
				$this->Picture .= '"';
			}
			
			if ($this->PictureClass) {
				$this->Picture .= ' class="';
				$this->Picture .= $this->PictureClass;
				$this->Picture .= '"';
			}
			
			if ($this->PictureStyle) {
				$this->Picture .= ' style="';
				$this->Picture .= $this->PictureStyle;
				$this->Picture .= '"';
			}
			
			if ($this->PictureLink) {
				$this->Picture .= ' src="';
				$this->Picture .= $this->PictureLink;
				$this->Picture .= '"';
			}
			
			if ($this->PictureAltText) {
				$this->Picture .= ' alt="';
				$this->Picture .= $this->PictureAltText;
				$this->Picture .= '"';
			}
			
			if ($this->Width) {
				$this->Picture .= ' width="';
				$this->Picture .= $this->Width;
				$this->Picture .= '"';
			}
			
			if ($this->Height) {
				$this->Picture .= ' height="';
				$this->Picture .= $this->Height;
				$this->Picture .= '"';
			}
		
			$this->Picture .= " />\n";
			
			if ($this->EndTag) {
				$this->Picture .= '  ';
				$this->Picture .= $this->EndTag;
				$this->Picture .= "\n";
			}
		}
	}
	
	public function getOutput() {
		return $this->Picture;
	}
}
?>