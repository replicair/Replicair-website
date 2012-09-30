<?php
include_once ("lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/ReplicairController.php');

$controller = new ReplicairController();
$t = $controller->handleRequest($_GET,$_POST,"article");
$t->render($t->template);
?>