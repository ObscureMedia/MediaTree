<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Obscure Media: View Customer</title>
</head>
<body>

<form action="EditUser.php" method="post">
<?php
if(!isset($_SESSION))
{include 'connect.php';
}

 
	echo "<b>User ID:</b>",$_SESSION['U_ID'];
	echo "<br>";
	echo "<b>Email Address:</b>", $_SESSION['U_EMAIL_ADDRESS'];
	echo "<br>";
	echo "<b>Password: ******** shown for testing:</b>",$_SESSION['U_PASSWORD'];
	echo "<br>";
	echo "<b>First name:</b>", $_SESSION['U_FIRST_NAME'];
	echo "<br>";
	echo "<b>Surname:</b>",  $_SESSION['U_SURNAME'];
	echo "<br>";
	echo "<b>Phone Number:</b>", $_SESSION['U_PHONE_NUMBER'];
	echo "<br>";
	echo "<b>User Type:</b>", $_SESSION['U_TYPE']; 
	echo "<br>";
	?>
			<input type="submit" name="changeDetails" value="Edit Details">
			<input type="submit" name="changeDetails" value="Change Email Address">
			<input type="submit" name="changeDetails" value="Change Password">
			
		</form>
		
		
</body>
</html>