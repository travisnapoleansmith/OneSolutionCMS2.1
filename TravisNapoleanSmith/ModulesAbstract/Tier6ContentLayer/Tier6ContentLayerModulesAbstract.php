<?php

abstract class Tier6ContentLayerModulesAbstract 
{
	protected $PageID;
	protected $ObjectID;
	
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
	
	protected $PrintPreview;
	protected $Space;
	protected $EnableDisable;
	protected $Status;
	protected $ErrorMessage = array();
	protected $HttpUserAgent;
	
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
	
	public function gethostname() {
		return $this->hostname;
	}
	
	public function getuser() {
		return $this->user;
	}
	
	public function getpassword() {
		return $this->password;
	}
	
	public function getdatabasename() {
		return $this->databasename;
	}
	
	public function getdatabasetable() {
		return $this->databasetable;
	}
	
	public function getEmpty() {
		return $this->Empty;
	}
	
	public function getStartTag() {
		return $this->StartTag;
	}
	
	public function getEndTag() {
		return $this->EndTag;
	}
	
	public function getStartTagID() {
		return $this->StartTagID;
	}
	
	public function getStartTagStyle() {
		return $this->StartTagStyle;
	}		
	
	public function getStartTagClass() {
		return $this->StartTagClass;
	}
	
	public function getPrintPreview() {
		return $this->PrintPreview;
	}
	
	public function getEnableDisable() {
		return $this->EnableDisable;
	}
	
	public function getStatus() {
		return $this->Status;
	}
	
	public function getSpace() {
		return $this->Space;
	}	
	
	public function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	public function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	
	public function getError ($idnumber) {
		return $this->ErrorMessage[$idnumber];
	}
	
	public function getErrorArray() {
		return $this->ErrorMessage;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
	
	}

	public function FetchDatabase ($idnumber) {
	
	}
	public function CreateOutput($space) {
	
	}
	public function getOutput() {
	
	}
	
	/*protected function CreateWordWrap($wordwrapstring) {
		if (stristr($wordwrapstring, '<a href')) {
			// Strip AHef Tags for wordwrap then put them back in
			$firstpos = strpos($wordwrapstring, '<a href');
			$lastpos = strpos($wordwrapstring, '</a>');
			$lastpos = $lastpos + 3;
			
			// Split a string into an array - character by character
			$newwordwrapstring = Array();
			$j = 0;
			$end = strlen($wordwrapstring);
			while ($j <= $end) {
				array_push ($newwordwrapstring, $wordwrapstring[$j]);
				$j++;
			}
			
			$j = $firstpos;
			while ($j <= $lastpos) {
				$endstring .= $newwordwrapstring[$j];
				$j++;
			}
			
			$returnstring = $endstring;
			$returnstring = str_replace (' ', '<SPACE>', $returnstring);
			$wordwrapstring = str_replace ($endstring, $returnstring, $wordwrapstring);
			// END STRIP AHREF TAG FOR WORDWRAP
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n$this->Space$this->Space");
		}
		return $wordwrapstring;
	}
	*/
	
	protected function CreateWordWrap($wordwrapstring) {
		if (stristr($wordwrapstring, '<a href')) {
			// Strip AHef Tags for wordwrap then put them back in
			$firstpos = strpos($wordwrapstring, '<a href');
			$lastpos = strpos($wordwrapstring, '</a>');
			$lastpos = $lastpos + 3;
			
			// Split a string into an array - character by character
			$newwordwrapstring = Array();
			$j = 0;
			$end = strlen($wordwrapstring);
			while ($j <= $end) {
				array_push ($newwordwrapstring, $wordwrapstring[$j]);
				$j++;
			}
			
			$j = $firstpos;
			while ($j <= $lastpos) {
				$endstring .= $newwordwrapstring[$j];
				$j++;
			}
			
			$returnstring = $endstring;
			$returnstring = str_replace (' ', '<SPACE>', $returnstring);
			$wordwrapstring = str_replace ($endstring, $returnstring, $wordwrapstring);
			// END STRIP AHREF TAG FOR WORDWRAP
			
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n       $this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 100, "\n       $this->Space$this->Space");
		}
		
		return $wordwrapstring;
	}
	
	protected function buildModules($moduleslocation) {
		if ($moduleslocation) {
			$hold = Array();
			$dir = dir($moduleslocation);
			
			while ($entry = $dir->read()) {
				
				$filestring = $moduleslocation;
				$filestring .= $entry;
				if (!($entry == '.' | $entry == '..')) {
					if (is_dir($filestring)) {
						$modulesfile = $filestring;
						$modulesfile .= '/Class';
						$modulesfile .= $entry;
						$modulesfile .= '.php';
						if (is_file($modulesfile)) {
							$hold[$entry] = $modulesfile;
						} else {
							array_push($this->errormessage,'buildModules: Module file does not exist!');
						}
					}
				}
			}
			return $hold;
		} else {
			array_push($this->errormessage,'buildModules: Module Location is not set!');
		}
	}
	
	protected function CheckUserString() {
		if (strstr($this->HttpUserAgent, 'MSIE 6.0')) {
			if ($this->AllowScriptAccess == 'true') {
				$this->AllowScriptAccess = 'always';
			}
			return TRUE;
		}
		
		if (strstr($this->HttpUserAgent,'MSIE 7.0')) {
			if ($this->AllowScriptAccess == 'true') {
				$this->AllowScriptAccess = 'always';
			}
			return TRUE;
		}
		
		if (strstr($this->HttpUserAgent,'MSIE 8.0')) {
			if ($this->AllowScriptAccess == 'true') {
				$this->AllowScriptAccess = 'always';
			}
			return TRUE;
		}
	}
	
}
?>
