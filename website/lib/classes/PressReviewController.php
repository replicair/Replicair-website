<?php

include_once(SITE_PATH . '/lib/classes/ManagedObjectController.php');
include_once(SITE_PATH . '/lib/classes/PressReviewService.php');
include_once(SITE_PATH . '/lib/classes/PressReview.php');
include_once(SITE_PATH . '/lib/classes/FileHelper.php');
//include_once(SITE_PATH . '/lib/classes/DateTimeFrench.php');
include_once(SITE_PATH . '/lib/classes/DateTimeCustom.php');



class PressReviewController extends ManagedObjectController {
	
	var $elementsByPage = 8;
	var $paginationPrevNextCount = 3;
	
	var $pageCreate = "pressreview-create.inc";
	var $pageUpdate = "pressreview-create.inc";
	var $pageList = "pressreview-list.inc";
	var $pageListDefaultLink = "press_review.php?action=list&page=";
	
	var $hasFile = TRUE;
	var $fileBasename = 'pressreview';
	var $fileDefaultName = 'pressreview-default.png';
	
	var $dateFormat = "dd/mm/yy";
	var $dateFormatViewList = "F Y";
	var $dateFormatViewUpdate = "d/m/Y";
	
	/**
	 * Override parent
	 */
	function getService() {
		return new PressReviewService();
	}
	
	/**
	 * Override parent
	 */
	function getManagedObject() {
		return new PressReview();
	}
	
	/**
	 * Override parent
	 */
	function getManagedObjectFromRequest($action,$parameters) {
		$object = $this->getManagedObject();
		if ($action == $this->actionValueUpdate) {
			$object->id = $parameters['object_id'];
		}
		$object->source = $parameters['object_source'];
		$object->author = $parameters['object_author'];
		$object->url = $parameters['object_url'];
		$object->label = $parameters['object_label'];
		//$object->filename = $parameters['object_file'];
		$object->date = $parameters['object_date'];
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForViewList($list) {
		// format date for view
		foreach ($list as $object) {
			//$date = new DateTimeFrench($object->date,new DateTimeZone('UTC'));
			$date = new DateTimeCustom($object->date);
			$object->dateFormatted = $date->format($this->dateFormatViewList);
		}
		return $list;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForViewUpdate($object) {
		// prepare date formatted for field update
		//$date = new DateTimeFrench($object->date,new DateTimeZone('UTC'));
		$date = new DateTimeCustom($object->date);
		$object->date = $date->format($this->dateFormatViewUpdate);
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function handleFileUpload($fileParameters,$id) {
		$filename = NULL;
		if (array_key_exists($this->parameterFile, $_FILES) and
				array_key_exists('name',$_FILES[$this->parameterFile]) and
				$_FILES[$this->parameterFile]['name'] != '') {
			$fileHelper = new FileHelper();
			$filename = $fileHelper->upload($this->fileBasename, $id, $_FILES[$this->parameterFile]);
		}
		return $filename;
	}
	
}
?>