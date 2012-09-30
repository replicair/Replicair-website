<?php

include_once(SITE_PATH  . '/lib/classes/ManagedObjectController.php');
include_once(SITE_PATH . '/lib/classes/ArticleService.php');
include_once(SITE_PATH . '/lib/classes/Article.php');
include_once(SITE_PATH . '/lib/classes/PaginationArticle.php');
include_once(SITE_PATH . '/lib/classes/ImageHelper.php');

class ArticleController extends ManagedObjectController {
	
	var $elementsByPage = 1;
	var $paginationPrevNextCount = 3;
	
	var $pageCreate = "article-create.inc";
	var $pageUpdate = "article-create.inc";
	var $pageList = "article-list.inc";
	var $pageListFooter = "article-list-subpart.inc";
	var $pageView = "article-view.inc";
	var $pageListDefaultLink = 'article.php?action=list';
	
	var $hasFile = TRUE;
	var $fileBasename = 'article';
	var $fileDefaultName = 'article-default.png';
	
	var $templateList = "adminWithFooter.phtml";
	
	var $parameterCategory = "category";
	
	/**
	 * Override parent
	 */
	function getService() {
		return new ArticleService();
	}
	
	/**
	 * Override parent
	 */
	function getManagedObject() {
		return new Article();
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
		$object->category = $parameters['object_category'];
		$object->position = $parameters['object_position'];
		$object->contentShow = $parameters['object_contentShow'];
		$object->contentHidden = $parameters['object_contentHidden'];
		//$object->filename = $parameters['object_file'];
		//$object->date = $parameters['object_date'];
		return $object;
	}
	
	/**
	 * Override parent
	 */
	function adaptObjectForViewList($list) {
		// format date for view
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
		if ($object->filename == NULL or $object->filename == "") {
			$object->filename = $this->fileDefaultName;
		}
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
			// hack pour pouvoir avoir la catégorie
			$filename = $this->fileBasename;
			/*if (isset($_POST["object_category"])) {
				$category = $_POST["object_category"];
				$filename = $category ."_".self::fileBasename;
			}*/
			$filename = $fileHelper->upload($filename, $id, $_FILES[$this->parameterFile]);
		}
		return $filename;
	}
	
	function getListTemplate() {
		$category = "replicair";
		if (isset($_GET[$this->parameterCategory])) {
			$category = $_GET[$this->parameterCategory];
		}
		elseif (isset($_POST["object_category"])) {
			$category = $_POST["object_category"];
		}
		return $this->prepareTemplateForListByCategory(TRUE,TRUE,$this->elementsByPage,1,$this->pageListDefaultLink,$category);
	}
	
	function prepareTemplateAfterCreate() {
		return $this->getListTemplate();
	}
	
	function prepareTemplateAfterUpdate() {
		return $this->getListTemplate();
	}
	
	function prepareTemplateAfterChangeState() {
		return $this->getListTemplate();
	}
	
	function prepareTemplateAfterDelete() {
		return $this->getListTemplate();
	}
	
	/**
	 * Override parent
	 */
	function prepareTemplateForListByCategory($active,$inactive,$elementByPage,$page,$link,$category) {
		
		$service = $this->getService();
		$min = ($page - 1) * $elementByPage;
		$list = $service->searchByCategory($active, $inactive, $category, $min, $elementByPage);
		$total = $service->countByCategory($active, $inactive, $category);
		if ($total == "0") {
			throw new Exception("Aucun article accessibles. Veuillez contacter l'administrateur pour qu'il en mette à disposition");
		}
		$list = $this->adaptObjectForViewList($list);
		$pagination = new PaginationArticle($total,$page,$link,$category);
		$t = new Template();
		// if managed object associated with file, need to give location on website to page parameters
		if ($this->hasFile == TRUE) {
			$t->fileLocation = $this->objectFileLocation;
		}
		$t->pagination = $pagination;
		$t->list = $list;
		$t->central = $this->defaultPageLocation . $this->pageList;
		
		$t->centralFooter = $this->defaultPageLocation . $this->pageListFooter;
		$t->template = $this->templateList;
		return $t;
	}
	
	function handleRequest($get, $post) {
		try {
			if (isset($post[$this->actionValueCreate])) {
				return $this->handleCreateRequest($post);
			}
			elseif (isset($post[$this->actionValueUpdate])) {
				return $this->handleUpdateRequest($post);
			}
			elseif (isset($get[$this->parameterAction])) {
				$action = $get[$this->parameterAction];
				if ($action == $this->actionValueList) {
					$category = "replicair";
					if (isset($get[$this->parameterCategory])) {
						$category = $get[$this->parameterCategory];
					}
					if (isset($get[$this->parameterPage])) {
						return $this->prepareTemplateForListByCategory(TRUE,TRUE,$this->elementsByPage,$get[$this->parameterPage],$this->pageListDefaultLink,$category);
					}
					else {
						return $this->prepareTemplateForListByCategory(TRUE,TRUE,$this->elementsByPage,1,$this->pageListDefaultLink,$category);
					}
				}
				if ($action == $this->actionValueView) {
					return $this->prepareTemplateForPreview($get);
				}
				if ($action == $this->actionValueChangeState) {
					return $this->handleChangeStateRequest($get[$this->parameterId], $get[$this->parameterCurrentState]);
				}
				if ($action == $this->actionValueUpdate) {
					return $this->prepareTemplateForUpdate($get);
				}
				if ($action == $this->actionValueCreate) {
					return $this->prepareTemplateForCreate();
				}
				if ($action == $this->actionValueDelete) {
					return $this->handleDeleteRequest($get);
				}
			}
			else {
				return $this->prepareTemplateForCreate();
			}
		} catch (Exception $e) {
			return $this->handleException($e);
		}
	}
	
}
?>