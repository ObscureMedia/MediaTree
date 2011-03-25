<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Obscure Media: View Customer</title>
</head>
<body>


<?php

if(!isset($_SESSION))
{include'ConnectAndSelect.php';
session_register();
session_start();
}

//$_SESSION['Dcounter'] = 0;
$Ccounter = 0;
$User_Cards = array();

	echo"<table>";

	$q = "SELECT * FROM USER_CARD
	WHERE U_ID = 1";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$_SESSION['U_ID']  = $row[0];
	$CARD_NAME = $row[1];
	$CARD_NUMBER  = $row[2];
	$CARD_HOLDERS_NAME  = $row[3];
	$ISSUE_NUMBER_START_DATE  = $row[4];
	$EXPIRATION_DATE = $row[5];
	$SECURITY_NUMBER  = $row[6];
	$B_ADDRESS_LINE_1  = $row[7];
	$B_ADDRESS_LINE_2  = $row[8];
	$B_TOWN_CITY  = $row[9];
	$B_COUNTY = $row[10];
	$B_POSTCODE  = $row[11];
	$B_COUNTRY  = $row[12];

	$Card=array('CARD_NAME' =>$CARD_NAME,
	'CARD_NUMBER' =>$CARD_NUMBER,
	'CARD_HOLDERS_NAME'=> $CARD_HOLDERS_NAME,
	'ISSUE_NUMBER_START_DATE' =>$ISSUE_NUMBER_START_DATE ,
	'EXPIRATION_DATE'=> $EXPIRATION_DATE, 
	'SECURITY_NUMBER' =>$SECURITY_NUMBER,
	'B_ADDRESS_LINE_1' =>$B_ADDRESS_LINE_1,
	'B_ADDRESS_LINE_2'=> $B_ADDRESS_LINE_2,
	'B_TOWN_CITY' =>$B_TOWN_CITY,
	'B_COUNTY'=> $B_COUNTY, 
	'B_POSTCODE' =>$B_POSTCODE, 
	'B_COUNTRY' =>$B_COUNTRY);
	
	array_push($User_Cards,$Card);
	$_SESSION['U_CARDS']=$User_Cards;

	echo "Card Name: ",$CARD_NAME,"<br>";
	echo "Card Number: ************",substr($CARD_NUMBER, -4),"<br>";
	echo "Issue Number/Start Date: ",$ISSUE_NUMBER_START_DATE,"<br>";
	echo "Expiration Date: ",$EXPIRATION_DATE,"<br>";
	echo "Security Number: ",$SECURITY_NUMBER,"<br>";
	echo "Billing Address: <br>";
	echo $B_ADDRESS_LINE_1,"<br>";
		if($B_ADDRESS_LINE_2 != '')
				{
					echo "B_ADDRESS LINE_2<br>";
				}
	echo $B_TOWN_CITY,"<br>";
	echo $B_COUNTY,"<br>";
	echo $B_POSTCODE,"<br>";
	echo $B_COUNTRY,"<br><br>";
	
	echo"<form action='ChangeCard.php' method='post'>
	<input type='submit' name='changeCard' value='Edit Card'>
	<input type='submit' name='changeCard' value='Delete Card'>
	<input type='hidden' name='card' value=$Ccounter>
	
	</form>";
	$Ccounter++;
	echo"<hr />";
	
	}
	
	?>
	
</body>
</html>
	