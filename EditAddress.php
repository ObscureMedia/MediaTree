<html>

<body>
<?php
if(!isset($_SESSION))
{
session_start();
}
	?>
	<form action='AmendAddress.php' method='post'>
		<br>
		<p>Address Name:<br>
		<input type='text' name='NEW_D_ADDRESS_NAME' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_NAME']; ?>'><br>
		<p>Address Line 1:<br>
		<input type='text' name='NEW_D_ADDRESS_LINE_1' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_LINE_1']; ?>'><br>
		<p>Address Line 2:<br>
		<input type='text' name='NEW_D_ADDRESS_LINE_2' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_LINE_2']; ?>'><br>
		<p>Town/City:<br>
		<input type='text' name='NEW_D_TOWN_CITY' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_TOWN_CITY']; ?>'><br>
		<p>County:<br>
		<input type='text' name='NEW_D_COUNTY' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_COUNTY']; ?>'><br>
		<p>Postcode:<br>
		<input type='text' name='NEW_D_POSTCODE' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_POSTCODE']; ?>'><br>
		<p>Country:<br>
		<input type='text' name='NEW_D_COUNTRY' value='<?php echo $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_COUNTRY']; ?>'><br>
		
		
			<input type='submit' value='Save Address' name='amendAddress'>
			<input type='submit' value='Cancel' name='amendAddress'>
		</p>
		</form>
</body>
</html>
