<?php

include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/Pagination.php');

class ManagedObjectController {
	
	var $elementsByPage = 10;
	var $paginationPrevNextCount = 5;
	
	var $defaultPage = "index.inc";
	var $defaultPageLocation = "central/";
	
	var $pageCreate;
	var $pageUpdate;
	var $pageList;
	var $pageView;
	var $pageException = "message.inc";
	var $pageListDefaultLink;
	
	var $parameterAction = 'action';
	var $parameterPage = 'page';
	var $parameterId = 'id';
	var $parameterFile = 'file';
	var $parameterCurrentState = 'currentState';
	
	var $actionValueList = 'list';
	var $actionValueUpdate = 'update';
	var $actionValueCreate = 'create';
	var $actionValueDelete = 'delete';
	var $actionValueView = 'view';
	var $actionValueChangeState = 'changeState';
	
	var $hasFile = FALSE;
	var $fileBasename = 'file';
	var $fileDefaultName = 'file-default.png';
	var $objectFileLocation = '/content/';
	
	var $defaultTemplate = 'admin.phtml';
	
	public function ManagedObjectController() {
		//$this->objectFileLocation = $root.$this->objectFileLocation;
		//$this->pageListDefaultLink = $root.$this->pageListDefaultLink;
		$this->objectFileLocation = $this->objectFileLocation;
		//echo $this->pageListDefaultLink;
	}
		
	/**
	 * Get an instance of service for managed object
	 * 
	 * @return SlideshowService
	 */
	function getService() {
		return NULL;
	}
	
	/**
	 * Get an instance of managed object
	 *
	 * @return SlideshowService
	 */
	function getManagedObject() {
		return NULL;
	}
	
	/**
	 * Get a managed object from request
	 * 
	 * @param string $action : action caused by request
	 * @param array $parameters : usefull request parameters
	 * @return NULL
	 */
	function getManagedObjectFromRequest($action,$parameters) {
		return NULL;
	}
	
	/**
	 * Adapt objects for list view
	 * 
	 * @param array $list : list of managed object
	 * @return NULL
	 */
	function adaptObjectForViewList($list) {
		return $list;
	}
	
	/**
	 * Adapt objects for preview/view
	 *
	 * @param array $list : list of managed object
	 * @return NULL
	 */
	function adaptObjectForView($object) {
		return $object;
	}
	
	/**
	 * Adapt object for update view
	 *
	 * @param Object $object : managed object
	 * @return NULL
	 */
	function adaptObjectForViewUpdate($object) {
		return $object;
	}
	
	/**
	 * Handle file upload
	 * 
	 * @param array $fileParameters : file request parameters
	 * @return NULL
	 */
	function handleFileUpload($fileParameters,$id) {
		/*$filename = self::fileDefaultName;
		if (array_key_exists(self::parameterFile, $fileParameters)) {
			$imageHelper = new ImageHelper();
			$filename = $imageHelper->upload(self::fileBasename, $id, $fileParameters[self::parameterFile]);
			/*if ($filepath != "") {
			 $imageHelper = new SimpleImage();
			$imageHelper->load($filepath);
			$imageHelper->resize(100,100);
			$imageHelper->save('../img/news/News-".$id."100x100.png');
			}
		}*/
		return NULL;
	}
	
	function getListTemplate() {
		return $this->prepareTemplateForListDefault(TRUE, TRUE, $this->pageListDefaultLink); 
	}
	
	/**
	 * Prepare template for list view
	 *
	 * @param Boolean $active
	 * @param Boolean $inactive
	 * @param int $elementByPage
	 * @param int $page
	 * @return Template
	 */
	function prepareTemplateForList($active,$inactive,$elementByPage,$page,$link) {
		$service = $this->getService();
		$min = ($page - 1) * $elementByPage;
		$list = $service->search($active, $inactive, $min, $elementByPage);
		$total = $service->count($active, $inactive);
		$list = $this->adaptObjectForViewList($list);
		$pagination = new Pagination($total,$elementByPage,$page,$this->paginationPrevNextCount,$link);
		$t = new Template();
		// if managed object associated with file, need to give location on website to page parameters
		if ($this->hasFile == TRUE) {
			$t->fileLocation = $this->objectFileLocation;
		}
		$t->pagination = $pagination;
		$t->list = $list;
		$t->central = $this->defaultPageLocation . $this->pageList;
		$t->template = $this->defaultTemplate;
		return $t;
	}
	
	/**
	 * Prepare template for list view with default parameters
	 * 
	 * @return Template
	 */
	function prepareTemplateForListDefault($active, $inactive, $link) {
		return $this->prepareTemplateForList($active,$inactive,$this->elementsByPage,1,$link);
	}

	/**
	 * Prepare template for update view
	 * 
	 * @param array $parameters : request parameters
	 * @return Template
	 */
	function prepareTemplateForUpdate($parameters) {
		$t = new Template();
		$id = $parameters[$this->parameterId];
		$service = $this->getService();
		$object = $service->get($id);
		$object = $this->adaptObjectForViewUpdate($object);
		$t->action = $this->actionValueUpdate;
		$t->object = $object;
		$t->central = $this->defaultPageLocation . $this->pageCreate;
		$t->template = $this->defaultTemplate;
		return $t;
	}
	
	/**
	 * Prepare template for create view
	 * 
	 * @return Template
	 */
	function prepareTemplateForCreate() {
		$t = new Template();
		$t->action = $this->actionValueCreate;
		$t->object = $this->getManagedObject();
		$t->central = $this->defaultPageLocation . $this->pageCreate;
		$t->template = $this->defaultTemplate;
		return $t;
	}
	
	/**
	 * Prepare template for preview of managed object
	 *
	 * @param unknown_type $parameters
	 * @return Template
	 */
	function prepareTemplateForPreview($parameters) {
		$t = new Template();
		$id = $parameters[$this->parameterId];
		$service = $this->getService();
		$object = $service->get($id);
		$object = $this->adaptObjectForView($object);
		if ($this->hasFile == TRUE) {
			$t->fileLocation = $this->objectFileLocation;
		}
		$t->object = $object;
		$t->central = $this->defaultPageLocation . $this->pageView;
		$t->template = $this->defaultTemplate;
		return $t;
	}
	
	
	/**
	 * Handle request for changing managed object state
	 * 
	 * @param int $id
	 * @param int $currentState
	 * @return Template
	 */
	function handleChangeStateRequest($id, $currentState) {
		$service = $this->getService();
		if ($currentState == 1) {
			$service->changeState($id, 0);
		}
		else {
			$service->changeState($id, 1);
		}
		return $this->prepareTemplateAfterChangeState();
	}
	
	/**
	 * Handle request to create managed object
	 * 
	 * @param array $parameters : request parameters
	 * @return Template
	 */
	function handleCreateRequest($parameters) {
	
		$object = $this->getManagedObjectFromRequest($this->actionValueCreate,$parameters);
		$service = $this->getService();	
		$id = $service->saveOrUpdate($object);
		
		if ($this->hasFile == TRUE) {
			$filename = $this->fileDefaultName;
			$filename = $this->handleFileUpload($_FILES,$id);
			if ($filename != NULL) {
				$service->updateFile($id,$filename);
			}
		}
		return $this->prepareTemplateAfterCreate();
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
	 * Handle request to update managed object
	 *
	 * @param array $parameters : request parameters
	 * @return Template
	 */
	function handleUpdateRequest($parameters) {
		$object = $this->getManagedObjectFromRequest($this->actionValueUpdate,$parameters);
		$service = $this->getService();
		$id = $service->saveOrUpdate($object);
		if ($this->hasFile == TRUE) {
			$filename = $this->handleFileUpload($_FILES, $id);
			if ($filename != NULL && $filename != $this->fileDefaultName) {
				$service->updateFile($id,$filename);
			}
		}
		return $this->prepareTemplateAfterUpdate();
	}
	
	/**
	 * Handle request to update managed object
	 * 
	 * NOT IMPLEMENTED ACTUALLY
	 *
	 * @param array $parameters : request parameters
	 * @return Template
	 */
	function handleDeleteRequest($parameters) {
		return $this->prepareTemplateAfterDelete();
	}
	
	/**
	 * Handle exception to redirect view to message view
	 * 
	 * @param Exception $e
	 * @return Template
	 */
	function handleException(Exception $e) {
		$t = new Template();
		$t->central = $this->defaultPageLocation . $this->pageException;
		$t->message = $e->getMessage();
		$t->template = $this->defaultTemplate;
		return $t;
	}
	
	/**
	 * Handle request concerning managed object
	 *
	 * @param array $get : request parameters from get
	 * @param array $post : request parameters from post
	 * @return Template
	 */
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
					if (isset($get[$this->parameterPage])) {
						return $this->prepareTemplateForList(TRUE,TRUE,$this->elementsByPage,$get[$this->parameterPage],$this->pageListDefaultLink);
					}
					else {
						return $this->prepareTemplateForListDefault(TRUE, TRUE, $this->pageListDefaultLink);
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
		}
		catch (Exception $e) {
			return $this->handleException($e);
		}
	}
}
?>