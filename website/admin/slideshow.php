<?php
include_once ("../lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/SlideshowService.php');
include_once(SITE_PATH . '/lib/classes/Slideshow.php');
include_once(SITE_PATH . '/lib/classes/SlideshowController.php');

$controller = new SlideshowController();
$template = $controller->handleRequest($_GET, $_POST);
$template->render($template->template);

?>