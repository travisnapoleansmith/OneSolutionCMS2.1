<?php
class MySqlConnect extends Tier2DataAccessLayerModulesAbstract implements Tier2DataAccessLayerModules
{
	public function MySqlConnect () {
		$this->idsearch = Array();
		$this->errormessage = Array();
	}
	
	public function Connect () {
		if (!($this->link = mysql_connect($this->hostname, $this->user, $this->password))) {
			array_push($this->errormessage,'Connect: Could not connect to server');
		}
		
		if ($this->link) {
			if (!mysql_select_db($this->databasename, $this->link)) {
				array_push($this->errormessage,'Connect: Could not select database');
			}
		}
	}
		
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
		array_push($this->errormessage,'checkDatabaseName: Database Name does not exist'); 
		return FALSE;
	}
	
	protected function checkTableName () {
		if ($this->tablenames) {
			$results = $this->tablenamequery;
		} else {
			$this->Connect();
			$results = mysql_list_tables($this->databasename, $this->link);
			$this->tablenamequery = $results;
			$this->tablenames = Array();
			$i = 0;
			while (mysql_tablename($results, $i)) {
				array_push($this->tablenames, mysql_tablename($results, $i));
				$i++;
			}
		}
		$i = 0;
		while (mysql_tablename($results, $i)) {
			$temp = mysql_tablename($results, $i);
			if ($temp == $this->databasetable) {
				return $temp;
			}
			$i++;
		}
		array_push($this->errormessage,'checkTableName: Table Name does not exist');
		return FALSE;
	}
	
	protected function checkPermissions ($permission) {
		$this->Connect();
		$query = 'SHOW GRANTS';
		$result = mysql_query($query);
		$userdata = mysql_result($result, 1);
		$userdata2 = mysql_result($result, 0);
		$userdata = substr_replace($userdata, NULL, 0, 5);
		if (strpos($userdata, $permission)) {
			return TRUE;
		} else if (strpos($userdata2, 'ALL PRIVILEGES ON')){
			return TRUE;
		} else {
			array_push($this->errormessage,'checkPermissions: Permission has been denied');
			return FALSE;
		}
	}
	
	protected function checkField ($field) {
		$this->Connect();
		$query = 'SHOW COLUMNS FROM `' . $this->databasetable . '` LIKE "' . $field . '" ';
		$result = mysql_query($query);
		$userdata = mysql_result($result, 0);
		if (!$userdata) {
			return FALSE;
		} else {
			if ($userdata == $field) {
				return $userdata;
			} else {
				array_push($this->errormessage,'checkField: Field does not exist');
				return FALSE;
			}
		}
	}
	
	public function createDatabase () {
		$databasenamecheck = $this->checkDatabaseName();
		$permissionscheck = $this->checkPermissions ('CREATE');
		
		if (!$databasenamecheck) {
			if ($permissionscheck) {
				$query = 'CREATE DATABASE ' . $this->databasename .'';
				$result = mysql_query($query);
			} else {
				array_push($this->errormessage,'createDatabase: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'createDatabase: Database name exists!');
		}
	}
	
	public function deleteDatabase (){
		$databasenamecheck = $this->checkDatabaseName();
		$permissionscheck = $this->checkPermissions('DROP');
		
		if ($databasenamecheck) {
			if ($permissionscheck) {
				$query = 'DROP DATABASE ' . $this->databasename .'';
				$result = mysql_query($query);
			} else {
				array_push($this->errormessage,'deleteDatabase: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'deleteDatabase: Database name does not exist!');
		}
	}
	
	public function createTable ($tablestring) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('CREATE');
		
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if (!$tablenamecheck) {
					if (!is_array($tablestring)) {
						if ($tablestring != NULL) {
							$query = 'CREATE TABLE ' . $this->databasetable . ' ( ' . $tablestring . ' ); ';
							$result = mysql_query($query);
						} else {
							array_push($this->errormessage,'createTable: Table String cannot be NULL!');
						}
					} else {
						array_push($this->errormessage,'createTable: Table String cannot be an Array!');
					}
				} else {
					array_push($this->errormessage,'createTable: Table name exists!');
				}
			} else {
				array_push($this->errormessage,'createTable: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'createTable: Database name does not exist!');
		}
	}
	
	public function updateTable ($tablestring) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('UPDATE');
		
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if ($tablestring != NULL) {
						if (!is_array($tablestring)) {
							$query = 'UPDATE `'  . $this->databasetable . '` SET ' . $tablestring . '; ';
							$result = mysql_query($query);
						} else {
							while (isset($tablestring[key($tablestring)])) {
								$query = 'UPDATE `'  . $this->databasetable . '` SET ' . current($tablestring) . '; ';
								$result = mysql_query($query);
								next($tablestring);
							}
						}
					} else {
						array_push($this->errormessage,'updateTable: Table string cannot be NULL!');
					}
				} else {
					array_push($this->errormessage,'updateTable: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'updateTable: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'updateTable: Database name does not exist!');
		}
	}
	
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
					array_push($this->errormessage,'deleteTable: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'deleteTable: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'deleteTable: Database name does not exist!');
		}
	}
	
	public function createRow ($rowname, $rowvalue) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('INSERT');

		$insertrow = NULL;
		$insertrowvalue = NULL;
		
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (is_array($rowname[0])) {
						if (is_array($rowvalue[0])) {
							if ($rowname != NULL) {
								if ($rowvalue != NULL) {
									while (isset($rowname[key($rowname)])) {
										while(current($rowname[key($rowname)])) {
											$insertrow .= "`";
											$insertrow .= current($rowname[key($rowname)]);
											$insertrow .= "`";
											$insertrowvalue .= "'";
											if (current($rowvalue[key($rowvalue)]) == NULL) {
												$insertrowvalue .= 'NULL';
											} else {
												$insertrowvalue .= current($rowvalue[key($rowvalue)]);
											}
											$insertrowvalue .= "'";
											
											next($rowname[key($rowname)]);
											next($rowvalue[key($rowvalue)]);
											if (current($rowname[key($rowname)])) {
												$insertrow .= ' , ';
												$insertrowvalue .= ' , ';
											}
										}
										
										$query = 'INSERT INTO ' . $this->databasetable . ' ( ' . $insertrow . ') VALUES ( ' . $insertrowvalue . '); ';
										$result = mysql_query($query);
										if (!$result) {
											$temp = key($rowvalue);
											array_push($this->errormessage,"createRow: Row Value [$temp] exists in the Database!");
										}
										
										next($rowname);
										next($rowvalue);
										
										$insertrowvalue = NULL;
										$insertrow = NULL;
									}
								} else {
									array_push($this->errormessage,'createRow: Row Value cannot be NULL!');
								}
							} else {
								array_push($this->errormessage,'createRow: Row Name cannot be NULL!');
							}
						} else if (is_array($rowvalue)){
							array_push($this->errormessage,'createRow: Row Name is a 3 dimmensional Array but Row Value must be an Array!');
						} else {
							array_push($this->errormessage,'createRow: Row Name is a 3 Dimmensional Array but Row Value must be a 3 Dimmensional Array!');
						}
					} else if (is_array($rowvalue[0])) {
						array_push($this->errormessage,'createRow: Row Value is a 3 Dimmensional Array but Row Name must be a 3 Dimmensional Array!');
					} else if (is_array($rowname)) {
						if (is_array($rowvalue)) {
							if ($rowname != NULL) {
								if ($rowvalue != NULL) {
									while (isset($rowname[key($rowname)])) {
										$insertrow .= "`";
										$insertrow .= current($rowname);
										$insertrow .= "`";
										$insertrowvalue .= "'";
										if (current($rowvalue) == NULL) {
											$insertrowvalue .= 'NULL';
										} else {
											$insertrowvalue .= current($rowvalue);
										}
										$insertrowvalue .= "'";
										next($rowname);
										next($rowvalue);
										if (current($rowname)) {
											$insertrow .= ' , ';
											$insertrowvalue .= ' , ';
										}
									}
									$query = 'INSERT INTO ' . $this->databasetable . ' ( ' . $insertrow . ') VALUES ( ' . $insertrowvalue . '); ';
									$result = mysql_query($query);
									
									if (!$result) {
										array_push($this->errormessage,'createRow: Row Value exists in the Database!');
									}
								} else {
									array_push($this->errormessage,'createRow: Row Value cannot be NULL!');
								}
							} else {
								array_push($this->errormessage,'createRow: Row Name cannot be NULL!');
							}
						} else {
							array_push($this->errormessage,'createRow: Row Value must be an Array!');
						}
					} else {
						array_push($this->errormessage,'createRow: Row Name must be an Array!');
					}
				} else {
					array_push($this->errormessage,'createRow: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'createRow: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'createRow: Database name does not exist!');
		}
	}
	
	public function updateRow ($rowname, $rowvalue, $rownumbername, $rownumber) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('UPDATE');
		
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($rowname)) {
						if (!is_array($rowvalue)) {
							if (!is_array($rownumbername)) {
								if (!is_array($rownumber)) {
									if ($rowname != NULL) {
										if ($rowvalue != NULL) {
											if ($rownumbername != NULL) {
												if ($rownumber != NULL) {
													$query = 'UPDATE `'  . $this->databasetable . '` SET `' . $rowname . '` = "' . $rowvalue . '" WHERE `' . $rownumbername .'` = "' . $rownumber . '" ';
													$result = mysql_query($query);
												} else {
													array_push($this->errormessage,'updateRow: Row Number cannot be NULL!');
												}
											} else {
												array_push($this->errormessage,'updateRow: Row Number Name cannot be NULL!');
											}
										} else {
											array_push($this->errormessage,'updateRow: Row Value cannot be NULL!');
										}
									} else {
										array_push($this->errormessage,'updateRow: Row Name cannot be NULL!');
									}
								} else {
									array_push($this->errormessage,'updateRow: Row Name is not an Array, Row Value is not an Array, Row Number Name is not an Array so Row Number cannot be an Array!');
								}
							} else {
								array_push($this->errormessage,'updateRow: Row Name is not an Array, Row Value is not an Array so Row Number Name cannot be an Array!');
							}
						} else {
							array_push($this->errormessage, 'updateRow: Row Name is not an Array so Row Value cannot be an Array!');
						}
					} else {
						if (is_array($rowvalue)){
							if (is_array($rownumbername)) {
								if (is_array($rownumber)) {
									while (isset($rowname[key($rowname)])) {
										$query = 'UPDATE `'  . $this->databasetable . '` SET `' . current($rowname) . '` = "' . current($rowvalue) . '" WHERE `' . current($rownumbername) .'` = "' . current($rownumber) . '" ';
										$result = mysql_query($query);
										
										next($rowname);
										next($rowvalue);
										next($rownumbername);
										next($rownumber);
									}
								} else {
									array_push($this->errormessage,'updateRow: Row Name is an Array, Row Value is an Array, Row Number Name is an Array and Row Number must be an Array!');
								}
							} else {
								array_push($this->errormessage,'updateRow: Row Name is an Array, Row Value is an Array and Row Number Name must be an Array!');
							}
						} else {
							array_push($this->errormessage,'updateRow: Row Name is an Array and Row Value must be an Array!');
						}
					}
				} else {
					array_push($this->errormessage,'updateRow: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'updateRow: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'updateRow: Database name does not exist!');
		}
	}
	
	public function deleteRow ($rowname, $rowvalue) {
		$databasenamecheck = $this->checkDatabaseName();
		$tablenamecheck = $this->checkTableName();
		$permissionscheck = $this->checkPermissions ('DELETE');
		
		if ($databasenamecheck) {
			if ($permissionscheck) {
				if ($tablenamecheck) {
					if (!is_array($rowname)) {
						if (!is_array($rowvalue)) {
							if ($rowname != NULL) {
								if ($rowvalue != NULL) {
									$query = 'DELETE FROM ' . $this->databasetable . ' WHERE ' . $rowname . ' = ' . $rowvalue . '';
									$result = mysql_query($query);
								} else {
									array_push($this->errormessage,'deleteRow: Row Name has a value but Row Value cannot be NULL!');
								}
							} else {
								if ($rowvalue == NULL) {
									$query = 'DELETE FROM ' . $this->databasetable . ' ';
									$result = mysql_query($query);
								} else {
									array_push($this->errormessage,'deleteRow: Row Name is NULL but Row Value cannot have a value!');
								}
							}
						} else {
							array_push($this->errormessage,'deleteRow: Row Value cannot be an Array!');
						}
					} else {
						if (is_array($rowvalue)) {
							if ($rowname != NULL) {
								if ($rowvalue != NULL) {
									while (isset($rowname[key($rowname)])) {
										$query = 'DELETE FROM ' . $this->databasetable . ' WHERE ' . current($rowname) . ' = ' . current($rowvalue) . '';
										$result = mysql_query($query);
										next($rowname);
										next($rowvalue);
									}
								} else {
									array_push($this->errormessage,'deleteRow: Row Name is an array and has a value. Row Value is an array but cannot be NULL!');
								}
							} else {
								if ($rowvalue == NULL) {
									$query = 'DELETE FROM ' . $this->databasetable . ' ';
									$result = mysql_query($query);
								} else {
									array_push($this->errormessage,'deleteRow: Row Name is an array and is NULL but Row Value is an array but cannot have a value!');
								}
							}
						}
					}
				} else {
					array_push($this->errormessage,'deleteRow: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'deleteRow: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'deleteRow: Database name does not exist!');
		}
	}
	
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
													array_push($this->errormessage,"createField: FIRST: Field String exists in the Database!");
												}
											} else {
												array_push($this->errormessage,'createField: Field Flag has been set to FIRST and Field Flag Column has to be NULL!');
											}
										} else if ($fieldflag == 'AFTER') {
											if ($fieldflagcolumn != NULL) {
												$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . $fieldstring . ' AFTER `' . $fieldflagcolumn .'` ; ';
												$result = mysql_query($query);
												if (!$result) {
													array_push($this->errormessage,"createField: AFTER: Field String exists in the Database!");
												}
											} else {
												array_push($this->errormessage,'createField: Field Flag has been set to AFTER and Field Flag Column cannot be NULL!');
											}
										} else { 
											array_push($this->errormessage,'createField: Field Flag can only be FIRST or AFTER');
										}
									} else {
										$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . $fieldstring . ' ; ';
										$result = mysql_query($query);
										if (!$result) {
											array_push($this->errormessage,"createField: Field String exists in the Database!");
										}
									}
								} else {
									array_push($this->errormessage,'createField: Field String cannot be NULL!');
								}
							} else {
								
								array_push($this->errormessage,'createField: Field Flag Column cannot be an Array!');
							}
						} else {
							array_push($this->errormessage,'createField: Field Flag cannot be an Array!');
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
														array_push($this->errormessage,"createField: FIRST: Field String [$temp] exists in the Database!");
													}
												} else {
													array_push($this->errormessage,"createField: Field Flag [current($fieldflag)] has been set to FIRST and Field Flag Column [current($fieldflagcolumn)]has to be NULL!");
												}
											} else if (current($fieldflag) == 'AFTER') {
												if ($fieldflagcolumn != NULL) {
													$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . current($fieldstring) . ' AFTER `' . current($fieldflagcolumn) .'` ; ';
													$result = mysql_query($query);
													if (!$result) {
														$temp = key($fieldstring);
														array_push($this->errormessage,"createField: AFTER: Field String [$temp] and Field Flag Column [$temp] exists in the Database!");
													}
												} else {
													array_push($this->errormessage,'createField: Field Flag [current($fieldflag)] has been set to AFTER and Field Flag Column [current($fieldflagcolumn)] cannot be NULL!');
												}
											} else { 
												array_push($this->errormessage,'createField: Field Flag [current($fieldflag)] can only be FIRST or AFTER');
											}
										} else {
											$query = 'ALTER TABLE `' . $this->databasetable . '` ADD ' . current($fieldstring) . ' ; ';
											$result = mysql_query($query);
											if (!$result) {
												$temp = key($fieldstring);
												array_push($this->errormessage,"createField: Field String [$temp] exists in the Database!");
											}
										}
										next($fieldstring);
										next($fieldflag);
										next($fieldflagcolumn);
									}
								} else {
									array_push($this->errormessage,'createField: Field String cannot be NULL!');
								}
							} else {
								array_push($this->errormessage,'createField: Field String is an Array. Field Flag is an Array so Field Flag Column must be an Array!');
							}
						} else {
							array_push($this->errormessage,'createField: Field String is an Array so Field Flag must be an Array!');
						}
					}
				} else {
					array_push($this->errormessage,'createField: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'createField: Permission has been denied!');
			} 
		} else {
			array_push($this->errormessage,'createField: Database name does not exist!');
		}
	}
	
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
											array_push($this->errormessage,'updateField: Field Change - Field name exists!');
										}
									} else {
										array_push($this->errormessage,'updateField: Field Change cannot be NULL!');
									}
								} else {
									
									array_push($this->errormessage,'updateField: Field Change cannot be an Array!');
								}
								
							} else {
								array_push($this->errormessage,'updateField: Field name does not exist!');
							}
						} else {
							array_push($this->errormessage,'updateField: Field cannot be NULL!');
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
												array_push($this->errormessage,"updateField: Field is an Array and Field Change [$temp] - Field name exists!");
											}
										} else {
											array_push($this->errormessage,'updateField: Field is an Array so Field Change cannot be NULL!');
										}
									} else {
										array_push($this->errormessage,'updateField: Field is an Array so Field Change must be an Array!');
									}
								} else {
									$temp = key($field);
									array_push($this->errormessage,"updateField: Field [$temp] is an Array and Field name does not exist!");
								}
								next($field);
								next($fieldchange);
							}
						} else {
							array_push($this->errormessage,'updateField: Field is an Array and cannot be NULL!');
						}
					}
				} else {
					array_push($this->errormessage,'updateField: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'updateField: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'updateField: Database name does not exist!');
		}
	}
	
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
								array_push($this->errormessage,'deleteField: Field does not exist!');
							}
						} else {
							array_push($this->errormessage,'deleteField: Field cannot be NULL!');
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
									array_push($this->errormessage,'deleteField: Field is an Array but does not exist!');
								}
							}
						} else {
							array_push($this->errormessage,'deleteField: Field is an Array but cannot be NULL!');
						}
					}
				} else {
					array_push($this->errormessage,'deleteField: Table name does not exist!');
				}
			} else {
				array_push($this->errormessage,'deleteField: Permission has been denied!');
			}
		} else {
			array_push($this->errormessage,'deleteField: Database name does not exist!');
		}
		
	}
	
	public function setDatabaseRow ($idnumber) {
		$this->idnumber = $idnumber;
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
			$this->rowresult = mysql_query($this->rowquery);
			if ($this->rowresult) {
				$this->rowfield = mysql_fetch_array($this->rowresult, MYSQL_ASSOC);
			}
		} else {
			array_push($this->errormessage,'setDatabaseRow: Idnumber must be an Array!');
		}
	}
	
	public function setEntireTable () {
		if ($this->orderbyname && $this->orderbytype) {
			$this->tablequery = 'SELECT * FROM ' . $this->databasetable . ' ' . 'ORDER BY `' . $this->orderbyname . '` ' . $this->orderbytype;
		} else {
			$this->tablequery = 'SELECT * FROM ' . $this->databasetable . ' ';
		}
		$this->tableresult = mysql_query($this->tablequery);
		
		if ($this->tableresult) {
			$this->rownumber = mysql_num_rows($this->tableresult);
			mysql_data_seek($this->tableresult, 0);
		}
		$this->rownumber = $this->rownumber + 0;
		$this->i = 1;
		$this->BuildingEntireTable();
	}
	
	protected function BuildingEntireTable(){
		$i = 1;
		while ($i <= $this->rownumber){
			$this->entiretable[$i] = mysql_fetch_array($this->tableresult, MYSQL_ASSOC);
			$i++;
		}
	}
	
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

			$this->rowresult = mysql_query($this->rowquery);
			if ($this->rowresult) {
				$this->database = mysql_fetch_assoc($this->rowresult);
			}
		} else {
			array_push($this->errormessage,'setDatabaseRow: Idnumber must be an Array!');
		}
	}
}
?>