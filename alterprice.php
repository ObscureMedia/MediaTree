<?php
 	$usr = "group18";
	$pwd = "able7prime7";
	$host = "dec20";
	$db = $usr;

	$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
	echo "<p>$host is connected!</p>";
	mysql_select_db($db) or die(mysql_error());
	echo "<p>$db is selected</p>";


	
		$q="ALTER TABLE AGE_RATING_LOOKUP
		MODIFY AGE_RATING VARCHAR(2) NOT NULL";
	mysql_query($q) or die(mysql_error());
			
			
		$q="ALTER TABLE PRODUCT
		MODIFY P_AGE_RATING VARCHAR(2) NOT NULL";
	mysql_query($q) or die(mysql_error());

	mysql_close($server);
?>

	

	
	