<?php
include_once ("../lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/PressReviewService.php');
include_once(SITE_PATH . '/lib/classes/PressReview.php');
include_once(SITE_PATH . '/lib/classes/PressReviewController.php');

$controller = new PressReviewController();
$template = $controller->handleRequest($_GET, $_POST);
$template->render($template->template);

?>