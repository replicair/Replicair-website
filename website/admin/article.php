<?php
include_once ("../lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/ArticleController.php');

$controller = new ArticleController();
$template = $controller->handleRequest($_GET, $_POST);
$template->render($template->template);

?>