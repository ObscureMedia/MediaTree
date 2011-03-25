<html>
<head>
</head>
<?php
	$usr = "group18";
			$pwd = "able7prime7";
			$host = "dec20";
			$db = $usr;
			$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
			mysql_select_db($db) or die(mysql_error());
	
	if(!isset($_SESSION))
{
session_start();
}

switch ($_POST['amendAddress']) {
      // if calculate => add
      case 'Save Address':
      		$OLD_D_NAME = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_NAME'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_NAME'] = $_POST['NEW_D_ADDRESS_NAME'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_LINE_1'] = $_POST['NEW_D_ADDRESS_LINE_1'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_LINE_2'] = $_POST['NEW_D_ADDRESS_LINE_2'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_TOWN_CITY'] = $_POST['NEW_D_TOWN_CITY'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_COUNTY'] = $_POST['NEW_D_COUNTY'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_POSTCODE'] = $_POST['NEW_D_POSTCODE'];
      		$_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_COUNTRY'] = $_POST['NEW_D_COUNTRY'];
      			
      		$D_ADDRESS_NAME = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_NAME'];
      		$D_ADDRESS_LINE_1 = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_LINE_1'];
      		$D_ADDRESS_LINE_2 = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_ADDRESS_LINE_2'];
      		$D_TOWN_CITY = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_TOWN_CITY'];
      		$D_COUNTY = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_COUNTY'];
      		$D_POSTCODE = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_POSTCODE'];
      		$D_COUNTRY = $_SESSION['U_ADDRESSES'][$_SESSION['Address_Number']]['D_COUNTRY'];
      		
      		$q = "UPDATE DELIVERY_ADDRESS SET D_ADDRESS_NAME = '$D_ADDRESS_NAME' ,
      			D_ADDRESS_LINE_1 = '$D_ADDRESS_LINE_1',
      			D_ADDRESS_LINE_2 = '$D_ADDRESS_LINE_2',
				D_TOWN_CITY = '$D_TOWN_CITY', 
				D_COUNTY = '$D_COUNTY',
				D_POSTCODE = '$D_POSTCODE',
				D_COUNTRY = '$D_COUNTRY'
 WHERE D_ADDRESS_NAME = '$OLD_D_NAME'";
	mysql_query($q) or die(mysql_error());
	
	$q = "UPDATE ORDER_TABLE SET D_ADDRESS_NAME = '$D_ADDRESS_NAME'
	WHERE D_ADDRESS_NAME = '$OLD_D_NAME'";
		mysql_query($q) or die(mysql_error());
	
	
echo" $OLD_D_NAME updated.";
include'ViewAddresses.php';
      		
            break;

   
   
            break;

      case 'Save Email Address':
   
            break;
      case 'Cancel':
      	include 'ViewUser.php';
      	break;
}

?>