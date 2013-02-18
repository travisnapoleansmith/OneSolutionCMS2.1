<?php
/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2013 One Solution CMS
* This content management system is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* (at your option) any later version.
*
* This content management system is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/gpl-2.0.txt
* @version    2.1.141, 2013-01-14
*************************************************************************************
*/

class MenuItem
{
	private $idnumber;
	private $MenuItemName;
	private $MenuItemLink;
	private $MenuItemTitle;
	private $MenuItemEnableDisable;
	private $MenuItemOutput;
	private $MenuItemStatus;
	private $LiIdClass;
	private $LiStyle;
	private $LiClass;
	private $AStyle;
	private $AClass;


	public function __construct() {

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

	public function setMenuItemStatus($status){
		$this->MenuItemStatus = $status;
	}

	public function getMenuItemStatus(){
		return $this->MenuItemStatus;
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
		$this->idnumber = $LiClass;
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

	private function processInformation ($Name, $Title) {
		$this->MenuItemOutput .= ' ';
		$this->MenuItemOutput .= $Name;
		$this->MenuItemOutput .= "='";
		$this->MenuItemOutput .= $Title;
		$this->MenuItemOutput .= "'";
	}

	public function processLi($space, $data) {
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

	private function processA($space) {
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

	private function processInsertInformation($space, $data) {
		$this->MenuItemOutput .= $space;
		$this->MenuItemOutput .= '   ';
		$this->MenuItemOutput .= $data;
		$this->MenuItemOutput .= "\n";
	}

	public function buildMenuItemOutput($space, $data) {
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

	public function getMenuItemOutput() {
		return $this->MenuItemOutput;
	}


}

?>