<?php

include_once('../lib/classes/ManagedObjectController.php');
include_once('../lib/classes/SlideshowService.php');
include_once('../lib/classes/Slideshow.php');
include_once('../lib/classes/ImageHelper.php');

class SlideshowController extends ManagedObjectController {
	
	var $elementsByPage = 2;
	var $paginationPrevNextCount = 3;
	
	var $pageCreate = "slideshow-create.inc";
	var $pageUpdate = "slideshow-create.inc";
	var $pageList = "slideshow-list.inc";
	var $pageListDefaultLink = "slideshow.php?action=list&page=";
	
	var $hasFile = TRUE;
	var $fileBasename = 'slideshow';
	var $fileDefaultName = 'slideshow-default.png';
	var $objectFileLocation = "content/slideshow/";
	
	/**
	 * Override parent
	 */
	function getService() {
		return new SlideshowService();
	}
	
	/**
	 * Override parent
	 */
	function getManagedObject() {
		return new Slideshow();
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
		$object->subtitle = $parameters['object_subtitle'];
		$object->content = $parameters['object_content'];
		//$object->filename = $parameters['object_filename'];
		$object->position = $parameters['object_position'];
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForViewList($list) {
		// set default image if none set
		foreach ($list as $object) {
			if ($object->filename == NULL or $object->filename == "") {
				$object->filename = $this->fileDefaultName;
			}
		}
		return $list;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForViewUpdate($object) {
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function handleFileUpload($fileParameters,$id) {
		$filename = $this->fileDefaultName;
		if (array_key_exists($this->parameterFile, $fileParameters) and
				array_key_exists('name',$fileParameters[$this->parameterFile]) and
				$fileParameters[$this->parameterFile]['name'] != '') {
			$imageHelper = new ImageHelper();
			$filename = $imageHelper->upload($this->fileBasename, $id, $fileParameters[$this->parameterFile]);
			/*if ($filepath != "") {
			$imageHelper = new SimpleImage();
			$imageHelper->load($filepath);
			$imageHelper->resize(100,100);
			$imageHelper->save('../img/news/News-".$id."100x100.png');
			}*/
		}
		return $filename;
	}	
}
?>