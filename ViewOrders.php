<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<link rel="stylesheet" type"text/css" href="orderCSS.css" />
	</head>
<body>

<?php
	//Logs in to the mysql and selects the database
include'ConnectAndSelect.php';      
	$Ocounter = 0;    
	$Pcounter = 0;   
	
	$q = "SELECT * FROM ORDER_TABLE
	WHERE U_ID = 2";
	$result = mysql_query($q) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		
		$O_ID[$Ocounter]  = $row[0];
		$Ocounter++;
	}	
	$Ocounter = 0;
	foreach ($O_ID as $OrderValue)
	{
	$q= "SELECT SUBTOTAL, POSTAGE, TOTAL_BEFORE_VAT, SALES_TAX, ORDER_TOTAL, D_APPROX, D_METHOD
		FROM ORDER_TABLE WHERE O_ID = '$OrderValue'";
		$result = mysql_query($q) or die(mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_NUM))
			{
				$Subtotal = $row[0];
				$Postage = $row[1];
				$Total_Before_VAT = $row[2];
				$Sales_Tax = $row[3];
				$O_TOTAL = $row[4];
				$Delivery_Approx_Date = $row[5];
				$Delivery_Method = $row[6];
			}
		$Pcounter=0;
	
		echo"<table border='1' class='order'>";
		echo"<th colspan='2'><h2>Order ID: $OrderValue</h2></th>";
				
		$q = "SELECT P_ID, QUANTITY FROM ORDERED_PRODUCT
		WHERE O_ID = '$OrderValue'";
		$result = mysql_query($q) or die(mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_NUM))
			{
				$ORDERED_PRODUCT[$Pcounter] = $row[0];
				$QUANTITY[$Pcounter] = $row[1];
				$Pcounter++;	
			}
		echo"<tr>";
		$Pcounter++;
		$Pcounter++;
		echo"<td rowspan=$Pcounter width=15% align='left'>";
		$Pcounter--;
		$Pcounter--;
		$q = "SELECT D_ADDRESS_NAME, D_ADDRESS_LINE_1, D_ADDRESS_LINE_2, D_TOWN_CITY, D_COUNTY, D_POSTCODE, D_COUNTRY
		FROM DELIVERY_ADDRESS
		WHERE D_ADDRESS_NAME = (SELECT D_ADDRESS_NAME FROM ORDER_TABLE WHERE O_ID = '$OrderValue')";
			$result = mysql_query($q) or die(mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_NUM))
		{
				$Delivery_Address_Name = $row[0];
				$Delivery_Address_Line_1 = $row[1];
				$Delivery_Address_Line_2 = $row[2];
				$Delivery_Town_City = $row[3];
				$Delivery_County = $row[4];
				$Delivery_Postcode = $row[5];
				$Delivery_Country = $row[6];
				echo"<div class 'delivery>";
				echo"<b>Delivery Address:</b><br>";
				echo "$Delivery_Address_Name<br>";	
				echo "$Delivery_Address_Line_1<br>";
				if($Delivery_Address_Line_2 != '')
				{
					echo "$Delivery_Address_Line_2<br>";
				}
				echo "$Delivery_Town_City<br>";
				echo "$Delivery_County<br>";
				echo "$Delivery_Postcode<br>";
				echo "$Delivery_Country<br><br>";
				echo "<b>Delivery method:</b><br>$Delivery_Method<br><br>";
				echo "<b>Approximate<br> Delivery Date:</b> $Delivery_Approx_Date";
				
				echo"</div>";
		}
		
		echo"</td>";
		
			$ORDERED_PRODUCT[$Pcounter] = $row[0];
			$Pcounter=0;
			foreach($ORDERED_PRODUCT as $Product_Value)
			{
				$q = "SELECT P_NAME, P_ARTIST, P_PRICE FROM PRODUCT
				WHERE P_ID ='$Product_Value'";
				$result = mysql_query($q) or die(mysql_error());
				while ($row = mysql_fetch_array($result, MYSQL_NUM))
				{
					$Product_Name[$Pcounter] = $row[0];
					$Product_Artist[$Pcounter] = $row[1];
					$Product_Price[$Pcounter] = $row[2];
					echo"<td class ='product'>";
					echo"Product Name: $Product_Name[$Pcounter]";
					
					echo"<div class='price'>Price: £$Product_Price[$Pcounter]</div><br>";
					echo"Product Artist:  $Product_Artist[$Pcounter]<br>";
					echo"Product Quantity: $QUANTITY[$Pcounter]<br>";

					$Pcounter++;
					echo"</td>";
					echo"</tr>";
					echo"<tr>";
					
				}
					
			}
			echo"</tr>";
			echo"<tr align='right'>";
			echo"<td>";
				echo"Item(s) Subtotal: £$Subtotal<br>";
				echo"Postage and packing: £$Postage<br>";
				echo"-----<br>";
				echo"Total Before VAT: £$Total_Before_VAT<br>";
				echo"VAT:  £$Sales_Tax<br>";
				echo"-----<br>";
				echo"Order Total: £$O_TOTAL<br>";
					echo"-----<br>";
			echo"</td>";
		echo"</tr>";
		echo"</table>";
		echo"<br>";
	}
	
		
?>