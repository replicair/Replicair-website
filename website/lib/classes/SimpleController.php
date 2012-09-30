<?php

include_once(SITE_PATH . '/lib/classes/Template.php');

class SimpleController {

	var $defaultPageLocation = "lib/includes/central/";
	var $pageException = "message.inc";
	var $template = "public.phtml";
	
	/**
	 * Handle exception to redirect view to message view
	 *
	 * @param Exception $e
	 * @return Template
	 */
	protected function handleException(Exception $e) {
		$t = new Template();
		$t->central = $this->defaultPageLocation . $this->pageException;
		$t->message = $e->getMessage();
		$t->template = $this->template;
		return $t;
	}
}
?>