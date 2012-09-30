<?php
include_once(SITE_PATH . '/lib/classes/DatabaseService.php');
include_once(SITE_PATH . '/lib/classes/Slideshow.php');

class SlideshowService extends DatabaseService {

	/**
	 * Map a database row result to object
	 * 
	 * @param array $row
	 * @return Slideshow
	 */
	function mapRowToObject($row) {
		$slideshow = new Slideshow();
		$slideshow->id = $row['id'];
		$slideshow->title = stripslashes($row['title']);
		$slideshow->subtitle = stripslashes($row['subtitle']);
		if ($row['image'] != NULL and $row['image'] != '') {
			$slideshow->filename = $row['image'];
		}
		$slideshow->content = $row['datas'];
		$slideshow->position = $row['position'];
		$slideshow->state = $row['state'];	
		return $slideshow;
	}
	
	public function prepareObjectForDatabase($object,$link) {
		$object->title = mysql_real_escape_string($object->title,$link);
		$object->subtitle = mysql_real_escape_string($object->subtitle,$link);
		if ($object->position == NULL or $object->position == "") {
			$object->position = 99;
		}
		return $object;
	}
	
	public function prepareQueryInsert($object) {
		return "insert into slideshow
					(title,subtitle,datas,position,state)
					values ('" . $object->title . "',
					'" . $object->subtitle . "',
					'" . $object->content . "',
					'" . $object->position . "',
					'0'
					)";
	}
	
	public function prepareQueryUpdate($object) {
		return "update slideshow set 
						title='" . $object->title . "',
						subtitle='" . $object->subtitle . "',
						datas='" . $object->content . "',
						position='" . $object->position . "'
						where id=".$object->id;
	}

	
	/**
	 * Get a Slideshow with complete informations
	 * 
	 * @param int $id : identifier 
	 * @return Slideshow
	 */
	function get($id) {
		$query = "select * from slideshow where id=".$id;
		$result = $this->select($query);
		$row = $result[0];
		$slideshow = $this->mapRowToObject($row);	
		return $slideshow;
	}
	
	/**
	 * Search for slideshow according to criterias : 
	 * 
	 * @param Boolean $active : to determine if get active for user.
	 * @param Boolean $inactive : to determine if get inactive for user.
	 * @param int $min : minimum from resultset to get, usefull for pagination.
	 * @param int $max : maximum from resultset to get, usefull for pagination
	 * @return array of Slideshow object.
	 */ 
	function search($active, $inactive, $from, $count) {
		$query = "select * from slideshow";
		
		if ($active == TRUE and $inactive == FALSE) {
			$query .= " where state = 1";
		}
		elseif ($active == FALSE and $inactive == TRUE) {
			$query .= " where state = 0";
		}
		$query .= " order by position asc";
		if ($count != NULL) {
			$query .= " limit ". $from .", ". $count;
		}
		$rows = $this->select($query);
		$list = array();
		foreach ($rows as $row) {
			$slideshow = $this->mapRowToObject($row);			
			array_push($list, $slideshow);
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
		$query = "select count(*) as nombre from slideshow";
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
	 * create or update a Slideshow
	 * 
	 * @param Slideshow $slideshow
	 * @throws Exception
	 * @return int id
	 */
	function saveOrUpdate(Slideshow $slideshow) {
		if ($slideshow->id == NULL) {
			$id = $this->insert($slideshow);
			return $id;
		}
		else {
			$this->update($slideshow);
			return $slideshow->id;
		}
	}
	
	/**
	 * Remove a Slideshow by its identifier
	 * 
	 * @param int $id
	 * @throws Exception
	 */
	function remove($id) {
		$this->delete($id);
	}
	
	/**
	 * Change actual slideshow state to the given one
	 * 
	 * @param int $id
	 * @param int $state
	 * @throws Exception
	 */
	function changeState($id, $state) {
		$query = "update slideshow set state=".$state." where id=".$id;
		$result = $this->updateSpecific($query);
	}
	
	/**
	 * Update file for managed object.
	 *
	 * @param int $id : identifier
	 * @param string $filename : filename
	 */
	function updateFile($id, $filename) {
		$query = "update slideshow set image='" . $filename."' where id=".$id;
		$result = $this->updateSpecific($query);
	}
}

?>