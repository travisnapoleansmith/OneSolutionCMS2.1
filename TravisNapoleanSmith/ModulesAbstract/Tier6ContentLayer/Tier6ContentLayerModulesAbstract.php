<?php

abstract class Tier6ContentLayerModulesAbstract extends LayerModulesAbstract
{
	protected $Writer;
	protected $GlobalWriter;
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
			
			$wordwrapstring = wordwrap($wordwrapstring, 85, "\n       $this->Space$this->Space");
			$wordwrapstring = str_replace ($returnstring, $endstring, $wordwrapstring);
			
		} else {
			$wordwrapstring = wordwrap($wordwrapstring, 85, "\n       $this->Space$this->Space");
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
	
	protected function ProcessArray($array, $arrayname, $tablesname, $j, $key, $databasetable) {
		if (is_array($array)) {
			$i = 1;
			$k = 0;
			$name = $arrayname;
			$name .= $i;
			$hold = $databasetable[$tablesname][$j][$name];
			while (array_key_exists($name, $databasetable[$tablesname][$j])) {
				array_push($array[$key], $hold);
				
				$k++;
				$i++;
				$name = $arrayname;
				$name .= $i;
				$hold = $databasetable[$tablesname][$j][$name];
			}
			return $array;
		} else {
			return NULL;
		}
	}
	
	protected function OutputArrayElement($array, $tag) {
		$i = 0;
		while (array_key_exists($i, $array)) {
			if ($array[$i] != NULL) {
				$this->OutputSingleElement($array[$i], $tag);
			}
			$i++;
		}
	}
	
	protected function OutputSingleElement($text, $tag) {
		$this->Writer->startElement($tag);
		$this->Writer->text($text);
		$this->Writer->endElement();
	}
	
	protected function OutputSingleElementRaw($text, $tag) {
		$this->Writer->startElement($tag);
		$this->Writer->writeRaw($text);
		$this->Writer->writeRaw("\n   ");
		$this->Writer->endElement();
	}
	
}
?>
