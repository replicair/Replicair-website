<?php

class Slideshow {
	
	const fileDefaultName = "slideshow-default.png";
	const fileDefaultLocation = 'content/slideshow/';
	
	var $id;
	var $filename;
	var $title;
	var $subtitle;
	var $content;
	var $position;
	var $state;
	
	public function Slideshow() {
		$this->filename = Slideshow::fileDefaultName;
	}
	
	
}
?>