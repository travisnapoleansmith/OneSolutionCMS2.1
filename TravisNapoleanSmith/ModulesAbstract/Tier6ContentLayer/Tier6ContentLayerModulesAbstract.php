<?php

abstract class Tier6ContentLayerModulesAbstract extends LayerModulesAbstract
{
	protected $Writer;
	protected $FileName;
	
	protected $StartTag;
	protected $EndTag;
	protected $StartTagID;
	protected $StartTagStyle;
	protected $StartTagClass;
	
	protected $PrintPreview;
	protected $EnableDisable;
	protected $Status;
	protected $HttpUserAgent;
	
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

	public function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	public function getHttpUserAgent() {
		return $this->HttpUserAgent;
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
			
			$wordwrapstring = wordwrap($wordwrapstring, 80, "\n       $this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 80, "\n       $this->Space$this->Space");
		}
		
		return $wordwrapstring;
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
