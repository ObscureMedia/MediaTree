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
$Dcounter = 0;
$User_Addresses = array();

	$q = "SELECT * FROM DELIVERY_ADDRESS
	WHERE U_ID = 2
	AND D_DELETED = FALSE";

	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$_SESSION['U_ID']  = $row[0];
	$D_ADDRESS_NAME = $row[1];
	$D_ADDRESS_LINE_1  = $row[2];
	$D_ADDRESS_LINE_2  = $row[3];
	$D_TOWN_CITY  = $row[4];
	$D_COUNTY = $row[5];
	$D_POSTCODE  = $row[6];
	$D_COUNTRY  = $row[7];

	$Address=array('D_ADDRESS_NAME' =>$D_ADDRESS_NAME,
	'D_ADDRESS_LINE_1' =>$D_ADDRESS_LINE_1,
	'D_ADDRESS_LINE_2'=> $D_ADDRESS_LINE_2,
	'D_TOWN_CITY' =>$D_TOWN_CITY,
	'D_COUNTY'=> $D_COUNTY, 
	'D_POSTCODE' =>$D_POSTCODE, 
	'D_COUNTRY' =>$D_COUNTRY);
	
	array_push($User_Addresses,$Address);
	$_SESSION['U_ADDRESSES']=$User_Addresses;

	
	$Dcounter++;
	echo "<b>Address $Dcounter:</b> <br>";
	$Dcounter--;
	echo $D_ADDRESS_NAME,"<br>";
	echo $D_ADDRESS_LINE_1,"<br>";
		if($D_ADDRESS_LINE_2 != '')
				{
					echo "D_ADDRESS LINE_2<br>";
				}
	echo $D_TOWN_CITY,"<br>";
	echo $D_COUNTY,"<br>";
	echo $D_POSTCODE,"<br>";
	echo $D_COUNTRY,"<br><br>";
	
	echo"<form action='ChangeAddress.php' method='post'>
	<input type='submit' name='changeAddress' value='Edit Address'>
	<input type='submit' name='changeAddress' value='Delete Address'>
	<input type='hidden' name='Address' value=$Dcounter>
	
	</form>";
	$Dcounter++;
	echo"<hr />";
	
	}
	
	?>
	
</body>
</html>
	