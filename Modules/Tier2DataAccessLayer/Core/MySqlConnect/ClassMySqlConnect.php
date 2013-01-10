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

/**
 * Class MySql Connect
 *
 * Class MySqlConnect is designed as the MySql database engine for One Solution CMS. It is used to do all MySql queries on the database.
 *
 * @author Travis Napolean Smith
 * @copyright Copyright (c) 1999 - 2012 One Solution CMS
 * @copyright PHP - Copyright (c) 2005 - 2012 One Solution CMS
 * @copyright C++ - Copyright (c) 1999 - 2005 One Solution CMS
 * @version PHP - 2.1.130
 * @version C++ - Unknown
 */

class MySqlConnect extends Tier2DataAccessLayerModulesAbstract implements Tier2DataAccessLayerModules
{
	/**
	 * Create an instance of MySqlConnect
	 *
	 * @access public
	*/
	public function MySqlConnect () {
		$this->idsearch = Array();

		$hold = array();
		if (!is_array($GLOBALS['ErrorMessage']['MySqlConnect'])) {
			$GLOBALS['ErrorMessage']['MySqlConnect'] = array();
		}
		array_push($GLOBALS['ErrorMessage']['MySqlConnect'], $hold);
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['MySqlConnect'][key($GLOBALS['ErrorMessage']['MySqlConnect'])];
	}

	/**
	 * Connect
	 * Connects to current database.
	 *
	 * @access public
	*/
	public function Connect () {
		if ($this->hostname == NULL | $this->user == NULL | $this->password == NULL | $this->databasename == NULL) {
			$this->hostname = $GLOBALS['credentaillogonarray'][0];
			$this->user = $GLOBALS['credentaillogonarray'][1];
			$this->password = $GLOBALS['credentaillogonarray'][2];
			$this->databasename = $GLOBALS['credentaillogonarray'][3];
		}

		if (!($this->link = mysql_connect($this->hostname, $this->user, $this->password))) {
			array_push($this->ErrorMessage,'Connect: Could not connect to server');
		}

		if ($this->link) {
			if (!mysql_select_db($this->databasename, $this->link)) {
				array_push($this->ErrorMessage,'Connect: Could not select database');
			}
		}
	}

	/**
	 * Disconnect
	 * Disconnects from current database.
	 *
	 * @access public
	*/
	public function Disconnect () {
		if ($this->link) {
			mysql_close($this->link);
		}
	}

	protected function checkDatabaseName (){
		$this->Connect();
		$results = mysql_list_dbs($this->link);
		$i = 0;
		while (mysql_db_name($results, $i)){
			$temp = mysql_db_name($results, $i);
			if ($temp == $this->databasename) {
				return $temp;
			}
			$i++;
		}
		array_push($this->ErrorMessage,'checkDatabaseName: Database Name does not exist');
		return FALSE;
	}

	protected function checkTableName () {
		$TableName = $this->databasetable;
		if ($this->tablenames === NULL) {
			$this->Connect();

			$query = 'SHOW TABLES FROM `' . $this->databasename . '`';
			$result = mysql_query($query);

			$this->tablenames = Array();

			while ($CurrentTableName = mysql_fetch_array($result, MYSQL_NUM)) {
				array_push($this->tablenames, $CurrentTableName[0]);
			}

			$this->Disconnect();

		}

		foreach ($this->tablenames as $Key => $Value) {
			if ($Value === $TableName) {
				return $TableName;
			}
		}
		return FALSE;
	}

	protected function checkPermissions ($Permission) {
		$this->Connect();
		$query = 'SHOW GRANTS';
		$result = mysql_query($query);
		$userdata = mysql_result($result, 1);
		$userdata2 = mysql_result($result, 0);
		$userdata = substr_replace($userdata, NULL, 0, 5);
		if (strpos($userdata, $Permission)) {
			return TRUE;
		} else if (strpos($userdata2, 'ALL PRIVILEGES ON')){
			return TRUE;
		} else {
			array_push($this->ErrorMessage,'checkPermissions: Permission has been denied');
			return FALSE;
		}
	}

	protected function checkField ($Field) {
		$this->Connect();
		$query = 'SHOW COLUMNS FROM `' . $this->databasetable . '` LIKE "' . $Field . '" ';
		$result = mysql_query($query);
		$userdata = mysql_result($result, 0);
		if (!$userdata) {
			return FALSE;
		} else {
			if ($userdata == $Field) {
				return $userdata;
			} else {
				array_push($this->ErrorMessage,'checkField: Field does not exist');
				return FALSE;
			}
		}
	}

	/**
	 * createDatabase
	 * Creates current database.
	 *
	 * @access public
	*/
	public function createDatabase () {
		$databasenamecheck = $this->checkDatabaseName();
		$permissionscheck = $this->checkPermissions ('CREATE');

		if (!$databasenamecheck) {
			if ($permissionscheck) {
				$query = 'CREATE DATABASE ' . $this->databasename .'';
				$result = mysql_query($query);
			} else {
				array_push($this->ErrorMessage,'createDatabase: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'createDatabase: Database name exists!');
		}
	}

	/**
	 * deleteDatabase
	 * Deletes current database.
	 *
	 * @access public
	*/
	public function deleteDatabase (){
		$databasenamecheck = $this->checkDatabaseName();
		$permissionscheck = $this->checkPermissions('DROP');

		if ($databasenamecheck) {
			if ($permissionscheck) {
				$query = 'DROP DATABASE ' . $this->databasename .'';
				$result = mysql_query($query);
			} else {
				array_push($this->ErrorMessage,'deleteDatabase: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'deleteDatabase: Database name does not exist!');
		}
	}

	/**
	 * createTable
	 *
	 * Create a table using TableString.
	 *
	 * @param string $TableString SQL Query to create table minus the 'CREATE TABLE'. Must be a string.
	 * @access public
	*/
	public function createTable ($TableString) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('CREATE');

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if (!$tablenamecheck) {
					if (!is_array($TableString)) {
						if ($TableString != NULL) {
							$query = 'CREATE TABLE ' . $this->databasetable . ' ( ' . $TableString . ' ); ';
							$result = mysql_query($query);
						} else {
							array_push($this->ErrorMessage,'createTable: Table String cannot be NULL!');
						}
					} else {
						array_push($this->ErrorMessage,'createTable: Table String cannot be an Array!');
					}
				} else {
					array_push($this->ErrorMessage,'createTable: Table name exists!');
				}
			} else {
				array_push($this->ErrorMessage,'createTable: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'createTable: Database name does not exist!');
		}
	}

	/**
	 * updateTable
	 *
	 * Updates a table using TableString.
	 *
	 * @param string $TableString SQL query to update the table. Tablestring comes after 'SET'. Must be a string.
	 * @access public
	*/
	public function updateTable ($TableString) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('UPDATE');
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if ($TableString != NULL) {
						if (!is_array($TableString)) {
							$query = 'UPDATE `'  . $this->databasetable . '` SET ' . $TableString . '; ';
							$result = mysql_query($query);
						} else {
							while (isset($TableString[key($TableString)])) {
								$query = 'UPDATE `'  . $this->databasetable . '` SET ' . current($TableString) . '; ';
								$result = mysql_query($query);
								next($TableString);
							}
						}
					} else {
						array_push($this->ErrorMessage,'updateTable: Table string cannot be NULL!');
					}
				} else {
					array_push($this->ErrorMessage,'updateTable: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'updateTable: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'updateTable: Database name does not exist!');
		}
	}

	/**
	 * deleteTable
	 * Deletes the current table.
	 *
	 * @access public
	*/
	public function deleteTable () {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('CREATE');

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					$query = 'DROP TABLE ' . $this->databasetable . '';
					$result = mysql_query($query);
				} else {
					array_push($this->ErrorMessage,'deleteTable: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'deleteTable: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'deleteTable: Database name does not exist!');
		}
	}

	/**
	 * createRow
	 *
	 * Creates a new row from RowName and RowValue. Rowname and rowvalue can be a string or an array but must be the same type for each!
	 *
	 * @param string $RowName Name of the row to create. Must be a string or an array of strings.
	 * @param string $RowValue Value of the row to create. Must be a string or an array of strings.
	 * @access public
	*/
	public function createRow ($RowName, $RowValue) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('INSERT');

		$insertrow = NULL;
		$insertrowvalue = NULL;
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (is_array($RowName[0])) {
						if (is_array($RowValue[0])) {
							if ($RowName != NULL) {
								if ($RowValue != NULL) {
									while (isset($RowName[key($RowName)])) {
										while(current($RowName[key($RowName)])) {
											$insertrow .= "`";
											$insertrow .= mysql_real_escape_string(current($RowName[key($RowName)]));
											$insertrow .= "`";

											if (is_null(current($RowValue[key($RowValue)]))) {
												$insertrowvalue .= 'NULL';
											} else {
												$insertrowvalue .= "'";
												$insertrowvalue .= mysql_real_escape_string(current($RowValue[key($RowValue)]));
												$insertrowvalue .= "'";
											}

											next($RowName[key($RowName)]);
											next($RowValue[key($RowValue)]);
											if (current($RowName[key($RowName)])) {
												$insertrow .= ' , ';
												$insertrowvalue .= ' , ';
											}
										}
										$query = 'INSERT INTO ' . $this->databasetable . ' ( ' . $insertrow . ') VALUES ( ' . $insertrowvalue . '); ';
										$result = mysql_query($query);
										if (!$result) {
											$temp = key($RowValue);
											array_push($this->ErrorMessage,"createRow: Row Value [$temp] exists in the Database!");
										}

										next($RowName);
										next($RowValue);

										$insertrowvalue = NULL;
										$insertrow = NULL;
									}
								} else {
									array_push($this->ErrorMessage,'createRow: Row Value cannot be NULL!');
								}
							} else {
								array_push($this->ErrorMessage,'createRow: Row Name cannot be NULL!');
							}
						} else if (is_array($RowValue)){
							array_push($this->ErrorMessage,'createRow: Row Name is a 3 dimmensional Array but Row Value must be an Array!');
						} else {
							array_push($this->ErrorMessage,'createRow: Row Name is a 3 Dimmensional Array but Row Value must be a 3 Dimmensional Array!');
						}
					} else if (is_array($RowValue[0])) {
						array_push($this->ErrorMessage,'createRow: Row Value is a 3 Dimmensional Array but Row Name must be a 3 Dimmensional Array!');
					} else if (is_array($RowName)) {
						if (is_array($RowValue)) {
							if ($RowName != NULL) {
								if ($RowValue != NULL) {
									while (isset($RowName[key($RowName)])) {
										$insertrow .= "`";
										$insertrow .= mysql_real_escape_string(current($RowName));
										$insertrow .= "`";

										if (is_null(current($RowValue))) {
											$insertrowvalue .= 'NULL';
										} else {
											$insertrowvalue .= "'";
											$insertrowvalue .= mysql_real_escape_string(current($RowValue));
											$insertrowvalue .= "'";
										}

										next($RowName);
										next($RowValue);
										if (current($RowName)) {
											$insertrow .= ' , ';
											$insertrowvalue .= ' , ';
										}
									}

									$query = 'INSERT INTO ' . $this->databasetable . ' ( ' . $insertrow . ') VALUES ( ' . $insertrowvalue . '); ';
									$result = mysql_query($query);
									if (!$result) {
										array_push($this->ErrorMessage,'createRow: Row Value exists in the Database!');
									}
								} else {
									array_push($this->ErrorMessage,'createRow: Row Value cannot be NULL!');
								}
							} else {
								array_push($this->ErrorMessage,'createRow: Row Name cannot be NULL!');
							}
						} else {
							array_push($this->ErrorMessage,'createRow: Row Value must be an Array!');
						}
					} else {
						array_push($this->ErrorMessage,'createRow: Row Name must be an Array!');
					}
				} else {
					array_push($this->ErrorMessage,'createRow: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'createRow: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'createRow: Database name does not exist!');
		}
	}

	/**
	 * updateRow
	 *
	 * Updates a row from RowName and RowValue with RowNumberName and RowNumber. Rowname and rowvalue can be a string or an array but
	 * must be the same type for each! RowNumberName and RowNumber can be a string or an array but must be the same type for each. Mixing
	 * arrays and strings for all past values are not permitted!
	 *
	 * @param string $RowName Name of the row to update. Must be a string or an array of strings.
	 * @param string $RowValue Value of the row to update. Must be a string or an array of strings.
	 * @param string $RowNumberName Name of the row to update with. Must be a string or an array of strings.
	 * @param string $RowNumber Value of the row to update with. Must be a string or an array of strings.
	 * @access public
	*/
	public function updateRow ($RowName, $RowValue, $RowNumberName, $RowNumber) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('UPDATE');

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($RowName)) {
						if (!is_array($RowValue)) {
							if (!is_array($RowNumberName)) {
								if (!is_array($RowNumber)) {
									if ($RowName != NULL) {
										if ($RowValue != NULL) {
											if ($RowNumberName != NULL) {
												if ($RowNumber != NULL) {
													$RowNumber = mysql_real_escape_string($RowNumber);
													$query = 'UPDATE `'  . $this->databasetable . '` SET `' . $RowName . '` = \'' . $RowValue . '\' WHERE `' . $RowNumberName .'` = "' . $RowNumber . '" ';
													$result = mysql_query($query);
												} else {
													array_push($this->ErrorMessage,'updateRow: Row Number cannot be NULL!');
												}
											} else {
												array_push($this->ErrorMessage,'updateRow: Row Number Name cannot be NULL!');
											}
										} else {
											array_push($this->ErrorMessage,'updateRow: Row Value cannot be NULL!');
										}
									} else {
										array_push($this->ErrorMessage,'updateRow: Row Name cannot be NULL!');
									}
								} else {
									array_push($this->ErrorMessage,'updateRow: Row Name is not an Array, Row Value is not an Array, Row Number Name is not an Array so Row Number cannot be an Array!');
								}
							} else {
								array_push($this->ErrorMessage,'updateRow: Row Name is not an Array, Row Value is not an Array so Row Number Name cannot be an Array!');
							}
						} else {
							array_push($this->ErrorMessage, 'updateRow: Row Name is not an Array so Row Value cannot be an Array!');
						}
					} else {
						if (is_array($RowValue)){
							if (is_array($RowNumberName)) {
								if (is_array($RowNumber)) {
									while (isset($RowName[key($RowName)])) {
										if (is_array($RowNumberName[key($RowNumberName)]) || is_array($RowNumber[key($RowNumber)])) {
											$namearray = $RowNumberName[key($RowNumberName)];
											$valuearray = $RowNumber[key($RowNumber)];
											reset($namearray);
											reset($valuearray);
											$string = NULL;
											while (isset($namearray[key($namearray)])) {
												$string .= '`';
												$string .= mysql_real_escape_string(current($namearray));
												$string .= '` = \'';
												$string .= mysql_real_escape_string(current($valuearray));
												$string .= '\'';
												next($namearray);
												next($valuearray);
												if (isset($namearray[key($namearray)])) {
													$string .= ' AND ';
												}
											}
											$RowValuestring = NULL;
											$RowValuestring = current($RowValue);
											$RowValuestring = mysql_real_escape_string($RowValuestring);
											if ($RowValuestring) {
												$query = 'UPDATE `'  . $this->databasetable . '` SET `' . current($RowName) . '` = \'' . $RowValuestring . '\' WHERE ' . $string . ' ';
											} else {
												$query = 'UPDATE `'  . $this->databasetable . '` SET `' . current($RowName) . '` = NULL WHERE ' . $string . ' ';
											}

											$result = mysql_query($query);
										} else {
											$RowNumberstring = NULL;
											$RowNumberstring = mysql_real_escape_string(current($RowNumber));
											$RowNumberNamestring = NULL;
											$RowNumberNamestring = mysql_real_escape_string(current($RowNumberName));
											$RowNamestring = NULL;
											$RowNamestring = mysql_real_escape_string(current($RowName));
											$RowValuestring = NULL;
											$RowValuestring = mysql_real_escape_string(current($RowValue));
											if ($RowValuestring) {
												$query = 'UPDATE `'  . $this->databasetable . '` SET `' . $RowNamestring . '` = \'' . $RowValuestring . '\' WHERE `' . $RowNumberNamestring .'` = "' . $RowNumberstring . '" ';
											} else {
												$query = 'UPDATE `'  . $this->databasetable . '` SET `' . $RowNamestring . '` = NULL WHERE `' . $RowNumberNamestring .'` = "' . $RowNumberstring . '" ';
											}
											$result = mysql_query($query);
										}
										next($RowName);
										next($RowValue);
										if (!next($RowNumberName)) {
											reset($RowNumberName);
										}
										if (!next($RowNumber)) {
											reset($RowNumber);
										}
									}

								} else {
									array_push($this->ErrorMessage,'updateRow: Row Name is an Array, Row Value is an Array, Row Number Name is an Array and Row Number must be an Array!');
								}
							} else {
								array_push($this->ErrorMessage,'updateRow: Row Name is an Array, Row Value is an Array and Row Number Name must be an Array!');
							}
						} else {
							array_push($this->ErrorMessage,'updateRow: Row Name is an Array and Row Value must be an Array!');
						}
					}
				} else {
					array_push($this->ErrorMessage,'updateRow: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'updateRow: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'updateRow: Database name does not exist!');
		}
	}

	/**
	 * deleteRow
	 *
	 * Deletes a row from RowName and RowValue. RowName and RowValue can be a string or an array but must be the same type for each!
	 *
	 * @param string $RowName Name of the row to delete. Must be a string or an array of strings.
	 * @param string $RowValue Value of the row to delete. Must be a string or an array of strings.
	 * @access public
	*/
	public function deleteRow ($RowName, $RowValue) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('DELETE');

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($RowName)) {
						if (!is_array($RowValue)) {
							if ($RowName != NULL) {
								if ($RowValue != NULL) {
									$query = 'DELETE FROM ' . $this->databasetable . ' WHERE ' . $RowName . ' = ' . $RowValue . '';
									$result = mysql_query($query);
								} else {
									array_push($this->ErrorMessage,'deleteRow: Row Name has a value but Row Value cannot be NULL!');
								}
							} else {
								if ($RowValue == NULL) {
									$query = 'DELETE FROM ' . $this->databasetable . ' ';
									$result = mysql_query($query);
								} else {
									array_push($this->ErrorMessage,'deleteRow: Row Name is NULL but Row Value cannot have a value!');
								}
							}
						} else {
							array_push($this->ErrorMessage,'deleteRow: Row Value cannot be an Array!');
						}
					} else {
						if (is_array($RowValue)) {
							if ($RowName != NULL) {
								if ($RowValue != NULL) {
									while (isset($RowName[key($RowName)])) {
										$query = 'DELETE FROM ' . $this->databasetable . ' WHERE ' . current($RowName) . ' = ' . current($RowValue) . '';
										$result = mysql_query($query);
										next($RowName);
										next($RowValue);
									}
								} else {
									array_push($this->ErrorMessage,'deleteRow: Row Name is an array and has a value. Row Value is an array but cannot be NULL!');
								}
							} else {
								if ($RowValue == NULL) {
									$query = 'DELETE FROM ' . $this->databasetable . ' ';
									$result = mysql_query($query);
								} else {
									array_push($this->ErrorMessage,'deleteRow: Row Name is an array and is NULL but Row Value is an array but cannot have a value!');
								}
							}
						}
					}
				} else {
					array_push($this->ErrorMessage,'deleteRow: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'deleteRow: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'deleteRow: Database name does not exist!');
		}
	}

	/**
	 * createField
	 *
	 * Creates a new field from fieldstring. Fieldstring can be a string or an array. Fieldflag and fieldflagcolumn can be null. They
	 * are used to set attributes for a new field.
	 *
	 * @param string $fieldstring Name of the field to create. Must be a string or an array of strings.
	 * @param string $fieldflag Specify which field flag to be used. Must be any one of these values:
	 *		- FIRST - Specifies if the field is to be the first column of the table.
	 *		- AFTER - Specifies that the field is to be after fieldflagcolumn.
	 * @param string $fieldflagcolumn Used only when fieldflag is set to AFTER. Specify which field fieldstring is after.
	 * @access public
	*/
	public function createField ($fieldstring, $fieldflag, $fieldflagcolumn) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('ALTER');

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($fieldstring)) {
						if (!is_array($fieldflag)) {
							if (!is_array($fieldflagcolumn)) {
								if ($fieldstring != NULL) {
									if ($fieldflag != NULL) {
										if ($fieldflag == 'FIRST') {
											if ($fieldflagcolumn == NULL) {
												$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . $fieldstring . ' FIRST; ';
												$result = mysql_query($query);
												if (!$result) {
													array_push($this->ErrorMessage,"createField: FIRST: Field String exists in the Database!");
												}
											} else {
												array_push($this->ErrorMessage,'createField: Field Flag has been set to FIRST and Field Flag Column has to be NULL!');
											}
										} else if ($fieldflag == 'AFTER') {
											if ($fieldflagcolumn != NULL) {
												$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . $fieldstring . ' AFTER `' . $fieldflagcolumn .'` ; ';
												$result = mysql_query($query);
												if (!$result) {
													array_push($this->ErrorMessage,"createField: AFTER: Field String exists in the Database!");
												}
											} else {
												array_push($this->ErrorMessage,'createField: Field Flag has been set to AFTER and Field Flag Column cannot be NULL!');
											}
										} else {
											array_push($this->ErrorMessage,'createField: Field Flag can only be FIRST or AFTER');
										}
									} else {
										$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . $fieldstring . ' ; ';
										$result = mysql_query($query);
										if (!$result) {
											array_push($this->ErrorMessage,"createField: Field String exists in the Database!");
										}
									}
								} else {
									array_push($this->ErrorMessage,'createField: Field String cannot be NULL!');
								}
							} else {

								array_push($this->ErrorMessage,'createField: Field Flag Column cannot be an Array!');
							}
						} else {
							array_push($this->ErrorMessage,'createField: Field Flag cannot be an Array!');
						}
					} else {
						if (is_array($fieldflag)) {
							if (is_array($fieldflagcolumn)) {
								if ($fieldstring != NULL) {
									while (current($fieldstring)) {
										if ($fieldflag != NULL) {
											if (current($fieldflag) == 'FIRST') {
												if (current($fieldflagcolumn) == NULL) {
													$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . current($fieldstring) . ' FIRST; ';
													$result = mysql_query($query);
													if (!$result) {
														$temp = key($fieldstring);
														array_push($this->ErrorMessage,"createField: FIRST: Field String [$temp] exists in the Database!");
													}
												} else {
													array_push($this->ErrorMessage,"createField: Field Flag [current($fieldflag)] has been set to FIRST and Field Flag Column [current($fieldflagcolumn)]has to be NULL!");
												}
											} else if (current($fieldflag) == 'AFTER') {
												if ($fieldflagcolumn != NULL) {
													$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . current($fieldstring) . ' AFTER `' . current($fieldflagcolumn) .'` ; ';
													$result = mysql_query($query);
													if (!$result) {
														$temp = key($fieldstring);
														array_push($this->ErrorMessage,"createField: AFTER: Field String [$temp] and Field Flag Column [$temp] exists in the Database!");
													}
												} else {
													array_push($this->ErrorMessage,'createField: Field Flag [current($fieldflag)] has been set to AFTER and Field Flag Column [current($fieldflagcolumn)] cannot be NULL!');
												}
											} else {
												array_push($this->ErrorMessage,'createField: Field Flag [current($fieldflag)] can only be FIRST or AFTER');
											}
										} else {
											$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . current($fieldstring) . ' ; ';
											$result = mysql_query($query);
											if (!$result) {
												$temp = key($fieldstring);
												array_push($this->ErrorMessage,"createField: Field String [$temp] exists in the Database!");
											}
										}
										next($fieldstring);
										next($fieldflag);
										next($fieldflagcolumn);
									}
								} else {
									array_push($this->ErrorMessage,'createField: Field String cannot be NULL!');
								}
							} else {
								array_push($this->ErrorMessage,'createField: Field String is an Array. Field Flag is an Array so Field Flag Column must be an Array!');
							}
						} else {
							array_push($this->ErrorMessage,'createField: Field String is an Array so Field Flag must be an Array!');
						}
					}
				} else {
					array_push($this->ErrorMessage,'createField: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'createField: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'createField: Database name does not exist!');
		}
	}

	/**
	 * updateField
	 *
	 * Updates a field from field and fieldchange. Field and fieldchange can be a string or an array but must be the same type for each!
	 *
	 * @param string $field Name of the field to change. Must be a string or an array of strings.
	 * @param string $fieldchange Value of the field to change. Must be a string or an array of strings.
	 * @access public
	*/
	public function updateField ($field, $fieldchange) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('ALTER');
		$fieldcheck = $this->checkField($field);
		$fieldcheck2 = $this->checkField($fieldchange);

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($field)) {
						if ($field != NULL) {
							if ($fieldcheck) {
								if (!is_array($fieldchange)) {
									if ($fieldchange != NULL) {
										if (!$fieldcheck2) {
											$type = NULL;

											$query = "SHOW COLUMNS FROM `$this->databasetable` LIKE '$field';";
											$result = mysql_query($query);
											$fieldvalue = mysql_fetch_array($result, MYSQL_ASSOC);
											unset($fieldvalue['Field']);

											if ($fieldvalue['Type']) {
												$type = $fieldvalue['Type'];
												unset($fieldvalue['Type']);
											}

											if ($fieldvalue['Key'] == NULL) {
												unset($fieldvalue['Key']);
											}

											if ($fieldvalue['Extra'] == NULL) {
												unset($fieldvalue['Extra']);
											}

											if ($type){
												$type = strtoupper($type);
												$changestring .= $type;
												$changestring .= ' ';
											} else {
												$changestring .= 'NULL ';
											}
											reset($fieldvalue);
											while (key($fieldvalue)){
												if (key($fieldvalue) == 'Null') {
													if (current($fieldvalue)) {
														$changestring .= "current($fieldvalue) ";
													} else {
														$changestring .= 'NOT NULL ';
													}
												} else {
													$hold = key($fieldvalue);
													$changestring .= "$hold ";
													$hold = current($fieldvalue);
													$changestring .= "'$hold' ";
												}
												next($fieldvalue);
											}
											$query2 = 'ALTER TABLE `' . $this->databasetable . '` CHANGE `' . $field .'` `' . $fieldchange . '` ' . $changestring . ' ;';
											$result2 = mysql_query($query2);
										} else {
											array_push($this->ErrorMessage,'updateField: Field Change - Field name exists!');
										}
									} else {
										array_push($this->ErrorMessage,'updateField: Field Change cannot be NULL!');
									}
								} else {

									array_push($this->ErrorMessage,'updateField: Field Change cannot be an Array!');
								}

							} else {
								array_push($this->ErrorMessage,'updateField: Field name does not exist!');
							}
						} else {
							array_push($this->ErrorMessage,'updateField: Field cannot be NULL!');
						}
					} else {
						if ($field != NULL) {
							while (isset($field[key($field)])) {
								$fieldcheck = $this->checkField(current($field));
								$fieldcheck2 = $this->checkField(current($fieldchange));
								if ($fieldcheck) {
									if (is_array($fieldchange)) {
										if ($fieldchange != NULL) {
											if (!$fieldcheck2) {
												$type = NULL;
												$helper = current($field);
												$query = "SHOW COLUMNS FROM `$this->databasetable` LIKE '$helper';";
												$result = mysql_query($query);
												$fieldvalue = mysql_fetch_array($result, MYSQL_ASSOC);
												unset($fieldvalue['Field']);

												if ($fieldvalue['Type']) {
													$type = $fieldvalue['Type'];
													unset($fieldvalue['Type']);
												}

												if ($fieldvalue['Key'] == NULL) {
													unset($fieldvalue['Key']);
												}

												if ($fieldvalue['Extra'] == NULL) {
													unset($fieldvalue['Extra']);
												}

												if ($type){
													$type = strtoupper($type);
													$changestring .= $type;
													$changestring .= ' ';
												} else {
													$changestring .= 'NULL ';
												}
												reset($fieldvalue);
												while (key($fieldvalue)){
													if (key($fieldvalue) == 'Null') {
														if (current($fieldvalue)) {
															$changestring .= "current($fieldvalue) ";
														} else {
															$changestring .= 'NOT NULL ';
														}
													} else {
														$hold = key($fieldvalue);
														$changestring .= "$hold ";
														$hold = current($fieldvalue);
														$changestring .= "'$hold' ";
													}
													next($fieldvalue);
												}
												$query2 = 'ALTER TABLE `' . $this->databasetable . '` CHANGE `' . current($field) .'` `' . current($fieldchange) . '` ' . $changestring . ' ;';
												$result2 = mysql_query($query2);
											} else {
												$temp = key($fieldchange);
												array_push($this->ErrorMessage,"updateField: Field is an Array and Field Change [$temp] - Field name exists!");
											}
										} else {
											array_push($this->ErrorMessage,'updateField: Field is an Array so Field Change cannot be NULL!');
										}
									} else {
										array_push($this->ErrorMessage,'updateField: Field is an Array so Field Change must be an Array!');
									}
								} else {
									$temp = key($field);
									array_push($this->ErrorMessage,"updateField: Field [$temp] is an Array and Field name does not exist!");
								}
								next($field);
								next($fieldchange);
							}
						} else {
							array_push($this->ErrorMessage,'updateField: Field is an Array and cannot be NULL!');
						}
					}
				} else {
					array_push($this->ErrorMessage,'updateField: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'updateField: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'updateField: Database name does not exist!');
		}
	}

	/**
	 * deleteField
	 *
	 * Deletes a field from field. Field can be a string or an array.
	 *
	 * @param string $field Name of the field to delete. Must be a string or an array of strings.
	 * @access public
	*/
	public function deleteField ($field) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('ALTER');
		$fieldcheck = $this->checkField($field);

		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($field)) {
						if ($field != NULL) {
							if ($fieldcheck) {
								$query = 'ALTER TABLE `' . $this->databasetable . '` DROP `' . $field . '` ; ';
								$result = mysql_query($query);
							} else {
								array_push($this->ErrorMessage,'deleteField: Field does not exist!');
							}
						} else {
							array_push($this->ErrorMessage,'deleteField: Field cannot be NULL!');
						}
					} else {
						if ($field != NULL) {
							while (isset($field[key($field)])) {
								$fieldcheck = $this->checkField(current($field));
								if ($fieldcheck) {
									$query = 'ALTER TABLE `' . $this->databasetable . '` DROP `' . current($field) . '` ; ';
									$result = mysql_query($query);
									next($field);
								} else {
									array_push($this->ErrorMessage,'deleteField: Field is an Array but does not exist!');
								}
							}
						} else {
							array_push($this->ErrorMessage,'deleteField: Field is an Array but cannot be NULL!');
						}
					}
				} else {
					array_push($this->ErrorMessage,'deleteField: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'deleteField: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'deleteField: Database name does not exist!');
		}

	}

	public function emptyTable() {
		$query = 'TRUNCATE TABLE `' . $this->databasetable . '` ; ';
		$result = mysql_query($query);
	}

	public function executeSQlCommand ($SQLCommand) {
		if (!is_null($SQLCommand)) {
			$this->Connect();
			$result = mysql_query($SQLCommand);
			$this->Disconnect();
		}
	}

	public function sortTable($sortorder) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('ALTER');
		if (!is_array($sortorder)) {
			$fieldcheck = $this->checkField($sortorder);
		}
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($sortorder)) {
						if ($sortorder != NULL) {
							if ($fieldcheck) {
								$query = 'ALTER TABLE `' . $this->databasetable . '` ORDER BY `' . $sortorder . '` ; ';
								$result = mysql_query($query);
							} else {
								array_push($this->ErrorMessage,'sortTable: Field does not exist!');
							}
						} else {
							array_push($this->ErrorMessage,'sortTable: Field cannot be NULL!');
						}
					} else {
						if ($sortorder != NULL) {
							$string = NULL;
							reset($sortorder);
							while (isset($sortorder[key($sortorder)])) {
								$fieldcheck = $this->checkField(current($sortorder));
								if ($fieldcheck) {
									$string .= '`';
									$string .= current($sortorder);
									$string .= '`';
									next($sortorder);
									if (current($sortorder)) {
										$string .= ', ';
									}
								} else {
									array_push($this->ErrorMessage,'sortTable: Field is an Array but does not exist!');
								}
							}
							if ($string != NULL) {
								$query = 'ALTER TABLE `' . $this->databasetable . '` ORDER BY ' . $string . ' ; ';
								$result = mysql_query($query);
							}
						} else {
							array_push($this->ErrorMessage,'sortTable: Field is an Array but cannot be NULL!');
						}
					}
				} else {
					array_push($this->ErrorMessage,'sortTable: Table name does not exist!');
				}
			} else {
				array_push($this->ErrorMessage,'sortTable: Permission has been denied!');
			}
		} else {
			array_push($this->ErrorMessage,'sortTable: Database name does not exist!');
		}
	}

	/**
	 * setDatabaseRow
	 *
	 * Executes a SQL query to retrieve the database rows creating a numerical array based on idnumber. Idnumber must be an array!
	 * To get the results, use getRowField(String $rowfield) for a single field in a row and getMultiRowField() for the entire row
	 * or multiple rows depending on the idnumber passed!
	 *
	 * @param array $idnumber Idnumber for the database query. Must be an array of strings with the key being the name of the field
	 * and the value being value of the field.
	 * @access public
	*/
	public function setDatabaseRow ($idnumber) {
		$this->idnumber = $idnumber;
		if ($this->multirowfield) {
			$this->multirowfield = array();
		}

		if (is_array($idnumber)) {
			while (isset($this->idnumber[key($this->idnumber)])) {
				$temp .= '`';
				$temp .= key($this->idnumber);
				$temp .= '` = "';
				$temp .= current($this->idnumber);
				$temp .= '" ';
				next($this->idnumber);
				if (isset($this->idnumber[key($this->idnumber)])) {
					$temp .= 'AND ';
				}
			}
			reset($this->idnumber);
			if ($this->orderbyname && $this->orderbytype) {
				$this->rowquery = 'SELECT * FROM ' . $this->databasetable . ' WHERE ' . $temp .' ORDER BY `' . $this->orderbyname . '` ' . $this->orderbytype;
			} else {
				$this->rowquery = 'SELECT * FROM ' . $this->databasetable . ' WHERE ' . $temp .' ';
			}

			if ($this->limit) {
				$this->rowquery .= ' LIMIT ';
				$this->rowquery .= $this->limit;
			}

			$this->rowresult = mysql_query($this->rowquery);

			if ($this->rowresult) {
				$this->rowfield = mysql_fetch_array($this->rowresult, MYSQL_ASSOC);

				array_push($this->multirowfield, $this->rowfield);
				$rowfield = mysql_fetch_array($this->rowresult, MYSQL_ASSOC);
				while ($rowfield) {
					array_push($this->multirowfield, $rowfield);
					$rowfield = mysql_fetch_array($this->rowresult, MYSQL_ASSOC);
				}
			}

		} else {
			array_push($this->ErrorMessage,'setDatabaseRow: Idnumber must be an Array!');
		}
	}

	/**
	 * setEntireTable
	 * Performs a SQL query to get the entire database table. Use getEntireTable() to get the entire table results!
	 *
	 * @access public
	*/
	public function setEntireTable () {
		if ($this->orderbyname && $this->orderbytype) {
			$this->tablequery = 'SELECT * FROM ' . $this->databasetable . ' ' . 'ORDER BY `' . $this->orderbyname . '` ' . $this->orderbytype;
		} else {
			$this->tablequery = 'SELECT * FROM ' . $this->databasetable . ' ';
		}
		if ($this->limit) {
			$this->tablequery .= ' LIMIT ';
			$this->tablequery .= $this->limit;
		}

		$this->tableresult = mysql_query($this->tablequery);

		if ($this->tableresult) {
			$this->rownumber = mysql_num_rows($this->tableresult);
			//mysql_data_seek($this->tableresult, 0);
		}

		$this->rownumber = $this->rownumber + 0;
		$this->i = 1;
		$this->BuildingEntireTable();
	}

	protected function BuildingEntireTable(){
		$i = 1;
		if ($this->entiretable) {
			$this->entiretable = NULL;
			$this->entiretable = array();
		}
		while ($i <= $this->rownumber){
			$this->entiretable[$i] = mysql_fetch_array($this->tableresult, MYSQL_ASSOC);
			$i++;
		}
	}

	/**
	 * BuildDatabaseRows
	 * Executes a SQL query to retrieve the database rows creating an associative array based on idnumber set from
	 * setIdNumber($idnumber). Idnumber must be an array. To retrieve the results use getDatabase($rownumber) using
	 * row value as rownumber.
	 *
	 * OPTIONAL - limit:
	 * If limit is set from setLimit, BuildDatabaseRows will impose that limit on the query.
	 *
	 * @access public
	*/
	public function BuildDatabaseRows (){
		if (is_array($this->idnumber)) {
			while (isset($this->idnumber[key($this->idnumber)])) {
				$temp .= '`';
				$temp .= key($this->idnumber);
				$temp .= '` = "';
				$temp .= current($this->idnumber);
				$temp .= '" ';
				next($this->idnumber);
				if (isset($this->idnumber[key($this->idnumber)])) {
					$temp .= 'AND ';
				}
			}
			reset($this->idnumber);
			if ($this->orderbyname && $this->orderbytype) {
				$this->rowquery = 'SELECT * FROM ' . $this->databasetable . ' WHERE ' . $temp .' ORDER BY `' . $this->orderbyname . '` ' . $this->orderbytype;
			} else {
				$this->rowquery = 'SELECT * FROM ' . $this->databasetable . ' WHERE ' . $temp .' ';
			}

			if ($this->limit) {
				$this->rowquery .= ' LIMIT ';
				$this->rowquery .= $this->limit;
			}
			$this->rowresult = mysql_query($this->rowquery);
			if ($this->rowresult) {
				$this->database = mysql_fetch_assoc($this->rowresult);
			}
		} else {
			array_push($this->ErrorMessage,'setDatabaseRow: Idnumber must be an Array!');
		}
	}

	public function BuildFieldNames($TableName) {
		if ($TableName) {
			$this->databasetable = $TableName;
		}

		$this->Connect();
		$query = 'SHOW COLUMNS FROM `' . $this->databasetable . '` ';
		$result = mysql_query($query);

		$this->rowfieldnames = array();
		while ($row = mysql_fetch_array ($result)) {
			array_push($this->rowfieldnames, $row['Field']);
			$row = NULL;
		}
	}

}
?>