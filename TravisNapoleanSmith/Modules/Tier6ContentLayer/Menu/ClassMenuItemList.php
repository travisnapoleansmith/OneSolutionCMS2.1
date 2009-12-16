<?php
require_once ("Modules/Tier6ContentLayer/Menu/ClassMenuItem.php"); 

class MenuItemList
{
	var $MenuItems;
	var $idnumber;
	var $MenuItemName;
	var $MenuItemLink;
	var $MenuItemTitle;
	var $MenuItemEnableDisable;
	var $MenuItemOutput;
	var $MenuItemStatus;
	var $UlIdClass;
	var $UlStyle;
	var $UlClass;
	var $LiIdClass;
	var $LiStyle;
	var $LiClass;
	var $AStyle;
	var $AClass;
	var $idMenuItems;
	var $i = 1;
	var $InsertInformation;
	var $root;
	
	function MenuItemList () {
		$this->MenuItems = Array();
		$this->idMenuItems = Array();
		$this->InsertInformation = Array();
	}
	
	function setIdNumber($idnumber){
		$this->idnumber = $idnumber;
	}
	
	function getIdNumber(){
		return $this->idnumber;
	}
	
	function setMenuItemName($name){
		$this->MenuItemName = $name;
	}
	
	function getIMenuItemName(){
		return $this->MenuItemName;
	}
	
	function setMenuItemLink($link){
		$this->MenuItemLink = $link;
	}
	
	function getMenuItemLink(){
		return $this->MenuItemLink;
	}
	
	function setMenuItemTitle($title){
		$this->MenuItemTitle = $title;
	}
	
	function getMenuItemTitle(){
		return $this->MenuItemTitle;
	}
	
	function setMenuItemEnableDisable($enable){
		$this->MenuItemEnableDisable = $enable;
	}
	
	function getMenuItemEnableDisable(){
		return $this->MenuItemEnableDisable;
	}
	
	function setMenuItemStatus($MenuItemStatus){
		$this->MenuItemStatus = $MenuItemStatus;
	}
	
	function getMenuItemStatus(){
		return $this->MenuItemStatus;
	}
	
	function setUlIdClass($UlIdClass){
		$this->UlIdClass = $UlIdClass;
	}
	
	function getUlIdClass(){
		return $this->UlIdClass;
	}
	
	function setUlStyle($UlStyle){
		$this->UlStyle = $UlStyle;
	}
	
	function getUlStyle(){
		return $this->UlStyle;
	}
	
	function setUlClass($UlClass){
		$this->UlClass = $UlClass;
	}
	
	function getUlClass(){
		return $this->UlClass;
	}
	
	function setLiIdClass($LiIdClass){
		$this->LiIdClass = $LiIdClass;
	}
	
	function getLiIdClass(){
		return $this->LiIdClass;
	}
	
	function setLiStyle($LiStyle){
		$this->LiStyle = $LiStyle;
	}
	
	function getLiStyle(){
		return $this->LiStyle;
	}
	
	function setLiClass($LiClass){
		$this->LiClass = $LiClass;
	}
	
	function getLiClass(){
		return $this->LiClass;
	}
	
	function setAStyle($AStyle){
		$this->AStyle = $AStyle;
	}
	
	function getAStyle(){
		return $this->AStyle;
	}
	
	function setAClass($AClass){
		$this->AClass = $AClass;
	}
	
	function getAClass(){
		return $this->AClass;
	}
	
	function setidMenuItems($idMenuItems, $idnumber){
		$this->idMenuItems[$idnumber] = $idMenuItems;
	}
	
	function getidMenuItems($idnumber) {
		return $this->idMenuItems[$idnumber];
	}
	 
	function setRoot($root){
		$this->root = $root;
	}
	
	function getRoot(){
		return $this->root;
	}
	function setAllBase ($idnumber, $name, $link, $title, $enable, $status) {
		$this->idnumber = $idnumber;
		$this->MenuItemName = $name;
		$this->MenuItemLink = $link;
		$this->MenuItemTitle = $title;
		$this->MenuItemEnableDisable = $enable;
		$this->MenuItemStatus = $status;
	}
	
	function setAllClassStyle ($LiIdClass, $LiStyle, $LiClass, $AStyle, $AClass) {
		$this->LiIdClass = $LiIdClass;
		$this->LiStyle = $LiStyle;
		$this->LiClass = $LiClass;
		$this->AStyle = $AStyle;
		$this->AClass = $AClass;
		
	}
	
	function setAllUl ($UlIdClass, $UlClass, $UlStyle) {
		$this->UlIdClass = $UlIdClass;
		$this->UlClass = $UlClass;
		$this->UlStyle = $UlStyle;
	}
	
	function setInsertInformation ($InsertInformation, $key){
		$this->InsertInformation[$key] = $InsertInformation;
	}
	
	function buildMenuItems() {
		$this->i = 1;
		$j = 5;
		while ($this->idMenuItems[$j]) {
			$fieldname = $this->idMenuItems[$j];
			$this->MenuItems[$fieldname] = new MenuItem();
			$this->i++;
			$j++;
		}
	}
	
	function removeUnusedMenuItems() {
		$j = 5;
		while ($this->idMenuItems[$j]) {
			$fieldname = $this->idMenuItems[$j];
			if ($this->MenuItems[$fieldname]->getIdNumber() == NULL){
				unset ($this->MenuItems[$fieldname]);
				unset ($this->idMenuItems[$j]);
			}
			$j++;
		}
	}
	
	function createMenuItemOutput ($idMenuItem, $InsertInformation) {
		$this->MenuItems[$idMenuItem]->buildMenuItemOutput('       ', $InsertInformation);
	}
	
	function getMenuItemOutput ($idMenuItem) {
		return $this->MenuItems[$idMenuItem]->getMenuItemOutput();
	}
	
	function processInformation ($Name, $Title) {
		$this->MenuItemOutput .= ' ';
		$this->MenuItemOutput .= "$Name";
		$this->MenuItemOutput .= "='";
		$this->MenuItemOutput .= $Title;
		$this->MenuItemOutput .= "'";
	}
	
	function processInsertInformation ($data, $insert, $find){
		$before = substr ($data, 0, strpos($data, $find));
		$after = strstr ($data, $find);
		$finaloutput = $before;
		$finaloutput .= $insert;
		$finaloutput .= '   ';
		$finaloutput .= $after;
		return "$finaloutput";
	}
	
	function processRoot ($space) {
		$this->MenuItemOutput .= '    <li';
		if ($this->LiIdClass) {
			$this->processInformation('id', $this->LiIdClass);
		}
		if ($this->LiStyle) {					
			$this->processInformation('style', $this->LiStyle);
		}
		
		if ($this->LiClass) {
			$this->processInformation('class', $this->LiClass);
		}
		
		$this->MenuItemOutput .= ">\n";
		
		$this->MenuItemOutput .= '      ';
		
		if ($this->AStyle || $this->AClass || $this->MenuItemTitle || $this->MenuItemLink) {
			$this->MenuItemOutput .= '<a';
			if ($this->AStyle) {
				$this->processInformation('style', $this->AStyle);
			}
			if ($this->AClass) {
				$this->processInformation('class', $this->AClass);
			}
			if ($this->MenuItemTitle) {
				$this->processInformation('title', $this->MenuItemTitle);
			}
			if ($this->MenuItemLink) {
				$this->processInformation('href', $this->MenuItemLink);
			}
			$this->MenuItemOutput .= '>';
			$this->MenuItemOutput .= $this->MenuItemName;
			$this->MenuItemOutput .= "</a>\n";
		
		} else {
			$this->MenuItemOutput .= $this->MenuItemName;
			$this->MenuItemOutput .= "\n";
		}
	}
	
	function createMenuItemListOutput ($space){
		if (is_array($this->idMenuItems)) {
			$fieldname = current($this->idMenuItems);
		}
		if ($this->MenuItemEnableDisable == 'Enable' && $this->MenuItemStatus == 'Approved') {
			if (!$MenuItemOutput){
				$this->MenuItemOutput = NULL;
			}
			
			if ($fieldname) {
				if ($this->root) {
					$this->processRoot($space);
				}
				
				if ($this->root) {
					$this->MenuItemOutput .= '       ';
				} else if ($space) {
					$this->MenuItemOutput .= "$space";
				} else {
					$this->MenuItemOutput .= '  ';
				}
				
				
				$i = 0;
				$fieldname2 = array_keys($this->idMenuItems);
				while ($this->idMenuItems[$fieldname2[$i]]) {
					$hold = $fieldname2[$i];
					$hold2 = $this->idMenuItems[$hold];
					
					$enabledisable[$i] = $this->MenuItems[$hold2]->getMenuItemEnableDisable();
					$i++;
				}
				$i = 0;
				$disable = FALSE;
				while ($enabledisable[$i]) {
					if ($enabledisable[$i] == 'Enable') {
						$disable = TRUE;
						break;
					}
					$i++;
				}
				
				if ($disable) {
					$this->MenuItemOutput .= '<ul';
				
					if ($this->UlIdClass) {
						$this->processInformation ('id', $this->UlIdClass);
					}
					
					if ($this->UlStyle) {
						$this->processInformation ('style', $this->UlStyle);
						
					} 
					
					if ($this->UlClass) {
						$this->processInformation ('class', $this->UlClass);
					}
				
					$this->MenuItemOutput .= ">\n";
					
					$i = 0;
					$fieldname2 = array_keys($this->idMenuItems);
					while ($this->idMenuItems[$fieldname2[$i]]) {
						$hold = $fieldname2[$i];
						$hold2 = $this->idMenuItems[$hold];
						if ($this->InsertInformation[$hold2]){
							$temp = $this->MenuItems[$hold2]->getMenuItemOutput();
							$insert = $this->InsertInformation[$hold2];
							
							$insert = str_replace ('  ', '    ', $insert);
							$insert = str_replace ('<ul', '       <ul', $insert);
							$insert = str_replace ('<li', '   <li', $insert);
							$insert = str_replace ('</li>', '   </li>', $insert);
							$insert = str_replace ('</ul>', '       </ul>', $insert);
							
							$output = $this->ProcessInsertInformation($temp, $insert, '      </li>');
							$this->MenuItemOutput .= "$output\n";
							
						} else {
							$this->MenuItemOutput .= $this->MenuItems[$hold2]->getMenuItemOutput();
						}
						$i++;
					}
					if ($space) {
						$this->MenuItemOutput .= "$space";
					}
					
					$this->MenuItemOutput .= '   ';
					$this->MenuItemOutput .= "</ul>\n";
				}
				
				if ($this->root) {
					$this->MenuItemOutput .= "    </li>\n";
				}
			} 
			else if ($this->root){
				$this->processRoot($space);
				if ($space) {
					$this->MenuItemOuput .= "$space";
				}
				$this->MenuItemOutput .= '    ';
				$this->MenuItemOutput .= "</li>\n";
			}
		}
	}
	
	function createMenuItemsData ($idMenuItem){
		
		$idnumber = $this->idnumber;
		$name = $this->MenuItemName;
		$link = $this->MenuItemLink;
		$title = $this->MenuItemTitle;
		$enable = $this->MenuItemEnableDisable;
		$status = $this->MenuItemStatus;
		$this->MenuItems[$idMenuItem]->setAllBase($idnumber, $name, $link, $title, $enable, $status);
		
		$LiIdClass = $this->LiIdClass;
		$LiStyle = $this->LiStyle;
		$LiClass = $this->LiClass;
		$AStyle = $this->AStyle;
		$AClass = $this->AClass;
		$this->MenuItems[$idMenuItem]->setAllClassStyle($LiIdClass, $LiStyle, $LiClass, $AStyle, $AClass);
				
		if ($this->InsertInformation[$idMenuItem]) {
			$InsertInformation = $this->InsertInformation[$idMenuItem];
		} else {
			$InsertInformation = NULL;
		}
		
		$this->createMenuItemOutput ($idMenuItem, $InsertInformation);
		
	}
	
	
	function WalkMenuItemsArray () {
		print_r($this->MenuItems);
	}
	
	function WalkidMenuItemsArray () {
		print_r($this->idMenuItems);
	}
	
	function WalkInsertInformationArray () {
		print_r($this->InsertInformation);
	}
	
	function getMenuOutput () {
		return $this->MenuItemOutput;
	}
	
}
?>