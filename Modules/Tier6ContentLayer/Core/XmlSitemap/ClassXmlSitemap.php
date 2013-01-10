<?php
/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2012 One Solution CMS
*
* This content management system is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2.1 of the License, or (at your option) any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.
*
* You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
* @version    2.1.139, 2012-12-27
*************************************************************************************
*/
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

	/**
	 * Create an instance of XmlSitemap
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XmlSitemap'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XmlSitemap'][$hold];
		$this->ErrorMessage = array();

		while (current($TableNames)) {
			$this->TableNames[key($TableNames)] = current($TableNames);
			next($TableNames);
		}

		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}

		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
			$this->Writer->startDocument('1.0' , 'UTF-8');
			$this->Writer->setIndent(4);

			$this->Writer->startElement('urlset');
			$this->Writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

		} else {
			if ($databaseoptions['Screen']) {
				$this->Writer = new XMLWriter();
				$this->Writer->openMemory();
				$this->Writer->startDocument('1.0' , 'UTF-8');
				$this->Writer->setIndent(4);

				$this->Writer->startElement('urlset');
				$this->Writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
			} else {
				$this->Writer = &$GLOBALS['Writer'];
			}
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
		} else {
			$this->XmlSitemap = $this->Writer->flush();
		}

	}

	public function getOutput() {
		return $this->XmlSitemap;
	}

	public function createSitemapItem(array $Item) {
		if ($Item != NULL) {
			reset($this->TableNames);
			while (current($this->TableNames)) {
				$this->LayerModule->pass (current($this->TableNames), 'BuildFieldNames', array('TableName' => current($this->TableNames)));
				$Keys = $this->LayerModule->pass (current($this->TableNames), 'getRowFieldNames', array());
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
			$PassID['PageID'] = $PageID['PageID'];

			reset($this->TableNames);
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
			array_push($this->ErrorMessage,'updateSitemapItemStatus: PageID cannot be NULL!');
		}
	}

}
?>