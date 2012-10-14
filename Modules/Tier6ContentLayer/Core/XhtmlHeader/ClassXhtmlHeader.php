<?php

class XhtmlHeader extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules 
{
	protected $TableNames = array();
	
	protected $PageTitle;
	protected $PageIcon;
	protected $Rss2_0;
	protected $Rss0_92;
	protected $Atom0_3;
	protected $BaseHref;
	protected $MetaName;
	protected $MetaNameContent;
	protected $HttpEquivType;
	protected $HttpEquivTypeContent;
	protected $LinkCharset;
	protected $LinkHref;
	protected $LinkHreflang;
	protected $LinkMedia;
	protected $LinkRel;
	protected $LinkRev;
	protected $LinkType;
	
	protected $ThemeName;
	protected $StyleSheet;
	
	protected $IE6StyleSheet;
	protected $IE7StyleSheet;
	protected $IE8StyleSheet;
	protected $IE9StyleSheet;
	
	protected $BlackberryOS5StyleSheet;
	protected $BlackberryOS6StyleSheet;
	protected $BlackberryPlaybookStyleSheet;
	protected $AppleiPhoneStyleSheet;
	protected $AppleiPadStyleSheet;
	protected $AppleiPodStyleSheet;
	protected $AndroidStyleSheet;
	
	protected $PrintPreviewStyleSheet;
	
	protected $JavaScriptSheet;
	protected $ScriptStyleSheet;
	protected $ScriptStyleSheetCharset;
	protected $ScriptStyleSheetCode;
	protected $ScriptStyleSheetDefer;
	protected $ScriptJavaScriptSheet;
	protected $ScriptJavaScriptSheetCharset;
	protected $ScriptJavaScriptSheetCode;
	protected $ScriptJavaScriptDefer;
	protected $ScriptVBScriptSheet;
	protected $ScriptVBScriptCharset;
	protected $ScriptVBScriptCode;
	protected $ScriptVBScriptDefer;
	
	protected $Theme;
	protected $SiteName;
	
	/**
	 * Create an instance of XtmlHeader
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlHeader'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlHeader'][$hold];
		$this->ErrorMessage = array();
		
		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
		
		while (current($TableNames)) {
			$this->TableNames[key($TableNames)] = current($TableNames);
			next($TableNames);
		}
		
		$this->HttpAccept = $_SERVER['HTTP_ACCEPT'];
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
	
	public function setSiteName ($SiteName) {
		$this->SiteName = $SiteName;
	}
	
	public function getSiteName() {
		return $this->SiteName;
	}
	
	public function getPage(){
		return $this->Page;
	}
	
	function FetchDatabase ($PageID) {
		reset($this->TableNames);
		
		$this->Theme = $PageID['Theme'];
		unset($PageID['Theme']);
		
		$this->LayerModule->Connect(current($this->TableNames));
		$passarray = array();
		$passarray = $PageID;
		$this->LayerModule->pass (current($this->TableNames), 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect(current($this->TableNames));
		
		$this->FillArray('MetaName', 'MetaName');
		$this->FillArray('MetaNameContent', 'MetaNameContent');
		$this->FillArray('HttpEquivType', 'HttpEquivType');
		$this->FillArray('HttpEquivTypeContent', 'HttpEquivTypeContent');
		
		$this->FillArray('LinkCharset', 'LinkCharset');
		$this->FillArray('LinkHref', 'LinkHref');
		$this->FillArray('LinkHreflang', 'LinkHreflang');
		$this->FillArray('LinkMedia', 'LinkMedia');
		$this->FillArray('LinkRel', 'LinkRel');
		$this->FillArray('LinkRev', 'LinkRev');
		$this->FillArray('LinkType', 'LinkType');
		
		$this->PageID = $PageID['PageID'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		$this->PageTitle = $this->LayerModule->pass (current($this->TableNames), 'getRowField',  array('rowfield' => 'PageTitle'));
		$this->PageIcon = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'PageIcon'));
		$this->Rss2_0 = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'Rss2.0'));
		$this->Rss0_92 = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'Rss0.92'));
		$this->Atom0_3 = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'Atom0.3'));
		$this->BaseHref = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'BaseHref'));
		
		$this->EnableDisable = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->Status = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'Status'));
		
		next($this->TableNames);
		
		$passarray = array();
		if ($this->Theme) {
			$passarray['ThemeName'] = $this->Theme;
		} else {
			$passarray['Enable/Disable'] = 'Enable';
		}

		$this->LayerModule->Connect(current($this->TableNames));
		$this->LayerModule->pass (current($this->TableNames), 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect(current($this->TableNames));
		
		$this->ThemeName = $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => 'ThemeName'));
		
		if ($this->ThemeName) {
			$GLOBALS['ThemeName'] = $this->ThemeName;
		}
		
		if ($this->HttpUserAgent) {
			$this->StyleSheetBuild('IE6StyleSheet');
			$this->StyleSheetBuild('IE7StyleSheet');
			$this->StyleSheetBuild('IE8StyleSheet');
			$this->StyleSheetBuild('IE9StyleSheet');
			
			$this->StyleSheetBuild('BlackberryOS5StyleSheet');
			$this->StyleSheetBuild('BlackberryOS6StyleSheet');
			$this->StyleSheetBuild('BlackberryPlaybookStyleSheet');
			$this->StyleSheetBuild('AppleiPhoneStyleSheet');
			$this->StyleSheetBuild('AppleiPadStyleSheet');
			$this->StyleSheetBuild('AppleiPodStyleSheet');
			$this->StyleSheetBuild('AndroidStyleSheet');
		}
		
		$this->FillArray('StyleSheet', 'StyleSheet');
		$this->FillArray('JavaScriptSheet', 'JavaScriptSheet');
		$this->FillArray('PrintPreviewStyleSheet', 'PrintPreviewStyleSheet');
		$this->FillArray('ScriptStyleSheet', 'ScriptStyleSheet');
		$this->FillArray('ScriptStyleSheetCharset', 'ScriptStyleSheetCharset');
		$this->FillArray('ScriptStyleSheetCode', 'ScriptStyleSheetCode');
		$this->FillArray('ScriptStyleSheetDefer', 'ScriptStyleSheetDefer');
		$this->FillArray('ScriptJavaScriptSheet', 'ScriptJavaScriptSheet');
		$this->FillArray('ScriptJavaScriptSheetCharset', 'ScriptJavaScriptSheetCharset');
		$this->FillArray('ScriptJavaScriptSheetCode', 'ScriptJavaScriptSheetCode');
		$this->FillArray('ScriptJavaScriptSheetDefer', 'ScriptJavaScriptSheetDefer');
		$this->FillArray('ScriptVBScriptSheet', 'ScriptVBScriptSheet');
		$this->FillArray('ScriptVBScriptSheetCharset', 'ScriptVBScriptSheetCharset');
		$this->FillArray('ScriptVBScriptSheetCode', 'ScriptVBScriptSheetCode');
		$this->FillArray('ScriptVBScriptSheetDefer', 'ScriptVBScriptSheetDefer');
	}
	
	protected function FillArray($arrayname, $arrayvalue) {
		$i = 1;
		$temp = $arrayvalue;
		$temp .= $i;
		$j = 0;
		$this->$arrayname = Array();
		while ($this->LayerModule->pass (current($this->TableNames), 'searchFieldNames', array('temp' => $temp))) {
			if ($this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => $temp))) {
				array_push($this->$arrayname, $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => $temp)));
			} else {
				array_push($this->$arrayname, NULL);
			}
			$i++;
			$temp = $arrayvalue;
			$temp .= $i;
		}
		$this->NullArrayWalk ($arrayname, 0, count($this->$arrayname));
	}
	
	protected function PrintArrayHelper ($item, $nametag ){
		$this->Writer->writeAttribute($nametag, $item);
	}
	
	protected function PrintArray($arraynames, $starttag, $arraynametags) {
		$i = 1;
		$j = 0;
		$flag = NULL;
		$holdname = $arraynames[$j];
		$hold = $this->$holdname;
		$max = count($hold);
		$nametag = $arraynametags[$j];
		while ($j < $max) {
			if ($hold[$j]) {
				$this->Writer->startElement($starttag);
				$temp = $hold[$j];
				
				$this->PrintArrayHelper ($hold[$j], $nametag);
				$flag = TRUE;
			} else {
				$flag = NULL;
			}
			
			if (!empty($arraynames)) {
				$holdname2 = $arraynames[$i];
			}
			if (!empty($holdname2)) {
				$hold2 = $this->$holdname2;
			} else {
				$hold2 = NULL;
			}
			if (!empty($arraynametags)) {
				$nametag2 = $arraynametags[$i];
			}
			
			while ($hold2) {			
				if (!$flag & !empty($hold2[$j])) {
					$this->Page->startElement($starttag);
				}
				if (!empty($hold2[$j])) {
					$flag = TRUE;
					$this->PrintArrayHelper ($hold2[$j], $nametag2);
				}
				$i++;
				if (!empty($arraynames)) {
					$holdname2 = $arraynames[$i];
				}
				if (!empty($holdname2)) {
					$hold2 = $this->$holdname2;
				} else {
					$hold2 = NULL;
				}
				if (!empty($arraynametags)) {
					$nametag2 = $arraynametags[$i];
				}
			}
				if ($hold[$j] || $flag) {
					$this->Writer->endElement();
				}
				
			$i = 1;
			$j++;
		}
	}
	
	protected function NullArrayWalk($arrayname, $key, $max) {
		$hasvalue = FALSE;
		$i = 0;
		while ($i < $max) {
			if ($this->{$arrayname}[$i] != NULL) {
				$hasvalue = TRUE;
			}
			$i++;
		}
		
		if (!$hasvalue) {
			$this->$arrayname = NULL;
		}
	}
	
	protected function StyleSheetBuild($StyleSheetName){
		$i = 1;
		$temp = $StyleSheetName;
		$temp .= $i;
		$this->$StyleSheetName = Array ();
		while ($this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => $temp))) {
			array_push($this->$StyleSheetName, $this->LayerModule->pass (current($this->TableNames), 'getRowField', array('rowfield' => $temp)));
			$i++;
			$temp = $StyleSheetName;
			$temp .= $i;
		}
	}
	
	protected function TagSheet($starttag, $rel, $type, $charset, $defer, $title, $src, $href, $intag, $endtag) {
		$i = 0;
		$max = 1;
		if (is_array($rel)) {
			$this->ArrayCheck($rel);
			$max = count($rel);
		} 
		if (is_array($type)) {
			$this->ArrayCheck($type);
			$max = count($type);
		} 
		if (is_array($charset)) {
			$this->ArrayCheck($charset);
			$max = count($charset);
		} 
		if (is_array($defer)) {
			$this->ArrayCheck($defer);
			$max = count($defer);
		} 
		if (is_array($title)) {
			$this->ArrayCheck($title);
			$max = count($title);
		} 
		if (is_array($src)) {
			$this->ArrayCheck($src);
			$max = count($src);
		} 
		if (is_array($href)) {
			$this->ArrayCheck($href);
			$max = count($href);
		} 
		if (is_array($intag)) {
			$this->ArrayCheck($intag);
			$max = count($intag);
		}
		
		if ($intag) {
			$intag = str_replace("\n", "\n   ", $intag); 
		}
		
		while ($i < $max) {
			$this->Writer->startElement($starttag);
			
			if ($rel) {
				$this->TagSheetCheck($rel, 'rel', $i);
			}
			
			if ($type) {
				$this->TagSheetCheck($type, 'type', $i);
			}
			
			if ($charset) {
				$this->TagSheetCheck($charset, 'charset', $i);
			}
			
			if ($defer) {
				$this->TagSheetCheck($defer, 'defer', $i);
			}
			
			if ($title) {
				$this->TagSheetCheck($title, 'title', $i);
			}
			
			if ($src) {
				$this->TagSheetCheck($src, 'src', $i);
			}
			
			if ($href) {
				$this->TagSheetCheck($href, 'href', $i);
			}
			
			if ($endtag) {
				if ($intag) {
					$this->TagSheetCheck($intag, NULL, $i);
					
				}
			} 
			if ($starttag == 'script') {
				$this->Writer->fullEndElement();
				$this->Writer->writeRaw("\n");
			} else {
				$this->Writer->endElement();
			}
			$i++;
		}
	}
	
	protected function TagSheetCheck ($tag, $tagname, $i) {
		if (is_array($tag)) {
			if ($tag[$i] != NULL) {
				$this->TagSheetOutput($tagname, $tag[$i]);
			}
		} else {
			$this->TagSheetOutput($tagname, $tag);
		}
	}
	
	protected function TagSheetOutput($tag, $tagvalue) {
		$this->Writer->writeAttribute($tag, $tagvalue);
	}
	
	protected function ArrayCheck(&$array) {
		$i = 0;
		$max = count($array);
		while ($i < $max) {
			if (!$array[$i]) {
				unset($array[$i]);
			}
			$i++;
		}
	}
	
	public function CreateOutput ($space) {
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved') {
			$arguments = func_get_args();
			$printpreviewflag = $arguments[0];
			$stylesheet = $arguments[1];
			
			// Determines if the browser will support XHTML or not and outputs the proper header for XHTML or HTML
			if (isset($this->HttpAccept)) {
				//if (stristr($this->HttpAccept, 'application/xhtml+xml')) {
					//header ('Content-type: application/xhtml+xml');
				//} else {
					header ('Content-type: text/html');
				//}
			}
			// USING NEW XMLWRITER
			// STARTS HEADER
			$this->Writer->startDTD('html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"');
			$this->Writer->endDTD();
			
			$this->Writer->startElement('html');
			$this->Writer->writeAttribute('lang', 'en-US');
			$this->Writer->writeAttribute('xml:lang', 'en-US');
			$this->Writer->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
			
			$this->Writer->startElement('head');
			
			$this->Writer->startElement('meta');
			$this->Writer->writeAttribute('http-equiv', 'Content-Type');
			$this->Writer->writeAttribute('content', 'text/html; charset=iso-8859-1');
			$this->Writer->endElement(); //ENDS META
			
			$this->Writer->startElement('title');
			if ($printpreviewflag) {
				$this->Writer->text('Print Preview');
				if ($this->PageTitle || $this->SiteName) {
					$this->Writer->text(' - ');
				}
			}
			
			if ($this->PageTitle) {
				$this->Writer->writeRaw($this->PageTitle);
			}
			
			if ($this->SiteName) {
				if ($this->PageTitle) {
					$this->Writer->text(' - ');
				}
				$this->Writer->text($this->SiteName);
			}
			$this->Writer->endElement(); // ENDS TITLE TAG
			$this->Writer->writeRaw("\n");
			
			if ($this->PageIcon){
				$this->TagSheet('link', 'icon', 'image/x-icon', NULL, NULL, NULL, NULL, $this->PageIcon, NULL, NULL);
			}
			
			if ($stylesheet && !$printpreviewflag){
				$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $stylesheet, NULL, NULL);
			} 
			
			if ($this->StyleSheet && !$printpreviewflag && !$stylesheet) {
				$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->StyleSheet, NULL, NULL);
			}
			
			if ($this->IE6StyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent, 'MSIE 6.0')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->IE6StyleSheet, NULL, NULL);
				}
			}
			
			if ($this->IE7StyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'MSIE 7.0')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->IE7StyleSheet, NULL, NULL);
				}
			}
			
			if ($this->IE8StyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'MSIE 8.0')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->IE8StyleSheet, NULL, NULL);
				}
			}
			
			if ($this->IE9StyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'MSIE 9.0')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->IE9StyleSheet, NULL, NULL);
				}
			}
			
			if ($this->BlackberryOS5StyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'BlackBerry') && strstr($this->HttpUserAgent, '/5.')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->BlackberryOS5StyleSheet, NULL, NULL);
				}
			}
			
			if ($this->BlackberryOS6StyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'BlackBerry') && strstr($this->HttpUserAgent, 'Version/6')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->BlackberryOS6StyleSheet, NULL, NULL);
				}
			}
			
			if ($this->BlackberryPlaybookStyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'PlayBook')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->BlackberryPlaybookStyleSheet, NULL, NULL);
				}
			}
			
			if ($this->AppleiPhoneStyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'iPhone')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->AppleiPhoneStyleSheet, NULL, NULL);
				}
			}
			
			if ($this->AppleiPadStyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'iPad')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->AppleiPadStyleSheet, NULL, NULL);
				}
			}
			
			if ($this->AppleiPodStyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'iPod')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->AppleiPodStyleSheet, NULL, NULL);
				}
			}
			
			if ($this->AndroidStyleSheet && !$printpreviewflag && !$stylesheet) {
				if (strstr($this->HttpUserAgent,'Android')) {
					$this->TagSheet('link', 'stylesheet', 'text/css', NULL, NULL, NULL, NULL, $this->AndroidStyleSheet, NULL, NULL);
				}
			}
			
			if ($this->Rss2_0 || $this->Rss0_92 || $this->Atom0_3) {
				$this->Writer->writeRaw("\n");
			}
			
			if ($this->Rss2_0) {
				$this->TagSheet('link', 'alternate', 'application/rss+xml', NULL, NULL, 'RSS 2.0', NULL, $this->Rss2_0, NULL, NULL);
			}
			
			if ($this->Rss0_92) {
				$this->TagSheet('link', 'alternate', 'text/xml', NULL, NULL, 'RSS .92', NULL, $this->RSS0_92, NULL, NULL);
			}
			
			if ($this->Atom0_3) {
				$this->TagSheet('link', 'alternate', 'application/atom+xml', NULL, NULL, 'Atom 0.3', NULL, $this->Atom0_3, NULL, NULL);
			}
			
			if ($this->Rss2_0 || $this->Rss0_92 || $this->Atom0_3) {
				$this->Writer->writeRaw("\n");
			}
			
			if ($this->BaseHref) {
				$this->TagSheet('base', NULL, NULL, NULL, NULL, NULL, NULL, $this->BaseHref, NULL, NULL);
			}
			
			if (!empty($this->MetaName) && !empty($this->MetaNameContent)) {
				//$this->Writer->writeRaw("\n");
				$metaarray[0] = 'MetaName';
				$metaarray[1] = 'MetaNameContent';
				$metanamesarray[0] = 'name';
				$metanamesarray[1] = 'content';
				$this->PrintArray($metaarray, 'meta', $metanamesarray);
			}
			
			if (!empty($this->HttpEquivType) && !empty($this->HttpEquivTypeContent)) {
				$httpequivtypearray[0] = 'HttpEquivType';
				$httpequivtypearray[1] = 'HttpEquivTypeContent';
				$httpequivnamesarray[0] = 'http-equiv';
				$httpequivnamesarray[1] = 'content';
				$this->PrintArray($httpequivtypearray, 'meta', $httpequivnamesarray);
			}
	
			if (!empty($this->LinkCharset) || !empty($this->LinkHref) || !empty($this->LinkMedia) || !empty($this->LinkRel) || !empty($this->LinkRev) || !empty($this->LinkType)) {
				$linkarray = Array();
				$linknamearray = Array();
				if (!empty($this->LinkCharset)) {
					array_push($linkarray, 'LinkCharset');
					array_push($linknamearray, 'charset');
				}
				if (!empty($this->LinkHref)) {
					array_push($linkarray, 'LinkHref');
					array_push($linknamearray, 'href');
				}
				if (!empty($this->LinkHreflang)){
					array_push($linkarray, 'LinkHreflang');
					array_push($linknamearray, 'hreflang');
				}
				if (!empty($this->LinkMedia)) {
					array_push($linkarray, 'LinkMedia');
					array_push($linknamearray, 'media');
				}
				if (!empty($this->LinkRel)) {
					array_push($linkarray, 'LinkRel');
					array_push($linknamearray, 'rel');
				}
				if (!empty($this->LinkRev)) {
					array_push($linkarray, 'LinkRev');
					array_push($linknamearray, 'rev');
				}
				if (!empty($this->LinkType)) {
					array_push($linkarray, 'LinkType');
					array_push($linknamearray, 'type');
				}
				$this->PrintArray($linkarray, 'link', $linknamearray);
			}
			
			if (!empty($this->JavaScriptSheet) && !$printpreviewflag && !$stylesheet) {
				$this->TagSheet('script', NULL, NULL, NULL, NULL, NULL, $this->JavaScriptSheet, NULL, NULL, NULL);
			}
			
			if (!empty($this->PrintPreviewStyleSheet) && $printpreviewflag && !$stylesheet) {
				$this->TagSheet('link', NULL, 'text/css', NULL, NULL, NULL, NULL, $this->PrintPreviewStyleSheet, NULL, NULL);
			}
			
			if (!empty($this->ScriptStyleSheet) && !$printpreviewflag && !$stylesheet) {
				$this->TagSheet('script', NULL, 'text/css', $this->ScriptStyleSheetCharset, NULL, NULL, $this->ScriptStyleSheet, NULL, NULL, 'script');
			}
			
			if (!empty($this->ScriptStyleSheetCode) && !$printpreviewflag && !$stylesheet) {
				$this->TagSheet('script', null, 'text/css', NULL, $this->ScriptStyleSheetDefer, NULL, NULL, NULL, $this->ScriptStyleSheetCode, 'script');
			}
			if (!empty($this->ScriptJavaScriptSheet) && !$printpreviewflag) {
				$this->TagSheet('script', NULL, 'text/javascript', $this->ScriptJavaScriptSheetCharset, NULL, NULL, $this->ScriptJavaScriptSheet, NULL, NULL, 'script');
			}
			
			if (!empty($this->ScriptJavaScriptSheetCode) && !$printpreviewflag) {
				$this->TagSheet('script', null, 'text/javascript', NULL, $this->ScriptJavaScriptSheetDefer, NULL, NULL, NULL, $this->ScriptJavaScriptSheetCode, 'script');
			}
			
			if (!empty($this->ScriptVBScriptSheet) && !$printpreviewflag) {
				$this->TagSheet('script', NULL, 'text/vbscript', $this->ScriptVBScriptSheetCharset, NULL, NULL, $this->ScriptVBScriptSheet, NULL, NULL, 'script');
			}
			
			if (!empty($this->ScriptVBScriptSheetCode) && !$printpreviewflag) {
				$this->TagSheet('script', null, 'text/vbscript', NULL, $this->ScriptVBScriptSheetDefer, NULL, NULL, NULL, $this->ScriptVBScriptSheetCode, 'script');
			}
			
			$this->Writer->endElement(); // END HEAD TAG
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	public function createHeader(array $Header) {
		if ($Header != NULL) {
			$this->LayerModule->pass (current($this->TableNames), 'BuildFieldNames', array('TableName' => current($this->TableNames)));
			$Keys = $this->LayerModule->pass (current($this->TableNames), 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $Header, current($this->TableNames));
		} else {
			array_push($this->ErrorMessage,'createHeader: Header cannot be NULL!');
		}
	}
	
	public function updateHeader(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, current($this->TableNames));
		} else {
			array_push($this->ErrorMessage,'updateHeader: PageID cannot be NULL!');
		}
	}
	
	public function deleteHeader(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, current($this->TableNames));
		} else {
			array_push($this->ErrorMessage,'deleteHeader: PageID cannot be NULL!');
		}
	}
	
	public function updateHeaderStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, current($this->TableNames));
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, current($this->TableNames));
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, current($this->TableNames));
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, current($this->TableNames));
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, current($this->TableNames));
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, current($this->TableNames));
			}
		} else {
			array_push($this->ErrorMessage,'updateHeaderStatus: PageID cannot be NULL!');
		}
	}
	
}
?>
