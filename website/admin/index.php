<?php
include_once ("../lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
$t = new Template();
$t->central = SITE_PATH_ADMIN.'central/index.inc';
$t->render('admin.phtml');
//$t->render('index.xml');
?>