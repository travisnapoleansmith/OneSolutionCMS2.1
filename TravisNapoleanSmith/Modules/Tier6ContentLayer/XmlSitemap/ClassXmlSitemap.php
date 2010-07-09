<?php

class XmlSitemap extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $TableNames = array();
	protected $SitemapTables = array();
	
	protected $PageID = array();
	protected $Loc = array();
	protected $Lastmod = array();
	protected $ChangeFreq = array();
	protected $Priority = array();
	protected $EnableDisable = array();
	protected $Status = array();
	
	protected $XmlSitemap;
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XmlSitemap'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XmlSitemap'][$hold];
		$this->ErrorMessage = array();
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
			$this->Writer->startDocument('1.0' , 'UTF-8');
			$this->Writer->setIndent(4);
			
			$this->Writer->startElement('urlset');
			$this->Writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
			
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
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->LayerModule->setDatabasetable (current($this->TableNames));
			next($this->TableNames);
		}
	}
	
	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->LayerModule->createDatabaseTable(current($this->TableNames));
			$this->LayerModule->Connect(current($this->TableNames));
			$this->LayerModule->pass (current($this->TableNames), 'setEntireTable', array());
			$this->LayerModule->Disconnect(current($this->TableNames));
			$this->SitemapTables[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getEntireTable', array());
			$i = 1;
			while ($this->SitemapTables[current($this->TableNames)][$i]['PageID']) {
				array_push($this->PageID, $this->SitemapTables[current($this->TableNames)][$i]['PageID']);
				array_push($this->Loc, $this->SitemapTables[current($this->TableNames)][$i]['Loc']);
				array_push($this->Lastmod, $this->SitemapTables[current($this->TableNames)][$i]['Lastmod']);
				array_push($this->ChangeFreq, $this->SitemapTables[current($this->TableNames)][$i]['ChangeFreq']);
				array_push($this->Priority, $this->SitemapTables[current($this->TableNames)][$i]['Priority']);
				array_push($this->EnableDisable, $this->SitemapTables[current($this->TableNames)][$i]['Enable/Disable']);
				array_push($this->Status, $this->SitemapTables[current($this->TableNames)][$i]['Status']);

				$i++;
			}
			next($this->TableNames);
		}		
	}
	
	public function CreateOutput($space) {
		reset($this->PageID);
		while (current($this->PageID)) {
			$PageId = current($this->PageID);
			$Loc = current($this->Loc);
			$Lastmod = current($this->Lastmod);
			$ChangeFreq = current($this->ChangeFreq);
			$Priority = current($this->Priority);
			$EnableDisable = current($this->EnableDisable);
			$Status = current($this->Status);
			
			if ($EnableDisable == 'Enable' & $Status == 'Approved') {
				$this->Writer->startElement('url');
				if ($Loc) {
					$this->Writer->startElement('loc');
					$this->Writer->text($Loc);
					$this->Writer->endElement();
				}
				
				if ($Lastmod) {
					$this->Writer->startElement('lastmod');
					$this->Writer->text($Lastmod);
					$this->Writer->endElement();
				}
				
				if ($ChangeFreq) {
					$this->Writer->startElement('changefreq');
					$this->Writer->text($ChangeFreq);
					$this->Writer->endElement();
				}
				
				if ($Priority) {
					$this->Writer->startElement('priority');
					$this->Writer->text($Priority);
					$this->Writer->endElement();
				}
				
				$this->Writer->endElement();
			}
			next($this->PageID);
			next($this->Loc);
			next($this->Lastmod);
			next($this->ChangeFreq);
			next($this->Priority);
			next($this->EnableDisable);
			next($this->Status);
		}
		$this->Writer->endElement();
		$this->Writer->endDocument();
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
		
	}
	
	public function createSitemapItem(array $Item) {
		if ($Item != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'Loc';
			$Keys[2] = 'Lastmod';
			$Keys[3] = 'ChangeFreq';
			$Keys[4] = 'Priority';
			$Keys[5] = 'Enable/Disable';
			$Keys[6] = 'Status';
			
			reset($this->TableNames);
			while (current($this->TableNames)) {
				$this->addModuleContent($Keys, $Item, current($this->TableNames));
				next($this->TableNames);
			}
		} else {
			array_push($this->ErrorMessage,'createStoryFeed: Header cannot be NULL!');
		}
	}
	
	public function updateSitemapItem(array $PageID) {
		if ($PageID != NULL) {
			reset($this->TableNames);
			while (current($this->TableNames)) {
				$this->updateRecord($PageID['PageID'], $PageID['Content'], current($this->TableNames));
				next($this->TableNames);
			}
		} else {
			array_push($this->ErrorMessage,'updateSitemapItem: PageID cannot be NULL!');
		}
	}
	
	public function deleteSitemapItem(array $PageID) {
		if ($PageID != NULL) {
			reset($this->TableNames);
			while (current($this->TableNames)) {
				$this->deleteModuleContent($PageID, current($this->TableNames));
				next($this->TableNames);
			}
			
		} else {
			array_push($this->ErrorMessage,'deleteStoryFeed: PageID cannot be NULL!');
		}
	}
	
	public function updateSitemapItemStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['XMLItem'] = $PageID['XMLItem'];
			
			while (current($this->TableNames)) {
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
				next($this->TableNames);
			}
				
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryDateStatus: PageID cannot be NULL!');
		}
	}
	
}
?>