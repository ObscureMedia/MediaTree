<?php

//get the product id
//change url
//display product
include_once ('mysql_connect.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location: 404.php");
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM PRODUCT WHERE P_ID='$id' LIMIT 1";

$result = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array($result)) {

		$product_name 	= 	$row['P_NAME'];
		$Page_Title		= 	$row['P_NAME']. " - ObscureMedia";
?>
<html>
	<head>
		<link href="stylingCSS.css" rel="stylesheet" type="text/css"> 
		<title><?php echo $Page_Title;?></title>
	</head>
	<body>
	
		<?php include "header.php";	?>
		
		<p><?php echo $product_name;?></p>
		
		
		<?php include "footer.php";	?>

	</body>
</html>

 <?php }?>