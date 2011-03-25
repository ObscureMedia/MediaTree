<html>

<body>
<?php
if(!isset($_SESSION))
{
session_start();
}
	?>
	<form action='AmendCard.php' method='post'>
		<p>Card Name:
		<input type='text' name='NEW_CARD_NAME' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['CARD_NAME']; ?>'></p>
		<p>Card Number:************<?php echo substr($_SESSION['U_CARDS'][$_SESSION['Card_Number']]['CARD_NUMBER'], -4);?>
		<p>Issue Number/Start Date: <?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['ISSUE_NUMBER_START_DATE'];?>
		<p>Cardholders Name: <input type='text' name='NEW_CARDHOLDERS_NAME' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['CARD_HOLDERS_NAME']; ?>'></p>
		<p>Expiration Date: 
		<select name="">
	<?php  for ($i = 1; $i <= 12; $i++) 
			{
 				echo"<option value='$i'>$i</option>";
			}
	?>
		</select>
			<select name="">
	<?php  for ($i = 2011; $i <= 2029; $i++) 
			{
 				echo"<option value='$i'>$i</option>";
			}
	?>
		</select>
		<p>Address Line 1:
		<input type='text' name='NEW_B_ADDRESS_LINE_1' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['B_ADDRESS_LINE_1']; ?>'><br>
		<p>Address Line 2:
		<input type='text' name='NEW_B_ADDRESS_LINE_2' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['B_ADDRESS_LINE_2']; ?>'><br>
		<p>Town/City:
		<input type='text' name='NEW_B_TOWN_CITY' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['B_TOWN_CITY']; ?>'><br>
		<p>County:
		<input type='text' name='NEW_B_COUNTY' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['B_COUNTY']; ?>'><br>
		<p>Postcode:
		<input type='text' name='NEW_B_POSTCODE' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['B_POSTCODE']; ?>'><br>
		<p>Country:
		<input type='text' name='NEW_B_COUNTRY' value='<?php echo $_SESSION['U_CARDS'][$_SESSION['Card_Number']]['B_COUNTRY']; ?>'><br>
		<input type='submit' value='Save Card Details' name = amendCard >
		<input type='submit' value='Cancel' name='amendCard'>
		</form>
</body>
</html>
