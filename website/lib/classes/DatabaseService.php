<?php 
include_once(SITE_PATH . '/lib/classes/DatabaseConnection.php');

class DatabaseService {

	/**
	 * Prepare object for insert / update in database
	 *
	 * @param PressReview $pressReview
	 * @return PressReview
	 */
	public function prepareObjectForDatabase($object,$link) {
		return $object;
	}
	
	public function prepareQueryInsert($object) {
		return "";
	}
	
	public function prepareQueryUpdate($object) {
		return "";
	}
	
	public function update($object) {
		$link = DatabaseConnection::get();
		$object = $this->prepareObjectForDatabase($object,$link);
		$query = $this->prepareQueryUpdate($object);
		$result = mysql_query($query,$link);
		if (!$result) {
			$this->handleDatabaseError($link);
		}
		DatabaseConnection::closeConnection($link);
		return $result;
	}
	
	public function updateSpecific($query) {
		$link = DatabaseConnection::get();;
		$result = mysql_query($query,$link);
		if (!$result) {
			$this->handleDatabaseError($link);
		}
		DatabaseConnection::closeConnection($link); 
		return $result;
	}
	
	public function insert($object) {
		$link = DatabaseConnection::get();
		$object = $this->prepareObjectForDatabase($object,$link);
		$query = $this->prepareQueryInsert($object);
		$result = mysql_query($query,$link);
		if (!$result) {
			$this->handleDatabaseError($link);
		}
		$id = mysql_insert_id($link);
		DatabaseConnection::closeConnection($link);
		return $id;
	}
	
	public function select($query) {
		$link = DatabaseConnection::get();
		$result = mysql_query($query,$link);
		if (!$result) {
			$this->handleDatabaseError($link);
		}
		$rows = array();
		while ($row = mysql_fetch_assoc($result)){
			array_push($rows, $row);
		}
		DatabaseConnection::closeResult($result);
		DatabaseConnection::closeConnection($link);
		return $rows;
	}
	
	public function delete($id) {
		return FALSE;
	}

	private function handleDatabaseError($link) {
		$error = mysql_error($link);
		DatabaseConnection::closeConnection($link);
		throw new Exception("Erreur DB : [" . $error . "]");
	}

}

?>