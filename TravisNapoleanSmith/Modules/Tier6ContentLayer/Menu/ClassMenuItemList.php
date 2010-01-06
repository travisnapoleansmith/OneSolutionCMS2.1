<?php

class MenuItemList
{
	private $MenuItems;
	private $idnumber;
	private $MenuItemName;
	private $MenuItemLink;
	private $MenuItemTitle;
	private $MenuItemEnableDisable;
	private $MenuItemOutput;
	private $MenuItemStatus;
	private $UlIdClass;
	private $UlStyle;
	private $UlClass;
	private $LiIdClass;
	private $LiStyle;
	private $LiClass;
	private $AStyle;
	private $AClass;
	private $idMenuItems;
	private $i = 1;
	private $InsertInformation;
	private $root;
	
	public function MenuItemList () {
		$this->MenuItems = Array();
		$this->idMenuItems = Array();
		$this->InsertInformation = Array();
	}
	
	public function setIdNumber($idnumber){
		$this->idnumber = $idnumber;
	}
	
	public function getIdNumber(){
		return $this->idnumber;
	}
	
	public function setMenuItemName($name){
		$this->MenuItemName = $name;
	}
	
	public function getIMenuItemName(){
		return $this->MenuItemName;
	}
	
	public function setMenuItemLink($link){
		$this->MenuItemLink = $link;
	}
	
	public function getMenuItemLink(){
		return $this->MenuItemLink;
	}
	
	public function setMenuItemTitle($title){
		$this->MenuItemTitle = $title;
	}
	
	public function getMenuItemTitle(){
		return $this->MenuItemTitle;
	}
	
	public function setMenuItemEnableDisable($enable){
		$this->MenuItemEnableDisable = $enable;
	}
	
	public function getMenuItemEnableDisable(){
		return $this->MenuItemEnableDisable;
	}
	
	public function setMenuItemStatus($MenuItemStatus){
		$this->MenuItemStatus = $MenuItemStatus;
	}
	
	public function getMenuItemStatus(){
		return $this->MenuItemStatus;
	}
	
	public function setUlIdClass($UlIdClass){
		$this->UlIdClass = $UlIdClass;
	}
	
	public function getUlIdClass(){
		return $this->UlIdClass;
	}
	
	public function setUlStyle($UlStyle){
		$this->UlStyle = $UlStyle;
	}
	
	public function getUlStyle(){
		return $this->UlStyle;
	}
	
	public function setUlClass($UlClass){
		$this->UlClass = $UlClass;
	}
	
	public function getUlClass(){
		return $this->UlClass;
	}
	
	public function setLiIdClass($LiIdClass){
		$this->LiIdClass = $LiIdClass;
	}
	
	public function getLiIdClass(){
		return $this->LiIdClass;
	}
	
	public function setLiStyle($LiStyle){
		$this->LiStyle = $LiStyle;
	}
	
	public function getLiStyle(){
		return $this->LiStyle;
	}
	
	public function setLiClass($LiClass){
		$this->LiClass = $LiClass;
	}
	
	public function getLiClass(){
		return $this->LiClass;
	}
	
	public function setAStyle($AStyle){
		$this->AStyle = $AStyle;
	}
	
	public function getAStyle(){
		return $this->AStyle;
	}
	
	public function setAClass($AClass){
		$this->AClass = $AClass;
	}
	
	public function getAClass(){
		return $this->AClass;
	}
	
	public function setidMenuItems($idMenuItems, $idnumber){
		$this->idMenuItems[$idnumber] = $idMenuItems;
	}
	
	public function getidMenuItems($idnumber) {
		return $this->idMenuItems[$idnumber];
	}
	 
	public function setRoot($root){
		$this->root = $root;
	}
	
	public function getRoot(){
		return $this->root;
	}
	
	public function setAllBase ($idnumber, $name, $link, $title, $enable, $status) {
		$this->idnumber = $idnumber;
		$this->MenuItemName = $name;
		$this->MenuItemLink = $link;
		$this->MenuItemTitle = $title;
		$this->MenuItemEnableDisable = $enable;
		$this->MenuItemStatus = $status;
	}
	
	public function setAllClassStyle ($LiIdClass, $LiStyle, $LiClass, $AStyle, $AClass) {
		$this->LiIdClass = $LiIdClass;
		$this->LiStyle = $LiStyle;
		$this->LiClass = $LiClass;
		$this->AStyle = $AStyle;
		$this->AClass = $AClass;
		
	}
	
	public function setAllUl ($UlIdClass, $UlClass, $UlStyle) {
		$this->UlIdClass = $UlIdClass;
		$this->UlClass = $UlClass;
		$this->UlStyle = $UlStyle;
	}
	
	public function setInsertInformation ($InsertInformation, $key){
		$this->InsertInformation[$key] = $InsertInformation;
	}
	
	public function buildMenuItems() {
		$this->i = 1;
		$j = 5;
		while ($this->idMenuItems[$j]) {
			$fieldname = $this->idMenuItems[$j];
			$this->MenuItems[$fieldname] = new MenuItem();
			$this->i++;
			$j++;
		}
	}
	
	public function removeUnusedMenuItems() {
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
	
	public function createMenuItemOutput ($idMenuItem, $InsertInformation) {
		$this->MenuItems[$idMenuItem]->buildMenuItemOutput('       ', $InsertInformation);
	}
	
	public function getMenuItemOutput ($idMenuItem) {
		return $this->MenuItems[$idMenuItem]->getMenuItemOutput();
	}
	
	private function processInformation ($Name, $Title) {
		$this->MenuItemOutput .= ' ';
		$this->MenuItemOutput .= $Name;
		$this->MenuItemOutput .= "='";
		$this->MenuItemOutput .= $Title;
		$this->MenuItemOutput .= "'";
	}
	
	private function processInsertInformation ($data, $insert, $find){
		$before = substr ($data, 0, strpos($data, $find));
		$after = strstr ($data, $find);
		$finaloutput = $before;
		$finaloutput .= $insert;
		$finaloutput .= '   ';
		$finaloutput .= $after;
		return $finaloutput;
	}
	
	private function processRoot ($space) {
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
	
	public function createMenuItemListOutput ($space){
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
					$this->MenuItemOutput .= $space;
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
						$this->MenuItemOutput .= $space;
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
					$this->MenuItemOuput .= $space;
				}
				$this->MenuItemOutput .= '    ';
				$this->MenuItemOutput .= "</li>\n";
			}
		}
	}
	
	public function createMenuItemsData ($idMenuItem){
		
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
	
	
	public function WalkMenuItemsArray () {
		print_r($this->MenuItems);
	}
	
	public function WalkidMenuItemsArray () {
		print_r($this->idMenuItems);
	}
	
	public function WalkInsertInformationArray () {
		print_r($this->InsertInformation);
	}
	
	public function getMenuOutput () {
		return $this->MenuItemOutput;
	}
	
}
?>