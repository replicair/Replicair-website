<?php 
	// Server dependant constants
	define("MAIL_TO","sebastien.antony@gmail.com");
	define("MAIL_FROM","noreply-replicair@gmail.com");
	/*
	define("MAIL_TO","association.replicair@gmail.com");
	define("MAIL_FROM","noreply-replicair@gmail.com");
	*/
	define("SITE_ROOT","/website/");
	//define("SITE_ROOT","/replicair/");
	/*
	define("SITE_DB_USER", "s.antony");
	define("SITE_DB_PASS", "Ra1phuat");
	define("SITE_DB_HOST", "sql.free.fr");
	define("SITE_DB_NAME", "s_antony");
	define("SITE_DB_SERVER", "s.antony.sql.free.fr");
	*/
	/*
	 define("SITE_DB_USER", "replicair");
	define("SITE_DB_PASS", "morane31");
	define("SITE_DB_HOST", "sql.free.fr");
	define("SITE_DB_NAME", "replicair");
	define("SITE_DB_SERVER", "replicair.sql.free.fr");
	*/
	
	define("SITE_DB_USER", "replicair");
	define("SITE_DB_PASS", "welcome1");
	define("SITE_DB_HOST", "localhost");
	define("SITE_DB_NAME", "replicair");
	define("SITE_DB_SERVER", "replicair");
	
	
	// Constant for all servers
	define("SITE_ROOT_ADMIN",SITE_ROOT."admin/");
	define("SITE_PATH",$_SERVER['DOCUMENT_ROOT'].SITE_ROOT);
	define("SITE_PATH_ADMIN",$_SERVER['DOCUMENT_ROOT'].SITE_ROOT_ADMIN);
	
?>