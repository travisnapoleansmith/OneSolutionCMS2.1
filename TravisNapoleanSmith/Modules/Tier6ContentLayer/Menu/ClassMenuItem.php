<?php
class MenuItem
{
	var $idnumber;
	var $MenuItemName;
	var $MenuItemLink;
	var $MenuItemTitle;
	var $MenuItemEnableDisable;
	var $MenuItemOutput;
	var $MenuItemStatus;
	var $LiIdClass;
	var $LiStyle;
	var $LiClass;
	var $AStyle;
	var $AClass;
	
	
	function MenuItem() {
		
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
	
	function setMenuItemStatus($status){
		$this->MenuItemStatus = $status;
	}
	
	function getMenuItemStatus(){
		return $this->MenuItemStatus;
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
		$this->idnumber = $LiClass;
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
	
	function processInformation ($Name, $Title) {
		$this->MenuItemOutput .= ' ';
		$this->MenuItemOutput .= "$Name";
		$this->MenuItemOutput .= "='";
		$this->MenuItemOutput .= $Title;
		$this->MenuItemOutput .= "'";
	}
	
	function processLi($space, $data) {
		if ($this->AStyle) {
			$this->MenuItemOutput .= $space;
			$this->MenuItemOutput .= '   ';
			$this->MenuItemOutput .= '<a';
			$this->processInformation('style', $this->AStyle);
			
			$this->processA($space);
			if ($data) {
				$this->processInsertInformation($space, $data);
			}
			
		} else if ($this->AClass){ 
			
			$this->MenuItemOutput .= $space;
			$this->MenuItemOutput .= '   ';
			$this->MenuItemOutput .= '<a';
			$this->processInformation('class', $this->AClass);
			
			$this->processA($space);
			if ($data) {
				$this->processInsertInformation($space, $data);
			}
		
		} else {
			$this->MenuItemOutput .= $space;
			$this->MenuItemOutput .= '   ';
			$this->MenuItemOutput .= '<a';
			$this->processA($space);
			if ($data) {
				$this->processInsertInformation($space, $data);
			}
		}
	}
	
	function processA($space) {
		if ($this->AClass) {
			//$this->processInformation('class', $this->AClass);
		}
		
		if ($this->MenuItemTitle) {
			$this->processInformation('title', $this->MenuItemTitle);
		}
		
		if ($this->MenuItemLink) {
			$this->processInformation('href', $this->MenuItemLink);
		}
		$this->MenuItemOutput .= ">\n";
		$this->MenuItemOutput .= $space;
		$this->MenuItemOutput .= '     ';
		$this->MenuItemOutput .= $this->MenuItemName;
		$this->MenuItemOutput .= "\n";
		$this->MenuItemOutput .= $space;
		$this->MenuItemOutput .= "   </a>\n";
		
	}
	
	function processInsertInformation($space, $data) {
		$this->MenuItemOutput .= $space;
		$this->MenuItemOutput .= '   ';
		$this->MenuItemOutput .= $data;
		$this->MenuItemOutput .= "\n";
	}
	
	function buildMenuItemOutput($space, $data) {
		if ($this->MenuItemEnableDisable == 'Enable' && $this->MenuItemStatus == 'Approved') {
			$this->MenuItemOutput .= $space;
			$this->MenuItemOutput .= '<li';
			
			if ($this->LiIdClass) {
				$this->processInformation('id', $this->LiIdClass);
			}
			
			if ($this->LiStyle) {
				$this->processInformation('style', $this->LiStyle);
			}
			
			if ($this->LiClass) {
				$this->processInformation('class', $this->LiClass);
				$this->MenuItemOutput .= ">\n";
			} else {
				$this->MenuItemOutput .= ">\n";
			}
			
			$this->processLi($space, $data);
			$this->MenuItemOutput .= $space;
			$this->MenuItemOutput .= "</li>\n";
		} else {
			$this->MenuItemOutput = NULL;
		}
	}
	
	function getMenuItemOutput() {
		return $this->MenuItemOutput;
	}
	
	
}

?>