<?php
include_once ("../lib/classes/Properties.php");
include_once(SITE_PATH . '/lib/classes/Template.php');
$template = new Template();
$template->central = SITE_PATH_ADMIN.'central/work.inc';
$template->render('admin.phtml');

?>