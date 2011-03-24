<?php
	$usr = "group18";
	$pwd = "able7prime7";
	$host = "dec20";
	$db = $usr;
	$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
	echo "<p>$host is connected!</p>";

	mysql_select_db($db) or die(mysql_error());
	echo "<p>$db is selected</p>";

	echo "<h1>USER,</h1>";


	$q = "SELECT * FROM USER";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]</p>";
	}
	mysql_free_result($result);

	echo "<h1><USERS_CARD:</h1>";
	
	$q = "SELECT * FROM USER_CARD";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]</p>";
	}
	mysql_free_result($result);

	echo "<h1>DELIVERY_ADDRESS:</h1>";

	$q = "SELECT * FROM DELIVERY_ADDRESS";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]</p>";
	}
	mysql_free_result($result);

	echo "<h1>PRODUCT</h1>";

	$q = "SELECT * FROM PRODUCT";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]</p>";
	}
	mysql_free_result($result);

	echo "<h1>PRODUCT_REVIEWS:</h1>";

	$q = "SELECT * FROM PRODUCT_REVIEW";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3]</p>";
	}
	mysql_free_result($result);

	echo "<h1>ORDER_TABLE:</h1>";

	$q = "SELECT * FROM ORDER_TABLE";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]</p>";
	}
	mysql_free_result($result);

	echo "<h1>ORDERED_PRODUCT:</h1";

	$q = "SELECT * FROM ORDERED_PRODUCT";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2]</p>";
	}
	mysql_free_result($result);
	
		echo "<h1>AGE_RATING_LOOKUP:</h1>";

	$q = "SELECT * FROM AGE_RATING_LOOKUP";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1]</p>";
	}
	mysql_free_result($result);
	
	echo "<h1>DELIVER_METHOD_LOOKUP:</h1>";

		$q = "SELECT * FROM DELIVERY_METHOD_LOOKUP";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1], $row[2], $row[3]</p>";
	}
	mysql_free_result($result);

		echo "<h1>USER_LOOKUP:</h1>";
	$q = "SELECT * FROM USER_LOOKUP";
	
	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1]</p>";
	}
	mysql_free_result($result);
	
		echo "<h1>PRODUCT_TYPE_LOOKUP:</h1>";
	$q = "SELECT * FROM PRODUCT_TYPE_LOOKUP";
	
	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1]</p>";
	}
	mysql_free_result($result);
	
		echo "<h1>GENRE_LOOKUP:</h1>";

	$q = "SELECT * FROM GENRE_LOOKUP";
	
	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1]</p>";
	}
	mysql_free_result($result);
	
		echo "<h1>PRODUCT_TAG:</h1>";

	$q = "SELECT * FROM PRODUCT_TAG";
	
	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<p>$row[0], $row[1]</p>";
	}
	mysql_free_result($result);


	//Close
mysql_close($server);
?>
