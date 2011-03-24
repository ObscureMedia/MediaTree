<html>

<body>
<?php
if(!isset($_SESSION))
{
session_start();
}
	$Dcounter = $_SESSION['Dcounter'];
	?>
	<form action='AmendUser.php' method='post'>
		<p>Address Nmae:<br>
		<input type='text' name='NEW_D_ADDRESS_NAME' value=<?php echo $_SESSION['D_ADDRESS_NAME[$Dcounter]']; ?>><br>
		<p>Address Line 1:<br>
		<input type='text' name='NEW_D_ADDRESS_LINE_1' value=<?php echo $_SESSION['D_ADDRESS LINE_1[$Dcounter]']; ?>><br>
		<p>Address Line 2:<br>
		<input type='text' name='NEW_D_ADDRESS_LINE_2' value=<?php echo $_SESSION['D_ADDRESS LINE_2[$Dcounter]']; ?>><br>
		<p>Town/City:<br>
		<input type='text' name='NEW_D_TOWN_CITY' value=<?php echo $_SESSION['D_TOWN_CITY[$Dcounter]']; ?>><br>
		<p>County:<br>
		<input type='text' name='NEW_D_COUNTY' value=<?php echo $_SESSION['D_COUNTY[$Dcounter]']; ?>><br>
		<p>Postcode:<br>
		<input type='text' name='NEW_D_POSTCODE' value=<?php echo $_SESSION['D_POSTCODE[$Dcounter]']; ?>><br>
		<p>Country:<br>
		<input type='text' name='NEW_D_POSTCODE' value=<?php echo $_SESSION['D_Country[$Dcounter]']; ?>><br>
		
		
			<input type='submit' value='Save Address' name='amendAddress'>
			<input type='submit' value='Cancel' name='amendAddress'>
		</p>
		</form>
</body>
</html>
