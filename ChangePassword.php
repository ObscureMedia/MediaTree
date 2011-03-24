<html>

<body>
<?php 
if(!isset($_SESSION))
{
session_start();
}
?>
	<form action='AmendUser.php' method='post'>
		<p>Password:<br>
		<input type='password' name='U_PASSWORD'><br>
		<p>New Password:<br>
		<input type='password' name='NEW_U_PASSWORD'; ><br>
		<p>Confirm Password:<br>
		<input type='password' name='CONFIRM_U_PASSWORD'><br>
		<input type="submit" name="amendDetails" value="Save Password"> 
		<input type='submit' value='Cancel' name='amendDetails'>
	</form>
	
</body>
</html>
	
		