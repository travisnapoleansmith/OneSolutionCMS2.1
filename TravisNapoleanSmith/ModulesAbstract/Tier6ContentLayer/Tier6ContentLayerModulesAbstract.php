<?php

abstract class Tier6ContentLayerModulesAbstract extends LayerModulesAbstract
{
	protected $Writer;
	protected $GlobalWriter;
	protected $FileName;
	protected $NoAttributes;
	
	protected $RevisionID;
	protected $CurrentVersion;
	
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
	
	public function getRevisionID() {
		return $this->RevisionID;
	}
	
	public function getCurrentVersion() {
		return $this->CurrentVersion;
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
	
	public function getStripTagsContent($Content) {
		if (is_array($Content)) {
			reset($Content);
			while (current($Content)) {
				$Content[key($Content)] = $this->getStripTagsContent(current($Content));
				next($Content);
			}
			return $Content;
		} else {
			return $this->StripTagsContent($Content);
		}
	}
	
	public function getTag(array $Content) {
		return $this->SearchContentForTag($Content['Tag'], $Content['Content']);
	}
	
	public function removeTag(array $Content) {
		return $this->SearchReplaceTag($Content['Tag'], $Content['Content']);
	}
	
	public function addWordSpace(array $Content) {
		return $this->SearchReplaceWordSpace($Content['Content']);
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
	
	protected function CreateWordWrap($WordWrapString) {
		$args = func_get_args();
		if ($args[1]) {
			$WordSpacing = $args[1];
		} else {
			$WordSpacing = "\t";
		}
		if (stristr($WordWrapString, '<a href')) {
			// Strip AHef Tags for wordwrap then put them back in
			$FirstPos = strpos($WordWrapString, '<a href');
			$LastPos = strpos($WordWrapString, '</a>');
			$LastPos = $LastPos + 3;
			
			// Split a string into an array - character by character
			$NewWordWrapString = Array();
			$j = 0;
			$End = strlen($WordWrapString);
			while ($j <= $End) {
				array_push ($NewWordWrapString, $WordWrapString[$j]);
				$j++;
			}
			
			$j = $FirstPos;
			while ($j <= $LastPos) {
				$EndString .= $NewWordWrapString[$j];
				$j++;
			}
			
			$ReturnString = $EndString;
			$ReturnString = str_replace (' ', '<SPACE>', $ReturnString);
			$WordWrapString = str_replace ($EndString, $ReturnString, $WordWrapString);
			
			// End STRIP AHREF TAG FOR WORDWRAP
			$WordWrapString = wordwrap($WordWrapString, 85, "\n$WordSpacing");
			$WordWrapString = str_replace ($ReturnString, $EndString, $WordWrapString);
			
		} else {
			$WordWrapString = wordwrap($WordWrapString, 85, "\n$WordSpacing");
		}
		
		return $WordWrapString;
	}
	
	protected function StripTagsContent($Content) {
		if (!is_array($Content)) {
			if (!is_null($Content)) {
				$Pattern = "/(<(.*?)>(.*?)<\/(.*?)>)/";
				$StrippedContent = preg_split($Pattern, $Content);
				$StrippedContent = implode($StrippedContent);
				$StrippedContent = strip_tags($StrippedContent);
			
				return $StrippedContent;
			} else {
				array_push($this->ErrorMessage,'StripTagsContent: Content cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'StripTagsContent: Content cannot be an array!');
		}
	}
	
	protected function SearchContentForTag($Tag, $Content) {
		if (!is_array($Content) && !is_array($Tag)) {
			if (!is_null($Content) && !is_null($Tag)) {
				$Pattern = "/(<$Tag(.*?)>(.*?)<\/$Tag>)/";
				preg_match_all($Pattern, $Content, $SearchContent);
				return $SearchContent;
			} else {
				array_push($this->ErrorMessage,'SearchContentForTag: Tag and Content cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'SearchContentForTag: Tag and Content cannot be an array!');
		}
	}
	
	protected function SearchReplaceTag ($Tag, $Content) {
		if (!is_array($Content)) {
			if (!is_null($Content) && !is_null($Tag)) {
				if (is_array($Tag)) {
					reset($Tag);
					while (current($Tag)) {
						$tag = current($Tag);
						$Pattern = "/(<$tag(.*?)>)/";
						$Content = preg_replace($Pattern, '', $Content);
						$Pattern = "/(<\/$tag>)/";
						$Content = preg_replace($Pattern, '', $Content);
						next($Tag);
					}
					return $Content;
				} else {
					$Pattern = "/(<$Tag(.*?)>)/";
					$Content = preg_replace($Pattern, '', $Content);
					$Pattern = "/(<\/$Tag>)/";
					$Content = preg_replace($Pattern, '', $Content);
					return $Content;
				}
			} else {
					array_push($this->ErrorMessage,'SearchReplaceTag: Tag and Content cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'SearchReplaceTag: Content cannot be an array!');
		}
	}
	
	protected function SearchReplaceWordSpace($Content) {
		if (!is_array($Content)) {
			if (!is_null($Content)) {
				$Pattern = "/(?<!\ )[A-Z]|[0-9]+/";
				$Content = preg_replace($Pattern, ' $0', $Content);
				$Content = trim($Content);
				return $Content;
			} else {
				array_push($this->ErrorMessage,'SearchReplaceWordSpace: Content cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'SearchReplaceWordSpace: Content cannot be an array!');
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
	
	protected function ProcessArrayStandardAttribute($startingvariablename) {
		$variablehold = $startingvariablename . 'AccessKey';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('accesskey', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'Class';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('class', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'Dir';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('dir', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'ID';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('id', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'Lang';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('lang', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'Style';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('style', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'TabIndex';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('tabindex', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'Title';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('title', current($this->$variablehold));
			}
		}
		$variablehold = $startingvariablename . 'XMLLang';
		if ($this->$variablehold) {
			if (current($this->$variablehold)) {
				$this->Writer->writeAttribute('xml:lang', current($this->$variablehold));
			}
		}
	}
	
	protected function ProcessStandardAttribute($startingvariablename) {
		$variablehold = $startingvariablename . 'AccessKey';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('accesskey', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'Class';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('class', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'Dir';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('dir', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'ID';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('id', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'Lang';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('lang', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'Style';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('style', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'TabIndex';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('tabindex', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'Title';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('title', $this->$variablehold);
		}
		$variablehold = $startingvariablename . 'XMLLang';
		if ($this->$variablehold) {
			$this->Writer->writeAttribute('xml:lang', $this->$variablehold);
		}
	}
	
}
?>
