<html>

<body>
<?php
if(!isset($_SESSION))
{
session_start();
}
	?>
	
	<form action='AmendUser.php' method='post'>
		<p>First Name:<br>
		<input type='text' name='NEW_U_FIRST_NAME' value=<?php echo $_SESSION['U_FIRST_NAME']; ?>><br>
		<p>Surname:<br>
		<input type='text' name='NEW_U_SURNAME' value=<?php echo $_SESSION['U_SURNAME']; ?>><br>
		<p>Phoner Number:<br>
		<input type='text' name='NEW_U_PHONE_NUMBER' value=<?php echo $_SESSION['U_PHONE_NUMBER']; ?>><br>
			<input type='submit' value='Save Details' name='amendDetails'>
			<input type='submit' value='Cancel' name='amendDetails'>
		</p>
		</form>
</body>
</html>
