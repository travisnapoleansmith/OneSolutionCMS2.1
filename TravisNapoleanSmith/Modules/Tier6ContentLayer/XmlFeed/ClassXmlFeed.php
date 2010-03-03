<?php

class XmlFeed extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XmlProtectionLayer;
	
	protected $TableNames = array();
	protected $XMLFeedTables = array();
	
	protected $XMLLink;
	
	protected $XMLFeedName = array();
	protected $FeedTitle = array();
	protected $FeedLink = array();
	protected $FeedDescription = array();
	protected $FeedCategory = array();
	protected $FeedCloud = array();
	protected $FeedCopyright = array();
	
	protected $FeedImage = array();
	protected $FeedImageUrl = array();
	protected $FeedImageTitle = array();
	protected $FeedImageLink = array();
	protected $FeedImageDescription = array();
	protected $FeedImageHeight = array();
	protected $FeedImageWidth = array();
	
	protected $FeedLanguage = array();
	protected $FeedLastBuildDate = array();
	protected $FeedManagingEditor = array();
	protected $FeedPubDate = array();
	protected $FeedRating = array();
	
	protected $FeedSkipDays = array();
	protected $FeedSkipDaysNumber = array();
	protected $FeedSkipHours = array();
	protected $FeedSkipHoursNumber = array();
	
	protected $FeedTextInput = array();
	protected $FeedTextInputDescription = array();
	protected $FeedTextInputName = array();
	protected $FeedTextInputLink = array();
	protected $FeedTextInputTitle = array();
	protected $FeedTTL = array();
	protected $FeedWebMaster = array();
	protected $FeedEnableDisable = array();
	protected $FeedStatus = array();
	
	protected $StoryXMLItem = array();
	protected $StoryFeedItemTitle = array();
	protected $StoryFeedItemLink = array();
	protected $StoryFeedItemDescription = array();
	protected $StoryFeedItemAuthor = array();
	protected $StoryFeedItemCategory = array();
	protected $StoryFeedItemComments = array();
	
	protected $StoryFeedItemEnclosure = array();
	protected $StoryFeedItemEnclosureLength = array();
	protected $StoryFeedItemEnclosureType = array();
	protected $StoryFeedItemEnclosureUrl = array();
	
	protected $StoryFeedItemGuid = array();
	protected $StoryFeedItemPubDate = array();
	protected $StoryFeedItemSource = array();
	
	protected $StoryFeedEnableDisable = array();
	protected $StoryFeedStatus = array();
	
	protected $XmlFeed;
	
	public function __construct($tablenames, $database) {
		$this->XmlProtectionLayer = &$database;
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->Writer = new XMLWriter();
		if ($this->FileName) {
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer->openMemory();
		}
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
		
		$this->XMLLink = $GLOBALS['rsslink'];
		
		$this->Writer->startDocument('1.0' , 'UTF-8');
		$this->Writer->setIndent(4);
		
		$this->Writer->startElement('rss');
		$this->Writer->writeAttribute('version', '2.0');
		$this->Writer->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->XmlProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XmlProtectionLayer->setDatabasetable (current($this->TableNames));
			next($this->TableNames);
		}
	}
	
	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XmlProtectionLayer->Connect(current($this->TableNames));
			$this->XmlProtectionLayer->pass (current($this->TableNames), 'setEntireTable', array());
			$this->XmlProtectionLayer->Disconnect(current($this->TableNames));
			$this->XMLFeedTables[current($this->TableNames)] = $this->XmlProtectionLayer->pass (current($this->TableNames), 'getEntireTable', array());
			$i = 1;
			while ($this->XMLFeedTables[current($this->TableNames)][$i]['XMLFeedName']) {
				$key = $this->XMLFeedTables[current($this->TableNames)][$i]['XMLFeedName'];
				$this->XMLFeedName[$key] = array();
				$this->FeedTitle[$key] = array();
				$this->FeedLink[$key] = array();
				$this->FeedDescription[$key] = array();
				$this->FeedCategory[$key] = array();
				$this->FeedCloud[$key] = array();
				$this->FeedCopyright[$key] = array();
				
				$this->FeedImage[$key] = array();
				$this->FeedImageUrl[$key] = array();
				$this->FeedImageTitle[$key] = array();
				$this->FeedImageLink[$key] = array();
				$this->FeedImageDescription[$key] = array();
				$this->FeedImageHeight[$key] = array();
				$this->FeedImageWidth[$key] = array();
				
				$this->FeedLanguage[$key] = array();
				$this->FeedLastBuildDate[$key] = array();
				$this->FeedManagingEditor[$key] = array();
				$this->FeedPubDate[$key] = array();
				$this->FeedRating[$key] = array();
				
				$this->FeedSkipDays[$key] = array();
				$this->FeedSkipDaysNumber[$key] = array();
				$this->FeedSkipHours[$key] = array();
				$this->FeedSkipHoursNumber[$key] = array();
				
				$this->FeedTextInput[$key] = array();
				$this->FeedTextInputDescription[$key] = array();
				$this->FeedTextInputName[$key] = array();
				$this->FeedTextInputLink[$key] = array();
				$this->FeedTextInputTitle[$key] = array();
				$this->FeedTTL[$key] = array();
				$this->FeedWebMaster[$key] = array();
				$this->FeedEnableDisable[$key] = array();
				$this->FeedStatus[$key] = array();
	
				array_push($this->XMLFeedName[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['XMLFeedName']);
				array_push($this->FeedTitle[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTitle']);
				array_push($this->FeedLink[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedLink']);
				array_push($this->FeedDescription[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedDescription']);
				array_push($this->FeedCategory[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedCategory']);
				array_push($this->FeedCloud[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedCloud']);
				array_push($this->FeedCopyright[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedCopyright']);
				
				array_push($this->FeedImage[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImage']);
				array_push($this->FeedImageUrl[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImageUrl']);
				array_push($this->FeedImageTitle[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImageTitle']);
				array_push($this->FeedImageLink[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImageLink']);
				array_push($this->FeedImageDescription[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImageDescription']);
				array_push($this->FeedImageHeight[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImageHeight']);
				array_push($this->FeedImageWidth[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedImageWidth']);
				
				array_push($this->FeedLanguage[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedLanguage']);
				array_push($this->FeedLastBuildDate[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedLastBuildDate']);
				array_push($this->FeedManagingEditor[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedManagingEditor']);
				array_push($this->FeedPubDate[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedPubDate']);
				array_push($this->FeedRating[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedRating']);
				
				array_push($this->FeedSkipDays[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedSkipDays']);
				$this->FeedSkipDaysNumber = $this->ProcessArray($this->FeedSkipDaysNumber, 'FeedSkipDays', current($this->TableNames), $i, $key, $this->XMLFeedTables);
				array_push($this->FeedSkipHours[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedSkipHours']);
				$this->FeedSkipHoursNumber = $this->ProcessArray($this->FeedSkipHoursNumber, 'FeedSkipHours', current($this->TableNames), $i, $key, $this->XMLFeedTables);
				
				array_push($this->FeedTextInput[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTextInput']);
				array_push($this->FeedTextInputDescription[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTextInputDescription']);
				array_push($this->FeedTextInputName[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTextInputName']);
				array_push($this->FeedTextInputLink[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTextInputLink']);
				array_push($this->FeedTextInputTitle[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTextInputTitle']);
				array_push($this->FeedTTL[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedTTL']);
				array_push($this->FeedWebMaster[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['FeedWebMaster']);
				array_push($this->FeedEnableDisable[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['Enable/Disable']);
				array_push($this->FeedStatus[$key], $this->XMLFeedTables[current($this->TableNames)][$i]['Status']);
				
				$this->getFeedStories($key);
				$i++;
			}
			next($this->TableNames);
		}		
	}
	
	protected function getFeedStories($databasetable) {
		$hostname = $this->Hostname;
		$user = $this->User;
		$password = $this->Password;
		$databasename = $this->DatabaseName;
		
		$this->XmlProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->XmlProtectionLayer->setDatabasetable($databasetable);
		
		$this->XmlProtectionLayer->Connect($databasetable);
		$this->XmlProtectionLayer->pass ($databasetable, 'setEntireTable', array());
		$this->XmlProtectionLayer->Disconnect($databasetable);
				
		$this->XMLFeedTables[$databasetable] = $this->XmlProtectionLayer->pass ($databasetable, 'getEntireTable', array());
		
		$this->StoryXMLItem[$databasetable] = array();
	 	$this->StoryFeedItemTitle[$databasetable] = array();
	 	$this->StoryFeedItemLink[$databasetable] = array();
	 	$this->StoryFeedItemDescription[$databasetable] = array();
	 	$this->StoryFeedItemAuthor[$databasetable] = array();
		$this->StoryFeedItemCategory[$databasetable] = array();
	 	$this->StoryFeedItemComments[$databasetable] = array();
		
	 	$this->StoryFeedItemEnclosure[$databasetable] = array();
		$this->StoryFeedItemEnclosureLength[$databasetable] = array();
	 	$this->StoryFeedItemEnclosureType[$databasetable] = array();
	 	$this->StoryFeedItemEnclosureUrl[$databasetable] = array();
		
	 	$this->StoryFeedItemGuid[$databasetable] = array();
	 	$this->StoryFeedItemPubDate[$databasetable] = array();
	 	$this->StoryFeedItemSource[$databasetable] = array();
		
	 	$this->StoryFeedEnableDisable[$databasetable] = array();
	 	$this->StoryFeedStatus[$databasetable] = array();
		
		$i = 1;
		while (array_key_exists($i, $this->XMLFeedTables[$databasetable])) {
			array_push($this->StoryXMLItem[$databasetable], $this->XMLFeedTables[$databasetable][$i]['XMLItem']);
			array_push($this->StoryFeedItemTitle[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemTitle']);
			array_push($this->StoryFeedItemLink[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemLink']);
			array_push($this->StoryFeedItemDescription[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemDescription']);
			array_push($this->StoryFeedItemAuthor[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemAuthor']);
			array_push($this->StoryFeedItemCategory[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemCategory']);
			array_push($this->StoryFeedItemComments[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemComments']);
			
			array_push($this->StoryFeedItemEnclosure[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemEnclosure']);
			array_push($this->StoryFeedItemEnclosureLength[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemEnclosureLength']);
			array_push($this->StoryFeedItemEnclosureType[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemEnclosureType']);
			array_push($this->StoryFeedItemEnclosureUrl[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemEnclosureUrl']);
			
			array_push($this->StoryFeedItemGuid[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemGuid']);
			array_push($this->StoryFeedItemPubDate[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemPubDate']);
			array_push($this->StoryFeedItemSource[$databasetable], $this->XMLFeedTables[$databasetable][$i]['FeedItemSource']);
			
			array_push($this->StoryFeedEnableDisable[$databasetable], $this->XMLFeedTables[$databasetable][$i]['Enable/Disable']);
			array_push($this->StoryFeedStatus[$databasetable], $this->XMLFeedTables[$databasetable][$i]['Status']);
			
			$i++;
		}
	}
	
	public function CreateOutput($space) {
		while (current($this->XMLFeedName)) {
			reset($this->XMLFeedName[key($this->XMLFeedName)]);
			reset($this->FeedTitle[key($this->XMLFeedName)]);
			reset($this->FeedLink[key($this->XMLFeedName)]);
			reset($this->FeedDescription[key($this->XMLFeedName)]);
			reset($this->FeedCategory[key($this->XMLFeedName)]);
			reset($this->FeedCloud[key($this->XMLFeedName)]);
			reset($this->FeedCopyright[key($this->XMLFeedName)]);
			
			reset($this->FeedImage[key($this->XMLFeedName)]);
			reset($this->FeedImageUrl[key($this->XMLFeedName)]);
			reset($this->FeedImageTitle[key($this->XMLFeedName)]);
			reset($this->FeedImageLink[key($this->XMLFeedName)]);
			reset($this->FeedImageDescription[key($this->XMLFeedName)]);
			reset($this->FeedImageHeight[key($this->XMLFeedName)]);
			reset($this->FeedImageWidth[key($this->XMLFeedName)]);
			
			reset($this->FeedLanguage[key($this->XMLFeedName)]);
			reset($this->FeedLastBuildDate[key($this->XMLFeedName)]);
			reset($this->FeedManagingEditor[key($this->XMLFeedName)]);
			reset($this->FeedPubDate[key($this->XMLFeedName)]);
			reset($this->FeedRating[key($this->XMLFeedName)]);
			
			reset($this->FeedSkipDays[key($this->XMLFeedName)]);
			reset($this->FeedSkipDaysNumber[key($this->XMLFeedName)]);
			reset($this->FeedSkipHours[key($this->XMLFeedName)]);
			reset($this->FeedSkipHoursNumber[key($this->XMLFeedName)]);
			
			reset($this->FeedTextInput[key($this->XMLFeedName)]);
			reset($this->FeedTextInputDescription[key($this->XMLFeedName)]);
			reset($this->FeedTextInputName[key($this->XMLFeedName)]);
			reset($this->FeedTextInputLink[key($this->XMLFeedName)]);
			reset($this->FeedTextInputTitle[key($this->XMLFeedName)]);
			reset($this->FeedTTL[key($this->XMLFeedName)]);
			reset($this->FeedWebMaster[key($this->XMLFeedName)]);
			reset($this->FeedEnableDisable[key($this->XMLFeedName)]);
			reset($this->FeedStatus[key($this->XMLFeedName)]);
			
			while (current($this->XMLFeedName[key($this->XMLFeedName)])) {
				$XMLFeedName = current($this->XMLFeedName[key($this->XMLFeedName)]);
				$FeedTitle = current($this->FeedTitle[key($this->XMLFeedName)]);
				$FeedLink = current($this->FeedLink[key($this->XMLFeedName)]);
				$FeedDescription = current($this->FeedDescription[key($this->XMLFeedName)]);
				$FeedCategory = current($this->FeedCategory[key($this->XMLFeedName)]);
				$FeedCloud = current($this->FeedCloud[key($this->XMLFeedName)]);
				$FeedCopyright = current($this->FeedCopyright[key($this->XMLFeedName)]);
				
				$FeedImage = current($this->FeedImage[key($this->XMLFeedName)]);
				$FeedImageUrl = current($this->FeedImageUrl[key($this->XMLFeedName)]);
				$FeedImageTitle = current($this->FeedImageTitle[key($this->XMLFeedName)]);
				$FeedImageLink = current($this->FeedImageLink[key($this->XMLFeedName)]);
				$FeedImageDescription = current($this->FeedImageDescription[key($this->XMLFeedName)]);
				$FeedImageHeight = current($this->FeedImageHeight[key($this->XMLFeedName)]);
				$FeedImageWidth = current($this->FeedImageWidth[key($this->XMLFeedName)]);
				
				$FeedLanguage = current($this->FeedLanguage[key($this->XMLFeedName)]);
				$FeedLastBuildDate = current($this->FeedLastBuildDate[key($this->XMLFeedName)]);
				$FeedManagingEditor = current($this->FeedManagingEditor[key($this->XMLFeedName)]);
				$FeedPubDate = current($this->FeedPubDate[key($this->XMLFeedName)]);
				$FeedRating = current($this->FeedRating[key($this->XMLFeedName)]);
				
				$FeedSkipDays = current($this->FeedSkipDays[key($this->XMLFeedName)]);
				$FeedSkipDaysNumber = $this->FeedSkipDaysNumber[key($this->XMLFeedName)];
				$FeedSkipHours = current($this->FeedSkipHours[key($this->XMLFeedName)]);
				$FeedSkipHoursNumber = $this->FeedSkipHoursNumber[key($this->XMLFeedName)];
				
				$FeedTextInput = current($this->FeedTextInput[key($this->XMLFeedName)]);
				$FeedTextInputDescription = current($this->FeedTextInputDescription[key($this->XMLFeedName)]);
				$FeedTextInputName = current($this->FeedTextInputName[key($this->XMLFeedName)]);
				$FeedTextInputLink = current($this->FeedTextInputLink[key($this->XMLFeedName)]);
				$FeedTextInputTitle = current($this->FeedTextInputTitle[key($this->XMLFeedName)]);
				$FeedTTL = current($this->FeedTTL[key($this->XMLFeedName)]);
				$FeedWebMaster = current($this->FeedWebMaster[key($this->XMLFeedName)]);
				$FeedEnableDisable = current($this->FeedEnableDisable[key($this->XMLFeedName)]);
				$FeedStatus = current($this->FeedStatus[key($this->XMLFeedName)]);
				
				if ($FeedEnableDisable == 'Enable' & $FeedStatus == 'Approved') {
					$this->Writer->startElement('channel');
					
					$this->Writer->startElement('atom:link');
					$this->Writer->writeAttribute('href', $this->XMLLink);
					$this->Writer->writeAttribute('rel', 'self');
					$this->Writer->writeAttribute('type', 'application/rss+xml');
					$this->Writer->endElement();
					
					// Required Elements
					if ($FeedTitle) {
						$this->OutputSingleElement($FeedTitle, 'title');
					}
					
					if ($FeedLink) {
						$this->OutputSingleElement($FeedLink, 'link');
					}
					
					if ($FeedDescription) {
						$this->OutputSingleElement($FeedDescription, 'description');
					}
					
					// Optional Elements
					if ($FeedCategory) {
						$this->OutputSingleElement($FeedCategory, 'category');
					}
					
					if ($FeedCloud) {
						$this->OutputSingleElement($FeedCloud, 'cloud');
					}
					
					if ($FeedCopyright) {
						$this->OutputSingleElement($FeedCopyright, 'copyright');
					}
					
					// Image Element
					if ($FeedImage == 'True') {
						$this->Writer->startElement('image');
						$this->Writer->text($FeedImage);
					
						if ($FeedImageUrl) {
							$this->OutputSingleElement($FeedImageUrl, 'url');
						}
						
						if ($FeedImageTitle) {
							$this->OutputSingleElement($FeedImageTitle, 'title');
						}
						
						if ($FeedImageLink) {
							$this->OutputSingleElement($FeedImageLink, 'link');
						}
						
						if ($FeedImageDescription) {
							$this->OutputSingleElement($FeedImageDescription, 'description');
						}
						
						if ($FeedImageHeight) {
							$this->OutputSingleElement($FeedImageHeight, 'height');
						}
						
						if ($FeedImageWidth) {
							$this->OutputSingleElement($FeedImageWidth, 'width');
						}
						
						$this->Writer->endElement();
					}
					
					// Optional Elements
					if ($FeedLanguage) {
						$this->OutputSingleElement($FeedLanguage, 'language');
					}
					
					if ($FeedLastBuildDate) {
						$this->OutputSingleElement($FeedLastBuildDate, 'lastBuildDate');
					}
					
					if ($FeedManagingEditor) {
						$this->OutputSingleElement($FeedManagingEditor, 'managingEditor');
					}
					
					if ($FeedPubDate) {
						$this->OutputSingleElement($FeedPubDate, 'pubDate');
					}
					
					if ($FeedRating) {
						$this->OutputSingleElement($FeedRating, 'rating');
					}
					
					// Skip Days Element
					if ($FeedSkipDays == 'True') {
						$this->Writer->startElement('skipDays');
						if ($FeedSkipDaysNumber) {
							$this->OutputArrayElement($FeedSkipDaysNumber, 'days');
							
						}
						$this->Writer->endElement();
					}
					
					// Skip Hours Element
					if ($FeedSkipHours == 'True') {
						$this->Writer->startElement('skipHours');
					
						if ($FeedSkipHoursNumber) {
							$this->OutputArrayElement($FeedSkipHoursNumber, 'hours');
						}
						$this->Writer->endElement();
					}
					
					// Text Input Element
					if ($FeedTextInput == 'True') {
						$this->Writer->startElement('textInput');
						
						if ($FeedTextInputDescription) {
							$this->OutputSingleElement($FeedTextInputDescription, 'description');
						}
						
						if ($FeedTextInputName) {
							$this->OutputSingleElement($FeedTextInputName, 'name');
						}
						
						if ($FeedTextInputLink) {
							$this->OutputSingleElement($FeedTextInputLink, 'link');
						}
						
						if ($FeedTextInputTitle) {
							$this->OutputSingleElement($FeedTextInputTitle, 'title');
						}
						$this->Writer->endElement();
					}
					
					// Optional Elements
					if ($FeedTTL) {
						$this->OutputSingleElement($FeedTTL, 'ttl');
					}
					
					if ($FeedWebMaster) {
						$this->OutputSingleElement($FeedWebMaster, 'webMaster');
					}
					
					$this->processStoryItems($XMLFeedName);
					
					$this->Writer->endElement();
				}
				
				next($this->XMLFeedName[key($this->XMLFeedName)]);
				next($this->FeedTitle[key($this->XMLFeedName)]);
				next($this->FeedLink[key($this->XMLFeedName)]);
				next($this->FeedDescription[key($this->XMLFeedName)]);
				next($this->FeedCategory[key($this->XMLFeedName)]);
				next($this->FeedCloud[key($this->XMLFeedName)]);
				next($this->FeedCopyright[key($this->XMLFeedName)]);
				
				next($this->FeedImage[key($this->XMLFeedName)]);
				next($this->FeedImageUrl[key($this->XMLFeedName)]);
				next($this->FeedImageTitle[key($this->XMLFeedName)]);
				next($this->FeedImageLink[key($this->XMLFeedName)]);
				next($this->FeedImageDescription[key($this->XMLFeedName)]);
				next($this->FeedImageHeight[key($this->XMLFeedName)]);
				next($this->FeedImageWidth[key($this->XMLFeedName)]);
				
				next($this->FeedLanguage[key($this->XMLFeedName)]);
				next($this->FeedLastBuildDate[key($this->XMLFeedName)]);
				next($this->FeedManagingEditor[key($this->XMLFeedName)]);
				next($this->FeedPubDate[key($this->XMLFeedName)]);
				next($this->FeedRating[key($this->XMLFeedName)]);
				
				next($this->FeedSkipDays[key($this->XMLFeedName)]);
				next($this->FeedSkipDaysNumber[key($this->XMLFeedName)]);
				next($this->FeedSkipHours[key($this->XMLFeedName)]);
				next($this->FeedSkipHoursNumber[key($this->XMLFeedName)]);
				
				next($this->FeedTextInput[key($this->XMLFeedName)]);
				next($this->FeedTextInputDescription[key($this->XMLFeedName)]);
				next($this->FeedTextInputName[key($this->XMLFeedName)]);
				next($this->FeedTextInputLink[key($this->XMLFeedName)]);
				next($this->FeedTextInputTitle[key($this->XMLFeedName)]);
				next($this->FeedTTL[key($this->XMLFeedName)]);
				next($this->FeedWebMaster[key($this->XMLFeedName)]);
				next($this->FeedEnableDisable[key($this->XMLFeedName)]);
				next($this->FeedStatus[key($this->XMLFeedName)]);
				
			}
			next($this->XMLFeedName);
		}
		$this->Writer->endElement();
		$this->Writer->endDocument();
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->XmlFeed = $this->Writer->flush();
		}
		
	}
	
	protected function processStoryItems ($XMLFeedName) {
		$count = count($this->StoryXMLItem[$XMLFeedName]);
		$i = $count - 1;
		while ($this->StoryXMLItem[$XMLFeedName][$i]) {
			$StoryXMLItem = $this->StoryXMLItem[$XMLFeedName][$i];
			$StoryFeedItemTitle = $this->StoryFeedItemTitle[$XMLFeedName][$i];
	 		$StoryFeedItemLink = $this->StoryFeedItemLink[$XMLFeedName][$i];
	 		$StoryFeedItemDescription = $this->StoryFeedItemDescription[$XMLFeedName][$i];
	 		$StoryFeedItemAuthor = $this->StoryFeedItemAuthor[$XMLFeedName][$i];
			$StoryFeedItemCategory = $this->StoryFeedItemCategory[$XMLFeedName][$i];
	 		$StoryFeedItemComments = $this->StoryFeedItemComments[$XMLFeedName][$i];
			
	 		$StoryFeedItemEnclosure = $this->StoryFeedItemEnclosure[$XMLFeedName][$i];
			$StoryFeedItemEnclosureLength = $this->StoryFeedItemEnclosureLength[$XMLFeedName][$i];
	 		$StoryFeedItemEnclosureType = $this->StoryFeedItemEnclosureType[$XMLFeedName][$i];
	 		$StoryFeedItemEnclosureUrl = $this->StoryFeedItemEnclosureUrl[$XMLFeedName][$i];
			
	 		$StoryFeedItemGuid = $this->StoryFeedItemGuid[$XMLFeedName][$i];
	 		$StoryFeedItemPubDate = $this->StoryFeedItemPubDate[$XMLFeedName][$i];
	 		$StoryFeedItemSource = $this->StoryFeedItemSource[$XMLFeedName][$i];
			
	 		$StoryFeedEnableDisable = $this->StoryFeedEnableDisable[$XMLFeedName][$i];
	 		$StoryFeedStatus = $this->StoryFeedStatus[$XMLFeedName][$i];
			if ($StoryFeedEnableDisable == 'Enable' & $StoryFeedStatus == 'Approved') {
				$this->Writer->startElement('item');
					// Required Elements
					if ($StoryFeedItemTitle) {
						$this->OutputSingleElement($StoryFeedItemTitle, 'title');
					}
					
					if ($StoryFeedItemLink) {
						$this->OutputSingleElement($StoryFeedItemLink, 'link');
					}
					
					if ($StoryFeedItemDescription) {
						$StoryFeedItemDescription = $this->CreateWordWrap($StoryFeedItemDescription);
						$this->OutputSingleElementRaw($StoryFeedItemDescription, 'description');
					}
					
					// Optional Elements
					if ($StoryFeedItemAuthor) {
						$this->OutputSingleElement($StoryFeedItemAuthor, 'author');
					}
					
					if ($StoryFeedItemCategory) {
						$this->OutputSingleElement($StoryFeedItemCategory, 'category');
					}
					
					if ($StoryFeedItemComments) {
						$this->OutputSingleElement($StoryFeedItemComments, 'comments');
					}
					
					// Enclosure Element
					if ($StoryFeedItemEnclosure == 'True') {
						$this->Writer->startElement('enclosure');
						
						if ($StoryFeedItemEnclosureLength) {
							$this->OutputSingleElement($StoryFeedItemEnclosureLength, 'length');
						}
						
						if ($StoryFeedItemEnclosureType) {
							$this->OutputSingleElement($StoryFeedItemEnclosureType, 'type');
						}
						
						if ($StoryFeedItemEnclosureUrl) {
							$this->OutputSingleElement($StoryFeedItemEnclosureUrl, 'url');
						}
						$this->endElement();
					}
					
					// Optional Elements
					if ($StoryFeedItemGuid) {
						$this->OutputSingleElement($StoryFeedItemGuid, 'guid');
					}
					
					if ($StoryFeedItemPubDate) {
						$this->OutputSingleElement($StoryFeedItemPubDate, 'pubDate');
					}
					
					if ($StoryFeedItemSource) {
						$this->OutputSingleElement($StoryFeedItemSource, 'source');
					}
					
				$this->Writer->endElement();
			}
			$i--;
		}
	}
	
	public function getOutput() {
		return $this->XmlFeed;
	}
}
?>