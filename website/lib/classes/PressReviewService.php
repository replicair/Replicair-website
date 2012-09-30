<?php
include_once(SITE_PATH . '/lib/classes/DatabaseService.php');
include_once(SITE_PATH . '/lib/classes/PressReview.php');
include_once(SITE_PATH . '/lib/classes/FileHelper.php');

class PressReviewService extends DatabaseService {

	/**
	 * Map a database row result to object
	 * 
	 * @param array $row
	 * @return PressReview
	 */
	function mapRowToObject($row) {
		$pressReview = new PressReview();
		$pressReview->id = $row['id'];
		$pressReview->source = stripslashes($row['sourceInfo']);
		$pressReview->author = stripslashes($row['author']);
		$pressReview->label = stripslashes($row['label']);
		$pressReview->url = stripslashes($row['url']);
		$pressReview->file = $row['filename'];
		$pressReview->date = $row['dateEvent'];
		$pressReview->state = $row['state'];
		//echo "label : ".$row['label'];
		//echo "label : ".stripslashes($row['label']);
		//echo "label : ".$pressReview->label;
		if ($pressReview->file != NULL) {
			$fileHelper = new FileHelper();
			$pressReview->fileType = $fileHelper->getFileType($pressReview->file);
		}
		
		return $pressReview;
	}
	
	public function prepareObjectForDatabase($object,$link) {
		$object->source = mysql_real_escape_string($object->source,$link);
		$object->url = mysql_real_escape_string($object->url,$link);
		$object->author = mysql_real_escape_string($object->author,$link);
		$object->label = mysql_real_escape_string($object->label,$link);
		//$datetime = DateTime::createFromFormat("d/m/Y",$pressReview->date,new DateTimeZone('UTC'));
		$datetime = new DateTimeCustom($object->date,DateTimeCustom::FORMAT_SIMPLE);
		$sqldatetime = $datetime->format(DateTimeCustom::FORMAT_MYSQL);
		$object->date = $sqldatetime;
		return $object;
	}
	
	public function prepareQueryInsert($object) {
		return "insert into press_review
		(sourceInfo,author,label,url,filename,dateEvent,state)
		values ('" . $object->source . "',
		'" . $object->author . "',
		'" . $object->label . "',
		'" . $object->url . "',
		'" . $object->file . "',
		'" . $object->date . "',
		0
		)";
	}
	
	public function prepareQueryUpdate($object) {
		return "update press_review set 
						sourceInfo='" . $object->source . "',
						author='" . $object->author . "',
						label='" . $object->label . "',
						url='" . $object->url . "',
						dateEvent='" . $object->date . "'
						where id=".$object->id;
	}
	
	/**
	 * Get a PressReview with complete informations
	 * 
	 * @param int $id : identifier 
	 * @return PressReview
	 */
	function get($id) {
		$query = "select * from press_review where id=".$id;
		$result = $this->select($query);
		$row = $result[0];
		$pressReview = $this->mapRowToObject($row);
		return $pressReview;
	}
	
	/**
	 * Search for press review according to criterias : 
	 * 
	 * @param Boolean $active : to determine if get active for user.
	 * @param Boolean $inactive : to determine if get inactive for user.
	 * @param int $min : minimum from resultset to get, usefull for pagination.
	 * @param int $max : maximum from resultset to get, usefull for pagination
	 * @return array of PressReview object.
	 */ 
	function search($active, $inactive, $from, $count) {
		$query = "select * from press_review";
		
		if ($active == TRUE and $inactive == FALSE) {
			$query .= " where state = 1";
		}
		elseif ($active == FALSE and $inactive == TRUE) {
			$query .= " where state = 0";
		}
		$query .= " order by dateEvent desc";
		if ($count != NULL) {
			$query .= " limit ". $from .", ". $count;
		}
		$result = $this->select($query);
		$list = array();
		foreach ($result as $row) {
			$pressReview = $this->mapRowToObject($row);			
			array_push($list, $pressReview);
		}		
		return $list;
	}
	
	/**
	 * Count total object in database according to criterias
	 *
	 * @param Boolean $active
	 * @param Boolean $inactive
	 * @throws Exception
	 * @return int
	 */
	function count($active, $inactive) {
		$query = "select count(*) as nombre from press_review";
		if ($active == TRUE and $inactive == FALSE) {
			$query .= " where state = 1";
		}
		elseif ($active == FALSE and $inactive == TRUE) {
			$query .= " where state = 0";
		}
		$result = $this->select($query);
		$row = $result[0];
		$total = $row["nombre"];
		return $total;
	}
	
	/**
	 * $pressReview or update a PressReview
	 * 
	 * @param PressReview $pressReview
	 * @throws Exception
	 * @return int id
	 */
	function saveOrUpdate(PressReview $pressReview) {
		if ($pressReview->id == NULL) {
			$id = $this->insert($pressReview);
			return $id;
		}
		else {
			$this->update($pressReview);
			return $pressReview->id;
		}
	}
	
	/**
	 * Remove a PressReview by its identifier
	 * 
	 * @param int $id
	 * @throws Exception
	 */
	function remove($id) {
		$this->delete($id);
	}
	
	/**
	 * Change actual press review state to the given one
	 * 
	 * @param int $id
	 * @param int $state
	 * @throws Exception
	 */
	function changeState($id, $state) {
		$query = "update press_review set state=".$state." where id=".$id;
		$this->updateSpecific($query);
	}
	
	/**
	 * Update file for managed object.
	 *
	 * @param int $id : identifier
	 * @param string $filename : filename
	 */
	function updateFile($id, $filename) {
		$query = "update press_review set filename='" . $filename."' where id=".$id;
		$this->updateSpecific($query);
	}
}

?>