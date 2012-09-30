<?php

class Article {
	
	public function Article() {
		$this->fileDefaultName = "article-default.png";
		$this->fileDefaultLocation = SITE_ROOT . 'content/articles/';
		$this->filename = $this->fileDefaultName;
		$this->categories = array("replicair" => "Association",
				"project" => "Projet",
				"legend" => "Légende") ;
	}
	
	var $fileDefaultName;
	var $fileDefaultLocation;
	
	var $categories;
	
	var $id;
	var $category;
	var $position;
	var $title;
	var $contentShow;
	var $contentHidden;
	var $filename;
	var $state;
	var $date;
}
?>