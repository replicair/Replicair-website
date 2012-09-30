<?php

class News {
	
	public function News() {
		$this->filename = News::fileDefaultName;
	}
	
	const fileDefaultName = "news-default.jpg";
	const fileDefaultLocation = 'content/news/';
	
	var $id;
	var $title;
	var $titleShort;
	var $abstract;
	var $abstractShort;
	var $content;
	var $filename;
	var $state;
	var $date;
}
?>