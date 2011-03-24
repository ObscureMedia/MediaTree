<?php
	//Logs in to the mysql and selects the database
	$usr = "group18";
	$pwd = "able7prime7";
	$host = "dec20";
	$db = $usr;
	$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	
	// "session_register()" and "session_start();" both prepare the session ready for use, and "$myPHPvar=5"
	// is the variable we want to carry over to the new page. Just before we visit the new page, we need to
	// store the variable in PHP's special session area by using "$_SESSION['myPHPvar'] = $myPHPvar;"
	session_register();
	session_start();                      
	
	$q = "SELECT * FROM USER
	WHERE U_ID = 4";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$_SESSION['U_ID']  = $row[0];
	$_SESSION['U_EMAIL_ADDRESS'] = $row[1];
	$_SESSION['U_PASSWORD']  = $row[2];
	$_SESSION['U_FIRST_NAME']  = $row[3];
	$_SESSION['U_SURNAME']  = $row[4];
	$_SESSION['U_PHONE_NUMBER']  = $row[5];
	$_SESSION['U_TYPE']  = $row[6];

	}
	mysql_free_result($result);	
	?>