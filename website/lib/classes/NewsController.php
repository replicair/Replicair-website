<?php

include_once(SITE_PATH . '/lib/classes/ManagedObjectController.php');
include_once(SITE_PATH . '/lib/classes/NewsService.php');
include_once(SITE_PATH . '/lib/classes/News.php');
include_once(SITE_PATH . '/lib/classes/ImageHelper.php');
//include_once(SITE_PATH . '/lib/classes/DateTimeFrench.php');
include_once(SITE_PATH . '/lib/classes/DateTimeCustom.php');

class NewsController extends ManagedObjectController {
	
	var $elementsByPage = 4;
	var $paginationPrevNextCount = 3;
	
	var $pageCreate = "news-create.inc";
	var $pageUpdate = "news-create.inc";
	var $pageList = "news-list.inc";
	var $pageView = "news-preview.inc";
	var $pageListDefaultLink = "news.php?action=list&page=";
	
	var $hasFile = TRUE;
	var $fileBasename = 'news';
	var $fileDefaultName = 'news-default.jpg';
	var $objectFileLocation = '/content/news/';
	
	var $dateFormatView = "d.m.y";
	
	/**
	 * Override parent
	 */
	function getService() {
		return new NewsService();
	}
	
	/**
	 * Override parent
	 */
	function getManagedObject() {
		return new News();
	}
	
	/**
	 * Override parent
	 */
	function getManagedObjectFromRequest($action,$parameters) {
		$object = $this->getManagedObject();
		if ($action == $this->actionValueUpdate) {
			$object->id = $parameters['object_id'];
		}
		$object->title = $parameters['object_title'];
		$object->abstract = $parameters['object_abstract'];
		$object->titleShort = $parameters['object_titleShort'];
		$object->abstractShort = $parameters['object_abstractShort'];
		$object->content = $parameters['object_content'];
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForViewList($list) {
		// set default image if none setted
		foreach ($list as $object) {
			if ($object->filename == NULL or $object->filename == "") {
				$object->filename = $this->fileDefaultName;
			}
			$object->filenamePanel = "116x90.".$object->filename;
			$object->filenameList = "125x85.".$object->filename;
			// prepare date formatted for field update
			$date = new DateTimeCustom($object->date);
			$object->date = $date->format($this->dateFormatView);
		}
		
		return $list;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForView($object) {
		// set default image if none setted
		if ($object->filename == NULL or $object->filename == "") {
			$object->filename = $this->fileDefaultName;
		}
		$object->filenamePanel = "116x90.".$object->filename;
		$object->filenameList = "125x85.".$object->filename;
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function handleFileUpload($fileParameters,$id) {
		$filename = $this->fileDefaultName;
		if (array_key_exists($this->parameterFile, $_FILES) and
				array_key_exists('name',$_FILES[$this->parameterFile]) and
				$_FILES[$this->parameterFile]['name'] != '') {
			$fileHelper = new ImageHelper();
			$filename = $fileHelper->upload($this->fileBasename, $id, $_FILES[$this->parameterFile]);
		}
		return $filename;
	}
	
	function prepareTemplateForPreview($parameters) {
		$t = parent::prepareTemplateForPreview($parameters);
		$newsService = new NewsService();
		if (isset($parameters["admin"])) {
			$newsList = array();
			array_push($newsList,$t->object);
			$t->newsPreviewList = $newsList;
			$date = new DateTimeCustom(DateTimeCustom::NOW);
			$t->newsPreviewDate = $date->format("d F");
			$t->newsFileLocation = News::fileDefaultLocation;
		}
		if (!isset($parameters["page"])) {
			$page = "1";
		}
		else {
			$page = $parameters["page"];
		}
		$t->page = $page;
		return $t;
	}
}
?>