<?php
include_once(SITE_PATH . '/lib/classes/DatabaseService.php');
include_once(SITE_PATH . "/lib/classes/News.php");

class NewsService extends DatabaseService {
	
	/**
	 * Map a database row result to object
	 *
	 * @param array $row
	 * @return PressReview
	 */
	function mapRowToObject($row) {
		$news = new News();
		$news->id = $row['id'];
		$news->title = stripslashes($row['title']);
		$news->abstract = $row['abstract'];
		$news->titleShort = $row['titleShort'];
		$news->abstractShort = $row['abstractShort'];
		if (isset($row['datas'])) {
			$news->content = $row['datas'];
		}
		if ($row['image'] != NULL and $row['image'] != "") {
			$news->filename = $row['image'];
		}
		$news->date = $row['dateOut'];
		$news->state = $row['state'];
	
		return $news;
	}
	
	public function prepareObjectForDatabase($object,$link) {
		$object->title = mysql_real_escape_string($object->title,$link);
		return $object;
	}
	
	public function prepareQueryInsert($object) {
		return "insert into news
					(title,abstract,titleShort,abstractShort,datas,image,state,dateOut)
					values ('" . $object->title . "',
					'" . $object->abstract . "',
					'" . $object->titleShort . "',
					'" . $object->abstractShort . "',
					'" . $object->content . "',
					'" . $object->filename . "',
					0,
					now())";
	}
	
	public function prepareQueryUpdate($object) {
		return  "update news set title='" . $object->title . "',
						abstract='" . $object->abstract . "',
						titleShort='" . $object->titleShort . "',
						abstractShort='" . $object->abstractShort . "',
						datas='" . $object->content . "'
						where id=".$object->id;
	}
	
	/**
	 * Get a News with complete informations
	 * @param int $id : news to get identifier 
	 * @return News
	 */
	function get($id) {
		$query = "select * from news where id=".$id;
		$rows = $this->select($query);
		$row = $rows[0];
		$news = $this->mapRowToObject($row);
		return $news;
	}
	
	/**
	 * Search for news according to criterias : 
	 * @param Boolean $activeNews : to determine if get news active for user.
	 * @param Boolean $inactiveNews : to determine if get news inactive for user.
	 * @param int $min : minimum from resultset to get, usefull for pagination.
	 * @param int $max : maximum from resultset to get, usefull for pagination
	 * @return array of News object, without news content.
	 */ 
	function search($activeNews, $inactiveNews, $from, $count) {
		$query = "select id, image, title, titleShort, abstract, abstractShort, dateOut, state from news";
		
		if ($activeNews == TRUE and $inactiveNews == FALSE) {
			$query .= " where state = 1";
		}
		elseif ($activeNews == FALSE and $inactiveNews == TRUE) {
			$query .= " where state = 0";
		}
		$query .= " order by dateOut desc";
		if ($count != NULL) {
			$query .= " limit ". $from .", ". $count;
		}
		$rows = $this->select($query);
		$list = array();
		foreach ($rows as $row) {
			$news = $this->mapRowToObject($row);
			array_push($list, $news);
		}		
		return $list;
	}
	
	function count($activeNews, $inactiveNews) {
		$query = "select count(*) as nombre from news";
		if ($activeNews == TRUE and $inactiveNews == FALSE) {
			$query .= " where state = 1";
		}
		elseif ($activeNews == FALSE and $inactiveNews == TRUE) {
			$query .= " where state = 0";
		}
		$result = $this->select($query);
		$row = $result[0];
		$total = $row["nombre"];
		return $total;
	}
	
	/**
	 * Save or update a news
	 * @param News $news
	 * @throws Exception
	 */
	function saveOrUpdate(News $news) {
		if ($news->id == NULL) {
			$id = $this->insert($news);
			return $id;
		}
		else {
			$this->update($news);
			return $news->id;
		}
	}
	
	/**
	 * Update image for a news.
	 * 
	 * @param int $id : news identifier
	 * @param string $filename : filename for news
	 */
	function updateFile($id, $filename) {
		$query = "update news set image='" . $filename."' where id=".$id;
		$this->updateSpecific($query);
	}
	
	/**
	 * Remove a news by its identifier
	 * @param int $id
	 * @throws Exception
	 */
	function remove($id) {
		$query = "delete from news where id=".$id;
		$this->delete($query);
	}
	
	/**
	 * Change actual news state to the given one
	 * @param int $id
	 * @param int $state
	 * @throws Exception
	 */
	function changeState($id, $state) {
		$query = "update news set state=".$state." where id=".$id;
		$this->updateSpecific($query);
	}
}

?>