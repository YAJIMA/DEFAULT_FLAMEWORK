<?php
include_once('db.php');

class confEngine extends queryFactory {
	
	var $tconf = T_CONF;
	
	function __construct() {
		$this->count_queries = 0;
		$this->total_query_time = 0;
	}
	
	function load() {
		$this->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false);
		$tableName = $this->tconf;
		$sql = "SELECT `key`, `val` FROM $tableName";
		$res = $this->Execute($sql);
		while(!$res->EOF){
			if(!defined($res->fields['key'])){
				define($res->fields['key'], $res->fields['val']);
			}
			$res->MoveNext();
		}
		$this->close();
	}
	
	function update($key, $val) {
		$this->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false);
		$tableName = $this->tconf;
		$tableData = array();
		$tableData[] = array("fieldName"=>"val", "value"=>$val, "type"=>"string");
		$update = $this->perform($tableName, $tableData, 'UPDATE', "`key` = '".$key."'", DEBUG_FLAG);
		$this->close();
	}
	
	function add($key, $val) {
		$this->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false);
		$tableName = $this->tconf;
		$sql = "SELECT id FROM $tableName WHERE `key` = '$key'";
		$res = $this->Execute($sql, 1);
		if($res->fields['id'] > 0){
			$result = 0;
		}else{
			$tableData = array();
			$tableData[] = array("fieldName"=>"`key`", "value"=>$key, "type"=>"string");
			$tableData[] = array("fieldName"=>"`val`", "value"=>$val, "type"=>"string");
			$update = $this->perform($tableName, $tableData, 'INSERT', null, DEBUG_FLAG);
			$result = $this->insert_ID();
		}
		$this->close();
		return $result;
	}
}
?>