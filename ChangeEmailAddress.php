<html>

<body>
<?php 
if(!isset($_SESSION))
{
session_start();
}
?>
	<form action='AmendUser.php' method='post'>
		<p>Old Email Address:<br>
		<input type='text' name='U_EMAIL_ADDRESS' value=<?php echo $_SESSION['U_EMAIL_ADDRESS']; ?>><br>
		<p>New Email Address:<br>
		<input type='text' name='NEW_U_EMAIL_ADDRESS'><br>
		<p>Confirm Email Address:<br>
		<input type='text' name='CONFIRM_U_EMAIL_ADDRESS'><br>
		<p>Password:<br>
		<input type='password' name='U_PASSWORD'><br>
		<input type="submit" name="amendDetails" value="Save Email Address"> 
		<input type='submit' value='Cancel' name='amendDetails'>
	</form>
	
</body>
</html>
	
		