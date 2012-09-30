<?php
include_once ("lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/ReplicairController.php');
session_start();

$controller = new ReplicairController();
$t = $controller->handleRequest($_GET,$_POST,"contact");
$t->render($t->template);
?>