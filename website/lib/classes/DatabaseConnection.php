<?php

// call : $result = DatabaseConnection::get()->query("SELECT * FROM ...");

class DatabaseConnection
{
	private static $instance; // stores the MySQLi instance
	
	private function __construct() {
	} // block directly instantiating
	private function __clone() {
	} // block cloning of the object

	public static function get() {
		// create the instance if it does not exist
		/*if(!isset(self::$instance)) {
			// the MYSQL_* constants should be set to or
			//  replaced with your db connection details
			//self::$instance = new MySQLi('localhost', 'replicair', 'welcome1', 'replicair');
			//self::$instance = new MySQLi('sql.free.fr', 's.antony', 'Ra1phuat', 's.antony.sql.free.fr');
			self::$instance = mysql_connect ('localhost', 'replicair', 'welcome1', 'replicair');
			if(self::$instance->connect_error) {
				throw new Exception('MySQL connection failed: ' . self::$instance->connect_error);
			}
		}
		// return the instance
		return self::$instance;*/
		$link = mysql_connect (SITE_DB_HOST, SITE_DB_USER, SITE_DB_PASS, SITE_DB_NAME);
		if (!$link) {
			throw new Exception("Impossible de se connecter à la base de données");
		}
		$db_selected = mysql_select_db(SITE_DB_NAME);
		if (!$db_selected) {
			throw new Exception("Impossible d'accéder à la base voulue");
		}
		return $link;
	}	
	
	public static function query($query,$link) {
		$result = mysql_query($query,$link);
		if (!$result) {
			throw new Exception("Erreur DB : [" . mysql_error($link) . "]");
		}
		return $result;
	}
	public static function queryAlone($query) {
		$link = DatabaseConnection::get();
		$result = mysql_query($query,$link);
		if (!$result) {
			DatabaseConnection::closeConnection($link);
			throw new Exception("Erreur DB : [" . mysql_error($link) . "]");
		}
		DatabaseConnection::closeConnection($link);
		return $result;
	}
	
	public static function queryAloneId($query) {
		$link = DatabaseConnection::get();
		$result = mysql_query($query,$link);
		if (!$result) {
			DatabaseConnection::closeConnection($link);
			throw new Exception("Erreur DB : [" . mysql_error($link) . "]");
		}
		$id = mysql_insert_id($link);
		DatabaseConnection::closeConnection($link);
		return $id;
	}
	
	public static function queryFetch($query) {
		$link = DatabaseConnection::get();
		$result = mysql_query($query,$link);
		if (!$result) {
			DatabaseConnection::closeConnection($link);
			throw new Exception("Erreur DB : [" . mysql_error($link) . "]");
		}
		$rows = array();
		while ($row = mysql_fetch_assoc($result)){
			array_push($rows, $row);
		}
		DatabaseConnection::closeResult($result);
		DatabaseConnection::closeConnection($link);
		return $rows;
	}
	
	public static function escapeStr($value) {
		$link = DatabaseConnection::get();
		$value = mysql_escape_string($value);
		DatabaseConnection::closeConnection($link);
		return $value;
	}
	
	public static function closeResult($result) {
		mysql_free_result($result);
	}
	
	public static function closeConnection($link) {
		mysql_close($link);
	}
}
?>