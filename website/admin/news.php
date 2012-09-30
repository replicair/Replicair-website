<?php
include_once ("../lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/NewsService.php');
include_once(SITE_PATH . '/lib/classes/News.php');
include_once(SITE_PATH . '/lib/classes/NewsController.php');

$controller = new NewsController();
$template = $controller->handleRequest($_GET, $_POST);
$template->render('admin.phtml');

?>