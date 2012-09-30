<?php
include_once(SITE_PATH . '/lib/classes/DatabaseService.php');
include_once(SITE_PATH . "/lib/classes/Article.php");

class ArticleService extends DatabaseService {
	
	/**
	 * Map a database row result to object
	 *
	 * @param array $row
	 * @return Article
	 */
	private function mapRowToObject($row) {
		$article = new Article();
		$article->id = $row['id'];
		$article->title =  stripslashes($row['title']);
		$article->category = $row['category'];
		$article->position = $row['position'];
		$article->contentShow = $row['contentShow'];
		$article->contentHidden = $row['contentHidden'];
		if ($row['image'] != NULL and $row['image'] != "") {
			$article->filename = $row['image'];
		}
		$article->date = $row['dateOut'];
		$article->state = $row['state'];
	
		return $article;
	}
	
	public function prepareObjectForDatabase($object,$link) {
		$object->title = mysql_real_escape_string($object->title,$link);
		return $object;
	}
	
	public function prepareQueryInsert($object) {
		return "insert into article
					(title,contentShow,contentHidden,image,category,position,state,dateOut)
					values ('" . $object->title . "',
					'" . $object->contentShow . "',
					'" . $object->contentHidden . "',
					'" . $object->filename . "',
					'" . $object->category . "',
					'" . $object->position . "',
					0,
					now())";
	}
	
	public function prepareQueryUpdate($object) {
		return "update article set title='" . $object->title . "',
						contentShow='" . $object->contentShow . "',
						contentHidden='" . $object->contentHidden . "',
						category='" . $object->category . "',
						position='" . $object->position . "'
						where id=".$object->id;
	}
	
	/**
	 * Get an Article with complete informations
	 * @param int $id : news to get identifier 
	 * @return Article
	 */
	public function get($id) {
		$query = "select * from article where id=".$id;
		$rows = $this->select($query);
		$row = $rows[0];
		$article = $this->mapRowToObject($row);		
		return $article;
	}
	
	
	/**
	 * Search for articles according to criterias : 
	 * @param Boolean $active : to determine if get article active for user.
	 * @param Boolean $inactive : to determine if get article inactive for user.
	 * @param int $from : minimum from resultset to get, usefull for pagination.
	 * @param int $count : maximum from resultset to get, usefull for pagination
	 * @return array of News object, without news content.
	 */ 
	public function searchByCategory($active, $inactive, $category, $from, $count) {
		$query = "select id, image, title, category, position, contentShow, contentHidden, dateOut, state from article where category = '".$category."'";
		if ($active == TRUE and $inactive == FALSE) {
			$query .= " and state = 1";
		}
		elseif ($active == FALSE and $inactive == TRUE) {
			$query .= " and state = 0";
		}
		$query .= " order by position asc";
		if ($count != NULL) {
			$query .= " limit ". $from .", ". $count;
		}
		$rows = $this->select($query);
		$list = array();
		foreach ($rows as $row) {
			$article = $this->mapRowToObject($row);
			array_push($list, $article);
		}		
		return $list;
	}
	
	/**
	 * Get count of articles according to criterias
	 * @param boolean $active
	 * @param boolean $inactive
	 * @throws Exception
	 * @return int
	 */
	function countByCategory($active, $inactive, $category) {
		$query = "select count(*) as nombre from article where category = '".$category."'";
		if ($active == TRUE and $inactive == FALSE) {
			$query .= " and state = 1";
		}
		elseif ($active == FALSE and $inactive == TRUE) {
			$query .= " and state = 0";
		}
		$result = $this->select($query);
		$row = $result[0];
		$total = $row["nombre"];
		return $total;
	}
	
	/**
	 * Save or update an article
	 * @param Article $article
	 * @throws Exception
	 */
	function saveOrUpdate(Article $article) {
		if ($article->id == NULL) {
			$id = $this->insert($article);
			return $id;
		}
		else {
			$this->update($article);
			return $article->id;
		}
	}
	
	/**
	 * Update image for an article.
	 * 
	 * @param int $id : news identifier
	 * @param string $filename : filename
	 */
	function updateFile($id, $filename) {
		$query = "update article set image='" . $filename."' where id=".$id;
		$this->updateSpecific($query);
	}
	
	/**
	 * Remove an article by its identifier
	 * @param int $id
	 * @throws Exception
	 */
	function remove($id) {
		$this->updateSpecific($id);
	}
	
	/**
	 * Change actual news state to the given one
	 * @param int $id
	 * @param int $state
	 * @throws Exception
	 */
	function changeState($id, $state) {
		$query = "update article set state=".$state." where id=".$id;
		$this->updateSpecific($query);
	}
}

?>