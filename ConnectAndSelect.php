<?php
 	$usr = "group18";
	$pwd = "able7prime7";
	$host = "localhost";
	$db = $usr;

	$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
?>